---
title: "Design system — FixCity DesignComuni"
type: ux-design
status: draft
tags: [bmad, design-system, design-comuni, wcag-21-aa]
issues:
  - "https://github.com/laraxot/base_fixcity_fila5/issues/383"
discussions:
  - "https://github.com/laraxot/base_fixcity_fila5/discussions/392"
updated: 2026-10-17
qmd: "design read sixteen"
---

# Design read

Public-sector service redesign for residents and municipal staff: calm, clear,
trustworthy, content-first and low-motion. Design variance 3/10, motion 2/10,
density 5/10. No AI gradients, glassmorphism or ornamental 3D in task-critical UI.

# Tokens

- primary: `#007A52`; deep text/nav: `#17334F`; accent/link: `#0066CC`;
- surface: `#FFFFFF`; canvas: `#F5F6F7`; border: `#D9E0E6`; danger: `#B42318`;
- body: 16px minimum, line-height 1.5; Titillium Web remains the existing brand
  typeface, while the homepage civic headline uses the approved local Lora
  editorial face at regular weight for calmer, more legible display text;
- spacing follows 8px; touch targets are at least 44px; focus is a 2px high-contrast
  outline with visible offset;
- breakpoints: 320, 390, 768, 1024 and 1440px.

# Components

Shell, skip links, header/nav, breadcrumb, page index, service section, callout,
button, input/select/textarea, error summary, stepper, report card, status badge,
map/list switcher, timeline, modal, feedback, contact block and footer each define
default/hover/focus/disabled/loading/error/success states.

# Accessibility contract

All controls have visible labels; errors are inline and summarized at the top with
focus moved to the summary; map markers have a list alternative; color never carries
status alone; dialogs restore focus; reduced-motion removes non-essential movement;
no page may require horizontal scrolling at 320px.
