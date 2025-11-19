<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{ session('theme') === 'dark' ? 'dark' : '' }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    </head>
    <body class="font-sans antialiased bg-background text-foreground">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <div class="flex items-center mb-6">
                <a href="/" class="flex items-center space-x-2">
                    <x-application-logo class="w-12 h-12" />
                    <span class="text-2xl font-bold">{{ config('app.name') }}</span>
                </a>
            </div>

            <div class="w-full sm:max-w-md">
                {{ $slot }}
            </div>
            
            <div class="mt-6 flex items-center space-x-4">
                <x-ui.theme-toggle />
                <x-ui.lang-switcher />
            </div>
        </div>
    </body>
</html>
