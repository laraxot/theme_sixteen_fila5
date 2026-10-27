<?php

declare(strict_types=1);

namespace Themes\Sixteen\Actions\Seo;

use Spatie\QueueableAction\QueueableAction;
use Themes\Sixteen\Datas\PageHeadData;

/**
 * Metadati dell'intestazione HTML di una pagina del front office (DCP-288, FO-6-15, 17, 18).
 *
 * - Titolo: `<pagina> | <sito>`, senza ripetere il nome del sito dove il titolo lo contiene gia' ("FixCity, Segnala un problema...", "Accedi a FixCity").
 * - robots: `noindex,follow` per le pagine private o di servizio. Il `Disallow` di robots.txt non toglie dall'indice una pagina gia'
 *   conosciuta e non vale per le copie con la lingua in maiuscolo; il `meta robots` si'. Le pagine sotto `Disallow` (auth, area
 *   personale) il motore di ricerca non le scarica e quindi non legge il meta: il meta protegge le altre e le copie.
 * - og:locale: codice regionale della lingua (`it_IT`), non il solo `it`.
 */
final class ResolvePageHeadAction
{
    use QueueableAction;

    /** Percorsi (senza la lingua) che non devono comparire nei motori di ricerca; vale anche per tutto cio' che sta sotto. */
    private const array NOINDEX_PATHS = ['auth', 'area-personale', 'tests', 'tickets/create', 'tickets/confirmation', 'tickets/track'];

    public function execute(?string $title, string $siteName, string $path, string $locale): PageHeadData
    {
        return new PageHeadData(
            $this->brandedTitle($title, $siteName),
            $this->isPrivate($path) ? 'noindex,follow' : null,
            $this->regionalLocale($locale),
        );
    }

    private function brandedTitle(?string $title, string $siteName): string
    {
        $title = trim((string) $title);
        if ($title === '') {
            return $siteName;
        }

        return mb_stripos($title, $siteName) === false ? $title.' | '.$siteName : $title;
    }

    private function isPrivate(string $path): bool
    {
        $segments = explode('/', trim($path, '/'), 2);
        $supported = array_map('strval', array_keys((array) config('laravellocalization.supportedLocales', [])));
        $withoutLocale = in_array(mb_strtolower($segments[0]), $supported, true) ? ($segments[1] ?? '') : implode('/', $segments);

        foreach (self::NOINDEX_PATHS as $private) {
            if ($withoutLocale === $private || str_starts_with($withoutLocale, $private.'/')) {
                return true;
            }
        }

        return false;
    }

    private function regionalLocale(string $locale): string
    {
        $regional = config('laravellocalization.supportedLocales.'.$locale.'.regional');

        return is_string($regional) && $regional !== '' ? $regional : $locale;
    }
}
