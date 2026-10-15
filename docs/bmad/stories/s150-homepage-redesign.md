---
id: s150-homepage-redesign
type: epic-story
title: "Homepage — Redesign Design Comuni (v2.4.0)"
status: active
created: 2026-10-11
updated: 2026-10-11
owner: "@team-fixcity"
priority: P0
links:
  github_issue: "#150"
  discussion: "https://github.com/org/repo/discussions/150"
  reference_homepage: "https://italia.github.io/design-comuni-pagine-statiche/sito/homepage.html"
  architecture: "arc-sixteen-design-comuni-redesign"
  decision_log: "dl-sixteen-design-comuni-redesign"
tags: [docs, sixteen, bmad]
qmd: "story: homepage   redesign design comuni sixteen"
---

# Story: Homepage — Redesign Design Comuni

## Obiettivo
Riprogettare la homepage del tema Sixteen per rispettare la grafica Design Comuni v2.4.0 (pagina `sito/homepage.html` nel riferimento statico), usando **TailwindCSS + Alpine.js + Lit + DaisyUI + Flowbite**, senza Bootstrap.

## Definizione (BMAD — 5 campi)
1. **Job utente**: Visitare il sito comunale e vedere subito contenuti in evidenza (notizie, eventi, servizi rapidi).
2. **Inventario componenti**: Hero section con titolo + immagine, card notizie, calendario eventi, mini-card servizi, breadcrumb, skip links, footer istituzionale.
3. **Token**: Palette Design Comuni, tipo Lora/Source Sans, spaziatura 8px, elevazione sm/md/lg/xl, accent unico istituzionale.
4. **Stati**: Default, hover (card title/immagine), focus-visible (su link/button), disabled, loading (placeholder), error.
5. **Riferimento**: `design-comuni-pagine-statiche/sito/homepage.html`

## Requisiti (tracciabilità da Design Comuni)
- **Hero section** con titolo principale, sottotitolo, immagine principale, CTA "Tutte le novità"
- **News/Notizie** — 3 card con: categoria (es. "Notizie"), titolo con data, estratto, link "Tutte le novità"
- **Calendario eventi** — 3-5 card evento: titolo, data, ruolo (Sindaco, Assessore), azione
- **Servizi rapidi** — Mini-card 4-5: documenti, pagamenti, appuntamenti, iscrizioni
- **Breadcrumb** accessibile (DaisyUI)
- **Skip links** due: "Vai ai contenuti", "Vai al footer"
- **Footer istituzionale** con link: home, privacy, cookie, contatti, PEC, versione stampa
- **Language switch** it/eng (espresso come flag, non bandiera inglese)
- **bg-pattern** discreto (tipo texture carta kraft o griglia sottile) al posto di pure `#fff`
- **Accent color** unico (istituzionale PA, non gradiente viola/indigo)
- **APCA contrast**: Lc ≥75 body, ≥45 large-bold, ≥30 non-text

## Stack Implementativo
- `Alpine.js` per interattività minima (mobile menu toggle, focus-visible class toggle)
- `Lit` component `<muni-hero>`, `<muni-card-news>`, `<muni-card-service>`, `<muni-breadcrumb>`, `<muni-footer>`
- `DaisyUI` `hero`, `card`, `breadcrumb`, `badge`, `accordion`, `collapse`
- `Flowbite` modals (eventi dettaglio, ricerca avanzata) — opzionale
- `Tailwind` utilities per grid/margin/padding/typography
- Custom CSS in `styles.css` con solo `@layer components` per pattern ricorrenti

## File Coinvolti
- `laravel/Themes/Sixteen/resources/views/pages/index.blade.php` (ridefinito)
- `laravel/Themes/Sixteen/resources/js/components/muni-hero.js` (Lit)
- `laravel/Themes/Sixteen/resources/js/components/muni-card-news.js` (Lit)
- `laravel/Themes/Sixteen/resources/js/components/muni-card-service.js` (Lit)
- `laravel/Themes/Sixteen/resources/js/components/muni-breadcrumb.js` (Lit)
- `laravel/Themes/Sixteen/resources/js/components/muni-footer.js` (Lit)
- `laravel/Themes/Sixteen/resources/js/stores/ui-store.js` (Alpine)
- `laravel/Themes/Sixteen/tailwind.config.js` (token extend)
- `laravel/Themes/Sixteen/docs/bmad/stories/s150-homepage-redesign.md`
- `bashscripts/design-comuni/audit-homepage.sh`

## Criteri di Accettazione
- [ ] Pagina visivamente fedele al reference (`index.html`)
- [ ] Nessun componente Bootstrap importato
- [ ] APCA contrast passa su tutti i colori usati (Lc ≥75 body, ≥45 large-bold)
- [ ] Tutti gli elementi interattivi hanno `:focus-visible`
- [ ] Footer istituzionale con tutti i link richiesti Design Comuni
- [ ] Skip links funzionanti (focus order corretto)
- [ ] MAUVE passa (WCAG 2.1 AA, contrasti validi)
- [ ] Playwright E2E: capture viewport 390px → hero visibile, card swipe, footer click
- [ ] `prefers-reduced-motion` rispetta su tutte le animazioni

## Note
Il riferimento Bootstrap Italia (`bootstrap-italia-1to1.blade.php`, `bootstrap-italia-exact.blade.php`) vedi solo come documento storico, NON usare classi. La struttura HTML è identica per layout, ma le classi CSS sono tutte Tailwind/DaisyUI/Flowbite.