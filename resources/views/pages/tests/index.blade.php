<?php

declare(strict_types=1);

use function Laravel\Folio\middleware;
use function Laravel\Folio\name;
use Livewire\Volt\Component;
use Modules\Cms\Http\Middleware\PageSlugMiddleware;

name('tests.index');
middleware(PageSlugMiddleware::class);

new class extends Component {
<<<<<<< HEAD
    public string $pageSlug = 'tests.index';
    public array $data = [];
};
?>

=======
    public string $pageSlug = '';

    /** @var array<string, mixed> */
    public array $data = [];

    public function mount(): void
    {
        $this->pageSlug = 'tests.index';
        $this->data = [];
    }
};
?>
>>>>>>> 4a11dcf (.)
<x-layouts.app>
    @volt('tests.index')
    <div>
        <x-page side="content" :slug="$pageSlug" :data="$data" />
    </div>
    @endvolt
<<<<<<< HEAD
</x-layouts.app>
=======
</x-layouts.app>
>>>>>>> 4a11dcf (.)
