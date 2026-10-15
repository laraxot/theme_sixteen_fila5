<?php

declare(strict_types=1);

use Dom\HTMLDocument;
use Tests\TestCase;

uses(TestCase::class);

/**
 * axe `link-name` (serious, 375 px) sulla home reale, 2026-10-13: il CTA di accesso del header mostra la parola "Accedi" solo da
 * 992 px in su (`d-none d-lg-block`); sotto resta un'icona `aria-hidden` e il link non ha nome accessibile. Il nome deve esserci
 * a ogni larghezza, quindi non puo' dipendere dallo span responsive.
 */
it('gives the guest login call to action an accessible name at every width', function (string $partial): void {
    $html = view('pub_theme::components.sections.header.partials.'.$partial)->render();
    $link = HTMLDocument::createFromString('<body>'.$html.'</body>', LIBXML_NOERROR)->querySelector('a[data-element="personal-area-login"]');

    expect($link)->not->toBeNull();
    $name = trim((string) $link?->getAttribute('aria-label'));
    expect($name)->not->toBe('')->and($name)->not->toContain('pub_theme::');
})->with(['personal-area-guest-cta', 'personal-area-login-cta']);
