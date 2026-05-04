@php
    try {
        /** @var array<string, array<string, mixed>> $supportedLocales */
        $supportedLocales = \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getSupportedLocales();
    } catch (\Throwable) {
        $supportedLocales = [];
    }

    if ($supportedLocales === []) {
        $supportedLocales = [
            'it' => ['native' => 'Italiano'],
            'en' => ['native' => 'English'],
        ];
    }

    $currentLocale = app()->getLocale();
@endphp
<div class="nav-item dropdown">
    <button
        type="button"
        class="nav-link dropdown-toggle text-white"
        id="header-language-toggle"
        data-bs-toggle="dropdown"
        data-focus-mouse="false"
        aria-expanded="false"
        aria-haspopup="true"
        aria-controls="header-language-menu"
    >
        <span class="visually-hidden">{{ __('pub_theme::header.language.active_prefix.label') }}</span>
        <span>
            @php
                $currentShort = match (strtolower(substr($currentLocale, 0, 2))) {
                    'it' => __('pub_theme::header.language.code_it.label'),
                    'en' => __('pub_theme::header.language.code_en.label'),
                    default => strtoupper(substr($currentLocale, 0, 2)),
                };
            @endphp
            {{ $currentShort }}
        </span>
        <svg class="icon icon-white" aria-hidden="true">
            <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-expand"></use>
        </svg>
    </button>
    <div
        class="dropdown-menu"
        id="header-language-menu"
        role="menu"
        aria-labelledby="header-language-toggle"
        aria-orientation="vertical"
    >
        <div class="row">
            <div class="col-12">
                <div class="link-list-wrapper">
                    <ul class="link-list">
                        @foreach ($supportedLocales as $localeCode => $_meta)
                            @php
                                $localeKey = strtolower((string) $localeCode);
                                $isCurrent = str_starts_with(strtolower($currentLocale), $localeKey)
                                    || strtolower($currentLocale) === $localeKey;
                                $short = match (substr($localeKey, 0, 2)) {
                                    'it' => __('pub_theme::header.language.code_it.label'),
                                    'en' => __('pub_theme::header.language.code_en.label'),
                                    default => strtoupper(substr($localeKey, 0, 3)),
                                };
                                try {
                                    $href = \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getLocalizedURL($localeCode);
                                } catch (\Throwable) {
                                    $href = url('/'.$localeKey);
                                }
                            @endphp
                            <li>
                                <a class="dropdown-item list-item" href="{{ $href }}" role="menuitem" @if ($isCurrent) aria-current="true" @endif>
                                    <span>
                                        {{ $short }}
                                        @if ($isCurrent)
                                            <span class="visually-hidden">{{ __('pub_theme::header.language.selected_suffix.label') }}</span>
                                        @endif
                                    </span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
