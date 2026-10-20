<?php

declare(strict_types=1);

/**
 * Legacy Folio path /auth/{provider}/redirect — delege a oauth.redirect.
 * Non reclamare name('oauth.redirect'): SSoT e' Modules/User/routes/socialite.php.
 */

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Modules\User\Http\Controllers\Socialite\RedirectToProviderController;

/** @var string $provider */
$provider = is_string($provider ?? null) ? $provider : 'google';

if (! in_array($provider, ['google', 'microsoft', 'github'], true)) {
    abort(404, __('user::auth.login.invalid_provider'));
}

$locale = trim((string) app()->getLocale(), '/');
$supported = LaravelLocalization::getSupportedLanguagesKeys();
if (! in_array($locale, $supported, true)) {
    $locale = (string) config('app.locale', 'it');
}

if (Route::has('oauth.redirect')) {
    return redirect()->to(route('oauth.redirect', ['provider' => $provider, 'lang' => $locale]));
}

return app(RedirectToProviderController::class)(request(), $provider);
