---
title: "CSS data-page Elimination Plan — BMAD"
type: plan
status: active
created: 2026-10-20
updated: 2026-10-20
tags: [bmad, plan, css, design-comuni, architecture]
qmd: "css data-page elimination plan bmad"
---

# BMAD Plan: Eliminate `main[data-page="..."]` CSS Anti-Pattern

## Executive Summary

**Problem**: 384+ `data-page` CSS selectors across 10+ CSS files violate core architectural principles:
- `main[data-page="domande-frequenti"]` is runtime-injected, not canonical
- Violates **CSS-SCOPING-RULE**: canonical hook is `div.page-content[data-slug="..."][data-side="content"]`
- Violates **BODY_CLASS_RULE**: `<body>` must stay plain
- Violates **JSON-DRIVEN philosophy**: CSS must be reusable component-based, not page-specific
- Violates **TAILWIND-ALPINE-RULES**: Bootstrap Italia = visual reference only, never runtime CSS/JS

**Solution**: Migrate all page-specific CSS to canonical scoping + reusable component classes.

---

## Architecture Context (from docs)

### Canonical CSS Scoping Rules (css-scoping-rule.md)

| Page Type | Scope Hook | Example |
|-----------|------------|---------|
| Test pages | `.page-content[data-slug="tests.xxx"]` | `.page-content[data-slug="tests.segnalazione-02-dati"]` |
| Design Comuni pages | `body:has(.page-content[data-dc])` | `body:has(.page-content[data-dc]) .it-header` |
| Component styles | Component class names | `.cmp-accordion.faq .button-wrapper` |

### Current Anti-Pattern (WRONG)

```css
/* In listing-parity.css: 233 instances */
body[data-page='lista-risorse'] .cmp-breadcrumbs { ... }
body[data-page='amministrazione'] .cmp-hero { ... }

/* In argomenti-parity.css: 28 instances */
main[data-page="argomenti"] > .container { ... }

/* In homepage-parity-v2.css: 2 instances */
main[data-page="homepage"] .it-carousel-wrapper { ... }
```

### Target Pattern (CORRECT)

```css
/* Test pages - use canonical data-slug wrapper */
.page-content[data-slug="tests.segnalazione-02-dati"] .steppers-header { ... }

/* Design Comuni pages - use data-dc scope */
body:has(.page-content[data-dc]) .it-header-center-wrapper { ... }

/* Component-level styles - reusable, no page scoping */
.cmp-accordion.faq .button-wrapper { ... }
.cmp-hero .it-hero-text-wrapper { ... }
.cmp-input-search .input-group { ... }
```

---

## Inventory of Files to Fix

### High Priority (Page Parity CSS - 384+ selectors)

| File | Selectors | Pages Affected | Strategy |
|------|-----------|----------------|----------|
| `listing-parity.css` | 233 | lista-risorse, amministrazione, novita, servizi, novita-dettaglio, evento-dettaglio, luoghi, etc. | Replace `body[data-page='xxx']` → `.page-content[data-slug="container0.xxx"]` or component classes |
| `topics-parity.css` | 67 | argomenti, argomento | Replace `main[data-page="argomenti"]` → `.page-content[data-slug="argomenti.index"]` or component classes |
| `argomenti-parity.css` | 28 | argomenti | Replace `main[data-page="argomenti"]` → component classes |
| `civic-design-global-fixes.css` | 17 | various | Migrate to component classes |
| `design-comuni-global-fixes.css` | 16 | various | Migrate to component classes |
| `ticket-parity.css` | 4 | ticket | Migrate to component classes |
| `tests-design-comuni-parity.css` | 5 | tests | Migrate to canonical test scope |
| `tests-index-parity.css` | 11 | tests.index | Migrate to canonical test scope |
| `homepage-parity-v2.css` | 2 | homepage | Migrate to component classes / body:has() |
| `container-override.css` | 1 | container | Migrate to component classes |

### Medium Priority (Layout & Global)

| File | Issue | Fix |
|------|-------|-----|
| `layouts/app.blade.php` line 10 | Injects `data-page` on `<main>` | Keep attribute for JS if needed, **stop using for CSS** |
| `faq-parity.css` | Uses `body.dc-faq-parity` class | Migrate to `body:has(.page-content[data-dc])` + component classes |

### Low Priority (Components CSS)

| File | Action |
|------|--------|
| `resources/css/components/design-comuni.css` | Ensure all component styles here, no page scoping |
| `resources/css/components/argomenti.css` | Same |
| `resources/css/components/faq.css` | Same (if exists) |

