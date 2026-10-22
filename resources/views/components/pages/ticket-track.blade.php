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
    $partialData = [
        'breadcrumb' => [
            'items' => [['label' => __('pub_theme::navigation.home'), 'url' => route('home', [], false)]],
            'current' => __('fixcity::ticket.track.title'),
        ],
    ];
    $d = static fn (string $key, mixed $default = ''): mixed => data_get($partialData, $key, $default);
@endphp

<div class="dc-ticket-track">
    <div class="dc-ticket-track__container">
        @include('pub_theme::components.blocks.report-partials.breadcrumb')
        <div class="dc-ticket-track__intro">
            <h1 class="text-3xl font-bold tracking-tight text-slate-950 sm:text-4xl">{{ __('fixcity::ticket.track.title') }}</h1>
            <p class="mt-3 text-lg leading-8 text-slate-700">{{ $authenticatedLookup ? __('fixcity::ticket.track.account_subtitle') : __('fixcity::ticket.track.subtitle') }}</p>
        </div>

        @unless ($authenticatedLookup)
            <form method="get" action="{{ FrontofficeRoutes::ticketsTrack(false) }}" class="dc-ticket-track__form">
                <label class="block text-base font-semibold text-slate-950" for="ticket-track-code">{{ __('fixcity::ticket.fields.code.label') }}</label>
                <div class="dc-ticket-track__controls">
                    <input id="ticket-track-code" name="code" type="text" class="dc-ticket-track__input" value="{{ $codeString }}" required autocomplete="off" aria-invalid="{{ $notFound ? 'true' : 'false' }}" aria-describedby="ticket-track-help{{ $notFound ? ' ticket-track-error' : '' }}">
                    <button type="submit" class="dc-ticket-track__submit">{{ __('fixcity::ticket.track.submit') }}</button>
                </div>
                <p id="ticket-track-help" class="mt-2 text-sm text-slate-700">{{ __('fixcity::ticket.track.help') }}</p>
            </form>
        @endunless

        @if ($notFound)
            <div id="ticket-track-error" class="mt-4 rounded-lg border border-amber-700 bg-amber-50 p-4 text-amber-950" role="alert">{{ __('fixcity::ticket.track.not_found') }}</div>
        @endif

        @if (is_array($payload))
            <article class="mt-8 rounded-xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8" aria-live="polite">
                <h2 class="text-2xl font-bold text-slate-950">{{ $payload['title'] }}</h2>
                <dl class="mt-6 grid gap-4 border-y border-slate-200 py-5 sm:grid-cols-[minmax(0,1fr)_2fr]">
                    @if ($payload['code'] !== '')<dt class="font-semibold text-slate-700">{{ __('fixcity::ticket.fields.code.label') }}</dt><dd class="font-mono text-slate-950"><code>{{ $payload['code'] }}</code></dd>@endif
                    <dt class="font-semibold text-slate-700">{{ __('fixcity::ticket.fields.status.label') }}</dt><dd class="font-semibold text-slate-950">{{ TicketStatusEnum::tryFrom($payload['status'])?->getLabel() ?? $payload['status'] }}</dd>
                </dl>
                @if ($payload['description'] !== '')<p class="mt-5 leading-7 text-slate-800">{{ $payload['description'] }}</p>@endif
            </article>
            <section class="mt-8" aria-labelledby="ticket-track-timeline-heading">
                <h2 id="ticket-track-timeline-heading" class="text-2xl font-bold text-slate-950">{{ __('fixcity::ticket.track.timeline_title') }}</h2>
                @if ($timeline === [])<p class="mt-4 text-slate-700" role="status">{{ __('fixcity::ticket.track.timeline_empty') }}</p>@else
                    <ol class="mt-4 space-y-3" aria-label="{{ __('fixcity::ticket.track.timeline_title') }}">@foreach ($timeline as $entry)<li class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm"><div class="flex flex-col justify-between gap-1 sm:flex-row"><strong class="text-slate-950">{{ $entry['to_label'] }}</strong>@if ($entry['occurred_at'] !== '')<time class="text-sm text-slate-600">{{ $entry['occurred_at'] }}</time>@endif</div>@if ($entry['reason'] !== null && $entry['reason'] !== '')<p class="mt-2 leading-7 text-slate-700">{{ $entry['reason'] }}</p>@endif</li>@endforeach</ol>
                @endif
            </section>
        @endif
    </div>
</div>
