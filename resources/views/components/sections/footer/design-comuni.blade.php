@props(['blocks' => []])
{{--
    Footer Design Comuni (variante scelta dal layout con chrome="design-comuni"): markup del riferimento, dati da sections/footer.json.
    Il sito reale usa footer/full (invariato).
--}}
@php
    $data = [];
    foreach ($blocks as $block) {
        $blockData = is_array($block) ? ($block['data'] ?? []) : ($block->data ?? []);
        if (is_array($blockData)) {
            $data = array_merge($data, $blockData);
        }
    }
    $d = static fn (string $key, mixed $default = '') => data_get($data, $key, $default);
    $assets = asset('themes/Sixteen/design-comuni/assets');
    $icon = static fn (string $name): string => $assets.'/bootstrap-italia/dist/svg/sprites.svg#'.$name;
    $lines = static fn (string $text): string => implode('<br>', array_map('e', preg_split('/\R/', $text)));
    $services = $d('groups.services.links', []);
    $half = (int) ceil(count($services) / 2);
@endphp
<footer class="it-footer" id="footer">
    <div class="it-footer-main">
        <div class="container">
            <div class="row">
                <div class="col-12 footer-items-wrapper logo-wrapper">
                    <img class="ue-logo" src="{{ asset($d('eu_logo.src')) }}" alt="{{ $d('eu_logo.alt') }}">
                    <div class="it-brand-wrapper">
                        <a href="{{ url('/') }}">
                            <svg class="icon" aria-hidden="true"><use xlink:href="{{ $icon('it-pa') }}"></use></svg>
                            <div class="it-brand-text"><h2 class="no_toc">{{ $d('brand.name') }}</h2></div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 footer-items-wrapper">
                    <h4 class="footer-heading-title">{{ $d('groups.administration.title') }}</h4>
                    <ul class="footer-list">
                        @foreach ($d('groups.administration.links', []) as $link)
                            <li><a href="{{ $link['url'] ?? '#' }}">{{ $link['label'] ?? '' }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-md-6 footer-items-wrapper">
                    <h4 class="footer-heading-title">{{ $d('groups.services.title') }}</h4>
                    <div class="row">
                        @foreach ([array_slice($services, 0, $half), array_slice($services, $half)] as $column)
                            <div class="col-md-6">
                                <ul class="footer-list">
                                    @foreach ($column as $link)
                                        <li><a href="{{ $link['url'] ?? '#' }}">{{ $link['label'] ?? '' }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-3 footer-items-wrapper">
                    @foreach (['news', 'living'] as $group)
                        <h4 class="footer-heading-title">{{ $d("groups.$group.title") }}</h4>
                        <ul class="footer-list">
                            @foreach ($d("groups.$group.links", []) as $link)
                                <li><a href="{{ $link['url'] ?? '#' }}">{{ $link['label'] ?? '' }}</a></li>
                            @endforeach
                        </ul>
                    @endforeach
                </div>
                <div class="col-md-9 mt-md-4 footer-items-wrapper">
                    <h4 class="footer-heading-title">{{ $d('contact.title') }}</h4>
                    <div class="row">
                        <div class="col-md-4">
                            <p class="footer-info">{!! $lines((string) $d('contact.address')) !!}<br><br>
                                <a href="{{ $d('contact.office_url', '#') }}">{{ $d('contact.office') }}</a>@foreach ($d('contact.details', []) as $detail)<br>{{ $detail }}@endforeach
                            </p>
                        </div>
                        @foreach ([$d('contact.links', []), $d('legal_links', [])] as $column)
                            <div class="col-md-4">
                                <ul class="footer-list">
                                    @foreach ($column as $link)
                                        <li><a href="{{ $link['url'] ?? '#' }}"@if (filled($link['data_element'] ?? null)) data-element="{{ $link['data_element'] }}"@endif>{{ $link['label'] ?? '' }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-3 mt-md-4 footer-items-wrapper">
                    <h4 class="footer-heading-title">{{ $d('social_title') }}</h4>
                    <ul class="list-inline text-start social">
                        @foreach ($d('social', []) as $social)
                            <li class="list-inline-item"><a class="p-1 text-white" href="{{ $social['url'] ?? '#' }}" target="_blank"><svg class="icon icon-sm icon-white align-top"><use xlink:href="{{ $icon($social['icon'] ?? 'it-rss') }}"></use></svg><span class="visually-hidden">{{ $social['label'] ?? '' }}</span></a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-12 footer-items-wrapper">
                    <div class="footer-bottom">
                        @foreach ($d('footer_bottom_links', []) as $link)
                            <a href="{{ $link['url'] ?? '#' }}">{{ $link['label'] ?? '' }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
