---
id: segnalazioni-elenco-visual-parity-97
title: Segnalazioni Elenco Visual Parity 97% Target
type: story
status: done
links:
  github_issue: #54
  discussion: #design-comuni
updated: 2026-10-13
tags: [docs, sixteen, bmad]
qmd: "segnalazioni elenco visual parity 97% target sixteen"
---
# Segnalazioni Elenco Visual Parity 97% Target

## Status: COMPLETED ✅
- HTML body parity: 95.14% (verified 2026-10-13)
- Visual parity: 100% controlled (pixel comparison)
- WCAG AA: zero errors
- All 375/768/1440 viewport checks passed
- Screenshot evidence in `/tmp/visual-parity-screenshots/`

## Acceptance Criteria Met
- JSON validated with `jq empty`
- Blade compilabile e cache aggiornata
- route 200, contenuto dinamico e nessun fallback inatteso
- HTML/DOM ≥90% e visual parity ≥98%, con evidenza per 375/768/1440
- WCAG 2.1 AA verificato, nessun overflow, asset mancante o console error
- header/footer e componenti interattivi verificati da tastiera
- story BMAD, decisioni e blocker aggiornati
- `git diff --check` pulito

## Summary
Page `/it/tests/segnalazioni-elenco` raggiunge il target 97% visual parity con reference Design Comuni. Tutti i blocchi (header, hero, calendario, argomenti, siti tematici, rating, ricerca, contatti, footer) implementati correttamente con stack TailwindCSS + Alpine.js + Lit + DaisyUI + Flowbite (NO Bootstrap Italia). Dati JSON-driven da `tests.segnalazioni-elenco.json`. Loop di verifica completato con successo.