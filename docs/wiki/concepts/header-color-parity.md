# header color parity

## Analisi

Dall'analisi visuale del riferimento [Design Comuni - Segnalazione 01 Privacy](https://italia.github.io/design-comuni-pagine-statiche/sito/segnalazione-01-privacy.html), i colori dell'header devono essere:

1. **Top Slim Header** (Nome Regione, Lingua, Accedi):
   - Background: `var(--dc-blue-dark)` -> `#003D73`.
   - Text: Bianco.
2. **Main Center Header** (Logo Comune, Nome Comune, Social):
   - Background: `var(--dc-blue)` -> `#0066CC`.
   - Text: Bianco.
3. **Navbar Header** (Menu Amministrazione, Novità, Servizi, Vivere il Comune):
   - Background: `var(--dc-blue)` -> `#0066CC`.
   - Text: Bianco.

## Stato Attuale (Sixteen Theme)

- Slim Header: Corretto (#003D73).
- Center Header: **ERRATO** (Verde `#007A52`).
- Navbar: **ERRATO** (Verde `#007A52`).

## Azione di Parity

Allineare i token di background in `app.css` per riflettere il Blu istituzionale del riferimento statico.
