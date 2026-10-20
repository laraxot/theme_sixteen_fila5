<?php

declare(strict_types=1);

use function Laravel\Folio\middleware;
use function Laravel\Folio\name;
use Livewire\Volt\Component;
use Modules\Cms\Http\Middleware\PageSlugMiddleware;

name('auth.login');
middleware(PageSlugMiddleware::class);

new class extends Component {

    public string $pageSlug = '';

    /** @var array<string, mixed> */
    public array $data = [];

    public function mount(): void
    {
        $this->pageSlug = 'auth.login';
        $this->data = [];
    }
};
?>

<x-layouts.app
    :title="__('fixcity::auth.login.title.text')"
    :meta-description="__('fixcity::auth.login.intro.text')"
>
    {{--
      Nome @volt unico di questa pagina. Il fragment è md5 del nome, globale:
      counter/prova non devono riusare auth.login (vedi User docs/volt-errors.md).
      data-dc + .auth-login-card attivano lo scope Design Comuni e 14-auth-login.css.
    --}}
    @volt('auth.login')
        <div class="page-content content" data-dc data-slug="{{ $this->pageSlug }}" data-side="content">
            <x-page side="content" :slug="$this->pageSlug" :data="$this->data" />
        </div>
    @endvolt
</x-layouts.app>
