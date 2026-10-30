---
title: "Niente testi fissi nelle Blade del tema Sixteen (multilingua it/en/de/es)"
type: story
status: implemented
theme: Sixteen
updated: 2026-10-30
tags: [i18n, blade, multilingua]
---

# Niente testi fissi nelle Blade del tema Sixteen

## Scopo

Il sito risponde in italiano, inglese, tedesco e spagnolo: un testo scritto dentro una Blade esce uguale in ogni lingua. Il `fallback_locale` e' `it`, quindi una chiave mancante in `en`/`de`/`es` non da' errore e mostra l'italiano. Le frasi inglesi di Jetstream usate come chiave (`__('Frase')`) non erano tradotte da nessun file.

## Regola operativa

- Ogni testo visibile passa da `{{ __('pub_theme::contesto.collezione.chiave.tipo') }}`: cinque elementi, dove `contesto` e' il nome del file lingua e `tipo` il genere di testo (`label`, `title`, `description`, `placeholder`, `tooltip`, `helper_text`, `message`, `aria_label`, `alt`; [regola 008](../../../../../docs/wiki/rules/008-translation-5-level-protocol.md)). Mai la frase come chiave, e il traduttore ignora `['default' => ...]`.
- Namespace: solo `pub_theme::`, mai `sixteen::` ne' `two::`. Il CMS mappa `pub_theme` su `Themes/<tema attivo>/lang`: le chiavi si risolvono quando il tema attivo e' Sixteen.
- La stringa va in `Themes/Sixteen/lang/{it,en,de,es}/<contesto>.php`, con le stesse chiavi e gli stessi `:parametri` nelle quattro lingue. `it` e' l'originale al byte; `en`, `de`, `es` sono traduzioni vere. Se l'originale era inglese (scaffold), `en` lo conserva e `it` e' la traduzione.
- Vale anche per `aria-label`, `placeholder`, `title`, `alt`, per i default testuali di `@props` e per i fallback `?? 'Testo'`. Le frasi con variabili usano `:param`; i plurali `trans_choice`; i testi dentro `<script>` `@js(__('...'))`.
- Link a pagine CMS: niente `href="/it/..."`, niente `url('/...')`, niente nomi di rotta inventati per pagina. Si usa il builder `Themes\Sixteen\Infrastructure\Url\FrontofficeRoutes` oppure le rotte generiche della shell Folio, `route('container0.index', ['container0' => 'tickets'])` e `route('container0.view', ['container0' => 'area-personale', 'slug0' => 'notifiche'])`: il prefisso lingua lo aggiunge Folio. I nomi Folio veri (`home`, `login`, `logout`) restano validi. Dettaglio: [link multilingua del front office](../wiki/concepts/fo-folio-links-multilingua.md).
- Non sono errori: marchi e nomi propri, sigle, numeri, valori che arrivano dal modello o dal CMS, `alt=""` decorativo.

## Cosa e' stato fatto

- Rilevatore `bashscripts/tools/i18n/find-hardcoded-blade-text.py` sul tema: da 3.427 occorrenze in 427 file a 1.052 in 136 file (stesso strumento, commit di partenza contro stato attuale).
- 350 Blade convertite in quattro passate: flussi di appuntamento, assistenza, pagamento, area personale, segnalazione e ticket; componenti AGID e Bootstrap Italia; header, footer, ricerca, form, report e comune; layout, Livewire, pagine, navigazione, offline, e-mail; scaffold di profilo e team; blocchi di elenco.
- Creati 41 file lingua per ognuna delle quattro lingue, circa 1.440 chiavi per lingua. Flussi e AGID: `flow_appointment`, `flow_assistance`, `flow_payment`, `flow_personal_area`, `flow_report`, `flow_tickets`, `agid_components`, `bootstrap_italia`, `comune_pages`, `footer_blocks`, `blocks_common`, `blocks_content`, `auth_pages`, `api_tokens`. Componenti: `components_common`, `components_header`, `components_footer`, `components_reports`, `components_municipal`, `components_content`, `components_forms`, `components_search`. Layout e pagine: `common`, `municipal_components`, `navigation_components`, `pages_components`, `ui_components`, `utilities_components`, `home_components`, `layouts_components`, `offline_page`, `appointment_form`, `emails_christmas`, `account_menu`, `auth_components`, `legacy_homepage`. Scaffold e liste: `account_forms`, `listing_blocks`, `footer_full`, `legacy_prototypes`, `tickets_list`. In piu', `404` per `de` ed `es`.
- Scelte: terminologia fissa per «segnalazione» (en Report, de Meldung, es Incidencia); frasi di consenso con link in una chiave con `:terms`, `:privacy`, `:rules`; valutazione a stelle con `trans_choice`; circa 170 default di `@props`/`@php` portati a `__()`; correzioni di accessibilita' (ruoli ARIA, `sr-only`, bersagli minimi) mantenute.
- 77 link con lingua fissa portati a `route()` (vedi «Link e namespace»).

