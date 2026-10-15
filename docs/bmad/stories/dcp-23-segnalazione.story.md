---
id: dcp-23
title: "DCP-23: segnalazione (passi 01-04, area personale, dettaglio, elenco)"
type: story
epic: dc-parity-v2
status: done
priority: P1
owner: theme:Sixteen
created: 2026-10-13
updated: 2026-10-13
supersedes: dcp-16
qmd: "design comuni parity segnalazione disservizio report-step report-area report-detail report-list stepper area personale elenco bmad story"
tags: [docs, sixteen, bmad]
---

# DCP-23: segnalazione

## Richiesta
Replicare in `/it/tests/<slug>` le 7 pagine `sito/segnalazione-01-privacy`, `-02-dati`, `-03-riepilogo`, `-04-conferma`, `segnalazione-area-personale`, `segnalazione-dettaglio`, `segnalazioni-elenco` del riferimento `https://italia.github.io/design-comuni-pagine-statiche/`, guidate da JSON, fino a HTML body >= 90% e pixel >= 97% a 1920 / 1440 / 992 / 768 / 375 px con altezze identiche. Metodo: `docs/prompts/design-comuni-page-recipe.md`. Sostituisce [DCP-16](dcp-16-segnalazione-01-privacy.story.md) (solo baseline di 01). Storie precedenti sulle stesse pagine, non toccate: `segnalazione-01-privacy-visual-parity.story.md`, `segnalazione-dettaglio-visual-parity.story.md`, `segnalazioni-elenco-visual-parity.story.md`.

## Baseline (misurata 2026-10-13, prima di toccare nulla)
HTML body rigoroso / con URL normalizzati:

| Pagina | Rigorosa | Normalizzata |
|---|---|---|
| segnalazione-01-privacy | 76,88% | 86,75% |
| segnalazione-02-dati | 66,35% | 73,29% |
| segnalazione-03-riepilogo | 70,26% | 77,93% |
| segnalazione-04-conferma | 65,74% | 72,83% |
| segnalazione-area-personale | 37,31% | 41,34% |
| segnalazione-dettaglio | 47,14% | 51,63% |
| segnalazioni-elenco | 50,08% | 54,80% |

Pixel di 01 (DCP-16): 94,15 / 92,94 / 91,51 / 90,01 / 89,19%. Le altre pagine avevano blocchi legacy Tailwind (`flow/segnalazione/02-dati`, `03-riepilogo`, `04-conferma`, `segnalazione-area-personale`, `service/detail`, `segnalazioni-elenco`), che servono anche al front office e non sono stati modificati.

## Cosa e' stato fatto
1. **Backup** dei 10 JSON preesistenti (tenant e modulo) in `/home/zorin/dcp23-backup-2026-10-13/` (fuori dal repo). Il tenant e' tracciato in git; il modulo e' un repo separato.
2. **JSON** `tests.<slug>.json`, tenant e modulo, identici byte per byte: un solo blocco per pagina (`report-step` x4, `report-area`, `report-detail`, `report-list`). I dati sono copiati dal markup dei riferimenti con uno script (conteggi controllati col confronto dei token). Il modulo non aveva i file `01-privacy`, `02-dati`, `03-riepilogo`, `04-conferma` con questi slug (aveva `tests.segnalazione-privacy`, `-dati`, `-riepilogo`, `-conferma`, altre pagine, lasciate): creati nuovi. Nessuno slug duplicato (verificato in entrambe le cartelle).
3. **Famiglia di blocchi `report-*`** in `components/blocks/`:
   - `report-step/design-comuni.blade.php`: un blocco per i quattro passi. `layout` sceglie la struttura: `narrow` (consenso: paragrafi, casella, pulsante), `sidebar` (modulo con indice laterale; sezioni `place`, `fields` con campi `select|text|textarea|upload`, `person`), `summary` (avviso `callout`, gruppi di schede con riquadri riepilogo, pulsanti, modale termini), `done` (conferma con righe di testo in linea `text|strong|link|br`, ricevuta, servizi correlati). Un nuovo tipo di sezione o campo = un nuovo `@case` o file `section-<tipo>`.
   - `report-area`: titolo, tab, pannelli con indice e sezioni `messages|activities|practices` (file `section-<tipo>`), modale messaggio.
   - `report-detail`: titolo con stato, pulsanti, menu Condividi / Vedi azioni, indice, sezioni `text|list|text-attachment|cta|contacts`, carosello "Contenuti correlati".
   - `report-list`: filtro categorie, tab Mappa / Elenco (mappa statica con pin), schede, invito, modale.
   - `report-partials/`: `breadcrumb`, `stepper`, `navscroll`, `info-summary`, `info-card`, `steps-nav`, `rating`, `contacts`, `contacts-card`. `rating` e `contacts` esistono gia' come `dc-rating` / `dc-contacts` ma non coprono la classe della colonna (`p-lg-0 px-4`) e la colonna contatti larga 5: copie nella propria cartella, con la classe dal JSON.
