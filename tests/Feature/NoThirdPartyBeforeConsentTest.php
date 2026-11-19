<?php

declare(strict_types=1);

use Tests\TestCase;

uses(TestCase::class);

/*
 * Issue laraxot/theme_sixteen_fila5#106: prima di ogni scelta sui cookie il browser non contatta terzi.
 * - le mappe chiedono tile e geocoding al proxy del modulo Geo (attributi data-geo-* su <html>);
 * - nessun avatar Gravatar (config/local/fixcity/comments.php, gravatar.enabled = false).
 * La misura nel browser (Playwright, 13 pagine, 0 richieste a domini terzi) e' nella story dc-chrome-responsive-parity.
 */
it('declares the Geo proxy for map tiles and geocoding on every page', function (string $url): void {
    $html = (string) $this->get($url)->assertOk()->getContent();

    expect($html)->toMatch('#<html[^>]+data-geo-tile-url="[^"]*/api/geo/tiles/osm/\{z\}/\{x\}/\{y\}\.png"#')
        ->and($html)->toMatch('#<html[^>]+data-geo-nominatim-url="[^"]*/api/geo/nominatim"#')
        ->and($html)->not->toContain('tile.openstreetmap.org')
        ->and($html)->not->toContain('nominatim.openstreetmap.org')
        ->and($html)->not->toContain('gravatar.com');
})->with(['/it', '/it/tickets', '/it/blog', '/en/lista-categorie']);

it('keeps Gravatar off for the Fixcity tenant', function (): void {
    expect(config('comments.gravatar.enabled'))->toBeFalse();
});
