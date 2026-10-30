@props([
    'title' => __('pub_theme::flow_report.shared.report_details.title'),
    'description' => __('pub_theme::flow_report.dati.describe_the_service_issue_you_encountered.label'),
    'categorie' => [],
])

@php
    $categorie = collect($categorie)->map(function ($cat) {
        if (is_string($cat)) {
            return ['id' => $cat, 'name' => $cat];
        }
        return $cat;
    });
    
    if ($categorie->isEmpty()) {
        $categorie = collect([
            ['id' => 'illuminazione', 'name' => __('pub_theme::flow_report.shared.public_lighting.label')],
            ['id' => 'strade', 'name' => __('pub_theme::flow_report.shared.roads_and_pavements.label')],
            ['id' => 'verde', 'name' => __('pub_theme::flow_report.shared.public_green_spaces.label')],
            ['id' => 'rifiuti', 'name' => __('pub_theme::flow_report.shared.waste_and_cleaning.label')],
            ['id' => 'trasporti', 'name' => __('pub_theme::flow_report.shared.public_transport.label')],
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
            <label for="categoria" class="block text-sm font-medium text-gray-700 mb-2">
                {{ __('pub_theme::flow_report.shared.category.label') }} <span class="text-red-500">*</span>
            </label>
            <select 
                id="categoria" 
                name="categoria"
                x-model="categoria"
                required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                data-element="categoria-select"
            >
                <option value="">{{ __('pub_theme::flow_report.shared.select_a_category.label') }}</option>
                @foreach($categorie as $cat)
                    <option value="{{ $cat['id'] }}">{{ $cat['name'] }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="titolo" class="block text-sm font-medium text-gray-700 mb-2">
                {{ __('pub_theme::flow_report.shared.report_title.label') }} <span class="text-red-500">*</span>
            </label>
            <input 
                type="text" 
                id="titolo" 
                name="titolo"
                x-model="titolo"
                required
                maxlength="100"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                placeholder="{{ __('pub_theme::flow_report.shared.brief_description_of_the_problem.placeholder') }}"
                data-element="titolo-input"
            >
            <p class="mt-1 text-xs text-gray-500">{{ __('pub_theme::flow_report.shared.max_100_characters.label') }}</p>
        </div>

        <div>
            <label for="descrizione" class="block text-sm font-medium text-gray-700 mb-2">
                {{ __('pub_theme::flow_report.shared.detailed_description.label') }} <span class="text-red-500">*</span>
            </label>
            <textarea 
                id="descrizione" 
                name="descrizione"
                x-model="descrizione"
                required
                rows="5"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                placeholder="{{ __('pub_theme::flow_report.shared.describe_the_problem_you_encountered_in.placeholder') }}"
                data-element="descrizione-textarea"
            ></textarea>
        </div>

        <div>
            <label for="luogo" class="block text-sm font-medium text-gray-700 mb-2">
                {{ __('pub_theme::flow_report.shared.place_of_the_service_issue.label') }}
            </label>
            <input 
                type="text" 
                id="luogo" 
                name="luogo"
                x-model="luogo"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                placeholder="{{ __('pub_theme::flow_report.shared.address_or_description_of_the_place.placeholder') }}"
                data-element="luogo-input"
            >
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
                {{ __('pub_theme::flow_report.shared.attach_photos_optional.label') }}
            </label>
            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-400 cursor-pointer transition-colors">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <p class="mt-2 text-sm text-gray-600">
                    <span class="font-medium text-blue-600">{{ __('pub_theme::blocks_common.shared.click_to_upload.label') }}</span> {{ __('pub_theme::blocks_common.shared.or_drag_files.label') }}
                </p>
                <p class="mt-1 text-xs text-gray-500">{{ __('pub_theme::flow_report.shared.png_jpg_up_to_10mb.label') }}</p>
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
            :disabled="!categoria || !titolo || !descrizione"
            @click="currentStep++"
            data-element="step-next"
        >
            {{ __('pub_theme::blocks_common.shared.continue.label') }}
        </button>
    </div>
</div>