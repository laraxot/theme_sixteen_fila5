@props(['data' => []])
{{--
  Pagina test Design Comuni: dettaglio segnalazione pubblica.
  Struttura allineata al riferimento statico (classi BI per parity HTML).
  Copy da fixcity::ticket_detail — niente label hardcoded.
--}}
@php
    use Modules\Fixcity\Enums\TicketTypeEnum;
    use Modules\Fixcity\Enums\TicketStatusEnum;
    use Modules\Fixcity\Models\Ticket;

    $ticketId = (int) request()->query('id', 0);
    $ticket = $ticketId > 0 ? Ticket::query()->find($ticketId) : null;

    if ($ticket instanceof Ticket) {
        $currentStatus = $ticket->currentStatus();
        $statusValue = is_object($currentStatus) && isset($currentStatus->name) && is_string($currentStatus->name)
            ? $currentStatus->name
            : (string) $ticket->getRawOriginal('status');

        $statusEnum = TicketStatusEnum::tryFrom($statusValue);
        $canView = $statusEnum instanceof TicketStatusEnum
            ? in_array($statusEnum, TicketStatusEnum::canViewByAll(), true)
            : false;
        if (! $canView) {
            $uid = auth()->id();
            $canView = $uid !== null && in_array((string) $uid, [(string) $ticket->created_by, (string) $ticket->updated_by], true);
        }
        if (! $canView) {
            $ticket = null;
        }
    }

    $location = $ticket instanceof Ticket && is_array($ticket->location) ? $ticket->location : [];
    $address = (string) ($location['address'] ?? $location['display_name'] ?? '');

    $typeLabel = '';
    if ($ticket instanceof Ticket) {
        $rawType = $ticket->getRawOriginal('type') ?: $ticket->getRawOriginal('type_id');
        if (is_string($rawType) && $rawType !== '') {
            try {
                $typeLabel = (string) TicketTypeEnum::from($rawType)->getLabel();
            } catch (\ValueError) {
                $typeLabel = $rawType;
            }
        }
    }

    $statusLabel = '';
    if ($ticket instanceof Ticket) {
        $currentStatus = $ticket->currentStatus();
        $statusValue = is_object($currentStatus) && isset($currentStatus->name) && is_string($currentStatus->name)
            ? $currentStatus->name
            : (string) $ticket->getRawOriginal('status');

        if ($statusValue !== '') {
            try {
                $statusLabel = (string) TicketStatusEnum::from($statusValue)->getLabel();
            } catch (\ValueError) {
                $statusLabel = str_replace('_', ' ', $statusValue);
            }
        }
    }

    $images = collect();
    if ($ticket instanceof Ticket) {
        $images = $ticket->getMedia('attachments');
        if ($images->isEmpty()) {
            $images = $ticket->getMedia('ticket');
        }
    }

    $na = __('fixcity::ticket_detail.not_available');
    $localize = static fn (string $path): string => (string) \Mcamara\LaravelLocalization\Facades\LaravelLocalization::localizeURL($path);
@endphp

<div class="container py-5 segnalazione-dettaglio-page" id="main-container" data-element="segnalazione-dettaglio">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            @if (! $ticket)
                <div class="alert alert-warning" role="alert">
                    {{ __('fixcity::ticket_detail.not_found') }}
                </div>
            @else
                <nav class="breadcrumb-container" aria-label="{{ __('fixcity::ticket_detail.breadcrumb.aria') }}">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ $localize('/') }}">{{ __('fixcity::ticket_detail.breadcrumb.home') }}</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ $localize('/segnalazioni') }}">{{ __('fixcity::ticket_detail.breadcrumb.list') }}</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $ticket->name }}</li>
                    </ol>
                </nav>

                <h1 class="title-xxxlarge mb-4">{{ $ticket->name }}</h1>

                @auth
                    @livewire(\Modules\Fixcity\Filament\Widgets\TicketCitizenRatingPromptWidget::class, ['ticketId' => $ticket->id])
                @endauth

                <div class="card shadow-sm mb-4" data-element="ticket-meta">
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="text-paragraph-small text-muted">{{ __('fixcity::ticket_detail.meta.type') }}</div>
                            <div class="fw-semibold">{{ $typeLabel !== '' ? $typeLabel : $na }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="text-paragraph-small text-muted">{{ __('fixcity::ticket_detail.status.label') }}</div>
                            <div class="fw-semibold text-capitalize">{{ $statusLabel !== '' ? $statusLabel : $na }}</div>
                        </div>
                        @if ($address !== '')
                            <div class="mb-3">
                                <div class="text-paragraph-small text-muted">{{ __('fixcity::ticket_detail.where.address') }}</div>
                                <div class="fw-semibold">{{ $address }}</div>
                            </div>
                        @endif
                        @if ((string) $ticket->content !== '')
                            <div>
                                <div class="text-paragraph-small text-muted">{{ __('fixcity::ticket_detail.description.title') }}</div>
                                <div>{{ $ticket->content }}</div>
                            </div>
                        @endif
                    </div>
                </div>

                @if ($images->isNotEmpty())
                    <div class="card shadow-sm mb-4" data-element="ticket-images">
                        <div class="card-body">
                            <h2 class="title-medium-2-semi-bold mb-3">{{ __('fixcity::ticket_detail.images') }}</h2>
                            <div class="row g-3">
                                @foreach ($images as $image)
                                    <div class="col-12 col-md-6">
                                        <img
                                            src="{{ $image->getFullUrl() }}"
                                            alt="{{ __('fixcity::ticket_detail.image_alt', ['name' => $ticket->name]) }}"
                                            class="img-fluid rounded"
                                            loading="lazy"
                                        >
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>
