<?php

declare(strict_types=1);

use function Laravel\Folio\middleware;
use function Laravel\Folio\name;
use Modules\Cms\Http\Middleware\PageSlugMiddleware;

name('tests.view');
middleware(PageSlugMiddleware::class);
?>
@php
    $slug = (string) request()->route('slug', '');
    $pageSlug = $slug !== '' ? 'tests.'.$slug : 'tests';
    $locale = app()->getLocale();

    $blocks = \Modules\Cms\Models\Page::getBlocksBySlug($pageSlug, 'content');

    $pageTitle = match ($slug) {
        'segnalazione-dettaglio' => 'Segnalazione disservizio - Scheda servizio',
        'segnalazioni-elenco' => 'Elenco segnalazioni',
        default => ucfirst(str_replace('-', ' ', $slug)),
    };

    $pageMetaDescription = match ($slug) {
        'segnalazione-dettaglio' => 'Dettaglio del servizio di segnalazione disservizio.',
        'segnalazioni-elenco' => 'Elenco delle segnalazioni ricevute dal comune.',
        default => 'Pagina di test ' . $pageTitle,
    };

    $data = ['slug' => $slug];
@endphp
<x-layouts.app :title="$pageTitle" :meta-description="$pageMetaDescription">
    <div id="main-container" class="container cms-view-wrapper">
        <div class="page-content content" data-slug="{{ $pageSlug }}" data-side="content">
            @foreach($blocks as $block)
                @include($block->view, array_merge(['data' => []], $block->data))
            @endforeach
        </div>
    </div>
</x-layouts.app>