4. **Immagini** nuove in `public/design-comuni/assets/images/`: `image-disservizio.png`, `folder-wating.svg`, `folder-concluded.svg`, `folder-pay.svg` (scaricate dal riferimento; `img-disservizio-thumbnail.png`, `map-pin.svg`, `map-placeholder.svg`, `modal-disservizio-placeholder.png` c'erano gia', identiche).
5. **Manifest** (solo append): 7 righe in `design-comuni-pages.txt` (`sito/segnalazione-01-privacy.html` ... `sito/segnalazioni-elenco.html`) e 6 stati in `design-comuni-states.txt`: `1440|label[for=water]`, `1440|.pin`, `375|.pin`, `1440|a[href="#data-ex-disservizio2"]|button[data-bs-target="#collapse1"]`, `1440|a[href="#data-ex-tab3"]|button[data-bs-target="#collapse1"]`, `1440|a[href="#data-ex-tab3"]|#dropdownMenu-pratiche`. Gli altri stati che servono (`label[for=privacy]`, `#collapse-parents`, `#modal-terms`, `a[href="#data-ex-tab3"]`, `#modal-message`, `a.show-more`, rating, menu) c'erano gia', aggiunti da altri agenti. Nessun CSS scritto, nessun build lanciato.

## Risultato (misurato 2026-10-13 con `bashscripts/tools/visual/parity-gate.sh`, pagina locale come servita)
Il CSS di queste pagine e' in `components.css` (rigenerato dall'orchestratore alle 11:23, dopo l'aggiunta delle pagine ai manifest): le misure sono quelle del gate vero, non di una stima.

| Pagina | HTML rigorosa / URL normalizzati | 1920 | 1440 | 992 | 768 | 375 | Altezze 1920 / 992 / 375 |
|---|---|---|---|---|---|---|---|
| segnalazione-01-privacy | 85,69 / 97,28% | 99,88 | 99,84 | 99,74 | 99,73 | 99,62 | 1938 / 2010 / 2925 identiche |
| segnalazione-02-dati | 87,49 / 97,89% | 99,87 | 99,83 | 99,75 | 99,83 | 99,74 | 3064 / 3112 / 4056 identiche |
| segnalazione-03-riepilogo | 87,42 / 97,61% | 99,93 | 99,90 | 99,86 | 99,83 | 99,72 | 3115 / 3188 / 3956 identiche |
| segnalazione-04-conferma | 87,81 / 97,66% | 99,90 | 99,87 | 99,81 | 99,76 | 99,64 | 2301 / 2379 / 3083 identiche |
| segnalazione-area-personale | 87,06 / 95,68% | 99,75 | 99,66 | 99,50 | 99,80 | 99,67 | 2854 / 2902 / 3601 identiche |
| segnalazione-dettaglio | 89,86 / 98,17% | 99,88 | 99,88 | 99,82 | 99,82 | 99,69 | 4425 / 4673 / 6218 identiche |
| segnalazioni-elenco | 89,46 / 98,42% | 99,92 | 99,90 | 99,85 | 99,81 | 99,69 | 3128 / 3095 / 3395 identiche |

