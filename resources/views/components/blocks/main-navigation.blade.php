@props(['data' => []])

{{-- 
    Main Navigation Component - Design Comuni Style
    Usage: <x-blocks.main-navigation :data="$navData" />
    
    Data structure:
    - menu_items: array
--}}

@php
    $menuItems = $data['menu_items'] ?? [
        ['label' => __('pub_theme::header.center.nav.amministrazione.label'), 'url' => '/it/tests/amministrazione', 'submenu' => [
            ['label' => __('pub_theme::components_footer.admin.governing_bodies.label'), 'url' => '#'],
            ['label' => __('pub_theme::components_footer.admin.administrative_areas.label'), 'url' => '#'],
            ['label' => __('pub_theme::components_footer.admin.offices.label'), 'url' => '#'],
            ['label' => __('pub_theme::components_footer.admin.bodies_foundations.label'), 'url' => '#'],
        ]],
        ['label' => __('pub_theme::header.center.nav.novita.label'), 'url' => '/it/tests/novita', 'submenu' => [
            ['label' => __('pub_theme::components_footer.news.news.label'), 'url' => '#'],
            ['label' => __('pub_theme::components_footer.news.press_releases.label'), 'url' => '#'],
            ['label' => __('pub_theme::components_footer.news.notices.label'), 'url' => '#'],
        ]],
        ['label' => __('pub_theme::header.center.nav.servizi.label'), 'url' => '/it/tests/servizi', 'submenu' => []],
        ['label' => __('pub_theme::header.center.nav.vivere.label').'4', 'url' => '/it/tests/vivere', 'submenu' => [
            ['label' => __('pub_theme::components_footer.live.places.label'), 'url' => '#'],
            ['label' => __('pub_theme::components_footer.live.events.label'), 'url' => '#'],
        ]],
        ['label' => __('pub_theme::header.center.nav.argomenti.label'), 'url' => '/it/tests/argomenti', 'highlighted' => true],
    ];
@endphp

<nav class="it-nav-wrapper bg-white border-bottom" aria-label="{{ __('pub_theme::components_common.a11y.main_navigation.label') }}">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="navbar navbar-expand-lg">
                    <button 
                        class="navbar-toggler" 
                        type="button" 
                        data-bs-toggle="collapse" 
                        data-bs-target="#mainNavigation"
                        aria-controls="mainNavigation"
                        aria-expanded="false"
                        aria-label="{{ __('pub_theme::components_common.a11y.toggle_navigation.label') }}"
                    >
                        <span class="navbar-toggler-icon"></span>
                        <span class="sr-only">{{ __('pub_theme::header.center.nav.close_aria.label') }}</span>
                    </button>
                    
                    <div class="collapse navbar-collapse" id="mainNavigation">
                        <ul class="navbar-nav">
                            @foreach($menuItems as $item)
                            <li class="nav-item {{ isset($item['highlighted']) ? 'highlighted' : '' }}">
                                <a 
                                    href="{{ $item['url'] }}" 
                                    class="nav-link px-3 py-3 {{ isset($item['highlighted']) ? 'fw-bold text-primary' : '' }}"
                                    @if(isset($item['submenu']) && count($item['submenu']) > 0)
                                        aria-haspopup="true" 
                                        aria-expanded="false"
                                    @endif
                                >
                                    {{ $item['label'] }}
                                </a>
                                
                                @if(isset($item['submenu']) && count($item['submenu']) > 0)
                                <div class="submenu-wrapper">
                                    <ul class="submenu-list">
                                        @foreach($item['submenu'] as $submenuItem)
                                        <li>
                                            <a href="{{ $submenuItem['url'] }}" class="submenu-link">
                                                {{ $submenuItem['label'] }}
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
