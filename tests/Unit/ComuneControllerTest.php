<?php

namespace Themes\Sixteen\Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Fixcity\App\Models\News;
use Modules\Fixcity\App\Models\Ticket;
use Tests\TestCase;

class ComuneControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate', ['--database' => 'testing']);
    }

    public function test_homepage_returns_view()
    {
        $response = $this->get(route('comune.homepage'));

        $response->assertStatus(200);
        $response->assertViewIs('sixteen::pages.comune.homepage');
    }

    public function test_homepage_displays_recent_tickets()
    {
        $ticket = Ticket::factory()->create([
            'name' => 'Test Ticket',
            'description' => 'Test Description',
        ]);

        $response = $this->get(route('comune.homepage'));

        $response->assertSee('Test Ticket');
        $response->assertSee('Test Description');
    }

    public function test_homepage_displays_recent_news()
    {
        $news = News::factory()->create([
            'title' => 'Test News',
            'excerpt' => 'Test Excerpt',
        ]);

        $response = $this->get(route('comune.homepage'));

        $response->assertSee('Test News');
        $response->assertSee('Test Excerpt');
    }

    public function test_servizi_returns_view()
    {
        $response = $this->get(route('comune.servizi'));

        $response->assertStatus(200);
        $response->assertViewIs('sixteen::pages.comune.servizi');
    }

    public function test_servizi_displays_services()
    {
        $response = $this->get(route('comune.servizi'));

        $response->assertSee('Segnalazioni');
        $response->assertSee('Servizi');
        $response->assertSee('Anagrafe');
        $response->assertSee('Tributi');
    }

    public function test_novita_returns_view()
    {
        $response = $this->get(route('comune.novita'));

        $response->assertStatus(200);
        $response->assertViewIs('sixteen::pages.comune.novita');
    }

    public function test_novita_displays_news()
    {
        $news = News::factory()->count(5)->create();

        $response = $this->get(route('comune.novita'));

        foreach ($news as $article) {
            $response->assertSee($article->title);
        }
    }

    public function test_contatti_returns_view()
    {
        $response = $this->get(route('comune.contatti'));

        $response->assertStatus(200);
        $response->assertViewIs('sixteen::pages.comune.contatti');
    }

    public function test_contatti_displays_contact_info()
    {
        $response = $this->get(route('comune.contatti'));

        $response->assertSee(config('comune.nome'));
        $response->assertSee(config('comune.indirizzo'));
        $response->assertSee(config('comune.telefono'));
        $response->assertSee(config('comune.email'));
    }

    public function test_documenti_returns_view()
    {
        $response = $this->get(route('comune.documenti'));

        $response->assertStatus(200);
        $response->assertViewIs('sixteen::pages.comune.documenti');
    }

    public function test_eventi_returns_view()
    {
        $response = $this->get(route('comune.eventi'));

        $response->assertStatus(200);
        $response->assertViewIs('sixteen::pages.comune.eventi');
    }

    public function test_anagrafe_returns_view()
    {
        $response = $this->get(route('comune.anagrafe'));

        $response->assertStatus(200);
        $response->assertViewIs('sixteen::pages.comune.anagrafe');
    }

    public function test_tributi_returns_view()
    {
        $response = $this->get(route('comune.tributi'));

        $response->assertStatus(200);
        $response->assertViewIs('sixteen::pages.comune.tributi');
    }

    public function test_urbanistica_returns_view()
    {
        $response = $this->get(route('comune.urbanistica'));

        $response->assertStatus(200);
        $response->assertViewIs('sixteen::pages.comune.urbanistica');
    }

    public function test_prenotazioni_returns_view()
    {
        $response = $this->get(route('comune.prenotazioni'));

        $response->assertStatus(200);
        $response->assertViewIs('sixteen::pages.comune.prenotazioni');
    }

    public function test_send_contact_validates_required_fields()
    {
        $response = $this->post(route('comune.contatti.send'), []);

        $response->assertSessionHasErrors(['nome', 'email', 'oggetto', 'messaggio']);
    }

    public function test_send_contact_validates_email_format()
    {
        $response = $this->post(route('comune.contatti.send'), [
            'nome' => 'Test User',
            'email' => 'invalid-email',
            'oggetto' => 'Test Subject',
            'messaggio' => 'Test Message',
        ]);

        $response->assertSessionHasErrors(['email']);
    }

    public function test_send_contact_success()
    {
        $response = $this->post(route('comune.contatti.send'), [
            'nome' => 'Test User',
            'email' => 'test@example.com',
            'oggetto' => 'Test Subject',
            'messaggio' => 'Test Message',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success', 'Messaggio inviato con successo!');
    }
}
