# Sixteen Wiki Log

## [2026-04-27] sync | reusable search component discipline from Geo
- recepita regola cross-modulo: pattern search dei picker va estratto in componente riutilizzabile.
- riferimento: `../../../Modules/Geo/docs/wiki/concepts/reusable-search-ui-component-rule.md`.

## [2026-04-27] verifica | story 8-61 — screenshot runtime admin map con blocker 500
- raccolto screenshot contesto route admin: `scripts/admin-map-context.png`.
- diagnostica visuale: la pagina non renderizza il form mappa perche' cade prima in 500 (`Unsupported cipher or incorrect key length`).
- allineato boundary: in questo stato la mappa non e' verificabile, priorita al ripristino bootstrap Laravel.

## [2026-04-27] fix | story 8-59 — script credenziali da .env + placement map_diagnostic
- aggiornato `scripts/inspect-fixcity-admin-ticket-create-map.cjs` per leggere credenziali admin solo da `laravel/.env` (niente hardcoded).
- aggiunto `scripts/map_diagnostic.py` nella cartella `scripts` esistente del tema, conforme alla regola placement.
- formalizzata regola in `concepts/theme-owned-scripts-rule.md` (no credenziali hardcoded, no nuove cartelle root scripts/bashscripts).

## [2026-04-27] sync | geo admin map lens and controls visibility
- recepito fix cross-modulo su route admin ticket create: lente search ridimensionata e controlli mappa Lit resi sempre visibili.
- riferimento: `../../../Modules/Geo/docs/wiki/concepts/admin-map-magnifier-and-controls-visibility.md`.

## [2026-04-27] sync | lit light-dom map controls and reactive state
- recepito aggiornamento modulo Geo su `CoordinatePicker` Lit in Light DOM (iniezione CSS text esplicita).
- recepito fix reattivita stato coordinate lato bridge Alpine/Livewire (pattern immutabile).
- riferimento: `../../../Modules/Geo/docs/wiki/concepts/lit-light-dom-map-controls-and-sync.md`.

## [2026-04-27] sync | geo module build contract and runtime dependency
- recepito fix build modulo Geo (`vite.config.js` entry reali + sintassi `coordinate-picker-lit.js`).
- allineato il tema al principio: stabilita runtime mappa dipende anche dalla salute build del modulo owner Geo.
- riferimento: `../../../Modules/Geo/docs/wiki/concepts/geo-vite-build-contract.md`.

## [2026-04-27] verifica | admin map route visual check
- route admin `fixcity/admin/tickets/create` raggiunta e verificata in step `form.data::data::wizard-step`.
- confermata separazione contesto: runtime admin dipende dalla chain asset Geo (non dal solo CSS frontoffice del tema).
- recepita evidenza cross-modulo: fallback a `themes/Geo/js/map-picker-component.js` con asset mancanti su `/modules/geo/`.
- dopo hardening Geo, verificata chain locale-first: `themes/Geo/js/geo.js` caricato correttamente (HEAD/GET 200) e nessun ricorso primario a `unpkg`.

## [2026-04-27] sync | fixcity admin map asset chain analysis
- recepita analisi runtime della route `fixcity/admin/tickets/create`.
- confermato che il tema non deve sostituire la catena runtime canonica della mappa con fallback legacy.
- riferimento operativo: `../../../Modules/Fixcity/docs/stories/wizard-map-runtime-asset-chain.md`.
- collegamento architetturale: `../../../Modules/Fixcity/docs/wiki/log.md`.

## [2026-04-27] governance | obsidian vault alignment for theme docs
- aggiunta pagina `concepts/obsidian-vault-alignment.md`.
- fissata checklist minima index/log/link cross-modulo per evitare docs non ingestite.
- ingest knowledge base eseguito a livello progetto (`qmd update`) dopo update tema/moduli.

## [2026-04-27] governance | frontoffice vs admin panel style ownership
- aggiunta pagina `concepts/filament-admin-style-ownership-boundary.md`.
- chiarito che Sixteen governa frontoffice; bug visuali mappa in panel admin vanno validati nel contesto Filament admin.

## [2026-04-27] sync | policy matrix awareness in theme docs
- collegata la matrice policy modulo-per-modulo alla documentazione tema.
- ribadito che Sixteen non sceglie la base policy: renderizza capability backend.

## [2026-04-27] governance | policy rendering boundary with backend ACL
- chiarito boundary tema: Sixteen non sceglie tra `UserBasePolicy` e `XotBasePolicy`.
- il tema renderizza solo stati autorizzativi gia' risolti lato backend.
- nuova pagina: `concepts/policy-rendering-boundary.md`.

## [2026-04-27] sync | profiles owner boundary anti-regressione
- recepita regola aggiornata: nessuna migrazione additiva `add_*_to_profiles_table` nei moduli non owner.
- caso reale rimosso dal modulo User: `2026_04_27_000000_add_credits_to_profiles_table.php`.
- owner unico confermato: `Modules/Fixcity/...create_profiles_table.php`.

## [2026-04-27] sync | profiles migration nullable credits contract
- allineata knowledge cross-layer al fix profilo: `credits` e' opzionale e non deve bloccare il flusso UI/registrazione.
- riferimento modulo: `../../../Modules/Fixcity/docs/wiki/concepts/profiles-uuid-contract.md`.
- riferimento root: `../../../../docs/wiki/concepts/profiles-uuid-single-migration-rule.md`.

