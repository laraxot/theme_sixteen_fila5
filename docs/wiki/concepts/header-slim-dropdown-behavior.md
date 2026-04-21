# Header slim: dropdown lingua e utente (Sixteen)

## Scopo

La slim bar è il micro-contesto **istituzionale** (Regione / accesso lingua / area personale). I dropdown devono aprirsi e chiudersi in modo **prevedibile**, senza competere con overlay Filament/Livewire e **senza** `display: inline` lasciato sporco da vecchie chiusure JS.

## Regola operativa

1. **Markup:** `data-bs-toggle="dropdown"` + `.dropdown-menu` come da Bootstrap Italia (nomi classe), comportamento gestito da `Themes/Sixteen/resources/js/app.js` (no seconda Alpine per questi due controlli salvo refactor esplicito).
2. **Chiusura click esterno:** il listener su `document` deve ignorare i click che avvengono su `[data-bs-toggle="dropdown"]` o dentro `.dropdown-menu`, così non si richiede `stopPropagation` sul toggle e si riducono race con Livewire.
3. **CSS display:** preferire classe `.show` + CSS (`style-apply` / `segnalazione-parity`); dopo chiusura usare `removeProperty('display')` sul menu se era stato forzato inline.
4. **Stacking:** `.it-header-slim-wrapper .dropdown-menu` usa `z-index` elevato (es. 2000) e `overflow: visible` sulla right zone — **non** basarsi su selettori `.page-content[data-slug=...]` per l’header: l’header nel layout vive **fuori** da `.page-content`, quelle regole erano inefficaci per il DOM reale.
5. **Colore slim:** top bar istituzionale = token `--dc-blue-dark` (#003d73); CTA compatto login/utente in slim = `--dc-blue-primary` (#0066cc), coerente con linee guida Design Comuni e `design-comuni-tokens.css`. La banda **centrale** resta verde comune (`--dc-green`).

## Riferimenti

- Codice owner: `resources/views/components/sections/header/v1.blade.php`, `resources/js/app.js`, token `resources/css/components/design-comuni-tokens.css`.
- Story: `_bmad-output/implementation-artifacts/7-54-segnalazione-crea-header-slim-dropdowns-data-bs-toggle-unification.md` (unificazione `data-bs-toggle` vs Alpine su wizard)
- Story legacy: `_bmad-output/implementation-artifacts/8-33-segnalazione-crea-header-language-and-user-dropdown-functional-color-parity.md`
- Parallelo auth: [header-authenticated-state](./header-authenticated-state.md)
- Reference statico slim + utente: [graduatoria-area-personale](https://italia.github.io/design-comuni-pagine-statiche/servizi/graduatoria-area-personale.html)

## Backlink

- [Sixteen wiki index](../index.md)
- [Root wiki log](../../../../../docs/wiki/log.md)
