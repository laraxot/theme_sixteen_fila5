@props([
    'title' => __('pub_theme::flow_appointment.riepilogo.appointment_summary.title'),
    'appointment' => [],
])

@php
    $appointment = array_merge([
        'office' => '',
        'date' => '',
        'time' => '',
        'motivo' => '',
        'note' => '',
        'nome' => '',
        'cognome' => '',
        'codice_fiscale' => '',
        'email' => '',
        'telefono' => '',
    ], $appointment);
@endphp

<div class="step-content mt-8">
    @if($title)
        <h3 class="text-lg font-semibold text-gray-900 mb-4" data-element="step-title">{{ $title }}</h3>
    @endif

    <div class="bg-gray-50 rounded-lg p-6 mb-6">
        <h4 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-4">{{ __('pub_theme::flow_appointment.riepilogo.appointment_details.label') }}</h4>
        
        <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <dt class="text-sm text-gray-500">{{ __('pub_theme::flow_appointment.shared.office.label') }}</dt>
                <dd class="text-gray-900 font-medium" data-element="summary-office">{{ $appointment['office'] ?: 'Ufficio Anagrafe' }}</dd>
            </div>
            <div>
                <dt class="text-sm text-gray-500">{{ __('pub_theme::blocks_common.shared.date.label') }}</dt>
                <dd class="text-gray-900 font-medium" data-element="summary-date">{{ $appointment['date'] ?: '15 Aprile 2025' }}</dd>
            </div>
            <div>
                <dt class="text-sm text-gray-500">{{ __('pub_theme::flow_appointment.shared.time.label') }}</dt>
                <dd class="text-gray-900 font-medium" data-element="summary-time">{{ $appointment['time'] ?: '09:00' }}</dd>
            </div>
            <div>
                <dt class="text-sm text-gray-500">{{ __('pub_theme::flow_appointment.shared.reason.label') }}</dt>
                <dd class="text-gray-900 font-medium" data-element="summary-motivo">{{ $appointment['motivo'] ?: 'Informazioni generali' }}</dd>
            </div>
            @if(!empty($appointment['note']))
            <div class="md:col-span-2">
                <dt class="text-sm text-gray-500">{{ __('pub_theme::flow_appointment.riepilogo.notes.label') }}</dt>
                <dd class="text-gray-900" data-element="summary-note">{{ $appointment['note'] }}</dd>
            </div>
            @endif
        </dl>
    </div>

    <div class="bg-gray-50 rounded-lg p-6 mb-6">
        <h4 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-4">{{ __('pub_theme::flow_appointment.riepilogo.personal_details.label') }}</h4>
        
        <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <dt class="text-sm text-gray-500">{{ __('pub_theme::blocks_common.shared.name.label') }}</dt>
                <dd class="text-gray-900 font-medium" data-element="summary-nome">{{ $appointment['nome'] ?: 'Mario' }}</dd>
            </div>
            <div>
                <dt class="text-sm text-gray-500">{{ __('pub_theme::blocks_common.shared.surname.label') }}</dt>
                <dd class="text-gray-900 font-medium" data-element="summary-cognome">{{ $appointment['cognome'] ?: 'Rossi' }}</dd>
            </div>
            <div>
                <dt class="text-sm text-gray-500">{{ __('pub_theme::blocks_common.shared.tax_code.label') }}</dt>
                <dd class="text-gray-900 font-medium" data-element="summary-cf">{{ $appointment['codice_fiscale'] ?: 'RSSMRA85T10A562B' }}</dd>
            </div>
            <div>
                <dt class="text-sm text-gray-500">{{ __('pub_theme::blocks_common.shared.email.label') }}</dt>
                <dd class="text-gray-900 font-medium" data-element="summary-email">{{ $appointment['email'] ?: 'mario.rossi@email.it' }}</dd>
            </div>
            <div>
                <dt class="text-sm text-gray-500">{{ __('pub_theme::blocks_common.shared.phone.label') }}</dt>
                <dd class="text-gray-900 font-medium" data-element="summary-telefono">{{ $appointment['telefono'] ?: '333 1234567' }}</dd>
            </div>
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
            {!! __('pub_theme::flow_appointment.summary.consent_terms_privacy.message', ['terms' => '<a href="#" class="text-blue-600 hover:underline">'.e(__('pub_theme::blocks_common.shared.terms_of_service.label')).'</a>', 'privacy' => '<a href="#" class="text-blue-600 hover:underline">'.e(__('pub_theme::blocks_common.shared.privacy_policy.label')).'</a>']) !!}
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
            :disabled="!accettoTermini"
            @click="currentStep++"
            data-element="step-next"
        >
            {{ __('pub_theme::flow_appointment.riepilogo.confirm_appointment.label') }}
        </button>
    </div>
</div>