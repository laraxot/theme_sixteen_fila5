---
id: dcp-29
title: "DCP-29: servizi/permessi-* (7 pagine) sul service-flow, solo JSON piu' poche varianti permessi-*"
type: story
epic: dc-parity-v2
status: done
priority: P1
owner: theme:Sixteen
created: 2026-10-13
updated: 2026-10-13
qmd: "design comuni parity servizi permessi ztl service-flow json estrattore wizard stepper veicolo checkbox date riepilogo pagamento conferma area personale"
tags: [docs, sixteen, bmad]
---

# DCP-29: servizi/permessi-*

## Richiesta
Replicare `servizi/permessi-{scheda-servizio, area-personale, dati-personali, dati-specifici, pagamento, riepilogo, conferma}.html` come
`/it/tests/permessi-<X>` guidate da JSON (`tests.permessi-<X>`), riusando lo scheletro `blocks/service-flow/` (DCP-21). Metodo BMAD: Build.

## Baseline
Nessun JSON esisteva per questi slug (`find`/`grep` su tenant e modulo: zero file `tests.permessi-*`), quindi nessun backup da salvare.
Stato prima del lavoro non misurato (pagine inesistenti). Struttura del riferimento confrontata con le 7 `servizi-pagamento-*`: somiglianza di sequenza dei tag
0,95 (scheda), 0,99 (area personale), 0,86 (dati personali), 0,90 (dati specifici), 0,99 (pagamento), 0,91 (riepilogo), 0,98 (conferma).

## Cosa e' stato fatto
1. **Estrattore** (jsdom, fuori dal repo, `scratchpad/dcp29-extract.mjs`, ~340 righe): legge la pagina di riferimento e produce il blocco JSON `service-flow` (breadcrumb, titolo,
   stepper, indice, sezioni, schede, gruppi di dati, valutazione, correlati, contatti, finestre). **Validato** sulle 7 `servizi-pagamento-*`: rigenera i JSON gia' scritti a mano con 0 differenze di contenuto su 6 pagine; sulla settima
   (dati-specifici) l'unica differenza e' `modals: []` presente nel file esistente e assente nell'estratto. Il JSON estratto aggiunge solo i default espliciti di classe. Poi applicato alle 7 pagine permessi.
