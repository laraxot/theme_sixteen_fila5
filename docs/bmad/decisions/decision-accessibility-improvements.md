---
id: d006-accessibility-improvements
title: Decision — Accessibility improvements (WCAG, contrast, focus states)
github_issue: #55
discussion: '#55'
type: decision
status: active
decision: "Migliorare contrasti e accessibilità in header/footer"
reason: "Trovati problemi WCAG: footer titles su bg scuro (contrasto basso), header nav icone sottolineate con dimensioni sbagliate, language switcher non accessibile, tasto 'Accedi' da migliorare (focus + contrast)"
rules:
  - R004: tutti i testi devono passare APCA Lc ≥75 su contrasto base; ≥45 per testo grande (h1-h3)
  - R005: ogni elemento interattivo deve avere :hover, :focus-visible, :active, :disabled
  - R006: nessun testo su sfondo scuro senza contrasto ≥4.5 (WCAG) / ≥75 (APCA)
  - R007: lingua switcher deve essere un <button aria-label> accessibile, non un semplice link
  - R008: tutti i controlli devono essere ≥44px (touch target)
components:
  - footer/v1.blade.php
  - header/tailwind.blade.php
  - sections/header/partials/language-switcher.blade.php
  - sections/header/partials/personal-area-guest-cta.blade.php
next_steps:
  - Run ux_audit (APCA) su tutti i CSS/Blade
  - Fix contrast issues
  - Add focus states
  - Verify with WCAG 2.1 AA
created_at: 2026-10-11
updated_at: 2026-10-11
updated: 2026-10-13
tags: [docs, sixteen, bmad]
qmd: "decision accessibility improvements sixteen"
---
