@if(Auth::check())
  <div class="header-area-personale" data-user="{{ Auth::user()->email }}">
    <img src="{{ Spatie\LivewireComments\Support\Gravatar::url(Auth::user()->email) }}" alt="{{ Auth::user()->name }}" class="w-8 h-8 rounded mb-2" />
    <span>{{ Auth::user()->name }} — <a href="{{ route('segnalazione-area-personale') }}">{{ __('pub_theme::components_common.fields.report.label') }}</a> | <a href="{{ route('graduatoria-area-personale') }}">{{ __('pub_theme::components_header.personal_area.ranking.label') }}</a> | <a href="{{ route('permessi') }}">{{ __('pub_theme::components_header.personal_area.permits.label') }}</a> | <a href="{{ route('vantaggi') }}">{{ __('pub_theme::components_header.personal_area.benefits.label') }}</a> | <a href="{{ route('pagamenti-multa') }}">{{ __('pub_theme::components_header.personal_area.payments.label') }}</a> | <a href="{{ route('logout') }}">{{ __('pub_theme::header.user.dropdown.logout.label') }}</a></span>
  </div>
@else
  <a href="{{ route('login') }}" class="btn-login">{{ __('pub_theme::header.guest.login.label') }}</a>
@endif
<!-- Stack: Tailwind+Alpine+Lit; NO Bootstrap Italia; token #007A52 -->
