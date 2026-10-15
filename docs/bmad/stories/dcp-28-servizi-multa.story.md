---
id: dcp-28
title: "DCP-28: servizi pagamenti-multa (9 pagine) sul service-flow"
type: story
epic: dc-parity-v2
status: done
priority: P1
owner: theme:Sixteen
created: 2026-10-13
updated: 2026-10-13
qmd: "design comuni parity servizi pagamenti multa wizard dati specifici fase codice avviso importo validazione justValidateMulta service-flow multa json bmad story"
tags: [docs, sixteen, bmad]
---

# DCP-28: servizi pagamenti-multa

## Richiesta
Replicare `servizi/pagamenti-multa-*.html` come `/it/tests/<nome>` guidate da JSON (`tests.<nome>.json`, tenant e modulo), con HTML body >= 90% (o forbice spiegata dai soli URL)
e pixel >= 97% a 1920/1440/992/768/375 con altezze identiche. Si riusa lo scheletro `blocks/service-flow/` (DCP-21: `docs/bmad/stories/dcp-21-servizi-pagamento-e-service-flow.story.md`).

## Fatti verificati sul riferimento (prima di scrivere)
- **Il riferimento pubblicato usa `specifici`, non `specifci`.** L'indice (`index.html`) e il manifest elencano `pagamenti-multa-dati-specifici-fase1/2/3.html`, ma quei file rispondono 404.
  L'albero del ramo `gh-pages` contiene `pagamenti-multa-dati-specifici-fase1/2/3.html` (HTTP 200). Gli slug locali erano stati creati con `specifci`; l'orchestratore li ha rinominati in `specifici` (come i file reali), cosi' il manifest, lo sweep e le pagine usano lo stesso nome. Nel catalogo `servizi-index` il testo del file resta quello del riferimento (con il refuso), il link punta allo slug reale.
- **`servizi/pagamenti-multa-pagamento.html` non esiste** (404 sul sito e assente dal ramo `gh-pages`; il link dell'indice e' rotto). Quindi la nona pagina non ha un riferimento da replicare (vedi "Nona pagina").

## Baseline
Le 9 pagine locali rispondevano HTTP 200 con solo il chrome (nessun JSON). Misurata solo per scheda-servizio: HTML 41,06% rigorosa / 45,82% normalizzata.

