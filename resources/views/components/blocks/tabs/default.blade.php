@props(['data' => []])

@php
    $tabs = $data['tabs'] ?? [];
    $heading = $data['heading'] ?? '';
    $activeTab = collect($tabs)->firstWhere('active', true);
    $activeTabId = $activeTab ? ($activeTab['id'] ?? 'tab-1') : ($tabs[0]['id'] ?? 'tab-1');
@endphp

@if($tabs)
<div x-data="{
        activeTab: '{{ $activeTabId }}',
        setActive(tabId) { this.activeTab = tabId; },
        init() {
            const hash = window.location.hash.substring(1);
            if (hash && @json(collect($tabs)->pluck('id')->all()).includes(hash)) {
                this.activeTab = hash;
            }
        }
    }" class="w-full">

    @if($heading)
        <h3 class="mb-6 text-center text-lg font-semibold text-slate-900 dark:text-white">
            {{ $heading }}
        </h3>
    @endif

    <div class="border-b border-slate-200 dark:border-slate-700">
        <nav class="-mb-px flex flex-wrap gap-2" role="tablist">
            @foreach($tabs as $tab)
                @php
                    $tabId = $tab['id'] ?? 'tab-' . $loop->iteration;
                @endphp
                <button type="button"
                        @click="setActive('{{ $tabId }}')"
                        :class="activeTab === '{{ $tabId }}' ? 'border-sky-600 text-sky-700 dark:text-sky-400' : 'border-transparent text-slate-600 dark:text-slate-400 hover:text-slate-800 dark:hover:text-slate-200'"
                        class="border-b-3 border-transparent px-4 py-2 text-sm font-medium focus:outline-none focus:ring-2 focus:ring-sky-500 transition-colors whitespace-nowrap">
                    {{ $tab['label'] }}
                </button>
            @endforeach
        </nav>
    </div>

    <div class="mt-6">
        @foreach($tabs as $tab)
            @php
                $tabId = $tab['id'] ?? 'tab-' . $loop->iteration;
            @endphp
            <div x-show="activeTab === '{{ $tabId }}'" x-cloak>
                @if(isset($tab['pages']))
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($tab['pages'] as $page)
                            <a href="{{ $page['url'] ?? '#' }}"
                               class="group block rounded-lg border border-slate-200 dark:border-slate-700 p-4 hover:border-sky-500 transition-colors">
                                <h4 class="text-lg font-medium text-slate-900 dark:text-white group-hover:text-sky-700 dark:group-hover:text-sky-400">
                                    {{ $page['name'] }}
                                </h4>
                                @if(isset($page['description']) && $page['description'])
                                    <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">
                                        {{ $page['description'] }}
                                    </p>
                                @endif
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</div>
@endif
