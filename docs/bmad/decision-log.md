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
