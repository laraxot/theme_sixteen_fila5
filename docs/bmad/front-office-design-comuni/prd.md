---
title: "PRD — FixCity Front Office DesignComuni"
type: prd
status: draft
tags: [bmad, prd, design-comuni, wcag-21-aa]
issues:
  - "https://github.com/laraxot/base_fixcity_fila5/issues/383"
discussions:
  - "https://github.com/laraxot/base_fixcity_fila5/discussions/392"
updated: 2026-10-17
qmd: "functional requirements sixteen"
---

# Functional requirements

| ID | Requirement | Acceptance signal |
|---|---|---|
| FR-01 | Shared institutional shell | skip links, header, breadcrumb and footer on every FO page |
| FR-02 | Services directory | catalogue, category and detail preserve official section order |
| FR-03 | Report discovery | filters, accessible list and synchronized map |
| FR-04 | Report detail | title, status, location, timeline and next actions are explicit |
| FR-05 | Report wizard | privacy, data, summary and confirmation are separate recoverable steps |
| FR-06 | Personal area | recent activity, report status and empty/loading/error states |
| FR-07 | Auth and legal pages | login/register/privacy/accessibility/errors use the same shell |
| FR-08 | Shared components | Blade primitives, Alpine behaviours and Lit web components are reused |
| FR-09 | Localization | visible copy and labels remain locale-aware for existing locales |
| FR-10 | Progressive enhancement | essential content and forms remain understandable without JS |

# Non-functional requirements

| ID | Requirement | Gate |
|---|---|---|
| NFR-01 | WCAG 2.1 AA | contrast, keyboard, labels, focus, errors and reduced motion |
| NFR-02 | Responsive | 320, 390, 768, 1024 and 1440px; no horizontal overflow |
| NFR-03 | Performance | local critical assets, reserved media space, no decorative blocking JS |
| NFR-04 | Security | existing CSRF, server validation and privacy boundaries unchanged |
| NFR-05 | Maintainability | no controllers/services; component ownership follows module/theme rules |
| NFR-06 | Stack | Tailwind + Alpine + Lit + DaisyUI + Flowbite + Filament; no Bootstrap |

# Delivery rule

Implement one vertical slice at a time. Each story owns its files, includes a
browser/accessibility check, and must not rewrite unrelated dirty work in the tree.
