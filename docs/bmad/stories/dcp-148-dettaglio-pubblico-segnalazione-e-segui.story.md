---
id: dcp-148
title: "DCP-148: dettaglio pubblico /{lang}/tickets/{id} e funzione Segui"
type: story
epic: dc-parity-v2
status: done-with-open-decisions
priority: P1
owner: theme:Sixteen
created: 2026-10-13
updated: 2026-10-13
related: [dcp-104, dcp-93, dcp-33, dcp-124]
qmd: "dettaglio pubblico segnalazione tickets id segui follow SetTicketSubscriptionAction BuildPublicTicketDetailAction FollowTicketAction occurred_date design-comuni"
tags: [docs, sixteen, bmad]
---

# DCP-148: dettaglio pubblico della segnalazione e "Segui"

Fase BMAD: Implementation (TDD) a valle di DCP-104 (elenco). Numero verificato libero con `find laravel -iname '*dcp-148*'` prima di scrivere.
Wiki: `laravel/Modules/Fixcity/docs/wiki/concepts/public-ticket-detail-and-follow.md`.

## Obiettivo
`/{lang}/tickets/{id}` (id numerico) e' la pagina pubblica di una segnalazione gia' presa in carico. Il cittadino deve capire a che punto e', dove e', cosa dice, e poterla seguire. Prima era una scheda Tailwind con il chrome vecchio.
`sito/segnalazione-dettaglio.html` NON e' il dettaglio di un ticket (e' la pagina di servizio "Segnalazione disservizio"): nessun riferimento da replicare, conta lo scopo di ogni elemento.

## Cosa e' stato fatto
| Pezzo | File |
|---|---|
| Insieme dei campi esposti (unica fonte, array tipizzato, niente modello serializzato) | `Modules/Fixcity/app/Actions/BuildPublicTicketDetailAction.php` |
| Chiave `occurred_date` (solo giorno) accanto a `occurred_at` (invariata) | `Modules/Fixcity/app/Actions/BuildTicketTimelineAction.php` |
| POST Segui/Smetti (invocabile, `route:cache` ok) | `Modules/Fixcity/app/Actions/FollowTicketAction.php`, riga ancorata in `laravel/routes/web.php` (`tickets.follow`, `auth` + `throttle:30,1`, CSRF) |
| Testi 4 lingue | `Modules/Fixcity/lang/{it,en,de,es}/ticket_detail.php` |
| Vista | `Themes/Sixteen/resources/views/components/blocks/ticket-detail/{design-comuni,timeline}.blade.php`, `components/pages/ticket-detail.blade.php` (include sottile) |
| Ramo `ticket-detail` | `pages/[container0]/[slug0]/index.blade.php`: un blocco in `@php` (dati, 404, titolo, meta description, layout `design-comuni`, `header_active` `all-services`, `dcRelativeAssets`) e `data-dc` sul wrapper |
| CSS | `resources/css/app/19-ticket-detail.css` (importato dopo il 18), sotto `body:has(.page-content[data-dc])`, niente `!important` |
| Test | `Modules/Fixcity/tests/Feature/Pages/TicketPublicDetailPageTest.php` (16), `tests/Unit/Actions/BuildPublicTicketDetailActionTest.php` (7) |

Struttura della pagina: breadcrumb (Home / Elenco segnalazioni / titolo, link localizzati, mai `#`), un solo `h1` (titolo), riga meta (numero, tipologia, giorno), chip dello stato, poi quattro `h2`: Dove (indirizzo come lo mostra l'elenco + mappa di sola lettura), Descrizione (testo escapato, a capo con `nl2br(e())`), Stato della segnalazione (cronologia pubblica oppure una frase con lo stato attuale), Cosa puoi fare (Segui / Smetti di seguire per il loggato, "Accedi per seguire" per l'ospite, "Torna all'elenco", "Segnala un altro problema"). Dopo il POST: messaggio `role="status"` nella lingua dell'URL, con link a "Segnalazioni che seguo".

