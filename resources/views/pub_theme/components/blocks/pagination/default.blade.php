<nav aria-label="{{ __('pub_theme::listing_blocks.pagination.nav.label') }}" class="pagination-container flex items-center justify-between gap-4">
    <a href="{{ $prev_url ?? '#' }}"
       class="px-4 py-2 bg-neutral-100 text-neutral-700 rounded-md hover:bg-neutral-200 focus:outline-none focus:ring-2 focus:ring-primary-500 {{ !$has_prev ? 'opacity-50 pointer-events-none' : '' }}"
       aria-label="{{ __('pub_theme::listing_blocks.pagination.previous_page.label') }}"
       {{ !$has_prev ? 'tabindex="-1" aria-disabled="true"' : '' }}>
        &larr; {{ __('pub_theme::listing_blocks.pagination.previous.label') }}
    </a>

    <div class="flex items-center gap-2 text-sm text-neutral-600">
        <span>{{ __('pub_theme::listing_blocks.pagination.page.label') }} <strong>{{ $current_page }}</strong> {{ __('pub_theme::listing_blocks.pagination.of.label') }} <strong>{{ $total_pages }}</strong></span>
    </div>

    <a href="{{ $next_url ?? '#' }}"
       class="px-4 py-2 bg-primary-600 text-white rounded-md hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 {{ !$has_next ? 'opacity-50 pointer-events-none' : '' }}"
       aria-label="{{ __('pub_theme::listing_blocks.pagination.next_page.label') }}"
       {{ !$has_next ? 'tabindex="-1" aria-disabled="true"' : '' }}>
        {{ __('pub_theme::listing_blocks.pagination.next.label') }} &rarr;
    </a>
</nav>