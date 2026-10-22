{{--
  Callers: config/local/fixcity/database/content/pages/blog/index.json
  → content_blocks[*].data.view = pub_theme::components.blocks.blog.index
  Ref Design Comuni: sito/lista-risorse.html (HTML ≥90% / visual ≥95%, no header/footer).
  Schema: CMS $data + ThemeComposer Article(post). No writes.
--}}
@props(['data' => []])

@php
    $composer = app(\Modules\Blog\View\Composers\ThemeComposer::class);
    $cmsUrl = static fn (string $path): string => \Themes\Sixteen\Infrastructure\Url\FrontofficeUrl::fromStoredUrl($path);
    $search = trim((string) request()->query('q', ''));
    $categorySlug = trim((string) request()->query('categoria', ''));
    $featured = $composer->featuredBlogPosts(3);
    $featuredIds = $featured->pluck('id')->filter()->values()->all();
    // Ref lista-risorse: 3 evidenza + 6 explore. Fetch ampio, poi reject featured e take(6).
    $posts = $composer->paginatedBlogPosts(12, $search !== '' ? $search : null, $categorySlug !== '' ? $categorySlug : null);
    // Escludi featured dalla lista (Design Comuni). Mai transform→null senza setCollection.
    if ($featuredIds !== [] && $search === '' && $categorySlug === '') {
        $posts->setCollection(
            $posts->getCollection()
                ->reject(static fn ($item): bool => $item instanceof \Modules\Blog\Models\Article
                    && in_array($item->getKey(), $featuredIds, true))
                ->take(6)
                ->values()
        );
    }
    $blogIndexUrl = route('container0.index', ['container0' => 'blog']);

    $renderCard = static function ($post) use ($blogIndexUrl): ?array {
        if (! $post instanceof \Modules\Blog\Models\Article) {
            return null;
        }
        $title = $post->getTitle();
        if ($title === '') {
            return null;
        }
        $excerpt = (string) ($post->getAttribute('excerpt') ?: $post->getAttribute('description') ?: '');
        $image = (string) $post->getAttribute('main_image_url');
        $category = $post->category?->getAttribute('name') ?: $post->category?->getAttribute('title');
        $slug = (string) $post->getAttribute('slug');
        $url = route('container0.view', ['container0' => 'blog', 'slug0' => $slug]);
        // Ref lista-risorse: "28 FEB 2023" (giorno senza zero, mese abbr. maiuscolo)
        $date = $post->published_at?->translatedFormat('j M Y');
        $date = is_string($date) ? strtoupper($date) : '';
        $categoryLabel = is_string($category) && $category !== ''
            ? strtoupper($category)
            : 'NOTIZIE';
        $categorySlugAttr = $post->category?->getAttribute('slug');
        $categoryUrl = $categorySlugAttr
            ? $blogIndexUrl.'?categoria='.urlencode((string) $categorySlugAttr)
            : $url;

        return compact('title', 'excerpt', 'image', 'url', 'date', 'categoryLabel', 'categoryUrl');
    };

    $resultCount = method_exists($posts, 'total') ? (int) $posts->total() : $posts->count();
    $currentPage = method_exists($posts, 'currentPage') ? (int) $posts->currentPage() : 1;
    $lastPage = method_exists($posts, 'lastPage') ? max(1, (int) $posts->lastPage()) : 1;
    $pageUrl = static fn (int $page): string => $posts->url($page);
    // Ref: "62 notizie trovate in ordine alfabetico"
    $statusLabel = $resultCount === 1
        ? '1 notizia trovata'
        : $resultCount.' notizie trovate';

    // CMS JSON (feedback/contacts) > parity nest > config tema (se caricata).
    $parityFromConfig = config('sixteen.sixteen.blog.parity')
        ?? config('sixteen.blog.parity')
        ?? [];
    $parityData = array_replace_recursive(
        is_array($parityFromConfig) ? $parityFromConfig : [],
        array_filter([
            'feedback' => is_array($data['feedback'] ?? null) ? $data['feedback'] : null,
            'contacts' => is_array($data['contacts'] ?? null) ? $data['contacts'] : null,
        ]),
        is_array($data['parity'] ?? null) ? $data['parity'] : [],
    );
    foreach (['main', 'problems'] as $group) {
        $parityData['contacts'][$group]['items'] = array_map(
            static function (array $contact) use ($cmsUrl): array {
                $url = (string) ($contact['url'] ?? '#');
                $contact['url'] = $url === '#' || str_starts_with($url, '#') || str_starts_with($url, 'http') || str_starts_with($url, 'tel:') ? $url : $cmsUrl($url);

                return $contact;
            },
            $parityData['contacts'][$group]['items'] ?? [],
        );
    }
@endphp

