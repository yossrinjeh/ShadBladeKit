<!-- Toast Container -->
<div id="toast-container" 
     class="fixed top-4 right-4 z-[100] space-y-2 max-w-sm w-full pointer-events-none"
     x-data="toastManager()"
     @toast.window="addToast($event.detail)">
     
    <template x-for="toast in toasts" :key="toast.id">
        <div x-show="true"
             x-transition:enter="transform ease-out duration-300 transition"
             x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
             x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
             x-transition:leave="transition ease-in duration-100"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="pointer-events-auto w-full max-w-sm overflow-hidden rounded-xl border shadow-lg backdrop-blur-sm"
             :class="getToastClasses(toast.type)">
            
            <div class="p-4">
                <div class="flex items-start">
                    <div class="flex-shrink-0" x-html="getToastIcon(toast.type)"></div>
                    
                    <div class="ml-3 w-0 flex-1">
                        <p class="text-sm font-medium" x-text="toast.title"></p>
                        <p class="mt-1 text-sm opacity-90" x-text="toast.message"></p>
                    </div>
                    
                    <div class="ml-4 flex flex-shrink-0">
                        <button @click="removeToast(toast.id)"
                                class="inline-flex rounded-md hover:opacity-75 focus:outline-none focus:ring-2 focus:ring-offset-2">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </template>
</div>

<script>
function toastManager() {
    return {
        toasts: [],
        
        addToast(toast) {
            const id = Date.now() + Math.random();
            const newToast = {
                id,
                type: toast.type || 'info',
                title: toast.title || '',
                message: toast.message || '',
                duration: toast.duration || 5000,
                actions: toast.actions || []
            };
            
            this.toasts.push(newToast);
            
            // Auto remove after duration
            if (newToast.duration > 0) {
                setTimeout(() => {
                    this.removeToast(id);
                }, newToast.duration);
            }
        },
        
        removeToast(id) {
            const index = this.toasts.findIndex(toast => toast.id === id);
            if (index > -1) {
                this.toasts.splice(index, 1);
            }
        },
        
        getToastIcon(type) {
            const icons = {
                success: `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>`,
                error: `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>`,
                warning: `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>`,
                info: `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>`
            };
            return icons[type] || icons.info;
        },
        
        getToastClasses(type) {
            const classes = {
                success: 'bg-green-50 border-green-200 text-green-800 dark:bg-green-900/20 dark:border-green-800 dark:text-green-200',
                error: 'bg-red-50 border-red-200 text-red-800 dark:bg-red-900/20 dark:border-red-800 dark:text-red-200',
                warning: 'bg-amber-50 border-amber-200 text-amber-800 dark:bg-amber-900/20 dark:border-amber-800 dark:text-amber-200',
                info: 'bg-blue-50 border-blue-200 text-blue-800 dark:bg-blue-900/20 dark:border-blue-800 dark:text-blue-200'
            };
            return classes[type] || classes.info;
        }
    }
}

// Global toast function
window.showToast = function(type, title, message, options = {}) {
    window.dispatchEvent(new CustomEvent('toast', {
        detail: {
            type,
            title,
            message,
            ...options
        }
    }));
};
</script>

