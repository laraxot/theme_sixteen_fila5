<?php

declare(strict_types=1);

use Tests\TestCase;

uses(TestCase::class);

it('renders the services test page through the CMS/Folio wildcard', function (): void {
    $this->get('/it/tests/servizi')
        ->assertOk()
        ->assertSee('id="service-catalogue"', false)
        ->assertSee('data-service-searchable', false)
        ->assertSee('/it/tickets/create', false)
        ->assertSee('/it/tickets', false)
        ->assertSee('/it/tickets/track', false)
        ->assertDontSee('service-page-list', false)
        ->assertDontSee('href="#"', false);
});

it('does not invent a category filter for the supported service catalogue', function (): void {
    $this->get('/it/tests/servizi')
        ->assertOk()
        ->assertDontSee('category-cards', false);
});
