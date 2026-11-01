---
title: "Sixteen service catalogue — expected experience"
type: bmad-ux-contract
status: baseline
module: Sixteen
created: 2026-09-27
updated: 2026-09-27
tags: [bmad, design-comuni, services, accessibility, folio]
qmd: "Design Comuni service listing catalogue search categories service detail expected UX"
issues:
  - "https://github.com/laraxot/base_fixcity_fila5/issues/383"
discussions:
  - "https://github.com/laraxot/base_fixcity_fila5/discussions/392"
related:
  - ../../../Modules/Fixcity/docs/bmad/services-catalog-gap-analysis-2026-09-27.md
  - ../wiki/concepts/comuni-design-system-guidance.md
---

# Service catalogue: expected experience

Reusable truth rule: [Design Comuni catalogue guidance](../wiki/concepts/comuni-design-system-guidance.md#service-catalogue-only-verified-pathways).

## Reference study

The Design Comuni index defines a coherent public information architecture:
homepage, search, topics, administration, news, services, events and civic
flows. Its service area separates the catalogue (`servizi.html`), category
listing (`servizi-categoria.html`) and service detail (`servizio-dettaglio.html`).
The official detail page describes audience, service, steps, required documents,
outcome, dates, costs, online access, terms, contacts and related content. The
catalogue offers search, result count, alphabetical results, featured services,
category exploration, help and a disservice-report entry point.

The service-workflow index at `/servizi/index.html` responds HTTP 200 when fetched
directly. A direct HTTP audit on 2026-09-27 found 44 linked workflow templates,
all returning HTTP 200. They cover
two common pages (digital-identity access and privacy consent) plus six service
types: ranking applications, permits/authorizations, economic benefits, fines
via pagoPA, IMU via F24, and paid services. The published index has 44 workflow
pages; an earlier count of 45 was an off-by-one in this audit. Most repeat a service sheet, personal
data, service-specific data, editable summary, confirmation and personal-area
message; payment screens apply to the relevant workflows. The separate root
`index.html` describes the disservice-report journey. Its report-specific
service sheet is the directly relevant detail template and is implemented at
`/services/report-issue`. The page intentionally omits sample office contacts,
terms and related municipal services until the tenant supplies authoritative
content; it should expose both the real submission journey and public reports.

## Sixteen acceptance contract

- The page title and introduction explain the civic catalogue and its scope.
- Hero title, description and search feedback maintain at least 4.5:1 contrast
  against their actual rendered background; utility class names alone are not
  proof that a color or background is present.
- Search is keyboard-operable, localized, filters what is visibly listed, and
  announces result count and an empty state.
- Category navigation has real destinations; category links never point to
  missing anchors or self-referential placeholder URLs.
- The visible category set contains only categories backed by a working FixCity
  workflow. Do not show registry, tax, planning, social or culture services as
  available until verified content and integrations exist.
- Featured services are clearly identified and link to a real service flow or
  an honest availability/information page. Demo examples and contact details
  must not look like verified municipal data.
- State access requirements before entry to a protected flow; the report task
  must tell guests that submitting it requires signing in.
- A full municipal catalogue provides category discovery and verified contact
  routes. Until tenant-owned service records and contacts exist, Fixcity must
  state its narrower scope and link to its real report/list/track tasks only.
- UI copy and accessible labels exist for every supported locale. At 320 px and
  keyboard-only operation there is no clipped content, inaccessible control or
  misleading action.
- Service detail pages, when present, include audience, description, how to,
  requirements, outcome, deadlines, costs, access, terms and verified contacts.
- A report-service detail page links to both report submission and the public
  reports list. Do not invent contacts, terms, appointments or related services.

## Scope boundary

Fixcity currently implements civic issue reports, tracking and public discovery;
it does not establish that certificates, taxes, SUAP, social support or office
appointments are operational. The catalogue must distinguish implemented
Fixcity flows from municipal services that require tenant-owned content and
integration. Do not add fabricated service records, contacts, fees or deadlines.
