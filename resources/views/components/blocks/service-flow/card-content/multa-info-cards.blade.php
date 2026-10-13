{{--
    Schede persona con dettaglio apribile della famiglia multa (DCP-28): come `info-cards` (senza radio) ma con i gruppi di parts/multa-info-summary.
    `content`: add {label, icon}, cards[] {title, info {label, value}, toggle_label, collapse_id, collapse_class, header_id, button_class, groups[]}.
--}}
@php
    $assets = asset('themes/Sixteen/design-comuni/assets');
    $icon = static fn (string $name): string => $assets.'/bootstrap-italia/dist/svg/sprites.svg#'.$name;
@endphp
@foreach ($content['cards'] ?? [] as $card)
    <div class="cmp-info-button-card">
        <div class="card p-3 p-lg-4">
            <div class="card-body p-0">
                <h3 class="big-title mb-0">{{ $card['title'] ?? '' }}</h3>
                <p class="card-info">{{ data_get($card, 'info.label') }} <br><span>{{ data_get($card, 'info.value') }}</span></p>
                <div class="accordion-item">
                    <div class="accordion-header"@if (filled($card['header_id'] ?? null)) id="{{ $card['header_id'] }}"@endif>
                        <button class="{{ $card['button_class'] ?? 'collapsed accordion-button' }}" type="button" data-bs-toggle="collapse" data-bs-target="#{{ $card['collapse_id'] ?? '' }}" aria-expanded="false" aria-controls="{{ $card['collapse_id'] ?? '' }}">
                            <span class="d-flex align-items-center"> {{ $card['toggle_label'] ?? '' }} <svg class="icon icon-primary icon-sm"><use href="{{ $icon('it-expand') }}"></use></svg></span></button>
                    </div>
                    <div id="{{ $card['collapse_id'] ?? '' }}" class="{{ $card['collapse_class'] ?? 'accordion-collapse collapse' }}" role="region">
                        <div class="accordion-body p-0">
                            @foreach ($card['groups'] ?? [] as $group)
                                @include('pub_theme::components.blocks.service-flow.parts.multa-info-summary', ['group' => $group])
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
@if (filled($content['add'] ?? null))
    <button type="button" class="btn plus-text mt-20 p-0">
        <span class="rounded-icon"><svg class="icon icon-primary icon-sm" aria-hidden="true"><use href="{{ $icon($content['add']['icon'] ?? 'it-plus-circle') }}"></use></svg></span>
        <span class="">{{ $content['add']['label'] ?? '' }}</span></button>
@endif
