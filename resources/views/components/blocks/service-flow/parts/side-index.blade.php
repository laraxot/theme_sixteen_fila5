{{--
    Indice laterale con barra di avanzamento (scroll-spy `dcNavscroll`, montato per selettore `[data-bs-navscroll]`).
    `$sideNav`: title, aria_label, items[] {label, anchor}, class (classi della colonna), suffix (id dell'accordion, default "one").
--}}
@php
    $assets = \Themes\Sixteen\Infrastructure\Assets\DesignComuniAssets::base();
    $icon = static fn (string $name): string => $assets.'/bootstrap-italia/dist/svg/sprites.svg#'.$name;
    $suffix = $sideNav['suffix'] ?? 'one';
@endphp
<div class="{{ $sideNav['class'] ?? 'col-12 col-lg-3 mb-4 d-none d-lg-block' }}">
    <div class="cmp-navscroll sticky-top" aria-labelledby="accordion-title-{{ $suffix }}">
        <nav class="navbar it-navscroll-wrapper navbar-expand-lg" aria-label="{{ $sideNav['aria_label'] ?? '' }}" data-bs-navscroll>
            <div class="navbar-custom" id="navbarNavProgress">
                <div class="menu-wrapper">
                    <div class="link-list-wrapper">
                        <div class="accordion">
                            <div class="accordion-item">
                                <span class="accordion-header" id="accordion-title-{{ $suffix }}">
                                    <button class="accordion-button pb-10 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $suffix }}" aria-expanded="true" aria-controls="collapse-{{ $suffix }}"> {{ $sideNav['title'] ?? '' }}
                                        <svg class="icon icon-xs right"><use href="{{ $icon('it-expand') }}"></use></svg></button>
                                </span>
                                <div class="progress">
                                    <div class="progress-bar it-navscroll-progressbar" role="progressbar" aria-label="{{ __('pub_theme::a11y.reading_progress') }}" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div id="collapse-{{ $suffix }}" class="accordion-collapse collapse show" role="region" aria-labelledby="accordion-title-{{ $suffix }}">
                                    <div class="accordion-body">
                                        <ul class="link-list" data-element="page-index">
                                            @foreach ($sideNav['items'] ?? [] as $item)
                                                <li class="nav-item"><a class="nav-link" href="#{{ $item['anchor'] ?? '' }}"><span>{{ $item['label'] ?? '' }}</span></a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</div>
