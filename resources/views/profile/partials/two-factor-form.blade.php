<section>
    <header>
        <h2 class="text-lg font-medium">
            Two-Factor Authentication
        </h2>
        <p class="mt-1 text-sm text-muted-foreground">
            Add additional security to your account using two-factor authentication.
        </p>
    </header>

    @if (session('status') === 'setup-ready')
        <div class="mt-4 p-4 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-md">
            <p class="text-sm text-blue-800 dark:text-blue-200">2FA setup is ready. Please scan the QR code and enter the verification code.</p>
        </div>
    @elseif (session('status') === '2fa-enabled')
        <div class="mt-4 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-md">
            <h3 class="font-medium text-green-800 dark:text-green-200">Two-Factor Authentication Enabled!</h3>
            <p class="text-sm text-green-700 dark:text-green-300 mt-1">
                Store these recovery codes in a secure password manager. They can be used to recover access to your account if your two-factor authentication device is lost.
            </p>
            <div class="mt-3 grid grid-cols-2 gap-2 font-mono text-sm">
                @foreach(session('recovery_codes') as $code)
                    <div class="bg-green-100 dark:bg-green-800 p-2 rounded text-center">{{ $code }}</div>
                @endforeach
            </div>
        </div>
    @elseif (session('status') === 'recovery-codes-regenerated')
        <div class="mt-4 p-4 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-md">
            <h3 class="font-medium text-blue-800 dark:text-blue-200">New Recovery Codes Generated</h3>
            <div class="mt-3 grid grid-cols-2 gap-2 font-mono text-sm">
                @foreach(session('recovery_codes') as $code)
                    <div class="bg-blue-100 dark:bg-blue-800 p-2 rounded text-center">{{ $code }}</div>
                @endforeach
            </div>
        </div>
    @elseif (session('status') === '2fa-disabled')
        <div class="mt-4 p-4 bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-md">
            <p class="text-sm text-yellow-800 dark:text-yellow-200">Two-factor authentication has been disabled.</p>
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
                        <h3 class="font-medium mb-2">Scan QR Code</h3>
                        <p class="text-sm text-muted-foreground mb-4">
                            Scan this QR code with your authenticator app (Google Authenticator, Authy, etc.)
                        </p>
                        <div class="flex justify-center mb-4">
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data={{ urlencode(session('two_factor_qr_code')) }}" alt="2FA QR Code" class="border rounded">
                        </div>
                        <p class="text-xs text-muted-foreground text-center">
                            Secret Key: <code class="bg-muted px-1 rounded">{{ session('two_factor_secret') }}</code>
                        </p>
                    </div>

                    <!-- Verification Form -->
                    <form method="POST" action="{{ route('two-factor.confirm') }}" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium mb-1">Verification Code</label>
                            <x-ui.input type="text" name="code" placeholder="Enter 6-digit code" maxlength="6" required />
                            <p class="text-xs text-muted-foreground mt-1">Enter the 6-digit code from your authenticator app</p>
                        </div>
                        <x-ui.button type="submit">Verify & Enable</x-ui.button>
                    </form>
                </div>
            @else
                <!-- Enable 2FA Button -->
                <form method="POST" action="{{ route('two-factor.enable') }}">
                    @csrf
                    <x-ui.button type="submit">Enable Two-Factor Authentication</x-ui.button>
                </form>
            @endif
        @else
            <!-- 2FA is Enabled -->
            <div class="space-y-4">
                <div class="flex items-center space-x-2">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="text-sm font-medium text-green-600">Two-factor authentication is enabled</span>
                </div>

                <div class="flex space-x-2">
                    <form method="POST" action="{{ route('two-factor.recovery-codes') }}">
                        @csrf
                        <x-ui.button type="submit" variant="outline" size="sm">
                            Regenerate Recovery Codes
                        </x-ui.button>
                    </form>

                    <x-ui.button onclick="openDisable2FAModal()" variant="destructive" size="sm">
                        Disable 2FA
                    </x-ui.button>
                </div>
            </div>
        @endif
    </div>

    <!-- Disable 2FA Modal -->
    <div id="disable-2fa-modal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
        <div class="bg-background rounded-lg p-6 w-full max-w-md mx-4">
            <h3 class="text-lg font-semibold mb-4">Disable Two-Factor Authentication</h3>
            <p class="text-sm text-muted-foreground mb-4">
                Please confirm your password to disable two-factor authentication.
            </p>
            <form method="POST" action="{{ route('two-factor.disable') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium mb-1">Password</label>
                    <x-ui.input type="password" name="password" required />
                </div>
                <div class="flex justify-end space-x-2">
                    <x-ui.button type="button" variant="outline" onclick="closeDisable2FAModal()">Cancel</x-ui.button>
                    <x-ui.button type="submit" variant="destructive">Disable 2FA</x-ui.button>
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