<x-guest-layout>
    <x-slot name="title">{{ $appSettings['name'] }} - {{ __('welcome.title') }}</x-slot>

    <!-- Navigation -->
    <nav class="fixed top-0 w-full bg-white/80 dark:bg-gray-900/80 backdrop-blur-md border-b border-gray-200 dark:border-gray-700 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    @if($appSettings['logo'])
                        <img src="{{ asset('storage/' . $appSettings['logo']) }}" alt="{{ $appSettings['name'] }}" class="h-8 w-8 object-contain">
                    @else
                        <x-application-logo class="h-8 w-8" />
                    @endif
                    <span class="ml-2 text-xl font-bold">{{ $appSettings['name'] }}</span>
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
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="pt-24 pb-16 bg-gradient-to-br from-blue-50 to-indigo-100 dark:from-gray-900 dark:to-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl md:text-6xl font-bold text-gray-900 dark:text-white mb-6">
                    {{ $appSettings['name'] }}
                    <span class="text-blue-600">{{ __('welcome.starter_kit') }}</span>
                </h1>
                <p class="text-xl text-gray-600 dark:text-gray-300 mb-8 max-w-3xl mx-auto">
                    {{ __('welcome.hero_description', ['app' => $appSettings['name']]) }}
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('register') }}" class="bg-blue-600 text-white px-8 py-3 rounded-lg text-lg font-semibold hover:bg-blue-700 transition">
                        {{ __('welcome.get_started_free') }}
                    </a>
                    <a href="#features" class="border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 px-8 py-3 rounded-lg text-lg font-semibold hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                        {{ __('welcome.view_features') }}
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Key Features -->
    <section id="features" class="py-16 bg-white dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-4">
                    {{ __('welcome.everything_you_need') }}
                </h2>
                <p class="text-xl text-gray-600 dark:text-gray-300">
                    {{ __('welcome.enterprise_features') }}
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Authentication & Security -->
                <div class="bg-gray-50 dark:bg-gray-800 p-6 rounded-xl">
                    <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">{{ __('welcome.enterprise_security') }}</h3>
                    <p class="text-gray-600 dark:text-gray-300">{{ __('welcome.enterprise_security_desc') }}</p>
                </div>

                <!-- User Management -->
                <div class="bg-gray-50 dark:bg-gray-800 p-6 rounded-xl">
                    <div class="w-12 h-12 bg-green-100 dark:bg-green-900 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">{{ __('welcome.user_management') }}</h3>
                    <p class="text-gray-600 dark:text-gray-300">{{ __('welcome.user_management_desc') }}</p>
                </div>

                <!-- Modern UI/UX -->
                <div class="bg-gray-50 dark:bg-gray-800 p-6 rounded-xl">
                    <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h4" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">{{ __('welcome.modern_ui') }}</h3>
                    <p class="text-gray-600 dark:text-gray-300">{{ __('welcome.modern_ui_desc') }}</p>
                </div>

                <!-- Internationalization -->
                <div class="bg-gray-50 dark:bg-gray-800 p-6 rounded-xl">
                    <div class="w-12 h-12 bg-yellow-100 dark:bg-yellow-900 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">{{ __('welcome.multilingual_ready') }}</h3>
                    <p class="text-gray-600 dark:text-gray-300">{{ __('welcome.multilingual_desc') }}</p>
                </div>

                <!-- Analytics -->
                <div class="bg-gray-50 dark:bg-gray-800 p-6 rounded-xl">
                    <div class="w-12 h-12 bg-red-100 dark:bg-red-900 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">{{ __('welcome.analytics_dashboard') }}</h3>
                    <p class="text-gray-600 dark:text-gray-300">{{ __('welcome.analytics_desc') }}</p>
                </div>

                <!-- Theme Management -->
                <div class="bg-gray-50 dark:bg-gray-800 p-6 rounded-xl">
                    <div class="w-12 h-12 bg-pink-100 dark:bg-pink-900 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zM21 5a2 2 0 00-2-2h-4a2 2 0 00-2 2v12a4 4 0 004 4 4 4 0 004-4V5z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">{{ __('welcome.theme_system') }}</h3>
                    <p class="text-gray-600 dark:text-gray-300">{{ __('welcome.theme_system_desc') }}</p>
                </div>

                <!-- Command Palette -->
                <div class="bg-gray-50 dark:bg-gray-800 p-6 rounded-xl">
                    <div class="w-12 h-12 bg-cyan-100 dark:bg-cyan-900 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">{{ __('welcome.command_palette') }}</h3>
                    <p class="text-gray-600 dark:text-gray-300">{{ __('welcome.command_palette_desc') }}</p>
                </div>

                <!-- CRUD Generator -->
                <div class="bg-gray-50 dark:bg-gray-800 p-6 rounded-xl">
                    <div class="w-12 h-12 bg-orange-100 dark:bg-orange-900 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">{{ __('ui.crud_generator') }}</h3>
                    <p class="text-gray-600 dark:text-gray-300">{{ __('welcome.crud_generator_desc') }}</p>
                </div>

                <!-- Production Ready -->
                <div class="bg-gray-50 dark:bg-gray-800 p-6 rounded-xl">
                    <div class="w-12 h-12 bg-indigo-100 dark:bg-indigo-900 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">{{ __('welcome.production_ready') }}</h3>
                    <p class="text-gray-600 dark:text-gray-300">{{ __('welcome.production_desc') }}</p>
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
                    <p class="text-gray-400 mb-4">
                        {{ __('welcome.production_ready_with_features', ['app' => $appSettings['name']]) }}
                    </p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">{{ __('welcome.features') }}</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li>{{ __('welcome.authentication') }}</li>
                        <li>{{ __('welcome.user_management') }}</li>
                        <li>{{ __('welcome.analytics') }}</li>
                        <li>{{ __('welcome.multilingual') }}</li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">{{ __('welcome.resources') }}</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white">{{ __('welcome.documentation') }}</a></li>
                        <li><a href="https://github.com/yossrinjeh/ShadBladeKit" class="hover:text-white">{{ __('welcome.github') }}</a></li>
                        <li><a href="#" class="hover:text-white">{{ __('welcome.support') }}</a></li>
                        <li><a href="#" class="hover:text-white">{{ __('welcome.license') }}</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} {{ $appSettings['name'] }}. {{ __('welcome.made_with_love_by') }}</p>
            </div>
        </div>
    </footer>
</x-guest-layout>