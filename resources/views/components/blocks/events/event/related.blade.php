@props(['title' => null, 'items' => []])
@php
    $title = $title ?? __('pub_theme::navigation.homepage.related_events');
@endphp
<x-blocks.news.featured :title="$title" :items="$items" />
