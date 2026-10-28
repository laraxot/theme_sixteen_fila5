---
title: "BMAD — Riordino componenti auth (auth-login → auth/login)"
type: plan
status: active
updated: 2026-10-27
tags: [auth, sixteen, bmad, design-comuni, components]
qmd: "bmad auth components reorg sixteen no-auth-prefix"
related:
  - ../auth-login-architettura.md
  - ../plans/auth-login-design-comuni.md
  - ../bmad/filament-blueprint.md
decisions:
  - D-REORG-01: i file `components/pages/auth-*.blade.php` (prefisso ridondante) vanno in `components/pages/auth/*.blade.php`.
  - D-REORG-02: il componente `login.blade.php` esiste già come bridge; si aggiorna a punta al nuovo `auth/login.blade.php`.
  - D-REORG-03: nessun controller, nessun foglio CSS nuovo; si riusa `.auth-login-*` esistente.
constraints:
  - NO controllers (AGENTS.md)
  - NO Bootstrap Italia
  - Folio + Volt per le pagine (`pages/auth/`)
  - CMS JSON fornisce slug/view (`auth.login` → `pub_theme::components.pages.auth-login`)
  - Design Comuni: `data-dc`, `<x-auth.shell>`, widget Filament
  - File in inglese (regola naming)
---

# BMAD — Riordino componenti auth Sixteen

## Perché
`components/pages/auth-login.blade.php` (e `auth-password-reset`, `auth-password-token`, `auth-register`) hanno il prefisso `auth-` ridondante perché già sotto `pages/auth/`. Inoltre `auth-login.blade.php` contiene un merge conflict (`<<<<<<< .merge_file_16DQ8z`) e un blocco `<style>` privato che va sostituito con la filosofia `x-auth.shell` usata da `auth-register.blade.php` e `auth-password-reset.blade.php`.

## Filosofia (da `pages/auth/login.blade.php` + `index.blade.php`)
- Pagina Folio piccola (`name`, `middleware`, `render`, `mount`, `<x-layouts.app>`, `@volt`).
- Componente `components/pages/auth/*.blade.php` gestisce il vestito (`<x-auth.shell>`, widget Livewire, link locali via `FrontofficeUrl`).
- Nessun controller, nessuna API, nessun CSS aggiuntivo: `data-dc` attiva gli stili condivisi (`14-auth-login.css`).

## Azioni (ordine)
1. Creare `components/pages/auth/login.blade.php` (pulito, `<x-auth.shell>`, risolto merge, senza `<style>` privato, usa widget `LoginWidget`).
2. Creare `components/pages/auth/register.blade.php` (da `auth-register.blade.php`).
3. Creare `components/pages/auth/password-reset.blade.php` (da `auth-password-reset.blade.php`).
4. Creare `components/pages/auth/password-token.blade.php` (da `auth-password-token.blade.php`).
5. Aggiornare `components/pages/auth/login.blade.php` (compatibilità) → `@include('pub_theme::components.pages.auth.login')`.
6. Aggiornare CMS JSON / blocchi se riferiscono il vecchio nome (`auth-login` → `auth/login`?). **Nota:** il CMS usa `pub_theme::components.pages.auth-login`; se cambiamo il file componente, il riferimento nel JSON deve essere aggiornato oppure mantenuto come alias. Per sicurezza si mantiene il riferimento CMS e si aggiorna il componente nuovo; il bridge `auth/login.blade.php` (compatibilità) mantiene il vecchio nome per i blocchi esistenti.
7. Verifica `tests/Unit/AuthLoginStyleContractTest.php` (non deve rompersi, le classi `.auth-login-*` restano).
8. Commit.

## Riferimenti file
- Source (prefisso ridondante): `components/pages/auth-login.blade.php`, `auth-register.blade.php`, `auth-password-reset.blade.php`, `auth-password-token.blade.php`
- Filosofia pagina: `pages/auth/login.blade.php`, `pages/index.blade.php`
- Componenti shell: `components/auth/shell.blade.php`
- CSS condiviso: `resources/css/app/14-auth-login.css`
- Widget: `Modules/User/Filament/Widgets/Auth/LoginWidget`, `ForgotPasswordWidget`, `ResetPasswordWidget`; `Modules/Gdpr/Filament/Widgets/Auth/RegisterWidget`