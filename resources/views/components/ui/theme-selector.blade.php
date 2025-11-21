@props(['class' => ''])

<div class="relative {{ $class }}" x-data="{ open: false }">
    <button @click="open = !open" class="flex items-center space-x-2 px-3 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
        <div class="w-4 h-4 rounded-full" style="background-color: {{ $appSettings['primary_color'] }}"></div>
        <span>{{ $activeThemePreset?->name ?? 'Theme' }}</span>
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
    </button>
    
    <div x-show="open" @click.away="open = false" x-transition class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-md shadow-lg z-50">
        @foreach($themePresets as $preset)
            <form action="{{ route('theme-presets.activate', $preset) }}" method="POST" class="block">
                @csrf
                @method('PATCH')
                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 flex items-center space-x-2 {{ $preset->is_active ? 'bg-blue-50 dark:bg-blue-900/20' : '' }}">
                    <div class="flex space-x-1">
                        @foreach(array_slice($preset->colors, 0, 3) as $color)
                            <div class="w-3 h-3 rounded-full" style="background-color: {{ $color }}"></div>
                        @endforeach
                    </div>
                    <span>{{ $preset->name }}</span>
                    @if($preset->is_active)
                        <svg class="w-4 h-4 text-blue-600 ml-auto" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    @endif
                </button>
            </form>
        @endforeach
    </div>
</div>