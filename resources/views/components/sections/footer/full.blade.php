@php
    $localizedPath = app(\Themes\Sixteen\Actions\Url\BuildLocalizedFrontofficePathAction::class);
    $homeUrl = $localizedPath->execute('/');
    $createTicketUrl = $localizedPath->execute('/tickets/create');
    $trackTicketUrl = $localizedPath->execute('/tickets/track');
    $faqUrl = $localizedPath->execute('/domande-frequenti');
    $siteMapUrl = $localizedPath->execute('/mappa-sito');
@endphp

<footer class="it-footer" id="footer">
    <div class="it-footer-main">
        <div class="container">
            <div class="row align-items-start">
                <div class="col-12 col-md-4 footer-items-wrapper">
                    <div class="it-brand-wrapper">
                        <a href="{{ $homeUrl }}" aria-label="{{ __('pub_theme::footer.home') }}">
                            <svg class="icon" aria-hidden="true">
                                <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-pa"></use>
                            </svg>
                            <div class="it-brand-text">
                                <h2 class="no_toc">FixCity</h2>
                                <p>{{ __('pub_theme::footer.description') }}</p>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-12 col-md-4 footer-items-wrapper">
                    <h2 class="footer-heading-title h5">{{ __('pub_theme::footer.services') }}</h2>
                    <ul class="footer-list">
                        <li><a href="{{ $createTicketUrl }}">{{ __('pub_theme::footer.create_ticket') }}</a></li>
                        <li><a href="{{ $trackTicketUrl }}">{{ __('pub_theme::footer.track_ticket') }}</a></li>
                    </ul>
                </div>

                <div class="col-12 col-md-4 footer-items-wrapper">
                    <h2 class="footer-heading-title h5">{{ __('pub_theme::footer.information') }}</h2>
                    <ul class="footer-list">
                        <li><a href="{{ $faqUrl }}">{{ __('pub_theme::footer.faq') }}</a></li>
                        <li><a href="{{ $siteMapUrl }}">{{ __('pub_theme::footer.sitemap') }}</a></li>
                    </ul>
                    <p class="footer-info">{{ __('pub_theme::footer.information_unavailable') }}</p>
                </div>
            </div>
        </div>
    </div>
</footer>
