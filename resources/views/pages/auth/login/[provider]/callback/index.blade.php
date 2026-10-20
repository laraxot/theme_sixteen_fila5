<?php

declare(strict_types=1);

/**
 * Folio fallback per /{lang}/auth/login/{provider}/callback.
 * SSoT del flusso: ProcessCallbackController (Modules/User/routes/socialite.php).
 * Non reclamare name('oauth.callback'): la route named appartiene a socialite.php.
 *
 * Bug storico: request()->segment(3) con URL /it/auth/login/google/callback
 * leggeva "login" e abort(404). Il parametro Folio $provider e' la fonte corretta.
 */

use Modules\User\Http\Controllers\Socialite\ProcessCallbackController;

/** @var string $provider */
$provider = is_string($provider ?? null) ? $provider : '';

if (! in_array($provider, ['google', 'microsoft', 'github'], true)) {
    abort(404, __('user::auth.login.invalid_provider'));
}

return app(ProcessCallbackController::class)(request(), $provider);
