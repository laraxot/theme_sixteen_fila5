---
id: dcp-212
title: "DCP-212: la compilazione dei template Sixteen e' provata solo per il 55 per cento"
type: story
epic: dc-parity-v2
status: ready-for-dev
priority: P2
owner: theme:Sixteen
created: 2026-10-15
updated: 2026-10-15
qmd: "blade compilazione template sixteen view:cache parse php lang echo componenti non coperti navigation dcp-50 story 1.4 BladeTemplatesCompileTest"
related: [dcp-50, dcp-200]
tags: [blade, test, qualita, decisione]
---

# DCP-212: copertura della compilazione Blade del tema Sixteen

## Fase BMAD
Verify. Nasce dalla chiusura della story 1.4 (`bmad-output/stories/1.4.view-cache-component-integrity.story.md`) e dal difetto trovato il 2026-10-14: `blocks/navigation/simple.blade.php` usava `@lang()` dentro `{{ }}` e produceva PHP invalido (`unexpected token "<"`). `php artisan view:cache` usciva 0 comunque, perche' compila ma non fa il parse del PHP prodotto.

## Stato misurato (2026-10-15)
- `Themes/Sixteen/resources/views` contiene **963** template `.blade.php`.
- `tests/Unit/BladeTemplatesCompileTest.php` ne compila e ne fa il parse di **529**: `pages` (9), `components/layouts` (11), `components/blocks` (509). Pest: 532 passati su 532 (3 casi in piu' sono prove del test stesso).
- **434 template (45%) non sono coperti.** Per cartella: `components` direttamente (42), `components/ui` (30), `components/bootstrap-italia` (25), `components/utilities` (22), `components/sections` (22), `components/navigation` (18), `components/layout` (17), `components/forms` (17), `bootstrap-italia` (16), `pub_theme/components` (15), `pages_old/auth` (13), `components/data-display` (12) e altre minori.
- Un test che compila fuori dall'app fallisce per 63 blocchi (componenti non risolvibili senza avvio): dentro Pest, con l'app avviata, passano tutti.

## Compiti
- [ ] Estendere il dataset del test alle cartelle non coperte, **una alla volta**, leggendo l'esito (un template rotto e' un difetto vero da correggere, non una ragione per escluderlo).
- [ ] Per i template che non si compilano e non sono raggiunti da nessuno: decisione DEC-38 qui sotto.
- [ ] **AC#2 della 1.4, mai provato**: renderizzare il blocco `blocks/tests/segnalazione-crea.blade.php` con `<x-blocks.geo.mappa-static>` e ispezionare l'HTML della mappa. Oggi si sa che l'alias risolve e che il template compila, non cosa produce.
- [ ] Mettere il test di compilazione nel gate di qualita' (story 7.3) accanto a PHPStan: `view:cache` da solo non basta.
- [ ] Cercare altri `@lang`/`@json`/`@php` dentro `{{ }}` con `rg` mirato sul tema, ora che la causa e' nota.

## Decisioni
| ID | Decisione | Opzioni | Proposta | Chi decide |
|---|---|---|---|---|
| DEC-38 | `components/layouts/navigation.blade.php` non compila (un `@if` senza chiusura nel PHP prodotto) e nessun codice lo raggiunge (`@include('layouts.navigation')` risolve a `layouts/navigation.blade.php`); oggi il test lo esclude (DCP-50) | (a) ripararlo; (b) rimuoverlo con un commit in avanti | (b): nessuno lo usa; se serve in futuro si riscrive | titolare del tema |

## Criteri di accettazione
- [ ] Ogni cartella di `resources/views` e' coperta dal test o esclusa con un motivo scritto.
- [ ] DEC-38 ha un esito datato.
- [ ] L'AC#2 della 1.4 ha una prova (output della mappa).

## Non verificato
Il rendering reale dei template (solo la compilazione e' provata); l'esecuzione del gate in un ambiente di integrazione continua (non esiste un esito citabile).
