<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        return view('settings.index');
    }

    public function update(Request $request)
    {
        $request->validate([
            'theme' => 'in:light,dark',
            'language' => 'in:en,fr,es,ar',
        ]);

        if ($request->has('theme')) {
            session(['theme' => $request->theme]);
        }

        if ($request->has('language')) {
            session(['locale' => $request->language]);
        }

        return back()->with('status', 'settings-updated');
    }
}
