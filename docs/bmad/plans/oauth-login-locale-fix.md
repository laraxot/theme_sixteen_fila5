# BMAD / Filament Blueprint — Localized OAuth entry point

## Symptom

From `/it/auth/login`, the Google button generated `/auth/login/google`
without the active locale. The OAuth entry point must be `/it/auth/login/google`.

## Root cause

The shared Google button and the reusable Filament social-login views used
`route('oauth.redirect', ['provider' => ...])`. The named module route is not
locale-prefixed. The localized Folio/OAuth entry point already exists and its
callback is correctly generated as `/it/auth/login/google/callback`.

## Decision

Build the front-office OAuth URLs with
`LaravelLocalization::localizeURL('/auth/login/{provider}')`. Keep the existing
`oauth.redirect` route name, Socialite driver, callback route, and Filament
widget logic unchanged. This fixes the URL at the presentation boundary and
preserves one shared convention for Google, Microsoft, and GitHub.

## Acceptance checks

- Italian login renders Google as `/it/auth/login/google`.
- The entry point returns a 302 to Google with callback
  `/it/auth/login/google/callback`.
- Other locales preserve their prefix (`/en`, `/de`, `/es`).
- No controller, route-name, or Filament schema duplication is introduced.
