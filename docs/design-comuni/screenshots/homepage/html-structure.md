# HTML Structure Comparison: homepage

**Data:** 2026-04-07
**Reference:** https://italia.github.io/design-comuni-pagine-statiche/sito/homepage.html
**Locale:** http://127.0.0.1:8000/it/tests/homepage

## Struttura

| Metrica | Reference | Locale |
|---------|-----------|--------|
| Nodi totali | 844 | 9025 |
| Differenza | - | +8181 |

## Risultato Confronto

| Metrica | Valore |
|---------|--------|
| Match stimato | 98.9% |
| Problemi strutturali | 9 |
| Stato | ✅ PASS |

## Differenze Strutturali

- Extra classes on <body>: antialiased, bg-neutral-50, dark:bg-neutral-900, dark:text-white, font-sans...
- Children count mismatch on <body>: 5 vs 1
-   └ Missing classes on <div>: skiplink
-   └ Extra classes on <div>: min-h-dvh
-   └ Children count mismatch on <div>: 2 vs 9
-   └   └ Tag mismatch: <a> vs <section>
-   └   └ Missing classes on <a>: visually-hidden-focusable
-   └   └ Extra classes on <section>: border-dashed, border-neutral-300, border-x, dark:border-white/[9%], max-w-7xl...
-   └   └ Children count mismatch on <a>: 0 vs 1
-   └   └   └ Local has <div> but reference doesn't
-   └   └ Tag mismatch: <a> vs <div>
-   └   └ Missing classes on <a>: visually-hidden-focusable
-   └   └ Extra classes on <div>: h-0, relative, w-full
-   └   └ Children count mismatch on <a>: 0 vs 1
-   └   └   └ Local has <div> but reference doesn't
-   └   └ Local has <section> but reference doesn't
-   └   └ Local has <div> but reference doesn't
-   └   └ Local has <section> but reference doesn't
-   └   └ Local has <div> but reference doesn't
-   └   └ Local has <section> but reference doesn't
-   └   └ Local has <div> but reference doesn't
-   └   └ Local has <section> but reference doesn't
-   └ Reference has <header> but local doesn't
-   └ Reference has <main> but local doesn't
-   └ Reference has <div> but local doesn't
-   └ Reference has <footer> but local doesn't


## File Generati

| File | Descrizione |
|------|-------------|
| [reference-structure.txt](reference-structure.txt) | Struttura DOM reference |
| [local-structure.txt](local-structure.txt) | Struttura DOM locale |
| [analisi.md](analisi.md) | Analisi visiva |

---
*Generato automaticamente da compare-html.js*
