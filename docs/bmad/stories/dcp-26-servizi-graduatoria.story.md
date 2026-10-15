---
id: dcp-26
title: "DCP-26: servizi graduatoria (scuola dell'infanzia) e consenso privacy sul service-flow"
type: story
epic: dc-parity-v2
status: done
priority: P1
owner: theme:Sixteen
created: 2026-10-13
updated: 2026-10-13
qmd: "design comuni parity graduatoria scuola infanzia consenso privacy service-flow wizard area personale messaggio perfezionamento riepilogo conferma bmad story"
tags: [docs, sixteen, bmad]
---

# DCP-26: servizi graduatoria e consenso privacy

## Richiesta
Replicare come pagine di prova guidate da JSON dieci pagine di `https://italia.github.io/design-comuni-pagine-statiche/servizi/` (locale `/it/tests/<nome>`, JSON `tests.<nome>`):
`graduatoria-{area-personale, conferma, dati-personali, dati-specifici, messaggio, pagamento, perfezionamento, riepilogo, scheda-servizio}` e `consenso-privacy`.
Obiettivo: HTML body >= 90% (o forbice spiegata dai soli valori di URL) e pixel >= 97% a 1920/1440/992/768/375 px con altezze identiche.
Si usa lo scheletro `blocks/service-flow/` (DCP-21) scrivendo soprattutto JSON; i tipi nuovi sono file nuovi con prefisso `graduatoria-` dentro `service-flow/`.

## Esito sulle dieci pagine
**`graduatoria-pagamento` non esiste nel riferimento**: `https://italia.github.io/design-comuni-pagine-statiche/servizi/graduatoria-pagamento.html` risponde HTTP 404 (verificato con curl; anche su
`raw.githubusercontent.com/italia/design-comuni-pagine-statiche/{main,master,gh-pages}/servizi/graduatoria-pagamento.html`: 404). L'indice del sito (`index.html`) elenca il link, ma il file non e' pubblicato.
Senza riferimento non c'e' nulla da replicare ne' da misurare: nessun JSON creato, nessuna riga nei manifest. Le altre nove pagine sono state fatte.

## Baseline
Per i nove slug non esisteva nessun JSON (grep su `laravel/config/local/fixcity/database/content/pages/` e `laravel/Modules/Fixcity/config/database/content/pages/`: zero file `tests.graduatoria-*` e `tests.consenso-*`).
Nessun backup necessario. Nessuna misura numerica di baseline: le pagine non avevano blocco e non e' stata lanciata una misura prima di scrivere i JSON.

## Cosa e' stato fatto
1. **Riuso massimo del service-flow (DCP-21)**: sei pagine su nove usano l'ingresso condiviso `service-flow/design-comuni` e i tipi di pagina condivisi
   (`service-sheet` = scheda-servizio, `personal-area` = area-personale, `wizard-step` = dati-personali, dati-specifici, riepilogo, `confirmation` = conferma). Tre pagine hanno uno scheletro diverso e
   usano l'ingresso nuovo `service-flow/graduatoria-design-comuni` (perfezionamento, messaggio, consenso-privacy).
2. **19 file nuovi, tutti con prefisso `graduatoria-` dentro `blocks/service-flow/`** (nessun file esistente di service-flow modificato; vedi "Estensioni del modello dati"). Nessun testo nelle viste, nessun `x-data`, nessuno stile, nessun HTML nel JSON.
3. **JSON** `tests.<nome>.json` x9, in tenant e modulo (identici, verificato con `cmp`). Estratti dal riferimento con uno script jsdom (derivato da quello di DCP-21), un blocco `service-flow` per pagina; conteggi controllati con il confronto dei token di `<main>`
   (vedi "Risultato"). Nessuno slug duplicato nelle due cartelle (grep).
