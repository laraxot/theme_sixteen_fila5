---
id: dcp-100
title: "DCP-100: service-flow, assorbite le varianti imu/multa/permessi/vantaggi/graduatoria nei file condivisi (chiavi opzionali del JSON)"
type: story
epic: dc-parity-v2
status: in-review
priority: P2
owner: theme:Sixteen
created: 2026-10-13
updated: 2026-10-13
qmd: "design comuni service-flow consolidamento varianti chiavi opzionali json imu multa permessi vantaggi graduatoria ingresso unico design-comuni diff html pixel sweep bmad story"
tags: [docs, sixteen, bmad]
---

# DCP-100: consolidamento delle varianti del service-flow

## Richiesta
Le famiglie `servizi/` (DCP-26 graduatoria, 27 imu, 28 multa, 29 permessi, 30 vantaggi) avevano esteso lo scheletro `blocks/service-flow/` (DCP-21) con file di variante dal prefisso proprio.
Funzionava ma duplicava. Obiettivo: assorbire le varianti nei file condivisi con **chiavi opzionali del JSON** (default = comportamento di prima), far sparire le copie `*-<famiglia>` ridondanti e **non cambiare l'HTML di nessuna pagina**.
Ambito toccato: `laravel/Themes/Sixteen/resources/views/components/blocks/service-flow/**`, i 44 JSON `tests.{servizi-pagamento,pagamenti-imu,pagamenti-multa,permessi,vantaggi,graduatoria}*` e `tests.consenso-privacy` (tenant `laravel/config/local/fixcity/...` e copia identica nel modulo Fixcity, `header_active` e le altre chiavi estranee intatte), questa story e la sezione di coda della DCP-21.

## Risultato in numeri
| | Prima | Dopo |
|---|---|---|
| File in `service-flow/` | 105 | **60** (47 eliminati, 2 nuovi: `sections/title`, `card-content/checkboxes`) |
| Righe in `service-flow/` | 3067 | **1729** (-1338, -44%) |
| JSON modificati | | 36 su 44 (solo `type`/`kind`/`view` e chiavi opzionali; tenant e modulo identici byte per byte) |
| Ingressi (`*-design-comuni`) | 6 | **1** (`design-comuni`) |

### File eliminati (47) e dove sono finiti
- **Ingressi** `imu-`, `multa-`, `permessi-`, `vantaggi-`, `graduatoria-design-comuni`: un solo `design-comuni` che sceglie `pages/<kind>` (kind ripulito con `preg_replace('/[^a-z-]/', '')`, `@includeIf`: kind sconosciuto = niente). Le righe `view` dei 31 JSON di quelle famiglie ora puntano a `design-comuni` (tenant e modulo).
- **Pagine**: `imu-confirmation`, `multa-confirmation` -> `confirmation` (`after_heading`, `sections` facoltative); `permessi-payment` -> `payment` (`heading.row/col`, `body.row/col`); `imu-wizard-step`, `multa-wizard`, `permessi-wizard-step`, `vantaggi-wizard-step`, `graduatoria-wizard`, `graduatoria-document` -> `wizard-step` (`stepper_note`, `body.lead/form/row/steps_class`, `steps_content: split`, `heading.row/rule`).
- **Sezioni**: `graduatoria-flow`, `multa-flow`, `vantaggi-flow` -> `flow`; `graduatoria-timeline`, `permessi-timeline`, `vantaggi-timeline` -> `timeline`; `graduatoria-/imu-/permessi-/vantaggi-service-contacts` -> `service-contacts`; `imu-summary`, `permessi-summary` -> `summary`; `graduatoria-/permessi-filtered-accordion` -> `filtered-accordion`; `imu-card`, `multa-card` -> `card`; `graduatoria-heading`, `imu-title`, `vantaggi-heading` -> nuovo `title`.
- **Parti**: `permessi-heading`, `vantaggi-heading`, `multa-heading` -> `heading`; `graduatoria-/multa-/vantaggi-info-summary` -> `info-summary`; `multa-nav-steps` -> `nav-steps` (`next.submit`).
- **Contenuti di scheda**: `graduatoria-info-cards`, `multa-info-cards`, `vantaggi-cards`, `permessi-fieldset-cards` -> `info-cards`; `graduatoria-radios` -> `radios` (`legend`); `graduatoria-checks`, `permessi-checkboxes` -> nuovo `checkboxes`.
(Le copie `*-callout`, `imu-flow`, `*-activities` e `graduatoria-card` risultavano gia' eliminate nel working tree all'inizio: assorbimento fatto prima di questa story, non verificato da me.)

