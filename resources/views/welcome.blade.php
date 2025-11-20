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

                <!-- CRUD Generator -->
                <div class="bg-gray-50 dark:bg-gray-800 p-6 rounded-xl">
                    <div class="w-12 h-12 bg-orange-100 dark:bg-orange-900 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">CRUD Generator</h3>
                    <p class="text-gray-600 dark:text-gray-300">Generate complete CRUD interfaces with a single command. Includes modals, permissions, and sidebar integration.</p>
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
                    Built with Modern Technologies
                </h2>
                <p class="text-xl text-gray-600 dark:text-gray-300">
                    Leveraging the best tools and frameworks for optimal performance
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
                    Complete Feature Set
                </h2>
                <p class="text-xl text-gray-600 dark:text-gray-300">
                    All the modules you need for a modern web application
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-4">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">🔐 Authentication & Security</h3>
                    <ul class="space-y-2 text-gray-600 dark:text-gray-300">
                        <li>✅ Complete Auth System (Login, Register, Reset)</li>
                        <li>✅ Two-Factor Authentication (TOTP)</li>
                        <li>✅ Recovery Codes</li>
                        <li>✅ Email Verification</li>
                        <li>✅ Activity Logging</li>
                    </ul>
                </div>

                <div class="space-y-4">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">👥 User Management</h3>
                    <ul class="space-y-2 text-gray-600 dark:text-gray-300">
                        <li>✅ Advanced User CRUD</li>
                        <li>✅ Bulk Operations</li>
                        <li>✅ Role Assignment</li>
                        <li>✅ Search & Filters</li>
                        <li>✅ Avatar Upload</li>
                    </ul>
                </div>

                <div class="space-y-4">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">🎨 UI Components</h3>
                    <ul class="space-y-2 text-gray-600 dark:text-gray-300">
                        <li>✅ Dark/Light Mode</li>
                        <li>✅ Responsive Design</li>
                        <li>✅ Custom Blade Components</li>
                        <li>✅ Toast Notifications</li>
                        <li>✅ Data Tables</li>
                    </ul>
                </div>

                <div class="space-y-4">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">📊 Analytics & Monitoring</h3>
                    <ul class="space-y-2 text-gray-600 dark:text-gray-300">
                        <li>✅ Dashboard Analytics</li>
                        <li>✅ KPI Cards</li>
                        <li>✅ Charts & Graphs</li>
                        <li>✅ User Statistics</li>
                        <li>✅ Real-time Data</li>
                    </ul>
                </div>

                <div class="space-y-4">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">⚡ CRUD Generator</h3>
                    <ul class="space-y-2 text-gray-600 dark:text-gray-300">
                        <li>✅ One-Command Generation</li>
                        <li>✅ Auto Migration & Seeding</li>
                        <li>✅ Modal-Based Interface</li>
                        <li>✅ Permission Integration</li>
                        <li>✅ Sidebar Auto-Update</li>
                    </ul>
                </div>

                <div class="space-y-4">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">🚀 Developer Experience</h3>
                    <ul class="space-y-2 text-gray-600 dark:text-gray-300">
                        <li>✅ Production Ready</li>
                        <li>✅ Clean Architecture</li>
                        <li>✅ Best Practices</li>
                        <li>✅ Comprehensive Docs</li>
                        <li>✅ Easy Deployment</li>
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
                    Well-Organized Structure
                </h2>
                <p class="text-xl text-gray-600 dark:text-gray-300">
                    Clean, maintainable, and scalable project organization
                </p>
            </div>

            <div class="bg-white dark:bg-gray-900 rounded-lg p-6 font-mono text-sm overflow-x-auto border border-gray-200 dark:border-gray-700">
                <pre class="text-gray-800 dark:text-gray-200">
