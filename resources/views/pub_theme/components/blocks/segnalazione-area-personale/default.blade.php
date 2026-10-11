<div class="container py-4">
    <h2 class="mb-4">Area Personale - Segnalazioni</h2>

    <div class="accordion" x-data="{open: 1}">
        <div class="accordion-item border rounded mb-2">
            <h3 class="accordion-header" id="heading1">
                <button class="accordion-button {{ open === 1 ? '' : 'collapsed' }} w-100 text-start border-0 bg-transparent p-0 shadow-none"
                        x-on:click="open = 1" aria-expanded="true" aria-controls="collapse1">
                    Le mie Segnalazioni Inviate
                </button>
            </h3>
            <div id="collapse1" class="accordion-collapse collapse {{ open === 1 ? 'show' : '' }}"
                  x-show="open === 1" x-cloak>
                <div class="accordion-body pt-0">
                    <div class="list-item d-flex align-items-center py-3 border-bottom">
                        <div class="flex-grow-1">
                            <h4 class="mb-1">Segnalazione #1 - Problema di pulizia</h4>
                            <p class="text-muted small mb-0">Stato: <strong>In attesa di intervento</strong></p>
                        </div>
                        <button class="btn btn-sm btn-outline-primary ms-2">Dettagli</button>
                    </div>
                    <div class="list-item d-flex align-items-center py-3">
                        <div class="flex-grow-1">
                            <h4 class="mb-1">Segnalazione #2 - Lampione spento</h4>
                            <p class="text-muted small mb-0">Stato: <strong>Risolto</strong></p>
                        </div>
                        <button class="btn btn-sm btn-outline-primary ms-2">Dettagli</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="accordion-item border rounded mb-2">
            <h3 class="accordion-header" id="heading2">
                <button class="accordion-button collapsed w-100 text-start border-0 bg-transparent p-0 shadow-none"
                        x-on:click="open = 2" aria-expanded="false" aria-controls="collapse2">
                    I miei Dati
                </button>
            </h3>
            <div id="collapse2" class="accordion-collapse collapse"
                  x-show="open === 2" x-cloak>
                <div class="accordion-body pt-0">
                    <ul class="list-group">
                        <li class="list-group-item">Nome: Mario Rossi</li>
                        <li class="list-group-item">Email: mario.rossi@email.com</li>
                        <li class="list-group-item">Telefono: 123456789</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
