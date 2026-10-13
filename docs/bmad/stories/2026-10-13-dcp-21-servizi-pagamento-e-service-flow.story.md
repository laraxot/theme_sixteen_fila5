---
id: dcp-21
title: "DCP-21: servizi-pagamento (7 pagine) e scheletro generico service-flow per le famiglie servizi/"
type: story
epic: dc-parity-v2
status: in-review
priority: P1
owner: theme:Sixteen
created: 2026-10-13
updated: 2026-10-13
qmd: "design comuni parity servizi pagamento service-flow scheda servizio area personale wizard stepper riepilogo conferma blocco generico json bmad story"
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
2. **Blocco** `components/blocks/service-flow/` (1 ingresso, 5 tipi di pagina, parti condivise, 13 tipi di sezione, 4 tipi di finestra): vedi "Modello dati".
3. **JSON** `tests.servizi-pagamento-<X>.json` (7 file, tenant e modulo), estratti dal riferimento con uno script (jsdom) e controllati con i conteggi; un solo blocco `service-flow` per pagina.
4. Immagini nuove in `public/design-comuni/assets/images/`: `pagopa.svg`, `folder-incomplete.svg`, `folder-to-pay.svg` (le altre `folder-*` c'erano gia', identiche al riferimento).
5. Pagine aggiunte a `scripts/design-comuni-pages.txt` (7 righe) e 9 stati a `design-comuni-states.txt` (tab, finestre modali, pulsante Avanti, accordion, "Vedi altri").

## Risultato
(misure nella sezione "Misure" in fondo)

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
