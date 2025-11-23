<x-guest-layout>
    <x-ui.card class="w-full max-w-md mx-auto">
        <div class="p-6">
            <div class="mb-6 text-center">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ __('ui.forgot_password') }}</h2>
                <p class="text-gray-600 dark:text-gray-300 mt-2 text-sm">
                    {{ __('ui.forgot_password_desc') }}
                </p>
            </div>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
                @csrf

                <div>
                    <x-input-label for="email" :value="__('ui.email')" />
                    <x-ui.input id="email" type="email" name="email" :value="old('email')" required autofocus class="mt-1" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <x-ui.button type="submit" class="w-full">
                    {{ __('ui.email_password_reset_link') }}
                </x-ui.button>

                <div class="text-center">
                    <a class="text-sm text-primary hover:underline" href="{{ route('login') }}">
                        {{ __('ui.back_to_login') }}
                    </a>
                </div>
            </form>
        </div>
    </x-ui.card>
</x-guest-layout>
