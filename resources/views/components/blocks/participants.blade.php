@props(['data' => []])

<div class="mb-5">
    @if($data['title'])
    <h3 class="h5-semi-bold mb-3">{{ $data['title'] }}</h3>
    @endif
    <ul class="list-unstyled">
        @foreach($data['items'] as $item)
        <li class="d-flex align-items-center py-1 border-bottom border-light">
            <svg class="icon icon-sm me-2" role="img">
                <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-check"></use>
            </svg>
            <span>{{ $item }}</span>
        </li>
        @endforeach
    </ul>
</div>