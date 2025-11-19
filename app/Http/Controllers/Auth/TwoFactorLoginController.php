<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PragmaRX\Google2FA\Google2FA;

class TwoFactorLoginController extends Controller
{
    protected $google2fa;
    
    public function __construct()
    {
        $this->google2fa = new Google2FA();
    }
    
    public function show()
    {
        if (!session('login.id')) {
            return redirect()->route('login');
        }
        
        return view('auth.two-factor-challenge');
    }
    
    public function store(Request $request)
    {
        if (!session('login.id')) {
            return redirect()->route('login');
        }
        
        $request->validate([
            'code' => 'nullable|string',
            'recovery_code' => 'nullable|string',
        ]);
        
        $user = \App\Models\User::find(session('login.id'));
        
        if (!$user || !$user->hasTwoFactorEnabled()) {
            return redirect()->route('login');
        }
        
        if ($request->code) {
            $valid = $this->google2fa->verifyKey($user->two_factor_secret, $request->code);
            
            if (!$valid) {
                return back()->withErrors(['code' => 'Invalid authentication code']);
            }
        } elseif ($request->recovery_code) {
            $recoveryCodes = $user->two_factor_recovery_codes ?? [];
            $recoveryCode = strtoupper(str_replace(' ', '', $request->recovery_code));
            
            if (!in_array($recoveryCode, $recoveryCodes)) {
                return back()->withErrors(['recovery_code' => 'Invalid recovery code']);
            }
            
            // Remove used recovery code
            $user->two_factor_recovery_codes = array_diff($recoveryCodes, [$recoveryCode]);
            $user->save();
        } else {
            return back()->withErrors(['code' => 'Please provide an authentication code or recovery code']);
        }
        
        // Clear the login session and log the user in
        session()->forget('login.id');
        Auth::login($user, session('login.remember', false));
        session()->forget('login.remember');
        
        return redirect()->intended(route('dashboard'));
    }
}
