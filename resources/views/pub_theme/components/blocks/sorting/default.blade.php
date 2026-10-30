<div class="sorting-container">
    <label for="sort-field" class="block text-sm font-medium text-neutral-700 mb-1">{{ __('pub_theme::listing_blocks.sorting.sort_by.label') }}</label>
    <select id="sort-field" x-model="sortField" @change="updateSorting()"
            class="w-full border-neutral-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 text-sm">
        <option value="data">{{ __('pub_theme::listing_blocks.sorting.date.label') }}</option>
        <option value="popolarita">{{ __('pub_theme::listing_blocks.sorting.popularity.label') }}</option>
        <option value="data_asc">{{ __('pub_theme::listing_blocks.sorting.date_asc.label') }}</option>
        <option value="data_desc">{{ __('pub_theme::listing_blocks.sorting.date_desc.label') }}</option>
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