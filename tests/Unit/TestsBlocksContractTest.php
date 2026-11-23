<?php

declare(strict_types=1);

use Symfony\Component\Finder\Finder;

use function Safe\file_get_contents;

/**
 * I blocchi sotto `components/blocks/tests` sono adapter di compatibilità per
 * payload CMS legacy: il markup riusabile appartiene al blocco canonico.
 *
 * @see laravel/Themes/Sixteen/docs/design-comuni/TICKET-CREATION-WIZARD.md
 */
test('issue 77: i blocchi tests delegano a viste canoniche senza logica di pagina', function (): void {
    $blocksRoot = dirname(__DIR__, 2).'/resources/views/components/blocks/tests';
    $files = iterator_to_array(
        (new Finder)->files()->name('*.blade.php')->in($blocksRoot),
        false,
    );

    expect($files)->not->toBeEmpty();

    $delegatePattern = <<<'REGEX'
/@include\('pub_theme::components\.blocks\.[^']+', \['data' => \$data\]\)/
REGEX;

    foreach ($files as $file) {
        $html = file_get_contents($file->getPathname());

        expect($html)
            ->toContain("@props(['data' => []])")
            ->toMatch($delegatePattern)
            ->not->toMatch('/@php\\b/')
            ->not->toMatch('/<\\?php/')
            ->not->toMatch('/\\b(?:app|route|redirect|abort|auth)\\s*\\(/')
            ->not->toMatch('/Modules\\\\(?:Cms|Fixcity|Blog)\\\\Models\\\\/')
            ->not->toMatch('/(?:Action|Service)::class/');
    }
});
