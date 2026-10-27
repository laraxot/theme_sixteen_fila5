---
id: dcp-221
title: "DCP-221: tipografia home /it leggibile (WCAG, ipovedenti)"
type: story
epic: dc-parity-v2
status: done
priority: P1
owner: theme:Sixteen
created: 2026-10-15
updated: 2026-10-15
qmd: "tipografia font-weight 600 lora serif line-height wcag ipovedenti homepage sixteen titillium leggibilita bootstrap-italia"
related: [dcp-143, dcp-158, dcp-106, dcp-183, dcp-137]
tags: [docs, sixteen, bmad, wcag, a11y]
---

# DCP-221: tipografia home leggibile per tutti

## Scopo (perche')

Su `http://192.168.1.40:8000/it` i titoli risultavano «ciccioni»: peso computato
**800**, `line-height` **0.98**, clamp hero fino a **5.2rem**. Titillium Web non
ha 750/800: il browser cade sul Black 900 e le glifi si sovrappongono. Per
ipovedenti e WCAG 2.1 AA (percepibile / comprensibile) serve gerarchia sobria,
non peso massimo.

## Norma

- WCAG 2.1 AA: contrasto, spaziatura testuale, leggibilita'
- Designers Italia / Bootstrap Italia: titoli e nav in **semibold 600**
- L. 4/2004 + EN 301 549 (baseline progetto)

## Contratto tipografico FO (KISS)

Allineato a [Bootstrap Italia — Tipografia](https://italia.github.io/bootstrap-italia/docs/organizzare-i-contenuti/tipografia/).

| Elemento | family | weight | line-height | note |
|---|---|---|---|---|
| Hero `h1` | **Lora** (`.font-serif`) | **400** | **1.2** | clamp `2.5rem–3rem` (BI h1 40/48→48/60) |
| Section `h2`, signal, eyebrow | Titillium | **600** | **>= 1.15** | sans UI |
| Body / intro | Titillium | 400 | >= 1.55 | invariato |
| Brand title, nav link | Titillium | **600** | ~1.2 | no `700 !important` chrome |
| CTA / button | Titillium | 600 | — | gia' ok |

Font self-hosted via `design-comuni/fonts.css` + Vite relative `url()` (DCP-183 / Laravel Working with Fonts). Lora self-hosted: solo 400/700 — vietato 600 sull'h1 (sintesi/fake-bold). Vietato 750/800/900 su Titillium.

## Implementazione

- `resources/css/app/16-homepage-civic-reframe.css` — pesi/lh/clamp
- `resources/css/app.css` — rimosso override Lora/700 rivale
- `civic-design-tokens` / `design-comuni-tokens` — brand semibold
- `civic-design-global-fixes`, `header-footer-colors`, `bootstrap-italia-classes`,
  `03-header-navigation-primary`, `13-final-runtime-overrides` — chrome 600
  (override finale batte `ticket-parity` ancora a 700, file locked da altro task)

## Verifica (Playwright, 1280×900, 2026-10-15)

| Selettore | family | weight | size | lh ratio |
|---|---|---|---|---|
| `h1` | **Lora** | **400** | **48px** | **1.20** |
| `.fc-eyebrow` | Titillium | 600 | 13px | 1.35 |
| `.fc-section-heading h2` | Titillium | 600 | ~41px | 1.20 |
| `.it-brand-title` | Titillium | 600 | 16px | 1.20 |
| `nav .nav-link` | Titillium | 600 | 18px | normal |
| `.fc-home-hero__intro` | Titillium | 400 | 16px | 1.55 |

Lora Regular caricato (`document.fonts`). CSS: `app-Rdj9oV0q.css`. Guardia: `FontsCssGuardTest` 4/4.

## Criteri di accettazione

- [x] Hero `h1` in **Lora** Regular 400 (BI `.font-serif`)
- [x] Scale BI h1 (~40–48px), lh 1.2
- [x] Titoli sans home a weight <= 600
- [x] Font locali via Vite (no Google CDN)
- [x] Rebuild Sixteen + `FontsCssGuardTest` green
- [x] Story + decision-log + wiki aggiornati

## Collegamenti

- [accessibility](../../accessibility.md)
- [design-comuni-font-tokens](../../wiki/concepts/design-comuni-font-tokens.md)
- [dcp-183](dcp-183-font-come-asset-di-vite.story.md)
- [accessibility-audit-dcp](../../wiki/concepts/accessibility-audit-dcp.md)
- [homepage-guest-visual-fix](../../wiki/concepts/homepage-guest-visual-fix.md)
- [dcp-143](dcp-143-accessibilita-difetti-aria-e-audit-manuale-wcag-21-aa.story.md)
- [decision-log Sixteen](../decision-log.md)
