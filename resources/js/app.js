/**
 * Sixteen Theme - App JavaScript
 *
 * Design Comuni replicated with Tailwind CSS + Alpine.js
 * NO Bootstrap Italia - Pure Tailwind + Alpine implementation
 *
 * CRITICAL: Livewire/Filament already loads Alpine.js.
 * We must NOT create a second instance. Only extend the existing one.
 *
 * Dark mode: boot anti-FOUC in layouts/main.blade.php (head); logica toggle in theme/dark-mode.js.
 */

import '@splidejs/splide/dist/css/splide.min.css';
import '@theme-leaflet-css';
import { initDarkModeToggle, toggleDarkMode } from './theme/dark-mode.js';
import focus from '@alpinejs/focus';
import { dropdownToggle } from './components/dropdown';
import { modal } from './components/modal';
import { mobileMenu } from './components/mobile-menu';
import { governanceCarousel } from './components/carousel';
import './components/bootstrap-italia.js';
import { initHeaderMobileNav } from './theme/header-mobile-nav.js';
import '@modules/Geo/resources/js/components/map-lit.js';
import '@modules/Geo/resources/js/components/map-filter-lit.js';
import '@modules/Geo/resources/js/components/coordinate-picker-lit.js';
// DISABLED: domande-frequenti-parity.js was overriding blade template HTML with JS-generated structure
// Now using blade template directly with Alpine.js for accordion
// import { domandeFrequentiParity } from './domande-frequenti-parity';

/**
 * Register theme Alpine components onto Livewire/Filament’s Alpine bundle.
 *
 * IMPORTANT: questo file e' un ES module (defer). Il markup iniziale non deve
 * dipendere da Alpine.data registrati qui; l'header usa il controller
 * data-sixteen-mobile-nav importato in questo bundle Vite.
 *
 * @param {object} AlpineInstance
 */
function registerAlpineComponents(AlpineInstance) {
    if (!AlpineInstance || document.documentElement.hasAttribute('data-sixteen-alpine-components')) {
        return;
    }

    AlpineInstance.plugin(focus);

    AlpineInstance.data('dropdownToggle', dropdownToggle);
    AlpineInstance.data('modal', modal);
    AlpineInstance.data('mobileMenu', mobileMenu);
    AlpineInstance.data('governanceCarousel', governanceCarousel);

    AlpineInstance.data('dropdown', () => ({
        open: false,
        toggle() {
            this.open = !this.open;
        },
    }));

    // Work around Alpine 3.15.x object-literal issues inside inline x-data.
    AlpineInstance.data('accordionItem', () => ({ open: false }));
    AlpineInstance.data('ratingInline', () => ({ rating: 0, hover: 0 }));

    AlpineInstance.data('segnalazioniLayout', () => ({
        activeTab: 'map',
        showModal: false,
        showFilterModal: false,
    }));

    // Dark mode — state + toggle (persistito in localStorage)
    AlpineInstance.data('darkMode', () => ({
        isDark: document.documentElement.classList.contains('dark'),
        toggle() {
            toggleDarkMode();
            this.isDark = document.documentElement.classList.contains('dark');
        },
    }));

    document.documentElement.setAttribute('data-sixteen-alpine-components', 'true');
}

if (window.Alpine) {
    registerAlpineComponents(window.Alpine);
} else {
    document.addEventListener('alpine:init', () => {
        registerAlpineComponents(window.Alpine);
    }, { once: true });
}

initHeaderMobileNav();

// Scope modulo — disponibili a initHeaderDropdowns e ai listener globali (ESC, click esterno)
function closeDropdownMenu(menu) {
    if (!menu) { return; }
    menu.classList.remove('show');
    menu.style.removeProperty('display');
    const openDropdown = menu.closest('.dropdown');
    openDropdown?.classList.remove('is-open');
    openDropdown?.querySelector('[data-bs-toggle="dropdown"]')?.setAttribute('aria-expanded', 'false');
}

function openDropdownMenu(menu, dropdown, toggle) {
    if (!menu || !toggle) { return; }
    menu.classList.add('show');
    menu.style.removeProperty('display');
    dropdown?.classList.add('is-open');
    toggle.setAttribute('aria-expanded', 'true');
}

