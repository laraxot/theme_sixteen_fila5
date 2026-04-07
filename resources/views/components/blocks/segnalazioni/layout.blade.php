@props(['data' => []])

@php
    $title = $data['title'] ?? __('segnalazione::segnalazione.elenco.title');
    $subtitle = $data['subtitle'] ?? __('segnalazione::segnalazione.elenco.subtitle', ['count' => 73]);
    $resultsCount = $data['results_count'] ?? 645;
    $sprite = '/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg';
@endphp

<div class="container" id="main-container">
    <div class="row justify-content-center mb-lg-80">
        <div class="col-12 col-lg-10">
            <nav class="breadcrumb-container mb-4" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/it/tests/homepage">Home</a></li>
                    <li class="breadcrumb-item active">{{ $title }}</li>
                </ol>
            </nav>
            <div class="cmp-heading p-0">
                <h1 class="title-xxxlarge">{{ $title }}</h1>
                @if($subtitle) <p class="subtitle-small">{{ $subtitle }}</p> @endif
            </div>
        </div>
        <hr class="d-none d-lg-block mt-30 mb-2">
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8 offset-lg-1">
            <div class="d-flex justify-content-between border-bottom border-light pb-3 mt-5">
                <span class="search-results">{{ __('segnalazione::segnalazione.elenco.results', ['count' => $resultsCount]) }}</span>
            </div>

            <ul class="nav nav-tabs w-100 flex-nowrap border-bottom border-light mb-40 mt-3" x-data="{ activeTab: 'mappa' }" role="tablist">
                <li class="nav-item w-100" role="tab">
                    <a class="nav-link title-medium-semi-bold pt-0" :class="{ 'active': activeTab === 'mappa' }" @click.prevent="activeTab = 'mappa'" href="#mappa" role="tab" :aria-selected="activeTab === 'mappa'">{{ __('segnalazione::segnalazione.elenco.map_tab') }}</a>
                </li>
                <li class="nav-item w-100" role="tab">
                    <a class="nav-link title-medium-semi-bold pt-0" :class="{ 'active': activeTab === 'elenco' }" @click.prevent="activeTab = 'elenco'" href="#elenco" role="tab" :aria-selected="activeTab === 'elenco'">{{ __('segnalazione::segnalazione.elenco.list_tab') }}</a>
                </li>
            </ul>

            <div x-show="activeTab === 'mappa'" class="tab-content">
                <div class="map-placeholder mb-4" style="height: 300px; background: #e8e8e8; display: flex; align-items: center; justify-content: center;"><span class="text-muted">Mappa</span></div>
                <div class="card-wrapper bg-grey-card rounded h-auto mb-4">
                    <div class="card card-teaser bg-grey-card rounded shadow-sm p-3">
                        <div class="card-body">
                            <h3 class="title-medium-semi-bold">{{ __('segnalazione::segnalazione.elenco.make_report_title') }}</h3>
                            <p class="subtitle-small mt-3">{{ __('segnalazione::segnalazione.elenco.make_report_text') }}</p>
                            <a href="/it/tests/segnalazione-01-privacy" class="btn btn-primary mobile-full py-3 mt-2"><span>{{ __('segnalazione::segnalazione.elenco.make_report_btn') }}</span></a>
                        </div>
                    </div>
                </div>
            </div>

            <div x-show="activeTab === 'elenco'" class="tab-content">
                <div class="row">
                    @php $items = [['Buca in via Solferino','Verde pubblico','15/03/2026'],['Lampione non funzionante','Illuminazione pubblica','10/03/2026'],['Erba alta parco giochi','Verde pubblico','05/03/2026']]; @endphp
                    @foreach($items as $item)
                    <div class="col-12 mb-4 mb-lg-30">
                        <div class="card-wrapper bg-grey-card rounded h-auto">
                            <div class="card card-teaser bg-grey-card rounded shadow-sm p-3">
                                <div class="card-body">
                                    <h3 class="title-medium-semi-bold t-primary">{{ $item[0] }}</h3>
                                    <p class="subtitle-small mb-1">{{ $item[1] }}</p>
                                    <p class="text-paragraph-small text-muted">{{ $item[2] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="text-center mt-10">
                    <button type="button" class="btn btn-outline-primary mobile-full py-3 mx-auto"><span>{{ __('segnalazione::segnalazione.elenco.load_more') }}</span></button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bg-primary">
    <div class="container">
        <div class="row d-flex justify-content-center bg-primary">
            <div class="col-12 col-lg-6 p-lg-0 px-3">
                <div class="cmp-rating pt-lg-80 pb-lg-80" id="rating">
                    <div class="card shadow card-wrapper">
                        <div class="card-header border-0">
                            <h2 class="title-medium-2-semi-bold mb-0">{{ __('segnalazione::segnalazione.elenco.rating_question') }}</h2>
                        </div>
                        <div class="card-body">
                            <fieldset class="rating">
                                <legend class="visually-hidden">{{ __('segnalazione::segnalazione.elenco.rating_legend') }}</legend>
                                @for($i = 5; $i >= 1; $i--)
                                    <input type="radio" id="star{{ $i }}a" name="ratingA" value="{{ $i }}">
                                    <label class="full rating-star" for="star{{ $i }}a"><svg class="icon icon-sm" viewBox="0 0 24 24"><path d="M12 1.7L9.5 9.2H1.6L8 13.9l-2.4 7.6 6.4-4.7 6.4 4.7-2.4-7.6 6.4-4.7h-7.9L12 1.7z"/></svg></label>
                                @endfor
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bg-grey-card shadow-contacts">
    <div class="container">
        <div class="row d-flex justify-content-center p-contacts">
            <div class="col-12 col-lg-5">
                @include('components.blocks.contacts.faq')
            </div>
        </div>
    </div>
</div>
