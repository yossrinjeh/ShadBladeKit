@php
$languages = [
    'en' => ['name' => 'English', 'flag' => '🇺🇸'],
    'fr' => ['name' => 'Français', 'flag' => '🇫🇷'],
    'es' => ['name' => 'Español', 'flag' => '🇪🇸'],
    'ar' => ['name' => 'العربية', 'flag' => '🇸🇦']
];
$currentLocale = app()->getLocale();
@endphp

<x-dropdown align="right" width="48">
    <x-slot name="trigger">
        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-foreground bg-background hover:bg-accent focus:outline-none transition ease-in-out duration-150">
            <span class="mr-2">{{ $languages[$currentLocale]['flag'] }}</span>
            <span class="hidden sm:block">{{ $languages[$currentLocale]['name'] }}</span>
            <div class="ml-1">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </div>
        </button>
    </x-slot>

    <x-slot name="content">
        @foreach($languages as $code => $language)
            <x-dropdown-link href="{{ url('locale/' . $code) }}" class="flex items-center">
                <span class="mr-2">{{ $language['flag'] }}</span>
                {{ $language['name'] }}
            </x-dropdown-link>
        @endforeach
    </x-slot>
</x-dropdown>