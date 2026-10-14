---
id: bm-sixteen-design-comuni-redesign
title: "Brainstorming Redesign Design Comuni — Tema Sixteen"
type: brainstorming
status: active
created: 2026-10-11
updated: 2026-10-11
owner: "@team-fixcity"
tags: [design-comuni, sixteen, brainstorming, variants, homepage, segnalazione]
links:
  github_issue: "#150"
  architecture: "arc-sixteen-design-comuni-redesign"
qmd: "brainstorming redesign design comuni   tema sixteen sixteen"
---

# Brainstorming Redesign Design Comuni — Tema Sixteen

## Premessa
Il tema **Sixteen** contiene già una replica 1:1 di Bootstrap Italia in `resources/views/design-comuni/pages/homepage.blade.php`. Il redesign deve **mantenere la fedeltà visiva** a Design Comuni v2.4.0 ma **sostituire l'implementazione Bootstrap** con **Tailwind + DaisyUI + Flowbite + Lit + Alpine**.

## Varianti di Approccio per la Homepage

### Variante A — "Fedeltà Progressiva" (Consigliata)
**Principio**: Partire dall'attuale `homepage.blade.php` (Bootstrap), sostituire componente per componente con equivalenti Tailwind/DaisyUI, validare visivamente a ogni step.

| Step | Componente Bootstrap | Sostituzione Tailwind/DaisyUI | Validazione |
|------|---------------------|-------------------------------|-------------|
| 1 | `.container` + `.row` + `.col-*` | `container mx-auto` + `grid grid-cols-1 md:grid-cols-2 gap-8` | Screenshot diff |
| 2 | `.card` + `.card-body` | DaisyUI `card` + `card-body` | Screenshot diff |
| 3 | `.btn`, `.btn-primary` | DaisyUI `btn btn-primary` (custom accent) | Screenshot diff |
| 4 | `.chip`, `.read-more` | DaisyUI `badge` + custom `read-more` component | Screenshot diff |
| 5 | `.breadcrumb` | DaisyUI `breadcrumb` | Screenshot diff |
| 6 | Navbar + Footer | Lit `<muni-navbar>` + `<muni-footer>` + Alpine | E2E test |

**Pro**: Rischio basso, regressioni visive controllate, deploy incrementale
**Contro**: Più lento, codice ibrido temporaneo

### Variante B — "Clean Rewrite" (Radicale)
**Principio**: Scrivere da zero `homepage.blade.php` usando solo componenti Tailwind/DaisyUI/Flowbite/Lit, ispirandosi al reference HTML ma senza copiare classi Bootstrap.

**Pro**: Codice pulito da subito, niente debito tecnico, architettura Lit/Alpine nativa
**Contro**: Rischio deviazione visiva, serve visual regression testing forte

### Variante C — "Hybrid Lit-First" (Architettura-driven)
**Principio**: Definire prima i **Lit Web Components** per gli elementi ricorrenti (navbar, footer, card servizio, chip, breadcrumb, hero), poi comporre la homepage.

Componenti Lit candidati:
- `<muni-navbar>` — Navigation responsive, SPID/CIE login, ricerca
- `<muni-footer>` — Link istituzionali, social, contatti, privacy
- `<muni-hero>` — Hero section con immagine, titolo, CTA
- `<muni-card-news>` — Card notizia/novità con categoria, data, chip, read-more
- `<muni-card-service>` — Card servizio con icona, titolo, descrizione, CTA
- `<muni-breadcrumb>` — Breadcrumb accessibile
- `<muni-chip>` — Tag categorico (success/warning/danger/info)
- `<muni-read-more>` — Link "Tutti..." con freccia
- `<muni-skip-links>` — Skip to main/footer (WCAG)

**Pro**: Massima riutilizzabilità, testabilità isolata, design system reale
**Contro**: Setup iniziale più lungo, serve build Vite per Lit

## Varianti per la Pagina Segnalazione (Priorità Massima)

### Reference: `design-comuni-pagine-statiche/sito/segnalazione.html` (da verificare)

### Variante A — Multi-step Alpine Wizard
```html
<!-- Struttura -->
<muni-report-wizard x-data="reportWizard()">
  <template x-for="step in steps" :key="step.id">
    <fieldset x-show="currentStep === step.id" x-transition>
      <!-- Campi step -->
    </fieldset>
  </template>
  <muni-stepper :steps="steps" :current="currentStep" @change="goToStep" />
</muni-report-wizard>
```

**Step tipici Segnalazione**:
1. **Categoria** (dropdown: buche, illuminazione, rifiuti, verde, altro)
2. **Posizione** (mappa Leaflet/MapLibre + indirizzo + GPS)
3. **Dettagli** (titolo, descrizione, foto/allegati)
4. **Contatti** (nome, email, telefono, anonimo S/N)
5. **Riepilogo + Invio** (conferma, codice tracking)

**Pro**: UX guidata, validazione per step, salvataggio parziale (localStorage)
**Contro**: Più JS, serve gestione stato complessa

### Variante B — Single Page Form (Progressive Disclosure)
Un unico `<form>` con sezioni `details/summary` o `accordion` (DaisyUI `collapse`) che si aprono progressivamente.

**Pro**: Più semplice, nessun state management, funziona senza JS (progressive enhancement)
**Contro**: Form lungo, validazione solo al submit, UX meno guidata

### Variante C — Lit `<muni-report-form>` + Alpine Store
Web Component Lit che incapsula tutto il form, con Alpine store globale per stato cross-component.

**Pro**: Incapsulamento forte, riutilizzabile, state management centralizzato
**Contro**: Più complesso, serve build Vite, debugging harder

## Decisioni da Prendere (per Decision Log)

| Decisione | Opzioni | Raccomandazione |
|-----------|---------|-----------------|
| **Approccio Homepage** | A (Progressivo) / B (Rewrite) / C (Lit-First) | **C** — Lit-First per design system reale |
| **Approccio Segnalazione** | A (Wizard) / B (Single) / C (Lit+Store) | **A** — Wizard Alpine per UX guidata |
| **Component Library Base** | Solo DaisyUI / DaisyUI + Flowbite / Custom su Tailwind | **DaisyUI + Flowbite** — copertura completa |
| **Icone** | Bootstrap Italia SVG sprites / Heroicons / Lucide / Custom | **Heroicons** (già in Tailwind) + custom per icone PA specifiche |
| **Mappe** | Leaflet / MapLibre GL / Google Maps | **Leaflet** (leggero, open, Alpine-friendly) |
| **Build Lit** | Vite (esistente) / esbuild / Rollup | **Vite** (già configurato in Sixteen) |
| **CSS Architecture** | `@apply` in CSS / Solo utility / CSS Modules | **Solo utility + `@layer components` per pattern ricorrenti** |

## Prossimi Passi
1. Creare `decision-log.md` con decisioni confermate
2. Creare `design-system/tokens.md` estraendo da Design Comuni
3. Creare `design-system/components.md` mappando componenti
4. Implementare `<muni-navbar>` e `<muni-footer>` come Lit components (fondamenta)
5. Riscrivere `homepage.blade.php` usando i nuovi componenti
6. Implementare `segnalazione` come wizard Alpine