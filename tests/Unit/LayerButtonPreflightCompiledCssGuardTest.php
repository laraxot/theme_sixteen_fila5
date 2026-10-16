<?php

declare(strict_types=1);

use PHPUnit\Framework\Assert;

use function Safe\file_get_contents;
use function Safe\glob;

/*
 * DCP-195: il reset button/submit trasparente deve restare in @layer base nel CSS compilato,
 * altrimenti le utility Tailwind sui pulsanti FO tornano invisibili.
 */
$themeRoot = dirname(__DIR__, 2);
$manifestPath = $themeRoot.'/public/manifest.json';

it('wraps unlayered button submit transparent reset in @layer base in compiled app css', function () use ($themeRoot, $manifestPath): void {
    Assert::assertFileExists($manifestPath, 'manifest.json mancante: eseguire npm run build nel tema Sixteen.');
    /** @var array<string, array{file?: string, css?: list<string>}> $manifest */
    $manifest = json_decode(file_get_contents($manifestPath), true, 512, JSON_THROW_ON_ERROR);
    $entry = $manifest['resources/css/app.css']['file'] ?? null;
    Assert::assertIsString($entry, 'Voce resources/css/app.css assente nel manifest Vite.');

    $cssPath = $themeRoot.'/public/'.$entry;
    Assert::assertFileExists($cssPath, 'CSS del manifest non trovato: '.$cssPath);
    $css = file_get_contents($cssPath);

    Assert::assertTrue(
        str_contains($css, '@layer base{button')
        && preg_match('/@layer base\{button[\s\S]{0,800}background-color:#0000/', $css) === 1,
        'Manca il reset button in @layer base nel bundle '.$entry,
    );
});
