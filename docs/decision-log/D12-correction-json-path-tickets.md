---
type: correction
github_issue: #101
decision: D12
---
# D12 — Correzione percorso JSON tickets/create (errore agente)

**Errore**: Ho dichiarato `tests.tickets.create.json` mancante, ma il percorso corretto è `laravel/config/local/fixcity/database/content/pages/tickets.create.json` (esiste, corretto). Confusione tra pagine `/it/tests/*` (JSON sotto `tests.`) e pagine `/it/tickets/*` (JSON sotto `pages/`).

**Prevenzione (BMAD + second brain)**:
1. Verifica sempre il percorso reale con `ls` prima di dichiarare mancanza.
2. Documenta percorso esatto in `docs/decision-log/` (D12 aggiunto) e `MEMORY.md` con tag `#correction`.
3. Second brain: `kp-...` (correction tracking) — registrare errori agenti per evitare ripetizione.
4. Regola `docs/55-md-conventions.md`: visual-verification include check percorso file.

**Status**: Corretto — `tickets.create.json` esiste ed è corretto. Prossimo turno: implementare wizard Filament su quel JSON.
