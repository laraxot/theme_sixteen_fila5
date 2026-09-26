<?php

declare(strict_types=1);

<<<<<<< HEAD
=======
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
>>>>>>> laraxot/dev
return [
    /*
    |--------------------------------------------------------------------------
    | CIE Configuration
    |--------------------------------------------------------------------------
    |
    | Configurazione per l'integrazione CIE (Carta di Identità Elettronica)
    | secondo le specifiche AGID per l'identità digitale
    |
    */

    /*
    |--------------------------------------------------------------------------
    | Environment
    |--------------------------------------------------------------------------
    |
    | Ambiente CIE da utilizzare: preprod (pre-produzione) o prod (produzione)
    |
    */
<<<<<<< HEAD
    'environment' => env('CIE_ENVIRONMENT', 'preprod'),
=======
    'environment' => 'preprod',
>>>>>>> laraxot/dev

    /*
    |--------------------------------------------------------------------------
    | Base URLs per ambienti
    |--------------------------------------------------------------------------
    */
    'urls' => [
        'preprod' => [
            'base_url' => 'https://preprod.idserver.servizicie.interno.gov.it/idp',
            'federation_url' => 'https://preprod.idserver.servizicie.interno.gov.it/idp/federation',
        ],
        'prod' => [
            'base_url' => 'https://idserver.servizicie.interno.gov.it/idp',
            'federation_url' => 'https://idserver.servizicie.interno.gov.it/idp/federation',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | OAuth2 Client Configuration
    |--------------------------------------------------------------------------
    |
    | Credenziali OAuth2 per l'integrazione CIE
    | Ottenibili dal portale sviluppatori CIE
    |
    */
<<<<<<< HEAD
    'client_id' => env('CIE_CLIENT_ID'),
    'client_secret' => env('CIE_CLIENT_SECRET'),
=======
    'client_id' => null,
    'client_secret' => null,
>>>>>>> laraxot/dev

    /*
    |--------------------------------------------------------------------------
    | Redirect URIs
    |--------------------------------------------------------------------------
    |
    | URL di callback per l'autenticazione CIE
    |
    */
    'redirect_uris' => [
<<<<<<< HEAD
        'callback' => env('CIE_REDIRECT_URI', route('cie.callback')),
        'logout' => env('CIE_LOGOUT_REDIRECT_URI', route('home')),
=======
        'callback' => route('cie.callback'),
        'logout' => route('home'),
>>>>>>> laraxot/dev
    ],

    /*
    |--------------------------------------------------------------------------
    | Scopes OIDC
    |--------------------------------------------------------------------------
    |
    | Scope OpenID Connect richiesti
    |
    */
    'scopes' => [
        'openid',           // Obbligatorio per OIDC
        'profile',          // Informazioni profilo utente
        'email',            // Indirizzo email
        'offline_access',   // Refresh token per sessioni prolungate
    ],

    /*
    |--------------------------------------------------------------------------
    | ACR Values
    |--------------------------------------------------------------------------
    |
    | Authentication Context Class Reference per livelli CIE
    |
    */
    'acr_values' => [
        'level_2' => 'https://www.spid.gov.it/SpidL2',
        'level_3' => 'https://www.spid.gov.it/SpidL3',
    ],

    /*
    |--------------------------------------------------------------------------
    | Default Settings
    |--------------------------------------------------------------------------
    */
<<<<<<< HEAD
    'default_level' => env('CIE_DEFAULT_LEVEL', 'level_2'),
=======
    'default_level' => 'level_2',
>>>>>>> laraxot/dev
    'prompt' => 'login', // Forza sempre l'autenticazione
    'response_type' => 'code',
    'response_mode' => 'form_post',

    /*
    |--------------------------------------------------------------------------
    | Mobile App Integration
    |--------------------------------------------------------------------------
    |
    | Configurazione per l'integrazione con l'app CieID mobile
    |
    */
    'mobile' => [
<<<<<<< HEAD
        'enabled' => env('CIE_MOBILE_ENABLED', true),
        'app_scheme' => 'cieid',
        'universal_link' => env('CIE_UNIVERSAL_LINK', 'https://www.cartaidentita.interno.gov.it/cie-id'),
=======
        'enabled' => true,
        'app_scheme' => 'cieid',
        'universal_link' => 'https://www.cartaidentita.interno.gov.it/cie-id',
>>>>>>> laraxot/dev
        'deep_link_timeout' => 10, // secondi
        'fallback_to_web' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Token Configuration
    |--------------------------------------------------------------------------
    */
    'token' => [
        'validation' => [
            'verify_signature' => true,
            'verify_audience' => true,
            'verify_issuer' => true,
            'verify_expiry' => true,
            'verify_nonce' => true,
        ],
        'algorithms' => ['RS256', 'RS384', 'RS512'], // Algoritmi JWT supportati
        'leeway' => 60, // Tolleranza per timestamp (secondi)
    ],

    /*
    |--------------------------------------------------------------------------
    | User Attributes Mapping
    |--------------------------------------------------------------------------
    |
    | Mappatura degli attributi CIE ai campi applicazione
    |
    */
    'user_mapping' => [
        'id' => 'sub',
        'name' => 'given_name',
        'surname' => 'family_name',
        'full_name' => 'name',
        'fiscal_code' => 'fiscal_number',
        'email' => 'email',
        'email_verified' => 'email_verified',
        'phone' => 'phone_number',
        'phone_verified' => 'phone_number_verified',
        'birth_date' => 'birthdate',
        'birth_place' => 'place_of_birth',
        'gender' => 'gender',
        'address' => 'address',
        'locale' => 'locale',
        'timezone' => 'zoneinfo',
    ],

    /*
    |--------------------------------------------------------------------------
    | Session Configuration
    |--------------------------------------------------------------------------
    */
    'session' => [
<<<<<<< HEAD
        'timeout' => env('CIE_SESSION_TIMEOUT', 3600), // 1 ora
        'extend_on_activity' => env('CIE_EXTEND_SESSION', true),
        'remember_me' => env('CIE_REMEMBER_ME', false),
=======
        'timeout' => 3600, // 1 ora
        'extend_on_activity' => true,
        'remember_me' => false,
>>>>>>> laraxot/dev
        'max_remember_duration' => 86400 * 30, // 30 giorni
    ],

    /*
    |--------------------------------------------------------------------------
    | Security Settings
    |--------------------------------------------------------------------------
    */
    'security' => [
        'state_length' => 64,       // Lunghezza state parameter
        'nonce_length' => 64,       // Lunghezza nonce
        'pkce_enabled' => true,     // Proof Key for Code Exchange
        'pkce_method' => 'S256',    // Challenge method
<<<<<<< HEAD
        'require_https' => env('CIE_REQUIRE_HTTPS', env('APP_ENV') === 'production'),
=======
        'require_https' => config('app.env') === 'production',
>>>>>>> laraxot/dev
    ],

    /*
    |--------------------------------------------------------------------------
    | Routes Configuration
    |--------------------------------------------------------------------------
    */
    'routes' => [
<<<<<<< HEAD
        'prefix' => env('CIE_ROUTES_PREFIX', 'auth/cie'),
=======
        'prefix' => 'auth/cie',
>>>>>>> laraxot/dev
        'middleware' => ['web'],
        'names' => [
            'login' => 'cie.login',
            'mobile' => 'cie.mobile',
            'callback' => 'cie.callback',
            'logout' => 'cie.logout',
            'refresh' => 'cie.refresh',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Certificates and Keys
    |--------------------------------------------------------------------------
    |
    | Certificati per la validazione delle signature JWT
    |
    */
    'certificates' => [
<<<<<<< HEAD
        'jwks_uri' => env('CIE_JWKS_URI'), // URL dei certificati pubblici CIE
=======
        'jwks_uri' => null, // URL dei certificati pubblici CIE
>>>>>>> laraxot/dev
        'cache_ttl' => 3600, // Cache TTL per i certificati (1 ora)
        'local_cert_path' => storage_path('certificates/cie/'), // Path locale certificati
    ],

    /*
    |--------------------------------------------------------------------------
    | Logging Configuration
    |--------------------------------------------------------------------------
    */
    'logging' => [
<<<<<<< HEAD
        'enabled' => env('CIE_LOGGING_ENABLED', true),
        'level' => env('CIE_LOGGING_LEVEL', 'info'),
        'channel' => env('CIE_LOGGING_CHANNEL', 'cie'),
        'log_tokens' => env('CIE_LOG_TOKENS', false), // ATTENZIONE: Non abilitare in produzione
=======
        'enabled' => true,
        'level' => 'info',
        'channel' => 'cie',
        'log_tokens' => false, // ATTENZIONE: Non abilitare in produzione
>>>>>>> laraxot/dev
    ],

    /*
    |--------------------------------------------------------------------------
    | Cache Configuration
    |--------------------------------------------------------------------------
    */
    'cache' => [
        'prefix' => 'cie:',
        'discovery_ttl' => 3600,    // Cache discovery document (1 ora)
        'jwks_ttl' => 3600,         // Cache JWKS (1 ora)
        'userinfo_ttl' => 300,      // Cache user info (5 minuti)
    ],

    /*
    |--------------------------------------------------------------------------
    | Error Handling
    |--------------------------------------------------------------------------
    */
    'errors' => [
<<<<<<< HEAD
        'redirect_on_error' => env('CIE_REDIRECT_ON_ERROR', true),
        'error_route' => env('CIE_ERROR_ROUTE', 'login'),
        'show_technical_errors' => env('CIE_SHOW_TECHNICAL_ERRORS', env('APP_DEBUG', false)),
=======
        'redirect_on_error' => true,
        'error_route' => 'login',
        'show_technical_errors' => config('app.debug'),
>>>>>>> laraxot/dev
    ],

    /*
    |--------------------------------------------------------------------------
    | Integration Settings
    |--------------------------------------------------------------------------
    */
    'integration' => [
<<<<<<< HEAD
        'auto_create_user' => env('CIE_AUTO_CREATE_USER', true),
        'update_user_on_login' => env('CIE_UPDATE_USER_ON_LOGIN', true),
        'sync_attributes' => env('CIE_SYNC_ATTRIBUTES', true),
=======
        'auto_create_user' => true,
        'update_user_on_login' => true,
        'sync_attributes' => true,
>>>>>>> laraxot/dev
        'required_attributes' => ['fiscal_code'], // Attributi obbligatori per la registrazione
    ],

    /*
    |--------------------------------------------------------------------------
    | Development & Testing
    |--------------------------------------------------------------------------
    */
    'development' => [
<<<<<<< HEAD
        'mock_responses' => env('CIE_MOCK_RESPONSES', false),
        'test_user' => [
            'enabled' => env('CIE_TEST_USER_ENABLED', env('APP_ENV') !== 'production'),
            'fiscal_code' => env('CIE_TEST_FISCAL_CODE', 'RSSMRA80A01H501U'),
            'name' => env('CIE_TEST_NAME', 'Mario'),
            'surname' => env('CIE_TEST_SURNAME', 'Rossi'),
            'email' => env('CIE_TEST_EMAIL', 'mario.rossi@example.com'),
        ],
        'bypass_signature_validation' => env('CIE_BYPASS_SIGNATURE', env('APP_ENV') !== 'production'),
=======
        'mock_responses' => false,
        'test_user' => [
            'enabled' => config('app.env') !== 'production',
            'fiscal_code' => 'RSSMRA80A01H501U',
            'name' => 'Mario',
            'surname' => 'Rossi',
            'email' => 'mario.rossi@example.com',
        ],
        'bypass_signature_validation' => config('app.env') !== 'production',
>>>>>>> laraxot/dev
    ],

    /*
    |--------------------------------------------------------------------------
    | Compliance Settings
    |--------------------------------------------------------------------------
    */
    'compliance' => [
        'agid_compliant' => true,
        'gdpr_compliant' => true,
<<<<<<< HEAD
        'privacy_policy_url' => env('CIE_PRIVACY_POLICY_URL', '/privacy'),
        'terms_of_service_url' => env('CIE_TERMS_URL', '/terms'),
        'data_retention_days' => env('CIE_DATA_RETENTION', 365),
=======
        'privacy_policy_url' => '/privacy',
        'terms_of_service_url' => '/terms',
        'data_retention_days' => 365,
>>>>>>> laraxot/dev
    ],
];
