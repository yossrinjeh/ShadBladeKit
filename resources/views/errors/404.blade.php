<x-guest-layout>
    <x-slot name="title">{{ __('ui.page_not_found') }}</x-slot>
<div class="h-screen flex items-center justify-center px-4 bg-gradient-to-br from-primary/5 to-secondary/5">
    <div class="max-w-md w-full text-center">
        <!-- Error Code -->
        <div class="mb-8">
            <h1 class="text-8xl md:text-9xl font-bold text-primary/20 select-none">404</h1>
        </div>

        <!-- Icon -->
        <div class="mb-6">
            <div class="w-24 h-24 mx-auto bg-primary/10 rounded-full flex items-center justify-center">
                <svg class="w-12 h-12 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6-4h6m2 5.291A7.962 7.962 0 0112 15c-2.34 0-4.47-.881-6.08-2.33"></path>
                </svg>
            </div>
        </div>

        <!-- Content -->
        <div class="mb-8">
            <h2 class="text-2xl md:text-3xl font-bold text-foreground mb-4">{{ __('ui.page_not_found') }}</h2>
            <p class="text-muted-foreground text-sm md:text-base leading-relaxed">
                {{ __('ui.page_not_found_desc') }}
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
                {{ __('ui.go_back') }}
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