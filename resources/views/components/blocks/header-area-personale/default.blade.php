@if(Auth::check())
  <div class="header-area-personale" data-user="{{ Auth::user()->email }}">
    <img src="{{ Spatie\LivewireComments\Support\Gravatar::url(Auth::user()->email) }}" alt="{{ Auth::user()->name }}" class="w-8 h-8 rounded mb-2" />
    <span>{{ Auth::user()->name }} — <a href="{{ route('segnalazione-area-personale') }}">Segnalazione</a> | <a href="{{ route('graduatoria-area-personale') }}">Graduatoria</a> | <a href="{{ route('permessi') }}">Permessi</a> | <a href="{{ route('vantaggi') }}">Vantaggi</a> | <a href="{{ route('pagamenti-multa') }}">Pagamenti</a> | <a href="{{ route('logout') }}">Esci</a></span>
  </div>
@else
  <a href="{{ route('login') }}" class="btn-login">Accedi</a>
@endif
<!-- Stack: Tailwind+Alpine+Lit; NO Bootstrap Italia; token #007A52 -->
