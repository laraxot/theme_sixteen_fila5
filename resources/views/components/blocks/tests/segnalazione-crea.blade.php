@props(['data' => []])

<div class="mx-auto max-w-3xl p-4 md:p-8 bg-white rounded-2xl shadow-md border border-emerald-100" aria-live="polite" aria-atomic="false">
    @livewire(\Modules\Fixcity\Filament\Widgets\CreateTicketWizardWidget::class, ['blockData' => $data])
    {{-- Mappa geo per step 2 (dati-di-segnalazione): visibile anche senza HTTPS (SVG inline) --}}
    <div class="mt-6">
        <x-blocks.geo.mappa-static :lat="(float)($data['lat'] ?? 41.89)" :lng="(float)($data['lng'] ?? 12.49)" label="{{ $data['label'] ?? 'Danno da riparare' }}" />
    </div>
</div>
