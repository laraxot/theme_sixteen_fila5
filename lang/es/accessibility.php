<?php

declare(strict_types=1);

/*
 * Declaración de accesibilidad (Ley 4/2004 art. 3-quater; DCP-132): marco y textos fijos de la página. Estado de conformidad, fechas,
 * partes no accesibles y contactos NO están aquí: los aporta el Ayuntamiento en el JSON `accessibilita.index` (bloque accessibility-statement).
 */
return [
    'home' => 'Inicio',
    'page' => [
        'title' => ['text' => 'Declaración de accesibilidad'],
    ],
    'page' => ['title' => ['text' => 'Declaración de accesibilidad']],
    'title' => [
        'text' => 'Declaración de accesibilidad',
        'label' => 'Declaración de accesibilidad',
    ],
    'lead' => 'Declaración hecha conforme al art. 3-quater de la ley italiana n.º 4 de 9 de enero de 2004.',
    'incomplete' => [
        'title' => 'Declaración aún incompleta',
        'intro' => 'El Ayuntamiento debe aportar todavía los datos siguientes antes de la puesta en producción. Hasta entonces esta declaración no es válida.',
    ],
    'status' => [
        'title' => 'Estado de conformidad',
        'compliant' => 'Este sitio web es conforme con los requisitos de accesibilidad de la ley italiana n.º 4 de 9 de enero de 2004.',
        'partially_compliant' => 'Este sitio web es parcialmente conforme con los requisitos de accesibilidad de la ley italiana n.º 4 de 9 de enero de 2004.',
        'non_compliant' => 'Este sitio web no es conforme con los requisitos de accesibilidad de la ley italiana n.º 4 de 9 de enero de 2004.',
        'pending' => 'Aún no determinado: el Ayuntamiento indicará el estado tras la evaluación de accesibilidad.',
    ],
    'content' => [
        'title' => 'Contenidos no accesibles',
        'non_accessible' => 'Partes que no cumplen la ley',
        'disproportionate_burden' => 'Carga desproporcionada',
        'out_of_scope' => 'Contenidos fuera del ámbito de aplicación de la ley',
        'reason' => 'Motivo',
        'none' => 'El Ayuntamiento no declara contenidos no accesibles.',
        'pending' => 'A indicar por el Ayuntamiento.',
    ],
    'drafting' => [
        'title' => 'Elaboración de la declaración',
        'method' => 'Método de evaluación',
        'methods' => ['self' => 'Autoevaluación', 'third_party' => 'Evaluación de terceros'],
        'evaluation_date' => 'Fecha de la evaluación',
        'published_at' => 'Fecha de publicación',
        'updated_at' => 'Última actualización',
        'pending' => 'Aún no indicado',
        'agid' => 'Declaración elaborada en la plataforma de la AgID',
    ],
    'feedback' => [
        'title' => 'Comentarios y contacto',
        'intro' => 'Para comunicar un problema de accesibilidad de este sitio o pedir información, usa el formulario de abajo.',
        'jump' => 'Comunica un problema de accesibilidad',
        'email' => 'También puedes escribir a',
        'pending' => 'El Ayuntamiento indicará la dirección para las comunicaciones.',
    ],
    'procedure' => [
        'title' => 'Procedimiento de aplicación',
        'text' => 'Si no recibes respuesta en treinta días, o la respuesta no es satisfactoria, puedes iniciar el procedimiento de aplicación ante el defensor cívico digital de la AgID (ley 4/2004, art. 3-quinquies).',
        'link' => 'Procedimiento de aplicación (AgID)',
    ],
];
