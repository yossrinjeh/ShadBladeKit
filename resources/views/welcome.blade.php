<x-guest-layout>
    <x-slot name="title">ShadBladeKit v1 - The Ultimate Laravel Starter Kit</x-slot>

    <!-- Navigation -->
    <nav class="fixed top-0 w-full bg-white/80 dark:bg-gray-900/80 backdrop-blur-md border-b border-gray-200 dark:border-gray-700 z-50" x-data="{ mobileMenuOpen: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    @if($appSettings['logo'])
                        <img src="{{ asset('storage/' . $appSettings['logo']) }}" alt="{{ $appSettings['name'] }}" class="h-8 w-8 object-contain">
                    @else
                        <x-application-logo class="h-8 w-8" />
                    @endif
                    <span class="ml-2 text-xl font-bold hidden sm:block">{{ $appSettings['name'] }}</span>
                </div>
                
                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="p-2 rounded-md text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                
                <!-- Desktop menu -->
                <div class="hidden md:flex items-center space-x-4">
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
                    <button @click="darkMode = !darkMode; localStorage.setItem('darkMode', darkMode)" class="p-2 rounded-md text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800">
                        <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                        </svg>
                        <svg x-show="darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </button>
                    
                    <a href="{{ route('contact') }}" class="text-sm text-gray-700 dark:text-gray-300 hover:text-blue-600">{{ __('ui.contact_us') }}</a>
                    
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-sm text-gray-700 dark:text-gray-300 hover:text-blue-600">{{ __('welcome.dashboard') }}</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-300 hover:text-blue-600">{{ __('welcome.login') }}</a>
                        <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700">{{ __('welcome.get_started') }}</a>
                    @endauth
                </div>
            </div>
            
            <!-- Mobile menu -->
            <div x-show="mobileMenuOpen" x-transition class="md:hidden py-4 border-t border-gray-200 dark:border-gray-700">
                <div class="space-y-4">
                    <!-- Mobile Language Switcher -->
                    <div class="space-y-2">
                        <div class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('ui.language') }}</div>
                        <div class="grid grid-cols-2 gap-2">
                            <a href="{{ route('locale.switch', 'en') }}" class="flex items-center px-3 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-md">🇺🇸 English</a>
                            <a href="{{ route('locale.switch', 'fr') }}" class="flex items-center px-3 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-md">🇫🇷 Français</a>
                            <a href="{{ route('locale.switch', 'es') }}" class="flex items-center px-3 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-md">🇪🇸 Español</a>
                            <a href="{{ route('locale.switch', 'ar') }}" class="flex items-center px-3 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-md">🇸🇦 العربية</a>
                        </div>
                    </div>
                    
                    <!-- Mobile Dark Mode Toggle -->
                    <button @click="darkMode = !darkMode; localStorage.setItem('darkMode', darkMode)" class="flex items-center w-full px-3 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-md">
                        <svg x-show="!darkMode" class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                        </svg>
                        <svg x-show="darkMode" class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                        <span x-text="darkMode ? '{{ __('ui.light_mode') }}' : '{{ __('ui.dark_mode') }}'"></span>
                    </button>
                    
                    <a href="{{ route('contact') }}" class="block px-3 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-md">{{ __('ui.contact_us') }}</a>
                    
                    @auth
                        <a href="{{ route('dashboard') }}" class="block px-3 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-md">{{ __('welcome.dashboard') }}</a>
                    @else
                        <a href="{{ route('login') }}" class="block px-3 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-md">{{ __('welcome.login') }}</a>
                        <a href="{{ route('register') }}" class="block bg-blue-600 text-white px-3 py-2 rounded-lg text-sm hover:bg-blue-700 text-center">{{ __('welcome.get_started') }}</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="pt-24 pb-20 bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-5xl md:text-7xl font-bold text-gray-900 dark:text-white mb-6">
                    ShadBladeKit
                    <span class="text-blue-600">v1</span>
                </h1>
                <p class="text-2xl md:text-3xl font-semibold text-gray-700 dark:text-gray-300 mb-4">
                    {{ __('welcome.the_ultimate_laravel_starter') }}
                </p>
                <p class="text-lg text-gray-600 dark:text-gray-400 mb-12 max-w-4xl mx-auto">
                    {{ __('welcome.hero_description', ['app' => 'Laravel']) }}
                </p>
                
                <div class="flex flex-col sm:flex-row gap-4 justify-center mb-12">
                    <a href="#demo" class="bg-blue-600 text-white px-8 py-4 rounded-lg text-lg font-semibold hover:bg-blue-700 transition flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1m4 0h1m-6 4h8m-9-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ __('welcome.try_demo') }} →
                    </a>
                    <a href="https://github.com/yossrinjeh/ShadBladeKit" class="border-2 border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 px-8 py-4 rounded-lg text-lg font-semibold hover:bg-gray-50 dark:hover:bg-gray-800 transition flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                        </svg>
                        {{ __('welcome.view_on_github') }} →
                    </a>
                </div>

                <!-- CRUD Generator Video Demo -->
                <div class="relative max-w-4xl mx-auto">
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl overflow-hidden border border-gray-200 dark:border-gray-700">
                        <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 flex items-center space-x-2">
                            <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                            <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                            <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                            <div class="ml-4 text-sm text-gray-600 dark:text-gray-400">{{ __('welcome.crud_generator_demo') }}</div>
                        </div>
                        <div class="relative">
                            <video 
                                class="w-full h-auto" 
                                controls 
                                poster="{{ asset('storage/Post.PNG') }}"
                                preload="metadata"
                            >
                                <source src="{{ asset('storage/CRUD.mp4') }}" type="video/mp4">
                                <p class="p-6 text-center text-gray-600 dark:text-gray-300">
                                    {{ __('welcome.video_not_supported') }}
                                    <a href="{{ asset('storage/CRUD.mp4') }}" class="text-blue-600 hover:underline">{{ __('welcome.download_video') }}</a>
                                </p>
                            </video>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Feature Highlights -->
    <section class="py-20 bg-white dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">{{ __('welcome.powerful_features') }}</h2>
                <p class="text-xl text-gray-600 dark:text-gray-300">{{ __('welcome.everything_you_need') }}</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- CRUD Generator -->
                <div class="bg-gray-50 dark:bg-gray-800 p-8 rounded-xl border border-gray-200 dark:border-gray-700">
                    <div class="w-12 h-12 bg-orange-100 dark:bg-orange-900 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">{{ __('welcome.crud_generator') }}</h3>
                    <p class="text-gray-600 dark:text-gray-300 mb-4">{{ __('welcome.crud_generator_desc') }}</p>
                    <div class="bg-gray-900 rounded-lg p-3 text-sm font-mono text-green-400">
                        php artisan create:crud Post
                    </div>
                </div>

                <!-- AI Multi-Language -->
                <div class="bg-gray-50 dark:bg-gray-800 p-8 rounded-xl border border-gray-200 dark:border-gray-700">
                    <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">{{ __('welcome.ai_multilang_system') }}</h3>
                    <p class="text-gray-600 dark:text-gray-300 mb-4">{{ __('welcome.ai_multilang_desc') }}</p>
                    <div class="flex space-x-2">
                        <span class="px-2 py-1 bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 rounded text-xs">EN</span>
                        <span class="px-2 py-1 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 rounded text-xs">FR</span>
                        <span class="px-2 py-1 bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200 rounded text-xs">ES</span>
                        <span class="px-2 py-1 bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200 rounded text-xs">AR</span>
                    </div>
                </div>

                <!-- Command Palette -->
                <div class="bg-gray-50 dark:bg-gray-800 p-8 rounded-xl border border-gray-200 dark:border-gray-700">
                    <div class="w-12 h-12 bg-cyan-100 dark:bg-cyan-900 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">{{ __('welcome.command_palette') }}</h3>
                    <p class="text-gray-600 dark:text-gray-300 mb-4">{{ __('welcome.command_palette_desc') }}</p>
                    <div class="bg-gray-900 rounded-lg p-3 text-sm font-mono text-gray-300">
                        <span class="text-blue-400">⌘K</span> Quick Navigation
                    </div>
                </div>

                <!-- Analytics Dashboard -->
                <div class="bg-gray-50 dark:bg-gray-800 p-8 rounded-xl border border-gray-200 dark:border-gray-700">
                    <div class="w-12 h-12 bg-green-100 dark:bg-green-900 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">{{ __('welcome.analytics_dashboard') }}</h3>
                    <p class="text-gray-600 dark:text-gray-300 mb-4">{{ __('welcome.analytics_desc') }}</p>
                    <div class="grid grid-cols-2 gap-2">
                        <div class="bg-blue-100 dark:bg-blue-900 p-2 rounded text-center">
                            <div class="text-lg font-bold text-blue-800 dark:text-blue-200">24</div>
                            <div class="text-xs text-blue-600 dark:text-blue-300">Users</div>
                        </div>
                        <div class="bg-green-100 dark:bg-green-900 p-2 rounded text-center">
                            <div class="text-lg font-bold text-green-800 dark:text-green-200">12</div>
                            <div class="text-xs text-green-600 dark:text-green-300">Posts</div>
                        </div>
                    </div>
                </div>

                <!-- Theming & RTL -->
                <div class="bg-gray-50 dark:bg-gray-800 p-8 rounded-xl border border-gray-200 dark:border-gray-700">
                    <div class="w-12 h-12 bg-pink-100 dark:bg-pink-900 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h4" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">{{ __('welcome.theming_rtl_support') }}</h3>
                    <p class="text-gray-600 dark:text-gray-300 mb-4">{{ __('welcome.theming_rtl_desc') }}</p>
                    <div class="flex items-center space-x-2">
                        <div class="w-6 h-6 bg-white border-2 border-gray-300 rounded"></div>
                        <div class="w-6 h-6 bg-gray-900 rounded"></div>
                        <span class="text-sm text-gray-500 dark:text-gray-400">RTL ←</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Demo Area -->
    <section id="demo" class="py-20 bg-gray-50 dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">{{ __('welcome.try_it_live') }}</h2>
                <p class="text-xl text-gray-600 dark:text-gray-300">{{ __('welcome.experience_features') }}</p>
            </div>

            <!-- Demo Login -->
            <div class="max-w-md mx-auto mb-12">
                <div class="bg-white dark:bg-gray-900 p-8 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6 text-center">{{ __('welcome.demo_account') }}</h3>
                    <form method="POST" action="{{ route('login') }}" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('ui.email') }}</label>
                            <input type="email" name="email" value="admin@example.com" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('ui.password') }}</label>
                            <input type="password" name="password" value="password" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white" required>
                        </div>
                        <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-md font-semibold hover:bg-blue-700 transition flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                            </svg>
                            {{ __('welcome.enter_demo_dashboard') }}
                        </button>
                    </form>
                </div>
            </div>

            <!-- Quick Tasks -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <button class="bg-white dark:bg-gray-900 p-6 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 hover:shadow-xl transition text-left">
                    <div class="w-12 h-12 bg-orange-100 dark:bg-orange-900 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">{{ __('welcome.try_crud_generator') }}</h3>
                    <p class="text-gray-600 dark:text-gray-300">{{ __('welcome.generate_crud_seconds') }}</p>
                </button>

                <button class="bg-white dark:bg-gray-900 p-6 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 hover:shadow-xl transition text-left">
                    <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">{{ __('welcome.try_ai_translation') }}</h3>
                    <p class="text-gray-600 dark:text-gray-300">{{ __('welcome.translate_with_ai') }}</p>
                </button>

                <button class="bg-white dark:bg-gray-900 p-6 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 hover:shadow-xl transition text-left">
                    <div class="w-12 h-12 bg-cyan-100 dark:bg-cyan-900 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">{{ __('welcome.explore_command_palette') }}</h3>
                    <p class="text-gray-600 dark:text-gray-300">{{ __('welcome.press_ctrl_k') }}</p>
                </button>
            </div>
        </div>
    </section>

    <!-- Sample Data Section -->
    <section class="py-20 bg-white dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">{{ __('welcome.live_sample_data') }}</h2>
                <p class="text-xl text-gray-600 dark:text-gray-300">{{ __('welcome.dashboard_real_data') }}</p>
            </div>

            <!-- KPI Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-12">
                <div class="bg-blue-50 dark:bg-blue-900/20 p-6 rounded-xl border border-blue-200 dark:border-blue-800">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-blue-600 dark:text-blue-400 text-sm font-medium">{{ __('ui.total_users') }}</p>
                            <p class="text-3xl font-bold text-blue-900 dark:text-blue-100">24</p>
                        </div>
                        <div class="w-12 h-12 bg-blue-100 dark:bg-blue-800 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-green-50 dark:bg-green-900/20 p-6 rounded-xl border border-green-200 dark:border-green-800">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-green-600 dark:text-green-400 text-sm font-medium">{{ __('welcome.active_roles') }}</p>
                            <p class="text-3xl font-bold text-green-900 dark:text-green-100">5</p>
                        </div>
                        <div class="w-12 h-12 bg-green-100 dark:bg-green-800 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-purple-50 dark:bg-purple-900/20 p-6 rounded-xl border border-purple-200 dark:border-purple-800">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-purple-600 dark:text-purple-400 text-sm font-medium">{{ __('welcome.total_posts') }}</p>
                            <p class="text-3xl font-bold text-purple-900 dark:text-purple-100">12</p>
                        </div>
                        <div class="w-12 h-12 bg-purple-100 dark:bg-purple-800 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-orange-50 dark:bg-orange-900/20 p-6 rounded-xl border border-orange-200 dark:border-orange-800">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-orange-600 dark:text-orange-400 text-sm font-medium">{{ __('welcome.pending_tasks') }}</p>
                            <p class="text-3xl font-bold text-orange-900 dark:text-orange-100">3</p>
                        </div>
                        <div class="w-12 h-12 bg-orange-100 dark:bg-orange-800 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tech Stack -->
    <section class="py-20 bg-gray-50 dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">Built with Modern Tech</h2>
                <p class="text-xl text-gray-600 dark:text-gray-300">Leveraging the best tools and frameworks</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-8">
                <div class="text-center">
                    <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-sm mb-2">
                        <span class="text-2xl font-bold text-red-600">Laravel</span>
                    </div>
                    <p class="text-sm text-gray-600 dark:text-gray-300">Laravel 11</p>
                </div>
                <div class="text-center">
                    <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-sm mb-2">
                        <span class="text-2xl font-bold text-blue-600">Tailwind</span>
                    </div>
                    <p class="text-sm text-gray-600 dark:text-gray-300">Tailwind CSS</p>
                </div>
                <div class="text-center">
                    <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-sm mb-2">
                        <span class="text-2xl font-bold text-green-600">Alpine</span>
                    </div>
                    <p class="text-sm text-gray-600 dark:text-gray-300">Alpine.js</p>
                </div>
                <div class="text-center">
                    <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-sm mb-2">
                        <span class="text-2xl font-bold text-purple-600">Vite</span>
                    </div>
                    <p class="text-sm text-gray-600 dark:text-gray-300">Vite</p>
                </div>
                <div class="text-center">
                    <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-sm mb-2">
                        <span class="text-2xl font-bold text-yellow-600">MySQL</span>
                    </div>
                    <p class="text-sm text-gray-600 dark:text-gray-300">Database</p>
                </div>
                <div class="text-center">
                    <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-sm mb-2">
                        <span class="text-2xl font-bold text-indigo-600">Spatie</span>
                    </div>
                    <p class="text-sm text-gray-600 dark:text-gray-300">Packages</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Installation -->
    <section class="py-20 bg-white dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">Quick Installation</h2>
                <p class="text-xl text-gray-600 dark:text-gray-300">Get started in minutes with simple commands</p>
            </div>

            <div class="max-w-4xl mx-auto">
                <div class="bg-gray-900 rounded-lg p-6 font-mono text-sm overflow-x-auto">
                    <div class="text-green-400 mb-4"># Clone repository</div>
                    <div class="text-white mb-4">git clone https://github.com/yossrinjeh/ShadBladeKit.git</div>
                    <div class="text-white mb-4">cd ShadBladeKit</div>
                    
                    <div class="text-green-400 mb-4 mt-6"># Install dependencies</div>
                    <div class="text-white mb-4">composer install</div>
                    <div class="text-white mb-4">npm install</div>
                    
                    <div class="text-green-400 mb-4 mt-6"># Setup environment</div>
                    <div class="text-white mb-4">cp .env.example .env</div>
                    <div class="text-white mb-4">php artisan key:generate</div>
                    
                    <div class="text-green-400 mb-4 mt-6"># Run migrations</div>
                    <div class="text-white mb-4">php artisan migrate --seed</div>
                    
                    <div class="text-green-400 mb-4 mt-6"># Start development</div>
                    <div class="text-white">composer run dev</div>
                </div>

                <div class="mt-8 p-6 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                    <h3 class="text-lg font-semibold text-blue-900 dark:text-blue-100 mb-2">Default Credentials</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                        <div>
                            <strong class="text-blue-800 dark:text-blue-200">Admin:</strong><br>
                            Email: admin@example.com<br>
                            Password: password
                        </div>
                        <div>
                            <strong class="text-blue-800 dark:text-blue-200">User:</strong><br>
                            Email: user@example.com<br>
                            Password: password
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tech Stack -->
    <section class="py-16 bg-gray-50 dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-4">
                    {{ __('welcome.built_with_modern') }}
                </h2>
                <p class="text-xl text-gray-600 dark:text-gray-300">
                    {{ __('welcome.leveraging_best_tools') }}
                </p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-8">
                <div class="text-center">
                    <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-sm mb-2">
                        <span class="text-2xl font-bold text-red-600">Laravel</span>
                    </div>
                    <p class="text-sm text-gray-600 dark:text-gray-300">Laravel 11</p>
                </div>
                <div class="text-center">
                    <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-sm mb-2">
                        <span class="text-2xl font-bold text-blue-600">Tailwind</span>
                    </div>
                    <p class="text-sm text-gray-600 dark:text-gray-300">Tailwind CSS</p>
                </div>
                <div class="text-center">
                    <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-sm mb-2">
                        <span class="text-2xl font-bold text-green-600">Alpine</span>
                    </div>
                    <p class="text-sm text-gray-600 dark:text-gray-300">Alpine.js</p>
                </div>
                <div class="text-center">
                    <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-sm mb-2">
                        <span class="text-2xl font-bold text-purple-600">Vite</span>
                    </div>
                    <p class="text-sm text-gray-600 dark:text-gray-300">Vite</p>
                </div>
                <div class="text-center">
                    <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-sm mb-2">
                        <span class="text-2xl font-bold text-yellow-600">MySQL</span>
                    </div>
                    <p class="text-sm text-gray-600 dark:text-gray-300">Database</p>
                </div>
                <div class="text-center">
                    <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-sm mb-2">
                        <span class="text-2xl font-bold text-indigo-600">Spatie</span>
                    </div>
                    <p class="text-sm text-gray-600 dark:text-gray-300">Packages</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Modules Included -->
    <section class="py-16 bg-white dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-4">
                    {{ __('welcome.complete_feature_set') }}
                </h2>
                <p class="text-xl text-gray-600 dark:text-gray-300">
                    {{ __('welcome.all_modules_needed') }}
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-4">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">🔐 {{ __('welcome.auth_security') }}</h3>
                    <ul class="space-y-2 text-gray-600 dark:text-gray-300">
                        <li>✅ {{ __('welcome.complete_auth_system') }}</li>
                        <li>✅ {{ __('welcome.two_factor_totp') }}</li>
                        <li>✅ {{ __('welcome.recovery_codes') }}</li>
                        <li>✅ {{ __('welcome.email_verification') }}</li>
                        <li>✅ {{ __('welcome.activity_logging') }}</li>
                    </ul>
                </div>

                <div class="space-y-4">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">👥 {{ __('welcome.user_management_section') }}</h3>
                    <ul class="space-y-2 text-gray-600 dark:text-gray-300">
                        <li>✅ {{ __('welcome.advanced_user_crud') }}</li>
                        <li>✅ {{ __('welcome.bulk_operations') }}</li>
                        <li>✅ {{ __('welcome.role_assignment') }}</li>
                        <li>✅ {{ __('welcome.search_filters') }}</li>
                        <li>✅ {{ __('welcome.avatar_upload') }}</li>
                    </ul>
                </div>

                <div class="space-y-4">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">🎨 {{ __('welcome.ui_components') }}</h3>
                    <ul class="space-y-2 text-gray-600 dark:text-gray-300">
                        <li>✅ {{ __('welcome.dark_light_mode') }}</li>
                        <li>✅ {{ __('welcome.theme_presets') }}</li>
                        <li>✅ {{ __('welcome.custom_color_management') }}</li>
                        <li>✅ {{ __('welcome.command_palette_ctrl_k') }}</li>
                        <li>✅ {{ __('welcome.responsive_design') }}</li>
                        <li>✅ {{ __('welcome.custom_blade_components') }}</li>
                        <li>✅ {{ __('welcome.toast_notifications') }}</li>
                    </ul>
                </div>

                <div class="space-y-4">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">📊 {{ __('welcome.analytics_monitoring') }}</h3>
                    <ul class="space-y-2 text-gray-600 dark:text-gray-300">
                        <li>✅ {{ __('welcome.dashboard_analytics') }}</li>
                        <li>✅ {{ __('welcome.kpi_cards') }}</li>
                        <li>✅ {{ __('welcome.charts_graphs') }}</li>
                        <li>✅ {{ __('welcome.user_statistics') }}</li>
                        <li>✅ {{ __('welcome.real_time_data') }}</li>
                    </ul>
                </div>

                <div class="space-y-4">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">⚡ {{ __('welcome.crud_generator_section') }}</h3>
                    <ul class="space-y-2 text-gray-600 dark:text-gray-300">
                        <li>✅ {{ __('welcome.one_command_generation') }}</li>
                        <li>✅ {{ __('welcome.auto_migration_seeding') }}</li>
                        <li>✅ {{ __('welcome.modal_based_interface') }}</li>
                        <li>✅ {{ __('welcome.permission_integration') }}</li>
                        <li>✅ {{ __('welcome.sidebar_auto_update') }}</li>
                    </ul>
                </div>

                <div class="space-y-4">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">🚀 {{ __('welcome.developer_experience') }}</h3>
                    <ul class="space-y-2 text-gray-600 dark:text-gray-300">
                        <li>✅ {{ __('welcome.production_ready') }}</li>
                        <li>✅ {{ __('welcome.clean_architecture') }}</li>
                        <li>✅ {{ __('welcome.best_practices') }}</li>
                        <li>✅ {{ __('welcome.comprehensive_docs') }}</li>
                        <li>✅ {{ __('welcome.easy_deployment') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Folder Structure -->
    <section class="py-16 bg-gray-50 dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-4">
                    {{ __('welcome.well_organized_structure') }}
                </h2>
                <p class="text-xl text-gray-600 dark:text-gray-300">
                    {{ __('welcome.clean_maintainable_scalable') }}
                </p>
            </div>

            <div class="bg-white dark:bg-gray-900 rounded-lg p-6 font-mono text-sm overflow-x-auto border border-gray-200 dark:border-gray-700">
                <pre class="text-gray-800 dark:text-gray-200">
├── app/
│   ├── Http/Controllers/     # {{ __('welcome.business_logic') }}
│   ├── Models/              # {{ __('welcome.eloquent_models') }}
│   └── Listeners/           # {{ __('welcome.event_listeners') }}
├── resources/
│   ├── views/
│   │   ├── components/ui/   # {{ __('welcome.reusable_ui_components') }}
│   │   ├── auth/           # {{ __('welcome.authentication_views') }}
│   │   ├── profile/        # {{ __('welcome.profile_management') }}
│   │   └── users/          # {{ __('welcome.user_management_views') }}
│   └── lang/               # {{ __('welcome.multilingual_files') }}
│       ├── en/             # {{ __('welcome.english_translations') }}
│       ├── fr/             # {{ __('welcome.french_translations') }}
│       ├── es/             # {{ __('welcome.spanish_translations') }}
│       └── ar/             # {{ __('welcome.arabic_translations') }}
├── database/
│   ├── migrations/         # {{ __('welcome.database_schema') }}
│   └── seeders/           # {{ __('welcome.sample_data') }}
└── routes/
    ├── web.php            # {{ __('welcome.web_routes') }}
    └── auth.php           # {{ __('welcome.authentication_routes') }}
                </pre>
            </div>
        </div>
    </section>

    <!-- CRUD Generator Showcase -->
    <section class="py-16 bg-gradient-to-br from-orange-50 to-red-50 dark:from-orange-900/20 dark:to-red-900/20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-4">
                    ⚡ CRUD Generator
                </h2>
                <p class="text-xl text-gray-600 dark:text-gray-300">
                    {{ __('welcome.generate_complete_crud') }}
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">{{ __('welcome.create_full_crud_seconds') }}</h3>
                    <div class="space-y-4 mb-8">
                        <div class="flex items-start space-x-3">
                            <div class="w-6 h-6 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 dark:text-white">{{ __('welcome.complete_crud_operations') }}</h4>
                                <p class="text-gray-600 dark:text-gray-300">{{ __('welcome.crud_modal_interfaces') }}</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="w-6 h-6 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 dark:text-white">{{ __('welcome.auto_database_setup') }}</h4>
                                <p class="text-gray-600 dark:text-gray-300">{{ __('welcome.migration_seeding_automatic') }}</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="w-6 h-6 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 dark:text-white">{{ __('welcome.permission_integration') }}</h4>
                                <p class="text-gray-600 dark:text-gray-300">{{ __('welcome.permission_integration_desc') }}</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="w-6 h-6 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 dark:text-white">{{ __('welcome.sidebar_integration') }}</h4>
                                <p class="text-gray-600 dark:text-gray-300">{{ __('welcome.navigation_auto_updated') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div>
                    <div class="bg-gray-900 rounded-lg p-6 font-mono text-sm overflow-x-auto">
                        <div class="text-green-400 mb-2"># Generate a complete CRUD</div>
                        <div class="text-white mb-4">php artisan create:crud Post</div>
                        
                        <div class="text-gray-400 mb-2"># What gets created:</div>
                        <div class="text-blue-300 mb-1">✓ Migration (posts table)</div>
                        <div class="text-blue-300 mb-1">✓ Model (Post.php)</div>
                        <div class="text-blue-300 mb-1">✓ Controller (PostController.php)</div>
                        <div class="text-blue-300 mb-1">✓ Views (index, create, edit, show)</div>
                        <div class="text-blue-300 mb-1">✓ Request (PostRequest.php)</div>
                        <div class="text-blue-300 mb-1">✓ Routes (protected with permissions)</div>
                        <div class="text-blue-300 mb-1">✓ Permissions (view, create, edit, delete)</div>
                        <div class="text-blue-300 mb-4">✓ Sidebar navigation link</div>
                        
                        <div class="text-green-400 mb-2"># More examples:</div>
                        <div class="text-white mb-1">php artisan create:crud Product</div>
                        <div class="text-white mb-1">php artisan create:crud Category</div>
                        <div class="text-white">php artisan create:crud Customer</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Live Command Demo -->
    <section class="py-16 bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                    {{ __('welcome.try_it_yourself') }}
                </h2>
                <p class="text-xl text-gray-300">
                    {{ __('welcome.see_how_easy_generate') }}
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Command Examples -->
                <div>
                    <h3 class="text-xl font-bold text-white mb-6">{{ __('welcome.generate_commands') }}</h3>
                    <div class="space-y-4">
                        <div class="bg-gray-800 rounded-lg p-4 border border-gray-700">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-green-400 font-mono text-sm">$ php artisan create:crud Post</span>
                                <button onclick="copyCommand('php artisan create:crud Post')" class="text-gray-400 hover:text-white">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                    </svg>
                                </button>
                            </div>
                            <p class="text-white text-sm">{{ __('welcome.blog_post_management') }}</p>
                        </div>
                        
                        <div class="bg-gray-800 rounded-lg p-4 border border-gray-700">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-green-400 font-mono text-sm">$ php artisan create:crud Product</span>
                                <button onclick="copyCommand('php artisan create:crud Product')" class="text-gray-400 hover:text-white">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                    </svg>
                                </button>
                            </div>
                            <p class="text-white text-sm">{{ __('welcome.ecommerce_product_catalog') }}</p>
                        </div>
                        
                        <div class="bg-gray-800 rounded-lg p-4 border border-gray-700">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-green-400 font-mono text-sm">$ php artisan create:crud Customer</span>
                                <button onclick="copyCommand('php artisan create:crud Customer')" class="text-gray-400 hover:text-white">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                    </svg>
                                </button>
                            </div>
                            <p class="text-white text-sm">{{ __('welcome.customer_relationship_management') }}</p>
                        </div>
                        
                        <div class="bg-gray-800 rounded-lg p-4 border border-gray-700">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-green-400 font-mono text-sm">$ php artisan create:crud Order</span>
                                <button onclick="copyCommand('php artisan create:crud Order')" class="text-gray-400 hover:text-white">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                    </svg>
                                </button>
                            </div>
                            <p class="text-white text-sm">{{ __('welcome.order_management_tracking') }}</p>
                        </div>
                    </div>
                </div>
                
                <!-- Live Output -->
                <div>
                    <h3 class="text-xl font-bold text-white mb-6">{{ __('welcome.what_gets_generated') }}</h3>
                    <div class="bg-gray-800 rounded-lg p-6 border border-gray-700 font-mono text-sm">
                        <div class="text-green-400 mb-4">✅ {{ __('welcome.crud_created_successfully') }}</div>
                        <div class="space-y-1 text-white">
                            <div class="flex items-center"><span class="text-blue-400 mr-2">📁</span> Migration: create_posts_table</div>
                            <div class="flex items-center"><span class="text-blue-400 mr-2">📄</span> Model: Post.php</div>
                            <div class="flex items-center"><span class="text-blue-400 mr-2">🎮</span> Controller: PostController.php</div>
                            <div class="flex items-center"><span class="text-blue-400 mr-2">👁️</span> Views: index, create, edit, show</div>
                            <div class="flex items-center"><span class="text-blue-400 mr-2">✅</span> Request: PostRequest.php</div>
                            <div class="flex items-center"><span class="text-blue-400 mr-2">🛣️</span> Routes: /posts (protected)</div>
                            <div class="flex items-center"><span class="text-blue-400 mr-2">🔐</span> Permissions: view, create, edit, delete</div>
                            <div class="flex items-center"><span class="text-blue-400 mr-2">📋</span> Sidebar: Navigation updated</div>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-700">
                            <div class="text-green-400 mb-2">✅ {{ __('welcome.migration_executed') }}</div>
                            <div class="text-green-400">✅ {{ __('welcome.permissions_created') }}</div>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-700 text-white">
                            <div>🚀 {{ __('welcome.ready_to_use_at') }}</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-12 text-center">
                <div class="bg-gradient-to-r from-orange-500 to-red-500 rounded-lg p-6 inline-block">
                    <h4 class="text-white font-bold text-lg mb-2">⚡ {{ __('welcome.one_command_complete_crud') }}</h4>
                    <p class="text-orange-100">{{ __('welcome.migration_model_controller_etc') }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Installation -->
    <section class="py-16 bg-white dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-4">
                    {{ __('welcome.quick_installation') }}
                </h2>
                <p class="text-xl text-gray-600 dark:text-gray-300">
                    {{ __('welcome.get_started_minutes_simple') }}
                </p>
            </div>

            <div class="max-w-4xl mx-auto">
                <div class="bg-gray-900 rounded-lg p-6 font-mono text-sm overflow-x-auto">
                    <div class="text-green-400 mb-4"># {{ __('welcome.clone_repository') }}</div>
                    <div class="text-white mb-4">git clone https://github.com/yossrinjeh/ShadBladeKit.git</div>
                    <div class="text-white mb-4">cd ShadBladeKit</div>
                    
                    <div class="text-green-400 mb-4 mt-6"># {{ __('welcome.install_dependencies') }}</div>
                    <div class="text-white mb-4">composer install</div>
                    <div class="text-white mb-4">npm install</div>
                    
                    <div class="text-green-400 mb-4 mt-6"># {{ __('welcome.setup_environment') }}</div>
                    <div class="text-white mb-4">cp .env.example .env</div>
                    <div class="text-white mb-4">php artisan key:generate</div>
                    
                    <div class="text-green-400 mb-4 mt-6"># {{ __('welcome.run_migrations') }}</div>
                    <div class="text-white mb-4">php artisan migrate --seed</div>
                    
                    <div class="text-green-400 mb-4 mt-6"># {{ __('welcome.start_development') }}</div>
                    <div class="text-white">composer run dev</div>
                </div>

                <div class="mt-8 p-6 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                    <h3 class="text-lg font-semibold text-blue-900 dark:text-blue-100 mb-2">{{ __('welcome.default_credentials') }}</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                        <div>
                            <strong class="text-blue-800 dark:text-blue-200">{{ __('welcome.admin') }}:</strong><br>
                            Email: admin@example.com<br>
                            Password: password
                        </div>
                        <div>
                            <strong class="text-blue-800 dark:text-blue-200">{{ __('welcome.user') }}:</strong><br>
                            Email: user@example.com<br>
                            Password: password
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="py-16 bg-gradient-to-r from-blue-600 to-indigo-600">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                {{ __('welcome.ready_build_amazing') }}
            </h2>
            <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
                {{ __('welcome.skip_boilerplate_start_building') }}
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('register') }}" class="bg-white text-blue-600 px-8 py-3 rounded-lg text-lg font-semibold hover:bg-gray-100 transition">
                    {{ __('welcome.start_building_now') }}
                </a>
                <a href="https://github.com/yossrinjeh/ShadBladeKit" class="border border-white text-white px-8 py-3 rounded-lg text-lg font-semibold hover:bg-white/10 transition">
                    {{ __('welcome.view_on_github') }}
                </a>
            </div>
        </div>
    </section>

    <script>
        function copyCommand(command) {
            navigator.clipboard.writeText(command).then(function() {
                // Show success feedback
                const button = event.target.closest('button');
                const originalHTML = button.innerHTML;
                button.innerHTML = '<svg class="w-4 h-4 text-green-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>';
                setTimeout(() => {
                    button.innerHTML = originalHTML;
                }, 2000);
            }).catch(function(err) {
                console.error('Could not copy text: ', err);
            });
        }
    </script>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center mb-4">
                        @if($appSettings['logo'])
                            <img src="{{ asset('storage/' . $appSettings['logo']) }}" alt="{{ $appSettings['name'] }}" class="h-8 w-8 object-contain">
                        @else
                            <x-application-logo class="h-8 w-8" />
                        @endif
                        <span class="ml-2 text-xl font-bold">{{ $appSettings['name'] }}</span>
                    </div>
                    <p class="text-gray-400 mb-4">Production-ready Laravel starter kit with enterprise features</p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Features</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li>CRUD Generator</li>
                        <li>AI Translation</li>
                        <li>Command Palette</li>
                        <li>Analytics Dashboard</li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Resources</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="https://github.com/yossrinjeh/ShadBladeKit" class="hover:text-white">GitHub Repository</a></li>
                        <li><a href="#" class="hover:text-white">Documentation</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-white">Contact</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} {{ $appSettings['name'] }}. Built with ❤️ for the Laravel community.</p>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button -->
    <button id="scrollToTop" class="fixed bottom-6 right-6 bg-blue-600 text-white p-3 rounded-full shadow-lg hover:bg-blue-700 transition-all duration-300 opacity-0 invisible" onclick="scrollToTop()">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
        </svg>
    </button>

    <script>
        // Show/hide scroll to top button
        window.addEventListener('scroll', function() {
            const scrollToTopBtn = document.getElementById('scrollToTop');
            if (window.pageYOffset > 300) {
                scrollToTopBtn.classList.remove('opacity-0', 'invisible');
                scrollToTopBtn.classList.add('opacity-100', 'visible');
            } else {
                scrollToTopBtn.classList.add('opacity-0', 'invisible');
                scrollToTopBtn.classList.remove('opacity-100', 'visible');
            }
        });

        // Scroll to top function
        function scrollToTop() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    </script>
</x-guest-layout>