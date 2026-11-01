---
id: dcp-170
title: "DCP-170: audit visuale e semantico della Cookiebar"
type: story
epic: dc-parity-v2
status: ready-for-dev
priority: P0
owner: theme:Sixteen
module: Sixteen
created: 2026-10-14
updated: 2026-10-14
qmd: "cookiebar audit visuale semantica bootstrap italia tailwind alpine gdpr statikbe accessibilita"
related: [dcp-153, dcp-158, 6.3, 6.5, 6.7, 8.13]
tags: [docs, sixteen, bmad]
---

# DCP-170: audit visuale e semantico della Cookiebar

## Lacuna e prova

L'ispezione dei file del tema mostra più implementazioni: `partials/cookie-bar.blade.php`,
`bootstrap-italia/cookiebar.blade.php`, `utilities/ui/cookiebar.blade.php` e il modulo
JavaScript `cookie-consent.js`. La partial auditata contiene `data-bs-accept`, `#` come
destinazione predefinita, `localStorage` separato dal consenso Statikbe/Gdpr, testo di
default non localizzato, HTML non validato nel messaggio e CSS/JS inline. Sono rischi
funzionali, di accessibilità e di duplicazione del runtime; non sono una dichiarazione
di conformità.

## Riferimenti

- Cookiebar Bootstrap Italia: https://italia.github.io/bootstrap-italia/docs/componenti/cookiebar/
- Stack vincolante: TailwindCSS + Alpine.js + Lit + DaisyUI + Flowbite, no Bootstrap runtime.
- Decisione: Statikbe è l'unico runtime cookie; Gdpr possiede categorie, revoca e audit.
  [Source: `bmad-output/decision-log.md`, Cookiebar senza Bootstrap runtime]

## Criteri di accettazione

- [ ] Un solo punto di rendering pubblico è identificato; le implementazioni duplicate
  sono rimosse o dichiarate archivio, senza introdurre un secondo consenso.
- [ ] L'audit DOM verifica struttura, ordine dopo `body`, heading/label, focus,
  tastiera, responsive 375/768/1440, contrasto, reduced motion e stati nascosto/visibile.
- [ ] Non restano `data-bs-*`, Bootstrap CSS/JS, `#` per Preferenze, `localStorage`
  concorrente o testi hard-coded nel percorso canonico.
- [ ] Il consenso opzionale è bloccato prima della scelta, la revoca riapre le
  preferenze e il comportamento è verificato su it/en/de/es o segnalato come gap.
- [ ] L'evidenza comprende screenshot, DOM snapshot, axe e test browser; un audit
  visuale non viene usato come prova legale senza approvazione del titolare/DPO.

## Dipendenze e scope

Blocked by: 6.3, 6.7, 8.5, 8.13. Blocks: DCP-173 and release evidence.
Owned evidence: `docs/bmad/audits/cookiebar-visual-semantic-audit.md`.
Implementation files are owned by the external dev story 6.3/6.5/6.7 and must not be
modified opportunistically by this audit.

## Strategia di verifica

Use browser snapshots and axe at the three viewports, inspect computed styles and
keyboard tab order, test clean/accepted/rejected/revoked consent states, and assert
that optional scripts do not load before consent. Use synthetic data only.

## Dev Agent Record

_(empty — to be completed by the external dev tool)_