// Re-aggancia i listener dopo ogni DOM morph di Livewire 4
function initHeaderDropdowns() {
    document.querySelectorAll('[data-bs-toggle="dropdown"]').forEach(function(toggle) {
        if (toggle._headerDropdownInit) { return; }
        toggle._headerDropdownInit = true;

        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            const dropdown = this.closest('.dropdown');
            const menu = dropdown?.querySelector('.dropdown-menu');
            const willOpen = menu ? !menu.classList.contains('show') : false;

            document.querySelectorAll('.dropdown-menu.show').forEach(function(openMenu) {
                if (openMenu !== menu) { closeDropdownMenu(openMenu); }
            });

            if (menu) {
                willOpen ? openDropdownMenu(menu, dropdown, this) : closeDropdownMenu(menu);
            }
        });
    });

    document.querySelectorAll('.dropdown-menu').forEach(function(menu) {
        if (menu._headerDropdownMenuInit) { return; }
        menu._headerDropdownMenuInit = true;
        menu.addEventListener('click', function(e) { e.stopPropagation(); });
    });
}

document.addEventListener('DOMContentLoaded', initHeaderDropdowns);
document.addEventListener('livewire:navigated', initHeaderDropdowns);
document.addEventListener('livewire:update', initHeaderDropdowns);

document.addEventListener('DOMContentLoaded', initDarkModeToggle);
document.addEventListener('livewire:navigated', initDarkModeToggle);
document.addEventListener('DOMContentLoaded', initHeaderMobileNav);
document.addEventListener('livewire:navigated', initHeaderMobileNav);
document.addEventListener('livewire:update', initHeaderMobileNav);

document.addEventListener('DOMContentLoaded', function() {
    const closeModal = function(modal) {
        if (!modal) {
            return;
        }

        modal.classList.remove('show');
        modal.style.display = 'none';
        document.body.style.overflow = '';
    };

    const openModal = function(modal) {
        if (!modal) {
            return;
        }

        modal.classList.add('show');
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    };

    document.querySelectorAll('[data-bs-toggle="modal"]').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('data-bs-target');
            const modal = document.querySelector(targetId);

            if (!modal) {
                return;
            }

            if (modal.classList.contains('show')) {
                closeModal(modal);
            } else {
                openModal(modal);
            }
        });
    });

    document.querySelectorAll('[data-bs-dismiss="modal"], .modal .btn-close').forEach(function(btn) {
        btn.addEventListener('click', function() {
            closeModal(this.closest('.modal'));
        });
    });

    document.querySelectorAll('.modal').forEach(function(modal) {
        modal.addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal(this);
            }
        });
    });

    document.addEventListener('click', function(e) {
        const target = e.target;
        if (target instanceof Element) {
            if (target.closest('[data-bs-toggle="dropdown"]') || target.closest('.dropdown-menu')) {
                return;
            }
        }

        document.querySelectorAll('.dropdown-menu.show').forEach(function(openMenu) {
            closeDropdownMenu(openMenu);
        });
    });

    document.addEventListener('keydown', function(e) {
        if (e.key !== 'Escape') {
            return;
        }

        document.querySelectorAll('.dropdown-menu.show').forEach(function(openMenu) {
            closeDropdownMenu(openMenu);
        });

        document.querySelectorAll('.modal.show').forEach(function(modal) {
            closeModal(modal);
        });
    });
});

document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('[data-bs-toggle="collapse"]').forEach(function(toggle) {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();

            const targetId = this.getAttribute('data-bs-target');
            const panel = targetId ? document.querySelector(targetId) : null;

            if (!panel) {
                return;
            }

            const parentSelector = panel.getAttribute('data-bs-parent');
            const isOpen = panel.classList.contains('show');

            if (parentSelector) {
                document.querySelectorAll(parentSelector + ' .accordion-collapse.show').forEach(function(openPanel) {
                    if (openPanel !== panel) {
                        openPanel.classList.remove('show');
                        openPanel.previousElementSibling?.querySelector('.accordion-button')?.classList.add('collapsed');
                        openPanel.previousElementSibling?.querySelector('.accordion-button')?.setAttribute('aria-expanded', 'false');
                    }
                });
            }

            panel.classList.toggle('show', !isOpen);
            this.classList.toggle('collapsed', isOpen);
            this.setAttribute('aria-expanded', String(!isOpen));
        });
    });
});
