<?php

declare(strict_types=1);

use function Laravel\Folio\middleware;
use function Laravel\Folio\name;
use Livewire\Volt\Component;
use Modules\Cms\Http\Middleware\PageSlugMiddleware;

name('auth.login');
middleware(PageSlugMiddleware::class);

new class extends Component {

    public string $pageSlug = '';

    /** @var array<string, mixed> */
    public array $data = [];

    public function mount(): void
    {
        $this->pageSlug = 'auth.login';
        $this->data = [];
    }
};
?>

<x-layouts.app >
    @volt('auth.login')
    <div class="fc-home">
    <x-page side="content" :slug="$this->pageSlug" :data="$this->data" />
    </div>
    @endvolt
</x-layouts.app>
