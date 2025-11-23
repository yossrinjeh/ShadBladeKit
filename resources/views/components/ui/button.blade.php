@props([
    'variant' => 'default',
    'size' => 'default',
    'type' => 'button',
    'loading' => false,
    'disabled' => false
])

@php
$variants = [
    'default' => 'bg-gradient-to-r from-primary to-primary/90 text-primary-foreground hover:from-primary/90 hover:to-primary/80 shadow-lg shadow-primary/25 hover:shadow-xl hover:shadow-primary/30',
    'primary' => 'bg-gradient-to-r from-primary to-primary/90 text-primary-foreground hover:from-primary/90 hover:to-primary/80 shadow-lg shadow-primary/25 hover:shadow-xl hover:shadow-primary/30',
    'destructive' => 'bg-gradient-to-r from-destructive to-destructive/90 text-destructive-foreground hover:from-destructive/90 hover:to-destructive/80 shadow-lg shadow-destructive/25',
    'outline' => 'border-2 border-input bg-background hover:bg-accent hover:text-accent-foreground hover:border-accent-foreground/20 backdrop-blur-sm',
    'secondary' => 'bg-secondary/10 text-secondary border border-secondary/20 hover:bg-secondary/20 hover:border-secondary/30 backdrop-blur-sm',
    'ghost' => 'hover:bg-accent/70 hover:text-accent-foreground hover:backdrop-blur-sm',
    'link' => 'text-primary underline-offset-4 hover:underline hover:text-primary/80',
    'success' => 'bg-gradient-to-r from-green-500 to-green-600 text-white hover:from-green-600 hover:to-green-700 shadow-lg shadow-green-500/25',
    'warning' => 'bg-gradient-to-r from-amber-500 to-amber-600 text-white hover:from-amber-600 hover:to-amber-700 shadow-lg shadow-amber-500/25',
    'info' => 'bg-gradient-to-r from-blue-500 to-blue-600 text-white hover:from-blue-600 hover:to-blue-700 shadow-lg shadow-blue-500/25'
];

$sizes = [
    'xs' => 'h-8 px-2.5 py-1 text-xs min-w-[2rem]',
    'sm' => 'h-9 px-3 py-1.5 text-sm min-w-[2.25rem]',
    'default' => 'h-11 px-4 py-2.5 text-sm min-w-[2.75rem]',
    'lg' => 'h-12 px-6 py-3 text-base min-w-[3rem]',
    'xl' => 'h-14 px-8 py-4 text-lg min-w-[3.5rem]',
    'icon-xs' => 'h-8 w-8 p-0',
    'icon-sm' => 'h-9 w-9 p-0',
    'icon' => 'h-11 w-11 p-0',
    'icon-lg' => 'h-12 w-12 p-0',
    'icon-xl' => 'h-14 w-14 p-0'
];

$baseClasses = 'inline-flex items-center justify-center whitespace-nowrap rounded-xl font-medium ring-offset-background transition-all duration-200 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 touch-manipulation active:scale-95 hover:scale-105';

$loadingClasses = $loading ? 'cursor-not-allowed opacity-70' : '';
$disabledClasses = $disabled ? 'cursor-not-allowed opacity-50' : '';

$classes = $baseClasses . ' ' . $variants[$variant] . ' ' . $sizes[$size] . ' ' . $loadingClasses . ' ' . $disabledClasses;
@endphp

<button {{ $attributes->merge([
    'type' => $type, 
    'class' => $classes,
    'disabled' => $loading || $disabled
]) }}>
    @if($loading)
        <svg class="animate-spin -ml-1 mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        <span class="sr-only">Loading...</span>
    @endif
    
    <span class="{{ $loading ? 'opacity-0' : '' }} transition-opacity duration-200 flex items-center">
        {{ $slot }}
    </span>
</button>