<?php

declare(strict_types=1);

use function Laravel\Folio\middleware;
use function Laravel\Folio\name;

name('dashboard');
middleware(['web', 'auth']);

?>

<x-layouts.app>
    <x-slot name="title">
        {{ __('Dashboard') }}
    </x-slot>

    <main id="main-container" class="container py-4 py-lg-5">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">
                <header class="cmp-heading mb-4">
                    <h1 class="title-xxxlarge">{{ __('Benvenuto, :name', ['name' => auth()->user()->name]) }}</h1>
                    <p class="subtitle-small mb-0">
                        {{ __('Da qui puoi seguire lo stato delle tue segnalazioni e pratiche.') }}
                    </p>
                </header>

                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <h2 class="title-medium mb-2">{{ __('Le mie pratiche') }}</h2>
                        <p class="text-muted mb-3">
                            {{ __('Consulta lo stato di avanzamento delle tue segnalazioni e richieste.') }}
                        </p>
                        <a href="{{ route('area-personale.pratiche') }}" class="btn btn-primary">
                            {{ __('Vai alle mie pratiche') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-layouts.app>
