<?php

namespace App\Providers;

use App\Models\AppSetting;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppSettingsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('*', function ($view) {
            $view->with([
                'appSettings' => [
                    'name' => AppSetting::get('app_name', config('app.name')),
                    'logo' => AppSetting::get('app_logo'),
                    'favicon' => AppSetting::get('app_favicon'),
                    'bg_light_color' => AppSetting::get('bg_light_color', '#ffffff'),
                    'bg_dark_color' => AppSetting::get('bg_dark_color', '#1f2937'),
                    'primary_color' => AppSetting::get('primary_color', '#3b82f6'),
                    'secondary_color' => AppSetting::get('secondary_color', '#64748b'),
                    'accent_color' => AppSetting::get('accent_color', '#10b981'),
                    'success_color' => AppSetting::get('success_color', '#22c55e'),
                    'warning_color' => AppSetting::get('warning_color', '#f59e0b'),
                    'danger_color' => AppSetting::get('danger_color', '#ef4444'),
                ]
            ]);
        });
    }
}
