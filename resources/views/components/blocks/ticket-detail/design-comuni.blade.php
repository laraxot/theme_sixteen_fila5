{{--
    Dettaglio PUBBLICO di una segnalazione (pagina reale /{lang}/tickets/{id}), DCP-148. Parametro: $detail (BuildPublicTicketDetailAction,
    l'unica fonte dei campi esposti: mai codice di tracciamento, autore, email, immagini). Non c'e' un riferimento Design Comuni da
    replicare (sito/segnalazione-dettaglio.html e' la pagina di servizio, non il dettaglio di un ticket): stesso chrome, stesso breadcrumb
    e stesse classi dell'elenco `ticket-list/design-comuni`, contenuto con uno scopo per elemento.
    L'indirizzo e' una riga etichetta + valore (il partial info-summary ha un'intestazione vuota e padding da riepilogo del wizard).
    Mappa: `coordinate-picker-lit` in sola lettura (marker fisso con icona del tipo e colore dello stato, niente tab stop), con alternativa testuale (riga Indirizzo + aria-label).
    Segui: form POST con CSRF (FollowTicketAction) per il cittadino loggato; per l'ospite un link al login. Testi: lang fixcity::ticket_detail.
--}}
@php
    $locale = app()->getLocale();
    $base = '/'.$locale.'/tickets';
    $t = static fn (string $key, array $replace = []): string => __('fixcity::ticket_detail.'.$key, $replace);
    $parts = 'pub_theme::components.blocks.report-partials';
    $created = $detail['created_date'] !== '' ? \Illuminate\Support\Carbon::parse($detail['created_date'])->locale($locale) : null;
    $hasPoint = $detail['latitude'] !== null && $detail['longitude'] !== null;
    $mapLabel = $detail['address'] !== '' ? $t('where.map_at', ['address' => $detail['address']]) : $t('where.map');
    $mapState = json_encode(['latitude' => $detail['latitude'], 'longitude' => $detail['longitude']]);
    // stesso marker della mappa pubblica: icona fixcity::svg del tipo e colore dello stato (le due Action che costruiscono il GeoJSON)
    $markerType = app(\Modules\Fixcity\Actions\ResolveTicketTypeMarkerPropertiesAction::class)->execute($detail['type']);
    $markerColor = app(\Modules\Fixcity\Actions\ResolveTicketStatusMarkerPropertiesAction::class)->execute($detail['status'])['color'];
    $mapLabels = json_encode(['zoom_in' => __('geo::coordinate-picker.zoom_in'), 'zoom_out' => __('geo::coordinate-picker.zoom_out')], JSON_UNESCAPED_UNICODE);
    $followMessage = session('ticket_follow');
    $followMessage = in_array($followMessage, ['followed', 'unfollowed'], true) ? $followMessage : null;
    $followUrl = $base.'/'.$detail['id'].'/follow';
    $isLogged = auth()->check();
    // CommentsWidget canonico (Comment filament-blueprint): mount per chi può vieware
    // il ticket; guest non vede thread privati (lifecycle blueprint).
    $ticketCommentable = $isLogged
        ? \Modules\Fixcity\Models\Ticket::query()->find($detail['id'])
        : null;
    $canAccessComments = $ticketCommentable instanceof \Modules\Fixcity\Models\Ticket
        && \Illuminate\Support\Facades\Gate::forUser(auth()->user())->allows('view', $ticketCommentable);
    $canWriteComments = $canAccessComments
        && \Illuminate\Support\Facades\Gate::forUser(auth()->user())->allows('update', $ticketCommentable);
    $ticketForNextSteps = $ticketCommentable instanceof \Modules\Fixcity\Models\Ticket
        ? $ticketCommentable
        : \Modules\Fixcity\Models\Ticket::query()->find($detail['id']);
    $nextSteps = $ticketForNextSteps instanceof \Modules\Fixcity\Models\Ticket
        ? app(\Modules\Fixcity\Actions\BuildTicketNextStepsAction::class)->execute($ticketForNextSteps)
        : null;
    // dati per il partial condiviso del breadcrumb: voci localizzate, mai '#'
    $partialData = ['breadcrumb' => ['items' => [
        ['label' => $t('breadcrumb.home'), 'url' => '/'.$locale],
        ['label' => $t('breadcrumb.list'), 'url' => $base],
    ], 'current' => $detail['title']]];
    $d = static fn (string $key, mixed $default = '') => data_get($partialData, $key, $default);
@endphp
<div class="container" id="main-container">
    <div class="row justify-content-center mb-4 mb-md-40">
        <div class="col-12 col-lg-10">
            @include($parts.'.breadcrumb')
            @if ($followMessage !== null)
                <div class="alert alert-success" role="status">
                    {{ $t('follow.'.$followMessage) }}
                    @if ($followMessage === 'followed')
                        <a href="/{{ $locale }}/area-personale/seguite">{{ $t('follow.list_link') }}</a>
                    @endif
                </div>
            @endif
            <div class="cmp-heading p-0">
                <h1 class="title-xxxlarge">{{ $detail['title'] }}</h1>
                <ul class="td-meta subtitle-small">
                    <li>{{ $t('meta.number', ['id' => $detail['id']]) }}</li>
                    @if ($detail['type_label'] !== '')
                        <li>{{ $t('meta.type') }}: {{ $detail['type_label'] }}</li>
                    @endif
                    @if ($created !== null)
                        <li>{{ $t('meta.date') }} <time datetime="{{ $detail['created_date'] }}">{{ $created->translatedFormat('j F Y') }}</time></li>
                    @endif
                </ul>
                <p class="td-status mb-0"><span class="visually-hidden">{{ $t('status.label') }}: </span><span class="chip chip-simple chip-lg"><span class="chip-label">{{ $detail['status_label'] }}</span></span></p>
            </div>
        </div>
        <hr class="d-none d-lg-block mt-30 mb-2">
    </div>
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <section aria-labelledby="td-where">
                <h2 class="title-xxlarge mb-3" id="td-where">{{ $t('where.title') }}</h2>
                <p class="text-paragraph-small mb-1">{{ $t('where.address') }}</p>
                <p class="title-small-semi-bold mb-0">{{ $detail['address'] !== '' ? $detail['address'] : $t('where.no_address') }}</p>
                @if ($hasPoint)
                    <div class="td-map mt-3" role="region" aria-label="{{ $mapLabel }}">
                        <coordinate-picker-lit readonly state="{{ $mapState }}" zoom="16" height="18rem" labels="{{ $mapLabels }}" marker-icon-url="{{ $markerType['iconUrl'] }}" marker-color="{{ $markerColor }}" marker-label="{{ $detail['type_label'] }}"></coordinate-picker-lit>
                    </div>
                @endif
            </section>
            <section aria-labelledby="td-description" class="mt-40">
                <h2 class="title-xxlarge mb-3" id="td-description">{{ $t('description.title') }}</h2>
                @if (trim($detail['description']) !== '')
                    <p class="text-paragraph td-prose">{!! nl2br(e($detail['description'])) !!}</p>
                @else
                    <p class="text-paragraph">{{ $t('description.empty') }}</p>
                @endif
            </section>
            <section aria-labelledby="td-status-title" class="mt-40">
                <h2 class="title-xxlarge mb-3" id="td-status-title">{{ $t('status.title') }}</h2>
                @include('pub_theme::components.blocks.ticket-detail.timeline')
            </section>
            @if ($nextSteps !== null)
                <section aria-labelledby="td-next-steps-title" class="mt-40">
                    <h2 class="title-xxlarge mb-3" id="td-next-steps-title">{{ $t('next_steps.title') }}</h2>
                    <div class="cmp-card p-4">
                        <h3 class="title-medium mb-2">{{ $nextSteps['title'] }}</h3>
                        <p class="text-paragraph mb-2">{{ $nextSteps['description'] }}</p>
                        <p class="text-paragraph-small mb-0">{{ $t('next_steps.deadline_not_configured') }}</p>
                    </div>
                </section>
            @endif
            @auth
                @if ($canAccessComments)
                    <section aria-labelledby="td-comments-title" class="mt-40">
                        <h2 class="title-xxlarge mb-3" id="td-comments-title">Commenti e aggiornamenti</h2>
                        @livewire(\Modules\Comment\Filament\Widgets\Commentable\CommentsWidget::class, [
                            'commentableType' => $ticketCommentable::class,
                            'commentableKey' => (string) $ticketCommentable->getKey(),
                            'readOnly' => false,
                            'hideNotifications' => true,
                            'noReplies' => false,
                            'noReactions' => true,
                        ], key('ticket-comments-'.$ticketCommentable->getKey()))
                    </section>
                @endif
            @endauth
            <section aria-labelledby="td-actions-title" class="mt-40 mb-4">
                <h2 class="title-xxlarge mb-3" id="td-actions-title">{{ $t('actions.title') }}</h2>
                <div class="td-actions">
                    @if ($isLogged)
                        <form method="post" action="{{ $followUrl }}">
                            @csrf
                            <input type="hidden" name="following" value="{{ $detail['is_following'] ? '0' : '1' }}">
                            <button type="submit" @class(['btn py-3', 'btn-outline-primary' => $detail['is_following'], 'btn-primary' => ! $detail['is_following']])>{{ $t($detail['is_following'] ? 'actions.unfollow' : 'actions.follow') }}</button>
                        </form>
                    @else
                        <a href="/{{ $locale }}/auth/login" class="btn btn-primary py-3">{{ $t('actions.login') }}</a>
                    @endif
                    <a href="{{ $base }}" class="btn btn-outline-primary py-3">{{ $t('actions.back') }}</a>
                    <a href="{{ $base }}/create" class="btn btn-outline-primary py-3">{{ $t('actions.new') }}</a>
                </div>
                <p class="subtitle-small mt-3 mb-0">{{ $t($isLogged ? 'actions.follow_help' : 'actions.guest_help') }}</p>
            </section>
        </div>
    </div>
</div>
