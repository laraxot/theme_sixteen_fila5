---
id: dcp-24
title: "DCP-24: prenotazione appuntamento, passi 1, 3, 4, 5 e 6 (7 pagine di riferimento)"
type: story
epic: dc-parity-v2
status: done
priority: P1
owner: theme:Sixteen
created: 2026-10-13
updated: 2026-10-13
qmd: "design comuni parity appuntamento ufficio luogo dettagli richiedente autenticato riepilogo conferma stepper modale bmad story"
tags: [docs, sixteen, bmad]
---

# DCP-24: appuntamento (passi 1, 3, 4, 5, 6)

## Richiesta
Replicare come pagine di prova guidate da JSON i passi della prenotazione di `https://italia.github.io/design-comuni-pagine-statiche/` rimasti dopo DCP-14
(passo 2): `appuntamento-01-ufficio-luogo`, `appuntamento-01-ufficio`, `appuntamento-03-dettagli`, `appuntamento-04-richiedente`,
`appuntamento-04-richiedente-autenticato`, `appuntamento-05-riepilogo`, `appuntamento-06-conferma`.
Soglie: HTML body >= 90% (o forbice spiegata dai soli URL), pixel >= 97% a 1920/1440/992/768/375 con altezze identiche.

## Baseline (misurata)
Le 7 pagine locali rispondevano 200 ma senza blocchi (nessun JSON `tests.<slug>`); `appuntamento-02-data-orario` era a HTML 87,53% / 97,74% e pixel 99,74-99,86%.

## Cosa e' stato fatto
1. **JSON** `tests.<slug>.json` x7 (tenant `laravel/config/local/fixcity/...` e modulo `laravel/Modules/Fixcity/config/...`, file identici, un solo `slug` per sede).
   Dati estratti dal riferimento con uno script (opzioni dei menu dal markup, testi copiati dal markup compatto).
2. **Blocco `appointment-step`** esteso (passo 2 non toccato nel risultato): nuovi `@case` `select` (con schede ufficio `radio_cards`), `textarea`, `form`,
   `applicant-card`; `layout: centered` per il riepilogo; `contacts.layout: col`; `nav.save/save_short/next_class/next_target/next_icon`; `modal`;
   `subtitle` e classi opzionali `header_class`/`title_class`/`subtitle_class` per le variazioni di margine del riferimento (valori di default = passo 2).
   Partial nuovi in `appointment-step/partials/`: `breadcrumb`, `side-nav`, `nav-steps`, `info-summary` (riusato anche dal `@case office-summary` del passo 2),
   `section-select|textarea|form|applicant`, `summary`, `modal-terms`, `contacts-col`.
3. **Blocco fratello `appointment-confirmation`** (passo 6: intestazione con icona, indice, `checklist`, `address`, `calendar-links`, valutazione, contatti) che riusa i partial
   di `appointment-step` e ha una copia locale del partial valutazione (`px-4 p-lg-0` sulla colonna, assente nel partial condiviso `dc-rating`).
4. **Manifest**: 7 righe in `scripts/design-comuni-pages.txt`; 6 stati in `design-comuni-states.txt` (accordion richiedente, modale termini a 1440 e 375, scheda ufficio, focus su input e textarea).

## Risultati misurati
Misura 1, **HTML body** (`compare-body-html.mjs`, stato attuale del sito): rigorosa / URL normalizzati.

| Pagina | HTML rigorosa | HTML normalizzata |
|---|---|---|
| appuntamento-01-ufficio-luogo | 87,93% | 97,79% |
| appuntamento-01-ufficio | 86,90% | 97,59% |
| appuntamento-03-dettagli | 86,68% | 97,61% |
| appuntamento-04-richiedente | 86,45% | 97,59% |
| appuntamento-04-richiedente-autenticato | 86,73% | 97,67% |
| appuntamento-05-riepilogo | 87,64% | 97,66% |
| appuntamento-06-conferma | 88,61% | 97,85% |
| appuntamento-02-data-orario (regressione) | 87,53% (invariata) | 97,74% (invariata) |

