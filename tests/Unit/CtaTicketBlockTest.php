<?php

declare(strict_types=1);

namespace Themes\Sixteen\Tests\Unit;

use Tests\TestCase;

class CtaTicketBlockTest extends TestCase
{
    public function test_cta_ticket_block_renders_with_defaults(): void
    {
        $view = $this->view('pub_theme::components.blocks.cta.ticket', [
            'cta' => [],
        ]);

        $view->assertSee('cmp-text-button', false);
        $view->assertSee(__('fixcity::ticket.map.cta.title.label'), false);
        $view->assertSee(__('fixcity::ticket.map.cta.button.label'), false);
    }

    public function test_cta_ticket_block_renders_custom_payload(): void
    {
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
    }

    public function test_cta_ticket_block_does_not_use_frontoffice_url(): void
    {
        $path = dirname(__DIR__, 2).'/resources/views/components/blocks/cta/ticket.blade.php';
        $html = (string) file_get_contents($path);

        expect($html)->not->toContain('FrontofficeUrl');
    }
}
