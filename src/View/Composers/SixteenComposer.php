<?php

declare(strict_types=1);

namespace Themes\Sixteen\View\Composers;

use Illuminate\View\View;
use Themes\Sixteen\Events\BuildingSixteenMenu;
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< .merge_file_uCVTX9
=======
use Themes\Sixteen\Services\MenuBuilder;
>>>>>>> .merge_file_VPgYC4
=======
>>>>>>> 464cfc5 (.)

/**
 * View Composer per il tema Sixteen
 *
>>>>>>> 9e18142 (.)
use Themes\Sixteen\Actions\MenuBuilderAction;

/**
 * View Composer per il tema Sixteen
<<<<<<< HEAD
 *
=======
<<<<<<< HEAD
<<<<<<< .merge_file_uCVTX9
 *
=======
 * 
>>>>>>> .merge_file_VPgYC4
=======
 *
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
 * Questo composer inietta le configurazioni del tema e i menu
 * costruiti dinamicamente nelle viste del layout
 */
class SixteenComposer
{
    public function __construct(
        protected MenuBuilderAction $menuBuilder
    ) {}

    /**
     * Componi la vista con i dati del tema
     */
    public function compose(View $view): void
    {
        // Configurazioni base del tema
        $config = config('sixteen', []);

        // Costruzione dinamica dei menu tramite eventi
        $this->buildMenus();

<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< .merge_file_uCVTX9
        // Costruzione dinamica dei menu tramite eventi
        $this->buildMenus();

=======
        
        // Costruzione dinamica dei menu tramite eventi
        $this->buildMenus();
        
>>>>>>> .merge_file_VPgYC4
=======
        // Costruzione dinamica dei menu tramite eventi
        $this->buildMenus();

>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
        // Inietta i dati nella vista
        $view->with([
            'sixteenConfig' => $config,
            'slimHeaderMenu' => $this->menuBuilder->getSlimHeader(),
            'headerMenu' => $this->menuBuilder->getHeader(),
            'footerMenu' => $this->menuBuilder->getFooter(),
            'footerBarMenu' => $this->menuBuilder->getFooterBar(),
            'themeInfo' => [
                'name' => 'Sixteen',
                'version' => config('sixteen.version', '1.0.0'),
                'agid_compliant' => true,
                'bootstrap_italia' => true,
                'tailwind_css' => true,
            ],
        ]);
    }

    /**
     * Costruisce i menu usando il sistema di eventi
     */
    protected function buildMenus(): void
    {
        // Inizializza i menu con quelli della configurazione
        $this->initializeMenusFromConfig();

        // Lancia eventi per permettere modifiche dinamiche
        $locations = ['slim_header', 'header', 'footer', 'footer_bar'];

<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< .merge_file_uCVTX9
        // Lancia eventi per permettere modifiche dinamiche
        $locations = ['slim_header', 'header', 'footer', 'footer_bar'];

=======
        
        // Lancia eventi per permettere modifiche dinamiche
        $locations = ['slim_header', 'header', 'footer', 'footer_bar'];
        
>>>>>>> .merge_file_VPgYC4
=======
        // Lancia eventi per permettere modifiche dinamiche
        $locations = ['slim_header', 'header', 'footer', 'footer_bar'];

>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
        foreach ($locations as $location) {
            event(new BuildingSixteenMenu($this->menuBuilder, $location));
        }
    }

    /**
     * Inizializza i menu con i dati dalla configurazione
     */
    protected function initializeMenusFromConfig(): void
    {
        $menuConfig = config('sixteen.menu', []);

        if (isset($menuConfig['slim_header'])) {
            $this->menuBuilder->addSlimHeader($menuConfig['slim_header']);
        }

        if (isset($menuConfig['header'])) {
            $this->menuBuilder->addHeader($menuConfig['header']);
        }

        if (isset($menuConfig['footer'])) {
            $this->menuBuilder->addFooter($menuConfig['footer']);
        }

<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< .merge_file_uCVTX9
=======
>>>>>>> 464cfc5 (.)
        if (isset($menuConfig['slim_header'])) {
            $this->menuBuilder->addSlimHeader($menuConfig['slim_header']);
        }

        if (isset($menuConfig['header'])) {
            $this->menuBuilder->addHeader($menuConfig['header']);
        }

        if (isset($menuConfig['footer'])) {
            $this->menuBuilder->addFooter($menuConfig['footer']);
        }

<<<<<<< HEAD
=======
        
        if (isset($menuConfig['slim_header'])) {
            $this->menuBuilder->addSlimHeader($menuConfig['slim_header']);
        }
        
        if (isset($menuConfig['header'])) {
            $this->menuBuilder->addHeader($menuConfig['header']);
        }
        
        if (isset($menuConfig['footer'])) {
            $this->menuBuilder->addFooter($menuConfig['footer']);
        }
        
>>>>>>> .merge_file_VPgYC4
=======
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
        if (isset($menuConfig['footer_bar'])) {
            $this->menuBuilder->addFooterBar($menuConfig['footer_bar']);
        }
    }
}
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< .merge_file_uCVTX9
=======




>>>>>>> .merge_file_VPgYC4
=======
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
