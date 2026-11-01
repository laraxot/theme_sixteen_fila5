{{-- <nome progetto> Homepage Component --}}
@props([
    'side' => 'content', 
    'slug' => '',
    'page' => null
])

<div class="min-h-screen bg-gray-100">
    {{-- Header --}}
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-900">
                <nome progetto>
            </h1>
        </div>
    </header>

    {{-- Main Content --}}
    <main>
        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="px-4 py-6 sm:px-0">
                <div class="border-4 border-dashed border-gray-200 rounded-lg p-8">
                    <div class="text-center">
                        <h2 class="text-2xl font-semibold text-gray-900 mb-4">
                            {{ __('pub_theme::components_project_home.hero.welcome.title') }} <nome progetto>
                        </h2>
                        <p class="text-gray-600 mb-8">
                            {{ __('pub_theme::components_project_home.hero.subtitle.description') }}
                        </p>
                        
                        {{-- Quick Actions --}}
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="bg-blue-50 p-6 rounded-lg">
                                <h3 class="text-lg font-semibold text-blue-900 mb-2">{{ __('pub_theme::components_project_home.quick_actions.employees.title') }}</h3>
                                <p class="text-blue-700 mb-4">{{ __('pub_theme::components_project_home.quick_actions.employees.description') }}</p>
                                <a href="/employee/admin" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                                    {{ __('pub_theme::blocks_common.shared.log_in.label') }}
                                </a>
                            </div>
                            
                            <div class="bg-green-50 p-6 rounded-lg">
                                <h3 class="text-lg font-semibold text-green-900 mb-2">{{ __('pub_theme::components_project_home.quick_actions.admin.title') }}</h3>
                                <p class="text-green-700 mb-4">{{ __('pub_theme::components_project_home.quick_actions.admin.description') }}</p>
                                <a href="/admin" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
                                    {{ __('pub_theme::blocks_common.shared.log_in.label') }}
                                </a>
                            </div>
                            
                            <div class="bg-purple-50 p-6 rounded-lg">
                                <h3 class="text-lg font-semibold text-purple-900 mb-2">{{ __('pub_theme::components_project_home.quick_actions.charts.title') }}</h3>
                                <p class="text-purple-700 mb-4">{{ __('pub_theme::components_project_home.quick_actions.charts.description') }}</p>
                                <a href="/chart/admin" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700 transition">
                                    {{ __('pub_theme::blocks_common.shared.log_in.label') }}
                                </a>
                            </div>
                        </div>

                        {{-- System Info --}}
                        <div class="mt-8 text-sm text-gray-500">
                            <p>Tema: {{ config('app.name', '<nome progetto>') }} | Versione: {{ app()->version() }}</p>
                            <p>Lingua: {{ app()->getLocale() }} | Ambiente: {{ app()->environment() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
