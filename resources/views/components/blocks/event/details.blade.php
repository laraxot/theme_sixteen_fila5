@props(['title' => 'Dettagli evento', 'sections' => [], 'content' => ''])
@if(! empty($sections))
    <x-pub_theme::components.blocks.service.details :title="$title" :sections="$sections" />
@else
    <x-pub_theme::components.blocks.content.body :body-title="$title" :body-text="$content" />
@endif
