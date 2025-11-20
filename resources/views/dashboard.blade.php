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
        <x-ui.card>
            <div class="p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold mb-2">{{ __('ui.welcome') }}, {{ Auth::user()->name }}!</h3>
                        <p class="text-muted-foreground">{{ __('You\'re logged in!') }}</p>
                    </div>
                    <form method="POST" action="{{ route('notifications.test') }}">
                        @csrf
                        <x-ui.button type="submit" variant="outline" size="sm">
                            Test Notification
                        </x-ui.button>
                    </form>
                </div>
            </div>
        </x-ui.card>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <x-ui.card>
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="p-2 bg-gray-100 dark:bg-gray-800 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6" fill="#4f46e5" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path>
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
                        <div class="p-2 bg-gray-100 dark:bg-gray-800 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6" fill="#059669" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
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
                        <div class="p-2 bg-gray-100 dark:bg-gray-800 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6" fill="#0284c7" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"></path>
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
                        <div class="p-2 bg-gray-100 dark:bg-gray-800 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6" fill="#d97706" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267v1.698c.384-.104.734-.267 1.013-.49.398-.32.654-.769.654-1.257 0-.488-.256-.937-.654-1.257A4.014 4.014 0 0011 12.85z"></path>
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"></path>
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
