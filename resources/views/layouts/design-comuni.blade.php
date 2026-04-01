<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nome del Comune</title>
    <meta name="description" content="">
    
    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css'], 'themes/Sixteen')
    
    <style>
        [x-cloak] { display: none !important; }
        
        /* Design Comuni Header Styles - Tailwind equivalent */
        .it-header-wrapper { @apply bg-white; }
        .it-header-slim-wrapper { @apply bg-[#0066CC] py-2; }
        .it-header-slim-wrapper-content { @apply flex justify-between items-center; }
        .it-header-slim-right-zone { @apply flex items-center gap-4; }
        .navbar-brand { @apply text-white text-sm font-semibold no-underline hover:underline; }
        
        .it-header-center-wrapper { @apply py-4; }
        .it-brand-wrapper { @apply flex items-center gap-3; }
        .it-brand-text { @apply flex flex-col; }
        .it-brand-title { @apply text-xl font-bold text-[#0066CC]; }
        .it-brand-tagline { @apply text-sm text-gray-600; }
        
        .it-right-zone { @apply flex items-center gap-6; }
        .it-socials { @apply flex items-center gap-3; }
        .it-socials span { @apply text-sm text-gray-600; }
        .it-socials ul { @apply flex gap-2 list-none p-0 m-0; }
        .it-socials a { @apply text-white no-underline hover:opacity-80; }
        
        .it-search-wrapper { @apply flex items-center gap-2; }
        .it-search-wrapper span { @apply text-sm text-gray-600; }
        .search-link { @apply p-2 rounded-full bg-[#0066CC] text-white hover:bg-[#0052A3] transition-colors; }
        
        .it-header-navbar-wrapper { @apply bg-[#0066CC]; }
        .navbar { @apply flex items-center justify-between; }
        .navbar-nav { @apply flex list-none m-0 p-0 gap-4; }
        .navbar-nav a { @apply text-white no-underline hover:opacity-80 py-2 block; }
        .navbar-secondary { @apply hidden lg:flex; }
        
        /* Footer */
        .it-footer-main { @apply bg-[#003D73] text-white py-8; }
        .it-footer-secondary { @apply bg-black text-white py-4 border-t border-gray-700; }
        
        /* Skip link */
        .skiplink { @apply fixed top-0 left-0 -translate-y-full focus:translate-y-0 z-50 transition-transform; }
        .skiplink a { @apply bg-[#0066CC] text-white px-4 py-2 no-underline; }
        .visually-hidden { @apply absolute w-px h-px p-0 -m-px overflow-hidden whitespace-nowrap border-0; }
        .visually-hidden-focusable { @apply absolute w-px h-px p-0 -m-px overflow-hidden whitespace-nowrap border-0; }
        .visually-hidden-focusable:focus { @apply static w-auto h-auto p-2 overflow-visible whitespace-normal; }
        
        /* Hero Section */
        .head-section { @apply py-8; }
        .category-top { @apply flex items-center gap-2 text-sm text-gray-600 mb-2; }
        .card-title { @apply text-xl font-semibold text-gray-900 mb-2; }
        .read-more { @apply flex items-center gap-1 text-[#0066CC] no-underline hover:underline; }
        .chip { @apply inline-block px-3 py-1 bg-gray-100 rounded-full text-sm no-underline hover:bg-gray-200; }
        .chip-simple { @apply bg-transparent border border-gray-300; }
        
        /* Sections */
        .section-muted { @apply bg-gray-50; }
        .evidence-section { @apply bg-[#0066CC] text-white py-12; }
        .card-teaser { @apply bg-white rounded-lg shadow-sm border border-gray-200 p-4; }
        .card-teaser-image { @apply flex; }
        
        /* Colors */
        .text-primary { color: #0066CC; }
        .bg-primary { background-color: #0066CC; }
        .icon { @apply w-6 h-6 inline; }
        .icon-sm { @apply w-4 h-4; }
        .icon-white { @apply text-white; }
    </style>
</head>
<body>
    <!-- Skip Links -->
    <div class="skiplink">
        <a class="visually-hidden-focusable" href="#main-container">Vai ai contenuti</a>
        <a class="visually-hidden-focusable" href="#footer">Vai al footer</a>
    </div>

    <!-- Header -->
    <header class="it-header-wrapper">
        <!-- Header Slim - Top Bar -->
        <div class="it-header-slim-wrapper">
            <div class="container">
                <div class="it-header-slim-wrapper-content">
                    <a class="navbar-brand" href="#" target="_blank">Nome della Regione</a>
                    <div class="it-header-slim-right-zone" role="navigation">
                        <div class="nav-item dropdown">
                            <button type="button" class="nav-link dropdown-toggle text-white bg-transparent border-0 cursor-pointer flex items-center gap-1" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="visually-hidden">Lingua attiva:</span>
                                <span>ITA</span>
                                <svg class="icon icon-sm icon-white"><use href="#it-expand"></use></svg>
                            </button>
                            <div class="dropdown-menu">
                                <div class="link-list-wrapper">
                                    <ul class="link-list">
                                        <li><a class="dropdown-item" href="#"><span>ITA <span class="visually-hidden">selezionata</span></span></a></li>
                                        <li><a class="dropdown-item" href="#"><span>ENG</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <a class="btn btn-primary btn-icon btn-full" href="#" data-element="personal-area-login">
                            <span class="rounded-icon" aria-hidden="true">
                                <svg class="icon icon-primary"><use href="#it-user"></use></svg>
                            </span>
                            <span class="d-none d-lg-block">Accedi all'area personale</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Header Center - Logo & Search -->
        <div class="it-header-center-wrapper">
            <div class="container">
                <div class="it-header-center-content-wrapper flex justify-between items-center">
                    <div class="it-brand-wrapper">
                        <a href="#">
                            <svg width="82" height="82" class="icon" aria-hidden="true">
                                <image xlink:href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Ccircle cx='50' cy='50' r='45' fill='%230066CC'/%3E%3Ctext x='50' y='60' font-size='40' text-anchor='middle' fill='white'%3EC%3C/text%3E%3C/svg%3E" width="82" height="82"/>
                            </svg>
                            <div class="it-brand-text">
                                <div class="it-brand-title">Nome del Comune</div>
                                <div class="it-brand-tagline d-none d-md-block">Un comune da vivere</div>
                            </div>
                        </a>
                    </div>
                    <div class="it-right-zone">
                        <div class="it-socials d-none d-lg-flex">
                            <span>Seguici su</span>
                            <ul>
                                <li><a href="#" target="_blank"><svg class="icon icon-sm icon-white"><use href="#it-twitter"></use></svg><span class="visually-hidden">Twitter</span></a></li>
                                <li><a href="#" target="_blank"><svg class="icon icon-sm icon-white"><use href="#it-facebook"></use></svg><span class="visually-hidden">Facebook</span></a></li>
                                <li><a href="#" target="_blank"><svg class="icon icon-sm icon-white"><use href="#it-youtube"></use></svg><span class="visually-hidden">YouTube</span></a></li>
                                <li><a href="#" target="_blank"><svg class="icon icon-sm icon-white"><use href="#it-telegram"></use></svg><span class="visually-hidden">Telegram</span></a></li>
                                <li><a href="#" target="_blank"><svg class="icon icon-sm icon-white"><use href="#it-whatsapp"></use></svg><span class="visually-hidden">Whatsapp</span></a></li>
                                <li><a href="#" target="_blank"><svg class="icon icon-sm icon-white"><use href="#it-rss"></use></svg><span class="visually-hidden">RSS</span></a></li>
                            </ul>
                        </div>
                        <div class="it-search-wrapper">
                            <span class="d-none d-md-block">Cerca</span>
                            <button class="search-link" type="button" aria-label="Cerca nel sito">
                                <svg class="icon"><use href="#it-search"></use></svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Header Navbar - Navigation -->
        <div class="it-header-navbar-wrapper" id="header-nav-wrapper">
            <div class="container">
                <div class="navbar navbar-expand-lg">
                    <button class="navbar-toggler" type="button" aria-controls="nav4" aria-expanded="false" aria-label="Mostra/Nascondi la navigazione" data-bs-target="#nav4" data-bs-toggle="collapse">
                        <svg class="icon text-white"><use href="#it-burger"></use></svg>
                    </button>
                    <div class="collapse navbar-collapse" id="nav4">
                        <div class="menu-wrapper">
                            <nav aria-label="Principale">
                                <ul class="navbar-nav" data-element="main-navigation">
                                    <li class="nav-item"><a class="nav-link" href="#">Amministrazione</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#">Novità</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#">Servizi</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#">Vivere il Comune</a></li>
                                </ul>
                            </nav>
                            <nav aria-label="Secondaria">
                                <ul class="navbar-nav navbar-secondary">
                                    <li class="nav-item"><a class="nav-link" href="#">Iscrizioni</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#">Estate in città</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#">Polizia locale</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#">Tutti gli argomenti</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main>
        <h1 class="visually-hidden" id="main-container">Nome del comune</h1>
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="it-footer" id="footer">
        <div class="it-footer-main">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="it-brand-wrapper mb-4">
                            <a href="#">
                                <svg width="82" height="82" class="icon" aria-hidden="true">
                                    <image xlink:href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Ccircle cx='50' cy='50' r='45' fill='white'/%3E%3Ctext x='50' y='60' font-size='40' text-anchor='middle' fill='%230066CC'%3EC%3C/text%3E%3C/svg%3E" width="82" height="82"/>
                                </svg>
                                <div class="it-brand-text">
                                    <div class="it-brand-title text-white">Nome del Comune</div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <h3 class="footer-heading-title">Amministrazione</h3>
                        <ul class="footer-list">
                            <li><a href="#">Organi di governo</a></li>
                            <li><a href="#">Aree amministrative</a></li>
                            <li><a href="#">Uffici</a></li>
                            <li><a href="#">Enti e fondazioni</a></li>
                            <li><a href="#">Politici</a></li>
                            <li><a href="#">Personale amministrativo</a></li>
                            <li><a href="#">Documenti e dati</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3">
                        <h3 class="footer-heading-title">Categorie di servizio</h3>
                        <ul class="footer-list">
                            <li><a href="#">Anagrafe e stato civile</a></li>
                            <li><a href="#">Cultura e tempo libero</a></li>
                            <li><a href="#">Vita lavorativa</a></li>
                            <li><a href="#">Imprese e commercio</a></li>
                            <li><a href="#">Appalti pubblici</a></li>
                            <li><a href="#">Catasto e urbanistica</a></li>
                            <li><a href="#">Turismo</a></li>
                            <li><a href="#">Mobilità e trasporti</a></li>
                            <li><a href="#">Educazione e formazione</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3">
                        <h3 class="footer-heading-title">Novità</h3>
                        <ul class="footer-list">
                            <li><a href="#">Notizie</a></li>
                            <li><a href="#">Comunicati</a></li>
                            <li><a href="#">Avvisi</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3">
                        <h3 class="footer-heading-title">Contatti</h3>
                        <ul class="footer-list">
                            <li>Comune di Nome Comune</li>
                            <li>Via Roma 123 - 00100 Comune</li>
                            <li>Codice fiscale: 00123456789</li>
                            <li><a href="#">Ufficio Relazioni con il Pubblico</a></li>
                            <li>Numero verde: 800 016 123</li>
                            <li>Posta Elettronica Certificata</li>
                            <li>Centralino unico: 012 3456</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="it-footer-secondary">
            <div class="container">
                <div class="row">
                    <div class="col-12 d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <ul class="footer-list d-flex gap-4 mb-0">
                            <li><a href="#">Leggi le FAQ</a></li>
                            <li><a href="#">Prenotazione appuntamento</a></li>
                            <li><a href="#">Segnalazione disservizio</a></li>
                            <li><a href="#">Richiesta d'assistenza</a></li>
                        </ul>
                        <ul class="footer-list d-flex gap-4 mb-0">
                            <li><a href="#">Amministrazione trasparente</a></li>
                            <li><a href="#">Informativa privacy</a></li>
                            <li><a href="#">Note legali</a></li>
                            <li><a href="#">Dichiarazione di accessibilità</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Tailwind JS -->
    @vite(['resources/js/app.js'], 'themes/Sixteen')
</body>
</html>