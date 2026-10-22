{{--
  Callers: CMS auth.register → <x-page> → questo blocco (Folio pages/auth/register).
  Vestito FO: card centrata, JSON/CMS per heading/intro.
  Widget Gdpr RegisterWidget = dominio (consensi + create user). Nessun controller.

  Perché stili inline: sotto `.page-content[data-dc]` le utility Tailwind del tema
  e 14-auth-login.css sono isolate — senza questo la card va a full-bleed.
  Breadcrumb: nessun `<span class="separator">` dentro il li (il CSS DC ne aggiunge
  un altro via ::before → doppia slash «Home / /»).
--}}
@props(['data' => []])

@php
    $heading = trim((string) ($data['heading'] ?? '')) ?: __('fixcity::auth.register.title.text');
    $intro = trim((string) ($data['intro'] ?? '')) ?: __('fixcity::auth.register.intro.text');
    $localize = static fn (string $path): string => \Mcamara\LaravelLocalization\Facades\LaravelLocalization::localizeURL($path);
@endphp

<style>
    .auth-register-shell {
        background: #f5f7f9;
        padding: 1.5rem 1rem 7rem;
    }
    .auth-register-shell__inner {
        width: 100%;
        max-width: 36rem;
        margin-left: auto;
        margin-right: auto;
    }
    .auth-register-shell__crumb {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 0.35rem;
        margin: 0 0 1rem;
        padding: 0;
        list-style: none;
        font-size: 0.875rem;
        color: #5c6f82;
    }
    .auth-register-shell__crumb a {
        color: #007a52;
        font-weight: 600;
        text-decoration: underline;
        text-underline-offset: 2px;
    }
    .auth-register-shell__crumb a:focus-visible {
        outline: 2px solid #007a52;
        outline-offset: 2px;
    }
    .auth-register-shell__crumb [aria-current="page"] {
        color: #1a1a1a;
        font-weight: 600;
    }
    .auth-register-card {
        background: #fff;
        border: 1px solid #d9e1e8;
        border-radius: 0.25rem;
        padding: 1.5rem 1.25rem 2rem;
    }
    .auth-register-card h1 {
        margin: 0;
        font-size: clamp(1.75rem, 4vw, 2.25rem);
        line-height: 1.15;
        font-weight: 700;
        color: #1a1a1a;
    }
    .auth-register-card .auth-register-lede {
        margin: 0.5rem 0 0;
        color: #5c6f82;
        font-size: 1.0625rem;
        line-height: 1.55;
    }
    .auth-register-card .auth-register-account {
        margin: 0.75rem 0 0;
        font-size: 0.9375rem;
        color: #1a1a1a;
    }
    .auth-register-card .auth-register-account a,
    .auth-register-card .auth-register-links a {
        color: #007a52;
        font-weight: 600;
        text-decoration: underline;
        text-underline-offset: 3px;
    }
    .auth-register-card .auth-register-account a:focus-visible,
    .auth-register-card .auth-register-links a:focus-visible {
        outline: 2px solid #007a52;
        outline-offset: 2px;
    }
    .auth-register-card .auth-register-widget {
        margin-top: 1.75rem;
    }
    .auth-register-card .auth-register-google {
        margin-top: 1.25rem;
    }
    .auth-register-card .auth-register-links {
        margin: 0.75rem 0 0;
        font-size: 0.9375rem;
    }
    @media (min-width: 640px) {
        .auth-register-shell {
            padding-left: 1.5rem;
            padding-right: 1.5rem;
        }
        .auth-register-card {
            padding: 2rem 2rem 2.25rem;
        }
    }
</style>

<section class="auth-register-shell" aria-labelledby="auth-register-heading">
    <div class="auth-register-shell__inner">
        <nav aria-label="{{ __('fixcity::global.breadcrumb') }}">
            <ol class="auth-register-shell__crumb">
                <li>
                    <a href="{{ $localize('/') }}">{{ __('pub_theme::navigation.home') }}</a>
                </li>
                <li aria-hidden="true">/</li>
                <li aria-current="page">{{ $heading }}</li>
            </ol>
        </nav>

        <div class="auth-register-card">
            <h1 id="auth-register-heading">{{ $heading }}</h1>
            <p class="auth-register-lede">{{ $intro }}</p>
            <p class="auth-register-account">
                {{ __('user::registration.already_registered') }}
                <a href="{{ $localize('/auth/login') }}">{{ __('user::login.actions.login.label') }}</a>
            </p>

            <div class="auth-register-widget">
                @livewire(\Modules\Gdpr\Filament\Widgets\Auth\RegisterWidget::class)
            </div>

            <div class="auth-register-google">
                @include('components.utilities.google-button')
            </div>

            <p class="auth-register-links">
                <a href="{{ route('password.request') }}">{{ __('user::auth.login.forgot_password.text') }}</a>
            </p>
            <p class="auth-register-links">
                <a href="{{ $localize('/accessibilita') }}">{{ __('pub_theme::accessibility.page.title.text') }}</a>
            </p>
        </div>
    </div>
</section>
