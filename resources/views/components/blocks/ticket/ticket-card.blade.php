@props([
    'item' => null,
    'loop' => null,
    'ns' => 'fixcity::ticket',
    'sprite' => '',
])

@php
    $itemLocation = is_array($item->location ?? null) ? $item->location : [];
    $itemAddress = $itemLocation['address'] ?? $itemLocation['display_name'] ?? '';
    $itemTypeLabel = (string) ($item->type_label ?? '');
    $collapseId = 'collapse' . ($loop->iteration ?? 1);
    $demoImages = (int) ($item->demo_images ?? 0);
    $imageSrc = '/themes/Sixteen/design-comuni/assets/images/image-disservizio.png';
    $rawType = $item->type ?? null;
    $ticketTypeValue = $rawType instanceof \BackedEnum
        ? $rawType->value
        : (is_string($rawType) ? $rawType : '');
    $ticketStatusValue = method_exists($item, 'resolveTicketStatusValue')
        ? $item->resolveTicketStatusValue()
        : (is_string($item->status ?? null) ? $item->status : '');
@endphp

<div
    class="mb-4 rounded-xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6"
    data-public-ticket-card
    data-filter-type="{{ $ticketTypeValue }}"
    data-filter-status="{{ $ticketStatusValue }}"
    x-data="{ open: false }">
        <h3 class="text-xl font-bold text-slate-950">{{ $item->name ?? '' }}</h3>
                        @if($itemTypeLabel)
                            <p class="mt-2 text-sm text-slate-700">
                                {{ __($ns . '.card.type.label') }}: <span>{{ $itemTypeLabel }}</span>
                            </p>
                        @endif

                        <div class="mt-4">
                                <button
                                    class="min-h-11 rounded-lg border-2 border-sky-800 px-4 py-2 font-semibold text-sky-900 hover:bg-sky-50 focus:outline-none focus:ring-4 focus:ring-sky-800/20"
                                    type="button"
                                    x-on:click="open = !open"
                                    x-bind:aria-expanded="open.toString()"
                                    aria-controls="{{ $collapseId }}"
                                >
                                    {{ __($ns . '.card.expand.button.label') }}
                                </button>
                            <div id="{{ $collapseId }}" x-cloak x-show="open" class="mt-4 space-y-3 border-t border-slate-200 pt-4" role="region">
                                                @if ($itemAddress)
                                                    <div>
                                                        <div class="text-sm font-semibold text-slate-600">{{ __($ns . '.card.address.label') }}</div>
                                                        <p class="mt-1 text-slate-800">{{ $itemAddress }}</p>
                                                    </div>
                                                @endif
                                                @if (! empty($item->content ?? null))
                                                    <div>
                                                        <div class="text-sm font-semibold text-slate-600">{{ __($ns . '.card.detail.label') }}</div>
                                                        <p class="mt-1 text-slate-800">{{ $item->content }}</p>
                                                    </div>
                                                @endif
                                                @if ($demoImages > 0)
                                                    <div>
                                                        <div class="text-sm font-semibold text-slate-600">{{ __($ns . '.card.photos.label') }}</div>
                                                        <div class="mt-3 grid gap-3 sm:grid-cols-2">
                                                                @for ($i = 0; $i < $demoImages; $i++)
                                                                    <div>
                                                                        <img
                                                                            src="{{ $imageSrc }}"
                                                                            alt="{{ __($ns . '.modal.detail.image.alt.label') }}"
                                                                            class="w-full rounded-lg"
                                                                            loading="lazy"
                                                                        >
                                                                    </div>
                                                                @endfor
                                                            </div>
                                                        </div>
                                                @endif
                            </div>
                        </div>
    </div>
