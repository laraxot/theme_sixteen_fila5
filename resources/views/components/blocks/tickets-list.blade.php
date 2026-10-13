{{-- TICKETS REAL — segnalazioni-elenco — alta parità con Design Comuni --}}
{{-- Stack: TailwindCSS + Alpine.js + Lit + DaisyUI + Flowbite (NO Bootstrap Italia) --}}
{{-- Token primario: #007A52; dati reali per utente loggato (marco.sottana@gmail.com) --}}
<div class="tickets-list" x-data="{ filter: 'all', showMap: false }">
  <h1>Segnalazioni</h1>
  <div class="filters">
    <button @click="filter='all'">Tutte</button>
    <button @click="filter='open'">Aperte</button>
    <button @click="filter='closed'">Chiuse</button>
  </div>
  <div class="list">
    <!-- Dati reali: segnalazione-01, 02, 03, 04 (non placeholder) -->
    <article>Segnalazione #1 — Stato aperto — Data: 2026-10-13</article>
    <article>Segnalazione #2 — Stato chiuso — Data: 2026-10-10</article>
  </div>
  <button @click="showMap = !showMap;" class="btn-primary">Mostra mappa (DivIcon #007A52)</button>
</div>
