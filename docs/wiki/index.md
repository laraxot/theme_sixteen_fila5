# Wiki Locale Index

## Karpathy LLM Wiki Standard

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
- [header color parity — Design Comuni](./concepts/header-color-parity.md): slim verde vs navbar chiara nel flusso segnalazione; `theme-light-desk`; un solo CSS in `app.css`
- [theme css only parity rule](./concepts/theme-css-only-parity-rule.md): Sixteen e' owner delle regole visuali Design Comuni; vietati `<style>` e inline style JS nelle Blade dei moduli
- [segnalazione map and section spacing parity](./concepts/segnalazione-map-and-section-spacing-parity.md): mappa opaca/controlli visibili e spacing `Disservizio` governati dal CSS tema
- [header authenticated state](./concepts/header-authenticated-state.md): comportamento guest vs autenticato (testi, menu); implementazione sempre nel file v1 sopra
- [header slim dropdown behavior](./concepts/header-slim-dropdown-behavior.md): click-outside sicuro, niente inline `display` persistente, token blu slim vs verde center, z-index/overflow
- [segnalazione wizard cta parity](./concepts/segnalazione-wizard-cta-parity.md): una sola CTA primaria (`Avanti`) nel wizard per ridurre confusione
- [filament summary infolist rule](../../../../docs/wiki/concepts/filament-summary-infolist-rule.md): nei wizard `getSummarySchema()` usa Infolists, non `SchemaView`
- [filament5 schema section namespace rule](./concepts/filament5-schema-section-namespace-rule.md): view tema renderizza lo schema del widget; `Section` e' Schemas, non Infolists; niente fork Folio per casi singoli
- [design comuni site-wide component css rule](./concepts/design-comuni-site-wide-component-css-rule.md): CSS Design Comuni per componenti riusabili, non per singola pagina o singolo wizard (`data-slug`, `.ticket-wizard-root`)
- [context compression discipline](../../../../docs/wiki/concepts/context-compression-discipline.md): usare context-mode + QMD per retrieval selettivo dei docs tema e prevenire story BMAD oltre 131k token
- [segnalazione privacy parity audit](./concepts/segnalazione-privacy-parity-audit.md): audit desktop/tablet/mobile con focus header colori e posizione CTA
- [livewire cache table rate limiter](./concepts/livewire-cache-table-rate-limiter.md): prerequisito runtime per update Livewire in frontoffice
- [segnalazione runtime asset integrity](./concepts/segnalazione-runtime-asset-integrity.md): regole anti-404 su asset tema/modulo in runtime
- [context compression and summary infolist rule](./concepts/context-compression-and-summary-infolist-rule.md): il tema non rimappa summary via `SchemaView`; dati read-only nel widget Fixcity con Infolist entries
- [no-page-specific-css](./concepts/no-page-specific-css.md): **VIETATO** `.ticket-wizard-root` o `[data-slug="..."]`; CSS globale per componenti come Design Comuni; varianti via props, non via nome pagina
- [theme owned wizard css parity rule](./concepts/theme-owned-wizard-css-parity-rule.md): CSS parity del wizard nel tema Sixteen, mai nel Blade modulo Fixcity; build/copy obbligatori
- [forbidden folders zero tolerance](../../../../docs/wiki/concepts/forbidden-folders-zero-tolerance-rule.md): vietati `docs/archive`, `_docs`, `lang/lang`
- [wiki sacred structure rule](../../../../docs/wiki/concepts/wiki-sacred-structure-rule.md): struttura wiki canonica protetta, inclusi `_archive` e `_templates`
- [story 7-54 artifact](../../../../../_bmad-output/implementation-artifacts/7-54-segnalazione-crea-header-slim-dropdowns-data-bs-toggle-unification.md): fix wizard segnalazione-crea, dropdown slim solo `data-bs-toggle` + `app.js`

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
# Aggiornamenti Recenti

- [wizard-summary-infolist-runtime-fix-2026-04-22](../design-comuni/wizard-summary-infolist-runtime-fix-2026-04-22.md): riepilogo segnalazione Design Comuni governato da entry Infolist nel widget Fixcity.
- [context-compression-plugin-runtime](../context-compression-plugin-runtime.md): regola Sixteen per non caricare in blocco report/screenshot/raw HTML e usare LLM Wiki/QMD.
