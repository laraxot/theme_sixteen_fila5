---
title: "Front office UI/UX Design Comuni"
type: note
status: draft
updated: 2026-10-22
tags: [docs, sixteen, plans]
qmd: "front office ui/ux design comuni sixteen"
---
# Front office UI/UX Design Comuni

## Objective

Bring the active Sixteen front office to one coherent Design Comuni experience across IT, EN, DE and ES, while preserving CMS-driven content and the Folio route contract.

## Scope

- active Folio pages and shared layouts, header, footer, breadcrumbs and blocks;
- navigation and internal links, including ticket, service, blog and event journeys;
- reusable, nullable-safe and data-driven components;
- responsive behavior at 375px, 768px and 1440px;
- WCAG 2.1 AA basics: landmarks, names, contrast, focus and keyboard behavior;
- Playwright smoke and axe checks where the browser/runtime is available.

## Execution waves

1. Inventory active routes, layouts, blocks and existing browser contracts.
2. Correct root causes in shared components and route helpers; avoid page-specific duplication.
3. Verify multilingual URL generation and content fallback behavior.
4. Run PHPStan, Blade cache, asset build and browser checks serially; record environment blockers as unverified.
5. Keep this plan and durable decisions in the owning theme docs; do not create timestamped filenames.

## Invariants

- Front-office links use named Folio routes (`container0.index` and `container0.view`) or the project’s stored-URL normalizer.
- `LaravelLocalization::localizeUrl()` is not used in active front-office views.
- CMS JSON remains the source of page-specific labels and URLs; theme config is only a safe fallback.
- Shared blocks stay reusable and data-driven; repeated markup is not copied into individual pages.
- No destructive cleanup of historical docs is performed without link/reference evidence.

## Exit criteria

- PHPStan reports no errors for `Modules`.
- Active front-office link and localization contracts pass.
- Browser smoke/axe checks are green, or a concrete runtime/tooling blocker is reported.
- `graphify update .` completes after code changes.
- `git diff --check` is clean.
