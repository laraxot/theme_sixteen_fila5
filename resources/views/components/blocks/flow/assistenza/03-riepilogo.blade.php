@props([
    'title' => __('pub_theme::flow_assistance.riepilogo.request_summary.title'),
    'richiesta' => [],
])

@php
    $richiesta = array_merge([
        'nome' => '',
        'cognome' => '',
        'email' => '',
        'telefono' => '',
        'tipo_richiesta' => '',
        'oggetto' => '',
        'messaggio' => '',
    ], $richiesta);
@endphp

<div class="step-content mt-8">
    @if($title)
        <h3 class="text-lg font-semibold text-gray-900 mb-4" data-element="step-title">{{ $title }}</h3>
    @endif

    <div class="bg-gray-50 rounded-lg p-6 mb-6">
        <h4 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-4">{{ __('pub_theme::flow_assistance.riepilogo.applicant_details.label') }}</h4>
        
        <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <dt class="text-sm text-gray-500">{{ __('pub_theme::blocks_common.shared.name.label') }}</dt>
                <dd class="text-gray-900 font-medium" data-element="summary-nome">{{ $richiesta['nome'] ?: 'Mario' }}</dd>
            </div>
            <div>
                <dt class="text-sm text-gray-500">{{ __('pub_theme::blocks_common.shared.surname.label') }}</dt>
                <dd class="text-gray-900 font-medium" data-element="summary-cognome">{{ $richiesta['cognome'] ?: 'Rossi' }}</dd>
            </div>
            <div>
                <dt class="text-sm text-gray-500">{{ __('pub_theme::blocks_common.shared.email.label') }}</dt>
                <dd class="text-gray-900 font-medium" data-element="summary-email">{{ $richiesta['email'] ?: 'mario.rossi@email.it' }}</dd>
            </div>
            @if(!empty($richiesta['telefono']))
            <div>
                <dt class="text-sm text-gray-500">{{ __('pub_theme::blocks_common.shared.phone.label') }}</dt>
                <dd class="text-gray-900 font-medium" data-element="summary-telefono">{{ $richiesta['telefono'] }}</dd>
            </div>
            @endif
        </dl>
    </div>

    <div class="bg-gray-50 rounded-lg p-6 mb-6">
        <h4 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-4">{{ __('pub_theme::flow_assistance.riepilogo.request_details.label') }}</h4>
        
        <dl class="space-y-4">
            <div>
                <dt class="text-sm text-gray-500">{{ __('pub_theme::flow_assistance.shared.request_type.label') }}</dt>
                <dd class="text-gray-900 font-medium" data-element="summary-tipo">{{ $richiesta['tipo_richiesta'] ?: 'Supporto tecnico' }}</dd>
            </div>
            <div>
                <dt class="text-sm text-gray-500">{{ __('pub_theme::flow_assistance.shared.subject.label') }}</dt>
                <dd class="text-gray-900 font-medium" data-element="summary-oggetto">{{ $richiesta['oggetto'] ?: 'Problema con il portale' }}</dd>
            </div>
            <div>
                <dt class="text-sm text-gray-500">{{ __('pub_theme::flow_assistance.shared.message.label') }}</dt>
                <dd class="text-gray-900" data-element="summary-messaggio">{{ $richiesta['messaggio'] ?: 'Non riesco ad accedere alla sezione dedicata ai pagamenti. Ricevo un errore di autenticazione.' }}</dd>
            </div>
        </dl>
    </div>

    <div class="flex items-start mb-6">
        <input 
            type="checkbox" 
            id="accetto_privacy" 
            x-model="accettoPrivacy"
            class="mt-1 h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
        >
        <label for="accetto_privacy" class="ml-2 text-sm text-gray-700">
            {!! __('pub_theme::flow_assistance.summary.consent_privacy_terms.message', ['privacy' => '<a href="#" class="text-blue-600 hover:underline">'.e(__('pub_theme::blocks_common.shared.privacy_policy.label')).'</a>', 'terms' => '<a href="#" class="text-blue-600 hover:underline">'.e(__('pub_theme::blocks_common.shared.terms_of_service.label')).'</a>']) !!}
        </label>
    </div>

    <div class="mt-6 flex justify-between">
        <button 
            type="button"
            class="px-6 py-2 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2"
            @click="currentStep--"
            data-element="step-prev"
        >
            {{ __('pub_theme::blocks_common.shared.back.label') }}
        </button>
        <button 
            type="button"
            class="px-6 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
            :disabled="!accettoPrivacy"
            @click="currentStep++"
            data-element="step-next"
        >
            {{ __('pub_theme::blocks_common.shared.submit_request.label') }}
        </button>
    </div>
</div>