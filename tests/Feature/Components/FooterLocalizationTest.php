<?php

declare(strict_types=1);

use Tests\TestCase;

uses(TestCase::class);

it('renders localized footer copy and working frontoffice destinations', function (string $locale, string $createLabel, string $trackLabel): void {
    app()->setLocale($locale);

    $html = view('pub_theme::components.sections.footer.full')->render();

    expect($html)
        ->toContain($createLabel)
        ->toContain($trackLabel)
        ->toContain('/'.$locale.'"')
        ->toContain('/'.$locale.'/tickets/create')
        ->toContain('/'.$locale.'/tickets/track')
        ->not->toContain('href="#"')
        ->not->toContain('Nome del Comune')
        ->not->toContain('Via Roma 123');
})->with([
    'Italian' => ['it', 'Invia una segnalazione', 'Segui una segnalazione'],
    'English' => ['en', 'Submit a report', 'Track a report'],
]);
