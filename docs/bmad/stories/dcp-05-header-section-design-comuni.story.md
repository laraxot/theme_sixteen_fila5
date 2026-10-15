---
id: dcp-05
title: "DCP-05: sezione header con markup Design Comuni da header.json"
type: story
epic: dc-parity-v2
status: done
priority: P0
owner: theme:Sixteen
created: 2026-10-13
updated: 2026-10-13
qmd: "design comuni parity dcp-05: sezione header con markup design comuni da header.json bmad story"
tags: [docs, sixteen, bmad]
---

# DCP-05: sezione header con markup Design Comuni da header.json

## Contesto
Header = 361 token nel riferimento; similarity del locale 17,8%. Il template `components/sections/header/v1.blade.php` (e `tailwind.blade.php`) e' Tailwind
e condiviso con tutto il sito. Il controller del menu mobile del tema (`resources/js/theme/header-mobile-nav.js`) cerca gia'
`.custom-navbar-toggler[data-bs-target="#nav4"]` e `#nav4.navbar-collapsable`: l'infrastruttura Alpine/JS e' pronta.

## Risultato (2026-10-13 sera, misurato)
Header `sections/header/design-comuni.blade.php` da `sections/header.json` (chiavi additive: `brand.header_title/menu_title`, `region.title/aria_label`, `languages`, `social_links`, `search`, `menu`, `account.element/login_label`, `navigation[].element`): header **100% a 1440, 992 e 375 px**, altezze identiche. Link lingua = stesso percorso in `/en`/`/it`; hamburger, tendina lingua e modale verificati con i pixel dopo il clic (99,7-99,9%).
Scelta di non cambiare il sito reale: la variante e' `tpl="design-comuni"` usata solo da `layouts/design-comuni` (pagine `pages/tests/*`); `/it` identica (0,000% pixel diversi). Gli stati utente (menu utente, accesso) restano nel header v1 del sito reale; qui l'account e' il link del JSON come in v1.

## Attenzione (scoperto leggendo i template)
`header/v1.blade.php` include `header/tailwind.blade.php` e i partial `language-switcher`, `nav-primary`, `nav-secondary`, `personal-area-*`, `user-dropdown`:
stato di accesso, lingue reali e menu utente. **Non sostituire con markup statico**: il markup deve combaciare con il riferimento mantenendo questi comportamenti.
Il CSS generato e' scoped `.dc-page`: la radice di header/footer deve avere la classe di scope (un token di differenza) oppure generare uno scope dedicato.

## Da fare
1. Estendere `config/local/fixcity/database/content/sections/header.json` (it/en) con: social (6 icone sprite), lingue, brand, navigazione, navigazione secondaria, "Tutti gli argomenti", account.
2. Template header che emette il markup del riferimento (`header.it-header-wrapper`: slim, center con "Seguici su" e "Cerca", navbar, menu) da JSON, icone via sprite SVG (`svg.icon.icon-white > use`), nessun testo cablato, it/en.
3. Stili generati scope `.dc-header` (stesso metodo di DCP-04: `extract-used-css.mjs --within header --scope ...`).
4. Difetti dell'audit: icone SVG bianche e non lettere, lente attaccata al box con "Cerca", hamburger solo quando serve, link senza sottolineatura.

## Criteri di accettazione
- Token parity della regione `<header>` >= 90%; pixel parity del selettore `header` >= 97% a 375/768/1440; clic su hamburger e dropdown lingua verificati (`--click`).
- Nessuna regressione su `/it` e sulle pagine sentinella.

## Verifica
```bash
node bashscripts/tools/visual/compare-screenshots.mjs https://italia.github.io/design-comuni-pagine-statiche/sito/homepage.html http://192.168.1.40:8000/it/tests/homepage --width 1440 --selector header --stub-images 'picsum\.photos'
```