Con gli URL normalizzati i token diversi sono solo nel chrome condiviso (header `style=""`, "Whatsapp"/"WhatsApp", `<link>`/`<style>`/`wire:snapshot`: 13 token locali in piu' per pagina);
il contenuto dei blocchi coincide in struttura (verificato token per token sulle 7 pagine nuove, con il chrome escluso) salvo 2 token deliberati: il pulsante "Annulla" della modale (pagina 05) e `for="radio-4"` -> `radio-5` dell'ultima risposta della valutazione (pagina 06), due refusi del riferimento. La rigorosa resta sotto 90% per i valori di `href`/`src` (sprite relativi del riferimento contro URL assoluti, ~50 token nel chrome + ~10 nel main).

Misura 2, **pixel con il gate reale** (`parity-gate.sh`, CSS compilato com'e' ora, ultima generazione 10:35, prima di queste pagine):
- `appuntamento-02-data-orario`: 99,86 / 99,77 / 99,74 / 99,84 / 99,78% a 1920/1440/992/768/375, altezze 2486/2486/2574/2706/3569 identiche (nessuna regressione dopo il refactor del blocco).
- `appuntamento-01-ufficio` (usa solo regole gia' presenti): 99,87 / 99,83 / 99,76 / 99,80 / 99,73%, altezze 1862/1862/1910/2094/2911 identiche.
- `appuntamento-06-conferma` (CSS mancante: `has-bkg-primary-grey`, `cmp-ul-list`, `address-wrapper`...): 78,93 / 78,07 / 77,65 / 86,17 / 86,45%, altezze 2693 contro 2568 (1920).
  **Sotto soglia solo perche' `components.css` non e' ancora stato rigenerato**.

Misura 3, **pixel con il CSS delle pagine iniettato nella sola pagina locale** (estratto con `extract-used-css.mjs` dalle 8 pagine, scope `body:has(.page-content[data-slug*="tests."])`, file
privato fuori dal repo; stesso screenshot full-page del gate): e' la previsione di cio' che dara' la rigenerazione, non la misura finale.

| Pagina | 1920 | 1440 | 992 | 768 | 375 | altezze |
|---|---|---|---|---|---|---|
| 01-ufficio-luogo | 99,91 | 99,88 | 99,83 | 99,86 | 99,79 | 2655/2655/2823/2919/3766 identiche |
| 01-ufficio | 99,87 | 99,83 | 99,76 | 99,79 | 99,73 | 1862/1862/1910/2094/2911 identiche |
| 03-dettagli | 99,87 | 99,82 | 99,77 | 99,82 | 99,75 | 2139/2139/2187/2373/3146 identiche |
| 04-richiedente | 99,89 | 99,86 | 99,80 | 99,82 | 99,74 | 2101/2101/2149/2339/3130 identiche |
| 04-richiedente-autenticato | 99,90 | 99,87 | 99,82 | 99,81 | 99,74 | 2025/2025/2073/2241/3028 identiche |
| 05-riepilogo | 99,94 | 99,91 | 99,88 | 99,85 | 99,76 | 2844/2844/2917/2903/3633 identiche |
| 06-conferma | 99,87 | 99,84 | 99,78 | 99,83 | 99,74 | 2693/2693/2771/2594/3369 identiche |
| 02-data-orario (controllo) | 99,86 | 98,45 | 97,97 | 99,74 | 99,78 | 2486/2486/2574/2706/3569 identiche |

(02 a 1440 e 992 oscilla 98-99,8% per la posizione dell'elemento sticky nello screenshot a pagina intera, come gia' annotato in DCP-14; col gate reale e' 99,77/99,74.)

Misura 4, **comportamenti con pixel dopo il clic** (stesso CSS iniettato, pagina intera): accordion "Mostra tutto" 99,88% (1440) e 99,75% (375); modale termini 97,89% (1440) e 97,56% (375)
(scarto: il riferimento mette `focus--mouse` sulla modale, vedi sotto); scheda ufficio scelta 99,77% (senza `has-border-green`); focus su `#name` 99,86%; valutazione 4 stelle 99,69% (1440) e 99,78% (375).
**Salva richiesta: 91,62%, altezze 2159 contro 2101**: manca il comportamento JS condiviso (sotto).

## Da fare dopo la rigenerazione dell'orchestratore
`regenerate-design-comuni-css.sh`, poi rilanciare il gate reale sulle 8 pagine (comando sotto) e riscrivere qui la tabella: i numeri della "Misura 3" sono una previsione, non la misura.

## Modifiche condivise richieste (non fatte: fuori dal perimetro)
Comportamenti del riferimento (`assets/script/scripts.js`) assenti in `resources/js`:
- **`.saveBtn`** (pulsanti "Salva Richiesta"/"Salva", passi 4 e 5): al clic rimuove `d-none` da `#alert-message`, aggiunge `pb-4` a `.steppers-nav`, dopo 3000 ms ripristina entrambi.
  Misurato con `dom-diff-after-click.mjs`: riferimento cambia alert + `pb-4`, locale no.
- **`.radio-card` / `.radio-input`** (passo 1 con schede ufficio): al `change` la scheda dell'input scelto riceve `has-border-green`, le altre la perdono.
  Misurato: riferimento aggiunge `has-border-green` al clic su `label[for=first]`, locale no.
- Modale `#modal-terms` (passo 5): si apre e ha backdrop come nel riferimento (stesso delta DOM), ma non riceve `focus--mouse`/`data-focus-mouse` (solo cosmetico).

## Differenze note
- HTML rigoroso sotto 90% per i soli valori degli URL: sprite `../assets/...sprites.svg#it-x` e `homepage.html` del riferimento contro URL assoluti/reali; i token rimasti non-URL
  stanno nel chrome (header/footer/Livewire/link di preload), non nei blocchi di questa famiglia.
- Pulsante "Annulla" della modale termini: nel riferimento ha `data-bs-dismiss="modal fw-bold"` (refuso: non chiude); qui `data-bs-dismiss="modal"` e senza `fw-bold` (1 token HTML di scarto).
- Valutazione (pagina 06): l'ultima risposta "Altro" ha `for="radio-4"` nel riferimento (refuso, punta alla risposta precedente); il partial locale usa `radio-5` come il partial condiviso.
- Il campo `required` dei form e' presente come nel riferimento ma senza validazione JS (nel riferimento solo `#justValidateForm` la usa, assente in queste pagine).

## Come si controlla
```bash
for s in appuntamento-01-ufficio-luogo appuntamento-01-ufficio appuntamento-03-dettagli appuntamento-04-richiedente \
         appuntamento-04-richiedente-autenticato appuntamento-05-riepilogo appuntamento-06-conferma appuntamento-02-data-orario; do
  bashscripts/tools/visual/parity-gate.sh https://italia.github.io/design-comuni-pagine-statiche/sito/$s.html \
    http://192.168.1.40:8000/it/tests/$s --stub-images 'picsum\.photos|via\.placeholder\.com' --fail-if-contains '|---LINE:'
done
```

## RISULTATO CON IL GATE REALE (orchestratore, 2026-10-13, dopo la rigenerazione del CSS: `parity-sweep.sh`)
CSS rigenerato da 38 pagine (`regenerate-design-comuni-css.sh`, ora parallelo: ~4,5 minuti) e tema ricompilato; misura con `parity-gate.sh --stub-images 'picsum\.photos|via\.placeholder\.com'`.
| Pagina | HTML rigorosa | HTML URL normalizzati | Pixel a 1920 / 1440 / 992 / 768 / 375 (altezze identiche) |
|---|---:|---:|---|
| `appuntamento-01-ufficio-luogo` | 87.93% | 97.79% | 99.91% / 99.88% / 99.83% / 99.86% / 99.79% |
| `appuntamento-01-ufficio` | 86.9% | 97.59% | 99.87% / 99.83% / 99.76% / 99.8% / 99.73% |
| `appuntamento-02-data-orario` | 87.53% | 97.74% | 99.86% / 99.81% / 99.74% / 99.84% / 99.78% |
| `appuntamento-03-dettagli` | 86.68% | 97.61% | 99.88% / 99.84% / 99.77% / 99.82% / 99.75% |
| `appuntamento-04-richiedente` | 86.45% | 97.59% | 99.89% / 99.8% / 99.8% / 99.82% / 99.74% |
| `appuntamento-04-richiedente-autenticato` | 86.73% | 97.67% | 99.9% / 99.87% / 99.82% / 99.81% / 99.74% |
| `appuntamento-05-riepilogo` | 87.64% | 97.66% | 99.94% / 99.91% / 99.86% / 99.85% / 99.76% |
| `appuntamento-06-conferma` | 88.61% | 97.85% | 99.88% / 99.84% / 99.78% / 99.84% / 99.74% |

Lettura: pixel >= 97% a tutte le larghezze con altezze identiche; l'HTML rigoroso resta tra 86% e 91% per i soli valori di `href`/`src` (percorsi relativi nel riferimento, URL assoluti da noi) e per il chrome condiviso; con gli URL normalizzati e' >= 97,5% ovunque.
Modifiche condivise richieste dall'agente e applicate dall'orchestratore: vedi la story DCP-19 (carosello `carousel-4-card`, fallback `href="#id"` del collapse, `col_class` del rating, `.saveBtn`, `.radio-card`, `focus--mouse` sulle modali, validazione form, layout `design-comuni-bare` per il catalogo, selettori del menu mobile).
