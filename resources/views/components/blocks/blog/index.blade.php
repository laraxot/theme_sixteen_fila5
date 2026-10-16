{{--
  Callers: config/local/fixcity/database/content/pages/blog.index.json
  → content_blocks[*].data.view = pub_theme::components.blocks.blog.index
  Ref Design Comuni: sito/lista-risorse.html (HTML ≥90% / visual ≥95%, no header/footer).
  Schema: CMS $data + ThemeComposer Article(post). No writes.
--}}
@props(['data' => []])

@php
    $composer = app(\Modules\Blog\View\Composers\ThemeComposer::class);
    $localize = static fn (string $path): string => \LaravelLocalization::localizeURL($path);
    $assets = \Themes\Sixteen\Support\DesignComuniAssets::base();
    $sprite = $assets.'/bootstrap-italia/dist/svg/sprites.svg';
    $search = trim((string) request()->query('q', ''));
    $categorySlug = trim((string) request()->query('categoria', ''));
    $featured = $composer->featuredBlogPosts(3);
    $featuredIds = $featured->pluck('id')->filter()->values()->all();
    $posts = $composer->paginatedBlogPosts(9, $search !== '' ? $search : null, $categorySlug !== '' ? $categorySlug : null);
    // Escludi featured dalla lista (Design Comuni). Mai transform→null senza setCollection.
    if ($featuredIds !== [] && $search === '' && $categorySlug === '') {
        $posts->setCollection(
            $posts->getCollection()
                ->reject(static fn ($item): bool => $item instanceof \Modules\Blog\Models\Article
                    && in_array($item->getKey(), $featuredIds, true))
                ->values()
        );
    }
    $blogIndexUrl = $localize('/blog');

    $renderCard = static function ($post) use ($localize): ?array {
        if (! $post instanceof \Modules\Blog\Models\Article) {
            return null;
        }
        $title = (string) $post->getAttribute('title');
        $excerpt = (string) ($post->getAttribute('excerpt') ?: $post->getAttribute('description') ?: '');
        $image = (string) $post->getAttribute('main_image_url');
        $category = $post->category?->getAttribute('name') ?: $post->category?->getAttribute('title');
        $slug = (string) $post->getAttribute('slug');
        $url = $localize('/blog/'.$slug);
        // Ref lista-risorse: "28 FEB 2023" (giorno senza zero, mese abbr. maiuscolo)
        $date = $post->published_at?->translatedFormat('j M Y');
        $date = is_string($date) ? strtoupper($date) : '';
        $categoryLabel = is_string($category) && $category !== ''
            ? strtoupper($category)
            : 'NOTIZIE';
        $categorySlugAttr = $post->category?->getAttribute('slug');
        $categoryUrl = $categorySlugAttr
            ? $localize('/blog').'?categoria='.urlencode((string) $categorySlugAttr)
            : $url;

        return compact('title', 'excerpt', 'image', 'url', 'date', 'categoryLabel', 'categoryUrl');
    };

    $resultCount = method_exists($posts, 'total') ? (int) $posts->total() : $posts->count();
    $currentPage = method_exists($posts, 'currentPage') ? (int) $posts->currentPage() : 1;
    $lastPage = method_exists($posts, 'lastPage') ? max(1, (int) $posts->lastPage()) : 1;
    $pageUrl = static fn (int $page): string => $posts->url($page);
    $statusLabel = $resultCount === 1
        ? '1 novità trovata'
        : $resultCount.' novità trovate';

    $parityData = array_replace_recursive(config('sixteen.blog.parity', []), is_array($data['parity'] ?? null) ? $data['parity'] : []);
    foreach (['main', 'problems'] as $group) {
        $parityData['contacts'][$group]['items'] = array_map(
            static function (array $contact) use ($localize): array {
                $url = (string) ($contact['url'] ?? '#');
                $contact['url'] = $url === '#' || str_starts_with($url, '#') || str_starts_with($url, 'http') ? $url : $localize($url);

                return $contact;
            },
            $parityData['contacts'][$group]['items'] ?? [],
        );
    }
@endphp

{{-- Breadcrumb: id main-container resta su <main> (skiplink); niente id duplicato. --}}
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <div class="cmp-breadcrumbs" role="navigation">
                <nav class="breadcrumb-container" aria-label="breadcrumb">
                    <ol class="breadcrumb p-0" data-element="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ $localize('/') }}">{{ $data['home_label'] ?? 'Home' }}</a>
                            <span class="separator">/</span>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $data['title'] ?? 'Novità' }}</li>
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
                        <h1 class="text-black" data-element="page-name">{{ $data['title'] ?? 'Novità' }}</h1>
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
                            <svg class="icon icon-sm icon-primary"><use href="{{ $sprite }}#it-search"></use></svg>
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
                        <a class="page-link" href="{{ $currentPage > 1 ? $pageUrl($currentPage - 1) : '#' }}" tabindex="{{ $currentPage <= 1 ? '-1' : '0' }}" @if ($currentPage <= 1) aria-hidden="true" @endif>
                            <svg class="icon icon-primary"><use href="{{ $sprite }}#it-chevron-left"></use></svg>
                            <span class="visually-hidden">Pagina precedente</span>
                        </a>
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
                        <a class="page-link" href="{{ $currentPage < $lastPage ? $pageUrl($currentPage + 1) : '#' }}" @if ($currentPage >= $lastPage) aria-hidden="true" @endif>
                            <span class="visually-hidden">Pagina successiva</span>
                            <svg class="icon icon-primary"><use href="{{ $sprite }}#it-chevron-right"></use></svg>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>

@include('pub_theme::components.blocks.partials.dc-rating', ['data' => $parityData])
@include('pub_theme::components.blocks.partials.dc-contacts', ['data' => $parityData])
