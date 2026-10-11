@php
    $localizedPath = app(\Themes\Sixteen\Actions\Url\BuildLocalizedFrontofficePathAction::class);
    $homeUrl = $localizedPath->execute('/');
    $createTicketUrl = $localizedPath->execute('/tickets/create');
    $trackTicketUrl = $localizedPath->execute('/tickets/track');
    $faqUrl = $localizedPath->execute('/domande-frequenti');
    $siteMapUrl = $localizedPath->execute('/mappa-sito');
@endphp

<footer class="border-t border-slate-200 bg-slate-950 text-slate-100" id="footer">
    <div class="mx-auto grid max-w-7xl gap-10 px-4 py-12 sm:px-6 md:grid-cols-3 lg:px-8">
        <div>
            <a class="inline-flex items-start gap-3 rounded-lg focus:outline-none focus:ring-4 focus:ring-white/30" href="{{ $homeUrl }}" aria-label="{{ __('pub_theme::footer.home') }}">
                <img class="h-12 w-12 object-contain" src="{{ asset('themes/Sixteen/design-comuni/assets/images/logo-comune.svg') }}" alt="">
                <span><span class="block text-xl font-bold">FixCity</span><span class="mt-2 block max-w-xs text-sm leading-6 text-slate-300">{{ __('pub_theme::footer.description') }}</span></span>
            </a>
        </div>
        <div>
            <h2 class="text-lg font-bold !text-white">{{ __('pub_theme::footer.services') }}</h2>
            <ul class="mt-4 space-y-3">
                <li><a class="underline decoration-slate-500 underline-offset-4 hover:text-white focus:outline-none focus:ring-2 focus:ring-white" href="{{ $createTicketUrl }}">{{ __('pub_theme::footer.create_ticket') }}</a></li>
                <li><a class="underline decoration-slate-500 underline-offset-4 hover:text-white focus:outline-none focus:ring-2 focus:ring-white" href="{{ $trackTicketUrl }}">{{ __('pub_theme::footer.track_ticket') }}</a></li>
            </ul>
        </div>
        <div>
            <h2 class="text-lg font-bold !text-white">{{ __('pub_theme::footer.information') }}</h2>
            <ul class="mt-4 space-y-3">
                <li><a class="underline decoration-slate-500 underline-offset-4 hover:text-white focus:outline-none focus:ring-2 focus:ring-white" href="{{ $faqUrl }}">{{ __('pub_theme::footer.faq') }}</a></li>
                <li><a class="underline decoration-slate-500 underline-offset-4 hover:text-white focus:outline-none focus:ring-2 focus:ring-white" href="{{ $siteMapUrl }}">{{ __('pub_theme::footer.sitemap') }}</a></li>
            </ul>
            <p class="mt-4 text-sm leading-6 !text-slate-300">{{ __('pub_theme::footer.information_unavailable') }}</p>
        </div>
    </div>
    <div class="border-t border-white/20">
        <div class="mx-auto max-w-7xl px-4 py-5 text-sm text-slate-300 sm:px-6 lg:px-8">{{ config('app.name', 'FixCity') }} · {{ date('Y') }}</div>
    </div>
</footer>
