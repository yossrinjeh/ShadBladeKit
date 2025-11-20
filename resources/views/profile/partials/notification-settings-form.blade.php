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

        <div class="space-y-4" >
            <!-- Email Notifications -->
            <div class="flex items-center justify-between p-4 rounded-lg border border-input">
                <div class="flex items-center space-x-3">
                    <div class="p-3 rounded-xl bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900/30 dark:to-blue-800/30 flex items-center justify-center shadow-sm">
                        <svg class="w-5 h-5 " fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
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
                    <div class="p-3 rounded-xl bg-gradient-to-br from-green-50 to-green-100 dark:from-green-900/30 dark:to-green-800/30 flex items-center justify-center shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
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
                    <div class="p-3 rounded-xl bg-gradient-to-br from-purple-50 to-purple-100 dark:from-purple-900/30 dark:to-purple-800/30 flex items-center justify-center shadow-sm">
                        <svg class="w-5 h-5 " fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
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
                    <div class="p-3 rounded-xl bg-gradient-to-br from-red-50 to-red-100 dark:from-red-900/30 dark:to-red-800/30 flex items-center justify-center shadow-sm">
                        <svg class="w-5 h-5 " fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
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