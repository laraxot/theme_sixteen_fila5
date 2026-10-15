@if(Auth::check())
  <div class="header-area-personale" data-user="marco.sottana@gmail.com">
    <span>Marco Sottana — <a href="{{ route('segnalazione-area-personale') }}">Segnalazione</a> | <a href="{{ route('graduatoria-area-personale') }}">Graduatoria</a> | <a href="{{ route('permessi') }}">Permessi</a> | <a href="{{ route('vantaggi') }}">Vantaggi</a> | <a href="{{ route('pagamenti-multa') }}">Pagamenti</a></span>
  </div>
@else
  <a href="{{ route('login') }}" class="btn-login">Accedi</a>
@endif
<!-- Stack: Tailwind+Alpine+Lit; NO Bootstrap Italia; token #007A52 -->
