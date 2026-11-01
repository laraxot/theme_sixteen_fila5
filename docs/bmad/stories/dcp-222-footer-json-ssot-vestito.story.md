---
id: dcp-222
title: "DCP-222: footer JSON SSoT — slogan e link nel footer.json, Blade solo vestito"
type: story
epic: dc-parity-v2
status: done
priority: P1
owner: theme:Sixteen
created: 2026-10-15
updated: 2026-10-15
qmd: "footer json ssot x-section vestito brand slogan links social dcp-198 a5 fixcity"
related: [dcp-198, dcp-131, dcp-137]
tags: [docs, sixteen, bmad, footer, json]
---

# DCP-222: footer come l'header — JSON SSoT, Blade vestito

## Scopo (perche')

`<x-section slug="footer">` legge `sections/footer.json`. Slogan (brand.description),
nome, colonne, contatti, legal e bottom links devono vivere nel JSON tenant.
Il Blade Sixteen e' solo presentazione (+ `FrontofficeUrl`). Stesso contratto D11
dell'header.

## Catena

```
layouts/app → <x-section slug="footer" tpl="design-comuni|full">
  → Section::getBlocksBySlug('footer')
  → config/{local,eu}/fixcity/database/content/sections/footer.json
  → pub_theme::components.sections.footer.{tpl}
```

## Implementazione (2026-10-15)

- Tre copie JSON (local, eu, modulo): brand **FixCity** + slogan prodotto;
  gruppi/colonne solo path reali (`/tickets`, `/create`, `/track`, FAQ, legale);
  `social: []`; `eu_logo.src` vuoto (D198-4/5).
- Vestito `design-comuni` / `v1`: filtra URL vuoti/`#` (niente `<a>` nudi — A5);
  `FrontofficeUrl`; niente copy «Nome del Comune».
- Guard: `Modules/Fixcity/tests/Unit/FooterJsonBrandAndLinksSsotTest.php`.

## Verifica live `/it`

- Brand FixCity + slogan «Segnala e segui…»
- Marchio footer = header (partial `brand-mark`, 82×82, stesso `brand.logo`)
- 0 bare `<a>` senza href; 0 social fake; 0 logo UE
- Link solo a path FixCity / legale
- Hamburger: stesso `brand.logo`, non sprite `it-pa`

## Criteri

- [x] JSON SSoT in 3 copie × 4 lingue
- [x] Blade senza hardcode istituzionale
- [x] A5: niente voci morte come link
- [x] Guard Pest green
- [x] Docs / decision-log / wiki

## Collegamenti

- [dcp-198](dcp-198-menu-footer-social-e-segnaposto-del-front-office.story.md)
- [zen-wizard-header-philosophy](../../wiki/concepts/zen-wizard-header-philosophy.md)
- [HeaderJsonBrandAndNavSsotTest](../../../../../Modules/Fixcity/tests/Unit/HeaderJsonBrandAndNavSsotTest.php)
