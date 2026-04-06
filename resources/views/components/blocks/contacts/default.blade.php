{{--
    Contacts Block - Bootstrap Italia Style
    Reference: https://italia.github.io/design-comuni-pagine-statiche/sito/contatti.html
--}}
@props(['data' => []])

@php
    $title = $data['title'] ?? 'Contatti';
    $phone = $data['phone'] ?? '';
    $email = $data['email'] ?? '';
    $address = $data['address'] ?? '';
    $pec = $data['pec'] ?? '';
    $website = $data['website'] ?? '';
@endphp

<div class="cmp-contacts">
    <div class="card-wrapper">
        <div class="card bg-white shadow-sm">
            <div class="card-body">
                <h3 class="title-medium-2-semi-bold mb-0">{{ $title }}</h3>
                
                @if($phone)
                <div class="mt-3">
                    <p class="subtitle-small mb-1">Telefono</p>
                    <a href="tel:{{ $phone }}" class="text-decoration-none t-primary">
                        <svg class="icon icon-sm me-1">
                            <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-phone"></use>
                        </svg>
                        {{ $phone }}
                    </a>
                </div>
                @endif

                @if($email)
                <div class="mt-3">
                    <p class="subtitle-small mb-1">Email</p>
                    <a href="mailto:{{ $email }}" class="text-decoration-none t-primary">
                        <svg class="icon icon-sm me-1">
                            <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-mail"></use>
                        </svg>
                        {{ $email }}
                    </a>
                </div>
                @endif

                @if($pec)
                <div class="mt-3">
                    <p class="subtitle-small mb-1">PEC</p>
                    <a href="mailto:{{ $pec }}" class="text-decoration-none t-primary">
                        <svg class="icon icon-sm me-1">
                            <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-mail"></use>
                        </svg>
                        {{ $pec }}
                    </a>
                </div>
                @endif

                @if($address)
                <div class="mt-3">
                    <p class="subtitle-small mb-1">Indirizzo</p>
                    <p class="text-secondary mb-0">
                        <svg class="icon icon-sm me-1">
                            <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-location"></use>
                        </svg>
                        {{ $address }}
                    </p>
                </div>
                @endif

                @if($website)
                <div class="mt-3">
                    <p class="subtitle-small mb-1">Sito Web</p>
                    <a href="{{ $website }}" class="text-decoration-none t-primary" target="_blank">
                        <svg class="icon icon-sm me-1">
                            <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-link"></use>
                        </svg>
                        {{ $website }}
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
