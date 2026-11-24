{{--
    Header Design Comuni: fascia slim.
    @see Themes/Sixteen/docs/header-components.md
    Riceve solo dati già risolti dal renderer v1: il CMS resta la fonte delle etichette.
--}}
<div class="it-header-slim-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="it-header-slim-wrapper-content">
                    @if ($regionLink['name'] !== '')
                        @if ($regionPortalHref !== null)
                            <a class="d-lg-block navbar-brand" target="_blank" rel="noopener noreferrer" href="{{ $regionPortalHref }}" @if ($regionLink['aria_label']) aria-label="{{ $regionLink['aria_label'] }}" @endif @if ($regionLink['title']) title="{{ $regionLink['title'] }}" @endif>{{ $regionLink['name'] }}</a>
                        @else
                            <span class="d-lg-block navbar-brand">{{ $regionLink['name'] }}</span>
                        @endif
                    @endif
                    <div class="it-header-slim-right-zone ms-auto" role="navigation" aria-label="{{ __('pub_theme::header.slim.tools_aria') }}">
                        @include('pub_theme::components.sections.header.partials.language-switcher')
                        @if ($isSignedIn)
                            @include('pub_theme::components.sections.header.partials.user-dropdown')
                        @else
                            @include('pub_theme::components.sections.header.partials.personal-area-login-cta', [
                                'label' => (string) $d('account.label', __('pub_theme::header.guest.cta.label')),
                            ])
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
