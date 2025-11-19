<?php

namespace Database\Seeders;

use App\Models\AppSetting;
use Illuminate\Database\Seeder;

class AppSettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            'app_name' => 'ShadBladeKit',
            'bg_light_color' => '#ffffff',
            'bg_dark_color' => '#0f172a',
            'primary_color' => '#6366f1',
            'secondary_color' => '#64748b',
            'accent_color' => '#10b981',
            'success_color' => '#22c55e',
            'warning_color' => '#f59e0b',
            'danger_color' => '#ef4444',
        ];

        foreach ($settings as $key => $value) {
            AppSetting::updateOrCreate(['key' => $key], ['value' => $value]);
        }
    }
}