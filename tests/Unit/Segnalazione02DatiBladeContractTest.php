<?php

declare(strict_types=1);

<<<<<<< .merge_file_NDPGqX
/**
 * Contratto markup story 7-3: niente handler JS assente; navigazione come link.
 */
test('il blade segnalazione-02-dati espone stepper nav e non usa confirmAndProceed', function (): void {
    $bladePath = dirname(__DIR__, 4).'/Themes/Sixteen/resources/views/components/blocks/tests/segnalazione-02-dati.blade.php';
    expect(file_exists($bladePath))->toBeTrue('Blade tema mancante: '.$bladePath);

    $html = (string) file_get_contents($bladePath);
    expect($html)->toContain('steppers-btn-confirm');
    expect($html)->toContain('steppers-btn-prev');
    expect($html)->toContain('fixcity::segnalazione.actions.next.label');
    expect($html)->toContain('fixcity::segnalazione.breadcrumb.home.label');
    expect($html)->not->toContain('fixcity::common.');
    expect($html)->not->toContain('confirmAndProceed()');
});
=======
use PHPUnit\Framework\Assert;
use Tests\TestCase;

use function Safe\file_get_contents;

uses(TestCase::class);
>>>>>>> .merge_file_3ziUCc

/**
 * @return array{view: string, layout: string, nav: array{next: string, ...}, steps: array{index: string, ...}, ...}
 */
<<<<<<< .merge_file_NDPGqX
test('il blade segnalazione-02-dati ha steppers-header e steppers-index per la responsive', function (): void {
    $bladePath = dirname(__DIR__, 4).'/Themes/Sixteen/resources/views/components/blocks/tests/segnalazione-02-dati.blade.php';
    $html = (string) file_get_contents($bladePath);

    // Elementi strutturali del stepper necessari per il CSS responsive
    expect($html)->toContain('steppers-header');
    expect($html)->toContain('steppers-index');
    // Il blade usa classi dinamiche Blade (non literal 'class="active"')
    expect($html)->toContain("'active'");
    expect($html)->toContain("'confirmed'");
});
=======
function segnalazioneDatiPayload(): array
{
    $path = dirname(__DIR__, 4).'/Modules/Fixcity/config/database/content/pages/tests.segnalazione-02-dati.json';
    $page = json_decode(file_get_contents($path), true, 512, JSON_THROW_ON_ERROR);
>>>>>>> .merge_file_3ziUCc

    Assert::assertIsArray($page);
    Assert::assertIsArray($page['content_blocks']);
    Assert::assertIsArray($page['content_blocks']['it']);
    Assert::assertIsArray($page['content_blocks']['it'][0]);
    Assert::assertIsArray($page['content_blocks']['it'][0]['data']);

<<<<<<< .merge_file_NDPGqX
    $css = (string) file_get_contents($cssPath);
=======
    $data = $page['content_blocks']['it'][0]['data'];
    Assert::assertIsString($data['view']);
    Assert::assertIsString($data['layout']);
    Assert::assertIsArray($data['nav']);
    Assert::assertIsString($data['nav']['next']);
    Assert::assertIsArray($data['steps']);
    Assert::assertIsString($data['steps']['index']);
>>>>>>> .merge_file_3ziUCc

    return $data;
}

test('the data step uses the shared CMS block instead of a page-specific Blade', function (): void {
    $data = segnalazioneDatiPayload();
    expect($data['view'])->toBe('pub_theme::components.blocks.report-step.design-comuni');
    expect($data['layout'])->toBe('sidebar');
    Assert::assertIsArray($data['nav']);
    Assert::assertIsString($data['nav']['next']);
    $this->view('pub_theme::components.blocks.report-step.design-comuni', ['data' => $data])
        ->assertSee('steppers-btn-confirm', false)
        ->assertSee('steppers-btn-prev', false)
        ->assertSee($data['nav']['next'])
        ->assertDontSee('confirmAndProceed()', false);
});

test('the data step exposes responsive step states from its CMS payload', function (): void {
    $data = segnalazioneDatiPayload();
    Assert::assertIsArray($data['steps']);
    Assert::assertIsString($data['steps']['index']);
    $this->view('pub_theme::components.blocks.report-step.design-comuni', ['data' => $data])
        ->assertSee('steppers-header', false)
        ->assertSee('steppers-index', false)
        ->assertSee($data['steps']['index'])
        ->assertSee('class="active"', false)
        ->assertSee('class="confirmed"', false);
});

test('the compiled CSS retains responsive step visibility without relying on source comments', function (): void {
    $root = dirname(__DIR__, 2);
    $manifest = json_decode(file_get_contents($root.'/public/manifest.json'), true, 512, JSON_THROW_ON_ERROR);
    Assert::assertIsArray($manifest);
    Assert::assertIsArray($manifest['resources/css/app.css']);
    Assert::assertIsString($manifest['resources/css/app.css']['file']);
    $css = file_get_contents($root.'/public/'.$manifest['resources/css/app.css']['file']);
    expect($css)->toContain('.steppers-header ul li:not(.active)')
        ->toContain('.steppers-index')
        ->toContain('@media');
});
