<?php

declare(strict_types=1);

namespace Themes\Sixteen\Services;

use Illuminate\Support\Collection;
use Themes\Sixteen\Contracts\MenuFilterInterface;

/**
 * Menu Builder Service per Sixteen Theme
 * Ispirato al tema ufficiale italia/design-laravel-theme
 * Supporta menu dinamici, filtri e autorizzazioni
 */
class MenuBuilder
{
    protected Collection $slimHeader;

    protected Collection $header;

    protected Collection $footer;

    protected Collection $footerBar;

    protected array $filters = [];

    public function __construct()
    {
        $this->slimHeader = collect();
        $this->header = collect();
        $this->footer = collect();
        $this->footerBar = collect();
    }

    /**
     * Aggiungi elementi al menu slim header
     */
    public function addSlimHeader(array $items): self
    {
        $processedItems = $this->transformItems($items);
        $this->slimHeader = $this->slimHeader->merge($processedItems);

        return $this;
    }

    /**
     * Aggiungi elementi al menu header principale
     */
    public function addHeader(array $items): self
    {
        $processedItems = $this->transformItems($items);
        $this->header = $this->header->merge($processedItems);

        return $this;
    }

    /**
     * Aggiungi elementi al menu footer
     */
    public function addFooter(array $items): self
    {
        $processedItems = $this->transformItems($items);
        $this->footer = $this->footer->merge($processedItems);

        return $this;
    }

    /**
     * Aggiungi elementi alla footer bar
     */
    public function addFooterBar(array $items): self
    {
        $processedItems = $this->transformItems($items);
        $this->footerBar = $this->footerBar->merge($processedItems);

        return $this;
    }

    /**
     * Registra filtri da applicare ai menu items
     */
    public function setFilters(array $filters): self
    {
        $this->filters = $filters;

        return $this;
    }

    /**
     * Costruisci e restituisci tutti i menu
     */
    public function build(): array
    {
        return [
            'slim_header' => $this->slimHeader->toArray(),
            'header' => $this->header->toArray(),
            'footer' => $this->footer->toArray(),
            'footer_bar' => $this->footerBar->toArray(),
        ];
    }

    /**
     * Ottieni solo il menu header
     */
    public function getHeader(): Collection
    {
        return $this->header;
    }

    /**
     * Ottieni solo il menu slim header
     */
    public function getSlimHeader(): Collection
    {
        return $this->slimHeader;
    }

    /**
     * Ottieni solo il menu footer
     */
    public function getFooter(): Collection
    {
        return $this->footer;
    }

    /**
     * Ottieni solo la footer bar
     */
    public function getFooterBar(): Collection
    {
        return $this->footerBar;
    }

    /**
     * Carica menu dalla configurazione
     */
    public function loadFromConfig(): self
    {
        $config = config('sixteen.menu', []);

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
        }

        return $this;
    }

    /**
     * Reset di tutti i menu
     */
    public function reset(): self
    {
        $this->slimHeader = collect();
        $this->header = collect();
        $this->footer = collect();
        $this->footerBar = collect();

        return $this;
    }

    /**
return array_merge([
            'active' => false,
            'target' => null,
            'icon' => null,
            'badge' => null,
            'attributes' => [],
        ], $item);
/**
     * Trasforma e processa gli elementi del menu
     */
    protected function transformItems(array $items): Collection
    {
        return collect($items)
            ->map([$this, 'processMenuItem'])
            ->filter() // Rimuove elementi false/null dai filtri
            ->values(); // Re-index array
    }

    /**
     * Determina il tipo di elemento del menu
     */
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
}