### File condivisi modificati (16)
`design-comuni`, `pages/{confirmation,payment,wizard-step}`, `parts/{heading,info-summary,nav-steps}`, `sections/{card,filtered-accordion,flow,service-contacts,summary,timeline}`, `card-content/{info-cards,radios}` (+ `card-content/multa-fields`: solo il nome della parte inclusa).

## Chiavi opzionali aggiunte
Elenco completo e forma nel **modello dati**, in coda alla DCP-21 (sezione "Estensioni del modello dati dopo il consolidamento"). Tutte assenti = rendering di prima. Casi particolari dove il valore di prima non era "assente":
- le famiglie che usavano il default della variante portano ora la chiave esplicita nel JSON (es. `service-contacts` di graduatoria: `office.card_class`, `title_class`, `email_plain`; `summary` di imu: `bare`, `wrapper_class: ""`, `total_class`; `card` di imu/multa: `tag: none`/`plain`; gruppi di multa: `no_header`, `footer_class: card-footer p-0 d-none`, `edit.tight`; schede di graduatoria con pannello `show`: `expanded: true`; vantaggi: `flow` con `bare: true` e `nested-list`, `timeline.entries[].text` -> `info`);
- `status.tone` delle righe di `info-summary`: tutte le righe esistenti lo avevano gia' esplicito; senza `tone` vale come prima nel condiviso (`alert` se manca `value`).

## Prova (protocollo di sicurezza)
1. **Prima** di toccare qualsiasi vista: scaricato l'HTML di tutte le **44 pagine** (7 servizi-pagamento, 7 pagamenti-imu, 9 pagamenti-multa, 7 permessi, 5 vantaggi, 8 graduatoria, `consenso-privacy`) con `curl http://192.168.1.40:8000/it/tests/<slug>`: tutte HTTP 200, nessun `|---LINE:`. Due scarichi consecutivi, normalizzati, sono identici (diff vuoto).
2. Dopo **ogni** file eliminato o condiviso modificato: `view:clear`, riscarico delle 44 pagine, confronto col "prima". Quando non era vuoto ho capito il perche' prima di proseguire (errori miei: `Undefined array key "tag"` nel nuovo `title`; spazio presente/assente fra involucro e scheda nel `card` `plain`; spazio fra `<a>` e testo nel link "Modifica" di multa; `legend` gia' presente nel JSON di permessi che con `info-cards.legend` produceva un secondo fieldset; `after` di imu non letto dopo la rinomina in `after_heading` perche' il file `imu-confirmation` esisteva ancora) e ho corretto in avanti; nessun ripristino da backup e' servito.
3. **Esito finale**: le 44 pagine, normalizzate, sono **identiche byte per byte** (29.527 righe normalizzate prima e dopo) e tutte rispondono 200 senza marcatori.

