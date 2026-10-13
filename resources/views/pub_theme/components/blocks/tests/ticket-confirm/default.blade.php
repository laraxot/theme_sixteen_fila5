<div class="confirmation-page bg-neutral-50 min-h-screen">
    <div class="max-w-3xl mx-auto px-6 py-12">
        <div class="card shadow card-wrapper bg-white rounded-xl p-8 text-center">
            <h1 class="title-xxxlarge text-4xl font-extrabold text-neutral-900 mb-4" data-element="page-name">Segnalazione inviata</h1>
            <p class="text-lg text-neutral-600 mb-6">Grazie per aver segnalato il danno. Il tuo intervento verrà assegnato al luogo indicato (mappa confermata nel riepilogo).</p>

            <div class="bg-primary-50 rounded-lg p-6 mb-6 border border-primary-100">
                <h2 class="text-sm uppercase tracking-wider text-primary-600 font-bold mb-2">Numero pratica</h2>
                <div class="text-3xl font-mono font-bold text-neutral-900" x-text="pratica || 'T-2026-XXXX'">T-2026-XXXX</div>
                <p class="text-sm text-neutral-500 mt-2">Conserva questo numero per seguire lo stato della riparazione.</p>
            </div>

            <div class="cmp-rating__card-first bg-neutral-50 rounded-lg p-6 mb-6 border border-neutral-200">
                <h3 class="font-semibold text-neutral-800 mb-3">Come valuti questa segnalazione?</h3>
                <div class="flex gap-2 justify-center">
                    <template x-for="star in [1,2,3,4,5]" :key="star">
                        <button @click="rating = star" class="w-10 h-10 rounded-full bg-primary-600 text-white flex items-center justify-center hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2" aria-label="Valuta {{ star }} stelle" :class="rating >= star ? 'bg-primary-600' : 'bg-neutral-300'">
                            ★
                        </button>
                    </template>
                </div>
            </div>

            <a href="/it/" class="btn btn-primary btn-icon btn-full w-full bg-primary-600 text-white py-3 rounded-md hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">Torna alla homepage</a>
        </div>
    </div>
</div>
