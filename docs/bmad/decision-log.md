---
id: dl-sixteen-design-comuni-redesign
title: "Decision Log — Redesign Design Comuni Tema Sixteen"
type: decision-log
status: active
created: 2026-10-11
updated: 2026-10-11
owner: "@team-fixcity"
links:
  github_issue: "#150"
  architecture: "arc-sixteen-design-comuni-redesign"
---

# Decision Log — Redesign Design Comuni

## D1: Script non in laravel/scripts/ ma in bashscripts/
**Contesto**: Richiesta esplicita dell'utente.
**Decisione**: Tutti gli script di audit, build, design-comuni, accessibilità vanno in sottocartelle di `/bashscripts/` (es. `bashscripts/design-comuni/`, `bashscripts/audit/`). Documentati in `bashscripts/docs/`.
**Rationale**: Separazione tra codice applicazione (laravel) e strumenti di sviluppo/validazione. Rispetta la struttura esistente del repo.
**Stato**: ✅ Confirmato

## D2: Docs design system non a radice ma in laravel/Themes/Sixteen/docs/
**Contesto**: L'utente ha corretto l'errore di creare `/design-system/` a radice.
**Decisione**: Documentazione del design system, BMAD, implementazione, script documentati dentro `laravel/Themes/Sixteen/docs/` con struttura `bmad/`, `design-system/`, `implementation/`, `scripts/`.
**Rationale**: Il design system appartiene al tema Sixteen, che è già il tema Design Comuni. Non è un progetto separato.
**Stato**: ✅ Confirmato — file creato `laravel/Themes/Sixteen/docs/bmad/architecture.md`

## D3: Design-comuni.blade.php non duplicato (Sixteen già Design Comuni)
**Contesto**: `resources/views/layouts/design-comuni.blade.php` NON esiste; il tema usa `design-comuni/pages/homepage.blade.php`. L'utente ha spiegato che Sixteen è già il tema Design Comuni.
**Decisione**: NON creare un nuovo `design-comuni.blade.php`. Migliorare `resources/views/design-comuni/pages/homepage.blade.php` e i layout `base.blade.php` / `main.blade.php`. Documentare la logica in `docs/bmad/architecture.md`.
**Rationale**: Evitare duplicazione. Sixteen è già il tema di riferimento per Design Comuni.
**Stato**: ✅ Confirmato

## D4: Stack — NO Bootstrap, only Tailwind + Alpine + Lit + DaisyUI + Flowbite + Filament
**Contesto**: Richiesta esplicita. Bootstrap Italia è solo riferimento visivo (grafica), mai stack implementativo.
**Decisione**: Tutta la UI front-end usa Tailwind utilities + DaisyUI components + Flowbite extras + Lit web components + Alpine.js per interattività. Filament solo per admin/back-office. Bootstrap Italia NON importato come CSS/JS.
**Rationale**: Modern approach, lighter bundle, full control over tokens, no legacy framework lock-in.
**Stato**: ✅ Confirmato

## D5: Approccio Homepage — Lit-First (Variante C)
**Contesto**: Brainstorming (3 varianti).
**Decisione**: Usa Variante C (Lit Web Components per elementi ricorrenti + composizione Tailwind). Componenti: `<muni-navbar>`, `<muni-footer>`, `<muni-hero>`, `<muni-card-news>`, `<muni-card-service>`, `<muni-breadcrumb>`, `<muni-chip>`, `<muni-read-more>`, `<muni-skip-links>`.
**Rationale**: Design system reale, riutilizzabilità massima, testabilità isolata, coerenza con stack moderno.
**Stato**: ✅ Confirmato — da implementare in E01/E02

## D6: Pagina Segnalazione — Wizard Alpine (Variante A)
**Contesto**: Priorità massima (pagina `#segnalazione` di Design Comuni), 5 step (categoria → posizione → dettagli → contatti → riepilogo).
**Decisione**: Multi-step wizard con Alpine.js (`x-data="reportWizard()"`), validazione per step, mappa Leaflet per posizione, allegati foto, tracking codice riferimento. State management via Alpine store locale.
**Rationale**: UX guidata, accessibile, coerenza con flussi di servizio Design Comuni (graduatorie, permessi, prenotazioni).
**Stato**: ✅ Confirmato — da implementare in E04

## D7: Accessibilità — MAUVE valida ogni pagina, WCAG 2.1 AA come floor
**Contesto**: `https://mauve.isti.cnr.it/` caricata (WCAG 2.1, 44/78 criteria implementati). Design Comuni richiede inclusività PA.
**Decisione**: Ogni pagina validata con MAUVE prima del merge. Checklist: contrast APCA Lc ≥75 body, focus-visible su tutti interattivi, skip links, ARIA labels, semantic HTML, `prefers-reduced-motion` per animazioni.
**Rationale**: PA (Pubblica Amministrazione) richiede accessibilità obbligatoria. Non è opzionale.
**Stato**: ✅ Confirmato — script `bashscripts/design-comuni/audit-accessibility.sh` da creare