**Pixel: >= 99,50% su 35 misure su 35, altezze identiche. HTML rigoroso: 85,69-89,86%, quindi sotto il 90% (il gate esce con codice 1 per questo solo motivo).** Con URL normalizzati: 95,68-98,42%. Il blocco dentro `<main>` e' al 92,64-95,15% rigoroso e al 98,73-99,82% normalizzato (`tokdiff --main`); il resto e' fuori dal blocco ed e' uguale per ogni pagina /tests: `href`/`src` relativi del riferimento (`../assets/...`, `homepage.html`) contro assoluti da noi (header, footer, menu, sprite `<use>`, `<img>`), `Whatsapp` / `WhatsApp`, wrapper Livewire, `<style>`/`<link>` nel body. Su pagine piccole questi token pesano di piu' (come per `eventi`, DCP-15, 88,78%). Residui scelti dentro il blocco: `label for="radio-4"` sul quinto radio del rating (errore del riferimento); `data-bs-dismiss="modal fw-bold"` (refuso del riferimento, impedirebbe di chiudere la modale); `aria-selected="true"` su entrambe le tab dell'elenco; `aria-hidden` mancante sull'icona della prima scheda del carosello; `onclick="listenElements(...)"` sulla voce "Ascolta" (funzione del bundle del riferimento che da noi non esiste, come DCP-17). Per l'area personale il riferimento ha l'**header da utente autenticato** (`it-user-wrapper`, "Mario Rossi", menu a 4 voci: circa 45 token) e noi quello da ospite (sezione condivisa, vedi "Modifiche condivise").

**Struttura DOM** (`outline.mjs`, scheletro di `<main>` a 5 livelli, riferimento contro locale): identico per tutte e 7 le pagine (verificato di nuovo dopo l'arrivo di `carousel-4-card`; prima del carosello l'unica differenza era il carosello non montato: 97,16 / 96,98 / 96,21% a 992 / 768 / 375 px con altezze diverse di 26 px, misura fatta con il CSS dell'orchestratore non ancora rigenerato, iniettato da un estratto privato).

### Comportamenti (pagina intera dopo il clic: `compare-screenshots.mjs --selector body --click`, gate vero)
| Pagina | Stato | 1440 | 375 |
|---|---|---|---|
| 01 | casella privacy | 99,84% (1939) | 99,62% (2926) |
| 02 | accordion "Mostra tutto" | 99,72% (3295) | 99,75% (4263) |
| 03 | "Invia" (modale termini) | 99,97% (3115) | 99,92% (3956) |
| 04 | rating 4 stelle / 2 stelle | 99,89% / 99,89% (2856) | 99,70% (3682) |
| area personale | modale messaggio | 99,80% (2854) | 99,69% (3602) |
| area personale | **tab "Attivita'"** | **86,75%, altezze 3014-2854** | non misurato |
| dettaglio | menu Condividi / Vedi azioni / rating | 99,88 / 99,88 / 99,72% | non misurato |
| dettaglio | "Vedi altri 2" del carosello | 99,64% (4506) | 99,70% (6299) |
| elenco | tab Elenco | 99,86% (3239) | non misurato |
| elenco | tab Elenco + accordion | 99,87% (3667) | 99,78% (4893) |
| elenco | pin -> modale | 99,91% (3128) | 99,69% (3395) |
| elenco | casella categoria / rating | 99,90 / 99,91% | non misurato |

(altezze tra parentesi.) **Non funziona: il cambio tab dell'area personale.** `initTicketTabs` in `app.js` e' limitato a `#tabDisservizio`; `dom-diff-after-click` mostra che sul riferimento il clic su un tab sposta `active`/`show` tra link e pannello, da noi cambia solo la barra di avanzamento. Con un gestore generico dei tab (solo nel mio test, vedi sotto): tab Attivita' 99,68% (1440) e 99,68% (375), con accordion aperto 99,69%, con menu "Ordina" 99,69%, tab Messaggi 99,65%. I tab e l'accordion dell'elenco funzionano col codice esistente (`initTicketTabs`, gestore `collapse`); l'accordion "Mostra tutto" del passo 02 funziona col gestore `collapse` esistente. Lo stato "tab Attivita' + accordion pratica" e "+ menu Ordina" non e' misurabile col gate vero per lo stesso motivo (il pulsante e' nel pannello nascosto).


