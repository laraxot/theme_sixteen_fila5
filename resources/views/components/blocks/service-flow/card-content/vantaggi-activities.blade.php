{{-- Ultime attivita' dei vantaggi: come `activities`, con il titolo sottolineato. `content`: icon, more, items[] {date, title}. --}}
@php
    $assets = asset('themes/Sixteen/design-comuni/assets');
    $icon = static fn (string $name): string => $assets.'/bootstrap-italia/dist/svg/sprites.svg#'.$name;
@endphp
@foreach ($content['items'] ?? [] as $item)
    <div class="cmp-icon-card mb-3">
        <div class="card pt-20 pb-4 ps-4 pr-30 drop-shadow">
            <div class="cmp-card-title d-flex">
                <svg class="icon icon-sm me-2" aria-hidden="true"><use href="{{ $icon($content['icon'] ?? 'it-files') }}"></use></svg>
                <h3 class="t-primary mb-2 underline title-small-semi-bold"><a href="#">{{ $item['title'] ?? '' }}</a></h3>
            </div>
            <div class="cmp-icon-card__description"><date class="date-xsmall ml-30">{{ $item['date'] ?? '' }}</date></div>
        </div>
    </div>
@endforeach
<button type="button" class="btn btn-xs btn-me btn-label t-primary px-0"><span class="">{{ $content['more'] ?? '' }}</span></button>