## [2026-04-23] governance | Route target recheck nel runtime reale del tema
- documentata la regola `route-target-recheck-rule`
- per fix visuali/runtime Sixteen serve recheck della route finale reale dopo build/copy asset, non basta il controllo del componente isolato

## [2026-04-23] governance | Theme bundle integration false friends
- Documentate best practices, bad practices e false friends sull'integrazione bundle del tema con componenti Lit/modulari.
- Regola centrale: il tag custom nel Blade non basta; import in `resources/js/app.js`, build, copy e verifica URL reale sono parte del contratto.
- Nuova pagina: `concepts/theme-bundle-integration-false-friends.md`.

## [2026-04-23] fix | GeopointPicker JS missing from theme bundle
- **problema**: `<geopoint-picker-lit>` non viene riconosciuto dal browser perché il JS non era importato in `app.js`
- **fix**: aggiunto import in `resources/js/app.js` e rebuild tema
- **wiki**: `concepts/geo-lit-components-must-be-imported-rule.md`
- **modules wiki**: `Modules/Geo/docs/wiki/concepts/geopoint-picker-map-invisible-wizard-fix.md`

## [2026-04-23] deletion | Removed redundant Folio page segnalazione-crea.blade.php
- **file removed**: `resources/views/pages/segnalazione-crea.blade.php`
- **reason**: duplicated CMS-driven page (`tests.segnalazione-crea.json` → block view → wizard). Shadowed Folio page with its own route name created confusion; the only production channel is CMS JSON blocks.
- **wiki**: `concepts/no-cms-shadowed-folio-pages-rule.md`

## [2026-04-23] discovery | CMS block architecture for segnalazione-crea
- **sources**: `resources/views/pages/tests/[slug].blade.php`, `config/local/fixcity/database/content/pages/tests.segnalazione-crea.json`, `resources/views/components/blocks/tests/segnalazione-crea.blade.php`
- **decision**: URL /it/tests/segnalazione-crea è CMS-driven (JSON → block view → widget), NON Folio hardcoded. Il tema Sixteen definisce block view come thin wrapper.
- **wiki**: `concepts/theme-cms-block-architecture-segnalazione-crea.md`

## [2026-04-22] contract | public wizard map stability without page css
- **sources:** `Modules/Geo/resources/js/components/coordinate-picker-lit.js`, `docs/wiki/concepts/no-page-specific-css.md`
- **decision:** la stabilita visuale della mappa nei wizard pubblici dipende da box/layout tema stabili e da runtime Geo debounced; il tema non deve introdurre CSS per pagina o workaround JS per compensare flicker runtime.
- **wiki:** `concepts/leaflet-map-flicker-visual-contract.md`

## [2026-04-23] fix | segnalazione-crea map flicker + geolocate when empty
- **sources:** `Modules/Geo/resources/js/components/coordinate-picker-lit.js`, `Modules/Fixcity/app/Filament/Widgets/CreateTicketWizardWidget.php`, `Themes/Sixteen/resources/css/app.css`
- **root cause:** refresh loop troppo aggressivo (invalidate + tile redraw + setView ripetuti) causava lampeggio; coordinate vuote senza `geolocateWhenEmpty()` non centravano sulla posizione corrente.
- **decision:** refresh con invalidate differito, redraw tile solo su `tileerror`/fullscreen; `CoordinatePicker` dello step dati configurato con `->geolocateWhenEmpty()`.

## [2026-04-23] fix | segnalazione-crea navbar green + map fullscreen contracts
- **sources:** `resources/css/app.css`, `resources/views/components/sections/header/v1.blade.php`, `docs/wiki/concepts/segnalazione-crea-navbar-green-contract.md`, `docs/wiki/concepts/coordinate-picker-fullscreen-wizard-contract.md`, `Modules/Geo/docs/wiki/concepts/coordinate-picker-fullscreen-wizard-contract.md`, `Modules/Fixcity/docs/wiki/concepts/segnalazione-crea-map-fullscreen-contract.md`
- **root cause header:** documentazione precedente indicava navbar chiara/theme-light-desk e `app.css` aveva blocchi header duplicati; cambiando un blocco intermedio il blu/bianco poteva vincere ancora.
- **root cause map:** fullscreen solo CSS + `body.overflow=hidden` non bloccava sempre `html`/stacking context wizard; Leaflet richiede refresh dopo transizione.
- **decision:** navbar `segnalazione-crea` verde `#007a52`; coordinate-picker fullscreen usa contratto browser fullscreen + classe document-level e refresh differiti.

## [2026-04-22] governance | No page-specific CSS — Design Comuni principle
- **regola**: vietato `.ticket-wizard-root`, `[data-slug="..."]` o qualsiasi selettore CSS per pagina/widget specifico
- **principio**: Design Comuni ufficiale usa solo selettori di componente (`.it-*`); un wizard è un componente, non "la pagina segnalazione-crea"
- **varianti**: usare props/attributi sul componente, non il nome della pagina come discriminante CSS
- **rule**: `bashscripts/ai/.claude/rules/no-page-specific-css.md`
- **wiki concept**: `laravel/Themes/Sixteen/docs/wiki/concepts/no-page-specific-css.md`
- **memory**: `memory/feedback_no_page_specific_css.md`

