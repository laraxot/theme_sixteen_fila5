<?php

declare(strict_types=1);
<<<<<<< HEAD
use Tests\TestCase;

use function Safe\file_get_contents;

uses(TestCase::class);

test('cta ticket block renders with defaults', function (): void {
    /** @var TestCase $this */
=======

uses(Tests\TestCase::class);

test('cta ticket block renders with defaults', function (): void {
    /** @var Tests\TestCase $this */
>>>>>>> laraxot/dev
    $view = $this->view('pub_theme::components.blocks.cta.ticket', [
        'cta' => [],
    ]);

    $view->assertSee('cmp-text-button', false);
    $view->assertSee(__('fixcity::ticket.map.cta.title.label'), false);
    $view->assertSee(__('fixcity::ticket.map.cta.button.label'), false);
});

test('cta ticket block renders custom payload', function (): void {
<<<<<<< HEAD
    /** @var TestCase $this */
=======
    /** @var Tests\TestCase $this */
>>>>>>> laraxot/dev
    $view = $this->view('pub_theme::components.blocks.cta.ticket', [
        'cta' => [
            'title' => 'Custom title',
            'text' => 'Custom text',
            'button_text' => 'Custom button',
            'button_url' => '/tests/ticket-crea',
        ],
    ]);

    $view->assertSee('Custom title', false)
        ->assertSee('Custom text', false)
        ->assertSee('Custom button', false);
});

test('cta ticket block does not use frontoffice url', function (): void {
    $path = dirname(__DIR__, 2).'/resources/views/components/blocks/cta/ticket.blade.php';
<<<<<<< HEAD
    $html = file_get_contents($path);
=======
    $html = (string) file_get_contents($path);
>>>>>>> laraxot/dev

    expect($html)->not->toContain('FrontofficeUrl');
});
