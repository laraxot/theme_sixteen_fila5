{{-- Modulo in finestra con campi di testo e caricamento. `modal`: id, close_label, title, info, form_id, fields[] {id, label, hint}, uploads[], cancel, save. --}}
<div class="cmp-modal-scrollable">
    <div class="modal fade" tabindex="-1" role="dialog" id="{{ $modal['id'] ?? '' }}" aria-labelledby="{{ $modal['id'] ?? '' }}-modal-title">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header flex-column align-items-start">
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="{{ $modal['close_label'] ?? '' }}"></button>
                    <div class="cmp-modal-scrollable__header">
                        <h2 class="cmp-modal-scrollable__header-title" id="{{ $modal['id'] ?? '' }}-modal-title">{{ $modal['title'] ?? '' }}</h2>
                        <p class="cmp-modal-scrollable__header-info">{{ $modal['info'] ?? '' }}</p>
                    </div>
                </div>
                <div class="modal-body">
                    <form action="" id="{{ $modal['form_id'] ?? '' }}">
                        @foreach ($modal['fields'] ?? [] as $field)
                            <div class="form-group cmp-input">
                                <label class="cmp-input__label" for="{{ $field['id'] ?? '' }}">{{ $field['label'] ?? '' }}</label>
                                <input type="text" class="form-control" id="{{ $field['id'] ?? '' }}" name="{{ $field['id'] ?? '' }}" required>
                                <div class="d-flex"><span class="form-text cmp-input__text"> {{ $field['hint'] ?? '' }}</span></div>
                            </div>
                        @endforeach
                        @foreach ($modal['uploads'] ?? [] as $upload)
                            @include('pub_theme::components.blocks.service-flow.parts.upload', ['upload' => $upload])
                        @endforeach
                    </form>
                </div>
                <div class="modal-footer shadow flex-nowrap pt-4 w-100">
                    <button class="btn btn-outline-primary w-100 fw-bold me-4" data-bs-dismiss="modal" type="button">{{ $modal['cancel'] ?? '' }}</button>
                    <button class="btn btn-primary w-100 fw-bold" type="submit" form="">{{ $modal['save'] ?? '' }}</button>
                </div>
            </div>
        </div>
    </div>
</div>
