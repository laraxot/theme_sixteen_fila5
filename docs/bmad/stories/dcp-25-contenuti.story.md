---
id: dcp-25
title: "DCP-25: amministrazione, argomenti, argomento, documenti-dati, domande-frequenti, mappa-sito"
type: story
epic: dc-parity-v2
status: done
priority: P1
owner: theme:Sixteen
created: 2026-10-13
updated: 2026-10-13
qmd: "design comuni parity amministrazione argomenti argomento documenti-dati domande-frequenti mappa-sito content-page content-topic content-sitemap bmad story"
tags: [docs, sixteen, bmad]
---

# DCP-25: pagine di contenuto (amministrazione, argomenti, argomento, documenti-dati, domande-frequenti, mappa-sito)

## Richiesta
Replicare come pagine di prova guidate da JSON sei pagine di `https://italia.github.io/design-comuni-pagine-statiche/sito/<slug>.html` (locale `/it/tests/<slug>`, JSON `tests.<slug>`): HTML body >= 90% (o forbice spiegata dai soli URL) e pixel >= 97% a 1920 / 1440 / 992 / 768 / 375 px con altezze identiche. Metodo: `docs/prompts/design-comuni-page-recipe.md`. Fase BMAD: implementazione + verifica (story nel tema owner, nessun nuovo modulo).

## Stato: in-progress
Markup e JSON fatti e misurati. Il CSS di queste pagine **non e' ancora tutto in `components.css`** (lo rigenera l'orchestratore, non lanciato qui): con il CSS compilato di oggi tre pagine sono sotto soglia pixel. Con il CSS estratto dal riferimento e iniettato nella sola pagina locale (file privato fuori dal repo) tutte e sei superano 99,79% con altezze identiche. Vedi "Verifiche da rifare dopo la rigenerazione".

## Baseline (misurata con `parity-gate.sh` prima di toccare nulla; solo 1920 e 1440, poi il locale e' cambiato)
| pagina | HTML rigorosa / normalizzata | pixel 1920 / 1440 | altezze rif-loc (1920) |
|---|---|---|---|
| amministrazione | 76,26 / 83,93 | 88,75 / 87,42 | 3120-3192 |
| argomenti | 41,51 / 45,52 | 37,76 / 31,60 | 4104-7141 |
| argomento | 45,38 / 50,90 | 7,26 / 7,87 | 4135-1045 (nessun JSON: `<main>` vuoto) |
| documenti-dati | 46,41 / 51,91 | 8,99 / 9,77 | 4090-1045 (blocchi senza vista: `<main>` vuoto) |
| domande-frequenti | HTTP 500 (blocco `faq/default` legacy) | | |
| mappa-sito | 60,77 / 66,36 | 42,55 / 42,63 | 4202-2558 |

