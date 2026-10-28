---
title: "Auth login — Design Comuni remediation"
type: plan
status: in-progress
updated: 2026-10-20
tags: [docs, sixteen, bmad]
qmd: "`/it/auth/login`   census and correction plan sixteen"
---

# `/it/auth/login` — census and correction plan

## Intent

Bring the public login into the Sixteen front-office contract: CMS/Folio
provides content, the Sixteen theme provides reusable Design Comuni framing and
styles, and `Modules\User\Filament\Widgets\Auth\LoginWidget` owns only the
authentication interaction.

## Census (evidence first)

1. **Deployment drift (P0).** The public response still contains legacy
   `data-bs-*` attributes, Bootstrap Italia sprite references and the old
   header asset. The local source is on the Sixteen/Vite path. This is a
   release/cache/deployment mismatch, not a reason to fork the page template.
2. **Broken recovery link (P0).** The page emitted
   `/it/auth/password/forgot`, but the registered localized route is
   `/it/forgot-password` (`password.request`).
3. **Translation contract violation (P1).** The page used
   `fixcity::auth.login.*`; those keys are not the User auth contract, so the
   public page rendered the literal key for “create account”. Use
   `user::auth.login.*` for User-owned auth copy and keep CMS heading/intro
   data-driven.
4. **Merge integrity failure (P0).** The login block contained unresolved
   merge markers and two competing implementations. A Blade file with
   `<<<<<<<`/`=======`/`>>>>>>>` cannot be shipped or reliably cached.
5. **Ownership risk (P1).** Registration, recovery, accessibility and social
   actions must each have one visible owner. The page block owns page-level
   navigation; the Filament widget owns credentials, errors, loading and
   submit; no disconnected Alpine submit state or duplicated Google control.
6. **Responsive/a11y gate (P1).** The final structure must preserve one `h1`,
   labelled form controls, visible keyboard focus, loading announcement and no
   horizontal overflow at 375, 768 and 1440 px.

## Plan (BMAD / Blueprint execution)

### Step 1 — Stabilise the contract (serial)

- Resolve the component to one clean CMS-driven implementation.
- Use the registered localized recovery path and User translation namespace.
- Keep Filament as the single form/submit owner.
- Add a source contract test preventing merge markers, wrong route and wrong
  translation namespace.

Exit: Blade cache succeeds; unit contract passes.

### Step 2 — Verify Design Comuni parity (serial after Step 1)

- Compare the local rendered DOM with the Design Comuni reference at the three
  required widths.
- Check landmarks, breadcrumb, focus order, field/error/loading states and
  mobile overflow.
- Change only shared component hooks/tokens; do not add `data-page` selectors
  or page-specific CSS branches.

Exit: no P0/P1 markup or accessibility defect remains; visual differences are
recorded with evidence.

### Step 3 — Release integrity (serial after Step 2)

- Build Sixteen assets from `laravel/Themes/Sixteen`.
- Clear/rebuild Laravel view caches from `laravel`.
- Confirm the deployed HTML references the new Vite manifest and contains no
  stale auth markup.

Exit: deployment is explicitly verified; local success is not reported as live
success until the public response changes.

### Step 4 — Regression gate (serial)

- Run the targeted Sixteen/User tests and route checks.
- Run the login feature test only with the test database provisioned.
- Record environment blockers as `UNVERIFIED`, never as passing checks.

## Current execution

Step 1 is implemented locally. Steps 2–4 remain gated by browser tooling,
asset/build output and deployment authority. No production deployment is
performed by this change.