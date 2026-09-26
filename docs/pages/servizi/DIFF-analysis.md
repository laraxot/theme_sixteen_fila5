# DIFF Analysis: servizi

**Date**: 2026-04-06
**Agent**: Group C Analysis
**Reference**: https://italia.github.io/design-comuni-pagine-statiche/sito/servizi.html
**Local**: http://127.0.0.1:8000/it/tests/servizi

## Screenshot Parity

| Viewport | Local Height | Reference Height | Diff | Parity |
|----------|-------------|-----------------|------|--------|
| Desktop (1440x900) | 3481px | 4628px | 1147px | **75%** |
| Mobile (390x844) | 6233px | 7433px | 1200px | **84%** |

## HTML Structure Comparison

### Tag Counts
| Tag | Local | Reference |
|-----|-------|-----------|
| `<div>` | 122 | 221 |
| `<section>` | 3 | 1 |
| `<h2>` | 4 | 9 |
| `<h3>` | 7 | 23 |
| `<p>` | 15 | 23 |
| `<a>` | 89 | 116 |
| `<button>` | 12 | 11 |

### Reference Sections (in order)
1. `<section class="it-hero-wrapper bg-white align-items-start">` — Hero/breadcrumb with search
2. Hero text: "Servizi" H1 + search form (`cmp-input-search`) + category dropdown filter
3. Service listings (620 items alphabetically) — `cmp-card-latest-messages` cards
4. "SERVIZI IN EVIDENZA" — 6 highlighted services (bullet list)
5. "Esplora per categoria" — 14 category cards grid (`cmp-card-simple`)
6. Feedback form (`cmp-rating`, `cmp-steps-rating` two-step)
7. Support/contacts section (`cmp-contacts`)

### Local Sections (in order)
1. `<section class="it-hero-wrapper bg-white align-items-start">` — Hero/breadcrumb ✓
2. `<section id="servizi" class="py-20 bg-white scroll-mt-20">` — Categories: 6 groups (Anagrafe, Cultura, Mobilità, Ambiente, Polizia locale, Servizi sociali)
3. `<section class="appointment-booking-section py-5">` — Prenota appuntamento (NOT in reference)
4. `cmp-contacts` — Contacts ✓

## Missing Components in Local

| Component | Reference Class | Status |
|-----------|----------------|--------|
| Search/filter form | `cmp-input-search` | **MISSING** |
| Category filter dropdown | `cmp-radio-list` | **MISSING** |
| "Servizi in evidenza" section | featured list | **MISSING** |
| "Esplora per categoria" grid (14 items) | `cmp-card-simple` | **PARTIAL** — only 6 groups, no icon grid |
| Feedback rating system | `cmp-rating`, `cmp-steps-rating` | **MISSING** |

## Extra Components in Local (not in reference)
- `<section class="appointment-booking-section py-5">` — Prenota appuntamento section

## Key Structural Differences

1. **Search/filter bar missing**: Reference has a prominent keyword search + category dropdown filtering 620 services. Local has no search in the services area.

2. **"Servizi in evidenza" section missing**: Reference shows 6 highlighted/featured services. Local has no equivalent.

3. **Category grid incomplete**: Reference shows 14 category cards with icons and descriptions. Local shows only 6 category headings with sub-lists (no icon-based card grid).

4. **Feedback form absent**: Reference has `cmp-rating` / `cmp-steps-rating` two-step survey. Local has none.

5. **Height gap (1147px desktop)**: Missing content accounts for the height difference — search area, featured services, additional categories, feedback form.

## CSS Observations

- Local uses Tailwind (`py-20`) for section padding; reference uses Bootstrap Italia (`pt-lg-80 pb-lg-80`)
- Local service groups use `text-xl font-bold text-gray-900` for H3; reference uses Bootstrap Italia `.title-medium-2-semi-bold`
- Missing `cmp-card-simple` grid layout for categories

## Priority: **HIGH**
Major content sections are missing. Requires: search form, featured services, 8 additional categories, feedback form.
