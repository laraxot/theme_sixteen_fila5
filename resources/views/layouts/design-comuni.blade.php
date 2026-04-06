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
        .it-header-wrapper { @apply bg-white shadow-sm; }
        .it-header-slim-wrapper { @apply bg-[#007a52] py-2; }
        .it-header-center-wrapper { @apply bg-white py-4; }
        .it-header-navbar-wrapper { @apply bg-[#007a52] py-2; }
        .it-brand-title { @apply text-xl font-bold text-[#17334f]; }
        .it-brand-tagline { @apply text-sm text-gray-600; }
        
        .it-right-zone { @apply flex items-center gap-6; }
        .it-socials { @apply flex items-center gap-3; }
        .it-socials span { @apply text-sm text-gray-600; }
        .it-socials ul { @apply flex gap-2 list-none p-0 m-0; }
        .it-socials a { @apply text-white no-underline hover:opacity-80; }
        
        .it-search-wrapper { @apply flex items-center gap-2; }
        .it-search-wrapper span { @apply text-sm text-gray-600; }
        .search-link { @apply p-2 rounded-full bg-[#0073e6] text-white hover:bg-[#005cb3] transition-colors; }
        
        .skiplink a { @apply bg-[#0073e6] text-white px-4 py-2 no-underline; }
        .evidence-section { @apply bg-[#0073e6] text-white py-12; }
        .card-teaser { @apply bg-white rounded-lg shadow-sm border border-gray-200 p-4; }
        .card-teaser-image { @apply flex; }
        
        /* Footer - Bootstrap Italia style */
        .it-footer-main { @apply bg-[#009699] text-white py-8; }
        .it-footer-main .h4, .it-footer-main h4 { @apply text-white no-underline uppercase text-base mb-3; }
        .it-footer-main .link-list-wrapper ul li a { @apply text-white no-underline py-0 text-base leading-8; }
        .it-footer-main .link-list-wrapper ul li a:hover { @apply underline; }
        .it-footer-main .it-brand-wrapper { @apply py-8; }
        .it-footer-main .it-brand-text { @apply flex flex-col; }
        .it-footer-main .it-brand-title { @apply text-xl font-bold text-white; }
        .it-footer-main .it-brand-tagline { @apply text-sm text-white/80; }
        
        .it-footer-secondary { @apply bg-[#17334f] text-white py-4 border-t border-white/20; }
        .footer-heading-title { @apply text-white no-underline uppercase text-base font-semibold mb-3; }
        .footer-list { @apply list-none p-0 m-0; }
        .footer-list li { @apply mb-2; }
        .footer-list a { @apply text-white no-underline hover:underline; }
        
        /* Colors - Bootstrap Italia */
        .text-primary { color: #007a52; }
        .bg-primary { background-color: #007a52; }
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
                                <svg class="icon icon-sm icon-white"><use xlink:href="#it-expand"></use></svg>
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
                                <svg class="icon icon-primary"><use xlink:href="#it-user"></use></svg>
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
                                <li><a href="#" target="_blank"><svg class="icon icon-sm icon-white"><use xlink:href="#it-twitter"></use></svg><span class="visually-hidden">Twitter</span></a></li>
                                <li><a href="#" target="_blank"><svg class="icon icon-sm icon-white"><use xlink:href="#it-facebook"></use></svg><span class="visually-hidden">Facebook</span></a></li>
                                <li><a href="#" target="_blank"><svg class="icon icon-sm icon-white"><use xlink:href="#it-youtube"></use></svg><span class="visually-hidden">YouTube</span></a></li>
                                <li><a href="#" target="_blank"><svg class="icon icon-sm icon-white"><use xlink:href="#it-telegram"></use></svg><span class="visually-hidden">Telegram</span></a></li>
                                <li><a href="#" target="_blank"><svg class="icon icon-sm icon-white"><use xlink:href="#it-whatsapp"></use></svg><span class="visually-hidden">Whatsapp</span></a></li>
                                <li><a href="#" target="_blank"><svg class="icon icon-sm icon-white"><use xlink:href="#it-rss"></use></svg><span class="visually-hidden">RSS</span></a></li>
                            </ul>
                        </div>
                        <div class="it-search-wrapper">
                            <span class="d-none d-md-block">Cerca</span>
                            <button class="search-link" type="button" aria-label="Cerca nel sito">
                                <svg class="icon"><use xlink:href="#it-search"></use></svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Header Navbar - Navigation -->
        <div class="it-header-navbar-wrapper" id="header-nav-wrapper" x-data="mobileMenu()" @keydown.escape="close()">
            <div class="container">
                <div class="navbar navbar-expand-lg">
                    <button 
                        class="navbar-toggler md:hidden" 
                        type="button" 
                        @click="toggle()"
                        :aria-expanded="isOpen"
                        aria-controls="nav4" 
                        aria-label="Mostra/Nascondi la navigazione" 
                        data-bs-target="#nav4" 
                        data-bs-toggle="collapse"
                    >
                        <svg class="icon text-white"><use xlink:href="#it-burger"></use></svg>
                    </button>
                    <div 
                        class="collapse navbar-collapse transition-all duration-300" 
                        id="nav4"
                        x-show="isOpen || !isMobile()"
                        @click.outside="close()"
                    >
                        <div class="menu-wrapper">
                            <nav aria-label="Principale">
                                <ul class="navbar-nav" data-element="main-navigation">
                                    <li class="nav-item"><a class="nav-link" href="#" @click="closeOnItemClick()">Amministrazione</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#" @click="closeOnItemClick()">Novità</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#" @click="closeOnItemClick()">Servizi</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#" @click="closeOnItemClick()">Vivere il Comune</a></li>
                                </ul>
                            </nav>
                            <nav aria-label="Secondaria">
                                <ul class="navbar-nav navbar-secondary">
                                    <li class="nav-item"><a class="nav-link" href="#" @click="closeOnItemClick()">Iscrizioni</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#" @click="closeOnItemClick()">Estate in città</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#" @click="closeOnItemClick()">Polizia locale</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#" @click="closeOnItemClick()">Tutti gli argomenti</a></li>
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