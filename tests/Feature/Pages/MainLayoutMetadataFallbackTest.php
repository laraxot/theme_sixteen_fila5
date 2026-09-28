<?php

declare(strict_types=1);

use Tests\TestCase;

use function Pest\Laravel\get;

uses(TestCase::class);

it('renders Folio pages with safe metadata when no title props are supplied', function (string $path): void {
    get($path)
        ->assertOk()
        ->assertSee('<title>', false)
        ->assertDontSee('Undefined variable $title');
})->with([
    'English password reset' => ['/en/auth/password/reset'],
    'Administration CMS page' => ['/it/administration'],
    'News CMS page' => ['/it/news'],
    'Services CMS page' => ['/it/services'],
]);
