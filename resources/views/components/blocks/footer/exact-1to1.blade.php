{{--
    EXACT Bootstrap Italia Footer - 1:1 Replication from view-source
    Source: https://italia.github.io/design-comuni-pagine-statiche/sito/homepage.html
--}}

<div class="it-footer-main-wrapper">
  <div class="container">
    <div class="row gy-4">

      {{-- Column 1: Amministrazione --}}
      <div class="col-lg-3 col-md-6 pb-4">
        <h4 class="footer-heading">{{ __('pub_theme::footer_blocks.shared.administration.label') }}</h4>
        <ul class="footer-link-list">
          <li><a href="{{ route('container0.index', ['container0' => 'organi-di-governo'], false) }}">{{ __('pub_theme::footer_blocks.shared.governing_bodies.label') }}</a></li>
          <li><a href="{{ route('container0.index', ['container0' => 'aree-e-uffici'], false) }}">{{ __('pub_theme::footer_blocks.exact_1to1.areas_and_offices.label') }}</a></li>
          <li><a href="{{ route('container0.index', ['container0' => 'enti-e-fondazioni'], false) }}">{{ __('pub_theme::footer_blocks.shared.bodies_and_foundations.label') }}</a></li>
          <li><a href="{{ route('container0.index', ['container0' => 'politici'], false) }}">{{ __('pub_theme::footer_blocks.shared.politicians.label') }}</a></li>
          <li><a href="{{ route('container0.index', ['container0' => 'dirigenti'], false) }}">{{ __('pub_theme::footer_blocks.exact_1to1.managers.label') }}</a></li>
          <li><a href="{{ route('container0.index', ['container0' => 'associazioni-e-societa'], false) }}">{{ __('pub_theme::footer_blocks.exact_1to1.associations_and_companies.label') }}</a></li>
        </ul>
      </div>

      {{-- Column 2: Novità --}}
      <div class="col-lg-3 col-md-6 pb-4">
        <h4 class="footer-heading">{{ __('pub_theme::blocks_common.shared.news.label') }}</h4>
        <ul class="footer-link-list">
          <li><a href="{{ route('container0.index', ['container0' => 'notizie'], false) }}">{{ __('pub_theme::footer_blocks.shared.news.label') }}</a></li>
          <li><a href="{{ route('container0.index', ['container0' => 'comunicati-stampa'], false) }}">{{ __('pub_theme::footer_blocks.exact_1to1.press_releases.label') }}</a></li>
        </ul>
      </div>

      {{-- Column 3: Servizi --}}
      <div class="col-lg-3 col-md-6 pb-4">
        <h4 class="footer-heading">{{ __('pub_theme::blocks_common.shared.services.label') }}</h4>
        <ul class="footer-link-list">
          <li><a href="{{ route('container0.index', ['container0' => 'servizi-e-demografici'], false) }}">{{ __('pub_theme::footer_blocks.exact_1to1.demographic_services.label') }}</a></li>
          <li><a href="{{ route('container0.index', ['container0' => 'servizi-educativi'], false) }}">{{ __('pub_theme::footer_blocks.exact_1to1.educational_services.label') }}</a></li>
          <li><a href="{{ route('container0.index', ['container0' => 'servizi-sociali'], false) }}">{{ __('pub_theme::footer_blocks.exact_1to1.social_services.label') }}</a></li>
        </ul>
      </div>

      {{-- Column 4: Contatti --}}
      <div class="col-lg-3 col-md-6 pb-4">
        <h4 class="footer-heading">{{ __('pub_theme::blocks_common.shared.contacts.label') }}</h4>
        <p class="footer-address">
          <strong>Comune di Example</strong><br>
          Via Example, 1<br>
          00100 Example (RM)<br>
          Codice fiscale / P. IVA: 00000000000
        </p>
        <ul class="footer-contact-list">
          <li>
            <a href="tel:+000000000">
              <span>{{ __('pub_theme::blocks_common.shared.phone_colon.label') }} </span>
              <strong>000 0000000</strong>
            </a>
          </li>
          <li>
            <a href="mailto:example@cert.it">
              <span>{{ __('pub_theme::blocks_common.shared.email_colon.label') }} </span>
              <strong>example@cert.it</strong>
            </a>
          </li>
          <li>
            <a href="mailto:example@pec.it">
              <span>{{ __('pub_theme::footer_blocks.shared.certified_email_colon.label') }} </span>
              <strong>example@pec.it</strong>
            </a>
          </li>
        </ul>
      </div>

    </div>
  </div>
