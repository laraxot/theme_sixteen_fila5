---
title: "Sixteen shared shell WCAG audit"
type: bmad-audit
status: remediation-in-progress
date: 2026-10-12
scope: [header, footer, language-switcher, personal-area-cta, social-links]
standards: [WCAG-2.1-AA, WCAG-2.2-AA]
updated: 2026-10-13
tags: [docs, sixteen, bmad]
qmd: "audit e piano di remediation sixteen"
---

# Audit e piano di remediation

## Evidenze iniziali

L'header e il footer sono sezioni CMS condivise (`<x-section slug="header" />` e
`<x-section slug="footer" />`), con dati in `config/local/fixcity/database/content/sections/`.
La view canonica è quella del tema Sixteen: non vengono introdotti layout o componenti
Design Comuni paralleli. Il runtime resta TailwindCSS + Alpine.js + Lit + DaisyUI +
Flowbite; Bootstrap Italia è soltanto una fonte di riferimento e non viene caricato.

## Matrice elemento per elemento

| Elemento | Rischio osservato | Requisito | Remediation | Verifica |
|---|---|---|---|---|
| Regione/utility | link poco distinguibile su verde | 1.4.3, 1.4.11 | testo bianco, underline solo hover, focus 2px | contrast + snapshot |
| Cambio lingua | codice lingua senza controllo operativo chiaro | 2.1.1, 2.4.6, 4.1.2 | button Alpine, `aria-expanded`, menu `role=menu`, locale corrente | tastiera + axe |
| Link lingua | stato corrente non sempre evidente | 1.3.1, 4.1.2 | `aria-current=true`, target minimo 44px | DOM audit |
| CTA area personale | icona/dimensioni incoerenti | 1.4.11, 2.5.8 | SVG inline, target 48px, label persistente | bounding boxes |
| Social | icone testuali sottolineate e target piccoli | 1.4.11, 2.5.8 | cerchi 44x44, `aria-label`, nessuna underline decorativa | computed styles |
| Ricerca/menu mobile | controllo icon-only fragile | 2.1.1, 4.1.2 | `button`, label, `aria-expanded`, target 44px | tastiera |
| Navigazione | underline sempre visibile sulle icone/link | 1.4.11, 2.4.4 | `no-underline` default, underline solo hover/focus | screenshot |
| Titoli footer | override CSS poteva renderli scuri su fondo scuro | 1.4.3 | `!text-white` esplicito e shell scura | contrast pairs |
| Link footer | testo e focus non uniformi | 1.4.3, 2.4.7 | testo chiaro, focus ring bianco, area minima 44px dove possibile | axe + CSS |
| Logo/brand | contenuto brand poco associato | 1.1.1, 2.4.4 | link brand con nome e tagline, logo decorativo | snapshot |
| Responsive shell | sovrapposizione e overflow | 1.4.10, 2.5.8 | menu mobile Alpine, wrapping, 320/390px checks | Playwright |

## Contrasto contrattuale

- testo normale: almeno 4.5:1;
- testo grande: almeno 3:1;
- bordi, focus, icone e controlli: almeno 3:1;
- palette scura footer: `#f8fafc`/`#cbd5e1` su `#020617`;
- palette header: `#ffffff` su `#004d3a`/`#007a52`;
- focus: anello bianco su header/footer e verde scuro su menu lingua bianco.

## Piano BMAD

1. **DC-A11Y-001 Shell audit** — catturare snapshot, screenshot e computed styles a
   320/390/768/1440px; classificare ogni elemento condiviso.
2. **DC-A11Y-002 Header controls** — lingua, CTA, social, ricerca, menu mobile e
   navigazione semantica; coprire mouse, tastiera, focus e stato aperto/chiuso.
3. **DC-A11Y-003 Footer contrast** — bloccare i token chiari sul fondo scuro,
   verificare colonne, contatti, social, legal e copyright.
4. **DC-A11Y-004 Automated gate** — axe WCAG 2.1 AA, contrast pairs, target size,
   overflow, missing images, console errors e screenshot archiviati in `/tmp`.
5. **DC-A11Y-005 Full catalog regression** — rieseguire le 37 route Design Comuni;
   ogni pagina eredita lo shell audit e non può regredire.

## Definition of done

Nessuna violazione critical/serious axe; nessuna coppia testo normale sotto 4.5:1;
nessun controllo condiviso sotto 44x44px senza alternativa conforme; focus visibile;
lingua operabile da tastiera; zero overflow orizzontale a 320px; zero errori console;
report e screenshot aggiornati per tutte le route catalogate.
