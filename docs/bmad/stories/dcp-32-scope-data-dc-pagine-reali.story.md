---
id: dcp-32s
title: "DCP-32S: scope CSS Design Comuni per le pagine reali (data-dc) e layout scelto dal JSON"
type: story
epic: dc-parity-v2
status: in-review
priority: P0
owner: theme:Sixteen
created: 2026-10-13
updated: 2026-10-13
qmd: "design comuni scope data-dc pagine reali tickets create confirmation layout json isDesignComuniPage"
blocks: [dcp-33, dcp-34]
tags: [docs, sixteen, bmad]
---

# DCP-32S: lo scope CSS vale anche per le pagine reali

## Perche'
Il CSS generato (`resources/css/design-comuni/components.css`) vale solo sotto `body:has(.page-content[data-slug*="tests."])`: un proxy di "pagina di prova", scelto per isolare il front office reale. Ora l'utente vuole che due pagine reali (`/it/tickets/create` passo riepilogo e `/it/tickets/confirmation`) abbiano altissima parity con `sito/segnalazione-03-riepilogo.html` e `-04-conferma.html`: chrome (header, footer), stepper, schede, contatti. Senza lo scope quelle pagine non ricevono nessuna regola.

## Decisione (la piu' piccola che regge)
- Lo scope diventa un attributo esplicito sul wrapper: `.page-content[data-dc]`. Lo mettono le pagine di prova (`pages/tests/[slug]`, `pages/tests/index`) e le pagine reali il cui JSON dichiara `"layout": "design-comuni"` (o `design-comuni-authenticated`, `design-comuni-bare`): `pages/[container0]/[slug0]/index.blade.php` sceglie `layouts.<layout>` e stampa `data-dc`. Le altre pagine reali (`/it`, `/it/tickets`, login, dettaglio) restano su `layouts.app` / `layouts.test` e non cambiano di un pixel.
- Nessuna classe o attributo sul `<body>` (policy `html-parity-body-policy.md`): `body:has(.page-content[data-dc])`.
- Cinque punti di codice usano lo scope: `scripts/regenerate-design-comuni-css.sh` (`--scope`), `postcss/isolate-legacy-important.cjs` (`SCOPE`), `resources/js/theme/header-mobile-nav.js` (`isDesignComuniPage`), `resources/js/theme/design-comuni-home.js` (`mountDesignComuniComponents`), `resources/css/design-comuni/overrides.css` (1 regola).
- Per non ripetere i 5-10 minuti di estrazione (carico alto: 2 `llama-server` di Ollama tengono ~16 core su 24) il prefisso nel `components.css` gia' generato si sostituisce con `sed` e si fa un solo `npm run build`; la prossima rigenerazione completa usa lo scope nuovo da sola.

## Fatto
- Wrapper `data-dc` nelle pagine di prova e nella pagina reale (verificato: `/it`, `/it/tickets`, `/it/tickets/create`, `/it/auth/login`, `/it/tickets/confirmation` rispondono 200 senza `data-dc`; `/it/tests/homepage` lo ha).
- `pages/[container0]/[slug0]/index.blade.php`: `layout` del JSON `design-comuni*` -> `layouts.<layout>`.

## Fatto (2026-10-13)
- Scope cambiato nei 5 punti (`regenerate-design-comuni-css.sh`, `postcss/isolate-legacy-important.cjs`, `header-mobile-nav.js`, `design-comuni-home.js`, `overrides.css`) e nel prefisso di `components.css` (`sed`, 0 occorrenze vecchie); un solo `npm run build` (exit 0). Backup dei file prima del cambio nello scratchpad `dcp0-backup/scope/`.
- CORREZIONE (13:55): avevo fatto saltare al plugin PostCSS le regole `.fi-*` pensando che fossero la libreria Filament. Errore: il CSS di Filament arriva dall'asset separato `@filamentStyles`, e le `.fi-*` nel bundle del tema sono TUTTE regole legacy di parity del vecchio look (`.fi-sc-wizard button{background:#007a52}`, `.fi-sc-wizard-footer{display:flex!important}`, ...). Con l'esenzione dipingevano di verde ogni pulsante del wizard e tenevano visibile il footer Filament sul riepilogo. Rimossa: sotto `data-dc` le regole legacy `.fi-*` sono isolate come tutte le altre, e il wizard riceve Filament vendor + Design Comuni. Conseguenza dichiarata: i passi 1-2 sulle pagine con `data-dc` perdono lo shell legacy finche' DCP-35 non cabla le sue viste `dc-*`.
- CSS compilato: 0 riferimenti al vecchio scope, 24.016 al nuovo.
- Sentinelle: `/it` contro `home-before.png`: 5 pixel diversi su 4.982.400 (0,000%). Altre sentinelle: vedi sotto (sweep di 4 pagine di prova e gate della conferma reale).
- Sweep dell'ondata 2 prima del cambio (37 pagine, CSS rigenerata con 81 pagine): pixel minimo >= 99,61%, altezze uguali, HTML rigoroso >= 90 su 13 di 37, URL normalizzati >= 97,49%.