---

## Migration Strategy

### Phase 1: Audit & Map (Day 1)

1. **Catalog every `data-page` selector** with its target page slug
2. **Map to canonical slug** from Folio route / CMS page
3. **Classify each rule**:
   - `COMPONENT` → belongs in component CSS (design-comuni.css, argomenti.css, etc.)
   - `PAGE_SPECIFIC` → needs `.page-content[data-slug="..."]` scope
   - `GLOBAL_DC` → needs `body:has(.page-content[data-dc])` scope
   - `DUPLICATE` → remove, already covered by component styles

### Phase 2: Create Component CSS (Day 1-2)

Move all reusable component styles to proper component CSS files:

```
resources/css/components/
├── design-comuni.css       # All Design Comuni component styles
├── argomenti.css           # Argomenti component styles  
├── faq.css                 # FAQ component styles
├── listing.css             # Listing component styles
├── ticket.css              # Ticket component styles
├── header.css              # Header component styles
├── footer.css              # Footer component styles
└── global.css              # Truly global utilities only
```

### Phase 3: Replace Page-Specific CSS (Day 2-3)

For each page type:

**Test Pages** (`tests.*` slugs):
```css
/* BEFORE */
body[data-page='segnalazione-02-dati'] .steppers-header { ... }

/* AFTER */
.page-content[data-slug="tests.segnalazione-02-dati"] .steppers-header { ... }
```

**Design Comuni Pages** (pages with `data-dc` attribute):
```css
/* BEFORE */
body[data-page='lista-risorse'] .cmp-breadcrumbs { ... }

/* AFTER */
body:has(.page-content[data-dc]) .cmp-breadcrumbs { ... }
/* OR component-level (preferred): */
.cmp-breadcrumbs { ... }
```

**Container Pages** (`container0.index` slugs):
```css
/* BEFORE */
main[data-page="argomenti"] .it-hero-wrapper { ... }

/* AFTER */
.page-content[data-slug="argomenti.index"] .it-hero-wrapper { ... }
/* OR component-level: */
.cmp-hero .it-hero-wrapper { ... }
```

### Phase 4: Clean Up Parity CSS Files (Day 3)

After migration, the parity CSS files should be **empty or removed**:
- `listing-parity.css` → delete (all moved to component CSS)
- `topics-parity.css` → delete
- `argomenti-parity.css` → delete
- `civic-design-global-fixes.css` → delete
- `design-comuni-global-fixes.css` → delete
- `ticket-parity.css` → delete
- `tests-design-comuni-parity.css` → delete
- `tests-index-parity.css` → delete
- `homepage-parity-v2.css` → delete
- `container-override.css` → delete

### Phase 5: Verify & Test (Day 3-4)

1. **Build**: `cd laravel/Themes/Sixteen && npm run build`
2. **HTML Parity**: Run `compare-body-html.mjs` on all affected pages
3. **Visual Parity**: Screenshots at 375px, 768px, 1440px
4. **WCAG 2.1 AA**: axe-core + manual check
5. **PHPStan**: `cd laravel && ./vendor/bin/phpstan analyse`
6. **Pest Tests**: `cd laravel && ./vendor/bin/pest --compact`

---

## Detailed Migration Mapping

### listing-parity.css (233 selectors) → Component CSS

| data-page value | Canonical Slug | Target Component CSS |
|-----------------|----------------|---------------------|
| `lista-risorse` | `blog.index` | `design-comuni.css` (cmp-breadcrumbs, cmp-hero, it-card) |
| `amministrazione` | `amministrazione.index` | `design-comuni.css` (cmp-breadcrumbs, cmp-hero, card-teaser) |
| `novita` | `novita.index` | `design-comuni.css` (cmp-breadcrumbs, cmp-hero, it-card) |
| `servizi` | `servizi.index` | `design-comuni.css` (cmp-breadcrumbs, cmp-hero, service-list-item) |
| `novita-dettaglio` | `novita.show` | `design-comuni.css` (cmp-hero, it-card) |
| `evento-dettaglio` | `events.show` | `design-comuni.css` (cmp-hero, it-card) |
| `luoghi` | `luoghi.index` | `design-comuni.css` (listing styles) |
| `documenti-e-dati` | `documenti-e-dati.index` | `design-comuni.css` |

### argomenti-parity.css (28 selectors) → Component CSS

