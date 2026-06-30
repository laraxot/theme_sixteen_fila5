# Ponytail audit — Sixteen

**Run:** 2026-06-30

Documento canonico: [ponytail-audit-over-engineering.md](../../ponytail-audit-over-engineering.md)

## Findings

1. `Main_files/` — estrarre 2 SVG usati da `vite.config.js` in `assets/images/`, poi `.bak`
2. `ruvector.db` — non in pipeline build
3. `Http/Controllers/ComuneController` + `routes/web.php` — valutare vs architettura Folio bridge-only

Hub: [ponytail-audit-themes.md](../../../../../../docs/project/ponytail-audit-themes.md)
