{{--
  Callers: CMS auth.login → <x-page> → questo blocco (Folio pages/auth/login).
  Vestito: stessa colonna civica della registrazione, classi .auth-login-*.
  Lo stile sta nel componente: lo sheet compilato non dipinge dentro data-dc.
  Niente selettori di pagina.
  Widget User LoginWidget = dominio (credenziali). Nessun controller.
--}}
@php
    $loginHeading = is_string($heading ?? null) && trim($heading) !== ''
        ? trim($heading)
        : __('fixcity::auth.login.title.text');
    $loginIntro = is_string($intro ?? null) && trim($intro) !== ''
        ? trim($intro)
        : __('fixcity::auth.login.intro.text');
    $localize = static fn (string $path): string => \Themes\Sixteen\Infrastructure\Url\FrontofficeUrl::fromStoredUrl($path);
@endphp

<style>
    .auth-login-shell { background: #f5f7f9; padding: 1.5rem 1rem 7rem; }
    .auth-login-shell__inner { width: 100%; max-width: 36rem; margin-left: auto; margin-right: auto; }
    .auth-login-shell__crumb { display: flex; flex-wrap: wrap; align-items: center; gap: 0.35rem; margin: 0 0 1rem; padding: 0; list-style: none; font-size: 0.875rem; color: #5c6f82; }
    .auth-login-shell__crumb a,
    .auth-login-card .auth-login-account a,
    .auth-login-card .auth-login-links a { color: #007a52; font-weight: 600; text-decoration: underline; text-underline-offset: 3px; }
    .auth-login-card { background: #fff; border: 1px solid #d9e1e8; border-radius: 0.25rem; padding: 1.5rem 1.25rem 2rem; }
    .auth-login-card h1 { margin: 0; font-size: clamp(1.75rem, 4vw, 2.25rem); line-height: 1.15; font-weight: 700; color: #1a1a1a; }
    .auth-login-card .auth-login-lede { margin: 0.5rem 0 0; color: #5c6f82; font-size: 1.0625rem; line-height: 1.55; }
    .auth-login-card .auth-login-account,
    .auth-login-card .auth-login-links { margin: 0.75rem 0 0; font-size: 0.9375rem; color: #1a1a1a; }
    .auth-login-card .auth-login-widget { margin-top: 1.75rem; }
    /* Esito negativo del login, stampato dal widget (filament/widgets/auth/login.blade.php): password errata oppure
       Google annullato/rifiutato (RedirectToLoginAction lo mette nel gruppo errori `email`). Colore #a50021 su #fdf2f4: 7,2:1. */
    .auth-login-card .auth-login-alert { display: flex; align-items: flex-start; gap: 0.75rem; margin: 0 0 1.25rem; padding: 0.75rem 1rem; border: 1px solid #d9364f; border-left-width: 4px; background: #fdf2f4; color: #a50021; font-size: 0.9375rem; line-height: 1.5; }
    .auth-login-card .auth-login-alert__icon { flex: 0 0 auto; width: 1.25rem; height: 1.25rem; margin-top: 0.125rem; }
    .auth-login-card .auth-login-alert__text { margin: 0 !important; min-width: 0; }
    .auth-login-card .auth-login-google { margin-top: 1rem; }
    .auth-login-card form input[type="email"],
    .auth-login-card form input[type="password"],
    .auth-login-card form input[type="text"] { display: block; width: 100%; box-sizing: border-box; min-height: 2.75rem; margin-top: 0.35rem; border: 1px solid #c5d0db; border-radius: 0; background: #fff; color: #1a1a1a; }
    /* Password rivelabile di Filament: l'occhio è la suffix action, non un bottone nostro.
       Lo sheet compilato non dipinge .fi-input-wrp dentro data-dc, quindi il flex e la misura dell'icona stanno qui. */
    .auth-login-card .fi-input-wrp:has(input.fi-revealable) { display: flex; align-items: stretch; margin-top: 0.35rem; border: 1px solid #c5d0db; background: #fff; min-height: 2.75rem; }
    .auth-login-card .fi-input-wrp:has(input.fi-revealable) .fi-input-wrp-content-ctn { flex: 1 1 auto; min-width: 0; }
    .auth-login-card .fi-input-wrp:has(input.fi-revealable) input { margin-top: 0; border: 0; min-height: 2.75rem; }
    .auth-login-card .fi-input-wrp-suffix,
    .auth-login-card .fi-input-wrp-actions { display: flex; align-items: center; flex: 0 0 auto; }
    .auth-login-card .fi-input-wrp-actions .fi-ac-btn-action { display: inline-flex; align-items: center; justify-content: center; width: 2.75rem; height: 2.75rem; padding: 0; border: 0; background: transparent; color: #1a1a1a; font-size: 0; line-height: 0; cursor: pointer; }
    .auth-login-card .fi-input-wrp-actions svg { width: 1.25rem; height: 1.25rem; flex: 0 0 auto; }
    /* Checkbox Filament (`Checkbox::make('remember')`).
       DC: `body:has(.page-content[data-dc]) input { appearance: none !important }` — senza
       `!important` qui il controllo resta 20×20 ma trasparente. Non ridisegnare: nativo + accent. */
    .auth-login-card .fi-fo-field-label:has(.fi-checkbox-input),
    .auth-login-card form label:has(> input[type="checkbox"]) {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-top: 0.75rem;
        cursor: pointer;
    }
    .auth-login-card form input[type="checkbox"],
    .auth-login-card input.fi-checkbox-input {
        appearance: auto !important;
        -webkit-appearance: checkbox !important;
        flex: 0 0 auto;
        width: 1.25rem;
        height: 1.25rem;
        margin: 0;
        accent-color: #007a52;
        cursor: pointer;
    }
    .auth-login-card form button[type="submit"] { display: flex; align-items: center; justify-content: center; width: 100%; min-height: 2.75rem; margin-top: 1.25rem; border: 0; border-radius: 0; background: #007a52; color: #fff; font-weight: 600; cursor: pointer; }
    .auth-login-card .google-login-wrapper a { display: flex !important; align-items: center; justify-content: center; gap: 0.5rem; width: 100%; height: 2.75rem; min-height: 2.75rem; padding: 0 1rem; box-sizing: border-box; border: 1px solid #c5d0db; border-radius: 0; background: #fff; color: #1a1a1a; text-decoration: none; }
    .auth-login-card .google-login-wrapper svg { width: 1.25rem; height: 1.25rem; flex: 0 0 auto; }
    .auth-login-card [wire\:loading] { display: none; }
    @media (min-width: 640px) {
        .auth-login-shell { padding-left: 1.5rem; padding-right: 1.5rem; }
        .auth-login-card { padding: 2rem 2rem 2.25rem; }
    }
</style>

<section class="auth-login-shell" aria-labelledby="auth-login-heading">
    <div class="auth-login-shell__inner">
        <nav aria-label="{{ __('fixcity::global.breadcrumb') }}">
            <ol class="auth-login-shell__crumb">
                <li><a href="{{ $localize('/') }}">{{ __('pub_theme::navigation.home') }}</a></li>
                <li aria-hidden="true">/</li>
                <li aria-current="page">{{ $loginHeading }}</li>
            </ol>
        </nav>

        <div class="auth-login-card">
            <h1 id="auth-login-heading">{{ $loginHeading }}</h1>
            <p class="auth-login-lede">{{ $loginIntro }}</p>
            <p class="auth-login-account">
                {{ __('fixcity::auth.login.no_account.text') }}
                <a href="{{ $localize('/auth/register') }}">{{ __('fixcity::auth.login.create_account.text') }}</a>
            </p>

            <div class="auth-login-widget">
                @livewire(\Modules\User\Filament\Widgets\Auth\LoginWidget::class)
            </div>

            <div class="auth-login-google">
                @include('components.utilities.google-button')
            </div>

            <p class="auth-login-links">
                <a href="{{ route('password.request') }}">{{ __('fixcity::auth.login.forgot_password.text') }}</a>
            </p>
            <p class="auth-login-links">
                <a href="{{ $localize('/accessibilita') }}">{{ __('pub_theme::accessibility.page.title.text') }}</a>
            </p>
        </div>
    </div>
</section>
