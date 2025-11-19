<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('ui.profile') }}
        </h2>
    </x-slot>

    <div class="space-y-6">
        <!-- Profile Information -->
        <x-ui.card>
            <div class="p-6">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>
        </x-ui.card>

        <!-- Avatar Upload -->
        <x-ui.card>
            <div class="p-6">
                <div class="max-w-xl">
                    @include('profile.partials.update-avatar-form')
                </div>
            </div>
        </x-ui.card>

        <!-- Preferences -->
        <x-ui.card>
            <div class="p-6">
                <div class="max-w-xl">
                    @include('profile.partials.preferences-form')
                </div>
            </div>
        </x-ui.card>

        <!-- Notification Settings -->
        <x-ui.card>
            <div class="p-6">
                <div class="max-w-xl">
                    @include('profile.partials.notification-settings-form')
                </div>
            </div>
        </x-ui.card>

        <!-- Password Update -->
        <x-ui.card>
            <div class="p-6">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
        </x-ui.card>

        <!-- Two-Factor Authentication -->
        <x-ui.card id="two-factor">
            <div class="p-6">
                <div class="max-w-xl">
                    @include('profile.partials.two-factor-form')
                </div>
            </div>
        </x-ui.card>

        <!-- Delete Account -->
        <x-ui.card>
            <div class="p-6">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </x-ui.card>
    </div>
</x-app-layout>
