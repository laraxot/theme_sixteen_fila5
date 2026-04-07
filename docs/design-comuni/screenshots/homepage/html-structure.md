# HTML Structure Comparison: homepage

**Data:** 2026-04-07
**Reference:** https://italia.github.io/design-comuni-pagine-statiche/sito/homepage.html
**Locale:** http://127.0.0.1:8000/it/tests/homepage

## Struttura

| Metrica | Reference | Locale |
|---------|-----------|--------|
| Nodi totali | 844 | 1015 |
| Differenza | - | +171 |

## Risultato Confronto

| Metrica | Valore |
|---------|--------|
| Match stimato | 94.1% |
| Problemi strutturali | 50 |
| Stato | ✅ PASS |

## Differenze Strutturali

- Extra classes on <body>: dc-homepage-parity, page-tests, page-tests-homepage
-   └   └   └   └   └   └   └   └ Missing classes on <a>: btn-full, btn-primary
-   └   └   └   └   └   └   └   └ Extra classes on <a>: btn-outline-light
-   └   └   └   └   └   └   └   └ Children count mismatch on <a>: 2 vs 1
-   └   └   └   └   └   └   └   └   └ Tag mismatch: <span> vs <svg>
-   └   └   └   └   └   └   └   └   └ Missing classes on <span>: rounded-icon
-   └   └   └   └   └   └   └   └   └ Extra classes on <svg>: icon, icon-white
-   └   └   └   └   └   └   └   └   └   └ Tag mismatch: <svg> vs <use>
-   └   └   └   └   └   └   └   └   └   └ Missing classes on <svg>: icon, icon-primary
-   └   └   └   └   └   └   └   └   └   └ Children count mismatch on <svg>: 1 vs 0
-   └   └   └   └   └   └   └   └   └   └   └ Reference has <use> but local doesn't
-   └   └   └   └   └   └   └   └   └ Reference has <span> but local doesn't
-   └   └   └   └   └   └   └ Children count mismatch on <div>: 2 vs 3
-   └   └   └   └   └   └   └   └ Tag mismatch: <div> vs <button>
-   └   └   └   └   └   └   └   └ Missing classes on <div>: it-brand-wrapper
-   └   └   └   └   └   └   └   └ Extra classes on <button>: custom-navbar-toggler, d-lg-none, me-3
-   └   └   └   └   └   └   └   └   └ Tag mismatch: <a> vs <svg>
-   └   └   └   └   └   └   └   └   └ Extra classes on <svg>: icon
-   └   └   └   └   └   └   └   └   └ Children count mismatch on <a>: 2 vs 1
-   └   └   └   └   └   └   └   └   └   └ Tag mismatch: <svg> vs <use>
-   └   └   └   └   └   └   └   └   └   └ Missing classes on <svg>: icon
-   └   └   └   └   └   └   └   └   └   └ Children count mismatch on <svg>: 1 vs 0
-   └   └   └   └   └   └   └   └   └   └   └ Reference has <image> but local doesn't
-   └   └   └   └   └   └   └   └   └   └ Reference has <div> but local doesn't
-   └   └   └   └   └   └   └   └ Missing classes on <div>: it-right-zone
-   └   └   └   └   └   └   └   └ Extra classes on <div>: it-brand-wrapper
-   └   └   └   └   └   └   └   └ Children count mismatch on <div>: 2 vs 1
-   └   └   └   └   └   └   └   └   └ Tag mismatch: <div> vs <a>
-   └   └   └   └   └   └   └   └   └ Missing classes on <div>: d-lg-flex, d-none, it-socials
-   └   └   └   └   └   └   └   └   └   └ Tag mismatch: <span> vs <svg>
-   └   └   └   └   └   └   └   └   └   └ Extra classes on <svg>: icon
-   └   └   └   └   └   └   └   └   └   └ Children count mismatch on <span>: 0 vs 1
-   └   └   └   └   └   └   └   └   └   └   └ Local has <image> but reference doesn't
-   └   └   └   └   └   └   └   └   └   └ Tag mismatch: <ul> vs <div>
-   └   └   └   └   └   └   └   └   └   └ Extra classes on <div>: it-brand-text
-   └   └   └   └   └   └   └   └   └   └ Children count mismatch on <ul>: 6 vs 2
-   └   └   └   └   └   └   └   └   └   └   └ Tag mismatch: <li> vs <div>
-   └   └   └   └   └   └   └   └   └   └   └ Extra classes on <div>: it-brand-title
-   └   └   └   └   └   └   └   └   └   └   └ Children count mismatch on <li>: 1 vs 0
-   └   └   └   └   └   └   └   └   └   └   └   └ Reference has <a> but local doesn't
-   └   └   └   └   └   └   └   └   └   └   └ Tag mismatch: <li> vs <div>
-   └   └   └   └   └   └   └   └   └   └   └ Extra classes on <div>: d-md-block, d-none, it-brand-tagline
-   └   └   └   └   └   └   └   └   └   └   └ Children count mismatch on <li>: 1 vs 0
-   └   └   └   └   └   └   └   └   └   └   └   └ Reference has <a> but local doesn't
-   └   └   └   └   └   └   └   └   └   └   └ Reference has <li> but local doesn't
-   └   └   └   └   └   └   └   └   └   └   └ Reference has <li> but local doesn't
-   └   └   └   └   └   └   └   └   └   └   └ Reference has <li> but local doesn't
-   └   └   └   └   └   └   └   └   └   └   └ Reference has <li> but local doesn't
-   └   └   └   └   └   └   └   └   └ Reference has <div> but local doesn't
-   └   └   └   └   └   └   └   └ Local has <div> but reference doesn't

... e altri 47 dettagli

## File Generati

| File | Descrizione |
|------|-------------|
| [reference-structure.txt](reference-structure.txt) | Struttura DOM reference |
| [local-structure.txt](local-structure.txt) | Struttura DOM locale |
| [analisi.md](analisi.md) | Analisi visiva |

---
*Generato automaticamente da compare-html.js*
