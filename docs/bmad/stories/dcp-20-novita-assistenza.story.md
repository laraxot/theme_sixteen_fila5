---
id: dcp-20
title: "DCP-20: novita, novita-dettaglio, assistenza-01-dati, assistenza-02-conferma e catalogo (index)"
type: story
epic: dc-parity-v2
status: done
priority: P1
owner: theme:Sixteen
created: 2026-10-13
updated: 2026-10-13
qmd: "design comuni parity novita news-page news-detail assistenza assistance-form assistance-confirm catalogo tests-index bmad story"
tags: [docs, sixteen, bmad]
---

# DCP-20: novita, assistenza e catalogo

## Richiesta
Replicare come pagine di prova guidate da JSON cinque pagine del riferimento `https://italia.github.io/design-comuni-pagine-statiche/`: `sito/novita.html`, `sito/novita-dettaglio.html`, `sito/assistenza-01-dati.html`, `sito/assistenza-02-conferma.html` e il catalogo `index.html` (locale `/it/tests/`). Obiettivo: HTML body >= 90% e pixel >= 97% a 1920 / 1440 / 992 / 768 / 375 px con altezze identiche. Metodo: `docs/prompts/design-comuni-page-recipe.md`.

## Stato: in-progress
Il markup e' fatto e misurato. Il CSS di queste pagine **non e' ancora in `components.css`** (lo rigenera l'orchestratore con `regenerate-design-comuni-css.sh`, non lanciato qui): il gate pixel reale, oggi, e' sotto soglia per quel motivo. Vedi "Verifiche da rifare dopo la rigenerazione".

## Baseline (misurata con `parity-gate.sh` prima di toccare nulla)
| pagina | HTML rigorosa / normalizzata | pixel 1920 / 1440 / 992 / 768 / 375 | altezze rif-loc (1920) |
|---|---|---|---|
| novita | 46,67 / 51,77 | 31,47 / 31,14 / 26,12 / 25,01 / 18,62 | 4466-2247 |
| novita-dettaglio | 48,81 / 54,80 | 8,10 / 8,72 / 9,12 / 8,05 / 8,76 | 3607-997 (pagina assente: `<main>` vuoto, solo header e footer) |
| assistenza-01-dati | 59,72 / 67,52 | 9,06 / 9,52 / 10,13 / 7,79 / 9,58 | 2916-997 (pagina assente) |
| assistenza-02-conferma | 61,31 / 69,28 | 13,28 solo a 1920 (1942-997, pagina assente); le altre larghezze della baseline sono contaminate dalla mia scrittura a meta' run e non si riportano | |
| index | 28,99 / 28,99 | 74,86 / 74,05 / 76,69 / 80,93 / 81,86 | 4155-5372 |

`tests.novita.json` esisteva solo nel tenant (blocco `catalog-page`, backup nello scratchpad); `tests.index.json` esisteva in tenant e modulo (blocco `template-index`, backup nello scratchpad). Le altre tre pagine non avevano JSON.

## Cosa e' stato fatto
1. **JSON** (identici in tenant e modulo, un blocco ciascuno, dati estratti dal riferimento con uno script sul DOM; conteggi controllati: 9 card novita, 3 categorie, 35 pagine del catalogo in 8 sezioni): `tests.novita`, `tests.novita-dettaglio`, `tests.assistenza-01-dati`, `tests.assistenza-02-conferma`, `tests.index`. Nessun doppione di `slug` (verificato con grep su tenant e modulo).
2. **Blocchi** (nessun testo cablato, nessun `x-data`, nessuno `<script>`, markup del riferimento):
   - `blocks/news-page/design-comuni.blade.php` + `card.blade.php` (card con immagine opzionale, usata in "In evidenza" e "Esplora tutte le novita'"), ricerca, paginazione, categorie, partial `dc-rating` e `dc-contacts` (con gruppo "Problemi in citta'").
   - `blocks/news-detail/design-comuni.blade.php`: titolo, data e tempo di lettura, menu Condividi / Vedi azioni, argomenti, immagine, indice laterale, descrizione, "A cura di", ultimo aggiornamento.
   - `blocks/assistance-form/design-comuni.blade.php`: modulo a sezioni, `fields[].kind` = `input` | `select` | `textarea` (nuovo tipo = nuovo `@case`), privacy, Indietro / Invia, contatti. Gli spazi variano come nel riferimento in base alla posizione (primo campo, prima select).
   - `blocks/assistance-confirm/design-comuni.blade.php`: hero con icona di successo, email del riepilogo, rating, contatti.
   - `blocks/tests-index/design-comuni.blade.php`: titolo con versione, schede, indice laterale, sezioni con elenco pagine. Solo la scheda "Sito": quella "Flussi di servizio" e' commentata nell'HTML del riferimento. I link portano a `/it/tests/<slug>`.
3. **Immagini**: 7 `notizia-*.png` scaricate dal riferimento in `public/design-comuni/assets/images/` (nessun file vuoto).
4. **Manifest** (solo append): `design-comuni-pages.txt` +5 righe (`sito/novita.html`, `sito/novita-dettaglio.html`, `sito/assistenza-01-dati.html`, `sito/assistenza-02-conferma.html`, `index.html`); `design-comuni-states.txt` +2 righe (`1440|label[for=privacy]` checkbox spuntato, `1440|button.send` stato di validazione del riferimento: classi `is-invalid` e `.form-feedback`). Le altre pagine hanno gia' gli stati di menu, accordion, radio, rating.
5. Nessun file condiviso toccato (CSS, JS, partial, layout, sections, pagine Folio).

## Risultati misurati
### HTML body (`compare-body-html.mjs`, dopo le modifiche)
| pagina | rigorosa | URL normalizzati |
|---|---|---|
| novita | 88,48 | 98,18 |
| novita-dettaglio | 88,71 | 97,93 |
| assistenza-01-dati | 87,69 | 97,77 |
| assistenza-02-conferma | 87,64 | 97,53 |
| index (pagina intera) | 57,27 | 62,03 |
| index (solo `<main>`, vedi sotto) | 90,70 | 100,00 |

Perche' la rigorosa e' sotto 90 sulle prime quattro: dei token del riferimento non coincidenti (90 / 82 / 72 / 70) quelli che differiscono **solo per il valore di `href`/`src`** sono 82 / 73 / 65 / 62 (sprite `<use>`, immagini e link con percorso relativo nel riferimento e assoluto da noi, come nelle altre pagine: eventi 88,78). Gli altri 8 / 9 / 7 / 8 sono header, footer e wrapper Volt condivisi, `Whatsapp` / `WhatsApp`, `label for="radio-4"` (refuso del riferimento sul quinto radio) e, in novita-dettaglio, l'`onclick="listenElements(...)"` non replicato (come DCP-17).

### Pixel
**Gate reale oggi** (`parity-gate.sh`, CSS non ancora rigenerato, riga di baseline per baseline):
- novita 81,56 / 78,58 / 74,16 / 89,30 / 90,50 (altezze 4466-4575, 4466-4575, 5371-5528, 5527-5720, 8004-8235)
- novita-dettaglio 84,18 / 84,00 / 79,09 / 82,62 / 85,31 (3607-3675, 3881-4018, 3784-3924, 4861-4928)
- assistenza-01-dati 93,19 / 92,46 / 91,49 / 94,04 / 92,00 (2916-2853, 2964-2901, 3010-2997, 3781-3768)
- assistenza-02-conferma 94,93 / 94,03 / 93,01 / 92,62 / 90,84 (1942-1930, 2020-2008, 1950-1958, 2689-2697)
- index 76,86 / 75,70 / 75,66 / 78,78 / 71,92 (4155-5172, 4398-5358, 4764-5501, 5379-6502)
Sotto soglia perche' mancano le regole CSS delle classi nuove (es. `row-shadow`, `cmp-card-simple`, `it-list`, `privacy-wrapper`, `cmp-text-area`, `nav-tabs`: 0 occorrenze in `components.css`), e il catalogo ha in piu' header e footer (vedi richieste condivise).

**Simulazione della rigenerazione** (non e' il gate ufficiale): CSS estratto dal riferimento con `extract-used-css.mjs` per le sole cinque pagine con gli stati del manifest, in un file fuori dal repo, **iniettato con `addStyleTag` solo sulla pagina locale** (copia di `compare-screenshots.mjs` nello scratchpad); `components.css` e il build non toccati. Risultato a 1920 / 1440 / 992 / 768 / 375 px, altezze identiche in ogni misura:
- novita 99,94 / 99,92 / 99,90 / 99,88 / 99,84 (4466, 5371, 5527, 8004)
- novita-dettaglio 99,89 / 99,86 / 99,81 / 99,76 / 99,63 (3607, 3881, 3784, 4861)
- assistenza-01-dati 99,87 / 99,82 / 99,75 / 99,85 / 99,78 (2916, 2964, 3010, 3781)
- assistenza-02-conferma 99,90 / 99,87 / 99,82 / 99,77 / 99,69 (1942, 2020, 1950, 2689)
- index, solo `<main>` (`--selector main` su entrambe): 100,00 a tutte e cinque le larghezze (4107, 4350, 4716, 5331), PNG identici (stesso md5 a 1440).

**Comportamenti** sulla pagina intera con CSS iniettato (stesso metodo): novita-dettaglio Condividi 99,86 (menu aperto in entrambe, verificato a occhio), Vedi azioni 99,86, indice (accordion) 99,86 a 1440 e 99,63 a 375; novita rating voto 4 a 1440 99,93; assistenza-02 rating voto 2 a 375 99,75; assistenza-01 checkbox privacy a 1440 99,72.

### Una trappola trovata e corretta
Nel blocco `news-detail` avevo lasciato un `</div>` in meno (il `.container` dell'indice restava aperto e rating e contatti finivano dentro): pixel 98,93 a 1440 con una banda a 95,89; dopo la correzione 99,86. Controllo: confrontare gli antenati di `.cmp-rating` e `.cmp-contacts` nel riferimento e nel locale (devono coincidere, a parte il wrapper Volt `div.page-content`).

## Differenze note e richieste condivise (NON fatte: fuori dai miei file)
1. **Catalogo, layout.** `pages/tests/index.blade.php` usa `<x-layouts.test>`: skiplink, header v1, modale ricerca, footer full e `<body data-page="tests">`. Il catalogo del riferimento ha il solo `<main>`. Sono 488 token locali senza controparte: HTML pagina intera massimo ~62% e pixel pagina intera impossibili (altezze 4155 contro 5172). Serve un layout senza chrome (es. `layouts/design-comuni-bare`: `<x-layouts.main :title :description body-page="">` + `<main>{{ $slot }}</main>`) e la pagina Folio che lo usa; con quello il blocco e' gia' pronto (main-only 100% pixel e 100% HTML normalizzato).
2. **Catalogo, menu indice mobile.** `resources/js/theme/header-mobile-nav.js` lega il toggler solo a `#nav4` (`navToggleSelector`, `navPanelSelector`). Il catalogo ha `.custom-navbar-toggler[data-bs-target="#navbarNavB"]` + `.navbar-collapsable#navbarNavB`. Misura: clic a 375 px sul toggler, solo `<main>`, 98,88% con banda 0 al 93,37% (il riferimento apre il pannello a tutto schermo con "Back" e "INDICE", il locale no). Soluzione: generalizzare i selettori a `.custom-navbar-toggler[data-bs-target]` e `.navbar-collapsable`.
3. **assistenza-01, validazione e invio.** Il riferimento (just-validate) al clic su `button.send` con campi vuoti aggiunge `is-invalid`, `aria-invalid`, `aria-describedby` e un `div.form-feedback.just-validate-error-label` per campo, e la barra di avanzamento dell'indice. Da noi non c'e' JS: misura clic a 1440 97,88% (altezze 2917-2916, banda 96,89). Inoltre il `<form>` senza `action` e `type="submit"` con campi validi ricaricherebbe la pagina con i dati nella query string: serve `preventDefault` e il comportamento di invio (alert `#alert-message`, passo successivo). Il CSS dello stato e' coperto dalla riga di manifest `1440|button.send`.
4. **novita-dettaglio, "Ascolta".** `onclick="listenElements(...)"` non replicato (sintesi vocale, funzione di `scripts.js` assente da noi; gia' annotato in DCP-17).
5. **novita, ricerca.** `data-bs-autocomplete="[]"` nel markup ma nessun JS di autocomplete (con elenco vuoto il riferimento non propone nulla: nessuna differenza misurata).
6. `dc-rating` (condiviso) rende `for="radio-5"` sul quinto radio dove il riferimento ha `for="radio-4"`: 1 token per pagina, non toccato.

## Verifiche da rifare dopo la rigenerazione
1. `parity-gate.sh` completo sulle quattro pagine: atteso >= 97% con altezze identiche (la simulazione dice 99,6-99,9%); HTML rigorosa invariata (88-89%, URL).
2. Hover (`.card-wrapper`, `.card-title`, `.page-link`, `.btn`, `.list-item` del catalogo, `.nav-link`, `.chip`) con `compare-computed.mjs` / `explain-style.mjs --state hover`: non misurati.
3. Catalogo: gate completo solo dopo la richiesta 1; comportamento menu mobile dopo la richiesta 2.
4. Stato `button.send` e `label[for=privacy]` nel CSS rigenerato, poi richiesta 3.

## Come si controlla
```bash
B=https://italia.github.io/design-comuni-pagine-statiche; L=http://192.168.1.40:8000/it/tests
for p in novita novita-dettaglio assistenza-01-dati assistenza-02-conferma; do
  bashscripts/tools/visual/parity-gate.sh $B/sito/$p.html $L/$p --stub-images 'picsum\.photos|via\.placeholder\.com|images\.unsplash\.com' --fail-if-contains '|---LINE:'
done
bashscripts/tools/visual/parity-gate.sh $B/ $L/ --fail-if-contains '|---LINE:'
```

## RISULTATO CON IL GATE REALE (orchestratore, 2026-10-13, dopo la rigenerazione del CSS: `parity-sweep.sh`)
CSS rigenerato da 38 pagine (`regenerate-design-comuni-css.sh`, ora parallelo: ~4,5 minuti) e tema ricompilato; misura con `parity-gate.sh --stub-images 'picsum\.photos|via\.placeholder\.com'`.
| Pagina | HTML rigorosa | HTML URL normalizzati | Pixel a 1920 / 1440 / 992 / 768 / 375 (altezze identiche) |
|---|---:|---:|---|
| `novita` | 88.48% | 98.18% | 99.94% / 99.92% / 99.9% / 99.88% / 99.84% |
| `novita-dettaglio` | 88.71% | 97.93% | 99.89% / 99.86% / 99.81% / 99.77% / 99.63% |
| `assistenza-01-dati` | 87.69% | 97.77% | 99.87% / 99.82% / 99.75% / 99.85% / 99.78% |
| `assistenza-02-conferma` | 87.64% | 97.53% | 99.9% / 99.87% / 99.82% / 99.77% / 99.69% |
| `index` | 89.32% | 98.4% | 99.9% / 99.87% / 100% / 99.78% / 100% |

Lettura: pixel >= 97% a tutte le larghezze con altezze identiche; l'HTML rigoroso resta tra 86% e 91% per i soli valori di `href`/`src` (percorsi relativi nel riferimento, URL assoluti da noi) e per il chrome condiviso; con gli URL normalizzati e' >= 97,5% ovunque.
Modifiche condivise richieste dall'agente e applicate dall'orchestratore: vedi la story DCP-19 (carosello `carousel-4-card`, fallback `href="#id"` del collapse, `col_class` del rating, `.saveBtn`, `.radio-card`, `focus--mouse` sulle modali, validazione form, layout `design-comuni-bare` per il catalogo, selettori del menu mobile).
