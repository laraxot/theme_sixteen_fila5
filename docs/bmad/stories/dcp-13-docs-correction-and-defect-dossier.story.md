---
id: dcp-13
title: "DCP-13: correzione dei documenti e dossier dei 14 difetti"
type: story
epic: dc-parity-v2
status: in-progress
priority: P1
owner: theme:Sixteen
created: 2026-10-13
updated: 2026-10-13
qmd: "design comuni parity dcp-13: correzione dei documenti e dossier dei 14 difetti bmad story"
tags: [docs, sixteen, bmad]
---

# DCP-13: correzione dei documenti e dossier dei 14 difetti

## Fatto
- `docs/prompts/homepage/index.md`: dichiarazioni non misurate marcate come superate; misure reali aggiunte.
- `docs/prompts/homepage/00-COORDINATION.md`: riscritto (la versione precedente descriveva una corsia rimossa).
- Dossier `docs/bmad/homepage-visual-parity-defects/defects-d01-d14.md`: causa verificata, prevenzione, fix, controllo per ciascun difetto.
- Decisione sulle cause e i guardrail, lezioni, nota di metodo nel wiki del tema.
- Documentazione degli strumenti in `bashscripts/docs/visual-comparison/` (indice aggiornato).

## Da fare
1. Verificare alla fonte le cause dei difetti dell'header (D01-D04, D12) quando si lavora su DCP-05: oggi sono marcate "da verificare".
2. Allineare `docs/prompts/homepage/blocks/` (tre schemi di nome diversi: `00-`, `block-`, `INDEX.md`) ai blocchi reali; marcare `superseded` i duplicati senza cancellarli.
3. Marcare `superseded` i documenti che prescrivono toppe Tailwind per la homepage (`homepage-remediation-*`, `homepage-visual-parity-defects/ARCHITECTURE.md`) collegandoli a DCP-04.
4. Aggiornare gli indici di moduli e temi toccati e rilanciare `bash bashscripts/docs/llm-wiki-qmd.sh update`.

## Criteri di accettazione
- Nessun documento del tema dichiara una parity che nessun comando riproduce; ogni documento superato punta al successore.
