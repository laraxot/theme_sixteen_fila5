@props(['data' => []])

@php
    $sections = $data['sections'] ?? [];
    $contacts = $data['contacts'] ?? [];
    $topics = $data['topics'] ?? [];
    $breadcrumb = $data['breadcrumb'] ?? [];
@endphp

<div class="dc-service-page mx-auto w-full max-w-[1166px] px-4 py-8">
    <nav class="dc-service-breadcrumb mb-8" aria-label="{{ __('pub_theme::components_common.a11y.breadcrumb_trail.label') }}">
        <ol class="flex flex-wrap items-center gap-2 text-base">
            @foreach($breadcrumb as $item)
                @if($loop->last)
                    <li aria-current="page">{{ $item['label'] ?? '' }}</li>
                @else
                    <li><a href="{{ $item['url'] ?? '#' }}">{{ $item['label'] ?? '' }}</a><span class="mx-2" aria-hidden="true">/</span></li>
                @endif
            @endforeach
        </ol>
    </nav>

    <header class="grid gap-8 border-b border-[#d9d9d9] pb-8 lg:grid-cols-[minmax(0,8fr)_minmax(220px,3fr)]">
        <div>
            <h1 class="text-[3.5rem] font-bold leading-[1.1] tracking-[-0.02em] text-[#191919]">{{ $data['title'] ?? '' }}</h1>
            @if(! empty($data['status']))
                <span class="mt-4 inline-flex rounded-full border border-[#007a52] px-3 py-1 text-sm font-semibold text-[#007a52]">{{ $data['status'] }}</span>
            @endif
            <p class="mt-5 max-w-3xl text-lg leading-7 text-[#191919]">{{ $data['summary'] ?? '' }}</p>
            <div class="mt-6 flex flex-wrap gap-4">
                @foreach($data['actions'] ?? [] as $action)
                    <a href="{{ $action['url'] ?? '#' }}" class="inline-flex min-h-12 items-center justify-center rounded-none px-6 py-3 text-base font-semibold focus:outline-none focus:ring-2 focus:ring-[#007a52] focus:ring-offset-2 {{ ($action['style'] ?? 'primary') === 'primary' ? 'bg-[#007a52] text-white hover:bg-[#005c3d]' : 'border-2 border-[#007a52] bg-white text-[#007a52] hover:bg-[#e8f3ef]' }}">
                        {{ $action['label'] ?? '' }}
                    </a>
                @endforeach
            </div>
        </div>
        <div class="flex flex-col gap-4 lg:items-start lg:pt-4">
            <button type="button" x-data @click="navigator.clipboard?.writeText(window.location.href)" class="inline-flex min-h-11 items-center gap-2 text-left text-base text-[#007a52] underline focus:outline-none focus:ring-2 focus:ring-[#007a52]">
                <span aria-hidden="true">↗</span>{{ $data['share_label'] ?? __('pub_theme::components_content.service.share.label') }}
            </button>
            <button type="button" onclick="window.print()" class="inline-flex min-h-11 items-center gap-2 text-left text-base text-[#007a52] underline focus:outline-none focus:ring-2 focus:ring-[#007a52]">
                <span aria-hidden="true">⋯</span>{{ $data['actions_label'] ?? __('pub_theme::components_content.service.see_actions.label') }}
            </button>
        </div>
    </header>

    <div class="mt-10 grid gap-10 lg:grid-cols-[minmax(220px,3fr)_minmax(0,8fr)]">
        <aside class="border-r-0 lg:border-r lg:border-[#d9d9d9] lg:pr-8">
            <h2 class="text-base font-semibold uppercase text-[#191919]">{{ $data['index_label'] ?? __('pub_theme::components_content.service.page_index_caps.label') }}</h2>
            <nav class="mt-3" aria-label="{{ __('pub_theme::components_common.a11y.page_index.label') }}">
                <ul class="border-l-2 border-[#007a52] pl-4">
                    @foreach($sections as $section)
                        <li><a class="block py-1 text-base text-[#007a52] hover:underline focus:outline-none focus:ring-2 focus:ring-[#007a52]" href="#{{ $section['id'] ?? '' }}">{{ $section['title'] ?? '' }}</a></li>
                    @endforeach
                    @if(! empty($contacts))
                        <li><a class="block py-1 text-base text-[#007a52] hover:underline focus:outline-none focus:ring-2 focus:ring-[#007a52]" href="#contacts">{{ $contacts['title'] ?? __('pub_theme::components_common.nav.contacts.label') }}</a></li>
                    @endif
                </ul>
            </nav>
        </aside>

        <div class="min-w-0">
            @foreach($sections as $section)
                <section id="{{ $section['id'] ?? '' }}" class="mb-12 scroll-mt-8 {{ ! empty($section['highlight']) ? 'bg-[#f5f5f5] p-6' : '' }}">
                    <h2 class="mb-4 text-[2.5rem] font-bold leading-tight text-[#5d7083]">{{ $section['title'] ?? '' }}</h2>
                    @if(! empty($section['paragraphs']))
                        @foreach($section['paragraphs'] as $paragraph)
                            <p class="mb-4 text-base leading-6 text-[#191919]">{!! $paragraph !!}</p>
                        @endforeach
                    @endif
                    @if(! empty($section['items']))
                        <ul class="list-disc space-y-2 pl-6 text-base leading-6 text-[#191919]">
                            @foreach($section['items'] as $item)<li>{{ $item }}</li>@endforeach
                        </ul>
                    @endif
                    @if(! empty($section['links']))
                        <ul class="mt-4 space-y-2">
                            @foreach($section['links'] as $link)
                                <li><a href="{{ $link['url'] ?? '#' }}" class="text-[#007a52] underline focus:outline-none focus:ring-2 focus:ring-[#007a52]">{{ $link['label'] ?? '' }}</a></li>
                            @endforeach
                        </ul>
                    @endif
                    @if(! empty($section['actions']))
                        <div class="mt-5 flex flex-wrap gap-4">
                            @foreach($section['actions'] as $action)
                                <a href="{{ $action['url'] ?? '#' }}" class="inline-flex min-h-12 items-center justify-center rounded-none px-6 py-3 font-semibold focus:outline-none focus:ring-2 focus:ring-[#007a52] {{ ($action['style'] ?? 'primary') === 'primary' ? 'bg-[#007a52] text-white hover:bg-[#005c3d]' : 'border-2 border-[#007a52] bg-white text-[#007a52] hover:bg-[#e8f3ef]' }}">{{ $action['label'] ?? '' }}</a>
                            @endforeach
                        </div>
                    @endif
                </section>
            @endforeach

            @if(! empty($contacts))
                <section id="contacts" class="scroll-mt-8">
                    <h2 class="mb-5 text-[2.5rem] font-bold leading-tight text-[#191919]">{{ $contacts['title'] ?? __('pub_theme::components_common.nav.contacts.label') }}</h2>
                    <div class="rounded border border-[#d9d9d9] bg-white p-6 shadow-sm">
                        <h3 class="text-xl font-semibold text-[#007a52]">{{ $contacts['office'] ?? '' }}</h3>
                        <p class="mt-3 whitespace-pre-line text-base leading-6 text-[#191919]">{{ $contacts['address'] ?? '' }}</p>
                        @if(! empty($contacts['phone']))<p class="mt-2"><a class="text-[#007a52] underline" href="tel:{{ $contacts['phone'] }}">{{ $contacts['phone'] }}</a></p>@endif
                        @if(! empty($contacts['email']))<p class="mt-2"><a class="text-[#007a52] underline" href="mailto:{{ $contacts['email'] }}">{{ $contacts['email'] }}</a></p>@endif
                    </div>
                    @if(! empty($topics))
                        <div class="mt-8">
                            <span class="text-sm text-[#5d7083]">{{ $data['topics_label'] ?? __('pub_theme::components_content.service.topics_colon.label') }}</span>
                            <div class="mt-3 flex flex-wrap gap-2">
                                @foreach($topics as $topic)<a href="{{ $topic['url'] ?? '#' }}" class="rounded-full border border-[#007a52] px-3 py-1 text-sm text-[#007a52] hover:bg-[#e8f3ef]">{{ $topic['label'] ?? '' }}</a>@endforeach
                            </div>
                        </div>
                    @endif
                    @if(! empty($data['updated_at']))<p class="mt-6 text-sm text-[#5d7083]">{{ $data['updated_at'] }}</p>@endif
                </section>
            @endif
        </div>
    </div>

    <section id="rating" class="mt-16 bg-[#007a52] px-6 py-12 text-white" aria-labelledby="service-rating-title" x-data="{rated: 0}">
        <div class="mx-auto max-w-2xl text-center">
            <h2 id="service-rating-title" class="text-2xl font-semibold text-white">{{ $data['rating_title'] ?? __('pub_theme::components_reports.rating.service_ease.title') }}</h2>
            <p x-cloak x-show="rated > 0" class="mt-4 font-semibold text-white">{{ $data['rating_success'] ?? __('pub_theme::news.index.feedback.thanks') }}</p>
            <div x-show="rated === 0" class="mt-5 flex justify-center gap-2" role="radiogroup" aria-label="{{ __('pub_theme::components_reports.feedback.rate_1_5.label') }}">
                <template x-for="star in [1,2,3,4,5]" :key="star">
                    <button type="button" class="min-h-11 min-w-11 text-3xl focus:outline-none focus:ring-2 focus:ring-white" role="radio" :aria-checked="rated === star" x-on:click="rated = star" :aria-label="star + @js(' '.__('pub_theme::components_reports.rating.stars_suffix.label'))">★</button>
                </template>
            </div>
        </div>
    </section>

    @if(! empty($data['related_content']))
        <section id="related-content" class="mx-auto mt-14 max-w-5xl" aria-labelledby="related-content-title">
            <h2 id="related-content-title" class="text-3xl font-bold text-[#191919]">{{ $data['related_title'] ?? __('pub_theme::components_content.service.related.title') }}</h2>
            <div class="mt-6 grid gap-4 md:grid-cols-3">
                @foreach($data['related_content'] as $related)
                    <a href="{{ $related['url'] ?? '#' }}" class="rounded border border-[#d9d9d9] bg-white p-5 text-[#007a52] shadow-sm hover:shadow-md focus:outline-none focus:ring-4 focus:ring-[#80c8ad]">
                        <h3 class="font-bold underline underline-offset-2">{{ $related['title'] ?? '' }}</h3>
                        @if(! empty($related['description']))<p class="mt-2 text-sm leading-6 text-[#191919]">{{ $related['description'] }}</p>@endif
                    </a>
                @endforeach
            </div>
        </section>
    @endif
</div>
