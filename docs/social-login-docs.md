# Social Login — Folio + Volt + Filament Blueprint

## Architettura (Zero Controller, Zero web.php)

| Azione | Route Folio | Blade (Volt) | Route Name |
|--------|-------------|--------------|------------|
| Redirect provider | `/auth/login/{provider}` | `pages/auth/[provider]/index.blade.php` | `oauth.redirect` |
| Callback provider | `/it/auth/login/{provider}/callback` | `pages/auth/[provider]/callback/index.blade.php` | `oauth.callback` |

## Componenti

### 1. Login Page (`/it/auth/login`)
- **File**: `Themes/Sixteen/resources/views/pages/auth/login.blade.php`
- **Layout**: `@extends('layouts.app')` + `@section('content')`
- **Asset**: `@vite(['resources/css/app.css', 'resources/js/app.js'], 'themes/Sixteen')`
- **Widget**: `@livewire(\Modules\User\Filament\Widgets\Auth\SocialLoginWidget::class, ['redirectRoute' => 'oauth.redirect'])`
- **Google Button**: `@include('components.utilities.google-button')`

### 2. Redirect Page (`/auth/login/{provider}`)
- **File**: `Themes/Sixteen/resources/views/pages/auth/[provider]/index.blade.php`
- **Mechanism**: Volt component `mount(string $provider)` → `Socialite::driver($provider)->redirect()`
- **Design**: Design Comuni gradient card, Filament icon `heroicon-o-arrow-path`, spinner animato

### 3. Callback Page (`/it/auth/login/{provider}/callback`)
- **File**: `Themes/Sixteen/resources/views/pages/auth/[provider]/callback/index.blade.php`
- **Handles**: success/error session flash, back-to-login link

## Traduzioni (Convenzione 5 elementi — BMAD + Second Brain)

Ogni chiave deve seguire il formato: `<namespace>::<contesto>.<collezione>.<chiave>.<tipo>`

**Esempi corretti:**
- `user::auth.login.title.text`
- `user::auth.login.subtitle.text`
- `user::auth.login.intro.text`
- `user::auth.login.google.button.text`
- `user::auth.login.email.placeholder`
- `user::auth.login.password.text` (precedentemente `user::auth.password` — FIXED)
- `user::auth.login.create_account.text`
- `user::auth.login.forgot_password.text`

**Esempi errati corretti:**
- `fixcity::auth.intro` → `fixcity::auth.login.intro.text`
- `user::auth.password` → `user::auth.login.password.text`
- `pub_theme::accessibility.title` → `pub_theme::accessibility.page.title.text`

**Regola Second Brain:** nessuna chiave con meno di 5 elementi (`namespace`, `contesto`, `collezione`, `chiave`, `tipo`).

## .env Configuration

```env
GOOGLE_CLIENT_ID=google-client-id.apps.googleusercontent.com
GOOGLE_CLIENT_SECRET=google-client-secret
GOOGLE_REDIRECT_URI=https://fixcity.eu/it/auth/login/google/callback
```

## Design Comuni Compliance

- **Colori**: Primary `#007A52` (token design-comuni)
- **Card**: `rounded-3xl shadow-xl border border-slate-200`
- **Gradient Header**: `from-blue-700 to-blue-900`
- **Accessibilità**: skiplink in `layouts.app`, semantic `<main role="main">`, `aria-label` sui pulsanti

## BMAD + Second Brain

- **Benchmark**: Identificato errore `folio.layouts.default` + route naming inconsistency
- **Analisi**: Route file non caricato, naming `socialite.oauth.*` vs `oauth.*`, traduzioni non conformi
- **Design**: Folio dynamic routes + Volt mount() + Filament widget = zero controller
- **Execute**: Route `oauth.redirect` unificata, traduzioni 5 elementi, asset Vite corretti, docs aggiornate

## Prevenzione Errori Futuri

1. **Mai** usare controller per OAuth redirect/callback
2. **Sempre** verificare `route('oauth.redirect')` esiste prima di usare in Blade
3. **Sempre** usare convenzione traduzioni 5 elementi: `namespace::contesto.collezione.chiave.tipo`
4. **Sempre** `@extends('layouts.app')` per pagine Folio (non standalone)
5. **Sempre** `@vite` con terzo argomento `'themes/Sixteen'` per asset del tema

## File Chiave

```
Themes/Sixteen/resources/views/pages/auth/login.blade.php
Themes/Sixteen/resources/views/pages/auth/[provider]/index.blade.php
Themes/Sixteen/resources/views/components/utilities/google-button.blade.php
Modules/User/routes/socialite.php
Modules/User/app/Filament/Widgets/Auth/SocialLoginWidget.php
Modules/User/lang/it/auth.php
```
