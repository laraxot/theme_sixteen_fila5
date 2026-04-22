<?php

declare(strict_types=1);

use function Laravel\Folio\name;

name('segnalazione.crea');

?>

<x-layouts.app>
    <div class="page-content content" data-slug="segnalazione-crea" data-side="content">
        @livewire(\Modules\Fixcity\Filament\Widgets\CreateTicketWizardWidget::class)
    </div>
</x-layouts.app>
