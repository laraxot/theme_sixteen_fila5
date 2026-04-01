<?php

declare(strict_types=1);

use function Laravel\Folio\middleware;
use function Laravel\Folio\name;
use Livewire\Volt\Component;
use Modules\Cms\Http\Middleware\PageSlugMiddleware;

name('tests.view');
middleware(PageSlugMiddleware::class);

new class extends Component {
    public string $slug = '';
    public string $pageSlug = '';
<<<<<<< HEAD
    public array $blocks = [];
=======

    /** @var array<string, mixed> */
    public array $data = [];
>>>>>>> 4a11dcf (.)

    public function mount(string $slug): void
    {
        $this->slug = $slug;
        $this->pageSlug = 'tests.'.$slug;
<<<<<<< HEAD
        
        // Load blocks from JSON
        $jsonPath = config_path('local/fixcity/database/content/pages/'.$this->pageSlug.'.json');
        if (file_exists($jsonPath)) {
            $content = file_get_contents($jsonPath);
            $data = json_decode($content, true);
            $this->blocks = $data['content_blocks']['it'] ?? [];
        }
    }
};
?>

<x-layouts.app>
    @volt('tests.view')
    <div>
        {{-- Skip Links --}}
        <div class="skiplink">
            <a class="visually-hidden-focusable" href="#main-container">Vai ai contenuti</a>
            <a class="visually-hidden-focusable" href="#footer">Vai al footer</a>
        </div><!-- /skiplink -->

        {{-- Header --}}
        <x-section slug="header" />

        {{-- Main Content --}}
        <main id="main-container">
            @foreach($this->blocks as $block)
                @if(isset($block['data']['view']))
                    @includeIf($block['data']['view'], ['data' => $block['data']])
                @endif
            @endforeach
        </main>

        {{-- Footer --}}
        <x-section slug="footer" tpl="full" />
=======
        $this->data = [
            'slug' => $slug,
        ];
    }
};
?>
<x-layouts.app>
    @volt('tests.view')
    <div>
        <x-page side="content" :slug="$pageSlug" :data="$data" />
>>>>>>> 4a11dcf (.)
    </div>
    @endvolt
</x-layouts.app>
