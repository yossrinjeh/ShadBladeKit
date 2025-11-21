<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 ">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold">Theme Settings</h2>
                        <form action="{{ route('theme-presets.reset') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="px-4 py-2 rounded text-white bg-gray-600 hover:bg-gray-700" onclick="return confirm('Reset all colors to defaults?')">
                                Reset to Defaults
                            </button>
                        </form>
                    </div>
                    
                    @if(session('success'))
                        <div class="mb-6 p-4 bg-green-100 dark:bg-green-900/20 text-green-800 dark:text-green-400 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    <!-- Theme Presets Section -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold mb-4">Theme Presets</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($presets as $preset)
                                <div class="border rounded-lg p-4 {{ $preset->is_active ? 'border-blue-500 bg-blue-50 dark:bg-blue-900/20' : 'border-gray-200 dark:border-gray-700 dark:bg-gray-900' }}">
                                    <div class="flex justify-between items-start mb-3">
                                        <h3 class="font-semibold text-lg">{{ $preset->name }}</h3>
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
                    
                    <!-- Custom Colors Section -->
                    <div class="border-t pt-8">
                        <h3 class="text-lg font-semibold mb-4">Custom Colors</h3>
                        <form method="POST" action="{{ route('theme-presets.colors') }}" class="space-y-6">
                            @csrf
                            @method('PATCH')
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                                <div>
                                    <label for="bg_light_color" class="block text-sm font-medium mb-2">Light Background</label>
                                    <div class="flex items-center space-x-2">
                                        <input type="color" id="bg_light_color" name="bg_light_color" value="{{ $settings['bg_light_color'] }}" class="w-10 h-10 rounded border cursor-pointer" required>
                                        <input type="text" value="{{ $settings['bg_light_color'] }}" readonly class="flex-1 text-xs px-2 py-1 border rounded  dark:bg-gray-800" />
                                    </div>
                                </div>
                                <div>
                                    <label for="bg_dark_color" class="block text-sm font-medium mb-2">Dark Background</label>
                                    <div class="flex items-center space-x-2">
                                        <input type="color" id="bg_dark_color" name="bg_dark_color" value="{{ $settings['bg_dark_color'] }}" class="w-10 h-10 rounded border cursor-pointer" required>
                                        <input type="text" value="{{ $settings['bg_dark_color'] }}" readonly class="flex-1 text-xs px-2 py-1 border rounded  dark:bg-gray-800" />
                                    </div>
                                </div>
                                <div>
                                    <label for="primary_color" class="block text-sm font-medium mb-2">Primary Color</label>
                                    <div class="flex items-center space-x-2">
                                        <input type="color" id="primary_color" name="primary_color" value="{{ $settings['primary_color'] }}" class="w-10 h-10 rounded border cursor-pointer" required>
                                        <input type="text" value="{{ $settings['primary_color'] }}" readonly class="flex-1 text-xs px-2 py-1 border rounded  dark:bg-gray-800" />
                                    </div>
                                </div>
                                <div>
                                    <label for="secondary_color" class="block text-sm font-medium mb-2">Secondary Color</label>
                                    <div class="flex items-center space-x-2">
                                        <input type="color" id="secondary_color" name="secondary_color" value="{{ $settings['secondary_color'] }}" class="w-10 h-10 rounded border cursor-pointer" required>
                                        <input type="text" value="{{ $settings['secondary_color'] }}" readonly class="flex-1 text-xs px-2 py-1 border rounded  dark:bg-gray-800" />
                                    </div>
                                </div>
                                <div>
                                    <label for="accent_color" class="block text-sm font-medium mb-2">Accent Color</label>
                                    <div class="flex items-center space-x-2">
                                        <input type="color" id="accent_color" name="accent_color" value="{{ $settings['accent_color'] }}" class="w-10 h-10 rounded border cursor-pointer" required>
                                        <input type="text" value="{{ $settings['accent_color'] }}" readonly class="flex-1 text-xs px-2 py-1 border rounded  dark:bg-gray-800" />
                                    </div>
                                </div>
                                <div>
                                    <label for="success_color" class="block text-sm font-medium mb-2">Success Color</label>
                                    <div class="flex items-center space-x-2">
                                        <input type="color" id="success_color" name="success_color" value="{{ $settings['success_color'] }}" class="w-10 h-10 rounded border cursor-pointer" required>
                                        <input type="text" value="{{ $settings['success_color'] }}" readonly class="flex-1 text-xs px-2 py-1 border rounded  dark:bg-gray-800" />
                                    </div>
                                </div>
                                <div>
                                    <label for="warning_color" class="block text-sm font-medium mb-2">Warning Color</label>
                                    <div class="flex items-center space-x-2">
                                        <input type="color" id="warning_color" name="warning_color" value="{{ $settings['warning_color'] }}" class="w-10 h-10 rounded border cursor-pointer" required>
                                        <input type="text" value="{{ $settings['warning_color'] }}" readonly class="flex-1 text-xs px-2 py-1 border rounded  dark:bg-gray-800" />
                                    </div>
                                </div>
                                <div>
                                    <label for="danger_color" class="block text-sm font-medium mb-2">Danger Color</label>
                                    <div class="flex items-center space-x-2">
                                        <input type="color" id="danger_color" name="danger_color" value="{{ $settings['danger_color'] }}" class="w-10 h-10 rounded border cursor-pointer" required>
                                        <input type="text" value="{{ $settings['danger_color'] }}" readonly class="flex-1 text-xs px-2 py-1 border rounded  dark:bg-gray-800" />
                                    </div>
                                </div>
                            </div>
                            
                            <div class="flex justify-end pt-4">
                                <button type="submit" class="px-6 py-2 rounded text-white" style="background-color: {{ $settings['primary_color'] }}">
                                    Save Custom Colors
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>