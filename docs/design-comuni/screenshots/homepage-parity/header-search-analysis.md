# Header And Search Analysis

Torna a: [homepage-parity-report.md](../../homepage-parity-report.md)

Screenshot usati:
- [reference-header-issues.png](./reference-header-issues.png)
- [local-header-issues.png](./local-header-issues.png)

## Delta osservati

1. Centratura
- riferimento: container header `x=52`, `width=1176`
- locale: container header `x=70`, `width=1140`
- effetto percepito: layout locale piu stretto e visivamente spostato a sinistra

2. Social icons
- markup presente
- icone non visibili nel locale perché gli `svg` ereditano `rgb(0, 122, 82)` sul fondo verde invece del bianco

3. Cerca nel sito
- il modal `#search-modal` e gia nascosto sia nel riferimento sia nel locale (`display: none`)
- il blocco visibile nel locale e `.cmp-search` dentro `#head-section`
- nel riferimento quel blocco non e presente nell'above-the-fold (`cmpSearch: null`)

## Direzione fix

- riallineare `container` ai gutter del riferimento
- forzare `color` e `fill` bianchi per le icone social dell'header
- nascondere `.cmp-search` nella homepage parity, lasciando il modal header come punto di accesso corretto

Ritorno: [homepage-parity-report.md](../../homepage-parity-report.md)