## [2026-04-22] ops | context-mode + QMD per docs tema e story BMAD
- **regola root**: `docs/wiki/concepts/context-compression-discipline.md`
- **scope Sixteen**: per story su wizard/header/parity non caricare l'intero corpus tema; usare QMD/context-mode e passare allo skill solo indici, concetti wiki e snippet essenziali.
- **verifica**: context-mode plugin/MCP connessi; QMD aggiorna `theme-sixteen` con 1005 file indicizzati.

## [2026-04-22] governance | getSummarySchema wizard con Infolists
- **regola**: i riepiloghi wizard Sixteen/Fixcity devono usare Filament Infolists in `getSummarySchema()`; `SchemaView` non e' ammesso per summary read-only strutturati.
- **root wiki**: `docs/wiki/concepts/filament-summary-infolist-rule.md`
- **fonte ufficiale**: https://filamentphp.com/docs/5.x/infolists/overview
- **nota DRY + KISS**: linkare la regola root dagli indici locali, non duplicare esempi divergenti.

## [2026-04-21] governance | header segnalazione — una sola fonte CSS + wiki kit
- **sources:** `laravel/Themes/Sixteen/resources/views/components/layouts/main.blade.php`, `laravel/Themes/Sixteen/resources/views/components/sections/header/v1.blade.php`, `laravel/Themes/Sixteen/resources/css/app.css`, `laravel/Themes/Sixteen/docs/wiki/concepts/header-color-parity.md`, `docs/wiki/index.md`, `docs/wiki/concepts/header-section-owner-rule.md`
- **summary:** eliminato `<style>` inline duplicato e link 404 a override esterni; regola Design Comuni (repo + GitHub Pages) e anti-pattern “navbar tutta verde” descritti in `header-color-parity.md`; commento SSoT in `app.css`.
- **riferimento:** [italia/design-comuni-pagine-statiche](https://github.com/italia/design-comuni-pagine-statiche)

## [2026-04-21] story | 8-40 segnalazione-crea — navbar bianca + bundle map
- **sources:** `resources/css/app.css` (`.it-header-wrapper.is-segnalazione-crea …`), `resources/views/components/layouts/main.blade.php` (override fine `<head>` dopo CDN BI 2.18 + Vite), `resources/views/components/sections/header/v1.blade.php` (classe BI **`theme-light-desk`** su `.it-header-navbar-wrapper` quando `tests/segnalazione-crea` — default BI è `background:#06c`), `resources/js/app.js` (rimosso `filament/map-picker.js` duplicato).
- **riferimento visivo:** [Design Comuni segnalazione-02-dati](https://italia.github.io/design-comuni-pagine-statiche/sito/segnalazione-02-dati.html).
- **build:** `npm run build` tema Sixteen dopo modifiche Geo/JS.

## [2026-04-21] fix | header nav links background — design-comuni-global.css

- **sources:** `resources/css/design-comuni-global.css`
- **summary:** `.it-header-center-wrapper` e `.it-header-navbar-wrapper` corretti da `#007a52` (verde) a `#fff`; `.navbar-nav .nav-link` e `.navbar-secondary .nav-link` corretti da `#fff` a `#0066CC` (blu istituzionale). Allineamento visuale con reference Design Comuni `segnalazione-02-dati.html`.

## [2026-04-21] fix | segnalazione-crea header/nav parity reale su section owner

- **sources:** `resources/views/components/sections/header/v1.blade.php`, `resources/css/app.css`, `../../Modules/Fixcity/resources/views/filament/widgets/ticket-create-wizard.blade.php`
- **summary:** applicata classe owner-side `is-segnalazione-crea` direttamente sull'header reale; rimosse override colore fragili nel widget wizard; forzati navbar/slim bar verdi con link trasparenti (niente background blu sui link); allineata posizione hamburger su mobile (sinistra logo, centrato verticalmente); nascosto header wizard Filament duplicato per eliminare linea verde centrale nello stepper.
- **build:** `npm run build && npm run copy` eseguiti con successo.

## [2026-04-21] fix | segnalazione-crea crash su component alias filament non risolto

- **sources:** `../../Modules/Geo/resources/views/filament/forms/components/coordinate-picker.blade.php`
- **summary:** rimossa invocazione legacy `x-filament-forms::field-wrapper.error-message` non disponibile nella versione Filament corrente; il crash bloccava il rendering del wizard in `/it/tests/segnalazione-crea`.
- **artifact:** `../../Modules/Geo/docs/wiki/troubleshooting/filament-field-wrapper-error-message-missing.md`

## [2026-04-21] governance | forbidden folders zero tolerance recepita

- **sources:** `../../../../docs/wiki/concepts/forbidden-folders-zero-tolerance-rule.md`
- **summary:** per tema Sixteen recepita regola strutturale: non devono esistere `docs/archive`, `_docs`, `lang/lang`; mantenere solo percorsi canonici.

## [2026-04-21] story | 8-41 segnalazione-crea css dedup header-stepper-hamburger parity

- **sources:** `resources/css/app.css`, `resources/views/components/sections/header/v1.blade.php`, `../../Modules/Fixcity/resources/views/filament/widgets/ticket-create-wizard.blade.php`
- **summary:** creata story dedicata al cleanup dei blocchi CSS duplicati/conflittuali della pagina `tests/segnalazione-crea`, con focus su header link background, posizionamento hamburger, menu aperto mobile e artifact stepper.
- **artifact:** `../../../../../_bmad-output/implementation-artifacts/8-41-segnalazione-crea-css-dedup-header-stepper-hamburger-parity.md`

## [2026-04-21] audit | parity segnalazione-privacy (header colori, cta, responsive)

- **sources:** `../../Modules/Fixcity/resources/views/filament/widgets/ticket-create-wizard.blade.php`, `resources/css/app.css`
- **summary:** confronto visuale locale vs reference Design Comuni su mobile/tablet/desktop; colori header allineati (`slim` verde scuro, barra nav verde), rimossa CTA duplicata `Successivo`; `Accedi all'area personale` forzato al verde istituzionale.
- **cta rule:** `Avanti` riposizionato sotto checkbox privacy su tutti i breakpoint.
- **artifact:** `concepts/segnalazione-privacy-parity-audit.md`

## [2026-04-21] governance | no docs/archive per nuova documentazione tema

- **summary:** fissata regola locale: niente nuovi file in `Themes/Sixteen/docs/archive/`; nuova conoscenza solo in `docs/wiki/` e `docs/raw/`.
- **artifact:** `concepts/no-docs-archive-rule.md`

## [2026-04-21] governance | struttura wiki tema canonica e sacra

- **summary:** recepita regola root sulla struttura wiki canonica, inclusi `_archive` e `_templates` come parti valide del wiki.
- **artifact:** `../../../../docs/wiki/concepts/wiki-sacred-structure-rule.md`

## [2026-04-21] ui | segnalazione-crea cta parity (avanti unico)

- **sources:** `../../Modules/Fixcity/resources/views/filament/widgets/ticket-create-wizard.blade.php`, `resources/css/app.css`
- **summary:** eliminata la doppia percezione CTA nel wizard (`Successivo` + `Avanti`) mantenendo una sola CTA primaria visibile (`Avanti`) in linea con il pattern Design Comuni; risolti marker di merge residui in `resources/css/app.css`.
- **build:** eseguiti `npm install`, `npm run build`, `npm run copy`.
- **refinement:** allineate classi pulsanti navigazione wizard (`fw-bold`, `btn-next`, `btn-prev`) per miglior parity sui CTA.

## [2026-04-21] fix | livewire queryexception su cache table

- **sources:** `../../database/migrations/2026_04_21_111944_create_cache_table.php`
- **summary:** risolto errore 500 `SQLSTATE[42S02]` su `POST /livewire-*/update` dovuto a tabella `cache` assente; creata anche `cache_locks` con migrazione mirata.
- **guardrail:** per frontoffice con Livewire, garantire disponibilità tabelle cache quando lo store runtime può risolvere su database.
- **artifact:** `concepts/livewire-cache-table-rate-limiter.md`
- **hardening:** resa idempotente la migrazione duplicata `2026_04_21_112114_create_cache_table` per prevenire regressioni su migrate completi.

## [2026-04-21] fix | catena errori 404 + livewire/alpine bootstrap

- **sources:** `resources/views/components/layouts/main.blade.php`, `../../Modules/Geo/resources/views/filament/forms/components/map-picker.blade.php`
- **summary:** rimossi `<link>` hardcoded verso `/themes/Sixteen/css/*` non presenti nel deploy; mantenuto solo bundle Vite.
- **deploy:** pubblicato `themes/Geo/js/geo.js` nel webroot attivo (`public_html/themes/Geo/js/geo.js`).
- **runtime:** riallineati asset Livewire/Filament (`livewire:publish --assets`, `filament:assets`) e pulita cache (`optimize:clear`).
- **resilienza:** `geoMapPickerField` registrato sia in init immediata sia in hook `alpine:init`.
- **artifact:** `concepts/segnalazione-runtime-asset-integrity.md`

## [2026-04-21] refactor | lit component ownership fuori da blade

- **sources:** `../../Modules/Geo/resources/views/filament/forms/components/map-picker.blade.php`, `resources/js/app.js`
- **summary:** eliminata definizione LitElement inline in Blade del map picker; runtime componente demandato al file JS modulo importato nel bundle tema.
- **import:** aggiunto `@modules/Geo/resources/js/filament/map-picker.js` in `resources/js/app.js`.
- **guardrail:** Blade = host/binding; LitElement = solo JS component module.

## [2026-04-21] governance | no absolute paths in git-tracked config (project-wide)

- **sources:** `../../../../../laravel/.mcp.json`, `../../../../../docs/wiki/concepts/no-absolute-paths-in-config.md`
- **summary:** recepita nel tema la regola di portabilita del progetto: file config tracciati da git non devono contenere path assoluti legati a una macchina locale; usare path relativi e variabili env.

## [2026-04-21] governance | Blade extraction generale + header partials

- sources:
  - `../../../../docs/wiki/concepts/blade-component-extraction-governance.md`
  - `../../../../docs/wiki/concepts/sixteen-header-composition-rule.md`
  - `../../../../../memory/feedback_sixteen-header-v1-ssot.md`
- summary:
  - confermata la regola: cercare componenti riusabili in tutte le Blade del tema, non solo in `header/v1.blade.php`
  - per blocchi locali a una section usare `partials/` sotto la directory owner
  - per blocchi locali all'header Sixteen usare `resources/views/components/sections/header/partials/`; `v1.blade.php` resta owner

## [2026-04-21] story | 8-37 Blade reusable extraction e header partials

- sources:
  - `../../../../../_bmad-output/implementation-artifacts/8-37-blade-reusable-components-extraction-and-header-partials-governance.md`
  - `../../../../docs/wiki/concepts/sixteen-header-composition-rule.md`
- summary:
  - fissata la regola generale: cercare componenti riusabili in tutte le Blade del tema
  - se un componente e' locale all'header `v1.blade.php`, va messo sotto `resources/views/components/sections/header/partials/`
  - `v1.blade.php` resta owner/orchestratore; i partial non diventano owner

## [2026-04-21] implement | Story 8-36 — header v1 sottocomponenti DRY/KISS consolidati

- **sources:** `resources/views/components/sections/header/v1.blade.php`, `resources/views/components/sections/header/personal-area-guest-cta.blade.php`, `resources/views/components/sections/header/personal-area-guest-parity.blade.php`, `resources/views/components/sections/header/user-dropdown.blade.php`
- **summary:** consolidati sotto il section owner i blocchi guest CTA, guest parity dropdown e user dropdown autenticato; `v1.blade.php` resta source of truth e orchestration layer dell'header.
- **guardrail:** l'estrazione riduce il rumore ma non cambia l'owner runtime di `<x-section slug="header" />`.

## [2026-04-20] governance | Story 8-35 — SSoT header = `components/sections/header/v1.blade.php`

- **sources:** `../../../../docs/wiki/concepts/header-section-owner-rule.md`, `../../../../../memory/feedback_sixteen-header-v1-ssot.md`, artifact 8-35
- **summary:** regola esplicita per LLM e sviluppatori: `<x-section slug="header" />` → unico blade owner `resources/views/components/sections/header/v1.blade.php`; allineati MEMORY, AGENTS, cursor rules, wiki root; corretto drift su `bootstrap-italia/header` come finta SSoT.
- **index:** [wiki index](./index.md)

## [2026-04-20] implement | Story 7-54 — dropdown slim senza Alpine inline su wizard Livewire

- **sources:** `resources/views/components/sections/header/v1.blade.php`, `resources/js/app.js`, artifact `7-54-segnalazione-crea-header-slim-dropdowns-data-bs-toggle-unification.md`
- **summary:** lingua e utente autenticato usano `data-bs-toggle="dropdown"` (stesso wiring del blocco guest parity e del polyfill `DOMContentLoaded` in `app.js`). Rimosso `x-data`/`x-show` che su `/tests/segnalazione-crea` potevano non inizializzarsi. Rimosso override `background-color: #0066CC` inline sulla slim bar; sfondo da `design-comuni-tokens.css`. Avatar con `img` arrotondato + bordo chiaro se URL presente.
- **wiki:** [header-authenticated-state](./concepts/header-authenticated-state.md), [header-slim-dropdown-behavior](./concepts/header-slim-dropdown-behavior.md)

## [2026-04-20] rule | header SSoT del section layout

- sources:
  - `resources/views/components/sections/header/v1.blade.php`
  - `../../../../docs/wiki/concepts/header-section-owner-rule.md`
- summary:
  - fissata come regola permanente del tema: se il layout usa `<x-section slug="header" />`, l'header owner e fonte di verita e' `components/sections/header/v1.blade.php`
  - `bootstrap-italia/header.blade.php` non va assunto come owner automatico per `segnalazione-crea`

## [2026-04-20] story | 8-36 header subcomponents extraction sotto sections/header

- sources:
  - `resources/views/components/sections/header/v1.blade.php`
  - `../../../../../_bmad-output/implementation-artifacts/8-36-header-section-v1-subcomponents-extraction-dry-kiss.md`
  - `../../../../../.planning/stories/8-36-header-section-v1-subcomponents-extraction-dry-kiss.story.md`
- summary:
  - creata story dedicata per estrarre blocchi riusabili dal section header mantenendo `v1.blade.php` come owner
  - candidati espliciti: language switcher, user dropdown, guest CTA e blocchi presentazionali affini
  - regola DRY + KISS aggiornata da story 8-37: eventuali estrazioni locali all'header solo sotto `resources/views/components/sections/header/partials/`, mai come nuovo header parallelo
  - wiki root: [sixteen-header-composition-rule](../../../../docs/wiki/concepts/sixteen-header-composition-rule.md); aggiornati README tema, AGENTS, MEMORY, `.cursor/rules/sixteen-header-v1-ssot.mdc`

## [2026-04-20] implement | header slim segnalazione-crea fixato nel section owner reale

- sources:
  - `resources/views/components/sections/header/v1.blade.php`
  - `resources/js/app.js`
  - `resources/css/app.css`
  - `./concepts/header-authenticated-state.md`
- summary:
  - corretto il path owner reale del runtime `segnalazione-crea`: l'header passa da `<x-section slug="header" />` e va fissato in `components/sections/header/v1.blade.php`
  - rimossi i dropdown Alpine inline dal section header; ora lingua e utente usano il wiring unico `data-bs-toggle="dropdown"` gia gestito da `app.js`
  - riallineato il blocco utente al reference `Mario Rossi`: nome in primo piano, avatar secondario, chevron e menu coerenti con slim header
  - build tema eseguita con successo; restano solo warning noti su asset logo risolti a runtime

## [2026-04-20] rule | dropdown slim header runtime-critical e color-parity

- sources:
  - `./concepts/header-authenticated-state.md`
  - `https://italia.github.io/design-comuni-pagine-statiche/servizi/graduatoria-area-personale.html`
  - `_bmad-output/implementation-artifacts/8-33-segnalazione-crea-header-language-and-user-dropdown-functional-color-parity.md`
- summary:
  - fissato il guardrail: dropdown lingua e dropdown utente nel slim header devono funzionare nel runtime reale
  - la parity richiesta include anche i colori e gli stati visuali dei menu aperti/chiusi
  - il quality gate corretto e' screenshot-driven su pagina reale come `segnalazione-crea`

## [2026-04-20] implement | header owner-side con display name e avatar fallback raffinati

- sources:
  - `resources/views/components/bootstrap-italia/header.blade.php`
- summary:
  - raffinata la risoluzione del blocco personale autenticato nel componente owner dell'header
  - display name risolto in ordine `full_name` → `first_name + last_name` → `name` → `email`
  - avatar risolto in ordine `profile_photo_url` → `profile_photo_path` → icona fallback owner-side
  - nickname e chevron del menu utente resi visibili anche fuori dal solo desktop largo

## [2026-04-20] wiki | header guest/auth — fonte di verità e anti-regressione

- sources:
  - `./concepts/header-authenticated-state.md`
  - `../../../../../.planning/stories/5.0-header-logged-in-state.story.md`
  - `../../../../../.cursor/rules/design-comuni-header-auth-state.mdc`
- summary:
  - pagina concetto aggiornata: `bootstrap-italia/header` + `pub_theme::ui.personal_area` / `header_area_personale.*`
  - guest: solo CTA «Accedi all'area personale»; auth: avatar + nickname + dropdown + POST logout
  - screenshot: confrontare guest vs auth su stessa URL (es. `tests/segnalazione-crea`)

## [2026-04-20] ui | header slim area personale se autenticato (Design Comuni)

- sources:
  - `resources/views/components/bootstrap-italia/header.blade.php`
  - `lang/it/ui.php`, `lang/en/ui.php`
- summary:
  - su pagine che usano `<x-bootstrap-italia.header />` il slim header mostra nome utente + dropdown (servizi, pratiche, notifiche, impostazioni, esci) come reference `segnalazione-area-personale.html`
  - ospite: pulsante verso `route('login')` e copy da `pub_theme::ui.personal_area`
  - testi menu da `pub_theme::ui.header_area_personale.*` (struttura a 5 elementi per label)

## [2026-04-20] i18n | login view without italian literal phrases

- sources:
  - `resources/views/pages/auth/login.blade.php`
  - `../../../Modules/User/lang/it/auth.php`
  - `../../../Modules/User/lang/en/auth.php`
- summary:
  - rimosse frasi italiane inline dalla view del tema
  - la view usa solo chiavi traduzione dal modulo `User` (`user::auth.login.page.*`)
  - mantenuta coerenza DRY: copy condivisa cross-theme nel modulo di dominio

## [2026-04-20] ui | login auth riallineata a design comuni con widget filament

- sources:
  - `resources/views/pages/auth/login.blade.php`
  - `resources/views/filament/widgets/auth/login.blade.php`
  - `../../../Modules/User/app/Filament/Widgets/Auth/LoginWidget.php`
- summary:
  - la pagina `/it/auth/login` ora usa un layout visivo coerente con il linguaggio Design Comuni (hero informativa + card servizio)
  - mantenuto il principio architetturale: il form resta nel `LoginWidget` Filament (modulo User), il tema gestisce il vestito
  - semplificato il widget style per coerenza con componenti pubblici del tema

## [2026-04-20] ui | zoom mappa con svg standard e no underline

- sources:
  - `../../Modules/Geo/resources/js/components/coordinate-picker-field.js`
  - `../../Modules/Fixcity/app/Filament/Widgets/CreateTicketWizardWidget.php`
- summary:
  - resa uniforme la UI dei controlli zoom (`+/-`) con icone SVG standard e senza sottolineatura
  - aumentato zoom iniziale del `MapPicker` di test (`location1`) a 15

## [2026-04-20] ui | controlli zoom mappa allineati a toolbar custom

- sources:
  - `../../Modules/Geo/resources/js/components/coordinate-picker-field.js`
- summary:
  - pulsanti `+/-` Leaflet allineati al look&feel dei controlli custom (`layer/fullscreen/current position`)
  - aggiornate icone fullscreen/locate con simboli standard orientati all'abitudine utente

## [2026-04-20] build | rebuild tema dopo marker custom mappicker

- sources:
  - `../../Modules/Geo/resources/js/components/map-picker-marker-config.js`
- summary:
  - recepito marker SVG custom runtime del `MapPicker` nel bundle tema
  - mantenuto fallback marker locale, senza introduzione di dipendenze esterne

## [2026-04-20] governance | mappicker runtime ux recepita nel tema

- sources:
  - `../../Modules/Geo/resources/js/components/coordinate-picker-field.js`
  - `../../Modules/Geo/resources/views/filament/forms/components/coordinate-picker.blade.php`
  - `../../Modules/Geo/docs/wiki/concepts/mappicker-runtime-ux.md`
- summary:
  - recepita nel tema la regola runtime: coordinate iniziali mancanti in `MapPicker` => geolocalizzazione corrente
  - allineata la semantica di stato per evitare mappe inizializzate con coordinate spurie

## [2026-04-20] governance | mappicker xotbasefield recepito nel tema

- sources:
  - `../../Modules/Geo/app/Filament/Forms/Components/MapPicker.php`
  - `../../Modules/Geo/docs/wiki/concepts/mappicker-xotbasefield-rule.md`
- summary:
  - recepita nel tema la regola strutturale: `MapPicker` estende `XotBaseField` e non dipende da sibling field
  - ridotto rischio di regressioni runtime nei wizard con piu varianti mappa

## [2026-04-20] build | rebuild tema dopo fix mappicker (overlay, address readout, marker, fullscreen)

- sources:
  - `../../Modules/Geo/resources/views/filament/forms/components/coordinate-picker.blade.php`
  - `../../Modules/Geo/resources/js/components/coordinate-picker-field.js`
  - `public/assets/app-Cin6PdhR.js`
- summary:
  - rigenerato bundle runtime del tema con fix visuali/funzionali su `MapPicker` (`location1`)
  - eliminato overlap tra layer control e toolbar custom, migliorata gestione fullscreen

## [2026-04-20] build | rebuild tema dopo fix visibilita mappa e fullscreen reattivo

- sources:
  - `Modules/Geo/resources/js/components/geo-latlng-input.js`
  - `public/assets/app-V_uIqEqu.js`
  - `public/manifest.json`
- summary:
  - rigenerato bundle tema dopo fix runtime su `LatitudeLongitudeInput` (tile map visibili)
  - riallineata reattivita pulsante fullscreen nel web component Lit in Light DOM

## [2026-04-20] build | rebuild tema dopo autolocate-on-init per latitudelongitudeinput

- sources:
  - `Modules/Geo/resources/views/filament/forms/components/latitude-longitude-input-lit.blade.php`
  - `Modules/Geo/resources/js/components/geo-latlng-input.js`
  - `public/assets/app-iVHx4Bly.js`
- summary:
  - rigenerato bundle tema con supporto `auto-locate-on-init` quando coordinate iniziali sono null
  - mantenuta visibilità controlli mappa (layer/fullscreen/locate) nel wizard

## [2026-04-20] fix | latitudelongitudeinput runtime ux allineata nel tema

- sources:
  - `../../Modules/Geo/resources/views/filament/forms/components/latitude-longitude-input-lit.blade.php`
  - `../../Modules/Geo/resources/js/components/geo-latlng-input.js`
- summary:
  - recepita nel tema la regola runtime: su coordinate null avvio autolocate automatico
  - confermata necessità di mantenere visibili i controlli layer/fullscreen/locate nel flusso wizard

## [2026-04-20] governance | latitudelongitudeinput allineato a xotbasefield

- sources:
  - `../../Modules/Geo/app/Filament/Forms/Components/LatitudeLongitudeInput.php`
  - `../../Modules/Geo/docs/wiki/concepts/latitudelongitudeinput-xotbasefield-rule.md`
- summary:
  - recepita nel tema la regola architetturale Laraxot: `LatitudeLongitudeInput` non dipende da `CoordinatePicker`
  - ridotto coupling tra picker sibling e migliorata stabilità evolutiva lato UI runtime

## [2026-04-20] build | rebuild tema dopo fix fullscreen/drag in geolatlnginput

- sources:
  - `Modules/Geo/resources/js/components/geo-latlng-input.js`
  - `public/assets/app-bhwe-_Wn.js`
  - `public/manifest.json`
- summary:
  - eseguiti `npm run build` e `npm run copy` per distribuire fix runtime del picker legacy
  - rimane warning ambiente Node (< 20.19) ma build completata con successo

## [2026-04-20] build | rebuild tema dopo dedup input lat/lng nel picker legacy

- sources:
  - `Modules/Geo/resources/js/components/geo-latlng-input.js`
  - `public/assets/app-CXkgYcr7.js`
  - `public/manifest.json`
- summary:
  - rigenerato bundle tema dopo rimozione doppia coppia input coordinate nel web component `geo-latlng-input`
  - eseguito anche `npm run copy` per allineare runtime in `public_html/themes/Sixteen`

## [2026-04-20] governance | allineamento tema a class selector policy per mappe Geo

- sources:
  - `../../Modules/Geo/docs/wiki/concepts/leaflet-class-selector-governance.md`
- summary:
  - recepita nel tema la regola di integrazione runtime: mount mappe via classi locali del componente, mai via id globali
  - ridotto rischio collisioni quando lo stesso step contiene piu picker

## [2026-04-20] audit | tema incluso nello scan selector id-based

- sources:
  - `resources/*`
  - `public/assets/*` (read-only audit)
- summary:
  - completata ricognizione pattern id-based nel tema; classificati i casi non picker-runtime come legacy/docs/assets compilati
  - confermata priorità di enforcement sui componenti mappa runtime del modulo Geo

## [2026-04-20] fix | wizard segnalazione runtime restore after latitudelongitudeinput getter mismatch

- sources:
  - `Modules/Geo/resources/views/filament/forms/components/latitude-longitude-input-lit.blade.php`
- summary:
  - ripristinata compatibilita runtime della pagina `/it/tests/segnalazione-crea` dopo convergenza su `CoordinatePicker`
  - eliminata dipendenza lato view da getter legacy `getDefault*` non presenti nel wrapper attuale

## [2026-04-20] hotfix | ripristino rendering mappa legacy nello step wizard

- sources:
  - `Modules/Geo/resources/views/filament/forms/components/latitude-longitude-input.blade.php`
  - `public/assets/app-CoVltwNO.js`
- summary:
  - fix rapido regressione visuale: `LatitudeLongitudeInput` tornato visibile nello step `/it/tests/segnalazione-crea`
  - preservati i blocchi mappa commentati nel widget Fixcity (nessuna rimozione)

## [2026-04-20] fix | wizard mappa legacy - toolbar layer/geoloc ripristinato

- sources:
  - `Modules/Geo/resources/views/filament/forms/components/latitude-longitude-input.blade.php`
  - `public/assets/app-4WPb1Mkc.js`
- summary:
  - nel flusso `/it/tests/segnalazione-crea` ripristinata inizializzazione runtime del picker legacy (`x-init`)
  - toolbar con layer switch e posizione corrente ora visibile/stabile anche nel layout wizard

## [2026-04-20] refactor | convergenza runtime picker geo nel bundle tema

- sources:
  - `resources/js/app.js`
  - `public/assets/app-4WPb1Mkc.js`
  - `public/manifest.json`
- summary:
  - aggiornato bundle con convergenza eventi e controlli picker (`coords-changed`, locate esplicito, fullscreen coerente)
  - allineata UX mappe nello scenario wizard `/it/tests/segnalazione-crea`

## [2026-04-20] fix | legacy latitudelongitudeinput toolbar e fullscreen runtime

- sources:
  - `Modules/Geo/resources/views/filament/forms/components/latitude-longitude-input.blade.php`
  - `Modules/Geo/lang/it/latitude_longitude_input.php`
- summary:
  - migliorata UX nello step mappa di `/it/tests/segnalazione-crea`: pulsante "usa posizione corrente" sempre visibile nel toolbar
  - fullscreen del picker legacy allineato a copertura completa viewport (edge-to-edge)

## [2026-04-20] dev | coordinatepicker geo - rebuild asset tema

- sources:
  - `resources/js/app.js`
  - `public/manifest.json`
  - `public/assets/app-C-lswTBj.js`
- summary:
  - rebuild Vite dopo consolidamento `CoordinatePicker` (Lit + Leaflet) nel modulo Geo
  - verificata disponibilita runtime del custom element importato nel bundle tema

## [2026-04-20] dev | mappa wizard segnalazione - rebuild asset tema

- sources:
  - `resources/js/app.js`
  - `public/manifest.json`
- summary:
  - rebuild Vite tema Sixteen dopo refactor selector class-based nei picker Geo
  - verificato runtime pagina `/it/tests/segnalazione-crea` con step mappa attivo

## [2026-04-15] init | wiki bootstrap

- Added schema, index, and theme adoption guide.
## [2026-04-21] rule | Header style layer, no inline parity CSS

- Consolidata regola Design Comuni: `v1.blade.php` resta owner markup/composizione; colori e background header vanno nel CSS/token layer.
- Rimosso l'anti-pattern dello `<style>` condizionale per `is-segnalazione-crea`.
- Nuova pagina: `concepts/header-style-layer-rule.md`.
# 2026-04-22

- Ingestita decisione Design Comuni: lo step riepilogo segnalazione resta renderizzato dal widget Fixcity con entry Infolist; il tema governa layout/parity CSS e non reintroduce `SchemaView` come riepilogo primario.
- Ingestita nota `context-compression-plugin-runtime`: Sixteen contiene corpus visuale ampio; consultare wiki/QMD e non caricare batch report completi se non necessario.
- Ingestita regola `theme-css-only-parity-rule`: Sixteen e' owner unico del CSS Design Comuni per `segnalazione-crea`; le Blade dei moduli non devono contenere `<style>` o inline style JS per la parity.
- Ingestita regola `filament5-schema-section-namespace-rule`: il tema non deve forkare la pagina Folio per casi singoli; renderizza lo schema widget corretto e lascia `Section` a Filament Schemas.
- Ingestita regola `filament5-schema-form-access-rule`: il tema renderizza `{{ $this->form }}`; il widget legge stato tramite `$this->form`, non `getForm('form')`.
- Ingestita regola `segnalazione-map-and-section-spacing-parity`: controlli mappa e spacing sezione Disservizio si governano dal CSS tema con build/copy.
- Rafforzata regola CSS Design Comuni: niente selettori per-page tipo `.page-content[data-slug="tests.segnalazione-crea"]` per correzioni riusabili; usare selettori semantici component/site-level.
- Rafforzata regola CSS Design Comuni: niente `.ticket-wizard-root` per comportamenti comuni di wizard; usare hook site/component-level e non specializzare il ticket wizard rispetto agli altri wizard.
- Aggiunto piano header-first per parity dello step riepilogo e submit canonico: `../../Modules/Fixcity/docs/stories/wizard-summary-step-header-and-submit-parity-plan.md`.
# 2026-04-22 - CSS parity wizard owner tema

- Aggiunta `concepts/theme-owned-wizard-css-parity-rule.md`.
- Spostati gli override CSS del wizard segnalazione dal Blade Fixcity a `resources/css/app.css`.
- Regola build: dopo CSS tema eseguire `npm run build` e `npm run copy` da `laravel/Themes/Sixteen`.

# 2026-04-22 - Header navbar green component rule

- Aggiunta `concepts/header-navbar-green-component-rule.md`.
- Documentata la causa ricorsiva dei regressi blu/bianco: Bootstrap Italia ridefinisce colori a livello wrapper, container, navbar, link, stati e media query.
- Regola: correggere sempre il componente header in `resources/css/app.css`, mai tramite selettori per pagina o `.ticket-wizard-root`.

# 2026-04-23 - CSS globale, niente selettori per pagina (wizard parity)

- Nuova pagina: `concepts/global-css-no-page-selectors-wizard-parity.md`.
- Ribadita regola tema: parity via CSS globale/component-level, non via `.page-content[data-slug="..."]` o classi per wizard specifici.
