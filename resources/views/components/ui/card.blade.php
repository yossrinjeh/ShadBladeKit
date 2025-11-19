@props(['class' => ''])

<div {{ $attributes->merge(['class' => 'rounded-lg border bg-card text-card-foreground shadow-sm ' . $class]) }}>
    {{ $slot }}
</div>