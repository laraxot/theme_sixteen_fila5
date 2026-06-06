<?php

declare(strict_types=1);

namespace Themes\Sixteen\Tests\Feature;

use Tests\TestCase;

final class SegnalazioniElencoPageTest extends TestCase
{
    public function test_homepage_loads_successfully(): void
    {
        $response = $this->get('/it');

        $response->assertStatus(200);
        $response->assertSee('Elenco segnalazioni');
    }

    public function test_homepage_has_required_components(): void
    {
        $response = $this->get('/it');

        $response->assertStatus(200);
        $response->assertSee('nav-tabs');
        $response->assertSee('category-list');
        $response->assertSee('map-lit');
    }

    public function test_homepage_has_breadcrumb(): void
    {
        $response = $this->get('/it');

        $response->assertStatus(200);
        $response->assertSee('breadcrumb');
        $response->assertSee('Home');
        $response->assertSee('Elenco segnalazioni');
    }

    public function test_homepage_has_map_and_list_tabs(): void
    {
        $response = $this->get('/it');

        $response->assertStatus(200);
        $response->assertSee('Mappa');
        $response->assertSee('Elenco');
    }

    public function test_homepage_has_filters(): void
    {
        $response = $this->get('/it');

        $response->assertStatus(200);
        $response->assertSee('Filtra');
    }

    public function test_homepage_has_cta_section(): void
    {
        $response = $this->get('/it');

        $response->assertStatus(200);
        $response->assertSee('Fai una segnalazione');
        $response->assertSee('Segnala');
    }

    public function test_homepage_has_contacts_section(): void
    {
        $response = $this->get('/it');

        $response->assertStatus(200);
        $response->assertSee('Contatta il comune');
    }

    public function test_homepage_has_rating_feedback(): void
    {
        $response = $this->get('/it');

        $response->assertStatus(200);
        $response->assertSee('Valuta da 1 a 5 stelle');
    }

    public function test_segnalazioni_elenco_test_page_loads_successfully(): void
    {
        $response = $this->get('/it/tests/segnalazioni-elenco');

        $response->assertStatus(200);
        $response->assertSee('Elenco segnalazioni');
    }
}
