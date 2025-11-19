<x-guest-layout>
    <x-ui.card class="w-full max-w-md mx-auto">
        <div class="p-6">
            <div class="mb-6 text-center">
                <h2 class="text-2xl font-bold">{{ __('ui.forgot_password') }}</h2>
                <p class="text-muted-foreground mt-2 text-sm">
                    {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link.') }}
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
                    Email Password Reset Link
                </x-ui.button>

                <div class="text-center">
                    <a class="text-sm text-primary hover:underline" href="{{ route('login') }}">
                        Back to {{ __('ui.login') }}
                    </a>
                </div>
            </form>
        </div>
    </x-ui.card>
</x-guest-layout>
