---
title: Giro del front office da ospite, coerenza con Design Comuni
type: audit
created: 2026-10-27
status: completato, sola lettura, nessuna modifica al codice
---

# Giro del front office da ospite

Audit in sola lettura del FO FixCity percorso da utente non loggato, in italiano, a 1280px e a 375px, con Playwright MCP su `http://192.168.1.40:8000` (dev). Riferimento: Design Comuni (`https://italia.github.io/design-comuni-pagine-statiche/sito/`) e, per la gerarchia visiva, produzione `https://fixcity.eu/it`.

Convenzioni: ora in UTC, misure fatte il 2026-10-27 tra le 06:58 e le 07:50. Il debugbar (circa 33px in fondo) e le chiamate `/_boost/browser-logs` sono ignorati. Screenshot in `/tmp/claude-1000/-mnt-nas07-var-www--bases-base-fixcity-fila5/29a166b2-0272-41ac-a703-feea7fe8f6bd/scratchpad/shots-guest/` (nel testo sono citati solo con il nome del file). Altre sessioni modificavano il codice durante il giro: dove una pagina e' cambiata tra due misure e' indicato.

Gradi di evidenza: A = misurato e riprodotto (o visto in screenshot e misurato); B = osservato una volta o dedotto da codice e confronto; C = ipotesi.

## a) Copertura

| # | Percorso | Eseguito | Note |
|---|----------|----------|------|
| 1 | Home `/it` | si | 1280 e 375, 5 slice, confronto con produzione |
| 2 | `/it/tickets` lista, dettaglio 129 e 554, CTA ospite | si | filtri, paginazione (25 pagine), tab Mappa/Elenco |
| 3 | Blog e articolo, Eventi e evento | si | tutte e 4 le pagine, confronto con novita.html ed evento |
| 4 | Crea segnalazione da ospite | si | `/it/tickets/create` -> 302 `/it/auth/login` senza `?redirect` |
| 5 | Auth: login, registrazione, password dimenticata, errori, focus, tab | si | nessun login completato, Google solo fino al redirect |
| 6 | Pagine legali (privacy, note-legali, terms, media-policy, cookie-policy, accessibilita) | si | anche in en, de, es per privacy |
| 7 | Footer e header, ogni link | si | stato HTTP di tutti i link interni, nessun `href="#"` |
| 8 | Cambio lingua it, en, de, es | si | via URL diretti su home, tickets, login, privacy; 12 URL, tutti 200 |
| 9 | Banner cookie su profilo pulito | si | 1280 e 375 |
| 10 | 404 (`/it/pagina-che-non-esiste`, `/it/tickets/99999999`) | si | entrambe sul tema, HTTP 404 |
| 11 | Tastiera: Tab su home e login, Esc sul menu mobile | si | Tab verificato anche su registrazione |

Copertura: 11 percorsi su 11. Pagine aggiuntive viste: track, faq, lista-categorie, mappa-sito, ricerca, domande-frequenti, reset password, registrazione.

## b) Difetti

Ordinati per gravita e poi per ID. Percorsi dei proprietari relativi a `laravel/`.

### b1) Bloccanti e maggiori

