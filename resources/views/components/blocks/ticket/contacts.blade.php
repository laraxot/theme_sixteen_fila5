@props([
    'contacts' => [],
    'contactsId' => 'info-contacts',
    'sprite' => '',
])

@if (!empty($contacts))
    <section id="{{ $contactsId }}" class="border-t border-slate-200 bg-white px-4 py-10 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-3xl">
                                    <h2 class="text-2xl font-bold text-slate-950">{{ $contacts['title'] }}</h2>
                                    <ul class="mt-4 divide-y divide-slate-200 rounded-xl border border-slate-200">
                                        @foreach ($contacts['items'] as $contact)
                                            @php
                                                $icon = $contact['icon'] ?? 'it-help-circle';
                                                $dataElement = $contact['data_element'] ?? null;
                                            @endphp
                                            <li>
                                                <a class="flex min-h-12 items-center px-4 py-3" href="{{ $contact['url'] }}"@if ($dataElement) data-element="{{ $dataElement }}"@endif>
                                                    <span class="font-semibold text-sky-900 underline-offset-4 hover:underline">{{ $contact['label'] }}</span>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
        </div>
    </section>
@endif
