@props(['municipality' => '', 'subtitle' => '', 'logo' => '', 'social' => [], 'search' => [], 'items' => []])

<div class="it-nav-wrapper">
    {{-- Header Center --}}
    <div class="it-header-center-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="it-header-center-content-wrapper">
                        <div class="it-brand-wrapper">
                            <a href="/">
                                <svg width="82" height="82" class="icon" aria-hidden="true">
                                    <image xlink:href="{{ $logo ?: '/themes/Sixteen/images/logo-comune.svg' }}"/>
                                </svg>
                                <div class="it-brand-text">
                                    <div class="it-brand-title">{{ $municipality ?: 'Il mio Comune' }}</div>
                                    @if($subtitle)
                                    <div class="it-brand-tagline d-none d-md-block">{{ $subtitle }}</div>
                                    @endif
                                </div>
                            </a>
                        </div>
                        <div class="it-right-zone">
                            @if(!empty($social))
                            <div class="it-socials d-none d-lg-flex">
                                <span>Seguici su</span>
                                <ul>
                                    @foreach($social as $s)
                                    <li>
                                        <a href="{{ $s['url'] ?? '#' }}" target="_blank">
                                            <svg class="icon icon-sm icon-white align-top">
                                                <use xlink:href="#it-{{ $s['platform'] ?? '' }}"></use>
                                            </svg>
                                            <span class="visually-hidden">{{ ucfirst($s['platform'] ?? '') }}</span>
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            <div class="it-search-wrapper">
                                <span class="d-none d-md-block">Cerca</span>
                                <button class="search-link rounded-icon" type="button" data-bs-toggle="modal" data-bs-target="#search-modal" aria-label="Cerca nel sito">
                                    <svg class="icon">
                                        <use href="#it-search"></use>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Navbar --}}
    <div class="it-header-navbar-wrapper" id="header-nav-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="navbar navbar-expand-lg has-megamenu">
                        <button class="custom-navbar-toggler" type="button" aria-controls="nav-main" aria-expanded="false" aria-label="Mostra/Nascondi la navigazione" data-bs-target="#nav-main" data-bs-toggle="navbarcollapsible">
                            <svg class="icon">
                                <use href="#it-burger"></use>
                            </svg>
                        </button>
                        <div class="navbar-collapsable" id="nav-main">
                            <div class="overlay" style="display: none;"></div>
                            <div class="close-div">
                                <button class="btn close-menu" type="button">
                                    <span class="visually-hidden">Nascondi la navigazione</span>
                                    <svg class="icon">
                                        <use href="#it-close-big"></use>
                                    </svg>
                                </button>
                            </div>
                            <div class="menu-wrapper">
                                <a href="/" class="logo-hamburger">
                                    <svg class="icon" aria-hidden="true">
                                        <use href="#it-pa"></use>
                                    </svg>
                                    <div class="it-brand-text">
                                        <div class="it-brand-title">{{ $municipality ?: 'Il mio Comune' }}</div>
                                    </div>
                                </a>
                                <nav aria-label="Navigazione principale">
                                    <ul class="navbar-nav">
                                        @foreach($items as $item)
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ $item['url'] ?? '#' }}">
                                                <span>{{ $item['label'] ?? '' }}</span>
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Search Modal --}}
<div class="modal fade" id="search-modal" tabindex="-1" aria-labelledby="search-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="search-modal-label">Cerca nel sito</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Chiudi"></button>
            </div>
            <div class="modal-body">
                <form action="{{ $search['action'] ?? '/it/ricerca' }}" method="get">
                    <div class="mb-3">
                        <label for="search-modal-input" class="form-label">Parola chiave</label>
                        <input type="text" class="form-control" id="search-modal-input" name="q" placeholder="Cerca una parola chiave">
                    </div>
                    <button type="submit" class="btn btn-primary">Cerca</button>
                </form>
            </div>
        </div>
    </div>
</div>
