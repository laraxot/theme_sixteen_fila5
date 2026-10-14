<?php

declare(strict_types=1);

/*
 * Rechtliche Seiten aus dem Text der Gemeinde (Datenschutzerklärung, Rechtliche Hinweise, Media Policy; DCP-130/131). Den
 * eigentlichen Text liefert die Gemeinde: diese Texte sind nur der Rahmen und der Hinweis bei fehlendem oder unvollständigem Text.
 */
return [
    'home' => 'Startseite',
    'documents' => [
        'privacy' => ['title' => 'Datenschutzerklärung'],
        'legal_notes' => ['title' => 'Rechtliche Hinweise'],
        'media_policy' => ['title' => 'Media Policy'],
    ],
    'incomplete' => [
        'title' => 'Text noch nicht vollständig',
        'intro_missing' => 'Der Verantwortliche muss die folgenden Angaben vor dem Produktivbetrieb noch liefern.',
        'intro_present' => 'Der Text unten ist unvollständig: Der Verantwortliche muss die folgenden Angaben vor dem Produktivbetrieb noch liefern oder ergänzen.',
        'document_missing' => 'Die Gemeinde hat den Text dieses Dokuments noch nicht geliefert. Der Verantwortliche muss ihn vor dem Produktivbetrieb veröffentlichen.',
    ],
];
