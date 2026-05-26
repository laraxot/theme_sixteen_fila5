<?php

declare(strict_types=1);

/**
 * Rule 018: wizard steps non hanno blade CMS dedicate — solo segnalazione-crea + redirect legacy.
 */
test('le blade step wizard blocks/tests non devono esistere', function (): void {
    $themeBlocks = dirname(__DIR__, 2).'/resources/views/components/blocks/tests';
    $forbidden = [
        'segnalazione-01-privacy.blade.php',
        'segnalazione-02-dati.blade.php',
        'segnalazione-03-riepilogo.blade.php',
    ];

    foreach ($forbidden as $file) {
        expect(file_exists($themeBlocks.'/'.$file))
            ->toBeFalse('Blade vietata (rule 018): blocks/tests/'.$file);
    }

    expect(file_exists($themeBlocks.'/segnalazione-crea.blade.php'))->toBeTrue();
});

test('folio tests slug delega render blocchi a x-page senza fetch duplicato', function (): void {
    $folioPath = dirname(__DIR__, 2).'/resources/views/pages/tests/[slug].blade.php';
    $html = (string) file_get_contents($folioPath);

    expect($html)->not->toContain('LEGACY_WIZARD_STEP_SLUGS');
    expect($html)->not->toContain('LaravelLocalization');
    expect($html)->not->toContain('$this->redirect(');
    expect($html)->not->toContain('Page::getBlocksBySlug');
    expect($html)->not->toContain(':blocks=');
    expect($html)->not->toContain('$blocks');
    expect($html)->toContain('<x-page side="content" :slug="$pageSlug" :data="$data" />');
});

test('segnalazione-parity.css §27.18 scope stepper su segnalazione-crea', function (): void {
    $cssPath = dirname(__DIR__, 2).'/resources/css/segnalazione-parity.css';
    $css = (string) file_get_contents($cssPath);

    expect($css)->toContain('27.18 Stepper — responsive tablet/mobile');
    expect($css)->toContain('.page-content[data-slug="tests.segnalazione-crea"] .steppers-index');
    expect($css)->not->toContain('27.18 Stepper — scroll orizzontale');
});
