@props(['data' => []])

@php
    $title = (string) ($data['title'] ?? 'Documenti e Dati');
    $intro = (string) ($data['intro'] ?? '');
    $featuredTitle = (string) ($data['featured_title'] ?? 'In evidenza');
    $exploreTitle = (string) ($data['explore_title'] ?? 'Esplora i documenti');
    $categoriesTitle = (string) ($data['categories_title'] ?? 'Esplora per categoria');
    $searchPlaceholder = (string) ($data['search_placeholder'] ?? 'Cerca per parola chiave');
    $searchCount = (string) ($data['search_count'] ?? '');
    $featured = is_array($data['featured'] ?? null) ? $data['featured'] : [];
    $documents = is_array($data['documents'] ?? null) ? $data['documents'] : [];
    $categories = is_array($data['categories'] ?? null) ? $data['categories'] : [];
    $breadcrumb = is_array($data['breadcrumb'] ?? null) ? $data['breadcrumb'] : [];
    $searchTerms = array_map(static fn (array $document): string => mb_strtolower(($document['title'] ?? '').' '.($document['description'] ?? '')), $documents);
@endphp

<div class="dc-documents-page" x-data="{ query: '', visible: true, matches: {{ count($documents) }}, terms: @js($searchTerms) }">
    <div class="container dc-documents-container">
        <nav class="dc-breadcrumb" aria-label="{{ __('pub_theme::blocks_content.shared.breadcrumb.label') }}">
            <ol>
                @foreach ($breadcrumb as $item)
                    <li><a href="{{ $item['url'] ?? '#' }}">{{ $item['label'] ?? '' }}</a><span aria-hidden="true">/</span></li>
                @endforeach
                <li aria-current="page">{{ $title }}</li>
            </ol>
        </nav>
    </div>

    <section class="dc-documents-hero" aria-labelledby="documents-title">
        <div class="container dc-documents-container">
            <h1 id="documents-title">{{ $title }}</h1>
            <p>{{ $intro }}</p>
        </div>
    </section>

    <section class="dc-documents-section container" aria-labelledby="featured-title">
        <h2 id="featured-title">{{ $featuredTitle }}</h2>
        <div class="dc-documents-grid">
            @foreach ($featured as $document)
                <article class="dc-document-card">
                    <div class="dc-document-card__type">
                        <x-ui.icon name="it-files" class="dc-document-card__icon" aria-hidden="true" />
                        <span>{{ $document['type'] ?? 'Documento' }}</span>
                    </div>
                    <h3><a href="{{ $document['url'] ?? '#' }}">{{ $document['title'] ?? '' }}</a></h3>
                    <p>{{ $document['description'] ?? '' }}</p>
                </article>
            @endforeach
        </div>
    </section>

    <section class="dc-documents-explore" aria-labelledby="explore-title">
        <div class="container dc-documents-container">
            <h2 id="explore-title">{{ $exploreTitle }}</h2>
            <form class="dc-documents-search" role="search" @submit.prevent="visible = true" @input="matches = terms.filter(term => term.includes(query.toLowerCase())).length">
                <label class="sr-only" for="documents-query">{{ $searchPlaceholder }}</label>
                <x-ui.icon name="it-search" class="dc-documents-search__icon" aria-hidden="true" />
                <input id="documents-query" type="search" x-model="query" placeholder="{{ $searchPlaceholder }}" />
                <button type="submit">{{ $data['search_button'] ?? 'Invio' }}</button>
            </form>
            <p class="dc-documents-count" x-show="visible">{{ $searchCount }}</p>
            <div class="dc-documents-grid">
                @foreach ($documents as $document)
                    <article class="dc-document-card" x-show="!query || terms[{{ $loop->index }}].includes(query.toLowerCase())">
                        <div class="dc-document-card__type">
                            <x-ui.icon name="it-files" class="dc-document-card__icon" aria-hidden="true" />
                            <span>{{ $document['type'] ?? 'Documento' }}</span>
                        </div>
                        <h3><a href="{{ $document['url'] ?? '#' }}">{{ $document['title'] ?? '' }}</a></h3>
                        <p>{{ $document['description'] ?? '' }}</p>
                    </article>
                @endforeach
            </div>
            <p class="dc-documents-empty" x-show="query && matches === 0">{{ $data['empty_label'] ?? 'Nessun altro risultato' }}</p>
        </div>
    </section>

    <section class="dc-documents-section container" aria-labelledby="categories-title">
        <h2 id="categories-title">{{ $categoriesTitle }}</h2>
        <div class="dc-documents-grid">
            @foreach ($categories as $category)
                <article class="dc-category-card">
                    <h3><a href="{{ $category['url'] ?? '#' }}">{{ $category['title'] ?? '' }}</a></h3>
                    <p>{{ $category['description'] ?? '' }}</p>
                </article>
            @endforeach
        </div>
    </section>
</div>
