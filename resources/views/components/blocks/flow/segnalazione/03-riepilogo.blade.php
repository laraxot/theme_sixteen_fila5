@props([
    'title' => 'Riepilogo segnalazione',
    'segnalazione' => [],
])

@php
    $segnalazione = array_merge([
        'nome' => '',
        'cognome' => '',
        'email' => '',
        'telefono' => '',
        'indirizzo' => '',
        'categoria' => '',
        'titolo' => '',
        'descrizione' => '',
        'luogo' => '',
    ], $segnalazione);
@endphp

<div class="step-content mt-8">
    @if($title)
        <h3 class="text-lg font-semibold text-gray-900 mb-4" data-element="step-title">{{ $title }}</h3>
    @endif

    <div class="bg-gray-50 rounded-lg p-6 mb-6">
        <h4 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-4">Dati segnalatore</h4>
        
        <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <dt class="text-sm text-gray-500">Nome</dt>
                <dd class="text-gray-900 font-medium" data-element="summary-nome">{{ $segnalazione['nome'] ?: 'Mario' }}</dd>
            </div>
            <div>
                <dt class="text-sm text-gray-500">Cognome</dt>
                <dd class="text-gray-900 font-medium" data-element="summary-cognome">{{ $segnalazione['cognome'] ?: 'Rossi' }}</dd>
            </div>
            <div>
                <dt class="text-sm text-gray-500">Email</dt>
                <dd class="text-gray-900 font-medium" data-element="summary-email">{{ $segnalazione['email'] ?: 'mario.rossi@email.it' }}</dd>
            </div>
            @if(!empty($segnalazione['telefono']))
            <div>
                <dt class="text-sm text-gray-500">Telefono</dt>
                <dd class="text-gray-900 font-medium" data-element="summary-telefono">{{ $segnalazione['telefono'] }}</dd>
            </div>
            @endif
            @if(!empty($segnalazione['indirizzo']))
            <div class="md:col-span-2">
                <dt class="text-sm text-gray-500">Indirizzo</dt>
                <dd class="text-gray-900" data-element="summary-indirizzo">{{ $segnalazione['indirizzo'] }}</dd>
            </div>
            @endif
        </dl>
    </div>

    <div class="bg-gray-50 rounded-lg p-6 mb-6">
        <h4 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-4">Dettagli segnalazione</h4>
        
        <dl class="space-y-4">
            <div>
                <dt class="text-sm text-gray-500">Categoria</dt>
                <dd class="text-gray-900 font-medium" data-element="summary-categoria">{{ $segnalazione['categoria'] ?: 'Illuminazione pubblica' }}</dd>
            </div>
            <div>
                <dt class="text-sm text-gray-500">Titolo</dt>
                <dd class="text-gray-900 font-medium" data-element="summary-titolo">{{ $segnalazione['titolo'] ?: 'Lampione spento in via Roma' }}</dd>
            </div>
            <div>
                <dt class="text-sm text-gray-500">Descrizione</dt>
                <dd class="text-gray-900" data-element="summary-descrizione">{{ $segnalazione['descrizione'] ?: 'Il lampione all\'incrocio con via Milano è spento da diversi giorni, rendendo pericolosa la circolazione pedonale serale.' }}</dd>
            </div>
            @if(!empty($segnalazione['luogo']))
            <div>
                <dt class="text-sm text-gray-500">Luogo</dt>
                <dd class="text-gray-900" data-element="summary-luogo">{{ $segnalazione['luogo'] }}</dd>
            </div>
            @endif
        </dl>
    </div>

    <div class="flex items-start mb-6">
        <input 
            type="checkbox" 
            id="accetto_termini" 
            x-model="accettoTermini"
            class="mt-1 h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
        >
        <label for="accetto_termini" class="ml-2 text-sm text-gray-700">
            Confermo che le informazioni fornite sono veritiere e accetto le <a href="#" class="text-blue-600 hover:underline">condizioni di servizio</a>
        </label>
    </div>

    <div class="mt-6 flex justify-between">
        <button 
            type="button"
            class="px-6 py-2 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2"
            @click="currentStep--"
            data-element="step-prev"
        >
            Indietro
        </button>
        <button 
            type="button"
            class="px-6 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
            :disabled="!accettoTermini"
            @click="currentStep++"
            data-element="step-next"
        >
            Invia segnalazione
        </button>
    </div>
</div>