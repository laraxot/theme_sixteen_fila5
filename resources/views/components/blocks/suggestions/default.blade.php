@props(['data' => []])

<section class="dc-suggestions" aria-labelledby="dc-suggestions-title">
    @if(!empty($data['title']))
        <h2 id="dc-suggestions-title">{{ $data['title'] }}</h2>
    @endif
    <ul>
        @foreach(($data['items'] ?? []) as $item)
            <li><a href="{{ $item['url'] ?? '#' }}">{{ $item['label'] ?? '' }}</a></li>
        @endforeach
    </ul>
</section>
