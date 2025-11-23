@props(['user' => null])

<div class="flex h-screen bg-background" x-data="{ sidebarOpen: false, isMobile: window.innerWidth < 768 }" @resize.window="isMobile = window.innerWidth < 768">
    <!-- Mobile Backdrop -->
    <div x-show="sidebarOpen && isMobile" 
         x-transition:enter="transition-opacity ease-linear duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="sidebarOpen = false"
         class="fixed inset-0 z-40 bg-black/50 backdrop-blur-sm md:hidden"
         style="display: none;"></div>

    <!-- Sidebar -->
    <div class="fixed inset-y-0 left-0 z-50 w-72 transform transition-transform duration-300 ease-in-out md:relative md:translate-x-0 md:w-64 md:flex md:flex-col"
         :class="{ '-translate-x-full': !sidebarOpen && isMobile, 'translate-x-0': sidebarOpen || !isMobile }">
        <div class="flex flex-col h-full pt-5 overflow-y-auto bg-card/95 backdrop-blur-xl border-r border-border/50 shadow-2xl md:shadow-none">
            <!-- Logo -->
            <div class="flex items-center justify-between flex-shrink-0 px-4 mb-2">
                <div class="flex items-center">
                    @if($appSettings['logo'])
                        <img src="{{ asset('storage/' . $appSettings['logo']) }}" alt="{{ $appSettings['name'] }}" class="h-8 w-8 object-contain">
                    @else
                        <x-application-logo class="h-8 w-8" />
                    @endif
                    <span class="ml-3 text-xl font-bold text-foreground">{{ $appSettings['name'] }}</span>
                </div>
                <!-- Mobile Close Button -->
                <button @click="sidebarOpen = false" class="md:hidden p-2 rounded-lg hover:bg-accent/50 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- Navigation -->
            <div class="mt-8 flex-grow flex flex-col">
                <nav class="flex-1 px-2 space-y-6">
                    <!-- Main Section -->
                    <div class="space-y-1">
                        <a href="{{ route('dashboard') }}" 
                           @click="isMobile && (sidebarOpen = false)"
                           class="group flex items-center px-3 py-2 text-sm font-medium rounded-md transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-primary text-white' : 'text-muted-foreground hover:bg-accent/70 hover:text-accent-foreground hover:translate-x-1' }}">
                            <div class="flex items-center justify-center w-5 h-5 rounded {{ request()->routeIs('dashboard') ? 'bg-white/20' : 'bg-accent/30 group-hover:bg-accent/50' }} transition-colors mr-2">
                                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z" />
                                </svg>
                            </div>
                            {{ __('navigation.dashboard') }}
                        </a>
                    </div>

                    @if(auth()->user()->hasRole('admin'))
                    <!-- User Management -->
                    <div class="space-y-1" x-data="{ open: {{ request()->routeIs('users.*', 'roles.*') ? 'true' : 'false' }} }">
                        <button @click="open = !open" class="w-full flex items-center justify-between px-2 py-2 text-sm font-medium rounded-md text-muted-foreground hover:bg-accent hover:text-accent-foreground">
                            <div class="flex items-center">
                                <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                                </svg>
                                <span>{{ __('navigation.user_management') }}</span>
                            </div>
                            <svg class="h-4 w-4 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        
                        <div x-show="open" x-transition class="ml-6 space-y-1">
                            @can('view users')
                            <a href="{{ route('users.index') }}" 
                               @click="isMobile && (sidebarOpen = false)"
                               class="group flex items-center px-3 py-2 text-sm font-medium rounded-md transition-all duration-200 {{ request()->routeIs('users.*') ? 'bg-primary text-white' : 'text-muted-foreground hover:bg-accent/70 hover:text-accent-foreground hover:translate-x-1' }}">
                                <div class="flex items-center justify-center w-5 h-5 rounded {{ request()->routeIs('users.*') ? 'bg-white/20' : 'bg-accent/30 group-hover:bg-accent/50' }} transition-colors mr-2">
                                    <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                                    </svg>
                                </div>
                                {{ __('navigation.users') }}
                            </a>
                            @endcan
                            
                            <a href="{{ route('roles.index') }}" 
                               @click="isMobile && (sidebarOpen = false)"
                               class="group flex items-center px-3 py-2 text-sm font-medium rounded-md transition-all duration-200 {{ request()->routeIs('roles.*') ? 'bg-primary text-white' : 'text-muted-foreground hover:bg-accent/70 hover:text-accent-foreground hover:translate-x-1' }}">
                                <div class="flex items-center justify-center w-5 h-5 rounded {{ request()->routeIs('roles.*') ? 'bg-white/20' : 'bg-accent/30 group-hover:bg-accent/50' }} transition-colors mr-2">
                                    <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                </div>
                                {{ __('navigation.roles_permissions') }}
                            </a>
                        </div>
                    </div>

                    <!-- Content Management -->
                    <div class="space-y-1">
                        <div class="px-2 py-1">
                            <h3 class="text-xs font-semibold text-muted-foreground uppercase tracking-wider">{{ __('navigation.content') }}</h3>
                        </div>
                        
                        
                        
                        {{-- Add more navigation items here --}}
                    </div>
                    @else
                    <!-- Regular User Section -->
                    @can('view users')
                    <div class="space-y-1">
                        <a href="{{ route('users.index') }}" 
                           @click="isMobile && (sidebarOpen = false)"
                           class="group flex items-center px-3 py-2 text-sm font-medium rounded-md transition-all duration-200 {{ request()->routeIs('users.*') ? 'bg-primary text-white' : 'text-muted-foreground hover:bg-accent/70 hover:text-accent-foreground hover:translate-x-1' }}">
                            <div class="flex items-center justify-center w-5 h-5 rounded {{ request()->routeIs('users.*') ? 'bg-white/20' : 'bg-accent/30 group-hover:bg-accent/50' }} transition-colors mr-2">
                                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                                </svg>
                            </div>
                            {{ __('navigation.users') }}
                        </a>
                    </div>
                    @endcan
                    @endif

                    <!-- Personal Section -->
                    <div class="space-y-1">
                        <div class="px-2 py-1">
                            <h3 class="text-xs font-semibold text-muted-foreground uppercase tracking-wider">{{ __('navigation.personal') }}</h3>
                        </div>
                        
                        <a href="{{ route('notifications.index') }}" 
                           @click="isMobile && (sidebarOpen = false)"
                           class="group flex items-center px-3 py-2 text-sm font-medium rounded-md transition-all duration-200 {{ request()->routeIs('notifications.*') ? 'bg-primary text-white' : 'text-muted-foreground hover:bg-accent/70 hover:text-accent-foreground hover:translate-x-1' }}">
                            <div class="flex items-center justify-center w-5 h-5 rounded {{ request()->routeIs('notifications.*') ? 'bg-white/20' : 'bg-accent/30 group-hover:bg-accent/50' }} transition-colors mr-2">
                                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                                </svg>
                            </div>
                            <span class="flex-1">{{ __('navigation.notifications') }}</span>
                            @if(auth()->user()->unreadNotifications->count() > 0)
                                <span class="inline-flex items-center justify-center w-5 h-5 text-xs font-bold text-white bg-red-500 rounded-full animate-pulse">
                                    {{ auth()->user()->unreadNotifications->count() > 9 ? '9+' : auth()->user()->unreadNotifications->count() }}
                                </span>
                            @endif
                        </a>
                        
                        <a href="{{ route('profile.edit') }}" 
                           @click="isMobile && (sidebarOpen = false)"
                           class="group flex items-center px-3 py-2 text-sm font-medium rounded-md transition-all duration-200 {{ request()->routeIs('profile.*') ? 'bg-primary text-white' : 'text-muted-foreground hover:bg-accent/70 hover:text-accent-foreground hover:translate-x-1' }}">
                            <div class="flex items-center justify-center w-5 h-5 rounded {{ request()->routeIs('profile.*') ? 'bg-white/20' : 'bg-accent/30 group-hover:bg-accent/50' }} transition-colors mr-2">
                                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            {{ __('navigation.profile') }}
                        </a>
                        
                        <a href="{{ route('settings.index') }}" 
                           @click="isMobile && (sidebarOpen = false)"
                           class="group flex items-center px-3 py-2 text-sm font-medium rounded-md transition-all duration-200 {{ request()->routeIs('settings.*') ? 'bg-primary text-white' : 'text-muted-foreground hover:bg-accent/70 hover:text-accent-foreground hover:translate-x-1' }}">
                            <div class="flex items-center justify-center w-5 h-5 rounded {{ request()->routeIs('settings.*') ? 'bg-white/20' : 'bg-accent/30 group-hover:bg-accent/50' }} transition-colors mr-2">
                                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            {{ __('navigation.settings') }}
                        </a>
                    </div>
                    
                    @if(auth()->user()->hasRole('admin'))
                    <!-- System Administration -->
                    <div class="space-y-1" x-data="{ open: {{ request()->routeIs('admin.*', 'theme-presets.*') ? 'true' : 'false' }} }">
                        <button @click="open = !open" class="w-full flex items-center justify-between px-2 py-2 text-sm font-medium rounded-md text-muted-foreground hover:bg-accent hover:text-accent-foreground">
                            <div class="flex items-center">
                                <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span>{{ __('navigation.administration') }}</span>
                            </div>
                            <svg class="h-4 w-4 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        
                        <div x-show="open" x-transition class="ml-6 space-y-1">
                            <a href="{{ route('admin.settings') }}" 
                               @click="isMobile && (sidebarOpen = false)"
                               class="group flex items-center px-3 py-2 text-sm font-medium rounded-md transition-all duration-200 {{ request()->routeIs('admin.settings*') ? 'bg-primary text-white' : 'text-muted-foreground hover:bg-accent/70 hover:text-accent-foreground hover:translate-x-1' }}">
                                <div class="flex items-center justify-center w-5 h-5 rounded {{ request()->routeIs('admin.settings*') ? 'bg-white/20' : 'bg-accent/30 group-hover:bg-accent/50' }} transition-colors mr-2">
                                    <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4" />
                                    </svg>
                                </div>
                                {{ __('navigation.app_settings') }}
                            </a>
                            
                            <a href="{{ route('translations.index') }}" 
                               @click="isMobile && (sidebarOpen = false)"
                               class="group flex items-center px-3 py-2 text-sm font-medium rounded-md transition-all duration-200 {{ request()->routeIs('translations.*') ? 'bg-primary text-white' : 'text-muted-foreground hover:bg-accent/70 hover:text-accent-foreground hover:translate-x-1' }}">
                                <div class="flex items-center justify-center w-5 h-5 rounded {{ request()->routeIs('translations.*') ? 'bg-white/20' : 'bg-accent/30 group-hover:bg-accent/50' }} transition-colors mr-2">
                                    <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129" />
                                    </svg>
                                </div>
                                {{ __('navigation.translations') }}
                            </a>
                            
                            <a href="{{ route('theme-presets.index') }}" 
                               @click="isMobile && (sidebarOpen = false)"
                               class="group flex items-center px-3 py-2 text-sm font-medium rounded-md transition-all duration-200 {{ request()->routeIs('theme-presets.*') ? 'bg-primary text-white' : 'text-muted-foreground hover:bg-accent/70 hover:text-accent-foreground hover:translate-x-1' }}">
                                <div class="flex items-center justify-center w-5 h-5 rounded {{ request()->routeIs('theme-presets.*') ? 'bg-white/20' : 'bg-accent/30 group-hover:bg-accent/50' }} transition-colors mr-2">
                                    <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zM21 5a2 2 0 00-2-2h-4a2 2 0 00-2 2v12a4 4 0 004 4 4 4 0 004-4V5z" />
                                    </svg>
                                </div>
                                {{ __('navigation.theme_presets') }}
                            </a>
                        </div>
                    </div>
                    
                    <div class="space-y-1">
                        <a href="{{ route('activity-logs.index') }}" 
                           @click="isMobile && (sidebarOpen = false)"
                           class="group flex items-center px-3 py-2 text-sm font-medium rounded-md transition-all duration-200 {{ request()->routeIs('activity-logs.*') ? 'bg-primary text-white' : 'text-muted-foreground hover:bg-accent/70 hover:text-accent-foreground hover:translate-x-1' }}">
                            <div class="flex items-center justify-center w-5 h-5 rounded {{ request()->routeIs('activity-logs.*') ? 'bg-white/20' : 'bg-accent/30 group-hover:bg-accent/50' }} transition-colors mr-2">
                                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                                </svg>
                            </div>
                            {{ __('navigation.activity_logs') }}
                        </a>
                        
                        <a href="{{ route('components.index') }}" 
                           @click="isMobile && (sidebarOpen = false)"
                           class="group flex items-center px-3 py-2 text-sm font-medium rounded-md transition-all duration-200 {{ request()->routeIs('components.*') ? 'bg-primary text-white' : 'text-muted-foreground hover:bg-accent/70 hover:text-accent-foreground hover:translate-x-1' }}">
                            <div class="flex items-center justify-center w-5 h-5 rounded {{ request()->routeIs('components.*') ? 'bg-white/20' : 'bg-accent/30 group-hover:bg-accent/50' }} transition-colors mr-2">
                                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                            </div>
                            {{ __('navigation.components') }}
                        </a>
                    </div>
                    @endif
                </nav>
            </div>

            <!-- User Profile -->
            @auth
            <div class="flex-shrink-0 flex border-t p-4">
                <div class="flex items-center w-full">
                    <div class="flex-shrink-0">
                        @if(Auth::user()->avatar)
                            <img class="h-8 w-8 rounded-full object-cover" src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}">
                        @else
                            <div class="h-8 w-8 rounded-full bg-primary flex items-center justify-center">
                                <span class="text-sm font-medium text-primary-foreground">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </span>
                            </div>
                        @endif
                    </div>
                    <div class="ml-3 flex-1">
                        <p class="text-sm font-medium">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-muted-foreground">{{ Auth::user()->email }}</p>
                    </div>
                    <div class="relative" x-data="{ open: false }" @click.outside="open = false">
                        <div @click="open = ! open">
                            <button class="flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                </svg>
                            </button>
                        </div>
                        <div x-show="open" x-transition class="absolute bottom-full right-0 mb-2 w-48 rounded-md shadow-lg  dark:bg-gray-800 ring-1 ring-black ring-opacity-5 z-50" style="display: none;">
                            <div class="py-1">
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    {{ __('navigation.profile') }}
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                        {{ __('ui.logout') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            @endauth
        </div>
    </div>

    <!-- Main content -->
    <div class="flex flex-col flex-1 overflow-hidden">
        <!-- Top bar -->
        <header class="sticky top-0 z-30 bg-background/80 backdrop-blur-xl border-b border-border/50 px-4 py-3 flex items-center justify-between shadow-sm">
            <div class="flex items-center space-x-3">
                <!-- Mobile menu button -->
                <button @click="sidebarOpen = !sidebarOpen" 
                        class="md:hidden p-2.5 rounded-xl text-muted-foreground hover:bg-accent/70 hover:text-accent-foreground transition-all duration-200 hover:scale-105 active:scale-95">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                
                <!-- Mobile Logo -->
                <div class="md:hidden flex items-center">
                    @if($appSettings['logo'])
                        <img src="{{ asset('storage/' . $appSettings['logo']) }}" alt="{{ $appSettings['name'] }}" class="h-7 w-7 object-contain">
                    @else
                        <x-application-logo class="h-7 w-7" />
                    @endif
                    <span class="ml-2 text-lg font-bold text-foreground">{{ $appSettings['name'] }}</span>
                </div>
            </div>
            
            <div class="flex items-center space-x-2 sm:space-x-4">
                <!-- Command Palette Trigger -->
                <button 
                    @click="$dispatch('toggle-command-palette')"
                    class="flex items-center space-x-2 px-2 sm:px-3 py-1.5 text-sm text-muted-foreground hover:text-foreground hover:bg-accent/70 rounded-lg transition-all duration-200 hover:scale-105"
                    title="{{ __('navigation.open_command_palette') }}"
                >
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v14a2 2 0 002 2z" />
                    </svg>
                    <span class="hidden lg:inline">{{ __('navigation.press') }}</span>
                    <kbd class="hidden lg:inline-flex items-center rounded border bg-muted px-1.5 py-0.5 text-xs font-mono">Ctrl+K</kbd>
                </button>
                
                <!-- Notifications -->
                @auth
                <x-dropdown align="right" width="w-80">
                    <x-slot name="trigger">
                        <button class="relative p-2.5 rounded-xl text-muted-foreground hover:bg-accent/70 hover:text-accent-foreground transition-all duration-200 hover:scale-105">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                            </svg>
                            @if(auth()->user()->unreadNotifications->count() > 0)
                                <span class="absolute -top-1 -right-1 h-5 w-5 bg-gradient-to-r from-red-500 to-red-600 text-white text-xs rounded-full flex items-center justify-center animate-pulse shadow-lg">
                                    {{ auth()->user()->unreadNotifications->count() > 9 ? '9+' : auth()->user()->unreadNotifications->count() }}
                                </span>
                            @endif
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <div class="min-w-80 max-h-96 overflow-y-auto">
                            <!-- Header -->
                            <div class="sticky top-0 bg-card border-b px-4 py-3 flex items-center justify-between min-w-0">
                                <div class="flex items-center space-x-2 flex-shrink-0">
                                    <div class="w-2 h-2 bg-primary rounded-full"></div>
                                    <h3 class="text-sm font-semibold whitespace-nowrap">{{ __('navigation.notifications') }}</h3>
                                </div>
                                <a href="{{ route('notifications.index') }}" class="text-xs font-medium text-primary hover:text-primary/80 px-2 py-1 rounded hover:bg-primary/10 transition-colors whitespace-nowrap flex-shrink-0">
                                    {{ __('navigation.view_all') }}
                                </a>
                            </div>
                            
                            <!-- Notifications List -->
                            <div class="p-2">
                                @forelse(auth()->user()->notifications->take(5) as $notification)
                                    <a href="{{ route('notifications.index') }}" class="group block p-3 hover:bg-accent/50 rounded-lg mb-1 border border-transparent hover:border-border/50 transition-all duration-200 {{ $notification->read_at ? 'opacity-70' : 'bg-primary/5' }}">
                                        <div class="flex items-start space-x-3">
                                            <!-- Icon -->
                                            <div class="flex-shrink-0 mt-0.5">
                                                <div class="w-8 h-8 rounded-full {{ $notification->read_at ? 'bg-muted' : 'bg-primary/20' }} flex items-center justify-center">
                                                    <svg class="w-4 h-4 {{ $notification->read_at ? 'text-muted-foreground' : 'text-primary' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                    </svg>
                                                </div>
                                            </div>
                                            
                                            <!-- Content -->
                                            <div class="flex-1 min-w-0">
                                                <div class="flex items-center justify-between mb-1">
                                                    <p class="text-sm font-medium text-card-foreground group-hover:text-primary transition-colors truncate">
                                                        {{ $notification->data['title'] ?? 'Notification' }}
                                                    </p>
                                                    @if(!$notification->read_at)
                                                        <div class="w-2 h-2 bg-primary rounded-full flex-shrink-0 ml-2"></div>
                                                    @endif
                                                </div>
                                                <p class="text-xs text-muted-foreground line-clamp-2 mb-2">
                                                    {{ $notification->data['message'] ?? '' }}
                                                </p>
                                                <div class="flex items-center justify-between">
                                                    <span class="text-xs text-muted-foreground">
                                                        {{ $notification->created_at->diffForHumans() }}
                                                    </span>
                                                    <svg class="w-3 h-3 text-muted-foreground group-hover:text-primary transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @empty
                                    <div class="text-center py-8">
                                        <div class="w-12 h-12 mx-auto mb-3 rounded-full bg-muted flex items-center justify-center">
                                            <svg class="w-6 h-6 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                            </svg>
                                        </div>
                                        <p class="text-sm text-muted-foreground">{{ __('navigation.no_notifications_yet') }}</p>
                                        <p class="text-xs text-muted-foreground mt-1">{{ __('navigation.notify_when_happens') }}</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </x-slot>
                </x-dropdown>
                @endauth
                
                <div class="hidden sm:flex items-center space-x-2">
                    <x-ui.theme-toggle />
                    <x-ui.lang-switcher />
                </div>
                
                <!-- Mobile Actions Menu -->
                <div class="sm:hidden" x-data="{ open: false }" @click.outside="open = false">
                    <button @click="open = !open" class="p-2.5 rounded-xl text-muted-foreground hover:bg-accent/70 hover:text-accent-foreground transition-all duration-200">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                        </svg>
                    </button>
                    <div x-show="open" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="absolute right-4 top-16 w-48 bg-card/95 backdrop-blur-xl rounded-xl shadow-2xl border border-border/50 py-2 z-50"
                         style="display: none;">
                        <div class="px-3 py-2 border-b border-border/50">
                            <p class="text-xs font-medium text-muted-foreground uppercase tracking-wider">{{ __('ui.settings') }}</p>
                        </div>
                        <div class="p-2 space-y-1">
                            <div class="flex items-center justify-between px-3 py-2">
                                <span class="text-sm font-medium">{{ __('navigation.theme') }}</span>
                                <x-ui.theme-toggle />
                            </div>
                            <div class="flex items-center justify-between px-3 py-2">
                                <span class="text-sm font-medium">{{ __('navigation.language') }}</span>
                                <x-ui.lang-switcher />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Page content -->
        <main class="flex-1 overflow-y-auto p-4 sm:p-6">
            <div class="max-w-7xl mx-auto">
                {{ $slot }}
            </div>
        </main>
    </div>
    
    <!-- Command Palette -->
    <div x-data="{ open: false }" @toggle-command-palette.window="open = !open">
        <x-ui.command-palette x-show="open" @close="open = false" />
    </div>
    
    <!-- Mobile Bottom Navigation -->
    @auth
        <x-ui.mobile-nav />
    @endauth
    
    <!-- Toast Notifications -->
    <x-ui.toast-container />
</div>