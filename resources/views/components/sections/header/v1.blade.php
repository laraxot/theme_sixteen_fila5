@props([
    'blocks' => [],
    'view' => null,
    'brand' => null,
    'brand_subtitle' => null,
    'cta_label' => null,
    'cta_url' => null,
    'items' => [],
    'navigation' => [],
    'logo' => null,
    'utility_links' => [],
    'account' => null,
])

@php
    // x-section supplies the locale-resolved CMS blocks; preserve them.
    // The shared language-switcher and user-dropdown contracts are rendered by
    // the selected header skin; this wrapper must remain a transport shell.
    if ($blocks === []) {
        $locale = app()->getLocale();
        $fallbackTaglines = [
            'it' => 'Segnalazioni e servizi della città',
            'en' => 'City reports and services',
        ];
        $fallbackSocialLinks = [];
        foreach ((array) config('comune.social', []) as $network => $url) {
            if (! is_string($url) || trim($url) === '' || $url === '#') {
                continue;
            }

            $fallbackSocialLinks[] = [
                'label' => ucfirst((string) $network),
                'url' => $url,
                'icon' => 'it-'.$network,
            ];
        }

        $fallbackBrand = is_array($brand) ? $brand : [];
        $headerData = [
            'brand' => [
                'name' => $fallbackBrand['name'] ?? 'FixCity',
                'tagline' => $fallbackBrand['tagline'] ?? ($fallbackTaglines[$locale] ?? $fallbackTaglines['it']),
            ],
            'brand_subtitle' => $brand_subtitle,
            'cta_label' => $cta_label,
            'cta_url' => $cta_url,
            'items' => $items,
            'navigation' => $navigation,
            'logo' => $logo,
            'utility_links' => $utility_links,
            'account' => $account,
            'social_links' => $fallbackSocialLinks,
        ];

        $blocks = [['data' => $headerData]];
    }
@endphp

