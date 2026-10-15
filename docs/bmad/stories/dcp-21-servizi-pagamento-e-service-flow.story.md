---
id: dcp-21
title: "DCP-21: servizi-pagamento (7 pagine) e scheletro generico service-flow per le famiglie servizi/"
type: story
epic: dc-parity-v2
status: done
priority: P1
owner: theme:Sixteen
created: 2026-10-13
updated: 2026-10-13
qmd: "design comuni parity servizi pagamento service-flow scheda servizio area personale wizard stepper riepilogo conferma blocco generico json bmad story"
tags: [docs, sixteen, bmad]
---

# DCP-21: servizi-pagamento e scheletro `service-flow`

## Richiesta
Replicare le 7 pagine `servizi/servizi-pagamento-{scheda-servizio, area-personale, dati-personali, dati-specifici, pagamento, riepilogo, conferma}.html`
come `/it/tests/servizi-pagamento-<X>` guidate da JSON. Prima famiglia `servizi/` della fase 1 (DCP-19): progetta lo scheletro **generico** `blocks/service-flow/`
che graduatoria, imu, multa, permessi, vantaggi riusano scrivendo solo JSON.

## Baseline (misurata prima di toccare nulla)
Le pagine rispondevano HTTP 200 vuote (solo chrome, nessun JSON). HTML body 38,91% (scheda-servizio) e 69,61% (pagamento). Pixel di pagamento: 11,43 / 12,02 / 12,77 / 10,24 / 26,33%
a 1920 / 1440 / 992 / 768 / 375 px, altezze 2308 contro 997.

## Cosa e' stato fatto
1. **Confronto fra famiglie** (prima di scrivere il blocco): scaricate le 46 pagine `servizi/` e confrontate le classi `cmp-*` e le strutture di permessi-*, vantaggi-*, graduatoria-*, imu-*, multa-*
   con le mie 7. Le classi usate dalle altre famiglie sono le stesse; mancano solo `cmp-toggle`, `cmp-info-checkbox`, `cmp-ul-list`, `cmp-tot` (IMU, graduatoria). Cambiano i dati, il numero di sezioni e qualche utilita'
   di spaziatura (es. `row justify-content-center mb-40 mb-lg-80` e `col-12 col-lg-10 pb-2` nel titolo di permessi-scheda-servizio): per questo le classi di contenitore sono chiavi del JSON con default.
2. **Blocco** `components/blocks/service-flow/` (1 ingresso, 5 tipi di pagina, 14 parti condivise, 11 tipi di sezione, 5 tipi di contenuto di scheda, 4 tipi di finestra): vedi "Modello dati".
3. **JSON** `tests.servizi-pagamento-<X>.json` (7 file, tenant e modulo), estratti dal riferimento con uno script (jsdom) e controllati con i conteggi; un solo blocco `service-flow` per pagina.
4. Immagini nuove in `public/design-comuni/assets/images/`: `pagopa.svg`, `folder-incomplete.svg`, `folder-to-pay.svg` (le altre `folder-*` c'erano gia', identiche al riferimento).
5. Pagine aggiunte a `scripts/design-comuni-pages.txt` (7 righe) e 9 stati a `design-comuni-states.txt` (tab, finestre modali, pulsante Avanti, accordion, "Vedi altri").

## Risultato (misurato con `bashscripts/tools/visual/parity-gate.sh --stub-images 'picsum\.photos|via\.placeholder\.com' --fail-if-contains '|---LINE:'`, dopo la rigenerazione di `components.css` (file modificato alle 11:56, contiene le regole delle mie pagine, es. `card-summary-grey`, `cmp-warning-box`, `cmp-upload`))
Pixel a 1920 / 1440 / 992 / 768 / 375 px, **altezze identiche** in tutte le 35 misure; HTML body rigorosa (valori degli URL inclusi) e con URL normalizzati.

