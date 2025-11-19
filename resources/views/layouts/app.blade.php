<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" class="{{ auth()->check() && auth()->user()->dark_mode ? 'dark' : '' }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $appSettings['name'] ?? config('app.name', 'Laravel') }}</title>
        
        <!-- Favicon -->
        @if($appSettings['logo'])
            <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . $appSettings['favicon']) }}">
        @else
            <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
        @endif

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        
        <!-- Custom App Colors -->
        <style>
            :root {
                --bg-light: {{ $appSettings['bg_light_color'] ?? '#ffffff' }};
                --bg-dark: {{ $appSettings['bg_dark_color'] ?? '#1f2937' }};
                --primary: {{ $appSettings['primary_color'] ?? '#3b82f6' }};
                --secondary: {{ $appSettings['secondary_color'] ?? '#64748b' }};
                --accent: {{ $appSettings['accent_color'] ?? '#10b981' }};
                --success: {{ $appSettings['success_color'] ?? '#22c55e' }};
                --warning: {{ $appSettings['warning_color'] ?? '#f59e0b' }};
                --danger: {{ $appSettings['danger_color'] ?? '#ef4444' }};
            }
            
            /* Background Colors */
            html { background-color: var(--bg-light) !important; }
            html.dark { background-color: var(--bg-dark) !important; }
            body { background-color: var(--bg-light) !important; }
            .dark body { background-color: var(--bg-dark) !important; }
            
            /* Override Tailwind background classes */
            .bg-gray-50, .bg-white, .bg-background { background-color: var(--bg-light) !important; }
            .dark .bg-gray-900, .dark .bg-gray-800, .dark .bg-background { background-color: var(--bg-dark) !important; }
            .bg-card { background-color: var(--bg-light) !important; }
            .dark .bg-card { background-color: var(--bg-dark) !important; }
            
            /* Primary Colors */
            .bg-primary { background-color: var(--primary) !important; }
            .text-primary { color: var(--primary) !important; }
            .border-primary { border-color: var(--primary) !important; }
            .bg-primary\/90 { background-color: color-mix(in srgb, var(--primary) 90%, transparent) !important; }
            .bg-primary\/10 { background-color: color-mix(in srgb, var(--primary) 10%, transparent) !important; }
            .hover\:bg-primary\/90:hover { background-color: color-mix(in srgb, var(--primary) 90%, transparent) !important; }
            .text-primary-foreground { color: white !important; }
            
            /* Secondary Colors */
            .bg-secondary { background-color: var(--secondary) !important; }
            .text-secondary { color: var(--secondary) !important; }
            .border-secondary { border-color: var(--secondary) !important; }
            
            /* Accent Colors */
            .bg-accent { background-color: var(--accent) !important; }
            .text-accent { color: var(--accent) !important; }
            .border-accent { border-color: var(--accent) !important; }
            
            /* Success Colors */
            .bg-green-500, .bg-green-600, .text-green-600 { background-color: var(--success) !important; color: var(--success) !important; }
            .bg-green-100 { background-color: color-mix(in srgb, var(--success) 10%, transparent) !important; }
            
            /* Warning Colors */
            .bg-yellow-500, .bg-orange-600, .text-yellow-600, .text-orange-600 { background-color: var(--warning) !important; color: var(--warning) !important; }
            .bg-yellow-100, .bg-orange-100 { background-color: color-mix(in srgb, var(--warning) 10%, transparent) !important; }
            
            /* Danger Colors */
            .bg-red-500, .bg-red-600, .text-red-600, .text-red-500 { background-color: var(--danger) !important; color: var(--danger) !important; }
            .bg-red-100 { background-color: color-mix(in srgb, var(--danger) 10%, transparent) !important; }
            
            /* Blue Colors (Primary Override) */
            .bg-blue-600, .text-blue-600, .bg-blue-100 { background-color: var(--primary) !important; color: var(--primary) !important; }
            .bg-blue-100 { background-color: color-mix(in srgb, var(--primary) 10%, transparent) !important; }
            
            /* Purple Colors (Secondary Override) */
            .bg-purple-600, .text-purple-600, .bg-purple-100 { background-color: var(--secondary) !important; color: var(--secondary) !important; }
            .bg-purple-100 { background-color: color-mix(in srgb, var(--secondary) 10%, transparent) !important; }
        </style>
    </head>
    <body class="font-sans antialiased text-foreground">
        <x-ui.sidebar>
            @isset($header)
                <div class="mb-6">
                    {{ $header }}
                </div>
            @endisset
            
            {{ $slot }}
        </x-ui.sidebar>
    </body>
</html>
