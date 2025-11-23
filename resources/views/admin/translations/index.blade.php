<x-app-layout>
    <div class="space-y-6">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold text-foreground">Translation Management</h1>
        </div>

        @if(session('success'))
            <div class="bg-accent/20 border border-accent text-accent-foreground px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        @endif
        
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
                {{ session('error') }}
            </div>
        @endif
        
        @if(isset($message))
            <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded-lg">
                🔄 {{ $message }}
            </div>
        @endif

        <div x-data="{ 
            activeTab: window.location.hash.substring(1) || 'en',
            init() {
                this.$watch('activeTab', value => {
                    window.location.hash = value;
                });
            }
        }" class="space-y-4">
            <!-- Language Tabs -->
            <div class="border-b border-border">
                <nav class="-mb-px flex space-x-8">
                    @foreach(['en' => 'English', 'fr' => 'Français', 'es' => 'Español', 'ar' => 'العربية'] as $code => $name)
                        <button @click="activeTab = '{{ $code }}'; window.location.hash = '{{ $code }}'" 
                                :class="activeTab === '{{ $code }}' ? 'border-primary text-primary' : 'border-transparent text-muted-foreground hover:text-foreground hover:border-border'"
                                class="whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm transition-colors">
                            {{ $name }}
                        </button>
                    @endforeach
                </nav>
            </div>

            <!-- Translation Forms -->
            @foreach(['en', 'fr', 'es', 'ar'] as $locale)
                <div x-show="activeTab === '{{ $locale }}'" class="space-y-4">
                    @if(isset($translations[$locale]))
                        @foreach($translations[$locale] as $file => $trans)
                            <div class="bg-card rounded-lg border border-border p-4">
                                <div class="flex justify-between items-center mb-3">
                                    <h3 class="text-lg font-semibold text-card-foreground capitalize">{{ $file }}.php</h3>
                                    @if($locale !== 'en')
                                        <div class="flex gap-2">
                                            @if($loop->first)
                                                <button id="translate-all-{{ $locale }}" onclick="translateAllFiles('{{ $locale }}', this)" class="bg-gradient-to-r from-primary to-primary/90 hover:from-primary/90 hover:to-primary/80 text-white px-3 py-1.5 text-sm rounded-md shadow-lg shadow-primary/25 hover:shadow-primary/30 transition-all duration-200">
                                                    <span class="translate-all-text">🌍 Translate All</span>
                                                    <span class="translate-all-loading hidden flex items-center">
                                                        <svg class="animate-spin -ml-1 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24">
                                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                        </svg>
                                                        Translating All...
                                                    </span>
                                                </button>
                                            @endif
                                            <button id="translate-{{ $locale }}-{{ $file }}" onclick="translateFile('{{ $locale }}', '{{ $file }}', this)" class="bg-gradient-to-r from-primary to-primary/90 hover:from-primary/90 hover:to-primary/80 text-white px-3 py-1.5 text-sm rounded-md shadow-lg shadow-primary/25 hover:shadow-primary/30 transition-all duration-200">
                                                <span class="translate-text">🤖 AI Translate</span>
                                                <span class="translate-loading hidden flex items-center">
                                                    <svg class="animate-spin -ml-1 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24">
                                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 714 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                    </svg>
                                                    Translating...
                                                </span>
                                            </button>
                                        </div>
                                    @endif
                                </div>
                                
                                <form method="POST" action="{{ route('translations.update') }}">
                                    @csrf
                                    <input type="hidden" name="locale" value="{{ $locale }}">
                                    <input type="hidden" name="file" value="{{ $file }}">
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3 mb-4">
                                        @foreach($trans as $key => $value)
                                            @if(is_array($value))
                                                @foreach($value as $subKey => $subValue)
                                                    <div class="space-y-1">
                                                        <label class="text-xs font-medium text-muted-foreground">{{ $key }}.{{ $subKey }}</label>
                                                        <input type="text" 
                                                               name="translations[{{ $key }}][{{ $subKey }}]" 
                                                               value="{{ is_array($subValue) ? json_encode($subValue) : $subValue }}" 
                                                               class="w-full h-8 px-2 text-sm rounded-md border border-input bg-background text-foreground focus:border-primary focus:ring-1 focus:ring-primary">
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="space-y-1">
                                                    <label class="text-xs font-medium text-muted-foreground">{{ $key }}</label>
                                                    <input type="text" 
                                                           name="translations[{{ $key }}]" 
                                                           value="{{ is_array($value) ? json_encode($value) : $value }}" 
                                                           class="w-full h-8 px-2 text-sm rounded-md border border-input bg-background text-foreground focus:border-primary focus:ring-1 focus:ring-primary">
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    
                                    <div class="flex justify-end">
                                        <button type="submit" class="bg-gradient-to-r from-primary to-primary/90 hover:from-primary/90 hover:to-primary/80 text-white px-3 py-1.5 text-sm rounded-md shadow-lg shadow-primary/25 hover:shadow-primary/30 transition-all duration-200">
                                            Update {{ ucfirst($file) }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        @endforeach
                    @endif
                </div>
            @endforeach
        </div>
    </div>
    
    <script>
    function translateFile(locale, file, button) {
        // Show loading state
        button.disabled = true;
        button.querySelector('.translate-text').classList.add('hidden');
        button.querySelector('.translate-loading').classList.remove('hidden');
        
        fetch('{{ route('translations.ai-translate') }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ locale: locale, file: file })
        })
        .then(response => response.json())
        .then(data => {
            // Reset button state
            button.disabled = false;
            button.querySelector('.translate-text').classList.remove('hidden');
            button.querySelector('.translate-loading').classList.add('hidden');
            
            if (data.success) {
                // Show toast
                showToast('✅ Translation completed and saved!', 'success');
                // Refresh page after short delay
                setTimeout(() => {
                    window.location.reload();
                }, 1500);
            } else {
                showToast('❌ Translation failed: ' + data.message, 'error');
            }
        })
        .catch(error => {
            // Reset button state
            button.disabled = false;
            button.querySelector('.translate-text').classList.remove('hidden');
            button.querySelector('.translate-loading').classList.add('hidden');
            
            console.error('Error:', error);
            showToast('❌ Error occurred', 'error');
        });
    }
    
    function translateAllFiles(locale, button) {
        // Show loading state
        button.disabled = true;
        button.querySelector('.translate-all-text').classList.add('hidden');
        button.querySelector('.translate-all-loading').classList.remove('hidden');
        
        fetch('{{ route('translations.ai-translate-all') }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ locale: locale })
        })
        .then(response => response.json())
        .then(data => {
            // Reset button state
            button.disabled = false;
            button.querySelector('.translate-all-text').classList.remove('hidden');
            button.querySelector('.translate-all-loading').classList.add('hidden');
            
            if (data.success) {
                showToast(`✅ All ${data.files.length} files translated successfully!`, 'success');
                setTimeout(() => {
                    window.location.reload();
                }, 2000);
            } else {
                showToast('❌ Translation failed: ' + data.error, 'error');
            }
        })
        .catch(error => {
            // Reset button state
            button.disabled = false;
            button.querySelector('.translate-all-text').classList.remove('hidden');
            button.querySelector('.translate-all-loading').classList.add('hidden');
            
            console.error('Error:', error);
            showToast('❌ Error occurred', 'error');
        });
    }
    
    function showToast(message, type) {
        const toast = document.createElement('div');
        toast.className = `fixed top-4 right-4 px-4 py-3 rounded-lg text-white z-50 transition-all duration-300 ${
            type === 'success' ? 'bg-green-500' : 'bg-red-500'
        }`;
        toast.textContent = message;
        document.body.appendChild(toast);
        
        setTimeout(() => {
            toast.classList.add('opacity-0', 'translate-x-full');
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    }
    </script>
</x-app-layout>