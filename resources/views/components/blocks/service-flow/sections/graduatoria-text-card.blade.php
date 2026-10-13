{{--
    Testo in scheda semplice (`cmp-card` senza sfondo). `section`: items[] con `type`: paragraph {text, class}, bullets {class, items[] {label (grassetto), text}}.
    I paragrafi accettano **grassetto** e \n (a capo): vedi parts/rich.
--}}
<div class="cmp-card">
    <div class="card">
        <div class="card-body p-0">
            @foreach ($section['items'] ?? [] as $item)
                @if (($item['type'] ?? '') === 'bullets')
                    <div class="{{ $item['class'] ?? 'mb-3 mt-3' }}">
                        <div class="cmp-ul-list">
                            <ul class="list-wrapper">
                                @foreach ($item['items'] ?? [] as $entry)
                                    <li><span><strong>{{ $entry['label'] ?? '' }}</strong> {{ $entry['text'] ?? '' }} </span></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @else
                    <p class="{{ $item['class'] ?? 'text-paragraph mb-3' }}">@include('pub_theme::components.blocks.service-flow.parts.rich', ['text' => $item['text'] ?? ''])</p>
                @endif
            @endforeach
        </div>
    </div>
</div>
