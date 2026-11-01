---
title: "DesignComuni front-office quality skill"
type: skill
tags: [sixteen, design-comuni, wcag, alpinejs, lit, tailwind]
created: 2026-10-09
updated: 2026-10-09
qmd: "Sixteen DesignComuni front office WCAG contrast Tailwind apply Alpine Lit map marker"
status: draft
---

# DesignComuni front-office quality skill

Usare i pattern ufficiali DesignComuni come riferimento visuale e semantico,
ma implementare nel tema con Tailwind `@apply`, Alpine.js e Lit già presenti nel
progetto. Il CDN Bootstrap Italia non è ammesso.

Per mappe e marker: marker ad alto contrasto, bordo chiaro/scuro separatore,
dimensione e area cliccabile percepibile, stato focus/selected esplicito,
testo alternativo o istruzione equivalente e fallback leggibile senza mappa.
Verificare desktop/mobile, zoom 200%, keyboard focus, reduced motion e contrasto
WCAG 2.1 AA prima del passaggio successivo.

Il redesign deve riusare i blocchi CMS/JSON esistenti, mantenere le route Folio
canoniche e non aggiungere controller, service layer o Three.js se la mappa live
risolve già il bisogno informativo.
