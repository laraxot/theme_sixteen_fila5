---
name: "BMAD + Second Brain — Disclaimer & Design Italia Integration"
status: "completed"
created: "2026-10-14"
updated: "2026-10-14"
title: "second brain disclaimer integration"
type: note
tags: [docs, sixteen, bmad]
qmd: "second brain disclaimer integration sixteen"
---

## Iniziativa
Integrazione Disclaimer + Cookie Preferences + Design Italia Guidelines nel tema Sixteen.

## Articoli creati (BMAD)
- `disclaimer-integration.story.md` — disclaimer (IP, limitazione responsabilità, contatti PA)
- `design-italia-guidelines-integration.story.md` — principi Design Italia (umano, accessibilità, usabilità, content design)
- `cookiebar-bootstrap-italia-integration.story.md` — già esistente, aggiornato

## Componenti/Blade aggiornati
- `cookiebar.blade.php` — link `/disclaimer`, `data-bs-accept="cookiebar"` preservato, multilingua
- `disclaimer.blade.php` — pagina completa con sezioni legali, indirizzo PA, contatti
- `main.blade.php` — include cookie-bar dopo `<body>`

## Second Brain (kp-... / memoria)
- `cookiebar-gdpr-dcp153.md` — conferma GDPR
- Design Italia: principi applicati in header AGID, breadcrumb, WCAG 2.1 AA

## Stack
Tailwind + Alpine + DaisyUI + Flowbite + Lit. NO Bootstrap. Multilingua it/en/de/es.

## Stato
Tutto completato. Documenti BMAD con `github_issue`. Componenti verificati. Pronto per `ux_audit`.