<div class="filters-container" x-data="filtersComponent()">
    <div class="filters-header flex items-center justify-between mb-4">
        <h3 class="text-lg font-semibold text-neutral-900">Filtri</h3>
        <button @click="resetFilters()" class="text-sm text-primary-600 hover:text-primary-700">Azzera filtri</button>
    </div>

    <div class="filter-group mb-6">
        <label class="block text-sm font-medium text-neutral-700 mb-2">Tipo</label>
        <div class="space-y-2">
            <template x-for="option in filters.type.options" :key="option.value">
                <label class="flex items-center">
                    <input type="radio" :name="'tipo'" :value="option.value"
                           x-model="filters.type.value"
                           class="mr-2 text-primary-600 focus:ring-primary-500" />
                    <span class="text-sm text-neutral-700" x-text="option.label"></span>
                </label>
            </template>
        </div>
    </div>

    <div class="filter-group mb-6">
        <label class="block text-sm font-medium text-neutral-700 mb-2">Data</label>
        <div class="space-y-2">
            <template x-for="option in filters.data.options" :key="option.value">
                <label class="flex items-center">
                    <input type="radio" :name="'data'" :value="option.value"
                           x-model="filters.data.value"
                           class="mr-2 text-primary-600 focus:ring-primary-500" />
                    <span class="text-sm text-neutral-700" x-text="option.label"></span>
                </label>
            </template>
        </div>
    </div>

    <div class="filter-group mb-6">
        <label class="block text-sm font-medium text-neutral-700 mb-2">Popolarità</label>
        <div class="space-y-2">
            <template x-for="option in filters.popolarita.options" :key="option.value">
                <label class="flex items-center">
                    <input type="radio" :name="'popolarita'" :value="option.value"
                           x-model="filters.popolarita.value"
                           class="mr-2 text-primary-600 focus:ring-primary-500" />
                    <span class="text-sm text-neutral-700" x-text="option.label"></span>
                </label>
            </template>
        </div>
    </div>

    <button @click="applyFilters()"
            class="w-full bg-primary-600 text-white py-2 px-4 rounded-md hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">
        Applica filtri
    </button>
</div>

<script>
function filtersComponent() {
    return {
        filters: {
            type: {
                value: 'all',
                options: [
                    { value: 'all', label: 'Tutti' },
                    { value: 'service', label: 'Servizi' },
                    { value: 'map', label: 'Mappe' },
                    { value: 'normative', label: 'Normative' },
                    { value: 'prenotazione', label: 'Prenotazioni' },
                    { value: 'contatti', label: 'Contatti' }
                ]
            },
            data: {
                value: 'tutto',
                options: [
                    { value: 'tutto', label: 'Tutto' },
                    { value: 'ultimi_7_giorni', label: 'Ultimi 7 giorni' },
                    { value: 'ultimo_mese', label: 'Ultimo mese' },
                    { value: 'ultimo_anno', label: 'Ultimo anno' }
                ]
            },
            popolarita: {
                value: 'data',
                options: [
                    { value: 'data', label: 'Data' },
                    { value: 'piu_popolare', label: 'Più popolare' },
                    { value: 'meno_popolare', label: 'Meno popolare' }
                ]
            }
        },
        resetFilters() {
            this.filters.type.value = 'all';
            this.filters.data.value = 'tutto';
            this.filters.popolarita.value = 'data';
        },
        applyFilters() {
            // Apply filters logic
            console.log('Filters applied:', this.filters);
        }
    };
}
</script>