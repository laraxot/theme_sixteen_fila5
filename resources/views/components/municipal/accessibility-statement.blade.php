{{--
/**
 * Dichiarazione di Accessibilità Component - Bootstrap Italia Compliant
 * 
 * Componente per la dichiarazione di accessibilità obbligatoria per PA italiana
 * Conforme alle linee guida AGID e WCAG 2.1 AA
 * 
 * @param string $statementId ID unico della dichiarazione (default: auto-generated)
 * @param string $comuneName Nome del comune (default: config app.name)
 * @param string $lastUpdate Data ultimo aggiornamento (default: current date)
 * @param string $complianceLevel Livello conformità (default: 'Parzialmente conforme')
 * @param array $nonAccessibleContent Contenuti non accessibili
 * @param string $feedbackEmail Email per segnalazioni accessibilità
 * @param string $agidFormUrl URL modulo AGID per segnalazioni
 */
--}}

@props([
    'statementId' => 'accessibility-statement-' . uniqid(),
    'comuneName' => config('app.name', __('pub_theme::components_common.brand.municipality.label'),
    'lastUpdate' => now()->format('d/m/Y'),
    'complianceLevel' => __('pub_theme::components_municipal.accessibility.partially_compliant.label'),
    'nonAccessibleContent' => [
        __('pub_theme::components_municipal.accessibility.issue_pdf.label'),
        __('pub_theme::components_municipal.accessibility.issue_video.label'),
        __('pub_theme::components_municipal.accessibility.issue_maps.label')
    ],
    'feedbackEmail' => 'accessibilita@comune.example.it',
    'agidFormUrl' => 'https://form.agid.gov.it/view/xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx'
])

<section id="{{ $statementId }}" class="accessibility-statement bg-white rounded-lg shadow-md p-6 mb-6">
    <header class="mb-6">
        <h2 class="text-2xl font-bold text-primary-800 mb-2">{{ __('pub_theme::accessibility.page.title.text') }}</h2>
        <p class="text-gray-600">
            {{ __('pub_theme::components_municipal.accessibility.statement_intro.text', ['municipality' => $comuneName]) }}
        </p>
    </header>

    <div class="space-y-6">
        {{-- Sezione Conformità --}}
        <div class="border-l-4 border-blue-500 pl-4">
            <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ __('pub_theme::accessibility.status.title') }}</h3>
            <div class="bg-blue-50 p-4 rounded">
                <p class="text-blue-800 font-medium">
                    <span class="inline-flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        {{ __('pub_theme::components_municipal.accessibility.compliance_line.text', ['level' => $complianceLevel]) }}
                    </span>
                </p>
                <p class="text-blue-700 text-sm mt-2">
                    {{ __('pub_theme::components_municipal.accessibility.last_update.text', ['date' => $lastUpdate]) }}
                </p>
            </div>
        </div>

        {{-- Contenuti non accessibili --}}
        <div>
            <h3 class="text-lg font-semibold text-gray-900 mb-3">{{ __('pub_theme::accessibility.content.title') }}</h3>
            <div class="bg-yellow-50 p-4 rounded border border-yellow-200">
                <p class="text-yellow-800 mb-3">
                    {{ __('pub_theme::components_municipal.accessibility.non_accessible_intro.text') }}
                </p>
                <ul class="list-disc list-inside text-yellow-700 space-y-1">
                    @foreach($nonAccessibleContent as $content)
                    <li>{{ $content }}</li>
                    @endforeach
                </ul>
            </div>
        </div>

        {{-- Preparazione della dichiarazione --}}
        <div>
            <h3 class="text-lg font-semibold text-gray-900 mb-3">{{ __('pub_theme::components_municipal.accessibility.preparation.title') }}</h3>
            <div class="bg-gray-50 p-4 rounded">
                <p class="text-gray-700">
                    {{ __('pub_theme::components_municipal.accessibility.preparation_text.text', ['date' => $lastUpdate]) }}
                </p>
            </div>
        </div>

        {{-- Feedback e segnalazioni --}}
        <div>
            <h3 class="text-lg font-semibold text-gray-900 mb-3">{{ __('pub_theme::accessibility.feedback.title') }}</h3>
            <div class="bg-green-50 p-4 rounded border border-green-200">
                <p class="text-green-800 mb-3">
                    {{ __('pub_theme::components_municipal.accessibility.report_intro.text') }}
                </p>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- Email --}}
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-green-600 mr-3 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                        </svg>
                        <div>
                            <p class="font-medium text-gray-900">{{ __('pub_theme::components_common.form.email.label') }}</p>
                            <a href="mailto:{{ $feedbackEmail }}" class="text-green-700 hover:text-green-800">
                                {{ $feedbackEmail }}
                            </a>
                        </div>
                    </div>

                    {{-- Modulo AGID --}}
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-green-600 mr-3 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-2 0c0 .993-.241 1.929-.668 2.754l-1.524-1.525a3.997 3.997 0 00.078-2.183l1.562-1.562C15.802 8.249 16 9.1 16 10zm-5.165 3.913l1.58 1.58A5.98 5.98 0 0110 16a5.976 5.976 0 01-2.516-.552l1.562-1.562a4.006 4.006 0 001.789.027zm-4.677-2.796a4.002 4.002 0 01-.041-2.08l-.08.08-1.53-1.533A5.98 5.98 0 004 10c0 .954.223 1.856.619 2.657l1.54-1.54zm1.088-6.45A5.974 5.974 0 0110 4c.954 0 1.856.223 2.657.619l-1.54 1.54a4.002 4.002 0 00-2.346.033L7.246 4.668zM12 10a2 2 0 11-4 0 2 2 0 014 0z" clip-rule="evenodd" />
                        </svg>
                        <div>
                            <p class="font-medium text-gray-900">{{ __('pub_theme::components_municipal.accessibility.agid_form.label') }}</p>
                            <a href="{{ $agidFormUrl }}" 
                               target="_blank" 
                               rel="noopener noreferrer"
                               class="text-green-700 hover:text-green-800">
                                {{ __('pub_theme::components_municipal.accessibility.report_to_agid.label') }}
                            </a>
                        </div>
                    </div>
                </div>

                <p class="text-green-700 text-sm mt-4">
                    {{ __('pub_theme::components_municipal.accessibility.response_time.text') }}
                </p>
            </div>
        </div>

        {{-- Processo di miglioramento --}}
        <div>
            <h3 class="text-lg font-semibold text-gray-900 mb-3">{{ __('pub_theme::components_municipal.accessibility.improvement.title') }}</h3>
            <div class="bg-blue-50 p-4 rounded">
                <p class="text-blue-800">
                    {{ __('pub_theme::components_municipal.accessibility.improvement_text.text', ['municipality' => $comuneName]) }}
                </p>
            </div>
        </div>
    </div>

    {{-- Badge accessibilità --}}
    <footer class="mt-8 pt-6 border-t border-gray-200">
        <div class="flex items-center justify-center">
            <div class="bg-gray-100 px-4 py-2 rounded-full flex items-center">
                <svg class="w-6 h-6 text-blue-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <span class="text-sm font-medium text-gray-700">{{ __('pub_theme::components_municipal.accessibility.in_progress.label') }}</span>
            </div>
        </div>
    </footer>
</section>

{{-- Stili specifici --}}
@pushOnce('styles')
<style>
.accessibility-statement {
    max-width: 800px;
    margin: 0 auto;
}

.accessibility-statement h2,
.accessibility-statement h3 {
    scroll-margin-top: 100px;
}

.accessibility-statement a {
    text-decoration: underline;
}

.accessibility-statement a:hover {
    text-decoration: none;
}

@media (max-width: 768px) {
    .accessibility-statement {
        margin: 0 -1rem;
        border-radius: 0;
        padding: 1.5rem;
    }
}
</style>
@endPushOnce

{{--
Usage Examples:

1. Dichiarazione base:
<x-pub_theme::municipal.accessibility-statement />

2. Dichiarazione personalizzata:
<x-pub_theme::municipal.accessibility-statement 
    comuneName="Comune di Roma"
    complianceLevel="Totalmente conforme"
    feedbackEmail="accessibilita@comune.roma.it"
    :nonAccessibleContent="['Documenti PDF legacy']" />

3. Con URL AGID specifico:
<x-pub_theme::municipal.accessibility-statement 
    agidFormUrl="https://form.agid.gov.it/view/12345678-1234-1234-1234-123456789012" />
--}}