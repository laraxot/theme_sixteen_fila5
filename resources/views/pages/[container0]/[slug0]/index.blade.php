<?php

declare(strict_types=1);

use function Laravel\Folio\middleware;
use function Laravel\Folio\name;
use Livewire\Volt\Component;
use Modules\Cms\Actions\ResolvePageAction;
use Modules\Cms\Http\Middleware\PageSlugMiddleware;

name('container0.view');
middleware(PageSlugMiddleware::class);

new class extends Component {
    public string $container0 = '';
    public string $slug0 = '';

    public string $pageSlug = '';

    /** @var array<string, mixed> */
    public array $data = [];

    public function mount(string $container0, string $slug0 = ''): void
    {
        $this->container0 = $container0;
        $this->slug0 = $slug0;

        $resolved = app(ResolvePageAction::class)->execute($container0, $slug0);

        $this->pageSlug = $resolved->pageSlug;
        $item = $resolved->item;

        $this->data = [
            'container0' => $container0,
            'slug0' => $slug0,
            'slug' => $slug0,
            'item' => $item,
        ];
    }
};
?>

@php
    $cmsPage = \Modules\Cms\Models\Page::findUniqueBySlug(request()->segment(2).'.'.request()->segment(3));
    $specialPage = $container0 === 'auth' && $slug0 === 'login'
        ? 'auth-login'
        : ($container0 === 'auth' && $slug0 === 'register'
        ? 'auth-register'
        : ($container0 === 'tickets' && $slug0 === 'track'
        ? 'ticket-track'
        : ($container0 === 'tickets' && ctype_digit($slug0) ? 'ticket-detail' : null)));
    $pageTitle = $specialPage === 'auth-login'
        ? __('Accedi a FixCity')
        : ($specialPage === 'auth-register'
        ? __('Crea il tuo account')
        : ($specialPage === 'ticket-track'
        ? __('fixcity::ticket.track.title')
        : ($specialPage === 'ticket-detail' ? __('pub_theme::home.map.details')
        : ($cmsPage?->getTranslation('title', app()->getLocale(), false) ?? config('app.name')))));
    $pageDescription = $cmsPage?->getAttribute('description') ?? '';
@endphp
<x-layouts.app :title="$pageTitle" :meta-description="$pageDescription">
    <div class="page-content content" data-slug="{{ request()->segment(2).'.'.request()->segment(3) }}" data-side="content">
        @if ($specialPage === 'auth-login')
            @include('pub_theme::components.pages.auth-login')
        @elseif ($specialPage === 'auth-register')
            @include('pub_theme::components.pages.auth-register')
        @elseif ($specialPage === 'ticket-track')
            @include('pub_theme::components.pages.ticket-track')
        @elseif ($specialPage === 'ticket-detail')
            @include('pub_theme::components.pages.ticket-detail')
        @else
            @volt('container0.view')
                <x-page side="content" :slug="$this->pageSlug" :data="$this->data" />
            @endvolt
        @endif
    </div>
</x-layouts.app>
