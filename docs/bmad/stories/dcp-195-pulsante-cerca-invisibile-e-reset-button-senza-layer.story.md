---
id: dcp-195
title: "DCP-195: il pulsante «Cerca» di /tickets/track e' invisibile (reset di button senza layer) e altri difetti di stile del front office"
type: story
epic: dc-parity-v2
status: in-progress
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
Build (B1). Nata dall'audit [DCP-186](./dcp-186-front-office-scopo-e-senso-di-ogni-pagina-ed-elemento.story.md), gruppi A e B.

## Scopo
`/{lang}/tickets/track` e' l'unico modo per un cittadino, anche non registrato, di sapere a che punto e' una segnalazione dal codice ricevuto. Se il pulsante di invio non si vede, la funzione esiste ma non e' usabile.

## Difetto principale (B1)
- Il pulsante «Cerca» ha `bg-sky-800` + `text-white` ma risultava bianco su bianco (`background-color: rgba(0,0,0,0)`).
- Causa: reset unlayered `button/...[type=submit]{-webkit-appearance:button;background-color:#0000}` (stessa specificita' della utility, dopo nel file). Le regole senza layer battono quelle in un layer.
- Origine: preflight Tailwind fuori da `@layer` (toolchain v4 + direttive v3), poi limitato fuori Design Comuni da `isolate-legacy-important.cjs`.

## Esito B1 (D195-1 = a, 2026-10-15, ECC)
- Nuovo `postcss/layer-button-preflight.cjs`: avvolge in `@layer base` le regole unlayered su button/submit con `appearance:button` + background trasparente.
- Registrato in `postcss.config.js` **prima** di `isolate-legacy-important`.
- Build: `app-CdxND1b0.css` (manifest Sixteen). OLD unlayered → NEW `@layer base{button:not(...)}`.
- Smoke: `node postcss/layer-button-preflight.test.cjs`.
- Markup invariato (`ticket-track.blade.php` tiene `bg-sky-800`).

## Esito B18 (modale filtri mobile `/tickets`, 2026-10-15)
- `initFilterModal` in `resources/js/app.js`: focus sul primo controllo all'apertura, trappola Tab, Esc chiude e restituisce il focus al pulsante «Filtra».
- `ticket-list/modal.blade.php`: `role="dialog"`.
- Probe: `tests/browser/a11y-axe.spec.mjs` (focus in modale + Esc).

## Cose da fare
- [x] Causa del reset unlayered
- [x] D195-1(a) + rebuild
- [x] Spec Playwright contrasto «Cerca» >= 4,5:1 a 375 e 1280 px (`tests/browser/tracking-form-responsive.spec.mjs`)
- [ ] Misura browser degli altri button/submit FO con `bg-*`
- [ ] B2: layout `design-comuni` se D195-2; non toccare `middleware` (`TicketTrackPageJsonGuardTest`)
- [ ] A9: cookiebar — [cookiebar-duplicate-footer-removal](../../stories/cookiebar-duplicate-footer-removal.story.md)
- [x] B18: focus/tastiera modale filtri mobile `/tickets` (focus in apertura, Esc, trappola Tab in `app.js`; `role="dialog"`)
- [ ] Matrice interfaccia I-08 / I-24
- [x] Voce in [DCP-03](./dcp-03-legacy-parity-css-cascade-debt.story.md)

## Decisioni
| ID | Scelta | Note |
|---|---|---|
| D195-1 | **(a)** `@layer base` via PostCSS | sistemico; no override locale |
| D195-2 | aperta | dopo misure browser B1 |
| D195-3 | questa sessione ECC | fatto |

## Criteri di accettazione
- [x] Causa/correzione documentate; CSS con reset in `@layer base`
- [x] Playwright «Cerca» visibile e contrasto OK
- [ ] Nessun button FO azzerato dal reset (elenco misurato)
- [ ] Guardie Folio/JSON track verdi
- [x] Registro DCP-03 aggiornato

## Scope
- `postcss/layer-button-preflight.cjs`, `postcss.config.js`, asset CSS Sixteen
- Non toccare: middleware `tickets.track.json`; cookiebar in altra sessione
