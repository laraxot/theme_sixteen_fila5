<?php

declare(strict_types=1);

use Tests\TestCase;

use function Safe\file_get_contents;

uses(TestCase::class);

/**
 * @see Themes/Sixteen/docs/design-comuni/TICKET-CREATION-WIZARD.md
 */
test('ticket create block exposes a reusable semantic CMS boundary', function (): void {
    $path = dirname(__DIR__, 2).'/resources/views/components/blocks/ticket-create/design-comuni.blade.php';
    $blade = file_get_contents($path);

    expect($blade)
        ->toContain("@props(['data' => []])")
        ->toContain('<section')
        ->toContain('aria-label="{{ $sectionLabel }}"')
        ->toContain('data-block="ticket-create"')
        ->toContain("['blockData' => \$data]")
        ->toContain('@see Themes/Sixteen/docs/design-comuni/TICKET-CREATION-WIZARD.md');
});

/**
 * @see Themes/Sixteen/docs/design-comuni/TICKET-CREATION-WIZARD.md
 */
test('ticket create CMS entries keep the shared block view contract', function (): void {
    $paths = [
        dirname(__DIR__, 4).'/config/local/fixcity/database/content/pages/tickets/create.json',
        dirname(__DIR__, 4).'/Modules/Fixcity/config/database/content/pages/tickets.create.json',
        dirname(__DIR__, 4).'/Modules/Fixcity/config/database/content/pages/tickets/create.json',
    ];

    foreach ($paths as $path) {
        $payload = json_decode(file_get_contents($path), true, 512, JSON_THROW_ON_ERROR);

        expect($payload['content_blocks'] ?? null)->toBeArray();

        foreach (['it', 'en', 'de', 'es'] as $locale) {
            $block = $payload['content_blocks'][$locale][0] ?? null;

            expect($block)->toBeArray()
                ->and($block['type'] ?? null)->toBe('ticket_create')
                ->and($block['data']['view'] ?? null)
                ->toBe('pub_theme::components.blocks.ticket-create.design-comuni');
        }
    }
});

/**
 * @see Themes/Sixteen/docs/design-comuni/TICKET-CREATION-WIZARD.md
 */
test('legacy ticket create view delegates to the semantic block', function (): void {
    $path = dirname(__DIR__, 2).'/resources/views/components/blocks/tests/ticket-crea.blade.php';

    expect(file_get_contents($path))
        ->toContain("@include('pub_theme::components.blocks.ticket-create.design-comuni'");
});
