---
id: dcp-197
title: "DCP-197: esposizione per ambiente, repliche tests pubbliche, file di prova, sitemap, robots, host e pagine di errore"
type: story
epic: dc-parity-v2
status: open
priority: P0
owner: theme:Sixteen
created: 2026-10-15
updated: 2026-10-15
qmd: "repliche tests pubbliche noindex robots.txt sitemap trustHosts host header soft 404 pagina 404 due main pagine di errore favicon manifest security.txt public_html file di prova ambiente produzione"
related: [dcp-186, dcp-154, dcp-166, dcp-139, dcp-151]
tags: [docs, sixteen, bmad, go-live, sicurezza, front-office]
---

# DCP-197: cio' che e' pubblico e non dovrebbe esserlo

## Fase BMAD
Plan. Nata dall'audit [DCP-186](./dcp-186-front-office-scopo-e-senso-di-ogni-pagina-ed-elemento.story.md), gruppo E (orfani e repliche) e gruppo D (voce D8). Le correzioni che non richiedevano decisioni sono gia' fatte (E1 `info.php` rimosso, E4 percorsi a 4 segmenti a 404). Qui resta il resto.

## Scopo
Un sito pubblico deve rispondere solo di cio' che e' stato deciso di pubblicare. Le 84 repliche `tests.*` del riferimento Design Comuni servono alla parita' visiva in sviluppo, ma sono raggiungibili da chiunque, contengono dati finti (codici fiscali, email, «Il Comune di Firenze gestisce i dati personali», numero verde 05 0505, Lorem Ipsum) e il solo argine e' `robots.txt`, che non e' un controllo d'accesso.

## Cose da fare
Gia' fatto in DCP-186: E1 (`public_html/info.php` rimosso), E4 (`/it/a/b/c/d` risponde 404 invece di 500, test `UnknownFourSegmentPageTest`).

