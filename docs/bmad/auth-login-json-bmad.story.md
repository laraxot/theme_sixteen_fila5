---
title: "Auth Login JSON + Filament Blueprint"
status: completed
decision: D32
related_initiative: kp-174d15a58ff94901b2b0df0d86b8907a
---

# Auth.login JSON creation — BMAD + Second Brain + Filament Blueprint

## Perché
`login.blade.php` usa `x-page :slug="auth.login"`; senza JSON CMS la pagina non ha contenuto né blocchi.

## Azione
- `laravel/Themes/Sixteen/resources/views/pages/auth/login.blade.php.json` → slug, layout, view
- `laravel/config/local/fixcity/database/content/pages/auth.login.json` → CMS data con content_blocks
- FP (Filament Blueprint): il tema monta widget modulo (Comment, Auth) solo tramite blocchi JSON, nessuna Resource tema

## Regole rispettate
- NO controller (AGENTS.md / bmad)
- Folio + Volt + x-page
- JSON pagina => blade vestito
- Second Brain: pagina registrata