{{--
    Header canonico (`<x-section slug="header" tpl="v1">`, header-template-naming.md): markup Design Comuni / Bootstrap Italia
    come https://italia.github.io/design-comuni-pagine-statiche/sito/homepage.html (slim > center > navbar).
    Story: docs/stories/header-footer-design-comuni-markup.story.md.
    Dati: SOLO sections/header.json (brand, navigazione, etichette) + config('ente') via GetEnteDataAction (regione, social, DCP-289).
    Un dato mancante nasconde il blocco: mai segnaposto, mai href="#". Comportamenti: resources/js/app.js (data-bs-toggle).
    Partial condivisi: language-switcher, user-dropdown (stato autenticato, decision-header-auth-state), personal-area-login-cta.
--}}
@php
    $data = [];
    foreach ($blocks as $block) {
        $blockData = is_array($block) ? ($block['data'] ?? []) : ($block->data ?? []);
        if (is_array($blockData)) {
            $data = array_merge($data, $blockData);
        }
    }
    $d = static fn (string $key, mixed $default = '') => data_get($data, $key, $default);
    $assets = \Themes\Sixteen\Infrastructure\Assets\DesignComuniAssets::base();
    $icon = static fn (string $name): string => $assets.'/bootstrap-italia/dist/svg/sprites.svg#'.$name;
    $storedNavHref = static function (?string $url): ?string {
        $raw = trim((string) ($url ?? ''));
        if ($raw === '' || $raw === '#') {
            return null;
        }
        $resolved = \Themes\Sixteen\Infrastructure\Url\FrontofficeUrl::fromStoredUrl($raw);

        return $resolved !== '' && $resolved !== '#' ? $resolved : null;
    };
    // Voce attiva: `element` dichiarato dal layout ($dcHeaderActive) oppure, se assente, la voce il cui URL coincide con la
    // pagina o la contiene, scegliendo il percorso PIU' LUNGO: /it/tickets/track e' "Traccia", non "Segnalazioni" (/it/tickets).
    $currentNavPath = '/'.trim((string) parse_url(url()->current(), PHP_URL_PATH), '/');
    $navMatchLength = static function (array $item) use ($storedNavHref, $currentNavPath): int {
        $element = $item['element'] ?? null;
        $declared = view()->shared('dcHeaderActive');
        if (filled($declared)) {
            return $element === $declared ? PHP_INT_MAX : 0;
        }
        $href = $storedNavHref((string) ($item['url'] ?? ''));
        $itemPath = '/'.trim((string) parse_url((string) $href, PHP_URL_PATH), '/');
        if ($href === null || $itemPath === '/' || preg_match('#^/[a-z]{2}$#', $itemPath) === 1) {
            return 0;
        }

        return $currentNavPath === $itemPath || str_starts_with($currentNavPath, $itemPath.'/') ? strlen($itemPath) : 0;
    };
    $ente = app(\Modules\Tenant\Actions\Ente\GetEnteDataAction::class)->execute();
    // Social: config('ente') (DCP-289); in assenza, i `social_links` del blocco (fallback config('comune.social')), solo URL http(s).
    $socials = $ente->social !== [] ? $ente->social : array_values(array_filter(
        (array) $d('social_links', []),
        static fn (mixed $social): bool => is_array($social) && preg_match('#^https?://#', (string) ($social['url'] ?? '')) === 1 && filled($social['icon'] ?? null),
    ));
    // URL esterno gia' validato (http/https) da GetEnteDataAction: non passa da FrontofficeUrl.
    $regionPortalHref = $ente->region_url !== '' ? $ente->region_url : null;
    // D35: `region.name` ("Demo") e' il contenuto del CMS; se l'ente ha il suo nome (config('ente')) vince l'ente.
    $regionLink = \Themes\Sixteen\Presentation\Accessibility\RegionPortalLinkLabels::resolve(
        is_array($data['region'] ?? null) ? $data['region'] : [],
        $ente->region_name,
    );
    $homeHref = $storedNavHref((string) $d('brand.url', '/')) ?? url('/'.app()->getLocale());
    $brandTitle = (string) ($d('brand.header_title') ?: $d('brand.name'));
    // Stato autenticato: menu utente con avatar (profilo o Gravatar, CMT-022) e badge delle notifiche non lette.
    $realUser = auth()->user();
    $isSignedIn = (bool) (($dcSignedIn ?? false) || $realUser !== null);
    $displayName = $realUser !== null
        // Nome, poi nome e cognome, e solo per ultimo l'email (che in testata si legge da chiunque guardi lo schermo).
        ? (trim((string) ($realUser->name ?? ''))
            ?: trim((string) ($realUser->first_name ?? '').' '.(string) ($realUser->last_name ?? ''))
            ?: (string) ($realUser->email ?? ''))
        : (string) $d('account.signed_in.name', __('pub_theme::header.user.personal_area'));
    $avatarUrl = $realUser instanceof \Modules\Comment\Models\Contracts\CanComment
        ? (string) $realUser->commentatorProperties()->avatar
        : '';
    $userInitial = mb_strtoupper(mb_substr($displayName, 0, 1));
    $unreadNotificationsCount = $realUser instanceof \Modules\Xot\Contracts\UserContract
        ? app(\Modules\Fixcity\Actions\BuildAuthenticatedUserTicketNotificationsQueryAction::class)->execute($realUser)->whereNull('read_at')->count()
        : 0;
    $navigation = array_values(array_filter((array) $d('navigation', []), static fn (mixed $item): bool => is_array($item) && $storedNavHref((string) ($item['url'] ?? '')) !== null));
    $activeNavIndex = null;
    $activeNavLength = 0;
    foreach ($navigation as $navIndex => $navItem) {
        $length = $navMatchLength($navItem);
        if ($length > $activeNavLength) {
            $activeNavIndex = $navIndex;
            $activeNavLength = $length;
        }
    }
    $secondaryItems = array_values(array_filter((array) $d('secondary_navigation', []), static fn (mixed $item): bool => is_array($item) && $storedNavHref((string) ($item['url'] ?? '')) !== null));
@endphp
<header class="it-header-wrapper" data-bs-target="#header-nav-wrapper">
    @include('pub_theme::components.sections.header.partials.slim')
    <div class="it-nav-wrapper">
        @include('pub_theme::components.sections.header.partials.center')
        @include('pub_theme::components.sections.header.partials.navbar')
    </div>
</header>
