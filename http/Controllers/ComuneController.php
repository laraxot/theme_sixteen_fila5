<?php

<<<<<<< HEAD
namespace Themes\Sixteen\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\View\View;
use Modules\Fixcity\App\Models\News;
use Modules\Fixcity\App\Models\Ticket;

class ComuneController extends Controller
{
    /**
     * Inoltra una chiamata dinamica su un target di tipo sconosciuto a livello statico.
     *
     * Modules\Fixcity non e' presente in questa base (modulo agnostico/esterno):
     * Ticket/News non sono risolvibili staticamente da PHPStan. Il dispatch dinamico
     * evita di dichiarare un tipo falso, mantenendo il comportamento reale invariato
     * quando il modulo e' installato altrove.
     *
     * @param  array<int, mixed>  $args
     */
    private function dynamicCall(mixed $target, string $method, array $args = []): mixed
    {
        return $target->{$method}(...$args);
    }

    /**
     * Homepage del comune
     */
    public function homepage(): View
    {
<<<<<<< HEAD
        if (! class_exists(Ticket::class) || ! class_exists(News::class)) {
            return view('sixteen::pages.comune.homepage', ['recentTickets' => collect(), 'recentNews' => collect()]);
        }

        $ticketClass = Ticket::class;
        $newsClass = News::class;

        $ticketsQuery = $this->dynamicCall($ticketClass::with(['user', 'status', 'priority']), 'orderBy', ['created_at', 'desc']);
        $ticketsQuery = $this->dynamicCall($ticketsQuery, 'limit', [5]);
        $recentTickets = $this->dynamicCall($ticketsQuery, 'get');

        $newsQuery = $this->dynamicCall($newsClass::orderBy('created_at', 'desc'), 'limit', [3]);
        $recentNews = $this->dynamicCall($newsQuery, 'get');
=======
        $recentTickets = Ticket::with(['user', 'status', 'priority'])
=======
declare(strict_types=1);

namespace Themes\Sixteen\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\View\View;
use Modules\Fixcity\Models\Ticket;
use Themes\Sixteen\Models\Municipal\MunicipalNews;

class ComuneController extends Controller
{
    public function homepage(): View
    {
        $recentTickets = Ticket::query()
            ->with(['owner'])
>>>>>>> 464cfc5 (.)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

<<<<<<< HEAD
        $recentNews = News::orderBy('created_at', 'desc')
            ->limit(3)
            ->get();
>>>>>>> 9e18142 (.)

        return view('sixteen::pages.comune.homepage', compact('recentTickets', 'recentNews'));
    }

    /**
     * Pagina servizi
     */
=======
        $recentNews = MunicipalNews::query()
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        /** @var view-string $view */
        $view = 'sixteen::pages.comune.homepage';

        return view($view, compact('recentTickets', 'recentNews'));
    }

>>>>>>> 464cfc5 (.)
    public function servizi(): View
    {
        $services = [
            [
                'nome' => 'Segnalazioni',
                'descrizione' => 'Segnala problemi e disservizi',
                'url' => route('fixcity.tickets.create'),
                'icona' => 'exclamation-triangle',
            ],
            [
                'nome' => 'Prenotazione Appuntamenti',
                'descrizione' => 'Prenota un appuntamento con gli uffici',
                'url' => route('comune.prenotazioni'),
                'icona' => 'calendar',
            ],
            [
                'nome' => 'Documenti e Moduli',
                'descrizione' => 'Scarica moduli e documenti',
                'url' => route('comune.documenti'),
                'icona' => 'file',
            ],
            [
                'nome' => 'Anagrafe',
                'descrizione' => 'Servizi anagrafici e stato civile',
                'url' => route('comune.anagrafe'),
                'icona' => 'user',
            ],
            [
                'nome' => 'Tributi',
                'descrizione' => 'Pagamento tasse e tributi comunali',
                'url' => route('comune.tributi'),
                'icona' => 'credit-card',
            ],
            [
                'nome' => 'Urbanistica',
                'descrizione' => 'Pratiche edilizie e urbanistiche',
                'url' => route('comune.urbanistica'),
                'icona' => 'building',
            ],
        ];

<<<<<<< HEAD
        return view('sixteen::pages.comune.servizi', compact('services'));
    }

    /**
     * Pagina novità
     */
    public function novita(): View
    {
        if (! class_exists(News::class)) {
            abort(404);
        }

        $newsClass = News::class;
        $news = $this->dynamicCall($newsClass::orderBy('created_at', 'desc'), 'paginate', [10]);

        return view('sixteen::pages.comune.novita', compact('news'));
    }

    /**
     * Dettaglio notizia
     */
    public function showNews(int $news): View
    {
        if (! class_exists(News::class)) {
            abort(404);
        }

        $newsClass = News::class;
        $newsModel = $this->dynamicCall($newsClass::query(), 'findOrFail', [$news]);

        return view('sixteen::pages.comune.novita-detail', ['news' => $newsModel]);
    }

    /**
     * Pagina contatti
     */
    public function contatti(): View
    {
        return view('sixteen::pages.comune.contatti');
    }

    /**
     * Invia messaggio di contatto
     */
<<<<<<< HEAD
    public function sendContact(Request $request): RedirectResponse
=======
    public function sendContact(Request $request)
=======
        /** @var view-string $view */
        $view = 'sixteen::pages.comune.servizi';

        return view($view, compact('services'));
    }

