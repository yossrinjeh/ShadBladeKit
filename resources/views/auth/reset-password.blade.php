<x-guest-layout>
    <x-ui.card class="w-full max-w-md mx-auto">
        <div class="p-6">
            <div class="mb-6 text-center">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ __('ui.reset_password') }}</h2>
                <p class="text-gray-600 dark:text-gray-300 mt-2 text-sm">
                    {{ __('ui.reset_password_desc') }}
                </p>
            </div>

            <form method="POST" action="{{ route('password.store') }}" class="space-y-4">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div>
                    <x-input-label for="email" :value="__('ui.email')" />
                    <x-ui.input id="email" type="email" name="email" :value="old('email', $request->email)" required autofocus class="mt-1" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="password" :value="__('ui.password')" />
                    <x-ui.input id="password" type="password" name="password" required class="mt-1" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="password_confirmation" :value="__('ui.confirm_password')" />
                    <x-ui.input id="password_confirmation" type="password" name="password_confirmation" required class="mt-1" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <x-ui.button type="submit" class="w-full">
                    {{ __('ui.reset_password') }}
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
