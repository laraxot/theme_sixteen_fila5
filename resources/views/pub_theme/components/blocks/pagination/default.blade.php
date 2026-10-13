<nav aria-label="Paginazione" class="pagination-container flex items-center justify-between gap-4">
    <a href="{{ $prev_url ?? '#' }}"
       class="px-4 py-2 bg-neutral-100 text-neutral-700 rounded-md hover:bg-neutral-200 focus:outline-none focus:ring-2 focus:ring-primary-500 {{ !$has_prev ? 'opacity-50 pointer-events-none' : '' }}"
       aria-label="Pagina precedente"
       {{ !$has_prev ? 'tabindex="-1" aria-disabled="true"' : '' }}>
        &larr; Precedente
    </a>

    <div class="flex items-center gap-2 text-sm text-neutral-600">
        <span>Pagina <strong>{{ $current_page }}</strong> di <strong>{{ $total_pages }}</strong></span>
    </div>

    <a href="{{ $next_url ?? '#' }}"
       class="px-4 py-2 bg-primary-600 text-white rounded-md hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 {{ !$has_next ? 'opacity-50 pointer-events-none' : '' }}"
       aria-label="Pagina successiva"
       {{ !$has_next ? 'tabindex="-1" aria-disabled="true"' : '' }}>
        Successiva &rarr;
    </a>
</nav>