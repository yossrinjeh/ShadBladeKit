<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Notifications') }}
            </h2>
            @if($notifications->where('read_at', null)->count() > 0)
                <form method="POST" action="{{ route('notifications.read-all') }}">
                    @csrf
                    <x-ui.button type="submit" variant="outline" size="sm">
                        {{ __('Mark All Read') }}
                    </x-ui.button>
                </form>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-card overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-card-foreground">
                    @if($notifications->count() > 0)
                        <div class="space-y-4">
                            @foreach($notifications as $notification)
                                <div class="bg-card border border-border rounded-lg p-4 {{ !$notification->read_at ? 'ring-2 ring-primary/20' : '' }}">
                                    <div class="flex items-start space-x-4">
                                        <div class="flex-shrink-0">
                                            <div class="w-8 h-8 bg-primary/10 rounded-full flex items-center justify-center">
                                                <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-center justify-between">
                                                <h3 class="text-sm font-medium text-card-foreground">
                                                    {{ $notification->data['title'] }}
                                                </h3>
                                                <div class="flex items-center space-x-2">
                                                    <span class="text-xs text-muted-foreground">
                                                        {{ $notification->created_at->diffForHumans() }}
                                                    </span>
                                                    @if(!$notification->read_at)
                                                        <form method="POST" action="{{ route('notifications.read', $notification->id) }}" class="inline">
                                                            @csrf
                                                            <x-ui.button type="submit" variant="ghost" size="sm">
                                                                {{ __('Mark Read') }}
                                                            </x-ui.button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </div>
                                            <p class="mt-1 text-sm text-muted-foreground">
                                                {{ $notification->data['message'] }}
                                            </p>
                                            @if(isset($notification->data['action_url']) && isset($notification->data['action_text']))
                                                <div class="mt-2">
                                                    <a href="{{ $notification->data['action_url'] }}" class="text-sm text-primary hover:text-primary/80">
                                                        {{ $notification->data['action_text'] }} →
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <div class="mt-6">
                            {{ $notifications->links() }}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5-5-5h5v-12"/>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-100">{{ __('No notifications') }}</h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('You have no notifications at this time.') }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>