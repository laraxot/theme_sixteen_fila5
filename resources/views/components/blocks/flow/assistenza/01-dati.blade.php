@props([
    'title' => __('pub_theme::flow_appointment.riepilogo.personal_details.label'),
    'description' => __('pub_theme::flow_assistance.dati.enter_your_details_for_the_assistance.help'),
])

<div class="step-content mt-8">
    @if($title)
        <h3 class="text-lg font-semibold text-gray-900 mb-4" data-element="step-title">{{ $title }}</h3>
    @endif
    
    @if($description)
        <p class="text-gray-600 mb-6" data-element="step-description">{{ $description }}</p>
    @endif

    <div class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="nome" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ __('pub_theme::blocks_common.shared.name.label') }} <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    id="nome" 
                    name="nome"
                    x-model="nome"
                    required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    data-element="nome-input"
                >
            </div>
            <div>
                <label for="cognome" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ __('pub_theme::blocks_common.shared.surname.label') }} <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    id="cognome" 
                    name="cognome"
                    x-model="cognome"
                    required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    data-element="cognome-input"
                >
            </div>
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                {{ __('pub_theme::blocks_common.shared.email.label') }} <span class="text-red-500">*</span>
            </label>
            <input 
                type="email" 
                id="email" 
                name="email"
                x-model="email"
                required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                data-element="email-input"
            >
        </div>

        <div>
            <label for="telefono" class="block text-sm font-medium text-gray-700 mb-2">
                {{ __('pub_theme::blocks_common.shared.phone.label') }}
            </label>
            <input 
                type="tel" 
                id="telefono" 
                name="telefono"
                x-model="telefono"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                data-element="telefono-input"
            >
        </div>
    </div>

    <div class="mt-6 flex justify-end">
        <button 
            type="button"
            class="px-6 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed"
            :disabled="!nome || !cognome || !email"
            @click="currentStep++"
            data-element="step-next"
        >
            {{ __('pub_theme::blocks_common.shared.continue.label') }}
        </button>
    </div>
</div>