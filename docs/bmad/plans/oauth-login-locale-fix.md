---
title: "BMAD — Localized OAuth entry point"
type: plan
status: done
created: 2026-10-20
updated: 2026-10-26
related:
  - ../decision-log.md
  - ../filament-blueprint.md
  - ../../social-login-docs.md
  - ../../../../Modules/User/docs/bmad/google-auth-login.md
tags: [docs, sixteen, bmad]
qmd: "bmad / filament blueprint   localized oauth entry point sixteen"
---

# BMAD / Filament Blueprint — Localized OAuth entry point

## Symptom

From `/it/auth/login`, the Google button generated `/auth/login/google`
without the active locale. The OAuth entry point must be `/it/auth/login/google`.

## Why (business / religion)

The public site is always locale-prefixed. Google’s `GOOGLE_REDIRECT_URI` is
`/it/auth/login/google/callback`. Entry and callback must share the same
locale context so the citizen stays in Italian (or `en`/`de`/`es`) and the
OAuth state/session matches the console redirect URI.

## Root cause

1. Presentation used `route('oauth.redirect', ['provider' => ...])` without
   `lang`. The named route is `{lang}/auth/login/{provider}`
   (`Modules/User/routes/socialite.php`).
2. Stale compiled Blade kept an old href on production-like caches.
3. Folio callback stub used `request()->segment(3)` which, under `/it/...`,
   reads `login` and `abort(404)` — so the localized callback could not
   complete even when the entry redirect worked.
4. Controllers typed `Illuminate\Support\Facades\Request` and only declared
   `$provider`. With `{lang}` in the URI, Laravel bound `it` into `$provider`
   → `ProviderNotConfigured("it")`.

## Decision

- Build FO Google URLs with
  `route('oauth.redirect', ['provider' => 'google', 'lang' => $locale])`
  (fallback: `localizeURL('/auth/login/google', $locale)`).
- Keep `oauth.redirect` as the classic entry route; `oauth.callback` is now the
  redirect-only Folio page at `pages/auth/login/[provider]/callback.blade.php`.
  Its provider guard runs inside `render()`, so Folio route-name discovery does
  not execute an `abort()` at file scope. The callback policy is shared by the
  `ProcessSocialiteCallbackAction`; `web.php` remains unchanged.
- Language entry point survives the fixed `GOOGLE_REDIRECT_URI` through the
  session (`ProcessCallbackSession::KEY`); `{lang}` and
  `{provider}` are constrained in `socialite.php`.
- The login error block is the widget's (`filament/widgets/auth/login.blade.php`),
  styled by `.auth-login-alert*` in `components/pages/auth-login.blade.php`.
- Controllers: `__invoke(Request $request, string $lang, string $provider)` with
  `Illuminate\Http\Request`.
- Do not open Google OAuth in a new tab (session/state must stay on the same
  browsing context).

## Acceptance checks

- Italian login renders Google as `/it/auth/login/google`.
- The entry point returns a 302 to Google with callback
  `/it/auth/login/google/callback`.
- Localized callback invokes the Folio page and returns a real redirect (no
  segment-3 404).
- Other locales preserve their prefix (`/en`, `/de`, `/es`).
- No new controller or Filament schema duplication.
