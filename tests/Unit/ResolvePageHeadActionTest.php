<?php

declare(strict_types=1);

use Tests\TestCase;
use Themes\Sixteen\Actions\Seo\ResolvePageHeadAction;
use Themes\Sixteen\Datas\PageHeadData;

uses(TestCase::class);

/**
 * DCP-288 (FO-6-17, FO-6-18, FO-6-15): titolo con il marchio, robots sulle pagine private, og:locale con la regione.
 */
function pageHead(?string $title, string $path = 'it/tickets', string $locale = 'it'): PageHeadData
{
    return app(ResolvePageHeadAction::class)->execute($title, 'FixCity', $path, $locale);
}

it('appends the site name to inner page titles', function (): void {
    expect(pageHead('Elenco segnalazioni')->title)->toBe('Elenco segnalazioni | FixCity');
});

it('does not repeat the site name when the title already carries it', function (string $title): void {
    expect(pageHead($title)->title)->toBe($title);
})->with([
    'in the middle' => ["FixCity \u{2014} Segnala un problema, segui la soluzione"],
    'at the end' => ['Accedi a FixCity'],
    'other case' => ['fixcity: elenco'],
]);

it('falls back to the site name when the page has no title', function (?string $title): void {
    expect(pageHead($title)->title)->toBe('FixCity');
})->with([null, '', '   ']);

it('asks search engines not to index private and service pages', function (string $path): void {
    expect(pageHead('x', $path)->robots)->toBe('noindex,follow');
})->with([
    'login' => ['it/auth/login'],
    'login in another language' => ['de/auth/login'],
    'personal area' => ['it/area-personale/pratiche'],
    'new report' => ['it/tickets/create'],
    'confirmation' => ['en/tickets/confirmation'],
    'tracking' => ['es/tickets/track'],
    'parity pages' => ['it/tests/home'],
    'upper case language' => ['IT/auth/login'],
]);

it('leaves public pages indexable', function (string $path): void {
    expect(pageHead('x', $path)->robots)->toBeNull();
})->with([
    'home' => ['it'],
    'list' => ['it/tickets'],
    'detail' => ['it/tickets/12'],
    'privacy' => ['it/privacy'],
    'a slug that only starts like a private one' => ['it/authors'],
    'a ticket slug' => ['it/tickets/created'],
]);

it('gives og:locale the regional code', function (string $locale, string $expected): void {
    expect(pageHead('x', $locale, $locale)->ogLocale)->toBe($expected);
})->with([
    ['it', 'it_IT'],
    ['en', 'en_GB'],
    ['de', 'de_DE'],
    ['es', 'es_ES'],
]);
