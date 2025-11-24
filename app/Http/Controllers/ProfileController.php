<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();
        
        activity()
            ->causedBy($request->user())
            ->withProperties([
                'ip_address' => request()->ip()
            ])
            ->log('Profile updated');

        return redirect(route('profile.edit') . '#profile-information')->with('status', 'profile-updated');
    }

    /**
     * Update user avatar
     */
    public function updateAvatar(Request $request): RedirectResponse
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        try {
            if (!$request->hasFile('avatar')) {
                return redirect(route('profile.edit') . '#avatar')->withErrors(['avatar' => 'No file uploaded']);
            }
            
            $file = $request->file('avatar');
            
            if (!$file->isValid()) {
                return redirect(route('profile.edit') . '#avatar')->withErrors(['avatar' => 'Invalid file']);
            }
            
            $user = $request->user();
            
            // Delete old avatar if exists
            if ($user->avatar && file_exists(storage_path('app/public/' . $user->avatar))) {
                unlink(storage_path('app/public/' . $user->avatar));
            }
            
            // Generate unique filename
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $avatarPath = 'avatars/' . $filename;
            
            // Move file to public storage
            $file->move(storage_path('app/public/avatars'), $filename);
            
            // Update user avatar
            $request->user()->update(['avatar' => $avatarPath]);
            
            activity()
                ->causedBy($request->user())
                ->withProperties([
                    'ip_address' => request()->ip()
                ])
                ->log('Avatar updated');
            
            return redirect(route('profile.edit') . '#avatar')->with('status', 'avatar-updated');
            
        } catch (\Exception $e) {
            return redirect(route('profile.edit') . '#avatar')->withErrors(['avatar' => 'Upload failed: ' . $e->getMessage()]);
        }
    }

    /**
     * Update user language
     */
    public function updateLanguage(Request $request): RedirectResponse
    {
        $request->validate([
            'language' => 'required|in:en,fr,es,ar'
        ]);

        $oldLanguage = $request->user()->language;
        $request->user()->update(['language' => $request->language]);
        session(['locale' => $request->language]);
        
        activity()
            ->causedBy($request->user())
            ->withProperties([
                'old_language' => $oldLanguage,
                'new_language' => $request->language,
                'ip_address' => request()->ip()
            ])
            ->log('Language changed');
        
        return redirect(route('profile.edit') . '#preferences')->with('status', 'language-updated');
    }

    /**
     * Toggle dark mode
     */
    public function toggleDarkMode(Request $request)
    {
        $user = $request->user();
        $darkMode = $request->input('dark_mode', !$user->dark_mode);
        
        $user->update(['dark_mode' => $darkMode]);
        
        activity()
            ->causedBy($user)
            ->withProperties([
                'theme' => $darkMode ? 'dark' : 'light',
                'ip_address' => request()->ip()
            ])
            ->log('Theme changed');
        
        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'dark_mode' => $darkMode]);
        }
        
        return redirect(route('profile.edit') . '#preferences')->with('status', 'theme-updated');
    }

    /**
     * Update notification settings
     */
    public function updateNotifications(Request $request): RedirectResponse
    {
        $settings = [
            'email_notifications' => $request->boolean('email_notifications'),
            'push_notifications' => $request->boolean('push_notifications'),
            'marketing_emails' => $request->boolean('marketing_emails'),
            'security_alerts' => $request->boolean('security_alerts'),
        ];
        
        $request->user()->update(['notification_settings' => $settings]);
        
        return redirect(route('profile.edit') . '#notifications')->with('status', 'notifications-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
