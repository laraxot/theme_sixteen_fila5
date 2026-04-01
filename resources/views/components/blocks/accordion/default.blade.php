{{--
    Accordion Block - Default
    Usage: <x-blocks.accordion :items="$data['items']" :title="$data['title']" />
--}}

@props(['items' => [], 'title' => ''])

<section class="cmp-accordion mb-8">
    @if($title)
    <h2 class="title-xlarge mb-4">{{ $title }}</h2>
    @endif

    <div class="accordion" id="accordion-{{ Str::slug($title) }}">
        @foreach($items as $index => $item)
        <div class="accordion-item">
            <h2 class="accordion-header" id="heading-{{ Str::slug($title) }}-{{ $index }}">
                <button class="accordion-button" 
                        type="button" 
                        data-bs-toggle="collapse" 
                        data-bs-target="#collapse-{{ Str::slug($title) }}-{{ $index }}"
                        aria-expanded="{{ $index === 0 ? 'true' : 'false' }}"
                        aria-controls="collapse-{{ Str::slug($title) }}-{{ $index }}">
                    {{ $item['question'] }}
                </button>
            </h2>
            <div id="collapse-{{ Str::slug($title) }}-{{ $index }}" 
                 class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}"
                 aria-labelledby="heading-{{ Str::slug($title) }}-{{ $index }}"
                 data-bs-parent="#accordion-{{ Str::slug($title) }}">
                <div class="accordion-body">
                    {!! $item['answer'] !!}
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>
