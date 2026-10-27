{{--
  Callers: CMS auth.login → <x-page> → questo blocco (Folio pages/auth/login).
  Guscio e resa: <x-auth.shell> + <x-auth.assets> (condivisi con registrazione e recupero password, DCP-290).
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

<x-auth.shell :heading="$loginHeading" :intro="$loginIntro" heading-id="auth-login-heading">
    <p class="auth-login-account">
        {{ __('fixcity::auth.login.no_account.text') }}
        <a href="{{ $localize('/auth/register') }}">{{ __('fixcity::auth.login.create_account.text') }}</a>
    </p>

    <div class="auth-login-widget">
        @livewire(\Modules\User\Filament\Widgets\Auth\LoginWidget::class)
    </div>

    @include('components.utilities.google-button')

    <p class="auth-login-links">
        <a href="{{ route('password.request') }}">{{ __('fixcity::auth.login.forgot_password.text') }}</a>
    </p>
    <p class="auth-login-links">
        <a href="{{ $localize('/accessibilita') }}">{{ __('pub_theme::accessibility.page.title.text') }}</a>
    </p>
</x-auth.shell>