├── app/
│   ├── Http/Controllers/     # Business logic
│   ├── Models/              # Eloquent models
│   └── Listeners/           # Event listeners
├── resources/
│   ├── views/
│   │   ├── components/ui/   # Reusable UI components
│   │   ├── auth/           # Authentication views
│   │   ├── profile/        # Profile management
│   │   └── users/          # User management
│   └── lang/               # Multilingual files
│       ├── en/             # English translations
│       ├── fr/             # French translations
│       ├── es/             # Spanish translations
│       └── ar/             # Arabic translations
├── database/
│   ├── migrations/         # Database schema
│   └── seeders/           # Sample data
└── routes/
    ├── web.php            # Web routes
    └── auth.php           # Authentication routes
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
                    Generate complete CRUD interfaces with a single command
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Create Full CRUD in Seconds</h3>
                    <div class="space-y-4 mb-8">
                        <div class="flex items-start space-x-3">
                            <div class="w-6 h-6 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 dark:text-white">Complete CRUD Operations</h4>
                                <p class="text-gray-600 dark:text-gray-300">Create, Read, Update, Delete with modal interfaces</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="w-6 h-6 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 dark:text-white">Auto Database Setup</h4>
                                <p class="text-gray-600 dark:text-gray-300">Migration and seeding handled automatically</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="w-6 h-6 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 dark:text-white">Permission Integration</h4>
                                <p class="text-gray-600 dark:text-gray-300">Role-based access control built-in</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="w-6 h-6 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 dark:text-white">Sidebar Integration</h4>
                                <p class="text-gray-600 dark:text-gray-300">Navigation automatically updated</p>
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
                    Try It Yourself
                </h2>
                <p class="text-xl text-gray-300">
                    See how easy it is to generate complete CRUD interfaces
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Command Examples -->
                <div>
                    <h3 class="text-xl font-bold text-white mb-6">Generate Commands</h3>
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
                            <p class="text-white text-sm">Creates a complete blog post management system</p>
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
                            <p class="text-white text-sm">Perfect for e-commerce product catalog</p>
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
                            <p class="text-white text-sm">Customer relationship management made easy</p>
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
                            <p class="text-white text-sm">Order management with full tracking</p>
                        </div>
                    </div>
                </div>
                
                <!-- Live Output -->
                <div>
                    <h3 class="text-xl font-bold text-white mb-6">What Gets Generated</h3>
                    <div class="bg-gray-800 rounded-lg p-6 border border-gray-700 font-mono text-sm">
                        <div class="text-green-400 mb-4">✅ CRUD for Post created successfully!</div>
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
                            <div class="text-green-400 mb-2">✅ Migration executed</div>
                            <div class="text-green-400">✅ Permissions created</div>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-700 text-white">
                            <div>🚀 Ready to use at: /posts</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-12 text-center">
                <div class="bg-gradient-to-r from-orange-500 to-red-500 rounded-lg p-6 inline-block">
                    <h4 class="text-white font-bold text-lg mb-2">⚡ One Command = Complete CRUD</h4>
                    <p class="text-orange-100">Migration + Model + Controller + Views + Routes + Permissions + Sidebar</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Installation -->
    <section class="py-16 bg-white dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-4">
                    Quick Installation
                </h2>
                <p class="text-xl text-gray-600 dark:text-gray-300">
                    Get started in minutes with our simple setup process
                </p>
            </div>

            <div class="max-w-4xl mx-auto">
                <div class="bg-gray-900 rounded-lg p-6 font-mono text-sm overflow-x-auto">
                    <div class="text-green-400 mb-4"># Clone the repository</div>
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

    <!-- CTA -->
    <section class="py-16 bg-gradient-to-r from-blue-600 to-indigo-600">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                Ready to Build Something Amazing?
            </h2>
            <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
                Skip the boilerplate and start building your next Laravel application with our production-ready starter kit.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('register') }}" class="bg-white text-blue-600 px-8 py-3 rounded-lg text-lg font-semibold hover:bg-gray-100 transition">
                    Start Building Now
                </a>
                <a href="https://github.com/yossrinjeh/ShadBladeKit" class="border border-white text-white px-8 py-3 rounded-lg text-lg font-semibold hover:bg-white/10 transition">
                    View on GitHub
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
                        Production-ready {{ $appSettings['name'] }} with enterprise-grade features and modern UI components.
                    </p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Features</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li>Authentication</li>
                        <li>User Management</li>
                        <li>Analytics</li>
                        <li>Multilingual</li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Resources</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white">Documentation</a></li>
                        <li><a href="#" class="hover:text-white">GitHub</a></li>
                        <li><a href="#" class="hover:text-white">Support</a></li>
                        <li><a href="#" class="hover:text-white">License</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} {{ $appSettings['name'] }}. Made with ❤️ by Yossri Njeh.</p>
            </div>
        </div>
    </footer>
</x-guest-layout>