<?php
declare(strict_types=1);
use function Laravel\Folio\{middleware, name};
use Filament\Notifications\Notification;
use Filament\Notifications\Livewire\Notifications;
use Filament\Notifications\Actions\Action;
use Filament\Support\Enums\Alignment;
use Filament\Support\Enums\VerticalAlignment;
use Livewire\Volt\Component;
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
use Modules\Tenant\Services\TenantService;
>>>>>>> 464cfc5 (.)
>>>>>>> laraxot/dev
use Modules\Cms\Models\Page;
use Modules\Cms\Http\Middleware\PageSlugMiddleware;

/** @var array */
<<<<<<< HEAD
//$middleware=app(\Modules\Tenant\Actions\Config\ResolveTenantConfigValueAction::class)->execute('middleware');
=======
<<<<<<< HEAD
//$middleware=app(\Modules\Tenant\Actions\Config\ResolveTenantConfigValueAction::class)->execute('middleware');
=======
//$middleware=TenantService::config('middleware');
>>>>>>> 464cfc5 (.)
>>>>>>> laraxot/dev
//$base_middleware=Arr::get($middleware,'base',[]);

$base_middleware=[];

name('pages.view');
/*
if(isset($slug)){
    $middleware=Page::getMiddlewareBySlug($slug);
    middleware($middleware);
}
*/
middleware(PageSlugMiddleware::class);



new class extends Component
{
    public string $slug;

   
};

?>

<x-layouts.app>
    @volt('pages.view')
    <div>
        <x-page side="content" :slug="$slug" />
    </div>
    @endvolt
</x-layouts.app>
