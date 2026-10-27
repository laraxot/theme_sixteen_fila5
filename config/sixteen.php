<?php

declare(strict_types=1);
use Themes\Sixteen\Filters\ActiveMenuFilter;
use Themes\Sixteen\Filters\GateMenuFilter;
use Themes\Sixteen\Filters\HrefMenuFilter;

/*
 * Solo valori di default: niente env() in questo file. Larastan vieta env()
 * fuori dalla config/ di root (stessa scelta di Modules/Catalog/config/metel.php,
 * Modules/Wts/config/wts.php e altri Modules/*\/config/*.php). Questo file viene
 * caricato da ThemeServiceProvider::loadConfigFrom() via mergeConfigFrom(), quindi
 * non e' sotto config_path() e Larastan lo tratta come codice applicativo.
 * Per override via .env servirebbe un overlay nel ThemeServiceProvider (stesso
 * pattern di CatalogServiceProvider::applyMetelEnvOverrides(), che usa
 * Illuminate\Support\Env::get() invece della funzione env()) — fuori scope qui:
 * il task copre solo i 4 file di config, non i Providers.
 */
return [
    'blog' => [
        'parity' => [
            'feedback' => [
                'title' => 'Quanto sono chiare le informazioni su questa pagina?',
                'legend' => 'Valuta da 1 a 5 stelle la pagina',
                'star_label' => 'Valuta %d stelle su 5',
                'thanks' => 'Grazie, il tuo parere ci aiuterà a migliorare il servizio!',
                'positive' => ['question' => 'Quali sono stati gli aspetti che hai preferito?', 'answers' => ['Le indicazioni erano chiare', 'Le indicazioni erano complete', 'Capivo sempre che stavo procedendo correttamente', 'Non ho avuto problemi tecnici', 'Altro']],
                'negative' => ['question' => 'Dove hai incontrato le maggiori difficoltà?', 'answers' => ['A volte le indicazioni non erano chiare', 'A volte le indicazioni non erano complete', 'A volte non capivo se stavo procedendo correttamente', 'Ho avuto problemi tecnici', 'Altro']],
                'detail' => ['question' => 'Vuoi aggiungere altri dettagli?', 'label' => 'Dettaglio', 'help' => 'Inserire massimo 200 caratteri'],
                'back' => 'Indietro',
                'next' => 'Avanti',
            ],
            'contacts' => [
                'main' => ['title' => 'Contatta il comune', 'items' => [
                    ['icon' => 'it-help-circle', 'label' => 'Leggi le domande frequenti', 'url' => '/domande-frequenti'],
                    ['icon' => 'it-mail', 'label' => 'Richiedi assistenza', 'url' => '/contatti', 'element' => 'contacts'],
                    ['icon' => 'it-hearing', 'label' => 'Chiama il numero verde :value', 'ente' => 'toll_free'],
                    ['icon' => 'it-calendar', 'label' => 'Prenota appuntamento', 'url' => '/servizi', 'element' => 'appointment-booking'],
                ]],
                'problems' => ['title' => 'Problemi in città', 'items' => [['icon' => 'it-map-marker-circle', 'label' => 'Segnala disservizio', 'url' => '/tickets/create']]],
            ],
        ],
    ],
    'events' => [
        'parity' => [
            'title' => 'Vivere il comune',
            'hero' => [
                'text' => 'Tutti gli eventi, le iniziative e i luoghi d’interesse per scoprire e vivere il territorio comunale.',
                'image' => ['file' => 'roma-colosseo.png', 'title' => 'Colosseo, Roma', 'alt' => 'Colosseo di Roma'],
                'caption' => 'Colosseo, Roma. Foto di Griffin Wooldridge.',
            ],
            'card' => ['read_more' => 'Leggi di più', 'read_more_aria' => 'Leggi di più sulla pagina di %s', 'read_more_hidden' => ''],
            'locations' => [
                ['image' => ['file' => 'luoghi-castello-1.png', 'title' => 'Il castello normanno', 'alt' => 'Il castello normanno'], 'title' => 'Il castello normanno', 'text' => 'Scopri la storia e i luoghi di interesse del territorio.'],
                ['image' => ['file' => 'luoghi-castello-2.png', 'title' => 'Il castello normanno', 'alt' => 'Il castello normanno'], 'title' => 'Il castello normanno', 'text' => 'Scopri il programma degli eventi dell’estate.'],
                ['image' => ['file' => 'luoghi-castello-3.png', 'title' => 'Il castello normanno', 'alt' => 'Il castello normanno'], 'title' => 'Il castello normanno', 'text' => 'Un luogo da vivere e conoscere.'],
                ['image' => ['file' => 'luoghi-gipsoteca.png', 'title' => 'La Gipsoteca canoviana', 'alt' => 'La Gipsoteca canoviana'], 'title' => 'La Gipsoteca canoviana', 'text' => 'Modelli in gesso e bozzetti dello scultore Antonio Canova.'],
                ['image' => ['file' => 'luoghi-tomba.png', 'title' => 'Tomba Brion', 'alt' => 'Tomba Brion'], 'title' => 'Tomba Brion', 'text' => 'Un luogo affascinante e ricco di simbologia.'],
                ['image' => ['file' => 'luoghi-castello-4.png', 'title' => 'Il castello normanno', 'alt' => 'Il castello normanno'], 'title' => 'Il castello normanno', 'text' => 'Un itinerario per scoprire il territorio.'],
            ],
        ],
    ],
    /*
    |--------------------------------------------------------------------------
    | Sixteen Theme Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration file per il tema Sixteen Bootstrap Italia
    | Basato sul tema ufficiale italia/design-laravel-theme
    |
    */

    /*
    |--------------------------------------------------------------------------
    | App Information
    |--------------------------------------------------------------------------
    */
    'app' => [
        'name' => config('app.name', 'Applicazione PA'),
        'tagline' => 'Servizi digitali per i cittadini',
        'description' => 'Ente di appartenenza',
        'version' => '1.0.0',
    ],

    /*
    |--------------------------------------------------------------------------
    | Brand Configuration
    |--------------------------------------------------------------------------
    */
    'brand' => [
        'logo' => [
            'type' => 'icon', // 'icon', 'image', 'text'
            'source' => 'heroicon-o-building-office',
            'alt' => 'Logo istituzionale',
            'width' => 40,
            'height' => 40,
        ],
        'colors' => [
            'primary' => '#0066CC',
            'secondary' => '#5A6772',
            'success' => '#00B373',
            'warning' => '#FFB400',
            'danger' => '#D9364F',
        ],
        'favicon' => '/favicon.ico',
    ],

    /*
    |--------------------------------------------------------------------------
    | Layout Configuration
    |--------------------------------------------------------------------------
    */
    'layout' => [
        'slim_header' => [
            'enabled' => true,
            'light_theme' => false,
            'show_owner' => true,
        ],
        'header' => [
            'small' => true,
            'sticky' => true,
            'show_search' => true,
            'show_social' => true,
        ],
        'footer' => [
            'show_social' => true,
            'show_newsletter' => false,
            'show_contacts' => true,
            'show_address' => true,
        ],
        'breadcrumbs' => [
            'enabled' => true,
            'show_home' => true,
            'separator' => '/',
        ],
        'back_to_top' => true,
        'cookiebar' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Configuration
    |--------------------------------------------------------------------------
    */
    'auth' => [
        'enabled' => true,
        'login' => [
            'route' => 'login',
            'text' => 'Accedi',
            'icon' => 'heroicon-o-arrow-right-on-rectangle',
        ],
        'logout' => [
            'route' => 'logout',
            'method' => 'post',
            'text' => 'Esci',
            'icon' => 'heroicon-o-arrow-left-on-rectangle',
        ],
        'register' => [
            'enabled' => true,
            'route' => 'register',
            'text' => 'Registrati',
        ],
        'spid' => [
            'enabled' => false,
            'button_size' => 'medium', // small, medium, large
            'route' => 'spid.login',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Routes Configuration
    |--------------------------------------------------------------------------
    */
    'routes' => [
        'home' => [
            'route' => 'home',
            'url' => '/',
        ],
        'search' => [
            'enabled' => true,
            'route' => 'search',
            'placeholder' => 'Cerca nel sito...',
        ],
        'newsletter' => [
            'enabled' => false,
            'route' => 'newsletter',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Configuration
    |--------------------------------------------------------------------------
    */
    'menu' => [
        'slim_header' => [
            [
                'text' => 'Amministrazione Trasparente',
                'url' => '/amministrazione-trasparente',
                'icon' => 'heroicon-o-eye',
            ],
            [
                'text' => 'Contatti',
                'url' => '/contatti',
                'icon' => 'heroicon-o-phone',
            ],
        ],

        'header' => [
            [
                'text' => 'Home',
                'route' => 'home',
                'icon' => 'heroicon-o-home',
                'active_urls' => ['/', 'home'],
            ],
            [
                'text' => 'Servizi',
                'url' => '/servizi',
                'icon' => 'heroicon-o-cog-6-tooth',
                'dropdown' => [
                    [
                        'text' => 'Certificati anagrafici',
                        'url' => '/servizi/certificati',
                        'icon' => 'heroicon-o-document-text',
                    ],
                    [
                        'text' => 'Tributi e pagamenti',
                        'url' => '/servizi/tributi',
                        'icon' => 'heroicon-o-credit-card',
                    ],
                    [
                        'text' => 'Pratiche edilizie',
                        'url' => '/servizi/pratiche-edilizie',
                        'icon' => 'heroicon-o-building-office-2',
                    ],
                    '-',
                    [
                        'text' => 'Tutti i servizi',
                        'url' => '/servizi',
                        'icon' => 'heroicon-o-squares-2x2',
                    ],
                ],
            ],
            [
                'text' => 'Amministrazione',
                'url' => '/amministrazione',
                'icon' => 'heroicon-o-user-group',
                'megamenu' => [
                    [
                        'Organi di Governo',
                        [
                            'text' => 'Sindaco',
                            'url' => '/amministrazione/sindaco',
                            'icon' => 'heroicon-o-user',
                        ],
                        [
                            'text' => 'Giunta Comunale',
                            'url' => '/amministrazione/giunta',
                            'icon' => 'heroicon-o-users',
                        ],
                        [
                            'text' => 'Consiglio Comunale',
                            'url' => '/amministrazione/consiglio',
                            'icon' => 'heroicon-o-building-library',
                        ],
                    ],
                    [
                        'Uffici e Servizi',
                        [
                            'text' => 'Segreteria',
                            'url' => '/uffici/segreteria',
                            'icon' => 'heroicon-o-clipboard-document-list',
                        ],
                        [
                            'text' => 'Ufficio Tributi',
                            'url' => '/uffici/tributi',
                            'icon' => 'heroicon-o-calculator',
                        ],
                        [
                            'text' => 'Anagrafe',
                            'url' => '/uffici/anagrafe',
                            'icon' => 'heroicon-o-identification',
                        ],
                        [
                            'text' => 'URP',
                            'url' => '/uffici/urp',
                            'icon' => 'heroicon-o-chat-bubble-left-right',
                        ],
                    ],
                ],
            ],
            [
                'text' => 'Notizie',
                'url' => '/notizie',
                'icon' => 'heroicon-o-newspaper',
            ],
            [
                'text' => 'Eventi',
                'url' => '/eventi',
                'icon' => 'heroicon-o-calendar-days',
            ],
        ],

        'footer' => [
            [
                [
                    'text' => 'Amministrazione',
                    'url' => '/amministrazione',
                ],
                [
                    'text' => 'Sindaco',
                    'url' => '/amministrazione/sindaco',
                ],
                [
                    'text' => 'Giunta e Consiglio',
                    'url' => '/amministrazione/organi',
                ],
                [
                    'text' => 'Aree tematiche',
                    'url' => '/aree-tematiche',
                ],
                [
                    'text' => 'Documenti e dati',
                    'url' => '/documenti',
                ],
            ],
            [
                [
                    'text' => 'Servizi',
                    'url' => '/servizi',
                ],
                [
                    'text' => 'Certificati',
                    'url' => '/servizi/certificati',
                ],
                [
                    'text' => 'Pratiche online',
                    'url' => '/servizi/pratiche',
                ],
                [
                    'text' => 'Pagamenti',
                    'url' => '/servizi/pagamenti',
                ],
                [
                    'text' => 'Segnalazioni',
                    'url' => '/servizi/segnalazioni',
                ],
            ],
            [
                [
                    'text' => 'Vivere il comune',
                    'url' => '/vivere-comune',
                ],
                [
                    'text' => 'Luoghi',
                    'url' => '/luoghi',
                ],
                [
                    'text' => 'Eventi',
                    'url' => '/eventi',
                ],
                [
                    'text' => 'Associazioni',
                    'url' => '/associazioni',
                ],
                [
                    'text' => 'Trasporti',
                    'url' => '/trasporti',
                ],
            ],
        ],

        'footer_bar' => [
            [
                'text' => 'Privacy policy',
                'url' => '/privacy',
            ],
            [
                'text' => 'Note legali',
                'url' => '/note-legali',
            ],
            [
                'text' => 'Dichiarazione di accessibilità',
                'url' => '/accessibilita',
            ],
            [
                'text' => 'Mappa del sito',
                'url' => '/mappa-sito',
            ],
            [
                'text' => 'RSS',
                'url' => '/feed',
                'external' => true,
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Contact Information
    |--------------------------------------------------------------------------
    */
    'contact' => [
        'address' => 'Via Roma 1<br>00100 Roma (RM)',
        'phone' => '+39 06 12345678',
        'fax' => null,
        'email' => 'info@comune.esempio.it',
        'pec' => 'protocollo@pec.comune.esempio.it',
        'cf_piva' => '12345678901',
        'ipa_code' => 'c_a123',
        'urp' => [
            'enabled' => true,
            'phone' => null,
            'email' => null,
            'hours' => 'Lun-Ven: 9:00-12:00, 15:00-17:00',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Social Media Links
    |--------------------------------------------------------------------------
    */
    'social' => [
        'facebook' => null,
        'twitter' => null,
        'youtube' => null,
        'instagram' => null,
        'linkedin' => null,
        'telegram' => null,
        'whatsapp' => null,
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Filtri applicati agli elementi del menu prima del rendering
    |
    */
    'menu_filters' => [
        HrefMenuFilter::class,
        ActiveMenuFilter::class,
        GateMenuFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Integrations
    |--------------------------------------------------------------------------
    */
    'integrations' => [
        'analytics' => [
            'google_tag_id' => null,
            'matomo_url' => null,
            'matomo_site_id' => null,
        ],
        'maps' => [
            'provider' => 'osm', // 'google', 'osm', 'mapbox'
            'api_key' => null,
            'default_zoom' => 15,
        ],
        'recaptcha' => [
            'enabled' => false,
            'site_key' => null,
            'secret_key' => null,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Performance Settings
    |--------------------------------------------------------------------------
    */
    'performance' => [
        'cdn_enabled' => false,
        'lazy_loading' => true,
        'preload_critical_css' => true,
        'minify_html' => false,
        'cache_menu' => true,
        'cache_ttl' => 3600, // secondi
    ],

    /*
    |--------------------------------------------------------------------------
    | SEO Configuration
    |--------------------------------------------------------------------------
    */
    'seo' => [
        'meta' => [
            'description' => 'Sito ufficiale del Comune - Servizi digitali per i cittadini',
            'keywords' => 'comune, servizi, cittadini, pubblica amministrazione',
            'author' => 'Comune',
            'robots' => 'index, follow',
        ],
        'og' => [
            'enabled' => true,
            'image' => '/images/og-image.jpg',
            'locale' => 'it_IT',
        ],
        'schema' => [
            'enabled' => true,
            'organization_type' => 'GovernmentOrganization',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Accessibility
    |--------------------------------------------------------------------------
    */
    'accessibility' => [
        'skip_links' => true,
        'high_contrast' => false,
        'font_size_controls' => false,
        'keyboard_navigation' => true,
        'screen_reader_content' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Development & Debug
    |--------------------------------------------------------------------------
    */
    'debug' => [
        'show_menu_debug' => false,
        'show_component_info' => false,
        'log_menu_build' => false,
    ],
];
