---
name: wizard-visual-parity
description: Regola di parità visuale per il wizard Segnalazione (tema Sixteen)
type: concept
---

# Parità Visuale del Wizard Segnalazione – Tema Sixteen

## Contesto
Il wizard **Segnalazione** (`/it/tests/segnalazione-crea`) è riusato dal modulo Fixcity ma deve rispettare le linee guida di *Design Comuni* per coerenza UI.

## Cosa è stato corretto
1. **Bottone Submit** aggiunto nello step `form.riepilogo` con il componente `<x-button type="submit">Invia segnalazione</x-button>`.
2. **Header** allineato usando gli stili globali di `header-footer-colors.css` (nessun selettore per pagina).
3. **Visibilità mappa** garantita rimuovendo gli selector `.segnalazione-wizard-root` e aggiungendo una regola globale in `filament-wizard-parity.css`:
   ```css
   .filament-wizard coordinate-picker-lit {
       display: block !important;
       width: 100% !important;
       min-height: 340px !important;
   }
   ```
4. **Ricostruzione asset** (`npm run build && npm run copy`).

## Best practices
- **CSS globale**: usa classi component‑level (`.filament-wizard …`) anziché selector basati sul percorso o slug della pagina.
- **Componenti Blade**: mantieni il markup del widget *pure*; inserisci logica e stili nei componenti del tema.
- **Livewire root**: ogni widget deve restituire un **singolo** elemento radice; avvolgi il contenuto in `<div>` se necessario.
- **Map visibility**: quando un componente Leaflet è nascosto dietro il wizard, chiama `invalidateSize()` oppure usa un `MutationObserver` (vedi regola *leaflet-wizard-invalidate-size*).

## Bad practices / false friends
- **Selector per pagina** (`.segnalazione-wizard-root`, `[data-slug]`) – viola la regola *No Page‑Specific CSS* e rompe la riusabilità.
- **Multipli root HTML** in Livewire – porta all'errore *Multiple root elements detected* e blocca il rendering.
- **Uso di CDN per assets Leaflet** – porta a fallback 404; utilizza SVG locali per marker (regola *MapMarker Custom Asset*).
- **Hard‑coded classi Bootstrap Italia** (`data-bs-toggle`) – sostituire con `wire:click` o `x‑` Alpine per coerenza.

---
