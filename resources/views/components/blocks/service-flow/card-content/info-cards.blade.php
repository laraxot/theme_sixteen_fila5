{{--
    Schede persona con dati riassunti e dettaglio apribile. `content`: radio_name (se presente la scheda e' selezionabile), legend (testo nascosto: racchiude le schede in un fieldset),
    empty {id, class, text_class, text} (riquadro "nessun dato" prima delle schede), add {label, icon, modal (id della finestra che il pulsante apre)},
    cards[] {id, title, info {label, value}, toggle_label, collapse_id, collapse_class, header_id, button_class, expanded (true = aria-expanded="true"), groups[] (parts/info-summary)}.
--}}
@php
    $assets = \Themes\Sixteen\Infrastructure\Assets\DesignComuniAssets::base();
    $icon = static fn (string $name): string => $assets.'/bootstrap-italia/dist/svg/sprites.svg#'.$name;
    $radio = filled($content['radio_name'] ?? null);
@endphp
@if (filled($content['legend'] ?? null))<fieldset><legend class="visually-hidden">{{ $content['legend'] }}</legend>@endif
@if (filled($content['empty'] ?? null))
    <div class="{{ $content['empty']['class'] ?? 'bg-white mt-3' }}" id="{{ $content['empty']['id'] ?? '' }}"><p class="{{ $content['empty']['text_class'] ?? 'title-xsmall py-4 px-3' }}">{{ $content['empty']['text'] ?? '' }}</p></div>
@endif
@foreach ($content['cards'] ?? [] as $card)
    <div @class(['cmp-info-button-card', 'radio-card' => $radio])>
        <div class="card p-3 p-lg-4">
            @if ($radio)
                <div class="card-header mb-0 p-0">
                    <div class="form-check m-0">
                        <input class="radio-input" name="{{ $content['radio_name'] }}" type="radio" id="{{ $card['id'] ?? '' }}">
                        <label for="{{ $card['id'] ?? '' }}"><h3 class="big-title mb-0">{{ $card['title'] ?? '' }}</h3></label>
                    </div>
                </div>
            @endif
            <div class="card-body p-0">
                @unless ($radio)<h3 class="big-title mb-0">{{ $card['title'] ?? '' }}</h3>@endunless
                <p class="card-info">{{ data_get($card, 'info.label') }} <br><span>{{ data_get($card, 'info.value') }}</span></p>
                <div class="accordion-item">
                    <div class="accordion-header"@if (filled($card['header_id'] ?? null)) id="{{ $card['header_id'] }}"@endif>
                        <button class="{{ $card['button_class'] ?? 'collapsed accordion-button' }}" type="button" data-bs-toggle="collapse" data-bs-target="#{{ $card['collapse_id'] ?? '' }}" aria-expanded="{{ ($card['expanded'] ?? false) ? 'true' : 'false' }}" aria-controls="{{ $card['collapse_id'] ?? '' }}">
                            <span class="d-flex align-items-center"> {{ $card['toggle_label'] ?? '' }} <svg class="icon icon-primary icon-sm"><use href="{{ $icon('it-expand') }}"></use></svg></span></button>
                    </div>
                    <div id="{{ $card['collapse_id'] ?? '' }}" class="{{ $card['collapse_class'] ?? 'accordion-collapse collapse' }}" role="region">
                        <div class="accordion-body p-0">
                            @foreach ($card['groups'] ?? [] as $group)
                                @include('pub_theme::components.blocks.service-flow.parts.info-summary', ['group' => $group])
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
@if (filled($content['legend'] ?? null))</fieldset>@endif
@if (filled($content['add'] ?? null))
    <button type="button"@if (filled($content['add']['modal'] ?? null)) data-bs-toggle="modal" data-bs-target="{{ $content['add']['modal'] }}"@endif class="btn plus-text mt-20 p-0">
        <span class="rounded-icon"><svg class="icon icon-primary icon-sm" aria-hidden="true"><use href="{{ $icon($content['add']['icon'] ?? 'it-plus-circle') }}"></use></svg></span>
        <span class="">{{ $content['add']['label'] ?? '' }}</span></button>
@endif
