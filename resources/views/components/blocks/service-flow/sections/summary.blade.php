{{--
    Riepilogo a gruppi di dati. `section`: class (contenitore, default `mt-40`), heading {text, class} (titolo fuori dalla scheda, h3), wrapper_class,
    card_class, header_class, title, title_tag (h2|h3), title_class, groups[] (parts/info-summary), total (riga del totale), bare (senza contenitore).
--}}
@php
    $titleTag = ($section['title_tag'] ?? 'h3') === 'h2' ? 'h2' : 'h3';
@endphp
@unless ($section['bare'] ?? false)<div class="{{ $section['class'] ?? 'mt-40' }}"@if (filled($section['id'] ?? null)) id="{{ $section['id'] }}"@endif>@endunless
    @if (filled(data_get($section, 'heading.text')))<h3 class="{{ data_get($section, 'heading.class', 'title-xxlarge mb-4') }}">{{ data_get($section, 'heading.text') }}</h3>@endif
    <div class="{{ trim('cmp-card '.($section['wrapper_class'] ?? 'mb-4')) }}">
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
                    <div class="bg-white"><p class="title-large-semi-bold card-white mb-0">{{ $section['total'] }}</p></div>
                @endif
            </div>
        </div>
    </div>
@unless ($section['bare'] ?? false)</div>@endunless
