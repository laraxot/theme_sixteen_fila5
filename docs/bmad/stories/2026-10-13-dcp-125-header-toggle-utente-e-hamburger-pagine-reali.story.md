---
id: dcp-125
title: "DCP-125: header: toggle utente come <button> e hamburger che copriva il nome della Regione"
type: story
epic: dc-parity-v2
status: done
priority: P0
owner: theme:Sixteen
created: 2026-10-13
updated: 2026-10-13
qmd: "header toggle utente button btn-full permessi-area-personale 768 hamburger it-header-navbar-wrapper transform margin-top derive-dc-chrome-css Nome della Regione"
related: [dcp-32, dcp-98, dcp-106, dcp-121]
tags: [docs, sixteen, bmad]
---

# DCP-125: due difetti di header trovati dalla sweep dopo DCP-121

## Fase BMAD
Verifica (QA) con difetto trovato dal gate, poi correzione e nuova misura.

## Difetto 1: `permessi-area-personale` a 768 px (pixel 94,92%, altezze 2998 contro 2993)
- **Causa provata** (`explain-style.mjs`, box a confronto con `dcp124-boxes.mjs`): un'altra sessione ha reso `<button>` il toggle del menu utente
  (`id="header-user-toggle"`, `aria-haspopup`; corretto per l'accessibilita': apre un menu, non naviga). Il riferimento usa
  `<a class="btn btn-primary btn-icon btn-full">`. Due regole di Bootstrap Italia pensate per il selettore lingua colpiscono ogni `button` dell'header:
  `.it-header-wrapper .nav-item.dropdown button` (sfondo trasparente, 14 px) e `.it-header-slim-right-zone button` (padding verticale 7,5 px).
  Il toggle perdeva sfondo, 16 px di font e padding: 49x26 px invece di 49x41, quindi 5 px di altezza in meno su tutta la pagina.
- **Correzione**: due regole (e una `@media(min-width:576px)`) in `resources/css/design-comuni/overrides.css`, con specificita' maggiore di quelle di
  Bootstrap Italia, che ripristinano l'aspetto di `a.btn-primary.btn-icon.btn-full` (sfondo `--bs-primary`, hover `#006342`, padding verticale 12 px sotto i
  576 px e 16 px sopra). Nessun `!important`.
- **Primo tentativo sbagliato (mio)**: padding fisso a 16 px su tutte le larghezze. Risolveva 768 ma rompeva 375 (pagina 5 px piu' alta, pixel 92,79%): a
  375 px il riferimento ha 12 px (la regola `.btn-full{padding:16px}` vale solo da 576 px). Visto dal gate completo, non dal solo box a 768.
- **Secondo errore (mio)**: `background:var(--bs-btn-bg)` rendeva il bottone trasparente (la variabile e' `transparent` su `.btn`; il colore del
  primario sta su `.btn-primary` come valore diretto). Letto nel computed style, non nell'immagine.
- Aggiornati anche i 12 selettori `a.btn.btn-primary.btn-icon.btn-full` del CSS legacy (`app/13-final-runtime-overrides.css`, `app/08-layout-type-and-header.css`)
  con `:is(a, button)`: stessa specificita', ora valgono anche per il `<button>` sulle pagine reali (toggle verde 48x48 sulla home).

## Difetto 2: l'hamburger copriva "Nome della Regione" sulle pagine reali (375 e 768 px)
- **Misura**: sulla home reale `/it` il pulsante del menu stava nella barra slim (box `0,-33 56x120`, pulsante a y=3 o y=-21) e tagliava la prima lettera
  del nome della Regione. Era la voce "overlap della barra alta a 375" rimasta aperta in DCP-121.
- **Causa provata**: il wrapper e' `position:absolute; top:0; height:100%` (legacy, pensato per stare a sinistra della riga centrale: il contenuto ha
  `padding-left:3.5rem`) ma due regole lo spostavano verso l'alto: il `transform:translateY(-50%)!important` legacy e il `margin-top:-22px` derivato da
  Bootstrap Italia nel file generato `app/17-dc-chrome-mobile-nav.css`. L'esperimento nel browser (aggiungere `margin-top:0; transform:none`) lo
  riportava nella riga centrale, a sinistra del logo.
- **Correzione nel generatore** (`bashscripts/tools/visual/derive-dc-chrome-css.py`, epilogo), non nel file generato: `transform:none!important` ora sempre
  (prima solo con `body.nav-open`) e `margin-top:0` con la stessa specificita' della regola derivata. File rigenerato; il diff e' solo nell'ultima riga.
- **Misure dopo** (home reale, Playwright): a 375 px pulsante a `8,85 48x48`, a 768 px `8,61 48x96`, entrambi nella riga centrale; "Nome della Regione"
  per intero; a 1024 px nessun cambio (le regole valgono sotto i 992 px). Menu aperto a 375: pannello 375x800, `menu-wrapper` 309 px, 15 voci visibili,
  tocco sull'overlay chiude (`nav-open` torna falso); a 768: `menu-wrapper` 387 px, stesso esito.

## Misure del gate (dopo, `permessi-area-personale`)
| larghezza | pixel | altezze |
|---|---|---|
| 1920 | 99,78% | 2970-2970 |
| 1440 | 99,71% | 2970-2970 |
| 992 | 99,59% | 3018-3018 |
| 768 | 99,77% | 2998-2998 |
| 375 | 99,62% | 3708-3708 |

HTML rigorosa 94,45%, url normalizzati 97,05% (invariati). Prima: 768 a 94,92% con altezze diverse.

## Limite noto
A 992 e 1440 px il chip utente e' largo 206 px contro 184: il testo e' "Area personale" (la pagina di prova non ha un nome reale) al posto di "Mario Rossi".
Sulle pagine reali il nome e' quello dell'utente; sulle pagine di prova e' un segnaposto. Non e' un difetto di CSS.

## Lezione (da portare in `tasks/lessons.md` quando l'altra sessione non lo sta toccando)
Quando un'altra sessione cambia il tag di un elemento (`a` in `button`), grep di TUTTI i selettori che citano il tag (`a.btn...`) e delle regole di
Bootstrap Italia che citano `button` dentro lo stesso contenitore: il riferimento non le attiva perche' usa un altro tag. Un errore di 5 px a una sola
larghezza e' quasi sempre una regola che cambia solo da un breakpoint: misurare tutte e cinque le larghezze prima di dichiarare chiuso.