Backup dei JSON preesistenti (stato all'avvio) fuori dal repo, nello scratchpad di sessione `dcp25/backup/`: tenant amministrazione, argomenti, documenti-dati, domande-frequenti, mappa-sito; modulo amministrazione, argomenti, domande-frequenti. `tests.argomento.json` non esisteva.

## Cosa e' stato fatto
1. **JSON** (identici in tenant `laravel/config/local/fixcity/database/content/pages/` e modulo `laravel/Modules/Fixcity/config/database/content/pages/`, verificato con `filecmp`): `tests.amministrazione`, `tests.argomenti`, `tests.argomento` (nuovo), `tests.documenti-dati`, `tests.domande-frequenti`, `tests.mappa-sito`; un blocco ciascuno, dati estratti dal DOM del riferimento con uno script (jsdom), conteggi controllati (3+7 card amministrazione; 3 in evidenza + 20 argomenti; 3 documenti in evidenza + 3 nei risultati + 10 categorie; 20 domande; 4 sezioni argomento; 74 voci della mappa). Nessun doppione di `slug` (controllo su entrambe le cartelle). I blocchi legacy (`faq/default`, `sitemap/default`, `administration/*`, `topics/*`) non sono toccati. `domande-frequenti.json` (senza `tests.`) non toccato; `tests.catalog.json` contiene solo voci di catalogo con quei nomi, non e' un doppione.
2. **Blocchi** (nessun testo cablato, nessun `x-data`, nessuno `<script>`/`<style>`/`!important`, markup del riferimento; verificato con grep):
   - `blocks/content-page/design-comuni.blade.php`: breadcrumb, hero di testo (`hero.shadow` = `row-shadow`), `sections[]` e i partial condivisi `dc-rating` (con `feedback.col_class` per la FAQ) e `dc-contacts`. `sections[].type` sceglie la vista in `sections/` (nuovo tipo = nuovo file): `cards-simple`, `grid-overlay`, `cards-document`, `search-list`, `search`, `accordion`; `sections[].style` = `grey` | `plain` | `bare`. Partial della cartella: `breadcrumb`, `search`, `document-card`.
   - `blocks/content-topic/design-comuni.blade.php` + `news-card` + `teaser-card`: hero con immagine e scheda sovrapposta, "gestito da", sezioni `news` e `teaser`.
   - `blocks/content-sitemap/design-comuni.blade.php` + `node.blade.php` (ricorsivo): albero `link-list` a profondita' libera, `emphasis` e `sublist_id` dal JSON (il riferimento ha `id=""` solo su alcune liste).
3. **Manifest** (solo append): `design-comuni-pages.txt` +6 righe (`sito/amministrazione.html`, `argomenti`, `argomento`, `documenti-dati`, `domande-frequenti`, `mappa-sito`). `design-comuni-states.txt`: **nessuna riga nuova**: gli stati che servono (accordion aperto, rating, radio) ci sono gia' e l'estrazione privata con il manifest attuale ha dato i risultati sotto, comprese le prove dopo clic. Nota: `scripts/` e' in `.gitignore` del tema (i manifest esistono su disco ma non risultano in `git status`).
4. Nessun file condiviso toccato (CSS, JS, partial, layout, sections, pagine Folio, immagini: le pagine usano solo sprite e picsum, nessuna immagine nuova da scaricare).

## Risultati misurati
### HTML body (`compare-body-html.mjs`, pagina intera)
| pagina | rigorosa | URL normalizzati | solo `<main>` rigorosa / normalizzata |
|---|---|---|---|
| amministrazione | 89,16 | 97,85 | 97,31 / 99,22 |
| argomenti | 90,55 | 98,41 | 97,86 / 99,46 |
| argomento | 90,73 | 98,44 | 97,95 / 99,48 |
| documenti-dati | 89,71 | 98,16 | 96,00 / 99,46 |
| domande-frequenti | 89,08 | 98,53 | 93,74 / 99,54 |
| mappa-sito | 90,44 | 98,38 | 99,66 / 99,66 |

Tre pagine (amministrazione, documenti-dati, domande-frequenti) hanno la rigorosa 0,3-0,9 punti sotto 90. Forbice spiegata (diff dei token con `tokdiff`, elenco per pagina): header e footer del layout (link reali `/amministrazione`, `/login`, `https://twitter.com` contro `*.html` e `#` del riferimento, url degli sprite assoluti contro `../assets/...`), gli sprite delle mie icone (`it-file`, `it-search`, `it-help-circle`...: assoluti contro relativi) e il link "Home" (`/it/tests/homepage` contro `homepage.html`, che localmente sarebbe rotto). Non-URL residui, tutti fuori dai miei file: wrapper `div.page-content` con `wire:snapshot`, `<style>:root{}</style>` e `<link>` di preload nel body, `style=""` sull'header, "WhatsApp" contro "Whatsapp" nel footer, `for="radio-5"` contro `radio-4` nel partial `dc-rating` (gia' noto da DCP-20). Dentro `<main>` la normalizzata e' >= 99,22.

Antenati di `.cmp-rating`, `.cmp-contacts` e `h1` identici al riferimento (a parte `div.page-content`) su tutte e sei: verificato con jsdom.

