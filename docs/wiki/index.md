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
- [header color parity — Design Comuni](./concepts/header-color-parity.md): segnalazione-crea con navbar verde scoped late in `app.css`; niente `theme-light-desk`
- [segnalazione-crea navbar green contract](./concepts/segnalazione-crea-navbar-green-contract.md): menu header verde, anti-regressione blu/bianco
- [coordinate picker fullscreen wizard contract](./concepts/coordinate-picker-fullscreen-wizard-contract.md): fullscreen mappa senza scrollbar e senza sidebar sopra la mappa
- [segnalazione-crea header and map visual regression contract](./concepts/segnalazione-crea-header-and-map-visual-regression-contract.md): guardrail visuale combinato su header e mappa
- [header navigation background fix](./docs/wiki/concepts/header-navigation-background-fix.md): navbar link background override per allineare a verde tema Design Comuni
- [theme css only parity rule](./concepts/theme-css-only-parity-rule.md): Sixteen e' owner delle regole visuali Design Comuni; vietati `<style>` e inline style JS nelle Blade dei moduli
- [segnalazione map and section spacing parity](./concepts/segnalazione-map-and-section-spacing-parity.md): mappa opaca/controlli visibili e spacing `Disservizio` governati dal CSS tema
- [segnalazione riepilogo reference gap plan](./concepts/segnalazione-riepilogo-reference-gap-plan.md): confronto step 3 con reference, header-first, submit/nav e piano parity
- [header authenticated state](./concepts/header-authenticated-state.md): comportamento guest vs autenticato (testi, menu); implementazione sempre nel file v1 sopra
- [header slim dropdown behavior](./concepts/header-slim-dropdown-behavior.md): click-outside sicuro, niente inline `display` persistente, token blu slim vs verde center, z-index/overflow
- [segnalazione wizard cta parity](./concepts/segnalazione-wizard-cta-parity.md): una sola CTA primaria (`Avanti`) nel wizard per ridurre confusione
- [filament summary infolist rule](../../../../docs/wiki/concepts/filament-summary-infolist-rule.md): nei wizard `getSummarySchema()` usa Infolists, non `SchemaView`
- [filament5 schema section namespace rule](./concepts/filament5-schema-section-namespace-rule.md): view tema renderizza lo schema del widget; `Section` e' Schemas, non Infolists; niente fork Folio per casi singoli
- [filament5 schema form access rule](./concepts/filament5-schema-form-access-rule.md): view tema renderizza `{{ $this->form }}`; lettura stato nel widget via `$this->form`, non `getForm('form')`
- [design comuni site-wide component css rule](./concepts/design-comuni-site-wide-component-css-rule.md): CSS Design Comuni per componenti riusabili, non per singola pagina o singolo wizard (`data-slug`, `.ticket-wizard-root`)
- [design comuni header green navbar rule](./concepts/design-comuni-header-green-navbar-rule.md): le voci menu principali devono usare il fondo verde branding; attenzione a cascade Bootstrap Italia e asset build/copy
- [header navbar green component rule](./concepts/header-navbar-green-component-rule.md): fix globale componente header per wrapper/link/stati/media query; evita regressioni blu/bianco
- [coordinate picker fullscreen theme layer rule](./concepts/coordinate-picker-fullscreen-theme-layer-rule.md): fullscreen mappa sopra navscroll/box wizard, senza CSS per pagina
- [leaflet map flicker visual contract](./concepts/leaflet-map-flicker-visual-contract.md): contratto visuale tema per mappa stabile senza lampeggio o overlay spurii
- [context compression discipline](../../../../docs/wiki/concepts/context-compression-discipline.md): usare context-mode + QMD per retrieval selettivo dei docs tema e prevenire story BMAD oltre 131k token
- [segnalazione privacy parity audit](./concepts/segnalazione-privacy-parity-audit.md): audit desktop/tablet/mobile con focus header colori e posizione CTA
- [livewire cache table rate limiter](./concepts/livewire-cache-table-rate-limiter.md): prerequisito runtime per update Livewire in frontoffice
- [segnalazione runtime asset integrity](./concepts/segnalazione-runtime-asset-integrity.md): regole anti-404 su asset tema/modulo in runtime
- [context compression and summary infolist rule](./concepts/context-compression-and-summary-infolist-rule.md): il tema non rimappa summary via `SchemaView`; dati read-only nel widget Fixcity con Infolist entries
- [no-page-specific-css](./concepts/no-page-specific-css.md): **VIETATO** `.ticket-wizard-root` o `[data-slug="..."]`; CSS globale per componenti come Design Comuni; varianti via props, non via nome pagina
- [theme owned wizard css parity rule](./concepts/theme-owned-wizard-css-parity-rule.md): CSS parity del wizard nel tema Sixteen, mai nel Blade modulo Fixcity; build/copy obbligatori
- [forbidden folders zero tolerance](../../../../docs/wiki/concepts/forbidden-folders-zero-tolerance-rule.md): vietati `docs/archive`, `_docs`, `lang/lang`
- [wiki sacred structure rule](../../../../docs/wiki/concepts/wiki-sacred-structure-rule.md): struttura wiki canonica protetta, inclusi `_archive` e `_templates`
- [theme cms block architecture segnalazione crea](./concepts/theme-cms-block-architecture-segnalazione-crea.md): pattern CMS JSON → block view → widget; segnalazione-crea è CMS-driven, non hardcoded
- [no cms shadowed folio pages rule](./concepts/no-cms-shadowed-folio-pages-rule.md): REGOLA — SE una pagina è CMS-driven (JSON blocks → block view), NON deve esistere un Folio page hardcoded con stesso slug che la duplica
- [geo lit components must be imported rule](./concepts/geo-lit-components-must-be-imported-rule.md): OGNI componente Lit del modulo Geo deve essere importato in app.js del tema — altrimenti il browser non riconosce il custom element
- [theme bundle integration false friends](./concepts/theme-bundle-integration-false-friends.md): il tema e' owner dell'integrazione bundle dei custom elements frontoffice
- [story 7-54 artifact](../../../../../_bmad-output/implementation-artifacts/7-54-segnalazione-crea-header-slim-dropdowns-data-bs-toggle-unification.md): fix wizard segnalazione-crea, dropdown slim solo `data-bs-toggle` + `app.js`
- [visual-parity-verification-rule](./concepts/visual-parity-verification-rule.md): REGOLA — dopo ogni modifica (PHP/Blade/CSS/JS) verificare la pagina nel browser all'URL di riferimento; mai dichiarare fix "completato" senza browser

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
| [global-css-no-page-selectors-wizard-parity](./concepts/global-css-no-page-selectors-wizard-parity.md) | Concept | parity governance | 2026-04-23 |
| [visual-parity-verification-rule](./concepts/visual-parity-verification-rule.md) | Concept | Post-modifica-verifica obbligatoria con browser | 2026-04-23 |
# Aggiornamenti Recenti

- [wizard-summary-infolist-runtime-fix-2026-04-22](../design-comuni/wizard-summary-infolist-runtime-fix-2026-04-22.md): riepilogo segnalazione Design Comuni governato da entry Infolist nel widget Fixcity.
- [context-compression-plugin-runtime](../context-compression-plugin-runtime.md): regola Sixteen per non caricare in blocco report/screenshot/raw HTML e usare LLM Wiki/QMD.

- [context overflow compression rule](./concepts/context-overflow-compression-rule.md): workflow Sixteen anti overflow per audit visuali e Design Comuni
- [route target recheck rule](./concepts/route-target-recheck-rule.md): un fix Sixteen non e' chiuso finche' la route finale reale non viene ricontrollata nel runtime del tema
