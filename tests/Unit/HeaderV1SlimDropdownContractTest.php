<?php

declare(strict_types=1);

/**
 * Contratto Story 7-54: slim header section — dropdown lingua/utente via data-bs-toggle + app.js (no Alpine inline).
 */
test('header v1 slim usa data-bs-toggle per lingua e utente e non langOpen/userOpen Alpine', function (): void {
    $bladePath = dirname(__DIR__, 4).'/Themes/Sixteen/resources/views/components/sections/header/v1.blade.php';
    expect(file_exists($bladePath))->toBeTrue('Blade header v1 mancante: '.$bladePath);

    $html = (string) file_get_contents($bladePath);

    expect($html)->toContain('id="header-language-toggle"');
    expect($html)->toContain('data-bs-toggle="dropdown"');
    expect($html)->toContain('id="header-user-toggle"');
    expect($html)->not->toContain('langOpen');
    expect($html)->not->toContain('userOpen');
    expect($html)->not->toContain('x-data="{ langOpen');
    expect($html)->not->toContain('x-data="{ userOpen');
});

test('header v1 slim wrapper non forza background hex inline (token CSS)', function (): void {
    $bladePath = dirname(__DIR__, 4).'/Themes/Sixteen/resources/views/components/sections/header/v1.blade.php';
    $html = (string) file_get_contents($bladePath);

    expect($html)->not->toContain('style="background-color: #0066CC"');
    expect($html)->not->toContain("style='background-color: #0066CC'");
});
