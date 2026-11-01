{{--
    Schede con casella (cmp-info-checkbox). `content`: add {label, icon, modal}, cards[] {class (default `cmp-info-checkbox`), card_class (default `card`), id, title, title_tag,
    title_class, lines[] {tag (p|span), class, text, child {class, text}}, toggle (come imu-toggle), info {label, value}, payment_rows[] {label, value},
    accordion {id, label, groups[] (parts/info-summary)}}. Ordine nella scheda: lines, toggle, info, payment_rows, accordion.
--}}
@php
    $assets = \Themes\Sixteen\Infrastructure\Assets\DesignComuniAssets::base();
    $icon = static fn (string $name): string => $assets.'/bootstrap-italia/dist/svg/sprites.svg#'.$name;
    $cc = 'pub_theme::components.blocks.service-flow.card-content.';
@endphp
@foreach ($content['cards'] ?? [] as $card)
    <div class="{{ $card['class'] ?? 'cmp-info-checkbox' }}">
        <div class="{{ $card['card_class'] ?? 'card' }}">
            <div class="card-header">
                <div class="form-check form-check-group mt-0 p-0">
                    <input class="check-input" id="{{ $card['id'] ?? '' }}" type="checkbox">
                    <label for="{{ $card['id'] ?? '' }}"><h2 class="{{ $card['title_class'] ?? 'title-xlarge u-main-black' }}">{{ $card['title'] ?? '' }}</h2></label>
                </div>
            </div>
            <div class="card-body">
                @foreach ($card['lines'] ?? [] as $line)
                    @php($lineTag = ($line['tag'] ?? 'p') === 'span' ? 'span' : 'p')
                    <{{ $lineTag }} class="{{ $line['class'] ?? '' }}">{{ $line['text'] ?? '' }}@if (filled($line['child'] ?? null))
                        <span class="{{ $line['child']['class'] ?? '' }}">{{ $line['child']['text'] ?? '' }}</span>@endif</{{ $lineTag }}>
                @endforeach
                @if (filled($card['toggle'] ?? null))@include($cc.'imu-toggle', ['content' => $card['toggle']])@endif
                @if (filled($card['info'] ?? null))
                    <div class="info-wrapper">
                        <span class="info-wrapper__label">{{ data_get($card, 'info.label') }}</span>
                        <p class="info-wrapper__value">{{ data_get($card, 'info.value') }}</p>
                    </div>
                @endif
                @foreach ($card['payment_rows'] ?? [] as $row)
                    <div class="info-wrapper-payment d-flex flex-lg-column">
                        <p class="info-wrapper__label me-2 me-md-0">{{ $row['label'] ?? '' }}</p>
                        <span class="fw-semibold">{{ $row['value'] ?? '' }}</span>
                    </div>
                @endforeach
                @if (filled($card['accordion'] ?? null))
                    <div class="accordion-item">
                        <div class="accordion-header">
                            <button class="collapsed accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#{{ data_get($card, 'accordion.id') }}" aria-expanded="false" aria-controls="{{ data_get($card, 'accordion.id') }}">
                                <span class="d-flex align-items-center"> {{ data_get($card, 'accordion.label') }} <svg class="icon icon-primary icon-sm"><use href="{{ $icon('it-expand') }}"></use></svg></span></button>
                        </div>
                        <div id="{{ data_get($card, 'accordion.id') }}" class="accordion-collapse collapse" role="region">
                            <div class="accordion-body p-0">
                                @foreach (data_get($card, 'accordion.groups', []) as $group)
                                    @include('pub_theme::components.blocks.service-flow.parts.info-summary', ['group' => $group])
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endforeach
@if (filled($content['add'] ?? null))
    <button type="button" data-bs-toggle="modal" data-bs-target="{{ data_get($content, 'add.modal', '#') }}" class="btn plus-text mt-20 p-0">
        <span class="rounded-icon"><svg class="icon icon-primary icon-sm" aria-hidden="true"><use href="{{ $icon(data_get($content, 'add.icon', 'it-plus-circle')) }}"></use></svg></span>
        <span class="">{{ data_get($content, 'add.label') }}</span></button>
@endif
