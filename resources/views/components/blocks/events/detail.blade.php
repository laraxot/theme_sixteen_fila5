@props(['event' => null, 'item' => null, 'slug0' => null, 'slug' => null])

{{-- Callers: CMS pages/events/view.json (slug view → events.view). Il corpo è l'Article, non il JSON. --}}
@php
    if (! $event instanceof \Modules\Blog\Models\Article && $item instanceof \Modules\Blog\Models\Article) {
        $event = $item;
    }
    if (! $event instanceof \Modules\Blog\Models\Article) {
        $lookup = is_string($slug0) && $slug0 !== '' ? $slug0 : (is_string($slug) ? $slug : '');
        $found = $lookup === ''
            ? null
            : app(\Modules\Blog\View\Composers\ThemeComposer::class)->findPublishedEventBySlug($lookup);
        $event = $found instanceof \Modules\Blog\Models\Article ? $found : null;
    }
@endphp
@if ($event instanceof \Modules\Blog\Models\Article)
@php
    $title = (string) $event->getAttribute('title');
    $image = (string) $event->getAttribute('main_image_url');
    $blocks = $event->getAttribute('content_blocks');
    $blockCollection = is_array($blocks) ? collect($blocks) : collect();
    $paragraphs = $blockCollection->where('type', 'paragraph')->pluck('data.text')->filter();
    $imageBlock = $blockCollection->firstWhere('type', 'image');
    $imageAlt = is_array($imageBlock)
        ? (string) data_get($imageBlock, 'data.alt', $title)
        : $title;
    $imageCaption = is_array($imageBlock) ? (string) data_get($imageBlock, 'data.caption', '') : '';
    $imageCredit = is_array($imageBlock) ? (string) data_get($imageBlock, 'data.credit', '') : '';
    if ($image === '' && is_array($imageBlock)) {
        $image = (string) data_get($imageBlock, 'data.url', '');
    }
    $localize = static fn (string $path): string => \LaravelLocalization::localizeURL($path);
    $category = $event->category?->getAttribute('name');
    $start = filled($event->event_start_date)
        ? \Illuminate\Support\Carbon::parse($event->event_start_date)
        : null;
    $end = filled($event->event_end_date)
        ? \Illuminate\Support\Carbon::parse($event->event_end_date)
        : null;
    // Comments list/form: CommentsWidget (Filament) — no pre-fetch gate.
@endphp

<div class="container" id="main-container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <div class="cmp-breadcrumbs" role="navigation">
                <nav class="breadcrumb-container" aria-label="breadcrumb">
                    <ol class="breadcrumb p-0" data-element="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ $localize('/') }}">Home</a>
                            <span class="separator">/</span>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ $localize('/events') }}">Eventi</a>
                            <span class="separator">/</span>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<article class="container pt-3 pb-5 blog-article-detail" aria-labelledby="event-title">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <header class="mb-4">
                @if (is_string($category) && $category !== '')
                    <p class="category-top mb-2">
                        <span class="category">{{ strtoupper($category) }}</span>
                    </p>
                @endif
                <h1 id="event-title" class="text-black" data-element="page-name">{{ $title }}</h1>
                @if ($start)
                    <p class="text-muted mb-0">
                        <time datetime="{{ $start->toIso8601String() }}">
                            {{ $start->translatedFormat('j F Y, H:i') }}
                        </time>
                        @if ($end)
                            <span aria-hidden="true"> – </span>
                            <time datetime="{{ $end->toIso8601String() }}">
                                {{ $end->translatedFormat('j F Y, H:i') }}
                            </time>
                        @endif
                    </p>
                @endif
            </header>

            @if ($event->getAttribute('description'))
                <p class="lead mb-3">{{ $event->getAttribute('description') }}</p>
            @endif

            <div class="event-content post-content richtext-wrapper lora mb-4">
                @foreach ($paragraphs as $paragraph)
                    {!! $paragraph !!}
                @endforeach
            </div>

            @if ($image !== '')
                <figure class="mb-4 blog-article-detail__media">
                    <img src="{{ $image }}" alt="{{ $imageAlt }}" class="img-fluid w-100 rounded" width="1200" height="675" fetchpriority="high">
                    @if ($imageCaption !== '' || $imageCredit !== '')
                        <figcaption class="figure-caption text-center pt-3">
                            @if ($imageCaption !== '')
                                {{ $imageCaption }}
                            @endif
                            @if ($imageCredit !== '')
                                <span class="d-block text-muted small">{{ $imageCredit }}</span>
                            @endif
                        </figcaption>
                    @endif
                </figure>
            @endif

            <section class="mt-5 pt-4 border-top" aria-labelledby="comments-title">
                <h2 id="comments-title" class="h3 mb-4">Commenti</h2>
                @auth
                    @livewire(\Modules\Comment\Filament\Widgets\Commentable\CommentsWidget::class, [
                        'commentableType' => $event::class,
                        'commentableKey' => (string) $event->getKey(),
                        'readOnly' => false,
                        'hideNotifications' => true,
                        'noReplies' => true,
                        'noReactions' => true,
                    ], key('event-comments-'.$event->getKey()))
                @endauth
                @guest
                    @livewire(\Modules\Comment\Filament\Widgets\Commentable\CommentsWidget::class, [
                        'commentableType' => $event::class,
                        'commentableKey' => (string) $event->getKey(),
                        'readOnly' => true,
                        'hideNotifications' => true,
                        'noReplies' => true,
                        'noReactions' => true,
                    ], key('event-comments-ro-'.$event->getKey()))
                    <p class="mt-3 text-sm text-muted">
                        <a class="underline" href="{{ $localize('/auth/login') }}">
                            {{ __('comment::txt.log-in-for-comment') }}
                        </a>
                    </p>
                @endguest
            </section>

            <p class="mt-5">
                <a class="read-more" href="{{ $localize('/events') }}">
                    <span class="text">Torna agli eventi</span>
                </a>
            </p>
        </div>
    </div>
</article>
@endif
