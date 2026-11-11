@props(['region' => __('pub_theme::header.slim.region.name.label'), 'language' => 'ITA', 'login_url' => '#'])

{{-- Top Bar - Bootstrap Italia Exact Replica --}}
<div class="it-top-nav-wrapper">
    <div class="container">
        <div class="row align-items-center">
            {{-- Left: Region Name --}}
            <div class="col-6 col-md-3">
                <span class="top-nav-region">{{ $region }}</span>
            </div>
            
            {{-- Right: Language + Login --}}
            <div class="col-6 col-md-3 offset-md-6 text-right">
                {{-- Language Selector --}}
                <div class="d-inline-block mr-2">
                    <select class="form-control form-control-sm" aria-label="{{ __('pub_theme::components_header.language.select.label') }}" style="width: auto; display: inline-block;">
                        <option value="it" {{ $language === 'ITA' ? 'selected' : '' }}>{{ __('pub_theme::header.language.code_it.label') }}</option>
                        <option value="en" {{ $language === 'ENG' ? 'selected' : '' }}>{{ __('pub_theme::header.language.code_en.label') }}</option>
                    </select>
                </div>
                
                {{-- Login Button --}}
                <a href="{{ $login_url }}" class="btn btn-sm btn-primary">
                    <svg class="icon icon-sm">
                        <use href="#it-user"></use>
                    </svg>
                    <span class="d-none d-sm-inline">{{ __('pub_theme::faq.contacts.login') }}</span>
                </a>
            </div>
        </div>
    </div>
</div>
