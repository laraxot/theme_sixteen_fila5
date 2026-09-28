<div id="faq-content" class="container-italia mx-auto max-w-5xl px-4 py-10" aria-labelledby="faq-title">
    <nav class="mb-8 text-sm" aria-label="{{ __('pub_theme::faq.navigation.label') }}">
        <a class="font-semibold text-primary-700 underline underline-offset-4 focus:outline-none focus:ring-2 focus:ring-primary-700" href="{{ \Mcamara\LaravelLocalization\Facades\LaravelLocalization::localizeURL('/') }}">
            {{ __('pub_theme::faq.navigation.home') }}
        </a>
    </nav>

    <header class="mb-8 max-w-3xl">
        <h1 id="faq-title" class="mb-4 text-4xl font-bold text-gray-900">{{ __('pub_theme::faq.meta.title') }}</h1>
        <p class="text-lg leading-relaxed text-gray-700">{{ __('pub_theme::faq.intro') }}</p>
    </header>

    <section class="space-y-4" aria-label="{{ __('pub_theme::faq.meta.title') }}">
        @foreach (__('pub_theme::faq.items') as $item)
            <details class="group rounded-lg border border-gray-300 bg-white p-5 open:border-primary-600 open:shadow-sm">
                <summary class="cursor-pointer text-lg font-semibold text-gray-900 marker:text-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-700 focus:ring-offset-2">
                    {{ $item['question'] }}
                </summary>
                <p class="mt-4 leading-relaxed text-gray-700">{{ $item['answer'] }}</p>
            </details>
        @endforeach
    </section>

    <nav class="mt-10 rounded-xl border border-gray-200 bg-gray-50 p-6" aria-label="{{ __('pub_theme::faq.navigation.label') }}">
        <h2 class="mb-4 text-xl font-bold text-gray-900">{{ __('pub_theme::faq.navigation.label') }}</h2>
        <ul class="flex flex-wrap gap-x-6 gap-y-4">
            <li><a class="inline-flex min-h-11 items-center font-semibold text-primary-700 underline underline-offset-4 focus:outline-none focus:ring-2 focus:ring-primary-700" href="{{ \Mcamara\LaravelLocalization\Facades\LaravelLocalization::localizeURL('/services/report-issue') }}">{{ __('pub_theme::faq.links.service') }}</a></li>
            <li><a class="inline-flex min-h-11 items-center font-semibold text-primary-700 underline underline-offset-4 focus:outline-none focus:ring-2 focus:ring-primary-700" href="{{ \Mcamara\LaravelLocalization\Facades\LaravelLocalization::localizeURL('/tickets') }}">{{ __('pub_theme::faq.links.reports') }}</a></li>
            <li><a class="inline-flex min-h-11 items-center font-semibold text-primary-700 underline underline-offset-4 focus:outline-none focus:ring-2 focus:ring-primary-700" href="{{ \Mcamara\LaravelLocalization\Facades\LaravelLocalization::localizeURL('/tickets/track') }}">{{ __('pub_theme::faq.links.tracking') }}</a></li>
            <li><a class="inline-flex min-h-11 items-center font-semibold text-primary-700 underline underline-offset-4 focus:outline-none focus:ring-2 focus:ring-primary-700" href="{{ \Mcamara\LaravelLocalization\Facades\LaravelLocalization::localizeURL('/privacy') }}">{{ __('pub_theme::faq.links.privacy') }}</a></li>
        </ul>
    </nav>
</div>
