<?php

declare(strict_types=1);

use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Themes\Sixteen\Actions\Assets\ServeThemeAssetAction;
use Themes\Sixteen\Actions\Auth\SanitizeReturnUrlAction;
use Themes\Sixteen\Actions\SpidAuthAction;

use function Safe\file_get_contents;

/*
 * Invarianti dei contratti in docs/contracts/ (sanitize-return-url-action, serve-theme-asset-action, spid-auth-action).
 * Nessuna app: i rami provati non toccano config, sessione ne' filesystem, quindi girano anche quando il boot fallisce.
 * Le classi del tema non sono nell'autoload di Composer (le carica il provider al boot): require_once.
 */
require_once dirname(__DIR__, 2).'/app/Actions/Auth/SanitizeReturnUrlAction.php';
require_once dirname(__DIR__, 2).'/app/Actions/Assets/ServeThemeAssetAction.php';
require_once dirname(__DIR__, 2).'/app/Actions/SpidAuthAction.php';

test('return url on another host or scheme falls back', function (string $candidate): void {
    $request = Request::create('https://localhost/it/auth/login');

    expect((new SanitizeReturnUrlAction)->execute($request, $candidate, '/it/area-personale'))->toBe('/it/area-personale');
})->with([
    '//evil.example/path',
    'https://evil.example/path',
    'http://localhost/it/area-personale',
    'https://localhost:8443/it/area-personale',
    'javascript:alert(1)',
])->group('SIXTEEN-RETURN-INV-1');

test('return url with backslash, control char or non-string falls back', function (mixed $candidate): void {
    $request = Request::create('https://localhost/it/auth/login');

    expect((new SanitizeReturnUrlAction)->execute($request, $candidate, '/fallback'))->toBe('/fallback');
})->with([
    ['/\\evil.example'],
    ["/it/area\t-personale"],
    ["/it/\x00"],
    [''],
    [null],
    [['/it']],
])->group('SIXTEEN-RETURN-INV-2');

test('relative return url becomes absolute on the current host', function (): void {
    $request = Request::create('https://localhost/it/auth/login');

    expect((new SanitizeReturnUrlAction)->execute($request, '/it/area-personale', '/fallback'))
        ->toBe('https://localhost/it/area-personale');
})->group('SIXTEEN-RETURN-INV-3');

test('theme asset path with .. or empty is a 404 before any filesystem access', function (string $path): void {
    expect(fn (): mixed => (new ServeThemeAssetAction)->execute($path))->toThrow(NotFoundHttpException::class);
})->with([
    '../.env',
    'design-comuni/../../../.env',
    '..\\..\\composer.json',
    '',
    '/',
])->group('SIXTEEN-ASSET-INV-1');

test('SPID rejects a successful response that carries no XML signature', function (): void {
    $action = (new ReflectionClass(SpidAuthAction::class))->newInstanceWithoutConstructor();
    $method = new ReflectionMethod(SpidAuthAction::class, 'validateSamlResponse');
    $document = new DOMDocument;
    $document->loadXML('<samlp:Response xmlns:samlp="urn:oasis:names:tc:SAML:2.0:protocol"><samlp:Status><samlp:StatusCode Value="urn:oasis:names:tc:SAML:2.0:status:Success"/></samlp:Status></samlp:Response>');

    expect(fn (): mixed => $method->invoke($action, $document))->toThrow(Exception::class, 'SPID authentication failed');
})->group('SIXTEEN-SPID-INV-1');

test('SPID rejects a response whose status is not Success', function (): void {
    $action = (new ReflectionClass(SpidAuthAction::class))->newInstanceWithoutConstructor();
    $method = new ReflectionMethod(SpidAuthAction::class, 'validateSamlResponse');
    $document = new DOMDocument;
    $document->loadXML('<samlp:Response xmlns:samlp="urn:oasis:names:tc:SAML:2.0:protocol"><samlp:Status><samlp:StatusCode Value="urn:oasis:names:tc:SAML:2.0:status:Responder"/></samlp:Status></samlp:Response>');

    expect(fn (): mixed => $method->invoke($action, $document))->toThrow(Exception::class, 'SPID authentication failed');
})->group('SIXTEEN-SPID-INV-2');

test('a successful SPID or CIE login logs attribute names, never their values', function (string $action): void {
    $source = file_get_contents(dirname(__DIR__, 2).'/app/Actions/'.$action.'.php');

    expect($source)->toContain("'attribute_names' => array_keys(")
        ->and($source)->not->toMatch("/Log::info\([^;]*'user_attributes'\s*=>/s");
})->with([
    'SPID' => ['SpidAuthAction'],
    'CIE' => ['CieAuthAction'],
])->group('SIXTEEN-SPID-INV-6', 'SIXTEEN-CIE-INV-4');