## Scostamenti dal design e perche'
1. Mappa: `<coordinate-picker-lit readonly>` diretto e NON `<x-geo::point-map>`. Il componente stampa sotto la mappa latitudine e longitudine a 6 decimali: sarebbe un'esposizione nuova rispetto all'elenco (decisione PP-02 aperta). L'alternativa testuale e' la riga Indirizzo + `aria-label` della regione. Nessun link a OpenStreetMap con coordinate esatte. Il Lit in `readonly` non da' tab stop al marker e a Leaflet (verificato: restano solo i due bottoni di zoom).
2. Indirizzo: riga etichetta + valore, non il partial `info-summary`: ha un'intestazione vuota con filo e padding da riepilogo del wizard (visto nello screenshot, disallineato dalla mappa). Riusati `breadcrumb` e le classi dell'elenco.
3. Visibilita': stessa query della mappa (`BuildPublicTicketsQueryAction::execute()` con `includeOwnTickets` di default). Il proprietario loggato apre il dettaglio della propria segnalazione ancora `pending` (lo richiede `CitizenMyTicketsDetailLinkTest`); ospite e altri cittadini: 404.
4. Cronologia: mostro anche `reason` (motivazione scritta dall'operatore su un'attivita' con visibilita' pubblica) e "Prima: stato". Se la privacy dell'operatore non e' voluta, e' una riga da togliere.
5. Cronologia: chiavi `occurred_date` (giorno localizzato) e `occurred_on` (ISO `Y-m-d` per `<time datetime>` nel blocco `timeline.blade.php`, ECC 2026-10-15).
6. Codice morto lasciato: nella ternaria `$pageTitle` di `index.blade.php` il ramo `ticket-detail` con `home.map.details` non e' piu' usato (il blocco lo sovrascrive); non l'ho tolto per toccare il minimo nel file contesto.

## Prove (comandi e output reali, 2026-10-13)
| Prova | Comando | Esito |
|---|---|---|
| TDD rosso | `pest-scratch-db.sh` sui 2 file nuovi prima del codice | `22 failed, 1 passed` (il passato e' il test dei 404, gia' vero prima) |
| Test verdi | stesso comando dopo il codice, con cache route attiva | `23 passed (227 assertions)` |
| Mutazioni (il test deve rompersi) | tolgo il filtro di visibilita' nell'Action / aggiungo `code` all'insieme esposto / tolgo l'escape della descrizione / tolgo `auth` dalla route / ignoro la visibilita' in Follow | M1 `2 failed` (404 e null), M2 `1 failed` (insieme di chiavi), M3 `1 failed` (escape), M4 `1 failed` (ospite verso il login), M5 `1 failed` (non pubblico). File ripristinati e confrontati con `cmp` |
| Vicini | + CitizenMyTicketsDetailLink, PersonalAreaPages, TicketPages, TicketListPage, FollowedTicketsPage, UnknownTwoSegmentPage, TicketTrackCodeRedirect, ListPublicTicketsAction | `3 failed, 101 passed`: i 3 rossi NON sono miei (vedi "Trovato fuori perimetro") |
| DB di sviluppo non scritto | `dbcount.sh` prima/dopo ogni run | utenti 11 e attivita' 0 invariati; i ticket sono saliti da 16 a 17 per un ticket "Buca di prova flusso coordinatore" creato da un altro agente alle 22:11 UTC (non dai miei test, che girano su DB scratch con `APP_CONFIG_CACHE=/nonexistent/config.php`) |
| PHPStan | `./vendor/bin/phpstan analyse <3 Action, routes/web.php, 2 test, 4 lang> --no-progress --error-format=raw` | exit 0, 0 errori |
| Sentinelle dopo `view:clear` e dopo `route:cache` e dopo ogni build | curl | `/it` 200, `/it/tickets` 200, `/it/tests/homepage` 200, `/it/tickets/confirmation` 200, `/it/tests/permessi-area-personale` 200, `/it/tickets/29` 200, `/it/tickets/create` 302; 7 asset linkati tutti 200 |
| curl ospite 4 lingue | `/{it,en,de,es}/tickets/29` | 200 in tutte; titolo, `h2` e pulsanti nella lingua (es. de: Wo, Beschreibung, Status der Meldung, Was Sie tun können, Zum Folgen anmelden) |
| 404 | `/it/tickets/{999999,abc,0,10,27,28}` | 404 (10, 27, 28 sono `pending`) |
| POST ospite senza token | `curl -X POST /it/tickets/29/follow` | 419 (CSRF attivo); con token verso il login e' provato in Pest |
| Playwright ospite 375/768/1440 | script in scratchpad su `192.168.1.40:8000/it/tickets/29` | scrollWidth = clientWidth in tutti; 1 `h1`; 4 `h2`; chip "In lavorazione"; `aria-current="page"` sul breadcrumb; mappa Leaflet con 1 marker, 0 trascinabili, tile caricati (6/12/15); tab stop nella mappa: solo "Aumenta zoom" e "Diminuisci zoom"; pulsanti 351x56, 175x56; 0 errori in console, 0 richieste fallite; link: Torna all'elenco -> `/it/tickets`, Segnala un altro problema -> `/it/auth/login` (da ospite `/it/tickets/create` e' 302), Accedi per seguire -> `/it/auth/login`, breadcrumb -> `/it/tickets` e `/it` |
| Playwright loggato (fixture isolata, porta 8093, DB usa-e-getta, poi `stop`) | `/it/tickets/1`, 12 segnalazioni pubbliche di prova + 2 cambi di stato pubblici e 1 interno | segui: messaggio "Ora segui questa segnalazione. Vai alle segnalazioni che segui" in `role="status"`, bottone diventa "Smetti di seguire"; `/it/area-personale/seguite` contiene la segnalazione; smetti: "Non segui più questa segnalazione."; en/de/es: messaggi nella lingua; 0 overflow a 375/768/1440; 0 errori in console; la cronologia mostra i 2 cambi pubblici e non la nota interna |
| axe-core | `a11y-page-probe.mjs` su `/{it,en,de,es}/tickets/29` e sulla pagina con cronologia; script axe loggato con messaggio di stato, 375 e 1440 | 0 violazioni (anche minor/moderate: `violations: []`) |
| Parity | `parity-sweep.sh <manifest> --jobs 1` con `BASE_REF=https://italia.github.io/design-comuni-pagine-statiche` | homepage pixel min 99.83, permessi-area-personale 99.59, index 99.78; altezze uguali in tutte e tre |