## D8: Design tokens — estratti da Design Comuni, non inventati
**Contesto**: `https://designers.italia.it/kit/comuni/` e `UI Kit Italia`.
**Decisione**: Token color, typography, spacing, radius, elevation definiti in `design-system/tokens.md` basandosi su Design Comuni v2.4.0. Nessun valore off-system. Accent unico (colore istituzionale PA, non viola/indigo).
**Rationale**: Design Comuni ha palette e regole precise. Inventare token = deviazione.
**Stato**: ⏳ Da creare in E01

## D9: Scripts in bashscripts/ + docs in bashscripts/docs/
**Contesto**: User request esplicita.
**Decisione**: `bashscripts/design-comuni/` per script audit/build; `bashscripts/docs/` per documentazione script. Nessun file in `laravel/scripts/`.
**Rationale**: Separazione chiara, rispetto regole repo.
**Stato**: ⏳ Da creare

## D10: No design-system/ a radice — tutto dentro Sixteen
**Contesto**: User ha corretto l'errore.
**Decisione**: Tutte le cartelle relative al redesign (docs, design-system, scripts, implementation, tests) dentro `laravel/Themes/Sixteen/`. Se serve qualcosa a livello progetto, solo symlink o riferimento, mai copia.
**Rationale**: Il tema è il proprietario della grafica, non il repo.
**Stato**: ✅ Confirmato

## D11: Header e footer sono sections CMS del tema
**Contesto**: Le shell pubbliche chiamano `<x-section slug="header" />` e
`<x-section slug="footer" tpl="full" />`; il CMS passa i blocchi localizzati al
renderer risolto dal tema.
**Decisione**: `header.json` e `footer.json` del tenant sono la fonte dei dati
per logo, nome, slogan, navigazione, lingua, account, contatti, social e link
legali. Sixteen possiede un solo renderer Tailwind/Alpine per ciascuna section;
non si usano `header-comune`, `footer-comune` o view Bootstrap come renderer
paralleli.
**Rationale**: una section è il confine corretto tra contenuto tenant e
presentazione del tema; mantiene SSR, accessibilità e riuso su `app`, `test` e
`guest` senza duplicare Design Comuni.
**Stato**: ✅ Implementato e verificato con view cache, test di localizzazione e
Playwright su 375/768/1440.

## D12: `tests/{slug}` è una route CMS dinamica, non una collezione di Blade
specifiche

**Contesto**: `/it/tests/homepage` era stato interpretato come motivo per
creare `resources/views/pages/tests/homepage.blade.php`. Questo rompe la
responsabilità del CMS e duplica il renderer per ogni pagina Design Comuni.

**Decisione**: `pages/tests/index.blade.php` gestisce esclusivamente il
catalogo `/it/tests`; `pages/tests/[slug].blade.php` gestisce ogni dettaglio,
compreso `homepage`, costruendo lo slug `tests.<slug>`. Il contenuto viene da
`config/local/fixcity/database/content/pages/tests.<slug>.json`; i componenti
riutilizzabili vivono in `resources/views/components/blocks/`.

**Layout**: il catalogo usa esplicitamente `<x-layouts.test>`; il dettaglio
dinamico usa `<x-layouts.app>`. Il campo JSON `layout` resta disponibile per i
wrapper CMS generici allow-listati, non per generare nuove view Folio.

**Rationale**: una route, un contratto CMS, nessuna duplicazione e possibilità
di aggiungere pagine modificando JSON e blocchi universali.

**Stato**: ✅ Confermato; `homepage.blade.php` non esiste.

## D13: nessun sotto-router semantico `tests/segnalazioni`

**Contesto**: creare `pages/tests/segnalazioni/[slug].blade.php` introduce un
secondo albero Folio per una famiglia di pagine, duplicando middleware, Volt,
layout e risoluzione CMS.

**Decisione**: tutti gli URL `/it/tests/{slug}`, inclusi
`/it/tests/segnalazioni-elenco`, `/it/tests/segnalazione-dettaglio` e gli step
del flusso, usano esclusivamente `pages/tests/[slug].blade.php`. Il valore
`slug` è il segmento completo dopo `tests/` e diventa `tests.<slug>`; i dati e
l'ordine dei blocchi arrivano dal JSON tenant corrispondente.

**Rationale**: Folio definisce il routing tecnico, mentre `tests.<slug>` è il
contratto editoriale CMS. Un sotto-percorso Blade chiamato `segnalazioni`
confonderebbe dominio e routing e renderebbe impossibile aggiungere pagine
senza creare nuove view.

**Stato**: ✅ Corretto; rimossi `tests/homepage.blade.php` e
`tests/segnalazioni/[slug].blade.php`.

## D14: il route dinamico non contiene fallback di catalogo

**Contesto**: il mount di `tests/[slug].blade.php` leggeva
`tests.catalog.json` e selezionava view speciali quando mancava una pagina CMS.
Questo introduceva una seconda sorgente editoriale e rendeva il risultato
dipendente dallo slug.

**Decisione**: il mount costruisce esclusivamente `tests.<slug>` e passa i dati
di contesto a `<x-page>`. La pagina viene risolta dal JSON
`database/content/pages/tests.<slug>.json`; blocchi e varianti sono scelti dal
contratto CMS, non da `if` nel route file.

