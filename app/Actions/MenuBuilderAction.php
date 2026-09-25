<?php

declare(strict_types=1);

namespace Themes\Sixteen\Actions;

use Illuminate\Support\Collection;
<<<<<<< HEAD
use InvalidArgumentException;
=======
>>>>>>> laraxot/dev
use Spatie\QueueableAction\QueueableAction;
use Themes\Sixteen\Contracts\MenuFilterInterface;

class MenuBuilderAction
{
    use QueueableAction;

<<<<<<< HEAD
    /** @var Collection<int, non-empty-array<array-key, mixed>> */
    protected Collection $slimHeader;

    /** @var Collection<int, non-empty-array<array-key, mixed>> */
    protected Collection $header;

    /** @var Collection<int, non-empty-array<array-key, mixed>> */
    protected Collection $footer;

    /** @var Collection<int, non-empty-array<array-key, mixed>> */
    protected Collection $footerBar;

    /** @var array<int, MenuFilterInterface> */
=======
    protected Collection $slimHeader;

    protected Collection $header;

    protected Collection $footer;

    protected Collection $footerBar;

>>>>>>> laraxot/dev
    protected array $filters = [];

    public function __construct()
    {
<<<<<<< HEAD
        $this->slimHeader = $this->emptyMenuCollection();
        $this->header = $this->emptyMenuCollection();
        $this->footer = $this->emptyMenuCollection();
        $this->footerBar = $this->emptyMenuCollection();
=======
        $this->slimHeader = collect();
        $this->header = collect();
        $this->footer = collect();
        $this->footerBar = collect();
>>>>>>> laraxot/dev
    }

    public function execute(): void
    {
        $this->build();
    }

<<<<<<< HEAD
    /**
     * @param  array<array-key, mixed>  $items
     */
=======
>>>>>>> laraxot/dev
    public function addSlimHeader(array $items): self
    {
        $processedItems = $this->transformItems($items);
        $this->slimHeader = $this->slimHeader->merge($processedItems);

        return $this;
    }

<<<<<<< HEAD
    /**
     * @param  array<array-key, mixed>  $items
     */
=======
>>>>>>> laraxot/dev
    public function addHeader(array $items): self
    {
        $processedItems = $this->transformItems($items);
        $this->header = $this->header->merge($processedItems);

        return $this;
    }

<<<<<<< HEAD
    /**
     * @param  array<array-key, mixed>  $items
     */
=======
>>>>>>> laraxot/dev
    public function addFooter(array $items): self
    {
        $processedItems = $this->transformItems($items);
        $this->footer = $this->footer->merge($processedItems);

        return $this;
    }

<<<<<<< HEAD
    /**
     * @param  array<array-key, mixed>  $items
     */
=======
>>>>>>> laraxot/dev
    public function addFooterBar(array $items): self
    {
        $processedItems = $this->transformItems($items);
        $this->footerBar = $this->footerBar->merge($processedItems);

        return $this;
    }

<<<<<<< HEAD
    /**
     * @param  array<int, MenuFilterInterface>  $filters
     */
=======
>>>>>>> laraxot/dev
    public function setFilters(array $filters): self
    {
        $this->filters = $filters;

        return $this;
    }

<<<<<<< HEAD
    /**
     * Collection tipizzata e vuota per l'inizializzazione dei menu.
     *
     * Costruita tramite transformItems() (anziche' collect() a vuoto) perche'
     * deve esporre esattamente lo stesso tipo generico prodotto da ogni altro
     * punto di popolamento (addSlimHeader()/addHeader()/...): Collection il
     * cui TValue e' invariante in Larastan, quindi non basta un array<...>
     * generico piu' ampio, serve lo stesso tipo esatto ovunque.
     *
     * @return Collection<int, non-empty-array<array-key, mixed>>
     */
    protected function emptyMenuCollection(): Collection
    {
        return $this->transformItems([]);
    }

