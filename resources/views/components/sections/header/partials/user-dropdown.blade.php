<div class="it-user-wrapper nav-item dropdown">
    <button
        type="button"
        class="nav-link dropdown-toggle header-auth-toggle"
        id="header-user-toggle"
        data-bs-toggle="dropdown"
        data-focus-mouse="false"
        aria-expanded="false"
        aria-controls="header-user-menu"
        aria-haspopup="true"
        aria-label="{{ __('pub_theme::ui.header_area_personale.user_menu_toggle.tooltip') }}"
    >
        <span class="header-user-avatar" aria-hidden="true">
            @if ($avatarUrl)
                <img src="{{ $avatarUrl }}" alt="{{ __('pub_theme::ui.header_area_personale.avatar_alt.label') }}" class="rounded-circle border border-2 border-white" loading="lazy" decoding="async">
            @else
                <span class="header-user-avatar-initial">{{ $userInitial !== '' ? $userInitial : 'U' }}</span>
            @endif
        </span>
        <span class="header-user-label d-none d-lg-inline">{{ $displayName }}</span>
        <svg class="icon icon-sm icon-white" aria-hidden="true">
            <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-expand"></use>
        </svg>
    </button>

    <div
        class="dropdown-menu bg-white text-gray-800 rounded-md px-3 py-2"
        id="header-user-menu"
        role="menu"
        aria-labelledby="header-user-toggle"
        aria-orientation="vertical"
    >
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
                    <a class="dropdown-item list-item" href="{{ route('tests.view', ['slug' => 'segnalazione-area-personale']) }}" role="menuitem">
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
        </div>
    </div>
</div>
