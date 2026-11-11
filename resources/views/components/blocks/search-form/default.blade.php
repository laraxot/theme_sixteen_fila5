@props(['data' => []])

@php($searchUrl = url('/'.app()->getLocale().'/ricerca'))

<section class="dc-search-block" aria-labelledby="dc-search-title">
    <h2 id="dc-search-title">{{ $data['label'] ?? __('pub_theme::header.center.search.toggle_aria.label') }}</h2>
    <form action="{{ $searchUrl }}" method="get" class="dc-search-block__form" role="search">
        <label class="sr-only" for="dc-page-search">{{ $data['placeholder'] ?? __('pub_theme::header.center.search.toggle_aria.label') }}</label>
        <div class="dc-search-block__input-wrap">
            <svg aria-hidden="true" viewBox="0 0 24 24" focusable="false"><path d="m21 21-4.35-4.35m2.1-5.4a7.5 7.5 0 1 1-15 0 7.5 7.5 0 0 1 15 0Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-width="2"/></svg>
            <input id="dc-page-search" type="search" name="q" placeholder="{{ $data['placeholder'] ?? __('pub_theme::header.center.search.toggle_aria.label') }}">
        </div>
        <button type="submit">{{ $data['button_label'] ?? __('pub_theme::header.center.search.label') }}</button>
    </form>
</section>
