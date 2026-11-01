{{-- Ultimi messaggi. `content`: category_label, modal (id della finestra), more, items[] {date, title, text}. --}}
@foreach ($content['items'] ?? [] as $item)
    <div class="cmp-card-latest-messages mb-3" data-bs-toggle="modal" data-bs-target="{{ $content['modal'] ?? '#' }}" id="{{ $loop->iteration }}">
        <div class="card shadow-sm px-4 pt-4 pb-4">
            <span class="visually-hidden">{{ $content['category_label'] ?? '' }}</span>
            <div class="card-header border-0 p-0 m-0"><date class="date-xsmall">{{ $item['date'] ?? '' }}</date></div>
            <div class="card-body p-0 my-2">
                <h3 class="title-small-semi-bold t-primary m-0 mb-1"><a href="#" class="text-decoration-none">{{ $item['title'] ?? '' }}</a></h3>
                <p class="text-paragraph text-truncate">{{ $item['text'] ?? '' }}</p>
            </div>
        </div>
    </div>
@endforeach
<button type="button" class="btn btn-xs btn-me btn-label t-primary px-0"><span class="">{{ $content['more'] ?? '' }}</span></button>
