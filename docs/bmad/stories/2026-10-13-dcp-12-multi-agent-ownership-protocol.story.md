---
id: dcp-12
title: "DCP-12: protocollo di proprieta' dei file tra agenti"
type: story
epic: dc-parity-v2
status: todo
priority: P0
owner: theme:Sixteen
created: 2026-10-13
updated: 2026-10-13
qmd: "design comuni parity dcp-12: protocollo di proprieta' dei file tra agenti bmad story"
---

# DCP-12: protocollo di proprieta' dei file tra agenti

## Evidenza
Il 2026-10-13 hanno modificato gli stessi file nello stesso tempo: questa sessione, codex, opencode, qwen e omp. Conseguenze: layout
`replica.blade.php` riscritto in pochi minuti da un altro agente, `index.md` modificato mentre lo leggevo, `homepage.json` duplicato con slug identico (500),
`manifest.json` sovrascritto da build concorrenti, pagine Folio create e cancellate da agenti diversi.

## Da fare
1. Un file `docs/prompts/homepage/00-COORDINATION.md` (riscritto, quello attuale descrive una corsia rimossa) con tabella file -> proprietario -> scadenza, aggiornata a inizio e fine lavoro.
2. Abitudine obbligatoria prima di scrivere: `find <dir> -mmin -10`, `git diff <file>`, `ps -eo pid,etimes,args | grep -E "claude|codex|opencode|qwen|omp"`; modifiche ancorate e idempotenti; backup nello scratchpad.
3. Build: una sola per volta (`npm run build` richiede 11 secondi); il manifest si legge dopo la build, mai si assume.
4. Quando due approcci confliggono, si confrontano **con i numeri del gate** e si scrive il risultato nel file di coordinamento.

## Criteri di accettazione
- Il file di coordinamento e' corretto e referenziato da `index.md`; nessuna modifica concorrente non dichiarata nella sessione successiva.
