@php
    use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

    $searchCreateUrl = LaravelLocalization::localizeURL('/tickets/create');
    $searchListUrl = LaravelLocalization::localizeURL('/tickets');
    $searchTrackUrl = LaravelLocalization::localizeURL('/tickets/track');
@endphp
<div class="modal fade search-modal" id="search-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content perfect-scrollbar">
            <div class="modal-body">
                <form>
                    <div class="container">
                        <div class="row variable-gutters">
                            <div class="col">
                                <div class="modal-title">
                                    <button class="search-link d-md-none" type="button" data-bs-toggle="modal" data-bs-target="#search-modal" aria-label="{{ __('pub_theme::ui.close') }}">
                                        <svg class="icon icon-md">
                                            <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-arrow-left"></use>
                                        </svg>
                                    </button>
                                    <h2>{{ __('pub_theme::ui.search') }}</h2>
                                    <button class="search-link d-none d-md-block" type="button" data-bs-toggle="modal" data-bs-target="#search-modal" aria-label="{{ __('pub_theme::ui.close') }}">
                                        <svg class="icon icon-md">
                                            <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-close-big"></use>
                                        </svg>
                                    </button>
                                </div>
                                <div class="form-group autocomplete-wrapper">
                                    <label for="autocomplete-two" class="visually-hidden">{{ __('pub_theme::ui.search_site_aria') }}</label>
                                    <input type="search" class="autocomplete ps-5" placeholder="{{ __('pub_theme::ui.search_site_aria') }}" id="autocomplete-two" name="autocomplete-two" data-bs-autocomplete="[]">
                                    <span class="autocomplete-icon" aria-hidden="true">
                                        <svg class="icon"><use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-search"></use></svg>
                                    </span>
                                    <button type="button" class="btn btn-primary">
                                        <span class="">{{ __('pub_theme::ui.search') }}</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="row variable-gutters">
                            <div class="col-lg-5">
                                <div class="searches-list-wrapper">
                                    <div class="other-link-title">{{ __('pub_theme::navigation.homepage.maybe_searching') }}</div>
                                    <ul class="searches-list">
                                        <li><a href="{{ $searchCreateUrl }}">{{ __('pub_theme::footer.create_ticket') }}</a></li>
                                        <li><a href="{{ $searchListUrl }}">{{ __('pub_theme::footer.services') }}</a></li>
                                        <li><a href="{{ $searchTrackUrl }}">{{ __('pub_theme::footer.track_ticket') }}</a></li>
                                    </ul><!-- /searches-list -->
                                </div><!-- /searches-list-wrapper -->
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
