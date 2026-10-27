<?php

declare(strict_types=1);

return [
    'meta' => ['title' => 'Notizie e comunicati', 'description' => 'Notizie, comunicati e avvisi del Comune.', 'breadcrumb' => 'Notizie'],
    'hero' => ['title' => 'Notizie e comunicati', 'subtitle' => 'Aggiornamenti ufficiali e informazioni utili dalla città.'],
    'filters' => ['aria' => 'Filtri notizie', 'all' => 'Tutte le notizie', 'press' => 'Comunicati', 'notices' => 'Avvisi'],
    'latest' => ['title' => 'Ultime notizie', 'subtitle' => 'Resta aggiornato sulle novità del Comune.'],
    'search' => ['label' => 'Cerca notizie', 'placeholder' => 'Cerca notizie'],
    'read_more' => 'Leggi tutto',
    // Fallback degli elenchi blog ed eventi (blocks/blog/index, blocks/events/index): il JSON della pagina li puo' sostituire.
    'index' => [
        'default_category' => 'Notizie',
        'default_event_category' => 'Eventi',
        'search_label' => 'Cerca',
        'search_placeholder' => 'Cerca per parola chiave',
        'search_submit' => 'Invio',
        'result_one' => '1 notizia trovata',
        'result_many' => ':count notizie trovate',
    ],
    'items' => [
        'one' => ['category' => 'Comunicati', 'date_iso' => '2026-09-01', 'date' => '1 settembre 2026', 'title' => 'Nuovi servizi digitali per i cittadini', 'body' => 'Sono disponibili nuovi percorsi online per accedere ai servizi comunali.'],
        'two' => ['category' => 'Avvisi', 'date_iso' => '2026-08-20', 'date' => '20 agosto 2026', 'title' => 'Aggiornamento dei servizi sul territorio', 'body' => 'Consulta gli aggiornamenti operativi e le informazioni per la comunità.'],
        'three' => ['category' => 'Eventi', 'date_iso' => '2026-08-05', 'date' => '5 agosto 2026', 'title' => 'Iniziative aperte alla cittadinanza', 'body' => 'Scopri le prossime iniziative e partecipa alla vita della città.'],
    ],
];
