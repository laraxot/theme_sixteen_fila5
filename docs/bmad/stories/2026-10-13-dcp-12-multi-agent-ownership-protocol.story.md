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
tags: [docs, sixteen, bmad]
---

# DCP-12: protocollo di proprieta' dei file tra agenti

## Evidenza
Il 2026-10-13 hanno modificato gli stessi file nello stesso tempo: questa sessione, codex, opencode, qwen e omp. Conseguenze: layout
`replica.blade.php` riscritto in pochi minuti da un altro agente, `index.md` modificato mentre lo leggevo, `homepage.json` duplicato con slug identico (500),
`manifest.json` sovrascritto da build concorrenti, pagine Folio create e cancellate da agenti diversi.

## Regole nuove emerse a fine giornata
- **Vietate le regole a mano con `.dc-page` nel selettore**: il plugin di isolamento le salta e raddoppiano margini/padding o forzano colori (`!important` anche in hover). Gli override motivati stanno solo in `resources/css/design-comuni/overrides.css`, con il perche' in commento.
- Non copiare dal riferimento un `id` gia' presente nel layout (`main-container`): ID duplicato = HTML non valido e regole legacy `#main-container` che si applicano due volte.
- Il file `search-results-parity.css` e il blocco in fondo ad `app.css` (pulsante "Cerca") di un altro agente sono stati ripuliti dalle regole `.dc-page` (backup nello scratchpad della sessione).

## Da fare
1. Un file `docs/prompts/homepage/00-COORDINATION.md` (riscritto, quello attuale descrive una corsia rimossa) con tabella file -> proprietario -> scadenza, aggiornata a inizio e fine lavoro.
2. Abitudine obbligatoria prima di scrivere: `find <dir> -mmin -10`, `git diff <file>`, `ps -eo pid,etimes,args | grep -E "claude|codex|opencode|qwen|omp"`; modifiche ancorate e idempotenti; backup nello scratchpad.
3. Build: una sola per volta (`npm run build` richiede 11 secondi); il manifest si legge dopo la build, mai si assume.
4. Quando due approcci confliggono, si confrontano **con i numeri del gate** e si scrive il risultato nel file di coordinamento.

## Criteri di accettazione
- Il file di coordinamento e' corretto e referenziato da `index.md`; nessuna modifica concorrente non dichiarata nella sessione successiva.
