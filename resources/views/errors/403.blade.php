<x-guest-layout>
    <x-slot name="title">{{ __('Access Forbidden') }}</x-slot>
<div class="h-screen flex items-center justify-center px-4 bg-gradient-to-br from-destructive/5 to-orange-500/5">
    <div class="max-w-md w-full text-center">
        <!-- Error Code -->
        <div class="mb-8">
            <h1 class="text-8xl md:text-9xl font-bold text-destructive/20 select-none">403</h1>
        </div>

        <!-- Icon -->
        <div class="mb-6">
            <div class="w-24 h-24 mx-auto bg-destructive/10 rounded-full flex items-center justify-center">
                <svg class="w-12 h-12 text-destructive" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
            </div>
        </div>

        <!-- Content -->
        <div class="mb-8">
            <h2 class="text-2xl md:text-3xl font-bold text-foreground mb-4">{{ __('Access Forbidden') }}</h2>
            <p class="text-muted-foreground text-sm md:text-base leading-relaxed">
                {{ __('You don\'t have permission to access this resource. Please contact your administrator if you believe this is an error.') }}
            </p>
        </div>

        <!-- Actions -->
        <div class="space-y-3">
            <x-ui.button 
                onclick="window.history.back()" 
                variant="outline" 
                class="w-full"
            >
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                {{ __('Go Back') }}
            </x-ui.button>

            <x-ui.button 
                href="{{ route('dashboard') }}" 
                class="w-full"
            >
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                {{ __('Go Home') }}
            </x-ui.button>
        </div>
    </div>
</div>
</x-guest-layout>