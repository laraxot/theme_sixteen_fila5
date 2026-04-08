/**
 * Sixteen Theme - App JavaScript
 *
 * Design Comuni replicated with Tailwind CSS + Alpine.js
 * NO Bootstrap Italia - Pure Tailwind + Alpine implementation
 */

import Alpine from 'alpinejs';
import '@splidejs/splide/dist/css/splide.min.css';
import { dropdownToggle } from './components/dropdown';
import { modal } from './components/modal';
import { mobileMenu } from './components/mobile-menu';
import { governanceCarousel } from './components/carousel';
import './components/bootstrap-italia.js';
// DISABLED: domande-frequenti-parity.js was overriding blade template HTML with JS-generated structure
// Now using blade template directly with Alpine.js for accordion
// import { domandeFrequentiParity } from './domande-frequenti-parity';

window.Alpine = Alpine;

// Register Alpine components for direct usage
Alpine.data('dropdownToggle', dropdownToggle);
Alpine.data('modal', modal);
Alpine.data('mobileMenu', mobileMenu);
Alpine.data('governanceCarousel', governanceCarousel);

// Fallback Alpine data for backward compatibility
Alpine.data('dropdown', () => ({
    open: false,
    toggle() {
        this.open = !this.open;
    },
}));

// Generic components used by inline x-data (workaround for Alpine 3.15.x bug
// where plain object literals in x-data trigger "r.call(...).catch is not a function")
Alpine.data('accordionItem', () => ({ open: false }));
Alpine.data('ratingInline', () => ({ rating: 0, hover: 0 }));

// Segnalazioni elenco page: tabs + modals state
Alpine.data('segnalazioniLayout', () => ({
    activeTab: 'map',
    showModal: false,
    showFilterModal: false,
}));

