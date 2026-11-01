{{--
    Elenco filtrabile di pratiche o pagamenti. `section`: id, class, title, accordion_id (id dell'accordion, default vuoto), filter {label}, sort {id, label, items[]},
    search {id, name, label, placeholder}, attachment_class, more, items[] {n (numero per gli id), title, date, status {label, class, image, image_class (default `icon-folder`), alt},
    details[] {label, value}, link, chips[], attachments[] {label, aria (assente = nessun aria-label), class}, button}.
--}}
@php
    $assets = \Themes\Sixteen\Infrastructure\Assets\DesignComuniAssets::base();
    $icon = static fn (string $name): string => $assets.'/bootstrap-italia/dist/svg/sprites.svg#'.$name;
@endphp
<section class="{{ trim('it-page-section '.($section['class'] ?? '')) }}" id="{{ $section['id'] ?? '' }}">
    <div class="cmp-filter">
        <div class="filter-section">
            <h2 class="cmp-filter__title title-xxlarge"@if (filled($section['title_id'] ?? null)) id="{{ $section['title_id'] }}"@endif>{{ $section['title'] ?? '' }}</h2>
            <div class="filter-wrapper d-flex align-items-center">
                <button type="button" class="btn p-0 pe-2 t-primary">
                    <span class="rounded-icon"><svg class="icon icon-primary icon-xs me-1" aria-hidden="true"><use href="{{ $icon('it-funnel') }}"></use></svg></span>
                    <span class="">{{ data_get($section, 'filter.label') }}</span></button>
                <div class="dropdown">
                    <button class="btn btn-dropdown dropdown-toggle" type="button" id="{{ data_get($section, 'sort.id') }}" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="">
                        <svg class="icon-expand icon icon-sm icon-primary"><use href="{{ $icon('it-expand') }}"></use></svg>
                        <span class="dropdown__title">{{ data_get($section, 'sort.label') }}</span></button>
                    <div class="dropdown-menu" aria-labelledby="{{ data_get($section, 'sort.id') }}">
                        <div class="link-list-wrapper">
                            <ul class="link-list">
                                @foreach (data_get($section, 'sort.items', []) as $entry)
                                    <li><a class="dropdown-item list-item" href="#"><span>{{ $entry }}</span></a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="cmp-input-search">
            <div class="form-group autocomplete-wrapper">
                <div class="input-group">
                    <label for="{{ data_get($section, 'search.id') }}" class="visually-hidden">{{ data_get($section, 'search.label') }}</label>
                    <input type="search" class="autocomplete form-control" placeholder="{{ data_get($section, 'search.placeholder') }}" id="{{ data_get($section, 'search.id') }}" name="{{ data_get($section, 'search.name') }}" data-bs-autocomplete="[]">
                    <span class="autocomplete-icon" aria-hidden="true"><svg class="icon icon-sm"><use href="{{ $icon('it-search') }}"></use></svg></span>
                </div>
            </div>
        </div>
    </div>
    <div class="cmp-accordion">
        <div class="accordion" id="{{ $section['accordion_id'] ?? '' }}">
            @foreach ($section['items'] ?? [] as $item)
                <div class="accordion-item">
                    <div class="accordion-header" id="heading{{ $item['n'] ?? $loop->iteration }}">
                        <button class="accordion-button collapsed title-snall-semi-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $item['n'] ?? $loop->iteration }}" aria-expanded="true" aria-controls="collapse{{ $item['n'] ?? $loop->iteration }}">
                            <div class="button-wrapper"> {{ $item['title'] ?? '' }}
                                <div class="icon-wrapper">
                                    <img class="{{ data_get($item, 'status.image_class', 'icon-folder') }}" src="{{ $assets }}/images/{{ data_get($item, 'status.image') }}" alt="{{ data_get($item, 'status.alt') }}" role="img">
                                    <span class="{{ data_get($item, 'status.class', '') }}">{{ data_get($item, 'status.label') }}</span>
                                </div>
                            </div></button>
                        <p class="accordion-date title-xsmall-regular mb-0">{{ $item['date'] ?? '' }}</p>
                    </div>
                    <div id="collapse{{ $item['n'] ?? $loop->iteration }}" class="accordion-collapse collapse p-0" data-bs-parent="#accordionExample{{ $item['n'] ?? $loop->iteration }}" role="region" aria-labelledby="heading{{ $item['n'] ?? $loop->iteration }}">
                        <div class="accordion-body">
                            @foreach ($item['details'] ?? [] as $detail)
                                <p class="mb-2 fw-normal">{{ $detail['label'] ?? '' }} <span class="label">{{ $detail['value'] ?? '' }}</span></p>
                            @endforeach
                            <a href="#" class="mb-2"><span class="t-primary">{{ $item['link'] ?? '' }}</span></a>
                            @foreach ($item['chips'] ?? [] as $chip)
                                <a class="chip chip-simple" href="#"><span class="chip-label">{{ $chip }}</span></a>
                            @endforeach
                            <div class="cmp-icon-list">
                                <div class="link-list-wrapper">
                                    <ul class="link-list">
                                        @foreach ($item['attachments'] ?? [] as $attachment)
                                            <li class="{{ $attachment['class'] ?? $section['attachment_class'] ?? 'shadow p-0' }}">
                                                <a class="list-item icon-left t-primary title-small-semi-bold" href="#"@if (array_key_exists('aria', $attachment)) aria-label="{{ $attachment['aria'] }}"@endif>
                                                    <span class="list-item-title-icon-wrapper">
                                                        <svg class="icon icon-sm align-self-start icon-color" aria-hidden="true"><use href="{{ $icon('it-clip') }}"></use></svg>
                                                        <span class="list-item-title title-small-semi-bold">{{ $attachment['label'] ?? '' }}</span></span></a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            @if (filled($item['button'] ?? null))
                                <button type="button" class="btn btn-primary justify-content-center my-3"><span class="">{{ $item['button'] }}</span></button>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <button type="button" class="{{ $section['more_class'] ?? 'btn accordion-view-more mb-2 pt-3 t-primary title-xsmall-semi-bold ps-lg-3' }}"><span class="">{{ $section['more'] ?? '' }}</span></button>
</section>
