{{--
    Gruppo di dati `cmp-info-summary` della famiglia multa (DCP-28). `$group`: class (default `bg-white`), header {title, class, edit {label, url}} (assente = nessuna testata),
    rows[] {label, value, class (classi del contenitore del valore, default `border-light`)}, last_row_class (se presente sostituisce `class` sull'ultima riga, es. `border-light border-0`),
    footer_class (default `card-footer p-0 d-none`).
--}}
<div class="cmp-info-summary {{ $group['class'] ?? 'bg-white' }}">
    <div class="card">
        @if (filled($group['header'] ?? null))
            <div class="card-header border-bottom border-light p-0 mb-0 {{ data_get($group, 'header.class', 'd-flex justify-content-between d-flex justify-content-end') }}">
                <h4 class="title-large-semi-bold mb-3">{{ data_get($group, 'header.title') }}</h4>
                @if (filled(data_get($group, 'header.edit')))
                    <a href="{{ data_get($group, 'header.edit.url', '#') }}" class="text-decoration-none"><span class="text-button-sm-semi t-primary">{{ data_get($group, 'header.edit.label') }}</span></a>
                @endif
            </div>
        @endif
        <div class="card-body p-0">
            @foreach ($group['rows'] ?? [] as $row)
                <div class="single-line-info border-light">
                    <div class="text-paragraph-small">{{ $row['label'] ?? '' }}</div>
                    <div class="{{ ($loop->last && filled($group['last_row_class'] ?? null)) ? $group['last_row_class'] : ($row['class'] ?? 'border-light') }}"><p class="data-text"> {{ $row['value'] ?? '' }} </p></div>
                </div>
            @endforeach
        </div>
        <div class="{{ $group['footer_class'] ?? 'card-footer p-0 d-none' }}"></div>
    </div>
</div>