    /**
     * @return array{
     *     slim_header: array<int, array<array-key, mixed>>,
     *     header: array<int, array<array-key, mixed>>,
     *     footer: array<int, array<array-key, mixed>>,
     *     footer_bar: array<int, array<array-key, mixed>>
     * }
     */
    public function build(): array
    {
        // all() (non toArray()) preserva il TValue generico esatto della
        // Collection: gli elementi qui sono gia' array PHP semplici (non
        // Arrayable), quindi il comportamento a runtime e' identico.
        return [
            'slim_header' => $this->slimHeader->all(),
            'header' => $this->header->all(),
            'footer' => $this->footer->all(),
            'footer_bar' => $this->footerBar->all(),
        ];
    }

    /**
     * @return Collection<int, non-empty-array<array-key, mixed>>
     */
=======
    public function build(): array
    {
        return [
            'slim_header' => $this->slimHeader->toArray(),
            'header' => $this->header->toArray(),
            'footer' => $this->footer->toArray(),
            'footer_bar' => $this->footerBar->toArray(),
        ];
    }

>>>>>>> laraxot/dev
    public function getHeader(): Collection
    {
        return $this->header;
    }

<<<<<<< HEAD
    /**
     * @return Collection<int, non-empty-array<array-key, mixed>>
     */
=======
>>>>>>> laraxot/dev
    public function getSlimHeader(): Collection
    {
        return $this->slimHeader;
    }

<<<<<<< HEAD
    /**
     * @return Collection<int, non-empty-array<array-key, mixed>>
     */
=======
>>>>>>> laraxot/dev
    public function getFooter(): Collection
    {
        return $this->footer;
    }

<<<<<<< HEAD
    /**
     * @return Collection<int, non-empty-array<array-key, mixed>>
     */
=======
>>>>>>> laraxot/dev
    public function getFooterBar(): Collection
    {
        return $this->footerBar;
    }

