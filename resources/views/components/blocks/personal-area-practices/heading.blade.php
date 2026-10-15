{{--
    Testata dell'area personale (DCP-110): briciole, titolo, descrizione, azione principale e navigazione tra le pagine dell'area
    (stesse classi del riferimento sito/segnalazione-area-personale: `cmp-heading`, `cmp-nav-tab`, `nav-tabs-icon-text`).
    Le "schede" del riferimento qui sono collegamenti veri a quattro pagine diverse (non pannelli nella stessa pagina): per questo
    `<nav>` con `aria-current="page"` e niente `role="tab"`.
    Parametri: $active (practices|followed), $title, $subtitle, $cta (label, url) opzionale. Usa $icon e $locale del chiamante.
--}}
@php
    $localize = static fn (string $path): string => (string) \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getLocalizedURL($locale, $path);
    $tabs = [
        'practices' => ['/area-personale/pratiche', 'it-files'],
        'followed' => ['/area-personale/seguite', 'it-star-outline'],
        'notifications' => ['/area-personale/notifiche', 'it-mail'],
        'settings' => ['/area-personale/impostazioni', 'it-settings'],
    ];
@endphp
<div class="row justify-content-center">
    <div class="col-12 col-lg-10">
        <div class="cmp-breadcrumbs" role="navigation">
            <nav class="breadcrumb-container" aria-label="breadcrumb"><ol class="breadcrumb p-0" data-element="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ $localize('/') }}">{{ __('fixcity::personal_area.breadcrumb.home') }}</a><span class="separator">/</span></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
            </ol></nav>
        </div>
        <div class="cmp-heading pb-3 pb-lg-4">
            <h1 class="title-xxxlarge">{{ $title }}</h1>
            <p class="subtitle-small">{{ $subtitle }}</p>
            @isset($cta)
                <a class="btn btn-primary mt-2" href="{{ $cta['url'] }}"><svg class="icon icon-white icon-sm me-2" aria-hidden="true"><use href="{{ $icon('it-plus-circle') }}"></use></svg><span>{{ $cta['label'] }}</span></a>
            @endisset
        </div>
    </div>
    <div class="col-12 p-0">
        <nav class="cmp-nav-tab mb-4 mb-lg-5 mt-lg-4" aria-label="{{ __('fixcity::personal_area.nav.aria_label') }}">
            <ul class="nav nav-tabs nav-tabs-icon-text w-100 flex-wrap">
                @foreach ($tabs as $key => [$path, $tabIcon])
                    <li class="nav-item">
                        <a @class(['nav-link justify-content-start text-tab', 'active' => $key === $active]) href="{{ $localize($path) }}" @if ($key === $active) aria-current="page" @endif><svg class="icon me-1 mr-lg-10" aria-hidden="true"><use href="{{ $icon($tabIcon) }}"></use></svg> {{ __('fixcity::personal_area.nav.'.$key) }} </a>
                    </li>
                @endforeach
            </ul>
        </nav>
    </div>
</div>
