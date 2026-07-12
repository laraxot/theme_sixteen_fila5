<?php

declare(strict_types=1);

namespace Themes\Sixteen\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\Xot\Actions\Cast\SafeStringCastAction;
use Symfony\Component\HttpFoundation\Response;

class PWAMiddleware
{
    /**
     * @param  Closure(Request): Response  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $this->addPWAHeaders($response);
        $this->handleCaching($request, $response);
        $this->handleOfflineFallback($request, $response);

        return $response;
    }

    private function addPWAHeaders(Response $response): void
    {
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-Frame-Options', 'DENY');
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        $response->headers->set('Service-Worker-Allowed', '/');
        $response->headers->set('Link', '</manifest.json>; rel="manifest"');

        $contentType = SafeStringCastAction::cast($response->headers->get('Content-Type'));
        if ($contentType !== '' && str_contains($contentType, 'text/html')) {
            $this->addViewportMeta($response);
        }
    }

    private function handleCaching(Request $request, Response $response): void
    {
        $path = $request->path();

        if ($this->isStaticResource($path)) {
            $response->headers->set('Cache-Control', 'public, max-age=31536000, immutable');
            $response->headers->set('Expires', gmdate('D, d M Y H:i:s', time() + 31536000).' GMT');
        }

        if (str_starts_with($path, 'api/')) {
            $response->headers->set('Cache-Control', 'no-cache, no-store, must-revalidate');
            $response->headers->set('Pragma', 'no-cache');
            $response->headers->set('Expires', '0');
        }

        if ($this->isPageRequest($request)) {
            $response->headers->set('Cache-Control', 'no-cache, no-store, must-revalidate');
        }
    }

    private function handleOfflineFallback(Request $request, Response $response): void
    {
        if ($request->method() !== 'GET' || ! $this->isPageRequest($request)) {
            return;
        }

        $contentType = SafeStringCastAction::cast($response->headers->get('Content-Type'));
        if ($contentType !== '' && str_contains($contentType, 'text/html')) {
            $this->addOfflineMeta($response);
        }
    }

    private function addViewportMeta(Response $response): void
    {
        $content = $response->getContent();
        if (! is_string($content)) {
            return;
        }

        if (str_contains($content, 'name="viewport"')) {
            return;
        }

        $viewportMeta = '<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">';
        $response->setContent(str_replace('<head>', "<head>\n    {$viewportMeta}", $content));
    }

    private function addOfflineMeta(Response $response): void
    {
        $content = $response->getContent();
        if (! is_string($content)) {
            return;
        }

        $pwaMeta = implode("\n    ", [
            '<meta name="theme-color" content="#0066cc">',
            '<meta name="apple-mobile-web-app-capable" content="yes">',
            '<meta name="apple-mobile-web-app-status-bar-style" content="default">',
            '<meta name="apple-mobile-web-app-title" content="FixCity">',
            '<meta name="msapplication-TileColor" content="#0066cc">',
            '<meta name="msapplication-config" content="/browserconfig.xml">',
        ]);

        $response->setContent(str_replace('</head>', "    {$pwaMeta}\n</head>", $content));
    }

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

    private function isPageRequest(Request $request): bool
    {
        $accept = SafeStringCastAction::cast($request->header('Accept'));

        return $accept !== '' && str_contains($accept, 'text/html');
    }
}
