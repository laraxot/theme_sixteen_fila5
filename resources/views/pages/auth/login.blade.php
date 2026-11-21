<?php

declare(strict_types=1);

/**
 * @see docs/stories/11-auth-pages-design-comuni-redesign.story.md
 * @see docs/social-login-bmad.md
 */

use Livewire\Attributes\Locked;
use Livewire\Volt\Component;
use Modules\Cms\Http\Middleware\PageSlugMiddleware;

use function Laravel\Folio\middleware;
use function Laravel\Folio\name;

name('auth.login');
middleware(PageSlugMiddleware::class);

/**
 * Folio shell for the public login page; authentication is delegated to the CMS/User widget.
 *
 * @see docs/stories/11-auth-pages-design-comuni-redesign.story.md
 * @see docs/social-login-bmad.md
 * @see docs/architecture/page-routing-architecture.md
 */
new class extends Component
{
    #[Locked]
    public string $pageSlug = '';

    /** @var array<string, mixed> */
    #[Locked]
    public array $data = [];

    /**
     * @see docs/stories/11-auth-pages-design-comuni-redesign.story.md
     * @see docs/architecture/page-routing-architecture.md
     */
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
      @see docs/stories/11-auth-pages-design-comuni-redesign.story.md
      @see docs/social-login-bmad.md
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
