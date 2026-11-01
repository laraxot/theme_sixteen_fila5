@props(['data' => []])

@php
    $d = static fn (string $key, mixed $default = '') => data_get($data, $key, $default);
    $featured = $d('featured.items', []);
    $sections = $d('sections.items', []);
@endphp

<div class="dc-page administration-page">
    <div class="container">
        <div class="mb-md-5">
            <div class="cmp-breadcrumbs" role="navigation">
                <nav class="breadcrumb-container" aria-label="{{ __('pub_theme::blocks_common.shared.breadcrumb.label') }}">
                    <ol class="breadcrumb p-0" data-element="breadcrumb">
                        @foreach ($d('breadcrumb.items', []) as $crumb)
                            <li class="breadcrumb-item"><a href="{{ $crumb['url'] ?? '#' }}">{{ $crumb['label'] ?? '' }}</a><span class="separator">/</span></li>
                        @endforeach
                        <li class="breadcrumb-item active" aria-current="page">{{ $d('breadcrumb.current') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 offset-lg-1">
                <h1 class="text-black">{{ $d('title') }}</h1>
                <p class="lead">{{ $d('description') }}</p>
            </div>
        </div>
    </div>

    <section class="section py-5" aria-labelledby="administration-featured-title">
        <div class="container">
            <h2 id="administration-featured-title" class="title-xxlarge mb-4">{{ $d('featured.title') }}</h2>
            <div class="card-wrapper card-teaser-wrapper card-teaser-wrapper-equal card-teaser-block-3">
                @foreach ($featured as $item)
                    <a href="{{ $item['url'] ?? '#' }}" class="card card-teaser no-after rounded shadow-sm border border-light">
                        <div class="card-body pb-5">
                            <h3 class="card-title t-primary">{{ $item['title'] ?? '' }}</h3>
                            <p class="card-text">{{ $item['description'] ?? '' }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section py-5" aria-labelledby="administration-explore-title">
        <div class="container">
            <h2 id="administration-explore-title" class="title-xxlarge mb-4">{{ $d('sections.title') }}</h2>
            <div class="card-wrapper card-teaser-wrapper card-teaser-wrapper-equal card-teaser-block-3">
                @foreach ($sections as $item)
                    <a href="{{ $item['url'] ?? '#' }}" class="card card-teaser no-after rounded shadow-sm border border-light">
                        <div class="card-body pb-5">
                            <h3 class="card-title t-primary">{{ $item['title'] ?? '' }}</h3>
                            <p class="card-text">{{ $item['description'] ?? '' }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    @include('pub_theme::components.blocks.partials.dc-rating', ['data' => $data])
    @include('pub_theme::components.blocks.partials.dc-contacts', ['data' => $data])
</div>
