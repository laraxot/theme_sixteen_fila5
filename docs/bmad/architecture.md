---
id: arc-sixteen-design-comuni-redesign
title: "Architettura Redesign Design Comuni — Tema Sixteen"
type: architecture
status: active
created: 2026-10-11
updated: 2026-10-11
owner: "@team-fixcity"
tags: [design-comuni, sixteen, tailwind, alpine, lit, daisyui, flowbite, filament, wcag, mauve]
links:
  github_issue: "#150"
  discussion: "https://github.com/org/repo/discussions/150"
  design_comuni: "https://italia.github.io/design-comuni-pagine-statiche/index.html"
  ui_kit_italia: "https://github.com/italia/design-ui-kit"
  mauve_wcag: "https://mauve.isti.cnr.it/supported_wcag21.jsp"
qmd: "architettura redesign design comuni   tema sixteen sixteen"
---

# Architettura Redesign Design Comuni — Tema Sixteen

## Obiettivo
Redesign completo delle pagine front office del tema **Sixteen** per rispettare le specifiche grafiche e strutturali di **Design Comuni v2.4.0** (modello sito web per i comuni italiani), mantenendo la coerenza visiva con le pagine statiche di riferimento `https://italia.github.io/design-comuni-pagine-statiche/index.html` (in particolare la pagina **Segnalazione** `#segnalazione`).

## Stack Tecnologico (Vincolante)
| Livello | Tecnologia | Note |
|---------|-----------|------|
| CSS Framework | **TailwindCSS** (v3+) | Utility-first, no Bootstrap Italia |
| JS Interattività | **Alpine.js** (v3+) | Componenti reattivi leggeri |
| Web Components | **Lit** (v3+) | Custom elements per UI riutilizzabili |
| Component Library | **DaisyUI** (v4+) | Componenti pre-costruiti su Tailwind |
| UI Kit aggiuntivo | **Flowbite** (v2+) | Componenti extra su Tailwind |
| Admin Panel | **Filament** (v3+) | Solo back-office, non front-end |
| Accessibilità | **MAUVE** + WCAG 2.1 AA | Validazione automatizzata |

**Regola ferrea**: **Nessun Bootstrap** (né Bootstrap Italia né Bootstrap vanilla). Tutto il CSS via Tailwind + DaisyUI + Flowbite. Le grafiche Design Comuni sono **riferimento visivo**, non implementazione Bootstrap.

## Struttura Pagine Front Office (da redesignare)
Basato su `design-comuni-pagine-statiche` v2.4.0:

### Sezione Sito (Generali)
- **Homepage** — `sito/homepage.html` → `resources/views/pages/index.blade.php`
- **FAQ / Domande frequenti** — `sito/domande-frequenti.html`
- **Risultati ricerca** — `sito/risultati-ricerca.html`
- **Argomenti** (lista) — `sito/argomenti.html`
- **Argomento** (dettaglio) — `sito/argomento.html`
- **Lista risorse** — `sito/lista-risorse.html`
- **Lista categorie** — `sito/lista-categorie.html`
- **Lista risorse e categorie** — `sito/lista-risorse-categorie.html`
- **Mappa del sito** — `sito/mappa-sito.html`

### Sezione Amministrazione
- **Amministrazione** (livello 1) — `sito/amministrazione.html`
- **Documenti e dati** — `sito/documenti-dati.html`

### Sezione Novità
- **Novità** (lista) — `sito/novita.html`
- **Notizia/Comunicato/Avviso** (dettaglio) — `sito/novita-dettaglio.html`

### Sezione Servizi (Flussi di servizio)
- **Servizi** (livello 1) — `sito/servizi.html`
- **Categoria servizio** (livello 2) — `sito/servizi-categoria.html`
- **Scheda servizio** (dettaglio) — `sito/servizio-dettaglio.html`
- **Accesso servizio** (SPID/CIE) — `servizi/accesso-servizio.html`
- **Consenso privacy** — `servizi/consenso-privacy.html`
- **Graduatorie** (scuola infanzia) — 6 step + area personale
- **Permessi/Autorizzazioni** (ZTL) — 4 step + area personale
- **Prenotazioni** (es. appuntamenti) — 5 step + area personale
- **Segnalazioni** — **PRIORITÀ ALTA** (pagina `#segnalazione` del reference)

