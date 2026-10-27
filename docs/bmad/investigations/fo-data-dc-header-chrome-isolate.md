---
title: "FO: header illeggibile sotto data-dc (isolate legacy)"
type: investigation
status: resolved-in-source
updated: 2026-10-22
tags: [docs, sixteen, data-dc, header, css, bmad]
qmd: "fo header data-dc isolate legacy chrome colori bianco su verde"
---

# FO: header illeggibile sotto `data-dc` (isolate legacy)

## Perché

Il look Design Comuni si accende con `page-content[data-dc]` (D16). Il plugin PostCSS `isolate-legacy-important` toglie le regole legacy con `!important` dall'ambito DC, così non spaccano wizard/home.

`components/header-footer-colors.css` è chrome DC (verde Laraxot + testo bianco) scritto con `!important`. Il plugin lo trattava come legacy: sotto `data-dc` quelle regole non applicavano. Restava il colore ereditato `#191919` su fondo verde → header illeggibile su home/tickets/login.

## Evidenza

| Ambiente | `data-dc` | slim `color` | esito |
|----------|-----------|--------------|--------|
| fixcity.eu `/it` (blade stale) | 0 | `rgb(255,255,255)` | testo ok, ma senza telaio DC |
| locale `/it` e `/it/tickets` prima del fix | 1 | `rgb(25,25,25)` | testo scuro su verde |
| locale dopo esenzione chrome | 1 | `rgb(255,255,255)` | ok |

Su `fixcity.eu` la home serve ancora un Volt root `class="fc-home"` senza `page-content`/`data-dc` (tree Ploi `/home/ploi/fixcity.eu`, non questo NAS). Serve deploy di blade + asset.

## Fix (KISS)

In `postcss/isolate-legacy-important.cjs`:

1. esentare le regole **important** su `.it-header-*` / `.it-footer-*` / `.it-brand-*`;
2. esentare `#head-section` / `.btn-hero-*` (hero guest FO).

Poi `npm run build` + `npm run copy` nel tema Sixteen.

Home coerente (contratto guest): hero verde `#head-section.bg-primary` + `map-lit`, come-funziona, banda `bg-light` — niente `fc-home-hero` charcoal né mappa duplicata.

## Verifica

```bash
cd laravel/Themes/Sixteen && npm run build && npm run copy
# puppeteer / curl locale: data-dc≥1 e slim color bianco
```

## Collegamenti

- [D16 scope data-dc](../../decision-log/D16-scope-data-dc-pagine-reali.md)
- [design-comuni parity method](../../wiki/concepts/design-comuni-parity-method.md)
- [DCP-32 story](../stories/dcp-32-scope-data-dc-pagine-reali.story.md)
