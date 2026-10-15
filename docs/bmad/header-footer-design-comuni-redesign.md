---
id: header-footer-redesign
title: "Header + Footer — redesign Design Comuni (Sezioni `<x-section>`)"
type: epic-story
status: active
module: Sixteen
created: 2026-10-11
updated: 2026-10-11
owner: "@team-fixcity"
tags: [bmad, design-comuni, header, footer, navigation, accessibility, lit, x-section, second-brain]
links:
  github_issue: "#151"
  discussion: "https://github.com/org/repo/discussions/151"
  design_comuni: "https://italia.github.io/design-comuni-pagine-statiche/"
  reference_header: "https://italia.github.io/design-comuni-pagine-statiche/sito/homepage.html#header"
  reference_footer: "https://italia.github.io/design-comuni-pagine-statiche/sito/homepage.html#footer"
related:
  - ./architecture.md
  - ../design-system/tokens.md
  - ./design-system/components.md
  - ./design-comuni-navigation-comparison.md
  - ./decision-layout-test.md
qmd: "header + footer   redesign design comuni (sezioni `<x-section>`) sixteen"
---

> **Aggiornamento 2026-10-11** — l'inventario storico sotto resta utile per la
> parità, ma il renderer canonico è ora Tailwind/Alpine e legge i blocchi JSON
> localizzati tramite `<x-section>`. Per il contratto corrente leggere
> `header-footer-sections-contract.md`; non usare le proposte Lit o Bootstrap
> riportate nella sezione storica come istruzioni operative.

# Header + Footer — Redesign Design Comuni (Sezioni `<x-section>`)

## Obiettivo

Redesign e documentazione completa delle due sezioni globali del tema Sixteen:

- **`<x-section slug="header" />`** → header slim (regione/portale) + header centrale (logo, titolo, slogan, social, ricerca) + navbar (menu primario, secondario, menu mobile/hamburger)
- **`<x-section slug="footer" />`** → footer Design Comuni (logo UE, brand, 4 colonne: Amministrazione / Categorie di Servizio / Novità e Vivere il Comune / Contatti, footer legale, social)

Entrambe rispecchiano la specifica **Design Comuni v2.4.0** e il riferimento statico `https://italia.github.io/design-comuni-pagine-statiche/`. L'implementazione corrente è Blade server-rendered con TailwindCSS e Alpine.js; Lit resta disponibile per interazioni isolate, senza introdurre un secondo renderer.

---

## Inventario Header (sezione per sezione)

### H1. Slim Header (`it-header-slim-wrapper`)

| Elemento | Codice attuale | Descrizione |
|---|---|---|
| Logo/portale regione | `<a class="d-lg-block navbar-brand">` | Link esterno alla regione (`config('comune.regione')`) |
| Switcher lingua | `include('pub_theme::components.sections.header.partials.language-switcher')` | Selettore i18n (it/en/de/es) |
| Login / Personal area (guest) | `<a class="btn btn-primary btn-icon btn-full" href="{{ route('login') }}">` | Icona `it-user` + testo "Personal area" |
| User dropdown (authenticated) | `include('pub_theme::components.sections.header.partials.user-dropdown', [...])` | Avatar → nome utente → notifiche non lette → menu utente |

### H2. Header centrale (`it-header-center-wrapper`)

| Elemento | Codice attuale | Descrizione |
|---|---|---|
| Logo comune | `<svg ... class="icon" ...><image xlink:href="/themes/Sixteen/design-comuni/assets/images/logo-comune.svg"/></svg>` | Logo 82x82px |
| Brand title | `<div class="it-brand-title">{{ config('app.name', 'Il mio Comune') }}</div>` | Nome del comune (config) |
| Brand tagline | `<div class="it-brand-tagline">...sottotitolo</div>` | Slogan (`config('comune.sottotitolo')`) |
| Socials desktop | `<div class="it-socials">` | "Seguici su" + Twitter/Facebook/YouTube/Telegram/Whatsapp/RSS (solo lg+) |
| Search trigger | `<button class="search-link" data-bs-toggle="modal" data-bs-target="#search-modal">` | Apre il modal di ricerca |
| Riferimento HTML | `sito/homepage.html` → `#it-header-center-wrapper` |

### H3. Navigation (`it-header-navbar-wrapper`, `#header-nav-wrapper`)

