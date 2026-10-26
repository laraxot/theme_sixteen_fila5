---
title: "Perché pages/home.blade.php e pages/homepage.blade.php nel tema non devono esistere"
type: knowledge-page
status: active
created: 2026-10-23
updated: 2026-10-23
tags: [knowledge, architecture, bmad, second-brain, sixteen, folio, homepage, cms]
qmd: "why home blade homepage blade must not exist theme sixteen pages root index home.json"
related:
  - ./why-profile-edit-blade-must-not-exist.md
  - ./why-domande-frequenti-blade-php-must-not-exist.md
  - ../../page-directory-structure.md
  - ../homepage-local-parity.md
  - ../../../../../config/local/fixcity/database/content/pages/home.json
  - ../../../../../Modules/Fixcity/docs/homepage-content-contract.md
  - ../../../../../../docs/second-brain/process/sixteen-pages-folder-religion.md
---

# Perché `pages/home.blade.php` e `pages/homepage.blade.php` non devono esistere

## Dove vive la homepage

`/{lingua}` lo serve **solo** `Themes/Sixteen/resources/views/pages/index.blade.php` (shell Folio+Volt →
`<x-page slug="home">`).

**SSOT contenuto tenant:** `laravel/config/local/fixcity/database/content/pages/home.json`
(`content_blocks` per lingua). Contratto owner:
[homepage-content-contract.md](../../../../../Modules/Fixcity/docs/homepage-content-contract.md).

Cambiare la home = aggiornare quel JSON (+ sync CMS) **oppure** i blocchi
riutilizzabili citati dal JSON (`components/blocks/...`). Mai una page Blade dedicata.

## Perché un file in piu' e' sbagliato (misurato 2026-10-23)

1. **Seconda fonte della stessa pagina.** `homepage.blade.php` era una homepage scritta a mano: header blu,
   «Nome della Regione», «Benvenuto nel portale del …», solo italiano, rotte `services.categories` e `contact`
   che non esistono. Non e' Design Comuni, non e' multilingua, non e' CMS.
2. **Nome di rotta duplicato.** `home.blade.php` dichiarava `name('home')` come `index.blade.php`. Folio tiene
   l'ultimo registrato: `route('home')` puo' finire su `/it/home` invece che su `/it`.
3. **Morti che fingono di vivere.** Folio prova le cartelle letterali, poi quelle jolly, poi i file: un file in
   radice perde contro `[container0]`. Misurato: `/it/home`, `/it/homepage`, `/it/counter`, `/it/prova01`,
   `/it/show`, `/it/bootstrap-italia-showcase` 404; `/it/privacy` e `/it/cookie-policy` le serve
   `[container0]/index` dal JSON. Chi legge il codice crede che quei file possiedano una pagina.

## Perche' tornano

Creati il 2026-10-07 dal merge di `laraxot/dev`, tolti il 10-11, ricreati il 10-18, modificati il 10-22: il tema
e' un repo condiviso e il merge li riporta. La guardia Pest guardava solo le **cartelle** di `pages/`, l'hook
esentava i file in radice: nessun controllo li vedeva.

## Cosa e' stato fatto (2026-10-23)

- Tolti i 9 file morti in radice (`[slug]`, `bootstrap-italia-showcase`, `cookie-policy`, `counter`,
  `index.blade.php.old`, `privacy`, `prova01`, `segnalazioni`, `show`); `home` e `homepage` li aveva gia' tolti
  un'altra sessione. Stati HTTP di 15 URL identici prima e dopo; `route('home')` = `/it`.
- `NoSemanticFolioPageDirectoriesTest`: secondo test, in radice solo `index.blade.php` (rosso con 9 file, verde dopo).
- `theme-pages-guard.sh`: rifiuta anche i file in radice (12 casi provati).

## Aperto

Codice morto anche alla radice del **tema** (fuori da `resources/views`): `pages/comune/homepage.blade.php`,
`components/header-comune.blade.php`, `components/footer-comune.blade.php`, `routes/web.php` (il provider carica
solo `routes/auth.php`; `/privacy` senza lingua risponde 404). Gli ultimi due sono stati modificati da un'altra
sessione il 2026-10-22: non toccati, da decidere nella story owner.
