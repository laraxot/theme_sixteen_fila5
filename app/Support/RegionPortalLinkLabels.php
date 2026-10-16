<?php

declare(strict_types=1);

namespace Themes\Sixteen\Support;

use function Safe\preg_match;
use function Safe\preg_replace;

/**
 * Risolve title e aria-label del link «portale regione» nel header slim (template CMS con graffe).
 */
final class RegionPortalLinkLabels
{
    /**
     * @param  array<string, mixed>  $region
     * @return array{name: string, title: ?string, aria_label: ?string}
     */
    public static function resolve(array $region): array
    {
        $name = self::stringOrEmpty($region['name'] ?? null);
        if ($name === '') {
            $configured = config('comune.regione', '');
            $name = is_string($configured) ? trim($configured) : '';
        }

        return [
            'name' => $name,
            'title' => self::interpolateLabel($region['title'] ?? null, $name),
            'aria_label' => self::interpolateLabel($region['aria_label'] ?? null, $name),
        ];
    }

    private static function interpolateLabel(mixed $template, string $regionName): ?string
    {
        if (! is_string($template)) {
            return null;
        }

        $template = trim($template);
        if ($template === '') {
            return null;
        }

        if ($regionName === '') {
            if (preg_match('/\{[^}]+\}/', $template) === 1) {
                return null;
            }

            return $template;
        }

        $resolved = trim(preg_replace('/\{[^}]+\}/', $regionName, $template));
        if ($resolved === '' || preg_match('/\{[^}]+\}/', $resolved) === 1) {
            return null;
        }

        return $resolved;
    }

    private static function stringOrEmpty(mixed $value): string
    {
        return is_string($value) ? trim($value) : '';
    }
}
