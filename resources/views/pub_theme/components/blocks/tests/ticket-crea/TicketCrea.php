<?php

namespace App\Livewire\Components\Tests;

use Livewire\Component;

class TicketCrea extends Component
{
    public $form = [
        'tipo' => '',
        'categoria' => '',
        'descrizione' => '',
        'allegati' => '',
        'privacy' => false,
    ];

    public function callSchemaComponentMethod()
    {
        // Schema method required by Livewire/V filamento wizard
        return $this->form;
    }

    public function save()
    {
        // Save ticket
    }

    public function render()
    {
        return view('pub_theme::components.blocks.tests.ticket-crea.default');
    }
}
