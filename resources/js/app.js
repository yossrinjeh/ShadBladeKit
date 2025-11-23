import './bootstrap';
import './components';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

// Mobile-first enhancements
document.addEventListener('DOMContentLoaded', function() {
    // Add mobile viewport meta tag if not present
    if (!document.querySelector('meta[name="viewport"]')) {
        const viewport = document.createElement('meta');
        viewport.name = 'viewport';
        viewport.content = 'width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no';
        document.head.appendChild(viewport);
    }
    
    // Prevent zoom on input focus (iOS)
    const inputs = document.querySelectorAll('input, textarea, select');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            if (window.innerWidth < 768) {
                const viewport = document.querySelector('meta[name="viewport"]');
                viewport.content = 'width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no';
            }
        });
        
        input.addEventListener('blur', function() {
            if (window.innerWidth < 768) {
                const viewport = document.querySelector('meta[name="viewport"]');
                viewport.content = 'width=device-width, initial-scale=1, maximum-scale=5, user-scalable=yes';
            }
        });
    });
    
    // Add touch feedback for buttons
    const buttons = document.querySelectorAll('button, [role="button"], a');
    buttons.forEach(button => {
        button.addEventListener('touchstart', function() {
            this.style.transform = 'scale(0.98)';
        }, { passive: true });
        
        button.addEventListener('touchend', function() {
            this.style.transform = '';
        }, { passive: true });
    });
    
    // Smooth scrolling for anchor links
    const anchorLinks = document.querySelectorAll('a[href^="#"]');
    anchorLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                e.preventDefault();
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
    
    // Add loading states to forms
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function() {
            const submitButton = this.querySelector('button[type="submit"], input[type="submit"]');
            if (submitButton) {
                submitButton.disabled = true;
                submitButton.innerHTML = `
                    <svg class="animate-spin -ml-1 mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Loading...
                `;
            }
        });
    });
    
    // Add pull-to-refresh indicator (visual only)
    let startY = 0;
    let pullDistance = 0;
    const pullThreshold = 100;
    
    document.addEventListener('touchstart', function(e) {
        if (window.scrollY === 0) {
            startY = e.touches[0].clientY;
        }
    }, { passive: true });
    
    document.addEventListener('touchmove', function(e) {
        if (window.scrollY === 0 && startY > 0) {
            pullDistance = e.touches[0].clientY - startY;
            if (pullDistance > 0) {
                document.body.style.transform = `translateY(${Math.min(pullDistance / 3, 50)}px)`;
                document.body.style.opacity = Math.max(0.8, 1 - pullDistance / 300);
            }
        }
    }, { passive: true });
    
    document.addEventListener('touchend', function() {
        if (pullDistance > pullThreshold) {
            // Show refresh indicator
            showToast('info', 'Refreshing...', 'Updating content');
            setTimeout(() => {
                window.location.reload();
            }, 500);
        }
        
        // Reset transform
        document.body.style.transform = '';
        document.body.style.opacity = '';
        startY = 0;
        pullDistance = 0;
    }, { passive: true });
    
    // Add keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        // Ctrl/Cmd + K for command palette
        if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
            e.preventDefault();
            window.dispatchEvent(new CustomEvent('toggle-command-palette'));
        }
        
        // Escape to close modals/dropdowns
        if (e.key === 'Escape') {
            const openModals = document.querySelectorAll('[x-show="true"]');
            openModals.forEach(modal => {
                if (modal.style.display !== 'none') {
                    modal.dispatchEvent(new CustomEvent('close'));
                }
            });
        }
    });
    
    // Add network status indicator
    function updateNetworkStatus() {
        if (navigator.onLine) {
            document.body.classList.remove('offline');
        } else {
            document.body.classList.add('offline');
            showToast('warning', 'No Internet', 'You are currently offline');
        }
    }
    
    window.addEventListener('online', updateNetworkStatus);
    window.addEventListener('offline', updateNetworkStatus);
    updateNetworkStatus();
    
    // Add performance monitoring
    if ('performance' in window) {
        window.addEventListener('load', function() {
            setTimeout(() => {
                const perfData = performance.getEntriesByType('navigation')[0];
                if (perfData && perfData.loadEventEnd > 5000) {
                    console.warn('Slow page load detected:', perfData.loadEventEnd + 'ms');
                }
            }, 0);
        });
    }
});

// Global utilities
window.utils = {
    // Debounce function for search inputs
    debounce: function(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    },
    
    // Format numbers for display
    formatNumber: function(num) {
        return new Intl.NumberFormat().format(num);
    },
    
    // Copy to clipboard
    copyToClipboard: async function(text) {
        try {
            await navigator.clipboard.writeText(text);
            showToast('success', 'Copied!', 'Text copied to clipboard');
        } catch (err) {
            console.error('Failed to copy:', err);
            showToast('error', 'Copy Failed', 'Could not copy to clipboard');
        }
    },
    
    // Detect mobile device
    isMobile: function() {
        return window.innerWidth < 768 || /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
    },
    
    // Get safe area insets
    getSafeAreaInsets: function() {
        const style = getComputedStyle(document.documentElement);
        return {
            top: parseInt(style.getPropertyValue('env(safe-area-inset-top)')) || 0,
            right: parseInt(style.getPropertyValue('env(safe-area-inset-right)')) || 0,
            bottom: parseInt(style.getPropertyValue('env(safe-area-inset-bottom)')) || 0,
            left: parseInt(style.getPropertyValue('env(safe-area-inset-left)')) || 0
        };
    }
};

Alpine.start();
