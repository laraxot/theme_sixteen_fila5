{{--
  Callers: Folio/CMS block monta questa view su data-slug=tickets.track
  (già in uso — questo file esiste; rewrite vestito Design Comuni).
  Nessun altro file è la pagina FO «Traccia»: non duplicare in pages/tickets/.
  Schema: query code|ticket_id; payload Actions Fixcity (GetPublicTicketByCodeAction…).
  Istruzione utente: «migliora http://192.168.1.40:8000/it/tickets/track».
--}}
@php
    use Illuminate\Support\Facades\Gate;
    use Modules\Fixcity\Actions\BuildTicketPublicDetailsPayloadAction;
    use Modules\Fixcity\Actions\BuildTicketTimelineAction;
    use Modules\Fixcity\Actions\GetPublicTicketByCodeAction;
    use Modules\Fixcity\Enums\TicketStatusEnum;
    use Modules\Fixcity\Models\Ticket;
    use Modules\Xot\Contracts\UserContract;
    use Themes\Sixteen\Infrastructure\Url\FrontofficeRoutes;

    $code = request()->query('code');
    $codeString = is_string($code) ? trim($code) : '';
    $ticketId = request()->query('ticket_id');
    $ticketIdString = is_string($ticketId) || is_int($ticketId) ? (string) $ticketId : '';
    $authenticatedLookup = $ticketIdString !== '';
    $ticket = null;
    if ($authenticatedLookup) {
        $user = auth()->user();
        abort_unless($user instanceof UserContract, 403);
        abort_unless(ctype_digit($ticketIdString), 404);
        $candidate = Ticket::query()->find((int) $ticketIdString);
        abort_unless($candidate instanceof Ticket, 404);
        Gate::authorize('view', $candidate);
        $ticket = $candidate;
    } elseif ($codeString !== '') {
        $ticket = app(GetPublicTicketByCodeAction::class)->execute($codeString);
    }
    $payload = $ticket instanceof Ticket ? app(BuildTicketPublicDetailsPayloadAction::class)->execute($ticket) : null;
    $timeline = $ticket instanceof Ticket ? app(BuildTicketTimelineAction::class)->execute($ticket) : [];
    $notFound = $codeString !== '' && ! $ticket instanceof Ticket;
    $statusEnum = is_array($payload) ? TicketStatusEnum::tryFrom((string) ($payload['status'] ?? '')) : null;
    $createUrl = FrontofficeRoutes::ticketsCreate(false);
    $trackUrl = FrontofficeRoutes::ticketsTrack(false);
    $homeUrl = route('home', [], false);
    $partialData = [
        'breadcrumb' => [
            'items' => [['label' => __('pub_theme::navigation.home'), 'url' => $homeUrl]],
            'current' => __('fixcity::ticket.track.title'),
        ],
    ];
    $d = static fn (string $key, mixed $default = ''): mixed => data_get($partialData, $key, $default);
@endphp

