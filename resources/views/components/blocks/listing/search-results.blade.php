@props([
    'title' => '',
    'button_label' => 'Invio',
    'summary' => '',
    'items' => [],
])

<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="cmp-heading pb-3 pb-lg-4">
                    <h2>{{ $title }}</h2>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <form class="cmp-input-search mb-4" role="search">
                    <div class="input-group">
                        <input type="search" class="form-control" aria-label="Cerca nelle novità">
                        <button class="btn btn-primary" type="button">{{ $button_label }}</button>
                    </div>
                </form>

                @if($summary !== '')
                    <p class="mb-4">{{ $summary }}</p>
                @endif
            </div>
        </div>

        <div class="row g-4">
            @foreach($items as $item)
                <div class="col-12 col-lg-6">
                    <article class="card card-teaser card-teaser-image-top no-after rounded shadow-sm h-100">
                        @if(!empty($item['image']))
                            <div class="card-image-wrapper with-read-more">
                                <div class="card-body p-0">
                                    <img class="img-fluid" src="{{ $item['image'] }}" alt="{{ $item['image_alt'] ?? 'descrizione immagine' }}">
                                </div>
                            </div>
                        @endif

                        <div class="card-body">
                            @if(!empty($item['category']) || !empty($item['date']))
                                <div class="category-top">
                                    @if(!empty($item['category']))
                                        <span class="badge bg-primary">{{ $item['category'] }}</span>
                                    @endif
                                    @if(!empty($item['date']))
                                        <span class="data">{{ $item['date'] }}</span>
                                    @endif
                                </div>
                            @endif

                            <h3 class="card-title h5">
                                <a href="{{ $item['url'] ?? '#' }}" class="text-decoration-none">
                                    {{ $item['title'] ?? '' }}
                                </a>
                            </h3>

                            @if(!empty($item['description']))
                                <p class="card-text font-serif">{{ $item['description'] }}</p>
                            @endif
                        </div>
                    </article>
                </div>
            @endforeach
        </div>
    </div>
</section>
