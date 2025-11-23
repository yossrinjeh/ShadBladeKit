@props([
    'class' => '',
    'variant' => 'default',
    'padding' => 'default',
    'hover' => true,
    'glass' => false
])

@php
$variants = [
    'default' => 'bg-card/95 border-border/50',
    'elevated' => 'bg-card shadow-lg border-border/30',
    'outlined' => 'bg-transparent border-2 border-border',
    'filled' => 'bg-accent/5 border-accent/20',
    'gradient' => 'bg-gradient-to-br from-card via-card/95 to-accent/5 border-border/30'
];

$paddings = [
    'none' => '',
    'sm' => 'p-3',
    'default' => 'p-4 sm:p-6',
    'lg' => 'p-6 sm:p-8',
    'xl' => 'p-8 sm:p-10'
];

$baseClasses = 'rounded-xl text-card-foreground shadow-sm backdrop-blur-sm transition-all duration-300';
$hoverClasses = $hover ? 'hover:shadow-lg hover:shadow-black/5 hover:-translate-y-1 hover:border-border' : '';
$glassClasses = $glass ? 'backdrop-blur-xl bg-card/80 border-white/10' : '';
$variantClasses = $variants[$variant];
$paddingClasses = $paddings[$padding];

$classes = $baseClasses . ' ' . $variantClasses . ' ' . $hoverClasses . ' ' . $glassClasses . ' ' . $paddingClasses . ' ' . $class;
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</div>