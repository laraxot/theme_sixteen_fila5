---
id: dcp-50
title: "Guardia di compilazione dei template Blade e hardening dei middleware CMS"
type: story
epic: dc-parity-v2
status: done
priority: P1
owner: theme:Sixteen
module: Sixteen
created: 2026-10-13
updated: 2026-10-13
tags: [test, blade, outage, cms, middleware]
related: [Themes/Sixteen/docs/bmad/stories/dcp-40-volt-radice-widget-livewire.story.md, Modules/Fixcity/docs/stories/dcp-42-tickets-create-auth-regressione.story.md]
qmd: "dcp-50 guardia compilazione template blade parse error outage login 500 PageSlugMiddleware web"
---

# DCP-50: guardia di compilazione dei template e hardening dei middleware CMS

## Incidenti del 2026-10-13 (stessa classe: una stringa sbagliata in un file condiviso manda in 500 pagine che non c'entrano)
1. 13:56:58 UTC: `"middleware": ["web","auth"]` in `tickets.create.json`. `PageSlugMiddleware` risolve ogni voce con `app($nome)`; `web` e' un gruppo: `Target class [web] does not exist`, 500 per tutti (D17, DCP-42). Corretto in `["auth"]` entro pochi minuti.
2. 14:14:20 UTC: un `@if` messo dentro gli attributi del tag `<x-dynamic-component ...>` in `pages/[container0]/[slug0]/index.blade.php`. Il compilatore Blade non lo supporta: `ParseError ... unexpected token "endif"`. Quella pagina serve login, registrazione e tracking: `/it/auth/login`, `/it/auth/register`, `/it/tickets/track` in 500 (log, `curl`: 500; `/it/tickets` e `/it/tests` 200). Ripristinato alle 14:17:15 UTC con un attributo `null` (`:header-active="$headerActive"`, non renderizzato quando e' `null`): circa 3 minuti.

## Modifiche
- `Themes/Sixteen/tests/Unit/BladeTemplatesCompileTest.php`: compila con `Blade::compileString` ogni template di `pages/**` e `components/layouts/*` e controlla il PHP con `token_get_all(..., TOKEN_PARSE)`. Due test di prova: un `@if` dentro il tag viene rilevato; l'attributo `null` equivalente e' accettato. Dataset con `Symfony\Finder` (si calcola prima dell'avvio dell'app: le facciate non esistono).
- `Modules/Cms/app/Http/Middleware/PageSlugMiddleware.php`: `web` e' un no-op documentato (e' gia' nello stack Folio); ogni altro nome non risolvibile lancia `InvalidArgumentException` con un messaggio chiaro invece di `Target class [x] does not exist`, e NON viene mai ignorato in silenzio (ignorare un refuso come `auht` renderebbe pubblica una pagina protetta).
- `Modules/Cms/tests/Unit/Http/Middleware/PageSlugMiddlewareTest.php`: due test nuovi (web ignorato; nome non risolvibile rifiutato con messaggio) e riparato il mock dell'alias (usava `getRouteMiddleware`, il codice chiama `getMiddlewareAliases`).

## Verifica (output reali, 2026-10-13 ~14:25 UTC, DB isolato come in DCP-45)
```
BladeTemplatesCompileTest: Tests: 17 passed (17 assertions)
PageSlugMiddlewareTest: 7 passed, 2 failed (preesistenti: resolveCmsPageSlug x2, "A facade root has not been set" e LogicException "while it is being booted")
phpstan (BladeTemplatesCompileTest.php, PageSlugMiddleware.php, PageSlugMiddlewareTest.php): 0 errori
```
Prima del fix: i due test nuovi del middleware erano rossi (`4 failed, 5 passed`); dopo: verdi. Prova che la guardia rileva l'incidente: il test "detects a directive placed inside a component tag" passa su un template che ricalca quello rotto.

## Trovato dalla guardia (non riparato)
`Themes/Sixteen/resources/views/components/layouts/navigation.blade.php` non compila (`unexpected end of file, expecting "elseif" or "else" or "endif"`, riga 296 del PHP compilato) ma nessun codice lo usa (`@include('layouts.navigation')` risolve a `layouts/navigation.blade.php`). Escluso dal controllo con il motivo scritto nel test. Decisione del proprietario: ripararlo o rimuoverlo (non si cancella senza di lui).

## Aperto
- Due test `resolveCmsPageSlug` del file Cms sono rossi da prima (stato dell'app non inizializzato nei test unitari): non toccati.
- `PageSlugMiddleware::handle` ha `catch (\Throwable) { $middlewares = []; }`: se la lettura dei middleware della pagina fallisce, la pagina diventa pubblica in silenzio (fail-open). Non l'ho cambiato (puo' dipendere dal tenant in contesti senza tenant); e' un finding per l'audit DCP-49.
- La guardia non copre i template sotto `components/**` diversi dai layout: estendere se serve.