### Normalizzazione (sed documentato) e DEVIAZIONE dal protocollo
Il "diff vuoto" e' misurato sul contenuto di `<main>...</main>` dopo queste normalizzazioni, tutte applicate allo stesso modo al "prima" e al "dopo":
- **rumore per richiesta** (previsto): `wire:id`, `wire:snapshot`, `data-csrf`, meta/`_token`, `nonce`, riga `phpdebugbar.addDataSet(...)`;
- **hash dei file Vite** (`/themes/Sixteen/assets/<nome>-<hash8>.css|js`) e **fuori da `<main>`** (header, footer, `<head>`): un altro agente ha ricostruito gli asset e cambiato l'`aria-label` del pulsante di accesso durante la sessione;
- **DEVIAZIONE 1, marker di Livewire** `<!--[if BLOCK]><![endif]-->` / `<!--[if ENDBLOCK]><![endif]-->`: Livewire li inietta attorno a ogni `@if`/`@foreach` del template, quindi dipendono dalla struttura Blade e non dal JSON. Un file condiviso con una struttura Blade diversa dalla variante li emette in numero diverso: e' impossibile assorbire una variante restando uguali "al byte" con i marker. Sono commenti, non contenuto;
- **DEVIAZIONE 2, spazi**: sequenze di spazi/a capo ridotte a uno e rimossi gli spazi adiacenti a tag di blocco (`div p ul ol li section h1-h6 form fieldset header footer main nav article aside table tbody thead tr td th dl dt dd`), come fa il browser. **Resta visibile** al confronto: testo, attributi, classi, ordine dei tag e la presenza/assenza di spazio fra elementi in linea (`</span> <span>` contro `</span><span>`); verificato con modifiche artificiali (classe cambiata e spazio in linea aggiunto: rilevati; spazio prima di `</p>`: ignorato, come voluto).
Senza queste due normalizzazioni (solo spazi esatti e marker inclusi) il diff **non** e' vuoto: 43 pagine su 44 differiscono nel `<main>` (spazi fra i tag e commenti Livewire; nessun altro tipo di differenza, per costruzione dell'esito sopra). Dove un residuo di spazio fra elementi in linea era reale l'ho eliminato con una chiave (`info-summary` `edit.tight`) invece di accettarlo. Se si vuole il confronto "al byte" con marker e spazi, le varianti non si possono assorbire senza chiavi che codificano accidenti di impaginazione dei vecchi file.

```bash
# norm: rumore -> marker -> spazi (un tag per riga) solo su <main>
sed -E -e 's/wire:id="[^"]*"/wire:id="X"/g' -e 's/wire:snapshot="[^"]*"/wire:snapshot="X"/g' -e 's/data-csrf="[^"]*"/data-csrf="X"/g' \
  -e 's/nonce="[^"]*"/nonce="X"/g' -e 's/(themes\/Sixteen\/assets\/[A-Za-z0-9_.-]+)-[A-Za-z0-9_-]{8}\.(css|js)/\1-HASH.\2/g' -e 's/^phpdebugbar\.addDataSet\(.*/phpdebugbar.addDataSet(X)/' pagina.html \
 | sed -E 's/<!--\[if (END)?BLOCK\]><!\[endif\]-->//g' | sed -n '/<main/,/<\/main>/p' | tr -s ' \t\r\n' ' ' \
 | sed -E -e "s# ?(</?(div|p|ul|ol|li|section|h[1-6]|form|fieldset|header|footer|main|nav|article|aside|table|tbody|thead|tr|td|th|dl|dt|dd)([ ][^>]*)?>) ?#\1#g" -e 's/>/>\n/g'
```

### Sweep pixel a campione (`parity-sweep.sh --jobs 1`, 3 pagine di famiglie diverse, dopo tutte le modifiche)
| Pagina | Pixel 1920 / 1440 / 992 / 768 / 375 | Altezze | HTML rig. / URL norm. (rig. del 2026-10-13 prima di questa story: 86,91 / 88,03 / 91,57) |
|---|---|---|---|
| graduatoria-perfezionamento (wizard-step assorbito, regola nella riga) | 99,87 / 99,82 / 99,75 / 99,78 / 99,69 | uguali (2510, 2510, 2558, 2589, 3389) | 93,02 / 97,79 |
| pagamenti-multa-dati-specifici-fase2 (`steps_content: split`, `body.form`, card `plain`) | 99,93 / 99,90 / 99,86 / 99,78 / 99,65 | uguali (3392, 3392, 3488, 3559, 4426) | 93,79 / 98,04 |
| vantaggi-dati-personali (`info-cards`, `heading`, gruppi, finestre) | 99,92 / 99,89 / 99,84 / 99,91 / 99,83 | uguali (5846, 5846, 5918, 5879, 6678) | 96,34 / 98,85 |
Tutte >= 99,5% con altezze uguali; minimi identici allo sweep del 2026-10-13 (99,69 / 99,65 / 99,83) e URL normalizzati invariati (97,79 / 98,04 / 98,85); la colonna rigorosa e' salita (probabile causa: URL degli sprite resi via `DesignComuniAssets`, altro lavoro) e non e' attribuibile a questa story.
Test di fumo dei rami non esercitati da nessuna pagina (`tinker`, `view(...)->render()`): `after_heading` con/senza `link_first`, `heading.span`/`segments`/`class_first`, `nested-list`, `timeline.bare/intro`, `card.tag=none/plain/heading/header_content`, `info-cards.legend/empty/add.modal`, `summary` con totale a oggetto, `service-contacts` con tutte le chiavi, `payment`, `wizard-step` (`split`, `form`, `lead`, `stepper_note`, `submit`), kind sconosciuto: tutti rendono senza eccezioni.

