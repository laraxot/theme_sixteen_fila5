---
title: "Locale '/it' non supportato — correzione LoginWidget (D37)"
status: completed
decision: D37
updated: 2026-10-18
tags: [bmad, second-brain, mcamara, localization, login]
related:
  - ../../../../Modules/User/docs/bmad/decision-log.md
  - ../../../../Modules/User/docs/bmad-second-brain.md
type: story
qmd: "errore: `locale '/it' is not in the list of supported locales` sixteen"
---

# Errore: `Locale '/it' is not in the list of supported locales`

## Causa

`LoginWidget` chiamava:

```php
LaravelLocalization::getLocalizedURL('/' . app()->getLocale());
```

La firma del package ([mcamara/laravel-localization](https://github.com/mcamara/laravel-localization)) è:

```php
getLocalizedURL($locale = null, $url = null, ...)
localizeURL($url = null, $locale = null) // wrapper: getLocalizedURL($locale, $url)
```

Passare `'/it'` come **primo** argomento di `getLocalizedURL` lo tratta come
**locale**, non come URL → `UnsupportedLocaleException`.

## Correzione

```php
$locale = trim((string) app()->getLocale(), '/');
LaravelLocalization::localizeURL('/', $locale);
// oppure, solo se serve locale esplicito:
// LaravelLocalization::getLocalizedURL($locale, '/');
```

Nel submit Livewire (`POST /livewire-*`) la locale della pagina
`/it/auth/login` non è garantita dal path: normalizzare e validare contro
`getSupportedLanguagesKeys()`.

## Anti-pattern

- `getLocalizedURL('/')` — `/` diventa locale
- `getLocalizedURL('/it')` — `/it` diventa locale
- `getLocalizedURL(route('dashboard'))` — URL assoluto interpretato come locale

## Pattern corretto

- URL nella lingua corrente: `localizeURL($url)`
- Locale + URL espliciti: `getLocalizedURL($locale, $url)`
