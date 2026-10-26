@props(['title' => '', 'metaDescription' => '', 'bodyPage' => '', 'searchLinks' => [], 'headerActive' => ''])
{{--
    Layout delle pagine di prova Design Comuni (pages/tests/*): header, footer e modale di ricerca nel markup del riferimento
    (sezioni con tpl design-comuni, dati da sections/*.json). `<body>` resta plain e non si inventano classi o wrapper (policy:
    docs/html-parity-body-policy.md): lo stile generato (resources/css/design-comuni/components.css) vale sotto
    `body:has(.page-content[data-dc])`, cioe' dove il wrapper porta `data-dc` (pagine /tests e pagine reali con JSON `layout` design-comuni*); lo stesso ambito isola le
    regole legacy (postcss/isolate-legacy-important.cjs). `<main>` senza attributi, come nel riferimento.
    NON e' `layouts/test`: quello serve anche pagine del front office reale (es. /it/tickets) e resta su header v1 e footer full.
    Non aggiungere `class="dc-page"` o simili: non serve a nessuno stile. Non cambiare senza rimisurare: docs/prompts/homepage/00-COORDINATION.md.
--}}
@php(view()->share('dcHeaderActive', (string) $headerActive))
<x-layouts.main :title="$title" :description="$metaDescription" :body-page="$bodyPage">
    <div class="skiplink">
        <a class="visually-hidden-focusable" href="#main-container">{{ __('pub_theme::ui.skip_to_content') }}</a>
        <a class="visually-hidden-focusable" href="#footer">{{ __('pub_theme::ui.skip_to_footer') }}</a>
    </div>

    <x-section slug="header" tpl="design-comuni" />
    <x-layouts.main-landmark :body-page="$bodyPage">{{ $slot }}</x-layouts.main-landmark>
    <x-section slug="search-modal" tpl="design-comuni" />
    <x-section slug="footer" tpl="design-comuni" />
</x-layouts.main>
