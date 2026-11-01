{{--
    Fascia contatti (sfondo grigio). `contacts`: layout (`offset` = col-lg-6 centrata con offset-lg-3, `center` = riga centrata), col (default
    `col-12 col-lg-6`), main {title, items[] {icon, label, url, element}}, problems (secondo gruppo, opzionale). Se c'e' `$related`
    il carosello dei contenuti correlati sta nella stessa riga, sopra i contatti (come nella scheda servizio).
--}}
@php
    $d = static fn (string $key, mixed $default = '') => data_get($data, $key, $default);
    $assets = \Themes\Sixteen\Infrastructure\Assets\DesignComuniAssets::base();
    $icon = static fn (string $name): string => $assets.'/bootstrap-italia/dist/svg/sprites.svg#'.$name;
    $offset = $d('contacts.layout', 'offset') === 'offset';
    $col = $d('contacts.col', 'col-12 col-lg-6');
@endphp
<div class="bg-grey-card shadow-contacts">
    <div class="container">
        <div @class(['row', 'd-flex justify-content-center p-contacts' => ! $offset])>
            @if (filled($related ?? null))
                <div class="col-12 pt-5">@include('pub_theme::components.blocks.service-flow.parts.related', ['related' => $related])</div>
            @endif
            <div class="{{ $offset ? $col.' offset-lg-3 p-contacts' : $col }}">
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
