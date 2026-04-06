@props(['data' => []])

@php
    $title = $data['title'] ?? 'QUANTO SONO CHIARE LE INFORMAZIONI SU QUESTA PAGINA?';
@endphp

<div class="it-rating-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="it-rating-wrapper" x-data="{ rating: 0, hover: 0 }">
                    <div class="it-rating-label-container">
                        <p>{{ $title }}</p>
                    </div>
                    <div class="it-rating-list-container">
                        <ul class="it-rating-list">
                            @for($i = 1; $i <= 5; $i++)
                                <li>
                                    <button class="btn btn-link" 
                                            title="Valuta {{ $i }} stelle su 5"
                                            @click="rating = {{ $i }}"
                                            @mouseenter="hover = {{ $i }}"
                                            @mouseleave="hover = 0"
                                            type="button">
                                        <svg class="icon icon-sm" :class="(hover >= {{ $i }} || rating >= {{ $i }}) ? 'fill-yellow-400' : 'fill-gray-300'">
                                            <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                                        </svg>
                                        <span class="sr-only">Valuta {{ $i }} stelle su 5</span>
                                    </button>
                                </li>
                            @endfor
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