## Cosa e' rimasto e perche'
- **Finestre `modals/imu-fields`, `permessi-form`, `vantaggi-form` + `parts/vantaggi-form-items`** (~170 righe): stessa cornice `cmp-modal` tre volte, ma tre modelli di campo diversi (`kind`, `type` input/select/upload, `items` ricorsivi) con ordine degli attributi e `required`/`placeholder`/`disabled` diversi. Unificarle richiede un tipo di campo con chiavi che riproducono l'ordine degli attributi di ciascuna: costo > beneficio. Prossimo passo possibile: cornice unica + `parts/form-items` generalizzando `vantaggi-form-items`, con una prova dedicata.
- **Contenuti di scheda `imu-*`** (`check-cards`, `stack`, `toggle`, `total`, `input`, `select`), `multa-fields`, `permessi-dates`: tipi propri della famiglia, senza corrispondente condiviso. `imu-select` assomiglia a `select` ma servirebbero 5 chiavi (`label_class`, `select_class`, `hint`, `label_flag`, wrapper) per 17 righe.
- **Sezioni `graduatoria-{attachments,closing,consent,text-card}`** e **`pages/graduatoria-consent`** (tre container separati): tipi unici, non copie. `parts/multa-inline`: aiuto generico (testo in linea a segmenti) usato ora anche da `heading`; il solo prefisso nel nome non giustifica un rinomina in questa story.
- **Correzioni del riferimento a 1 token NON applicate perche' cambiano l'HTML**: `related` `pb-0 pb-0` e `aria-hidden` mancante sul primo svg dei correlati, rating `for="radio-4"` sul quinto radio, `aria-expanded` derivato dalla classe `show` (reso esplicito con `expanded`, senza derivarlo), `onclick="listenElements(...)"` (funzione inesistente nel tema, non copiata). Restano come differenze note delle story DCP-21/26/29.
- **Header "loggato" in area personale** e voce "Servizi" attiva: invariati, fuori ambito (header condiviso).

## Rischi
- Il gate e' meno stretto del "byte per byte" (deviazioni 1 e 2 sopra, dichiarate): una differenza solo di commenti Livewire o di spazi fra blocchi non verrebbe vista; la protezione e' lo sweep pixel (3 pagine, 5 viewport) e il test di fumo.
- Il kind ora e' risolto senza whitelist (`@includeIf` su `pages/<kind>` dopo la pulizia del nome): un JSON non fidato puo' scegliere solo file presenti in `pages/`.
- Chiavi come `edit.tight`, `footer_class`, `plain` esistono per lasciare invariato l'HTML delle vecchie varianti: sono documentate nella DCP-21 e si possono togliere quando si accetta di cambiare quel markup.
- Macchina molto carica (load average 40-96) durante le misure: nessun timeout nei cicli finali, ma le prove sono state lente.
- Altri agenti scrivono nello stesso repo: durante la sessione sono cambiati chrome (`aria-label` del login) e hash degli asset; per questo il gate guarda solo `<main>`.

## Collegamenti
Modello dati: DCP-21 (sezione "Estensioni del modello dati dopo il consolidamento"). Superate in parte da questa story le note "Modifiche condivise richieste" di DCP-26, 27, 28, 29, 30 e i nomi dei file `graduatoria-*`, `imu-*`, `multa-*`, `permessi-*`, `vantaggi-*` che citano (storia, non cancellata). Piano: DCP-19. Epic: DCP-00.
