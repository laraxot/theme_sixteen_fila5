<?php

declare(strict_types=1);

/**
 * Tema Sixteen: pages/ = solo auth, [container0], tests (+ index.blade.php home).
 *
 * @see laravel/Themes/Sixteen/docs/page-directory-structure.md
 */
test('sixteen pages contiene solo directory allowlist', function (): void {
    $pagesRoot = dirname(__DIR__, 2).'/resources/views/pages';

    $allowed = ['auth', '[container0]', 'tests'];

    foreach (scandir($pagesRoot) ?: [] as $entry) {
        if ($entry === '.' || $entry === '..') {
            continue;
        }
        $path = $pagesRoot.'/'.$entry;
        if (! is_dir($path)) {
            continue;
        }
        expect(in_array($entry, $allowed, true))->toBeTrue("Unexpected Folio dir: pages/{$entry}");
    }

    foreach ($allowed as $dir) {
        expect(is_dir($pagesRoot.'/'.$dir))->toBeTrue("Missing required Folio dir: pages/{$dir}");
    }
});

test('sixteen pages non contiene directory semantiche vietate', function (): void {
    $pagesRoot = dirname(__DIR__, 2).'/resources/views/pages';

    $forbidden = [
        'administration', 'ambiente', 'area-personale', 'article', 'articles', 'categories', 'cultura',
        'dashboard', 'eventi', 'famiglia', 'genesis', 'lavoro', 'learn', 'mobilita',
        'news', 'pages', 'personal-area', 'profile', 'salute', 'segnalazioni', 'services', 'sport',
        'tickets', 'turismo',
    ];

    foreach ($forbidden as $dir) {
        expect(is_dir($pagesRoot.'/'.$dir))->toBeFalse("Forbidden Folio dir: pages/{$dir}");
    }
});

test('tests non ha sottocartelle dominio', function (): void {
    $testsRoot = dirname(__DIR__, 2).'/resources/views/pages/tests';

    foreach (scandir($testsRoot) ?: [] as $entry) {
        if ($entry === '.' || $entry === '..') {
            continue;
        }
        $path = $testsRoot.'/'.$entry;
        expect(is_dir($path))->toBeFalse("tests/ must be flat — remove subdir: tests/{$entry}");
    }
});
