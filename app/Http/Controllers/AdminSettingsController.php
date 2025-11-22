<?php

namespace App\Http\Controllers;

use App\Models\AppSetting;
use App\Models\ThemePreset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminSettingsController extends Controller
{
    public function index()
    {
        $settings = [
            'app_name' => AppSetting::get('app_name', config('app.name')),
            'bg_light_color' => AppSetting::get('bg_light_color', '#ffffff'),
            'bg_dark_color' => AppSetting::get('bg_dark_color', '#1f2937'),
            'primary_color' => AppSetting::get('primary_color', '#3b82f6'),
            'secondary_color' => AppSetting::get('secondary_color', '#64748b'),
            'accent_color' => AppSetting::get('accent_color', '#10b981'),
            'success_color' => AppSetting::get('success_color', '#22c55e'),
            'warning_color' => AppSetting::get('warning_color', '#f59e0b'),
            'danger_color' => AppSetting::get('danger_color', '#ef4444'),
            'app_logo' => AppSetting::get('app_logo'),
            'app_favicon' => AppSetting::get('app_favicon'),
        ];
        
        $presets = ThemePreset::all();
        $activePreset = ThemePreset::getActive();
        
        return view('admin.settings', compact('settings', 'presets', 'activePreset'));
    }
    
    public function update(Request $request)
    {
        $request->validate([
            'app_name' => 'required|string|max:255',
            'app_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'app_favicon' => 'nullable|file|mimes:ico,png,jpg,jpeg|max:2048',
        ]);
        
        // Update app name
        AppSetting::set('app_name', $request->app_name);
        
        // Handle logo upload
        if ($request->hasFile('app_logo')) {
            $file = $request->file('app_logo');
            
            // Delete old logo
            $oldLogo = AppSetting::get('app_logo');
            if ($oldLogo && file_exists(storage_path('app/public/' . $oldLogo))) {
                unlink(storage_path('app/public/' . $oldLogo));
            }
            
            // Create logos directory if it doesn't exist
            if (!file_exists(storage_path('app/public/logos'))) {
                mkdir(storage_path('app/public/logos'), 0755, true);
            }
            
            // Generate unique filename
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $logoPath = 'logos/' . $filename;
            
            // Move file to public storage
            $file->move(storage_path('app/public/logos'), $filename);
            
            AppSetting::set('app_logo', $logoPath);
        }
        
        // Handle favicon upload
        if ($request->hasFile('app_favicon')) {
            $file = $request->file('app_favicon');
            
            // Delete old favicon
            $oldFavicon = AppSetting::get('app_favicon');
            if ($oldFavicon && file_exists(storage_path('app/public/' . $oldFavicon))) {
                unlink(storage_path('app/public/' . $oldFavicon));
            }
            
            // Create favicons directory if it doesn't exist
            if (!file_exists(storage_path('app/public/favicons'))) {
                mkdir(storage_path('app/public/favicons'), 0755, true);
            }
            
            // Generate unique filename
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $faviconPath = 'favicons/' . $filename;
            
            // Move file to public storage
            $file->move(storage_path('app/public/favicons'), $filename);
            
            AppSetting::set('app_favicon', $faviconPath);
        }
        
        activity()
            ->causedBy(auth()->user())
            ->withProperties([
                'app_name' => $request->app_name,
                'primary_color' => $request->primary_color,
                'secondary_color' => $request->secondary_color,
                'ip_address' => request()->ip()
            ])
            ->log('App settings updated');
        
        $message = 'App settings updated successfully!';
        if ($request->hasFile('app_logo')) {
            $message .= ' Logo uploaded.';
        }
        if ($request->hasFile('app_favicon')) {
            $message .= ' Favicon uploaded.';
        }
        
        return redirect()->route('admin.settings')->with('status', 'settings-updated')->with('message', $message);
    }
    
    public function activatePreset(ThemePreset $preset)
    {
        $preset->activate();
        
        activity()
            ->causedBy(auth()->user())
            ->withProperties([
                'preset_name' => $preset->name,
                'ip_address' => request()->ip()
            ])
            ->log('Theme preset activated');
        
        return redirect()->route('admin.settings')->with('status', 'preset-activated');
    }
    
    public function resetToDefaults()
    {
        $defaults = [
            'bg_light_color' => '#ffffff',
            'bg_dark_color' => '#0f172a',
            'primary_color' => '#6366f1',
            'secondary_color' => '#64748b',
            'accent_color' => '#10b981',
            'success_color' => '#22c55e',
            'warning_color' => '#f59e0b',
            'danger_color' => '#ef4444',
        ];
        
        foreach ($defaults as $key => $value) {
            AppSetting::set($key, $value);
        }
        
        // Deactivate all presets
        ThemePreset::query()->update(['is_active' => false]);
        
        activity()
            ->causedBy(auth()->user())
            ->withProperties(['ip_address' => request()->ip()])
            ->log('Theme colors reset to defaults');
        
        return redirect()->route('admin.settings')->with('status', 'reset-completed');
    }
}
