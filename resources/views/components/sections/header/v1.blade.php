@props([
    'blocks' => [],
    'view' => null,
    'brand' => null,
    'brand_subtitle' => null,
    'cta_label' => null,
    'cta_url' => null,
    'items' => [],
    'navigation' => [],
    'logo' => null,
    'utility_links' => [],
    'account' => null,
])

@php
    // x-section supplies the locale-resolved CMS blocks; preserve them.
    if ($blocks === []) {
        $headerData = [
            'brand' => $brand,
            'brand_subtitle' => $brand_subtitle,
            'cta_label' => $cta_label,
            'cta_url' => $cta_url,
            'items' => $items,
            'navigation' => $navigation,
            'logo' => $logo,
            'utility_links' => $utility_links,
            'account' => $account,
        ];

        $blocks = [['data' => $headerData]];
    }
@endphp

@include('pub_theme::components.sections.header.tailwind', ['blocks' => $blocks])
