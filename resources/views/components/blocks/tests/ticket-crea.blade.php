@props(['data' => []])

{{-- Legacy CMS alias; keep it resolvable for existing tenant payloads. --}}
{{-- @see Themes/Sixteen/docs/design-comuni/TICKET-CREATION-WIZARD.md --}}
@include('pub_theme::components.blocks.ticket-create.design-comuni', ['data' => $data])