### Sezione Vivere il Comune
- **Eventi** (lista) — `sito/eventi.html`
- **Evento** (dettaglio) — `sito/evento-dettaglio.html`

### Prenotazione Appuntamento (template specifici)
- Step 1–5 + area personale + messaggi + perfezionamento

## Design System (in `laravel/Themes/Sixteen/docs/design-system/`)
**Posizione corretta**: i documenti di design system vanno **dentro il tema**, non a radice progetto.

```text
laravel/Themes/Sixteen/docs/
├── bmad/
│   ├── architecture.md           ← questo file
│   ├── brainstorming.md
│   ├── decision-log.md
│   └── stories/
├── design-system/
│   ├── tokens.md                 # Colori, tipografia, spaziatura, ombre, raggi
│   ├── components.md             # Catalogo componenti DaisyUI/Flowbite mappati a Design Comuni
│   ├── elevation.md              # Scale ombre (sm/md/lg/xl) — named levels only
│   ├── layout.md                 # Griglia, breakpoint, container, rhythm
│   ├── states.md                 # Stati interattivi (hover, focus-visible, disabled, loading, error, empty)
│   └── accessibility.md          # Checklist MAUVE/WCAG 2.1 AA, contrasti APCA
├── implementation/
│   ├── homepage.md
│   ├── segnalazione.md
│   ├── servizi.md
│   └── ...
└── scripts/
    └── audit.md                  # Comandi per validazione (pint, phpstan, mauve, playwright)
```

## Mapping Design Comuni → Stack Moderno
| Design Comuni (Bootstrap Italia) | Implementazione Tailwind + DaisyUI + Flowbite + Lit |
|----------------------------------|-----------------------------------------------------|
| `.container`, `.row`, `.col-*` | Tailwind grid/flex (`container mx-auto`, `grid grid-cols-12 gap-8`) |
| `.btn`, `.btn-primary`, `.btn-secondary` | DaisyUI `btn btn-primary`, `btn btn-secondary` + custom accent |
| `.card` | DaisyUI `card` / Flowbite `card` + elevation tokens |
| `.navbar`, `.nav-link` | Lit `<muni-navbar>` + Alpine per mobile toggle |
| `.breadcrumb` | DaisyUI `breadcrumb` / Flowbite breadcrumb |
| `.form-control`, `.form-select` | DaisyUI `input input-bordered` / `select select-bordered` |
| `.alert`, `.badge` | DaisyUI `alert` / `badge` + semantic colors |
| `.modal` | Lit `<muni-modal>` + Alpine `x-transition` |
| `.table` | DaisyUI `table` / Flowbite table + `tabular-nums` |
| `.pagination` | DaisyUI `pagination` |
| `.accordion` | DaisyUI `collapse` / Flowbite accordion + Alpine |

## Regole di Progetto (da AGENTS.md + Design Comuni)
1. **No HTTP Controllers** — Folio pages + Actions (`app/Actions/*Action.php`)
2. **No Services layer** — Business logic in Actions
3. **Module providers manifest** — `module.json` + `composer.json` per modulo
4. **Composer root minimal (nwidart)** — Solo skeleton in `laravel/composer.json`
5. **Module contracts** — Suffisso `*Contract`, cartella `app/Contracts/` o `Models/Contracts/`
6. **Migrations** — Solo aggiornamento timestamps, niente nuove tabelle in migration esistenti
7. **Wiki frontmatter** — Ogni `.md` in `docs/wiki/` ha YAML frontmatter obbligatorio
8. **<x-page> data bag** — Solo predefined data bag
9. **No root `.txt` / extra `.md` in moduli/temi** — Solo `README.md` in root modulo/tema
10. **Design tokens ONLY** — Nessun hardcoded hex fuori `:root` / `theme()`
11. **Elevation named levels** — Solo `sm/md/lg/xl`, niente shadow ad-hoc
12. **Accent unico** — Solo token accent definito, no gradienti viola/indigo
13. **Type scale modulare** — Ratio 1.25, niente font-size custom
14. **Spacing 8px grid** — Token spacing, niente pixel magici
15. **Stati completi** — Ogni elemento interattivo: default, hover, focus-visible, active, disabled + error/empty/loading
16. **prefers-reduced-motion** — Obbligatorio per ogni transizione/animazione
17. **MAUVE validation** — Ogni pagina validata WCAG 2.1 AA prima del merge

