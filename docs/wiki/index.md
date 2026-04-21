# Wiki Locale Index

## Karpathy LLM Wiki Standard

<<<<<<< .merge_file_7WzEwW
- [schema](./schema.md): rules for ingest, query, and lint inside the Sixteen wiki.
- [geo map selector governance](../../../Modules/Geo/docs/wiki/concepts/leaflet-class-selector-governance.md): integrazione tema con picker multipli senza collisioni id-based
- [latitudelongitudeinput xotbasefield rule](../../../Modules/Geo/docs/wiki/concepts/latitudelongitudeinput-xotbasefield-rule.md): allineamento architetturale del picker legacy ai wrapper XotBase
- [mappicker xotbasefield rule](../../../Modules/Geo/docs/wiki/concepts/mappicker-xotbasefield-rule.md): `MapPicker` allineato ai wrapper XotBase senza ereditarieta sibling
- [mappicker runtime ux](../../../Modules/Geo/docs/wiki/concepts/mappicker-runtime-ux.md): se lat/lng mancanti, geolocalizza automaticamente e aggiorna stato
- [latitudelongitudeinput runtime ux](../../../Modules/Geo/docs/wiki/concepts/latitudelongitudeinput-runtime-ux.md): coordinate null gestite con autolocate e controlli mappa sempre disponibili
- [header v1 blade SSoT](../../../../docs/wiki/concepts/header-section-owner-rule.md): **normativa** — l'header e' e deve essere `resources/views/components/sections/header/v1.blade.php` per `<x-section slug="header" />` (story 8-35)
- [blade component extraction governance](../../../../docs/wiki/concepts/blade-component-extraction-governance.md): regola generale per tutte le Blade — owner/runtime prima, componente riusabile o partial locale solo se riduce duplicazione reale
- [header composition rule (root)](../../../../docs/wiki/concepts/sixteen-header-composition-rule.md): estrazione componenti riusabili da tutte le Blade; per blocchi locali all'header usare `sections/header/partials/`; `v1.blade.php` resta orchestratore (story 8-37)
- [header partials location rule](./concepts/header-partials-location-rule.md): partial locali header sempre in `sections/header/partials/`; mai allo stesso livello di `v1.blade.php`
- [blade component extraction rule (local)](./concepts/blade-component-extraction-rule.md): quick-reference locale — classificazione blocchi blade (riusabile cross-section, partial di section, inline)
- [header authenticated state](./concepts/header-authenticated-state.md): comportamento guest vs autenticato (testi, menu); implementazione sempre nel file v1 sopra
- [header slim dropdown behavior](./concepts/header-slim-dropdown-behavior.md): click-outside sicuro, niente inline `display` persistente, token blu slim vs verde center, z-index/overflow
- [segnalazione wizard cta parity](./concepts/segnalazione-wizard-cta-parity.md): una sola CTA primaria (`Avanti`) nel wizard per ridurre confusione
- [segnalazione privacy parity audit](./concepts/segnalazione-privacy-parity-audit.md): audit desktop/tablet/mobile con focus header colori e posizione CTA
- [livewire cache table rate limiter](./concepts/livewire-cache-table-rate-limiter.md): prerequisito runtime per update Livewire in frontoffice
- [segnalazione runtime asset integrity](./concepts/segnalazione-runtime-asset-integrity.md): regole anti-404 su asset tema/modulo in runtime
<<<<<<< HEAD
- [forbidden folders zero tolerance](../../../../docs/wiki/concepts/forbidden-folders-zero-tolerance-rule.md): vietati `docs/archive`, `_docs`, `lang/lang`
=======
- [no docs archive rule](./concepts/no-docs-archive-rule.md): nuova documentazione solo in wiki/raw, niente `docs/archived`
- [wiki sacred structure rule](../../../../docs/wiki/concepts/wiki-sacred-structure-rule.md): struttura wiki canonica protetta, inclusi `_archive` e `_templates`
>>>>>>> 4b3e8ff (.)
- [story 7-54 artifact](../../../../../_bmad-output/implementation-artifacts/7-54-segnalazione-crea-header-slim-dropdowns-data-bs-toggle-unification.md): fix wizard segnalazione-crea, dropdown slim solo `data-bs-toggle` + `app.js`
=======
- [forbidden-folders-rule](../../../../docs/wiki/concepts/forbidden-folders.md): Strict structural constraints.
- [llm-wiki-standard](../../../../docs/wiki/concepts/karpathy-wiki.md): Repository mapping and knowledge lifecycle.
>>>>>>> .merge_file_gLgpOQ

## Sacred Hierarchy

- [concepts/](./concepts/): Architectural patterns and methodologies.
- [entities/](./entities/): Key models and components.
- [sources/](./sources/): Research data and external links.
- [comparisons/](./comparisons/): Alternative implementations.
- [decisions/](./decisions/): ADL (Architectural Decision Log).
- [troubleshooting/](./troubleshooting/): Known issues and solutions.
- [_archive/](./_archive/): Legacy documentation.
- [_templates/](./_templates/): Standard templates.

## Compiled Pages

| Page | Type | Source | Updated |
|------|------|--------|---------|
| [.gitkeep](./concepts/.gitkeep) | Concept | - | 2026-04-21 |
| [bootstrap-italia-tailwind-philosophy](./concepts/bootstrap-italia-tailwind-philosophy.md) | Concept | - | 2026-04-21 |
| [header-authenticated-state](./concepts/header-authenticated-state.md) | Concept | - | 2026-04-21 |
| [header-color-parity](./concepts/header-color-parity.md) | Concept | - | 2026-04-21 |
| [header-slim-dropdown-behavior](./concepts/header-slim-dropdown-behavior.md) | Concept | - | 2026-04-21 |
| [header-ssot](./concepts/header-ssot.md) | Concept | - | 2026-04-21 |
| [livewire-cache-table-rate-limiter](./concepts/livewire-cache-table-rate-limiter.md) | Concept | - | 2026-04-21 |
| [segnalazione-privacy-parity-audit](./concepts/segnalazione-privacy-parity-audit.md) | Concept | - | 2026-04-21 |
| [segnalazione-runtime-asset-integrity](./concepts/segnalazione-runtime-asset-integrity.md) | Concept | - | 2026-04-21 |
| [segnalazione-wizard-cta-parity](./concepts/segnalazione-wizard-cta-parity.md) | Concept | - | 2026-04-21 |
