<?php

declare(strict_types=1);

/*
 * Páginas legales a partir del texto del Ayuntamiento (aviso de privacidad, notas legales, política de medios; DCP-130/131). El
 * texto real lo aporta el Ayuntamiento: estas cadenas son solo el marco y el aviso que se muestra cuando falta o está incompleto.
 */
return [
    'home' => 'Inicio',
    'documents' => [
        'privacy' => ['title' => 'Aviso de privacidad'],
        'legal_notes' => ['title' => 'Notas legales'],
        'media_policy' => ['title' => 'Política de medios'],
    ],
    'incomplete' => [
        'title' => 'Texto aún incompleto',
        'intro_missing' => 'El responsable del tratamiento debe aportar todavía los datos siguientes antes de la puesta en producción.',
        'intro_present' => 'El texto de abajo está incompleto: el responsable del tratamiento debe aportar o completar todavía los datos siguientes antes de la puesta en producción.',
        'document_missing' => 'El Ayuntamiento aún no ha aportado el texto de este documento. El responsable debe publicarlo antes de la puesta en producción.',
    ],
];
