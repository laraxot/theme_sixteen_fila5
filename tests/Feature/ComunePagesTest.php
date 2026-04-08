<?php

namespace Themes\Sixteen\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Fixcity\App\Models\News;
use Modules\Fixcity\App\Models\Ticket;
use Tests\TestCase;

class ComunePagesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate', ['--database' => 'testing']);
    }

    public function test_homepage_loads_successfully()
    {
        $response = $this->get(route('comune.homepage'));

        $response->assertStatus(200);
        $response->assertSee('Benvenuti nel Comune di');
        $response->assertSee('Segnalazioni');
        $response->assertSee('Servizi');
        $response->assertSee('Novità');
    }

    public function test_homepage_displays_recent_tickets()
    {
        $ticket = Ticket::factory()->create([
            'name' => 'Buca Stradale',
            'description' => 'Buca pericolosa in via Roma',
        ]);

        $response = $this->get(route('comune.homepage'));

        $response->assertSee('Ultime Segnalazioni');
        $response->assertSee('Buca Stradale');
        $response->assertSee('Buca pericolosa in via Roma');
    }

    public function test_homepage_displays_recent_news()
    {
        $news = News::factory()->create([
            'title' => 'Nuovo Servizio Online',
            'excerpt' => 'Il comune lancia un nuovo servizio digitale',
        ]);

        $response = $this->get(route('comune.homepage'));

        $response->assertSee('Ultime Novità');
        $response->assertSee('Nuovo Servizio Online');
        $response->assertSee('Il comune lancia un nuovo servizio digitale');
    }

    public function test_servizi_page_loads_successfully()
    {
        $response = $this->get(route('comune.servizi'));

        $response->assertStatus(200);
        $response->assertSee('Servizi del Comune');
        $response->assertSee('Segnalazioni');
        $response->assertSee('Prenotazione Appuntamenti');
        $response->assertSee('Documenti e Moduli');
    }

    public function test_servizi_page_displays_service_categories()
    {
        $response = $this->get(route('comune.servizi'));

        $response->assertSee('Anagrafe');
        $response->assertSee('Tributi');
        $response->assertSee('Urbanistica');
        $response->assertSee('Sociale');
        $response->assertSee('Cultura');
        $response->assertSee('Ambiente');
    }

    public function test_novita_page_loads_successfully()
    {
        $response = $this->get(route('comune.novita'));

        $response->assertStatus(200);
        $response->assertSee('Novità e Comunicati');
        $response->assertSee('Filtra per Categoria');
        $response->assertSee('Archivio');
    }

    public function test_novita_page_displays_news_articles()
    {
        $news = News::factory()->count(3)->create([
            'title' => 'Notizia Test',
            'excerpt' => 'Estratto notizia test',
        ]);

        $response = $this->get(route('comune.novita'));

        foreach ($news as $article) {
            $response->assertSee($article->title);
            $response->assertSee($article->excerpt);
        }
    }

    public function test_contatti_page_loads_successfully()
    {
        $response = $this->get(route('comune.contatti'));

        $response->assertStatus(200);
        $response->assertSee('Contatti');
        $response->assertSee('Informazioni di Contatto');
        $response->assertSee('Orari di Apertura');
        $response->assertSee('Mappa');
    }

    public function test_contatti_page_displays_contact_information()
    {
        $response = $this->get(route('comune.contatti'));

        $response->assertSee(config('comune.nome'));
        $response->assertSee(config('comune.indirizzo'));
        $response->assertSee(config('comune.telefono'));
        $response->assertSee(config('comune.email'));
        $response->assertSee(config('comune.pec'));
    }

    public function test_contatti_page_displays_opening_hours()
    {
        $response = $this->get(route('comune.contatti'));

        $response->assertSee('Lunedì - Venerdì');
        $response->assertSee('Martedì e Giovedì');
        $response->assertSee('Sabato');
        $response->assertSee('Domenica');
    }

    public function test_documenti_page_loads_successfully()
    {
        $response = $this->get(route('comune.documenti'));

        $response->assertStatus(200);
        $response->assertSee('Documenti');
        $response->assertSee('Regolamento Comunale');
        $response->assertSee('Bilancio 2024');
        $response->assertSee('Modulo Richiesta Carta d\'Identità');
    }

    public function test_eventi_page_loads_successfully()
    {
        $response = $this->get(route('comune.eventi'));

        $response->assertStatus(200);
        $response->assertSee('Eventi');
        $response->assertSee('Festa del Patrono');
        $response->assertSee('Mercato Contadino');
        $response->assertSee('Consiglio Comunale');
    }

    public function test_anagrafe_page_loads_successfully()
    {
        $response = $this->get(route('comune.anagrafe'));

        $response->assertStatus(200);
        $response->assertSee('Anagrafe');
    }

    public function test_tributi_page_loads_successfully()
    {
        $response = $this->get(route('comune.tributi'));

        $response->assertStatus(200);
        $response->assertSee('Tributi');
    }

    public function test_urbanistica_page_loads_successfully()
    {
        $response = $this->get(route('comune.urbanistica'));

        $response->assertStatus(200);
        $response->assertSee('Urbanistica');
    }

    public function test_prenotazioni_page_loads_successfully()
    {
        $response = $this->get(route('comune.prenotazioni'));

        $response->assertStatus(200);
        $response->assertSee('Prenotazioni');
    }

    public function test_contact_form_validation()
    {
        $response = $this->post(route('comune.contatti.send'), []);

        $response->assertSessionHasErrors(['nome', 'email', 'oggetto', 'messaggio']);
    }

    public function test_contact_form_email_validation()
    {
        $response = $this->post(route('comune.contatti.send'), [
            'nome' => 'Test User',
            'email' => 'invalid-email',
            'oggetto' => 'Test Subject',
            'messaggio' => 'Test Message',
        ]);

        $response->assertSessionHasErrors(['email']);
    }

    public function test_contact_form_success()
    {
        $response = $this->post(route('comune.contatti.send'), [
            'nome' => 'Test User',
            'email' => 'test@example.com',
            'oggetto' => 'Test Subject',
            'messaggio' => 'Test Message',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');
    }

    public function test_responsive_design()
    {
        $response = $this->get(route('comune.homepage'));

        $response->assertStatus(200);
        $response->assertSee('viewport');
        $response->assertSee('width=device-width');
        $response->assertSee('initial-scale=1');
    }

    public function test_accessibility_features()
    {
        $response = $this->get(route('comune.homepage'));

        $response->assertStatus(200);
        $response->assertSee('alt=');
        $response->assertSee('aria-label');
        $response->assertSee('role=');
    }

    public function test_bootstrap_italia_integration()
    {
        $response = $this->get(route('comune.homepage'));

        $response->assertStatus(200);
        $response->assertSee('bootstrap-italia');
        $response->assertSee('it-header-wrapper');
        $response->assertSee('it-footer');
    }

    public function test_leaflet_integration()
    {
        $response = $this->get(route('comune.contatti'));

        $response->assertStatus(200);
        $response->assertSee('leaflet');
        $response->assertSee('L.map');
    }

    public function test_font_awesome_integration()
    {
        $response = $this->get(route('comune.homepage'));

        $response->assertStatus(200);
        $response->assertSee('font-awesome');
        $response->assertSee('fas fa-');
    }
}
