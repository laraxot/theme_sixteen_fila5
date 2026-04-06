@props(['data' => []])

@php
    $contactTitle = $data['contact_title'] ?? 'Contatta il comune';
    $contacts = $data['contacts'] ?? [];
    $issuesTitle = $data['issues_title'] ?? 'Problemi in città';
    $issues = $data['issues'] ?? [];
@endphp

<div class="bg-grey-card shadow-contacts">
    <div class="container">
        <div class="row d-flex justify-content-center p-contacts">
            @if(!empty($contacts))
            <div class="col-12 col-lg-5">
                <div class="cmp-contacts">
                    <div class="card w-100">
                        <div class="card-body">
                            <h2 class="title-medium-2-semi-bold">{{ $contactTitle }}</h2>
                            <ul class="contact-list p-0">
                                @foreach($contacts as $contact)
                                <li>
                                    <a class="list-item" href="{{ $contact['url'] ?? '#' }}">
                                        <svg class="icon icon-primary icon-sm" aria-hidden="true">
                                            <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-help-circle"></use>
                                        </svg>
                                        <span>{{ $contact['label'] ?? '' }}</span>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            @if(!empty($issues))
            <div class="col-12 col-lg-5">
                <div class="cmp-contacts">
                    <div class="card w-100">
                        <div class="card-body">
                            <h2 class="title-medium-2-semi-bold">{{ $issuesTitle }}</h2>
                            <ul class="contact-list p-0">
                                @foreach($issues as $issue)
                                <li>
                                    <a class="list-item" href="{{ $issue['url'] ?? '#' }}">
                                        <svg class="icon icon-primary icon-sm" aria-hidden="true">
                                            <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-help-circle"></use>
                                        </svg>
                                        <span>{{ $issue['label'] ?? '' }}</span>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
