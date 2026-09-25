<?php

declare(strict_types=1);

namespace Themes\Sixteen\Providers;

<<<<<<< HEAD
use Illuminate\Support\Facades\Blade;
=======
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\View\View as ViewInstance;
>>>>>>> edd328a (.)
use Modules\Xot\Actions\Blade\RegisterBladeComponentsAction;
use Modules\Xot\Providers\XotBaseThemeServiceProvider;
use Themes\Sixteen\Console\Commands\SixteenInstallCommand;
use Themes\Sixteen\Console\Commands\SixteenPublishCommand;
use Themes\Sixteen\Contracts\MenuFilterInterface;
use Themes\Sixteen\Filters\ActiveMenuFilter;
use Themes\Sixteen\Filters\GateMenuFilter;
use Themes\Sixteen\Filters\HrefMenuFilter;
<<<<<<< HEAD
use Themes\Sixteen\Actions\CieAuthAction;
use Themes\Sixteen\Actions\MenuBuilderAction;
use Themes\Sixteen\Actions\SpidAuthAction;
use Themes\Sixteen\Adapters\ThemeAdapter;
use Themes\Sixteen\View\Composers\SixteenComposer;
=======
use Themes\Sixteen\Services\CieAuthService;
use Themes\Sixteen\Services\MenuBuilder;
use Themes\Sixteen\Services\SpidAuthService;
use Themes\Sixteen\Services\ThemeService;
use Themes\Sixteen\View\Composers\SixteenComposer;
use function Safe\glob;
use function Safe\realpath;
>>>>>>> edd328a (.)

/**
 * Enhanced Service Provider per il tema Sixteen.
 *
 * Questo provider gestisce la registrazione e configurazione
 * del tema Sixteen nell'applicazione Laravel, integrando il
 * nuovo Menu Builder System e le funzionalità avanzate.
 *
 * IMPORTANTE: Il tema Sixteen usa il namespace 'pub_theme' per le viste,
 * non 'sixteen', per essere compatibile con il sistema di temi.
 */
class ThemeServiceProvider extends XotBaseThemeServiceProvider
{
    public string $name = 'Sixteen';

    public string $nameLower = 'sixteen';

    protected string $module_dir = __DIR__.'/../../';

    protected string $module_ns = __NAMESPACE__;

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Load theme resources BEFORE parent to ensure pub_theme namespace is registered first
        $this->loadCoreThemeResources();

        parent::boot();

        // Menu system registration
        $this->registerMenuSystem();

        // View composers
        $this->registerViewComposers();

        // Artisan commands
        $this->registerCommands();

        // Publishing configurations
        $this->registerPublishing();

        // Authentication routes
        $this->registerAuthRoutes();

        // Layout shortcuts (legacy compatibility)
        $this->registerLayoutShortcuts();
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        parent::register();

        // Register core services
        $this->registerCoreServices();

        // Register menu filters
        $this->registerMenuFilters();

