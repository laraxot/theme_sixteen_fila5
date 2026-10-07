<?php

declare(strict_types=1);

use function Safe\file_get_contents;

test('homepage uses the Sixteen public contract without legacy CMS test slugs', function (): void {
    $path = dirname(__DIR__, 2).'/resources/views/pages/index.blade.php';
    $html = file_get_contents($path);

    expect($html)
        ->toContain("name('home')")
        ->toContain('body-page="homepage"')
        ->toContain('<map-lit')
        ->toContain("localizeURL('/tickets/create')")
        ->toContain("localizeURL('/tickets')")
        ->toContain("localizeURL('/tickets/track')")
        ->not->toContain("'tests'")
        ->not->toContain('<style>');
});
