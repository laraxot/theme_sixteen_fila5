---
title: "Decisioni architetturali — Sixteen"
type: documentation
theme: Sixteen
status: active
---

# Decisioni architetturali — Sixteen

Gli ADR spiegano le scelte difficili da invertire del tema Sixteen:
accessibilità, struttura delle pagine, asset e integrazione con il design
system. L'indice è in [index.md](./index.md).

Ogni ADR deve includere contesto, driver, alternative scartate, decisione,
conseguenze e una conferma verificabile.

## Decisioni

- [0001 — data attributes nominati per ruolo](0001-data-attributes-named-by-role.md)
- [0002 — parità HTML Design Comuni](0002-design-comuni-html-parity.md)
- [0003 — route di identità digitale disattivate di default](0003-digital-identity-routes-off-by-default.md)
- [0004 — asset del tema tramite symlink pubblico](0004-theme-assets-via-public-symlink.md)

## Harness minimo: ownership, evidenza e recupero (2026-11-27)

Questo indice appartiene a **theme_sixteen_fila5**: ogni decisione su codice, dominio o tema va nell'ADR del package owner; il root registra soltanto i vincoli di composizione. Un ADR richiede una scelta reale con alternative e conseguenze, più una **Conferma** ripetibile (oppure la dichiarazione esplicita che manca). Non creare ADR fittizi per riempire un indice.

- [Confine LaravelDay/harness Xot](https://github.com/laraxot/module_xot_fila5/blob/dev/docs/adr/0042-laravel-day-harness-adoption-boundary.md); [ownership root](https://github.com/laraxot/base_ptvx_fila5/blob/dev/docs/adr/0001-harness-minimo-e-ownership.md).
- **BMAD**: la story owner-local conserva `scope`, `must_not_change`, `evidence`, `approval_required` nei cambi rischiosi.
- **ECC**: nessun marker di merge; distinguere la prova eseguita dal semplice riferimento a un test; se la conferma non è disponibile segnare `non eseguita`.
- **Second Brain**: QMD/Graphify e `.harness/memory/{facts,lessons}.md` sono puntatori a evidenza datata, non copie degli ADR. [Runbook](https://github.com/laraxot/base_ptvx_fila5/blob/dev/docs/harness/README.md) · [Rollout #15](https://github.com/laraxot/base_ptvx_fila5/issues/15).
