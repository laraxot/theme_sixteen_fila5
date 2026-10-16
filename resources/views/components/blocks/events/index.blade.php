{{--
  Callers: CMS events.index → pub_theme::components.blocks.events.index
  (Cms page.blade.php include via content_blocks view). Unique FO events listing.
  Reads: ThemeComposer Article(event) + CMS $data / config sixteen.events.parity. No writes.
  User: «devi sempre correggere… migliorare… senza conferma» + parity Design Comuni eventi.
--}}
@props(['data' => []])

@php
    $composer = app(\Modules\Blog\View\Composers\ThemeComposer::class);
    $localize = static fn (string $path): string => \LaravelLocalization::localizeURL($path);
    $parity = array_replace_recursive(
        [
            'title' => 'Vivere il comune',
            'hero' => [
                'text' => 'Tutti gli eventi, le iniziative e i luoghi d’interesse per scoprire e vivere il territorio comunale.',
                'image' => ['file' => 'roma-colosseo.png', 'title' => 'Colosseo, Roma', 'alt' => 'Colosseo di Roma'],
                'caption' => 'Colosseo, Roma. Foto di Griffin Wooldridge.',
            ],
            'card' => ['read_more' => 'Leggi di più', 'read_more_aria' => 'Leggi di più sulla pagina di %s', 'read_more_hidden' => ''],
            'locations' => [
                ['image' => ['file' => 'luoghi-castello-1.png', 'title' => 'Il castello normanno', 'alt' => 'Il castello normanno'], 'title' => 'Il castello normanno', 'text' => 'Scopri la storia e i luoghi di interesse del territorio.'],
                ['image' => ['file' => 'luoghi-castello-2.png', 'title' => 'Il castello normanno', 'alt' => 'Il castello normanno'], 'title' => 'Il castello normanno', 'text' => 'Scopri il programma degli eventi dell’estate.'],
                ['image' => ['file' => 'luoghi-castello-3.png', 'title' => 'Il castello normanno', 'alt' => 'Il castello normanno'], 'title' => 'Il castello normanno', 'text' => 'Un luogo da vivere e conoscere.'],
                ['image' => ['file' => 'luoghi-gipsoteca.png', 'title' => 'La Gipsoteca canoviana', 'alt' => 'La Gipsoteca canoviana'], 'title' => 'La Gipsoteca canoviana', 'text' => 'Modelli in gesso e bozzetti dello scultore Antonio Canova.'],
                ['image' => ['file' => 'luoghi-tomba.png', 'title' => 'Tomba Brion', 'alt' => 'Tomba Brion'], 'title' => 'Tomba Brion', 'text' => 'Un luogo affascinante e ricco di simbologia.'],
                ['image' => ['file' => 'luoghi-castello-4.png', 'title' => 'Il castello normanno', 'alt' => 'Il castello normanno'], 'title' => 'Il castello normanno', 'text' => 'Un itinerario per scoprire il territorio.'],
            ],
        ],
        config('sixteen.events.parity', []),
        is_array($data['parity'] ?? null) ? $data['parity'] : [],
        is_array($data) ? $data : [],
    );
    $featured = $composer->featuredEvents(6);
    $featuredIds = $featured->pluck('id')->filter()->values()->all();
    $events = $composer->paginatedEvents(9);
    if ($featuredIds !== []) {
        $events->setCollection(
            $events->getCollection()
                ->reject(static fn ($item): bool => $item instanceof \Modules\Blog\Models\Article
                    && in_array($item->getKey(), $featuredIds, true))
                ->values()
        );
    }

    $toCard = static function ($event) use ($localize): ?array {
        if (! $event instanceof \Modules\Blog\Models\Article) {
            return null;
        }
        $start = filled($event->event_start_date) ? \Illuminate\Support\Carbon::parse($event->event_start_date) : null;
        $title = (string) ($event->getAttribute('title') ?? '');
        $url = $localize('/events/'.(string) ($event->getAttribute('slug') ?? ''));
        $category = $event->category?->getAttribute('name') ?: $event->category?->getAttribute('title');
        $date = $start?->translatedFormat('j M Y');

        return [
            'image' => ['url' => (string) ($event->getAttribute('main_image_url') ?? ''), 'title' => $title, 'alt' => $title],
            'category' => ['label' => is_string($category) && $category !== '' ? strtoupper($category) : 'EVENTI', 'url' => $url],
            'title' => $title,
            'url' => $url,
            'text' => (string) ($event->getAttribute('excerpt') ?: $event->getAttribute('description') ?: ''),
            'read_more_url' => $url,
            'calendar' => $start ? ['date' => $start->format('d'), 'day' => $start->translatedFormat('F')] : null,
            'date' => is_string($date) ? strtoupper($date) : null,
        ];
    };

    $featuredItems = $featured->map($toCard)->filter()->values()->all();
    $exploreItems = collect($events->items())->map($toCard)->filter()->values()->all();
    $locationItems = is_array($parity['locations'] ?? null) ? $parity['locations'] : [];

    $sections = [];
    if ($featuredItems !== []) {
        $sections[] = [
            'style' => 'grey',
            'title' => $data['featured_title'] ?? 'Eventi in evidenza',
            'items' => $featuredItems,
        ];
    }
    $sections[] = [
        'style' => 'plain',
        'title' => $data['explore_title'] ?? 'Tutti gli eventi',
        'items' => $exploreItems,
        'empty' => $data['empty'] ?? 'Non ci sono ancora eventi pubblicati.',
    ];
    if ($locationItems !== []) {
        $sections[] = [
            'style' => 'plain',
            'title' => $data['locations_title'] ?? 'Luoghi in evidenza',
            'items' => $locationItems,
            'button' => ['label' => 'Tutti i luoghi', 'url' => '#', 'element' => 'live-button-locations'],
        ];
    }

    $pageData = array_replace_recursive($parity, [
        'title' => $data['title'] ?? ($parity['title'] ?? 'Vivere il comune'),
        'breadcrumb' => [
            'items' => [['label' => $data['home_label'] ?? 'Home', 'url' => $localize('/')]],
            'current' => $data['title'] ?? ($parity['title'] ?? 'Vivere il comune'),
        ],
        'sections' => $sections,
        'hero' => [
            'text' => $data['intro'] ?? ($parity['hero']['text'] ?? ''),
            'image' => $parity['hero']['image'] ?? ['file' => '', 'title' => '', 'alt' => ''],
            'caption' => $parity['hero']['caption'] ?? '',
        ],
        'card' => [
            'read_more' => $data['read_more'] ?? ($parity['card']['read_more'] ?? 'Leggi di più'),
            'read_more_aria' => $parity['card']['read_more_aria'] ?? 'Leggi di più: %s',
            'read_more_hidden' => $parity['card']['read_more_hidden'] ?? '',
        ],
    ]);
@endphp

@include('pub_theme::components.blocks.events-page.design-comuni', ['data' => $pageData])
