@props(['columns' => [], 'social' => [], 'legal' => [], 'contact' => []])

{{--
    Footer Main Block
    
    Usage:
    "view": "pub_theme::components.blocks.footer.main",
    "columns": [
        {
            "title": "Amministrazione",
            "links": [
                {"label": "Giunta", "url": "/it/giunta"},
                {"label": "Consiglio", "url": "/it/consiglio"}
            ]
        }
    ],
    "social": [...],
    "legal": {...},
    "contact": {...}
    
    Docs: docs/design-comuni/blocks/00-index.md
--}}

<footer class="it-footer-main-wrapper" id="footer">
    <div class="container">
        {{-- Footer Main Content --}}
        <div class="row gy-4">
            {{-- Contact Column --}}
            @if(count($contact) > 0)
            <div class="col-12 col-md-4">
                <div class="footer-contact">
                    <h3 class="footer-title">{{ __('pub_theme::blocks_common.shared.contacts.label') }}</h3>
                    <address class="footer-address">
                        @if(isset($contact['address']))
                            <p>{{ $contact['address'] }}</p>
                        @endif
                        @if(isset($contact['phone']))
                            <p>
                                <strong>{{ __('pub_theme::blocks_common.shared.phone_colon.label') }}</strong> 
                                <a href="tel:{{ $contact['phone'] }}">{{ $contact['phone'] }}</a>
                            </p>
                        @endif
                        @if(isset($contact['email']))
                            <p>
                                <strong>{{ __('pub_theme::blocks_common.shared.email_colon.label') }}</strong> 
                                <a href="mailto:{{ $contact['email'] }}">{{ $contact['email'] }}</a>
                            </p>
                        @endif
                        @if(isset($contact['pec']))
                            <p>
                                <strong>{{ __('pub_theme::footer_blocks.shared.certified_email_colon.label') }}</strong> 
                                <a href="mailto:{{ $contact['pec'] }}">{{ $contact['pec'] }}</a>
                            </p>
                        @endif
                    </address>
                </div>
            </div>
            @endif

            {{-- Link Columns --}}
            @foreach($columns as $column)
            <div class="col-12 col-md-{{ count($columns) > 3 ? '3' : '4' }}">
                <div class="footer-links">
                    <h3 class="footer-title">{{ $column['title'] }}</h3>
                    <ul class="footer-link-list">
                        @foreach($column['links'] as $link)
                            <li>
                                <a href="{{ $link['url'] }}">{{ $link['label'] }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Social & Legal Bar --}}
        <div class="footer-bar mt-5 pt-4 border-top">
            <div class="row align-items-center">
                {{-- Social Links --}}
                @if(count($social) > 0)
                <div class="col-12 col-md-6">
                    <div class="footer-social">
                        <span class="footer-social-label">{{ __('pub_theme::blocks_common.shared.follow_us_on_colon.label') }}</span>
                        <ul class="footer-social-list list-inline">
                            @foreach($social as $platform)
                                <li class="list-inline-item">
                                    <a href="{{ $platform['url'] }}" class="footer-social-link" aria-label="{{ ucfirst($platform['platform']) }}">
                                        <svg class="icon icon-sm">
                                            <use href="#it-{{ $platform['platform'] }}"></use>
                                        </svg>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif

                {{-- Legal Links --}}
                @if(count($legal) > 0)
                <div class="col-12 col-md-6 text-md-end">
                    <ul class="footer-legal-list">
                        @foreach($legal as $label => $url)
                            <li class="list-inline-item">
                                <a href="{{ $url }}">{{ ucfirst(str_replace('-', ' ', $label)) }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
        </div>

        {{-- Footer Small Prints - EXACT Bootstrap Italia Structure --}}
        <div class="it-footer-small-prints mt-4 pt-3 border-top">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <ul class="footer-small-prints-list list-inline text-center mb-0">
                            <li class="list-inline-item me-3">
                                <a href="{{ route('container0.index', ['container0' => 'amministrazione-trasparente'], false) }}" class="footer-small-print-link">{{ __('pub_theme::footer_blocks.shared.transparent_administration.label') }}</a>
                            </li>
                            <li class="list-inline-item me-3">
                                <a href="{{ route('container0.index', ['container0' => 'cookie-policy'], false) }}" class="footer-small-print-link">{{ __('footer.cookie_policy') }}</a>
                            </li>
                            <li class="list-inline-item me-3">
                                <a href="{{ route('container0.index', ['container0' => 'informativa-privacy'], false) }}" class="footer-small-print-link">{{ __('footer.privacy') }}</a>
                            </li>
                            <li class="list-inline-item me-3">
                                <a href="{{ route('container0.index', ['container0' => 'note-legali'], false) }}" class="footer-small-print-link">{{ __('footer.legal_notes') }}</a>
                            </li>
                            <li class="list-inline-item">
                                <a href="{{ route('container0.index', ['container0' => 'dichiarazione-accessibilita'], false) }}" class="footer-small-print-link">{{ __('footer.accessibility') }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
