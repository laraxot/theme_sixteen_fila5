---
id: dcp-186
title: "DCP-186: front office, ogni pagina e ogni elemento ha uno scopo, una funzione e una politica (scheda per pagina)"
type: story
epic: dc-parity-v2
status: in-progress
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

## Non verificato (da compilare a fine audit)
(vuoto)

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