## Link e namespace

- Link: dei 77 link, 62 chiamate `route('tests.view'|'tests.index', ...)` in 18 Blade sono state portate a `route('container0.view', ['container0' => 'tests', 'slug0' => ...])` e `route('container0.index', ['container0' => 'tests'])`. Un nome per pagina presuppone una pagina Folio per dominio, vietata dalla regola sulle directory semantiche. Residuo `tests.*`: 0.
- Namespace: 23 chiamate `__('sixteen::...')` in 14 Blade sono diventate `__('pub_theme::...')`. `sixteen::` e' registrato dal provider ma lega la vista a un solo tema; in Sixteen `pub_theme` punta alla stessa cartella `lang`, quindi la risoluzione non cambia.
- Restano, per classe, contati dal rilevatore e non corretti: nomi di rotta di pagina richiesti da un test di contratto dell'header (31), URL fissi in `url('/...')` (74), nomi di rotta che nessun file definisce (66).
- Forma da preferire in Sixteen: `Themes\Sixteen\Infrastructure\Url\FrontofficeRoutes`, che incapsula `container0.view` e `container0.index`.

## Residui dichiarati (1.052 occorrenze, stima per categoria)

| Categoria | N |
|---|---:|
| Viste di prototipo, legacy o demo non instradate (pagine vecchie, template, prove, dump) | circa 630 |
| Direttive Blade, frammenti di codice e binding Alpine: falsi positivi | circa 190 |
| Dati di esempio, segnaposto e contenuti mock (indirizzi, e-mail, codici pratica, elenchi di prova) | circa 120 |
| Marchi e nomi di servizio (social, VISA, PagoPA, OpenStreetMap) | circa 100 |
| Autonimi di lingua (Italiano, English) | circa 13 |

Testi in PHP: non cercati in questa campagna sul tema, quindi non toccati.

## Limiti

- Nessuna verifica a video: la resa, `@js()` nei template JavaScript e la risoluzione di `route()` con il prefisso lingua non sono state provate; le traduzioni de/es non sono riviste da un madrelingua.
- Alcuni link restano nella forma precedente, per classe in «Link e namespace»; percorsi con lingua fissa scritti dentro `{{ }}` possono sfuggire al rilevatore.
- Dove il contenuto arriva dal CMS (JSON, database), il testo resta nella lingua in cui e' stato scritto: de/es dei contenuti non fanno parte di questa campagna.
- Verifica del 2026-10-30: compilazione Blade dei file convertiti senza errori, nessuna chiave usata dalla campagna manca in `it`, `en`, `de`, `es`.

## Riferimenti

Metodo e regola completa: [story del tema Two](../../../Two/docs/stories/blade-i18n-no-hardcoded-text.story.md); protocollo a cinque elementi: [regola 008](../../../../../docs/wiki/rules/008-translation-5-level-protocol.md). Regola completa dei link e motivi: [§2 del promemoria sul protocollo di traduzione](../../../../../docs/wiki/memories/translation-protocol-memory-aid.md). Il dettaglio per file e' nel repo privato di audit.

## Seguito: forma delle chiavi

Le chiavi a 2-3 segmenti create da questa campagna sono state in parte portate a `ns::file.collezione.chiave.tipo`: **5 chiavi spostate** in questo proprietario (stesso testo, tutte le lingue, usi riscritti, nessun uso della vecchia chiave rimasto). Le altre sono bloccate da file lingua con commenti o gia' in HEAD: vedi [la story dei residui di Sixteen](pub-theme-keys-and-route-names-residuals.story.md). La frase sui «tre o quattro elementi» qui sopra descrive lo stato precedente: le chiavi rimaste a 3-4 elementi non sono state verificate una per una; la misura assoluta, lo strumento e i residui sono in [la story di Lang](../../../../Modules/Lang/docs/stories/translation-key-shape-rekey.story.md).
