<?php

declare(strict_types=1);

namespace Themes\Sixteen\Support;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

use function Safe\parse_url;

/**
 * Utility URL CMS/JSON — path localizzati senza prefisso lingua hardcoded.
 *
 * Il menu header utente usa `route('<folio-name>')` verificate con `php artisan folio:list`.
 * Non aggiungere wrapper che duplicano path inventati per voci menu.
 *
 * Canon: laravel/Themes/Sixteen/docs/wiki/concepts/fo-folio-named-routes-header.md
 */
final class FrontofficeUrl
{
    public static function path(string $path): string
    {
        if ('' === $path || ! str_starts_with($path, '/')) {
            return $path;
        }

        /** @var string|null $localized */
        $localized = LaravelLocalization::getLocalizedURL(
            LaravelLocalization::getCurrentLocale(),
            $path
        );

        return is_string($localized) && $localized !== '' ? $localized : $path;
    }

    /**
     * Normalizza URL da CMS/JSON (es. `/it/servizi`) → path locale corrente.
     */
    public static function fromStoredUrl(string $url): string
    {
        if ($url === '' || $url === '#') {
            return $url;
        }

        $path = parse_url($url, PHP_URL_PATH);
        if (! is_string($path) || $path === '') {
            return $url;
        }

        $normalized = '/'.ltrim($path, '/');
        $supported = array_keys(LaravelLocalization::getSupportedLocales());
        $segments = explode('/', ltrim($normalized, '/'));
        if ($segments !== [] && in_array($segments[0], $supported, true)) {
            $normalized = '/'.implode('/', array_slice($segments, 1));
        }

        return self::path($normalized !== '/' ? $normalized : '/');
    }

    /**
     * Solo parity Design Comuni / demo statiche — non usare in header produzione.
     */
    public static function testsParity(string $slug): string
    {
        return self::path('/tests/'.$slug);
    }

    /**
     * Route per l'area personale — I miei servizi
     * Usa route Folio area-personale.services
     */
    public static function personalAreaServices(): string
    {
        return self::folioRoute('area-personale.services', '/area-personale/services');
    }

    /**
     * Route per l'area personale — Le mie pratiche
     * Usa route Folio area-personale.requests
     */
    public static function personalAreaPractices(): string
    {
        return self::folioRoute('area-personale.requests', '/area-personale/requests');
    }

    /**
     * Route per l'area personale — Notifiche
     * Usa route Folio area-personale.notifiche
     */
    public static function personalAreaNotifications(): string
    {
        return self::folioRoute('area-personale.notifiche', '/area-personale/notifiche');
    }

    /**
     * Route per l'area personale — Impostazioni
     * Usa route Folio area-personale.impostazioni
     */
    public static function personalAreaSettings(): string
    {
        return self::folioRoute('area-personale.impostazioni', '/area-personale/impostazioni');
    }

    /**
     * Route per logout — usa la route standard Laravel
     */
    public static function logout(): string
    {
        return route('logout');
    }

    /**
     * Preferisce route Folio `name()` quando registrata; fallback path localizzato.
     */
    private static function folioRoute(string $routeName, string $fallbackPath): string
    {
        try {
            $url = route($routeName);

            if (is_string($url) && $url !== '') {
                return $url;
            }
        } catch (\Throwable) {
            // Folio route non disponibile in questo contesto
        }

        return self::path($fallbackPath);
    }
}