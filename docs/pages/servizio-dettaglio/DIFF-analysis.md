# DIFF Analysis: servizio-dettaglio

**Date**: 2026-04-06
**Agent**: Group C Analysis
**Reference**: https://italia.github.io/design-comuni-pagine-statiche/sito/servizio-dettaglio.html
**Local**: http://127.0.0.1:8000/it/tests/servizio-dettaglio

## Screenshot Parity

| Viewport | Local Height | Reference Height | Diff | Parity |
|----------|-------------|-----------------|------|--------|
| Desktop (1440x900) | 2550px | 5813px | 3263px | **44%** |
| Mobile (390x844) | 4741px | 7710px | 2969px | **61%** |

## HTML Structure Comparison

### Tag Counts
| Tag | Local | Reference |
|-----|-------|-----------|
| `<div>` | 127 | 208 |

### Reference Page: "Iscrizione alla Scuola dell'infanzia"
Sections (in order):
1. Breadcrumb (`cmp-breadcrumbs`)
2. Service header: title + status + sharing tools
3. **Sticky index nav**: `cmp-navscroll sticky-top` — links to all page sections
4. `<section class="it-page-section mb-30" id="who-needs">` — A chi è rivolto
5. `<section class="it-page-section mb-30" id="description">` — Descrizione
6. `<section class="it-page-section mb-30" id="how-to">` — Come si richiede
7. `<section class="it-page-section mb-30 has-bg-grey p-3" id="needed">` — Documenti
8. `<section class="it-page-section mb-30" id="obtain">` — Cosa si ottiene
9. `<section class="it-page-section mb-30" id="deadlines">` — Tempi e scadenze (with `cmp-timeline`)
10. `<section class="it-page-section mb-30" id="costs">` — Costi
11. `<section class="it-page-section mb-30 has-bg-grey p-4" id="submit-request">` — Accedi al servizio (CTA buttons)
12. `<section class="it-page-section mb-30" id="more-info">` — Ulteriori informazioni
13. `<section class="it-page-section mb-30" id="conditions">` — Condizioni di servizio
14. `cmp-heading` — Service heading
15. Contacts (`cmp-contacts`)
16. Carousel of related services (`cmp-carousel`, `splide`)
17. Feedback form (`cmp-rating`, `cmp-steps-rating`)

### Local Page: "Certificato di Residenza"
Sections (in order):
1. Breadcrumb (`cmp-breadcrumbs`) ✓
2. H1: "Certificato di Residenza"
3. H2: "Informazioni sul servizio"
4. H3: "A chi è rivolto" ✓ (partial)
5. H3: "Come si richiede" ✓ (partial)
6. H3: "Documenti richiesti" ✓ (partial)
7. H3: "Tempi di rilascio" ✓ (partial)
8. H3: "Costi" ✓ (partial)
9. H2: "Contatti"
10. H3: "Ufficio", "Recapiti", "Orari", "Indirizzo" ✓
11. `<section class="cmp-links-grid mb-8">` — Servizi correlati ✓

## Missing Components in Local

| Component | Reference Class | Status |
|-----------|----------------|--------|
| Sticky index navigation | `cmp-navscroll sticky-top` | **MISSING** |
| Page sections with `it-page-section` | 10 sections with IDs | **PARTIAL** — no IDs, no `has-bg-grey` variants |
| "Cosa si ottiene" section | `id="obtain"` | **MISSING** |
| Timeline/deadlines | `cmp-timeline` | **MISSING** |
| "Accedi al servizio" CTA section | `id="submit-request"` | **MISSING** |
| "Ulteriori informazioni" section | `id="more-info"` | **MISSING** |
| "Condizioni di servizio" section | `id="conditions"` | **MISSING** |
| Sharing tools (FB, Twitter, etc.) | utility buttons | **MISSING** |
| Print/Listen/Email buttons | utility buttons | **MISSING** |
| Related services carousel | `cmp-carousel`, `splide` | Replaced by `cmp-links-grid` |
| Feedback rating | `cmp-rating`, `cmp-steps-rating` | **MISSING** |
| `cmp-heading` component | `cmp-heading pb-3 pb-lg-4` | Replaced by custom H2 |

## Key Structural Differences

1. **No sticky section index**: Reference has `cmp-navscroll` sticky sidebar navigation linking to all sections. Local has no page-level navigation.

2. **Missing 5 content sections**: "Cosa si ottiene", "Accedi al servizio" (CTA), "Ulteriori informazioni", "Condizioni di servizio", "Tempi e scadenze" with timeline.

3. **`it-page-section` pattern not used**: Reference wraps every section in `<section class="it-page-section mb-30 [id]">` with alternating grey backgrounds. Local uses plain H3 headings.

4. **No `cmp-timeline`**: Deadlines section in reference uses a visual timeline component. Local shows "Tempi di rilascio" as plain text.

5. **No CTA buttons**: Reference has prominent "Richiedi online" and "Prenota appuntamento" buttons in a dedicated `has-bg-grey` section.

6. **No sharing utilities**: Print, listen, share buttons missing.

7. **No feedback form**: `cmp-rating` / `cmp-steps-rating` entirely absent.

## CSS Observations

- Local uses `title-xxxlarge`, `title-xxlarge`, `h5` for headings; reference uses Bootstrap Italia typography classes
- Missing `has-bg-grey p-3/p-4` for alternating section backgrounds
- `cmp-links-grid` used for related services (vs reference's `cmp-carousel` with splide.js)

## Priority: **HIGH**
44% desktop parity. Multiple content sections missing. Key UX elements (sticky nav, CTA, timeline) absent.
