{{--
    Category Resources Block
    Reference: design-comuni-pagine-statiche lista-risorse-categorie page
--}}
@props([
    'categories' => [],
    'title' => '',
])

<section class="section py-4">
    <div class="container">
        @if(!empty($title))
            <div class="row mb-4">
                <div class="col-12">
                    <h2>{{ $title }}</h2>
                </div>
            </div>
        @endif

        @forelse($categories as $category)
            <div class="row mb-4">
                <div class="col-12">
                    <h3 class="h4 mb-3">{{ $category['name'] ?? 'Categoria' }}</h3>
                    <div class="list-group">
                        @forelse($category['resources'] ?? [] as $resource)
                            <a href="{{ $resource['url'] ?? '#' }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                <span>{{ $resource['title'] ?? '' }}</span>
                                <svg class="icon icon-sm"><use href="#it-arrow-right"></use></svg>
                            </a>
                        @empty
                            <p class="text-muted">{{ __('pub_theme::blocks_content.resources.no_resources_in_this_category.label') }}</p>
                        @endforelse
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-muted text-center">{{ __('pub_theme::blocks_content.resources.no_categories_available.label') }}</p>
            </div>
        @endforelse
    </div>
</section>