---
type: epic-story
status: open
priority: high
tags: [design-guidelines, design-system, audit, visual-verification, second-brain]
github_issue: "#55"
discussion: "https://github.com/italia/design-comuni"
rights_owner: "laravel/Themes/Sixteen"
related_to: ["STORY-ADOZIONE-LINEE-GUIDA-DESIGN-PA", "STORY-COOKIEBAR-GDPR-COMPLIANCE"]
title: "BMAD Story — Audit Visivo Cookie Bar (Design Comuni)"
updated: 2026-10-15
qmd: "bmad story   audit visivo cookie bar (design comuni) sixteen"
---

# BMAD Story — Audit Visivo Cookie Bar (Design Comuni)

## Scopo

Eseguire audit visivo della cookie bar per verificare conformità ai principi di design industriale (Dieter Rams), garantire coerenza con il design-comuni, e validare l'esperienza utente secondo i criteri di qualità del design system.

## Riferimenti

- Bootstrap Italia Cookiebar docs: https://italia.github.io/bootstrap-italia/docs/componenti/cookiebar/
- Statikbe cookie consent: https://github.com/statikbe/laravel-cookie-consent
- Design Comuni stack: Tailwind + Alpine + Lit + DaisyUI + Flowbite (NO Bootstrap)
- Linee guida di design PA (Art. 53 CAD, Linee guida AgID)

## Decisioni chiave (D10/D11)

- Audit visivo obbligatorio prima di dichiarare completato il componente
- Verifica APCA contrast (Lc ≥75 body, ≥45 large-bold, ≥30 non-text)
- Verifica assenza di anti-pattern: glassmorphism, gradient orbs, neon glow, default-card, 1px-gray-border
- Compatibilità con Gdpr config (3 categorie: necessary/analytics/marketing)
- Stored preferences in localStorage come JSON (compatibilità con statikbe middleware)

## Stato

In corso. Audit visivo in corso su tutti i viewport (375/768/1440). Prima verifica: stato attuale delle componenti esistenti.

## Note tecniche

- Verifica APCA contrast per tutti i testi (necessary, analytics, marketing)
- Verifica stato di attivazione (show/accepted/preferences) tramite LocalStorage
- Controllo di coerenza con DESIGN.md tokens (colore, spaziamento, elevazione)
- Verifica presenza di tutti gli stati interattivi richiesti (default, hover, focus-visible, active, disabled, error, empty, loading)