<?php

declare(strict_types=1);

<<<<<<< HEAD
use Tests\TestCase;
use Themes\Sixteen\Actions\Url\BuildLocalizedFrontofficePathAction;
use Themes\Sixteen\Actions\Url\NormalizeStoredFrontofficeUrlAction;

use function Safe\file_get_contents;

uses(TestCase::class);

=======
use Themes\Sixteen\Actions\Url\BuildLocalizedFrontofficePathAction;
use Themes\Sixteen\Actions\Url\NormalizeStoredFrontofficeUrlAction;

<<<<<<< HEAD
>>>>>>> laraxot/dev
/**
 * Contratto header area personale: named route Folio verificate (folio:list), no wrapper path custom.
 */
test('FrontofficeUrl e autoloadabile per nav CMS', function (): void {
    expect(class_exists(BuildLocalizedFrontofficePathAction::class))->toBeTrue();
    expect(class_exists(NormalizeStoredFrontofficeUrlAction::class))->toBeTrue();
<<<<<<< HEAD
=======
=======
uses(Tests\TestCase::class);

/**
 * Contratto header area personale: named route Folio verificate (folio:list), no wrapper path custom.
 */
test('Frontoffice URL actions sono autoloadabili per nav CMS', function (): void {
    expect(class_exists(NormalizeStoredFrontofficeUrlAction::class))->toBeTrue();
    expect(method_exists(NormalizeStoredFrontofficeUrlAction::class, 'execute'))->toBeTrue();
    expect(class_exists(BuildLocalizedFrontofficePathAction::class))->toBeTrue();
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
});

test('user-dropdown usa named route Folio verificate', function (): void {
    $themeRoot = dirname(__DIR__, 2);
<<<<<<< HEAD
    $html = file_get_contents($themeRoot.'/resources/views/components/sections/header/partials/user-dropdown.blade.php');
=======
    $html = (string) file_get_contents($themeRoot.'/resources/views/components/sections/header/partials/user-dropdown.blade.php');
>>>>>>> laraxot/dev

    expect($html)->toContain("route('services.categories')");
    expect($html)->toContain("route('dashboard')");
    expect($html)->toContain("route('notifications')");
    expect($html)->toContain("route('profile.edit')");
    expect($html)->toContain("route('logout')");
    expect($html)->not->toContain('FrontofficeUrl::personalArea');
    expect($html)->not->toContain("route('tests.view'");
    expect($html)->not->toContain("route('user.services'");
    expect($html)->not->toContain("route('area-personale");
    expect($html)->not->toContain('area-personale.notifiche');
    expect($html)->not->toContain('ui::ui.profile');
    expect($html)->toContain("pub_theme::header.user.dropdown.notifications.label");
});

test('guest CTA header usa route login Folio', function (): void {
    $themeRoot = dirname(__DIR__, 2);
    $paths = [
        $themeRoot.'/resources/views/components/sections/header/partials/personal-area-guest-cta.blade.php',
        $themeRoot.'/resources/views/components/sections/header/partials/personal-area-login-cta.blade.php',
    ];

    foreach ($paths as $path) {
        if (! file_exists($path)) {
            continue;
        }
<<<<<<< HEAD
        $html = file_get_contents($path);
=======
        $html = (string) file_get_contents($path);
>>>>>>> laraxot/dev
        expect($html)->toContain("route('login')");
        expect($html)->not->toContain('FrontofficeUrl::login()');
    }
});

test('header area-personale partials non contengono locale hardcoded ne FrontofficeUrl personalArea', function (): void {
    $themeRoot = dirname(__DIR__, 2);
    $areaPersonalePartials = [
        'user-dropdown.blade.php',
        'personal-area-guest-cta.blade.php',
        'personal-area-guest-parity.blade.php',
        'personal-area-login-cta.blade.php',
    ];

    foreach ($areaPersonalePartials as $file) {
        $path = $themeRoot.'/resources/views/components/sections/header/partials/'.$file;
        if (! file_exists($path)) {
            continue;
        }
<<<<<<< HEAD
        $html = file_get_contents($path);
=======
        $html = (string) file_get_contents($path);
>>>>>>> laraxot/dev
        expect($html)->not->toContain('href="/it/');
        expect($html)->not->toContain("href='/it/");
        expect($html)->not->toContain('href="/{{ app()->getLocale()');
        expect($html)->not->toContain('/profilo/');
        expect($html)->not->toContain('FrontofficeUrl::personalArea');
        expect($html)->not->toContain('<span>I miei servizi</span>');
    }
});

test('bootstrap-italia header riusa partial canonici area personale', function (): void {
    $themeRoot = dirname(__DIR__, 2);
<<<<<<< HEAD
    $html = file_get_contents($themeRoot.'/resources/views/components/bootstrap-italia/header.blade.php');
=======
    $html = (string) file_get_contents($themeRoot.'/resources/views/components/bootstrap-italia/header.blade.php');
>>>>>>> laraxot/dev

    expect($html)->toContain('partials.personal-area-guest-cta');
    expect($html)->toContain('partials.user-dropdown');
});

<<<<<<< HEAD
test('nav partials localizzano url da header.json via fromStoredUrl', function (): void {
    $themeRoot = dirname(__DIR__, 2);
    foreach (['nav-primary.blade.php', 'nav-secondary.blade.php'] as $file) {
        $html = file_get_contents($themeRoot.'/resources/views/components/sections/header/partials/'.$file);
=======
<<<<<<< HEAD
test('nav partials localizzano url da header.json via fromStoredUrl', function (): void {
=======
test('nav partials localizzano url da header.json via headerFolioUrl callback', function (): void {
>>>>>>> edd328a (.)
    $themeRoot = dirname(__DIR__, 2);
    foreach (['nav-primary.blade.php', 'nav-secondary.blade.php'] as $file) {
        $html = (string) file_get_contents($themeRoot.'/resources/views/components/sections/header/partials/'.$file);
>>>>>>> laraxot/dev
        expect($html)->toContain('$headerFolioUrl');
        expect($html)->not->toContain('href="/it/');
    }
});

<<<<<<< HEAD
test('FrontofficeUrl non espone wrapper personalArea', function (): void {
    $php = file_get_contents(dirname(__DIR__, 2).'/app/Support/FrontofficeUrl.php.bak');
=======
<<<<<<< HEAD
test('FrontofficeUrl non espone wrapper personalArea', function (): void {
    $php = (string) file_get_contents(dirname(__DIR__, 2).'/app/Support/FrontofficeUrl.php.bak');
>>>>>>> laraxot/dev

    expect($php)->not->toContain('personalAreaServices');
    expect($php)->not->toContain('personalAreaNotifications');
    expect($php)->toContain('fromStoredUrl');
<<<<<<< HEAD
=======
=======
test('Frontoffice URL actions non espongono wrapper personalArea', function (): void {
    $paths = [
        dirname(__DIR__, 2).'/app/Actions/Url/NormalizeStoredFrontofficeUrlAction.php',
        dirname(__DIR__, 2).'/app/Actions/Url/BuildLocalizedFrontofficePathAction.php',
    ];

    foreach ($paths as $phpPath) {
        $php = (string) file_get_contents($phpPath);
        expect($php)->not->toContain('personalAreaServices');
        expect($php)->not->toContain('personalAreaNotifications');
    }
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
});

test('legacy header user-dropdown usa named route Folio', function (): void {
    $themeRoot = dirname(__DIR__, 2);
<<<<<<< HEAD
    $html = file_get_contents($themeRoot.'/resources/views/components/header/user-dropdown.blade.php');
=======
    $html = (string) file_get_contents($themeRoot.'/resources/views/components/header/user-dropdown.blade.php');
>>>>>>> laraxot/dev

    expect($html)->toContain("route('services.categories')");
    expect($html)->toContain("route('notifications')");
    expect($html)->not->toContain('FrontofficeUrl::personalArea');
});

test('nessun blade Sixteen usa FrontofficeUrl personalArea wrapper', function (): void {
    $themeRoot = dirname(__DIR__, 2);
    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($themeRoot.'/resources/views', FilesystemIterator::SKIP_DOTS)
    );

    foreach ($iterator as $file) {
<<<<<<< HEAD
        if (! $file instanceof SplFileInfo) {
            continue;
        }
=======
>>>>>>> laraxot/dev
        if (! $file->isFile() || $file->getExtension() !== 'php') {
            continue;
        }
        if (! str_ends_with($file->getFilename(), '.blade.php')) {
            continue;
        }
<<<<<<< HEAD
        $html = file_get_contents($file->getPathname());
=======
        $html = (string) file_get_contents($file->getPathname());
>>>>>>> laraxot/dev
        expect($html)->not->toContain('FrontofficeUrl::personalArea', $file->getPathname());
    }
});

test('legacy header variants usano route Folio e chiavi header.user.dropdown', function (): void {
    $themeRoot = dirname(__DIR__, 2);
    $legacyHeaders = [
        'components/header/authenticated.blade.php',
        'components/layout/design-comuni-header.blade.php',
        'components/ui/app/header.blade.php',
    ];

    foreach ($legacyHeaders as $relative) {
<<<<<<< HEAD
        $html = file_get_contents($themeRoot.'/resources/views/'.$relative);
=======
        $html = (string) file_get_contents($themeRoot.'/resources/views/'.$relative);
>>>>>>> laraxot/dev
        expect($html)->toContain("route('services.categories')");
        expect($html)->toContain("route('notifications')");
        expect($html)->toContain('pub_theme::header.user.dropdown.notifications.label');
        expect($html)->not->toContain('FrontofficeUrl::personalArea');
        expect($html)->not->toContain('pub_theme::ui.header_area_personale');
        expect($html)->not->toContain('ui::ui.profile');
    }
});
