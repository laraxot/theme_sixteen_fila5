<?php

declare(strict_types=1);

namespace Themes\Sixteen\Datas;

/**
 * Cio' che il layout scrive nell'intestazione HTML per una pagina: titolo con il marchio, direttiva robots, lingua di Open Graph.
 */
final readonly class PageHeadData
{
    public function __construct(
        public string $title,
        public ?string $robots,
        public string $ogLocale,
    ) {}
}
