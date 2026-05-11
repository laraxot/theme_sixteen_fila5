@extends('pub_theme::layouts.app')

@section('title', __('fixcity::segnalazione.page.title.label'))

@section('content')
    <div class="container mx-auto py-6">
        <h1 class="text-2xl font-semibold mb-4">
            {{ __('fixcity::segnalazione.page.title.label') }}
        </h1>
        {{-- Lit map component: Sixteen registers map-lit in the app bundle (canonical SSoT, see memory feedback_map_lit_canonical_name). --}}
        @include('pub_theme::components.sections.map-lit')
    </div>
@endsection
