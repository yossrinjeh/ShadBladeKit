<section>
    <header>
        <h2 class="text-lg font-medium">
            {{ __('ui.preferences') }}
        </h2>
        <p class="mt-1 text-sm text-muted-foreground">
            {{ __('ui.preferences_description') }}
        </p>
    </header>

    <div class="mt-6 space-y-6">
        <!-- Language Selection -->
        <div>
            <h3 class="text-sm font-medium mb-3">{{ __('ui.language') }}</h3>
            <form method="post" action="{{ route('profile.language') }}">
                @csrf
                @method('patch')
                <div class="space-y-2">
                    @php
                        $languages = [
                            'en' => ['name' => 'English', 'flag' => '🇺🇸'],
                            'fr' => ['name' => 'Français', 'flag' => '🇫🇷'],
                            'es' => ['name' => 'Español', 'flag' => '🇪🇸'],
                            'ar' => ['name' => 'العربية', 'flag' => '🇸🇦'],
                        ];
                    @endphp
                    
                    @foreach($languages as $code => $lang)
                        <label class="flex items-center space-x-3 p-3 rounded-lg border cursor-pointer hover:bg-accent {{ ($user->language ?? 'en') === $code ? 'border-primary bg-primary/5' : 'border-input' }}">
                            <input 
                                type="radio" 
                                name="language" 
                                value="{{ $code }}" 
                                {{ ($user->language ?? 'en') === $code ? 'checked' : '' }}
                                onchange="this.form.submit()"
                                class="text-primary focus:ring-primary"
                            >
                            <span class="text-lg">{{ $lang['flag'] }}</span>
                            <span class="font-medium">{{ $lang['name'] }}</span>
                        </label>
                    @endforeach
                </div>
            </form>
        </div>

        <!-- Dark Mode Toggle -->
        <div>
            <h3 class="text-sm font-medium mb-3">{{ __('ui.theme') }}</h3>
            <form method="post" action="{{ route('profile.dark-mode') }}">
                @csrf
                <div class="flex items-center justify-between p-3 rounded-lg border border-input">
                    <div class="flex items-center space-x-3">
                        <div class="p-2 rounded-lg bg-accent">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium">{{ __('ui.dark_mode') }}</p>
                            <p class="text-sm text-muted-foreground">{{ __('ui.switch_to_dark_theme') }}</p>
                        </div>
                    </div>
                    <button 
                        type="submit"
                        class="relative inline-flex h-6 w-11 items-center rounded-full transition-colors focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 {{ ($user->dark_mode ?? false) ? 'bg-primary' : 'bg-muted' }}"
                    >
                        <span class="inline-block h-4 w-4 transform rounded-full bg-white transition-transform {{ ($user->dark_mode ?? false) ? 'translate-x-6' : 'translate-x-1' }}"></span>
                    </button>
                </div>
            </form>
        </div>

        @if (session('status') === 'language-updated')
            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-green-600">
                {{ __('ui.language_updated_successfully') }}
            </p>
        @endif

        @if (session('status') === 'theme-updated')
            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-green-600">
                {{ __('ui.theme_updated_successfully') }}
            </p>
        @endif
    </div>
</section>