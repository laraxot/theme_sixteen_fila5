---
id: dcp-99
title: "DCP-99: HTML rigoroso >= 90%: asset relativi come il riferimento (opzione A di DCP-94)"
type: story
epic: dc-parity-v2
status: in-review
priority: P0
owner: theme:Sixteen
created: 2026-10-13
updated: 2026-10-13
qmd: "html rigorosa asset relativi sprites svg href src alias rotta lingua assets DesignComuniAssets route cache dcp94 dcp99 90 per cento"
related: [dcp-94, dcp-92, dcp-00]
tags: [docs, sixteen, bmad]
---

# DCP-99: stessi valori di `href`/`src` degli asset del riferimento

## Perche'
Il criterio dell'utente e' HTML body >= 90% (la gate rigorosa conta anche i valori di `href`/`src`). Con gli URL assoluti dei nostri asset (`http://.../themes/Sixteen/design-comuni/assets/...#it-x` contro `../assets/...` del riferimento) solo 13 pagine su 37 passavano (82,6-93%), con la struttura al 97-99%. Misura di fattibilita' prima di toccare nulla: sostituendo il solo prefisso sull'HTML scaricato, `permessi-pagamento` 86,04 -> 92,36, `pagamenti-multa-dati-specifici-fase1` 86,86 -> 93,16, `graduatoria-perfezionamento` 86,91 -> 93,02, `graduatoria-messaggio` 87,41 -> 93,38.

## Decisione (sessione tema, 2026-10-13, reversibile; sotto la regola "non fermarti" dell'utente)
Opzione A di [DCP-94](dcp-94-decisione-metrica-html-rigorosa.story.md) senza inquinare le rotte vere: nelle pagine con chrome Design Comuni gli asset del body hanno lo stesso valore relativo del riferimento (`../assets/...`), e una rotta di sola lettura li serve. Si continuano a riportare SEMPRE entrambe le misure (rigorosa e normalizzata): il valore normalizzato resta quello che misura la struttura.

