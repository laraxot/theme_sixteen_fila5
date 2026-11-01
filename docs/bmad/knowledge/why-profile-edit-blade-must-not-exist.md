---
title: "Perché pages/profile/edit.blade.php nel tema non deve esistere"
type: knowledge-page
status: active
created: 2026-10-22
updated: 2026-10-22
tags: [knowledge, architecture, bmad, second-brain, sixteen, folio, profile, filament-blueprint]
qmd: "why profile edit blade must not exist theme sixteen folio container0 area-personale"
related:
  - ../container0-index-shell-contract.md
  - ../filament-blueprint.md
  - ../decision-log.md
  - ../../page-directory-structure.md
  - ../../wiki/rules/sixteen-pages-folder-religion.md
  - ../../wiki/concepts/fo-folio-links-multilingua.md
  - ./why-domande-frequenti-blade-php-must-not-exist.md
  - ../../../../../Modules/User/resources/views/pages/profile/edit.blade.php
---

# Perché `Themes/Sixteen/.../pages/profile/edit.blade.php` non deve esistere

Il file **non** deve essere nel tema. È già stato creato (almeno) tre volte come
«fix» a un 404 e poi rimosso. Stesso errore di `pages/domande-frequenti/`.

## Lo scopo (business)

«Impostazioni profilo» nel FO civico è l’**area personale**: privacy, preferenze
notifiche, dati account. Vive sotto `/it/area-personale/impostazioni` (CMS JSON +
blocchi Fixcity). Non è una seconda applicazione Laravel Breeze nel tema.

Il modulo **User** possiede eventualmente `Modules/User/.../pages/profile/edit.blade.php`
(`name('profile.edit')`) per logica account. Il tema **veste** e collega; non
duplica la pagina Folio.

## Perché crearla nel tema è sbagliato

1. **Religione `pages/`** — in Sixteen solo `auth/`, `[container0]/`, `tests/`.
   Una cartella `profile/` è dominio semantico vietato
   ([page-directory-structure.md](../../page-directory-structure.md)).
2. **Catch-all** — `[container0]/[slug0]` intercetta `/profile/edit` prima che
   emerga la pagina del modulo: un alias nel tema non «ripara» il 404, crea una
   **seconda Volt** che compete con User e con `area-personale.impostazioni`.
3. **Filament blueprint** — il tema non ha Resource; le impostazioni FO si
   montano da JSON `area-personale.impostazioni` + widget owner, non da una
   Blade Folio inventata nel tema.
4. **DRY / KISS** — header già punta a
   `FrontofficeRoutes::personalAreaImpostazioni()` (mai `pages/profile/` locale).

## Cosa fare invece (quando serve una pagina)

| Bisogno | Azione corretta |
|---------|-----------------|
| Link FO «Impostazioni» | `FrontofficeRoutes::personalAreaImpostazioni()` → `container0.view` area-personale/impostazioni |
| Contenuto impostazioni | JSON `config/local/fixcity/database/content/pages/area-personale/impostazioni.json` + blocco/widget Fixcity/User |
| Logica profilo User | Solo in `Modules/User/...` — mai copiare in Sixteen |
| 404 su `/profile/edit` | Correggere il **link** che emette quell’URL; **non** creare la Blade nel tema |

## Enforcement

- Pest: `NoSemanticFolioPageDirectoriesTest` (cartella `profile` vietata esplicitamente)
- Hook: `bashscripts/ai/.agents/hooks/theme-pages-guard.sh` (rifiuta creazione sotto `pages/<nuovo>/`)
- Canone: [sixteen-pages-folder-religion.md](../../wiki/rules/sixteen-pages-folder-religion.md)

## Catena canonica FO

```text
Header «Impostazioni»
  → FrontofficeRoutes::personalAreaImpostazioni()
  → route('container0.view', area-personale / impostazioni)
  → pages/[container0]/[slug0]/index.blade.php
  → slug area-personale.impostazioni
  → JSON tenant + blocchi owner
```
