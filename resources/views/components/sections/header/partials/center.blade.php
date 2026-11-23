{{--
    Header Design Comuni: fascia centrale con identità, social e ricerca.
    @see Themes/Sixteen/docs/header-components.md
--}}
<div class="it-header-center-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="it-header-center-content-wrapper">
                    <div class="it-brand-wrapper">
                        <a href="{{ $homeHref }}"@if (filled($d('brand.link_title'))) title="{{ $d('brand.link_title') }}"@endif>
                            @include('pub_theme::components.sections.partials.brand-mark', ['src' => $d('brand.logo'), 'size' => 82, 'invert' => true])
                            <div class="it-brand-text">
                                <div class="it-brand-title">{{ $brandTitle }}</div>
                                @if (filled($d('brand.tagline')))
                                    <div class="it-brand-tagline d-none d-md-block">{{ $d('brand.tagline') }}</div>
                                @endif
                            </div>
                        </a>
                    </div>
                    <div class="it-right-zone">
                        @if ($socials !== [])
                            <div class="it-socials d-none d-lg-flex">
                                <span>{{ $d('follow_us') }}</span>
                                <ul>
                                    @foreach ($socials as $social)
                                        <li><a href="{{ $social['url'] }}" target="_blank" rel="noopener noreferrer"><svg class="icon icon-sm icon-white align-top" aria-hidden="true"><use href="{{ $icon($social['icon']) }}"></use></svg><span class="visually-hidden">{{ $social['label'] }}</span></a></li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="it-search-wrapper">
                            <span class="d-none d-md-block">{{ $d('search.label') }}</span>
                            <button class="search-link rounded-icon" type="button" data-bs-toggle="modal" data-bs-target="#search-modal" aria-label="{{ $d('search.aria_label') }}"><svg class="icon" aria-hidden="true"><use href="{{ $icon('it-search') }}"></use></svg></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
