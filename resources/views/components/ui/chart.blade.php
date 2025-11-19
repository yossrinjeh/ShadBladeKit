@props([
    'type' => 'line',
    'title' => '',
    'height' => 'h-64',
    'chartId' => 'chart-' . uniqid()
])

<x-ui.card {{ $attributes }}>
    <div class="p-6">
        @if($title)
            <h3 class="text-lg font-semibold mb-4">{{ $title }}</h3>
        @endif
        <div class="{{ $height }}">
            <canvas id="{{ $chartId }}"></canvas>
        </div>
    </div>
</x-ui.card>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('{{ $chartId }}').getContext('2d');
    
    // Chart configuration will be passed from parent component
    window.initChart_{{ str_replace('-', '_', $chartId) }} = function(config) {
        new Chart(ctx, config);
    };
});
</script>
@endpush