<?php

declare(strict_types=1);

return array_replace_recursive(require __DIR__.'/../en/header.php', [
    'guest' => ['login' => ['label' => 'Anmelden'], 'register' => ['label' => 'Registrieren'], 'cta' => ['label' => 'Persönlicher Bereich', 'help' => 'Zum persönlichen Bereich.']],
    'center' => ['brand' => ['title' => ['label' => 'Meine Gemeinde'], 'tagline' => ['label' => 'Eine Gemeinde zum Leben']], 'search' => ['label' => 'Suchen', 'toggle_aria' => ['label' => 'Website durchsuchen']], 'nav' => ['toggle_aria' => ['label' => 'Navigation anzeigen oder ausblenden'], 'close_aria' => ['label' => 'Navigation schließen'], 'primary_aria' => ['label' => 'Hauptnavigation'], 'secondary_aria' => ['label' => 'Sekundärnavigation'], 'amministrazione' => ['label' => 'Verwaltung'], 'novita' => ['label' => 'Nachrichten'], 'servizi' => ['label' => 'Dienste'], 'argomenti' => ['label' => 'Alle Themen']]],
    'language' => ['active_prefix' => ['label' => 'Aktuelle Sprache:'], 'code_it' => ['label' => 'ITA'], 'code_en' => ['label' => 'ENG'], 'selected_suffix' => ['label' => 'ausgewählt']],
]);
