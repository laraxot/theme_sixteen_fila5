<?php

declare(strict_types=1);

use function Laravel\Folio\middleware;
use function Laravel\Folio\name;
use Livewire\Volt\Component;
use Modules\Cms\Http\Middleware\PageSlugMiddleware;

name('oauth.redirect');
middleware(PageSlugMiddleware::class);

new class extends Component {

    public string $pageSlug = '';

    /** @var array<string, mixed> */
    public array $data = [];

    public function mount(): void
    {
        $this->pageSlug = 'oauth.redirect';
        $this->data = [];
    }
};
?>

<x-layouts.app >
    @volt('oauth.redirect')
    <div class="fc-home">
    <x-page side="content" :slug="$this->pageSlug" :data="$this->data" />
    </div>
    @endvolt
</x-layouts.app>
