---
id: dcp-186
title: "DCP-186: front office, ogni pagina e ogni elemento ha uno scopo, una funzione e una politica (scheda per pagina)"
type: story
epic: dc-parity-v2
status: done
priority: P1
owner: theme:Sixteen
created: 2026-10-14
updated: 2026-10-14
qmd: "front office scheda per pagina scopo funzione politica senso orfani repliche tests link morti placeholder audit swarm sola lettura"
related: [dcp-112, dcp-154, dcp-131, dcp-130, dcp-137, dcp-180]
tags: [docs, sixteen, bmad, front-office, audit]
---

# DCP-186: il front office ha senso, pagina per pagina

## Fase BMAD
Analyze. Sola lettura: **nessun file di codice o di contenuto viene modificato dall'audit**. L'esito e' una scheda per pagina e un elenco di decisioni; le correzioni seguono in story proprie, dopo aver scelto.

## Richiesta
Utente, 2026-10-14: «controlla in tutto il front office che tutto abbia senso, che tutto abbia un suo scopo, una sua funzionalita', una sua politica, una sua filosofia». Con BMAD, second brain, ponytail, Filament Blueprint.

## Domanda "perche'?" prima di cominciare
Lo scopo del progetto e le norme sono gia' scritti ([scopo](../../../../../Modules/Fixcity/docs/compliance/00-scopo-del-progetto.md), [matrice normativa](../../../../../Modules/Fixcity/docs/compliance/01-matrice-conformita-normativa.md), [matrice di interfaccia I-01..I-27](../../compliance/01-matrice-conformita-interfaccia.md)). Manca la scheda inversa: per ogni pagina e ogni elemento, **a chi serve, cosa fa davvero (misurato), con quale politica, e se qualcosa in essa non ha ragione di stare li'**. Un elemento senza scopo e' un debito: un link che porta a 404, un testo segnaposto, una pagina di prova pubblica, due pagine che dicono la stessa cosa.

## Perimetro e metodo
Inventario di partenza (misurato 2026-10-14): la sitemap dichiara 10 pagine x 4 lingue (home, accessibilita, cookie-policy, domande-frequenti, media-policy, note-legali, privacy, terms, tickets, tickets/track); i JSON di pagina reali sono 18; esistono **83** `tests.*` (repliche del riferimento Design Comuni usate per la parity); le pagine con login sono `tickets/create` e l'area personale.
Cinque gruppi disgiunti, ordine di avvio estratto con `shuf` e registrato qui sotto; ogni gruppo e' un agente in sola lettura che misura con `curl` e con browser vero e scrive nella propria sezione di questo file solo dopo la consegna al coordinatore.

| Ordine | Gruppo | Ambito |
|---|---|---|
| 1 | B | lettura pubblica dei ticket: elenco e mappa, dettaglio, segui, tracciamento, conferma |
| 2 | D | pagine legali e informative: privacy, termini, note legali, cookie, media policy, accessibilita', FAQ |
| 3 | A | struttura comune: header, footer, menu, lingue, breadcrumb, cookiebar, ricerca |
| 4 | E | orfani e repliche: `tests.*`, pagine non in sitemap, rotte di front office senza pagina, 404/429, robots, sitemap |
| 5 | C | cittadino e identita': login, registrazione, recupero password, wizard di segnalazione, area personale |

## Criteri di una riga della scheda
Scopo (a chi serve e perche'), Funzione (misurata: stato HTTP, comportamento reale), Politica (accesso, limite di richieste, trattamento dei dati, testo legale e chi lo possiede), Coerenza (contraddice un'altra pagina? testo segnaposto? duplicato?), Verdetto: **tenere** / **correggere** / **togliere** / **decidere** (con chi deve decidere), e la prova.

