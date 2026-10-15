---
id: dcp-27
title: "DCP-27: servizi IMU (7 pagine pagamenti-imu-*) sul service-flow"
type: story
epic: dc-parity-v2
status: done
priority: P1
owner: theme:Sixteen
created: 2026-10-13
updated: 2026-10-13
qmd: "design comuni parity servizi pagamenti imu anteprima f24 preferenze riepilogo conferma area personale scheda servizio service-flow imu- toggle cmp-tot bmad story"
tags: [docs, sixteen, bmad]
---

# DCP-27: servizi IMU sul service-flow

## Richiesta
Replicare come pagine di prova guidate da JSON le 7 pagine `https://italia.github.io/design-comuni-pagine-statiche/servizi/pagamenti-imu-<X>.html`
(`anteprima-F24`, `area-personale`, `conferma`, `dati-personali`, `preferenze`, `riepilogo`, `scheda-servizio`) in `/it/tests/pagamenti-imu-<X>` (stesso nome, maiuscole comprese).
Soglie: HTML body >= 90% (o forbice spiegata dai soli URL), pixel >= 97% a 1920/1440/992/768/375 px con altezze identiche.
Scheletro generico: `blocks/service-flow/` (DCP-21). Questa story aggiunge solo JSON e file nuovi con prefisso `imu-` dentro il blocco.

