{{-- Messaggio dell'area personale. `modal`: id, close_label, date, title, subtitle, text, link. --}}
<div class="cmp-modal">
    <div class="modal fade it-dialog-scrollable" tabindex="-1" role="dialog" id="{{ $modal['id'] ?? '' }}" aria-labelledby="{{ $modal['id'] ?? '' }}-modal-title">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-dimensions h-100">
                <div class="cmp-modal__header modal-header pb-0">
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="{{ $modal['close_label'] ?? '' }}"></button>
                    <div class="cmp-modal__header mt-30 mt-lg-50"><date class="date-regular w-100">{{ $modal['date'] ?? '' }}</date>
                        <h2 id="{{ $modal['id'] ?? '' }}-modal-title" class="title-xxxlarge mt-2 mb-0">{{ $modal['title'] ?? '' }}</h2></div>
                </div>
                <div class="modal-body">
                    <div class="mb-60 mb-lg-80">
                        <h5 class="subtitle-large">{{ $modal['subtitle'] ?? '' }}</h5>
                        <p class="text-paragraph mb-4 fw-normal">{{ $modal['text'] ?? '' }}</p>
                        <a href="#" class="text-paragraph t-primary text-decoration-underline">{{ $modal['link'] ?? '' }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
