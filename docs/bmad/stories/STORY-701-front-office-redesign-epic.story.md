---
title: "Epic — Front office redesign DesignComuni v2.4.0 (TailwindCSS + Alpine.js + Lit)"
type: epic-story
status: active
priority: critical
created: 2026-10-11
updated: 2026-10-11
theme: Sixteen
module: Fixcity
tags: [bmad, design-comuni, front-office, tailwind, alpine, lit, daisyui, flowbite, wcag-21-AA, no-bootstrap]
github_issue: "https://github.com/italia/design-comuni-pagine-statiche"
github_discussion: "https://github.com/laraxot/base_fixcity_fila5/discussions"
design_ref: "https://italia.github.io/design-comuni-pagine-statiche/index.html"
segnalazione_ref: "https://italia.github.io/design-comuni-pagine-statiche/sito/segnalazione-01-privacy.html"
freellmapi_boundary: "docs/bmad/freellmapi-theme-boundary.md"
tech_stack: "TailwindCSS v4 + Alpine.js 3.x + Lit 3.x + DaisyUI + Flowbite + Filament v5 (NO Bootstrap Italia)"
qmd: "epic: front office redesign   designcomuni v2.4.0 sixteen"
---

# Epic: Front Office Redesign — DesignComuni v2.4.0

## Obiettivo

Ricalare **tutte le pagine front office** del tema Sixteen su
`design-comuni-pagine-statiche` v2.4.0, mantenendo struttura visiva Design Comuni
ma usando **esclusivamente** TailwindCSS utility classes + Alpine.js + Lit Web Components.
**Niente classi Bootstrap Italia nei template Blade** (`.container`, `.row`, `.col-*`,
`.card`, `.btn`, `.chip`, `.title-xxlarge`...). Zero SVG sprite Bootstrap Italia;
sostituiti con inline SVG o Heroicons. Zero JavaScript inline; tutta la logica in
Alpine.js-data o Lit.

## Perimetro

| Area | Owner | Tech |
|---|---|---|
| Header | Sixteen | TailwindCSS + Alpine.js ✅ **Completato** |
| Footer | Sixteen | TailwindCSS ✅ **Completato** |
| Homepage (blocchi CMS) | Sixteen | TailwindCSS + Lit |
| Segnalazione wizard (4 step) | Fixcity | Livewire + Filament Wizard + Alpine |
| Ticket list + mappa | Fixcity | Livewire + `<map-lit>` Lit WC |
| Ticket detail | Fixcity | Livewire + `<map-lit>` |
| Track ticket | Fixcity | Livewire + Alpine |
| FAQ | Sixteen | Blade + Alpine (accordion) |
| Mappa sito | Sixteen | Blade |
| Auth pages | Sixteen | Blade + Alpine |

## Problemi attuali (2026-10-11)

1. **Blocchi homepage** usano classi BS Italia nel markup:
   - `how-it-works.blade.php`: `.container`, `.row`, `.col-12`, `.col-lg-8/4`, `.title-xxlarge`, `.text-secondary`, SVG sprite
   - `quick-actions.blade.php`: `.container`, `.d-flex`, `.flex-sm-row`, `.justify-content-sm-end`, SVG sprite
   - `home/hero.blade.php`: pulito (`fc-*` solo) ✅
2. **Riferimento `design-comuni/pages/homepage.blade.php`**: uso massiccio di BS Italia
3. **JavaScript inline** in `how-it-works` e `quick-actions` (dovrebbe essere Alpine.js)
4. **CSS ridondante**: 50+ file CSS importati in `app.css` con sovrapposizioni
5. **Documentazione frammentata**: 208 file in `docs/design-comuni/` con doppioni datati

## Sub-tasks

### T1. Tailwind utility conversion per blocchi homepage
- `how-it-works.blade.php`: `.container` → `max-w-7xl mx-auto px-4 sm:px-6 lg:px-8`, `.row/.col-*` → `grid md:grid-cols-2 gap-8`, SVG sprite → inline SVG, inline JS → Alpine `x-data`
- `quick-actions.blade.php`: `.container` → container Tailwind, `.d-flex` → `flex`, SVG → inline SVG, JS → Alpine

### T2. Homepage reference template cleanup
- `design-comuni/pages/homepage.blade.php`: conversione completa da BS Italia a Tailwind utility

### T3. Consolidamento documentazione
- Creare `docs/design-comuni/design-comuni-canonical.md` (unico documento di riferimento)
- Creare `docs/STORIES-INDEX.md` (indice di tutte le stories)
- Archiviare (non cancellare) i file duplicati con data

### T4. Quality gate WCAG 2.1 AA
- Script `bashscripts/tools/visual/wcag-aa-check.mjs` (✅ creato)
- Mauve ISTI CNR reference: https://mauve.isti.cnr.isti.cnr.it/supported_wcag21.jsp

### T5. CSS cleanup
- Creare `resources/css/app/design-comuni.css` (Tailwind utility canonico)
- Rimuovere imports obsoleti da `resources/css/app.css`

## Definizione di Completato

- [ ] Nessun riferimento a `bootstrap-italia/dist/svg/sprites.svg` in Blade
- [ ] Nessun `.container`, `.row`, `.col-*-*` in Blade (sostituito con Tailwind)
- [ ] Nessun `<script>` inline in Blade (sostituito con Alpine.js o Lit)
- [ ] WCAG 2.1 AA: 0 critical, 0 serious (verificato con axe-core)
- [ ] Design Comuni visual parity: ≥90% match su homepage hero, header, footer
- [ ] PHPStan zero error (livello 10) su file modificati
- [ ] Pint PSR-12: tutti i file formattati

## Tracciabilità

- Epic: `docs/stories/front-office-complete-redesign.story.md` (root story)
- Fixcity stories: `Modules/Fixcity/docs/bmad/stories/STORY-013-public-landing-page.md` etc.
- Runtime audit: `docs/bmad/segnalazioni-tailwind-runtime-audit.md`
- Visual contract: `docs/bmad/homepage-guest-visual-contract.md`
