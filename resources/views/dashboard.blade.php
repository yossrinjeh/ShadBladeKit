<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('ui.dashboard') }}
        </h2>
    </x-slot>

    <div class="space-y-6">
        <!-- Welcome Card -->
        <x-ui.card>
            <div class="p-6">
                <h3 class="text-lg font-semibold mb-2">{{ __('ui.welcome') }}, {{ Auth::user()->name }}!</h3>
                <p class="text-muted-foreground">{{ __('You\'re logged in!') }}</p>
            </div>
        </x-ui.card>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <x-ui.card>
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="p-2 bg-primary/10 rounded-lg">
                            <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-muted-foreground">{{ __('ui.users') }}</p>
                            <p class="text-2xl font-bold">1,234</p>
                        </div>
                    </div>
                </div>
            </x-ui.card>

            <x-ui.card>
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="p-2 bg-green-100 dark:bg-green-900/20 rounded-lg">
                            <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
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
                        <div class="p-2 bg-blue-100 dark:bg-blue-900/20 rounded-lg">
                            <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
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
                        <div class="p-2 bg-purple-100 dark:bg-purple-900/20 rounded-lg">
                            <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
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
        <x-ui.card>
            <div class="p-6">
                <h3 class="text-lg font-semibold mb-4">Recent Activity</h3>
                <div class="space-y-4">
                    <div class="flex items-center space-x-4">
                        <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                        <div class="flex-1">
                            <p class="text-sm font-medium">New user registered</p>
                            <p class="text-xs text-muted-foreground">2 minutes ago</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                        <div class="flex-1">
                            <p class="text-sm font-medium">System update completed</p>
                            <p class="text-xs text-muted-foreground">1 hour ago</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="w-2 h-2 bg-yellow-500 rounded-full"></div>
                        <div class="flex-1">
                            <p class="text-sm font-medium">Backup created</p>
                            <p class="text-xs text-muted-foreground">3 hours ago</p>
                        </div>
                    </div>
                </div>
            </div>
        </x-ui.card>
    </div>
</x-app-layout>
