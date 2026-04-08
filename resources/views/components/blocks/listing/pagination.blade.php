@props([
    'current_page' => 1,
    'pages' => [],
    'previous_label' => 'Pagina precedente',
    'next_label' => 'Pagina successiva',
])

<div class="container">
    <div class="row">
        <div class="col-12">
            <nav class="cmp-pagination" aria-label="Paginazione">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="{{ $pages[0]['url'] ?? '#' }}">{{ $previous_label }}</a>
                    </li>

                    @foreach($pages as $page)
                        <li class="page-item {{ (int) ($page['number'] ?? 0) === (int) $current_page ? 'active' : '' }}">
                            <a class="page-link" href="{{ $page['url'] ?? '#' }}">
                                {{ $page['label'] ?? $page['number'] ?? '' }}
                            </a>
                        </li>
                    @endforeach

                    <li class="page-item">
                        <a class="page-link" href="{{ $pages[count($pages) - 1]['url'] ?? '#' }}">{{ $next_label }}</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