    public function novita(): View
    {
        $news = MunicipalNews::query()
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        /** @var view-string $view */
        $view = 'sixteen::pages.comune.novita';

        return view($view, compact('news'));
    }

    public function showNews(MunicipalNews $news): View
    {
        /** @var view-string $view */
        $view = 'sixteen::pages.comune.novita-detail';

        return view($view, compact('news'));
    }

    public function contatti(): View
    {
        /** @var view-string $view */
        $view = 'sixteen::pages.comune.contatti';

        return view($view);
    }

    public function sendContact(Request $request): RedirectResponse
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telefono' => 'nullable|string|max:20',
            'oggetto' => 'required|string|max:255',
            'messaggio' => 'required|string|max:1000',
        ]);

<<<<<<< HEAD
        // Qui implementeresti l'invio dell'email
        // Mail::to(config('comune.email'))->send(new ContactMessage($request->all()));

        return redirect()->back()->with('success', 'Messaggio inviato con successo!');
    }

    /**
     * Pagina documenti
     */
=======
        return redirect()->back()->with('success', 'Messaggio inviato con successo!');
    }

>>>>>>> 464cfc5 (.)
    public function documenti(): View
    {
        $documenti = [
            [
                'titolo' => 'Regolamento Comunale',
                'descrizione' => 'Regolamento generale del comune',
                'tipo' => 'PDF',
                'dimensione' => '2.5 MB',
                'data' => '2024-01-15',
                'url' => '#',
            ],
            [
                'titolo' => 'Bilancio 2024',
                'descrizione' => 'Bilancio preventivo e consuntivo 2024',
                'tipo' => 'PDF',
                'dimensione' => '1.8 MB',
                'data' => '2024-01-10',
                'url' => '#',
            ],
            [
                'titolo' => 'Modulo Richiesta Carta d\'Identità',
                'descrizione' => 'Modulo per la richiesta di carta d\'identità',
                'tipo' => 'PDF',
                'dimensione' => '150 KB',
                'data' => '2024-01-05',
                'url' => '#',
            ],
        ];

<<<<<<< HEAD
        return view('sixteen::pages.comune.documenti', compact('documenti'));
    }

    /**
     * Pagina eventi
     */
=======
        /** @var view-string $view */
        $view = 'sixteen::pages.comune.documenti';

        return view($view, compact('documenti'));
    }

>>>>>>> 464cfc5 (.)
    public function eventi(): View
    {
        $eventi = [
            [
                'titolo' => 'Festa del Patrono',
                'descrizione' => 'Celebrazione del santo patrono del comune',
                'data' => '2024-06-15',
                'ora' => '18:00',
                'luogo' => 'Piazza del Comune',
                'immagine' => 'evento1.jpg',
            ],
            [
                'titolo' => 'Mercato Contadino',
                'descrizione' => 'Mercato settimanale con prodotti locali',
                'data' => '2024-06-20',
                'ora' => '08:00',
                'luogo' => 'Via Roma',
                'immagine' => 'evento2.jpg',
            ],
            [
                'titolo' => 'Consiglio Comunale',
                'descrizione' => 'Seduta pubblica del consiglio comunale',
                'data' => '2024-06-25',
                'ora' => '20:30',
                'luogo' => 'Sala Consiliare',
                'immagine' => 'evento3.jpg',
            ],
        ];

<<<<<<< HEAD
        return view('sixteen::pages.comune.eventi', compact('eventi'));
    }

    /**
     * Pagina anagrafe
     */
    public function anagrafe(): View
    {
        return view('sixteen::pages.comune.anagrafe');
    }

    /**
     * Pagina tributi
     */
    public function tributi(): View
    {
        return view('sixteen::pages.comune.tributi');
    }

    /**
     * Pagina urbanistica
     */
    public function urbanistica(): View
    {
        return view('sixteen::pages.comune.urbanistica');
    }

    /**
     * Pagina prenotazioni
     */
    public function prenotazioni(): View
    {
        return view('sixteen::pages.comune.prenotazioni');
=======
        /** @var view-string $view */
        $view = 'sixteen::pages.comune.eventi';

        return view($view, compact('eventi'));
    }

    public function anagrafe(): View
    {
        /** @var view-string $view */
        $view = 'sixteen::pages.comune.anagrafe';

        return view($view);
    }

    public function tributi(): View
    {
        /** @var view-string $view */
        $view = 'sixteen::pages.comune.tributi';

        return view($view);
    }

    public function urbanistica(): View
    {
        /** @var view-string $view */
        $view = 'sixteen::pages.comune.urbanistica';

        return view($view);
    }

    public function prenotazioni(): View
    {
        /** @var view-string $view */
        $view = 'sixteen::pages.comune.prenotazioni';

        return view($view);
>>>>>>> 464cfc5 (.)
    }
}
