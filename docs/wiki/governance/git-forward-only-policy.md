---
issues: []
discussions: []
title: "Politica Git Forward-Only — Tema Sixteen"
type: rule
tags: [git, forward-only, sixteen, themes]
created: 2026-04-01
updated: 2026-07-27
qmd: "sixteen git forward-only never restore checkout reset revert study show"
related:
  - ../../../../../../docs/wiki/concepts/git-forward-only-discipline.md
  - ../../../../../../docs/wiki/concepts/git-forward-only-study-old-version.md
status: draft
---

# Politica Git: Forward-Only (Sixteen)

Conformità globale: [git-forward-only-discipline](../../../../../../docs/wiki/concepts/git-forward-only-discipline.md).

<<<<<<< .merge_file_u1fJn8
1. **Roll-Forward sui Fix CSS/JS**: Se una modifica agli stili o ai componenti Lit del tema introduce un bug visivo, non si esegue il revert del commit. Si crea un nuovo commit di fix che corregge l'errore, preservando la storia dei tentativi precedenti.
2. **Tracciabilità dei Componenti**: Ogni componente Web (come `<map-lit>`) integrato nelle pagine del tema deve essere documentato nelle wiki del rispettivo modulo, ma il tema deve mantenere un registro delle integrazioni nel proprio `docs/wiki/log.md`.
3. **Studio vs Ripristino**: Le versioni precedenti si studiano con `git show` / `git log` (sola lettura). **Mai** `git restore` o `git checkout --` su file. Hub: [git-forward-only-study-old-version.md](../../../../docs/wiki/concepts/git-forward-only-study-old-version.md).
=======
1. Bug CSS/JS/Lit → **nuovo** commit di fix (roll-forward), mai revert/reset.
2. Passato = `git show` / `git log` (sola lettura). **Mai** restore / checkout -- / reset / revert / rollback.
3. Codice vecchio utile → studia → riscrivi **migliorato** sul file attuale.
4. Integrazioni componenti → `docs/wiki/log.md`.
>>>>>>> .merge_file_0rFzTT

Cursor: `.cursor/rules/git-forward-only.mdc` (**alwaysApply**).
