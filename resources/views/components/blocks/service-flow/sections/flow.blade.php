{{--
    Sezione di testo (cornice semplice): `section` = id, class, title, title_class (default `title-xxlarge mb-3`), items[] con `type`:
    paragraph {text, class}, list {items[]}, button {label, class}, attachment {label, title, aria, url, icon}.
    Il testo dei paragrafi accetta **grassetto** e \n (a capo): vedi parts/rich.
--}}
@php
    $assets = asset('themes/Sixteen/design-comuni/assets');
    $icon = static fn (string $name): string => $assets.'/bootstrap-italia/dist/svg/sprites.svg#'.$name;
@endphp
<section class="{{ trim('it-page-section '.($section['class'] ?? '')) }}" id="{{ $section['id'] ?? '' }}">
    <h2 class="{{ $section['title_class'] ?? 'title-xxlarge mb-3' }}">{{ $section['title'] ?? '' }}</h2>
    @foreach ($section['items'] ?? [] as $item)
        @switch($item['type'] ?? '')
            @case('paragraph')
                <p class="{{ $item['class'] ?? 'text-paragraph lora mb-0' }}">@include('pub_theme::components.blocks.service-flow.parts.rich', ['text' => $item['text'] ?? ''])</p>
                @break
            @case('list')
                <ul class="list-wrapper lora">
                    @foreach ($item['items'] ?? [] as $entry)
                        <li class="list-item"><span>{{ $entry }}</span></li>
                    @endforeach
                </ul>
                @break
            @case('button')
                <button type="button" class="{{ $item['class'] ?? 'btn btn-primary' }}"><span class="">{{ $item['label'] ?? '' }}</span></button>
                @break
            @case('attachment')
                <div class="cmp-icon-link">
                    <a class="list-item icon-left d-inline-block" href="{{ $item['url'] ?? '#' }}" aria-label="{{ $item['aria'] ?? '' }}" title="{{ $item['title'] ?? '' }}">
                        <span class="list-item-title-icon-wrapper">
                            <svg class="icon icon-primary icon-sm me-1" aria-hidden="true"><use href="{{ $icon($item['icon'] ?? 'it-clip') }}"></use></svg>
                            <span class="list-item">{{ $item['label'] ?? '' }}</span></span></a>
                </div>
                @break
        @endswitch
    @endforeach
</section>
