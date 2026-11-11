---
id: servizi-catalogo-visual-parity-97
type: bmad-story
links:
  github_issue: #999
  discussion: #design-comuni
title: "Operazioni Orario — Visual Parity 97% Target"
updated: 2026-10-13
tags: [docs, sixteen, bmad]
qmd: "operazioni orario   visual parity 97% target sixteen"
status: superseded
superseded_by: servizi-utente-visual-parity.story.md
---

> Nota docs-temi: il testo qui sotto e' una copia byte per byte di [operazioni-orario-visual-parity.story.md](./operazioni-orario-visual-parity.story.md) (stessa copia anche in `amministrazione-visual-parity.story.md`) e descrive `operazioni-orario`, non `servizi-catalogo`. Da riscrivere per la pagina `servizi-catalogo` quando la story viene ripresa; la fonte del testo e' il file indicato.

# Operazioni Orario — Visual Parity 97% Target

## WHY (philosophy / religion / politics / zen)
- `operazioni-orario` = pagina pubblica di servizio (orari operativi, apertura, chiusura) — un cittadino deve sapere quando può presentarsi senza chiamare.
- Non è decorazione — l'orario è funzione (il servizio deve essere accessibile). Senza orari chiari, il cittadino viene escluso.
- Filosofia: trasparenza = informazione disponibile senza barriera; religione: partecipazione = accesso senza discriminazione; politica: governo che nasconde gli orari blocca il cittadino; zen: chiarezza = onestà.
- Design-comuni pattern: card + tabella orari + contatti + mappa (se applicabile).

## Status
- Reference URL: non disponibile direttamente ai percorsi noti (404). Usa architettura locale + pattern design-comuni.
- JSON: `tests.operazioni-orario.json` (da creare / verificare in `laravel/config/local/fixcity/database/content/pages/`)
- Component: `pub_theme/components/blocks/tests/operazioni-orario/default.blade.php` (o simile da verificare — R006: controlla esistente)
- Stack: Tailwind + Alpine + Lit + DaisyUI + Flowbite (NO Bootstrap); token `bg-primary-600`
- Visual parity target: 97%

## Acceptance (pre-verifica con riferimento locale se disponibile, altrimenti con architettura)
- HTTP 200 OK
- Componenti: orari operativi con tabella, apertura/chiusura chiari, contatti, eventuale mappa se rilevante
- Focus-visible + touch targets >=44px
- No Bootstrap; token-only
- BMAD + second brain aggiornati
- No file inventato (R006)
