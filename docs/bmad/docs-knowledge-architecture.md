---
title: "Documentation knowledge architecture"
type: architecture
tags: [bmad, second-brain, qmd, graphify, governance]
qmd: "Sixteen documentation architecture BMAD second brain QMD Graphify"
status: draft
updated: 2026-10-11
---

# Architettura della documentazione Sixteen

## Decisione

La documentazione resta dentro `laravel/Themes/Sixteen/docs` perché Design
Comuni è una responsabilità del tema Sixteen. Non si crea una cartella globale
`design-system/` e non si aggiunge un layout `design-comuni`: entrambi
romperebbero ownership e riuso.

## Strati

1. **Knowledge map**: `00-INDEX.md` e `knowledge-map.md`.
2. **Norme**: `wiki/rules/`, con trigger map e regole on-demand.
3. **Piano BMAD**: `docs/bmad/`, con traceability verso il codice e le
   acceptance criteria. `bmad-output/` è storico/read-only per i nuovi
   documenti, secondo la regola del repository.
4. **Contratti visuali**: `design-comuni/`, `design-system/`, `pages/`.
5. **Evidence**: parity, screenshot e investigation; non diventano norme senza
   una decisione consolidata.
6. **Archivio**: documenti duplicati o superati, conservati per tracciabilità.

## Definition of done documentale

- link dall'indice corretto;
- front matter presente sui nuovi documenti;
- nessuna prescrizione Bootstrap Italia runtime;
- ownership Sixteen esplicita;
- codice/file citati verificati;
- query QMD utile e recuperabile;
- riferimenti Graphify non ambigui;
- decisione registrata nel log BMAD/Second Brain quando cambia una regola.

## Non obiettivi

Non si rinominano in massa i 3.000+ file storici, non si cancellano screenshot
o report e non si duplicano i documenti nei moduli. L'organizzazione avviene
con indici, link e filtri di indicizzazione; una migrazione fisica si farà solo
con una mappa completa dei riferimenti.
