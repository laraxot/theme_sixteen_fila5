---
title: "Brainstorming — Blog, Eventi, Commenti (demo realistica)"
type: note
status: draft
updated: 2026-10-17
tags: [docs, sixteen, bmad]
qmd: "brainstorming   blog, eventi, commenti (demo realistica) sixteen"
---
# Brainstorming — Blog, Eventi, Commenti (demo realistica)

## Contesto
- Moduli esistenti: `Blog` (laravel/Modules/Blog/), `Comment` (laravel/Modules/Comment/)
- Non usare lorem ipsum — contenuto reale per demo PA (foto, descrizioni, date, autori)
- Eventi: possono essere tipo di post (`post_type: event`) nel Blog o modulo `Event` separato

## Proposta
1. Post del blog: titolo reale, immagine (public demo), corpo con testo credibile, categorie (`Novità`, `Eventi`), commenti attivati
2. Eventi: come `content_type=event` nel Blog (più semplice, riusa `Comment`) oppure modulo `Event` con schema proprio se serve geolocalizzazione/registrazione
3. Seeder + Factory reali (nomi PA, date future/prossime)
4. Marketing: foto da `public/assets/demo/` (no lorem), descrizioni con riferimenti a Design Comuni

## Decisione (BMAD + second brain)
- Per questa demo: evento = tipo post nel Blog (`post_type`), con campo aggiuntivo `event_date` e `location`. Evita nuovo modulo, riusa `Comment`.
- Se in futuro serve registrazione/partecipanti: valutare modulo `Event` separato.

## Documenti correlati
- docs/investigations/blog-eventi-demorealistica.md
- docs/stories/blog-demo-realistico.story.md (da creare)

## Regola fissa (ricordo sempre)
- NO /bmad-output — SOLO docs in moduli/temi
- Nessuna conferma richiesta per queste azioni