**Rationale**: il route è infrastruttura Folio, mentre catalogo e contenuto
sono responsabilità del CMS. Un fallback nasconde i JSON mancanti e rende
impossibile verificare la parità pagina per pagina.

**Stato**: ✅ Implementato; rimosse importazioni `File`/`Page`,
`catalogFallback` e gli include catalogo.

## D15: lo slug vuoto ricade su `tests.index`

**Contesto**: il fallback `$pageSlug = 'tests'` non corrisponde allo slug CMS
della pagina indice, che è `tests.index`. Questo può produrre una pagina senza
blocchi se il componente viene montato senza parametro.

**Decisione**: `tests/[slug].blade.php` usa
`$slug ? 'tests.'.$slug : 'tests.index'`. Lo slug valorizzato resta invariato;
lo slug vuoto identifica sempre il documento indice CMS.

**Rationale**: il valore Folio della route e lo slug editoriale JSON devono
essere identici. `tests.index` è il contratto canonico del catalogo.

**Stato**: ✅ Implementato e verificato con lint e smoke HTTP.

## D16: risultati-ricerca richiede una sequenza BMAD dedicata

**Contesto**: il primo block `search-results` produceva solo due card e una
sezione minimale, mentre la reference contiene filtri, dieci risultati,
caricamento ulteriore, rating e contatti. La misurazione reale era 12.87% body
HTML e 24.02% visuale a 1440px.

**Decisione**: il lavoro è stato suddiviso nelle storie `DC-027.1`–`DC-027.5`:
evidence/contratto, JSON, markup e stile, interazioni WCAG, verifica finale.
Nessuna pagina Folio specifica viene creata.

**Rationale**: il fallimento derivava da un contratto dati incompleto e da una
verifica prematura, non da un semplice difetto CSS. Le soglie devono essere
misurate a 375, 768 e 1440px con body comparator e screenshot.

**Stato**: ✅ Pianificato; implementazione rinviata alla sessione successiva.

## D13: Mappa e wizard ticket — map marker visibility (STORY-054)
- **Scelta**: Aggiornare il marker SVG in `tickets/index.blade.php` con Design Comuni green `#007A52`, dimensione `36×48`, `aria-label="Segnalazione sul territorio"`, `role="img"`, nessun overlay `?`.
- **Motivazione**: Il marker attuale era scuro, piccolo e aveva un overlay di punto di domanda — non conforme a Design Comuni (green PA, visibilità WCAG, nessun icona decorativa).
- **Risultato**: marker visibile, conforme, WCAG compliant, nessun fallback necessario.

## D14: Pulsanti mappa non trasparenti (STORY-XXX)
- **Scelta**: Applicare Design Comuni styling ai pulsanti `ctrl-btn` della mappa:
  - Background: `#007a52`
  - Hover/focus-visible: `#005c3d`
  - Ombra leggera: `box-shadow: 0 2px 6px rgba(0,122,82,0.3)`
  - Transizioni: `transition: background-color 150ms ease, box-shadow 150ms ease, transform 120ms ease`
  - `rounded-lg`, `cursor:pointer`
- **File**: `Modules/Geo/resources/js/components/map/controls/geolocation.js` (renderButton function)
- **Rationale**: I pulsanti devono essere visibili e accessibili, non devono avere sfondo trasparente. Il design Comuni richiede colori di contrasto e stato chiaro/attivo ben definiti.

## D15: Geolocalizzazione non funzionante (STORY-530)
- **Scelta**: Documentare e rafforzare l'uso di HTTPS (`FORCE_HTTPS=true` in `.env.production.example`) e l'uso corretto di `fallBackToApproximate` per scenari non sicuri.
- **Motivazione**: Il browser richiede `isSecureContext`, altrimenti la geolocalizzazione fallisce. Il codice esistente ha già un fallback, ma è stato documentato e verificato.
- **Status**: ✅ Confirmed
- **Impact**: Allows users to still report locations even when geolocation is unavailable (e.g., HTTP, permission denied), with neutral messaging and fallback to approximate location.

## D16: Documentazione parallela — aggiornamento second-brain
- **Fixcity**: `second-brain.md` §8 aggiornato con 3 storie parallele e riferimenti ai BMAD stories.
- **Sixteen**: `second-brain/geo-map-tickets-2026-10-14.md` creato con dettagli tecnici e riferimenti.
- **BMAD stories**: `STORY-054-ticket-marker-visibility.md`, `STORY-XXX-wizard-map-buttons.md`, `STORY-530-geolocation-not-working.md` create con frontmatter completo.

## D17: Documentation standards — consistency across modules
- All `docs/bmad/` stories must include: `github_issue`, `discussion`, `type`, `tags`, `qmd`, `links`, `status`, `module`.
- All `docs/second-brain/` must reference specific stories via `links` and `tags`.
- All `docs/bmad/` stories must follow the Design Comuni documentation standards (no Bootstrap, proper token usage, accessibility).
