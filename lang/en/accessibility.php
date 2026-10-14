<?php

declare(strict_types=1);

/*
 * Accessibility statement (Law 4/2004 art. 3-quater; DCP-132): frame and fixed texts of the page. Compliance status, dates,
 * inaccessible parts and contacts are NOT here: the municipality supplies them in the JSON `accessibilita.index` (block accessibility-statement).
 */
return [
    'home' => 'Home',
    'title' => 'Accessibility statement',
    'lead' => 'Statement made under art. 3-quater of Italian Law no. 4 of 9 January 2004.',
    'incomplete' => [
        'title' => 'Statement not complete yet',
        'intro' => 'The municipality still has to provide the following information before the service goes live. Until then this statement is not valid.',
    ],
    'status' => [
        'title' => 'Compliance status',
        'compliant' => 'This website is compliant with the accessibility requirements of Italian Law no. 4 of 9 January 2004.',
        'partially_compliant' => 'This website is partially compliant with the accessibility requirements of Italian Law no. 4 of 9 January 2004.',
        'non_compliant' => 'This website is not compliant with the accessibility requirements of Italian Law no. 4 of 9 January 2004.',
        'pending' => 'Not determined yet: the municipality will indicate the status after the accessibility evaluation.',
    ],
    'content' => [
        'title' => 'Inaccessible content',
        'non_accessible' => 'Parts that do not comply with the law',
        'disproportionate_burden' => 'Disproportionate burden',
        'out_of_scope' => 'Content outside the scope of the law',
        'reason' => 'Reason',
        'none' => 'The municipality declares no inaccessible content.',
        'pending' => 'To be provided by the municipality.',
    ],
    'drafting' => [
        'title' => 'Preparation of the statement',
        'method' => 'Evaluation method',
        'methods' => ['self' => 'Self-assessment', 'third_party' => 'Third-party assessment'],
        'evaluation_date' => 'Evaluation date',
        'published_at' => 'Publication date',
        'updated_at' => 'Last update',
        'pending' => 'Not provided yet',
        'agid' => 'Statement completed on the AgID platform',
    ],
    'feedback' => [
        'title' => 'Feedback and contacts',
        'intro' => 'To report an accessibility problem on this site or ask for information, use the form below.',
        'jump' => 'Report an accessibility problem',
        'email' => 'You can also write to',
        'pending' => 'The address for reports will be provided by the municipality.',
    ],
    'procedure' => [
        'title' => 'Enforcement procedure',
        'text' => 'If you get no reply within thirty days, or the reply is not satisfactory, you can start the enforcement procedure before the digital ombudsman at AgID (Law 4/2004, art. 3-quinquies).',
        'link' => 'Enforcement procedure (AgID)',
    ],
];
