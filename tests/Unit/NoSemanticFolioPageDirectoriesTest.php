<?php

declare(strict_types=1);

/**
 * Il tema veste. Il dominio sta nel JSON CMS, non in una cartella Folio.
 * pages/domande-frequenti/ e pages/profile/ sono sbagliati: Folio darebbe a
 * quelle cartelle la precedenza su [container0] (FAQ) o creerebbe un alias
 * morto/competitivo col modulo User (profile/edit — creato ≥3 volte).
 *
 * @see laravel/Themes/Sixteen/docs/page-directory-structure.md
 * @see laravel/Themes/Sixteen/docs/bmad/knowledge/why-profile-edit-blade-must-not-exist.md
 * @see laravel/Themes/Sixteen/docs/bmad/knowledge/why-domande-frequenti-blade-php-must-not-exist.md
 */
test('sixteen pages ammette solo auth, container0 e tests', function (): void {
    $pagesRoot = dirname(__DIR__, 2).'/resources/views/pages';
    $allowed = ['[container0]', 'auth', 'tests'];

    $found = [];
    foreach (scandir($pagesRoot) ?: [] as $entry) {
        if ($entry === '.' || $entry === '..') {
            continue;
        }
        if (is_dir($pagesRoot.'/'.$entry)) {
            $found[] = $entry;
        }
    }

    $extra = array_values(array_diff($found, $allowed));

    expect($extra)->toBe([]);
    expect(is_dir($pagesRoot.'/domande-frequenti'))->toBeFalse();
    expect(is_file($pagesRoot.'/domande-frequenti/index.blade.php'))->toBeFalse();
    // Folio 1.2.0 prova MatchLiteralDirectories prima di MatchWildcardDirectories e MatchLiteralViews dopo: la cartella
    // omonima intercetta l'URL, un file `domande-frequenti.blade.php` perde contro [container0] (misurato) ma resta una
    // seconda sorgente morta che finge di possedere la pagina. Nessuna delle due forme.
    expect(glob($pagesRoot.'/domande-frequenti*') ?: [])->toBe([]);

    // Caso reale ripetuto: pages/profile/edit.blade.php (alias «fix 404»). FO usa
    // FrontofficeRoutes::personalAreaImpostazioni() → container0 area-personale/impostazioni.
    expect(is_dir($pagesRoot.'/profile'))->toBeFalse();
    expect(is_file($pagesRoot.'/profile/edit.blade.php'))->toBeFalse();
    expect(glob($pagesRoot.'/profile*') ?: [])->toBe([]);

    expect(is_dir($pagesRoot.'/[container0]'))->toBeTrue();
});