| Pagina | HTML rigorosa | URL normalizzati | solo `<main>` (rig. / norm.) | 1920 | 1440 | 992 | 768 | 375 | Altezze (1440) |
|---|---|---|---|---|---|---|---|---|---|
| scheda-servizio | 90,30% | 98,25% | 95,17 / 99,24 | 99,88 | 99,88 | 99,77 | 99,82 | 99,68 | 4791 |
| area-personale | 87,75% | 96,04% | 93,89 / 99,85 | 99,74 | 99,66 | 99,51 | 99,80 | 99,67 | 2854 |
| dati-personali | 91,20% | 98,74% | 95,22 / 99,73 | 99,91 | 99,89 | 99,84 | 99,88 | 99,79 | 4477 |
| dati-specifici | 88,64% | 98,00% | 95,81 / 99,61 | 99,86 | 99,81 | 99,73 | 99,86 | 99,78 | 3880 |
| pagamento | 86,00% | 97,76% | 93,03 / 98,97 | 99,91 | 99,87 | 99,82 | 99,76 | 99,64 | 2308 |
| riepilogo | 90,56% | 98,35% | 97,30 / 99,75 | 99,96 | 99,95 | 99,92 | 99,90 | 99,82 | 5704 |
| conferma | 88,52% | 97,86% | 95,45 / 99,23 | 99,86 | 99,82 | 99,73 | 99,78 | 99,67 | 2629 |

