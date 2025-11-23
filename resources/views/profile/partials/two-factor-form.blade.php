<section>
    <header>
        <h2 class="text-lg font-medium">
            {{ __('ui.two_factor_authentication') }}
        </h2>
        <p class="mt-1 text-sm text-muted-foreground">
            {{ __('ui.two_factor_description') }}
        </p>
    </header>

    @if (session('status') === 'setup-ready')
        <div class="mt-4 p-4 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-md">
            <p class="text-sm text-blue-800 dark:text-blue-200">{{ __('ui.two_factor_setup_ready') }}</p>
        </div>
    @elseif (session('status') === '2fa-enabled')
        <div class="mt-4 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-md">
            <h3 class="font-medium text-green-800 dark:text-green-200">{{ __('ui.two_factor_enabled') }}</h3>
            <p class="text-sm text-green-700 dark:text-green-300 mt-1">
                {{ __('ui.recovery_codes_message') }}
            </p>
            <div class="mt-3 grid grid-cols-2 gap-2 font-mono text-sm">
                @foreach(session('recovery_codes') as $code)
                    <div class="bg-green-100 dark:bg-green-800 p-2 rounded text-center">{{ $code }}</div>
                @endforeach
            </div>
        </div>
    @elseif (session('status') === 'recovery-codes-regenerated')
        <div class="mt-4 p-4 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-md">
            <h3 class="font-medium text-blue-800 dark:text-blue-200">{{ __('ui.new_recovery_codes_generated') }}</h3>
            <div class="mt-3 grid grid-cols-2 gap-2 font-mono text-sm">
                @foreach(session('recovery_codes') as $code)
                    <div class="bg-blue-100 dark:bg-blue-800 p-2 rounded text-center">{{ $code }}</div>
                @endforeach
            </div>
        </div>
    @elseif (session('status') === '2fa-disabled')
        <div class="mt-4 p-4 bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-md">
            <p class="text-sm text-yellow-800 dark:text-yellow-200">{{ __('ui.two_factor_disabled') }}</p>
        </div>
    @endif

    @if (session('error'))
        <div class="mt-4 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-md">
            <p class="text-sm text-red-800 dark:text-red-200">{{ session('error') }}</p>
        </div>
    @endif

    <div class="mt-6">
        @if (!$user->hasTwoFactorEnabled())
            @if (session('two_factor_secret'))
                <!-- Show QR Code for Setup -->
                <div class="space-y-4">
                    <div class="p-4 border rounded-md">
                        <h3 class="font-medium mb-2">{{ __('ui.scan_qr_code_title') }}</h3>
                        <p class="text-sm text-muted-foreground mb-4">
                            {{ __('ui.scan_qr_code_description') }}
                        </p>
                        <div class="flex justify-center mb-4">
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data={{ urlencode(session('two_factor_qr_code')) }}" alt="2FA QR Code" class="border rounded">
                        </div>
                        <p class="text-xs text-muted-foreground text-center">
                            {{ __('ui.secret_key') }}: <code class="bg-muted px-1 rounded">{{ session('two_factor_secret') }}</code>
                        </p>
                    </div>

                    <!-- Verification Form -->
                    <form method="POST" action="{{ route('two-factor.confirm') }}" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium mb-1">{{ __('ui.verification_code_label') }}</label>
                            <x-ui.input type="text" name="code" placeholder="{{ __('ui.enter_6_digit_code') }}" maxlength="6" required />
                            <p class="text-xs text-muted-foreground mt-1">{{ __('ui.enter_code_from_app') }}</p>
                        </div>
                        <x-ui.button type="submit">{{ __('ui.verify_and_enable') }}</x-ui.button>
                    </form>
                </div>
            @else
                <!-- Enable 2FA Button -->
                <form method="POST" action="{{ route('two-factor.enable') }}">
                    @csrf
                    <x-ui.button type="submit">{{ __('ui.enable_two_factor_authentication') }}</x-ui.button>
                </form>
            @endif
        @else
            <!-- 2FA is Enabled -->
            <div class="space-y-4">
                <div class="flex items-center space-x-2">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="text-sm font-medium text-green-600">{{ __('ui.two_factor_is_enabled') }}</span>
                </div>

                <div class="flex space-x-2">
                    <form method="POST" action="{{ route('two-factor.recovery-codes') }}">
                        @csrf
                        <x-ui.button type="submit" variant="outline" size="sm">
                            {{ __('ui.regenerate_recovery_codes') }}
                        </x-ui.button>
                    </form>

                    <x-ui.button onclick="openDisable2FAModal()" variant="destructive" size="sm">
                        {{ __('ui.disable_2fa') }}
                    </x-ui.button>
                </div>
            </div>
        @endif
    </div>

    <!-- Disable 2FA Modal -->
    <div id="disable-2fa-modal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
        <div class="bg-background rounded-lg p-6 w-full max-w-md mx-4">
            <h3 class="text-lg font-semibold mb-4">{{ __('ui.disable_two_factor_title') }}</h3>
            <p class="text-sm text-muted-foreground mb-4">
                {{ __('ui.disable_two_factor_message') }}
            </p>
            <form method="POST" action="{{ route('two-factor.disable') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium mb-1">{{ __('ui.password') }}</label>
                    <x-ui.input type="password" name="password" required />
                </div>
                <div class="flex justify-end space-x-2">
                    <x-ui.button type="button" variant="outline" onclick="closeDisable2FAModal()">{{ __('ui.cancel') }}</x-ui.button>
                    <x-ui.button type="submit" variant="destructive">{{ __('ui.disable_2fa') }}</x-ui.button>
                </div>
            </form>
        </div>
    </div>
</section>

<script>
function openDisable2FAModal() {
    document.getElementById('disable-2fa-modal').classList.remove('hidden');
    document.getElementById('disable-2fa-modal').classList.add('flex');
}

function closeDisable2FAModal() {
    document.getElementById('disable-2fa-modal').classList.add('hidden');
    document.getElementById('disable-2fa-modal').classList.remove('flex');
}
</script>