{{--
    Riepilogo a gruppi di dati. `section`: class (contenitore, default `mt-40`), id, bare (senza contenitore), heading {text, class, tag (h2|h3, default h3), id} (titolo fuori
    dalla scheda), wrapper_class (dopo `cmp-card`, default `mb-4`), card_class, header_class, title, title_tag (h2|h3), title_class, title_id, groups[] (parts/info-summary),
    total (testo semplice oppure {label, value, class, value_class}: etichetta e valore su due spazi, il valore va a capo sotto lg), total_class (classi del totale testuale,
    default `title-large-semi-bold card-white mb-0`).
--}}
@php
    $titleTag = ($section['title_tag'] ?? 'h3') === 'h2' ? 'h2' : 'h3';
    $headTag = data_get($section, 'heading.tag', 'h3') === 'h2' ? 'h2' : 'h3';
    $total = $section['total'] ?? null;
@endphp
@unless ($section['bare'] ?? false)<div class="{{ $section['class'] ?? 'mt-40' }}"@if (filled($section['id'] ?? null)) id="{{ $section['id'] }}"@endif>@endunless
    @if (filled(data_get($section, 'heading.text')))<{{ $headTag }} class="{{ data_get($section, 'heading.class', 'title-xxlarge mb-4') }}"@if (filled(data_get($section, 'heading.id'))) id="{{ data_get($section, 'heading.id') }}"@endif>{{ data_get($section, 'heading.text') }}</{{ $headTag }}>@endif
    <div class="{{ trim('cmp-card '.($section['wrapper_class'] ?? 'mb-4')) }}">
        <div class="{{ $section['card_class'] ?? 'card has-bkg-grey shadow-sm mb-0' }}">
            @if (filled($section['title'] ?? null))
                <div class="{{ $section['header_class'] ?? 'card-header border-0 p-0 mb-lg-20' }}">
                    <div class="d-flex"><{{ $titleTag }} class="{{ $section['title_class'] ?? 'subtitle-large mb-0' }}"@if (filled($section['title_id'] ?? null)) id="{{ $section['title_id'] }}"@endif>{{ $section['title'] }}</{{ $titleTag }}></div>
                </div>
            @endif
            <div class="card-body p-0">
                @foreach ($section['groups'] ?? [] as $group)
                    @include('pub_theme::components.blocks.service-flow.parts.info-summary', ['group' => $group])
                @endforeach
                @if (is_array($total))
                    <div class="bg-white"><p class="{{ $total['class'] ?? 'title-large-semi-bold card-white' }}">{{ $total['label'] ?? '' }} <span class="{{ $total['value_class'] ?? 'd-block d-lg-inline' }}">{{ $total['value'] ?? '' }}</span></p></div>
                @elseif (filled($total))
                    <div class="bg-white"><p class="{{ $section['total_class'] ?? 'title-large-semi-bold card-white mb-0' }}">{{ $total }}</p></div>
                @endif
            </div>
        </div>
    </div>
@unless ($section['bare'] ?? false)</div>@endunless
