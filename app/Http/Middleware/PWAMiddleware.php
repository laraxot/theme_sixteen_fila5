<?php

declare(strict_types=1);

namespace Themes\Sixteen\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> laraxot/dev
use Symfony\Component\HttpFoundation\Response;

/**
 * Middleware per gestire le richieste PWA
 *
 * Aggiunge header necessari per il funzionamento
 * della Progressive Web App e gestisce il caching.
 */
class PWAMiddleware
{
    /**
     * Handle an incoming request.
<<<<<<< HEAD
     *
     * @param  Closure(Request): Response  $next
=======
=======
use Modules\Xot\Actions\Cast\SafeStringCastAction;
use Symfony\Component\HttpFoundation\Response;

class PWAMiddleware
{
    /**
     * @param  Closure(Request): Response  $next
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> laraxot/dev
        // Aggiungi header PWA
        $this->addPWAHeaders($response);

        // Gestisci caching per risorse statiche
        $this->handleCaching($request, $response);

        // Gestisci offline fallback
<<<<<<< HEAD
=======
=======
        $this->addPWAHeaders($response);
        $this->handleCaching($request, $response);
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
        $this->handleOfflineFallback($request, $response);

        return $response;
    }

<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> laraxot/dev
    /**
     * Aggiungi header necessari per PWA
     */
    private function addPWAHeaders(Response $response): void
    {
        // Header per PWA
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-Frame-Options', 'DENY');
        $response->headers->set('X-XSS-Protection', '1; mode=block');

        // Header per Service Worker
        $response->headers->set('Service-Worker-Allowed', '/');

        // Header per manifest
        $response->headers->set('Link', '</manifest.json>; rel="manifest"');

        // Header per viewport mobile
<<<<<<< HEAD
        $contentType = $response->headers->get('Content-Type');
        if (is_string($contentType) && str_contains($contentType, 'text/html')) {
=======
        if ($response->headers->has('Content-Type') &&
            str_contains($response->headers->get('Content-Type'), 'text/html')) {
=======
    private function addPWAHeaders(Response $response): void
    {
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-Frame-Options', 'DENY');
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        $response->headers->set('Service-Worker-Allowed', '/');
        $response->headers->set('Link', '</manifest.json>; rel="manifest"');

        $contentType = SafeStringCastAction::cast($response->headers->get('Content-Type'));
        if ($contentType !== '' && str_contains($contentType, 'text/html')) {
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
            $this->addViewportMeta($response);
        }
    }

<<<<<<< HEAD
    /**
     * Gestisci caching per risorse statiche
     */
=======
<<<<<<< HEAD
    /**
     * Gestisci caching per risorse statiche
     */
=======
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
    private function handleCaching(Request $request, Response $response): void
    {
        $path = $request->path();

<<<<<<< HEAD
        // Cache per risorse statiche
=======
<<<<<<< HEAD
        // Cache per risorse statiche
=======
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
        if ($this->isStaticResource($path)) {
            $response->headers->set('Cache-Control', 'public, max-age=31536000, immutable');
            $response->headers->set('Expires', gmdate('D, d M Y H:i:s', time() + 31536000).' GMT');
        }

<<<<<<< HEAD
        // Cache per API
=======
<<<<<<< HEAD
        // Cache per API
=======
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
        if (str_starts_with($path, 'api/')) {
            $response->headers->set('Cache-Control', 'no-cache, no-store, must-revalidate');
            $response->headers->set('Pragma', 'no-cache');
            $response->headers->set('Expires', '0');
        }

<<<<<<< HEAD
        // Cache per pagine HTML
=======
<<<<<<< HEAD
        // Cache per pagine HTML
=======
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
        if ($this->isPageRequest($request)) {
            $response->headers->set('Cache-Control', 'no-cache, no-store, must-revalidate');
        }
    }

<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> laraxot/dev
    /**
     * Gestisci fallback offline
     */
    private function handleOfflineFallback(Request $request, Response $response): void
    {
        // Solo per richieste GET di pagine
<<<<<<< HEAD
=======
=======
    private function handleOfflineFallback(Request $request, Response $response): void
    {
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
        if ($request->method() !== 'GET' || ! $this->isPageRequest($request)) {
            return;
        }

<<<<<<< HEAD
        // Aggiungi meta tag per offline
        $contentType = $response->headers->get('Content-Type');
        if (is_string($contentType) && str_contains($contentType, 'text/html')) {
=======
<<<<<<< HEAD
        // Aggiungi meta tag per offline
        if ($response->headers->has('Content-Type') &&
            str_contains($response->headers->get('Content-Type'), 'text/html')) {
=======
        $contentType = SafeStringCastAction::cast($response->headers->get('Content-Type'));
        if ($contentType !== '' && str_contains($contentType, 'text/html')) {
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
            $this->addOfflineMeta($response);
        }
    }

<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> laraxot/dev
    /**
     * Aggiungi meta tag viewport
     */
    private function addViewportMeta(Response $response): void
    {
        $content = $response->getContent();

<<<<<<< HEAD
=======
        // Verifica se viewport meta è già presente
=======
    private function addViewportMeta(Response $response): void
    {
        $content = $response->getContent();
>>>>>>> laraxot/dev
        if (! is_string($content)) {
            return;
        }

<<<<<<< HEAD
        // Verifica se viewport meta è già presente
=======
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
        if (str_contains($content, 'name="viewport"')) {
            return;
        }

<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> laraxot/dev
        // Aggiungi viewport meta tag
        $viewportMeta = '<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">';

        // Inserisci dopo <head>
        $content = str_replace('<head>', "<head>\n    {$viewportMeta}", $content);

        $response->setContent($content);
    }

    /**
     * Aggiungi meta tag per offline
     */
    private function addOfflineMeta(Response $response): void
    {
        $content = $response->getContent();

<<<<<<< HEAD
=======
        // Meta tag per PWA
=======
        $viewportMeta = '<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">';
        $response->setContent(str_replace('<head>', "<head>\n    {$viewportMeta}", $content));
    }

    private function addOfflineMeta(Response $response): void
    {
        $content = $response->getContent();
>>>>>>> laraxot/dev
        if (! is_string($content)) {
            return;
        }

<<<<<<< HEAD
        // Meta tag per PWA
=======
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
        $pwaMeta = implode("\n    ", [
            '<meta name="theme-color" content="#0066cc">',
            '<meta name="apple-mobile-web-app-capable" content="yes">',
            '<meta name="apple-mobile-web-app-status-bar-style" content="default">',
            '<meta name="apple-mobile-web-app-title" content="FixCity">',
            '<meta name="msapplication-TileColor" content="#0066cc">',
            '<meta name="msapplication-config" content="/browserconfig.xml">',
        ]);

<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> laraxot/dev
        // Inserisci prima di </head>
        $content = str_replace('</head>', "    {$pwaMeta}\n</head>", $content);

        $response->setContent($content);
    }

    /**
     * Verifica se è una risorsa statica
     */
<<<<<<< HEAD
=======
=======
        $response->setContent(str_replace('</head>', "    {$pwaMeta}\n</head>", $content));
    }

>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
    private function isStaticResource(string $path): bool
    {
        $staticExtensions = ['css', 'js', 'png', 'jpg', 'jpeg', 'gif', 'svg', 'ico', 'woff', 'woff2', 'ttf', 'eot'];

        foreach ($staticExtensions as $ext) {
            if (str_ends_with($path, '.'.$ext)) {
                return true;
            }
        }

        return false;
    }

<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> laraxot/dev
    /**
     * Verifica se è una richiesta di pagina
     */
    private function isPageRequest(Request $request): bool
    {
<<<<<<< HEAD
        $accept = $request->header('Accept');

        return is_string($accept) && str_contains($accept, 'text/html');
=======
        return $request->header('Accept') &&
               str_contains($request->header('Accept'), 'text/html');
=======
    private function isPageRequest(Request $request): bool
    {
        $accept = SafeStringCastAction::cast($request->header('Accept'));

        return $accept !== '' && str_contains($accept, 'text/html');
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
    }
}