## Ancora da fare
1. Attivare `"layout": "design-comuni"` in `tickets.create.json` SOLO d'accordo con DCP-35 (passi 1-2) e DCP-33 (riepilogo): la pagina cambia chrome per tutti e tre i passi.
2. Aggiornare l'epic con i numeri finali dell'ondata 2 e la memoria (fatto in parte).

## Registro di coordinamento (leggere prima di toccare qualsiasi file della tabella; aggiornare la propria riga)
Fonte unica per sessioni e agenti: le story BMAD. Regola: prima di modificare un file controllare `find -mmin` e `git diff`; modifiche minime e idempotenti; chi chiude un lavoro scrive qui la riga e nella propria story. Build, `regenerate-design-comuni-css.sh` e `npm run build` li lancia solo l'orchestratore (sessione principale del tema): uno alla volta, con lock `/tmp/design-comuni-build.lock`.

| Voce | Story | Responsabile | File | Stato 2026-10-13 |
|---|---|---|---|---|
| Scope `data-dc` (5 punti + sed del prefisso) e un `npm run build` | DCP-32 | orchestratore (sessione tema) | `regenerate-design-comuni-css.sh`, `postcss/isolate-legacy-important.cjs`, `header-mobile-nav.js`, `design-comuni-home.js`, `overrides.css`, `components.css` | in attesa dello sweep dell'ondata 2 (non si puo' costruire mentre misura) |
| Wrapper `data-dc`, layout dal JSON (pagine reali) | DCP-32 | orchestratore | `pages/[container0]/[slug0]/index.blade.php`, `pages/tests/*` | fatto, verificato |
| Conferma: azione, adattatore, JSON it/en, `layout-done` | DCP-34 | orchestratore + subagent test | `Actions/ResolveTicketConfirmationDataAction.php`, `blocks/ticket-confirmation/`, `tickets.confirmation.json`, `report-step/layout-done` | codice fatto; manca misura (dipende dallo scope) e test |
| Test di funzionalita' + PHPStan della conferma | DCP-34 | subagent `dcp34-tests` | `Modules/Fixcity/tests/Feature/Pages/TicketConfirmationPageTest.php`, `tests/Unit/Actions/ResolveTicketConfirmationDataActionTest.php` | fatto: 13 test verdi (SQLite, `APP_CONFIG_CACHE` escluso, vedi story DCP-34), PHPStan 0; aperti: link `/it/contacts` 404, `description` it nel meta en, 2 test vecchi rossi in `CreateTicketConfirmationFlowTest` |
| Wizard: vista, schema, mappa nel riepilogo | DCP-33 | **altra sessione attiva** (12:34-12:50) + subagent `dcp33-plan` (solo analisi) | `filament/widgets/create-ticket-wizard.blade.php`, `TicketForm.php`, `TicketFormReviewInfolist.php`, lang `ticket_form`, test del widget | NON toccare senza rileggere; il subagent consegna un piano, non codice |
| Ondata 2 (graduatoria, imu, multa, permessi, vantaggi) e `servizi-index` | DCP-26..31 | orchestratore | manifest, `components.css`, sweep | sweep di 37 pagine in corso (carico alto per due `llama-server` di Ollama) |

## Stato (14:20)
In revisione. Fatto: scope `data-dc` nei 5 punti e in `components.css`; tre build eseguiti dall'orchestratore (scope, Lit `readonly`, revert dell'esenzione `.fi-*`); wrapper `data-dc` e scelta del layout dal JSON (`design-comuni`, `design-comuni-bare`, `design-comuni-authenticated`) sia in `pages/tests/[slug]` sia in `pages/[container0]/[slug0]`; `tickets.create.json` ora con `"layout": "design-comuni"` (3 copie). Sentinelle dopo il primo build: `/it` 5 px su 4.982.400, sweep di 4 pagine di prova invariato; dopo i build successivi sono ricontrollate solo `/it` e le pagine reali con `curl` (200): **da rifare una sentinella completa a fine giornata** (sweep a campione + `/it` + `/it/tickets`). Seguiti: DCP-91 (wizard e CSS legacy), DCP-92 (header), DCP-97 (registro di numerazione).
