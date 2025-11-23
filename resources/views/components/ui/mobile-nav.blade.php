@props(['user' => null])

<!-- Mobile Bottom Navigation -->
<div class="md:hidden fixed bottom-0 left-0 right-0 z-50 bg-card/95 backdrop-blur-xl border-t border-border/50 safe-area-bottom">
    <div class="grid grid-cols-5 h-16">
        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}" 
           class="flex flex-col items-center justify-center space-y-1 text-xs font-medium transition-all duration-200 {{ request()->routeIs('dashboard') ? 'text-primary bg-primary/10' : 'text-muted-foreground hover:text-foreground' }}">
            <div class="relative">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"/>
                </svg>
                @if(request()->routeIs('dashboard'))
                    <div class="absolute -top-1 -right-1 w-2 h-2 bg-primary rounded-full animate-pulse"></div>
                @endif
            </div>
            <span class="text-[10px]">{{ __('navigation.dashboard') }}</span>
        </a>

        <!-- Users -->
        @can('view users')
        <a href="{{ route('users.index') }}" 
           class="flex flex-col items-center justify-center space-y-1 text-xs font-medium transition-all duration-200 {{ request()->routeIs('users.*') ? 'text-primary bg-primary/10' : 'text-muted-foreground hover:text-foreground' }}">
            <div class="relative">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                </svg>
                @if(request()->routeIs('users.*'))
                    <div class="absolute -top-1 -right-1 w-2 h-2 bg-primary rounded-full animate-pulse"></div>
                @endif
            </div>
            <span class="text-[10px]">{{ __('navigation.users') }}</span>
        </a>
        @else
        <div class="flex flex-col items-center justify-center opacity-30">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
            </svg>
            <span class="text-[10px]">Locked</span>
        </div>
        @endcan

        <!-- Notifications -->
        <a href="{{ route('notifications.index') }}" 
           class="flex flex-col items-center justify-center space-y-1 text-xs font-medium transition-all duration-200 {{ request()->routeIs('notifications.*') ? 'text-primary bg-primary/10' : 'text-muted-foreground hover:text-foreground' }}">
            <div class="relative">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0"/>
                </svg>
                @if(auth()->user()->unreadNotifications->count() > 0)
                    <div class="absolute -top-1 -right-1 w-4 h-4 bg-red-500 text-white text-[8px] rounded-full flex items-center justify-center animate-pulse">
                        {{ auth()->user()->unreadNotifications->count() > 9 ? '9+' : auth()->user()->unreadNotifications->count() }}
                    </div>
                @endif
                @if(request()->routeIs('notifications.*'))
                    <div class="absolute -top-1 -right-1 w-2 h-2 bg-primary rounded-full animate-pulse"></div>
                @endif
            </div>
            <span class="text-[10px]">Alerts</span>
        </a>

        <!-- Profile -->
        <a href="{{ route('profile.edit') }}" 
           class="flex flex-col items-center justify-center space-y-1 text-xs font-medium transition-all duration-200 {{ request()->routeIs('profile.*') ? 'text-primary bg-primary/10' : 'text-muted-foreground hover:text-foreground' }}">
            <div class="relative">
                @if(Auth::user()->avatar)
                    <img class="w-5 h-5 rounded-full object-cover" src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}">
                @else
                    <div class="w-5 h-5 rounded-full bg-primary/20 flex items-center justify-center">
                        <span class="text-[8px] font-bold text-primary">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </span>
                    </div>
                @endif
                @if(request()->routeIs('profile.*'))
                    <div class="absolute -top-1 -right-1 w-2 h-2 bg-primary rounded-full animate-pulse"></div>
                @endif
            </div>
            <span class="text-[10px]">Profile</span>
        </a>

        <!-- More Menu -->
        <div class="flex flex-col items-center justify-center" x-data="{ open: false }" @click.outside="open = false">
            <button @click="open = !open" 
                    class="flex flex-col items-center justify-center space-y-1 text-xs font-medium text-muted-foreground hover:text-foreground transition-all duration-200 w-full h-full">
                <div class="relative">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </div>
                <span class="text-[10px]">More</span>
            </button>

            <!-- More Menu Dropdown -->
            <div x-show="open" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                 x-transition:leave-end="opacity-0 scale-95 translate-y-2"
                 class="absolute bottom-20 right-4 w-56 bg-card/95 backdrop-blur-xl rounded-2xl shadow-2xl border border-border/50 py-2 z-50"
                 style="display: none;">
                
                <div class="px-4 py-2 border-b border-border/50">
                    <p class="text-xs font-medium text-muted-foreground uppercase tracking-wider">Quick Actions</p>
                </div>

                <div class="p-2 space-y-1">
                    <a href="{{ route('settings.index') }}" 
                       @click="open = false"
                       class="flex items-center space-x-3 px-3 py-2.5 rounded-lg hover:bg-accent/50 transition-colors {{ request()->routeIs('settings.*') ? 'bg-primary/10 text-primary' : 'text-foreground' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span class="text-sm font-medium">{{ __('navigation.settings') }}</span>
                    </a>

                    @if(auth()->user()->hasRole('admin'))
                    <a href="{{ route('admin.settings') }}" 
                       @click="open = false"
                       class="flex items-center space-x-3 px-3 py-2.5 rounded-lg hover:bg-accent/50 transition-colors {{ request()->routeIs('admin.*') ? 'bg-primary/10 text-primary' : 'text-foreground' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"/>
                        </svg>
                        <span class="text-sm font-medium">Admin Settings</span>
                    </a>

                    <a href="{{ route('activity-logs.index') }}" 
                       @click="open = false"
                       class="flex items-center space-x-3 px-3 py-2.5 rounded-lg hover:bg-accent/50 transition-colors {{ request()->routeIs('activity-logs.*') ? 'bg-primary/10 text-primary' : 'text-foreground' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                        </svg>
                        <span class="text-sm font-medium">{{ __('navigation.activity_logs') }}</span>
                    </a>
                    @endif

                    <div class="border-t border-border/50 my-2"></div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" 
                                @click="open = false"
                                class="w-full flex items-center space-x-3 px-3 py-2.5 rounded-lg hover:bg-red-500/10 hover:text-red-600 transition-colors text-left">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            <span class="text-sm font-medium">{{ __('ui.logout') }}</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add bottom padding to main content to account for mobile nav -->
<style>
    @media (max-width: 767px) {
        body {
            padding-bottom: 4rem;
        }
    }
</style>