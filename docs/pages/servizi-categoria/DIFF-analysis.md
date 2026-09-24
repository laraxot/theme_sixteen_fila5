# DIFF Analysis: servizi-categoria

**Date**: 2026-04-06
**Agent**: Group C Analysis
**Reference**: https://italia.github.io/design-comuni-pagine-statiche/sito/servizi-categoria.html
**Local**: http://127.0.0.1:8000/it/tests/servizi-categoria

## Screenshot Parity

| Viewport | Local Height | Reference Height | Diff | Parity |
|----------|-------------|-----------------|------|--------|
| Desktop (1440x900) | 1698px | 4539px | 2841px | **37%** |
| Mobile (390x844) | 2822px | 6070px | 3248px | **46%** |

## HTML Structure Comparison

### Tag Counts
| Tag | Local | Reference |
|-----|-------|-----------|
| `<div>` | 94 | 183 |
| `<section>` | 1 | 1 |

### Reference Page: "Anagrafe e stato civile"
Sections (in order):
1. `<section class="it-hero-wrapper bg-white align-items-start">` — Hero with category title + description
2. "Esplora tutti i servizi" — search input (`cmp-input-search`) + 340 services alphabetically
3. "UFFICI" — 5 office items + "VAI ALL'AREA AMMINISTRATIVA" link
4. "Bandi" — public notices card
5. Feedback form (`cmp-rating`, `cmp-steps-rating`)
6. Contacts (`cmp-contacts`)

### Local Page: "Categoria di servizio"
Headings found:
- H1: "Categoria di servizio"
- H2: "Servizi"

Sections:
1. `<section class="it-hero-wrapper bg-white align-items-start">` — Hero
2. Cards: `cmp-card-simple card-wrapper pb-0 rounded border border-light` — service list

## Missing Components in Local

| Component | Reference Class | Status |
|-----------|----------------|--------|
| Search/filter form | `cmp-input-search` | **MISSING** |
| Category filter | `cmp-radio-list` | **MISSING** |
| "UFFICI" section with office list | custom div | **MISSING** |
| Public notices / Bandi section | `cmp-card-latest-messages` | **MISSING** |
| Feedback rating system | `cmp-rating`, `cmp-steps-rating` | **MISSING** |
| "VAI ALL'AREA AMMINISTRATIVA" link | navigation link | **MISSING** |

## Present Components

| Component | Status |
|-----------|--------|
| Hero wrapper | ✓ Present |
| Breadcrumb (`cmp-breadcrumbs`) | ✓ Present |
| Service cards (`cmp-card-simple`) | ✓ Present (but limited content) |
| Contacts (`cmp-contacts`) | Likely present (in base layout) |

## Key Structural Differences

1. **Only 37% desktop parity** — most critical gap in Group C after evento-dettaglio.

2. **Search form missing**: No keyword search or category filter in service list.

3. **Office section missing**: Reference shows "UFFICI" with 5 offices linked to administrative area.

4. **Bandi section missing**: Reference includes a public notices card.

5. **Feedback form absent**: Complete `cmp-rating` / `cmp-steps-rating` missing.

6. **Content depth**: Reference has 340 services listed; local shows limited card list.

## CSS Observations

- Local uses generic Tailwind card styling; reference uses `cmp-card-simple card-wrapper pb-0 rounded`
- Reference hero section includes category description text and metadata; local may be missing this

## Priority: **CRITICAL**
Lowest parity (37%) in Group C. Major sections missing: search, offices, bandi, feedback. Page needs significant content additions.
