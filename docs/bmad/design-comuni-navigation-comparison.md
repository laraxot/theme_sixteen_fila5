---
title: "Sixteen public navigation — expected/actual comparison"
type: bmad-comparison
status: verified
module: Sixteen
created: 2026-09-27
updated: 2026-09-27
tags: [bmad, design-comuni, navigation, runtime-audit]
qmd: "Sixteen navigation runtime pages blank shell 200 expected actual"
issues:
  - "https://github.com/laraxot/base_fixcity_fila5/issues/383"
discussions:
  - "https://github.com/laraxot/base_fixcity_fila5/discussions/392"
related:
  - ./design-comuni-navigation-expected-2026-09-27.md
  - ./design-comuni-navigation-correction-plan-2026-09-27.md
---

# Runtime baseline — 2026-09-27

Checked the running local app at `http://localhost:8001` using direct HTTP
requests and parsed rendered headings and locale-switch links.

| Path | HTTP | Main content | Decision |
| --- | ---: | --- | --- |
| `/it` | 200 | Segnalazioni, community intro, how it works | Working home |
| `/it/services` | 200 | Report, browse and track tasks; reports category | Working canonical catalogue |
| `/it/administration` | 200 | Administration sections | Published destination |
| `/it/news` | 200 | News list | Published destination |
| `/it/events` | 200 | No page heading/body | Empty shell; hide until published |
| `/it/topics` | 200 | No page heading/body | Empty shell; hide until published |
| `/it/registrations` | 200 | No page heading/body | Empty shell; hide until published |
| `/it/summer-in-the-city` | 200 | No page heading/body | Empty shell; hide until published |
| `/it/local-police` | 200 | No page heading/body | Empty shell; hide until published |
| `/it/servizi` | 200 | No page heading/body | Stale duplicate path; canonical page is `/it/services` |

The labels and destinations came from tenant `header.json`; the blank pages came
from the generic Folio `[container0]/index` fallback, which rendered the shared
layout even when neither a CMS page nor an owner utility view existed. This
made HTTP status alone an insufficient navigation check.

## Reference comparison

The Design Comuni root index describes distinct administration, news, services,
events and general discovery pages. The service-workflow index describes
transaction patterns for several domains. FixCity has real administration,
news, reports and tracking journeys, but it has no published event, enrollment,
summer-program or local-police content. Showing those menu links as working
pages overstates product scope. The report service and its privacy/data/review/
confirmation/personal-area paths remain the relevant workflow subset.

## Gap

The generic page resolver must distinguish a published CMS destination from an
unknown slug. The header must preserve tenant configuration while suppressing
entries whose page does not exist. Existing content and the `/services` route
must not change.

## Post-correction verification

The Fixcity header JSON still contains all configured links; `vivere-il-comune`,
`iscrizioni`, `estate-in-citta` and `polizia-locale` are disabled until their
owner pages are published, and `topics_enabled` is explicitly false. The
secondary menu honors that flag. Generic Folio indexes without CMS content now
return 404. Browser coverage passed at 390 and 1440 px across `it`, `en`, `de`
and `es`: four tests pass, including all unbacked routes and the existing
service catalogue journeys.

The separate Design Comuni utility-page browser suite also passed **2/2**:
the FAQ and sitemap remain rendered and localized at supported widths, and the
personal-area redirect preserves the selected locale.