### Pixel con altezze (CSS del riferimento iniettato nella sola pagina locale)
CSS estratto con `extract-used-css.mjs` per le sole sei pagine (stesse opzioni e stati di `regenerate-design-comuni-css.sh`; 1362 regole su 13253) in un file privato fuori dal repo e iniettato con `addStyleTag` in una copia di `compare-screenshots.mjs`; `components.css` e build non toccati. Immagini picsum sostituite da PNG deterministico su entrambi i lati.

| pagina | 1920 | 1440 | 992 | 768 | 375 | altezze (1920 / 1440 / 992 / 768 / 375) |
|---|---|---|---|---|---|---|
| amministrazione | 99,92 | 99,90 | 99,86 | 99,85 | 99,79 | 3120 / 3120 / 3402 / 3772 / 5023 |
| argomenti | 99,94 | 99,91 | 99,88 | 99,87 | 99,83 | 4104 / 4104 / 4720 / 5229 / 7693 |
| argomento | 99,94 | 99,92 | 99,87 | 99,87 | 99,81 | 4135 / 4135 / 4407 / 5136 / 6706 |
| documenti-dati | 99,93 | 99,91 | 99,88 | 99,87 | 99,81 | 4090 / 4090 / 4798 / 5058 / 6824 |
| domande-frequenti | 99,94 | 99,92 | 99,89 | 99,85 | 99,79 | 3314 / 3314 / 3645 / 3382 / 4558 |
| mappa-sito | 100 | 100 | 100 | 100 | 100 | 4202 / 4202 / 4250 / 4363 / 5057 |

Altezze identiche in ogni misura (rif = loc).

### Pixel con il CSS compilato di oggi (`parity-gate.sh` reale, senza iniezione)
- amministrazione 99,92 / 99,90 / 99,86 / 99,85 / 99,79 (3120 / 3120 / 3402 / 3772 / 5023): gia' a posto (le regole stanno gia' in `components.css`).
- domande-frequenti 99,11 / 98,86 / 98,60 / 98,16 / 97,31: altezze 3314-3315 (1 px) a ogni larghezza.
- mappa-sito 96,16 / 95,64 / 94,90 / 94,40 / 97,97 (altezze 4202-4154, 4250-4202, 4363-4315; 375 uguale).
- argomenti 77,61 / 75,46 / 82,56 / 82,24 / 72,88 (4104-3940 ...), argomento 68,30 / 65,35 / 68,10 / 76,58 / 68,18 (4135-4333 ...), documenti-dati 90,60 / 89,27 / 84,72 / 87,46 / 85,25 (4090-4034 ...): mancano regole CSS (grep in `components.css` alle 11:23 UTC: 0 occorrenze di `it-grid-item-overlay`, `it-griditem-text-wrapper`, `it-hero-bottom-overlapping`, `link-sublist`; `categoryicon-top` 1 occorrenza contro 2 nel CSS estratto dal riferimento).

### Comportamenti (CSS iniettato; pagina intera; % con altezze rif-loc)
- Accordion FAQ: clic sulla 1a domanda 99,92 a 1440 (3514-3514) e 99,80 a 375 (4902-4902); 1a e 2a aperte insieme 99,93 a 1440 (3714-3714). `dom-diff-after-click` sul riferimento e sul locale: stesse classi (`show`, `collapsed` rimossa, `focus--mouse`). Il riferimento lascia `aria-expanded="true"` anche da chiuso e dopo il clic: replicato.
- Pulsanti "Invio" (`#button-3`) e "Carica altre domande": nel riferimento non fanno nulla oltre al focus del mouse (`dom-diff-after-click`); 99,92 e 99,91 a 1440.
- Rating (shared) dopo clic stella: FAQ 4 stelle 99,93 a 1440 e 99,81 a 375, 2 stelle 99,82 a 375 (5204); amministrazione 4 stelle 99,91 (3675); argomento 2 stelle 99,93 (4689).
- Documenti e dati, focus sul campo di ricerca: 99,91 a 1440, 99,81 a 375; clic su `#button-3`: 99,91.
- Stili calcolati a riposo e in hover (`compare-computed.mjs --hover`, CSS iniettato) su card semplici, card overlay, card documento, categoria, link teaser, pulsante `text-button`, accordion, pulsante outline, `#button-3`, campo di ricerca, voci della mappa: nessuna differenza tranne `scrollbar-color` e `tab-size` che sono globali del tema su ogni elemento (non delle pagine).