**Pixel: tutte sopra 99,5%.** **HTML rigorosa: 3 pagine su 7 sopra il 90%** (scheda-servizio, dati-personali, riepilogo). Le altre 4 (86-88,6%) restano sotto per i valori di `href`/`src` e per il chrome condiviso, non per la struttura:
- con gli URL normalizzati sono tutte >= 96,04% (>= 97,76% senza area-personale);
- la colonna "solo `<main>`" (misura mia, stesso algoritmo di `compare-body-html`, ristretta al blocco) e' >= 93,03% rigorosa e >= 98,97% normalizzata;
- i token mancanti fuori dal blocco sono header, footer e `<link>` condivisi: nel riferimento gli sprite sono `../assets/bootstrap-italia/dist/svg/sprites.svg#it-x` e i link `#`/`../sito/*.html`, da noi URL assoluti e route reali (es. `pagamento`: 1010 token in tutto, 195 nel `<main>`: il resto e' header, footer e `<link>` condivisi);
- il blocco perde solo i `<use href>`/`<img src>` (sprite e immagini assolute) e `href="homepage.html"` -> `/it/tests/homepage`. Non e' stato "risolto" con trucchi sui dati.
- area-personale in piu': nel riferimento l'header e' lo stato **loggato** (pulsante utente "Mario Rossi" con menu "I miei servizi / Le mie pratiche / Notifiche / Impostazioni / Esci", ~60 token) contro il pulsante "Accedi all'area personale" del nostro header condiviso.

Comportamenti, pagina intera (`compare-screenshots.mjs --selector body --click ...`):
| Comportamento | 1440 | 375 |
|---|---|---|
| scheda: menu Condividi / Vedi azioni | 99,84 / 99,84 | - |
| scheda: rating (4 stelle) | 99,66 | 99,58 |
| scheda: "Vedi altri 2" (carosello correlati) | 99,64 | - |
| scheda: indice -> Costi / indice chiuso | 99,75 / 99,84 | - |
| area personale: scheda "Servizi"(tab 3) | 99,68 | - |
| area personale: tab 3 + pratica aperta | 98,42 | 99,71 |
| area personale: finestra messaggio | 99,79 | 99,69 |
| dati-personali: "Mostra tutto" richiedente | 99,92 | 99,83 |
| dati-personali: finestra documenti / Avanti (finestra salva) | 99,79 / 99,89 | - |
| dati-specifici: radio scelto | 99,71 | - |
| riepilogo: finestra termini | 99,99 | 99,95 |
| conferma: rating (2 stelle) | 99,68 | - |
Il carosello dei correlati a 4 card e' montato dalle opzioni `carousel-4-card` ora presenti in `resources/js/theme/design-comuni-home.js`; prima di quelle (Splide non montato) la scheda scendeva a 97,38 / 97,18 / 96,38% a 992 / 768 / 375 px.
Prima di rigenerare il CSS ho misurato con il CSS estratto in locale e iniettato nel solo lato locale (`extract-used-css` sulle 7 pagine, copia di `compare-screenshots` fuori dal repo): stessi valori (es. pagamento 99,91 / 99,87 / 99,82 / 99,76 / 99,64) poi confermati dal gate reale.
Sentinelle: `/it`, `/it/tests/accesso-servizio`, `/it/tests/homepage` rispondono 200; non ho toccato file condivisi (partial `dc-*`, layout, CSS, JS), quindi non attesi cambiamenti.

## Differenze note e aperte
- **Header "loggato" in area-personale** (sopra): serve una variante dello stato nel JSON dell'header condiviso, scelta per pagina. Costa ~3 punti di HTML su quella pagina e un tratto di pixel nell'header (la pagina e' comunque 99,5%+).
- Header: nel riferimento la voce "Servizi" e' `active` e il brand ha `title="Vai alla homepage"` (gia' noto da DCP-14): dipende dalla pagina, JSON condiviso.
- Non replicati: `onclick="listenElements(...)"` della voce "Ascolta" (come DCP-17), le piccole incoerenze del riferimento (`for="radio-4"` sul quinto radio del rating, `aria-hidden` mancante sull'icona della prima card dei correlati,
  ordine degli attributi `<a class href>` nel link "Contattaci" di dati-personali).
- I pulsanti dei passi (`Avanti`, `Salva`, `Indietro`) sono markup: la navigazione tra i 7 slug e il salvataggio non sono implementati (il riferimento e' statico). I link `#` restano `#` come nel riferimento.
- Il modello non copre ancora i tipi nominati sotto "Non ancora previsto" (IMU, graduatoria).

## Modifiche condivise richieste (non fatte: fuori dalla mia proprieta')
1. **Header loggato** (`sections/header` o il suo JSON): variante con utente "Mario Rossi" per `servizi-pagamento-area-personale` (e le altre `*-area-personale`: permessi, vantaggi, imu, multa, graduatoria).
2. **Voce "Servizi" attiva** nel header per le pagine `servizi/*` (vedi DCP-14).
3. Nessun'altra: tab (`data-bs-toggle="tab"`), carosello `carousel-4-card`, accordion, dropdown e finestre modali funzionano gia' con i controller del tema (misure sopra).

## Modello dati del service-flow (per le famiglie successive: scrivere solo JSON)
Pagina = `tests.<slug>.json` con **un** blocco: `{"type": "service-flow", "data": {"view": "pub_theme::components.blocks.service-flow.design-comuni", "kind": "...", ...}}`.
Copiare uno dei 7 JSON di `servizi-pagamento-*` come punto di partenza: contengono tutti i default espliciti (anche le classi) cosi' l'HTML coincide col riferimento.

### Chiavi comuni (tutte opzionali tranne `kind` e `breadcrumb`)
| Chiave | Forma |
|---|---|
| `kind` | `service-sheet` \| `personal-area` \| `wizard-step` \| `confirmation` \| `payment` (sceglie `pages/<kind>.blade.php`) |
| `breadcrumb` | `{items:[{label,url}], current}` |
| `heading` | `{title, title_element?, icon?{name,class}, subtitles?[{text,class?,link?{label,url,class?}}], chips?[{label,element?}], buttons?[{label,class,icon?}], actions?[{id,aria_label,icon,label,items[{label,icon,url}]}], rule?, row?, col?}` |
| `stepper` | `{items:[{label,state: confirmed\|active\|""}], confirmed_label, active_label, index}` (solo `wizard-step`; assente = nessuno stepper) |
| `side_nav` | `{title, aria_label, items:[{label,anchor}], class?, suffix?}` indice laterale con scroll-spy; `class` = classi della colonna, `suffix` = id dell'accordion (default `one`) |
| `sections` | elenco di sezioni (sotto) |
| `nav` | `{aria_label, back, save?{long,short}, next{label,icon?,class?,modal?}, saved_message}` pulsanti del passo (solo `wizard-step`) |
| `feedback` | come il partial `dc-rating` (`title, legend, star_label ("... %d ..."), thanks, positive/negative{question,answers[]}, detail{question,label,help}, back, next`) + `col_class` (default `col-12 col-lg-6 p-lg-0 px-4`) |
| `related` | `{title, cards:[{icon,title,links:[testo], more?{label,items:[testo]}}]}` carosello dei contenuti correlati (solo `service-sheet`, dentro la fascia contatti) |
| `contacts` | `{layout: offset\|center, col?, main{title,items:[{icon,label,url,element?}]}, problems?{...}}`; `offset` = `col-lg-6 offset-lg-3`, `center` = riga centrata con `col` (es. `col-12 col-lg-5`) |
| `modals` | elenco di finestre nascoste (sotto) |

`text` dei paragrafi, dei sottotitoli e dei campi `rich` accetta due soli segni: `**grassetto**` e `\n` (a capo `<br>`); il testo e' sempre escapato prima (nessun HTML nel JSON).

### Tipi di pagina (`kind`) e chiavi specifiche
- `service-sheet` (scheda servizio): breadcrumb in un container, titolo con `actions` a due colonne, `heading.rule` (linea nella riga), `body.row`, `side_nav` + `sections`, `feedback`, `related`+`contacts`.
- `personal-area`: `heading`, `tabs {id, items:[{label,icon,target,aria_controls,active?}]}`, `panes:[{id,active?,side_nav?,col_class?,sections?}]` (un pannello per scheda, anche vuoto), `contacts`, `modals`.
- `wizard-step`: `heading`, `stepper`, `body {layout: sidebar\|centered, steps_content: outer\|inner\|none, col?, sections_container?, before?[sezioni]}`, `side_nav` (se `sidebar`), `sections`, `nav`, `contacts`, `modals`.
  `steps_content` = dove sta `.steppers-content` nel riferimento (attorno alla riga con l'indice, dentro la colonna, assente); `before` = sezioni prima del contenitore (es. `warning-box`).
- `confirmation` (richiesta inviata): `heading` con `icon`, `subtitles`, `buttons`, `rule` (fuori dalla colonna), `side_nav`, `sections`, `feedback`, `contacts`.
- `payment` (pagamento): `heading` + `rule`, `sections` (`summary`, `cta`), `contacts`. Colonna `col-12 col-lg-10 offset-lg-1`.

### Tipi di sezione (`sections[].type` = file in `sections/`)
- `flow` (testo, cornice semplice): `{id, class, title, title_class?, items:[{type: paragraph\|list\|button\|attachment, ...}]}`; `paragraph {text,class?}`, `list {items:[testo]}`, `button {label,class}`, `attachment {label,aria,title,url}`.
- `timeline` (tempi e scadenze): `{id, class, title, entries:[{year,day,month,label}], footer?{class?,link{label,url},text}}`.
- `service-contacts`: `{id, title, office{name,url,lines[],email,email_aria,image{src,alt}}, topics{label,items[]}, updated}`.
- `icon-list`: `{id, title, title_class?, items:[{label,icon,url,class?}]}` (servizi correlati).
- `cta`: `{class, buttons:[{label,class,image?{file,alt}}], link?{label,url}}` (`cmp-text-button`).
- `summary`: riepilogo a gruppi `{class?, bare?, heading?{text,class?}, wrapper_class, card_class, header_class, title?, title_tag?, title_class?, groups:[gruppo], total?}`.
- `card`: scheda grigia `{id, tag?, class, wrapper_class, card_class, header_class, title, title_class, subtitle?, subtitle_class?, content{kind,...}}`; `content.kind` = file in `card-content/`:
  `select {class,id,label,placeholder,required,options[]}`, `radios {name,required,options[]}`, `info-cards {radio_name?, cards:[{id,title,info{label,value},toggle_label,collapse_id,collapse_class,button_class,header_id?,groups[]}], add?{label,icon}}`,
  `messages {category_label,modal,more,items:[{date,title,text}]}`, `activities {icon,more,items:[{date,title}]}`.
- `filtered-accordion` (elenco filtrabile): `{id, class, title, filter{label}, sort{id,label,items[]}, search{id,name,label,placeholder}, attachment_class, more, items:[{n,title,date,status{label,class,image,alt},details[{label,value}],link,chips[],attachments[{label,aria,class?}],button?}]}`.
- `warning-box` `{icon,icon_xlink,title,text,links[{label,url}]}`, `callout` `{class,icon,title,text,text_block?}`, `note` `{class,text}`.
- **Gruppo di dati** (`summary.groups[]`, `info-cards.cards[].groups[]`): `{class, header_class, title?, edit?{label,url,hidden?}, inline?, rows:[{label,value?,id?,status?{tone,text,icon}}], footer_button?{label,icon,modal}}`. Una riga con `status` e senza `value` e' l'avviso (documento mancante); `inline` rende "Etichetta: **valore**" su una riga (pagamento).

### Finestre (`modals[].type` = file in `modals/`)
`message {id,close_label,date,title,subtitle,text,link}`, `upload {id,close_label,title,info,form_id,uploads[],cancel,save}`, `form {id,close_label,title,info,form_id,fields:[{id,label,hint}],uploads[],cancel,save}`,
`dialog {id,close_label,header{title,info,link?},success?{icon,message},footer?{buttons:[{label,variant: primary\|outline,target?}]}}`; `uploads[]` = `{label,label_class,files:[{state: success\|error,name,visually_hidden,remove_label}],input_id,link_label,info}`.

### Come si aggiunge un tipo nuovo
Una sezione nuova = un file `sections/<nome>.blade.php` (riceve `$section`); un contenuto di scheda nuovo = `card-content/<nome>.blade.php` (riceve `$content`); una finestra nuova = `modals/<nome>.blade.php` (riceve `$modal`).
Nessuno `@switch` condiviso da modificare: le famiglie parallele non si pestano i piedi. Un `type` sconosciuto non produce nulla (nessun errore).

### Cosa varia fra famiglie (verificato sulle altre cartelle `servizi/`) e dove si esprime
- Numero e titoli delle sezioni, voci del timeline, passi dello stepper, dati dei gruppi: solo JSON.
- Spaziature dei contenitori (`heading.row/col/rule`, `body.row`, `side_nav.class`, `body.col`, classi delle sezioni): chiavi del JSON con default.
- Persone/veicoli/conti (permessi, vantaggi): altre `info-cards`/`summary` con gli stessi gruppi.
- **Non ancora previsto** (si aggiunge come file nuovo quando serve): campi di testo/interruttori/checkbox/totale dell'IMU (`cmp-input`, `cmp-toggle`, `cmp-info-checkbox`, `cmp-tot`: `card-content/inputs`, `toggles`), elenco di allegati `cmp-ul-list` (graduatoria-messaggio),
  stato "accesso effettuato" del header (area personale).

## Come si controlla
```bash
for x in scheda-servizio area-personale dati-personali dati-specifici pagamento riepilogo conferma; do
  bashscripts/tools/visual/parity-gate.sh https://italia.github.io/design-comuni-pagine-statiche/servizi/servizi-pagamento-$x.html \
    http://192.168.1.40:8000/it/tests/servizi-pagamento-$x --stub-images 'picsum\.photos|via\.placeholder\.com' --fail-if-contains '|---LINE:'
done
```
Dopo un 500: `cd laravel && php artisan view:clear`. Trappola incontrata: in Blade `@endif` attaccato a una parola (`required@endif`) non e' riconosciuto (serve un carattere non alfanumerico prima della `@`); usare `{{ cond ? ' required' : '' }}`.
Trappola dell'ambiente: la cartella scratchpad della sessione e' condivisa fra gli agenti paralleli (un altro agente ha cancellato la mia `ref/`): usare una sottocartella con un nome proprio.

## Collegamenti
Ricetta `docs/prompts/design-comuni-page-recipe.md`; piano `dcp-19-piano-replica-tutte-le-pagine`; esempi dello stesso metodo: dcp-14 (appuntamento), dcp-17 (evento-dettaglio), dcp-18 (accesso-servizio).

## Verifica dell'orchestratore (parity-sweep.sh, 2026-10-13, CSS rigenerata con le 44 pagine)
Rimisurato da me con lo sweep reale, non dai numeri dell'agente: coincidono. Pixel minimo / HTML rigorosa / URL normalizzati / altezze:
area-personale 99,5 / 87,75 / 96,04; conferma 99,67 / 88,52 / 97,86; dati-personali 99,79 / 91,2 / 98,74; dati-specifici 99,73 / 88,64 / 98; pagamento 99,64 / 86 / 97,76; riepilogo 99,82 / 90,56 / 98,35; scheda-servizio 99,68 / 90,3 / 98,25. Altezze uguali su tutte. Stato: done con riserva, come DCP-23: HTML rigoroso >= 90 su 3 pagine su 7 (il resto per valori di URL e, in area-personale, per l'header autenticato non replicato).


## Estensioni del modello dati dopo il consolidamento (DCP-100)
<!-- ancora: dcp-100-modello-dati -->
Le varianti `imu-*`, `multa-*`, `permessi-*`, `vantaggi-*`, `graduatoria-*` sono state assorbite nei file condivisi (story `2026-10-13-dcp-100-service-flow-consolidamento-varianti`).
Tutte le chiavi sotto sono **opzionali**: assenti, il rendering e' quello descritto sopra. Un solo ingresso per tutte le famiglie: `pub_theme::components.blocks.service-flow.design-comuni` (il `kind` sceglie `pages/<kind>`; un `kind` sconosciuto non produce nulla).

| Dove | Chiave nuova | Effetto |
|---|---|---|
| `heading` | `title_class` | classi dell'`h1` senza icona (default `title-xxxlarge`) |
| `heading.subtitles[]` | `segments[]` | al posto di `text`: stringhe, `{span: classi, text}`, `{br: classi}`, `{strong: testo}` (parts/multa-inline) |
| `heading.subtitles[]` | `span {text, class}` | testo in coda al sottotitolo, prima del link |
| `heading.subtitles[].link` | `class_first` | `true` = attributo `class` prima di `href` |
| `sections[]` tipo `title` | `{tag h2\|h3\|h4, class, text}` | titolo isolato fuori dalle schede (sostituisce `graduatoria-heading`, `imu-title`, `vantaggi-heading`) |
| `flow` | `items[].type = heading {text, class}` | `h3` di sezione (default `mb-3 subtitle-medium`) |
| `flow` | `list.class`, `items[].type = nested-list` | classi dell'elenco; elenco con voci `{text, items[]}` annidate |
| `flow` | `attachment.class` | classi del link dell'allegato (default `list-item icon-left d-inline-block`) |
| `timeline` | `bare`, `intro`, `entries[].info`, `entries[].info_class` | senza `<section>`; paragrafo introduttivo; riga di dettaglio sotto il titolo della voce |
| `service-contacts` | `office.card_class`, `title_class`, `name_class`, `name_element`, `email_href`, `email_plain`, `text_wrap` | classi della scheda e del titolo; classi/`data-element` del link del nome (`""` = `class=""` / assente); indirizzo del `mailto`; `true` = link email senza `class` ne' `title`; `true` = paragrafo in `div.card-text` |
| `summary` | `id`, `heading.tag`, `heading.id`, `title_id`, `total_class`, `total` come `{label, value, class, value_class}` | id del contenitore; tag/id del titolo esterno; id del titolo della scheda; classi del totale testuale (default `title-large-semi-bold card-white mb-0`); totale con valore su due spazi |
| `filtered-accordion` | `accordion_id`, `items[].status.image_class`, `attachments[].aria` facoltativo | id dell'accordion; classi dell'icona (default `icon-folder`); senza `aria` nessun `aria-label` |
| `card` | `tag: none`, `plain`, `heading {tag, class, text}`, `title_tag`, `header_content {kind,...}` | nessun involucro; involucro senza `class`/`id`; titolo prima della scheda; `h2`/`h3`; contenuto nell'intestazione |
| `info-summary` (gruppo) | `no_header`, `edit.tight`, `last_row_class`, `footer_class`, `rows[].class` | senza testata; niente spazio fra `<a>` e testo; classe del valore sull'ultima riga; classi del piede (default `card-footer p-0`); classi del contenitore del valore (default `border-light`) |
| `info-summary` (riga) | `status.tone` | `alert` = avviso (anche con `value`), `success` = esito (anche senza `value`); senza `tone`: `alert` se manca `value`, `success` altrimenti |
| `info-cards` | `legend`, `empty {id, class, text_class, text}`, `add.modal`, `cards[].expanded` | fieldset con legenda nascosta; riquadro "nessun dato"; il pulsante "aggiungi" apre una finestra; `aria-expanded="true"` |
| `radios` | `legend` | racchiude il gruppo in un fieldset |
| `checkboxes` (nuovo contenuto di scheda) | `class`, `options[] {id, name, value, label}` | caselle di scelta multipla (`name`/`value` = `id` se mancano) |
| `confirmation` | `after_heading {class, text, link {label, url, class}, link_first}`; `sections` facoltative | paragrafo sotto il titolo; senza `sections` niente linea, indice e corpo |
| `payment` | `heading.row`, `heading.col`, `body.row`, `body.col` | classi di righe e colonne |
| `wizard-step` | `stepper_note {class, text}`, `body.lead {col_class, class, text}`, `body.form`, `body.row`, `body.steps_class`, `body.steps_content: split`, `heading.row`, `heading.rule` | nota sotto lo stepper; colonna con paragrafo prima del corpo; `<form>` attorno a sezioni e pulsanti; classi della riga del corpo; classi aggiunte a `.steppers-content`; il container si chiude dopo lo stepper e se ne apre un altro; riga del titolo; linea dentro la riga |
| `nav` | `next.submit` | pulsante `type="submit"` con `data-bs-validate="validate"` |

Con `wizard-step` un passo senza stepper ne' pulsanti diventa una "pagina documento" (`body.layout: centered`, `body.sections_container: false`, nessun `nav`).
