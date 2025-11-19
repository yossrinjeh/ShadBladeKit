<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('ui.settings') }}
        </h2>
    </x-slot>

    <div class="space-y-6">
        <!-- Theme Settings -->
        <x-ui.card>
            <div class="p-6">
                <h3 class="text-lg font-semibold mb-4">{{ __('ui.theme') }}</h3>
                <form method="POST" action="{{ route('settings.update') }}">
                    @csrf
                    <div class="space-y-4">
                        <div class="flex items-center space-x-4">
                            <input type="radio" id="light" name="theme" value="light" 
                                   {{ session('theme', 'light') === 'light' ? 'checked' : '' }}
                                   class="rounded border-input">
                            <label for="light" class="text-sm font-medium">Light Mode</label>
                        </div>
                        <div class="flex items-center space-x-4">
                            <input type="radio" id="dark" name="theme" value="dark" 
                                   {{ session('theme') === 'dark' ? 'checked' : '' }}
                                   class="rounded border-input">
                            <label for="dark" class="text-sm font-medium">Dark Mode</label>
                        </div>
                    </div>
                    <div class="mt-6">
                        <x-ui.button type="submit">{{ __('ui.save') }}</x-ui.button>
                    </div>
                </form>
            </div>
        </x-ui.card>

        <!-- Language Settings -->
        <x-ui.card>
            <div class="p-6">
                <h3 class="text-lg font-semibold mb-4">{{ __('ui.language') }}</h3>
                <form method="POST" action="{{ route('settings.update') }}">
                    @csrf
                    <div class="space-y-4">
                        @php
                        $languages = [
                            'en' => ['name' => 'English', 'flag' => '🇺🇸'],
                            'fr' => ['name' => 'Français', 'flag' => '🇫🇷'],
                            'es' => ['name' => 'Español', 'flag' => '🇪🇸'],
                            'ar' => ['name' => 'العربية', 'flag' => '🇸🇦']
                        ];
                        $currentLocale = app()->getLocale();
                        @endphp
                        
                        @foreach($languages as $code => $language)
                        <div class="flex items-center space-x-4">
                            <input type="radio" id="lang_{{ $code }}" name="language" value="{{ $code }}" 
                                   {{ $currentLocale === $code ? 'checked' : '' }}
                                   class="rounded border-input">
                            <label for="lang_{{ $code }}" class="text-sm font-medium flex items-center">
                                <span class="mr-2">{{ $language['flag'] }}</span>
                                {{ $language['name'] }}
                            </label>
                        </div>
                        @endforeach
                    </div>
                    <div class="mt-6">
                        <x-ui.button type="submit">{{ __('ui.save') }}</x-ui.button>
                    </div>
                </form>
            </div>
        </x-ui.card>

        <!-- Account Settings -->
        <x-ui.card>
            <div class="p-6">
                <h3 class="text-lg font-semibold mb-4">Account Settings</h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="font-medium">Email Notifications</p>
                            <p class="text-sm text-muted-foreground">Receive email updates about your account</p>
                        </div>
                        <input type="checkbox" checked class="rounded border-input">
                    </div>
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="font-medium">Two-Factor Authentication</p>
                            <p class="text-sm text-muted-foreground">Add an extra layer of security</p>
                            @if(auth()->user()->hasTwoFactorEnabled())
                                <p class="text-xs text-green-600 dark:text-green-400 mt-1">✓ Enabled</p>
                            @endif
                        </div>
                        @if(auth()->user()->hasTwoFactorEnabled())
                            <a href="{{ route('profile.edit') }}#two-factor" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-muted-foreground bg-background hover:bg-accent focus:outline-none transition ease-in-out duration-150">
                                Manage
                            </a>
                        @else
                            <a href="{{ route('profile.edit') }}#two-factor" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md bg-primary text-primary-foreground hover:bg-primary/90 focus:outline-none transition ease-in-out duration-150">
                                Enable
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </x-ui.card>

        @if (session('status') === 'settings-updated')
            <div class="p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-md">
                <p class="text-sm text-green-800 dark:text-green-200">Settings updated successfully!</p>
            </div>
        @endif
    </div>
</x-app-layout>