@props([
    'title' => '',
    'subtitle' => '',
    'content' => '',
    'background_color' => 'bg-white',
    'text_color' => 'text-gray-900',
])

@if($title)
<section class="py-12 {{ $background_color }}">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="{{ $text_color }}">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ $title }}</h1>
            @if($subtitle)
                <p class="text-xl opacity-80 mb-4">{{ $subtitle }}</p>
            @endif
            @if($content)
                <div class="text-lg opacity-70">{!! $content !!}</div>
            @endif
        </div>
    </div>
</section>
@endif
