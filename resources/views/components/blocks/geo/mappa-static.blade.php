@props(['lat'=>41.89, 'lng'=>12.49, 'label'=>'Luogo del danno'])
<div class="geo-map-container bg-emerald-50 rounded-xl p-4 shadow-sm border border-emerald-100">
  <h3 class="text-emerald-800 font-bold mb-2">Localizzazione del danno</h3>
  <div class="map-canvas h-64 bg-gradient-to-br from-emerald-100 to-teal-50 rounded-lg flex items-center justify-center relative overflow-hidden">
    {{-- Mappa statica con pin centrato sulle coordinate del danno --}}
    <svg viewBox="0 0 400 300" class="w-full h-full" aria-label="Mappa con pin a {{ $label }}">
      <rect width="400" height="300" fill="#e8f5e9"/>
      <path d="M0 150 Q100 100 200 150 T400 150 L400 300 L0 300 Z" fill="#c8e6c9" opacity="0.6"/>
      <circle cx="200" cy="150" r="8" fill="#007a52" stroke="#fff" stroke-width="2"/>
      <text x="200" y="170" text-anchor="middle" fill="#17324d" font-size="10">{{ $label }}</text>
    </svg>
  </div>
  <p class="text-xs text-emerald-600 mt-2">Coordinate: {{ $lat }}, {{ $lng }}</p>
</div>
