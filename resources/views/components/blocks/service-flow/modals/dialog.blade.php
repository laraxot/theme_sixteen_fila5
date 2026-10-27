{{--
    Finestra di conferma piccola. `modal`: id, close_label, header {title, info, link {label, url}}, success {icon, message} (corpo con esito),
    footer {buttons[] {label, variant: primary|outline, target (id della finestra successiva)}} (assente = nessun piede).
--}}
@php
    $assets = \Themes\Sixteen\Infrastructure\Assets\DesignComuniAssets::base();
    $icon = static fn (string $name): string => $assets.'/bootstrap-italia/dist/svg/sprites.svg#'.$name;
@endphp
<div class="cmp-modal">
    <div class="modal fade" tabindex="-1" role="dialog" id="{{ $modal['id'] ?? '' }}" aria-labelledby="{{ $modal['id'] ?? '' }}-modal-title">
        <div class="modal-dialog modal-dialog-centered small" role="document">
            <div class="modal-content modal-dimensions">
                <div class="cmp-modal__header modal-header pb-0">
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="{{ $modal['close_label'] ?? '' }}"></button>
                    <h2 class="cmp-modal__header-title title-mini" id="{{ $modal['id'] ?? '' }}-modal-title">{{ data_get($modal, 'header.title') }}</h2>
                    <p class="cmp-modal__header-info header-font">{{ data_get($modal, 'header.info') }}</p>
                    @if (filled(data_get($modal, 'header.link')))<a href="{{ data_get($modal, 'header.link.url', '#') }}" class="cmp-modal__header-link text-success underline mt-1">{{ data_get($modal, 'header.link.label') }}</a>@endif
                </div>
                <div class="modal-body">
                    @if (filled($modal['success'] ?? null))
                        <div class="d-flex justify-content-center align-items-center pb-70">
                            <svg class="icon icon-success icon-md"><use href="{{ $icon($modal['success']['icon'] ?? 'it-check-circle') }}"></use></svg>
                            <span class="cmp-modal__success-message">{{ $modal['success']['message'] ?? '' }}</span>
                        </div>
                    @endif
                </div>
                @if (filled($modal['footer'] ?? null))
                    <div class="modal-footer pb-70 pt-0">
                        @foreach (data_get($modal, 'footer.buttons', []) as $button)
                            @if (($button['variant'] ?? 'primary') === 'primary')
                                <button class="btn btn-primary w-100 mx-0 fw-bold mb-4" type="submit" data-bs-toggle="modal" data-bs-target="{{ $button['target'] ?? '#' }}" form="">{{ $button['label'] ?? '' }}</button>
                            @else
                                <button class="btn btn-outline-primary w-100 mx-0" data-bs-dismiss="modal fw-bold" type="button">{{ $button['label'] ?? '' }}</button>
                            @endif
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
