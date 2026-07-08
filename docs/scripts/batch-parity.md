# batch-parity.cjs

- **movement**: moved from theme root to `scripts/` — 2026-05-16
- **deps**: Playwright (`chromium`)
- **run**: `node scripts/batch-parity.cjs`
- **src ref**: https://italia.github.io/design-comuni-pagine-statiche/sito
- **src loc**: http://127.0.0.1:8000/it/tests
- **coverage**: segnalazione-area-personale, ticket-list, segnalazione-dettaglio, segnalazione-01-privacy, segnalazione-02-dati, segnalazione-03-riepilogo, segnalazione-04-conferma
- **output**: stdout table — page | match% | status
- **notes**: extracts fontFamily, fontSize, fontWeight, color, backgroundColor for body, h1/h2-titles, primary-btn, card, a; tolerates Titillium font-family prefix differences; nothing written to disk
