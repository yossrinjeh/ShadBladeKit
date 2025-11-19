@props([
    'title' => '',
    'value' => 0,
    'change' => null,
    'trend' => 'neutral',
    'icon' => 'chart',
    'color' => 'blue'
])

@php
$colors = [
    'blue' => 'bg-blue-100 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400',
    'green' => 'bg-green-100 dark:bg-green-900/20 text-green-600 dark:text-green-400',
    'purple' => 'bg-purple-100 dark:bg-purple-900/20 text-purple-600 dark:text-purple-400',
    'orange' => 'bg-orange-100 dark:bg-orange-900/20 text-orange-600 dark:text-orange-400',
    'red' => 'bg-red-100 dark:bg-red-900/20 text-red-600 dark:text-red-400'
];

$trendColors = [
    'up' => 'text-green-600 dark:text-green-400',
    'down' => 'text-red-600 dark:text-red-400',
    'neutral' => 'text-muted-foreground'
];

$icons = [
    'users' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />',
    'check' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />',
    'shield' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />',
    'chart' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />',
    'dollar' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />'
];
@endphp

<x-ui.card {{ $attributes }}>
    <div class="p-6">
        <div class="flex items-center">
            <div class="p-2 {{ $colors[$color] }} rounded-lg">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    {!! $icons[$icon] !!}
                </svg>
            </div>
            <div class="ml-4 flex-1">
                <p class="text-sm font-medium text-muted-foreground">{{ $title }}</p>
                <div class="flex items-center">
                    <p class="text-2xl font-bold">{{ is_numeric($value) ? number_format($value) : $value }}</p>
                    @if($change !== null)
                        <span class="ml-2 text-sm {{ $trendColors[$trend] }}">
                            @if($trend === 'up')
                                <svg class="inline w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                            @elseif($trend === 'down')
                                <svg class="inline w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M14.707 12.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 14.586V3a1 1 0 012 0v11.586l2.293-2.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            @endif
                            {{ $change }}
                        </span>
                    @endif
                </div>
                @if($slot->isNotEmpty())
                    <div class="mt-1 text-xs text-muted-foreground">
                        {{ $slot }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-ui.card>