## Come funziona
- `Themes/Sixteen/app/Support/DesignComuniAssets.php`: `base()` e `url($path)`. Con il flag di vista `dcRelativeAssets` il prefisso e' relativo al percorso corrente: `/{lingua}/x/y` -> `../assets`, `/{lingua}/x` -> `./assets`, altrimenti resta `asset('themes/Sixteen/design-comuni/assets')`. Senza il flag (sito reale `/it`, aggiornamenti Livewire) l'output e' identico a prima: `/it` resta pixel-identica.
- Il flag lo condividono le pagine Folio: `pages/tests/[slug]`, `pages/tests/index` e `pages/[container0]/[slug0]` quando il JSON ha `layout` design-comuni* (non `<x-layout>`: il contenuto dello slot si valuta prima del layout).
- `routes/web.php`: `GET /{lang}/assets/{path}` -> `Themes\Sixteen\Actions\Assets\ServeDesignComuniAssetAction` (invocabile, cacheabile), che delega a `ServeThemeAssetAction` (percorso confinato in `Themes/Sixteen/public`, rifiuta `..`). Verificato: sprites `/it/assets/bootstrap-italia/dist/svg/sprites.svg` e `/en/...` 200 `image/svg+xml`; immagine 200; file inesistente 404; due tentativi di traversal 404.
- 76 viste sostituite (`asset('themes/Sixteen/design-comuni/assets')` -> `DesignComuniAssets::base()`) in `components/blocks`, `components/sections`, `components/wizard`, `filament/widgets`; il logo dell'header e il logo UE del footer (percorsi dal JSON) passano da `DesignComuniAssets::url()`. NON toccati i file del sito reale (`header-comune`, `footer-comune`, `footer-slim`). Backup delle viste in scratchpad `dcp99-backup/`.
- **Cache delle rotte**: `bootstrap/cache/routes-v7.php` esisteva (12:42) e nascondeva la rotta nuova; rigenerata con `php artisan route:cache` (backup del vecchio file nello scratchpad). Chi aggiunge o cambia rotte deve rieseguirlo (con closure non e' cacheabile: usare azioni invocabili). In produzione la rotta si puo' sostituire con una riscrittura del web server verso `themes/Sixteen/design-comuni/assets` (static, piu' veloce).

## Misure (2026-10-13, compare-body-html.mjs, 81 pagine del manifest)
HTML rigorosa >= 90 su **79 pagine su 81** (prima 13 su 37 per le sole servizi/ + catalogo). Sotto soglia solo i due cataloghi: `index.html` 89,54 / 98,40 e `servizi/index.html` 89,72 / 98,69 (i collegamenti dell'elenco sono `sito/x.html` nel riferimento e `/it/tests/x` da noi: non risolvibili come relativi). Pixel: vedi sotto (campione).

## Aperto
- Pixel a campione dopo la sostituzione e sentinelle: righe in coda a questa story.
- I due cataloghi: o allineare i `href` dell'elenco (non risolvibili) o accettare 89,5-89,7.
- Il valore rigoroso copre solo asset; i collegamenti di pagina restano diversi per natura (rotte nostre).

## Pixel e sentinelle dopo la sostituzione (parity-sweep.sh, 10 pagine, 2026-10-13 14:22)
HTML rigorosa / normalizzata, pixel minimo, altezze: amministrazione 93,97 / 98,15, 99,79; eventi 95,39 / 98,59, 99,68; evento-dettaglio 95,09 / 97,85, 98,8 (invariato); homepage 95,76 / 98,67, 99,83; permessi-scheda-servizio 95,19 / 98,16, 99,69; pagamenti-multa-conferma 93,38 / 97,96, 99,63; vantaggi-area-personale 96,26 / 98,9, 99,65; segnalazione-03-riepilogo 93,31 / 97,94, 99,72; catalogo `index` 89,54 / 98,4, 99,78; `servizi-index` 89,72 / 98,69, 99,75. Altezze uguali su tutte: le sprite e le immagini arrivano dalla rotta nuova. `/it` (sito reale) contro la baseline: 0 pixel diversi su 4.982.400 (output identico: il flag non e' impostato fuori dalle pagine Design Comuni). Stato: in revisione, resta lo sweep completo a fine giornata.

## Test (TDD a posteriori, 2026-10-13 14:50; ammissione: la sostituzione era gia' fatta quando li ho scritti)
`Modules/Fixcity/tests/Unit/DesignComuniAssetsTest.php` (10 casi: URL assoluto senza flag; `../assets` per `it/tests/x`, `it/tickets/create`, `en/tests/x`; `./assets` per `it/tests`; `../../assets` per tre segmenti; ripiego assoluto senza prefisso di lingua, solo lingua, prefisso lungo; `url()` mappa solo i percorsi sotto `themes/Sixteen/design-comuni/assets/`) e `Feature/DesignComuniAssetRouteTest.php` (6 casi: sprite 200 `svg` con `Cache-Control` pubblico in `it` ed `en`; 404 per file inesistente; tre varianti di traversal 404). `Tests: 16 passed (21 assertions)`; PHPStan a zero. Usano il TestCase del modulo Fixcity perche' il boot dell'app col TestCase radice richiede `database/fixcity_user_test.sqlite` (assente). Comando: `cd laravel && APP_ENV=testing DB_CONNECTION=sqlite ./vendor/bin/pest <file>`.

## Difetto trovato e corretto dopo (16:30): URL con barra finale
Le pagine rispondono 200 anche con la barra finale (`/it/tests/homepage/`, `/it/tests/`, `/it/tickets/confirmation/`: nessun redirect) e per il browser la directory del documento e' quella stessa: con `../assets` calcolato dal solo percorso senza barra le icone sarebbero andate in 404. `DesignComuniAssets` ora calcola la profondita' dalla directory del documento (`getPathInfo()` fino all'ultima `/`): `/it/tests/homepage/` -> `../../assets`, `/it/tests/` -> `../assets`, `/it/tests` -> `./assets`, query string ignorata. Test: 13 casi verdi (3 nuovi: barra su pagina, barra su sezione, query string); PHPStan a zero. Lezione: un percorso relativo dipende dall'URL come lo vede il browser, non dalla rotta.

