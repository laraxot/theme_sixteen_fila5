{{--
    Pulsante di azione con link di approfondimento (`cmp-text-button`). `section`: class, buttons[] {label, class, image {file, alt}}, link {label, url}.
    Le immagini sono in public/design-comuni/assets/images.
--}}
@php
    $assets = \Themes\Sixteen\Infrastructure\Assets\DesignComuniAssets::base();
@endphp
<div class="{{ trim('cmp-text-button '.($section['class'] ?? '')) }}">
    <div class="button-wrapper">
        @foreach ($section['buttons'] ?? [] as $button)
            <button type="button" class="{{ $button['class'] ?? 'btn btn-primary' }}">
                @if (filled($button['image'] ?? null))<img src="{{ $assets }}/images/{{ $button['image']['file'] ?? '' }}" alt="{{ $button['image']['alt'] ?? '' }}" class="me-2">@endif
                <span class="">{{ $button['label'] ?? '' }}</span></button>
        @endforeach
    </div>
    @if (filled($section['link'] ?? null))
        <a class="simple-link" href="{{ $section['link']['url'] ?? '#' }}">{{ $section['link']['label'] ?? '' }} <span class="visually-hidden">{{ $section['link']['label'] ?? '' }}</span></a>
    @endif
</div>
