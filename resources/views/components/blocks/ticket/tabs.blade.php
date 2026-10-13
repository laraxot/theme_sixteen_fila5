@props([
    'tabs' => [],
    'sectionId' => 'map-and-list',
])

{{-- HTML parity: https://italia.github.io/design-comuni-pagine-statiche/sito/ticket-list.html — Bootstrap Italia native tabs --}}
@if (!empty($tabs))
<ul class="mt-6 flex w-full border-b border-slate-300"
    id="tabDisservizio"
    role="tablist"
    data-section="{{ $sectionId }}">
    @foreach ($tabs as $index => $tab)
        @php
            $tabId = $tab['id'] ?? 'map';
            $panelId = 'data-ex-disservizio'.($index + 1);
            $controlId = 'disservizio'.($index + 1);
            $isFirst = $index === 0;
        @endphp
        <li class="flex-1" role="presentation">
            <button type="button" id="tab-{{ $tabId }}" class="min-h-12 w-full border-b-4 px-4 py-3 text-center font-semibold{{ $isFirst ? ' border-sky-800 text-sky-900' : ' border-transparent text-slate-700 hover:border-slate-400' }}"
               data-tab-id="{{ $tabId }}"
               x-on:click="activeTab = '{{ $tabId }}'"
               x-bind:class="activeTab === '{{ $tabId }}' ? 'border-sky-800 text-sky-900' : 'border-transparent text-slate-700 hover:border-slate-400'"
               role="tab"
               aria-controls="{{ $panelId }}"
               aria-selected="{{ $isFirst ? 'true' : 'false' }}">
                {{ $tab['label'] ?? '' }}
            </button>
        </li>
    @endforeach
</ul>
@endif
