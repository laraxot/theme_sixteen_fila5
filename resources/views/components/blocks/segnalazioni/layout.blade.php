{{--
    Segnalazioni Layout Block - Bootstrap Italia Exact Replica
    Combines sidebar filters + tabs/map-list content in correct row structure
    Reference: https://italia.github.io/design-comuni-pagine-statiche/sito/segnalazioni-elenco.html
    Tabs & Modals: Alpine.js (no Bootstrap JS)
--}}
@props(['data' => []])

@php
    $filters = $data['filters'] ?? [];
    $tabs = $data['tabs'] ?? [];
    $cta = $data['cta'] ?? [];
    $items = $data['items'] ?? [];
    $resultsCount = $data['results_count'] ?? 645;
@endphp

<script>
function openFilterModal() {
    var modal = document.getElementById('modal-categories');
    var backdrop = document.getElementById('modal-categories-backdrop');
    if (modal) {
        modal.classList.add('show', 'd-block');
        modal.style.display = 'block';
    }
    if (backdrop) {
        backdrop.classList.add('show');
        backdrop.style.display = 'block';
    }
}
function closeFilterModal() {
    var modal = document.getElementById('modal-categories');
    var backdrop = document.getElementById('modal-categories-backdrop');
    if (modal) {
        modal.classList.remove('show', 'd-block');
        modal.style.display = '';
    }
    if (backdrop) {
        backdrop.classList.remove('show');
        backdrop.style.display = '';
    }
}
function openDisservizioModal() {
    var modal = document.getElementById('modal-disservizio');
    if (modal) {
        modal.classList.add('show', 'd-block');
        modal.style.display = 'block';
        var backdrop = document.getElementById('modal-disservizio-backdrop');
        if (backdrop) {
            backdrop.classList.add('show');
            backdrop.style.display = 'block';
        }
    }
}
function closeDisservizioModal() {
    var modal = document.getElementById('modal-disservizio');
    if (modal) {
        modal.classList.remove('show', 'd-block');
        modal.style.display = '';
    }
    var backdrop = document.getElementById('modal-disservizio-backdrop');
    if (backdrop) {
        backdrop.classList.remove('show');
        backdrop.style.display = '';
    }
}
</script>