## Modifiche condivise richieste (non fatte: fuori dai file della famiglia)
1. **`resources/js/theme/design-comuni-home.js`, voce `carousel-4-card` in `CAROUSELS`** (carosello "Contenuti correlati" del dettaglio): **gia' aggiunta da un altro agente alle 11:26** (opzioni identiche a quelle del bundle del riferimento: `pagination: false, arrows: false, gap: '1rem', perPage: 4, perMove: 1, speed: 800, breakpoints {1200: perPage 3 + pagination, 992: perPage 2, 768: perPage 1, gap 0}`). Misura che la giustificava, prima: 97,16 / 96,98 / 96,21% a 992 / 768 / 375 px, altezze diverse di 26 px, "Vedi altri 2" non cliccabile; dopo (gate): 99,82 / 99,82 / 99,69% con altezze identiche. Il `collapse` via `href` funzionava gia' (Bootstrap Collapse), non serve toccarlo.
2. **`resources/js/app.js`, `initTicketTabs()`: tab generici.** Oggi cerca `#tabDisservizio` e i pannelli come fratelli di `.tab-content`. Nell'area personale la lista e' `#myTab` e i pannelli stanno in `.tab-content` altrove: servono tutte le `.nav-tabs` con `[data-bs-toggle="tab"]` e i pannelli trovati dall'`href` del link (`document.querySelector(link.getAttribute('href'))`); al clic: `active` e `aria-selected` sul link, `show active` sul pannello, gli altri senza. Misura: tab Attivita' 86,75% (altezze 3014 contro 2854) oggi; 99,68% con un gestore equivalente (test fuori repo). Il gestore dell'elenco (`#tabDisservizio`) resta valido (99,86%).
3. **`resources/views/components/blocks/partials/dc-rating.blade.php` (facoltativo)**: leggere la classe della colonna da `feedback.col_class` (default `col-12 col-lg-6`). Le pagine 04, dettaglio ed elenco hanno `col-12 col-lg-6 p-lg-0 px-4` (l'elenco `px-3`); misura: con la colonna di default il rating a 1440 e' largo 612 px contro 660 del riferimento (screenshot 04 prima del CSS). Qui e' stato risolto con una copia (`report-partials/rating`).
4. **Header da utente autenticato** (sezione `header`, vietata alla famiglia) per `segnalazione-area-personale`: il riferimento ha il pulsante utente `it-user-wrapper` ("Mario Rossi", icona, menu a tendina con 4 voci e "Esci"), circa 45 token, noi quello da ospite ("Accedi all'area personale"). Misura: HTML normalizzato 95,68% contro 97-98% delle altre pagine; pixel 99,5-99,8%.
5. **Comportamenti nuovi non replicati** (staticamente il riferimento non li ha, solo con il suo bundle): suggerimenti del campo luogo (`data-bs-autocomplete` in 02, e i campi "Cerca" dell'area personale), link "Usa la tua posizione" (geolocalizzazione: richiede contesto sicuro, vedi memoria `geolocation-needs-secure-context`), "Carica file" e rimozione del file caricato, voce "Ascolta" (sintesi vocale, `listenElements`), pulsanti Indietro / Avanti / Salva (nessuna navigazione tra i passi: il `data-bs-target="#"` del pulsante "Avanti" del passo 02 e' come nel riferimento e, cliccato, il gestore generico delle modali di `app.js` lancia `Failed to execute 'querySelector' on 'Document': '#' is not a valid selector` (verificato)), filtro "Rimuovi tutti i filtri" e categorie dell'elenco (le caselle non filtrano la lista), mappa (e' l'immagine `map-placeholder.svg` con un pin: una mappa Leaflet e' un blocco a parte, quello legacy `segnalazioni-elenco` ha `map-lit`).

## Cose non fatte
- Cambio tab dell'area personale, carosello (poi aggiunto da altri), header autenticato, suggerimenti del campo luogo, geolocalizzazione, upload, "Ascolta", filtro dell'elenco: vedi "Modifiche condivise" e il punto 5.
- Second brain: non ho toccato `MEMORY.md`, gli indici, l'epic DCP-00 e `00-COORDINATION.md` (fuori dalla mia proprieta'); le lezioni sono in "Trappole incontrate" di questa story, da riportare negli indici dall'orchestratore.
- Nessun test Pest: le pagine sono dati e la verifica e' il gate; i contratti Blade dei blocchi legacy (`tests/Unit/Segnalazione02DatiBladeContractTest.php`) non sono toccati.