| ID | Gravita | URL | Viewport | Cosa | Evidenza | Confronto Design Comuni | Proprietario probabile | Grado |
|----|---------|-----|----------|------|----------|-------------------------|------------------------|-------|
| D-PLACEHOLDER | bloccante | `/it/privacy`, `/it/note-legali` (anche en, de, es) | 1280, 375 | Placeholder grezzi visibili: privacy 5 (`[[ente.name]]`, `[[ente.address]]`, `[[ente.pec]]`, `[[ente.dpo_name]]`, `[[ente.dpo_email]]`), note legali 6 (`[[ente.name]]`, `[[ente.address]]`, `[[ente.tax_code]]`, `[[ente.pec]]`, `[[ente.email]]`, `[[ente.pec]]`). Le due pagine hanno anche il box "TESTO NON ANCORA COMPLETO". Ancora presenti alle 07:48. | privacy-1280-*.png, token `[[` rilevato dall'helper | Le pagine legali DC non hanno token non risolti; titolare, DPO e PEC sono dati obbligatori | `config/local/fixcity/lang/{it,en,de,es}/policy.md`, `legal-notes.md`, config ente del tenant | A |
| D-ACCESS | bloccante | `/it/accessibilita` | 1280, 375 | Dichiarazione "NON ANCORA COMPLETA" con testo da sviluppatore ("valore non valido" x4, "nella chiave name del file ente.php del tenant", "campo officer") e "si applica al sito web http://192.168.1.40:8000" (host dev). Produzione ha l'avviso ma non l'host dev. | accessibilita-1280-*.png | La dichiarazione di accessibilita AgID e' obbligatoria e deve citare sito e responsabile reali | `config/local/fixcity/database/content/pages/accessibilita.index.json` e config ente | A |
| D-LINE | maggiore (transitorio) | 13 pagine CMS: `/it/tickets`, `/blog`, `/events`, `/privacy`, `/note-legali`, `/terms`, `/media-policy`, `/cookie-policy`, `/accessibilita`, `/domande-frequenti`, `/lista-categorie`, `/mappa-sito`, `/ricerca` (it, en, de, es) | 1280, 375 | Il testo `\|---LINE:69---\|` appare sotto l'header e `\|---LINE:71---\|` sopra il footer. Visto dalle 07:06 alle 07:32; NON riproducibile alle 07:47 dopo che un'altra sessione ha ricompilato le viste (07:45). Non presente in produzione. | Vedi nota sotto | Nessun equivalente in DC | `Themes/Sixteen/resources/views/pages/[container0]/index.blade.php` (blocco `@volt('container0.index')`), viste compilate in `storage/framework/views` | A come osservazione, C come causa |
| D-HEADER | maggiore | `/it/blog/{slug}`, `/it/events/{slug}` | 1280 | Le pagine di dettaglio non hanno il wrapper `.page-content[data-dc]`, quindi header e footer cambiano aspetto: nav-link a x=12 invece di 30, sottolineato, `display:block` invece di `flex`, font navbar 18px invece di 16px, slim bar in grassetto, ricerca piu grande; footer con titoli 18px e x=12 invece di 64. Misurato alle 07:48. | Misure `hdr` dell'helper, article-1280-*.png, event-1280-*.png | In DC header e footer sono identici in ogni pagina | CSS `body:has(.page-content[data-dc]) ...` in `Themes/Sixteen/resources/css/app/*` (bundle `app-B4jD5-HK.css`); `Modules/Blog/resources/views/pages/blog/[slug].blade.php` e `events/[slug].blade.php` senza wrapper | A |
| D-COOKIETABLE | maggiore | `/it/cookie-policy` | 375, 1280 | Tabella dei cookie larga 709px; `.table-responsive` ha `overflow-x: visible` (calcolato). A 375 la tabella va da x=12 a x=721 in un contenitore di 351px: le colonne Finalita, Durata, Tipo sono fuori schermo e non raggiungibili. A 1280 la colonna "Cookie" e' 513px e "Finalita" 85px (testo su 4-5 righe); nome lungo `remember_web_59ba36...`. | cookie-policy-1280-*.png, m-cookie-policy (metriche) | DC: tabelle con `table-responsive` funzionante (scroll orizzontale) | `config/local/fixcity/database/content/pages/cookie-policy.index.json`; CSS `.table-responsive` mancante nel tema | A |
| D-SPINNER | maggiore | `/it/auth/login`, `/it/auth/register` | 1280 | Durante l'invio Livewire (circa 3,3s su dev) compare nel form un `svg.fi-loading-indicator` di 408x408px (385x385 in registrazione) piu un secondo svg 102x102 (125x125) con `animate-spin`. Riprodotto 3 volte su login, 2 su registrazione, con ritardo forzato di 3s alle 07:49. Su reset password non rilevato (timing). | register-spinner-1280.png; misura: login `fi-loading-indicator 408x408` e `102x102`, bottone "Accesso in corso..." | In DC lo stato di caricamento e' un `progress-spinner` piccolo dentro il bottone | `Themes/Sixteen/resources/views/filament/widgets/auth/*.blade.php`; CSS Filament non caricato per `.fi-icon` | A |
| D-HOMEGRID | maggiore | `/it` | 1280 | Griglia Novita: 3 card da 392px con gap 24 in un contenitore da 1176px; la terza card va a capo sulla seconda riga (top 2211 vs 2752) e lascia vuoto il terzo destro. Card a x=52 e x=468. | home-1280-3.png, home-1280-4.png | DC novita/home: 3 card su una riga a 1280 | `Themes/Sixteen/resources/views/components/blocks/home/news.blade.php`, `css/app/16-homepage-civic-reframe.css` (`.fc-home-news__grid`) | A |
| D-GRAV | maggiore | `/it/tickets/129`, `/it/tickets/554`, `/it/blog/{slug}`, `/it/events/{slug}` | 1280 | Gli avatar dei commenti puntano a `https://www.gravatar.com/avatar/<md5 dell'email>?d=mp`, bloccati dalla CSP (`img-src 'self' data: blob: https://*.tile.openstreetmap.org`): violazioni in console (livello INFO). L'HTML per l'ospite espone gli hash md5 delle email di chi commenta; si vedono anche nomi reali di chi commenta. | Log console `/tmp/playwright-mcp/console-2026-10-27T06-58-12-807Z.log` | In DC i commenti non espongono dati personali all'ospite | Componente commenti (blocks `tickets/detail`, `blog/detail`, `events/detail`), CSP in `config`/middleware | A per la CSP, B per l'impatto privacy |

