<?php

declare(strict_types=1);

return array_replace_recursive(require __DIR__.'/../en/header.php', [
    'guest' => ['login' => ['label' => 'Acceder'], 'register' => ['label' => 'Registrarse'], 'cta' => ['label' => 'Área personal', 'help' => 'Acceder al área personal.']],
    'center' => ['brand' => ['title' => ['label' => 'Mi Ayuntamiento'], 'tagline' => ['label' => 'Una ciudad para vivir']], 'search' => ['label' => 'Buscar', 'toggle_aria' => ['label' => 'Buscar en el sitio']], 'nav' => ['toggle_aria' => ['label' => 'Mostrar u ocultar la navegación'], 'close_aria' => ['label' => 'Cerrar navegación'], 'primary_aria' => ['label' => 'Navegación principal'], 'secondary_aria' => ['label' => 'Navegación secundaria'], 'amministrazione' => ['label' => 'Administración'], 'novita' => ['label' => 'Noticias'], 'servizi' => ['label' => 'Servicios'], 'argomenti' => ['label' => 'Todos los temas']]],
    'language' => ['active_prefix' => ['label' => 'Idioma actual:'], 'code_it' => ['label' => 'ITA'], 'code_en' => ['label' => 'ENG'], 'selected_suffix' => ['label' => 'seleccionado']],
]);
