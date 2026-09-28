<?php

declare(strict_types=1);

use Illuminate\View\View;
use Modules\Fixcity\Actions\BuildAuthenticatedUserFollowedTicketsQueryAction;
use Modules\Fixcity\Enums\TicketStatusEnum;
use Modules\Fixcity\Models\Ticket;
use Modules\Xot\Contracts\UserContract;

use function Laravel\Folio\middleware;
use function Laravel\Folio\name;
use function Laravel\Folio\render;

name('area-personale.seguite');
middleware(['web', 'auth']);

render(function (View $view): View {
    $user = auth()->user();
    abort_unless($user instanceof UserContract, 403);

    $tickets = app(BuildAuthenticatedUserFollowedTicketsQueryAction::class)
        ->execute($user)
        ->limit(50)
        ->get();

    return $view->with('tickets', $tickets);
});

?>
<x-layouts.app>
    <x-slot name="title">
        {{ __('fixcity::ticket.subscription.followed_title') }}
    </x-slot>

    <main id="main-container" class="container py-4 py-lg-5">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">
                <header class="cmp-heading mb-4">
                    <h1 class="title-xxxlarge">{{ __('fixcity::ticket.subscription.followed_title') }}</h1>
                    <p class="subtitle-small mb-0">{{ __('fixcity::ticket.subscription.followed_description') }}</p>
                </header>

                <nav class="d-flex gap-2 flex-wrap mb-3" aria-label="{{ __('fixcity::ticket.subscription.personal_area_navigation') }}">
                    <a class="btn btn-outline-primary" href="{{ url('/'.request()->segment(1).'/area-personale/pratiche') }}">
                        {{ __('fixcity::ticket.subscription.my_tickets') }}
                    </a>
                    <span class="btn btn-primary" aria-current="page">
                        {{ __('fixcity::ticket.subscription.followed_title') }}
                    </span>
                    <a class="btn btn-outline-primary" href="{{ url('/'.request()->segment(1).'/area-personale/impostazioni') }}">
                        {{ __('fixcity::ticket_notification_preferences.page_title') }}
                    </a>
                </nav>

                <p class="mb-3 text-muted" role="status">
                    {{ trans_choice('fixcity::ticket.subscription.followed_count', $tickets->count(), ['count' => $tickets->count()]) }}
                </p>

                @if ($tickets->isEmpty())
                    <div class="card shadow-sm border-0">
                        <div class="card-body p-4">
                            <p class="mb-3">{{ __('fixcity::ticket.subscription.followed_empty') }}</p>
                            <a class="btn btn-primary" href="{{ url('/'.request()->segment(1).'/tickets') }}">
                                {{ __('fixcity::ticket.subscription.discover_tickets') }}
                            </a>
                        </div>
                    </div>
                @else
                    <ul class="list-group shadow-sm" aria-label="{{ __('fixcity::ticket.subscription.followed_title') }}">
                        @foreach ($tickets as $ticket)
                            @php
                                /** @var Ticket $ticket */
                                $statusValue = $ticket->resolveTicketStatusValue();
                                $status = TicketStatusEnum::tryFrom($statusValue)?->getLabel() ?? $statusValue;
                                $ticketCode = $ticket->code;
                                $trackUrl = is_string($ticketCode) && trim($ticketCode) !== ''
                                    ? url('/'.request()->segment(1).'/tickets/track?code='.rawurlencode($ticketCode))
                                    : null;
                            @endphp
                            <li class="list-group-item py-3">
                                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3">
                                    <div>
                                        <h2 class="h5 mb-1">{{ $ticket->name }}</h2>
                                        <p class="mb-0 text-muted small">
                                            <span>{{ __('fixcity::ticket.fields.status.label') }}: {{ $status }}</span>
                                        </p>
                                    </div>
                                    @if (is_string($trackUrl))
                                        <a class="btn btn-outline-primary flex-shrink-0" href="{{ $trackUrl }}">
                                            {{ __('fixcity::ticket.track.submit') }}
                                            <span class="visually-hidden">: {{ $ticket->name }}</span>
                                        </a>
                                    @else
                                        <span class="text-muted small" role="status">
                                            {{ __('fixcity::ticket.subscription.tracking_unavailable') }}
                                        </span>
                                    @endif
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </main>
</x-layouts.app>