## Cosa e' stato fatto
1. **Confronto con `servizi-pagamento-*`** (diff dei markup compatti di `<main>`): scheda-servizio e area-personale coincidono con DCP-21 salvo dati e qualche classe; conferma, dati-personali, riepilogo e i 3 passi "dati specifici" hanno markup diverso (sottotitolo con `span`/`br` con classi, `steppers-content` fuori dalla colonna o assente, gruppi `cmp-info-summary` senza testata o con l'ultima riga `border-0`, `<form id="justValidateMulta">`, campi codice avviso e data).
2. **File nuovi** (solo prefisso `multa-`, nessun file condiviso toccato) in `blocks/service-flow/`:
   - `multa-design-comuni.blade.php` (ingresso: delega a `design-comuni` i tipi `service-sheet` e `personal-area`; gestisce `multa-wizard` e `multa-confirmation`)
   - `pages/multa-wizard.blade.php`, `pages/multa-confirmation.blade.php`
   - `parts/multa-heading.blade.php` (sottotitoli a segmenti), `parts/multa-inline.blade.php`, `parts/multa-nav-steps.blade.php` (`next.submit`), `parts/multa-info-summary.blade.php`
   - `sections/multa-card.blade.php`, `sections/multa-callout.blade.php`, `sections/multa-flow.blade.php`
   - `card-content/multa-fields.blade.php` (campi: text, title, radios, input, date, summary, box), `card-content/multa-info-cards.blade.php`, `card-content/multa-activities.blade.php`
3. **JSON** `tests.pagamenti-multa-*.json` (tenant e modulo, identici), estratti dal riferimento con uno script (mini DOM Python) e controllati con il diff dei markup compatti.
4. **Manifest**: 8 righe in coda a `scripts/design-comuni-pages.txt` (nomi reali `specifici`) e 1 stato (`1440|label[for="rate-2"]`) in `design-comuni-states.txt`.
5. Nessuna immagine nuova (le `folder-*.svg` e `pagopa.svg` esistevano gia').

## Modello dati aggiunto (per le famiglie che riusano questi tipi)
- `kind: multa-wizard`: `breadcrumb`, `heading` (`subtitles[]` con `text` oppure `segments[]`: stringa, `{span, text}`, `{br}`; `link.class_first` per l'ordine degli attributi), `stepper` (+ `note {class,text}`),
  `body {wrap: steppers-content|container|none, col, form}`, `sections[]`, `nav` (`next.submit` = pulsante `type=submit` con `data-bs-validate`), `contacts`, `modals[]`.
- `kind: multa-confirmation`: `heading` (icon, subtitles, buttons), `after_heading {class,text,link}`, `feedback`, `contacts`.
- Sezioni: `multa-card` (`heading`, `wrap`, `content.kind` = `multa-fields` | `multa-info-cards`), `multa-callout` (`block_class`), `multa-flow` (`button.bare`, `attachment.class`).
- `multa-fields.fields[]`: `text`, `title`, `radios` (`options[] {label, body_class, label_class}`), `input` (`wrapper_class`, `group_class`, `input_type`, `value`...), `date`, `summary {group}`, `box {class, fields[]}`.
- Gruppo `multa-info-summary`: `class`, `header {title, class, edit}` (assente = nessuna testata), `rows[] {label, value}`, `last_row_class`, `footer_class`.

## Risultato (misure)
Strumenti: `compare-body-html.mjs`, `parity-gate.sh`, `compare-screenshots.mjs`. Il CSS di `components.css` e' quello **attuale** (non rigenerato con queste pagine).

**HTML body** (rigorosa / URL normalizzati). La rigorosa resta sotto 90% **solo per i valori di `href`/`src`**: gli sprite relativi del riferimento (`../assets/...`) contro URL assoluti locali; il diff token per token di
`<main>` (commenti Livewire e valori degli sprite esclusi) lascia solo i punti elencati in "Differenze note".

| Pagina | Rigorosa | Normalizzata |
|---|---|---|
| scheda-servizio | 89,67% | 98,15% |
| area-personale | 87,55% | 95,97% |
| dati-personali | 87,47% | 97,78% |
| dati-specifici-fase1 | 86,86% | 97,67% |
| dati-specifici-fase2 | 88,03% | 97,89% |
| dati-specifici-fase3 | 88,11% | 97,90% |
| riepilogo | 87,89% | 97,86% |
| conferma | 87,84% | 97,64% |

**Pixel con il CSS attuale** (gate, 1920 / 1440 / 992 / 768 / 375; altezze riferimento-locale):

| Pagina | Pixel | Altezze |
|---|---|---|
| scheda-servizio | 99,92 / 99,85 / 99,78 / 99,79 / 99,72 | identiche (4331, 4331, 4555, 4875, 5986) |
| area-personale | 99,76 / 99,68 / 99,54 / 99,80 / 99,67 | identiche (2854, 2854, 2902, 2888, 3601) |
| dati-personali | 99,89 / 99,86 / 99,78 / 99,77 / 99,65 | identiche (2159, 2159, 2231, 2391, 3216) |
| riepilogo | 99,92 / 99,91 / 99,87 / 99,84 / 99,73 | identiche (3280, 3280, 3353, 3375, 4079) |
| conferma | 94,30 / 93,35 / 92,35 / 99,75 / 99,63 | 2178-2162, 2178-2162, 2284-2268, poi identiche |
| dati-specifici-fase1 | 95,11 / 94,27 / 96,89 / 99,79 / 99,68 | 2406-2431, 2406-2431, 2478-2479, poi identiche |
| dati-specifici-fase2 | ERR (una volta, non riproducibile; ripetuto: 93,68) / 92,89 / 93,05 / 99,71 / 99,59 | 3392-3456 (1920 e 1440), 3488-3528 (992), poi identiche |
| dati-specifici-fase3 | 93,71 / 92,91 / 93,07 / 99,67 / 99,59 | 3444-3508, 3444-3508, 3568-3608, poi identiche |

Le 4 pagine sotto soglia mancano solo di regole CSS dei breakpoint `lg` che il `components.css` attuale non ha ancora (verificato: `pt-lg-40`, `pl-lg-30`, `mb-lg-25` assenti dal file e presenti nel CSS estratto dal riferimento).

**Pixel con il CSS estratto iniettato solo nella pagina locale** (`extract-used-css.mjs` sulle 8 pagine, file privato fuori dal repo; stesso scope e stesse sorgenti di `regenerate-design-comuni-css.sh`; riproduce quel che dara' la rigenerazione, **da ri-verificare dopo**):

| Pagina | Pixel 1920 / 1440 / 992 / 768 / 375 | Altezze |
|---|---|---|
| conferma | 99,88 / 99,86 / 99,80 / 99,74 / 99,63 | identiche (2178, 2178, 2284, 2178, 3043) |
| dati-specifici-fase1 | 99,89 / 99,86 / 99,80 / 99,78 / 99,68 | identiche (2406, 2406, 2478, 2578, 3479) |
| dati-specifici-fase2 | 99,91 / 99,90 / 99,85 / 99,78 / 99,65 | identiche (3392, 3392, 3488, 3559, 4426) |
| dati-specifici-fase3 | 99,92 / 99,89 / 99,86 / 99,78 / 99,66 | identiche (3444, 3444, 3568, 3623, 4506) |

**Comportamenti** (pagina intera dopo il clic, CSS estratto iniettato; riferimento contro locale):
- scheda: menu Condividi 99,90% (1440); area personale: scheda Attivita' 99,69% (1440) e 99,69% (375), con accordion `#collapse1` 99,70%, menu Ordina 99,69%, messaggio (modale) 99,80%;
- dati-personali: accordion `#collapse-benef-1` 99,88% (1440) e 99,69% (375); Avanti (modale `modal-save-1`) 99,96%;
- fase1: radio `rate-2` 99,87%, Avanti 99,87%; fase2: Salva (messaggio) 99,90%; fase3: Avanti 99,90%; riepilogo: Invia (`modal-terms`) 99,97% (1440) e 99,92% (375), Salva 99,91%; conferma: stella 4 99,89% (1440), stella 2 99,70% (375).
- **Difetti nel comportamento condiviso** (vedi sotto): fase2 Avanti (validazione) 95,91% (1440, altezze 3414-3436) e 92,18% (375, 4448-4470); catena `modal-save-1` -> `modal-save-2` 67,19% (1440).

## Difetti nei file condivisi e richieste (non fatti: fuori proprieta')
1. **Validazione `#justValidateMulta`** (`resources/js/theme/design-comuni-home.js`, `dcFormValidate.submit`, riga 272-275): controlla ogni `input, select, textarea`, quindi segnala anche il gruppo radio `rate` (`input#rate-1[required]`).
   Il riferimento (`scripts.js`) registra solo `#code` e `#date-1` (`addField`): sul radio non compare alcun errore. Effetto misurato: etichetta `rate-1-error-0` in piu', +22 px di altezza dopo Avanti.
   Correzione proposta: nel ciclo di `submit` (e in `check`) saltare i radio/checkbox (`field.type === 'radio'`), o validare solo i campi con `data-bs-validate` esplicito. Il markup resta fedele (`required=""` sul radio come nel riferimento).
2. **Catena di modali** (`resources/js/app.js`, handler `[data-bs-toggle="modal"]`, ~riga 370): aprire una modale da un pulsante dentro una modale aperta (`modal-save-1` -> `modal-save-2`, anche in `servizi-pagamento-dati-personali`) lascia aperte entrambe con due backdrop;
   in Bootstrap la prima si chiude. Correzione proposta: prima di `openModal(modal)`, se il pulsante sta in un `.modal.show` diverso dal bersaglio, chiamare `closeModal(btn.closest('.modal'))`. Simulata solo nella misura (script iniettato nel browser, non nel repo): 67,19% -> 99,95% (1440).
3. **`parts/rating.blade.php`**: l'ultima risposta usa `for="radio-5"`, il riferimento ha `for="radio-4"` (refuso); inoltre il riferimento ha spazi attorno al testo delle tre domande (` Quali ... `), la vista no: non incide sul gate (i token si confrontano trimmati). Gia' noto da DCP-17: nessuna azione richiesta.
4. **`flow` / `button`**: nelle pagine multa il pulsante usa `<span>` senza attributo `class` e l'allegato ha `mt-3` sul link; `sections/flow.blade.php` li emette fissi (`<span class="">`, `list-item icon-left d-inline-block`).
   Risolto con `multa-flow` (copia con `button.bare` e `attachment.class`); se altre famiglie hanno lo stesso scarto conviene riportare le due chiavi opzionali in `flow` (righe 25 e 29) e cancellare `multa-flow`.
5. **`parts/related.blade.php`** riga 20 (carosello "Contenuti correlati"): il riferimento non ha `aria-hidden="true"` sull'icona della prima scheda (incoerenza del riferimento); la vista lo emette su tutte (1 token, lasciato).
6. **`sections/service-contacts.blade.php`**: `mailto:` usa lo stesso valore del testo; il riferimento ha un refuso nel solo `href` (`ufficiotributia@`). 1 token, lasciato.

## Differenze note
- Strict < 90% per gli URL (sprite e href del chrome); normalizzata 95,97 - 98,15%. Il chrome (header: `style=""`, voci utente dello stato "accesso effettuato" in area-personale; footer `data-element` dei link legali; `Whatsapp`/`WhatsApp`) non e' del blocco.
- `onclick="listenElements(...)"` della voce "Ascolta" nella scheda servizio (script del riferimento: non riprodotto per contratto).
- Il commento Livewire e il `div[wire:snapshot]` che avvolge il blocco non esistono nel riferimento.

## Nona pagina
`tests.pagamenti-multa-pagamento.json` (tenant e modulo) e' **derivata** da `servizi-pagamento-pagamento` con i dati del riepilogo multa (codice avviso, ente, 38,42 EUR): non e' una replica, il suo riferimento non esiste.
Non e' nei manifest (l'estrazione CSS fallirebbe sul 404). Risponde 200 senza `|---LINE:`. Contro il fratello `servizi-pagamento-pagamento.html`, come sola prova di struttura: HTML 84,05% rigorosa / 95,50% normalizzata (testi diversi per costruzione). Nessun valore di parity dichiarato.

## Come si controlla
```
bashscripts/tools/visual/parity-gate.sh https://italia.github.io/design-comuni-pagine-statiche/servizi/pagamenti-multa-dati-specifici-fase2.html \
  http://192.168.1.40:8000/it/tests/pagamenti-multa-dati-specifici-fase2 --stub-images 'picsum\.photos|via\.placeholder\.com' --fail-if-contains '|---LINE:'
```
Dopo la rigenerazione del CSS (orchestratore) ripetere il gate sulle 8 pagine e i comportamenti elencati sopra; la rigenerazione deve rendere `conferma` e `fase1-3` >= 97% a 1920/1440/992 senza iniezioni.

## Non fatto
Nessuna build ne' rigenerazione CSS; nessuna modifica a JS, partial o file condivisi; nessun aggiornamento di indici/MEMORY.md/second brain (fuori proprieta'); pagina `pagamenti-multa-pagamento` non replicabile.

## Verifica dell'orchestratore (parity-sweep.sh, 2026-10-13, dopo rigenerazione CSS a 81 pagine)
Rimisurato io, non dall'agente. HTML rigorosa / normalizzata (pixel minimo, altezze): pagamenti-multa-area-personale 90.2 / 98.93 (pixel min 99.69, altezze uguali); pagamenti-multa-conferma 87.84 / 97.8 (pixel min 99.63, altezze uguali); pagamenti-multa-dati-personali 87.47 / 97.95 (pixel min 99.65, altezze uguali); pagamenti-multa-dati-specifici-fase1 86.86 / 97.84 (pixel min 99.68, altezze uguali); pagamenti-multa-dati-specifici-fase2 88.03 / 98.04 (pixel min 99.65, altezze uguali); pagamenti-multa-dati-specifici-fase3 88.11 / 98.06 (pixel min 99.66, altezze uguali); pagamenti-multa-riepilogo 87.89 / 98.02 (pixel min 99.73, altezze uguali); pagamenti-multa-scheda-servizio 89.67 / 98.27 (pixel min 99.72, altezze uguali).
Stato: done con riserva: pixel >= 99,6% con altezze uguali su tutte le pagine; HTML rigoroso >= 90 su 1 di 8 (il resto per valori di `href`/`src`; le `*-area-personale` ora con header autenticato, `layouts/design-comuni-authenticated`).
