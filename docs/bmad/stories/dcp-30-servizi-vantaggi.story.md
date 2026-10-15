---
id: dcp-30
title: "DCP-30: servizi/vantaggi-* (5 pagine) con il blocco service-flow"
type: story
epic: dc-parity-v2
status: done
priority: P1
owner: theme:Sixteen
created: 2026-10-13
updated: 2026-10-13
qmd: "design comuni parity servizi vantaggi assegno maternita scheda servizio area personale dati personali riepilogo conferma service-flow json bmad story"
tags: [docs, sixteen, bmad]
---

# DCP-30: servizi/vantaggi

## Richiesta
Replicare come pagine di prova guidate da JSON le 5 pagine `https://italia.github.io/design-comuni-pagine-statiche/servizi/vantaggi-{scheda-servizio, area-personale, dati-personali, riepilogo, conferma}.html`
(locale `/it/tests/vantaggi-<nome>`), con HTML body >= 90% (o forbice spiegata dai soli URL) e pixel >= 97% a 1920/1440/992/768/375 px con altezze identiche.
Riuso dello scheletro `blocks/service-flow/` (DCP-21): il lavoro e' soprattutto JSON. Ricetta: `docs/prompts/design-comuni-page-recipe.md`.

## Baseline (HTML misurato prima di toccare nulla; i JSON non esistevano, le pagine rispondevano 200 con il solo chrome)
| Pagina | HTML rigorosa / url-normalizzata |
|---|---|
| vantaggi-scheda-servizio | 39,09 / 43,47 |
| vantaggi-area-personale | 35,07 / 38,96 |
| vantaggi-dati-personali | 33,75 / 37,37 |
| vantaggi-riepilogo | 46,47 / 51,98 |
| vantaggi-conferma | 54,78 / 61,70 |

Pixel di base non misurati (la baseline pixel era di una pagina vuota: sarebbe stata un confronto con il solo header/footer).

## Cosa e' stato fatto
1. **Estrazione**: lo script di DCP-21 (jsdom, `extract.mjs`) copiato in scratch e adattato alle 5 pagine; conteggi controllati sul diff dei token (sezioni, schede, righe, finestre). Output: 5 JSON `tests.vantaggi-<nome>.json`, scritti **identici** in tenant (`laravel/config/local/fixcity/database/content/pages/`) e modulo (`laravel/Modules/Fixcity/config/database/content/pages/`); un solo record per slug in ciascuna cartella (grep).
   Un solo blocco `service-flow` per pagina, `view = ...service-flow.vantaggi-design-comuni` (ingresso nuovo, vedi sotto).
2. **Tipi nuovi, tutti file nuovi con prefisso `vantaggi-` dentro `blocks/service-flow/`** (nessun file esistente toccato; sono le differenze di markup misurate col diff dei token fra riferimento e rendering del service-flow condiviso):
   | File | Perche' (differenza misurata) |
   |---|---|
   | `vantaggi-design-comuni.blade.php` | ingresso: sceglie prima `pages/vantaggi-<kind>` e poi `pages/<kind>` (stesso schema di `imu-design-comuni`) |
   | `pages/vantaggi-wizard-step.blade.php` + `parts/vantaggi-heading.blade.php` | `<h1 class="title-xxxlarge w-75">` (dati-personali, riepilogo) e `<a class=.. href=..>` con `class` prima di `href`: chiavi `heading.title_class` e `subtitles[].link.class_first` |
   | `sections/vantaggi-flow.blade.php` | elenchi annidati (`{text, items[]}`) e pulsanti con `<span>` senza `class=""` |
   | `sections/vantaggi-timeline.blade.php` | descrizione `p.info-text` sotto il titolo di ogni voce (`entries[].text`) |
   | `sections/vantaggi-service-contacts.blade.php` | `card ... align-items-center` e `span.title-small.mb-2` |
   | `sections/vantaggi-callout.blade.php` | seconda frase con `d-lg-block` (il condiviso ha `d-md-block`): `text_block_class` |
   | `sections/vantaggi-heading.blade.php` | titolo `h2.title-xxlarge.mb-4.mt-40` fra callout e schede del riepilogo (`tag`, `class`, `text`) |
   | `card-content/vantaggi-cards.blade.php` + `parts/vantaggi-info-summary.blade.php` | schede persona con `cards[].expanded` (`aria-expanded="true"`), riquadro `empty` ("nessun dato"), `add.modal`; riga con valore **e** avviso (`tone: alert`) |
   | `card-content/vantaggi-activities.blade.php` | titolo `h3 ... underline` |
   | `modals/vantaggi-form.blade.php` + `parts/vantaggi-form-items.blade.php` | moduli in finestra: campi con `name`/`placeholder`/`required`, interruttore (`toggles`/`lever`), caricamento, gruppi annidati (`body_class`, `form.class`, `form.enctype`, `save_form`) |
   Totale 13 file nuovi, 408 righe, nessuno oltre 63 righe. Nessun testo, `<style>`, `x-data` o `!important` nelle viste.
