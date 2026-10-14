---
id: dcp-121
title: "DCP-121: mobile e tablet: menu dell'header sulle pagine reali e audit dei bersagli e delle larghezze"
type: story
epic: dc-parity-v2
status: in-progress
priority: P0
owner: theme:Sixteen
created: 2026-10-13
updated: 2026-10-13
qmd: "mobile tablet menu hamburger header design comuni pagine reali navbar-collapsable nav-open derive-dc-chrome-css isolate-legacy-important 375 768 touch 44px"
related: [dcp-32, dcp-51, dcp-106, dcp-120]
tags: [docs, sixteen, bmad]
---

# DCP-121: il menu principale funzionava solo sulle pagine di prova

## Requisito (utente)
Il sito deve essere ottimizzato per cellulare e tablet. Norma di riferimento sull'accessibilita' dei bersagli e del riflusso: WCAG 2.1 AA (1.4.10 riflusso, 2.5.5/2.5.8 dimensione del bersaglio: il minimo AA di WCAG 2.2 e' 24x24 px, il consigliato AAA 44x44); le citazioni vanno verificate da DCP-112.

## Difetto misurato (2026-10-13 17:20, Playwright a 375 px, touch)
Sulle pagine REALI (home `/it`, login, ...), che dopo il cambio di `layouts/app` usano l'header Design Comuni, il menu principale si apriva ma il pannello risultava largo **47,6 px e traslato fuori schermo** (`translateX(-47.6px)`): menu inutilizzabile su telefono. Sulle pagine di prova `/it/tests/*` funzionava (pannello 375x800, voci in colonna, fascia di 66 px a destra che chiude al tocco).

## Cause (provate con CDP/`explain-style`)
1. **JS**: i comportamenti Design Comuni (`expanded`, display, backdrop) si attivavano solo con `.page-content[data-dc]`; le pagine reali non lo hanno. `isDesignComuniPage()` ora e' vero anche con `header.it-header-wrapper`.
2. **CSS**: il CSS generato vale sotto `body:has(.page-content[data-dc])`: le pagine reali non lo ricevono. Estenderlo a tutta la pagina avrebbe disattivato il legacy e le utility Tailwind che le pagine reali usano. Quindi `bashscripts/tools/visual/derive-dc-chrome-css.py` ricava da `components.css` le sole regole del menu mobile (114 regole, solo `max-width: 991.98px`) con scope `body:has(.it-header-wrapper):not(:has(.page-content[data-dc]))` -> `resources/css/app/17-dc-chrome-mobile-nav.css` (GENERATO: rieseguirlo dopo ogni rigenerazione di `components.css`).
3. **Legacy con `!important`** sul pannello (`width:85%!important`, `transform:translate(-100%)!important`, `a{padding:0!important}`): battevano le regole nuove. Il plugin PostCSS (`isolate-legacy-important.cjs`) le esenta nel sottoalbero del pannello **solo con `body.nav-open`** (menu aperto, quindi solo sotto i 992 px).
4. **Antenato con `transform`**: `.it-header-navbar-wrapper{transform:translateY(-50%)!important}` (legacy) rende `position:fixed` relativo a se stesso: pannello 56x120. Mentre il menu e' aperto la trasformazione si toglie (unico `!important` del file generato).
5. **Overlay non cliccabile**: `.navbar-collapsable .overlay{z-index:-1}` legacy: il tocco sulla fascia non chiudeva. `z-index:auto; pointer-events:auto` nello stesso file.
6. **Bug in `updateBodyLock`** (`header-mobile-nav.js`): `.is-open` si accodava solo all'ULTIMO selettore della lista e `#nav4.navbar-collapsable` (sempre presente) teneva `nav-open` sul body a menu chiuso: effetto visibile solo dopo il fix 4 (il pulsante restava spostato di 60 px dopo la chiusura).

## Errori miei lungo il percorso (documentati perche' si ripetano meno)
- Prima esenzione del pannello valida su TUTTE le larghezze: il menu desktop spariva a 1440 px (visto solo confrontando i pixel dopo il build) e poi tornava con pesi e colori sbagliati perche' le regole legacy dei link erano spente. Rimediato con `body.nav-open`.
- Prima famiglia di selettori troppo stretta (63 regole): le voci si disponevano in riga e uscivano dallo schermo; mancavano `.navbar-nav`, `.menu-wrapper`, `.navbar`.

## Misure dopo (stesso strumento)
- Desktop 1440 `/it` contro la baseline (prima delle modifiche): **identico**, tranne la fascia delle tile della mappa (varia con i tempi di caricamento).
- 375 px `/it`: pannello 375x800 con `menu-wrapper` 309 px (come la pagina di prova), voci in colonna, tocco sulla fascia a destra chiude, Escape chiude, il pulsante torna alla posizione iniziale (y=3) dopo la chiusura, 0 errori JS. Pagina di prova `/it/tests/homepage`: comportamento invariato.
- Bersaglio del pulsante del menu: 48x48 sulle pagine reali; **24x24 sulle pagine di prova** (riferimento): minimo AA, sotto il consigliato.
- Pulsante utente senza nome accessibile sotto `lg` (axe critical su ogni pagina da loggato, segnalato da AP-A e AP-B): `aria-label` dalla chiave `pub_theme::header.user.aria.toggle_menu.label` (it/en/de/es) in `sections/header/design-comuni.blade.php`.

## Aperto (mobile/tablet)
- ~~A 375 px la barra superiore copre il nome della regione con l'icona del menu~~ **chiuso in DCP-125** (hamburger riportato nella riga centrale, misurato a 375 e 768 px).
- ~~Contenitore del marchio nel footer oltre il viewport~~ **chiuso in DCP-129** (footer delle pagine reali in colonna sotto 768 px, misurato a 375).
- La casella "Ricevi aggiornamenti via email" ha l'etichetta alta 24 px; breadcrumb "Home" e indice laterale sotto 44 px (componenti del riferimento).
- `map-lit` ha `min-height: 320px` contro 305 px del riferimento (+15 px a 375 su `/it/tickets`): serve una modifica in `Modules/Geo/resources/js/components/map-lit.js:140-141` con build di Geo.
- ~~Audit sistematico delle pagine reali a 375/768/1024~~ **fatto in DCP-129** (13 percorsi, ospite e loggato: 0 px di scroll orizzontale; difetto del footer corretto; bersagli < 24 px elencati). Restano i testi lunghi de/es da misurare a mano.
