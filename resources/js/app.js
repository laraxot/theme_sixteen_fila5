/**
 * Sixteen Theme - App JavaScript
 *
 * Design Comuni replicated with Tailwind CSS + Alpine.js
 * NO Bootstrap Italia - Pure Tailwind + Alpine implementation
 *
 * CRITICAL: Livewire/Filament already loads Alpine.js.
 * We must NOT create a second instance. Only extend the existing one.
 */

import '@splidejs/splide/dist/css/splide.min.css';
import '@theme-leaflet-css';
<<<<<<< HEAD
<<<<<<< HEAD
import focus from '@alpinejs/focus';
=======
>>>>>>> 7aabf76 (.)
=======
import focus from '@alpinejs/focus';
>>>>>>> 92da240 (.)
import { dropdownToggle } from './components/dropdown';
import { modal } from './components/modal';
import { mobileMenu } from './components/mobile-menu';
import { governanceCarousel } from './components/carousel';
import './components/bootstrap-italia.js';
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> 92da240 (.)
import '@modules/Geo/resources/js/components/my-map-lit.js';
import '@modules/Geo/resources/js/components/geo-latlng-input.js';
import '@modules/Geo/resources/js/components/map-picker-lit.js';
import '@modules/Geo/resources/js/components/location-picker-lit.js';
import '@modules/Geo/resources/js/components/geo-map-widget.js';
import '@modules/Geo/resources/js/components/place-picker-lit.js';
import '@modules/Geo/resources/js/components/coordinate-picker-field.js';
<<<<<<< HEAD
=======
import '../../../Modules/Geo/resources/js/components/my-map-lit.js';
import '../../../Modules/Geo/resources/js/components/geo-latlng-input.js';
>>>>>>> 7aabf76 (.)
=======
>>>>>>> 92da240 (.)
// DISABLED: domande-frequenti-parity.js was overriding blade template HTML with JS-generated structure
// Now using blade template directly with Alpine.js for accordion
// import { domandeFrequentiParity } from './domande-frequenti-parity';

/**
 * Register theme Alpine components onto the Alpine instance already booted by
 * Livewire/Filament. The theme must never import or start a second runtime.
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

    // Story 1.1.1-HEADER-RESPONSIVE: Mobile header navigation toggle
    // Fixes inline x-data not being processed correctly by Livewire/Alpine
    AlpineInstance.data('headerMobileNav', () => ({
        mobileNavOpen: false,
        _mq: null,
        init() {
            this._mq = window.matchMedia('(min-width: 992px)');
            const onChange = () => {
                if (this._mq.matches) {
                    this.close();
                }
            };
            this._mq.addEventListener('change', onChange);
        },
        toggle() {
            this.mobileNavOpen = !this.mobileNavOpen;
            document.body.classList.toggle('nav-open', this.mobileNavOpen);
            if (this.mobileNavOpen) {
                this.$nextTick(() => {
                    const firstLink = document.querySelector('#nav4 .menu-wrapper a');
                    if (firstLink) {
                        firstLink.focus();
                    }
                });
            }
        },
        close() {
            this.mobileNavOpen = false;
            document.body.classList.remove('nav-open');
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

document.addEventListener('DOMContentLoaded', function() {
    const closeDropdownMenu = function(menu) {
        if (!menu) {
            return;
        }

        menu.classList.remove('show');
        menu.style.removeProperty('display');
        const openDropdown = menu.closest('.dropdown');
        openDropdown?.classList.remove('is-open');
        const openToggle = openDropdown?.querySelector('[data-bs-toggle="dropdown"]');
        openToggle?.setAttribute('aria-expanded', 'false');
    };

    const openDropdownMenu = function(menu, dropdown, toggle) {
        if (!menu || !toggle) {
            return;
        }

        menu.classList.add('show');
        menu.style.removeProperty('display');
        dropdown?.classList.add('is-open');
        toggle.setAttribute('aria-expanded', 'true');
    };

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

    document.querySelectorAll('[data-bs-toggle="dropdown"]').forEach(function(toggle) {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();

            const dropdown = this.closest('.dropdown');
            const menu = dropdown?.querySelector('.dropdown-menu');
            const willOpen = menu ? !menu.classList.contains('show') : false;

            document.querySelectorAll('.dropdown-menu.show').forEach(function(openMenu) {
                if (openMenu !== menu) {
                    closeDropdownMenu(openMenu);
                }
            });

            if (menu) {
                if (willOpen) {
                    openDropdownMenu(menu, dropdown, this);
                } else {
                    closeDropdownMenu(menu);
                }
            }
        });
    });

    document.querySelectorAll('.dropdown-menu').forEach(function(menu) {
        menu.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    });

    document.querySelectorAll('[data-bs-toggle="navbarcollapsible"]').forEach(function(toggle) {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();

            const targetId = this.getAttribute('data-bs-target');
            const panel = document.querySelector(targetId);

            if (!panel) {
                return;
            }

            const willOpen = !panel.classList.contains('show');
            panel.classList.toggle('show', willOpen);
            document.body.style.overflow = willOpen ? 'hidden' : '';
        });
    });

    document.querySelectorAll('.close-menu, .navbar-collapsable .overlay').forEach(function(trigger) {
        trigger.addEventListener('click', function(e) {
            e.preventDefault();

            const panel = this.closest('.navbar-collapsable') || document.querySelector('.navbar-collapsable.show');

            if (!panel) {
                return;
            }

            panel.classList.remove('show');
            document.body.style.overflow = '';
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

        document.querySelectorAll('.navbar-collapsable.show').forEach(function(panel) {
            panel.classList.remove('show');
        });

        document.body.style.overflow = '';
    });
});

console.log('Sixteen theme loaded - Tailwind + Alpine.js');

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