3. **Manifest** (solo righe in coda): 5 righe in `scripts/design-comuni-pages.txt` (`servizi/vantaggi-*.html`) e 5 in `scripts/design-comuni-states.txt`
   (`1440|[data-bs-target="#modal-minor"]`, `1440|[data-bs-target="#modal-bank-account"]`, `375|[data-bs-target="#modal-bank-account"]`, `1440|[data-bs-target="#modal-address"]`, `1440|button[data-bs-target="#collapse2"]`). Gli altri stati usati (menu condividi/azioni, stelle, tab, modale messaggio, Avanti/Invia) sono gia' nel manifest.
4. Immagini: nessuna nuova (le `folder-*` e le icone usate esistevano; avatar `https://picsum.photos/200/200` come nel riferimento).
5. Nessun CSS/JS/partial/layout/sezione dell'header o del footer modificato; nessun `npm run build` ne' `regenerate-design-comuni-css.sh`.

## Risultato misurato

### HTML body (`compare-body-html.mjs`, pagina reale)
| Pagina | rigorosa | url-normalizzata | token rif. / locale |
|---|---|---|---|
| vantaggi-scheda-servizio | 90,26 | 98,14 | 1858 / 1871 |
| vantaggi-area-personale | 87,15 | 95,84 | 2068 / 2025 |
| vantaggi-dati-personali | 91,57 | 98,76 | 2164 / 2177 |
| vantaggi-riepilogo | 90,29 | 98,28 | 1551 / 1564 |
| vantaggi-conferma | 88,29 | 97,81 | 1304 / 1317 |

