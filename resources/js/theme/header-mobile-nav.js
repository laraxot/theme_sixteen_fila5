const navToggleSelector = '[data-sixteen-mobile-nav-toggle]';
const navPanelSelector = '[data-sixteen-mobile-nav-panel]';
const navOverlaySelector = '[data-sixteen-mobile-nav-overlay]';
const navCloseSelector = '[data-sixteen-mobile-nav-close]';
const desktopMediaQuery = window.matchMedia('(min-width: 992px)');

function getTargetPanel(toggle) {
    const selector = toggle.getAttribute('data-sixteen-mobile-nav-target');

    if (!selector) {
        return document.querySelector(navPanelSelector);
    }

    return document.querySelector(selector);
}

function getRelatedOverlays(panel) {
    const root = panel.closest('[data-sixteen-mobile-nav]') || panel.closest('.it-nav-wrapper') || document;
    const overlays = root.querySelectorAll(navOverlaySelector);

    return overlays.length > 0 ? overlays : document.querySelectorAll(navOverlaySelector);
}

function updateBodyLock() {
    const hasOpenPanel = document.querySelector(`${navPanelSelector}.is-open`) !== null;

    document.body.classList.toggle('nav-open', hasOpenPanel);
    document.body.style.overflow = hasOpenPanel ? 'hidden' : '';
}

function setPanelOpen(panel, open, focusFirstLink = false) {
    if (!panel) {
        return;
    }

    panel.classList.toggle('is-open', open);
    panel.classList.toggle('show', open);

    getRelatedOverlays(panel).forEach((overlay) => {
        overlay.hidden = !open;
        overlay.classList.toggle('is-open', open);
        overlay.classList.toggle('show', open);
    });

    document.querySelectorAll(navToggleSelector).forEach((toggle) => {
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
    document.querySelectorAll(navPanelSelector).forEach((panel) => {
        setPanelOpen(panel, false);
    });
}

export function initHeaderMobileNav() {
    document.querySelectorAll(navToggleSelector).forEach((toggle) => {
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

    document.querySelectorAll(navOverlaySelector).forEach((overlay) => {
        if (overlay.dataset.sixteenMobileNavBound === 'true') {
            return;
        }

        overlay.dataset.sixteenMobileNavBound = 'true';
        overlay.addEventListener('click', closeAllPanels);
    });

    document.querySelectorAll(navCloseSelector).forEach((closeButton) => {
        if (closeButton.dataset.sixteenMobileNavBound === 'true') {
            return;
        }

        closeButton.dataset.sixteenMobileNavBound = 'true';
        closeButton.addEventListener('click', (event) => {
            event.preventDefault();
            const panel = closeButton.closest(navPanelSelector) || document.querySelector(navPanelSelector);
            setPanelOpen(panel, false);
        });
    });
}

document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape') {
        closeAllPanels();
    }
});

desktopMediaQuery.addEventListener('change', (event) => {
    if (event.matches) {
        closeAllPanels();
    }
});