| data-page value | Canonical Slug | Target Component CSS |
|-----------------|----------------|---------------------|
| `argomenti` | `argomenti.index` | `argomenti.css` / `design-comuni.css` (cmp-hero, cmp-card-simple, cmp-rating, contacts) |

### topics-parity.css (67 selectors) → Component CSS

| data-page value | Canonical Slug | Target Component CSS |
|-----------------|----------------|---------------------|
| `argomenti` | `argomenti.index` | `argomenti.css` |
| `argomento` | `argomenti.show` | `argomenti.css` |

---

## Acceptance Criteria

### Must Pass (Code Quality)

- [ ] Zero `main[data-page="..."]` selectors in all CSS files
- [ ] Zero `body[data-page="..."]` selectors in all CSS files  
- [ ] Zero `body.dc-*` or `body.page-*` classes in CSS
- [ ] All component styles in `resources/css/components/*.css`
- [ ] No parity CSS files remaining (or empty)
- [ ] `npm run build` succeeds
- [ ] `phpstan analyse` passes (zero errors on touched files)

### Must Pass (Visual Parity)

- [ ] HTML parity ≥ 90% on all affected pages (main-only)
- [ ] Visual parity ≥ 95% on all affected pages
- [ ] Screenshots at 375px, 768px, 1440px match reference
- [ ] WCAG 2.1 AA verified

### Must Pass (Architecture)

- [ ] `<body>` tag plain in all pages (no custom classes)
- [ ] `data-page` attribute on `<main>` not used by any CSS
- [ ] Canonical wrapper `div.page-content[data-slug][data-side="content"]` used for scoping
- [ ] Design Comuni pages use `data-dc` attribute on wrapper
- [ ] No Bootstrap Italia CSS/JS in build

---

## Risk Mitigation

| Risk | Likelihood | Impact | Mitigation |
|------|------------|--------|------------|
| Visual regression on edge pages | Medium | High | Screenshot comparison before/after each page |
| Missing component class in Blade | Low | Medium | Audit all Blade components for class names |
| Specificity conflicts | Medium | Medium | Use cascade order: component CSS → page-scope → global |
| Cache issues on deploy | High | Low | Document cache clear in deployment checklist |

---

## Rollback Plan

If critical regression:
1. `git revert` the commit
2. `npm run build` to restore old CSS
3. Document failure in decision log

---

## References

- [CSS-SCOPING-RULE.md](../../architecture/css-scoping-rule.md)
- [BODY_CLASS_RULE.md](../../body-class-rule.md)
- [JSON_DRIVEN_PHILOSOPHY.md](../../design-comuni/json-driven-philosophy.md)
- [TAILWIND_ALPINE_RULES.md](../../design-comuni/tailwind-alpine-rules.md)
- [Design Comuni Reference](https://italia.github.io/design-comuni-pagine-statiche/)
- [Decision Log: D16/DCP-32](../decisions/parity-root-cause-and-guardrails.md)

---

## Stories (Implementation Order)

### Story 1: Audit & Catalog
- **File**: This plan + spreadsheet/map
- **AC**: Complete inventory of 384+ selectors with canonical slug mapping

### Story 2: Create Component CSS Files
- **Files**: `resources/css/components/*.css`
- **AC**: All reusable component styles extracted, no page scoping

### Story 3: Migrate listing-parity.css (233 selectors)
- **Files**: `listing-parity.css` → delete, component CSS
- **AC**: Zero selectors, visual parity maintained

### Story 4: Migrate topics/argomenti parity CSS (95 selectors)
- **Files**: `topics-parity.css`, `argomenti-parity.css` → delete
- **AC**: Zero selectors, visual parity maintained

### Story 5: Migrate remaining parity CSS (59 selectors)
- **Files**: `civic-design-global-fixes.css`, `design-comuni-global-fixes.css`, `ticket-parity.css`, `tests-*.css`, `homepage-parity-v2.css`, `container-override.css`
- **AC**: Zero selectors, visual parity maintained

### Story 6: Fix faq-parity.css body class
- **Files**: `faq-parity.css`, layout
- **AC**: No `body.dc-faq-parity`, uses `body:has(.page-content[data-dc])`

### Story 7: Verify & Gate
- **Commands**: Build, parity scripts, screenshots, WCAG, PHPStan, Pest
- **AC**: All gates pass

---

## Definition of Done

1. All stories complete with AC met
2. Decision log entry in `docs/bmad/decisions/`
3. Documentation updated in `docs/architecture/css-scoping-rule.md`
4. Team notified of new convention
5. No `data-page` CSS selectors remain in codebase