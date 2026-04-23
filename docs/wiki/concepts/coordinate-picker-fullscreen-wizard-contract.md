---
name: coordinate-picker-fullscreen-wizard-contract
description: CoordinatePicker fullscreen behavior inside the segnalazione wizard
type: concept
---

# Coordinate Picker Fullscreen Wizard Contract

When `coordinate-picker-lit` enters fullscreen inside the `segnalazione-crea` wizard:

- the page must not show a vertical scrollbar;
- sidebar content such as `Informazioni richieste` must not overlay the map;
- the map must refresh after fullscreen transition so Leaflet tiles fill the viewport;
- the fullscreen layer must sit above wizard sidebars, sticky sections, modals, and header chrome.

## Root Cause

The previous fullscreen mode only toggled an internal CSS class and `document.body.style.overflow`. In the wizard layout, ancestors and sticky/sidebar elements can keep their stacking context and the document element can still scroll. Leaflet also needs `invalidateSize()` after the fullscreen transition.

## Contract

- `CoordinatePickerField._toggleFullscreen()` must use the browser Fullscreen API when available.
- While active, add a document-level class such as `geo-map-fullscreen-active` to lock `html` and `body` overflow.
- On enter and exit, call `_refreshMapSize()` with delayed refreshes.
- CSS must support both real `:fullscreen` and class fallback `.map-container.is-fullscreen`.
- The effective z-index for fallback mode must be above Bootstrap Italia/Filament layers.