2. **7 JSON** `tests.permessi-<X>.json` (tenant e modulo, identici byte per byte, verificato con `cmp`): un solo blocco `service-flow` per pagina, `view` = `permessi-design-comuni`.
3. **13 file nuovi** con prefisso `permessi-` in `components/blocks/service-flow/` (nessun file esistente modificato):
   - `permessi-design-comuni.blade.php`: ingresso (stesse pagine di service-flow piu' i `kind` `permessi-wizard-step` e `permessi-payment`; l'ingresso condiviso ha la lista dei `kind` cablata).
   - `pages/permessi-wizard-step`, `parts/permessi-heading`: titolo con `subtitles[].span {text,class}` (dati personali: `<span class="d-block d-lg-inline">` nel sottotitolo) e `link.class_first` (ordine `class`/`href` diverso fra pagine).
   - `pages/permessi-payment`: righe e colonne come chiavi (`heading.row/col`, `body.row/col`); nel riferimento sono `row justify-content-center`/`col-12 col-lg-10` e `pt-2 pt-lg-40`.
   - `sections/permessi-timeline` (riga `info` per voce), `permessi-service-contacts` (`office.card_class` con `align-items-center`, `office.title_class` con `mb-2`), `permessi-summary`
     (titolo esterno h2, titolo scheda con `id`, totale `{label,value}` con `<span class="d-block d-lg-inline">`), `permessi-callout` (`text_block_class`: `d-lg-block` invece di `d-md-block`), `permessi-filtered-accordion` (`status.image_class`).
   - `card-content/permessi-checkboxes` (tipo di permesso), `permessi-dates` (periodo di validita'), `permessi-fieldset-cards` (veicoli: `fieldset`+`legend` nascosta attorno alle schede, pulsante "Aggiungi veicolo" fuori).
   - `modals/permessi-form` (modulo veicolo: campi bloccati con placeholder, menu, caricamenti).
4. Immagini: nessuna nuova (`pagopa.svg`, `folder-*.svg` gia' presenti, non vuote).
5. Manifest: 7 righe `servizi/permessi-*.html` in coda a `design-comuni-pages.txt`; 5 stati in coda a `design-comuni-states.txt`
   (`[data-bs-target="#modal-vehicle"]` a 1440 e 375, `#modal-vehicle-data`, `label[for=vehicle1]`, `label[for=ztl-a]`).

## Modello dati: solo cio' che e' nuovo rispetto a DCP-21
- `kind`: anche `permessi-wizard-step` (come `wizard-step` con `permessi-heading`) e `permessi-payment`.
- Sezioni: `permessi-timeline`, `permessi-service-contacts`, `permessi-summary`, `permessi-callout`, `permessi-filtered-accordion` (stesse chiavi del tipo base piu' quelle sopra).
- `summary.heading.tag` (`h2`|`h3`), `heading.id`, `title_id`, `total` come testo oppure `{label, value, class, value_class}`.
- Contenuti scheda: `permessi-checkboxes {class, options[{id,name?,value?,label}]}`, `permessi-dates {class, fields[{id,name,label,class}]}`,
  `permessi-fieldset-cards {legend, radio_name, cards[], add}` (stesse schede di `info-cards`).
- Finestra `permessi-form {id, close_label, title, info, form_id, form_class, fields[{type: input|select|upload, ...}], cancel, save}`.

## Risultato (MISURATO)
### HTML body (`compare-body-html.mjs`, locale `http://192.168.1.40:8000/it/tests/permessi-<X>`)
| Pagina | rigorosa | URL normalizzati | token rif/loc |
|---|---|---|---|
| scheda-servizio | 90,08% | 97,95% | 1880/1893 |
| area-personale | 87,79% | 96,08% | 2197/2154 |
| dati-personali | 90,39% | 98,44% | 1964/1979 |
| dati-specifici | 86,88% | 97,67% | 1140/1153 |
| pagamento | 86,04% | 97,77% | 1013/1026 |
| riepilogo | 89,17% | 98,10% | 1399/1412 |
| conferma | 88,70% | 97,75% | 1355/1368 |

La forbice rigorosa/normalizzata e' fatta di valori di URL: per pagina 33-55 token degli sprite (`use href`: nel riferimento `../assets/bootstrap-italia/dist/svg/sprites.svg#x`,
in locale l'URL assoluto del tema; non cambiabile senza servire `/it/assets/...`), 17-23 link di header e footer (percorsi `../sito/...` contro rotte locali, parte condivisa)
e l'URL `homepage.html` del breadcrumb. Sotto il 90% rigoroso: area-personale, dati-specifici, pagamento, riepilogo, conferma.
**Non solo URL**: area-personale perde 66 token perche' il riferimento mostra l'header con utente autenticato (menu "Mario Rossi", "I miei servizi", "Esci"), il tema mostra
"Accedi all'area personale" (header condiviso, stato "accesso effettuato" non previsto, gia' annotato in DCP-21).

### Pixel (CSS privato iniettato nel locale, vedi "Verifica dopo la rigenerazione"; altezze rif-loc identiche in tutte le celle)
| Pagina | 1920 | 1440 | 992 | 768 | 375 | altezze 1920/1440/992/768/375 |
|---|---|---|---|---|---|---|
| scheda-servizio | 99,92 | 99,86 | 99,83 | 99,79 | 99,69 | 5127/5127/5375/5735/6906 |
| area-personale | 99,75 | 99,67 | 99,53 | 99,77 | 99,62 | 2970/2970/3018/2998/3708 |
| dati-personali | 99,94 | 99,92 | 99,88 | 99,89 | 99,81 | 4997/4997/5069/5084/5761 |
| dati-specifici | 99,84 | 99,80 | 99,70 | 99,79 | 99,66 | 2461/2461/2509/2610/3315 |
| pagamento | 99,90 | 99,87 | 99,80 | 99,76 | 99,63 | 2313/2313/2361/2333/3045 |
| riepilogo | 99,94 | 99,92 | 99,89 | 99,87 | 99,77 | 4288/4288/4336/4304/4922 |
| conferma | 99,86 | 99,81 | 99,73 | 99,79 | 99,67 | 2733/2733/2839/2620/3399 |

Senza CSS iniettato (stato attuale del tema, `parity-gate.sh` ufficiale, solo pagamento): HTML 86,04% / 97,77%; pixel 97,8 / 97,21 / 96,3 / 99,77 / 99,63 %, altezze 2313-2316 a 1920, 1440 e 992 px.
Quindi il tema attuale arriva gia' a ~97% sulle pagine piu' semplici; il resto (spaziature `pt-lg-40`, `mb-lg-40`, ecc.) arriva con la rigenerazione.

### Comportamenti (pagina intera dopo il clic, `compare-screenshots` con CSS iniettato, altezze identiche)
| Pagina | Clic | Larghezza | Parity |
|---|---|---|---|
| dati-personali | radio veicolo `label[for=vehicle1]` | 1440 | 99,86% |
| dati-personali | accordion `#collapse-benef-2` | 1440 | 99,85% |
| dati-personali | finestra documenti `#modal-vehicle` | 1440 / 375 | 99,85% / 99,81% |
| dati-personali | finestra veicolo `#modal-vehicle-data` | 1440 | 99,84% |
| dati-personali | Avanti (`#modal-save-1`) | 1440 / 375 | 99,90% / 99,93% |
| dati-specifici | casella `label[for=ztl-a]` | 1440 / 375 | 99,80% / 99,66% |
| riepilogo | Invia (`#modal-terms`) | 1440 / 375 | 99,98% / 99,93% |
| area-personale | scheda `#data-ex-tab3` | 1440 / 375 | 99,62% / 99,64% |
| area-personale | scheda 3 + accordion `#collapse1` | 1440 | 99,63% |
| area-personale | messaggio `#modal-message` | 1440 | 99,79% |
| scheda-servizio | menu `#shareActions` | 1440 | 99,86% |
| scheda-servizio | `a.show-more` | 1440 | 99,67% |
| scheda-servizio | stella `label[for=star4a]` | 1440 | 99,73% |
| conferma | stella `label[for=star4a]` | 1440 | 99,66% |
| pagamento | pulsante pagoPA `.btn-re` | 1440 | 99,87% |

`dom-diff-after-click.mjs` su `[data-bs-target="#modal-vehicle-data"]` (dati-personali): riferimento e locale cambiano 4 elementi (barra di avanzamento, `nav-link active`, pulsante, finestra
`show` con `aria-modal`). Sul pulsante cliccato il locale aggiunge la classe `focus--mouse` e `data-focus-mouse=true`, il riferimento mette `data-focus-mouse=false` (comportamento condiviso, nessun effetto sui pixel misurati). Nessun `|---LINE:` nell'HTML delle 7 pagine, tutte HTTP 200.

## Differenze note (non risolte)
- **Header autenticato** (area-personale): vedi sopra, 66 token.
- Voci in file condivisi (non toccati; correzione proposta nel report): `sections/flow.blade.php` riga 25 emette `<span class="">` dove il riferimento ha `<span>` (2 token, scheda-servizio);
  `parts/related.blade.php` riga 11 `pb-0` dove il riferimento ha `pb-0 pb-0` e riga 20 `aria-hidden="true"` su un'icona che in una scheda del riferimento non lo ha (2 token);
  `parts/heading.blade.php` riga 51 non rende `onclick="listenElements(this, '[data-audio]')"` della voce "Ascolta" (1 token; e' codice del riferimento, non copiato);
  `parts/rating.blade.php` riga 13 ha `id="rating"` fisso mentre la conferma del riferimento usa `id="rate-service"`, e il riferimento ripete `radio-4` (id duplicato) per la quinta risposta positiva
  mentre il blocco numera 1-5 (2 token; il clic sulle stelle dà lo stesso risultato, 99,66% in conferma);
  `card-content/info-cards.blade.php` riga 26 ha `aria-expanded="false"` fisso, nel riferimento e' `true` quando il pannello e' `show` (2 token, dati-personali).
- Non verificato: apertura del selettore di data (`input type=date` con classe `it-date-datepicker`) e invio dei moduli; le pagine sono statiche come il riferimento.

## Verifica dopo la rigenerazione (da fare dopo `regenerate-design-comuni-css.sh`)
Il CSS usato per le misure pixel e' un file privato (`extract-used-css.mjs` sulle 7 pagine, 1877 regole su 13253, stessi `--scope` e stati del manifest piu' i 5 stati aggiunti), iniettato
solo nella pagina locale. Dopo la rigenerazione rilanciare, una pagina alla volta:
`bashscripts/tools/visual/parity-gate.sh https://italia.github.io/design-comuni-pagine-statiche/servizi/permessi-<X>.html http://192.168.1.40:8000/it/tests/permessi-<X> --stub-images 'picsum\.photos|via\.placeholder\.com' --fail-if-contains '|---LINE:'`
e ricontrollare i clic della tabella. Se un valore scende, confrontare con `compare-computed.mjs` / `explain-style.mjs` (probabile causa: una regola persa dalla rigenerazione o dall'ordine in `components.css`).

## Come si controlla
`node bashscripts/tools/visual/compare-body-html.mjs <rif> <locale>`; `parity-gate.sh` (sopra); `find laravel/Themes/Sixteen/resources/views/components/blocks/service-flow -name 'permessi-*'` (13 file);
`cmp` fra i JSON di `laravel/config/local/fixcity/database/content/pages/` e di `laravel/Modules/Fixcity/config/database/content/pages/`.

## Lezioni
- Un estrattore dal DOM, validato prima sui JSON gia' scritti a mano (0 differenze su 6 pagine su 7), evita di trascrivere testo: il tempo va nelle varianti di classe.
- Le classi di contenitore che cambiano fra famiglie vanno come chiavi del JSON; cinque delle varianti `permessi-*` (callout, service-contacts, filtered-accordion, payment, heading) servono solo perche' una classe o un tag era cablato nel file condiviso.
- La misura rigorosa dell'HTML ha un tetto dato dagli sprite (33-55 token) e dai link di chrome (17-23): riportare sempre la normalizzata e la causa.

## Verifica dell'orchestratore (parity-sweep.sh, 2026-10-13, dopo rigenerazione CSS a 81 pagine)
Rimisurato io, non dall'agente. HTML rigorosa / normalizzata (pixel minimo, altezze): permessi-area-personale 90.37 / 98.96 (pixel min 99.64, altezze uguali); permessi-conferma 88.7 / 97.89 (pixel min 99.67, altezze uguali); permessi-dati-personali 90.39 / 98.54 (pixel min 99.81, altezze uguali); permessi-dati-specifici 86.88 / 97.84 (pixel min 99.66, altezze uguali); permessi-pagamento 86.04 / 97.77 (pixel min 99.63, altezze uguali); permessi-riepilogo 89.17 / 98.24 (pixel min 99.77, altezze uguali); permessi-scheda-servizio 90.08 / 98.06 (pixel min 99.69, altezze uguali).
Stato: done con riserva: pixel >= 99,6% con altezze uguali su tutte le pagine; HTML rigoroso >= 90 su 3 di 7 (il resto per valori di `href`/`src`; le `*-area-personale` ora con header autenticato, `layouts/design-comuni-authenticated`).
