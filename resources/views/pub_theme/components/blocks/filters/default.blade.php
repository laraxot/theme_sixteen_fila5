<div class="filters-container" x-data="filtersComponent()">
    <div class="filters-header flex items-center justify-between mb-4">
        <h3 class="text-lg font-semibold text-neutral-700 mb-2">{{ __('pub_theme::listing_blocks.filters.title.title') }}</h3>
        <button @click="resetFilters()" class="text-sm text-primary-600 hover:text-primary-700">{{ __('pub_theme::listing_blocks.filters.reset.label') }}</button>
    </div>

    <div class="filter-group mb-6">
        <label class="block text-sm font-medium text-neutral-700 mb-2">{{ __('pub_theme::listing_blocks.filters.type.label') }}</label>
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

        <!-- Add the search button here -->
  <div class="search-container mb-6">
    <form @submit.prevent="applySearch()" class="flex gap-2">
      <input type="text" name="query" x-model="searchTerm" class="flex-1 px-4 py-2 border border-neutral-300 rounded-md focus:ring-primary-500 focus:ring-offset-2 md:w-72 lg:w-96" placeholder="{{ __('pub_theme::listing_blocks.common.search.placeholder') }}" />
      <button type="submit" class="bg-primary-600 text-white py-2 px-4 rounded-md hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 whitespace-nowrap">{{ __('pub_theme::listing_blocks.common.search.label') }}</button>
    </form>
  </div>
