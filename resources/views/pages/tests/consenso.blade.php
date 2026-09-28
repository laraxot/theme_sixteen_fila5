<?php

declare(strict_types=1);

use function Laravel\Folio\name;

/**
 * Vetrina di verifica del blocco `consenso`.
 *
 * NON e' una pagina di produzione: sta sotto `/it/tests`, escluso da `robots.txt`, e va
 * rimosso dal percorso pubblico (STORY-517). Serve a verificare che il blocco renda,
 * che l'accessibilita' sia reale e che la traduzione sia applicata. Guardare il sorgente
 * non basta: i difetti di questo blocco sono di interazione, non di sintassi.
 *
 * TRE REGOLE PER NON RIPETERE I TRE ERRORI DI OGGI
 * ===================================================
 * In un file Blade il sorgente viene scandito AL GREZZO, prima che il PHP venga
 * valutato. Quindi nella prosa di un commento non si scrive mai:
 *
 *  1. il marcatore di apertura PHP. Scrivendolo dentro un docblock si apre il PHP
 *     dentro il commento: tutto il resto del file diventa output letterale e il
 *     blocco `@php` smette di essere compilato, con `Undefined variable` a seguire.
 *     Qui sotto si dice "il preambolo" e basta.
 *
 *  2. il marcatore di chiusura PHP, che chiude il PHP aperto al punto 1.
 *
 *  3. un tag componente, cioe' un nome di tag preceduto dalla parentesi angolare
 *     iniziale: il regex dei componenti lo aggancia e prosegue fino alla parentesi
 *     angolare di chiusura successiva del file, divorando righe nel mezzo.
 *
 * Il sintomo e' sempre lo stesso e punta lontano: `syntax error, unexpected
 * identifier "<parola>", expecting "]"` su una riga che sembra innocua, con la
 * parola citata presa da un attributo di trecento righe piu' in giu'. Quando
 * l'errore di sintassi non e' dove lo indica, il colpevole e' un marcatore o un
 * tag scritto in prosa: si legge la vista COMPILATA in
 * `storage/framework/views/`, che mostra esattamente dove il PHP si e' spezzato.
 *
 * NOTA 4 — nessun `render()`: non serve a passare dati, e chiamarlo senza importarlo
 * dà `Call to undefined function render()`.
 *
 * NOTA 5 — attributo bound senza apici. `:` davanti a un attributo lo rende
 * un'espressione PHP. Un attributo di testo semplice resta testo; con i due punti
 * `Testo` viene letto come costante seguita da identificatore, dentro l'array di
 * attributi che Blade genera. Per passare testo si usa l'attributo semplice.
 *
 * NOTA 6 — nessun array inline in un attributo. L'attributo con l'array letterale
 * su piu' righe viene troncato alla prima parentesi di chiusura dell'array. Gli
 * array si costruiscono in `@php` e si passano per nome.
 *
 * Le variabili si calcolano nel markup, mai nel preambolo: il preambolo serve solo
 * per `use`, `name()`, `render()` e `middleware()`.
 */
name('tests.consenso');
?>

@php
    // Stato 1 — solo informativa, nessuna azione.
    $d1 = ['link' => url('/'.app()->getLocale().'/privacy')];

    // Stato 2 — dentro un form, che e' l'uso reale nello step 1 del flusso.
    $d2 = ['action' => url('/'.app()->getLocale().'/tickets/create')];

    // Stato 3 — punti di trattamento espliciti, uno per voce.
    $d3 = [
        'action' => url('/'.app()->getLocale().'/tickets/create'),
        'points' => [
            'Dati trattati: nome, cognome, recapito elettronico, posizione.',
            'Finalità: rispondere alla segnalazione.',
        ],
    ];

    // Stato 4 — non interattivo: il riepilogo mostra il consenso già dato.
    $d4 = ['disabled' => true, 'required' => false];
@endphp

<x-pub_theme::layouts.app title="Verifica blocco consenso">
    <main class="container py-5">
        <h1 class="title-xxlarge mb-4">Verifica blocco consenso</h1>

        {{-- 1. Solo informativa e checkbox: il caso minimo, senza form intorno. --}}
        <section class="mb-5">
            <h2 class="h4 mb-2">1. Solo informativa e checkbox</h2>
            <x-pub_theme::consenso :data="$d1" />
        </section>

        {{-- 2. Con azione: l'uso reale nello step 1. --}}
        <section class="mb-5">
            <h2 class="h4 mb-2">2. Con azione (uso reale)</h2>
            <form method="POST" action="{{ $d2['action'] }}">
                <x-pub_theme::consenso :data="$d2" />
            </form>
        </section>

        {{-- 3. Con punti di trattamento espliciti. --}}
        <section class="mb-5">
            <h2 class="h4 mb-2">3. Con punti di trattamento</h2>
            <form method="POST" action="{{ $d3['action'] }}">
                <x-pub_theme::consenso :data="$d3" />
            </form>
        </section>

        {{-- 4. Non interattivo, per il riepilogo. --}}
        <section>
            <h2 class="h4 mb-2">4. Non interattivo (riepilogo)</h2>
            <x-pub_theme::consenso :data="$d4" />
        </section>
    </main>
</x-pub_theme::layouts.app>
