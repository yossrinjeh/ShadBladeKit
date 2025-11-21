<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('navigation.settings') }} - Admin
        </h2>
    </x-slot>

    <div class="space-y-6">
        @if (session('status') === 'settings-updated')
            <x-ui.toast type="success" title="Success" message="App settings updated successfully!" />
        @elseif (session('status') === 'preset-activated')
            <x-ui.toast type="success" title="Success" message="Theme preset activated successfully!" />
        @elseif (session('status') === 'reset-completed')
            <x-ui.toast type="success" title="Success" message="Colors reset to defaults successfully!" />
        @endif

        <x-ui.card>
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-semibold">App Configuration</h3>
                    <a href="{{ route('theme-presets.index') }}" class="px-4 py-2 rounded text-white" style="background-color: {{ $settings['primary_color'] }}">
                        Manage Themes
                    </a>
                </div>
                
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