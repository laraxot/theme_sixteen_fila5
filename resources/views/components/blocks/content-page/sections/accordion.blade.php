{{--
    Accordion FAQ `cmp-accordion faq` (collapse montato dal JS condiviso da data-bs-toggle/data-bs-target) e pulsante "Carica altre domande".
    $section = {accordion_id, col_class, items[{id, question, answer}], more{col_class, label}}. Il riferimento ha aria-expanded="true" su pulsanti chiusi e
    lo lascia cosi' anche dopo il clic (misurato con dom-diff-after-click): replicato tale e quale per la parity.
--}}
<div class="row">
    <div class="{{ $section['col_class'] ?? 'col-12' }}">
        <div class="cmp-accordion faq">
            <div class="accordion" id="{{ $section['accordion_id'] ?? '' }}">
                @foreach ($section['items'] ?? [] as $item)
                    <div class="accordion-item">
                        <div class="accordion-header" id="heading{{ $item['id'] }}">
                            <button class="accordion-button collapsed title-snall-semi-bold py-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $item['id'] }}" aria-expanded="true" aria-controls="collapse{{ $item['id'] }}">
                                <div class="button-wrapper">{{ $item['question'] ?? '' }}
                                    <div class="icon-wrapper">
                                        <svg class="icon icon-xs me-1 icon-primary"><use href="{{ $icon('') }}" xlink:href="{{ $icon('') }}"></use><span class=""></span></svg>
                                    </div>
                                </div>
                            </button>
                        </div>
                        <div id="collapse{{ $item['id'] }}" class="accordion-collapse collapse p-0" data-bs-parent="#accordionExample{{ $item['id'] }}" role="region" aria-labelledby="heading{{ $item['id'] }}">
                            <div class="accordion-body"><p class="mb-3">{{ $item['answer'] ?? '' }}</p></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @if (filled($section['more']['label'] ?? null))
        <div class="{{ $section['more']['col_class'] ?? 'col-12' }}">
            <button type="button" class="btn btn-outline-primary w-100 mt-40 mb-40 title-medium-bold"><span class="">{{ $section['more']['label'] }}</span></button>
        </div>
    @endif
</div>
