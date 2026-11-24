{{-- @see docs/wiki/concepts/fo-folio-named-routes-header.md --}}
<a class="btn btn-primary btn-icon btn-full" href="{{ \Themes\Sixteen\Infrastructure\Url\FrontofficeUrl::fromStoredUrl('/auth/login') }}" data-element="personal-area-login" aria-label="{{ __('pub_theme::header.guest.cta.label') }}">
    <span class="rounded-icon" aria-hidden="true">
        <svg class="icon icon-primary">
            <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-user"></use>
        </svg>
    </span>
    <span class="d-none d-lg-block">{{ __('pub_theme::header.guest.cta.label') }}</span>
</a>
