{{--
    Gruppo di dati (`cmp-info-summary`), variante graduatoria di parts/info-summary (DCP-26). `$group`: title (h4), edit {label, url, hidden}, class (default `bg-white`),
    header_class, rows[] {label, value, id, status {tone: success|alert, text, icon}}, footer_button {label, icon, modal}.
    Riga con `status`: tone `success` = esito (anche senza valore: documento inserito), tone `alert` = avviso (con o senza valore: documento scaduto o mancante).
--}}
@php
    $assets = asset('themes/Sixteen/design-comuni/assets');
    $icon = static fn (string $name): string => $assets.'/bootstrap-italia/dist/svg/sprites.svg#'.$name;
@endphp
<div class="cmp-info-summary {{ $group['class'] ?? 'bg-white' }}">
    <div class="card">
        <div class="card-header border-bottom border-light p-0 mb-0 {{ $group['header_class'] ?? 'd-flex justify-content-between d-flex justify-content-end' }}">
            @if (filled($group['title'] ?? null))<h4 class="title-large-semi-bold mb-3">{{ $group['title'] }}</h4>@endif
            @if (filled($group['edit'] ?? null))
                <a href="{{ $group['edit']['url'] ?? '#' }}" class="{{ ($group['edit']['hidden'] ?? false) ? 'd-none ' : '' }}text-decoration-none">
                    <span class="text-button-sm-semi t-primary">{{ $group['edit']['label'] ?? '' }}</span></a>
            @endif
        </div>
        <div class="card-body p-0">
            @foreach ($group['rows'] ?? [] as $row)
                @php
                    $status = $row['status'] ?? null;
                    $hasValue = filled($row['value'] ?? null);
                    $isAlert = filled($status) && ($status['tone'] ?? 'success') === 'alert';
                @endphp
                <div class="single-line-info border-light"@if (array_key_exists('id', $row)) id="{{ $row['id'] }}"@endif>
                    <div class="text-paragraph-small">{{ $row['label'] ?? '' }}</div>
                    @if ($isAlert)
                        @if ($hasValue)<p class="data-text"> {{ $row['value'] }}</p>@endif
                        <p class="fw-semibold data-text description-alert d-flex align-items-center border-light"><span class="d-flex align-items-center">
                            <svg class="icon icon-sm icon-warning" aria-hidden="true"><use href="{{ $icon($status['icon'] ?? 'it-error') }}"></use></svg> {{ $status['text'] ?? '' }} </span></p>
                    @else
                        <div class="border-light">
                            @if ($hasValue || ! filled($status))<p class="data-text"> {{ $row['value'] ?? '' }} </p>@endif
                            @if (filled($status))
                                <p class="fw-semibold pb-2 pt-2 data-text description-success d-flex align-items-center"><span class="d-flex align-items-center">
                                    <svg class="icon icon-sm icon-success" aria-hidden="true"><use href="{{ $icon($status['icon'] ?? 'it-check-circle') }}"></use></svg> {{ $status['text'] ?? '' }} </span></p>
                            @endif
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
        <div class="card-footer p-0">
            @if (filled($group['footer_button'] ?? null))
                <button type="button" data-bs-toggle="modal" data-bs-target="{{ $group['footer_button']['modal'] ?? '#' }}" class="btn btn-outline-primary w-100 mt-3">
                    <span class="rounded-icon"><svg class="icon icon-primary icon-sm" aria-hidden="true"><use href="{{ $icon($group['footer_button']['icon'] ?? 'it-pencil') }}"></use></svg></span>
                    <span class="">{{ $group['footer_button']['label'] ?? '' }}</span></button>
            @endif
        </div>
    </div>
</div>