</div>

{{-- Footer Middle Section - Social & Subscribe --}}
<div class="it-footer-middle-wrapper">
  <div class="container">
    <div class="row">

      {{-- Logo --}}
      <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
        <img src="https://picsum.photos/80/80" alt="{{ __('pub_theme::footer_blocks.exact_1to1.municipality_logo.label') }}" class="footer-logo" width="80" height="80">
        <p class="footer-municipality">
          <strong>Comune di Example</strong><br>
          {{ __('pub_theme::footer_blocks.exact_1to1.an_italian_town_to_live_in.label') }}
        </p>
      </div>

      {{-- Social --}}
      <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
        <h4 class="footer-heading">{{ __('pub_theme::footer_blocks.shared.follow_us_on.label') }}</h4>
        <ul class="footer-social-list list-inline">
          <li class="list-inline-item">
            <a href="#" class="footer-social-link" aria-label="Facebook">
              <svg class="icon">
                <use href="#it-facebook"></use>
              </svg>
            </a>
          </li>
          <li class="list-inline-item">
            <a href="#" class="footer-social-link" aria-label="Twitter">
              <svg class="icon">
                <use href="#it-twitter"></use>
              </svg>
            </a>
          </li>
          <li class="list-inline-item">
            <a href="#" class="footer-social-link" aria-label="Instagram">
              <svg class="icon">
                <use href="#it-instagram"></use>
              </svg>
            </a>
          </li>
          <li class="list-inline-item">
            <a href="#" class="footer-social-link" aria-label="YouTube">
              <svg class="icon">
                <use href="#it-youtube"></use>
              </svg>
            </a>
          </li>
        </ul>
      </div>

      {{-- Newsletter --}}
      <div class="col-lg-4 col-md-6">
        <h4 class="footer-heading">{{ __('pub_theme::footer_blocks.exact_1to1.newsletter.label') }}</h4>
        <p>{{ __('pub_theme::footer_blocks.exact_1to1.follow_the_municipality_s_news.label') }}</p>
        <form class="footer-newsletter-form">
          <div class="input-group">
            <input type="email" class="form-control" placeholder="{{ __('pub_theme::footer_blocks.exact_1to1.your_email.placeholder') }}" aria-label="{{ __('pub_theme::footer_blocks.exact_1to1.email_address_for_the_newsletter.label') }}">
            <button class="btn btn-primary" type="submit">{{ __('pub_theme::footer_blocks.exact_1to1.subscribe.label') }}</button>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>

{{-- Footer Bottom Section - Legal Links --}}
<div class="it-footer-bottom-wrapper">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <ul class="footer-bottom-links list-inline mb-0">
          <li class="list-inline-item">
            <a href="{{ route('container0.index', ['container0' => 'amministrazione-trasparente'], false) }}">{{ __('pub_theme::footer_blocks.shared.transparent_administration.label') }}</a>
          </li>
          <li class="list-inline-item">
            <a href="{{ route('container0.index', ['container0' => 'cookie-policy'], false) }}">{{ __('footer.cookie_policy') }}</a>
          </li>
          <li class="list-inline-item">
            <a href="{{ route('container0.index', ['container0' => 'informativa-privacy'], false) }}">{{ __('footer.privacy') }}</a>
          </li>
          <li class="list-inline-item">
            <a href="{{ route('container0.index', ['container0' => 'note-legali'], false) }}">{{ __('footer.legal_notes') }}</a>
          </li>
          <li class="list-inline-item">
            <a href="{{ route('container0.index', ['container0' => 'dichiarazione-accessibilita'], false) }}">{{ __('footer.accessibility') }}</a>
          </li>
        </ul>
      </div>
    </div>

    <div class="row mt-3">
      <div class="col-12">
        <p class="footer-copyright text-muted">
          {{ __('pub_theme::footer_blocks.exact_1to1.copyright.message', ['year' => date('Y')]) }}
        </p>
      </div>
    </div>
  </div>
</div>
