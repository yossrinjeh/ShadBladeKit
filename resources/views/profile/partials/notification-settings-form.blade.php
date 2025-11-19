<section>
    <header>
        <h2 class="text-lg font-medium">
            {{ __('Notification Settings') }}
        </h2>
        <p class="mt-1 text-sm text-muted-foreground">
            {{ __('Manage how you receive notifications and updates.') }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.notifications') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        @php
            $settings = $user->notification_settings ?? [];
        @endphp

        <div class="space-y-4">
            <!-- Email Notifications -->
            <div class="flex items-center justify-between p-4 rounded-lg border border-input">
                <div class="flex items-center space-x-3">
                    <div class="p-2 rounded-lg bg-blue-100 dark:bg-blue-900/20">
                        <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <p class="font-medium">{{ __('Email Notifications') }}</p>
                        <p class="text-sm text-muted-foreground">{{ __('Receive notifications via email') }}</p>
                    </div>
                </div>
                <input 
                    type="checkbox" 
                    name="email_notifications" 
                    value="1"
                    {{ ($settings['email_notifications'] ?? true) ? 'checked' : '' }}
                    class="rounded border-input text-primary focus:ring-primary"
                >
            </div>

            <!-- Push Notifications -->
            <div class="flex items-center justify-between p-4 rounded-lg border border-input">
                <div class="flex items-center space-x-3">
                    <div class="p-2 rounded-lg bg-green-100 dark:bg-green-900/20">
                        <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM4.868 19.718A8.966 8.966 0 003 15a9 9 0 0118 0 8.966 8.966 0 00-1.868 4.718" />
                        </svg>
                    </div>
                    <div>
                        <p class="font-medium">{{ __('Push Notifications') }}</p>
                        <p class="text-sm text-muted-foreground">{{ __('Receive push notifications in browser') }}</p>
                    </div>
                </div>
                <input 
                    type="checkbox" 
                    name="push_notifications" 
                    value="1"
                    {{ ($settings['push_notifications'] ?? true) ? 'checked' : '' }}
                    class="rounded border-input text-primary focus:ring-primary"
                >
            </div>

            <!-- Marketing Emails -->
            <div class="flex items-center justify-between p-4 rounded-lg border border-input">
                <div class="flex items-center space-x-3">
                    <div class="p-2 rounded-lg bg-purple-100 dark:bg-purple-900/20">
                        <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4V2a1 1 0 011-1h8a1 1 0 011 1v2m-9 0h10m-10 0a2 2 0 00-2 2v14a2 2 0 002 2h10a2 2 0 002-2V6a2 2 0 00-2-2" />
                        </svg>
                    </div>
                    <div>
                        <p class="font-medium">{{ __('Marketing Emails') }}</p>
                        <p class="text-sm text-muted-foreground">{{ __('Receive updates about new features') }}</p>
                    </div>
                </div>
                <input 
                    type="checkbox" 
                    name="marketing_emails" 
                    value="1"
                    {{ ($settings['marketing_emails'] ?? false) ? 'checked' : '' }}
                    class="rounded border-input text-primary focus:ring-primary"
                >
            </div>

            <!-- Security Alerts -->
            <div class="flex items-center justify-between p-4 rounded-lg border border-input">
                <div class="flex items-center space-x-3">
                    <div class="p-2 rounded-lg bg-red-100 dark:bg-red-900/20">
                        <svg class="w-5 h-5 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <div>
                        <p class="font-medium">{{ __('Security Alerts') }}</p>
                        <p class="text-sm text-muted-foreground">{{ __('Important security notifications') }}</p>
                    </div>
                </div>
                <input 
                    type="checkbox" 
                    name="security_alerts" 
                    value="1"
                    {{ ($settings['security_alerts'] ?? true) ? 'checked' : '' }}
                    class="rounded border-input text-primary focus:ring-primary"
                >
            </div>
        </div>

        <div class="flex items-center gap-4">
            <x-ui.button type="submit">{{ __('ui.save') }}</x-ui.button>

            @if (session('status') === 'notifications-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-green-600">
                    {{ __('Notification settings updated.') }}
                </p>
            @endif
        </div>
    </form>
</section>