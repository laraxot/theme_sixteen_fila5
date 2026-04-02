/**
 * Sixteen Theme - App JavaScript
 * 
 * Design Comuni replicated with Tailwind CSS + Alpine.js
 * NO Bootstrap Italia - Pure Tailwind + Alpine implementation
 */

// Import Alpine.js for interactivity
import Alpine from 'alpinejs';

// Make Alpine available globally
window.Alpine = Alpine;

// Alpine.js data for modals
Alpine.data('modal', () => ({
    open: false,
    toggle() {
        this.open = !this.open;
    },
    show() {
        this.open = true;
    },
    hide() {
        this.open = false;
    }
}));

// Alpine.js data for dropdowns
Alpine.data('dropdown', () => ({
    open: false,
    toggle() {
        this.open = !this.open;
    }
}));

// Start Alpine
Alpine.start();

// Handle Bootstrap-style modals with Vanilla JS
document.addEventListener('DOMContentLoaded', function() {
    // Handle modal triggers
    document.querySelectorAll('[data-bs-toggle="modal"]').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('data-bs-target');
            const modal = document.querySelector(targetId);
            if (modal) {
                modal.classList.add('show');
                modal.style.display = 'flex';
            }
        });
    });

    // Handle modal close
    document.querySelectorAll('[data-bs-dismiss="modal"], .modal .btn-close').forEach(function(btn) {
        btn.addEventListener('click', function() {
            const modal = this.closest('.modal');
            if (modal) {
                modal.classList.remove('show');
                modal.style.display = 'none';
            }
        });
    });

    // Close modal on backdrop click
    document.querySelectorAll('.modal').forEach(function(modal) {
        modal.addEventListener('click', function(e) {
            if (e.target === this) {
                this.classList.remove('show');
                this.style.display = 'none';
            }
        });
    });
});

// Custom theme JavaScript
console.log('Sixteen theme loaded - Tailwind + Alpine.js');
