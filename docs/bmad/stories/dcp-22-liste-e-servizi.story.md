---
id: dcp-22
title: "DCP-22: liste (categorie, risorse) ed elenco/dettaglio servizi"
type: story
epic: dc-parity-v2
status: in-review
priority: P1
owner: theme:Sixteen
created: 2026-10-13
updated: 2026-10-13
qmd: "design comuni parity lista-categorie lista-risorse lista-risorse-categorie servizi servizi-categoria servizio-dettaglio list-page service-page-list service-page-detail bmad story"
tags: [docs, sixteen, bmad]
---

# DCP-22: liste e servizi

## Richiesta
Replicare come pagine di prova guidate da JSON sei pagine di `https://italia.github.io/design-comuni-pagine-statiche/sito/`: `lista-categorie`, `lista-risorse-categorie`, `lista-risorse`, `servizi`, `servizi-categoria`, `servizio-dettaglio` (locale `/it/tests/<slug>`), con HTML body >= 90% e pixel >= 97% a 1920/1440/992/768/375 px con altezze identiche. Ricetta: `docs/prompts/design-comuni-page-recipe.md`.

## Baseline (misurata prima di toccare nulla, `parity-gate.sh --stub-images`)
Le tre `lista-*` non esistevano (la rotta rispondeva 200 con un contenuto qualsiasi); `tests.servizi.json` e `tests.servizio-dettaglio.json` esistevano con blocchi legacy (`catalog-page`, `service-detail`), solo nel tenant, backup fuori dal repo.

| Pagina | HTML rigorosa / url-norm. | Pixel 1920 / 1440 / 992 / 768 / 375 |
|---|---|---|
| lista-categorie | 50,77 / 56,88 | 9,18 / 10,03 / 9,84 / 8,1 / 8,32 |
| lista-risorse-categorie | 39,31 / 43,65 | 7,01 / 8,07 / 8,26 / 7,26 / 7,7 |
| lista-risorse | 47,4 / 52,96 | 8,11 / 9,06 / 9,37 / 7,75 / 8,27 |
| servizi | 45,6 / 50,62 | 15,43 / 15,98 / 16,43 / 15,84 / 15,86 |
| servizi-categoria | 48,65 / 54,52 | 6,83 / 7,47 / 7,91 / 7,06 / 8,02 |
| servizio-dettaglio | 42,12 / 46,21 | 44,55 / 45,13 / 41,71 / 40,63 / 35,96 |

## Cosa e' stato fatto
1. **Tre blocchi guidati dai dati, un blocco per famiglia di struttura** (nessun testo cablato, nessun `x-data`, nessuno stile):
   - `blocks/list-page/` (`design-comuni`, `news-cards`): sezioni scelte per `type` = `news-cards` (card con immagine opzionale, ricerca opzionale, paginazione opzionale; `style` plain|grey, `heading` xxlarge|secondary) e `category-cards`.
   - `blocks/service-page-list/` (`design-comuni`, `service-search`): `service-search` con `variant` catalog (servizi) o category (servizi-categoria) = ricerca, conteggio, card servizio, "carica altri", colonna laterale (`kind: cta` per il link finale); `category-cards`.
   - `blocks/service-page-detail/` (`design-comuni`, `heading`, `side-nav`, `section-content`, `section-timeline`, `section-contacts`, `related-contacts`): sezioni `content` (blocchi `richtext` con segmenti e a capo, `paragraph`, `subtitle`, `file`, `button`; `box.padding` 3|4), `timeline`, `contacts`; carosello correlati e contatti.
   - Parti riusabili tra le due famiglie: `blocks/list-parts/` (`breadcrumb`, `hero`, `category-cards`). Rating e contatti: partial condivisi `dc-rating` e `dc-contacts` (non modificati).
