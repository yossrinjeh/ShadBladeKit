<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('navigation.settings') }} - Admin
        </h2>
    </x-slot>

    <div class="space-y-6">
        @if (session('status') === 'settings-updated')
            <x-ui.toast type="success" title="Success" message="App settings updated successfully!" />
        @endif

        <x-ui.card>
            <div class="p-6">
                <h3 class="text-lg font-semibold mb-6">App Customization</h3>
                
                <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PATCH')

                    <div>
                        <label for="app_name" class="block text-sm font-medium mb-2">App Name</label>
                        <x-ui.input 
                            id="app_name" 
                            name="app_name" 
                            type="text" 
                            value="{{ old('app_name', $settings['app_name']) }}" 
                            required 
                        />
                        @error('app_name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-4">
                        <h4 class="text-md font-medium">Color Scheme</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <div>
                                <label for="bg_light_color" class="block text-sm font-medium mb-2">Light Background</label>
                                <div class="flex items-center space-x-2">
                                    <input type="color" id="bg_light_color" name="bg_light_color" value="{{ old('bg_light_color', $settings['bg_light_color']) }}" class="w-10 h-10 rounded border cursor-pointer" required>
                                    <x-ui.input type="text" value="{{ old('bg_light_color', $settings['bg_light_color']) }}" readonly class="flex-1 text-xs" />
                                </div>
                            </div>
                            <div>
                                <label for="bg_dark_color" class="block text-sm font-medium mb-2">Dark Background</label>
                                <div class="flex items-center space-x-2">
                                    <input type="color" id="bg_dark_color" name="bg_dark_color" value="{{ old('bg_dark_color', $settings['bg_dark_color']) }}" class="w-10 h-10 rounded border cursor-pointer" required>
                                    <x-ui.input type="text" value="{{ old('bg_dark_color', $settings['bg_dark_color']) }}" readonly class="flex-1 text-xs" />
                                </div>
                            </div>
                            <div>
                                <label for="primary_color" class="block text-sm font-medium mb-2">Primary Color</label>
                                <div class="flex items-center space-x-2">
                                    <input type="color" id="primary_color" name="primary_color" value="{{ old('primary_color', $settings['primary_color']) }}" class="w-10 h-10 rounded border cursor-pointer" required>
                                    <x-ui.input type="text" value="{{ old('primary_color', $settings['primary_color']) }}" readonly class="flex-1 text-xs" />
                                </div>
                            </div>
                            <div>
                                <label for="secondary_color" class="block text-sm font-medium mb-2">Secondary Color</label>
                                <div class="flex items-center space-x-2">
                                    <input type="color" id="secondary_color" name="secondary_color" value="{{ old('secondary_color', $settings['secondary_color']) }}" class="w-10 h-10 rounded border cursor-pointer" required>
                                    <x-ui.input type="text" value="{{ old('secondary_color', $settings['secondary_color']) }}" readonly class="flex-1 text-xs" />
                                </div>
                            </div>
                            <div>
                                <label for="accent_color" class="block text-sm font-medium mb-2">Accent Color</label>
                                <div class="flex items-center space-x-2">
                                    <input type="color" id="accent_color" name="accent_color" value="{{ old('accent_color', $settings['accent_color']) }}" class="w-10 h-10 rounded border cursor-pointer" required>
                                    <x-ui.input type="text" value="{{ old('accent_color', $settings['accent_color']) }}" readonly class="flex-1 text-xs" />
                                </div>
                            </div>
                            <div>
                                <label for="success_color" class="block text-sm font-medium mb-2">Success Color</label>
                                <div class="flex items-center space-x-2">
                                    <input type="color" id="success_color" name="success_color" value="{{ old('success_color', $settings['success_color']) }}" class="w-10 h-10 rounded border cursor-pointer" required>
                                    <x-ui.input type="text" value="{{ old('success_color', $settings['success_color']) }}" readonly class="flex-1 text-xs" />
                                </div>
                            </div>
                            <div>
                                <label for="warning_color" class="block text-sm font-medium mb-2">Warning Color</label>
                                <div class="flex items-center space-x-2">
                                    <input type="color" id="warning_color" name="warning_color" value="{{ old('warning_color', $settings['warning_color']) }}" class="w-10 h-10 rounded border cursor-pointer" required>
                                    <x-ui.input type="text" value="{{ old('warning_color', $settings['warning_color']) }}" readonly class="flex-1 text-xs" />
                                </div>
                            </div>
                            <div>
                                <label for="danger_color" class="block text-sm font-medium mb-2">Danger Color</label>
                                <div class="flex items-center space-x-2">
                                    <input type="color" id="danger_color" name="danger_color" value="{{ old('danger_color', $settings['danger_color']) }}" class="w-10 h-10 rounded border cursor-pointer" required>
                                    <x-ui.input type="text" value="{{ old('danger_color', $settings['danger_color']) }}" readonly class="flex-1 text-xs" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label for="app_favicon" class="block text-sm font-medium mb-2">App Favicon</label>
                        
                        @if($settings['app_favicon'])
                            <div class="mb-4">
                                <p class="text-sm text-muted-foreground mb-2">Current Favicon:</p>
                                <img src="{{ asset('storage/' . $settings['app_favicon']) }}" alt="Current Favicon" class="w-8 h-8 object-contain border rounded">
                            </div>
                        @endif
                        
                        <input 
                            type="file" 
                            id="app_favicon" 
                            name="app_favicon" 
                            accept="image/*"
                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-white hover:file:bg-primary/90"
                        >
                        <p class="text-xs text-muted-foreground mt-1">Supported: ICO, PNG, JPG. Max: 1MB. Recommended: 32x32px</p>
                    </div>

                    <div>
                        <label for="app_logo" class="block text-sm font-medium mb-2">App Logo</label>
                        
                        @if($settings['app_logo'])
                            <div class="mb-4">
                                <p class="text-sm text-muted-foreground mb-2">Current Logo:</p>
                                <img src="{{ asset('storage/' . $settings['app_logo']) }}" alt="Current Logo" class="w-16 h-16 object-contain border rounded">
                            </div>
                        @endif
                        
                        <input 
                            type="file" 
                            id="app_logo" 
                            name="app_logo" 
                            accept="image/*"
                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-white hover:file:bg-primary/90"
                        >
                        <p class="text-xs text-muted-foreground mt-1">Supported: JPEG, PNG, JPG, GIF, SVG. Max: 2MB</p>
                    </div>

                    <div class="flex items-center justify-end space-x-4 pt-6 border-t">
                        <x-ui.button type="submit" variant="primary">
                            {{ __('common.save') }} {{ __('navigation.settings') }}
                        </x-ui.button>
                    </div>
                </form>
            </div>
        </x-ui.card>
    </div>
</x-app-layout>