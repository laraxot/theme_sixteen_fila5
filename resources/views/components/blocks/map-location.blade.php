@props([
    'label' => 'Luogo',
    'placeholder' => 'Indirizzo del disservizio',
    'use_location_button' => 'Usa la tua posizione',
    'map_url' => 'https://maps.google.com',
    'map_embed' => true,
])

<div class="mb-4 map-location-block">
    <label for="map_location" class="form-label font-bold text-[#191919]">{{ $label }}</label>
    <div class="flex gap-2 mb-2">
        <span class="bg-[#007a52] text-white rounded-l px-3 py-2 flex items-center"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#007A52" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg></span>
        <input type="text" id="map_location" class="flex-1 border border-slate-300 rounded-r px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#007a52]" placeholder="{{ $placeholder }}" aria-required="true">
        <button type="button" class="bg-[#007a52] text-white px-4 py-2 rounded hover:bg-[#005a3a] transition" onclick="(function(){if(navigator.geolocation){navigator.geolocation.getCurrentPosition(function(p){document.getElementById('map_location').value=p.coords.latitude+', '+p.coords.longitude},function(){document.getElementById('map_location').value='Firenze (43.7696, 11.2558)';});}else{document.getElementById('map_location').value='Firenze (43.7696, 11.2558)';}})();">{{ $use_location_button }}</button>
    </div>
    <div class="map-embed rounded overflow-hidden shadow-sm" style="height: 320px; background:#f3f3f3; border: 1px solid #e5e5e5;">
        <iframe src="{{ $map_url }}" width="100%" height="100%" style="border:0;" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</div>
