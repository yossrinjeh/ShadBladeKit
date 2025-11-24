<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('ui.profile') }}
        </h2>
    </x-slot>

    <div class="space-y-6">
        <!-- Profile Information -->
        <x-ui.card id="profile-information">
            <div class="p-6">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>
        </x-ui.card>

        <!-- Avatar Upload -->
        <x-ui.card id="avatar">
            <div class="p-6">
                <div class="max-w-xl">
                    @include('profile.partials.update-avatar-form')
                </div>
            </div>
        </x-ui.card>

        <!-- Preferences -->
        <x-ui.card id="preferences">
            <div class="p-6">
                <div class="max-w-xl">
                    @include('profile.partials.preferences-form')
                </div>
            </div>
        </x-ui.card>

        <!-- Notification Settings -->
        <x-ui.card id="notifications">
            <div class="p-6">
                <div class="max-w-xl">
                    @include('profile.partials.notification-settings-form')
                </div>
            </div>
        </x-ui.card>

        <!-- Password Update -->
        <x-ui.card id="password">
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
        <x-ui.card id="delete-account">
            <div class="p-6">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </x-ui.card>
    </div>

    <script>
        // Smooth scroll to section if URL has fragment
        document.addEventListener('DOMContentLoaded', function() {
            if (window.location.hash) {
                const element = document.querySelector(window.location.hash);
                if (element) {
                    setTimeout(() => {
                        element.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    }, 100);
                }
            }
        });
    </script>
</x-app-layout>
