@props(['blocks' => []])
{{--
    Footer Design Comuni — vestito.
    SSoT: <x-section slug="footer"> → sections/footer.json (brand, groups, contact.title/labels/links, legal).
    Recapiti e social dell'ente: UNICA sorgente config('ente') via GetEnteDataAction (DCP-289). Un dato mancante nasconde la sua riga; senza
    nessun recapito sparisce anche il titolo "Contatti"; senza social sparisce la colonna "Seguici su".
    Qui solo markup + FrontofficeUrl; niente copy istituzionale hardcodato (D11 / DCP-198 A5).
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
    $assets = \Themes\Sixteen\Infrastructure\Assets\DesignComuniAssets::base();
    $brandLogo = trim((string) $d('brand.logo', 'assets/fixcity/svg/logo.svg'));
    $icon = static fn (string $name): string => $assets.'/bootstrap-italia/dist/svg/sprites.svg#'.$name;
    $lines = static fn (string $text): string => implode('<br>', array_map('e', preg_split('/\R/', $text) ?: []));

    // Path JSON senza lingua → URL FO localizzato. Vuoto/# = non e' un link (DCP-131 / A5).
    $isReplica = request()->segment(2) === 'tests';
    $href = static function (mixed $url) use ($isReplica): string {
        $raw = trim((string) $url);
        if ($raw === '' || $raw === '#') {
            return $isReplica ? '#' : '';
        }

        return \Themes\Sixteen\Infrastructure\Url\FrontofficeUrl::fromStoredUrl($raw);
    };
    $attr = static function (mixed $url) use ($href): string {
        $target = $href($url);

        return $target !== '' ? ' href="'.e($target).'"' : '';
    };
    $hasUrl = static function (mixed $item): bool {
        if (! is_array($item)) {
            return false;
        }
        $url = trim((string) ($item['url'] ?? ''));

        return $url !== '' && $url !== '#';
    };
    $activeLinks = static function (mixed $links) use ($hasUrl): array {
        if (! is_array($links)) {
            return [];
        }

        return array_values(array_filter($links, $hasUrl));
    };

    $adminLinks = $activeLinks($d('groups.administration.links', []));
    $serviceLinks = $activeLinks($d('groups.services.links', []));
    $newsLinks = $activeLinks($d('groups.news.links', []));
    $livingLinks = $activeLinks($d('groups.living.links', []));
    $contactLinks = $activeLinks($d('contact.links', []));
    $legalLinks = $activeLinks($d('legal_links', []));
    $bottomLinks = $activeLinks($d('footer_bottom_links', []));
    $ente = app(\Modules\Tenant\Actions\Ente\GetEnteDataAction::class)->execute();
    $socialLinks = $ente->social;
    // righe dei recapiti dell'ente, solo quelle con il dato; tel: e mailto: li costruisce EnteData::link() (cifre / indirizzo validato)
    $contactRows = [];
    foreach (['address', 'hours', 'phone', 'toll_free', 'email', 'pec', 'tax_code', 'vat', 'dpo_email'] as $field) {
        $link = $ente->link($field);
        $text = $link['label'] ?? (string) data_get($ente, $field, '');
        if ($text !== '') {
            $label = $field === 'address' ? '' : (string) $d('contact.labels.'.$field);
            $contactRows[] = [
                'label' => $field === 'dpo_email' && $ente->dpo_name !== '' ? $label.' ('.$ente->dpo_name.')' : $label,
                'text' => $text,
                'href' => $link['href'] ?? null,
            ];
        }
    }
    $euSrc = trim((string) $d('eu_logo.src', ''));
    $half = max(1, (int) ceil(count($serviceLinks) / 2));
@endphp
<footer class="it-footer" id="footer">
    <div class="it-footer-main">
        <div class="container">
            <div class="row">
                <div class="col-12 footer-items-wrapper logo-wrapper">
                    @if ($euSrc !== '')
                        <img class="ue-logo" src="{{ \Themes\Sixteen\Infrastructure\Assets\DesignComuniAssets::url($euSrc) }}" alt="{{ $d('eu_logo.alt') }}">
                    @endif
                    <div class="it-brand-wrapper">
                        <a href="{{ \Themes\Sixteen\Infrastructure\Url\FrontofficeUrl::fromStoredUrl('/') }}">
                            {{-- Callers: footer design-comuni; stesso partial dell'header. Schema brand.logo. Istruzione: logo footer = header. --}}
                            @include('pub_theme::components.sections.partials.brand-mark', [
                                'src' => $brandLogo,
                                'size' => 82,
                                'invert' => true,
                            ])
                            <div class="it-brand-text">
                                <h2 class="no_toc">{{ $d('brand.name') }}</h2>
                                @if (filled($d('brand.description')))
                                    <p class="h3">{{ $d('brand.description') }}</p>
                                @endif
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                @if ($adminLinks !== [])
                    <div class="col-md-3 footer-items-wrapper">
                        <h4 class="footer-heading-title">{{ $d('groups.administration.title') }}</h4>
                        <ul class="footer-list">
                            @foreach ($adminLinks as $link)
                                <li><a{!! $attr($link['url'] ?? '') !!}>{{ $link['label'] ?? '' }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if ($serviceLinks !== [])
                    <div class="col-md-6 footer-items-wrapper">
                        <h4 class="footer-heading-title">{{ $d('groups.services.title') }}</h4>
                        <div class="row">
                            @foreach ([array_slice($serviceLinks, 0, $half), array_slice($serviceLinks, $half)] as $column)
                                @if ($column !== [])
                                    <div class="col-md-6">
                                        <ul class="footer-list">
                                            @foreach ($column as $link)
                                                <li><a{!! $attr($link['url'] ?? '') !!}>{{ $link['label'] ?? '' }}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif
                @if ($newsLinks !== [] || $livingLinks !== [])
                    <div class="col-md-3 footer-items-wrapper">
                        @if ($newsLinks !== [])
                            <h4 class="footer-heading-title">{{ $d('groups.news.title') }}</h4>
                            <ul class="footer-list">
                                @foreach ($newsLinks as $link)
                                    <li><a{!! $attr($link['url'] ?? '') !!}>{{ $link['label'] ?? '' }}</a></li>
                                @endforeach
                            </ul>
                        @endif
                        @if ($livingLinks !== [])
                            <h4 class="footer-heading-title">{{ $d('groups.living.title') }}</h4>
                            <ul class="footer-list">
                                @foreach ($livingLinks as $link)
                                    <li><a{!! $attr($link['url'] ?? '') !!}>{{ $link['label'] ?? '' }}</a></li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                @endif
                @if ($contactRows !== [] || $contactLinks !== [] || $legalLinks !== [])
                    <div class="col-md-9 mt-md-4 footer-items-wrapper">
                        @if ($contactRows !== [])
                            <h4 class="footer-heading-title">{{ $d('contact.title') }}</h4>
                        @endif
                        <div class="row">
                            @if ($contactRows !== [])
                                <div class="col-md-4">
                                    <p class="footer-info">
                                        @foreach ($contactRows as $row)
                                            @if (! $loop->first)<br>@endif
                                            @if ($row['label'] !== ''){{ $row['label'] }}: @endif
                                            @if ($row['href'] !== null)<a href="{{ $row['href'] }}">{{ $row['text'] }}</a>@else{!! $lines($row['text']) !!}@endif
                                        @endforeach
                                    </p>
                                </div>
                            @endif
                            @foreach ([$contactLinks, $legalLinks] as $column)
                                @if ($column !== [])
                                    <div class="col-md-4">
                                        <ul class="footer-list">
                                            @foreach ($column as $link)
                                                <li><a{!! $attr($link['url'] ?? '') !!}@if (filled($link['data_element'] ?? null)) data-element="{{ $link['data_element'] }}"@endif>{{ $link['label'] ?? '' }}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif
                @if ($socialLinks !== [])
                    <div class="col-md-3 mt-md-4 footer-items-wrapper">
                        <h4 class="footer-heading-title">{{ $d('social_title') }}</h4>
                        <ul class="list-inline text-start social">
                            @foreach ($socialLinks as $social)
                                <li class="list-inline-item"><a class="p-1 text-white" href="{{ $social['url'] }}" target="_blank" rel="noopener noreferrer"><svg class="icon icon-sm icon-white align-top"><use xlink:href="{{ $icon($social['icon'] ?? 'it-rss') }}"></use></svg><span class="visually-hidden">{{ $social['label'] ?? '' }}</span></a></li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            @if ($bottomLinks !== [])
                <div class="row">
                    <div class="col-12 footer-items-wrapper">
                        <div class="footer-bottom">
                            @foreach ($bottomLinks as $link)
                                <a{!! $attr($link['url'] ?? '') !!}@if (! empty($link['preferences'])) data-cookie-preferences data-element="cookie-preferences"@endif>{{ $link['label'] ?? '' }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</footer>
