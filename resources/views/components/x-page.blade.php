<?php

/** @var string $slug */
/** @var array<string, mixed> $data */
/** @var string $side */

use Modules\Cms\Models\Page;

$pageSlug = $slug ? 'tests.'.$slug : 'tests';
$blocks = Page::getBlocksBySlug($pageSlug, 'content');

?>

<x-layouts.app>
    <div class="page-content content" data-slug="{{ $pageSlug }}" data-side="{{ $side }}">
        @foreach($blocks as $block)
            @include($block->view, array_merge($data, ['data' => $block->data]))
        @endforeach
    </div>
</x-layouts.app>