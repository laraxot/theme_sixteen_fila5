---
status: completed
review_type: swarm2-component-review
github_issue: "#swarm2-review"
initiative: kp-174d15a58ff94901b2b0df0d86b8907a
stack: "Tailwind+Alpine+Lit+DaisyUI+Flowbite — NO Bootstrap Italia"
constraint: "AGENTS.md + UX strict; token #007A52; mobile responsive (sm/md/lg/xl); nessun blocco HTTPS"
title: "Swarm 2 — Component Review (4 blocchi)"
type: note
updated: 2026-10-14
tags: [docs, sixteen, bmad]
qmd: "swarm 2   component review (4 blocchi) sixteen"
---

# Swarm 2 — Component Review (4 blocchi)

## File verificati
- `map-location.blade.php`
- `form-wizard/default.blade.php`
- `tickets-list.blade.php`
- `header-area-personale/default.blade.php`

## Violazioni "NO Bootstrap Italia"
| File | Stato | Note |
|---|---|---|
| map-location.blade.php | ⚠️ VIOLAZIONE | `input-group`, `input-group-text`, `form-control`, `btn btn-outline-secondary` — classi Bootstrap Italia inserite. Token `fill="#007A52"` OK. |
| form-wizard/default.blade.php | ✅ PASS | Tailwind (`md:grid-cols-4`, `text-[#191919]`, `bg-[#007a52]`), nessuna classe Bootstrap. Token OK. Responsive OK. |
| tickets-list.blade.php | ✅ PASS | Commento "NO Bootstrap Italia" confermato; token #007A52 presente; nessuna classe Bootstrap nel markup. |
| header-area-personale/default.blade.php | ✅ PASS | Commento "NO Bootstrap Italia + token #007A52"; nessuna classe Bootstrap; responsive implicito. |

## Token #007A52
- map-location: `fill="#007A52"` (SVG marker) ✅
- form-wizard: `bg-[#007a52]`, `focus-visible:ring-[#007a52]/40` ✅
- tickets-list: riferimento nel commento e bottone `btn-primary` ✅
- header-area-personale: riferimento nel commento ✅

## Mobile responsive (Tailwind sm/md/lg/xl)
- form-wizard: `md:grid-cols-4` ✅
- Altri: nessun breakpoint esplicito richiesto per questi blocchi; layout si adatta via contenitore genitore.

## HTTPS / blocco messaggi
- Nessun messaggio di blocco HTTPS rilevato.
- `map-location` usa `https://maps.google.com` (iframe) ✅

## Conclusione
3/4 componenti passano senza violazioni. `map-location.blade.php` richiede rimozione classi Bootstrap (`input-group`, `form-control`, `btn-outline-secondary`) e sostituzione con equivalenti Tailwind (`flex`, `rounded`, `border`, `shadow`, `bg-[#007A52]`). Loop aperto su correzione.
