<div id="sitemap-content" class="container-italia mx-auto max-w-6xl px-4 py-10" aria-labelledby="sitemap-title">
    <header class="mb-10 max-w-3xl">
        <h1 id="sitemap-title" class="mb-4 text-4xl font-bold text-gray-900">{{ __('pub_theme::sitemap.meta.title') }}</h1>
        <p class="text-lg leading-relaxed text-gray-700">{{ __('pub_theme::sitemap.intro') }}</p>
    </header>

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
        @foreach (__('pub_theme::sitemap.groups') as $group)
            <section class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm" aria-labelledby="sitemap-group-{{ $loop->index }}">
                <h2 id="sitemap-group-{{ $loop->index }}" class="mb-4 text-xl font-bold text-gray-900">{{ $group['title'] }}</h2>
                <ul class="space-y-3">
                    @foreach ($group['links'] as $link)
                        <li>
                            <a class="inline-flex min-h-11 items-center font-semibold text-primary-700 underline underline-offset-4 focus:outline-none focus:ring-2 focus:ring-primary-700" href="{{ \Mcamara\LaravelLocalization\Facades\LaravelLocalization::localizeURL($link['path']) }}">
                                {{ $link['label'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </section>
        @endforeach
    </div>
</div>
