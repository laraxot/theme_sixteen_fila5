---
type: epic-story
title: "Tickets Elenco — Design Comuni v2.4.0 (Pubblico, non test)"
github_issue: #103
github_discussion: #103
decision_log: docs/decision-log.md
status: draft
updated: 2026-10-13
tags: [docs, sixteen, bmad]
qmd: "story: tickets elenco redesign (pubblico trasparenza) sixteen"
---
# Story: Tickets Elenco Redesign (pubblico trasparenza)

**Scopo**: `/it/tickets` (elenco segnalazioni pubbliche) — NON `tests.` — modulo reale. Trasparenza: 73 segnalazioni risolte (12 mesi), categorie (Acqua/allagamenti 21, Ambiente/inquinamento 14, Arredo urbano 7, Disinfestazione/derattizzazione, etc.).
**Filosofia**: la città mostra il suo lavoro (risoluzioni), non solo problemi. Silenzio delle cifre — le categorie parlano.
**Logica**: elenco pubblico (non richiede login) con categorie contabili; accesso personale (`/tickets/create`) richiede login (`route('login')`) o `guest` (`middleware: [web,"guest"]` — D16).
**Regolamentazione**: GDPR 2016/679 (dati anonimi per elenco pubblico — solo categorie, nessun nome personale); CAD D.Lgs 82/2005; Design Comuni v2.4.0; AGID (accessibilità WCAG 2.1 AA, multilingua it/en).
**Zen**: il silenzio della lista — le cifre (21, 14, 7) raccontano il lavoro della città.
**Professionale**: nome reale DB (`marco.sottana@gmail.com` → Marco Sottana, NON Mario Rossi); contratti (`TicketContract`); PHPStan max; BMAD doc (D11-D16 + D17); no controller/service; NO Bootstrap (`Tailwind+DaisyUI/Flowbite+Alpine+Lit`); mobile responsive; `docs/bmad/` (125+ storie); `docs/decision-log/D11-D17`.
**Second brain**: `kp-*` (`#correction` + `#zen` + `#batch` + `#politica` + `#visual-parity`).
**Status**: In progress — visual parity con `segnalazioni-elenco.html` (20 sezioni, 4.5KB) in corso.
