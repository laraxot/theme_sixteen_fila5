<div class="search-results-container" x-data="searchResults({!! json_encode([
    'results' => $data['results'] ?? [],
    'filters' => $data['filters'] ?? [],
    'pagination' => $data['pagination'] ?? [],
    'resultCount' => $data['result_count'] ?? 0,
    'resultLabel' => $data['result_label'] ?? 'Risultati',
    'query' => $data['query'] ?? ''
]) })">
    @if(isset($data['query']) && $data['query'] !== '')
        <div class="search-summary mb-6">
            <p class="text-base text-neutral-700">
                Sono presenti <strong x-text="resultCount"></strong> <span x-text="resultLabel.toLowerCase()"></span> per "<strong x-text="query"></strong>"
            </p>
        </div>
    @endif

    <!-- Search Form -->
    <div class="mb-8" x-show="!query">
        <form @submit.prevent="doSearch()"
              class="bg-white rounded-lg border border-neutral-200 p-4 max-w-md mx-auto shadow-sm focus-within:ring-2 focus-within:ring-primary-500 focus-within:outline-none">
            <div class="relative">
                <svg class="absolute left-4 top-1/2 -translate-y-1/2 text-neutral-400 w-5 h-5"
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input id="search-input"
                       type="text"
                       name="query"
                       placeholder="Cerca..."
                       @model="query"
                       @input="updateQuery($event.target.value)"
                       autocomplete="off"
                       class="block w-full px-12 pr-4 py-4 rounded-xl text-neutral-900 placeholder-neutral-400 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:placeholder-neutral-500"
                       aria-label="Cerca nel sito">
            </div>
            <button type="submit"
                    class="absolute right-4 top-1/2 -translate-y-1/2 bg-primary-600 text-white px-4 py-2 rounded-xl text-sm font-medium hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition-colors"
                    aria-label="Esegui ricerca">
                Cerca
            </button>
        </form>
    </div>

    @if(isset($data['query']) && $data['query'] !== '')
        <div class="search-summary mb-6">
            <p class="text-base text-neutral-700">
                Sono presenti <strong x-text="resultCount"></strong> <span x-text="resultLabel.toLowerCase()"></span> per "<strong x-text="query"></strong>"
            </p>
        </div>
    @endif

    @if(isset($data['results']) && count($data['results']) > 0)
        <ul class="space-y-4 mb-8">
            <template x-for="result in results" :key="result.url">
                <li class="border border-neutral-200 rounded-lg p-4 hover:bg-neutral-50 transition-colors">
                    <div class="flex flex-col sm:flex-row items-start gap-4">
                        @if(isset($result['image']))
                            <img :src="result.image" :alt="result.image_alt ?? result.title" class="w-full sm:w-24 h-auto sm:h-24 object-cover rounded-md flex-shrink-0" loading="lazy" />
                        @endif

                        <div class="flex-1 min-w-0">
                            @if(isset($result['type']) && in_array($result['type'], ['Servizi', 'Novità', 'Luoghi', 'Eventi']))
                                <span class="inline-block px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary-100 text-primary-800 mb-2" x-text="result.type"></span>
                            @endif

                            <a :href="result.url"
                               class="block text-lg font-semibold text-primary-600 hover:text-primary-700 hover:underline focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 mb-1"
                               x-text="result.title">
                            </a>

                            <p class="mt-1 text-sm text-neutral-600" x-text="result.description"></p>

                            @if(isset($result['category']) && $result['category'])
                                <div class="mt-2 flex flex-wrap items-center gap-x-4 text-xs text-neutral-500">
                                    <span class="inline-flex items-center">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M17 17h.01M7 17h.01M17 7h.01M12 12h.01M12 7h.01" />
                                        </svg>
                                        <span x-text="result.category"></span>
                                    </span>
                                    @if(isset($result['date']) && $result['date'])
                                        <span x-text="`Aggiornato: ${result.date}`"></span>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </li>
            </template>
        </ul>

        @if(isset($data['pagination']) && $data['pagination'])
            <div class="pagination-container mb-8">
                <nav aria-label="Paginazione" class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <span class="text-sm text-neutral-600">
                            Pagina <strong x-text="pagination.current_page"></strong> di <strong x-text="pagination.total_pages"></strong>
                        </span>
                    </div>

                    <ul class="inline-flex items-center gap-1">
                        <li>
                            <a href="#" @click="prevPage()"
                               class="px-3 py-1 text-sm text-neutral-700 bg-neutral-100 rounded hover:bg-neutral-200 focus:outline-none focus:ring-2 focus:ring-primary-500"
                               :class="!pagination.has_prev && 'opacity-50 pointer-events-none'">
                                Precedente
                            </a>
                        </li>
                        <li>
                            <a href="#" @click="nextPage()"
                               class="px-3 py-1 text-sm text-neutral-700 bg-neutral-100 rounded hover:bg-neutral-200 focus:outline-none focus:ring-2 focus:ring-primary-500"
                               :class="!pagination.has_next && 'opacity-50 pointer-events-none'">
                                Successiva
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        @endif
    @else
        <div class="text-center py-12">
            <svg class="mx-auto h-12 w-12 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 01-18 0 9 9 0 0118 0z" />
            </svg>
            <p class="mt-4 text-lg font-medium text-neutral-900">Nessun risultato trovato</p>
            <p class="mt-2 text-sm text-neutral-500">Prova a modificare i filtri o la tua ricerca.</p>
        </div>
    @endif

    @if(isset($data['rating']))
        <div class="rating-container mt-12 pt-8 border-t border-neutral-200">
            <h3 class="text-lg font-semibold text-neutral-800 mb-4" x-text="rating.title"></h3>
            <div class="flex items-center gap-3">
                <template x-for="i in 5" :key="i">
                    <button @click="setRating(i)" type="button"
                            class="focus:outline-none focus:ring-2 focus:ring-primary-500 rounded">
                        <svg :class="`w-6 h-6 ${i <= ratingValue ? 'text-amber-400 fill-current' : 'text-neutral-300 stroke-current'}`"
                             viewBox="0 0 24 24">
                            <path d="M12 2l3.09 6.26L21.31 8.84 17.62 14.64 18.72 18.74 12 17.27 5.28 18.74 6.38 14.64 2.69 8.84 8.91 8.26z" />
                        </svg>
                    </button>
                </template>
                <span class="text-sm text-neutral-600" x-show="ratingValue > 0" x-text="`Hai valutato: ${ratingValue}/5`"></span>
            </div>
            <div class="mt-2" x-show="ratingValue > 0">
                <p class="text-sm text-neutral-600" x-text="rating.thanks"></p>
            </div>
        </div>
    @endif
</div>

<script>
function searchResults(config) {
    return {
        results: config.results || [],
        pagination: config.pagination || {},
        resultCount: config.resultCount || 0,
        resultLabel: config.resultLabel || 'Risultati',
        query: config.query || '',
        rating: config.rating || null,
        ratingValue: 0,

        updateQuery(value) {
            this.query = value;
        },

        setRating(value) {
            this.ratingValue = value;
        },

        prevPage() {
            if (this.pagination.has_prev) {
                window.location.href = this.pagination.prev_url || '#';
            }
        },

        nextPage() {
            if (this.pagination.has_next) {
                window.location.href = this.pagination.next_url || '#';
            }
        },

        doSearch() {
            if (this.query.trim()) {
                window.location.href = '/it/tests/risultati-ricerca?q=' + encodeURIComponent(this.query.trim());
            }
        }
    };
}
</script>