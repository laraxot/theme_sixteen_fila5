---
title: "FAQ: ownership della route e del blocco"
type: contract
status: active
created: 2026-10-20
updated: 2026-10-20
tags: [bmad, folio, cms, faq, filament-blueprint]
related:
  - ./container0-index-shell-contract.md
  - ./filament-blueprint.md
  - ./knowledge/why-domande-frequenti-blade-php-must-not-exist.md
  - ../../../../Modules/Cms/docs/wiki/concepts/container0-index-json-driven-pages.md
  - ../../../../Modules/Fixcity/docs/faq-catalog-ownership.md
qmd: "`domande-frequenti/index.blade.php` non deve esistere sixteen"
---

# `domande-frequenti/index.blade.php` non deve esistere

La FAQ è una pagina CMS di primo livello. L'URL `/it/domande-frequenti` deve
essere servito dallo shell generico:

```text
Folio [container0]/index
  → pageSlug = domande-frequenti.index
  → CMS JSON pages/domande-frequenti/index.json
  → block content-page (design-comuni)
      sections: search → accordion (source: faq → ListPublishedFaqsAction)
      feedback → partial dc-rating · contacts → partial dc-contacts
```

Fino al 2026-10-20 il JSON montava il blocco monolitico `faq-page` →
`components/pages/faq.blade.php`; con [DCP-260](./stories/dcp-260-faq-composizione-blocchi-condivisi.story.md) e D23
la pagina compone i blocchi condivisi e quel blocco non è più referenziato.

Una view dedicata è vietata, in entrambe le forme. Folio 1.2.0 valuta per ogni
segmento `MatchLiteralDirectories` prima di `MatchWildcardDirectories`, e
`MatchLiteralViews` dopo (`vendor/laravel/folio/src/Router.php`):

- `resources/views/pages/domande-frequenti/index.blade.php` (cartella omonima)
  **intercetta** l'URL e bypassa il resolver CMS: è la seconda route Folio;
- `resources/views/pages/domande-frequenti.blade.php` (file omonimo) **perde**
  contro `[container0]` (misurato il 2026-10-20: la shell ha continuato a servire
  `domande-frequenti.index`), ma è una seconda sorgente morta che fa credere di
  possedere la pagina.

Il perché misurato sta in
[why-domande-frequenti-blade-php-must-not-exist.md](./knowledge/why-domande-frequenti-blade-php-must-not-exist.md).

## Perché il 200 non basta

La view duplicata può mostrare `200 OK` pur non leggendo il JSON del tenant,
non rispettando la composizione Filament/CMS, non ereditando il corretto chrome
e non usando il contratto dati localizzato. Il bug è architetturale, non solo
visivo.

## Ownership

| Responsabilità | Proprietario |
|---|---|
| route generica, slug e `<x-page>` | Cms + shell Sixteen |
| domande, fallback e pubblicazione | Fixcity Action/catalogo |
| markup e utility visuali riusabili | Sixteen block |
| scelta dei blocchi e label tenant | CMS JSON/Filament |

Il tema non crea una Folio page per risolvere un problema del blocco. Si modifica
il componente condiviso, il JSON o l'Action owner, a seconda della causa.

## Guardrail obbligatori

- `NoSemanticFolioPageDirectoriesTest` verifica che né la cartella né il file
  omonimo esistano; rifiuta directory fuori da `auth`, `[container0]` e `tests`;
- `FolioPageMountContractTest` verifica che il file dedicato non esista e che la
  shell non nomini il contenitore;
- `FaqPageCompositionContractTest` verifica che il JSON compone `content-page`
  (it/en/de/es), senza `parity_page`, e che nessun CSS/JS del tema nomini la pagina;
- il JSON canonico è `config/local/fixcity/database/content/pages/domande-frequenti/index.json`;
- ogni modifica visiva va fatta nel componente condiviso (`content-page/sections/*`,
  `dc-rating`, `dc-contacts`) con un flag opzionale nel JSON, mai con CSS di pagina
  né utility Tailwind (spente su `data-dc`); verificata a 375, 768 e 1440 px con
  `getComputedStyle`, non con il grep della classe (vedi
  [shared-block-composition-no-page-css](../wiki/concepts/shared-block-composition-no-page-css.md));
- `components/pages/faq.blade.php` non è montato dal JSON del tenant;
- documentazione nuova di questo contratto resta in `Themes/Sixteen/docs/`;
  il dettaglio CMS va in `Modules/Cms/docs/` e il dettaglio dati in
  `Modules/Fixcity/docs/`.