<style>
    main[data-page="lista-risorse"] .row.g-4 { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 1.5rem; }
    main[data-page="lista-risorse"] .row.g-4 > [class*="col-"] { width: auto; max-width: none; padding: 0; }
    main[data-page="lista-risorse"] .img-responsive-panoramic img { width: 100% !important; height: 12rem !important; object-fit: cover !important; display: block !important; }
    main[data-page="lista-risorse"] .cmp-input-search .input-group { position: relative; display: flex; align-items: stretch; }
    main[data-page="lista-risorse"] .cmp-input-search .form-control { padding-left: 2.5rem !important; }
    main[data-page="lista-risorse"] .cmp-input-search .autocomplete-icon { position: absolute; left: 0.65rem; top: 50%; width: 1.25rem; height: 1.25rem; transform: translateY(-50%); pointer-events: none; z-index: 1; overflow: hidden; }
    main[data-page="lista-risorse"] .cmp-input-search .autocomplete-icon svg { width: 1.25rem; height: 1.25rem; display: block; }
    main[data-page="lista-risorse"] .card-wrapper { background: #fff; height: 100%; }
    main[data-page="lista-risorse"] .card-title,
    main[data-page="lista-risorse"] .card-title a,
    main[data-page="lista-risorse"] .category { color: #007a52; text-decoration: none; }
    main[data-page="lista-risorse"] .card-title { font-size: 1.25rem; line-height: 1.3; margin: 0 0 0.5rem; }
    main[data-page="lista-risorse"] .card-text { color: #5c6f82; }
    main[data-page="lista-risorse"] .bg-grey-card { background: #eceff1; }
    main[data-page="lista-risorse"] .pagination { display: flex; gap: 0.5rem; list-style: none; padding: 0; justify-content: center; }
    main[data-page="lista-risorse"] .page-link { color: #007a52; }
    @media (max-width: 768px) {
        main[data-page="lista-risorse"] .row.g-4 { grid-template-columns: 1fr; }
    }
</style>

{{-- Breadcrumb: id main-container resta su <main> (skiplink); niente id duplicato. --}}
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <div class="cmp-breadcrumbs" role="navigation">
                <nav class="breadcrumb-container" aria-label="breadcrumb">
                    <ol class="breadcrumb p-0" data-element="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">{{ $data['home_label'] ?? __('pub_theme::navigation.home') }}</a>
                            <span class="separator">/</span>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $data['title'] ?? __('pub_theme::navigation.homepage.news') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center row-shadow">
        <div class="col-12 col-lg-10">
            <div class="cmp-hero">
                <section class="it-hero-wrapper bg-white align-items-start">
                    <div class="it-hero-text-wrapper pt-0 ps-0 pb-4 pb-lg-60">
                        <h1 class="text-black" data-element="page-name">{{ $data['title'] ?? __('pub_theme::navigation.homepage.news') }}</h1>
                        <div class="hero-text">
                            <p>{{ $data['intro'] ?? '' }}</p>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>

@if ($featured->isNotEmpty() && $search === '' && $categorySlug === '')
    <div class="container py-5">
        <h2 class="title-xxlarge mb-4">{{ $data['featured_title'] ?? 'Notizie in evidenza' }}</h2>
        <div class="row g-4">
            @foreach ($featured as $post)
                @php($card = $renderCard($post))
                @continue($card === null)
                <div class="col-md-6 col-xl-4">
                    <div class="card-wrapper border border-light rounded shadow-sm">
                        <div class="card no-after rounded">
                            @if ($card['image'] !== '')
                                <div class="img-responsive-wrapper">
                                    <div class="img-responsive img-responsive-panoramic">
                                        <figure class="img-wrapper">
                                            <img src="{{ $card['image'] }}" title="{{ $card['title'] }}" alt="{{ $card['title'] }}">
                                        </figure>
                                    </div>
                                </div>
                            @endif
                            <div class="card-body">
                                <div class="category-top">
                                    <a class="category text-decoration-none" href="{{ $card['categoryUrl'] }}">{{ $card['categoryLabel'] }}</a>
                                    @if ($card['date'] !== '')
                                        <span class="data">{{ $card['date'] }}</span>
                                    @endif
                                </div>
                                <a href="{{ $card['url'] }}" class="text-decoration-none" data-element="news-category-link">
                                    <h3 class="card-title">{{ $card['title'] }}</h3>
                                </a>
                                @if ($card['excerpt'] !== '')
                                    <p class="card-text text-secondary">{{ $card['excerpt'] }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif

<div class="bg-grey-card py-5">
    <div class="container">
        <h2 class="title-xxlarge mb-4">{{ $data['explore_title'] ?? 'Esplora tutte le novità' }}</h2>

        <div class="cmp-input-search">
            <form method="get" action="{{ $blogIndexUrl }}" role="search">
                @if ($categorySlug !== '')
                    <input type="hidden" name="categoria" value="{{ $categorySlug }}">
                @endif
                <div class="form-group autocomplete-wrapper mb-0">
                    <div class="input-group">
                        <label for="autocomplete-autocomplete-three" class="visually-hidden">{{ $data['search_label'] ?? 'Cerca' }}</label>
                        <input
                            type="search"
                            class="autocomplete form-control"
                            placeholder="{{ $data['search_placeholder'] ?? 'Cerca per parola chiave' }}"
                            id="autocomplete-autocomplete-three"
                            name="q"
                            value="{{ $search }}"
                            data-bs-autocomplete="[]"
                        >
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit" id="button-3">
                                {{ $data['search_submit'] ?? 'Invio' }}
                            </button>
                        </div>
                        <span class="autocomplete-icon" aria-hidden="true">
                            <svg class="icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#5c6f82" stroke-width="2"><circle cx="11" cy="11" r="7"/><path d="M20 20l-3.5-3.5"/></svg>
                        </span>
                    </div>
                    <p id="autocomplete-label" class="u-grey-light text-paragraph-card mt-2 mb-30 mt-lg-3 mb-lg-40">{{ $statusLabel }}</p>
                </div>
            </form>
        </div>

        <div class="row g-4" aria-live="polite">
            @forelse ($posts as $post)
                @php($card = $renderCard($post))
                @continue($card === null)
                <div class="col-md-6 col-xl-4">
                    <div class="card-wrapper border border-light rounded shadow-sm">
                        <div class="card no-after rounded">
                            @if ($card['image'] !== '')
                                <div class="img-responsive-wrapper">
                                    <div class="img-responsive img-responsive-panoramic">
                                        <figure class="img-wrapper">
                                            <img class="" src="{{ $card['image'] }}" title="{{ $card['title'] }}" alt="{{ $card['title'] }}">
                                        </figure>
                                    </div>
                                </div>
                            @endif
                            <div class="card-body">
                                <div class="category-top">
                                    <a class="category text-decoration-none" href="{{ $card['categoryUrl'] }}">{{ $card['categoryLabel'] }}</a>
                                    @if ($card['date'] !== '')
                                        <span class="data">{{ $card['date'] }}</span>
                                    @endif
                                </div>
                                <a href="{{ $card['url'] }}" class="text-decoration-none" data-element="news-category-link">
                                    <h3 class="card-title">{{ $card['title'] }}</h3>
                                </a>
                                @if ($card['excerpt'] !== '')
                                    <p class="card-text text-secondary">{{ $card['excerpt'] }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="u-grey-light text-paragraph-card" role="status">{{ $data['empty'] ?? 'Non ci sono ancora novità pubblicate.' }}</p>
                </div>
            @endforelse
        </div>

        {{-- Ref lista-risorse: pagination sempre presente nella sezione explore --}}
        <div class="row my-4">
            <nav class="pagination-wrapper justify-content-center" aria-label="{{ $data['pagination_label'] ?? 'Paginazione delle novità' }}">
                <ul class="pagination">
                    <li class="page-item{{ $currentPage <= 1 ? ' disabled' : '' }}">
                        @if ($currentPage > 1)
                        <a class="page-link" href="{{ $pageUrl($currentPage - 1) }}" rel="prev">
                        @else
                        <span class="page-link" aria-disabled="true">
                        @endif
                            <svg class="icon" width="16" height="16" viewBox="0 0 24 24" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 6l-6 6 6 6"/></svg>
                            <span class="visually-hidden">Pagina precedente</span>
                        @if ($currentPage > 1)</a>@else</span>@endif
                    </li>
                    @foreach (range(1, min($lastPage, 3)) as $page)
                        <li class="page-item">
                            @if ($page === $currentPage)
                                <a class="page-link" href="{{ $pageUrl($page) }}" aria-current="page">
                                    <span class="d-inline-block d-sm-none">Pagina </span>{{ $page }}
                                </a>
                            @else
                                <a class="page-link" href="{{ $pageUrl($page) }}">{{ $page }}</a>
                            @endif
                        </li>
                    @endforeach
                    <li class="page-item{{ $currentPage >= $lastPage ? ' disabled' : '' }}">
                        @if ($currentPage < $lastPage)
                        <a class="page-link" href="{{ $pageUrl($currentPage + 1) }}" rel="next">
                        @else
                        <span class="page-link" aria-disabled="true">
                        @endif
                            <span class="visually-hidden">Pagina successiva</span>
                            <svg class="icon" width="16" height="16" viewBox="0 0 24 24" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 6l6 6-6 6"/></svg>
                        @if ($currentPage < $lastPage)</a>@else</span>@endif
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>

@include('pub_theme::components.blocks.partials.dc-rating', ['data' => $parityData])
@include('pub_theme::components.blocks.partials.dc-contacts', ['data' => $parityData])
