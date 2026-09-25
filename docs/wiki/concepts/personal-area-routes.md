---
title: "Area personale — rotte FO (deprecato, vedi canon)"
type: concept
tags: [folio, header, routing, deprecated, sixteen]
created: 2026-06-05
<<<<<<< HEAD
updated: 2026-06-10
=======
updated: 2026-07-13
>>>>>>> edd328a (.)
qmd: "area personale personal area routes deprecated notifications folio named route"
issues:
  - https://github.com/laraxot/base_fixcity_fila5/issues/289
related:
  - fo-folio-named-routes-header.md
  - fo-folio-routing-zen.md
  - ../../../../Modules/Cms/docs/wiki/concepts/folio-filesystem-routing-no-web-php.md
---

# Area personale — rotte FO

> **Deprecato come guida autonoma.** Usare i canon sotto — questo file resta solo per qmd/backlink storici.

<<<<<<< HEAD
## Canon attuale (2026-06-10)

| Argomento | Documento |
|-----------|-----------|
=======
## Canon attuale (2026-07-13)

| Argomento | Documento |
|-----------|-----------|
| Volt + auth via JSON CMS | [folio-volt-app-pages.md](folio-volt-app-pages.md) |
>>>>>>> edd328a (.)
| Dropdown header + `route()` | [fo-folio-named-routes-header.md](fo-folio-named-routes-header.md) |
| File = rotta, no web.php | [fo-folio-routing-zen.md](fo-folio-routing-zen.md) |
| Mount + modello mentale | [folio-filesystem-routing-no-web-php.md](../../../../Modules/Cms/docs/wiki/concepts/folio-filesystem-routing-no-web-php.md) |
| Cache stale | [route-not-found-view-cache.md](../troubleshooting/route-not-found-view-cache.md) |

<<<<<<< HEAD
=======
## Rotte area personale (Sixteen)

| `name()` | File Folio (owner) | Auth |
|----------|-------------------|------|
| `dashboard` | `Modules/User/resources/views/pages/dashboard/index.blade.php` | JSON `dashboard.json` |
| `area-personale.pratiche` | `Modules/User/.../area-personale/pratiche.blade.php` | JSON `area-personale.pratiche.json` |
| `area-personale.servizi` | `Modules/User/.../area-personale/servizi.blade.php` | JSON `area-personale.servizi.json` |
| `area-personale.impostazioni` | `Modules/User/.../area-personale/impostazioni.blade.php` | JSON `area-personale.impostazioni.json` |
| `services.categories` | `Modules/Fixcity/.../lista-categorie.blade.php` | CMS |
| `notifications` | `Modules/User/.../notifications/index.blade.php` | Folio `middleware(['web','auth'])` (owner User) |

Tema Sixteen `pages/`: solo `auth/`, `[container0]/`, `tests/` — [page-directory-structure.md](../../page-directory-structure.md) · [folio-app-pages-owner.md](../../../../Modules/User/docs/wiki/concepts/folio-app-pages-owner.md).

`/area-personale/notifiche` → redirect Volt verso `/notifications` (alias legacy).

>>>>>>> edd328a (.)
## Cosa NON fare (imparato)

- **Vietato** nomi route italiani (`area-personale.notifiche`, `area-personale.services`)
- **Vietato** registrare FO in `web.php`
- **Vietato** `FrontofficeUrl::personalArea*` per voci menu dropdown
- **Corretto** notifiche: `name('notifications')` (User) + `route('notifications')` (Sixteen)

## Notifiche — mapping definitivo

| Layer | Valore |
|-------|--------|
| Pagina Folio | `Modules/User/resources/views/pages/notifications/index.blade.php` |
| `name()` | `notifications` |
| URL | `/it/notifications` |
| Label header | `pub_theme::header.user.dropdown.notifications.label` |
