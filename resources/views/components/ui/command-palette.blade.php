@props([
    'shortcuts' => []
])

<div 
    x-data="commandPalette()" 
    x-show="isOpen" 
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-50 overflow-y-auto"
    @keydown.escape.window="close()"
    @keydown.cmd.k.window.prevent="toggle()"
    @keydown.ctrl.k.window.prevent="toggle()"
    style="display: none;"
>
    <div class="flex min-h-screen items-start justify-center p-4 pt-16">
        <div class="fixed inset-0 bg-black/50" @click="close()"></div>
        
        <div class="relative w-full max-w-lg bg-background rounded-lg shadow-xl">
            <!-- Search Input -->
            <div class="flex items-center border-b px-4">
                <svg class="h-5 w-5 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input 
                    x-ref="searchInput"
                    x-model="query"
                    @input="search()"
                    @keydown.arrow-down.prevent="selectNext()"
                    @keydown.arrow-up.prevent="selectPrevious()"
                    @keydown.enter.prevent="executeSelected()"
                    type="text" 
                    placeholder="{{ __('navigation.search_placeholder') }}"
                    class="w-full border-0 bg-transparent py-4 pl-4 pr-4 text-sm focus:outline-none focus:ring-0"
                />
            </div>
            
            <!-- Results -->
            <div class="max-h-96 overflow-y-auto p-2">
                <template x-for="(item, index) in filteredItems" :key="index">
                    <div 
                        @click="execute(item)"
                        @mouseenter="selectedIndex = index"
                        :class="{ 'bg-accent': selectedIndex === index }"
                        class="flex items-center space-x-3 rounded-md px-3 py-2 cursor-pointer hover:bg-accent"
                    >
                        <div class="flex-shrink-0">
                            <svg class="h-4 w-4 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path x-show="item.type === 'page'" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                <path x-show="item.type === 'action'" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                <path x-show="item.type === 'user'" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                <path x-show="item.type === 'setting'" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium" x-text="item.title"></p>
                            <p class="text-xs text-muted-foreground" x-text="item.description"></p>
                        </div>
                        <div x-show="item.shortcut" class="flex-shrink-0">
                            <kbd class="inline-flex items-center rounded border bg-muted px-1.5 py-0.5 text-xs font-mono text-muted-foreground" x-text="item.shortcut"></kbd>
                        </div>
                    </div>
                </template>
                
                <div x-show="filteredItems.length === 0 && query" class="px-3 py-8 text-center text-sm text-muted-foreground">
                    {{ __('navigation.no_results') }} "<span x-text="query"></span>"
                </div>
            </div>
            
            <!-- Footer -->
            <div class="border-t px-4 py-2 text-xs text-muted-foreground">
                <div class="flex items-center justify-between">
                    <span>{{ __('navigation.navigate_arrows') }}</span>
                    <span>{{ __('navigation.press_enter') }} <kbd class="rounded bg-muted px-1">Enter</kbd></span>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function commandPalette() {
    return {
        isOpen: false,
        query: '',
        selectedIndex: 0,
        filteredItems: [],
        
        items: [
            { title: '{{ __('navigation.dashboard') }}', description: '{{ __('navigation.go_to_dashboard') }}', type: 'page', url: '/dashboard', shortcut: 'Ctrl+D' },
            { title: '{{ __('navigation.users') }}', description: '{{ __('navigation.manage_users') }}', type: 'page', url: '/users', shortcut: 'Ctrl+U' },
            { title: '{{ __('navigation.settings') }}', description: '{{ __('navigation.application_settings') }}', type: 'setting', url: '/settings', shortcut: 'Ctrl+,' },
            { title: '{{ __('navigation.profile') }}', description: '{{ __('navigation.edit_your_profile') }}', type: 'user', url: '/profile', shortcut: 'Ctrl+P' },
            { title: '{{ __('ui.create_user') }}', description: '{{ __('navigation.add_new_user') }}', type: 'action', action: 'createUser' },
            { title: '{{ __('ui.theme') }}', description: '{{ __('navigation.toggle_theme_desc') }}', type: 'action', action: 'toggleTheme', shortcut: 'Ctrl+T' },
            { title: '{{ __('ui.logout') }}', description: '{{ __('navigation.sign_out_account') }}', type: 'action', action: 'logout' }
        ],
        
        init() {
            this.filteredItems = this.items;
        },
        
        toggle() {
            if (this.isOpen) {
                this.close();
            } else {
                this.open();
            }
        },
        
        open() {
            this.isOpen = true;
            this.query = '';
            this.selectedIndex = 0;
            this.filteredItems = this.items;
            this.$nextTick(() => {
                this.$refs.searchInput.focus();
            });
        },
        
        close() {
            this.isOpen = false;
            this.query = '';
            this.selectedIndex = 0;
        },
        
        search() {
            if (!this.query) {
                this.filteredItems = this.items;
                return;
            }
            
            this.filteredItems = this.items.filter(item => 
                item.title.toLowerCase().includes(this.query.toLowerCase()) ||
                item.description.toLowerCase().includes(this.query.toLowerCase())
            );
            this.selectedIndex = 0;
        },
        
        selectNext() {
            this.selectedIndex = Math.min(this.selectedIndex + 1, this.filteredItems.length - 1);
        },
        
        selectPrevious() {
            this.selectedIndex = Math.max(this.selectedIndex - 1, 0);
        },
        
        executeSelected() {
            if (this.filteredItems[this.selectedIndex]) {
                this.execute(this.filteredItems[this.selectedIndex]);
            }
        },
        
        execute(item) {
            if (item.url) {
                window.location.href = item.url;
            } else if (item.action) {
                this.executeAction(item.action);
            }
            this.close();
        },
        
        executeAction(action) {
            switch (action) {
                case 'toggleTheme':
                    // Call theme toggle function
                    if (window.toggleTheme) {
                        window.toggleTheme();
                    }
                    break;
                case 'createUser':
                    // Open create user modal
                    if (window.openCreateModal) {
                        window.openCreateModal();
                    }
                    break;
                case 'logout':
                    // Logout user
                    document.querySelector('form[action*="logout"]')?.submit();
                    break;
            }
        }
    }
}
</script>