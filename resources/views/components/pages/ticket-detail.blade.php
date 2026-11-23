{{-- @see Modules/Fixcity/docs/wiki/concepts/public-ticket-detail-and-follow.md --}}
@php
    $ticketSlug = is_string($slug0 ?? null) ? $slug0 : '';
    abort_unless(ctype_digit($ticketSlug), 404);
    $ticketDetail = app(\Modules\Fixcity\Actions\BuildPublicTicketDetailAction::class)->execute((int) $ticketSlug, auth()->user());
    abort_if($ticketDetail === null, 404);
@endphp
@include('pub_theme::components.blocks.ticket-detail.design-comuni', [
    'detail' => $ticketDetail,
])
