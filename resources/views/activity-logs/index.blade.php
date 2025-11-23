<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('ui.activity_logs') }}
        </h2>
    </x-slot>

    <div class="space-y-6">
        <!-- Filters -->
        <x-ui.card>
            <div class="p-6">
                <form method="GET" class="flex flex-wrap gap-4">
                    <div class="flex-1 min-w-48">
                        <x-ui.input 
                            type="text" 
                            name="event" 
                            placeholder="{{ __('ui.filter_by_event') }}" 
                            value="{{ request('event') }}"
                            class="w-full"
                        />
                    </div>
                    <div class="min-w-32">
                        <select name="user" class="w-full rounded-md border border-input bg-background px-3 py-2 text-sm">
                            <option value="">{{ __('ui.all_users') }}</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ request('user') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="min-w-32">
                        <x-ui.input 
                            type="date" 
                            name="date_from" 
                            value="{{ request('date_from') }}"
                            class="w-full"
                        />
                    </div>
                    <div class="min-w-32">
                        <x-ui.input 
                            type="date" 
                            name="date_to" 
                            value="{{ request('date_to') }}"
                            class="w-full"
                        />
                    </div>
                    <x-ui.button type="submit" variant="outline">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        {{ __('ui.filter') }}
                    </x-ui.button>
                    @if(request()->hasAny(['event', 'user', 'date_from', 'date_to']))
                        <a href="{{ route('activity-logs.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-muted-foreground hover:text-foreground">
                            {{ __('ui.clear') }}
                        </a>
                    @endif
                </form>
            </div>
        </x-ui.card>

        <!-- Activity Logs -->
        <x-ui.card>
            <div class="p-6">
                <h3 class="text-lg font-semibold mb-4">{{ __('ui.activity_timeline') }} ({{ $activities->total() }} {{ __('ui.events') }})</h3>
                
                <div class="space-y-4">
                    @forelse($activities as $activity)
                        <div class="flex items-start space-x-4 p-4 rounded-lg border border-input hover:bg-accent/50">
                            <!-- Event Icon -->
                            <div class="flex-shrink-0">
                                @php
                                    $iconClass = match(true) {
                                        str_contains($activity->description, 'login') => 'text-green-600 bg-green-100 dark:bg-green-900/20',
                                        str_contains($activity->description, 'logout') => 'text-blue-600 bg-blue-100 dark:bg-blue-900/20',
                                        str_contains($activity->description, 'failed') => 'text-red-600 bg-red-100 dark:bg-red-900/20',
                                        str_contains($activity->description, 'created') => 'text-purple-600 bg-purple-100 dark:bg-purple-900/20',
                                        str_contains($activity->description, 'updated') => 'text-yellow-600 bg-yellow-100 dark:bg-yellow-900/20',
                                        str_contains($activity->description, 'deleted') => 'text-red-600 bg-red-100 dark:bg-red-900/20',
                                        default => 'text-gray-600 bg-gray-100 dark:bg-gray-900/20'
                                    };
                                @endphp
                                <div class="p-2 rounded-full {{ $iconClass }}">
                                    @if(str_contains($activity->description, 'login'))
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                        </svg>
                                    @elseif(str_contains($activity->description, 'logout'))
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                        </svg>
                                    @elseif(str_contains($activity->description, 'created'))
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                    @elseif(str_contains($activity->description, 'updated'))
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    @elseif(str_contains($activity->description, 'deleted'))
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    @else
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    @endif
                                </div>
                            </div>

                            <!-- Event Details -->
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between">
                                    <p class="font-medium">{{ $activity->description }}</p>
                                    <span class="text-xs text-muted-foreground">
                                        {{ $activity->created_at->diffForHumans() }}
                                    </span>
                                </div>
                                
                                <div class="mt-1 text-sm text-muted-foreground">
                                    @if($activity->causer)
                                        <span class="font-medium">{{ $activity->causer->name }}</span>
                                    @else
                                        <span class="italic">{{ __('ui.system') }}</span>
                                    @endif
                                    
                                    @if($activity->properties && $activity->properties->has('ip_address'))
                                        • IP: {{ $activity->properties['ip_address'] }}
                                    @endif
                                    
                                    @if($activity->subject)
                                        • {{ __('ui.target') }}: {{ class_basename($activity->subject_type) }} #{{ $activity->subject_id }}
                                    @endif
                                </div>

                                <!-- Additional Properties -->
                                @if($activity->properties && $activity->properties->count() > 1)
                                    <div class="mt-2" x-data="{ expanded: false }">
                                        <button @click="expanded = !expanded" class="text-xs text-primary hover:underline">
                                            <span x-show="!expanded">{{ __('ui.show_details') }}</span>
                                            <span x-show="expanded">{{ __('ui.hide_details') }}</span>
                                        </button>
                                        <div x-show="expanded" class="mt-2 p-2 bg-muted rounded text-xs">
                                            <pre class="whitespace-pre-wrap">{{ json_encode($activity->properties, JSON_PRETTY_PRINT) }}</pre>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8 text-muted-foreground">
                            {{ __('ui.no_activity_logs') }}
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="mt-6">
                    {{ $activities->links() }}
                </div>
            </div>
        </x-ui.card>
    </div>
</x-app-layout>