4. Immagini: nessuna nuova (le `folder-*.svg` e i loghi servono gia' e non sono a 0 byte).
5. Manifest: 9 righe in coda a `scripts/design-comuni-pages.txt`; 6 righe in coda a `scripts/design-comuni-states.txt` (radio/checkbox delle preferenze, scheda persona selezionabile, finestra ISEE a 1440 e 375).
6. Strumenti privati (scratchpad di sessione, non nel repo): estrattore dei dati, confronto per token di `<main>`, estrazione del CSS delle nove pagine con `extract-used-css.mjs`, copia di `compare-screenshots.mjs` con `--inject-css`.

## Estensioni del modello dati (per le famiglie successive)
Ingresso `pub_theme::components.blocks.service-flow.graduatoria-design-comuni`: come `design-comuni` piu' tre `kind`.
- `graduatoria-wizard`: passo senza stepper con linea sotto il titolo. `heading.row` (default `row`), `heading.rule`, `side_nav`, `body {row (default 'row mt-lg-40'), col, steps_class}`, `sections`, `nav`, `contacts`.
- `graduatoria-document`: documento pubblicato. `heading.row`, `heading.rule`, `body {row, col}`, `sections`, `contacts`; niente indice laterale ne' contenitore delle sezioni.
- `graduatoria-consent`: consenso con stepper. `title`, `title_class`, `stepper`, `body.col`, `sections`, `contacts`.
Tipi di sezione (`sections[].type`): `graduatoria-card` (come `card` + `title_id`), `graduatoria-flow` (come `flow` + `heading`, `list.class`, `button.plain_span`), `graduatoria-timeline` (come `timeline` + `intro`, `bare`),
`graduatoria-service-contacts` (scheda contatti con `align-items-center`), `graduatoria-filtered-accordion` (come `filtered-accordion` + `accordion_id`, `status.image_class`, `aria` opzionale), `graduatoria-callout` (come `callout` + `text_class`),
`graduatoria-heading {text, class, tag}`, `graduatoria-text-card {items: paragraph|bullets}`, `graduatoria-attachments {title, items[{label, aria, description}]}`, `graduatoria-closing {text, link, suffix}`, `graduatoria-consent {paragraphs, checkbox, button}`.
Contenuti di scheda (`content.kind`): `graduatoria-radios` (con `legend`, fieldset), `graduatoria-checks {items[{id,label}]}`, `graduatoria-info-cards` (con `legend`; `aria-expanded` segue `show`; righe `status.tone` success|alert con o senza valore).
Parte: `parts/graduatoria-info-summary` (gruppo di dati con i tre casi di esito).

## Risultato misurato

### HTML body (`compare-body-html.mjs`, pagina reale, nessun CSS necessario)
| Pagina | rigorosa | url-normalizzati |
|---|---|---|
| graduatoria-scheda-servizio | 90,37 | 98,10 |
| graduatoria-area-personale | 87,02 | 96,29 |
| graduatoria-dati-personali | 92,43 | 98,91 |
| graduatoria-dati-specifici | 87,92 | 97,87 |
| graduatoria-riepilogo | 91,55 | 98,53 |
| graduatoria-conferma | 88,52 | 97,86 |
| graduatoria-perfezionamento | 86,91 | 97,62 |
| graduatoria-messaggio | 82,56 | 92,56 |
| consenso-privacy | 85,73 | 97,29 |

Tre pagine sono >= 90 rigoroso (scheda-servizio, dati-personali, riepilogo). Sulle altre sei la forbice e' spiegata cosi' (misurata con `dcp26-explain.mjs`: token del riferimento senza corrispondente nel locale, `rigorosa/normalizzata`, per regione della pagina):

| Pagina | prima di `<main>` (header) | dentro `<main>` | dopo `</main>` (footer) | token del riferimento |
|---|---|---|---|---|
| scheda-servizio | 35/3 | 27/5 | 29/4 | 1920 |
| area-personale | 94/62 | 59/0 | 29/4 | 2320 |
| dati-personali | 35/3 | 34/1 | 29/4 | 2651 |
| dati-specifici | 35/3 | 10/0 | 29/4 | 1246 |
| riepilogo | 35/3 | 10/0 | 29/4 | 1819 |
| conferma | 35/3 | 11/1 | 29/4 | 1332 |
| perfezionamento | 35/3 | 8/0 | 29/4 | 1114 |
| messaggio | 94/62 | 7/0 | 29/4 | 1147 |
| consenso-privacy | 35/3 | 5/0 | 29/4 | 976 |

Lettura: dentro `<main>` i token non trovati con URL normalizzati sono 0 in sei pagine e 1-5 nelle altre tre; tutto il resto della forbice sono valori di `href`/`src`/`xlink:href`
(sprite `<use>` assoluti locali contro `../assets/...` del riferimento, link Home `/it/tests/homepage` contro `homepage.html`) e, per la maggior parte, stanno in header e footer condivisi (non nostri).
Fanno eccezione area-personale e messaggio (header 94/62): nel riferimento hanno l'header con accesso effettuato (vedi "Modifiche condivise richieste").

Differenze di `<main>` con URL normalizzati, tutte spiegate:
- **2 token in piu' sul locale in ogni pagina**: `<div wire:key ... wire:snapshot=...>` e `</div>` aggiunti da Volt in `pages/tests/[slug].blade.php` (condiviso, vietato).
- conferma e scheda-servizio: `<label for="radio-4">` del riferimento contro `radio-5` locale (partial `parts/rating`, condiviso: errore di battitura del riferimento, ultima risposta del gruppo positivo).
- scheda-servizio: `onclick="listenElements(...)"` su "Ascolta" (comportamento assente), attributo `class` duplicato su `<a data-element="service-area">` (HTML non valido del riferimento, non replicato),
  `pb-0 pb-0` e `aria-hidden` mancante sul primo slide del carosello correlati (partial `parts/related`, condiviso).
- dati-personali: nel riferimento il link "Contattaci" ha gli attributi nell'ordine `class href`, nelle altre pagine `href class` (il partial `parts/heading` stampa sempre `href class`).

### Pixel (5 larghezze, altezze identiche in tutti i casi)
Misurati con una **copia in scratch di `compare-screenshots.mjs` con `--inject-css`**: il CSS delle nove pagine e' stato estratto con `extract-used-css.mjs` (stessi argomenti di `regenerate-design-comuni-css.sh`, solo le nove pagine,
stati dal manifest) in un file privato fuori dal repo e iniettato nella sola pagina locale. **Non e' la pipeline reale**: `components.css` non e' stato rigenerato (lo fa l'orchestratore); va ripetuto `parity-gate.sh` dopo `regenerate-design-comuni-css.sh`.

| Pagina | 1920 | 1440 | 992 | 768 | 375 | altezze ref=locale (1920/1440, 992, 768, 375) |
|---|---|---|---|---|---|---|
| scheda-servizio | 99,89 | 99,86 | 99,79 | 99,82 | 99,69 | 5344, 5752, 6104, 7478 |
| area-personale | 99,74 | 99,65 | 99,51 | 99,80 | 99,67 | 2854, 2902, 2888, 3601 |
| dati-personali | 99,93 | 99,90 | 99,86 | 99,91 | 99,83 | 5852, 5924, 5863, 6526 |
| dati-specifici | 99,86 | 99,82 | 99,75 | 99,82 | 99,73 | 2967, 3039, 3104, 3940 |
| riepilogo | 99,97 | 99,96 | 99,93 | 99,92 | 99,85 | 7215, 7263, 7263, 7724 |
| conferma | 99,87 | 99,82 | 99,75 | 99,78 | 99,66 | 2629, 2707, 2540, 3305 |
| perfezionamento | 99,86 | 99,82 | 99,74 | 99,79 | 99,69 | 2510, 2558, 2589, 3389 |
| messaggio | 99,84 | 99,79 | 99,70 | 99,79 | 99,73 | 2757, 2853, 2824, 3933 |
| consenso-privacy | 99,88 | 99,84 | 99,78 | 99,73 | 99,61 | 1938, 2010, 2051, 2875 |

La banda peggiore e' sempre >= 98,75% (a 375 px, y=900-5400) e per area-personale e messaggio le bande piu' basse sono in cima (y=0, 99,27-99,76%: l'header con accesso effettuato che non abbiamo).

### Comportamenti
Pagina intera, `compare-screenshots.mjs --click` (copia con CSS iniettato), altezze identiche in tutti i casi:
scheda-servizio @1440: `#shareActions` 99,86; `#viewActions` 99,89; `a.show-more` 99,64; `label[for=star4a]` 99,72.
area-personale: `a[href="#data-ex-tab3"]` 99,63; tab3 + `button[data-bs-target="#collapse1"]` 98,42; `#modal-message` 99,79 (1440) e 99,69 (375).
dati-personali: `#collapse-benef-2` 99,87; `label[for=son]` 99,81; `#modal-isee` 99,86 (1440) e 99,96 (375); `#modal-documents` 99,84; `button.steppers-btn-confirm` 99,86.
dati-specifici `label[for=religione-1]` 99,82; riepilogo `button.steppers-btn-confirm` 99,99 (1440) e 99,96 (375); perfezionamento `label[for=green-section]` 99,74, `label[for=doposcuola-1]` 99,82, `button.saveBtn` 99,70;
consenso-privacy `label[for=privacy]` 99,84; conferma `label[for=star4a]` 99,69.
In piu', stato del DOM dopo il clic su riferimento e locale con il JS reale (15 casi, tutti uguali): dropdown `.show`, `#collapseExample.show`, radio/checkbox `checked`, tab `tab-pane active show` + link `active`,
modali `.show` con `.modal-backdrop` (message, isee, save-1, terms), `#collapse-benef-2.show`, scheda persona `radio-card has-border-green`, avviso `#alert-message` visibile dopo `.saveBtn`, rating `.form-rating` visibile.

## Differenze note
- `graduatoria-pagamento`: il riferimento non e' pubblicato (404), vedi "Esito". Il locale `/it/tests/graduatoria-pagamento` risponde 200 senza il contenuto del flusso (nessun `cmp-heading`, nessun JSON): non e' una pagina nostra.
- Header con accesso effettuato nel riferimento di area-personale e messaggio (vedi sotto): pixel comunque >= 99,27 per banda, ma l'HTML rigoroso e' 87,02 e 82,56.
- Un solo errore di battitura del riferimento non replicato (`class` duplicato su un link) e uno replicabile solo con un dato in piu' (`for` dell'ultimo radio del rating).
- `en`: `content_blocks.en` vuoto come nelle pagine DCP-21 (i riferimenti sono in italiano).

## Modifiche condivise richieste (non fatte)
1. **Header con accesso effettuato** (`resources/views/components/sections/header/design-comuni.blade.php` e `partials/`; esiste gia' un `partials/user-dropdown.blade.php`, da verificare se serve a questo): nel riferimento di `graduatoria-area-personale` e `graduatoria-messaggio` il pulsante "Accedi all'area personale"
   (`a.btn.btn-primary.btn-icon.btn-full[data-element=personal-area-login]`) e' sostituito da `div.it-user-wrapper.nav-item.dropdown` con `a.btn.btn-primary.btn-icon.btn-full[data-bs-toggle=dropdown]`
   (avatar `img.border.rounded-circle.icon-white`, nome "Mario Rossi", icona `it-expand`) e `div.dropdown-menu > .row > .col-12 > .link-list-wrapper > ul.link-list` con 5 voci (I miei servizi, Le mie pratiche, Notifiche, divisore, Impostazioni, Esci con `it-external-link`).
   Inoltre in quelle due pagine (header identico nei due riferimenti, verificato con `diff`) il link del logo non ha `title="Vai alla homepage"` e la voce "all-services" non ha `active`. Misura: token del riferimento non trovati prima di `<main>` 94 (62 con URL normalizzati) contro 35 (3) nelle altre sette pagine.
   Proposta: chiave `account.state = "logged-in"` (o `account.menu[]`) nel JSON dell'header e variante di markup; per queste due pagine una chiave nel blocco (`header_state`) letta dal layout o un secondo tenant di header. Da ri-misurare dopo.
2. **Volt di `pages/tests/[slug].blade.php`**: il wrapper `<div wire:key wire:snapshot>` aggiunge 2 token a `<main>` in ogni pagina. Nessuna proposta (e' Livewire), solo da sapere.
3. **`parts/rating.blade.php`** (`for="radio-{{ $firstId + $loop->index }}"`, righe 51-52): il riferimento ha `for="radio-4"` sull'ultima risposta del gruppo positivo. Si correggerebbe solo con una chiave per risposta; non conviene replicare l'errore.
4. **Consolidamento futuro** (non urgente): le varianti `graduatoria-*` che sono copie con una chiave in piu' si possono assorbire nei file condivisi quando le altre famiglie hanno finito:
   `graduatoria-card` (+`title_id`) in `card`; `graduatoria-callout` (+`text_class`) in `callout`; `graduatoria-timeline` (+`intro`,`bare`) in `timeline`; `graduatoria-filtered-accordion` (+`accordion_id`,`status.image_class`, `aria` opzionale) in `filtered-accordion`;
   `graduatoria-service-contacts` in `service-contacts`; `graduatoria-info-cards`/`parts/graduatoria-info-summary` (+`legend`, `aria-expanded` da `show`, `status.tone`) in `info-cards`/`info-summary`.

## Da ri-verificare dopo la rigenerazione del CSS
`parity-gate.sh <ref> <locale> --stub-images 'picsum\.photos|via\.placeholder\.com' --fail-if-contains '|---LINE:'` su tutte e nove le pagine (pixel a 5 larghezze, altezze). In particolare: scheda-servizio (carosello Splide dei correlati e `a.show-more`),
area-personale (tab, `#collapse1` dopo tab3: 98,42 e' il valore piu' basso misurato), le tre pagine con modali (dati-personali, riepilogo, area-personale). Il CSS privato era l'unione delle sole nove pagine: il CSS reale e' l'unione di tutte le pagine del manifest.

## Come si controlla
- Dati: `laravel/config/local/fixcity/database/content/pages/tests.{graduatoria-*,consenso-privacy}.json` (e la copia identica in `laravel/Modules/Fixcity/config/database/content/pages/`).
- HTML: `node bashscripts/tools/visual/compare-body-html.mjs https://italia.github.io/design-comuni-pagine-statiche/servizi/<nome>.html http://192.168.1.40:8000/it/tests/<nome>`.
- Struttura: confronto dei token di `<main>` ordinati (un token per riga, URL normalizzati) con `diff`: dopo questa storia restano solo le righe elencate in "Differenze di `<main>`".
- Se una pagina da' 500: `cd laravel && php artisan view:clear` (l'exception renderer lascia `|---LINE:n---|` nella cache).

## Lezioni (da promuovere nella wiki a cura dell'orchestratore)
1. Prima di replicare, `curl -I` ogni URL del riferimento: l'indice del sito puo' elencare pagine non pubblicate (`graduatoria-pagamento.html` e' 404).
2. Famiglie diverse della stessa cartella hanno scheletri diversi (riga centrata o no, linea dentro o fuori dalla riga, stepper assente): conviene un `kind` nuovo piuttosto che forzare i default dello scheletro condiviso.
3. Il confronto per token ordinati di `<main>` (diff di un token per riga, URL normalizzati) trova in pochi minuti ogni attributo mancante; la metrica a sacchetto di token non dice dove, il diff si'.
4. Area personale e pagine "documenti" del riferimento hanno l'header con accesso effettuato: stato mancante nel header condiviso.

## Verifica dell'orchestratore (parity-sweep.sh, 2026-10-13, dopo rigenerazione CSS a 81 pagine)
Rimisurato io, non dall'agente. HTML rigorosa / normalizzata (pixel minimo, altezze): consenso-privacy 85.73 / 97.49 (pixel min 99.61, altezze uguali); graduatoria-area-personale 89.45 / 99.02 (pixel min 99.65, altezze uguali); graduatoria-conferma 88.52 / 98 (pixel min 99.66, altezze uguali); graduatoria-dati-personali 92.43 / 98.99 (pixel min 99.83, altezze uguali); graduatoria-dati-specifici 87.92 / 98.02 (pixel min 99.73, altezze uguali); graduatoria-messaggio 87.41 / 98.03 (pixel min 99.74, altezze uguali); graduatoria-perfezionamento 86.91 / 97.79 (pixel min 99.69, altezze uguali); graduatoria-riepilogo 91.55 / 98.64 (pixel min 99.85, altezze uguali); graduatoria-scheda-servizio 90.37 / 98.2 (pixel min 99.69, altezze uguali).
Stato: done con riserva: pixel >= 99,6% con altezze uguali su tutte le pagine; HTML rigoroso >= 90 su 3 di 9 (il resto per valori di `href`/`src`; le `*-area-personale` ora con header autenticato, `layouts/design-comuni-authenticated`).
