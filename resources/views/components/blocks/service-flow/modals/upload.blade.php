{{-- Caricamento documenti. `modal`: id, close_label, title, info, form_id, uploads[] (parts/upload), cancel, save. --}}
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
                    <div>
                        <form method="post" action="" enctype="multipart/form-data" id="{{ $modal['form_id'] ?? '' }}">
                            @foreach ($modal['uploads'] ?? [] as $upload)
                                @include('pub_theme::components.blocks.service-flow.parts.upload', ['upload' => $upload])
                            @endforeach
                        </form>
                    </div>
                </div>
                <div class="modal-footer shadow flex-nowrap pt-4 w-100">
                    <button class="btn btn-outline-primary w-100 fw-bold me-4" type="button" data-bs-dismiss="modal">{{ $modal['cancel'] ?? '' }}</button>
                    <button class="btn btn-primary w-100 fw-bold" type="submit" form="">{{ $modal['save'] ?? '' }}</button>
                </div>
            </div>
        </div>
    </div>
</div>
