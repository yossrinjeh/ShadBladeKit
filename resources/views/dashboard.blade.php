<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('ui.dashboard') }}
        </h2>
    </x-slot>

    <div class="space-y-6">
        <!-- Toast Notifications -->
        @if (session('status') === 'notification-sent')
            <x-ui.toast type="success" title="Success" message="Test notification sent!" />
        @endif
        
        <!-- Welcome Card -->
        <x-ui.card class="overflow-hidden">
            <div class="relative p-6 bg-gradient-to-br from-primary/5 via-transparent to-accent/5">
                <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-primary/10 to-transparent rounded-full -translate-y-16 translate-x-16"></div>
                <div class="relative flex flex-col sm:flex-row sm:items-center justify-between space-y-4 sm:space-y-0">
                    <div class="space-y-2">
                        <div class="flex items-center space-x-2">
                            <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                            <span class="text-xs font-medium uppercase tracking-wider" style="color: #059669;">Online</span>
                        </div>
                        <h3 class="text-xl sm:text-2xl font-bold bg-gradient-to-r from-foreground to-muted-foreground bg-clip-text text-transparent">
                            {{ __('ui.welcome') }}, {{ Auth::user()->name }}!
                        </h3>
                        <p class="text-muted-foreground text-sm sm:text-base">{{ __('You\'re logged in and ready to go!') }}</p>
                        <div class="flex items-center space-x-4 text-xs text-muted-foreground">
                            <div class="flex items-center space-x-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span>{{ now()->format('M d, Y') }}</span>
                            </div>
                            <div class="flex items-center space-x-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <span>{{ Auth::user()->timezone ?? 'UTC' }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-2">
                        <form method="POST" action="{{ route('notifications.test') }}">
                            @csrf
                            <x-ui.button type="submit" variant="outline" size="sm" class="w-full sm:w-auto hover:scale-105 transition-transform">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM4 19h6v-2H4v2zM4 15h8v-2H4v2zM4 11h10V9H4v2z"/>
                                </svg>
                                Test Notification
                            </x-ui.button>
                        </form>
                        <x-ui.button variant="ghost" size="sm" class="w-full sm:w-auto hover:scale-105 transition-transform">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Quick Tour
                        </x-ui.button>
                    </div>
                </div>
            </div>
        </x-ui.card>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
            <x-ui.card class="group hover:shadow-xl hover:shadow-indigo-500/10 transition-all duration-300 hover:-translate-y-1 cursor-pointer">
                <div class="p-4 sm:p-6">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3 sm:space-x-4">
                            <div class="p-2.5 sm:p-3 rounded-xl bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900/30 dark:to-blue-800/30 flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-5 h-5 sm:w-7 sm:h-7 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs sm:text-sm font-medium text-muted-foreground mb-1">{{ __('ui.users') }}</p>
                                <p class="text-xl sm:text-2xl font-bold">1,234</p>
                                <div class="flex items-center space-x-1 mt-1">
                                    <svg class="w-3 h-3" style="color: #059669;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 17l9.2-9.2M17 8v9H8"/>
                                    </svg>
                                    <span class="text-xs font-medium" style="color: #059669;">+12%</span>
                                </div>
                            </div>
                        </div>
                        <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <svg class="w-4 h-4 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </x-ui.card>

            <x-ui.card>
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-xl bg-gradient-to-br from-emerald-50 to-emerald-100 dark:from-emerald-900/30 dark:to-emerald-800/30 flex items-center justify-center shadow-lg">
                            <svg class="w-7 h-7 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-muted-foreground">Active</p>
                            <p class="text-2xl font-bold">98.5%</p>
                        </div>
                    </div>
                </div>
            </x-ui.card>

            <x-ui.card>
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-xl bg-gradient-to-br from-sky-50 to-sky-100 dark:from-sky-900/30 dark:to-sky-800/30 flex items-center justify-center shadow-lg">
                            <svg class="w-7 h-7 text-sky-600 dark:text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-muted-foreground">Growth</p>
                            <p class="text-2xl font-bold">+12.5%</p>
                        </div>
                    </div>
                </div>
            </x-ui.card>

            <x-ui.card>
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-xl bg-gradient-to-br from-amber-50 to-amber-100 dark:from-amber-900/30 dark:to-amber-800/30 flex items-center justify-center shadow-lg">
                            <svg class="w-7 h-7 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-muted-foreground">Revenue</p>
                            <p class="text-2xl font-bold">$45.2K</p>
                        </div>
                    </div>
                </div>
            </x-ui.card>
        </div>

        <!-- Recent Activity -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-6">
            <div class="lg:col-span-2">
                <x-ui.card>
                    <div class="p-4 sm:p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-semibold flex items-center space-x-2">
                                <div class="w-2 h-2 bg-primary rounded-full animate-pulse"></div>
                                <span>Recent Activity</span>
                            </h3>
                            <button class="text-xs text-primary hover:text-primary/80 font-medium px-3 py-1 rounded-lg hover:bg-primary/10 transition-colors">
                                View All
                            </button>
                        </div>
                        <div class="space-y-4">
                            <div class="group flex items-start space-x-4 p-3 rounded-lg hover:bg-accent/30 transition-colors cursor-pointer">
                                <div class="flex-shrink-0 w-8 h-8 bg-gradient-to-br from-green-100 to-green-200 dark:from-green-900/30 dark:to-green-800/30 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between">
                                        <p class="text-sm font-medium group-hover:text-primary transition-colors">New user registered</p>
                                        <span class="text-xs text-muted-foreground">2m</span>
                                    </div>
                                    <p class="text-xs text-muted-foreground mt-1">John Doe joined the platform</p>
                                </div>
                            </div>
                            <div class="group flex items-start space-x-4 p-3 rounded-lg hover:bg-accent/30 transition-colors cursor-pointer">
                                <div class="flex-shrink-0 w-8 h-8 bg-gradient-to-br from-blue-100 to-blue-200 dark:from-blue-900/30 dark:to-blue-800/30 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between">
                                        <p class="text-sm font-medium group-hover:text-primary transition-colors">System update completed</p>
                                        <span class="text-xs text-muted-foreground">1h</span>
                                    </div>
                                    <p class="text-xs text-muted-foreground mt-1">Version 2.1.0 deployed successfully</p>
                                </div>
                            </div>
                            <div class="group flex items-start space-x-4 p-3 rounded-lg hover:bg-accent/30 transition-colors cursor-pointer">
                                <div class="flex-shrink-0 w-8 h-8 bg-gradient-to-br from-amber-100 to-amber-200 dark:from-amber-900/30 dark:to-amber-800/30 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8a2 2 0 012-2h10a2 2 0 012 2v10a2 2 0 01-2 2H7a2 2 0 01-2-2V8z"/>
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between">
                                        <p class="text-sm font-medium group-hover:text-primary transition-colors">Backup created</p>
                                        <span class="text-xs text-muted-foreground">3h</span>
                                    </div>
                                    <p class="text-xs text-muted-foreground mt-1">Daily backup completed (2.3GB)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </x-ui.card>
            </div>
            
            <!-- Quick Actions -->
            <div class="space-y-4">
                <x-ui.card>
                    <div class="p-4 sm:p-6">
                        <h3 class="text-lg font-semibold mb-4">Quick Actions</h3>
                        <div class="space-y-3">
                            <button class="w-full flex items-start space-x-3 p-3 rounded-lg hover:bg-accent/50 transition-colors text-left group">
                                <div class="w-8 h-8 bg-primary/10 rounded-lg flex items-center justify-center group-hover:bg-primary/20 transition-colors flex-shrink-0">
                                    <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium">Add User</p>
                                    <p class="text-xs text-muted-foreground">Create new account</p>
                                </div>
                            </button>
                            <button class="w-full flex items-start space-x-3 p-3 rounded-lg hover:bg-accent/50 transition-colors text-left group">
                                <div class="w-8 h-8 bg-green-500/10 rounded-lg flex items-center justify-center group-hover:bg-green-500/20 transition-colors flex-shrink-0">
                                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium">View Reports</p>
                                    <p class="text-xs text-muted-foreground">Analytics dashboard</p>
                                </div>
                            </button>
                            <button class="w-full flex items-start space-x-3 p-3 rounded-lg hover:bg-accent/50 transition-colors text-left group">
                                <div class="w-8 h-8 bg-blue-500/10 rounded-lg flex items-center justify-center group-hover:bg-blue-500/20 transition-colors flex-shrink-0">
                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium">Settings</p>
                                    <p class="text-xs text-muted-foreground">System configuration</p>
                                </div>
                            </button>
                        </div>
                    </div>
                </x-ui.card>
            </div>
        </div>
    </div>
</x-app-layout>
