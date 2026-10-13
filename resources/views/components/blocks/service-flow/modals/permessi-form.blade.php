{{--
    Finestra con modulo a campi bloccati, menu e caricamenti (veicolo). `modal`: id, close_label, title, info, form_id, form_class, fields[] con `type`:
    input {id, label, placeholder, hint, disabled}, select {id, label, hint, placeholder, options[]}, upload (parts/upload); cancel, save.
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
                    <form action="" id="{{ $modal['form_id'] ?? '' }}" class="{{ $modal['form_class'] ?? 'text-black' }}" enctype="multipart/form-data">
                        @foreach ($modal['fields'] ?? [] as $field)
                            <div class="mb-4">
                                @switch($field['type'] ?? '')
                                    @case('input')
                                        <div class="form-group cmp-input">
                                            <label class="cmp-input__label" for="{{ $field['id'] ?? '' }}">{{ $field['label'] ?? '' }}</label>
                                            <input type="text" class="form-control" id="{{ $field['id'] ?? '' }}" name="{{ $field['id'] ?? '' }}" placeholder="{{ $field['placeholder'] ?? '' }}" required{!! ($field['disabled'] ?? false) ? ' disabled="disabled"' : '' !!}>
                                            <div class="d-flex"><span class="form-text cmp-input__text"> {{ $field['hint'] ?? '' }}</span></div>
                                        </div>
                                        @break
                                    @case('select')
                                        <div class="select-wrapper select-partials">
                                            <label for="{{ $field['id'] ?? '' }}" class="">{{ $field['label'] ?? '' }}</label>
                                            <select id="{{ $field['id'] ?? '' }}" class="" required>
                                                <option selected="selected" value="">{{ $field['placeholder'] ?? '' }}</option>
                                                @foreach ($field['options'] ?? [] as $option)
                                                    <option value="{{ $option }}">{{ $option }}</option>
                                                @endforeach
                                            </select>
                                            <div class="d-flex"><span class="form-text cmp-input__text"> {{ $field['hint'] ?? '' }}</span></div>
                                        </div>
                                        @break
                                    @case('upload')
                                        @include('pub_theme::components.blocks.service-flow.parts.upload', ['upload' => $field])
                                        @break
                                @endswitch
                            </div>
                        @endforeach
                    </form>
                </div>
                <div class="modal-footer shadow flex-nowrap pt-4 w-100">
                    <button class="btn btn-outline-primary w-100 fw-bold me-4" type="button" data-bs-dismiss="modal">{{ $modal['cancel'] ?? '' }}</button>
                    <button class="btn btn-primary w-100 fw-bold" type="submit" form="">{{ $modal['save'] ?? '' }}</button>
                </div>
            </div>
        </div>
    </div>
</div>
