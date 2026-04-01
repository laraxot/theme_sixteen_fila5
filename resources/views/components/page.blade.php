{{--
    Page Component - Renders pages from JSON config
    Usage: <x-page side="content" :slug="$pageSlug" :data="$data" />
    
    Renders all content blocks defined in JSON config
--}}

@props([
    'side' => 'content',
    'slug' => '',
    'data' => []
])

@php
    // Load page from JSON config
    $jsonPath = config('local.fixcity.database.content.pages.'.$slug);
    $pageData = null;
    $blocks = [];
    
    // Try to load from config path
    $configPath = base_path('laravel/config/local/fixcity/database/content/pages/'.$slug.'.json');
    if (file_exists($configPath)) {
        $pageData = json_decode(file_get_contents($configPath), true);
        $blocks = $pageData['content_blocks']['it'] ?? [];
    }
@endphp

<div class="page-content {{ $side }}">
    @if($pageData && count($blocks) > 0)
        {{-- Render all content blocks from JSON --}}
        @foreach($blocks as $block)
            @if(isset($block['type']))
                @php
                    $blockType = $block['type'];
                    $blockData = $block['data'] ?? [];
                    $viewPath = 'components.blocks.' . $blockType;
                @endphp
                
                @includeIf($viewPath, ['data' => $blockData])
            @endif
        @endforeach
    @else
        {{-- Error: Page not found or no blocks --}}
        <div class="container py-8">
            <div class="alert alert-danger" role="alert">
                <h2 class="h4 mb-2">Pagina non trovata</h2>
                <p>La pagina <code>{{ $slug }}</code> non esiste o non ha blocchi di contenuto.</p>
                <a href="/it/tests/" class="btn btn-primary mt-3">
                    Torna all'indice
                </a>
            </div>
        </div>
    @endif
</div>
