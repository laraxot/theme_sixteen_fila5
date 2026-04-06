@props([
    'title' => 'Area Personale',
    'description' => 'Benvenuto nella tua area personale',
    'user' => [],
])

@php
    $user = array_merge([
        'nome' => '',
        'cognome' => '',
        'email' => '',
        'codice_fiscale' => '',
    ], $user);
@endphp

<div class="area-personale-section py-8">
    @if($title)
        <h2 class="text-2xl font-bold text-gray-900 mb-2" data-element="page-title">{{ $title }}</h2>
    @endif
    
    @if($description)
        <p class="text-gray-600 mb-8" data-element="page-description">{{ $description }}</p>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg border border-gray-200 p-6 text-center hover:shadow-md transition-shadow">
            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
            <div class="text-3xl font-bold text-gray-900 mb-1">3</div>
            <div class="text-sm text-gray-500">Appuntamenti</div>
        </div>

        <div class="bg-white rounded-lg border border-gray-200 p-6 text-center hover:shadow-md transition-shadow">
            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <div class="text-3xl font-bold text-gray-900 mb-1">5</div>
            <div class="text-sm text-gray-500">Richieste</div>
        </div>

        <div class="bg-white rounded-lg border border-gray-200 p-6 text-center hover:shadow-md transition-shadow">
            <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-3">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                </svg>
            </div>
            <div class="text-3xl font-bold text-gray-900 mb-1">8</div>
            <div class="text-sm text-gray-500">Pagamenti</div>
        </div>

        <div class="bg-white rounded-lg border border-gray-200 p-6 text-center hover:shadow-md transition-shadow">
            <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-3">
                <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <div class="text-3xl font-bold text-gray-900 mb-1">12</div>
            <div class="text-sm text-gray-500">Documenti</div>
        </div>
    </div>

    <div class="bg-white rounded-lg border border-gray-200 p-6 mb-8">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">I tuoi dati</h3>
        <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <dt class="text-sm text-gray-500">Nome</dt>
                <dd class="text-gray-900 font-medium" data-element="user-nome">{{ $user['nome'] ?: 'Mario' }}</dd>
            </div>
            <div>
                <dt class="text-sm text-gray-500">Cognito</dt>
                <dd class="text-gray-900 font-medium" data-element="user-cognome">{{ $user['cognome'] ?: 'Rossi' }}</dd>
            </div>
            <div>
                <dt class="text-sm text-gray-500">Email</dt>
                <dd class="text-gray-900 font-medium" data-element="user-email">{{ $user['email'] ?: 'mario.rossi@email.it' }}</dd>
            </div>
            <div>
                <dt class="text-sm text-gray-500">Codice Fiscale</dt>
                <dd class="text-gray-900 font-medium" data-element="user-cf">{{ $user['codice_fiscale'] ?: 'RSSMRA85T10A562B' }}</dd>
            </div>
        </dl>
        <div class="mt-4 pt-4 border-t border-gray-200">
            <a href="#" class="text-sm text-blue-600 hover:underline" data-element="edit-profile">Modifica profilo</a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Appuntamenti recenti</h3>
                <a href="#" class="text-sm text-blue-600 hover:underline">Vedi tutti</a>
            </div>
            <div class="space-y-4">
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div>
                        <div class="font-medium text-gray-900">Ufficio Anagrafe</div>
                        <div class="text-sm text-gray-500">15 Aprile 2025 - 09:00</div>
                    </div>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        Confermato
                    </span>
                </div>
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div>
                        <div class="font-medium text-gray-900">Ufficio Urbanistica</div>
                        <div class="text-sm text-gray-500">22 Maggio 2025 - 14:30</div>
                    </div>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                        In attesa
                    </span>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Ultimi pagamenti</h3>
                <a href="#" class="text-sm text-blue-600 hover:underline">Vedi tutti</a>
            </div>
            <div class="space-y-4">
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div>
                        <div class="font-medium text-gray-900">TARI 2025</div>
                        <div class="text-sm text-gray-500">6 Aprile 2026</div>
                    </div>
                    <div class="text-right">
                        <div class="font-medium text-gray-900">€ 150,00</div>
                        <span class="text-xs text-green-600">Completato</span>
                    </div>
                </div>
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div>
                        <div class="font-medium text-gray-900">Permesso Sosta</div>
                        <div class="text-sm text-gray-500">15 Marzo 2026</div>
                    </div>
                    <div class="text-right">
                        <div class="font-medium text-gray-900">€ 80,00</div>
                        <span class="text-xs text-green-600">Completato</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>