## Esito (2026-10-14, 20:18)
Scheda per pagina: [`03-front-office-scheda-per-pagina.md`](../../compliance/03-front-office-scheda-per-pagina.md): sintesi, cinque gruppi (A struttura comune, B ticket pubblici, C cittadino, D pagine legali, E orfani e repliche), 85 voci segnalate dagli agenti, **12 riverificate dal coordinatore e tutte confermate** (una con la causa corretta: il pulsante «Cerca» invisibile non e' una classe mancante ma un reset senza layer che batte la utility).

**Corretti nello stesso giro, ciascuno con test rosso prima e verde dopo:** link della FAQ a 404 (D6), registrazione e recupero password irraggiungibili dal login (C1), recupero password in HTTP 500 per la connessione `liveuser_general` inesistente (C2), HTTP 500 sui percorsi a quattro segmenti (E4), `public_html/info.php` con `phpinfo()` tracciato in git (E1, rimosso).

**Aperti per lo sviluppo, in ordine:** B1 pulsante «Cerca» di `/tickets/track` (serve un build, da decidere con DCP-183), A4 modale di ricerca non cliccabile e A3 ricerca senza funzione, E2 repliche `tests` pubbliche senza controllo per ambiente, widget a stelle che non salva (B3/C8), «Accedi per seguire» che perde la destinazione (B10), assenza di limiti su `/tickets` e `/api/tickets/geojson` (B19), menu e footer morti (A1/A2/A5/A7), `email_verified_at` impostato senza verifica (C3), policy password 12 contro 8 (C6), Host nella sitemap (E7). **Non sono difetti di codice:** testi e dati dell'ente, base giuridica e consensi (titolare, DPO, legale), scelte di prodotto: tabella nella scheda.

**Proposte di story separate** (non aperte, una per ambito, cosi' ogni sessione prende un file): (1) CSS: reset `button` senza layer e build, (2) ricerca interna (A3, A4, DCP-166), (3) esposizione per ambiente: repliche, file di prova, `trustHosts`, noindex, (4) widget a stelle e destinazione dopo il login, (5) registrazione: verifica email, password, consensi (con il DPO).

**Non verificato:** produzione, invio reale di email e foto, EXIF, lettori di schermo, flussi che richiedono un login reale oltre la fixture.

**Coordinamento:** `[container0]/index.blade.php` (modificato dalla sessione che sistema `/it/segnalazioni`, 21:29) contiene ora `pageTitle` e fa fallire `FolioPageMountContractTest > container0 index usa mount lineare...`: contratto e file vanno riallineati da chi lo sta modificando.

**Aggiornamento 2026-10-22:** audit UI/UX con Playwright (chrome comune, accesso, contenuti, ticket pubblici: 73 finding) in [`../../compliance/04-audit-ui-ux-design-comuni.md`](../../compliance/04-audit-ui-ux-design-comuni.md). Corretto: chip categoria con `Str::upper`. Aperto, in ordine di peso: gravatar nei commenti, pagine `services`/`categories`/`sitemap` senza stile, skip-link e modale della home, selettore lingua senza focus.

## Dati misurati dalla sessione DCP-179/181/182 (2026-10-14, 19:45), da usare nelle schede
Non e' un secondo audit: e' un crawl da ospite, senza JavaScript, di `/it` a profondita' 2 (29 pagine, 89 altri link interni controllati con GET). Script riusabile: `crawl.py` nello scratchpad di quella sessione; i numeri sono ripetibili con `curl`.
- **Menu comune, 29 pagine su 29:** 7 link senza prefisso lingua danno 404: `/amministrazione` («Amministrazione»), `/argomenti` («Tutti gli argomenti»), `/argomenti/iscrizioni`, `/argomenti/estate-in-citta`, `/argomenti/polizia-locale`, `/eventi` («Vivere il Comune»), `/novita`, `/regione` («Nome della Regione»), `/servizi`. I testi sono quelli del template Design Comuni («Nome del Comune», «Il mio Comune. Un comune da vivere»). Visibilita' a schermo non misurata (serve browser): gruppo A.
- **Link rotti con prefisso lingua:** `/it/news` (16 pagine lo linkano), `/it/services/report-issue` (17), `/it/administration` (1); le stesse due pagine rotte esistono anche in en/de/es.
- **`/it/services` perde le chiavi di traduzione:** il testo contiene `pub_theme::footer.home` e `pub_theme::services.title` (il titolo `h1` e' «Servizi per la città» ma l'etichetta del link home no).
- **Home:** 8 servizi con `href="#"` che il progetto non eroga («Cambio di residenza», «Prenotazione appuntamenti», «Rilascio CIE», «Rilascio tessera elettorale», «Tributi online», «Voucher connettività»). Scopo del blocco da decidere (gruppo A/E).
- **Social e RSS:** `https://facebook.com`, `https://twitter.com`, `https://youtube.com`, `https://telegram.org`, `https://wa.me` e `RSS` con `#`: indirizzi generici, non i canali del Comune. Se il Comune non ha canali: toglierli.
- **Ricerca:** ogni pagina contiene un `<form>` senza `action` (`method=get`); la ricerca interna e' ancora quella di DCP-166 (non fatta).
- **Titoli identici:** `/tickets/create` e `/area-personale/pratiche` rispondono con il titolo «Accedi a FixCity» perche' reindirizzano al login da ospite (comportamento atteso, D17); `/it/tickets` e `/it/tickets?view=list` hanno lo stesso titolo (stessa pagina, due URL: canonical non misurato).
- **Bene:** 0 pagine senza `h1` o con `h1` multiplo; 0 immagini senza `alt`; `lang="it"` ovunque; nessun `noindex` nelle pagine pubbliche (le vetrine sono escluse da `robots.txt`, non dalle pagine); `/it/tickets/create` da ospite va al login, `/it/area-personale/*` idem.

## Dati misurati dalla sessione PHPStan/MCP (Claude Sonnet 5.5, 2026-10-14, 19:50): rotte pubbliche da ospite (per il gruppo E)
Non e' un secondo audit. Crawl delle **43 rotte Folio in italiano** (`php artisan folio:list --json`, parametri di esempio) con `curl` da ospite su `https://192.168.1.40:8080`: **17 x 200, 5 x 302 al login, 20 x 404, 1 x 500**. Fatti verificati:
1. **Le "API" con prefisso lingua rispondono HTML.** `/it/api/tickets/geojson` e `/it/api/tickets/list` danno 200 `text/html` (layout da 85 KB); la stessa rotta senza lingua `/api/tickets/geojson` da `application/json` (11 feature). Con il prefisso la Folio dell'API e' oscurata dal catch-all `[container0]/[slug0]/[container1]`. **Da verificare:** quale forma usano i consumatori (blocchi Sixteen e `Geo/resources/js/components/map/popup-ticket.js` citano `api/tickets/*`).
2. **404 da ospite su pagine Folio registrate:** `/it/dashboard`, `/it/learn`, `/it/genesis/about`, `/it/genesis/power-ups`, `/it/notifications`, `/it/pages`, `/it/mobile`, `/it/mobile/map`, `/it/profile/edit`, `/it/home`, `/it/prova`, `/it/errors/password-expired`, `/it/auth/verify`, `/it/area-personale/servizi`. `dashboard` e `learn` dichiarano `middleware(['auth','verified'])` ma rispondono 404, non 302: **non verificato** se e' la guardia o il catch-all (da provare da loggato con `scratch-auth-fixture.sh`). `learn/index` scarica a runtime `raw.githubusercontent.com/thedevdojo/genesis/.../README.md` (`Http::get` nel `mount`): e' pagina del kit di partenza "Genesis", non del prodotto. `prova.blade.php` e' una pagina di prova (`middleware(['guest'])`, importa componenti Cms).
3. **500 su URL inventato:** `/it/servizi/x/y/x` -> `Livewire\Exceptions\RootTagMissing`, corpo da 1,1 MB (debug attivo). Un indirizzo che non esiste deve dare 404.
4. **Le repliche sono pubbliche:** `/it/tests` e `/it/tests/x` rispondono 200 a chiunque. Decisione da prendere (non mia): chiuderle fuori dallo sviluppo?
5. **File morti accanto alle pagine vive** (7): `Themes/Sixteen/.../pages/[container0]/[slug].blade.php.old`, `pages/index.blade.php.old`; `Fixcity/.../tickets/[slug].blade.php.old`, `tickets/[ticket].blade.php.old`; `User/.../about.blade.php.no`, `pages/index.blade.php.no`, `area-personale/pratiche.blade.php.lock`; piu' la cartella `Themes/Sixteen/resources/views/pages_old/`. Nessuno e' una rotta: sono storico. Git li conserva.

### Claim: corsia "correzioni oggettive" (stessa sessione, dopo la misura)
Prendo solo cio' che non richiede una scelta di prodotto: chiavi di traduzione grezze nel testo visibile (misura 4 lingue in corso), il 500 del punto 3, e verifico il punto 1 prima di toccare qualunque cosa. **Non tocco** i gruppi A-E, i link a servizi che il Comune deve decidere se erogare, ne' i file dei punti 2, 4, 5 senza una decisione scritta qui.

## Avanzamento (2026-10-14, 20:00)
| Gruppo | Stato | Dove |
|---|---|---|
| D legali e informative | **consegnato**, 14 difetti, 4 ri-misurati dal coordinatore | [scheda, sezione D](../../compliance/03-front-office-scheda-per-pagina.md) |
| B, A, E, C | in corso | |

**Corretto subito (competenza dello sviluppo, nessuna decisione di prodotto):** D6, il link della FAQ «Apri il servizio di segnalazione» andava a `/{lang}/services/report-issue` (404 in 4 lingue) e il test del browser controllava solo l'attributo `href`. Ora punta a `/tickets/create`, come il footer. Prova: `Modules/Fixcity/tests/Feature/Pages/FaqLinksResolveTest.php` (4 lingue), rosso prima (`risponde 404`), verde dopo; con `FooterLinksResolveTest` e `PublicPagesStructureTest` 28 test verdi; PHPStan e Pint puliti; sul sito vivo il link e' servito in it, en, de, es. Aggiornato `tests/browser/design-comuni-utility-pages.spec.mjs:29`.

**Lasciato apposta, con motivo:** D7 (`domande-frequenti.json` orfano con affermazioni false, 3 copie tracciate piu' una da 14 KB in `Modules/Fixcity/resources/json/`): lo slug ha molti riferimenti legittimi e i JSON di pagina sono in modifica da piu' sessioni; non si cancella senza sapere chi lo carica. **Non e' una scelta mia:** D1-D5, D13, D14 sono testi o basi giuridiche (ente, titolare, DPO, legale).


### Esito della corsia "correzioni oggettive" (sessione PHPStan/MCP, 2026-10-14, 20:0x)
Tutto misurato; ogni riga ha il comando o il test che la prova. **Correzione di una mia affermazione:** avevo scritto che il difetto dell'API stava nel «carica altre» di `/it/tickets`. Era un'assunzione: quel blocco non e' su `/it/tickets` (0 occorrenze di `segnalazioni-elenco-root`), e' montato dal catch-all `[container0]/index.blade.php` su **`/it/segnalazioni`**. Misurato li' dopo la correzione.

| # | Difetto (prova) | Causa alla sorgente | Correzione | Verifica |
|---|---|---|---|---|
| 1 | `/it/api/tickets/list` risponde 200 `text/html`; il «carica altre» di `/it/segnalazioni` fa `response.json()`, fallisce e il pulsante sparisce in silenzio (`catch -> hasMore=false`) | `segnalazioni/layout.blade.php` localizzava l'URL dell'API; con il prefisso la Folio e' oscurata dal catch-all. Gli altri 7 consumatori usano gia' `/api/tickets/*` senza lingua | `$listApiUrl = '/api/tickets/list'` (1 riga) | `/it/segnalazioni` 200, `listUrl: '/api/tickets/list'`, `/api/tickets/list` -> `application/json`. Guardia nuova `Themes/Sixteen/tests/Unit/ApiUrlsAreNotLocalizedTest.php`: rossa prima (1 colpevole), verde dopo, rossa su una vista sbagliata di prova |
| 2 | `/{it,en,de,es}/auth/password/reset` mostra `user::auth.forgot-password.{title,subtitle,back_to_login,submit}` | la vista del widget usa il gruppo `forgot-password` (trattino); i file lingua avevano `forgot_password` (underscore, altra forma) o niente (en, es) | gruppo `forgot-password` con 4 stringhe in `Modules/User/lang/{it,en,de,es}/auth.php` (it/de riusano le frasi gia' presenti; en/es nuove) | guardiano sotto; `php -l` ok; 4 chiavi risolte in 4 lingue |
| 3 | `/{lang}/services` mostra `pub_theme::footer.home` e `pub_theme::services.title` | le chiavi non esistono (`footer.php` non ha `home`; `services.php` ha `meta.*`/`hero.*`, non `title`) | `navigation.home` (esiste in 4 lingue) e `services.meta.breadcrumb` (idem) | guardiano sotto |
| 4 | `/{lang}/segnalazioni` mostra `pub_theme::footer.home`; il `<nav>` breadcrumb ha `aria-label="Home"` | stessa chiave inesistente; l'etichetta del breadcrumb era quella della home | `navigation.home` per la voce, `fixcity::global.breadcrumb` per l'`aria-label` | `curl` 4 lingue: chiave assente, `aria-label` = «Percorso di navigazione»/«Breadcrumb»/«Navigationspfad»/«Ruta de navegación» |

**Guardiano:** `Modules/Fixcity/tests/Feature/Pages/PublicPagesStructureTest.php` (DCP-153, gia' render-based in 4 lingue) esteso con `/auth/password/reset` e `/services`. Rosso prima su tutte e 4 le lingue (e' il test che ha trovato anche `/segnalazioni`), **verde dopo: 4 passati**. Eseguito con `pest-scratch-db.sh` e il bypass `DB_DATABASE_LIMESURVEY= APP_CONFIG_CACHE=/nonexistent/config.php`. `PHPStan` `[OK]` sui 6 file PHP toccati.

**Lasciato fuori di proposito (decisioni, non mie):**
- `/segnalazioni` **non** e' nell'elenco della guardia: ha lo stesso `<title>` «Elenco segnalazioni» di `/tickets` (solo `it`) e la guardia fallirebbe sulla regola dei titoli unici. Ha uno scopo (la usa `search-modal.blade.php`, non e' nella sitemap). Serve scegliere: titolo distinto, o una sola pagina di elenco.
- Misura statica di `__('pub_theme::...')` letterali nelle 918 viste: 222 usi, **38 chiavi con problemi**, rumore incluso (prefissi dinamici, array voluti). Veri candidati ancora aperti: file lingua assenti per `social.*`, `notifications.close` (it/en/de/es) e `segnalazione.*` (de, es: oggi ripiegano in silenzio sull'italiano); chiavi `accessibility.*` (barra accessibilita'), `home.list.*` (quick-actions), `accessibility.close` assenti in tutte e 4. **Non so se quelle viste sono montate**: prima si misura il rendering (il guardiano non le copre), poi si corregge o si cancella il codice morto.
- Il guardiano legge il testo visibile di `<main>`: **non vede gli attributi** (`aria-label`, `title`, `placeholder`, `alt`). Una chiave grezza in un `aria-label` e' letta dallo screen reader e il test non la trova. Da misurare.

### Non verificato in questo giro
Il test `BladeTemplatesCompileTest` non ha stampato esito nel mio run: non lo conto come prova. La compilazione dei 3 file Blade modificati e' provata dal rendering reale (HTTP 200 e contenuto atteso in 4 lingue).

### Correzione alla misura precedente (sessione DCP-179/181/182, 2026-10-14, 20:15)
Il punto «`/it/services` perde le chiavi di traduzione» **non e' piu' riproducibile**: rifatto il GET alle 20:14, fuori dagli `<script>` ci sono 0 occorrenze di `pub_theme::` e il link home dice «Home». Il crawl di 2:34 minuti l'aveva letto durante le modifiche di un'altra sessione ai file `lang` del tema (non provato quale). **Non e' un difetto aperto**: non lavorarci. Gli altri punti della sezione sopra (menu con 7 rotte 404 senza prefisso lingua, `/it/news` e `/it/services/report-issue` 404, 8 servizi con `href="#"`, social generici) li ho ricontrollati con `curl` sugli URL singoli e restano veri.
