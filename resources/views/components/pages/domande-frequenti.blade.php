@props(['data' => []])

@php
    $heading = trim((string) ($data['heading'] ?? '')) ?: __('fixcity::domande-frequenti.title.text');
    $intro = trim((string) ($data['intro'] ?? '')) ?: __('fixcity::domande-frequenti.intro.text');
    $faqItems = $data['items'] ?? [];
@endphp

<section class="faq-section" aria-labelledby="faq-heading">
    <nav class="cmp-breadcrumbs" aria-label="{{ __('fixcity::global.breadcrumb') }}">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ \Themes\Sixteen\Infrastructure\Url\FrontofficeUrl::fromStoredUrl('/') }}">{{ __('pub_theme::navigation.home') }}</a>
                <span class="separator">/</span>
            </li>
            <li class="breadcrumb-item active" aria-current="page">{{ $heading }}</li>
        </ol>
    </nav>

    <header class="mb-8">
        <h1 id="faq-heading" class="text-3xl font-bold tracking-tight text-slate-950">
            {{ $heading }}
        </h1>
        @if ($intro)
            <p class="lede text-slate-700 text-base leading-relaxed mt-3">{{ $intro }}</p>
        @endif
    </header>

    <dl class="faq-accordion" aria-label="{{ $heading }}">
        @foreach ($faqItems as $index => $item)
            @php
                $question = trim((string) ($item['question'] ?? ''));
                $answer = trim((string) ($item['answer'] ?? ''));
                $id = 'faq-' . $index;
            @endphp
            @if ($question && $answer)
                <div class="faq-item border border-slate-200 bg-white rounded-lg overflow-hidden" x-data="{ open: false }">
                    <dt>
                        <button
                            type="button"
                            class="w-full flex items-center justify-between p-4 text-left bg-white hover:bg-slate-50 focus:outline-none focus-visible:ring-2 focus-visible:ring-primary-600 focus-visible:ring-offset-2 transition-colors duration-150"
                            aria-expanded="false"
                            aria-controls="{{ $id }}-answer"
                            @click="open = !open"
                            x-bind:aria-expanded="open"
                        >
                            <span class="font-semibold text-slate-900 pr-4">{{ $question }}</span>
                            <svg
                                class="w-5 h-5 text-slate-500 flex-shrink-0 transition-transform duration-150"
                                x-bind:class="{ 'rotate-180': open }"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                                aria-hidden="true"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    </dt>
                    <dd
                        id="{{ $id }}-answer"
                        class="p-4 bg-slate-50 border-t border-slate-100"
                        x-show="open"
                        x-transition:enter="transition ease-out duration-150"
                        x-transition:enter-start="opacity-0 transform -translate-y-1"
                        x-transition:enter-end="opacity-100 transform translate-y-0"
                        x-transition:leave="transition ease-in duration-100"
                        x-transition:leave-start="opacity-100 transform translate-y-0"
                        x-transition:leave-end="opacity-0 transform -translate-y-1"
                        x-cloak
                    >
                        <div class="prose prose-slate max-w-none text-slate-700 leading-relaxed">
                            {!! $answer !!}
                        </div>
                    </dd>
                </div>
            @endif
        @endforeach
    </dl>

    @if (empty($faqItems))
        <div class="text-center py-12 bg-slate-50 rounded-lg">
            <p class="text-slate-600">{{ __('fixcity::domande-frequenti.empty.text') }}</p>
        </div>
    @endif
</section>
