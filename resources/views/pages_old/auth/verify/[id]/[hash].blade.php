<?php

declare(strict_types=1);

use Illuminate\Auth\Events\Verified;
use Illuminate\Http\RedirectResponse;
use function Laravel\Folio\middleware;
use function Laravel\Folio\name;
use function Laravel\Folio\render;

// Link della mail di verifica (VerifyEmail genera route('verification.verify', ['id' => ..., 'hash' => ...])).
// Il modulo User non carica le sue route (Folio + Volt), quindi la route nominata vive qui.
middleware(['auth', 'signed', 'throttle:6,1']);
name('verification.verify');

render(function (string $id, string $hash): RedirectResponse {
    $user = auth()->user();

    abort_unless(
        $user !== null
            && hash_equals($id, (string) $user->getKey())
            && hash_equals($hash, sha1($user->getEmailForVerification())),
        403,
    );

    if (! $user->hasVerifiedEmail() && $user->markEmailAsVerified()) {
        event(new Verified($user));
    }

    return redirect('/'.app()->getLocale().'/tickets')->with('status', __('user::login.email_verified'));
});