## Trovato fuori perimetro (non corretto)
1. `/it/tickets/track` NON ha piu' il limite di 10 richieste al minuto: 12 curl di fila = 12 risposte 200. Il limite sta in `Modules/Fixcity/resources/views/pages/tickets/track.blade.php` (`middleware('throttle:10,1')`) ma la rotta e' servita dal ramo `ticket-track` di `pages/[container0]/[slug0]/index.blade.php` (gia' presente in HEAD, senza throttle). Il test `FollowedTicketsPageTest` "limits public ticket tracking lookups to ten requests per minute" e' rosso (da solo e con la cache route bypassata). Il codice di tracciamento e' un capability token: senza limite si puo' tentare a forza bruta. Serve una decisione/owner (DCP-139/143 sicurezza?).
2. `TicketListPageTest` "searches text and explains an empty result" e `ListPublicTicketsActionTest` "searches title, description and address": la ricerca per `dalmazia` (indirizzo dentro `location`) non trova la segnalazione nel DB scratch. Non toccano i miei file (`ApplyPublicTicketFiltersAction` fermo dalle 17:41). Causa non investigata.

## Cosa NON ho potuto verificare
- Il recapito reale della notifica a chi segue (`NotifyTicketSubscribersOfStatusChangeAction` esiste e salta i ticket senza `code`; il testo "ricevi una notifica quando cambia stato" non e' provato a recapito).
- Touch vero su telefono: ho emulato i viewport in Chromium. Il pan a un dito dentro la mappa cattura lo scroll (follow-up 4 di DCP-93, in Geo, non toccato): mitigato con l'altezza 18rem, non risolto.
- Lettori di schermo reali; Firefox e Safari. I bottoni di zoom della mappa (Geo) sono piu' piccoli di 44 px: non e' mio.
- Dopo il login dell'ospite si torna alla home e non al dettaglio: il link "Accedi per seguire" va a `/{lang}/auth/login` senza `intended`.
- Il DB di sviluppo non ha attivita' pubbliche: la cronologia con dati e' provata in Pest e sulla fixture, non sulle `DCPDEMO-*`.

## Decisioni che servono all'utente
1. Civico e arrotondamento delle coordinate (PP-02 di DCP-104): oggi il dettaglio mostra lo stesso indirizzo dell'elenco e la mappa mette il marker sul punto esatto (gia' pubblico nel geojson).
2. Miniatura/foto: non mostrata (PP-03: foto originali con EXIF).
3. Mostrare o no la `reason` dell'operatore nella cronologia.
4. Dopo il login tornare alla segnalazione (serve impostare `url.intended`, ora si perde).
5. Se un cittadino proprietario puo' seguire la propria segnalazione ancora non pubblica (oggi si', come da policy `view`).

## Seguito DCP-152 (2026-10-14)
Il marker della mappa del dettaglio era nero con un `?` (stili del marker assenti nel picker, nessun tipo passato). Ora il blocco passa `marker-icon-url`, `marker-color`, `marker-label`; spec `tests/browser/ticket-detail-marker.spec.mjs`. Causa e fix: `Modules/Geo/docs/stories/dcp-152-marker-dettaglio-ticket-e-pulsanti-mappa-su-pagine-dc.story.md`.
