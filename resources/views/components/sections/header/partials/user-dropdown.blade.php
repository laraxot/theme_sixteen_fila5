<div class="it-user-wrapper nav-item dropdown">
    <a
        href="#"
        class="btn btn-primary btn-icon btn-full"
        id="header-user-toggle"
        data-bs-toggle="dropdown"
        data-focus-mouse="false"
        aria-expanded="false"
        aria-controls="header-user-menu"
        aria-haspopup="true"
        role="button"
        aria-label="{{ __('pub_theme::header.user.aria.toggle_menu.label') }}"
    >
        <span class="rounded-icon" aria-hidden="true">
            @if ($avatarUrl)
                <img
                    src="{{ $avatarUrl }}"
                    alt="{{ $displayName }}"
                    class="border rounded-circle icon-white"
                    width="20"
                    height="20"
                    loading="lazy"
                    decoding="async"
                >
            @else
                <strong class="user-initial-fallback fw-bold text-uppercase">{{ $userInitial !== '' ? $userInitial : 'U' }}</strong>
            @endif
        </span>
        <span class="d-none d-lg-block">{{ $displayName }}</span>
        <svg class="icon icon-white d-none d-lg-block" aria-hidden="true">
            <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-expand"></use>
        </svg>
    </a>

    <div
        class="dropdown-menu"
        id="header-user-menu"
        role="menu"
        aria-labelledby="header-user-toggle"
    >
<<<<<<< Updated upstream
        <div class="row">
            <div class="col-12">
                <div class="link-list-wrapper">
                    <ul class="link-list">
<li>
    <a class="dropdown-item list-item" href="{{ route('services.categories') }}" role="menuitem">
        <span>{{ __('pub_theme::header.user.dropdown.my_services.label') }}</span>
    </a>
</li>
<li>
    <a class="dropdown-item list-item" href="{{ route('dashboard') }}" role="menuitem">
        <span>{{ __('pub_theme::header.user.dropdown.my_practices.label') }}</span>
    </a>
</li>
<li>
    <a class="dropdown-item list-item" href="{{ route('area-personale.notifiche') }}" role="menuitem">
        <span>{{ __('pub_theme::header.user.dropdown.notifications.label') }}</span>
        @if (($unreadNotificationsCount ?? 0) > 0)
            <span class="badge badge-primary ml-2">{{ $unreadNotificationsCount }}</span>
        @endif
    </a>
</li>
                        <li><span class="divider"></span></li>
                        <li>
                            <a class="dropdown-item list-item" href="{{ route('profile.edit') }}" role="menuitem">
                                <span>{{ __('pub_theme::header.user.dropdown.settings.label') }}</span>
                            </a>
                        </li>
                        <li>
                            <a class="list-item left-icon" href="{{ route('logout') }}" role="menuitem">
                                <svg class="icon icon-primary icon-sm left" aria-hidden="true">
                                    <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-external-link"></use>
                                </svg>
                                <span class="fw-bold">{{ __('pub_theme::header.user.dropdown.logout.label') }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
=======
        <div class="link-list-wrapper">
            <ul class="link-list">
                <li>
                    <a class="dropdown-item list-item" href="{{ route('tests.view', ['slug' => 'servizi']) }}" role="menuitem">
                        <svg class="icon icon-sm"><use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-briefcase"></use></svg>
                        <span>{{ __('pub_theme::ui.header_area_personale.my_services.label') }}</span>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item list-item" href="{{ route('tests.view', ['slug' => 'segnalazione-area-personale']) }}" role="menuitem">
                        <svg class="icon icon-sm"><use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-file"></use></svg>
                        <span>{{ __('pub_theme::ui.header_area_personale.my_practices.label') }}</span>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item list-item" href="{{ route('area-personale.notifiche') }}" role="menuitem">
                        <svg class="icon icon-sm"><use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-bell"></use></svg>
                        <span>{{ __('pub_theme::ui.header_area_personale.notifications.label') }}</span>
                        @if (($unreadNotificationsCount ?? 0) > 0)
                            <span class="badge badge-primary ml-2">{{ $unreadNotificationsCount }}</span>
                        @endif
                    </a>
                </li>
                <li><span class="divider"></span></li>
                <li>
                    <a class="dropdown-item list-item" href="{{ route('tests.view', ['slug' => 'segnalazione-area-personale']) }}" role="menuitem">
                        <svg class="icon icon-sm"><use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-settings"></use></svg>
                        <span>{{ __('pub_theme::ui.header_area_personale.settings.label') }}</span>
                    </a>
                </li>
                <li><span class="divider"></span></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}" class="m-0">
                        @csrf
                        <button type="submit" class="dropdown-item list-item text-danger border-0 bg-transparent w-100 text-left">
                            <svg class="icon icon-sm"><use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-logout"></use></svg>
                            <span>{{ __('pub_theme::ui.header_area_personale.logout.label') }}</span>
                        </button>
                    </form>
                </li>
            </ul>
>>>>>>> Stashed changes
        </div>
    </div>
</div>
