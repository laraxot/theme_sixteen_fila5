---
title: "Header FO — named route Folio verificate"
type: concept
tags: [folio, header, routing, named-routes, six]
created: 2026-06-05
updated: 2026-06-05
qmd: "folio named route header services.categories area-personale.notifiche dashboard profile.edit logout"
related:
  - fo-folio-links-multilingua.md
  - ../../../../../../docs/wiki/rules/folio-frontoffice-navigation-links.md
---

# Header FO — named route Folio verificate

## Regola

Il dropdown utente **non** usa helper PHP che inventano path (`FrontofficeUrl::personalAreaServices()`).

Usa **`route('<name>')`** solo per pagine Folio con `name()` registrato e verificato:

```bash
cd laravel && php artisan folio:list
```

## Mapping menu (2026-06-05)

| Voce | `route()` | Pagina Folio |
|------|-----------|--------------|
| I miei servizi | `services.categories` | `pages/lista-categorie.blade.php` |
| Le mie pratiche | `dashboard` | `Modules/User/.../dashboard/index.blade.php` |
| Notifiche | `area-personale.notifiche` | `pages/area-personale/notifiche.blade.php` |
| Impostazioni | `profile.edit` | `Modules/User/.../profile/edit.blade.php` |
| Esci | `logout` | `pages/auth/logout.blade.php` |
| Accedi (guest) | `login` | `pages/auth/login.blade.php` |

## Esempio canonico

```blade
<a href="{{ route('services.categories') }}" role="menuitem">
    <span>{{ __('pub_theme::header.user.dropdown.my_services.label') }}</span>
</a>
```

## Vietato

```blade
href="{{ \Themes\Sixteen\Support\FrontofficeUrl::personalAreaServices() }}"
href="/{{ app()->getLocale() }}/lista-categorie"
route('tests.view', ['slug' => 'servizi'])
route('user.services')
```

## `FrontofficeUrl` — scope ridotto

Solo utility CMS/JSON: `path()`, `fromStoredUrl()`, `testsParity()`.

**Non** per il menu utente.

## Perché (zen)

- La rotta **è** il file Folio — `route()` è il contratto Laravel verso quel file.
- Helper custom duplicano path e divergono da `folio:list`.
- Path in italiano (`profilo/servizi`) non esistono nel filesystem pages.

## Verifica

- Pest: `tests/Unit/HeaderAreaPersonaleLinksContractTest.php`
- CLI: `php artisan folio:list | grep services.categories`