<div class="dc-ticket-track">
    <div class="dc-ticket-track__container">
        @include('pub_theme::components.blocks.report-partials.breadcrumb')

        <div class="cmp-hero">
            <section class="it-hero-wrapper bg-white align-items-start">
                <div class="it-hero-text-wrapper pt-0 ps-0 pb-4">
                    <h1 class="text-black" data-element="page-name">{{ __('fixcity::ticket.track.title') }}</h1>
                    <div class="hero-text">
                        <p>{{ $authenticatedLookup ? __('fixcity::ticket.track.account_subtitle') : __('fixcity::ticket.track.subtitle') }}</p>
                    </div>
                </div>
            </section>
        </div>

        @unless ($authenticatedLookup)
            <form method="get" action="{{ $trackUrl }}" class="dc-ticket-track__form" role="search">
                <label class="dc-ticket-track__label" for="ticket-track-code">{{ __('fixcity::ticket.fields.code.label') }}</label>
                <div class="dc-ticket-track__controls input-group">
                    <input
                        id="ticket-track-code"
                        name="code"
                        type="text"
                        class="form-control dc-ticket-track__input"
                        value="{{ $codeString }}"
                        required
                        autocomplete="off"
                        spellcheck="false"
                        inputmode="text"
                        placeholder="TCK-XXXXXXXXXXXXXXXX"
                        aria-invalid="{{ $notFound ? 'true' : 'false' }}"
                        aria-describedby="ticket-track-help{{ $notFound ? ' ticket-track-error' : '' }}"
                    >
                    <button type="submit" class="btn btn-primary dc-ticket-track__submit">{{ __('fixcity::ticket.track.submit') }}</button>
                </div>
                <p id="ticket-track-help" class="dc-ticket-track__help">{{ __('fixcity::ticket.track.help') }}</p>
            </form>

            @if ($codeString === '' && ! $notFound)
                <p class="dc-ticket-track__hint" role="note">
                    {{ __('fixcity::ticket.track.empty_hint') }}
                    <a href="{{ $createUrl }}">{{ __('fixcity::ticket.track.create_cta') }}</a>
                </p>
            @endif
        @endunless

        @if ($notFound)
            <div id="ticket-track-error" class="dc-ticket-track__alert" role="alert">
                <p class="dc-ticket-track__alert-title">{{ __('fixcity::ticket.track.not_found') }}</p>
                <p class="dc-ticket-track__alert-body">{{ __('fixcity::ticket.track.not_found_help') }}</p>
                <div class="dc-ticket-track__actions">
                    <a class="btn btn-primary" href="{{ $trackUrl }}">{{ __('fixcity::ticket.track.retry') }}</a>
                    <a class="btn btn-outline-primary" href="{{ $createUrl }}">{{ __('fixcity::ticket.track.create_cta') }}</a>
                </div>
            </div>
        @endif

        @if (is_array($payload))
            <article class="dc-ticket-track__result" aria-live="polite">
                <header class="dc-ticket-track__result-head">
                    <h2 class="dc-ticket-track__result-title">{{ $payload['title'] }}</h2>
                    @if ($statusEnum instanceof TicketStatusEnum)
                        <span class="badge rounded-pill bg-primary dc-ticket-track__status">{{ $statusEnum->getLabel() }}</span>
                    @endif
                </header>
                <dl class="dc-ticket-track__meta">
                    @if (($payload['code'] ?? '') !== '')
                        <div class="dc-ticket-track__meta-row">
                            <dt>{{ __('fixcity::ticket.fields.code.label') }}</dt>
                            <dd><code>{{ $payload['code'] }}</code></dd>
                        </div>
                    @endif
                    <div class="dc-ticket-track__meta-row">
                        <dt>{{ __('fixcity::ticket.fields.status.label') }}</dt>
                        <dd>{{ $statusEnum?->getLabel() ?? $payload['status'] }}</dd>
                    </div>
                </dl>
                @if (($payload['description'] ?? '') !== '')
                    <p class="dc-ticket-track__description">{{ $payload['description'] }}</p>
                @endif
            </article>

            <section class="dc-ticket-track__timeline" aria-labelledby="ticket-track-timeline-heading">
                <h2 id="ticket-track-timeline-heading">{{ __('fixcity::ticket.track.timeline_title') }}</h2>
                @if ($timeline === [])
                    <p class="dc-ticket-track__timeline-empty" role="status">{{ __('fixcity::ticket.track.timeline_empty') }}</p>
                @else
                    <ol class="dc-ticket-track__timeline-list" aria-label="{{ __('fixcity::ticket.track.timeline_title') }}">
                        @foreach ($timeline as $entry)
                            <li class="dc-ticket-track__timeline-item">
                                <div class="dc-ticket-track__timeline-item-head">
                                    <strong>{{ $entry['to_label'] }}</strong>
                                    @if (($entry['occurred_at'] ?? '') !== '')
                                        <time datetime="{{ $entry['occurred_at'] }}">{{ $entry['occurred_at'] }}</time>
                                    @endif
                                </div>
                                @if (($entry['reason'] ?? null) !== null && $entry['reason'] !== '')
                                    <p>{{ $entry['reason'] }}</p>
                                @endif
                            </li>
                        @endforeach
                    </ol>
                @endif
            </section>

            <div class="dc-ticket-track__actions">
                <a class="btn btn-outline-primary" href="{{ $trackUrl }}">{{ __('fixcity::ticket.track.retry') }}</a>
                <a class="btn btn-primary" href="{{ $createUrl }}">{{ __('fixcity::ticket.track.create_cta') }}</a>
            </div>
        @endif
    </div>
</div>
