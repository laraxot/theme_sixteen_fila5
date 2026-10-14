---
id: header-auth-state-study-decision
type: bmad-decision
status: accepted
links:
  github_issue: "#999"
  discussion: "#design-comuni"
title: "Header Auth-State — Design + Function + Legal Framework"
updated: 2026-10-13
tags: [docs, sixteen, bmad]
qmd: "header auth-state   design + function + legal framework sixteen"
---
# Header Auth-State — Design + Function + Legal Framework

## Purpose (function, not decoration)
Header "Accedi all'area personale" must reflect user authentication state because:
- Unauthenticated (guest): must see login access + basic navigation (function = access to services without identity barrier — GDPR art 6(1)(e) public task / art 5(1)(c) data minimization — no data processing until consent/auth)
- Authenticated: must see relevant data (function = service delivery — user can see their reports, payments, benefits, permissions — GDPR art 6(1)(b) contract / art 6(1)(a) consent if additional processing)
- Reference pages (segna-area-personale, graduatoria, vantaggi, pagamenti, permessi) are not decorative templates — they serve real public-service functions.

## Design-Comuni Reference Study (function mapping)
- `segnalazione-area-personale`: reporting function — user needs to see submitted reports (access to own data, GDPR art 15)
- `graduatoria-area-personale`: ranking/result function — user sees ranking/position (transparency, public task)
- `vantaggi-area-personale`: benefits/access rights (service delivery, contract basis)
- `pagamenti-imu/multa-area-personale`: payments (service delivery, contract)
- `permessi-area-personale`: permissions/approvals

## Legal Framework (must be respected in every change)
- GDPR (Reg EU 2016/679): art 5 (principles: lawfulness, fairness, transparency, purpose limitation, minimization, accuracy, storage limitation, integrity/confidentiality); art 6 (lawfulness of processing: consent, contract, legal obligation, vital interests, public task, legitimate interests); art 13/14 (info to data subject); art 15 (access); art 20 (portability); art 32 (security)
- Italian Codice PA (CAD): public administration digital identity/access rules
- Accessibility: WCAG 2.1 AA (Legge Stanca / EU Directive 2016/2102 / EU Directive 2019/882 EAA); focus-visible; touch >=44px; reduced-motion
- eIDAS (Reg EU 910/2014): digital identity/authentication framework for public services (login/auth mechanism)
- Multi-language: SetFolioLocale middleware supports IT/EN; must work for international citizens (GDPR art 5(1)(d) accuracy + art 13 transparency in user's language)

## Mobile/Responsive + Professional Quality
- Responsive breakpoints: 375/768/1440 verified
- Touch targets >=44px (WCAG 2.5.5)
- Focus-visible states on all interactive elements
- `prefers-reduced-motion` fallback
- Professional academic: every change with reason, documented in BMAD + second brain, verified with `view:clear` + `curl` + `ux_audit`, no invent (R006)

## Decision (accepted after implementation verification)
- Auth-state logic must check Laravel auth state (`auth()->check()` or middleware context)
- Guest state (`!auth()->check()`): show "Accedi all'area personale" linking to `route('login')` (function = access to personal area requires authentication; no data shown — GDPR minimization)
- Authenticated state (`auth()->check()`): show user-relevant links (reports/payments/benefits) based on reference page patterns (function = service delivery; only show user's own data — GDPR purpose limitation + access rights)
- Multi-language behavior: same structure in IT/EN (label translation handled via locale system; link structure consistent; GDPR art 13/14 info accessible in user's language)
- Every component change must reference this decision + be verified (bmad + second brain + audit + visual verification with reference pages if available, else with design-comuni patterns)
- No decoration: header/auth-state is a service-delivery mechanism, not a decorative navigation bar.