Sotto 90 rigoroso: **conferma** (88,29) e **area-personale** (87,15). Misurato col diff dei token (con `--norm` a parita' di struttura):
- *conferma*: dentro `<main>` coincide al 100% tranne gli URL (href degli sprite `<use>`, assoluti da noi e relativi `../assets/...` nel riferimento; link Home) e il `for="radio-4"` del quinto radio del rating (errore del riferimento, partial condiviso). Il resto dello scarto e' nel chrome (header/footer/modale, non nostri), URL assoluti locali. Normalizzata 97,81: **forbice spiegata dai soli URL**.
- *area-personale*: oltre agli URL, **il riferimento mostra l'header in stato "accesso effettuato"** (menu utente "Mario Rossi" con 5 voci e "Esci": 65 token solo nel riferimento contro 22 solo nel locale, "Accedi all'area personale"). Non e' un URL: richiede una modifica condivisa (vedi sotto). Il `<main>` coincide (resta solo `h3 ... underline`, risolto con `vantaggi-activities`).
- scheda-servizio e riepilogo: 4 e 0 token differenti dentro `<main>` oltre gli URL (`onclick="listenElements(...)"` non replicato; `pb-0 pb-0` del titolo del carosello e `svg` senza `aria-hidden`, partial condivisi; `for` del rating).

### Pixel (5 larghezze, altezze identiche in tutti i 25 casi)
Misurati con `compare-screenshots.mjs` **copiato in scratch con `--inject-css`**: il CSS delle 5 pagine e' estratto con `extract-used-css.mjs` (stessi argomenti dello script condiviso, solo queste 5 pagine, tutti gli stati del manifest) in un file privato fuori dal repo e iniettato nella pagina locale. Non e' la pipeline reale.

| Pagina | 1920 | 1440 | 992 | 768 | 375 | altezze (1920/1440, 992, 768, 375) |
|---|---|---|---|---|---|---|
| scheda-servizio | 99,89 | 99,89 | 99,79 | 99,79 | 99,71 | 5021, 5413, 5665, 7138 |
| area-personale | 99,75 | 99,65 | 99,50 | 99,80 | 99,67 | 2854, 2902, 2888, 3601 |
| dati-personali | 99,91 | 99,88 | 99,83 | 99,91 | 99,83 | 5846, 5918, 5879, 6678 |
| riepilogo | 99,95 | 99,94 | 99,91 | 99,90 | 99,81 | 5370, 5478, 5422, 5988 |
| conferma | 99,87 | 99,83 | 99,76 | 99,77 | 99,65 | 2531, 2609, 2434, 3199 |

**Stato reale, senza iniezione** (CSS costruito oggi, non ancora rigenerato con queste pagine): scheda-servizio, area-personale e conferma praticamente uguali ai numeri sopra (scarto <= 0,04; 99,5-99,9, stesse altezze). Sotto le pagine che usano classi non ancora nel CSS costruito:
dati-personali 375 px **90,74** (altezze 6678 / 6628) e riepilogo 992 / 768 / 375 px **94,30 / 93,40 / 91,01** (5478 / 5418, 5422 / 5362, 5988 / 5938); gli altri punti 99,84-99,96. Causa: `.w-75` (h1 `title-xxxlarge w-75`) non esiste nel CSS costruito (0 occorrenze nei due fogli che la pagina carica, `app-Blydz7vk.css` e `app-C07hFaZU.css`); con il CSS estratto iniettato le stesse misure tornano a 99,8+ con altezze uguali.
Classi usate dalle pagine e assenti dal CSS costruito (confronto fra classi del `<main>` e fogli): `w-75`, `info-text`, `lever`, `toggles`, `modal-address` (e `cmp-timeline`, la cui regola e' forse scritta con altri selettori). Le porta la rigenerazione (le 5 pagine sono nel manifest).

### Comportamenti (pagina intera dopo il clic, CSS estratto iniettato)
Condividi 99,89 e Vedi azioni 99,89 (1440; `dom-diff-after-click`: in entrambi `dropdown-menu.show`, il locale aggiunge `is-open` al wrapper); stelle voto 4 99,73 (1440, altezze 5576) e 99,62 (375, 7736);
tab Attivita' 99,68 (1440, 3226) e tab + apertura accordion `#collapse1` 99,63-99,68 (3358; una misura isolata ha dato 98,39 con stesse altezze, non riprodotta in 3 ripetizioni: animazione ancora in corso allo scatto); modale messaggio 99,79 (1440) e 99,69 (375);
card ISEE aperta (`#collapse2`) 99,81 (1440, 6397) e 99,84 (375, 7185); modali Minore 99,85, Conto bancario 99,79 (1440) e 99,83 (375), Indirizzi 99,82 e Avanti (modale salvataggio) 99,84, tutti a 1440 con altezza 5846 (a 375 il conto bancario ha altezza 6678);
Invia (modale termini) riepilogo 99,98 (1440) e 99,95 (375), Salva richiesta 99,94 (5428); stelle voto 2 in conferma 99,70 (3086).
Non misurati: il carosello dei correlati dopo il clic sui "Vedi altri" (non cambia il DOM nel riferimento oltre al collapse), le frecce Splide.

## Modifiche condivise richieste (non fatte: fuori dalla famiglia)
1. **Header "accesso effettuato"** (`components/sections/header/design-comuni.blade.php` righe ~62-66, il `<a class="btn btn-primary btn-icon btn-full">` della zona destra): per `vantaggi-area-personale` il riferimento mostra il menu utente (`div.it-user-wrapper.nav-item.dropdown` con avatar `img.border.rounded-circle.icon-white alt="Mario Rossi"`, nome, `it-expand`, tendina "I miei servizi / Le mie pratiche / Notifiche / Impostazioni / Esci"). Esiste gia' il partial `sections/header/partials/personal-area-guest-parity.blade.php` con quasi lo stesso markup, ma il layout di test non lo include. Misura che lo giustifica: 65 token solo nel riferimento (43 netti) su 2068, rigorosa area-personale 87,15% (sotto 90).
2. **`parts/info-summary.blade.php` righe 28-36**: una riga con `value` e `status.tone = alert` (es. "Domicilio" di dati-personali) viene resa come esito positivo (`description-success` dentro `div.border-light`) invece di `p.data-text` + `p.description-alert`. Corretto in `parts/vantaggi-info-summary`; proposta: ramo su `status.tone` anche nel condiviso (misura prima del rimedio, dati-personali: 1 riga, 5 token diversi dal riferimento: 3 solo nel locale, 2 solo nel riferimento).
3. **`parts/heading.blade.php` riga 21**: chiave `heading.title_class` per `<h1 class="title-xxxlarge w-75">` (oggi fisso `title-xxxlarge`), e ordine degli attributi del link nei sottotitoli. Risolto in `parts/vantaggi-heading`; se si porta nel condiviso, `pages/vantaggi-wizard-step` e `parts/vantaggi-heading` si possono eliminare.
4. **`sections/{flow,timeline,service-contacts,callout}` e `card-content/{activities,info-cards}`**: le differenze della tabella sopra (liste annidate, `info-text` nella timeline, classi della scheda contatti, `d-lg-block`, `underline`, `expanded`/`empty`/`add.modal`) sono varianti `vantaggi-`; se un'altra famiglia ha le stesse, unificare con chiavi opzionali.
5. **Rating**: il quinto radio ha `for="radio-4"` nel riferimento (errore); da noi `radio-5`. 1 token in `parts/rating.blade.php`/`dc-rating`. **`parts/related.blade.php`**: `<h2 ... pb-0 pb-0>` e `<svg class="icon icon-md">` senza `aria-hidden` nella prima card del riferimento (2 token). **Tendina "Vedi azioni"**: `onclick="listenElements(this, '[data-audio]')"` non replicato (la funzione e' di `scripts.js` del riferimento e non esiste da noi). Nessuno dei tre incide sui pixel.
6. **Rigenerare il CSS** (`scripts/regenerate-design-comuni-css.sh`, lo lancia l'orchestratore): le 5 pagine e gli stati sono nei manifest. Porta `w-75`, `info-text`, `toggles`, `lever`, `modal-address`.

## Verifiche che restano dopo la rigenerazione
`parity-gate.sh` completo sulle 5 pagine (in particolare dati-personali 375 e riepilogo 992/768/375, oggi 90-94% senza il CSS); `find-important-overrides.mjs` a 0; modali aperte (Minore, Conto bancario, Indirizzi con interruttore) a 1440 e 375 con la pagina reale; hover su `.cmp-info-button-card`, `.cmp-card-latest-messages`, `.list-item` della colonna laterale (`compare-computed.mjs --hover`, `explain-style.mjs --state hover`); sentinelle (`/it`, `/it/tickets`, le 7 pagine `servizi-pagamento-*`); dopo la modifica 1 rimisurare area-personale.

## Differenze note
- `<a href="homepage.html">` del breadcrumb e' `/it/tests/homepage` (link funzionante); i link `#` restano `#`.
- Titoli di pagina in `title.it`/`title.en` identici all'`h1`; `content_blocks.en` e' vuoto, come nelle pagine `servizi-pagamento-*` (le pagine di prova esistono in italiano).
- I moduli nelle finestre sono solo markup (nessun invio), come nel riferimento statico.

## Come si controlla
`bash`: `bashscripts/tools/visual/compare-body-html.mjs https://italia.github.io/design-comuni-pagine-statiche/servizi/vantaggi-<nome>.html http://192.168.1.40:8000/it/tests/vantaggi-<nome>`; `parity-gate.sh` con gli stessi due URL e `--stub-images 'picsum\.photos|via\.placeholder\.com' --fail-if-contains '|---LINE:'`.

## Trappole (lezioni)
- **Blade non riconosce `@if`/`@endif` attaccati a una lettera**: `required@endif>` e `@endif@if` danno `syntax error ... unexpected token "case"/"endif"` (la regex delle direttive usa `\B@`). Meglio comporre l'attributo con `{!! cond ? ' required' : '' !!}`, oppure lasciare uno spazio o un `"` prima della direttiva.
- Dopo un 500 da Blade: `cd laravel && php artisan view:clear`.
- Il valore di una riga di riepilogo puo' stare fuori da `div.border-light` (riga con avviso): l'estrazione deve cercare `p.data-text` nella riga, non dentro `.border-light`.

## Verifica dell'orchestratore (parity-sweep.sh, 2026-10-13, dopo rigenerazione CSS a 81 pagine)
Rimisurato io, non dall'agente. HTML rigorosa / normalizzata (pixel minimo, altezze): vantaggi-area-personale 89.89 / 98.9 (pixel min 99.66, altezze uguali); vantaggi-conferma 88.29 / 97.96 (pixel min 99.65, altezze uguali); vantaggi-dati-personali 91.57 / 98.85 (pixel min 99.83, altezze uguali); vantaggi-riepilogo 90.29 / 98.41 (pixel min 99.81, altezze uguali); vantaggi-scheda-servizio 90.26 / 98.25 (pixel min 99.71, altezze uguali).
Stato: done con riserva: pixel >= 99,6% con altezze uguali su tutte le pagine; HTML rigoroso >= 90 su 3 di 5 (il resto per valori di `href`/`src`; le `*-area-personale` ora con header autenticato, `layouts/design-comuni-authenticated`).
