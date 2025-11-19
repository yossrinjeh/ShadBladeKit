<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" class="scroll-smooth" x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }" x-bind:class="{ 'dark': darkMode }">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? config('app.name', 'Laravel') }}</title>
        
        <!-- Favicon -->
        @if($appSettings['favicon'])
            <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . $appSettings['favicon']) }}">
        @else
            <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
        @endif

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <script>
            if (localStorage.getItem('darkMode') === null) {
                localStorage.setItem('darkMode', 'false');
            }
        </script>
        

    </head>
    <body class="font-sans antialiased bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100">
        @if(request()->routeIs('welcome'))
            {{ $slot }}
        @else
            <!-- Top Navigation for Auth Pages -->
            <nav class="bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-700">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between items-center h-16">
                        <div class="flex items-center">
                            <a href="{{ route('welcome') }}" class="flex items-center">
                                @if($appSettings['logo'])
                                    <img src="{{ asset('storage/' . $appSettings['logo']) }}" alt="{{ $appSettings['name'] }}" class="h-8 w-8 object-contain">
                                @else
                                    <x-application-logo class="h-8 w-8" />
                                @endif
                                <span class="ml-2 text-xl font-bold text-gray-900 dark:text-gray-100">{{ $appSettings['name'] }}</span>
                            </a>
                        </div>
                        <div class="flex items-center space-x-4">
                            <!-- Language Switcher -->
                            <div class="relative" x-data="{ open: false }" @click.outside="open = false">
                                <button @click="open = !open" class="flex items-center text-sm text-gray-700 dark:text-gray-300 hover:text-blue-600">
                                    @switch(app()->getLocale())
                                        @case('en') 🇺🇸 EN @break
                                        @case('fr') 🇫🇷 FR @break
                                        @case('es') 🇪🇸 ES @break
                                        @case('ar') 🇸🇦 AR @break
                                    @endswitch
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                <div x-show="open" x-transition class="absolute right-0 mt-2 w-32 bg-white dark:bg-gray-800 rounded-md shadow-lg z-50">
                                    <a href="{{ route('locale.switch', 'en') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">🇺🇸 English</a>
                                    <a href="{{ route('locale.switch', 'fr') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">🇫🇷 Français</a>
                                    <a href="{{ route('locale.switch', 'es') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">🇪🇸 Español</a>
                                    <a href="{{ route('locale.switch', 'ar') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">🇸🇦 العربية</a>
                                </div>
                            </div>
                            
                            <!-- Dark Mode Toggle -->
                            <button @click="darkMode = !darkMode; localStorage.setItem('darkMode', darkMode)" class="p-2 rounded-md text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                                </svg>
                                <svg x-show="darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </nav>
            
            <div class="min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8">
                {{ $slot }}
            </div>
        @endif
    </body>
</html>