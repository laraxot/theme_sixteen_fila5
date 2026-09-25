<?php

declare(strict_types=1);

namespace Themes\Sixteen\Events;

use Illuminate\Foundation\Events\Dispatchable;
<<<<<<< HEAD
use Themes\Sixteen\Actions\MenuBuilderAction;
=======
use Themes\Sixteen\Services\MenuBuilder;
>>>>>>> edd328a (.)

/**
 * Event che viene lanciato durante la costruzione del menu del tema Sixteen
 *
 * Questo event permette di modificare il menu prima che venga renderizzato,
 * seguendo il pattern dell'official Italia Design Theme
 */
class BuildingSixteenMenu
{
    use Dispatchable;

    public function __construct(
<<<<<<< HEAD
        public MenuBuilderAction $menuBuilder,
=======
        public MenuBuilder $menuBuilder,
>>>>>>> edd328a (.)
        public string $location
    ) {}

    /**
     * Aggiunge elementi al menu corrente in base alla location
     */
<<<<<<< HEAD
=======
    /**
     * @param  array<int, array<string, mixed>|string>  $items
     */
>>>>>>> edd328a (.)
    public function addMenuItems(array $items): void
    {
        match ($this->location) {
            'slim_header' => $this->menuBuilder->addSlimHeader($items),
            'header' => $this->menuBuilder->addHeader($items),
            'footer' => $this->menuBuilder->addFooter($items),
            'footer_bar' => $this->menuBuilder->addFooterBar($items),
            default => throw new \InvalidArgumentException("Unknown menu location: {$this->location}")
        };
    }

    /**
     * Ottiene il menu builder per modifiche avanzate
     */
<<<<<<< HEAD
    public function getMenuBuilder(): MenuBuilderAction
=======
    public function getMenuBuilder(): MenuBuilder
>>>>>>> edd328a (.)
    {
        return $this->menuBuilder;
    }

    /**
     * Ottiene la location del menu corrente
     */
    public function getLocation(): string
    {
        return $this->location;
    }
}
