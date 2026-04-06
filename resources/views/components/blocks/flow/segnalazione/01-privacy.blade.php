@props([
    'title' => 'Informativa privacy',
    'description' => 'Leggi l\'informativa prima di procedere',
    'privacyText' => '',
])

@php
    if (empty($privacyText)) {
        $privacyText = 'I dati personali conferiti con il presente modulo saranno trattati dall\'Ente per le finalità connesse alla gestione della segnalazione. Il conferimento dei dati è obbligatorio per l\'instaurazione e la prosecuzione del rapporto contrattuale; in caso di mancato conferimento non sarà possibile dar corso alla richiesta. Titolare del trattamento è [Nome Ente]. Responsabile della protezione dei dati è [DPO]. I dati saranno conservati per il tempo necessario all\'esecuzione della richiesta e successivamente per gli adempimenti di legge. Gli interessati possono esercitare i diritti di accesso, rettifica, cancellazione, limitazione, opposizione e portabilità rivolgendosi al Titolare.';
    }
@endphp

<div class="step-content mt-8">
    @if($title)
        <h3 class="text-lg font-semibold text-gray-900 mb-4" data-element="step-title">{{ $title }}</h3>
    @endif

    <div class="bg-gray-50 rounded-lg p-6 mb-6">
        <div class="prose prose-sm max-w-none text-gray-600">
            <p>{{ $privacyText }}</p>
        </div>
    </div>

    <div class="space-y-4">
        <div class="flex items-start">
            <input 
                type="checkbox" 
                id="consenso_trattamento" 
                x-model="consensoTrattamento"
                class="mt-1 h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
            >
            <label for="consenso_trattamento" class="ml-2 text-sm text-gray-700">
                Acconsento al trattamento dei miei dati personali per le finalità indicate nell'informativa privacy <span class="text-red-500">*</span>
            </label>
        </div>

        <div class="flex items-start">
            <input 
                type="checkbox" 
                id="consenso_comunicazioni" 
                x-model="consensoComunicazioni"
                class="mt-1 h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
            >
            <label for="consenso_comunicazioni" class="ml-2 text-sm text-gray-700">
                Acconsento all'invio di comunicazioni relative alla segnalazione via email
            </label>
        </div>
    </div>

    <div class="mt-6 flex justify-end">
        <button 
            type="button"
            class="px-6 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed"
            :disabled="!consensoTrattamento"
            @click="currentStep++"
            data-element="step-next"
        >
            Continua
        </button>
    </div>
</div>