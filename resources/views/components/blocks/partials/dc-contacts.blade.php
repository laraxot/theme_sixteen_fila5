@props(['data' => []])
@php
    $d = static fn (string $key, mixed $default = '') => data_get($data, $key, $default);
    $assets = asset('themes/Sixteen/design-comuni/assets');
    $icon = static fn (string $name): string => $assets.'/bootstrap-italia/dist/svg/sprites.svg#'.$name;
@endphp
<div class="bg-grey-card shadow-contacts">
    <div class="container">
        @php($offset = $d('contacts.layout') === 'offset')
        <div @class(['row', 'd-flex justify-content-center p-contacts' => ! $offset])>
            <div @class(['col-12 col-lg-6', 'offset-lg-3 p-contacts' => $offset])>
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
            </div>
        </div>
    </div>
</div>
