@props(['data' => []])

@php
    $title = $data['title'] ?? '';
    $description = $data['description'] ?? '';
    $hasRating = $data['has_rating'] ?? false;
    $ratingMax = $data['rating_max'] ?? 5;
@endphp

@if($title)
    <section class="my-12 border-t border-slate-200 dark:border-slate-700 pt-8">
        <h3 class="mb-4 text-xl font-semibold text-slate-900 dark:text-white">
            {{ $title }}
        </h3>
        @if($description)
            <p class="mb-4 text-slate-600 dark:text-slate-400">
                {{ $description }}
            </p>
        @endif
        @if($hasRating)
            <div class="flex gap-1">
                @for($i = 1; $i <= $ratingMax; $i++)
                    @include('pub_theme::components.ui.icon', ['name' => 'it-star', 'size' => 20])
                @endfor
            </div>
        @endif
    </section>
@endif