## Differenze note
1. HTML rigorosa < 90 su tre pagine: forbice descritta sopra (URL di header, footer e sprite; wrapper Volt). Nessun fix possibile nei miei file senza degradare i link (la Home) o rompere le icone (sprite relativi `../assets/`).
2. La ricerca di documenti-dati e quella della FAQ sono solo markup: nel riferimento l'autocomplete ha elenco vuoto (`data-bs-autocomplete="[]"`) e non filtra. Nessun JS aggiunto.
3. `aria-expanded="true"` sui pulsanti dell'accordion chiusi: come nel riferimento (parity), non e' una scelta di accessibilita'.

## Richieste condivise (NON fatte: fuori dai miei file)
Nessuna per queste sei pagine. Gia' segnalate altrove e valide anche qui: `dc-rating` rende `for="radio-5"` dove il riferimento ha `radio-4` (1 token per pagina); header/footer del layout con link reali invece di quelli del riferimento (influiscono sulla sola rigorosa).

## Verifiche da rifare dopo la rigenerazione
1. `parity-gate.sh` completo sulle sei pagine: atteso >= 99,7% con altezze identiche (la simulazione con CSS iniettato lo dice); HTML invariata (89-91 rigorosa, 97,8-98,5 normalizzata).
2. Stati dopo clic con il CSS rigenerato (accordion 1a domanda a 1440 e 375, rating, focus del campo di ricerca): ripetere le prove sopra senza iniezione.
3. Controllare in `components.css` le regole di `.it-grid-item-overlay`, `.it-griditem-text-wrapper`, `.it-hero-bottom-overlapping`, `.link-sublist` (oggi assenti, grep) e `.categoryicon-top` (parziale): sono la causa piu' probabile dei pixel sotto soglia senza iniezione; la prova e' che con il CSS del riferimento iniettato i numeri passano a 99,8+.

## Come si controlla
```bash
B=https://italia.github.io/design-comuni-pagine-statiche; L=http://192.168.1.40:8000/it/tests
for p in amministrazione argomenti argomento documenti-dati domande-frequenti mappa-sito; do
  bashscripts/tools/visual/parity-gate.sh $B/sito/$p.html $L/$p --stub-images 'picsum\.photos|via\.placeholder\.com' --fail-if-contains '|---LINE:'
done
bashscripts/tools/visual/dom-diff-after-click.mjs $B/sito/domande-frequenti.html 1440 'button[data-bs-target="#collapsefaq-1"]'
```

## RISULTATO CON IL GATE REALE (orchestratore, 2026-10-13, dopo la rigenerazione del CSS da 44 pagine: `parity-sweep.sh`)
| Pagina | HTML rigorosa | HTML URL normalizzati | Pixel a 1920 / 1440 / 992 / 768 / 375 (altezze identiche) |
|---|---:|---:|---|
| `amministrazione` | 89.16% | 97.85% | 99.92% / 99.9% / 99.86% / 99.85% / 99.79% |
| `argomenti` | 90.55% | 98.41% | 99.94% / 99.91% / 99.89% / 99.87% / 99.83% |
| `argomento` | 90.73% | 98.44% | 99.94% / 99.91% / 99.88% / 99.87% / 99.81% |
| `documenti-dati` | 89.71% | 98.16% | 99.93% / 99.9% / 99.88% / 99.87% / 99.81% |
| `domande-frequenti` | 89.08% | 98.53% | 99.93% / 99.92% / 99.89% / 99.85% / 99.79% |
| `mappa-sito` | 90.44% | 98.38% | 99.99% / 100% / 99.99% / 100% / 100% |
