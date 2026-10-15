{{-- Finestre modali nascoste della pagina: ogni voce di `modals` ha `type` = nome del file in modals/ (message, upload, form, dialog). --}}
@foreach (data_get($data, 'modals', []) as $modal)
    @includeIf('pub_theme::components.blocks.service-flow.modals.'.preg_replace('/[^a-z0-9-]/', '', (string) ($modal['type'] ?? '')), ['modal' => $modal])
@endforeach
