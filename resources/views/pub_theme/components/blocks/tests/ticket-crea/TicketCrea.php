<?php

declare(strict_types=1);

namespace App\Livewire\Components\Tests;

use Illuminate\Contracts\View\View;
use Livewire\Component;

/**
 * @phpstan-type TicketFormState array{tipo: string, categoria: string, descrizione: string, allegati: string, privacy: bool, lat?: int|float|string|null, lng?: int|float|string|null}
 */
class TicketCrea extends Component
{
    /** @var TicketFormState */
    public array $form = [
        'tipo' => '',
        'categoria' => '',
        'descrizione' => '',
        'allegati' => '',
        'privacy' => false,
    ];

    /** @return TicketFormState */
    public function callSchemaComponentMethod(): array
    {
        // Schema method required by Livewire/V filamento wizard
        return $this->form;
    }

    public function save(): void
    {
        // Save ticket
    }

    public function render(): View
    {
        return view('pub_theme::components.blocks.tests.ticket-crea');
    }
}
