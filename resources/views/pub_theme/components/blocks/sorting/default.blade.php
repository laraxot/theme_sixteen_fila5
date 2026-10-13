<div class="sorting-container">
    <label for="sort-field" class="block text-sm font-medium text-neutral-700 mb-1">Ordina per</label>
    <select id="sort-field" x-model="sortField" @change="updateSorting()"
            class="w-full border-neutral-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 text-sm">
        <option value="data">Data</option>
        <option value="popolarita">Popolarità</option>
        <option value="data_asc">Data (ascendente)</option>
        <option value="data_desc">Data (discendente)</option>
    </select>
</div>

<script>
function sortingComponent() {
    return {
        sortField: 'data',
        updateSorting() {
            console.log('Sorting updated:', this.sortField);
        }
    };
}
</script>