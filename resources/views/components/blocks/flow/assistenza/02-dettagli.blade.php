@props([
    'title' => __('pub_theme::flow_assistance.riepilogo.request_details.label'),
    'description' => __('pub_theme::flow_assistance.dettagli.describe_the_problem_you_need_help.help'),
    'tipi_richiesta' => [],
])

@php
    $tipi_richiesta = collect($tipi_richiesta)->map(function ($tipo) {
        if (is_string($tipo)) {
            return ['id' => $tipo, 'name' => $tipo];
        }
        return $tipo;
    });
    
    if ($tipi_richiesta->isEmpty()) {
        $tipi_richiesta = collect([
            ['id' => 'supporto-tecnico', 'name' => __('pub_theme::flow_assistance.dettagli.technical_support.label')],
            ['id' => 'info-servizio', 'name' => __('pub_theme::flow_assistance.dettagli.information_about_a_service.label')],
            ['id' => 'segnalazione-problema', 'name' => __('pub_theme::flow_assistance.dettagli.problem_report.label')],
            ['id' => 'richiesta-informazione', 'name' => __('pub_theme::flow_assistance.dettagli.information_request.label')],
            ['id' => 'altro', 'name' => __('pub_theme::blocks_content.feedback_section.other.label')],
        ]);
    }
@endphp

<div class="step-content mt-8">
    @if($title)
        <h3 class="text-lg font-semibold text-gray-900 mb-4" data-element="step-title">{{ $title }}</h3>
    @endif
    
    @if($description)
        <p class="text-gray-600 mb-6" data-element="step-description">{{ $description }}</p>
    @endif

    <div class="space-y-6">
        <div>
            <label for="tipo_richiesta" class="block text-sm font-medium text-gray-700 mb-2">
                {{ __('pub_theme::flow_assistance.shared.request_type.label') }} <span class="text-red-500">*</span>
            </label>
            <select 
                id="tipo_richiesta" 
                name="tipo_richiesta"
                x-model="tipoRichiesta"
                required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                data-element="tipo-select"
            >
                <option value="">{{ __('pub_theme::flow_assistance.dettagli.select_a_type.label') }}</option>
                @foreach($tipi_richiesta as $tipo)
                    <option value="{{ $tipo['id'] }}">{{ $tipo['name'] }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="oggetto" class="block text-sm font-medium text-gray-700 mb-2">
                {{ __('pub_theme::flow_assistance.shared.subject.label') }} <span class="text-red-500">*</span>
            </label>
            <input 
                type="text" 
                id="oggetto" 
                name="oggetto"
                x-model="oggetto"
                required
                maxlength="150"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                placeholder="{{ __('pub_theme::flow_assistance.dettagli.subject_of_your_request.placeholder') }}"
                data-element="oggetto-input"
            >
        </div>

        <div>
            <label for="messaggio" class="block text-sm font-medium text-gray-700 mb-2">
                {{ __('pub_theme::flow_assistance.shared.message.label') }} <span class="text-red-500">*</span>
            </label>
            <textarea 
                id="messaggio" 
                name="messaggio"
                x-model="messaggio"
                required
                rows="6"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                placeholder="{{ __('pub_theme::flow_assistance.dettagli.describe_your_problem_or_request_in.placeholder') }}"
                data-element="messaggio-textarea"
            ></textarea>
            <p class="mt-1 text-xs text-gray-500">{{ __('pub_theme::flow_assistance.dettagli.minimum_20_characters.label') }}</p>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
                {{ __('pub_theme::flow_assistance.dettagli.attach_documents_optional.label') }}
            </label>
            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-400 cursor-pointer transition-colors">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <p class="mt-2 text-sm text-gray-600">
                    <span class="font-medium text-blue-600">{{ __('pub_theme::blocks_common.shared.click_to_upload.label') }}</span> {{ __('pub_theme::blocks_common.shared.or_drag_files.label') }}
                </p>
                <p class="mt-1 text-xs text-gray-500">{{ __('pub_theme::flow_assistance.dettagli.pdf_doc_docx_up_to_10mb.label') }}</p>
            </div>
        </div>
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
            :disabled="!tipoRichiesta || !oggetto || !messaggio || messaggio.length < 20"
            @click="currentStep++"
            data-element="step-next"
        >
            {{ __('pub_theme::blocks_common.shared.continue.label') }}
        </button>
    </div>
</div>