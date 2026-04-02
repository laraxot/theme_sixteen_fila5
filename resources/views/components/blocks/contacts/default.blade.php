@props(['data' => []])

{{-- Contacts Component - Bootstrap Italia Exact Replica --}}
@php
    $title = $data['title'] ?? 'CONTATTA IL COMUNE';
    $address = $data['address'] ?? '';
    $phone = $data['phone'] ?? '';
    $email = $data['email'] ?? '';
    $pec = $data['pec'] ?? '';
    $hours = $data['hours'] ?? '';
@endphp

<div class="cmp-contacts">
    <div class="card card-teaser shadow p-4 rounded border border-light">
        <div class="card-body">
            @if($title)
            <h5 class="card-title mb-3">{{ $title }}</h5>
            @endif
            
            @if($address)
            <div class="contact-item mb-3">
                <svg class="icon icon-sm me-2">
                    <use xlink:href="#it-map-marker"></use>
                </svg>
                <span>{{ $address }}</span>
            </div>
            @endif
            
            @if($phone)
            <div class="contact-item mb-3">
                <svg class="icon icon-sm me-2">
                    <use xlink:href="#it-telephone"></use>
                </svg>
                <a href="tel:{{ $phone }}">{{ $phone }}</a>
            </div>
            @endif
            
            @if($email)
            <div class="contact-item mb-3">
                <svg class="icon icon-sm me-2">
                    <use xlink:href="#it-mail"></use>
                </svg>
                <a href="mailto:{{ $email }}">{{ $email }}</a>
            </div>
            @endif
            
            @if($pec)
            <div class="contact-item mb-3">
                <svg class="icon icon-sm me-2">
                    <use xlink:href="#it-certification"></use>
                </svg>
                <a href="mailto:{{ $pec }}">{{ $pec }}</a>
            </div>
            @endif
            
            @if($hours)
            <div class="contact-item">
                <svg class="icon icon-sm me-2">
                    <use xlink:href="#it-time"></use>
                </svg>
                <span>{{ $hours }}</span>
            </div>
            @endif
        </div>
    </div>
</div>