## Differenze note
- HTML rigoroso sotto il 90% per i motivi sopra (URL del riferimento; la struttura e' al 95-98%).
- Il breadcrumb "Servizi" punta a `#` come nel riferimento (nessuna pagina `tests/servizi` scelta come destinazione).
- `data-bs-dismiss="modal"` (non `"modal fw-bold"`) sul pulsante "Annulla" della modale termini; `aria-selected` corretto sulle tab dell'elenco; `aria-hidden` sull'icona della prima scheda del carosello.
- I testi sono solo in italiano (`content_blocks.en` vuoto, come prima).
- I 4 JSON dei passi nel modulo sono nuovi (con slug `tests.segnalazione-0N-*`); i `tests.segnalazione-privacy|dati|riepilogo|conferma` del modulo (altri slug, flusso legacy) restano.

## Trappole incontrate (da ricordare)
- Lo scratchpad della sessione e' condiviso tra gli agenti: nomi generici (`tokdiff.mjs`, `bak/`) vengono sovrascritti da altri. Usare una sottocartella propria.
- Il confronto HTML e' un insieme di token con tutti gli attributi: l'ordine degli attributi e le classi contano; i valori degli URL pesano di piu' nelle pagine piccole (vedi sopra).
- `extract-used-css.mjs` con 33 stati e 7 pagine impiega oltre 20 minuti col carico attuale della macchina; per misurare in anticipo conviene iniettare il CSS estratto nella sola pagina locale invece di aspettare la rigenerazione.
- Sotto carico la barra di debug di Laravel rientra nella pagina dopo i clic e aggiunge 48 px al `<body>` (falsi 83-92% nelle mie prime misure): nella copia privata dello strumento l'ho tolta di nuovo dopo i clic; le misure del gate vero qui sopra non hanno avuto il problema.
- Il mio primo sospetto "il `collapse` via `href` non funziona" era sbagliato: l'elemento non era cliccabile perche' il carosello non era montato. Verificare con un clic reale (e senza gestori aggiunti, che si sommano a quelli esistenti e si annullano) prima di chiedere una modifica condivisa.

## Come si controlla
```bash
for s in segnalazione-01-privacy segnalazione-02-dati segnalazione-03-riepilogo segnalazione-04-conferma segnalazione-area-personale segnalazione-dettaglio segnalazioni-elenco; do
  bashscripts/tools/visual/parity-gate.sh https://italia.github.io/design-comuni-pagine-statiche/sito/$s.html \
    http://192.168.1.40:8000/it/tests/$s --stub-images 'picsum\.photos|via\.placeholder\.com' --fail-if-contains '|---LINE:'
done
```
(in bash, non in zsh). Comportamenti: `compare-screenshots.mjs --selector body --click '<css>'` con i selettori della tabella; DOM: `dom-diff-after-click.mjs`.

## Collegamenti
[DCP-16](dcp-16-segnalazione-01-privacy.story.md) (superata), [DCP-14](dcp-14-appuntamento-02-data-orario.story.md) (stesso schema stepper/info-summary), [DCP-17](dcp-17-evento-dettaglio.story.md) (carosello, menu a tendina, scroll-spy), ricetta `docs/prompts/design-comuni-page-recipe.md`.

## RISULTATO CON IL GATE REALE (orchestratore, 2026-10-13, dopo la rigenerazione del CSS da 44 pagine: `parity-sweep.sh`)
| Pagina | HTML rigorosa | HTML URL normalizzati | Pixel a 1920 / 1440 / 992 / 768 / 375 (altezze identiche) |
|---|---:|---:|---|
| `segnalazione-01-privacy` | 85.69% | 97.28% | 99.87% / 99.84% / 99.76% / 99.73% / 99.62% |
| `segnalazione-02-dati` | 87.49% | 97.89% | 99.87% / 99.83% / 99.75% / 99.83% / 99.74% |
| `segnalazione-03-riepilogo` | 87.42% | 97.61% | 99.93% / 99.89% / 99.86% / 99.83% / 99.72% |
| `segnalazione-04-conferma` | 87.81% | 97.66% | 99.9% / 99.87% / 99.81% / 99.76% / 99.64% |
| `segnalazione-area-personale` | 87.06% | 95.68% | 99.75% / 99.66% / 99.52% / 99.8% / 99.67% |
| `segnalazione-dettaglio` | 89.86% | 98.17% | 99.91% / 99.88% / 99.82% / 99.82% / 99.69% |
| `segnalazioni-elenco` | 89.46% | 98.42% | 99.92% / 99.9% / 99.85% / 99.81% / 99.69% |
