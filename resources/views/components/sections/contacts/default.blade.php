@props(['data' => []])

@php
    $title = $data['title'] ?? '';
    $phoneLabel = $data['phone_label'] ?? 'Telefono';
    $phoneValue = $data['phone_value'] ?? '';
    $emailLabel = $data['email_label'] ?? 'Email';
    $emailValue = $data['email_value'] ?? '';
    $addressLabel = $data['address_label'] ?? 'Indirizzo';
    $addressValue = $data['address_value'] ?? '';
    $openingHours = $data['opening_hours'] ?? [];
@endphp

@if($phoneValue || $emailValue || $addressValue || $openingHours)
    <section class="my-12">
        @if($title)
            <h2 class="mb-6 text-2xl font-bold text-slate-900 dark:text-white">
                {{ $title }}
            </h2>
        @endif
        <div class="grid grid-cols-1 gap-8 text-base">
            @if($phoneValue)
                <div>
                    <span class="font-semibold text-slate-700 dark:text-slate-300">{{ $phoneLabel }}:</span>
                    <span class="text-sky-700 dark:text-sky-400">{{ $phoneValue }}</span>
                </div>
            @endif
            @if($emailValue)
                <div>
                    <span class="font-semibold text-slate-700 dark:text-slate-300">{{ $emailLabel }}:</span>
                    <a href="mailto:{{ $emailValue }}" class="text-sky-700 dark:text-sky-400 hover:underline">
                        {{ $emailValue }}
                    </a>
                </div>
            @endif
            @if($addressValue)
                <div>
                    <span class="font-semibold text-slate-700 dark:text-slate-300">{{ $addressLabel }}:</span>
                    <span class="text-slate-600 dark:text-slate-400">{{ $addressValue }}</span>
                </div>
            @endif
            @if($openingHours)
                <div>
                    <span class="font-semibold text-slate-700 dark:text-slate-300">Orari di apertura:</span>
                    <ul class="mt-2 space-y-1">
                        @foreach($openingHours as $hour)
                            <li class="flex gap-2">
                                <span class="w-20 text-slate-600 dark:text-slate-400">{{ $hour['label'] ?? '' }}:</span>
                                <span class="text-slate-600 dark:text-slate-400">{{ $hour['value'] ?? '' }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </section>
@endif
