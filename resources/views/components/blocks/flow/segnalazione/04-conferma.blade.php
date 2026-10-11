@props(['data' => []])

@php
    $blockData = is_array($data) ? $data : [];
    $title = (string) ($blockData['title'] ?? '');
    $summaryHtml = (string) ($blockData['summary_html'] ?? '');
    $visibilityHtml = (string) ($blockData['visibility_html'] ?? '');
    $emailIntroHtml = (string) ($blockData['email_intro_html'] ?? '');
    $email = (string) ($blockData['email'] ?? '');
    $receipt = $blockData['receipt'] ?? [];
    $reservedArea = $blockData['reserved_area'] ?? [];
    $relatedServices = $blockData['related_services'] ?? [];
    $contacts = $blockData['contacts'] ?? [];
    $showRating = (bool) ($blockData['show_rating'] ?? true);
    $ratingData = $blockData['rating'] ?? [];
@endphp

<div class="mx-auto max-w-4xl px-4 py-8" id="main-container">
    <div class="mb-6 flex items-center gap-3">
        <svg class="h-8 w-8 text-[#007a52]" aria-hidden="true">
            <path fill="currentColor" d="M9 16.2h6v-.2H9v.2Zm3-14C8.1 2 5 5.1 5 9.2c0 3.3 5.1 8 8 12.1 2.9-4.1 8-8.8 8-12.1 0-4.1-3.1-7.2-7-7.2Z"></path>
        </svg>
        <h1 class="text-3xl font-bold text-[#17324d]">{{ $title }}</h1>
    </div>

    @if ($summaryHtml !== '')
        <p class="mb-4 text-lg text-[#334e68]">{{ $summaryHtml }}</p>
    @endif
    @if ($visibilityHtml !== '')
        <p class="mb-4 text-lg text-[#334e68]">{{ $visibilityHtml }}</p>
    @endif
    @if ($emailIntroHtml !== '' || $email !== '')
        <p class="mb-6 text-lg text-[#334e68] pt-4">{{ $emailIntroHtml }}@if($email !== '')<br><strong>{{ $email }}</strong>@endif</p>
    @endif

    @if ($receipt !== [])
        <a href="{{ $receipt['url'] ?? '#' }}"
           class="mb-6 inline-flex items-center gap-3 rounded-md border-2 border-[#007a52] bg-white px-5 py-3 font-bold text-[#007a52] transition-colors hover:bg-[#e6f3ee] focus:outline-none focus:ring-4 focus:ring-[#80c8ad] focus:ring-offset-2">
            <span class="rounded-full bg-[#007a52] p-2 text-white">
                <svg class="h-5 w-5" aria-hidden="true">
                    <path fill="currentColor" d="M5 3h14v2H5Zm0 16h14V7H5v12Zm2-6h2v-4H7v4Zm4 0h2v-4h-2v4Z"></path>
                </svg>
            </span>
            <span>{{ $receipt['label'] ?? '' }}</span>
        </a>
    @endif
</div>

@if (($relatedServices['items'] ?? []) !== [])
    <hr class="mx-auto mb-0 mt-10 max-w-4xl border-[#d9e2e8]">
    <div class="mx-auto max-w-4xl px-4 py-8">
        <h2 class="mb-4 text-2xl font-bold text-[#17324d]" id="related-service">{{ $relatedServices['title'] ?? '' }}</h2>
        <ul class="space-y-3">
            @foreach (($relatedServices['items'] ?? []) as $item)
                <li class="shadow-sm">
                    <a class="flex items-center gap-3 rounded-md bg-white p-4 text-[#007a52] hover:bg-[#e6f3ee] focus:outline-none focus:ring-4 focus:ring-[#80c8ad]"
                       href="{{ $item['url'] ?? '#' }}">
                        <svg class="h-6 w-6 flex-shrink-0 text-[#007a52]" aria-hidden="true">
                            <use href="{{ $item['icon'] ?? '' }}"></use>
                        </svg>
                        <span class="font-bold">{{ $item['label'] ?? '' }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endif

@if ($showRating)
    @include('pub_theme::components.blocks.feedback.rating', ['data' => $ratingData])
@endif

@if (($contacts['links'] ?? []) !== [])
    <div class="bg-[#f5f7f9] py-12">
        <div class="mx-auto max-w-4xl px-4">
            <div class="rounded-lg bg-white p-6 shadow-sm">
                <h2 class="mb-4 text-2xl font-bold text-[#17324d]">{{ $contacts['title'] ?? '' }}</h2>
                <ul class="space-y-3">
                    @foreach (($contacts['links'] ?? []) as $link)
                        <li>
                            <a class="flex items-center gap-3 rounded-md p-3 text-[#17324d] hover:bg-[#f5f7f9] focus:outline-none focus:ring-4 focus:ring-[#80c8ad]"
                               href="{{ $link['url'] ?? '#' }}"
                               @if(!empty($link['data_element'])) data-element="{{ $link['data_element'] }}" @endif>
                                <svg class="h-6 w-6 text-[#007a52]" aria-hidden="true">
                                    <use href="{{ $link['icon'] ?? '' }}"></use>
                                </svg>
                                <span>{{ $link['label'] ?? '' }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endif