## Baseline (misurata)
- Prima di scrivere: nessun file `tests.pagamenti-imu-*.json` in tenant e modulo (`ls`), nessun altro file con quegli `slug`. `/it/tests/pagamenti-imu-scheda-servizio` rispondeva HTTP 200 (curl) senza il contenuto.
  Non ho misurato HTML e pixel di quella pagina vuota (non c'era nulla da confrontare).
- Dopo il JSON e **prima** della rigenerazione di `components.css` (CSS compilato com'e' ora), a 1440 px senza CSS iniettato: conferma 83,6% (altezze 2102-2042),
  dati-personali 94,52% (3433-3484), preferenze 72,69% (5373-4655). Cioe' mancano regole CSS che l'orchestratore aggiunge con la rigenerazione (vedi "Da ri-verificare").

## Cosa e' stato fatto
1. **JSON x7** `tests.pagamenti-imu-<X>.json` in `laravel/config/local/fixcity/database/content/pages/` e `laravel/Modules/Fixcity/config/database/content/pages/` (file identici, un solo `slug` per sede).
   Un solo blocco `service-flow` per pagina, `view` = `pub_theme::components.blocks.service-flow.imu-design-comuni`. Dati estratti dal riferimento con uno script (jsdom, testo letto dal DOM, non copiato a mano)
   e controllati con i conteggi (sezioni: scheda 9, area personale 2+2 sezioni in 4 pannelli, dati personali 3 + 4 finestre, preferenze 3 schede, riepilogo 5, anteprima 1, conferma 0).
   `feedback`, `contacts`, `related` e le azioni del titolo sono quelli di `tests.servizi-pagamento-scheda-servizio.json` (stesso testo nel riferimento IMU: verificato col confronto HTML).
2. **Ingresso IMU** `service-flow/imu-design-comuni.blade.php`: sceglie `pages/imu-<kind>` e, se non esiste, `pages/<kind>` condiviso (`@includeFirst`). Nessun file condiviso modificato.
3. **File nuovi (17, 394 righe)**, tutti dentro `service-flow/`:
   - pagine: `pages/imu-wizard-step` (come `wizard-step` piu' `stepper_note` e `body.lead`), `pages/imu-confirmation` (esito senza indice laterale, con `after`);
   - sezioni: `imu-title`, `imu-callout` (`text_block_class`, nel riferimento IMU e' `d-lg-block`), `imu-summary` (`total_class`), `imu-flow` (pulsanti con `<span>` senza class),
     `imu-service-contacts` (`card-text`, `email_href`), `imu-card` (scheda grigia a blocchi, con o senza `<section class="it-page-section">`, `header_content`);
   - contenuti di scheda (`card-content/`): `imu-stack` (sequenza di blocchi annidabile), `imu-select`, `imu-input`, `imu-toggle` (`cmp-toggle`), `imu-check-cards` (`cmp-info-checkbox`: righe, interruttore, info, righe pagamento, accordion, pulsante "aggiungi" con finestra), `imu-total` (`cmp-tot`), `imu-activities` (titolo con `underline`);
   - finestra: `modals/imu-fields` (finestra "Immobile" con menu e campi).
   Riusati senza modifiche: `stepper`, `nav-steps`, `side-index`, `info-summary`, `rating`, `contacts`, `related`, `heading`, `breadcrumb`, `card` (area personale), `filtered-accordion`, `info-cards`, `messages`, modali `dialog`/`upload`/`message`.
4. **Manifest**: 7 righe in coda a `scripts/design-comuni-pages.txt` (`servizi/pagamenti-imu-*.html`) e 11 righe in coda a `scripts/design-comuni-states.txt`
   (`label[for=toggle-toggle]` 1440; `label[for="toggle-1"]` 1440 e 375; `label[for="1"]` 1440 e 375; finestra Immobile 1440 e 375; `#collapse-benef-4` 1440; `#collapse-benef-1` 1440 e 375; `#dropdownMenu-pratiche` 1440).
5. Nessuna immagine nuova (`folder-concluded.svg`, `folder-pay.svg` c'erano; l'avatar e' `picsum.photos` come nel riferimento).

## Risultati misurati
Tutte le misure sono sullo stato attuale del sito (`http://192.168.1.40:8000`).

### HTML body (`compare-body-html.mjs`; l'ultima coppia di colonne con la stessa formula sul solo `<main>`, calcolata con uno script mio, non con il gate)
| Pagina | body rigorosa | body URL normalizzati | solo `<main>` rigorosa | solo `<main>` normalizzata |
|---|---|---|---|---|
| pagamenti-imu-anteprima-F24 | 89,57% | 98,17% | 96,62% | 99,69% |
| pagamenti-imu-area-personale | 87,15% | 95,84% | 93,37% | 99,83% |
| pagamenti-imu-conferma | 87,7% | 97,61% | 95,31% | 98,94% |
| pagamenti-imu-dati-personali | 92,71% | 98,91% | 96,68% | 99,78% |
| pagamenti-imu-preferenze | 89,43% | 98,15% | 96,51% | 99,68% |
| pagamenti-imu-riepilogo | 90,31% | 98,31% | 97,14% | 99,74% |
| pagamenti-imu-scheda-servizio | 90,16% | 98,23% | 95,04% | 99,22% |

Lettura: nei `<main>` (URL normalizzati) i token diversi sono: anteprima, area personale, preferenze, riepilogo 0 solo-riferimento e 2 solo-locale (il `<div wire:key ... wire:snapshot>` di Livewire e il suo `</div>`);
conferma 1/3 (in piu' `for="radio-4"` contro `for="radio-5"` dell'ultima risposta della valutazione, refuso del riferimento); dati-personali 1/3 (in piu' l'ordine `href`/`class` del collegamento "Contattaci"); scheda-servizio 3/5
(in piu' `onclick` del menu "Ascolta", `aria-hidden` del primo svg dei correlati, `radio-4`/`radio-5`). Sono i file condivisi elencati in "Modifiche condivise richieste".
La rigorosa sotto 90% di 4 pagine (anteprima, area personale, conferma, preferenze) e' spiegata dai valori degli URL: nel riferimento gli sprite sono `../assets/bootstrap-italia/dist/svg/sprites.svg#it-x`,
nel locale `http://192.168.1.40:8000/themes/Sixteen/design-comuni/assets/.../sprites.svg#it-x` (`asset()`), piu' i `href` di header e footer (chrome condiviso). Con gli URL normalizzati: 97,61-98,91% su 6 pagine.
**Area personale: 95,84% normalizzata, non solo URL.** Il riferimento ha l'header con utente collegato ("Mario Rossi", menu `it-user-wrapper`): sul body intero 65 token solo-riferimento contro 22 solo-locale;
l'elenco dei token diversi e' quello dell'header (utente, menu) piu' footer, `<link>` e `<style>` condivisi. L'header e' una sezione condivisa (`slug=header`, nessuna variante per pagina): non risolvibile dal JSON della pagina,
vedi "Modifiche condivise richieste". Nel solo `<main>` la pagina e' al 99,83% normalizzata.

### Pixel (CSS delle 7 pagine estratto con `extract-used-css.mjs` in un file privato e iniettato **solo nella pagina locale**; `--stub-images 'picsum\.photos|via\.placeholder\.com'`)
Riferimento: `servizi/pagamenti-imu-<X>.html`. Valore (altezza riferimento = altezza locale).

| Pagina | 1920 px | 1440 px | 992 px | 768 px | 375 px |
|---|---|---|---|---|---|
| pagamenti-imu-anteprima-F24 | 99,95% (4513=4513) | 99,93% (4513=4513) | 99,9% (4588=4588) | 99,88% (4745=4745) | 99,79% (5323=5323) |
| pagamenti-imu-area-personale | 99,77% (2854=2854) | 99,69% (2854=2854) | 99,56% (2902=2902) | 99,8% (2888=2888) | 99,67% (3601=3601) |
| pagamenti-imu-conferma | 99,88% (2102=2102) | 99,85% (2102=2102) | 99,79% (2180=2180) | 99,73% (2062=2062) | 99,61% (2873=2873) |
| pagamenti-imu-dati-personali | 99,87% (3433=3433) | 99,83% (3433=3433) | 99,74% (3481=3481) | 99,85% (3544=3544) | 99,74% (4387=4387) |
| pagamenti-imu-preferenze | 99,93% (5373=5373) | 99,91% (5373=5373) | 99,87% (5421=5421) | 99,83% (5047=5047) | 99,69% (5731=5731) |
| pagamenti-imu-riepilogo | 99,96% (5434=5434) | 99,94% (5434=5434) | 99,92% (5482=5482) | 99,9% (5422=5422) | 99,81% (5893=5893) |
| pagamenti-imu-scheda-servizio | 99,91% (5025=5025) | 99,88% (5025=5025) | 99,86% (5349=5349) | 99,86% (5681=5681) | 99,77% (7180=7180) |

Minimo 99,56% (area personale @992). Tutte le altezze sono identiche.
**Questo risultato dipende dall'iniezione del CSS**: senza (CSS compilato attuale) i valori sono quelli della sezione "Baseline". Va ri-misurato col gate reale dopo la rigenerazione (`regenerate-design-comuni-css.sh`).

### Comportamenti (pagina intera, `--selector body --click`, CSS privato iniettato; stesso clic su riferimento e locale)
| Pagina | Larghezza | Clic | Parity (altezze) |
|---|---|---|---|
| scheda-servizio | 1440 | `#shareActions` | 99,91% (5026=5026) |
| scheda-servizio | 1440 | `#viewActions` | 99,88% (5026=5026) |
| scheda-servizio | 1440 | `label[for=star4a]` (valutazione) | 99,76% (5580=5580) |
| scheda-servizio | 375 | `a.show-more` | 99,77% (7261=7261) |
| area-personale | 1440 | scheda "Attivita'" (`a[href="#data-ex-tab3"]`) | 99,69% (3226=3226) |
| area-personale | 1440 | scheda Attivita' > `button[data-bs-target="#collapse1"]` | 99,69% (3359=3359) |
| area-personale | 1440 | scheda Attivita' > `#dropdownMenu-pratiche` | 99,63% (3226=3226) |
| area-personale | 1440 / 375 | `[data-bs-target="#modal-message"]` | 99,81% (2854=2854) / 99,69% (3602=3602) |
| riepilogo | 1440 / 375 | `button.steppers-btn-confirm` (finestra termini) | 99,98% (5434=5434) / 99,94% (5893=5893) |
| anteprima-F24 | 1440 / 375 | `button.steppers-btn-confirm` | 99,98% (4513=4513) / 99,94% (5324=5324) |
| dati-personali | 1440 | accordion `#collapse-benef-2` | 99,82% (4854=4854) |
| dati-personali | 1440 / 375 | `button.steppers-btn-confirm` (finestra salvataggio) | 99,8% (3433=3433) / 99,9% (4388=4388) |
| dati-personali | 1440 / 375 | `button[data-bs-target="#modal-tributes"]` (finestra Immobile) | 99,8% (3433=3433) / 100% (4388=4388) |
| preferenze | 1440 | `label[for="toggle-1"]` (leva "Ravvedimento", solo CSS) | 99,91% (5374=5374) |
| preferenze | 1440 | `label[for="1"]` (casella "Acconto"; manca anche qui `has-border-green`, vedi sotto) | 99,85% (5374=5374) |
| preferenze | 1440 | `button.steppers-btn-confirm` | 99,96% (5374=5374) |
| conferma | 1440 | `label[for=star4a]` | 99,88% (2657=2657) |

Verifica DOM (`.modal.show` dopo il clic): riepilogo "Avanti" a 1440 e dati-personali "Aggiungi immobile" a 1440 e 375, riferimento 1 e locale 1 in tutti i casi.

**Comportamenti NON riprodotti (misurati: differiscono)**:
| Pagina | Clic | Riferimento | Locale | Parity |
|---|---|---|---|---|
| dati-personali | `label[for=toggle-toggle]` (1440) | `.infoWrapper` perde `d-none` (altezza 3751) | invariato (3433) | 81,6% |
| dati-personali | `label[for="1"]` (casella immobile, 1440) | `.cmp-info-checkbox` riceve `has-border-green` | nessuna classe | 99,61% (altezze uguali) |
| preferenze | digitazione di "12" in `#amount-1` (1440) | compare `button.clean-input` (1) | assente (0) | non misurata a pixel |

## Differenze note
- 4 token nei `<main>` per file condivisi (descritti sotto): menu "Ascolta" senza `onclick="listenElements(...)"`, collegamento "Contattaci" di dati-personali con `href` prima di `class`, primo svg di "Contenuti correlati" con `aria-hidden` in piu'.
- Il refuso del riferimento `<label for="property-location" class="" mb-3>` e' riprodotto (`label_flag`); `href="mailto:ufficiotributia@email.it"` (con la "a" in piu') anche (`email_href`).
- `anteprima-F24` non mostra un PDF: e' un riepilogo a gruppi con il totale "Importo pagamento"; i totali (`cmp-tot`) sono testo del JSON, non calcolati.
- Link "Home" delle briciole: `/it/tests/homepage` (link funzionante) contro `homepage.html` del riferimento (1 token strict).

## Modifiche condivise richieste (non fatte: file non miei)
1. **Comportamento JS** in `resources/js/theme/design-comuni-home.js` (montato per selettore, attivo solo con `.page-content[data-slug*="tests."]`), dal sorgente del riferimento `assets/script/scripts.js`:
   a. `#toggle-toggle` su `change` -> `.infoWrapper` fa `classList.toggle('d-none')` (dati-personali; misurato 81,6% senza, altezze 3751 contro 3433);
   b. `.check-input` su `change` -> la `.cmp-info-checkbox` con lo stesso indice fa `classList.toggle('has-border-green')` (dati-personali e preferenze; misurato in dati-personali: riferimento `.cmp-info-checkbox.has-border-green` 1, locale 0, parity 99,61% senza);
   c. `input[type="text"]` su `input` -> se il valore non e' vuoto inserisce dopo il campo `<button type="button" class="clean-input" aria-label="Elimina testo di ricerca"><svg class="icon"><use xlink:href=".../sprites.svg#it-close"></use></svg></button>` (clic: svuota il campo e rimuove il pulsante; se vuoto lo rimuove); misurato: riferimento 1 pulsante, locale 0.
   Il CSS di `.clean-input` non c'e' ne' nell'estrazione privata (0 occorrenze) ne' in `components.css` (0): lo stato `--state` di `extract-used-css.mjs` supporta solo clic, serve una digitazione.
2. **Header con utente collegato** (area personale): `sections/header` (JSON `header.json` + vista) senza variante; il riferimento `pagamenti-imu-area-personale` mostra `it-user-wrapper` con avatar, "Mario Rossi", menu (I miei servizi, Le mie pratiche, Notifiche, Impostazioni, Esci). Misura: body 87,15% / 95,84% normalizzata, `<main>` 99,83%.
3. **`parts/heading.blade.php` riga 51**: la voce di menu "Ascolta" ha `onclick="listenElements(this, '[data-audio]')"` nel riferimento (anche servizi-pagamento): proposta chiave `items[].onclick` (1 token).
4. **`parts/heading.blade.php` riga 31**: l'ordine degli attributi del collegamento nei sottotitoli e' `href`, `class`; in dati-personali IMU e' `class`, `href` (proposta `link.class_first`; 1 token).
5. **`parts/related.blade.php` riga 20**: `aria-hidden="true"` su tutti gli svg; nel riferimento IMU (scheda-servizio) la prima scheda "Amministrazione" non ce l'ha (1 token).
6. Da valutare per le altre famiglie (io ho copiato in `imu-*`): `sections/summary.blade.php` riga 22 (`mb-0` fisso sul totale: aggiungere `total_class`), `sections/callout.blade.php` riga 12 (`d-md-block` fisso),
   `sections/flow.blade.php` riga 25 (`<span class="">` fisso nei pulsanti), `card-content/activities.blade.php` riga 11 (manca `underline`), `sections/service-contacts.blade.php` riga 12 (`text-decoration-none`/`data-element`, manca `card-text`).

## Da ri-verificare dopo la rigenerazione di components.css
- `parity-gate.sh` completo sulle 7 pagine (ora 99,56-99,96% solo con il CSS iniettato; senza, 72,69-94,52% a 1440).
- Stati nuovi in `design-comuni-states.txt`: interruttori, caselle, finestra Immobile, accordion `#collapse-benef-*`; `compare-screenshots.mjs --selector body --click` sui clic della tabella sopra.
- `compare-computed.mjs` su `.cmp-toggle .lever`, `.cmp-tot`, `.cmp-info-checkbox` se dopo la rigenerazione resta una differenza.
- HTML: nessun cambio atteso (non dipende dal CSS); riesaminare area-personale quando l'header avra' la variante.

## Come si controlla
```bash
bashscripts/tools/visual/parity-gate.sh https://italia.github.io/design-comuni-pagine-statiche/servizi/pagamenti-imu-riepilogo.html \
  http://192.168.1.40:8000/it/tests/pagamenti-imu-riepilogo --stub-images 'picsum\.photos|via\.placeholder\.com' --fail-if-contains '|---LINE:'
bashscripts/tools/visual/parity-sweep.sh <manifest> --jobs 3 --out /tmp/dir --only 'pagamenti-imu'
```
Dati: `tests.pagamenti-imu-<X>.json` (un blocco `service-flow`); modello dati in DCP-21 e, per i tipi `imu-*`, nell'intestazione di ogni vista in `service-flow/`.

## Cose non fatte
- `npm run build` e `regenerate-design-comuni-css.sh` (li lancia l'orchestratore).
- Comportamenti JS nuovi (sopra), header con utente collegato, validazione dei campi, ricalcolo dei totali (nel riferimento i totali sono statici, nessuno script).
- Second brain (`memory/`, indici, MEMORY.md): vietati dal mio perimetro; riga proposta per l'orchestratore: "IMU = service-flow + file `imu-*` (DCP-27); pixel 99,56-99,96% solo con CSS iniettato; mancano 3 comportamenti JS e l'header con utente".

## Verifica dell'orchestratore (parity-sweep.sh, 2026-10-13, dopo rigenerazione CSS a 81 pagine)
Rimisurato io, non dall'agente. HTML rigorosa / normalizzata (pixel minimo, altezze): pagamenti-imu-anteprima-F24 89.57 / 98.31 (pixel min 99.79, altezze uguali); pagamenti-imu-area-personale 89.89 / 98.9 (pixel min 99.69, altezze uguali); pagamenti-imu-conferma 87.7 / 97.77 (pixel min 99.61, altezze uguali); pagamenti-imu-dati-personali 92.71 / 98.99 (pixel min 99.74, altezze uguali); pagamenti-imu-preferenze 89.43 / 98.28 (pixel min 99.69, altezze uguali); pagamenti-imu-riepilogo 90.31 / 98.43 (pixel min 99.81, altezze uguali); pagamenti-imu-scheda-servizio 90.16 / 98.33 (pixel min 99.77, altezze uguali).
Stato: done con riserva: pixel >= 99,6% con altezze uguali su tutte le pagine; HTML rigoroso >= 90 su 3 di 7 (il resto per valori di `href`/`src`; le `*-area-personale` ora con header autenticato, `layouts/design-comuni-authenticated`).
