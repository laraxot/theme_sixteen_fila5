{{--
    Area personale con schede (tab). Chiavi: breadcrumb, heading, tabs {id, items[] {label, icon, target, aria_controls, active}},
    panes[] {id, active, side_nav, col_class, sections[]} (un pannello per scheda, anche vuoto), contacts, modals[].
    Il cambio di scheda richiede il comportamento `data-bs-toggle="tab"` generalizzato (oggi solo `#tabDisservizio`: vedi story DCP-21).
--}}
@php
    $d = static fn (string $key, mixed $default = '') => data_get($data, $key, $default);
    $parts = 'pub_theme::components.blocks.service-flow.parts';
    $assets = \Themes\Sixteen\Infrastructure\Assets\DesignComuniAssets::base();
    $icon = static fn (string $name): string => $assets.'/bootstrap-italia/dist/svg/sprites.svg#'.$name;
@endphp
<div class="container" id="main-container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            @include("$parts.breadcrumb")
            @include("$parts.heading")
        </div>
        <div class="col-12 p-0">
            <div class="cmp-nav-tab mb-4 mb-lg-5 mt-lg-4">
                <ul class="nav nav-tabs nav-tabs-icon-text w-100 flex-nowrap" id="{{ $d('tabs.id', 'myTab') }}" role="tablist">
                    @foreach ($d('tabs.items', []) as $tab)
                        <li class="nav-item w-100" role="tab">
                            <a @class(['nav-link justify-content-start text-tab', 'active' => $tab['active'] ?? false]) href="#{{ $tab['target'] ?? '' }}" aria-current="page" aria-controls="{{ $tab['aria_controls'] ?? '' }}" aria-selected="false" data-bs-toggle="tab" role="button" data-focus-mouse="false">
                                <svg class="icon me-1 mr-lg-10" aria-hidden="true"><use href="{{ $icon($tab['icon'] ?? '') }}"></use></svg> {{ $tab['label'] ?? '' }} </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="it-page-sections-container">
        <div class="tab-content">
            @foreach ($d('panes', []) as $pane)
                <div class="{{ ($pane['active'] ?? false) ? 'tab-pane fade show active' : 'tab-pane' }}" id="{{ $pane['id'] ?? '' }}" role="tabpanel">
                    @if (filled($pane['sections'] ?? null))
                        <div class="row">
                            @include("$parts.side-index", ['sideNav' => $pane['side_nav'] ?? []])
                            <div class="{{ $pane['col_class'] ?? 'col-12 col-lg-8 offset-lg-1' }}">
                                @include("$parts.sections", ['sections' => $pane['sections']])
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</div>
@include("$parts.contacts", ['related' => null])
@include("$parts.modals")
