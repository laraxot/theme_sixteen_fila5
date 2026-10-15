---
id: dcp-195
title: "DCP-195: il pulsante «Cerca» di /tickets/track e' invisibile (reset di button senza layer) e altri difetti di stile del front office"
type: story
epic: dc-parity-v2
status: open
priority: P1
owner: theme:Sixteen
created: 2026-10-15
updated: 2026-10-15
qmd: "pulsante cerca tickets track bianco su bianco reset button senza layer tailwind cascade layer bg-sky-800 type submit appearance button cookiebar altezza track layout app design comuni"
related: [dcp-186, dcp-183, dcp-03, dcp-206]
tags: [docs, sixteen, bmad, css, front-office]
---

# DCP-195: «Cerca» invisibile e difetti di stile

## Fase BMAD
Plan. Nata dall'audit [DCP-186](./dcp-186-front-office-scopo-e-senso-di-ogni-pagina-ed-elemento.story.md), gruppi A e B. Nessun codice toccato dall'audit.

## Scopo di cio' che si corregge
`/{lang}/tickets/track` e' l'unico modo per un cittadino, anche non registrato, di sapere a che punto e' una segnalazione dal codice ricevuto (scopo del progetto: «il cittadino vede che cosa accade dopo»). Se il pulsante di invio non si vede, la funzione esiste ma non e' usabile.

## Difetto principale (B1, VERIFICATO dal coordinatore il 2026-10-14)
- Il pulsante «Cerca» ha `class="min-h-12 rounded-lg bg-sky-800 ... text-white"` ma risulta **bianco su bianco** a 375 e a 1280 px (stile calcolato: `color: rgb(255,255,255)`, `background-color: rgba(0,0,0,0)`).
- **Causa (corretta rispetto al rapporto dell'agente):** `bg-sky-800` esiste nel CSS compilato (1 occorrenza, variabile `--color-sky-800` definita). Perde la cascata contro una regola **senza layer** `button:not(...),[type=button]:not(...),[type=reset]:not(...),[type=submit]:not(...){-webkit-appearance:button;background-color:#0000;background-image:none}`: stessa specificita' (0,1,0), la regola del reset viene dopo nel file. Prova: `CSS.getMatchedStylesForNode` (CDP): la utility e il reset sono entrambi `layer=(nessun layer)`; un'altra regola `button{background-color:#0000}` e' in `@layer base`.
- Le regole senza layer battono quelle in un layer; quindi ogni utility Tailwind che imposta `background-*` su un `button` o `[type=submit]` fuori dalle pagine Design Comuni e' esposta allo stesso difetto.
- **Il rebuild del tema non lo risolve** (verificato: il CSS ricostruito contiene le stesse due regole).
- **Origine del reset: non identificata con certezza.** Non c'e' in `flowbite/dist/flowbite.css` ne' nei sorgenti del tema; `resources/css/app.css` usa le direttive di Tailwind 3 (`@tailwind base; @tailwind components; @tailwind utilities;`, righe 23-25) con Tailwind 4 installato. Ipotesi, da verificare: un preflight in stile v3 emesso fuori da `@layer`.

## Cose da fare
- [ ] Identificare l'origine del blocco `-webkit-appearance:button;background-color:#0000;background-image:none` (provare a compilare togliendo, uno alla volta, `@tailwind base`, `@plugin "daisyui"`, `flowbite.css`; usare un build in cartella temporanea come in DCP-183).
- [ ] Applicare la correzione scelta (decisione D195-1) e **provarla con un test in browser**: stile calcolato del pulsante diverso dallo sfondo del form, contrasto >= 4,5:1, a 375 e 1280 px (spec Playwright accanto a `tests/browser/design-comuni-utility-pages.spec.mjs`).
- [ ] Controllare gli altri `button`/`[type=submit]` con utility di sfondo nel tema (grep di `bg-` su `<button` e `type="submit"` nelle viste) e misurare lo stile calcolato di ciascuno: il difetto e' sistemico, non solo del tracciamento.
- [ ] B2: `tickets.track.json` ha `layout: "app"` (nessun breadcrumb, stile diverso dalle altre pagine pubbliche). Portare la pagina a `design-comuni` se la decisione D195-2 lo conferma; il contratto del JSON (middleware `throttle:10,1`) non va toccato (guardia `TicketTrackPageJsonGuardTest`).
- [ ] A9: la cookiebar e' alta 187 px (21% di 900 px, 36% a 375x800) e a 1280x900 copre il CTA dell'hero. Coordinare con [2026-10-15-cookiebar-duplicate-footer-removal](../../stories/cookiebar-duplicate-footer-removal.story.md) (un'altra sessione): ridurre l'altezza o renderla un banner basso compatto; misurare con la debug bar spenta.
- [ ] B18: nella modale dei filtri mobile di `/tickets` il focus da tastiera non entra e le frecce non cambiano scheda (WCAG 2.1.1 e 2.4.3). Aggiungere trappola del focus e gestione delle frecce, con test axe e tastiera.
- [ ] Aggiornare la matrice di interfaccia [I-08, I-24] con i valori misurati dopo la correzione.

## Decisioni da prendere
| ID | Domanda | Opzioni | Raccomandazione | Chi decide | Blocca |
|---|---|---|---|---|---|
| D195-1 | Dove si corregge il reset? | (a) metterlo in `@layer base` cosi' le utility lo battono; (b) sostituire le direttive v3 con `@import "tailwindcss"` e togliere il preflight duplicato; (c) un override locale sul pulsante | (a) se l'origine e' un blocco nostro, (b) se e' il preflight v3: e' la radice. Evitare (c): lascia il difetto per gli altri pulsanti | sviluppo, con chi sta lavorando al build (DCP-183) | il build del tema |
| D195-2 | `tickets/track` passa a Design Comuni? | si' (coerenza con le altre pagine pubbliche) / no (resta nativa) | si', ma dopo D195-1, perche' dentro `data-dc` il problema non si presenta | prodotto | solo B2 |
| D195-3 | Chi esegue il build che consegna la correzione? | questa sessione / chi ha modificato i template / una finestra concordata | una finestra concordata, dopo le risposte alle tre domande aperte di DCP-183 | chi coordina il tema | consegna di D195-1 |

## Criteri di accettazione
- [ ] Spec Playwright rosso prima, verde dopo: «Cerca» visibile e con contrasto >= 4,5:1 a 375 e 1280 px.
- [ ] Nessun `button` o `[type=submit]` del front office ha sfondo trasparente per effetto del reset (elenco misurato).
- [ ] `FolioPageMountContractTest` e `TicketTrackPageJsonGuardTest` verdi.
- [ ] La causa e la correzione sono scritte qui e nel registro di [DCP-03](./dcp-03-legacy-parity-css-cascade-debt.story.md).

## Non verificato
Origine esatta del reset; l'effetto della correzione sul resto delle pagine non Design Comuni (login, wizard Filament); il comportamento dopo il build (mai eseguito in questa sessione).
