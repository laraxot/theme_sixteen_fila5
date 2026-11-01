---
title: "Experience — FixCity DesignComuni front office"
type: ux-experience
status: draft
tags: [bmad, ux, journeys, design-comuni, wcag]
issues:
  - "https://github.com/laraxot/base_fixcity_fila5/issues/383"
discussions:
  - "https://github.com/laraxot/base_fixcity_fila5/discussions/392"
updated: 2026-10-17
qmd: "core journeys sixteen"
---

# Core journeys

## Find a service

Home → services → category/search → detail → access or contact. Loading, empty and
error states keep the search/action available.

## Report a problem

Home/list → report detail → privacy → data/location/media → summary/edit → confirmation.
Validation failure preserves all entered data and focuses the error summary. Success
shows the report identifier, next action and tracking link.

## Track and manage

Guest tracking or authenticated personal area → report detail → public timeline.
Private data remains owner-scoped; an empty area explains how to create the first report.

# Screen state rule

Every async surface defines default, loading, empty, error, success and disabled
states. Alpine manages transient state; server responses remain authoritative.

# Motion

Only small opacity/position transitions (150–250ms) are allowed. `prefers-reduced-motion`
renders the final state immediately. Three.js is excluded from these journeys.
