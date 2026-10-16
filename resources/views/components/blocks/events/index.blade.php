@props(['data' => []])

{{--
  Caller: CMS events.index content_blocks → pub_theme::components.blocks.events.index. Schema: articles content_type=event + is_featured. User: completa /it/events.
  DC ref: sito/eventi.html (hero, evidenza, esplora+search).
--}}
@php
    $composer = app(\Modules\Blog\View\Composers\ThemeComposer::class);
    $featured = $composer->featuredEvents(6);
    $featuredIds = $featured->pluck('id')->filter()->all();
    $events = $composer->paginatedEvents(9);
    // Exclude featured events from paginated list (design-comuni pattern: no duplication)
    if (!empty($featuredIds)) {
        $events->setCollection(
            $events->getCollection()
                ->reject(fn ($item): bool => $item !== null && in_array($item->getKey(), $featuredIds, true))
                ->values()
        );
    }
    $localize = static fn (string $path): string => \LaravelLocalization::localizeURL($path);
    $sprite = '/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg';
    $search = trim((string) request()->query('q', ''));
    $periodFilter = trim((string) request()->query('periodo', ''));
    $dateFilter = trim((string) request()->query('data', ''));
    $eventsUrl = $localize('/events');

    $renderCard = static function ($event) use ($localize): ?array {
        if (! $event instanceof \Modules\Blog\Models\Article) {
            return null;
        }
        $title = (string) $event->getAttribute('title') ?? '';
        $excerpt = (string) (($event->getAttribute('excerpt') ?: $event->getAttribute('description') ?: '') ?? '');
        $image = (string) $event->getAttribute('main_image_url') ?? '';
        $category = $event->category?->getAttribute('name') ?: $event->category?->getAttribute('title');
        $slug = (string) $event->getAttribute('slug') ?? '';
        $url = $localize('/events/'.$slug);
        $start = filled($event->event_start_date)
            ? \Illuminate\Support\Carbon::parse($event->event_start_date)
            : null;
        $end = filled($event->event_end_date)
            ? \Illuminate\Support\Carbon::parse($event->event_end_date)
            : null;
        $categoryLabel = is_string($category) && $category !== ''
            ? strtoupper($category)
            : 'EVENTI';
        $period = $start?->translatedFormat('j F Y, H:i');
        if ($end && $start) {
            $period .= ' – '.$end->translatedFormat('j F Y, H:i');
        }

        return compact('title', 'excerpt', 'image', 'url', 'start', 'period', 'categoryLabel');
    };

    $resultCount = method_exists($events, 'total') ? (int) $events->total() : $events->count();
    $currentPage = method_exists($events, 'currentPage') ? (int) $events->currentPage() : 1;
    $lastPage = method_exists($events, 'lastPage') ? (int) $events->lastPage() : 1;
    $pageUrl = static fn (int $page): string => $events->url($page);
    $parityData = array_replace_recursive([
        'feedback' => [
            'title' => 'Quanto sono chiare le informazioni su questa pagina?',
            'legend' => 'Valuta da 1 a 5 stelle la pagina',
            'star_label' => 'Valuta %d stelle su 5',
            'thanks' => 'Grazie, il tuo parere ci aiuterà a migliorare il servizio!',
            'positive' => ['question' => 'Quali sono stati gli aspetti che hai preferito?', 'answers' => []],
            'negative' => ['question' => 'Dove hai incontrato le maggiori difficoltà?', 'answers' => []],
            'detail' => ['question' => 'Vuoi aggiungere altri dettagli?', 'label' => 'Dettaglio', 'help' => 'Inserire massimo 200 caratteri'],
            'back' => 'Indietro',
            'next' => 'Avanti',
        ],
        'contacts' => [
            'main' => ['title' => 'Contatta il comune', 'items' => [
                ['icon' => 'it-help-circle', 'label' => 'Leggi le domande frequenti', 'url' => '#'],
                ['icon' => 'it-mail', 'label' => 'Richiedi assistenza', 'url' => '#', 'element' => 'contacts'],
                ['icon' => 'it-hearing', 'label' => 'Chiama il numero verde 05 0505', 'url' => '#'],
                ['icon' => 'it-calendar', 'label' => 'Prenota appuntamento', 'url' => '#', 'element' => 'appointment-booking'],
            ]],
            'problems' => ['title' => 'Problemi in città', 'items' => [
                ['icon' => 'it-map-marker-circle', 'label' => 'Segnala disservizio', 'url' => '#'],
            ]],
        ],
    ], $data);
@endphp
<div class="container" id="main-container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <div class="cmp-breadcrumbs" role="navigation">
                <nav class="breadcrumb-container" aria-label="breadcrumb">
                    <ol class="breadcrumb p-0" data-element="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ $localize('/') }}">{{ $data['home_label'] ?? 'Home' }}</a>
                            <span class="separator">/</span>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $data['title'] ?? 'Eventi' }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <div class="cmp-hero">
                <section class="it-hero-wrapper bg-white align-items-start">
                    <div class="it-hero-text-wrapper pt-0 ps-0 pb-4 pb-lg-70">
                        <h1 class="text-black" data-element="page-name">{{ $data['title'] ?? 'Eventi' }}</h1>
                        <div class="hero-text">
                            <p>{{ $data['intro'] ?? '' }}</p>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>

