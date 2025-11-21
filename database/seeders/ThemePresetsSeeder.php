<?php

namespace Database\Seeders;

use App\Models\ThemePreset;
use Illuminate\Database\Seeder;

class ThemePresetsSeeder extends Seeder
{
    public function run(): void
    {
        $presets = [
            [
                'name' => 'Classic Blue',
                'slug' => 'classic-blue',
                'colors' => [
                    'bg_light_color' => '#ffffff',
                    'bg_dark_color' => '#0f172a',
                    'primary_color' => '#3b82f6',
                    'secondary_color' => '#64748b',
                    'accent_color' => '#1d4ed8',
                    'success_color' => '#22c55e',
                    'warning_color' => '#f59e0b',
                    'danger_color' => '#ef4444',
                ],
                'is_active' => true,
            ],
            [
                'name' => 'Emerald SaaS',
                'slug' => 'emerald-saas',
                'colors' => [
                    'bg_light_color' => '#f8fafc',
                    'bg_dark_color' => '#0c1821',
                    'primary_color' => '#10b981',
                    'secondary_color' => '#6b7280',
                    'accent_color' => '#059669',
                    'success_color' => '#34d399',
                    'warning_color' => '#fbbf24',
                    'danger_color' => '#f87171',
                ],
            ],
            [
                'name' => 'Cyber Purple',
                'slug' => 'cyber-purple',
                'colors' => [
                    'bg_light_color' => '#faf5ff',
                    'bg_dark_color' => '#1a0b2e',
                    'primary_color' => '#8b5cf6',
                    'secondary_color' => '#a78bfa',
                    'accent_color' => '#7c3aed',
                    'success_color' => '#10b981',
                    'warning_color' => '#f59e0b',
                    'danger_color' => '#ec4899',
                ],
            ],
            [
                'name' => 'Warm Orange',
                'slug' => 'warm-orange',
                'colors' => [
                    'bg_light_color' => '#fffbf5',
                    'bg_dark_color' => '#1c1917',
                    'primary_color' => '#f97316',
                    'secondary_color' => '#78716c',
                    'accent_color' => '#ea580c',
                    'success_color' => '#22c55e',
                    'warning_color' => '#eab308',
                    'danger_color' => '#dc2626',
                ],
            ],
            [
                'name' => 'Minimal Black/White',
                'slug' => 'minimal-bw',
                'colors' => [
                    'bg_light_color' => '#ffffff',
                    'bg_dark_color' => '#000000',
                    'primary_color' => '#374151',
                    'secondary_color' => '#9ca3af',
                    'accent_color' => '#111827',
                    'success_color' => '#059669',
                    'warning_color' => '#d97706',
                    'danger_color' => '#dc2626',
                ],
            ],
        ];

        foreach ($presets as $preset) {
            ThemePreset::updateOrCreate(['slug' => $preset['slug']], $preset);
        }
    }
}