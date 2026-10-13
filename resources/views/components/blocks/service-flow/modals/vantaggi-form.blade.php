{{--
    Modulo in finestra (vantaggi): campi di testo, interruttori e caricamenti. `modal`: id, close_label, title, info, body_class (contenitore del form, opzionale),
    form {id, class, enctype}, items[] (parts/vantaggi-form-items), cancel, save, save_form (valore dell'attributo `form` del pulsante di invio).
--}}
<div class="cmp-modal">
    <div class="modal it-dialog-scrollable fade" tabindex="-1" role="dialog" id="{{ $modal['id'] ?? '' }}" aria-labelledby="{{ $modal['id'] ?? '' }}-modal-title">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="cmp-modal__header modal-header pb-0">
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="{{ $modal['close_label'] ?? '' }}"></button>
                    <h2 class="cmp-modal__header-title title-large-semi-bold" id="{{ $modal['id'] ?? '' }}-modal-title">{{ $modal['title'] ?? '' }}</h2>
                    <p class="cmp-modal__header-info">{{ $modal['info'] ?? '' }}</p>
                </div>
                <div class="modal-body">
                    @if (filled($modal['body_class'] ?? null))<div class="{{ $modal['body_class'] }}">@endif
                    <form action="" id="{{ data_get($modal, 'form.id') }}"{!! filled(data_get($modal, 'form.class')) ? ' class="'.e(data_get($modal, 'form.class')).'"' : '' !!}{!! filled(data_get($modal, 'form.enctype')) ? ' enctype="'.e(data_get($modal, 'form.enctype')).'"' : '' !!}>
                        @include('pub_theme::components.blocks.service-flow.parts.vantaggi-form-items', ['items' => $modal['items'] ?? []])
                    </form>
                    @if (filled($modal['body_class'] ?? null))</div>@endif
                </div>
                <div class="modal-footer shadow flex-nowrap pt-4 w-100">
                    <button class="btn btn-outline-primary w-100 fw-bold me-4" type="button" data-bs-dismiss="modal">{{ $modal['cancel'] ?? '' }}</button>
                    <button class="btn btn-primary w-100 fw-bold" type="submit" form="{{ $modal['save_form'] ?? '' }}">{{ $modal['save'] ?? '' }}</button>
                </div>
            </div>
        </div>
    </div>
</div>
