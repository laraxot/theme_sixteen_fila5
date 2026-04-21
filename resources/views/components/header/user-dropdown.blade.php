<!-- User Dropdown Component -->
<div x-data="{userOpen: false}"
     x-data="{avatarUrl: '{{  }}'}"
     x-data="{displayName: '{{  }}'}"
     @click.away="userOpen = false">
  <button @click="userOpen = !userOpen"
          class="nav-link dropdown-toggle header-auth-toggle"
          id="header-user-toggle">{{  }}</button>

  <div x-show="userOpen"
       class="dropdown-menu bg-white text-gray-800 rounded-md px-3 py-2"
       role="menu">
    <div class="link-list-wrapper">
      <ul class="link-list">
        <li>
          <a class="dropdown-item list-item" href="{{ route('tests.view', ['slug' => 'servizi']) }}" role="menuitem">
            <x-ui::icon name="briefcase" class="icon-sm"/>
            Servizi
          </a>
        </li>
        <li>
          <a class="dropdown-item list-item" href="{{ route('tests.view', ['slug' => 'segnalazione-area-personale']) }}" role="menuitem">
            <x-ui::icon name="document-text" class="icon-sm"/>
            Pratiche
          </a>
        </li>
        <li>
          <a class="dropdown-item list-item" href="{{ route('tests.view', ['slug' => 'segnalazione-area-personale']) }}" role="menuitem">
            <x-ui::icon name="bell" class="icon-sm"/>
            Notifiche
          </a>
        </li>
        <li><span class="divider"></span></li>
        <li>
          <a class="dropdown-item list-item" href="{{ route('tests.view', ['slug' => 'segnalazione-area-personale']) }}" role="menuitem">
            <x-ui::icon name="cog-6-tooth" class="icon-sm"/>
            Impostazioni
          </a>
        </li>
        <li><span class="divider"></span></li>
        <li>
          <form method="POST" action="{{ route('logout') }}" class="m-0">
            @csrf
            <button type="submit" class="dropdown-item list-item text-danger border-0 bg-transparent w-100 text-left">
              <x-ui::icon name="arrow-right-on-rectangle" class="w-4 h-4 mr-2"/>
              Logout
            </button>
          </form>
        </li>
      </ul>
    </div>
  </div>
</div>
