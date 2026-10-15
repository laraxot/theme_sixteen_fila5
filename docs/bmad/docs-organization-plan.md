---
title: "DOCS ORGANIZATION — Sixteen Theme + Modules (BMAD + Second Brain)"
type: note
status: draft
updated: 2026-10-13
tags: [docs, sixteen, bmad]
qmd: "docs organization   sixteen theme + modules (bmad + second brain) sixteen"
---
# DOCS ORGANIZATION — Sixteen Theme + Modules (BMAD + Second Brain)

## Structure (BMAD convention, YAML frontmatter required)

### Theme docs: laravel/Themes/Sixteen/docs/
- `index.md` — overview + second brain references (kp-...)
- `bmad/` — architecture.md, brainstorming.md, decision-log.md (D1-D10), stories/ (s150-homepage-redesign.md, s150-segnalazione-redesign.md, s-parity-all-pages.md)
- `design-system/` — tokens.md (PA colors #007A52, typography 1.25, 8px grid, 5 elevation), components.md (11 Lit components), argomenti.md
- `visual-parity/` — status.md (loop aperto/chiuso per pagina), deep-parity-plan.md, notes/
- `stories/` — epic stories per pagina
- `decision-log/` — decision-log.md, homepage-audit-taste-skill-bmad.md
- `wiki/` — QMD-searchable docs

### Module docs: laravel/Modules/<X>/docs/
Every module with `docs/` folder containing: `README.md`, `wiki/` (BMAD rules), `stories/` (if epic).

### Updates applied (2026-10-13)
- All docs follow YAML frontmatter per `wiki-markdown-frontmatter-mandatory.md`.
- Second brain initiatives: `kp-b052...` (FreeLLMAPI + docs), `kp-174d...` (Sixteen redesign), `kp-...` (parity/contrast).
- BMAD + no controllers + no services + module manifest + composer minimal maintained.
