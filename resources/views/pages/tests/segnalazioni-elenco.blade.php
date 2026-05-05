@extends('pub_theme::layouts.app')

@section('title', __('fixcity::segnalazione.page.title.label'))

@section('content')
    <div class="container mx-auto py-6">
        <h1 class="text-2xl font-semibold mb-4">
            {{ __('fixcity::segnalazione.page.title.label') }}
        </h1>
        {{-- Lit map component – displays the segnalazioni elenco map --}}
        <map-lit data-url="{{ asset('data/tickets.json') }}" class="w-full"></map-lit>
    </div>
@endsection