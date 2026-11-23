---
type: story
theme: Sixteen
status: completed
created: 2026-11-23
updated: 2026-11-23
issues:
  - "https://github.com/laraxot/theme_sixteen_fila5/issues/104"
---

# Audit harness dei documenti Sixteen

## Obiettivo

Rendere espliciti i contratti verificabili del tema attivo senza spostare nel tema il dominio dei moduli.

## Risultato

Confermati shell/presentation e aggiunto il contratto di build Vite con output `public/`, symlink del webroot e pruning
degli asset. Nessun contratto di dominio è stato inventato.

## Prova

`package.json`, `vite.config.js`, shell Folio e contratto `folio-page-shell.md` definiscono le superfici documentate.