<div class="row" x-data="segnalazioniLayout">
    {{-- Sidebar Filters --}}
    <div class="col-lg-3 d-none d-lg-block">
        <fieldset>
            <legend class="h6 text-uppercase category-list__title">{{ $filters['title'] ?? 'categoria' }}</legend>
            <div class="categoy-list pb-4">
                <ul>
                    @foreach($filters['items'] ?? [] as $filter)
                    <li>
                        <div class="form-check">
                            <div class="checkbox-body border-light py-1">
                                <input type="checkbox" id="{{ $filter['id'] }}" name="category" value="{{ $filter['value'] ?? '' }}">
                                <label for="{{ $filter['id'] }}" class="subtitle-small_semi-bold mb-0 category-list__list">
                                    {{ $filter['label'] }} ({{ $filter['count'] ?? 0 }})
                                </label>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </fieldset>
    </div>

    {{-- Main Content --}}
    <div class="col-lg-8 offset-lg-1">
        <div class="d-flex justify-content-between border-bottom border-light pb-3 mt-5">
            <span class="search-results">{{ $resultsCount }} Risultati</span>

            {{-- Mobile filter button --}}
            <button type="button" onclick="document.getElementById('modal-categories').classList.add('show', 'd-block'); document.getElementById('modal-categories').style.display = 'block';" class="btn p-0 pe-2 d-lg-none">
                <span class="rounded-icon">
                    <svg class="icon icon-primary icon-xs" aria-hidden="true">
                        <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-funnel"></use>
                    </svg>
                </span>
                <span class="t-primary title-xsmall-semi-bold ms-1">Filtra</span>
            </button>
            <button type="button" class="btn p-0 pe-2 d-none d-lg-block">
                <span class="title-xsmall-semi-bold ms-1">Rimuovi tutti i filtri</span>
            </button>
        </div>

        {{-- Tabs (Alpine.js) --}}
        <ul class="nav nav-tabs w-100 flex-nowrap border-bottom border-light mb-40 mt-3 shadow-none" id="tabDisservizio" role="tablist">
            @foreach($tabs as $tab)
            <li class="nav-item w-100" role="presentation">
                <a class="nav-link title-medium-semi-bold pt-0"
                   :class="{ 'active': activeTab === '{{ $tab['id'] }}' }"
                   @click.prevent="activeTab = '{{ $tab['id'] }}'"
                   href="#"
                   role="tab"
                   :aria-selected="activeTab === '{{ $tab['id'] }}'">
                    {{ $tab['label'] }}
                </a>
            </li>
            @endforeach
        </ul>

        {{-- Tab Content --}}
        <div class="tab-content">
            {{-- Map Tab --}}
            <div x-show="activeTab === 'map'" x-transition role="tabpanel">
                <div class="row">
                    <div class="col-12">
                        <div class="map-box position-relative">
                            <img src="/themes/Sixteen/design-comuni/assets/images/map-placeholder.svg" alt="Mappa" class="w-100">
                            <button type="button" onclick="openDisservizioModal()" class="position-absolute top-50 start-50 translate-middle bg-transparent border-0 p-0">
                                <img src="/themes/Sixteen/design-comuni/assets/images/map-pin.svg" alt="Pin di geolocalizzazione" title="Pin di geolocalizzazione">
                            </button>
                        </div>
                    </div>
                    @if($cta)
                    <div class="col-lg-6 mt-50 mb-4 mb-lg-0">
                        <div class="cmp-text-button mt-0">
                            <h2 class="title-xxlarge mb-0">{{ $cta['title'] ?? 'Fai una segnalazione' }}</h2>
                            <div class="text-wrapper">
                                <p class="subtitle-small mb-3 mt-3">{{ $cta['text'] ?? '' }}</p>
                            </div>
                            <div class="button-wrapper">
                                <button type="button" onclick="openDisservizioModal()" class="btn btn-primary mobile-full py-3 mt-2 mb-4 mb-lg-0">
                                    <span>{{ $cta['button_text'] ?? 'Segnala disservizio' }}</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            {{-- List Tab --}}
            <div x-show="activeTab === 'list'" x-transition role="tabpanel">
                <div class="row">
                        @foreach($items as $index => $item)
                        <div class="cmp-card mb-4 mb-lg-30">
                            <div class="card has-bkg-grey shadow-sm">
                                <div class="card-body p-0">
                                    <div class="cmp-info-button-card">
                                        <div class="card p-3 p-lg-4">
                                            <div class="card-body p-0">
                                                <h3 class="medium-title mb-0">{{ $item['title'] ?? 'Segnalazione' }}</h3>
                                                <p class="card-info">Tipologia di segnalazione <br>
                                                    <span>{{ $item['type'] ?? '' }}</span>
                                                </p>
                                                <div class="accordion-item" x-data="accordionItem">
                                                    <div class="accordion-header">
                                                        <button class="accordion-button" :class="{ 'collapsed': !open }" type="button" @click="open = !open" :aria-expanded="open">
                                                            <div class="button-wrapper">
                                                                <span class="title-xsmall-semi-bold">Dettagli</span>
                                                                <div class="icon-wrapper">
                                                                    <svg class="icon icon-xs icon-primary">
                                                                        <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-expand"></use>
                                                                    </svg>
                                                                </div>
                                                            </div>
                                                        </button>
                                                    </div>
                                                    <div class="accordion-collapse" x-show="open" x-collapse>
                                                        <div class="accordion-body">
                                                            <div class="single-line-info border-light">
                                                                <div class="text-paragraph-small">Data</div>
                                                                <div class="border-light"><p class="data-text">{{ $item['date'] ?? '' }}</p></div>
                                                            </div>
                                                            <div class="single-line-info border-light">
                                                                <div class="text-paragraph-small">Luogo</div>
                                                                <div class="border-light"><p class="data-text">{{ $item['location'] ?? '' }}</p></div>
                                                            </div>
                                                            <div class="single-line-info border-light">
                                                                <div class="text-paragraph-small">Stato</div>
                                                                <div class="border-light"><p class="data-text">{{ $item['status'] ?? '' }}</p></div>
                                                            </div>
                                                            <div class="single-line-info border-light">
                                                                <div class="text-paragraph-small">Dettaglio</div>
                                                                <div class="border-light"><p class="data-text">{{ $item['description'] ?? '' }}</p></div>
                                                            </div>
                                                            @if(isset($item['images']) && count($item['images']) > 0)
                                                            <div class="single-line-info border-light">
                                                                <div class="text-paragraph-small">Immagini</div>
                                                                <div class="border-light border-0">
                                                                    <div class="d-lg-flex gap-2 mt-3">
                                                                        @foreach($item['images'] as $img)
                                                                        <div><img src="{{ $img }}" alt="Immagine segnalazione" class="img-fluid w-100 mb-3 mb-lg-0"></div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Info Summary --}}
                                        <div class="cmp-info-summary bg-white border-0">
                                            <div class="card">
                                                <div class="card-header border-bottom border-light p-0 mb-0 d-flex justify-content-end">
                                                    <a href="{{ $item['edit_url'] ?? '#' }}" class="d-none text-decoration-none"><span class="text-button-sm-semi t-primary">Modifica</span></a>
                                                </div>
                                                <div class="card-body p-0">
                                                    <div class="single-line-info border-light">
                                                        <div class="text-paragraph-small">Indirizzo</div>
                                                        <div class="border-light"><p class="data-text">{{ $item['location'] ?? '' }}</p></div>
                                                    </div>
                                                    <div class="single-line-info border-light">
                                                        <div class="text-paragraph-small">Dettaglio</div>
                                                        <div class="border-light"><p class="data-text">{{ $item['description'] ?? '' }}</p></div>
                                                    </div>
                                                    @if(isset($item['images']) && count($item['images']) > 0)
                                                    <div class="single-line-info border-light">
                                                        <div class="text-paragraph-small">Immagini</div>
                                                        <div class="border-light border-0">
                                                            <div class="d-lg-flex gap-2 mt-3">
                                                                @foreach($item['images'] as $img)
                                                                <div><img src="{{ $img }}" alt="Immagine segnalazione" class="img-fluid w-100 mb-3 mb-lg-0"></div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Disservizio (Vanilla JS) --}}
    <div class="modal fade" 
         id="modal-disservizio" 
         tabindex="-1" 
         role="dialog">
        <div class="modal-backdrop fade" id="modal-disservizio-backdrop"></div>
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title title-small-semi-bold">{{ $items[0]['title'] ?? 'Segnalazione' }}</h2>
                    <button class="btn-close" type="button" onclick="closeDisservizioModal()" aria-label="Chiudi finestra modale">
                        <svg class="icon"><use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-close"></use></svg>
                    </button>
                </div>
                <div class="modal-body text-black">
                    <div class="border-bottom border-light">
                        <h3 class="title-xsmall pt-2">Tipologia di segnalazione</h3>
                        <p class="subtitle-small pb-2">{{ $items[0]['type'] ?? '' }}</p>
                    </div>
                    <div class="border-bottom border-light">
                        <h3 class="title-xsmall pt-2">Indirizzo</h3>
                        <p class="subtitle-small pb-2">{{ $items[0]['location'] ?? '' }}</p>
                    </div>
                    <div class="border-bottom border-light">
                        <h3 class="title-xsmall pt-2">Dettaglio</h3>
                        <p class="subtitle-small pb-2">{{ $items[0]['description'] ?? '' }}</p>
                    </div>
                    <h3 class="title-xsmall pt-2">Immagini</h3>
                    @if(isset($items[0]['images']) && count($items[0]['images']) > 0)
                        @foreach($items[0]['images'] as $img)
                        <img src="{{ $img }}" class="w-100 mb-2" alt="immagine disservizio">
                        @endforeach
                    @else
                        <img src="/themes/Sixteen/design-comuni/assets/images/modal-disservizio-placeholder.png" class="w-100 mb-2" alt="immagine disservizio">
                    @endif
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-primary w-100 btn-sm" type="button" onclick="closeDisservizioModal()">Chiudi</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Categories Mobile Filter (Vanilla JS) --}}
    <div class="modal fade" 
         id="modal-categories" 
         tabindex="-1" 
         role="dialog">
        <div class="modal-backdrop fade" id="modal-categories-backdrop"></div>
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title title-small-semi-bold">Filtra per categoria</h2>
                    <button class="btn-close" type="button" onclick="closeFilterModal()" aria-label="Chiudi">
                        <svg class="icon"><use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-close"></use></svg>
                    </button>
                </div>
                <div class="modal-body">
                    <fieldset>
                        <legend class="h6 text-uppercase category-list__title">categoria</legend>
                        <div class="categoy-list pb-4">
                            <ul>
                                @foreach($filters['items'] ?? [] as $filter)
                                <li>
                                    <div class="form-check">
                                        <div class="checkbox-body border-light py-1">
                                            <input type="checkbox" id="modal-{{ $filter['id'] }}" name="category" value="{{ $filter['value'] ?? '' }}">
                                            <label for="modal-{{ $filter['id'] }}" class="subtitle-small_semi-bold mb-0 category-list__list">{{ $filter['label'] }} ({{ $filter['count'] ?? 0 }})</label>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </fieldset>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-primary w-100 btn-sm" type="button" onclick="closeFilterModal()">Chiudi</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Rating Section --}}
