---
title: "register ux audit"
type: note
tags: [documentation]
created: 2026-09-26
updated: 2026-10-07
qmd: "register ux audit"
issues:
  - "https://github.com/laraxot/base_fixcity_fila5/issues/572"
discussions:
  - "https://github.com/laraxot/base_fixcity_fila5/discussions/573"
---

# Register `/it/auth/register` — audit UX/WCAG/funzionamento (2026-06-04)

## Problemi trovati (prima)

| Area | Issue |
|------|--------|
| UI | Password + conferma affiancate in `Grid::make(2)` (layout stretto) |
| UI | Widget in `user::widgets.auth.register-widget` (no tema Sixteen) |
| UI | Submit `bg-primary-600` → rischio blu legacy |
| UI | Password senza bordo (suffix reveal) |
| UX | Label/placeholder grezzi se cache traduzioni stale (`user::user_form`) |
| UI | Password + conferma affiancate (`Grid::make(2)`) — layout stretto |
| UI | Label/placeholder = nome campo (`first_name`) — `user_form.php` auto-seed |
| WCAG | Nessun `role="alert"` / `aria-live` su errori |
| WCAG | Pagina senza `data-page`, no `id` heading form |
| Funzione | `user::auth.registration.success` / `error_occurred` assenti |
| Funzione | `RuntimeException` su errore generico |

## Fix applicati

- `UserForm::getRegisterFormSchema()`: password e `password_confirmation` in colonna (`columnSpanFull`, no grid 2 colonne)
- `14-auth-login.css`: helper `fi-sc-dense` leggibile; password full-width su `auth-register`
- `user_form.php` (it): label/placeholder/helper campi register
- CTA submit `w-full min-h-[44px]`; nav secondaria con `aria-label` coerente
- `pages/auth/register.blade.php`: `bodyPage="auth-register"`, `auth-register-card`, meta, `aria-labelledby`
- `filament/widgets/auth/register.blade.php` (nome da `GetViewByClassAction`, parity `login.blade.php`)
- Rimosso `primaryColor()` da `XotBaseMainPanelProvider` (metodo assente Filament v5)
- `RegisterWidget`: view tema via `GetViewByClassAction`, `revealable()` password, notifiche + redirect sicuro
- Register allineato a login: `fo-filament-form-shell`, Filament button primary, link `italia-blue`
- CTA: solo `color="primary"` (no classe `auth-register-submit` per colore)
- **2026-06-04 UX pass:** password + conferma in colonna singola (`UserForm::getRegisterFormSchema` senza grid 2 col)
- **`user::user_form` IT:** label/placeholder/helper_text leggibili (WCAG 3.3.2)
- Submit full-width `min-h-11`; link login sotto CTA con `focus-visible:ring`
- Sidebar hint con `id` per `auth-register-hint-email` / `auth-register-hint-password`

## WCAG checklist

| Criterio | Stato |
|----------|--------|
| Un H1 | OK |
| Label Filament (LangServiceProvider) | OK |
| Touch target ≥44px submit | OK |
| Focus visible | OK (`outline` verde PA) |
| Errori annunciati (`aria-live="assertive"`) | OK |
| Contrasto CTA verde/bianco | OK (~4.5:1) |
| Skip link → `#main-container` | OK (layout app) |

## Verifica

```bash
cd laravel/Themes/Sixteen && npm run build
curl -sL http://127.0.0.1:8000/it/auth/register | grep -E 'auth-register|aria-live|fi-color-primary'
```

Registrazione test: email unica, password `TestPassword1!` (12+ char, maiusc, minus, num, simbolo).

## UX pass 2026-10-07

- mantenuti password e conferma in colonna singola anche su mobile;
- mantenuti error summary annunciato con `role="alert"` e `aria-live`;
- CTA a tutta larghezza con target minimo 44px e link di accesso sempre visibile;
- il form usa le traduzioni auto-configurate dal LangServiceProvider: non si
  aggiungono `->label()` nei widget Filament;
- la verifica email è demandata al modulo User e non introduce logica di dominio
  nel tema.

Il certificato locale HTTPS già attivo è il prerequisito per testare la pagina
dal browser in LAN; la consegna email resta separata dal rendering della pagina.

## Collegamenti

- [login-ux-fixes-2026-06-04.md](./login-ux-fixes-2026-06-04.md)
- [filament-pa-design-colors.md](../../../Modules/Xot/docs/wiki/concepts/filament-pa-design-colors.md)
