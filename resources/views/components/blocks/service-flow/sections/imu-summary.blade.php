{{--
    Riepilogo a gruppi senza contenitore esterno (cmp-card). Come `summary` con `bare`, piu' `total_class` (nel riferimento IMU il totale non ha `mb-0`).
    `section`: wrapper_class, card_class, header_class, title, title_tag (h2|h3), title_class, groups[] (parts/info-summary), total, total_class.
--}}
@php
    $titleTag = ($section['title_tag'] ?? 'h3') === 'h2' ? 'h2' : 'h3';
@endphp
<div class="{{ trim('cmp-card '.($section['wrapper_class'] ?? '')) }}">
    <div class="{{ $section['card_class'] ?? 'card has-bkg-grey shadow-sm mb-0' }}">
        @if (filled($section['title'] ?? null))
            <div class="{{ $section['header_class'] ?? 'card-header border-0 p-0 mb-lg-20' }}">
                <div class="d-flex"><{{ $titleTag }} class="{{ $section['title_class'] ?? 'subtitle-large mb-0' }}">{{ $section['title'] }}</{{ $titleTag }}></div>
            </div>
        @endif
        <div class="card-body p-0">
            @foreach ($section['groups'] ?? [] as $group)
                @include('pub_theme::components.blocks.service-flow.parts.info-summary', ['group' => $group])
            @endforeach
            @if (filled($section['total'] ?? null))
                <div class="bg-white"><p class="{{ $section['total_class'] ?? 'title-large-semi-bold card-white' }}">{{ $section['total'] }}</p></div>
            @endif
        </div>
    </div>
</div>