        // Register SPID/CIE services
        $this->registerAuthServices();
    }

    /**
     * Load core theme resources
     */
    protected function loadCoreThemeResources(): void
    {
        // IMPORTANTE: pub_theme è il namespace standard per i temi
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'pub_theme');
        $this->loadTranslationsFrom(__DIR__.'/../../lang', 'pub_theme');

        // Register 'sixteen' namespace for backward compatibility
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'sixteen');
        $this->loadTranslationsFrom(__DIR__.'/../../lang', 'sixteen');

        // Caricamento delle configurazioni del tema
        $this->loadConfigFrom(__DIR__.'/../../config', 'sixteen');
    }

    /**
     * Register the Menu Builder system
     */
    protected function registerMenuSystem(): void
    {
<<<<<<< HEAD
        // Singleton per il Menu Builder
        $this->app->singleton(MenuBuilderAction::class, static fn (): MenuBuilderAction => new MenuBuilderAction());

        // Alias per backward compatibility
        $this->app->alias(MenuBuilderAction::class, 'sixteen.menu');
=======
        $this->app->singleton(MenuBuilder::class, function (Application $app): MenuBuilder {
            $filters = [];
            foreach ($app->tagged('sixteen.menu.filters') as $filter) {
                if ($filter instanceof MenuFilterInterface) {
                    $filters[] = $filter;
                }
            }

            return new MenuBuilder($filters);
        });

        // Alias per backward compatibility
        $this->app->alias(MenuBuilder::class, 'sixteen.menu');
>>>>>>> edd328a (.)
    }

    /**
     * Register core services
     */
    protected function registerCoreServices(): void
    {
        // Theme Service con dependency injection del MenuBuilder
<<<<<<< HEAD
        $this->app->singleton('sixteen.theme', function ($app) {
            return new ThemeAdapter();
        });

        // Alias per il ThemeService
        $this->app->alias('sixteen.theme', ThemeAdapter::class);
=======
        $this->app->singleton('sixteen.theme', function (Application $app): ThemeService {
            return new ThemeService($app->make(MenuBuilder::class));
        });

        // Alias per il ThemeService
        $this->app->alias('sixteen.theme', ThemeService::class);
>>>>>>> edd328a (.)
    }

    /**
     * Register menu filters
     */
    protected function registerMenuFilters(): void
    {
        // Register default menu filters
        $this->app->singleton(HrefMenuFilter::class);
        $this->app->singleton(ActiveMenuFilter::class);
        $this->app->singleton(GateMenuFilter::class);

        // Tag them for the menu builder
        $this->app->tag([
            HrefMenuFilter::class,
            ActiveMenuFilter::class,
            GateMenuFilter::class,
        ], 'sixteen.menu.filters');

        // Register the interface binding for extension
        $this->app->bind(MenuFilterInterface::class, HrefMenuFilter::class);
    }

    /**
     * Register SPID/CIE authentication services
     */
    protected function registerAuthServices(): void
    {
        // Register SPID Auth Service
<<<<<<< HEAD
        $this->app->singleton(SpidAuthAction::class, function ($app) {
            return new SpidAuthAction;
        });

        // Register CIE Auth Service
        $this->app->singleton(CieAuthAction::class, function ($app) {
            return new CieAuthAction;
        });

        // Aliases for easier access
        $this->app->alias(SpidAuthAction::class, 'sixteen.spid');
        $this->app->alias(CieAuthAction::class, 'sixteen.cie');
=======
        $this->app->singleton(SpidAuthService::class, function ($app) {
            return new SpidAuthService;
        });

        // Register CIE Auth Service
        $this->app->singleton(CieAuthService::class, function ($app) {
            return new CieAuthService;
        });

        // Aliases for easier access
        $this->app->alias(SpidAuthService::class, 'sixteen.spid');
        $this->app->alias(CieAuthService::class, 'sixteen.cie');
>>>>>>> edd328a (.)
    }

    /**
     * Register view composers
     */
    protected function registerViewComposers(): void
    {
        // Composer per layout principali
<<<<<<< HEAD
        $this->app['view']->composer([
=======
        View::composer([
>>>>>>> edd328a (.)
            'pub_theme::layouts.app',
            'pub_theme::layouts.guest',
            'pub_theme::layouts.guest-agid',
            'pub_theme::components.layout.header',
            'pub_theme::components.layout.footer',
        ], SixteenComposer::class);
    }

    /**
     * Register Artisan commands
     */
    protected function registerCommands(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                SixteenInstallCommand::class,
                SixteenPublishCommand::class,
            ]);
        }
    }

    /**
     * Register publishing configurations
     */
    protected function registerPublishing(): void
    {
        // Pubblicazione degli assets del tema
        $this->publishes([
            __DIR__.'/../../resources/assets' => public_path('themes/sixteen/assets'),
            __DIR__.'/../../public' => public_path('themes/sixteen'),
        ], 'sixteen-assets');

        // Pubblicazione delle configurazioni del tema
        $this->publishes([
            __DIR__.'/../../config' => config_path('themes/sixteen'),
        ], 'sixteen-config');

        // Pubblicazione delle viste (opzionale per personalizzazioni)
        $this->publishes([
            __DIR__.'/../../resources/views' => resource_path('views/themes/sixteen'),
        ], 'sixteen-views');
    }

    /**
     * Register anonymous components for pub_theme namespace.
     */
    /**
     * Register Blade components for both sixteen and pub_theme namespaces.
     */
    protected function registerBladeComponents(): void
    {
        $componentNamespace = $this->module_ns.'\View\Components';

        // Register with sixteen namespace (parent)
        Blade::componentNamespace($componentNamespace, 'sixteen');

        // Register with pub_theme namespace (for theme compatibility)
        Blade::componentNamespace($componentNamespace, 'pub_theme');

        // Register anonymous components (default + pub_theme namespace)
        $componentsPath = realpath(__DIR__.'/../../resources/views/components');
<<<<<<< HEAD
        if ($componentsPath !== false) {
=======
        if ($componentsPath !== '') {
>>>>>>> edd328a (.)
            Blade::anonymousComponentPath($componentsPath);
            Blade::anonymousComponentPath($componentsPath, 'pub_theme');
        }

        // Register class-based components
        app(RegisterBladeComponentsAction::class)
            ->execute($this->module_dir.'/../View/Components', $this->module_ns);
    }

    /**
     * Register authentication routes
     */
    protected function registerAuthRoutes(): void
    {
        if (! $this->app->routesAreCached()) {
            $this->loadRoutesFrom(__DIR__.'/../../routes/auth.php');
        }
    }

    /**
     * Registra i layout shortcuts AGID per il tema (legacy compatibility).
     */
    protected function registerLayoutShortcuts(): void
    {
        // Registrazione dei layout shortcuts per facilitare l'uso
<<<<<<< HEAD
        $this->app['view']->addNamespace('layouts', __DIR__.'/../../resources/views/layouts');

        // Enhanced composer per layout AGID-compliant
        $this->app['view']->composer('layouts.guest-agid', function ($view): void {
            $themeService = app('sixteen.theme');
=======
        View::addNamespace('layouts', __DIR__.'/../../resources/views/layouts');

        View::composer('layouts.guest-agid', function (ViewInstance $view): void {
            $themeService = app(ThemeService::class);
>>>>>>> edd328a (.)

            $view->with([
                'theme_name' => 'Sixteen',
                'theme_info' => $themeService->getInfo(),
                'agid_compliant' => true,
                'accessibility_level' => 'WCAG 2.1 AA',
                'compliance_check' => $themeService->checkAgidCompliance(),
            ]);
        });
    }

    /**
     * Carica le configurazioni del tema.
     */
    protected function loadConfigFrom(string $path, string $namespace): void
    {
<<<<<<< HEAD
        if (is_dir($path)) {
            foreach (glob($path.'/*.php') as $file) {
                $name = basename($file, '.php');
                $this->mergeConfigFrom($file, $namespace.'.'.$name);
            }
=======
        if (! is_dir($path)) {
            return;
        }

        foreach (glob($path.'/*.php') as $file) {
            if (! is_string($file)) {
                continue;
            }

            $name = basename($file, '.php');
            $this->mergeConfigFrom($file, $namespace.'.'.$name);
>>>>>>> edd328a (.)
        }
    }
}