## Accessibilità (MAUVE + WCAG 2.1 AA)
- **Contrast**: APCA Lc ≥75 (body), ≥45 (large-bold), ≥30 (non-text) — WCAG 4.5:1 sidecar
- **Focus visible**: `:focus-visible` su tutti gli interattivi (outline 3px accent, offset 2px)
- **Keyboard**: Tutti i componenti navigabili da tastiera (Tab, Enter, Esc, Arrow keys)
- **ARIA**: Label, role, state corretti su componenti custom (Lit)
- **Language**: `lang="it"` su `<html>`, parti in lingua diversa marcate
- **Skip links**: "Vai al contenuto principale" primo link nella pagina
- **Landmarks**: `<header>`, `<nav>`, `<main>`, `<aside>`, `<footer>` semantici
- **Images**: `alt` significativi, decorative `alt=""` o CSS background

## Validazione Continua
```bash
# Design system lint (quando DESIGN.md esiste)
npx @google/design.md lint laravel/Themes/Sixteen/docs/design-system/DESIGN.md

# PHP quality
cd laravel && vendor/bin/pint && vendor/bin/pest && php -d memory_limit=2048M vendor/bin/phpstan analyse Modules

# Accessibilità (MAUVE via Playwright)
npx playwright test tests/accessibility/ --project=chromium

# Visual regression (Chromatic/Percy o custom)
npx playwright test tests/visual/ --project=chromium
```

## Roadmap Implementazione (Epic → Stories)
| Epic | Stories | Priorità |
|------|---------|----------|
| E01: Design System Foundation | Tokens, Elevation, Layout, Components catalog, States, Accessibility | P0 |
| E02: Layout Base + Navigation | `design-comuni.blade.php` enhancement, navbar Lit, footer, skip links | P0 |
| E03: Homepage | Hero, sezioni, card servizi, news, eventi | P0 |
| E04: Segnalazione (Report) | Form multi-step, mappa, allegati, conferma, tracking | **P0 — PRIORITÀ MASSIMA** |
| E05: Servizi (lista, categoria, scheda) | Filtri, ricerca, step wizard, accesso SPID/CIE | P1 |
| E06: Amministrazione + Novità + Vivere Comune | Liste, dettagli, archivio | P1 |
| E07: Area Personale + Prenotazioni | Auth, dashboard, storico, notifiche | P2 |
| E08: Accessibilità Audit + Fix | MAUVE full site scan, fix regressions | P0 (continuo) |

## Next Steps (BMAD)
1. **brainstorming.md** — Esplorazione varianti per homepage e segnalazione
2. **decision-log.md** — Decisioni chiave (es. no Bootstrap, Lit per navbar/modal, DaisyUI come base componenti)
3. **stories/** — Una `.story.md` per ogni pagina/flusso (formato BMAD con `github_issue`)
4. **design-system/tokens.md** — Estrazione token da Design Comuni (colori PA, tipografia, spacing)
5. **Implementazione** — Inizia da E01 → E04 (Segnalazione priorità massima)

## Note operative
- **Script** di validazione/build vanno in `bashscripts/` (es. `bashscripts/audit/`, `bashscripts/design-comuni/`), documentati in `bashscripts/docs/`
- **Test** in `laravel/Themes/Sixteen/tests/` (Pest per PHP, Playwright per E2E/visual/accessibilità)
- **Componenti Lit** in `laravel/Themes/Sixteen/resources/js/components/` (build con Vite)
- **Alpine stores** in `laravel/Themes/Sixteen/resources/js/stores/`
- **Tailwind config** in `laravel/Themes/Sixteen/tailwind.config.js` (extend con design tokens)