{{--
    Topics Highlight - Argomenti in evidenza + Siti tematici
    Reference: design-comuni-pagine-statiche/src/pages/sito/homepage.hbs .evidence-section
--}}
@props(['data' => []])
@php
    $title            = $data['title'] ?? 'Argomenti in evidenza';
    $background_image = $data['background_image'] ?? '';
    $items            = $data['items'] ?? [];
    $other_topics     = $data['other_topics'] ?? [];
    $show_all_url     = $data['show_all_url'] ?? '#';
    $show_all_label   = $data['show_all_label'] ?? 'Mostra tutti';
    $thematic_sites   = $data['thematic_sites'] ?? [];
@endphp

<section class="evidence-section">
    <div class="section py-5 pb-lg-80 px-lg-5 position-relative"
        @if($background_image) style="background-image: url({{ $background_image }})" @endif>
        <div class="container">
            <div class="row">
                <h2 class="text-white">{{ $title }}</h2>
            </div>
            <div>
                <div class="card-wrapper card-teaser-wrapper card-teaser-wrapper-equal card-teaser-block-3">
                    @foreach($items as $item)
                    <div class="card card-teaser no-after rounded shadow-sm border border-light">
                        <div class="card-body pb-5">
                            <h3 class="card-title">{{ $item['title'] ?? '' }}</h3>
                            <p class="card-text pb-3">{{ $item['description'] ?? '' }}</p>

                            @if(!empty($item['external_site']))
                            <p class="mb-10 text-paragraph-small-semi">Visita il sito:</p>
                            <a href="{{ $item['external_site']['url'] ?? '#' }}" class="card card-teaser card-bg-blue no-after rounded mt-0 p-3">
                                <div class="avatar size-lg me-3">
                                    <img src="{{ $item['external_site']['image'] ?? 'https://picsum.photos/200/200' }}" alt="Immagine">
                                </div>
                                <div class="card-body">
                                    <h4 class="card-title text-white mb-1">{{ $item['external_site']['title'] ?? '' }}</h4>
                                    <p class="card-text text-sans-serif text-white">{{ $item['external_site']['description'] ?? '' }}</p>
                                </div>
                            </a>
                            @endif

                            @if(!empty($item['links']))
                            <div class="link-list-wrapper mt-4">
                                <ul class="link-list">
                                    @foreach($item['links'] as $link)
                                    <li>
                                        <a class="list-item active icon-left mb-2" href="{{ $link['url'] ?? '#' }}">
                                            <span class="list-item-title-icon-wrapper">
                                                <span class="text-success">{{ $link['label'] }}</span>
                                            </span>
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                        </div>
                        <a class="read-more pt-0" href="{{ $item['url'] ?? '#' }}">
                            <span class="text">Esplora argomento</span>
                            <svg class="icon ms-0">
                                <use href="{{ asset('themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-arrow-right') }}"></use>
                            </svg>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Altri argomenti --}}
            @if(!empty($other_topics))
            <div class="row pt-30">
                <div class="col-lg-10 col-xl-6 offset-lg-1 offset-xl-2">
                    <div class="row d-lg-inline-flex">
                        <div class="col-lg-3">
                            <h3 class="text-uppercase mb-3 title-xsmall-bold text text-secondary">Altri argomenti</h3>
                        </div>
                        <div class="col-lg-9">
                            <ul class="d-flex flex-wrap gap-1">
                                @foreach($other_topics as $topic)
                                <li>
                                    <a class="chip chip-simple" href="#">
                                        <span class="chip-label">{{ $topic }}</span>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-10 col-xl-8 offset-lg-1 offset-xl-2 text-center">
                    <a href="{{ $show_all_url }}" class="btn btn-primary mt-40">{{ $show_all_label }}</a>
                </div>
            </div>
            @endif

            {{-- Siti tematici --}}
            @if(!empty($thematic_sites))
            <div class="row pt-5">
                <h2>Siti tematici</h2>
            </div>
            <div class="pt-4 pt-lg-30">
                <div class="card-wrapper card-teaser-wrapper card-teaser-wrapper-equal card-teaser-block-3 pb-0">
                    @foreach($thematic_sites as $site)
                    @php
                        $colorClass = match($site['color'] ?? 'blue') {
                            'warning' => 'card-bg-warning',
                            'dark'    => 'card-bg-dark',
                            default   => 'card-bg-blue',
                        };
                    @endphp
                    <a href="{{ $site['url'] ?? '#' }}" class="card card-teaser {{ $colorClass }} rounded mt-0 p-3">
                        <div class="avatar size-lg me-3">
                            <img src="{{ $site['image'] ?? 'https://picsum.photos/200/200' }}" alt="Immagine">
                        </div>
                        <div class="card-body">
                            <h3 class="card-title {{ $site['color'] === 'warning' ? '' : 'text-white' }} sito-tematico">
                                {{ $site['title'] }}
                            </h3>
                            <p class="card-text text-sans-serif {{ $site['color'] === 'warning' ? '' : 'text-white' }}">
                                {{ $site['description'] }}
                            </p>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</section>