2. **JSON** `tests.<slug>.json` x6, scritti in tenant (`laravel/config/local/fixcity/database/content/pages/`) e modulo (`laravel/Modules/Fixcity/config/database/content/pages/`). Dati estratti dal riferimento con uno script (parser stdlib sul markup, conteggi controllati: 3+9 card, 3+6+20, 3+6, 5+15, 10+1, 11 sezioni + 4 slide). Backup dei due file preesistenti (`tests.servizi.json`, `tests.servizio-dettaglio.json`) nello scratchpad di sessione `dcp22/backup/`. `tests.servizi-index.json` (slug diverso) e `servizi-categoria-14.json` (slug `tests.servizi-categoria-14`) non toccati: nessuna collisione di slug (verificato con grep su entrambe le cartelle).
3. Immagini: le 7 `notizia-*.png` usate esistevano gia' in `public/design-comuni/assets/images/`; nessuna nuova. Dettaglio: avatar `https://picsum.photos/200/200` come nel riferimento.
4. Manifest: 6 righe in coda a `scripts/design-comuni-pages.txt`; nessuna riga in `design-comuni-states.txt` (le righe servono gia': `#shareActions`, `#viewActions`, `.accordion-button`, `a.show-more`, `label[for=star4a]`).
5. Nessun file condiviso modificato (css, js, partial, layout, sezioni): vedi "Modifiche condivise richieste".

## Risultato misurato

### HTML body (`compare-body-html.mjs`, pagina reale)
| Pagina | rigorosa | url-normalizzati |
|---|---|---|
| lista-categorie | 89,39 | 97,98 |
| lista-risorse-categorie | 90,98 | 98,45 |
| lista-risorse | 89,15 | 98,12 |
| servizi | 90,81 | 98,24 |
| servizi-categoria | 89,71 | 98,07 |
| servizio-dettaglio | 90,73 | 98,44 |

Tre pagine restano sotto 90 rigoroso (89,15-89,71). Perche' (misurato con un diff di token): dentro `<main>` il markup coincide al 100% tranne i valori degli URL (token diversi dentro `<main>`: lista-categorie 9 su 596, lista-risorse 17 su 702, servizi-categoria 10 su 661; sono `src`/`href` delle immagini, degli sprite `<use>` e del link Home, piu' il `for` del quinto radio del rating, errore del riferimento). Fuori da `<main>` (header, footer, modale: non nostri) differiscono 64 token su tutte e tre, quasi tutti URL assoluti locali contro relativi del riferimento. Con URL normalizzati 97,98-98,45 su tutte e sei.

