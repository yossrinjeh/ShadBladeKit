<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" class="{{ auth()->check() && auth()->user()->dark_mode ? 'dark' : '' }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5, user-scalable=yes, viewport-fit=cover">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="{{ $appSettings['description'] ?? 'The Ultimate Laravel 11 Starter Kit with Enterprise Features and Modern UI' }}">
        <meta name="keywords" content="laravel, starter kit, admin panel, dashboard, php, tailwind css">
        <meta name="author" content="{{ $appSettings['author'] ?? 'ShadBladeKit' }}">
        <meta name="robots" content="index, follow">
        
        <!-- Mobile Optimizations -->
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="default">
        <meta name="apple-mobile-web-app-title" content="{{ $appSettings['name'] ?? config('app.name', 'Laravel') }}">
        <meta name="format-detection" content="telephone=no">
        <meta name="msapplication-tap-highlight" content="no">
        
        <!-- PWA Manifest -->
        <link rel="manifest" href="{{ asset('manifest.json') }}">
        
        <!-- Theme Colors -->
        <meta name="theme-color" content="{{ $appSettings['primary_color'] ?? '#3b82f6' }}">
        <meta name="msapplication-navbutton-color" content="{{ $appSettings['primary_color'] ?? '#3b82f6' }}">
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
        
        <!-- Open Graph -->
        <meta property="og:type" content="website">
        <meta property="og:title" content="{{ $appSettings['name'] ?? config('app.name', 'Laravel') }}">
        <meta property="og:description" content="{{ $appSettings['description'] ?? 'The Ultimate Laravel 11 Starter Kit' }}">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:site_name" content="{{ $appSettings['name'] ?? config('app.name', 'Laravel') }}">
        @if($appSettings['logo'])
            <meta property="og:image" content="{{ asset('storage/' . $appSettings['logo']) }}">
        @endif
        
        <!-- Twitter Card -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="{{ $appSettings['name'] ?? config('app.name', 'Laravel') }}">
        <meta name="twitter:description" content="{{ $appSettings['description'] ?? 'The Ultimate Laravel 11 Starter Kit' }}">
        @if($appSettings['logo'])
            <meta name="twitter:image" content="{{ asset('storage/' . $appSettings['logo']) }}">
        @endif

        <title>{{ $appSettings['name'] ?? config('app.name', 'Laravel') }}</title>
        
        <!-- Favicons -->
        @if($appSettings['favicon'])
            <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . $appSettings['favicon']) }}">
            <link rel="apple-touch-icon" href="{{ asset('storage/' . $appSettings['favicon']) }}">
        @else
            <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
            <link rel="apple-touch-icon" href="{{ asset('favicon.ico') }}">
        @endif
        


        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        

        
        <!-- DNS Prefetch -->
        <link rel="dns-prefetch" href="//fonts.bunny.net">
        <link rel="dns-prefetch" href="//cdn.jsdelivr.net">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="stylesheet" href="{{ asset('resources/css/rtl.css') }}">
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
            html { background-color: var(--bg-light); }
            html.dark { background-color: var(--bg-dark); }
            body { background-color: var(--bg-light); }
            .dark body { background-color: var(--bg-dark); }
            
            /* Theme Colors */
            .bg-primary { background-color: var(--primary); }
            .text-primary { color: var(--primary); }
            .border-primary { border-color: var(--primary); }
            .text-primary-foreground { color: white; }
            
            .bg-secondary { background-color: var(--secondary); }
            .text-secondary { color: var(--secondary); }
            .border-secondary { border-color: var(--secondary); }
            
            .bg-accent { background-color: var(--accent); }
            .text-accent { color: var(--accent); }
            .border-accent { border-color: var(--accent); }
            
            /* Button gradient classes */
            .from-primary { --tw-gradient-from: var(--primary); }
            .to-primary\/90 { --tw-gradient-to: color-mix(in srgb, var(--primary) 90%, transparent); }
            .hover\:from-primary\/90:hover { --tw-gradient-from: color-mix(in srgb, var(--primary) 90%, transparent); }
            .hover\:to-primary\/80:hover { --tw-gradient-to: color-mix(in srgb, var(--primary) 80%, transparent); }
            .shadow-primary\/25 { --tw-shadow-color: color-mix(in srgb, var(--primary) 25%, transparent); }
            .hover\:shadow-primary\/30:hover { --tw-shadow-color: color-mix(in srgb, var(--primary) 30%, transparent); }
            
            /* RTL Support */
            [dir="rtl"] .hover\:translate-x-1:hover { transform: translateX(-0.25rem); }
            [dir="rtl"] .space-x-2 > :not([hidden]) ~ :not([hidden]) { --tw-space-x-reverse: 1; }
            [dir="rtl"] .space-x-3 > :not([hidden]) ~ :not([hidden]) { --tw-space-x-reverse: 1; }
            [dir="rtl"] .space-x-4 > :not([hidden]) ~ :not([hidden]) { --tw-space-x-reverse: 1; }

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
