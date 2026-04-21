# Sixteen Wiki Index

## Foundations

- [schema](./schema.md): rules for ingest, query, and lint inside the Sixteen wiki.
- [geo map selector governance](../../../Modules/Geo/docs/wiki/concepts/leaflet-class-selector-governance.md): integrazione tema con picker multipli senza collisioni id-based
- [latitudelongitudeinput xotbasefield rule](../../../Modules/Geo/docs/wiki/concepts/latitudelongitudeinput-xotbasefield-rule.md): allineamento architetturale del picker legacy ai wrapper XotBase
- [mappicker xotbasefield rule](../../../Modules/Geo/docs/wiki/concepts/mappicker-xotbasefield-rule.md): `MapPicker` allineato ai wrapper XotBase senza ereditarieta sibling
- [mappicker runtime ux](../../../Modules/Geo/docs/wiki/concepts/mappicker-runtime-ux.md): se lat/lng mancanti, geolocalizza automaticamente e aggiorna stato
- [latitudelongitudeinput runtime ux](../../../Modules/Geo/docs/wiki/concepts/latitudelongitudeinput-runtime-ux.md): coordinate null gestite con autolocate e controlli mappa sempre disponibili
- [header v1 blade SSoT](../../../../docs/wiki/concepts/header-section-owner-rule.md): **normativa** — l'header e' e deve essere `resources/views/components/sections/header/v1.blade.php` per `<x-section slug="header" />` (story 8-35)
- [header composition rule (root)](../../../../docs/wiki/concepts/sixteen-header-composition-rule.md): estrazione DRY+KISS dei blocchi interni solo sotto `sections/header/`; `v1.blade.php` resta orchestratore (story 8-36)
- [header authenticated state](./concepts/header-authenticated-state.md): comportamento guest vs autenticato (testi, menu); implementazione sempre nel file v1 sopra
- [header slim dropdown behavior](./concepts/header-slim-dropdown-behavior.md): click-outside sicuro, niente inline `display` persistente, token blu slim vs verde center, z-index/overflow
- [story 7-54 artifact](../../../../../_bmad-output/implementation-artifacts/7-54-segnalazione-crea-header-slim-dropdowns-data-bs-toggle-unification.md): fix wizard segnalazione-crea, dropdown slim solo `data-bs-toggle` + `app.js`

## Pagine Compilate

| Pagina | Tipo | Argomento |
|--------|------|-----------|
| [sixteen-theme](./overviews/sixteen-theme.md) | overview | Bootstrap Italia, AGID compliance, Design Comuni |
