---
title: "Brainstorming report — FixCity civic front office"
type: brainstorming-report
status: synthesized
tags: [bmad, brainstorm, civic-tech, design-comuni, accessibility]
issues:
  - "https://github.com/laraxot/base_fixcity_fila5/issues/383"
discussions:
  - "https://github.com/laraxot/base_fixcity_fila5/discussions/392"
updated: 2026-10-17
qmd: "objective sixteen"
---

# Objective

Make the whole public FixCity journey feel like one excellent municipal service:
understandable before sign-in, fast on mobile, usable with assistive technology and
visually faithful to DesignComuni.

# 5 Whys

1. Residents abandon flows when the next action and required data are unclear.
2. They are unclear because pages evolved as isolated feature surfaces.
3. They evolved in isolation because framework compatibility CSS became the shared
   language instead of a documented component contract.
4. The contract was missing because visual parity was treated as a one-time styling task.
5. Therefore the fix is a durable token/component/state contract with evidence gates,
   not another page-specific CSS patch.

# SCAMPER ideas

- **Substitute:** replace framework-specific behaviour with Alpine/Lit primitives.
- **Combine:** pair every map interaction with a list/card equivalent.
- **Adapt:** use the official four-step report template for every multi-step flow.
- **Modify:** make service sections scannable with a page index and strong headings.
- **Put to another use:** reuse the report timeline pattern in personal-area activity.
- **Eliminate:** remove decorative motion, duplicate shells and Bootstrap runtime code.
- **Reverse:** start with the recovery/error state to expose missing data contracts early.

# SWOT

| | Findings |
|---|---|
| Strengths | existing modular Actions, Folio pages, Lit map work, DesignComuni research |
| Weaknesses | dirty legacy CSS, duplicate page artefacts, dependency/runtime drift |
| Opportunities | one accessible component system, better report completion and trust |
| Threats | privacy leaks, map-only interaction, contrast/focus regressions, scope creep |

# Reverse brainstorming: how to make it fail

Ship map-only controls, hide labels in placeholders, use color-only statuses, reset
the wizard after validation, add animation before semantics, copy framework CSS into
every page, and let guest responses contain owner data. Each is now a release gate.

# Converged decisions

1. The report flow is the reference vertical slice.
2. DesignComuni structure is preserved; Bootstrap implementation is not.
3. Every story must own a bounded set of files and include accessibility evidence.
4. Three.js is optional visual enhancement only, never a dependency of civic task completion.