<div class="bg-primary" id="rating">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-12 col-lg-6">
                <div class="cmp-rating pt-lg-80 pb-lg-80">
                    <div class="card shadow card-wrapper" data-element="feedback" x-data="ratingInline">
                        <div class="cmp-rating__card-first">
                            <div class="card-header border-0">
                                <h2 class="title-medium-2-semi-bold mb-0" data-element="feedback-title">Quanto sono chiare le informazioni su questa pagina?</h2>
                            </div>
                            <div class="card-body">
                                <fieldset class="rating">
                                    <legend class="visually-hidden">Valuta da 1 a 5 stelle la pagina</legend>
                                    <div class="d-flex flex-row-reverse justify-content-end">
                                        @for($i = 5; $i >= 1; $i--)
                                        <label class="full rating-star" :class="(hover >= {{ $i }} || rating >= {{ $i }}) ? 'active' : ''" for="star{{ $i }}a" data-element="feedback-rate-{{ $i }}">
                                            <input type="radio" id="star{{ $i }}a" name="ratingA" value="{{ $i }}" class="visually-hidden" @click="rating = {{ $i }}" @mouseenter="hover = {{ $i }}" @mouseleave="hover = 0">
                                            <svg class="icon icon-sm" role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12 1.7L9.5 9.2H1.6L8 13.9l-2.4 7.6 6.4-4.7 6.4 4.7-2.4-7.6 6.4-4.7h-7.9L12 1.7z"></path>
                                            </svg>
                                            <span class="visually-hidden">Valuta {{ $i }} {{ $i === 1 ? 'stella' : 'stelle' }} su 5</span>
                                        </label>
                                        @endfor
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        <div class="d-flex flex-nowrap pt-4 w-100 justify-content-center button-shadow">
                            <button class="btn btn-outline-primary fw-bold me-4" type="button">Indietro</button>
                            <button class="btn btn-primary fw-bold" type="submit">Avanti</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
