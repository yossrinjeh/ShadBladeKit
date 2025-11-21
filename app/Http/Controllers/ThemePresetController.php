<?php

namespace App\Http\Controllers;

use App\Models\ThemePreset;
use App\Models\AppSetting;
use Illuminate\Http\Request;

class ThemePresetController extends Controller
{
    public function index()
    {
        $presets = ThemePreset::all();
        $settings = [
            'bg_light_color' => AppSetting::get('bg_light_color', '#ffffff'),
            'bg_dark_color' => AppSetting::get('bg_dark_color', '#1f2937'),
            'primary_color' => AppSetting::get('primary_color', '#3b82f6'),
            'secondary_color' => AppSetting::get('secondary_color', '#64748b'),
            'accent_color' => AppSetting::get('accent_color', '#10b981'),
            'success_color' => AppSetting::get('success_color', '#22c55e'),
            'warning_color' => AppSetting::get('warning_color', '#f59e0b'),
            'danger_color' => AppSetting::get('danger_color', '#ef4444'),
        ];
        return view('settings.theme-presets', compact('presets', 'settings'));
    }
    
    public function activate(ThemePreset $preset)
    {
        $preset->activate();
        
        return back()->with('success', "Theme '{$preset->name}' activated successfully!");
    }
    
    public function updateColors(Request $request)
    {
        $request->validate([
            'bg_light_color' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'bg_dark_color' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'primary_color' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'secondary_color' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'accent_color' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'success_color' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'warning_color' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'danger_color' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/',
        ]);
        
        AppSetting::set('bg_light_color', $request->bg_light_color);
        AppSetting::set('bg_dark_color', $request->bg_dark_color);
        AppSetting::set('primary_color', $request->primary_color);
        AppSetting::set('secondary_color', $request->secondary_color);
        AppSetting::set('accent_color', $request->accent_color);
        AppSetting::set('success_color', $request->success_color);
        AppSetting::set('warning_color', $request->warning_color);
        AppSetting::set('danger_color', $request->danger_color);
        
        // Deactivate all presets since custom colors are applied
        ThemePreset::query()->update(['is_active' => false]);
        
        return back()->with('success', 'Custom colors updated successfully!');
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
        
        ThemePreset::query()->update(['is_active' => false]);
        
        return back()->with('success', 'Colors reset to defaults successfully!');
    }
}