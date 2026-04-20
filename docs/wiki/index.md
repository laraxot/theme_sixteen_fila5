# Sixteen Wiki Index

## Foundations

- [schema](./schema.md): rules for ingest, query, and lint inside the Sixteen wiki.
- [geo map selector governance](../../../Modules/Geo/docs/wiki/concepts/leaflet-class-selector-governance.md): integrazione tema con picker multipli senza collisioni id-based
- [latitudelongitudeinput xotbasefield rule](../../../Modules/Geo/docs/wiki/concepts/latitudelongitudeinput-xotbasefield-rule.md): allineamento architetturale del picker legacy ai wrapper XotBase
- [mappicker xotbasefield rule](../../../Modules/Geo/docs/wiki/concepts/mappicker-xotbasefield-rule.md): `MapPicker` allineato ai wrapper XotBase senza ereditarieta sibling
- [mappicker runtime ux](../../../Modules/Geo/docs/wiki/concepts/mappicker-runtime-ux.md): se lat/lng mancanti, geolocalizza automaticamente e aggiorna stato
- [latitudelongitudeinput runtime ux](../../../Modules/Geo/docs/wiki/concepts/latitudelongitudeinput-runtime-ux.md): coordinate null gestite con autolocate e controlli mappa sempre disponibili
- [header authenticated state](./concepts/header-authenticated-state.md): header auth-aware nel tema Sixteen con guest `Accedi all'area personale` e authenticated `avatar + nickname + dropdown`
- [header section owner rule](../../../../docs/wiki/concepts/header-section-owner-rule.md): se il layout usa `<x-section slug="header" />`, il file owner da trattare come fonte di verita e' `resources/views/components/sections/header/v1.blade.php`
- [header slim dropdown behavior](./concepts/header-slim-dropdown-behavior.md): click-outside sicuro, niente inline `display` persistente, token blu slim vs verde center, z-index/overflow

## Pagine Compilate

| Pagina | Tipo | Argomento |
|--------|------|-----------|
| [sixteen-theme](./overviews/sixteen-theme.md) | overview | Bootstrap Italia, AGID compliance, Design Comuni |
