<?php

declare(strict_types=1);

uses(Tests\TestCase::class);

<<<<<<< .merge_file_BGmGME
test('cta ticket block renders with defaults', function (): void {
    /** @var Tests\TestCase $this */
=======
test('cta ticket block omits empty CMS payload', function (): void {
    /** @var TestCase $this */
>>>>>>> .merge_file_WwzLlW
    $view = $this->view('pub_theme::components.blocks.cta.ticket', [
        'cta' => [],
    ]);

    $view->assertDontSee('cmp-text-button', false);
    $view->assertDontSee('<h2', false);
});

test('cta ticket block renders custom payload', function (): void {
    /** @var Tests\TestCase $this */
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
    $html = (string) file_get_contents($path);

    expect($html)->not->toContain('FrontofficeUrl');
});
