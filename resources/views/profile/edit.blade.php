<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('ui.profile') }}
        </h2>
    </x-slot>

    <div class="space-y-6">
        <x-ui.card>
            <div class="p-6">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>
        </x-ui.card>

        <x-ui.card>
            <div class="p-6">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
        </x-ui.card>

        <x-ui.card id="two-factor">
            <div class="p-6">
                <div class="max-w-xl">
                    @include('profile.partials.two-factor-form')
                </div>
            </div>
        </x-ui.card>

        <x-ui.card>
            <div class="p-6">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </x-ui.card>
    </div>
</x-app-layout>
