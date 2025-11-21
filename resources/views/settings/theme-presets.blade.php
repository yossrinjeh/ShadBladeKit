<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 ">
                    <h2 class="text-2xl font-bold mb-6">Theme Presets</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($presets as $preset)
                            <div class="border rounded-lg p-4 {{ $preset->is_active ? 'border-blue-500 bg-blue-50 dark:bg-blue-900/20' : 'border-gray-200 dark:border-gray-700 dark:bg-gray-900' }}">
                                <div class="flex justify-between items-start mb-3">
                                    <h3 class="font-semibold text-lg ">{{ $preset->name }}</h3>
                                    @if($preset->is_active)
                                        <span class="bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-400 text-xs px-2 py-1 rounded-full">Active</span>
                                    @endif
                                </div>
                                
                                <div class="grid grid-cols-4 gap-2 mb-4">
                                    @foreach($preset->colors as $key => $color)
                                        <div class="w-8 h-8 rounded border border-gray-300 dark:border-gray-600" 
                                             style="background-color: {{ $color }}"
                                             title="{{ ucwords(str_replace('_', ' ', $key)) }}"></div>
                                    @endforeach
                                </div>
                                
                                @unless($preset->is_active)
                                    <form action="{{ route('theme-presets.activate', $preset) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="w-full px-4 py-2 rounded text-white" style="background-color: {{ $preset->colors['primary_color'] }}; hover:opacity-90">
                                            Activate Theme
                                        </button>
                                    </form>
                                @endunless
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>