- [ ] **E2 / D8 repliche `tests`** (MISURATO, anche dal coordinatore: `/it/tests/consenso-privacy` risponde 200). Su 336 risposte (84 pagine x 4 lingue) nessuna ha `noindex` o `X-Robots-Tag`; canonical e hreflang puntano a se stesse; `robots.txt` distingue le maiuscole (`/IT/tests` risponde 200); il tenant `config/eu` ha le stesse pagine. Implementare il blocco per ambiente (decisione D197-1) e un test che fallisce se una replica risponde 200 con `APP_ENV=production`.
- [ ] **E3 soft 404:** URL inesistenti rispondono 200 con `<main>` vuoto, per esempio `/it/tests/x`, `/it/a/b/c`, `/it/api/tickets/list`. Cause: `pages/tests/[slug].blade.php:23` e `pages/[container0]/[slug0]/[container1]/index.blade.php:42`. Stesso criterio di DCP-126: `abort_if(..., 404)`. Test accanto a `UnknownTwoSegmentPageTest`.
- [ ] **E7 header `Host`:** `loc` della sitemap e canonical prendono l'host dalla richiesta. VERIFICATO dal coordinatore: con `Host: evil.example` la sitemap elenca `http://evil.example/it`. Configurare gli host fidati (`trustHosts` o `URL::forceRootUrl(config('app.url'))`) e testare.
- [ ] **E6 sitemap:** legge solo i JSON del CMS. Mancano `/segnalazioni`, `/lista-categorie`, `/services`, `/mappa-sito`, i ticket pubblici `/tickets/{id}`. `/domande-frequenti` c'e' solo per il vecchio `domande-frequenti.json` (che DCP-193 chiede di togliere). Decidere cosa elencare (D197-3) e generare da una sola sorgente.
- [ ] **E8 robots.txt:** manca la riga `Sitemap:`; il commento dice che la sitemap non esiste (ora esiste); 9 `Disallow` riguardano rotte che oggi rispondono 404; per `es` mancano `/es/api`, `/es/area-personale`, `/es/auth`; case-sensitive.
- [ ] **E9 / E10 pagine di errore:** la 404 ha due `<main id="main-container">`; 500, 403 e le 429 diverse da `tickets/track` usano la pagina grezza di Laravel (visto: 403 su `/api/log-download`). Estendere il gestore di `bootstrap/app.php` (DCP-151) a 500, 403 e a tutte le 429, a tema e nelle 4 lingue, senza dettagli tecnici in produzione.
- [ ] **E11:** `favicon.ico` e' vuoto (0 byte), nessuna pagina linka icona o manifest, le 8 icone del manifest rispondono 404, `sw.js` non e' registrato (e `offline.html` non e' raggiunto). Decidere se la PWA c'e' (D197-4); altrimenti togliere `manifest.json`, `sw.js`, `offline.html`.
- [ ] **E12 security.txt:** assente. Serve un contatto di sicurezza dell'ente (D197-5).
- [ ] **E15 `POST /livewire/form-create-ticket`** (`laravel/routes/web.php:29`): pubblico, senza auth ne' throttle, nessun client lo chiama. Da ospite risponde 422 e non crea ticket (24 prima e dopo, misurato dal gruppo C): non sfruttabile, ma e' una superficie senza scopo. Vedi [DCP-207](../../../../Modules/Fixcity/docs/stories/dcp-207-superfici-morte-e-residui-di-sicurezza-del-front-office.story.md).
- [ ] **E13 / E14:** chiavi di traduzione grezze nel breadcrumb di `/it/segnalazioni` (`/it/services` e' gia' stata corretta da un'altra sessione, da rimisurare) e meta description con numero fisso («risolte 73 segnalazioni», `pages/[container0]/index.blade.php:57`): calcolarla dai dati o toglierla.
- [ ] **E16-E19 igiene:** 15 rotte dei moduli sono «spente» solo perche' la catch-all del tema le precede (DEDOTTO); `segnalazione-dettaglio.json`, 5 file `tests.*` nel modulo e `config/eu/fixcity/.../1.json` (stesso slug `home` di `home.json`) sono JSON orfani o in conflitto; in en 77 repliche su 84 hanno `<main>` vuoto, in de ed es il testo e' italiano sotto un `lang` sbagliato.
- [ ] **Contratto Folio rosso (coordinamento):** `FolioPageMountContractTest > container0 index usa mount lineare...` fallisce perche' `pages/[container0]/index.blade.php` (modificato il 2026-10-14 alle 21:29 da un'altra sessione) contiene `pageTitle`. Riallineare file e contratto, chi ha modificato il file.

## Decisioni da prendere
| ID | Domanda | Opzioni | Raccomandazione | Chi decide | Blocca |
|---|---|---|---|---|---|
| D197-1 | Cosa succede alle 84 repliche `tests` in produzione? | (a) 404 fuori da `local`/`staging`; (b) restano ma con login e `noindex`; (c) restano pubbliche | (a): sono strumenti di sviluppo, non contenuto del servizio. Implementazione a livello di rotta o middleware per ambiente, non di singolo JSON | prodotto, con lo sviluppo | go-live |
| D197-2 | Il gate di messa online (DCP-154) controlla anche l'esposizione? | si' / no | si': aggiungere un controllo «nessuna replica risponde 200, `info.php` e file di prova assenti, `robots.txt` con `Sitemap:`» a `go-live-gate.py` | sviluppo | DCP-154 |
| D197-3 | Cosa va nella sitemap? | solo pagine istituzionali / anche i ticket pubblici | solo pagine istituzionali e FAQ; i ticket pubblici no, perche' contengono testo libero del cittadino (decide il titolare, vedi DCP-190 D190-5) | titolare, prodotto | E6 |
| D197-4 | La PWA (manifest, service worker, offline) c'e' o no? | togliere tutto / completare (icone, registrazione, test offline) | togliere finche' non c'e' un requisito: oggi e' codice morto e 8 404 | prodotto | E11 |
| D197-5 | Contatto di `security.txt` e politica di segnalazione | indirizzo dell'ente / indirizzo del fornitore | l'indirizzo dell'ente (titolare del sito), concordato col fornitore | ente, titolare | E12 |
| D197-6 | Host fidati in produzione | elenco fisso in config / `APP_URL` | `APP_URL` come unica sorgente, host sconosciuti a 400 | sviluppo e fornitore | E7 |

## Criteri di accettazione
- [ ] Con `APP_ENV=production` nessuna replica `tests.*` risponde 200 (test).
- [ ] Con `Host: evil.example` sitemap e canonical contengono solo l'host configurato (test).
- [ ] Nessun URL inesistente risponde 200 con `<main>` vuoto (test per `tests/<x>`, `/a/b/c`, `/api/...`).
- [ ] `robots.txt` con `Sitemap:`, senza regole su rotte inesistenti.
- [ ] Pagine 404, 403, 429 e 500 a tema e in 4 lingue, un solo `<main>`.
- [ ] `go-live-gate.py` include i controlli di esposizione e fallisce se ne manca uno.

## Owned File/Module Scope
- `laravel/bootstrap/app.php` (gestori degli errori, host fidati)
- `public_html/robots.txt`
- `laravel/Themes/Sixteen/resources/views/pages/**` (soft 404, repliche `tests`)
- `laravel/Modules/Fixcity/app/Actions/**` (sitemap)
- `bashscripts/tools/release/go-live-gate.py` (controlli di esposizione)
Non toccare: `pages/[container0]/index.blade.php` finche' chi l'ha modificato non riallinea `FolioPageMountContractTest`.

## Non verificato
Comportamento in produzione (route cache, tenant `eu` mai attivato, risposta di Apache a file `.php` in `public_html`, 500 senza debug); pagina 429 reale (il corpo non e' stato salvato); indicizzazione reale (nessun dato dei motori di ricerca).
