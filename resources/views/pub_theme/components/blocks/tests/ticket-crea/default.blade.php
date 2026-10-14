<div>
    <h2>Segnala disservizio</h2>
    @if(session('ticket_step'))
        <input type="hidden" id="wizard-step-data" value="{{ session('ticket_step') }}" aria-label="Passo wizard attuale" />
    @endif
    <form wire:submit.prevent="save" class="space-y-4">
        <div>
            <label>Tipo</label>
            <input type="text" wire:model="form.tipo" />
        </div>
        <div>
            <label>Categoria</label>
            <input type="text" wire:model="form.categoria" />
        </div>
        <div>
            <label>Descrizione</label>
            <textarea wire:model="form.descrizione"></textarea>
        </div>
        <div>
            <label>Privacy</label>
            <input type="checkbox" wire:model="form.privacy" />
        </div>
        <div class="map-section flex flex-col items-center">
            <label class="w-full mb-2">Posizione del danno (clicca sulla mappa)</label>
            <div id="map" class="w-full h-80 rounded shadow mb-4 flex items-center justify-center relative" data-auto-center="true" aria-label="Mappa interattiva — centrata sulla tua posizione attuale" role="region">
                <noscript><p class="text-center text-sm">Mappa disponibile con JavaScript abilitato</p></noscript>
            </div>
            <input type="hidden" wire:model="form.lat" />
            <input type="hidden" wire:model="form.lng" />
        </div>
        <div class="riepilogo-section bg-neutral-50 rounded p-4 border border-neutral-200">
            <h3>Riepilogo</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                <div><strong>Tipo:</strong> <span x-text="form.tipo || '—'"></span></div>
                <div><strong>Categoria:</strong> <span x-text="form.categoria || '—'"></span></div>
                <div class="md:col-span-2"><strong>Descrizione:</strong> <span x-text="form.descrizione || '—'"></span></div>
                <div><strong>Allegati:</strong> <span x-text="form.allegati || '—'"></span></div>
                <div><strong>Privacy:</strong> <span x-text="form.privacy ? 'Confermata' : 'Non confermata'"></span></div>
            </div>
            <div class="map-confirm mt-4 rounded overflow-hidden border border-neutral-300 shadow-sm flex items-center justify-center" id="map-confirm" aria-label="Conferma posizione danno" role="region"></div>
        </div>
        <button type="submit" class="w-full bg-primary-600 text-white py-3 rounded-md hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">Invia segnalazione</button>
    </form>
</div>
