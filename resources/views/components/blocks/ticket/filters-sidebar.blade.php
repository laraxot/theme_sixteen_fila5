@props([
    'filters' => [],
    'statusFilters' => [],
    'selectedTypes' => [],
    'selectedStatuses' => [],
    'context' => 'desktop',
])

@if (!empty($filters['items']))
    <fieldset class="mb-0">
        <legend class="mb-4 text-sm font-bold uppercase tracking-wide text-slate-600">{{ $filters['title'] }}</legend>
        <div class="pb-3">
            <ul class="space-y-3">
                @foreach ($filters['items'] as $item)
                    @php
                        $value = (string) ($item['value'] ?? '');
                        $inputId = (string) ($item['id'] ?? 'filter');
                        if ($context === 'mobile') {
                            $inputId .= '-mobile';
                        }
                        $isChecked = in_array($value, $selectedTypes, true);
                        $displayLabel = (string) ($item['display_label'] ?? $item['label'] ?? '');
                        $iconUrl = (string) ($item['iconUrl'] ?? $item['icon_url'] ?? '');
                    @endphp
                    <li>
                        <div>
                            <div class="flex items-start gap-3 py-1">
                                <input
                                    id="{{ $inputId }}"
                                    type="checkbox"
                                    name="category"
                                    value="{{ $value }}"
                                    data-filter-type="{{ $value }}"
                                    data-count="{{ (int) ($item['count'] ?? 0) }}"
                                    x-on:change="$dispatch('filter-type-changed', { type: '{{ $value }}', checked: $el.checked })"
                                    @checked($isChecked)
                                >
                                <label
                                    for="{{ $inputId }}"
                                    class="inline-flex cursor-pointer items-center gap-2 text-base leading-6 text-slate-900 hover:text-emerald-700"
                                >
                                    @if ($iconUrl !== '')
                                        <img
                                            src="{{ $iconUrl }}"
                                            alt=""
                                            class="h-5 w-5 shrink-0"
                                            width="20"
                                            height="20"
                                            loading="lazy"
                                        >
                                    @endif
                                    <span class="filter-type-label__text">
                                    @if (preg_match('/\(\d+\)\s*$/', $displayLabel) === 1)
                                        {{ $displayLabel }}
                                    @else
                                        {{ $displayLabel }}
                                        <span class="ml-1 text-slate-500">({{ (int) ($item['count'] ?? 0) }})</span>
                                    @endif
                                    </span>
                                </label>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </fieldset>
@endif

@if (!empty($statusFilters['items']))
    <fieldset class="mb-0 pt-3 mt-2 border-top border-light filter-status-fieldset">
        <legend class="mb-4 text-sm font-bold uppercase tracking-wide text-slate-600">{{ $statusFilters['title'] }}</legend>
        <div class="pb-4">
            <ul class="space-y-3">
                @foreach ($statusFilters['items'] as $item)
                    @php
                        $value = (string) ($item['value'] ?? '');
                        $inputId = (string) ($item['id'] ?? 'filter-status');
                        if ($context === 'mobile') {
                            $inputId .= '-mobile';
                        }
                        $isChecked = in_array($value, $selectedStatuses, true);
                        $displayLabel = (string) ($item['display_label'] ?? $item['label'] ?? '');
                        $statusColor = (string) ($item['color'] ?? '#607d8b');
                    @endphp
                    <li>
                        <div>
                            <div class="flex items-start gap-3 py-1">
                                <input
                                    id="{{ $inputId }}"
                                    type="checkbox"
                                    name="status"
                                    value="{{ $value }}"
                                    data-filter-status="{{ $value }}"
                                    data-count="{{ (int) ($item['count'] ?? 0) }}"
                                    x-on:change="$dispatch('filter-status-changed', { status: '{{ $value }}', checked: $el.checked })"
                                    @checked($isChecked)
                                >
                                <label
                                    for="{{ $inputId }}"
                                    class="inline-flex cursor-pointer items-center gap-2 text-base leading-6 text-slate-900 hover:text-emerald-700"
                                >
                                    <span
                                        class="h-3 w-3 shrink-0 rounded-full"
                                        style="background-color: {{ $statusColor }}"
                                        aria-hidden="true"
                                    ></span>
                                    <span class="filter-type-label__text">
                                    @if (preg_match('/\(\d+\)\s*$/', $displayLabel) === 1)
                                        {{ $displayLabel }}
                                    @else
                                        {{ $displayLabel }}
                                        <span class="ml-1 text-slate-500">({{ (int) ($item['count'] ?? 0) }})</span>
                                    @endif
                                    </span>
                                </label>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </fieldset>
@endif
