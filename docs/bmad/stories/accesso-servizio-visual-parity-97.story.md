---
id: accesso-servizio-visual-parity-97
title: Accesso Servizio (Area Riservata) Visual Parity 97% Target
type: story
status: open
links:
  github_issue: #999
  discussion: #design-comuni
updated: 2026-10-13
tags: [docs, sixteen, bmad]
qmd: "accesso servizio - area riservata visual parity 97% target sixteen"
---
# Accesso Servizio - Area Riservata Visual Parity 97% Target

## Reference Page
URL: https://italia.github.io/design-comuni-pagine-statiche/servizi/accesso-servizio.html
Reference size: 35,399 bytes
Title: "Accesso area riservata - Nome del Comune"
H1: "Accedi" (class title-xxxlarge)

## Structure
- **Header**: accesso / servizio (navigation breadcrumbs)
- **Form/Access**: card (`card w-100`) → card-body → btn-primary (`btn btn-primary btn-icon btn-full`) for SPID/CIE
- **SPID integration**: button links with SPID/CIE badges
- **Footer**: standard site footer

## Stack
TailwindCSS + Alpine.js + Lit + DaisyUI + Flowbite (NO Bootstrap Italia)

## Token References (Tailwind)
- `.btn-primary` → `bg-primary-600` (verde PA #007A52)
- `.btn-outline-primary` → `border-primary-600 bg-white`
- `.card.w-100` → `w-full bg-white rounded shadow-sm`
- `.bg-grey-card` → `bg-neutral-100` or `bg-neutral-50`
- `.shadow-contacts` → `shadow-sm` or custom elevation token
- `.btn-full` → `w-full` (full width)
- `.btn-icon` → icon + text combo with flex

## Implementation Requirements
- JSON: `tests.accesso-servizio.json`
- Blade: `pub_theme/components/blocks/accesso-servizio/default.blade.php`
- Page: `tests/accesso-servizio.blade.php`
- Layout: `layout: test`
- Focus-visible rings on all interactive elements (SPID/CIE buttons, text inputs, submit button)
- Touch targets ≥44px
- Form fields with proper labels and `aria-label`

## Acceptance Criteria
- HTTP 200 OK
- 90% HTML body / 90%+ visual parity vs Design Comuni `servizi/accesso-servizio.html`
- SPID/CIE access buttons visible with correct colors and full-width layout
- No Bootstrap references in CSS or markup