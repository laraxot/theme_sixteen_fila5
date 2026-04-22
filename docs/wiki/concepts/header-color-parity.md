# Header color parity — Design Comuni (kit statico)

## Fonti ufficiali (ordine consigliato)

- Repository HTML/CSS di riferimento: [italia/design-comuni-pagine-statiche](https://github.com/italia/design-comuni-pagine-statiche) (pagine in `src/` / build su GitHub Pages).
- Anteprima pubblicata: [Design Comuni — pagine statiche](https://italia.github.io/design-comuni-pagine-statiche/) (es. flusso segnalazione: `sito/segnalazione-01-privacy.html`, `sito/segnalazione-02-dati.html`, …).

## Due contesti visivi (non mescolare)

### 1) Sito comunale “standard”

Bande blu istituzionali (slim + center + navbar coerenti con Bootstrap Italia / modello comuni). Token di riferimento nel tema: import in `resources/css/app.css` (`design-comuni-global.css`, ecc.).

### 2) Flusso “Segnalazione disservizio” (wizard)

Dal kit statico (es. [segnalazione-02-dati](https://italia.github.io/design-comuni-pagine-statiche/sito/segnalazione-02-dati.html)):

- **Fascia slim** (regione / utilità): toni **verdi** del modello segnalazioni (es. `#00402b` / varianti da token), testo chiaro dove previsto dal prototipo.
- **Fascia menu principale** (`.it-header-navbar-wrapper`): **fondo chiaro** (bianco / grigio chiarissimo), **link scuri**, stato attivo/hover con **accento verde** — **non** una barra intera verde `#007a52` con testo bianco su tutti i `nav-link` (anti-pattern: rompe gerarchia e contrasto del kit).

## Implementazione nel tema Sixteen (DRY + KISS)

1. **Markup:** solo `resources/views/components/sections/header/v1.blade.php` (owner per `<x-section slug="header" />`).
2. **Bootstrap Italia 2.x:** sulla navbar del flusso test `tests/segnalazione-crea`, aggiungere la classe BI **`theme-light-desk`** su `.it-header-navbar-wrapper` (il default CDN è spesso `background: #06c` senza questa modifica).
3. **CSS:** regole dedicate in **`resources/css/app.css`** sotto il modificatore **`.it-header-wrapper.is-segnalazione-crea`** (stesso file già caricato da Vite dopo CDN/Filament sulle route test interessate). **Vietato** duplicare lo stesso blocco in `<style>` nel layout Blade.
4. **Moduli (wizard):** niente colori header inline nel widget Filament — parity solo lato tema.

## Anti-pattern (da non reintrodurre)

- `@if(...) <style> … #007a52 !important` su `.navbar-nav`, `.navbar-secondary`, center wrapper, per “pareggiare” la pagina: fragile, duplica `app.css`, e tende al **verde pieno** lontano dal kit.
- File CSS pubblicati a mano sotto `/themes/Sixteen/css/...` non presenti nel build: rischio **404**; preferire import Vite in `app.css`.

## Collegamenti

- [header section owner rule](../../../../../../docs/wiki/concepts/header-section-owner-rule.md)
- [header authenticated state](./header-authenticated-state.md)
- [header slim dropdown behavior](./header-slim-dropdown-behavior.md)
- [Wiki log tema](../log.md)
