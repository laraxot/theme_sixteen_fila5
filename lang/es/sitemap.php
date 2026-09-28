<?php

declare(strict_types=1);

return [
    'meta' => ['title' => 'Mapa del sitio', 'description' => 'Explora las páginas y los servicios públicos de FixCity.', 'breadcrumb' => 'Mapa del sitio'],
    'intro' => 'Encuentra rápidamente las páginas públicas y las tareas disponibles.',
    'groups' => [
        ['title' => 'Avisos', 'links' => [['label' => 'Servicio de avisos', 'path' => '/services/report-issue'], ['label' => 'Lista y mapa de avisos', 'path' => '/tickets'], ['label' => 'Seguir un aviso', 'path' => '/tickets/track'], ['label' => 'Mis trámites', 'path' => '/area-personale/pratiche']]],
        ['title' => 'Información', 'links' => [['label' => 'Servicios', 'path' => '/services'], ['label' => 'Administración', 'path' => '/administration'], ['label' => 'Noticias', 'path' => '/news'], ['label' => 'Preguntas frecuentes', 'path' => '/domande-frequenti'], ['label' => 'Privacidad', 'path' => '/privacy']]],
        ['title' => 'Cuenta', 'links' => [['label' => 'Iniciar sesión', 'path' => '/auth/login'], ['label' => 'Crear una cuenta', 'path' => '/auth/register']]],
    ],
];