Alpine.start();

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

    document.querySelectorAll('[data-bs-toggle="dropdown"]').forEach(function(toggle) {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();

            const menu = this.parentElement?.querySelector('.dropdown-menu');

            document.querySelectorAll('.dropdown-menu.show').forEach(function(openMenu) {
                if (openMenu !== menu) {
                    openMenu.classList.remove('show');
                }
            });

            if (menu) {
                menu.classList.toggle('show');
            }
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

    document.addEventListener('click', function() {
        document.querySelectorAll('.dropdown-menu.show').forEach(function(openMenu) {
            openMenu.classList.remove('show');
        });
    });

    document.addEventListener('keydown', function(e) {
        if (e.key !== 'Escape') {
            return;
        }

        document.querySelectorAll('.dropdown-menu.show').forEach(function(openMenu) {
            openMenu.classList.remove('show');
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

// DISABLED: Using blade template directly with Alpine.js instead of JS-generated structure
// domandeFrequentiParity();

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

    const faqSearchInput = document.querySelector('[data-faq-search]');
    const faqSearchForm = document.querySelector('[data-faq-search-form]');

    if (faqSearchForm) {
        faqSearchForm.addEventListener('submit', function(e) {
            e.preventDefault();
        });
    }

    if (faqSearchInput) {
        faqSearchInput.addEventListener('input', function() {
            const term = this.value.trim().toLowerCase();

            document.querySelectorAll('[data-faq-item]').forEach(function(item) {
                const haystack = item.getAttribute('data-faq-text') || '';
                item.style.display = term === '' || haystack.includes(term) ? '' : 'none';
            });
        });
    }
});

document.addEventListener('DOMContentLoaded', function() {
    if (document.querySelector('main[data-page="argomenti"]')) {
        document.body.classList.add('dc-argomenti-parity');
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const page = document.querySelector('main[data-page]');

    if (!page) {
        return;
    }

    if (page.dataset.page === 'lista-risorse') {
        const listingFallbacks = [
            'https://picsum.photos/id/1040/800/450',
            'https://picsum.photos/id/1060/800/450',
            'https://picsum.photos/id/1025/800/450',
            'https://picsum.photos/id/1011/800/450',
            'https://picsum.photos/id/1035/800/450',
            'https://picsum.photos/id/1074/800/450',
            'https://picsum.photos/id/1070/800/450',
            'https://picsum.photos/id/1050/800/450',
            'https://picsum.photos/id/1039/800/450',
        ];

        page.querySelectorAll('.card-teaser-image-top img').forEach(function(image, index) {
            const fallback = listingFallbacks[index % listingFallbacks.length];
            const currentSrc = image.getAttribute('src') || '';

            image.addEventListener('error', function handleError() {
                if (image.dataset.dcFallbackApplied === 'true') {
                    return;
                }

                image.dataset.dcFallbackApplied = 'true';
                image.src = fallback;
            }, { once: true });

            if (currentSrc.includes('placeholder-image.png')) {
                image.src = fallback;
                image.dataset.dcFallbackApplied = 'true';
            }
        });
    }
});

function addTestPageBodyClasses() {
    const path = window.location.pathname;
    const match = path.match(/^\/[a-z]{2}\/tests\/([^/?#]+)/);

    if (!match) {
        return null;
    }

    const slug = match[1];
    const slugClass = slug.replace(/[^a-z0-9-]/gi, '-').toLowerCase();

    document.body.classList.add('page-tests', `page-tests-${slugClass}`);

    return slug;
}

function findHeadingByText(selector, expectedText) {
    const normalizedExpectedText = expectedText.trim().toLowerCase();

    return Array.from(document.querySelectorAll(selector)).find((element) => {
        return element.textContent?.trim().toLowerCase() === normalizedExpectedText;
    }) ?? null;
}

function setupListaRisorseParity() {
    if (!document.body.classList.contains('page-tests-lista-risorse')) {
        return;
    }

    const heading = document.querySelector('.cmp-heading');
    heading?.closest('.container')?.classList.add('dc-lr-hero');

    const featuredHeading = findHeadingByText('h2', 'Notizie in evidenza');
    featuredHeading?.closest('.container')?.classList.add('dc-lr-featured');

    const allNewsHeading = findHeadingByText('h2', 'Esplora tutte le novità');
    allNewsHeading?.closest('.container')?.classList.add('dc-lr-all-news');

    const pagination = document.querySelector('.cmp-pagination');
    pagination?.closest('.container')?.classList.add('dc-lr-pagination-block');

    const ratings = document.querySelectorAll('.cmp-rating');
    if (ratings[0]) {
        ratings[0].classList.add('dc-lr-rating-question');
        ratings[0].closest('.container')?.classList.add('dc-lr-feedback-band');
    }

    if (ratings[1]) {
        ratings[1].classList.add('dc-lr-rating-feedback');
    }

    const searchBlocks = document.querySelectorAll('.cmp-input-search');
    if (searchBlocks[1]) {
        searchBlocks[1].closest('.container')?.classList.add('dc-lr-contact-search');
    }

    const contactsHeading = findHeadingByText('h2', 'Contatta il comune');
    contactsHeading?.closest('.container')?.classList.add('dc-lr-contacts-band');

    const referenceImages = [
        'https://italia.github.io/design-comuni-pagine-statiche/assets/images/notizia-sport-nel-verde.png',
        'https://italia.github.io/design-comuni-pagine-statiche/assets/images/notizia-torneo-bici.png',
        'https://italia.github.io/design-comuni-pagine-statiche/assets/images/notizia-sport-nel-verde.png',
        'https://italia.github.io/design-comuni-pagine-statiche/assets/images/notizia-dialoghi-biblioteca.png',
        'https://italia.github.io/design-comuni-pagine-statiche/assets/images/notizia-ludoteca.png',
        'https://italia.github.io/design-comuni-pagine-statiche/assets/images/notizia-sicurezza.png',
        'https://italia.github.io/design-comuni-pagine-statiche/assets/images/notizia-asfaltatura.png',
        'https://italia.github.io/design-comuni-pagine-statiche/assets/images/notizia-torneo-bici.png',
        'https://italia.github.io/design-comuni-pagine-statiche/assets/images/notizia-sgombero.png',
    ];

    document.querySelectorAll('.card-teaser-image-top .img-fluid').forEach((image, index) => {
        const referenceImage = referenceImages[index];

        if (!referenceImage) {
            return;
        }

        image.src = referenceImage;
        image.loading = 'eager';
    });
}

document.addEventListener('DOMContentLoaded', function() {
    addTestPageBodyClasses();
    setupListaRisorseParity();
});


document.addEventListener('DOMContentLoaded', function() {
    const pageMain = document.querySelector('main[data-page]');
    const page = pageMain?.dataset.page;

    if (!page) {
        return;
    }

    document.body.dataset.page = page;

    const sectionMap = {
        management: ['amministrazione', 'aree-amministrative', 'area-amministrativa-dettaglio', 'organo', 'persona', 'persona-dettaglio', 'ufficio', 'ufficio-dettaglio', 'enti-e-fondazioni', 'ente-dettaglio', 'documenti-dati', 'documento-dettaglio', 'dataset-dettaglio'],
        news: ['homepage', 'lista-risorse', 'lista-categorie', 'lista-risorse-categorie', 'mappa-sito', 'novita', 'novita-dettaglio'],
        'all-services': ['servizi', 'servizi-categoria', 'servizio-dettaglio', 'pagamento', 'pagamento-dettaglio', 'prenotazione-appuntamento', 'appuntamento-01-ufficio', 'appuntamento-01-ufficio-luogo', 'appuntamento-02-data-orario', 'appuntamento-03-dettagli', 'appuntamento-04-richiedente', 'appuntamento-04-richiedente-autenticato', 'appuntamento-05-riepilogo', 'appuntamento-06-conferma', 'richiesta-assistenza', 'assistenza-01-dati', 'assistenza-02-conferma'],
        live: ['eventi', 'evento-dettaglio', 'luoghi', 'luogo-dettaglio', 'contatti', 'segnalazione-disservizio', 'segnalazione-01-privacy', 'segnalazione-02-dati', 'segnalazione-03-riepilogo', 'segnalazione-04-conferma', 'segnalazione-area-personale', 'segnalazioni-elenco', 'segnalazione-dettaglio'],
        'all-topics': ['argomenti', 'argomento'],
    };

    const activeElement = Object.entries(sectionMap).find(function([, pages]) {
        return pages.includes(page);
    })?.[0];

    if (activeElement) {
        document.querySelectorAll('.it-header-navbar-wrapper .nav-link.active').forEach(function(link) {
            link.classList.remove('active');
            link.removeAttribute('aria-current');
        });

        const activeLink = document.querySelector('.it-header-navbar-wrapper .nav-link[data-element="' + activeElement + '"]');

        if (activeLink) {
            activeLink.classList.add('active');
            activeLink.setAttribute('aria-current', 'page');
        }
    }

    document.querySelectorAll('.card-image-wrapper img').forEach(function(image) {
        image.addEventListener('error', function() {
            if (this.dataset.dcFallbackApplied === 'true') {
                return;
            }

            this.dataset.dcFallbackApplied = 'true';
            this.src = 'data:image/svg+xml;charset=UTF-8,' + encodeURIComponent('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 800 500"><rect width="800" height="500" fill="#e8eef5"/><rect x="48" y="48" width="704" height="404" rx="18" fill="#dfe7f0"/><circle cx="220" cy="180" r="58" fill="#bfd0e0"/><path d="M110 388l145-136 102 96 118-115 215 155H110z" fill="#8cb3d1"/><rect x="128" y="86" width="206" height="26" rx="13" fill="#9fb8ce"/></svg>');
            this.alt = '';
        }, { once: true });
    });
});
