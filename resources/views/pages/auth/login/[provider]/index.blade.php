<?php

declare(strict_types=1);

/**
 * Folio fallback per /{lang}/auth/login/{provider}.
 * SSoT: RedirectToProviderController via route oauth.redirect (socialite.php).
 * Non reclamare name('oauth.redirect'): evita collisioni con la route named del modulo.
 */

use Modules\User\Http\Controllers\Socialite\RedirectToProviderController;

/** @var string $provider */
$provider = is_string($provider ?? null) ? $provider : '';

if (! in_array($provider, ['google', 'microsoft', 'github'], true)) {
    abort(404, __('user::auth.login.invalid_provider'));
}

return app(RedirectToProviderController::class)(request(), $provider);
