<x-guest-layout>
    <x-ui.card class="w-full max-w-md mx-auto">
        <div class="p-6">
            <div class="mb-6 text-center">
                <h2 class="text-2xl font-bold">Two-Factor Authentication</h2>
                <p class="text-muted-foreground mt-2">Please enter your authentication code</p>
            </div>

            <form method="POST" action="{{ route('two-factor.login') }}" class="space-y-4">
                @csrf
                
                <div x-data="{ recovery: false }">
                    <div x-show="!recovery">
                        <label class="block text-sm font-medium mb-1">Authentication Code</label>
                        <x-ui.input 
                            id="code" 
                            type="text" 
                            name="code" 
                            placeholder="Enter 6-digit code"
                            maxlength="6"
                            class="mt-1 text-center text-lg tracking-widest"
                            autofocus
                        />
                        <p class="text-xs text-muted-foreground mt-1">Enter the 6-digit code from your authenticator app</p>
                    </div>

                    <div x-show="recovery">
                        <label class="block text-sm font-medium mb-1">Recovery Code</label>
                        <x-ui.input 
                            id="recovery_code" 
                            type="text" 
                            name="recovery_code" 
                            placeholder="Enter recovery code"
                            class="mt-1 text-center text-lg tracking-widest"
                        />
                        <p class="text-xs text-muted-foreground mt-1">Enter one of your recovery codes</p>
                    </div>

                    <div class="flex items-center justify-between mt-4">
                        <button type="button" @click="recovery = !recovery" class="text-sm text-primary hover:underline">
                            <span x-show="!recovery">Use recovery code</span>
                            <span x-show="recovery">Use authentication code</span>
                        </button>
                    </div>
                </div>

                @if ($errors->any())
                    <div class="text-sm text-destructive">
                        {{ $errors->first() }}
                    </div>
                @endif

                <x-ui.button type="submit" class="w-full">
                    Verify
                </x-ui.button>
            </form>
        </div>
    </x-ui.card>
</x-guest-layout>