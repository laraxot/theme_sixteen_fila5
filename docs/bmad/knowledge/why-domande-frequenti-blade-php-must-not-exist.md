---
title: "Perché pages/domande-frequenti/index.blade.php non deve esistere"
type: knowledge-page
status: active
created: 2026-10-20
updated: 2026-10-20
tags: [knowledge, architecture, bmad, second-brain, sixteen, folio, faq]
qmd: "why-domande-frequenti-blade-php-must-not-exist folio cartella letterale precede container0"
related:
  - ../container0-index-shell-contract.md
  - ../faq-route-ownership.md
  - ../filament-blueprint.md
  - ../decision-log.md
  - ../../page-directory-structure.md
  - ../../wiki/rules/sixteen-pages-folder-religion.md
  - ../../wiki/concepts/folio-no-semantic-pages-tickets.md
  - ../../../../../Modules/Cms/docs/wiki/concepts/container0-index-json-driven-pages.md
  - ../../../../../Modules/Fixcity/docs/faq-catalog-ownership.md
  - ../../../../../Modules/Fixcity/docs/bmad/faq-parity.md
---

# Perché `pages/domande-frequenti/index.blade.php` non deve esistere

Il file non c’è, e non va ricreato. Vale lo stesso per `pages/domande-frequenti.blade.php`.

## Lo scopo della pagina

`/it/domande-frequenti` è una pagina di contenuto del comune: risposte su come si segnala, si segue una pratica e si entra in area personale. Il comune cambia testi, ordine e contatti dal JSON. Il tema veste. Fixcity possiede le domande.

Una Blade Folio col nome della pagina toglie al comune questa leva: l’URL smette di leggere il JSON e un 200 può arrivare da un vestito fermo nel tema.

## Perché Folio la farebbe vincere

Folio 1.2.0 prova le cartelle col nome vero prima delle cartelle jolly. `pages/domande-frequenti/index.blade.php` è il match letterale di `/domande-frequenti`. `[container0]/index.blade.php` è il jolly. Vince la cartella.

Da quel momento la richiesta non entra nella shell, non riceve lo slug `domande-frequenti.index` e non passa da `<x-page>`. Il JSON del tenant resta spento. È lo stesso incidente di `pages/tickets/` (STORY-285): path statico davanti al contenitore.

Un file piatto `pages/domande-frequenti.blade.php` perde contro il jolly, misurato dal test, e resta comunque una seconda sorgente morta. Entrambe le forme sono vuote: `glob pages/domande-frequenti*` deve restare vuoto.

## Catena che serve la pagina

```text
/it/domande-frequenti
  → pages/[container0]/index.blade.php
  → slug domande-frequenti.index
  → config/local/fixcity/database/content/pages/domande-frequenti/index.json
  → blocco content-page (pub_theme::components.blocks.content-page.design-comuni)
  → sezione accordion con source "faq"
  → Modules\Fixcity\Actions\Faq\ListPublishedFaqsAction
  → partial dc-rating e dc-contacts
```

Le domande stanno in `CivicFaqCatalog` e, se pubblicate, nella tabella `faqs`. Il JSON può sostituire l’elenco. Il vestito è quello di ogni pagina di contenuto: `.cmp-input-search`, `.cmp-accordion`, `.cmp-rating`, `.cmp-contacts`, in `resources/css/app/20-dc-components.css` sotto `.page-content[data-dc]`.

`components/pages/faq.blade.php` non è montato da nessun JSON del tenant. Modificarlo non cambia la pagina pubblica.

La shell non distingue la FAQ dal blog. `body-page` arriva solo se il JSON del blocco ha `parity_page`. Un `if ($container0 === 'domande-frequenti')` nella shell è la stessa seconda verità della cartella: il test di mount lo rifiuta.

## Chi possiede cosa

| Cosa | Chi |
|---|---|
| URL, slug, `<x-page>` | shell Sixteen + Cms |
| Quali blocchi, etichette, contatti | JSON del tenant |
| Testo delle domande e fallback | Fixcity, `ListPublishedFaqsAction` |
| Vestito `.cmp-*` | Sixteen, foglio dei componenti |

## Come si verifica

```bash
test ! -e laravel/Themes/Sixteen/resources/views/pages/domande-frequenti/index.blade.php
cd laravel && ./vendor/bin/pest Themes/Sixteen/tests/Unit/NoSemanticFolioPageDirectoriesTest.php Themes/Sixteen/tests/Unit/FolioPageMountContractTest.php --no-coverage
bash bashscripts/tools/verify-no-semantic-folio-pages.sh
```

`NoSemanticFolioPageDirectoriesTest` ammette solo le directory `auth`, `[container0]` e `tests`. `FolioPageMountContractTest` fallisce se il file FAQ ricompare e se la shell torna a nominare il contenitore.

## Collegamenti

- [Contratto shell](../container0-index-shell-contract.md)
- [Ownership della route](../faq-route-ownership.md)
- [Filament blueprint](../filament-blueprint.md)
- [D22](../decision-log.md)
- [Struttura pages/](../../page-directory-structure.md)
- [Religione cartelle](../../wiki/rules/sixteen-pages-folder-religion.md)
- [Stesso meccanismo sui ticket](../../wiki/concepts/folio-no-semantic-pages-tickets.md)
- [Cms](../../../../../Modules/Cms/docs/wiki/concepts/container0-index-json-driven-pages.md)
- [Catalogo Fixcity](../../../../../Modules/Fixcity/docs/faq-catalog-ownership.md)
- [Parità FAQ](../../../../../Modules/Fixcity/docs/bmad/faq-parity.md)
- [Second brain](../../../../../../docs/second-brain/process/sixteen-pages-folder-religion.md)