    public function loadFromConfig(): self
    {
        $config = config('sixteen.menu', []);

<<<<<<< HEAD
        if (! is_array($config)) {
            $config = [];
        }

        $slimHeader = $config['slim_header'] ?? null;
        if (is_array($slimHeader) && $slimHeader !== []) {
            $this->addSlimHeader($slimHeader);
        }

        $header = $config['header'] ?? null;
        if (is_array($header) && $header !== []) {
            $this->addHeader($header);
        }

        $footer = $config['footer'] ?? null;
        if (is_array($footer) && $footer !== []) {
            $this->addFooter($footer);
        }

        $footerBar = $config['footer_bar'] ?? null;
        if (is_array($footerBar) && $footerBar !== []) {
            $this->addFooterBar($footerBar);
=======
        if (! empty($config['slim_header'])) {
            $this->addSlimHeader($config['slim_header']);
        }

        if (! empty($config['header'])) {
            $this->addHeader($config['header']);
        }

        if (! empty($config['footer'])) {
            $this->addFooter($config['footer']);
        }

        if (! empty($config['footer_bar'])) {
            $this->addFooterBar($config['footer_bar']);
>>>>>>> laraxot/dev
        }

        return $this;
    }

    public function reset(): self
    {
<<<<<<< HEAD
        $this->slimHeader = $this->emptyMenuCollection();
        $this->header = $this->emptyMenuCollection();
        $this->footer = $this->emptyMenuCollection();
        $this->footerBar = $this->emptyMenuCollection();
=======
        $this->slimHeader = collect();
        $this->header = collect();
        $this->footer = collect();
        $this->footerBar = collect();
>>>>>>> laraxot/dev

        return $this;
    }

<<<<<<< HEAD
    /**
     * @return array<array-key, mixed>|false
     */
    public function processMenuItem(mixed $item): array|false
    {
        // Il separatore '-' va riconosciuto PRIMA del generico is_string(),
        // altrimenti '-' viene sempre intercettato come header testuale e il
        // ramo separatore sottostante non è mai raggiungibile.
        if ($item === '-') {
            return [
                'type' => 'separator',
            ];
        }

=======
    public function processMenuItem($item): array|false|null
    {
>>>>>>> laraxot/dev
        if (is_string($item)) {
            return [
                'type' => 'header',
                'text' => $item,
            ];
        }

<<<<<<< HEAD
        if (! is_array($item)) {
            return false;
        }

        foreach ($this->filters as $filter) {
            $filtered = $filter->filter($item);

            if ($filtered === false) {
                return false;
            }

            $item = $filtered;
=======
        if ($item === '-') {
            return [
                'type' => 'separator',
            ];
        }

        foreach ($this->filters as $filter) {
            if ($filter instanceof MenuFilterInterface) {
                $item = $filter->filter($item);

                if ($item === false) {
                    return false;
                }
            }
>>>>>>> laraxot/dev
        }

        $item['type'] = $this->determineItemType($item);

<<<<<<< HEAD
        if (isset($item['dropdown']) && is_array($item['dropdown'])) {
            $item['dropdown'] = $this->transformItems($item['dropdown'])->toArray();
        }

        if (isset($item['megamenu']) && is_array($item['megamenu'])) {
            $item['megamenu'] = collect($item['megamenu'])
                ->map(function (mixed $column): array {
                    return is_array($column) ? $this->transformItems($column)->toArray() : [];
=======
        if (isset($item['dropdown'])) {
            $item['dropdown'] = $this->transformItems($item['dropdown'])->toArray();
        }

        if (isset($item['megamenu'])) {
            $item['megamenu'] = collect($item['megamenu'])
                ->map(function ($column) {
                    return $this->transformItems($column)->toArray();
>>>>>>> laraxot/dev
                })
                ->toArray();
        }

        return array_merge([
            'active' => false,
            'target' => null,
            'icon' => null,
            'badge' => null,
            'attributes' => [],
        ], $item);
    }

    public function hasItems(string $menu): bool
    {
        return match ($menu) {
            'slim_header' => $this->slimHeader->isNotEmpty(),
            'header' => $this->header->isNotEmpty(),
            'footer' => $this->footer->isNotEmpty(),
            'footer_bar' => $this->footerBar->isNotEmpty(),
            default => false,
        };
    }

    public function countItems(string $menu): int
    {
        return match ($menu) {
            'slim_header' => $this->slimHeader->count(),
            'header' => $this->header->count(),
            'footer' => $this->footer->count(),
            'footer_bar' => $this->footerBar->count(),
            default => 0,
        };
    }

<<<<<<< HEAD
    /**
     * @return array<array-key, mixed>|null
     */
    public function findItem(string $id, ?string $menu = null): ?array
    {
        $menuNames = $menu !== null ? [$menu] : ['slim_header', 'header', 'footer', 'footer_bar'];

        foreach ($menuNames as $menuName) {
            $found = $this->getMenu($menuName)->first(
                fn (array $item): bool => isset($item['id']) && $item['id'] === $id
            );

            if ($found !== null) {
=======
    public function findItem(string $id, ?string $menu = null): ?array
    {
        $menus = $menu ? [$menu => $this->{$menu}] : [
            'slim_header' => $this->slimHeader,
            'header' => $this->header,
            'footer' => $this->footer,
            'footer_bar' => $this->footerBar,
        ];

        foreach ($menus as $menuItems) {
            $found = $menuItems->firstWhere('id', $id);
            if ($found) {
>>>>>>> laraxot/dev
                return $found;
            }
        }

        return null;
    }

    public function removeItem(string $id, ?string $menu = null): self
    {
<<<<<<< HEAD
        $menuNames = $menu !== null ? [$menu] : ['slim_header', 'header', 'footer', 'footer_bar'];

        foreach ($menuNames as $menuName) {
            $this->setMenu(
                $menuName,
                $this->getMenu($menuName)->reject(
                    fn (array $item): bool => isset($item['id']) && $item['id'] === $id
                )->values()
            );
=======
        $menus = $menu ? [$menu] : ['slim_header', 'header', 'footer', 'footer_bar'];

        foreach ($menus as $menuName) {
            $this->{$menuName} = $this->{$menuName}->reject(function ($item) use ($id) {
                return isset($item['id']) && $item['id'] === $id;
            });
>>>>>>> laraxot/dev
        }

        return $this;
    }

<<<<<<< HEAD
    /**
     * @param  array<array-key, mixed>  $updates
     */
    public function updateItem(string $id, array $updates, ?string $menu = null): self
    {
        $menuNames = $menu !== null ? [$menu] : ['slim_header', 'header', 'footer', 'footer_bar'];

        foreach ($menuNames as $menuName) {
            $this->setMenu(
                $menuName,
                $this->getMenu($menuName)->map(
                    function (array $item) use ($id, $updates): array {
                        if (isset($item['id']) && $item['id'] === $id) {
                            return array_merge($item, $updates);
                        }

                        return $item;
                    }
                )
            );
=======
    public function updateItem(string $id, array $updates, ?string $menu = null): self
    {
        $menus = $menu ? [$menu] : ['slim_header', 'header', 'footer', 'footer_bar'];

        foreach ($menus as $menuName) {
            $this->{$menuName} = $this->{$menuName}->map(function ($item) use ($id, $updates) {
                if (isset($item['id']) && $item['id'] === $id) {
                    return array_merge($item, $updates);
                }

                return $item;
            });
>>>>>>> laraxot/dev
        }

        return $this;
    }

<<<<<<< HEAD
    /**
     * @return array{
     *     slim_header_count: int,
     *     header_count: int,
     *     footer_count: int,
     *     footer_bar_count: int,
     *     total_items: int,
     *     has_dropdowns: bool,
     *     has_megamenus: bool
     * }
     */
=======
>>>>>>> laraxot/dev
    public function getStats(): array
    {
        return [
            'slim_header_count' => $this->slimHeader->count(),
            'header_count' => $this->header->count(),
            'footer_count' => $this->footer->count(),
            'footer_bar_count' => $this->footerBar->count(),
            'total_items' => $this->slimHeader->count() +
                           $this->header->count() +
                           $this->footer->count() +
                           $this->footerBar->count(),
            'has_dropdowns' => $this->header->contains('type', 'dropdown'),
            'has_megamenus' => $this->header->contains('type', 'megamenu'),
        ];
    }

<<<<<<< HEAD
    /**
     * @param  array<array-key, mixed>  $items
     * @return Collection<int, non-empty-array<array-key, mixed>>
     */
    protected function transformItems(array $items): Collection
    {
        return collect($items)
            ->map(fn (mixed $item): array|false => $this->processMenuItem($item))
=======
    protected function transformItems(array $items): Collection
    {
        return collect($items)
            ->map([$this, 'processMenuItem'])
>>>>>>> laraxot/dev
            ->filter()
            ->values();
    }

<<<<<<< HEAD
    /**
     * @param  array<array-key, mixed>  $item
     */
=======
>>>>>>> laraxot/dev
    protected function determineItemType(array $item): string
    {
        if (isset($item['dropdown'])) {
            return 'dropdown';
        }

        if (isset($item['megamenu'])) {
            return 'megamenu';
        }

        if (isset($item['url']) || isset($item['route'])) {
            return 'link';
        }

        return 'text';
    }
<<<<<<< HEAD

    /**
     * @return Collection<int, non-empty-array<array-key, mixed>>
     */
    protected function getMenu(string $menuName): Collection
    {
        return match ($menuName) {
            'slim_header' => $this->slimHeader,
            'header' => $this->header,
            'footer' => $this->footer,
            'footer_bar' => $this->footerBar,
            default => throw new InvalidArgumentException("Menu sconosciuto: {$menuName}"),
        };
    }

    /**
     * @param  Collection<int, non-empty-array<array-key, mixed>>  $items
     */
    protected function setMenu(string $menuName, Collection $items): void
    {
        match ($menuName) {
            'slim_header' => $this->slimHeader = $items,
            'header' => $this->header = $items,
            'footer' => $this->footer = $items,
            'footer_bar' => $this->footerBar = $items,
            default => throw new InvalidArgumentException("Menu sconosciuto: {$menuName}"),
        };
    }
=======
>>>>>>> laraxot/dev
}
