// Pagine /tests: qualunque toggler/pannello `navbarcollapsible` del riferimento (es. `#navbarNavB` del catalogo), non solo `#nav4`
const withDesignComuni = (base, extra) => (isDesignComuniPage() ? `${base}, ${extra}` : base);
const navToggleSelector = () => withDesignComuni('.custom-navbar-toggler[data-bs-target="#nav4"], [data-sixteen-mobile-nav-toggle]', '[data-bs-toggle="navbarcollapsible"]');
const navPanelSelector = () => withDesignComuni('#nav4.navbar-collapsable, [data-sixteen-mobile-nav-panel]', '.navbar-collapsable');
const navOverlaySelector = () => '.navbar-collapsable > .overlay, [data-sixteen-mobile-nav-overlay]';
const navCloseSelector = () => '.navbar-collapsable .close-menu, [data-sixteen-mobile-nav-close]';

/**
 * Dove valgono i comportamenti Design Comuni (menu `expanded`, modali con backdrop, tendine posizionate): pagine con il wrapper `data-dc` (CSS generato)
 * oppure con l'header Design Comuni (`layouts/app` sulle pagine reali: il menu mobile deve funzionare anche li', DCP-121).
 */
export const isDesignComuniPage = () => document.querySelector('.page-content[data-dc], header.it-header-wrapper') !== null;

function getTargetPanel(toggle) {
    const selector = toggle.getAttribute('data-bs-target')
        ?? toggle.getAttribute('data-sixteen-mobile-nav-target');

    return selector ? document.querySelector(selector) : document.querySelector('#nav4');
}

function getRelatedOverlays(panel) {
    const root = panel.closest('[data-sixteen-mobile-nav]') || panel.closest('.it-nav-wrapper') || document;
    const overlays = root.querySelectorAll(navOverlaySelector());

    return overlays.length > 0 ? overlays : document.querySelectorAll(navOverlaySelector());
}

function updateBodyLock() {
    // `.is-open` va su OGNI selettore della lista: prima si accodava solo all'ultimo e `#nav4.navbar-collapsable` (sempre presente) teneva `nav-open` sul body anche a menu chiuso
    const openPanels = navPanelSelector().split(',').map((part) => `${part.trim()}.is-open`).join(', ');
    document.body.classList.toggle('nav-open', document.querySelector(openPanels) !== null);
}

function setPanelOpen(panel, open, focusFirstLink = false) {
    if (!panel) {
        return;
    }

    panel.classList.toggle('is-open', open);
    panel.classList.toggle('show', open);
    // pagine Design Comuni (/tests, stesso ambito del CSS generato): `expanded`, display e aria-expanded sul pannello, come nel riferimento
    if (isDesignComuniPage()) {
        panel.classList.toggle('expanded', open);
        panel.style.display = open ? 'block' : '';
        if (open) {
            panel.setAttribute('aria-expanded', 'true');
        } else {
            panel.removeAttribute('aria-expanded');
        }
        document.documentElement.classList.toggle('pagescroll-scroll-disabled', open);
    }

    getRelatedOverlays(panel).forEach((overlay) => {
        overlay.hidden = !open;
        overlay.style.display = open ? 'block' : 'none';
        overlay.classList.toggle('is-open', open);
        overlay.classList.toggle('show', open);
        if (isDesignComuniPage()) {
            overlay.classList.toggle('fade', open);
        }
    });

    document.querySelectorAll(navToggleSelector()).forEach((toggle) => {
        if (getTargetPanel(toggle) === panel) {
            toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
        }
    });

    updateBodyLock();

    if (open && focusFirstLink) {
        window.requestAnimationFrame(() => {
            panel.querySelector('.menu-wrapper a, a, button')?.focus();
        });
    }
}

function closeAllPanels() {
    document.querySelectorAll(navPanelSelector()).forEach((panel) => {
        setPanelOpen(panel, false);
    });
}

export function initHeaderMobileNav() {
    document.querySelectorAll(navToggleSelector()).forEach((toggle) => {
        if (toggle.dataset.sixteenMobileNavBound === 'true') {
            return;
        }

        toggle.dataset.sixteenMobileNavBound = 'true';
        toggle.addEventListener('click', (event) => {
            event.preventDefault();
            const panel = getTargetPanel(toggle);
            setPanelOpen(panel, !(panel?.classList.contains('is-open')), true);
        });
    });

    document.querySelectorAll(navOverlaySelector()).forEach((overlay) => {
        if (overlay.dataset.sixteenMobileNavBound === 'true') {
            return;
        }

        overlay.dataset.sixteenMobileNavBound = 'true';
        overlay.addEventListener('click', closeAllPanels);
    });

    document.querySelectorAll(navCloseSelector()).forEach((closeButton) => {
        if (closeButton.dataset.sixteenMobileNavBound === 'true') {
            return;
        }

        closeButton.dataset.sixteenMobileNavBound = 'true';
        closeButton.addEventListener('click', (event) => {
            event.preventDefault();
            const panel = closeButton.closest(navPanelSelector()) || document.querySelector(navPanelSelector());
            setPanelOpen(panel, false);
        });
    });
}

if (typeof document !== 'undefined') {
    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            closeAllPanels();
        }
    });
}

if (typeof window !== 'undefined' && typeof window.matchMedia === 'function') {
    window.matchMedia('(min-width: 992px)').addEventListener('change', (event) => {
        if (event.matches) {
            closeAllPanels();
        }
    });
}
