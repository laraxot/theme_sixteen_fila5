---
name: "Quality Audit — Cookiebar / Disclaimer / Design Italia"
status: "completed"
created: "2026-10-14"
updated: "2026-10-14"
github_issue: "https://github.com/your-org/your-repo/issues/XXX"
title: "quality audit cookiebar disclaimer"
type: note
tags: [docs, sixteen, bmad]
qmd: "quality audit cookiebar disclaimer sixteen"
---

## Audit Results (BMAD + second brain)

### Cookiebar visual audit (app.css / cookiebar.blade.php)
- Contrast APCA: OK (Lc 99.28 body / -81.55 button — pass)
- Tokens FAIL: 80+ hardcoded hex (#007a52, #191919, etc.) — devono diventare variabili CSS `:root`
- States FAIL: `:disabled` mancante per bottoni cookiebar; `:focus-visible` deve essere aggiunto
- Shadow FAIL: ad-hoc `box-shadow` — sostituire con elevation named (sm/md/lg/xl)

### Disclaimer page (disclaimer.blade.php)
- Struttura semantica: `<article>` + `<section>` + `<header>` — OK
- Multilingua: chiavi `disclaimer.*` — OK
- Accessibilità: `aria-label` presente — OK

### Design Italia Guidelines integration
- Principi applicati: umano al centro, accessibilità, usabilità, content design — OK
- AGID header (skip links + institution branding) — OK
- Breadcrumb — OK
- WCAG 2.1 AA target — OK (deve completare token + states)

### Actions required for quality uplift
1. Spostare `#007a52` → `--dc-primary` in `civic-design-theme.css`
2. Aggiungere `:focus-visible`, `:disabled` a `cookiebar.blade.php`
3. Rimuovere `box-shadow` ad-hoc da `cookiebar.blade.php`
4. Aggiungere `cookie-bar.blade.php` regole `prefers-reduced-motion`

## References
- `DESIGN.md` (repo root)
- `design-italia-guidelines-integration.story.md`
- `cookiebar-bootstrap-italia-integration.story.md`
- `second-brain-disclaimer-integration.md`