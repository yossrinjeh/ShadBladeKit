<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PragmaRX\Google2FA\Google2FA;
use Illuminate\Support\Collection;

class TwoFactorController extends Controller
{
    protected $google2fa;
    
    public function __construct()
    {
        $this->google2fa = new Google2FA();
    }
    
    public function enable(Request $request)
    {
        $user = $request->user();
        
        if ($user->hasTwoFactorEnabled()) {
            return back()->with('error', '2FA is already enabled');
        }
        
        $secret = $this->google2fa->generateSecretKey();
        
        // Save the secret to the user
        $user->two_factor_secret = $secret;
        $user->save();
        
        $qrCodeUrl = $this->google2fa->getQRCodeUrl(
            config('app.name'),
            $user->email,
            $secret
        );
        
        return back()->with([
            'two_factor_secret' => $secret,
            'two_factor_qr_code' => $qrCodeUrl,
            'status' => '2fa-setup-ready'
        ]);
    }
    
    public function confirm(Request $request)
    {
        $request->validate([
            'code' => 'required|string|size:6'
        ]);
        
        $user = $request->user();
        
        if (!$user->two_factor_secret) {
            return back()->with('error', 'No 2FA secret found. Please start the setup process again.');
        }
        
        if ($user->two_factor_confirmed_at) {
            return back()->with('error', '2FA is already enabled for your account.');
        }
        
        $valid = $this->google2fa->verifyKey($user->two_factor_secret, $request->code);
        
        if (!$valid) {
            return back()->with('error', 'Invalid verification code');
        }
        
        // Generate recovery codes
        $recoveryCodes = Collection::times(8, function () {
            return strtoupper(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 8));
        });
        
        // Update user with confirmation and recovery codes
        $user->two_factor_confirmed_at = now();
        $user->two_factor_recovery_codes = $recoveryCodes->toArray();
        $user->save();
        
        return back()->with([
            'status' => '2fa-enabled',
            'recovery_codes' => $recoveryCodes
        ]);
    }
    
    public function disable(Request $request)
    {
        $request->validate([
            'password' => 'required|current_password'
        ]);
        
        $user = $request->user();
        
        $user->update([
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'two_factor_confirmed_at' => null
        ]);
        
        return back()->with('status', '2fa-disabled');
    }
    
    public function regenerateRecoveryCodes(Request $request)
    {
        $user = $request->user();
        
        if (!$user->hasTwoFactorEnabled()) {
            return back()->with('error', '2FA is not enabled');
        }
        
        $recoveryCodes = Collection::times(8, function () {
            return strtoupper(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 8));
        });
        
        $user->update(['two_factor_recovery_codes' => $recoveryCodes->toArray()]);
        
        return back()->with([
            'status' => 'recovery-codes-regenerated',
            'recovery_codes' => $recoveryCodes
        ]);
    }
}