| Elemento | Codice attuale | Descrizione |
|---|---|---|
| Hamburger toggle | `<button class="custom-navbar-toggler" aria-controls="nav4" ...>` | Menu mobile, icona `it-burger` |
| Close button (mobile) | `.close-div > .btn.close-menu` | `it-close-big` |
| Overlay | `.overlay` | Sfondo scuro mobile |
| Logo hamburger | `.logo-hamburger` | Logo istituzionale + brand title (mobile only) |
| **Menu primario** | `<nav aria-label="Principale"><ul class="navbar-nav" data-element="main-navigation">` | Amministrazione / Novità / Servizi / Vivere il Comune |
| **Menu secondario** | `<nav aria-label="Secondaria"><ul class="navbar-nav navbar-secondary">` | Iscrizioni / Estate in Città / Polizia Locale / Tutti gli argomenti (con chevron) |
| Socials mobile | `.it-socials` (dentro menu-wrapper) | Ripetizione social nel menu mobile |
| Riferimento HTML | `sito/homepage.html` → `it-header-navbar-wrapper` |

### H4. Header — Dati dinamici e dipendenze

| Categoria | Valore | Origine |
|---|---|---|
| Regione | `config('comune.regione', 'Nome della Regione')` | Config (tenant) |
| Nome comune | `config('app.name', 'Il mio Comune')` / `config('comune.name')` | Config |
| Sottotitolo | `config('comune.sottotitolo', 'Un comune da vivere')` | Config |
| Utente | `auth()->user()` + `profile` | Sessione DB |
| Nome display | `profile.user_name` → `full_name` → `user_name` → `first_name` + `last_name` → `name` → `email` | Profilazione fallback |
| Avatar URL | `profile.getFirstMediaUrl('avatar')` → `profile.avatar_url` → `profile_photo_url` → `profile_photo_path` → Gravatar fallback | Spatie Media |
| Notifiche | `authUser->unreadNotificationsCount ?? 0` | Eloquent |
| Locale | `app()->getLocale()` | Laravel i18n |
| Routes | `route('login')` | Laravel routing |
| Link menu | **hardcoded**: `/it/amministrazione`, `/it/novita`, `/it/servizi`, `/it/eventi`, `/it/iscrizioni`, `/it/estate-in-citta`, `/it/polizia-locale`, `/it/argomenti` | Blade (da spostare in dati config/CMS: `header.json` tenant) |

> Nota: il file `design-comuni-navigation-comparison.md` (2026-09-27) documenta che i link del menu vengono da `header.json` tenant; i link attualmente hardcoded non rispettano questa configurazione.

---

## Inventario Footer (sezione per sezione)

### F1. EU Logo Section (`it-footer-small-helper`, UE logo)

| Elemento | Codice attuale | Descrizione |
|---|---|---|
| Logo UE | `<img class="ue-logo" src="...logo-eu-inverted.svg" alt="logo Unione Europea">` | 60px altezza |
| Riferimento HTML | `sito/homepage.html` → `.it-footer-small-helper` |

### F2. Brand Section (`it-footer-main` — brand)

| Elemento | Codice attuale | Descrizione |
|---|---|---|
| Logo comune (footer) | `<image href="{{ asset('...logo-comune.svg') }}">` | 82x82px |
| Brand title | `<div class="it-brand-title">Nome del Comune</div>` | Fallback hardcoded |

### F3. Footer principale (4 colonne)

| Colonna | Elementi |
|---|---|
| **Amministrazione** | Organi di governo / Aree amministrative / Uffici / Enti e fondazioni / Politici / Personale amministrativo / Documenti e dati |
| **Categorie di Servizio** | Anagrafe / Cultura / Vita lavorativa / Imprese / Appalti / Catasto / Turismo / Mobilità / Educazione / Giustizia / Tributi / Ambiente / Salute / Autorizzazioni / Agricoltura (2×6) |
| **Novità + Vivere il Comune** | Notizie / Comunicati / Avvisi / Luoghi / Eventi |
| **Contatti** | Indirizzo (`Via Roma 123, 00100 Nome Comune (RM)`), CF/P.IVA, URP, telefono verde, SMS/WhatsApp, email, PEC, centralino, CTA (FAQ / Appuntamento / Segnalazione / Assistenza) |

### F4. Footer bottom (legale + social)

| Elemento | Codice attuale | Descrizione |
|---|---|---|
| Link legali | Amministrazione trasparente / Informativa privacy / Note legali / Dichiarazione di accessibilità | separatori `|` |
| Socials (bottom) | Twitter / Facebook / YouTube / Telegram / Whatsapp / RSS con `aria-label` |
| Footer secondario | Media policy / Mappa del sito |

