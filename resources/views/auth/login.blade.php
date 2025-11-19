<x-guest-layout>
    <x-ui.card class="w-full max-w-md mx-auto">
        <div class="p-6">
            <div class="mb-6 text-center">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ __('ui.login') }}</h2>
                <p class="text-gray-600 dark:text-gray-300 mt-2">{{ __('ui.welcome') }}</p>
            </div>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <div>
                    <x-input-label for="email" :value="__('ui.email')" />
                    <x-ui.input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" class="mt-1" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="password" :value="__('ui.password')" />
                    <x-ui.input id="password" type="password" name="password" required autocomplete="current-password" class="mt-1" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-input" name="remember">
                    <label for="remember_me" class="ml-2 text-sm text-gray-600 dark:text-gray-300">{{ __('ui.remember_me') }}</label>
                </div>

                <x-ui.button type="submit" class="w-full">
                    {{ __('ui.login') }}
                </x-ui.button>

                <div class="text-center">
                    @if (Route::has('password.request'))
                        <a class="text-sm text-primary hover:underline" href="{{ route('password.request') }}">
                            {{ __('ui.forgot_password') }}
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </x-ui.card>
</x-guest-layout>
