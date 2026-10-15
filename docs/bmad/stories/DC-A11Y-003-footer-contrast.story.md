---
id: DC-A11Y-003
title: "Garantire contrasto e leggibilità del footer"
status: in-progress
type: story
updated: 2026-10-13
tags: [docs, sixteen, bmad]
qmd: "user story sixteen"
---

# User story

Come cittadino, voglio leggere titoli, contatti e link del footer anche con basse
capacità visive, così da raggiungere privacy, assistenza e informazioni istituzionali.

## Acceptance criteria

- titoli e brand sono chiaramente chiari sul fondo scuro;
- testo e link normali raggiungono 4.5:1, controlli/focus 3:1;
- headings non sono focusable se non interattivi;
- contatti mantengono i ritorni a capo e link email/telefono sono distinguibili;
- legal/social links sono navigabili e hanno focus visibile;
- nessun override globale reintroduce testo scuro.

## Owned scope

`Themes/Sixteen/resources/views/components/sections/footer/v1.blade.php`, footer JSON,
token CSS e report WCAG.
