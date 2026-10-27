{{--
    Gruppo di dati (`cmp-info-summary`). `$group`: title (h4), edit {label, url, hidden, tight (true = nessuno spazio fra `<a>` e il testo)}, no_header (true = senza testata), class (classi del gruppo, default `bg-white`),
    header_class, inline (righe "Etichetta: **valore**" su una riga), last_row_class (sostituisce la classe del valore sull'ultima riga), footer_class (default `card-footer p-0`),
    footer_button {label, icon, modal}, rows[] {label, value, id, class (classi del contenitore del valore, default `border-light`), status {tone: success|alert, text, icon}}.
    Riga con `status`: tone `alert` = avviso (con o senza valore: documento scaduto o mancante), tone `success` = esito (anche senza valore: documento inserito);
    senza `tone` vale `alert` se la riga non ha `value`, `success` altrimenti.
--}}
@php
    $assets = \Themes\Sixteen\Infrastructure\Assets\DesignComuniAssets::base();
    $icon = static fn (string $name): string => $assets.'/bootstrap-italia/dist/svg/sprites.svg#'.$name;
    $inline = (bool) ($group['inline'] ?? false);
@endphp
<div class="cmp-info-summary {{ $group['class'] ?? 'bg-white' }}">
    <div class="card">
        @unless ($group['no_header'] ?? false)
            <div class="card-header border-bottom border-light p-0 mb-0 {{ $group['header_class'] ?? 'd-flex justify-content-between d-flex justify-content-end' }}">
                @if (filled($group['title'] ?? null))<h4 class="title-large-semi-bold mb-3">{{ $group['title'] }}</h4>@endif
                @if (filled($group['edit'] ?? null))
                    <a href="{{ $group['edit']['url'] ?? '#' }}" class="{{ ($group['edit']['hidden'] ?? false) ? 'd-none ' : '' }}text-decoration-none">{!! ($group['edit']['tight'] ?? false) ? '' : "\n                        " !!}<span class="text-button-sm-semi t-primary">{{ $group['edit']['label'] ?? '' }}</span></a>
                @endif
            </div>
        @endunless
        <div class="card-body p-0">
            @foreach ($group['rows'] ?? [] as $row)
                @php
                    $status = $row['status'] ?? null;
                    $hasValue = filled($row['value'] ?? null);
                    $isAlert = filled($status) && ($status['tone'] ?? ($hasValue ? 'success' : 'alert')) === 'alert';
                    $valueClass = ($loop->last && filled($group['last_row_class'] ?? null)) ? $group['last_row_class'] : ($row['class'] ?? 'border-light');
                @endphp
                <div class="single-line-info border-light"@if (array_key_exists('id', $row)) id="{{ $row['id'] }}"@endif>
                    @if ($inline)
                        <div class="border-light summary-inline"><p class="data-text summary-inline"> {{ $row['label'] ?? '' }}
                            <strong>{{ $row['value'] ?? '' }}</strong></p></div>
                    @else
                        <div class="text-paragraph-small">{{ $row['label'] ?? '' }}</div>
                        @if ($isAlert)
                            @if ($hasValue)<p class="data-text"> {{ $row['value'] }}</p>@endif
                            <p class="fw-semibold data-text description-alert d-flex align-items-center border-light"><span class="d-flex align-items-center">
                                <svg class="icon icon-sm icon-warning" aria-hidden="true"><use href="{{ $icon($status['icon'] ?? 'it-error') }}"></use></svg> {{ $status['text'] ?? '' }} </span></p>
                        @else
                            <div class="{{ $valueClass }}">
                                @if ($hasValue || ! filled($status))<p class="data-text"> {{ $row['value'] ?? '' }} </p>@endif
                                @if (filled($status))
                                    <p class="fw-semibold pb-2 pt-2 data-text description-success d-flex align-items-center"><span class="d-flex align-items-center">
                                        <svg class="icon icon-sm icon-success" aria-hidden="true"><use href="{{ $icon($status['icon'] ?? 'it-check-circle') }}"></use></svg> {{ $status['text'] ?? '' }} </span></p>
                                @endif
                            </div>
                        @endif
                    @endif
                </div>
            @endforeach
        </div>
        <div class="{{ $group['footer_class'] ?? 'card-footer p-0' }}">
            @if (filled($group['footer_button'] ?? null))
                <button type="button" data-bs-toggle="modal" data-bs-target="{{ $group['footer_button']['modal'] ?? '#' }}" class="btn btn-outline-primary w-100 mt-3">
                    <span class="rounded-icon"><svg class="icon icon-primary icon-sm" aria-hidden="true"><use href="{{ $icon($group['footer_button']['icon'] ?? 'it-pencil') }}"></use></svg></span>
                    <span class="">{{ $group['footer_button']['label'] ?? '' }}</span></button>
            @endif
        </div>
    </div>
</div>
