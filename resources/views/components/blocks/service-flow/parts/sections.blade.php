{{-- Elenco di sezioni: ogni voce ha `type` = nome del file in sections/. Un tipo sconosciuto non produce nulla (nessun errore). --}}
@foreach ($sections ?? [] as $section)
    @includeIf('pub_theme::components.blocks.service-flow.sections.'.preg_replace('/[^a-z0-9-]/', '', (string) ($section['type'] ?? '')), ['section' => $section])
@endforeach