@if ($featured->isNotEmpty())
    <div class="bg-grey-dsk py-5">
        <div class="container">
            <h2 class="mb-4">{{ $data['featured_title'] ?? 'Eventi in evidenza' }}</h2>
            <div class="row g-4">
                @foreach ($featured as $event)
                    @php($card = $renderCard($event))
                    @continue($card === null)
                    <div class="col-lg-6 col-xl-4">
                        <div class="card-wrapper border border-light rounded shadow-sm">
                            <div class="card no-after rounded">
                                @if ($card['image'] !== '')
                                    <div class="img-responsive-wrapper">
                                        <div class="img-responsive img-responsive-panoramic">
                                            <figure class="img-wrapper">
                                                <img src="{{ $card['image'] }}" title="{{ $card['title'] }}" alt="{{ $card['title'] }}" loading="lazy">
                                            </figure>
                                            @if ($card['start'])
                                                <div class="card-calendar d-flex flex-column justify-content-center">
                                                    <span class="card-date">{{ $card['start']->format('d') }}</span>
                                                    <span class="card-day">{{ $card['start']->translatedFormat('M') }}</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                                <div class="card-body">
                                    <div class="category-top">
                                        <a class="category text-decoration-none" href="{{ $card['url'] }}">{{ $card['categoryLabel'] }}</a>
                                        @if ($card['period'] && $card['start'])
                                            <time class="data" datetime="{{ $card['start']->toIso8601String() }}">{{ $card['period'] }}</time>
                                        @endif
                                    </div>
                                    <h3 class="card-title">
                                        <a href="{{ $card['url'] }}" class="text-decoration-none">{{ $card['title'] }}</a>
                                    </h3>
                                    @if ($card['excerpt'] !== '')
                                        <p class="card-text text-secondary pb-3">{{ $card['excerpt'] }}</p>
                                    @endif
                                    <a class="read-more t-primary text-uppercase" href="{{ $card['url'] }}" aria-label="{{ ($data['read_more'] ?? 'Leggi tutto').': '.$card['title'] }}">
                                        <span class="text">{{ $data['read_more'] ?? 'Leggi tutto' }}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif

<div class="container py-5">
    <h2 class="mb-4">{{ $data['explore_title'] ?? 'Tutti gli eventi' }}</h2>
    <div class="row g-4" aria-live="polite">
        @forelse ($events as $event)
            @php($card = $renderCard($event))
            @continue($card === null)
            <div class="col-lg-6 col-xl-4">
                <div class="card-wrapper border border-light rounded shadow-sm">
                    <div class="card no-after rounded">
                        @if ($card['image'] !== '')
                            <div class="img-responsive-wrapper">
                                <div class="img-responsive img-responsive-panoramic">
                                    <figure class="img-wrapper">
                                        <img src="{{ $card['image'] }}" title="{{ $card['title'] }}" alt="{{ $card['title'] }}" loading="lazy">
                                    </figure>
                                    @if ($card['start'])
                                        <div class="card-calendar d-flex flex-column justify-content-center">
                                            <span class="card-date">{{ $card['start']->format('d') }}</span>
                                            <span class="card-day">{{ $card['start']->translatedFormat('M') }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                        <div class="card-body">
                            <div class="category-top">
                                <a class="category text-decoration-none" href="{{ $card['url'] }}">{{ $card['categoryLabel'] }}</a>
                                @if ($card['period'] && $card['start'])
                                    <time class="data" datetime="{{ $card['start']->toIso8601String() }}">{{ $card['period'] }}</time>
                                @endif
                            </div>
                            <h3 class="card-title">
                                <a href="{{ $card['url'] }}" class="text-decoration-none">{{ $card['title'] }}</a>
                            </h3>
                            @if ($card['excerpt'] !== '')
                                <p class="card-text text-secondary pb-3">{{ $card['excerpt'] }}</p>
                            @endif
                            <a class="read-more t-primary text-uppercase" href="{{ $card['url'] }}" aria-label="{{ ($data['read_more'] ?? 'Leggi tutto').': '.$card['title'] }}">
                                <span class="text">{{ $data['read_more'] ?? 'Leggi tutto' }}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info" role="status">{{ $data['empty'] ?? 'Non ci sono ancora eventi pubblicati.' }}</div>
            </div>
        @endforelse
    </div>

    @if ($events->hasPages())
        <nav class="pagination-wrapper justify-content-center mt-5" aria-label="{{ $data['pagination_label'] ?? 'Paginazione degli eventi' }}">
            {{ $events->onEachSide(1)->links() }}
        </nav>
    @endif
</div>
