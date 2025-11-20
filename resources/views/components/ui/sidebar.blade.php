@props(['user' => null])

<div class="flex h-screen bg-background">
    <!-- Sidebar -->
    <div class="hidden md:flex md:w-64 md:flex-col">
        <div class="flex flex-col flex-grow pt-5 overflow-y-auto bg-card border-r">
            <!-- Logo -->
            <div class="flex items-center flex-shrink-0 px-4">
                @if($appSettings['logo'])
                    <img src="{{ asset('storage/' . $appSettings['logo']) }}" alt="{{ $appSettings['name'] }}" class="h-8 w-8 object-contain">
                @else
                    <x-application-logo class="h-8 w-8" />
                @endif
                <span class="ml-2 text-xl font-bold">{{ $appSettings['name'] }}</span>
            </div>

            <!-- Navigation -->
            <div class="mt-8 flex-grow flex flex-col">
                <nav class="flex-1 px-2 space-y-6">
                    <!-- Main Section -->
                    <div class="space-y-1">
                        <a href="{{ route('dashboard') }}" class="group flex items-center px-2 py-2 text-sm font-medium rounded-md {{ request()->routeIs('dashboard') ? 'bg-primary text-primary-foreground' : 'text-muted-foreground hover:bg-accent hover:text-accent-foreground' }}">
                            <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z" />
                            </svg>
                            {{ __('navigation.dashboard') }}
                        </a>
                    </div>

                    @if(auth()->user()->hasRole('admin'))
                    <!-- User Management -->
                    <div class="space-y-1">
                        <div class="px-2 py-1">
                            <h3 class="text-xs font-semibold text-muted-foreground uppercase tracking-wider">User Management</h3>
                        </div>
                        @can('view users')
                        <a href="{{ route('users.index') }}" class="group flex items-center px-2 py-2 text-sm font-medium rounded-md {{ request()->routeIs('users.*') ? 'bg-primary text-primary-foreground' : 'text-muted-foreground hover:bg-accent hover:text-accent-foreground' }}">
                            <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                            </svg>
                            {{ __('navigation.users') }}
                        </a>
                        @endcan
                        
                        <a href="{{ route('roles.index') }}" class="group flex items-center px-2 py-2 text-sm font-medium rounded-md {{ request()->routeIs('roles.*') ? 'bg-primary text-primary-foreground' : 'text-muted-foreground hover:bg-accent hover:text-accent-foreground' }}">
                            <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                            {{ __('navigation.roles_permissions') }}
                        </a>
                    </div>

                    <!-- System Administration -->
                    <div class="space-y-1">
                        <div class="px-2 py-1">
                            <h3 class="text-xs font-semibold text-muted-foreground uppercase tracking-wider">Administration</h3>
                        </div>
                        
                        <a href="{{ route('admin.settings') }}" class="group flex items-center px-2 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.settings*') ? 'bg-primary text-primary-foreground' : 'text-muted-foreground hover:bg-accent hover:text-accent-foreground' }}">
                            <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4" />
                            </svg>
                            App Settings
                        </a>
                        
                        <a href="{{ route('activity-logs.index') }}" class="group flex items-center px-2 py-2 text-sm font-medium rounded-md {{ request()->routeIs('activity-logs.*') ? 'bg-primary text-primary-foreground' : 'text-muted-foreground hover:bg-accent hover:text-accent-foreground' }}">
                            <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                            </svg>
                            {{ __('navigation.activity_logs') }}
                        </a>
                        
                        <a href="{{ route('components.index') }}" class="group flex items-center px-2 py-2 text-sm font-medium rounded-md {{ request()->routeIs('components.*') ? 'bg-primary text-primary-foreground' : 'text-muted-foreground hover:bg-accent hover:text-accent-foreground' }}">
                            <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                            {{ __('navigation.components') }}
                        </a>
                    </div>
                    
                    <!-- Content Management -->
                    <div class="space-y-1">
                        <div class="px-2 py-1">
                            <h3 class="text-xs font-semibold text-muted-foreground uppercase tracking-wider">Content</h3>
                        </div>
                        
                        
                        
                        {{-- Add more navigation items here --}}
                    </div>
                    @else
                    <!-- Regular User Section -->
                    @can('view users')
                    <div class="space-y-1">
                        <a href="{{ route('users.index') }}" class="group flex items-center px-2 py-2 text-sm font-medium rounded-md {{ request()->routeIs('users.*') ? 'bg-primary text-primary-foreground' : 'text-muted-foreground hover:bg-accent hover:text-accent-foreground' }}">
                            <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                            </svg>
                            {{ __('navigation.users') }}
                        </a>
                    </div>
                    @endcan
                    @endif

                    <!-- Personal Section -->
                    <div class="space-y-1">
                        <div class="px-2 py-1">
                            <h3 class="text-xs font-semibold text-muted-foreground uppercase tracking-wider">Personal</h3>
                        </div>
                        
                        <a href="{{ route('notifications.index') }}" class="group flex items-center px-2 py-2 text-sm font-medium rounded-md {{ request()->routeIs('notifications.*') ? 'bg-primary text-primary-foreground' : 'text-muted-foreground hover:bg-accent hover:text-accent-foreground' }}">
                            <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                            </svg>
                            {{ __('Notifications') }}
                            @if(auth()->user()->unreadNotifications->count() > 0)
                                <span class="ml-auto inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-red-600 rounded-full">
                                    {{ auth()->user()->unreadNotifications->count() }}
                                </span>
                            @endif
                        </a>
                        
                        <a href="{{ route('profile.edit') }}" class="group flex items-center px-2 py-2 text-sm font-medium rounded-md {{ request()->routeIs('profile.*') ? 'bg-primary text-primary-foreground' : 'text-muted-foreground hover:bg-accent hover:text-accent-foreground' }}">
                            <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            {{ __('navigation.profile') }}
                        </a>
                        
                        <a href="{{ route('settings.index') }}" class="group flex items-center px-2 py-2 text-sm font-medium rounded-md {{ request()->routeIs('settings.*') ? 'bg-primary text-primary-foreground' : 'text-muted-foreground hover:bg-accent hover:text-accent-foreground' }}">
                            <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            {{ __('navigation.settings') }}
                        </a>
                    </div>
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
                        <div x-show="open" x-transition class="absolute bottom-full right-0 mb-2 w-48 rounded-md shadow-lg bg-white dark:bg-gray-800 ring-1 ring-black ring-opacity-5 z-50" style="display: none;">
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
        <header class="bg-background border-b px-4 py-3 flex items-center justify-between">
            <div class="flex items-center">
                <!-- Mobile menu button -->
                <button class="md:hidden p-2 rounded-md text-muted-foreground hover:bg-accent">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
            
            <div class="flex items-center space-x-4">
                <!-- Notifications -->
                @auth
                <x-dropdown align="right" width="w-80">
                    <x-slot name="trigger">
                        <button class="relative p-2 rounded-md text-muted-foreground hover:bg-accent">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                            </svg>
                            @if(auth()->user()->unreadNotifications->count() > 0)
                                <span class="absolute -top-1 -right-1 h-4 w-4 bg-red-500 text-white text-xs rounded-full flex items-center justify-center">
                                    {{ auth()->user()->unreadNotifications->count() }}
                                </span>
                            @endif
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <div class="p-4 min-w-80">
                            <div class="flex items-center justify-between mb-3">
                                <h3 class="text-sm font-medium whitespace-nowrap">{{ __('ui.notifications') }}</h3>
                                <a href="{{ route('notifications.index') }}" class="text-xs text-primary hover:text-primary/80 whitespace-nowrap ml-4">View All</a>
                            </div>
                            @forelse(auth()->user()->notifications->take(5) as $notification)
                                <a href="{{ route('notifications.index') }}" class="block p-3 hover:bg-accent rounded-md mb-2 {{ $notification->read_at ? 'opacity-60' : '' }}">
                                    <p class="text-sm font-medium">{{ $notification->data['title'] ?? 'Notification' }}</p>
                                    <p class="text-xs text-muted-foreground mt-1">{{ $notification->data['message'] ?? '' }}</p>
                                    <p class="text-xs text-muted-foreground mt-1">{{ $notification->created_at->diffForHumans() }}</p>
                                </a>
                            @empty
                                <p class="text-sm text-muted-foreground p-3">No notifications</p>
                            @endforelse
                        </div>
                    </x-slot>
                </x-dropdown>
                @endauth
                
                <x-ui.theme-toggle />
                <x-ui.lang-switcher />
            </div>
        </header>

        <!-- Page content -->
        <main class="flex-1 overflow-y-auto p-6">
            {{ $slot }}
        </main>
    </div>
</div>