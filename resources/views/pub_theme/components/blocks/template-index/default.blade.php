<div class="container px-4 my-4">
    <div class="row">
        <div class="col-12 px-lg-4 py-lg-2">
            <h1 class="mb-2">{{ $data['heading'] }}</h1>
            <span class="fw-semibold">
                <a class="text-muted text-decoration-none" href="https://github.com/italia/design-comuni-pagine-statiche/releases/latest" target="_blank" alt="Link alla release su Github" title="Vai alla release">
                    <svg class="icon icon-sm icon-secondary">
                        <use href="{{ asset('assets/bootstrap-italia/dist/svg/sprites.svg#it-github') }}">
                        </use>
                    </svg>
                    v2.4.0</a></span>
        </div>

        <div class="col-12">
            <ul id="myTab" class="nav nav-tabs auto mt-3" role="tablist">
                @foreach ($data['navigation'] as $nav)
                <li class="nav-item">
                    <a class="nav-link {{ $nav['active'] ? 'active' : '' }}" href="{{ $nav['url'] }}"
                        {{ $nav['active'] ? 'aria-current="page"' : '' }}>{{ $nav['label'] }}</a>
                </li>
                @endforeach
            </ul>
            <div id="myTabContent" class="tab-content">
                <div id="tab1" class="tab-pane fade show active" role="tabpanel" aria-labelledby="tab1-tab">
                    <div class="row">
                        <div class="col-12 col-md-4 px-lg-2 py-lg-2 sticky-top">
                            <nav class="navbar it-navscroll-wrapper navbar-expand-lg it-top-navscroll"
                                data-bs-navscroll>
                                <button class="custom-navbar-toggler" type="button"
                                    aria-controls="navbarNavB" aria-expanded="false"
                                    aria-label="Toggle navigation" data-bs-toggle="navbarcollapsible"
                                    data-bs-target="#navbarNavB">
                                    <span class="it-list"></span>{{ $data['heading'] }}</button>
                                <div class="navbar-collapsable" id="navbarNavB">
                                    <div class="overlay"></div>
                                    <div class="close-div visually-hidden">
                                        <button class="btn close-menu" type="button"><span
                                                class="it-close"></span>close
                                        </button>
                                    </div>
                                    <a class="it-back-button" href="#"><svg class="icon icon-sm icon-primary align-top">
                                            <use href="{{ asset('assets/bootstrap-italia/dist/svg/sprites.svg#it-chevron-left') }}">
                                            </use>
                                        </svg><span>Back </span></a>
                                    <div class="menu-wrapper">
                                        <div class="link-list-wrapper">
                                            <h3>{{ $data['heading'] }}</h3>
                                            <ul class="link-list">
                                                @foreach ($data['sections'] as $section)
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#{{ $section['id'] }}">
                                                        <span>{{ $section['label'] }}</span></a>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </nav>
                        </div>
                        <div class="col-12 col-md-8 px-lg-2 py-lg-2">
                            <div class="my-5">
                                <div class="it-list-wrapper it-page-sections-container">
                                    @foreach ($data['sections'] as $section)
                                    <section id="{{ $section['id'] }}" class="it-page-section">
                                        <h2 id="{{ $section['id'] }}" class="text-secondary">{{ $section['label'] }}
                                        </h2>
                                        @if (isset($section['description']))
                                        <p class="mb-3">{{ $section['description'] }}</p>
                                        @endif
                                        <ul class="it-list mb-5">
                                            @foreach ($section['pages'] as $page)
                                            <li>
                                                <a href="{{ $page['url'] }}" target="_blank"
                                                    class="list-item" data-focus-mouse="false">
                                                    <div class="it-right-zone">
                                                        <span class="text">{{ $page['name'] }}
                                                            @if (isset($page['description']))
                                                            <em>{{ $page['description'] }}</em>
                                                            @endif
                                                        </span>
                                                        <span class="it-multiple"><span
                                                                class="metadata">{{ $page['file'] }}</span></span>
                                                    </div>
                                                </a>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </section>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
