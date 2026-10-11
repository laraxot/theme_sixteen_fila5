<?php

declare(strict_types=1);

use function Laravel\Folio\middleware;
use function Laravel\Folio\name;
use Livewire\Volt\Component;
use Modules\Cms\Http\Middleware\PageSlugMiddleware;

name('container1.index');
middleware(PageSlugMiddleware::class);

new class extends Component {
    public string $container0 = '';
    public string $slug0 = '';
    public string $container1 = '';

    public string $pageSlug = '';

    /** @var array<string, mixed> */
    public array $data = [];

    public function mount(string $container0, string $slug0 = '', string $container1 = ''): void
    {
        $this->container0 = $container0;
        $this->slug0 = $slug0;
        $this->container1 = $container1;
        $this->pageSlug = $container0.'.view';
        $this->data = [
            'container0' => $container0,
            'slug0' => $slug0,
            'container1' => $container1,
        ];
    }
};
?>

@php
    $specialPage = $container0 === 'auth' && $slug0 === 'password' && $container1 === 'reset'
        ? 'auth-password-reset'
        : ($container0 === 'auth' && $slug0 === 'password' && $container1 === 'confirm'
            ? 'auth-password-confirm'
            : null);
    $pageTitle = $specialPage === 'auth-password-reset' || $specialPage === 'auth-password-confirm'
        ? __('Reimposta la password')
        : config('app.name');
@endphp
<x-layouts.app :title="$pageTitle">
    @if ($container0 === 'auth' && $slug0 === 'password' && $container1 === 'reset')
        @include('pub_theme::components.pages.auth-password-reset')
    @else
        @volt('container1.index')
            <div class="page-content content" data-slug="{{ $pageSlug }}" data-side="content">
                <x-page side="content" :slug="$pageSlug" :data="$data" />
            </div>
        @endvolt
    @endif
</x-layouts.app>
