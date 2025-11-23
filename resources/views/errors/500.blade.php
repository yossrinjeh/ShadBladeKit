<x-guest-layout>
    <x-slot name="title">{{ __('ui.server_error') }}</x-slot>
<div class="h-screen flex items-center justify-center px-4 bg-gradient-to-br from-orange-500/5 to-red-500/5">
    <div class="max-w-md w-full text-center">
        <!-- Error Code -->
        <div class="mb-8">
            <h1 class="text-8xl md:text-9xl font-bold text-orange-500/20 select-none">500</h1>
        </div>

        <!-- Icon -->
        <div class="mb-6">
            <div class="w-24 h-24 mx-auto bg-orange-500/10 rounded-full flex items-center justify-center">
                <svg class="w-12 h-12 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
            </div>
        </div>

        <!-- Content -->
        <div class="mb-8">
            <h2 class="text-2xl md:text-3xl font-bold text-foreground mb-4">{{ __('ui.server_error') }}</h2>
            <p class="text-muted-foreground text-sm md:text-base leading-relaxed">
                {{ __('ui.server_error_desc') }}
            </p>
        </div>

        <!-- Actions -->
        <div class="space-y-3">
            <x-ui.button 
                onclick="window.location.reload()" 
                variant="outline" 
                class="w-full"
            >
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                </svg>
                {{ __('ui.try_again') }}
            </x-ui.button>

            <x-ui.button 
                href="{{ route('dashboard') }}" 
                class="w-full"
            >
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                {{ __('ui.go_home') }}
            </x-ui.button>
        </div>
    </div>
</div>
</x-guest-layout>