---
title: "Dev notes: organizzazione docs dei temi"
type: story-dev
status: done-with-open-decisions
created: 2026-10-28
updated: 2026-10-28
theme: Sixteen
owner: theme:Sixteen
related:
  - docs-organization-themes.story.md
tags: [docs, themes, naming, dev-notes]
---

# Dev notes: organizzazione docs dei temi

Storia: [docs-organization-themes.story.md](./docs-organization-themes.story.md).

## Metodo
1. `python3 -I bashscripts/tools/docs/md-filenames.py check --paths laravel/Themes/<T>/docs` per i nomi con data/suffisso; `git mv` (Sixteen/Two/Zero con `git -C`), data nel frontmatter, indici di tema aggiornati a mano.
2. Maiuscolo/underscore -> kebab-case: piano calcolato fuori repo (solo dove il nome minuscolo non esiste gia' e non c'e' un gemello), esclusi ID (`STORY-*`, `DC-*`, `D<nn>-*`, `CAM-*`), file con sidecar `.lock`, e nomi citati da codice non-md. Riscrittura dei riferimenti con `rewrite_text` del tool (sostituisce solo l'ultimo componente del percorso), `git mv` per lo spostamento.
3. Verifica: `check`, `md-collisions.py plan`, `md-filenames.py links` (conteggio prima/dopo), `git status` senza ` D`.

## Lezioni
- Il fallback "nome unico nel repo" della riscrittura sbaglia sui nomi generici citati come esempio (`REPORT.md`, `README-old.md`): controllare il diff dei file fuori dall'ambito e ripristinare.
- Minuscolare una sigla con numero (`PAGES_GROUP_3`) crea un suffisso numerico vietato: le serie di ID restano come sono.
- La vista di `git status` dalla radice per Sixteen/Two/Zero e' falsata (la radice li traccia a parte): per lo stato usare `git -C laravel/Themes/<T>`.

## Decisioni aperte
- Gemelli maiuscolo/minuscolo con contenuto diverso, da unire a mano: `product_strategy.md` (Sixteen, TwentyOne, Two), `product_roadmap.md`, `user_research.md`, `product_launch_plan.md` (Two), `ROADMAP.md` (TwentyOne), `FOOTER-CSS-FIX.md`, `design-comuni/SESSION_SUMMARY.md`, `design-comuni/VISUAL-COMPARISON-REPORT.md`, `bmad/homepage-visual-parity-defects/ARCHITECTURE.md`, `predict/{futuur_design_analysis,prediki_design_analysis,prediki_analysis}.md` (TwentyOne), `00-INDEX.md` vs `00-index.md` (Two), `llm-wiki/AGENTS.md` vs `agents.md`.
- 89 file con nome-ID maiuscolo lasciati (`DC-*`, `D<nn>-*`, `STORY-*`): confermare che gli ID restano maiuscoli oppure estendere il tool.
- 18 nomi maiuscoli citati da codice/script (es. `PERFORMANCE-OPTIMIZATION.md`, `MASTER.md`, `SPEC.md`, `DESIGN.md`): rinominare solo insieme al chiamante.
- Anni nel nome (`roadmap-2025.md`, `comparative-analysis-2025.md`, `components-update-2025.md`): il tool non li segnala; decidere se la regola "mai date" li include.
- Duplicati identici non toccati: `Two/docs/{fix,prompts/fix}/*.md` (prompt dell'utente), 13 `STORY-DEFECT-*.md` identici e 3 `*-visual-parity.story.md` identici in Sixteen, `comparative-analysis-2025.md` = `comparative-analysis.md` (Two).
