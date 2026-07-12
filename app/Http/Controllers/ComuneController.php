<?php

declare(strict_types=1);

namespace Themes\Sixteen\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\View\View;
use Modules\Fixcity\Models\Ticket;

class ComuneController extends Controller
{
    public function homepage(): View
    {
        $recentTickets = Ticket::query()
            ->with(['owner'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        /** @var view-string $view */
        $view = 'sixteen::pages.comune.homepage';

        return view($view, ['recentTickets' => $recentTickets]);
    }

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

        /** @var view-string $view */
        $view = 'sixteen::pages.comune.servizi';

        return view($view, compact('services'));
    }

    public function contatti(): View
    {
        /** @var view-string $view */
        $view = 'sixteen::pages.comune.contatti';

        return view($view);
    }

    public function sendContact(Request $request): RedirectResponse
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telefono' => 'nullable|string|max:20',
            'oggetto' => 'required|string|max:255',
            'messaggio' => 'required|string|max:1000',
        ]);

        return redirect()->back()->with('success', 'Messaggio inviato con successo!');
    }

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

        /** @var view-string $view */
        $view = 'sixteen::pages.comune.documenti';

        return view($view, compact('documenti'));
    }

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
    }
}
