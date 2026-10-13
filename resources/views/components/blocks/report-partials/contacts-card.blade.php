{{-- Riquadro contatti `cmp-contacts` (JSON: contacts.main e contacts.problems con title e items[icon, label, url, element]). --}}
<div class="cmp-contacts">
    <div class="card w-100">
        <div class="card-body">
            @foreach (array_filter([$d('contacts.main', []), $d('contacts.problems', [])], static fn ($group) => filled($group['title'] ?? null)) as $group)
                <h2 @class(['title-medium-2-semi-bold', 'mt-4' => ! $loop->first])>{{ $group['title'] ?? '' }}</h2>
                <ul class="contact-list p-0">
                    @foreach ($group['items'] ?? [] as $contact)
                        <li>
                            <a class="list-item" href="{{ $contact['url'] ?? '#' }}"@if (filled($contact['element'] ?? null)) data-element="{{ $contact['element'] }}"@endif>
                                <svg class="icon icon-primary icon-sm" aria-hidden="true"><use href="{{ $icon($contact['icon'] ?? 'it-help-circle') }}"></use></svg>
                                <span>{{ $contact['label'] ?? '' }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endforeach
        </div>
    </div>
</div>
