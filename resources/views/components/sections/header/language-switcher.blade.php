{{-- Language Switcher Component --}}
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
        <span class="visually-hidden">Lingua attiva:</span>
        <span>ITA</span>
        <svg class="icon icon-white" aria-hidden="true">
            <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-expand"></use>
        </svg>
    </button>
    <div
        class="dropdown-menu bg-white text-gray-800 rounded-md px-3 py-2"
        id="header-language-menu"
        role="menu"
        aria-labelledby="header-language-toggle"
        aria-orientation="vertical"
    >
        <ul class="link-list">
            <li><a class="dropdown-item bg-white text-gray-800 rounded-md px-3 py-2 hover:bg-gray-100 flex items-center space-x-2" href="#" role="menuitem"><span>ITA <span class="visually-hidden">selezionata</span></span></a></li>
            <li><a class="dropdown-item bg-white text-gray-800 rounded-md px-3 py-2 hover:bg-gray-100 flex items-center space-x-2" href="#" role="menuitem"><span>ENG</span></a></li>
        </ul>
    </div>
</div>