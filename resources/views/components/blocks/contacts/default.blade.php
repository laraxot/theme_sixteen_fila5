@props(['data' => []])

<section class="dc-contacts" aria-labelledby="dc-contacts-title">
    <div class="dc-contacts__card">
        <h2 id="dc-contacts-title">{{ $data['title'] ?? ($data['heading'] ?? 'Contatta il comune') }}</h2>
        <ul>
            @foreach(($data['items'] ?? []) as $item)
                @php($icon = $item['icon'] ?? 'help')
                <li>
                    <a href="{{ $item['url'] ?? '#' }}" @if(!empty($item['data_element'])) data-element="{{ $item['data_element'] }}" @endif>
                        <svg aria-hidden="true" viewBox="0 0 24 24" focusable="false">
                            @if($icon === 'mail')
                                <path d="M3 5h18v14H3zM3 6l9 7 9-7" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="1.8"/>
                            @elseif($icon === 'phone' || $icon === 'hearing')
                                <path d="M7 3h3l1.5 4-2 1.5a14 14 0 0 0 6 6l1.5-2 4 1.5v3a2 2 0 0 1-2 2C11 19 5 13 5 5a2 2 0 0 1 2-2Z" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="1.8"/>
                            @elseif($icon === 'calendar')
                                <path d="M5 4h14v16H5zM8 2v4m8-4v4M5 9h14" fill="none" stroke="currentColor" stroke-linecap="round" stroke-width="1.8"/>
                            @else
                                <circle cx="12" cy="12" r="9" fill="none" stroke="currentColor" stroke-width="1.8"/><path d="M12 11v5m0-8v.1" stroke="currentColor" stroke-linecap="round" stroke-width="1.8"/>
                            @endif
                        </svg>
                        <span>{{ $item['label'] ?? '' }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</section>