Nota su D-LINE: il difetto e' stato visto dall'inizio del giro fino alle 07:32 su tutte le 13 pagine, a 1280 e 375, in 4 lingue. Alle 07:47 le stesse pagine erano pulite. Le viste compilate `3e5da251912e1dd0ae7ea0bf8bd00f2c.blade.php` e `d086feaaebd9af068364b5ded3ae8e0b.php` contenevano `|---LINE:68/69/71---|` nel blocco volt. Ipotesi (grado C): il precompilatore dei wire-key di Livewire 4.4.8 inserisce il marcatore dentro `@volt` e le viste compilate vecchie lo conservano. Se la cache viste viene svuotata sul server di rilascio il difetto potrebbe ricomparire: va aggiunto un test di regressione che cerchi `|---LINE` nell'HTML.

### b2) Minori e di coerenza

| ID | Gravita | URL | Viewport | Cosa | Evidenza | Confronto Design Comuni | Proprietario probabile | Grado |
|----|---------|-----|----------|------|----------|-------------------------|------------------------|-------|
| D-H1ART | maggiore | `/it/blog/{slug}` | 1280 | h1 dell'articolo a 24px (classe `h2`); mancano inoltre blocchi DC di dettaglio: Dettagli, Argomenti, Data e tempo di lettura. | article-1280-1.png; `blocks/blog/detail.blade.php:56` | DC articolo e dettaglio: h1 48px; l'h1 del dettaglio evento FixCity e' 48px (coerente) | `Themes/Sixteen/resources/views/components/blocks/blog/detail.blade.php` | A |
| D-FOOTER | minore | tutte | 1280, 375 | La fascia scura `.it-footer-main` finisce a y=3496 e il copyright (testo scuro su trasparente) sta subito sotto su bianco; circa 298px (1280) e 143px (375) di spazio scuro vuoto sotto l'ultimo link; il secondo gruppo di link di ogni colonna non ha titolo (vuoto); "Mappa del sito" duplicata (colonna 2 e riga in basso); "Cookie policy" e "Gestisci cookie" puntano entrambi a `/it/cookie-policy` (il secondo apre il dialogo via JS, funziona); manca blocco Contatti/ente (DC e produzione lo hanno); `/it/terms` non e' linkata da footer o mappa del sito, solo dalla registrazione. | home-1280-5.png, m-home-375-*.png | DC footer: titoli per ogni gruppo, blocco contatti ente | `Themes/Sixteen/resources/views/components/*footer*` e config footer | A per striscia e spazio, B per il resto |
| D-LOGINREDIRECT | maggiore | header "Segnala", hero "Invia una segnalazione", footer "Segnalazione disservizio", "Segnala un altro problema" | 1280, 375 | `/it/tickets/create` -> 302 `/it/auth/login` SENZA `?redirect` (Location: `http://192.168.1.40:8000/it/auth/login`, circa 6,8s su dev). I link "Accedi per commentare/seguire" invece usano `?redirect=%2Fit%2Ftickets%2F129`. I link della pagina di login (Google, Crea un account, Password dimenticata) non propagano il parametro. Il ritorno dopo il login non e' stato verificato (vietato loggarsi). | Misura di rete (commit navigation) | DC: l'utente torna dove stava | `Modules/User/app/Filament/Widgets/Auth/LoginWidget.php` (`url.intended`), middleware auth | B/C |
| D-GOOGLE | minore (ambiente) | `/it/auth/login/google` | 1280 | 302 verso `accounts.google.com` con `redirect_uri=https://www.fixcity.eu/it/auth/login/google/callback`: l'host e' quello di produzione, su dev il flusso non puo' tornare. | Header Location | n/a | `.env`/config servizi Google dell'ambiente dev | C |
| D-CALENDAR | maggiore (visivo) | `/it` sezione Eventi | 1280, 375 | Il giorno nel box calendario e' in Roboto Mono 16px invece del numero grande 40px: lo `span aria-hidden` extra ingloba lo stile `.card-calendar .card-title span`. "DOM" disallineato. | home-1280-4.png; `components/blocks/home/events.blade.php:71` | DC: `15<span>lun</span>` dentro `h4.card-title` | `Themes/Sixteen/resources/views/components/blocks/home/events.blade.php` | A |
| D-HEROGAP | minore | `/it` | 1280, 375 | Distanza h1-paragrafo dell'hero = 0px (`margin-bottom: 0` su `.fc-home-hero__intro`). | home-1280-1.png | DC hero: spazio verticale tra titolo e testo | `css/app/16-homepage-civic-reframe.css` | A |
| D-HOMEALIGN | minore | `/it` | 1280, 375 | Bordo sinistro incoerente: mappa/novita/eventi x=64; "Come funziona" e "Segui la tua segnalazione" x=24 (identico in produzione). A 375: 12 / 56 / 12 / 36 / 56; la fascia eventi e' piu larga delle card (36..339 vs 44..331). | Misure `getBoundingClientRect` | DC: un solo allineamento al contenitore | `css/app/16-homepage-civic-reframe.css` (`.fc-how-section`, `.fc-track-section`) | A (misura), B (gravita) |
| D-LOGINSPACING | minore | `/it/auth/login` | 1280 | Email e label "Password" distanziati circa 6px; "Accedi con Google" attaccato a "Accedi" senza separatore ("oppure"); "Password dimenticata?" attaccato al bottone Google; testo del bottone Google sottolineato. | login-1280-*.png | DC accesso: separatore e spaziatura tra azioni | `Themes/Sixteen/resources/views/filament/widgets/auth/login*.blade.php` | B |
| D-ACTIVENAV | minore | `/it/tickets/track`, `/it/tickets`, `/it/blog`, `/it/events`, `/it/faq` | 1280 | Voce attiva incoerente: su `/tickets/track` e' marcata "Segnalazioni" invece di "Traccia"; su tickets, blog, events, faq nessuna voce attiva (`.nav-link.active` / `aria-current` assenti). | Misura DOM | DC: voce corrente con `active` e `aria-current` | `Themes/Sixteen` navbar e `header-active` | B |
| D-CATEGORIE | minore | `/it/lista-categorie` | 1280 | Il link "Categorie di segnalazione" (modale ricerca) porta a una pagina con h1 "Esplora le segnalazioni", una sola card e nessuna categoria; contenuto attaccato a x=24, box con bordo senza padding, "Apri le segnalazioni ->". | categorie-1280-*.png | DC elenco categorie: elenco di argomenti | `config/local/fixcity/database/content/pages/lista-categorie.index.json` | B |
| D-TESTDATA | minore | `/it/tickets?q=Titolo+segnalazione`, `?q=Solferino` | 1280 | Segnalazioni pubbliche con titolo segnaposto: "Titolo segnalazione 2", "Titolo segnalazione 3" (2 risultati) e "Buca in via Solferino" (3 risultati). | tickets-list-tab-1280.png | DC usa segnaposto, FixCity in produzione non dovrebbe | DB / seeder | B |
| D-EVENT-NOPLACE | minore | `/it/events/{slug}` | 1280 | Il dettaglio evento mostra titolo, data e ora, testo, immagine, commenti, "Torna agli eventi" ma niente luogo, mappa, indirizzo, costi, contatti (`hasMap` falso su 3 eventi). La lista eventi (h1 "Vivere il comune") e' coerente con eventi.html. | event-1280-*.png | DC evento-dettaglio: Luogo, Date e orari, Costi, Contatti | `components/blocks/events/detail.blade.php` e modello eventi | B |
| D-BREADCRUMB | minore | pagine CMS vs `/it/tickets/{id}`, `/it/tickets/track` | 1280 | Posizione verticale del breadcrumb incoerente: y=261 sulle pagine CMS, y=236 su dettaglio segnalazione e track (troppo attaccato all'header). | Misura | DC: distanza costante | `Themes/Sixteen` layout pagine | B |
| D-I18N | minore | `/en`, `/de`, `/es` home | 1280 | Estratti del blog e titoli eventi non tradotti (contenuto CMS in italiano); testo hero diverso tra it ("Segnalazioni e servizi per la tua comunita") e en/de/es ("Seen a problem in your city?", ecc.). Nessuna chiave grezza in nessuna lingua; i 12 URL rispondono 200 e il cambio lingua mantiene il percorso. | Metriche helper, home-en/de/es | n/a | `config/local/fixcity/database/content/*.json`, lang | B/C |
| D-TERMINOLOGY | minore | header, hero, footer | 1280 | Stessa destinazione con 6 etichette: "Segnala", "Invia una segnalazione", "Segnala un disservizio", "Segnalazione disservizio", "Invia segnalazione", "Segnala un problema". | Elenco link | DC: una sola etichetta per azione | lang e config footer/header | B |
| D-FOCUSLOSS | minore | tutte, menu mobile | 375 | Con Esc il menu si chiude (`aria-expanded` false) ma il focus va su BODY invece che sul pulsante `button.custom-navbar-toggler` (aria-label "Mostra/Nascondi la navigazione"). | Misura `document.activeElement` | DC: il focus torna al toggler | JS navbar Bootstrap Italia nel tema | B |
| D-H1SIZES | minore | varie | 1280 | Dimensioni h1: liste a 42,67px (track, blog, events, legali, faq); 48px (tickets, dettaglio segnalazione, dettaglio evento, login, registrazione, reset, categorie, mappa, ricerca, 404); articolo 24px. In DC: liste 42,67, elenco 48, dettagli 48. | Metrica `h1fs` | Coerente tranne l'articolo (vedi D-H1ART) | n/a | A |
| D-SMALLTARGETS | minore | `/it` (8), `/it/blog` (22), `/it/events` (29) | 1280 | Elementi interattivi con altezza o larghezza sotto 24px (WCAG 2.5.8): non dettagliati. | Metrica `small` | n/a | n/a | C |
| D-NETWORKIDLE | minore | `/it/tickets` | 375 | Una volta non ha raggiunto `networkidle` in 45s (mappa). Non riprodotto. | Un solo run | n/a | n/a | C |

## c) Coerente con Design Comuni, da non toccare

- Header: slim bar con "Accedi all'area personale" e selettore lingua; skip link "Vai ai contenuti" e "Vai al footer"; ordine di Tab logico su home, login e registrazione; anello di focus visibile da 3px.
- Ricerca modale: il focus va sul campo, Esc la chiude e il focus torna al pulsante.
- `/it/tickets`: struttura uguale a segnalazioni-elenco.html (breadcrumb, h1, hr, colonna filtri, "N Risultati", "Rimuovi tutti i filtri", tab Mappa/Elenco, "Fai una segnalazione", widget valutazione, "Hai bisogno di aiuto?"). I filtri funzionano (tipo public_lighting = 58, stato resolved = 123), paginazione 25 pagine.
- `/it/blog` uguale a novita.html; dettaglio segnalazione per l'ospite con timeline, commenti e "Accedi per commentare/seguire".
- Dimensioni h1 delle liste (42,67px) e dei dettagli (48px), salto H2 -> H4 nel footer (presente anche in DC).
- Banner cookie: un solo pulsante primario "Ho capito", link "Maggiori informazioni" verso `/it/cookie-policy`, `role=region` con `aria-label` "Gestione dei cookie", cookie `__cookie_consent` di circa un anno, si chiude e non riappare al ricaricamento, primo nell'ordine di Tab; a 375 occupa 231px su 812.
- Pagine 404: sul tema, HTTP 404, "Pagina non trovata", tre link (Vai alla home, Guarda le segnalazioni, Segnala un problema), pulsanti a tutta larghezza.
- Validazione form: login "Ci sono 2 errori da correggere" con `role=alert`, `aria-invalid`, focus sul primo campo non valido; registrazione 7 errori; reset 1 errore. Tab order della registrazione logico.
- Track: codice errato o inesistente -> "Nessuna segnalazione trovata per questo codice..." con "Nuova ricerca" e "Segnala un problema".
- Menu mobile off-canvas; nessuno scroll orizzontale a 375 su nessuna pagina (tranne il contenuto della tabella cookie, vedi D-COOKIETABLE); nessuna immagine senza `alt`; nessun id duplicato; landmark header, nav, main, footer presenti; nessuna richiesta di asset fallita (solo le 404 attese); nessun errore in console oltre alle violazioni CSP INFO; nessuna chiave di traduzione grezza.
- Tutti i link di header, footer, home e mappa del sito rispondono 200 (le aree protette rispondono 302 verso il login).
- Home: hero con titolo serif Lora come in produzione.

## d) Cosa non e' stato possibile verificare

- Il ritorno alla pagina richiesta dopo il login (vietato loggarsi): `url.intended` non testabile. Idem il completamento del login con Google.
- Se i placeholder della privacy e l'host dev nella dichiarazione di accessibilita siano solo un problema di config dev: la produzione non ha i placeholder, ma non e' stato verificato il contenuto del tenant di produzione.
- Ordine di Tab su tutte le pagine: verificato solo su home, login e registrazione.
- Cambio lingua: verificato con URL diretti su home, tickets, login, privacy; non cliccando il menu a tendina su ogni pagina. Controllo del menu a 375 solo sulla home.
- Uso reale da tastiera di mappa Leaflet, widget valutazione, accordion FAQ; comportamento con screen reader; contrasti non calcolati.
- Impatto privacy degli hash Gravatar (ipotesi B): non verificato se gli hash siano ricostruibili da email note.
- Causa di D-LINE: non riproducibile alle 07:47, quindi non confermata.
- Artefatti solo-dev ignorati: debugbar, POST a `/_boost/browser-logs`, latenza Livewire di circa 3s.
- Alcuni screenshot non sono stati guardati singolarmente (m-blog, m-events, m-ticket129, slice 2-3 di blog e evento, molti a 375): a 375 si e' lavorato soprattutto con metriche.
- Effetto collaterale del test: i controlli di `/it/auth/login/google` hanno fatto GET che seguono il redirect fino a `accounts.google.com`; nessun login, nessun dato creato.

## Stato dopo le correzioni (2026-10-27)

- **D-HEADER chiuso.** Era la stessa causa di FO-02 (frammento Volt sovrascritto da `pages_old/`, vedi `fo-giro-loggato.md`): `/it/blog/{slug}` ora ha `.page-content[data-dc]` e header e footer sono quelli del resto del sito.
- **D-H1ART in parte chiuso.** L'H1 dell'articolo e 48 px; restano da fare i blocchi Dettagli, Argomenti e la colonna a x=260.
- **D-LINE non piu riproducibile** (0 occorrenze su blog, events, tickets, lista-categorie dopo `view:clear` e `view:cache`): copie compilate stale dopo un errore, non un difetto dei sorgenti.
- **FO-05 correlato:** il link alla cookie policy dell'informativa e ora assoluto con prefisso lingua.
- **D-COOKIETABLE chiuso.** `.table-responsive` non ha regole nel CSS del tema e le utility Tailwind sono spente nello scope `data-dc`: il blocco `cookie-policy/design-comuni.blade.php` ora ha `overflow-x: auto` inline. A 375 px: wrapper 351 px, tabella 709 px che scorre, nessun overflow della pagina. Da portare in `20-dc-components.css` al prossimo build.
- **Aperti:** D-PLACEHOLDER e D-ACCESS (dati dell'ente mancanti, da fornire), D-SPINNER, D-HOMEGRID, D-GRAV, D-CALENDAR, D-FOOTER, D-LOGINREDIRECT e i minori.
