{{-- Bootstrap Italia Skiplinks Component --}}

<div class="skiplinks" role="navigation" aria-label="Skip links">
    <a class="visually-hidden-focusable screen-reader screen-reader-focusable" href="#content">
        Salta al contenuto
    </a>
    <a class="visually-hidden-focusable screen-reader screen-reader-focusable" href="#navigation">
        Salta al menu di navigazione
    </a>
    @if(!empty($links))
        @foreach($links as $link)
        <a class="visually-hidden-focusable screen-reader screen-reader-focusable"
           href="{{ $link['href'] }}">
            {{ $link['label'] }}
        </a>
        @endforeach
    @endif
</div>
