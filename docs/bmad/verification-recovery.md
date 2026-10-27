---
title: "Verification recovery"
type: note
status: draft
updated: 2026-10-26
tags: [docs, sixteen, bmad]
qmd: "verification recovery sixteen"
---
# Verification recovery

Purpose: make project verification reproducible and preserve observed defects and corrections.

- Vite resolves Lit and Leaflet from the theme dependency root with `resolve.dedupe`,
  including imports originating from Geo. A build with ancestor Lit/heat directories
  temporarily hidden passes. No runtime dependency is externalized.
- The public webroot must expose `themes/Sixteen` as a link to the theme public directory;
  its absence produced HTTP 500 despite a successful build.
- Strict axe found WCAG 2.5.3 label-content-name-mismatch on the authenticated desktop
  header. Its natural accessible name now comes from the real visible display name,
  including the preview fallback. A shared accessibility rule clips the name below
  992px instead of removing it from the accessibility tree. The language button also
  names its controlled menu. No page-specific name is hardcoded.
- The review audit must dismiss the consent banner before selecting the map point;
  otherwise the banner intercepts the click. Preserve all strict axe rules.
- Sixteen unit run: 710 passed and six stale assertions failed. Align tests with existing
  CMS type/view naming, intentionally absent empty CTA, shared report-step partials and
  semantic compiled CSS safety. Do not restore deleted page-specific Blade copies,
  hardcode translation defaults, or require a removed comment/obsolete minifier output.
- Scope the block naming guard to valid CMS slugs. Historical registry unit tests still
  test canonical/legacy classification independently; the registry is not an inventory
  of every domain-specific CMS block.

Checks: run PHP/Pest from Laravel; run build/browser checks from the theme. Browser
fixtures use disposable MariaDB schemas, a dedicated account and private storage.

## Verified results

| Check | Result |
| --- | --- |
| Whole Sixteen Unit scope | 716 passed, 3422 assertions |
| Final changed-contract and guest-name checks | 12 passed, 306 assertions |
| Root TestCase bootstrap | Premature migration call removed; Xot isolation guard reused |
| PHPStan changed PHP | Zero errors with existing configuration |
| PHPMD changed PHP | Pass |
| Pint changed PHP | Pass |
| PHP Insights root TestCase | Code/complexity/architecture/style all 100 |
| Blade compilation | Pass |
| Build and asset copy | Pass |
| Sibling dependency isolation build | Pass with ancestor Lit/heat hidden |
| Responsive home/login/wizard/settings | 12 cases: HTTP 200, no overflow, one H1 and one main |

The root application suite was run completely: 310 failed, 4 skipped, 37 passed.
These are unresolved baseline failures, not omitted checks. Frequent causes: 54 missing
Tenant schema assumptions, 20 starter tests using abstract factories, 18 obsolete `to`
parameters, 15 references to removed GeoDataValidationRules, and other stale APIs.
Module-wide discovery also fails on an empty `.git`-based hygiene dataset in this
exported checkout. No tests or modules were excluded to obtain the theme result.

## Repeat browser checks

Start `bashscripts/tools/visual/scratch-auth-fixture.sh` from the project root with
`APP_ENV=local`, a private `SCRATCH_AUTH_DIR`, and a free port. Verify its isolation
output before browser work. Obtain a real login session using the fixture account;
keep `auth.json` outside the repository. Use a preprovisioned test schema for cloning.

From the theme, set `FIXCITY_BASE_URL`, `FIXCITY_STORAGE_STATE`, `FIXCITY_TEST_EMAIL`
and `FIXCITY_TEST_PASSWORD` from the local scratch fixture, then run:

```bash
A11Y_STRICT=1 npx playwright test tests/browser/a11y-axe.spec.mjs tests/browser/header-menus-keyboard.spec.mjs tests/browser/header-logged-dropdown.spec.mjs --fully-parallel --workers=2 --timeout=90000
```

The 90s budget accommodates map setup, navigation and axe analysis on the shared
CPU host; no WCAG rule, assertion or HTTP status check is disabled. Use a private
`--output` directory when another agent runs browser tests. The rootless library
setup is in [project recovery](../../../../../docs/second-brain/project/project-confidence-recovery.md).
Only automation-covered WCAG criteria are claimed; screen-reader certification is
not inferred from axe output.

## Browser and layout evidence

Final browser run: **55 passed, 1 non-applicable**, zero failed. It includes strict
axe on 15 page/step states at three widths, Escape/focus checks, real login, and
account/language dropdown viewport checks. The optional mobile filter has no trigger
in the current page, so its test is explicitly skipped rather than called green.

- [Machine-readable verification summary](evidence/project-verification.json)
- [Twelve responsive page measurements](evidence/responsive-layout-checks.json)
- [Account-name accessibility and geometry](evidence/header-name-checks.json)
- Header screenshots: [375px](evidence/verification-header-375.png),
  [768px](evidence/verification-header-768.png), [1440px](evidence/verification-header-1440.png).

The name is visually clipped to 1px below 992px and remains named in the accessibility
tree; it is visibly 88px wide in the 1440px fixture. The actual renderer derives the name
from the current account and does not hardcode the fixture identity.

## CSS pipeline lesson

The legacy-important isolation plugin excludes unowned selectors from Design Comuni
pages. A shared accessibility override for this header must therefore explicitly scope
itself to `body:has(.page-content[data-dc])`; an unscoped important rule is intentionally
isolated and does not apply there. Keep the accessible-name clipping rule in the shared
shell accessibility stylesheet instead of adding page-specific CSS or duplicate labels.

The root TestCase now retains only used bootstrap behavior: its unused factory/auth
helpers had no callers and were removed. It no longer migrates before initialization.
The CMS test fixture declares an open array shape and validates every field it uses;
`mixed` is not needed. Follow the user's standing last-resort-only typing rule.

## Asset bytes and environment separation

Three previously committed Leaflet PNGs had invalid signatures/CRCs. Freshly generated
layers/layers-2x/marker PNGs match the installed Leaflet source bytes and pass full PNG
chunk CRC validation. Redundant trailing `!text !merge !diff` rules in the theme attributes
file were undoing `binary` safeguards. Removing those overrides restores ordinary binary
Git blobs without text normalization or LFS; verify staged bytes match source before commit.

Local `.env` must use `APP_ENV=local`. Using the testing template unchanged disables Boost
by design even when APP_DEBUG is true. `.env.testing` remains unchanged; test/schema tools
must explicitly isolate their connections rather than turn the whole app into a test run.
