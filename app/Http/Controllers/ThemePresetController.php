<?php

namespace App\Http\Controllers;

use App\Models\ThemePreset;
use Illuminate\Http\Request;

class ThemePresetController extends Controller
{
    public function index()
    {
        $presets = ThemePreset::all();
        return view('settings.theme-presets', compact('presets'));
    }
    
    public function activate(ThemePreset $preset)
    {
        $preset->activate();
        
        return back()->with('success', "Theme '{$preset->name}' activated successfully!");
    }
}