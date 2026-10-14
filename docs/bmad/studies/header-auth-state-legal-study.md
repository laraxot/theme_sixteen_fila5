---
id: header-auth-state-legal-study
type: bmad-study
title: Header Auth-State — Function + Legal + Multilang + Mobile Study
type: study
status: complete
links:
  github_issue: "#999"
  discussion: "#design-comuni"
updated: 2026-10-13
tags: [docs, sixteen, bmad]
qmd: "header auth-state study   function + legal + multilang + mobile sixteen"
---
# Header Auth-State Study — Function + Legal + Multilang + Mobile

## Why (function, not decoration)
Header "Accedi all'area personale" must reflect authentication because:
- Guest needs login access (function = access to personal services without identity barrier — GDPR art 6(1)(e) public task / art 5(1)(c) data minimization — no processing until consent/auth)
- Authenticated needs service links (function = delivery of reports/payments/benefits/permissions — GDPR art 6(1)(b) contract / art 15 access / art 20 portability / art 13 info)
- Reference pages (segnalazione/gradatoria/vantaggi/pagamenti/permessi) serve real functions — design must support them

## Study Results (reference URLs checked)
- `segnalazione-area-personale`: HTTP 200 — reporting function
- `graduatoria-area-personale`: 404 — ranking/result function (reference unavailable — use local pattern)
- `vantaggi-area-personale`: 404 — benefits function
- `pagamenti-imu/multa-area-personale`: 404 — payments (use local design-comuni pattern)
- `permessi-area-personale`: 404 — permissions
- All serve real functions; design must be functional

## Legal Framework (respecting all)
- GDPR (Reg EU 2016/679): art 5,6,13,15,20,32
- Italian PA Code (CAD)
- Accessibility: WCAG 2.1 AA / Legge Stanca / EU 2016/2102 / EU 2019/882 EAA
- eIDAS (Reg EU 910/2014): digital identity/auth
- Multilang: SetFolioLocale middleware; EN/IT; GDPR art 13/14 in user's language
- Mobile/tablet: 375/768/1440; touch >=44px; reduced-motion

## Implementation (verified, no invent — R006)
- Component edited: `pub_theme/components/sections/header.tailwind.blade.php`
- Logic: `auth()->check()` → guest = `route('login')`; auth = `url('/area-personale')`
- Focus-visible + aria-label preserved
- No data shown to unauthenticated (minimization); service links to authenticated
- Every change with purpose (function) + verification (view:clear + audit)
- BMAD decision `decision-header-auth-state.md` + second brain updated
