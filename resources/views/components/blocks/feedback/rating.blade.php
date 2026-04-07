{{--
    Feedback Rating Block
    Reference: design-comuni-pagine-statiche/sito/homepage.html #rating section
    Uses Bootstrap Italia structure with Tailwind @apply classes
--}}
@props(['data' => []])

@php
    $title = $data['title'] ?? 'Quanto sono chiare le informazioni su questa pagina?';
    $subtitle = $data['subtitle'] ?? 'Grazie, il tuo parere ci aiuterà a migliorare il servizio!';
@endphp

<div class="cmp-rating pt-lg-80 pb-lg-80" id="rating" x-data="{ rating: 0, hover: 0 }">
    <div class="card shadow card-wrapper" data-element="feedback">
        <div class="cmp-rating__card-first">
            <div class="card-header border-0">
                <h2 class="title-medium-2-semi-bold mb-0" data-element="feedback-title">{{ $title }}</h2>
            </div>
            <div class="card-body">
                <fieldset class="rating" id="fieldset-rating-one">
                    <legend class="visually-hidden">Valuta da 1 a 5 stelle la pagina</legend>

                    {{-- 5 stars - reverse order for CSS star rating --}}
                    <input type="radio" id="star5a" name="ratingA" value="5" x-model="rating">
                    <label class="full rating-star" for="star5a"
                           data-element="feedback-rate-5"
                           @click="rating = 5"
                           @mouseenter="hover = 5"
                           @mouseleave="hover = 0"
                           :class="{'active': hover >= 5 || rating >= 5}">
                        <svg class="icon icon-sm" role="img" aria-labelledby="first-star" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 1.7L9.5 9.2H1.6L8 13.9l-2.4 7.6 6.4-4.7 6.4 4.7-2.4-7.6 6.4-4.7h-7.9L12 1.7z"/>
                            <path fill="none" d="M0 0h24v24H0z"/>
                        </svg>
                        <span class="visually-hidden" id="first-star">Valuta 5 stelle su 5</span>
                    </label>

                    <input type="radio" id="star4a" name="ratingA" value="4" x-model="rating">
                    <label class="full rating-star" for="star4a"
                           data-element="feedback-rate-4"
                           @click="rating = 4"
                           @mouseenter="hover = 4"
                           @mouseleave="hover = 0"
                           :class="{'active': hover >= 4 || rating >= 4}">
                        <svg class="icon icon-sm" role="img" aria-labelledby="second-star" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 1.7L9.5 9.2H1.6L8 13.9l-2.4 7.6 6.4-4.7 6.4 4.7-2.4-7.6 6.4-4.7h-7.9L12 1.7z"/>
                            <path fill="none" d="M0 0h24v24H0z"/>
                        </svg>
                        <span class="visually-hidden" id="second-star">Valuta 4 stelle su 5</span>
                    </label>

                    <input type="radio" id="star3a" name="ratingA" value="3" x-model="rating">
                    <label class="full rating-star" for="star3a"
                           data-element="feedback-rate-3"
                           @click="rating = 3"
                           @mouseenter="hover = 3"
                           @mouseleave="hover = 0"
                           :class="{'active': hover >= 3 || rating >= 3}">
                        <svg class="icon icon-sm" role="img" aria-labelledby="third-star" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 1.7L9.5 9.2H1.6L8 13.9l-2.4 7.6 6.4-4.7 6.4 4.7-2.4-7.6 6.4-4.7h-7.9L12 1.7z"/>
                            <path fill="none" d="M0 0h24v24H0z"/>
                        </svg>
                        <span class="visually-hidden" id="third-star">Valuta 3 stelle su 5</span>
                    </label>

                    <input type="radio" id="star2a" name="ratingA" value="2" x-model="rating">
                    <label class="full rating-star" for="star2a"
                           data-element="feedback-rate-2"
                           @click="rating = 2"
                           @mouseenter="hover = 2"
                           @mouseleave="hover = 0"
                           :class="{'active': hover >= 2 || rating >= 2}">
                        <svg class="icon icon-sm" role="img" aria-labelledby="fourth-star" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 1.7L9.5 9.2H1.6L8 13.9l-2.4 7.6 6.4-4.7 6.4 4.7-2.4-7.6 6.4-4.7h-7.9L12 1.7z"/>
                            <path fill="none" d="M0 0h24v24H0z"/>
                        </svg>
                        <span class="visually-hidden" id="fourth-star">Valuta 2 stelle su 5</span>
                    </label>

                    <input type="radio" id="star1a" name="ratingA" value="1" x-model="rating">
                    <label class="full rating-star" for="star1a"
                           data-element="feedback-rate-1"
                           @click="rating = 1"
                           @mouseenter="hover = 1"
                           @mouseleave="hover = 0"
                           :class="{'active': hover >= 1 || rating >= 1}">
                        <svg class="icon icon-sm" role="img" aria-labelledby="fifth-star" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 1.7L9.5 9.2H1.6L8 13.9l-2.4 7.6 6.4-4.7 6.4 4.7-2.4-7.6 6.4-4.7h-7.9L12 1.7z"/>
                            <path fill="none" d="M0 0h24v24H0z"/>
                        </svg>
                        <span class="visually-hidden" id="fifth-star">Valuta 1 stella su 5</span>
                    </label>
                </fieldset>

                <div class="cmp-rating__card-second">
                    <p class="text-wrap">{{ $subtitle }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
