{{-- Bootstrap Italia Skiplinks Component --}}

<div class="skiplinks" role="navigation" aria-label="{{ __('pub_theme::components_common.skiplinks.region.label') }}">
    <a class="visually-hidden-focusable screen-reader screen-reader-focusable" href="#content">
        {{ __('pub_theme::components_common.skiplinks.content.label') }}
    </a>
    <a class="visually-hidden-focusable screen-reader screen-reader-focusable" href="#navigation">
        {{ __('pub_theme::components_common.skiplinks.navigation.label') }}
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
