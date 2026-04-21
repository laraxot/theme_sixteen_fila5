# Sixteen Wiki Log

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
  - regola DRY + KISS fissata: eventuali estrazioni solo sotto `resources/views/components/sections/header/`, mai come nuovo header parallelo
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
