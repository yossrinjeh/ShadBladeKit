@props([
    'type' => 'spinner',
    'size' => 'default',
    'color' => 'primary',
    'text' => null
])

@php
$sizes = [
    'xs' => 'w-3 h-3',
    'sm' => 'w-4 h-4',
    'default' => 'w-6 h-6',
    'lg' => 'w-8 h-8',
    'xl' => 'w-12 h-12'
];

$colors = [
    'primary' => 'text-primary',
    'secondary' => 'text-secondary',
    'white' => 'text-white',
    'gray' => 'text-gray-500'
];

$sizeClass = $sizes[$size] ?? $sizes['default'];
$colorClass = $colors[$color] ?? $colors['primary'];
@endphp

<div {{ $attributes->merge(['class' => 'flex items-center justify-center']) }}>
    @if($type === 'spinner')
        <svg class="animate-spin {{ $sizeClass }} {{ $colorClass }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
    @elseif($type === 'dots')
        <div class="flex space-x-1">
            <div class="w-2 h-2 {{ $colorClass === 'text-primary' ? 'bg-primary' : str_replace('text-', 'bg-', $colorClass) }} rounded-full animate-bounce"></div>
            <div class="w-2 h-2 {{ $colorClass === 'text-primary' ? 'bg-primary' : str_replace('text-', 'bg-', $colorClass) }} rounded-full animate-bounce" style="animation-delay: 0.1s"></div>
            <div class="w-2 h-2 {{ $colorClass === 'text-primary' ? 'bg-primary' : str_replace('text-', 'bg-', $colorClass) }} rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
        </div>
    @elseif($type === 'pulse')
        <div class="relative {{ $sizeClass }}">
            <div class="absolute inset-0 {{ $colorClass === 'text-primary' ? 'bg-primary' : str_replace('text-', 'bg-', $colorClass) }} rounded-full animate-ping opacity-75"></div>
            <div class="relative {{ $colorClass === 'text-primary' ? 'bg-primary' : str_replace('text-', 'bg-', $colorClass) }} rounded-full {{ $sizeClass }}"></div>
        </div>
    @elseif($type === 'bars')
        <div class="flex items-end space-x-1">
            <div class="w-1 h-4 {{ $colorClass === 'text-primary' ? 'bg-primary' : str_replace('text-', 'bg-', $colorClass) }} rounded-full animate-pulse"></div>
            <div class="w-1 h-6 {{ $colorClass === 'text-primary' ? 'bg-primary' : str_replace('text-', 'bg-', $colorClass) }} rounded-full animate-pulse" style="animation-delay: 0.1s"></div>
            <div class="w-1 h-4 {{ $colorClass === 'text-primary' ? 'bg-primary' : str_replace('text-', 'bg-', $colorClass) }} rounded-full animate-pulse" style="animation-delay: 0.2s"></div>
        </div>
    @endif
    
    @if($text)
        <span class="ml-3 text-sm font-medium {{ $colorClass }}">{{ $text }}</span>
    @endif
</div>