### Pixel (5 larghezze, altezze identiche in tutti i casi)
Misurati con `compare-screenshots.mjs` **copiato in scratch con un'opzione `--inject-css`**: il CSS di queste sei pagine e' stato estratto con `extract-used-css.mjs` (stessi argomenti dello script condiviso, solo le sei pagine, stati dal manifest) in un file di scratch e iniettato nella pagina locale; per il dettaglio e' iniettato anche Splide con la configurazione del riferimento (`.carousel-4-card`, vedi sotto). **Non e' la pipeline reale** (components.css non e' ancora rigenerato): va ripetuta con `parity-gate.sh` dopo la rigenerazione.

| Pagina | 1920 | 1440 | 992 | 768 | 375 | altezze (1920/1440, 992, 768, 375) |
|---|---|---|---|---|---|---|
| lista-categorie | 99,92 | 99,89 | 99,87 | 99,84 | 99,78 | 3374, 3981, 4004, 5749 |
| lista-risorse-categorie | 99,95 | 99,94 | 99,92 | 99,91 | 99,89 | 5838, 7183, 7585, 11460 |
| lista-risorse | 99,94 | 99,91 | 99,88 | 99,87 | 99,83 | 4256, 4983, 5065, 7469 |
| servizi | 99,94 | 99,91 | 99,90 | 99,88 | 99,83 | 4628, 5312, 5717, 7557 |
| servizi-categoria | 99,94 | 99,92 | 99,88 | 99,86 | 99,79 | 4539, 4833, 4844, 6145 |
| servizio-dettaglio | 99,91 | 99,85 | 99,82 | 99,78 | 99,66 | 5813, 6192, 6505, 7767 |

Stato attuale della pagina reale, senza iniezione (CSS non ancora rigenerato), 1440 px: 79,94 / 70,56 / 82,29 / 83,02 / 86,93 / 84,77 (altezze diverse): atteso, mancano le regole delle classi nuove.

### Comportamenti (servizio-dettaglio, stessa iniezione, pagina intera dopo il clic)
Condividi 99,88; Vedi azioni 99,85; indice (accordion) 99,88 a 1440 e 99,64 a 375; rating voto 4 99,72 (altezze 6368 uguali). Liste: clic sul campo ricerca 99,92 (servizi 1440) e 99,79 (servizi-categoria 375), clic su "Carica altri risultati" 99,92, clic su Invio 99,91. Nel riferimento questi elementi non hanno altri comportamenti (dom-diff: cambia solo `focus--mouse`, gia' gestito dal tema).
- **`a.show-more` ("Vedi altri 2" nel carosello): 96,11% con altezze 5893-5813**: il riferimento apre l'elenco (`ul.collapse` prende `show`, `aria-expanded=true`), da noi non si apre. Causa: il controller collapse di `app.js` legge solo `data-bs-target`, questo link usa `href="#collapseExample"`. Con la correzione emulata in scratch: 99,67%, altezze 5893 uguali.
- Clic su `.page-link` (`href="#"`, a fondo pagina): 96,13% con altezze uguali, ma e' un artefatto della misura: il riferimento ha `:root{scroll-behavior:smooth}` (verificato nel suo CSS), dopo il clic sta ancora scorrendo (scarto di 3 px), da noi il salto e' immediato. Non e' un difetto del blocco.

## Modifiche condivise richieste (non fatte: fuori dalla famiglia)
1. **Carosello `carousel-4-card`** (`resources/js/theme/design-comuni-home.js`, oggetto `CAROUSELS`): aggiungere la chiave `'carousel-4-card'` con le opzioni del riferimento (`assets/script/scripts.js`): `{ pagination: false, arrows: false, gap: '1rem', perPage: 4, perMove: 1, speed: 800, breakpoints: { 1200: { perPage: 3, pagination: true }, 992: { perPage: 2, gap: '1rem' }, 768: { perPage: 1, gap: 0 } } }`. Misura che la giustifica (CSS iniettato, senza Splide): servizio-dettaglio 99,8 / 97,78 / 97,58 / **96,81** a 1440 / 992 / 768 / 375 con altezze diverse di 26, 26 e 24 px a 992 / 768 / 375 (7743 contro 7767 a 375; a 1440 uguali); con Splide montato come sopra 99,85 / 99,82 / 99,78 / 99,66, altezze identiche.
2. **Collapse da `href`** (`resources/js/app.js`, controller `[data-bs-toggle="collapse"]`): se manca `data-bs-target` usare `href` quando inizia con `#`. Misura sopra (96,11 -> 99,67).
3. **Rating con colonna stretta** (`blocks/partials/dc-rating.blade.php`): il rating del dettaglio ha `col-12 col-lg-6 p-lg-0 px-4` (gli altri `col-12 col-lg-6`). Oggi il blocco ritocca l'HTML reso con `str_replace` (marcato `ponytail:` in `service-page-detail/design-comuni.blade.php`); pulito sarebbe un'opzione `feedback.col_class` nel partial, poi si toglie il ritocco.
4. **Sintesi vocale "Ascolta"** (`onclick="listenElements(...)"` nella tendina "Vedi azioni"): non replicata, come in DCP-17 (la funzione e' di `scripts.js` del riferimento e non esiste da noi).
5. Rigenerare il CSS (`scripts/regenerate-design-comuni-css.sh`, lo lancia l'orchestratore): le sei pagine sono gia' nel manifest.

## Verifiche che restano dopo la rigenerazione
`parity-gate.sh` completo sulle sei pagine (i numeri dei pixel sopra sono con CSS iniettato); `find-important-overrides.mjs` a 0; hover (`.card-wrapper`, `.cmp-card-simple`, `.cmp-card-latest-messages`, `.page-link`, `.list-item` della colonna laterale) con `compare-computed.mjs --hover` e `explain-style.mjs --state hover`; sentinelle (`/it` identica, `/it/tickets` invariata, homepage/eventi/evento-dettaglio invariate); dopo le modifiche condivise 1 e 2 rimisurare dettaglio a 992/768/375 e `a.show-more`.

## Differenze note
- `<a href="homepage.html">` del breadcrumb e' `/it/tests/homepage` (link funzionante); le card notizia mantengono `novita-dettaglio.html` come nel riferimento (pagina non replicata qui, fixture).
- In `servizi-categoria` il link "Servizi" del breadcrumb punta a `/it/tests/servizi` (nel riferimento e' `#`).
- Il `label for="radio-4"` del quinto radio del rating (errore del riferimento) non e' replicato: partial condiviso.
- L'autocompletamento (`data-bs-autocomplete="[]"`) e "Carica altri risultati" sono markup senza comportamento, come nel riferimento (lista vuota, nessun cambiamento nel DOM dopo il clic).

## Trappole incontrate (da ricordare)
- Lo scratchpad di sessione e' **condiviso tra gli agenti**: un altro agente ha sovrascritto il mio `tokdiff.mjs` (stesso nome). Usare una sottocartella per story (`dcp22/`) e nomi con prefisso; copiare subito i backup nella sottocartella.
- Lo scheletro del riferimento che collassa i figli uguali nasconde il contenuto del secondo `div.container`: collassare solo sottoalberi con firma identica (tag, classi, figli).
- `hr.d-none.d-lg-block.mt-2` del dettaglio sta **dentro `div.row.justify-content-center`** (larghezza 1320, non 1296) e, essendo un elemento flex, il suo margine non collassa: messo nel container errava di 16 px su tutta la pagina (altezze 5797 contro 5813, pixel 94,9%).
- `@class([...])` con una stringa vuota o senza condizioni vere emette `class=""` o uno spazio finale: i token HTML differiscono dal riferimento. Usare chiavi condizionali e comporre la stringa a mano quando serve un attributo assente.

## Come si controlla
```bash
for s in lista-categorie lista-risorse-categorie lista-risorse servizi servizi-categoria servizio-dettaglio; do
  bashscripts/tools/visual/parity-gate.sh https://italia.github.io/design-comuni-pagine-statiche/sito/$s.html \
    http://192.168.1.40:8000/it/tests/$s --stub-images 'picsum\.photos|via\.placeholder\.com' --fail-if-contains '|---LINE:'
done
```

## RISULTATO CON IL GATE REALE (orchestratore, 2026-10-13, dopo la rigenerazione del CSS: `parity-sweep.sh`)
CSS rigenerato da 38 pagine (`regenerate-design-comuni-css.sh`, ora parallelo: ~4,5 minuti) e tema ricompilato; misura con `parity-gate.sh --stub-images 'picsum\.photos|via\.placeholder\.com'`.
| Pagina | HTML rigorosa | HTML URL normalizzati | Pixel a 1920 / 1440 / 992 / 768 / 375 (altezze identiche) |
|---|---:|---:|---|
| `lista-categorie` | 89.39% | 97.98% | 99.92% / 99.89% / 99.85% / 99.84% / 99.78% |
| `lista-risorse-categorie` | 90.98% | 98.45% | 99.95% / 99.94% / 99.93% / 99.91% / 99.89% |
| `lista-risorse` | 89.15% | 98.12% | 99.93% / 99.91% / 99.88% / 99.87% / 99.83% |
| `servizi` | 90.81% | 98.24% | 99.94% / 99.92% / 99.89% / 99.89% / 99.83% |
| `servizi-categoria` | 89.71% | 98.07% | 99.94% / 99.92% / 99.89% / 99.86% / 99.79% |
| `servizio-dettaglio` | 90.73% | 98.44% | 99.91% / 99.88% / 99.78% / 99.81% / 99.66% |

Lettura: pixel >= 97% a tutte le larghezze con altezze identiche; l'HTML rigoroso resta tra 86% e 91% per i soli valori di `href`/`src` (percorsi relativi nel riferimento, URL assoluti da noi) e per il chrome condiviso; con gli URL normalizzati e' >= 97,5% ovunque.
Modifiche condivise richieste dall'agente e applicate dall'orchestratore: vedi la story DCP-19 (carosello `carousel-4-card`, fallback `href="#id"` del collapse, `col_class` del rating, `.saveBtn`, `.radio-card`, `focus--mouse` sulle modali, validazione form, layout `design-comuni-bare` per il catalogo, selettori del menu mobile).
