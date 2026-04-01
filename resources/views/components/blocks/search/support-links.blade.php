@props([
    'contact_title' => 'Contatta il comune',
    'contact_links' => [],
    'report_title' => 'Problemi in città',
    'report_links' => [],
    'search_title' => 'Cerca',
    'search_placeholder' => 'Cerca nel sito',
    'search_button' => 'Cerca',
    'related_title' => 'FORSE STAVI CERCANDO',
    'related_links' => [],
])

<section class="section section-muted">
    <div class="container">
        <div class="row g-4">
            <div class="col-12 col-md-6 col-lg-3">
                <h2 class="h4">{{ $contact_title }}</h2>
                <ul class="list-unstyled">
                    @foreach($contact_links as $link)
                        <li><a href="{{ $link['url'] ?? '#' }}">{{ $link['label'] }}</a></li>
                    @endforeach
                </ul>
            </div>

            <div class="col-12 col-md-6 col-lg-3">
                <h2 class="h4">{{ $report_title }}</h2>
                <ul class="list-unstyled">
                    @foreach($report_links as $link)
                        <li><a href="{{ $link['url'] ?? '#' }}">{{ $link['label'] }}</a></li>
                    @endforeach
                </ul>
            </div>

            <div class="col-12 col-md-6 col-lg-3">
                <h2 class="h4">{{ $search_title }}</h2>
                <form role="search">
                    <label class="visually-hidden" for="support-search">{{ $search_placeholder }}</label>
                    <input id="support-search" type="search" class="form-control mb-2" placeholder="{{ $search_placeholder }}">
                    <button type="button" class="btn btn-primary">{{ $search_button }}</button>
                </form>
            </div>

            <div class="col-12 col-md-6 col-lg-3">
                <h2 class="h6 text-uppercase">{{ $related_title }}</h2>
                <ul class="list-unstyled">
                    @foreach($related_links as $link)
                        <li><a href="{{ $link['url'] ?? '#' }}">{{ $link['label'] }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>
