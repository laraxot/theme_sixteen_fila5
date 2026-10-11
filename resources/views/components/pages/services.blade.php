@php
    $serviceUrl = \Mcamara\LaravelLocalization\Facades\LaravelLocalization::localizeURL('/tickets/create');
    $reportsUrl = \Mcamara\LaravelLocalization\Facades\LaravelLocalization::localizeURL('/tickets');
    $trackUrl = \Mcamara\LaravelLocalization\Facades\LaravelLocalization::localizeURL('/tickets/track');
@endphp

<main id="main-container" class="bg-slate-50 px-4 py-10 sm:px-6 lg:px-8 lg:py-14">
    <div class="mx-auto max-w-5xl">
        <nav aria-label="{{ __('fixcity::global.breadcrumb') }}">
            <ol class="flex flex-wrap gap-2 text-sm text-slate-700">
                <li><a class="underline underline-offset-4 hover:text-sky-800" href="{{ \Mcamara\LaravelLocalization\Facades\LaravelLocalization::localizeURL('/') }}">{{ __('pub_theme::footer.home') }}</a></li>
                <li aria-hidden="true">/</li>
                <li aria-current="page">{{ __('pub_theme::services.title') }}</li>
            </ol>
        </nav>
        <header class="mt-8 max-w-3xl">
            <h1 class="text-3xl font-bold tracking-tight text-slate-950 sm:text-4xl">{{ __('pub_theme::services.meta.title') }}</h1>
            <p class="mt-3 text-lg leading-8 text-slate-700">{{ __('pub_theme::services.meta.description') }}</p>
        </header>
        <div class="mt-10 grid gap-5 md:grid-cols-3">
            <a class="group rounded-xl border border-slate-200 bg-white p-6 shadow-sm transition hover:border-sky-700 hover:shadow-md focus:outline-none focus:ring-4 focus:ring-sky-800/20" href="{{ $serviceUrl }}">
                <h2 class="text-xl font-bold text-slate-950">{{ __('pub_theme::services.nav.report') }}</h2>
                <p class="mt-3 leading-7 text-slate-700">{{ __('pub_theme::services.tasks.report_body') }}</p>
                <span class="mt-5 inline-flex font-semibold text-sky-900 underline underline-offset-4">{{ __('pub_theme::services.tasks.report_action') }}</span>
            </a>
            <a class="group rounded-xl border border-slate-200 bg-white p-6 shadow-sm transition hover:border-sky-700 hover:shadow-md focus:outline-none focus:ring-4 focus:ring-sky-800/20" href="{{ $reportsUrl }}">
                <h2 class="text-xl font-bold text-slate-950">{{ __('pub_theme::services.nav.browse') }}</h2>
                <p class="mt-3 leading-7 text-slate-700">{{ __('pub_theme::services.tasks.browse_body') }}</p>
                <span class="mt-5 inline-flex font-semibold text-sky-900 underline underline-offset-4">{{ __('pub_theme::services.tasks.browse_action') }}</span>
            </a>
            <a class="group rounded-xl border border-slate-200 bg-white p-6 shadow-sm transition hover:border-sky-700 hover:shadow-md focus:outline-none focus:ring-4 focus:ring-sky-800/20" href="{{ $trackUrl }}">
                <h2 class="text-xl font-bold text-slate-950">{{ __('pub_theme::services.nav.track') }}</h2>
                <p class="mt-3 leading-7 text-slate-700">{{ __('pub_theme::services.tasks.track_body') }}</p>
                <span class="mt-5 inline-flex font-semibold text-sky-900 underline underline-offset-4">{{ __('pub_theme::services.tasks.track_action') }}</span>
            </a>
        </div>
    </div>
</main>
