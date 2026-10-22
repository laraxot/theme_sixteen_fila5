@props(['current' => ''])
{{-- Briciole di pane delle pagine area personale (DCP-111): Home / pagina corrente. Etichette dal file lang del modulo Fixcity. --}}
<div class="cmp-breadcrumbs">
    <nav class="breadcrumb-container" aria-label="{{ __('fixcity::personal_area_settings.breadcrumb.label') }}">
        <ol class="breadcrumb p-0" data-element="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('fixcity::personal_area_settings.breadcrumb.home') }}</a><span class="separator">/</span></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $current }}</li>
        </ol>
    </nav>
</div>