---

## Stato attuale vs. Design Comuni v2.4.0 (delta)

| Area | Attuale (Sixteen Blade + Bootstrap Italia) | Design Comuni ref. | Azione |
|---|---|---|---|
| Struttura markup | Bootstrap Italia classes (`it-header-slim-wrapper`, `.row`, `.col-*`) | Stessa struttura Design Comuni | **Conservare** la struttura semantica; **rimuovere** le dipendenze Bootstrap Italia |
| Icone | `bootstrap-italia/dist/svg/sprites.svg` | Stesso sprite Design Comuni | Conservare asset; spostare riferimento via token |
| Colori | Bootstrap Italia palette | Design Comuni palette (`#007A52`, `#333333`, grigio `#5d7083`) | Mappare su tokens |
| Menu | **Hardcoded** in Blade | Dati da `header.json` tenant | Spostare in CMS/config, applicare correzione `design-comuni-navigation-comparison.md` (nascondere link a pagine non publishate: `vivere-il-comune`, `iscrizioni`, `estate-in-citta`, `polizia-locale`) |
| Avatar utente | Gravatar fallback + Spatie | — | Mantenere (è funzionalità FixCity) |
| Accessibilità | Aria-label parziali, landmark presenti | Skip links, focus-visible, keyboard nav | Completare (vedi `x-section` skip links) |

---

## Decisioni in discussione

| ID | Decisione | Status |
|---|---|---|
| H-01 | Implementazione finale | **Deciso** — Blade SSR + TailwindCSS/DaisyUI/Flowbite; Alpine.js per menu e dropdown; nessun renderer parallelo. |
| H-02 | Header come Lit component o Blade SSR | **Deciso** — Blade SSR per SEO e parity; Alpine.js per le interazioni locali. |
| H-03 | Dati del menu: CMS JSON (`header.json`) vs config `comune.*` vs database migrations | **Deciso** — `config/local/{tenant}/database/content/sections/header.json`; config solo per fallback identitario. |
| H-04 | Social network: hardcoded list (6 network) — mapparli su config (abilitabili/disabilitabili per tenant) | Da decidere: aggiungere `config('comune.socials.*')` |
| H-05 | Footer: colonne 1-3 mappabili su CMS/terminology; contatti hardcoded da spostare in `comune.*` config o pagina Contatti del CMS | Da decidere |

---

## Piano di lavoro (BMAD)

### Phase 1 — Catalogazione e studio (IN CORSO)
1. ✅ Studio header-comune.blade.php, footer-comune.blade.php, sections/header.blade.php, sections/footer.blade.php
2. ✅ Studio x-section: come funziona il resolution di `slug="header"`
3. ✅ Catalogo elementi header/footer completato (questo documento)
4. 🔄 Studio x-section component registration + vendor packages (delega in corso)
5. 🔄 Studio `language-switcher` + `user-dropdown` partals
6. 🔄 Studio `header.json` tenant + DB schema

### Phase 2 — Documentazione decisionale
- `docs/bmad/decision-header-footer.md` — scelta implementazione (Lit vs Blade vs ibrido)
- `docs/bmad/decision-header-data.md` — fonte dati menu (header.json CMS)
- `docs/bmad/decision-socials.md` — social config

### Phase 3 — Implementazione + verifica
- Componente `<muni-header>` / `<muni-footer>` (o varianti)
- Mappatura Design Comuni → tokens
- Verifica visiva vs riferimento (screenshots)
- WCAG 2.1 AA + MAUVE
- Playwright E2E per header/footer

---

## Collegamenti al secondo cervello (hindsight)

- Iniziativa master: `kp-174d15a58ff94901b2b0df0d86b8907a` (FreeLLMAPI studied + docs modules/themes to improve)
- Navigazione: `design-comuni-navigation-comparison.md` (2026-09-27) — baseline header.json tenant
- `decision-layout-test.md` — layout `test` per pagine tests
- `design-comuni-navigation-correction-plan.md` — correzione menu (disabilitare link a pagine non publishate)

---

## Note

- Le sezioni `<x-section slug="header" />` e `<x-section slug="footer" tpl="full" />` sono inserite in `resources/views/layouts/app.blade.php`.
- Varianti footer: `footer-slim.blade.php` (single-column), `footer-full.blade.php` (4 colonne), `sections/footer.blade.php` (dispatch).
- Questo documento è un "living doc": aggiornare status, decisioni e piano man mano che si studiano i dettagli tecnici (delega in corso su x-section registration e header.json).
