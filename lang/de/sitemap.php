<?php

declare(strict_types=1);

return [
    'meta' => ['title' => 'Sitemap', 'description' => 'Entdecken Sie die öffentlichen Seiten und Dienste von FixCity.', 'breadcrumb' => 'Sitemap'],
    'intro' => 'Finden Sie schnell öffentliche Seiten und verfügbare Aufgaben.',
    'groups' => [
        ['title' => 'Meldungen', 'links' => [['label' => 'Meldedienst', 'path' => '/services/report-issue'], ['label' => 'Liste und Karte der Meldungen', 'path' => '/tickets'], ['label' => 'Meldung verfolgen', 'path' => '/tickets/track'], ['label' => 'Meine Vorgänge', 'path' => '/area-personale/pratiche']]],
        ['title' => 'Informationen', 'links' => [['label' => 'Dienste', 'path' => '/services'], ['label' => 'Verwaltung', 'path' => '/administration'], ['label' => 'Neuigkeiten', 'path' => '/news'], ['label' => 'Häufige Fragen', 'path' => '/domande-frequenti'], ['label' => 'Datenschutz', 'path' => '/privacy']]],
        ['title' => 'Konto', 'links' => [['label' => 'Anmelden', 'path' => '/auth/login'], ['label' => 'Konto erstellen', 'path' => '/auth/register']]],
    ],
];
