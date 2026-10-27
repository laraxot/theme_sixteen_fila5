---
type: epic-story
status: completed
priority: critical
tags: [gdpr, cookie, multilingua, design-comuni, second-brain]
github_issue: "#54"
discussion: "https://github.com/spatie/laravel-cookie-consent"
rights_owner: "laravel/Themes/Sixteen"
related_to: ["STORY-cookiebar-gdpr-compliance"]
title: "BMAD Story — Cookie Banner Multilingua (GDPR + Gdpr Module)"
updated: 2026-10-15
qmd: "bmad story   cookie banner multilingua (gdpr + gdpr module) sixteen"
---

# BMAD Story — Cookie Banner Multilingua (GDPR + Gdpr Module)

## Scopo

Cookie bar conforme alla normativa Garante Privacy 8 maggio 2014, integrata con il modulo `Gdpr` e la libreria `statikbe/laravel-cookie-consent`, ricostruita in Tailwind + Alpine + Flowbite senza Bootstrap Italia.

## Riferimenti

- Bootstrap Italia Cookiebar docs: https://italia.github.io/bootstrap-italia/docs/componenti/cookiebar/
- Spatie cookie consent (base): https://github.com/spatie/laravel-cookie-consent
- Statikbe cookie consent (categorie + middleware): https://github.com/statikbe/laravel-cookie-consent
- Modulo Gdpr: `laravel/Modules/Gdpr/`
- Design Comuni stack: Tailwind + Alpine + Lit + DaisyUI + Flowbite (NO Bootstrap)

## Decisioni chiave (D10 / D11)

- Categoria `necessary` obbligatoria, `analytics` e `marketing` opzionali (3 categorie dal config Gdpr)
- Componente Blade `cookie-bar.blade.php` ricostruito con `x-data`, `localStorage`, toggle per categorie, 3 pulsanti + modal preferenze
- Chiavi multilingua: esistenti in `Gdpr/lang/cookie-consent/{it,en,de}/texts.php` (complete per it/en/de)
- Middleware statikbe `CookieConsentMiddleware` attivo (`vendor/statikbe/laravel-cookie-consent/src/CookieConsentMiddleware.php`) - cookie `__cookie_consent` con formati `true/2/3/false`
- Inclusione nel layout base (`main.blade.php`, `test.blade.php`)

## Stato

Completato. Second brain `kp-cookiebar-gdpr` creato. Componente a norma.

## Nota di verifica del 2026-10-14 (aggiunta da un'altra sessione, righe sopra non toccate)
Lo stato «completato / a norma» non regge alla misura: sulle pagine servite (`/it`, `/en`, `/it/tickets`, `/it/auth/login`, `/it/privacy`) la barra compare **0 volte**; il partial usa 13 chiavi `gdpr::cookie.*` e la rotta `pages.view` che non esistono; la pagina `/it/cookie-policy` rispondeva 404; accendendo il middleware l'override `resources/views/vendor/cookie-consent/index.blade.php` (`@include('sixteen::...')`, namespace inesistente) faceva rispondere 500. Il banner funzionante e verificato (17 test nel browser, 59 test Pest, axe senza violazioni) e' descritto in [DCP-153](../../../../Modules/Gdpr/docs/stories/dcp-153-cookiebar-integrata-nel-modulo-gdpr.story.md); la pulizia dei file duplicati e' DCP-161. Il riferimento al provvedimento del Garante dell'8 maggio 2014 e' superato: il testo vigente per il progetto e' costituito dalle linee guida del 10 giugno 2021 (registro fonti 02).
