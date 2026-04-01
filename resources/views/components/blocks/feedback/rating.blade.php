{{--
    Feedback Rating Block
    Reference: design-comuni-pagine-statiche/src/pages/sito/homepage.hbs cmp-rating
--}}
@props([
    'id'    => 'rating',
    'title' => 'Quanto sono chiare le informazioni su questa pagina?',
])

<div class="bg-primary">
    <div class="container">
        <div class="row d-flex justify-content-center bg-primary">
            <div class="col-12 col-lg-6">
                <div class="cmp-rating">
                    <div class="card-wrapper card shadow-lg border-0">
                        <div class="card-header border-0 bg-white">
                            <h2 class="title-medium-2-semi-bold text-center" id="{{ $id }}-title">{{ $title }}</h2>
                        </div>
                        <div class="card-body px-4 pb-8">
                            <div class="rating" role="group" aria-labelledby="{{ $id }}-title">
                                @for($i = 5; $i >= 1; $i--)
                                <input type="radio" id="{{ $id }}-star{{ $i }}" name="{{ $id }}-rating" value="{{ $i }}" class="visually-hidden" />
                                <label class="rating-star" for="{{ $id }}-star{{ $i }}" aria-label="Valutazione {{ $i }} stelle su 5">
                                    <svg aria-hidden="true">
                                        <use href="{{ asset('themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-star-full') }}"></use>
                                    </svg>
                                </label>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
