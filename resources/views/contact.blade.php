<x-guest-layout>
    <x-slot name="title">{{ __('ui.contact_us') }}</x-slot>

    <!-- Hero Section -->
    <section class="pt-24 pb-16 bg-gradient-to-br from-blue-50 to-indigo-100 dark:from-gray-900 dark:to-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl md:text-6xl font-bold text-gray-900 dark:text-white mb-6">
                    {{ __('ui.contact_us') }}
                </h1>
                <p class="text-xl text-gray-600 dark:text-gray-300 mb-8 max-w-3xl mx-auto">
                    {{ __('ui.contact_description') }}
                </p>
            </div>
        </div>
    </section>

    <!-- Contact Form Section -->
    <section class="py-16 bg-white dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl mx-auto">
                <div class="bg-gray-50 dark:bg-gray-800 p-8 rounded-xl shadow-lg">
                    @if (session('status') === 'message-sent')
                        <div class="mb-6 p-4 bg-green-100 dark:bg-green-900/20 border border-green-400 dark:border-green-600 text-green-700 dark:text-green-300 rounded-lg">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                {{ __('ui.message_sent_success') }}
                            </div>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="mb-6 p-4 bg-red-100 dark:bg-red-900/20 border border-red-400 dark:border-red-600 text-red-700 dark:text-red-300 rounded-lg">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                                {{ session('error') }}
                            </div>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('contact.send') }}" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="name" :value="__('ui.name')" />
                                <x-text-input id="name" type="text" name="name" :value="old('name')" required autofocus class="mt-1 block w-full" />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="email" :value="__('ui.email')" />
                                <x-text-input id="email" type="email" name="email" :value="old('email')" required class="mt-1 block w-full" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                        </div>

                        <div>
                            <x-input-label for="subject" :value="__('ui.subject')" />
                            <x-text-input id="subject" type="text" name="subject" :value="old('subject')" required class="mt-1 block w-full" />
                            <x-input-error :messages="$errors->get('subject')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="message" :value="__('ui.message')" />
                            <textarea id="message" name="message" rows="6" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required placeholder="{{ __('ui.message') }}...">{{ old('message') }}</textarea>
                            <x-input-error :messages="$errors->get('message')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-between pt-4">
                            <a href="{{ route('welcome') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                {{ __('ui.go_back') }}
                            </a>
                            <x-primary-button class="ml-4">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                </svg>
                                {{ __('ui.send_message') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Info Section -->
    <section class="py-16 bg-gray-50 dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">{{ __('ui.email') }}</h3>
                    <p class="text-gray-600 dark:text-gray-300">contact@yosridev.com</p>
                </div>

                <div class="text-center">
                    <div class="w-12 h-12 bg-green-100 dark:bg-green-900 rounded-lg flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">{{ __('ui.response_time') ?? 'Response Time' }}</h3>
                    <p class="text-gray-600 dark:text-gray-300">{{ __('ui.within_24_hours') ?? 'Within 24 hours' }}</p>
                </div>

                <div class="text-center">
                    <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900 rounded-lg flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">{{ __('ui.support') ?? 'Support' }}</h3>
                    <p class="text-gray-600 dark:text-gray-300">{{ __('ui.technical_help') ?? 'Technical Help & Questions' }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center mb-4">
                        @if($appSettings['logo'])
                            <img src="{{ asset('storage/' . $appSettings['logo']) }}" alt="{{ $appSettings['name'] }}" class="h-8 w-8 object-contain">
                        @else
                            <x-application-logo class="h-8 w-8" />
                        @endif
                        <span class="ml-2 text-xl font-bold">{{ $appSettings['name'] }}</span>
                    </div>
                    <p class="text-gray-400 mb-4">
                        {{ __('welcome.production_ready_with_features', ['app' => $appSettings['name']]) }}
                    </p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">{{ __('welcome.features') }}</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li>{{ __('welcome.authentication') }}</li>
                        <li>{{ __('welcome.user_management') }}</li>
                        <li>{{ __('welcome.analytics') }}</li>
                        <li>{{ __('welcome.multilingual') }}</li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">{{ __('welcome.resources') }}</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white">{{ __('welcome.documentation') }}</a></li>
                        <li><a href="https://github.com/yossrinjeh/ShadBladeKit" class="hover:text-white">{{ __('welcome.github') }}</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-white">{{ __('ui.contact_us') }}</a></li>
                        <li><a href="#" class="hover:text-white">{{ __('welcome.license') }}</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} {{ $appSettings['name'] }}. {{ __('welcome.made_with_love_by') }}</p>
            </div>
        </div>
    </footer>
</x-guest-layout>