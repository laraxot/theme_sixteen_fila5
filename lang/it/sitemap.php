<?php

declare(strict_types=1);

return [
    'meta' => ['title' => 'Mappa del sito', 'description' => 'Esplora le pagine e i servizi pubblici di FixCity.', 'breadcrumb' => 'Mappa del sito'],
    'intro' => 'Trova rapidamente le pagine pubbliche e le attività disponibili.',
    'groups' => [
        ['title' => 'Segnalazioni', 'links' => [['label' => 'Servizio di segnalazione', 'path' => '/services/report-issue'], ['label' => 'Elenco e mappa delle segnalazioni', 'path' => '/tickets'], ['label' => 'Segui una segnalazione', 'path' => '/tickets/track'], ['label' => 'Le mie pratiche', 'path' => '/area-personale/pratiche']]],
        ['title' => 'Informazioni', 'links' => [['label' => 'Servizi', 'path' => '/services'], ['label' => 'Amministrazione', 'path' => '/administration'], ['label' => 'Notizie', 'path' => '/news'], ['label' => 'Domande frequenti', 'path' => '/domande-frequenti'], ['label' => 'Privacy', 'path' => '/privacy']]],
        ['title' => 'Account', 'links' => [['label' => 'Accedi', 'path' => '/auth/login'], ['label' => 'Crea un account', 'path' => '/auth/register']]],
    ],
];
