<?php

declare(strict_types=1);

return [
    'meta' => ['title' => 'Site map', 'description' => 'Explore FixCity public pages and services.', 'breadcrumb' => 'Site map'],
    'intro' => 'Find public pages and available tasks quickly.',
    'groups' => [
        ['title' => 'Reports', 'links' => [['label' => 'Reporting service', 'path' => '/services/report-issue'], ['label' => 'Report list and map', 'path' => '/tickets'], ['label' => 'Track a report', 'path' => '/tickets/track'], ['label' => 'My cases', 'path' => '/area-personale/pratiche']]],
        ['title' => 'Information', 'links' => [['label' => 'Services', 'path' => '/services'], ['label' => 'Administration', 'path' => '/administration'], ['label' => 'News', 'path' => '/news'], ['label' => 'Frequently asked questions', 'path' => '/domande-frequenti'], ['label' => 'Privacy', 'path' => '/privacy']]],
        ['title' => 'Account', 'links' => [['label' => 'Sign in', 'path' => '/auth/login'], ['label' => 'Create an account', 'path' => '/auth/register']]],
    ],
];
