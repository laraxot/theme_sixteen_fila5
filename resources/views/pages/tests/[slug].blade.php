<?php

declare(strict_types=1);

use Livewire\Volt\Component;
use Modules\Cms\Models\Page;
use Modules\Cms\Http\Middleware\PageSlugMiddleware;
use Illuminate\Support\Facades\File;

use function Laravel\Folio\middleware;
use function Laravel\Folio\name;

name('tests.view');
middleware(PageSlugMiddleware::class);

new class extends Component
{
    public string $slug = '';

    public string $pageSlug = '';

    /** @var array<string, mixed> */
    public array $data = [];

    public bool $catalogFallback = false;

    public function mount(string $slug = ''): void
    {
        $this->slug = $slug;
        $this->pageSlug = $slug ? 'tests.'.$slug : 'tests';
        $this->data = ['slug' => $slug];
        if ($slug !== '' && Page::findUniqueBySlug($this->pageSlug) === null) {
            $catalogPath = app(\Modules\Tenant\Actions\Config\GetTenantFilePathAction::class)->execute('database/content/pages/tests.catalog.json');
            if (is_string($catalogPath) && File::exists($catalogPath)) {
                $entry = File::json($catalogPath)['pages'][$slug] ?? null;
                if (is_array($entry)) {
                    $this->catalogFallback = true;
                    $this->data = array_merge($entry, ['home_url' => route('tests.index')]);
                }
            }
        }
    }
};
?>

<x-layouts.app>
    @volt('tests.view')
    <div class="page-content content" data-slug="{{ $pageSlug }}" data-side="content">
        @if($catalogFallback)
            @include('pub_theme::components.blocks.catalog-page', ['data' => $data])
        @else
            <x-page side="content" :slug="$pageSlug" :data="$data" />
        @endif
    </div>
    @endvolt
</x-layouts.app>
