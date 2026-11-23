{{--
    @see Themes/Sixteen/docs/design-comuni/TICKET-CREATION-WIZARD.md
    The CMS owns the copy and the wizard owns the interaction; this block only
    provides the reusable semantic section boundary between the two.
--}}
@props(['data' => []])

@php
    /** @var array<string, mixed> $data */
    $sectionLabel = (string) data_get($data, 'title', __('fixcity::ticket.page.title.label'));
@endphp

<section
    class="ticket-create-block"
    aria-label="{{ $sectionLabel }}"
    data-block="ticket-create"
>
    @livewire(\Modules\Fixcity\Filament\Widgets\CreateTicketWizardWidget::class, ['blockData' => $data])
</section>
