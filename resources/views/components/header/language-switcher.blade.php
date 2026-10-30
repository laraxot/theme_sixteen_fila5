<!-- Public Language Switcher Component -->
<div x-data="{langOpen: false}">
  <button @click="langOpen = !langOpen" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
    <span>{{ __('pub_theme::header.language.code_it.label') }}</span>
    <x-ui::icon name="chevron-down" x-show="!langOpen"/>
    <x-ui::icon name="chevron-up" x-show="langOpen"/>
  </button>
  <div class="dropdown-menu dropdown-menu-right"
       x-show="langOpen"
       x-transition:enter="transition ease-out duration-200"
       x-transition:leave="transition ease-in duration-150"
       role="menu">
    <a href="#" class="dropdown-item list-item"
x-on:click="lang = 'it'" aria-label="{{ __('pub_theme::components_header.language.select_it.label') }}">{{ __('pub_theme::header.language.code_it.label') }}</a>
    <a href="#" class="dropdown-item list-item"
x-on:click="lang = 'en'" aria-label="{{ __('pub_theme::components_header.language.select_en.label') }}">{{ __('pub_theme::header.language.code_en.label') }}</a>
  </div>
</div>
