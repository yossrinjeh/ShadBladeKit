<section>
    <header>
        <h2 class="text-lg font-medium">
            {{ __('Profile Avatar') }}
        </h2>
        <p class="mt-1 text-sm text-muted-foreground">
            {{ __('Upload a profile picture to personalize your account.') }}
        </p>
    </header>

    <div class="mt-6 space-y-6">
        <!-- Current Avatar -->
        <div class="flex items-center space-x-6">
            <div class="shrink-0">
                @if($user->avatar)
                    <img class="h-16 w-16 object-cover rounded-full" src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}">
                @else
                    <div class="h-16 w-16 rounded-full bg-primary flex items-center justify-center">
                        <span class="text-lg font-medium text-primary-foreground">
                            {{ substr($user->name, 0, 1) }}
                        </span>
                    </div>
                @endif
            </div>
            <div class="flex-1">
                <form method="post" action="{{ route('profile.avatar') }}" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div>
                        <x-ui.input 
                            id="avatar" 
                            name="avatar" 
                            type="file" 
                            accept="image/*"
                            class="block w-full text-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-primary-foreground hover:file:bg-primary/90"
                        />
                        <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
                        <p class="mt-1 text-xs text-muted-foreground">PNG, JPG, GIF up to 2MB</p>
                    </div>
                    <x-ui.button type="submit" size="sm">
                        {{ __('Upload Avatar') }}
                    </x-ui.button>
                </form>
            </div>
        </div>

        @if (session('status') === 'avatar-updated')
            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-green-600">
                {{ __('Avatar updated successfully.') }}
            </p>
        @endif
    </div>
</section>