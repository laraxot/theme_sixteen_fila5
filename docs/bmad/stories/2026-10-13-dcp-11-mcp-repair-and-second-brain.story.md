---
id: dcp-11
title: "DCP-11: riparazione MCP e second brain"
type: story
epic: dc-parity-v2
status: in-progress
priority: P1
owner: theme:Sixteen
created: 2026-10-13
updated: 2026-10-13
qmd: "design comuni parity dcp-11: riparazione mcp e second brain bmad story"
tags: [docs, sixteen, bmad]
---

# DCP-11: riparazione MCP e second brain

## Diagnosi 2026-10-13 (server che non si collegavano)
| Server | Causa | Azione |
|---|---|---|
| `qmd` | `.mcp.json` lanciava `bashscripts/docs/llm-wiki-qmd.sh mcp`, comando inesistente nel wrapper | cambiato in `qmd mcp` (provato: parte e chiude su stdin chiuso) |
| `sqlite` | il pacchetto npm `@modelcontextprotocol/server-sqlite` non esiste (404) | cambiato in `uvx mcp-server-sqlite --db-path ./laravel/database/database.sqlite` (provato) |
| `context-mode` | eseguibile `context-mode` non installato | non toccato: serve capire se serve davvero |
| `gsc`, `mauve`, `pagespeed` | `Connection closed` all'avvio | da diagnosticare uno per uno (non essenziali per la parity) |

I cambi in `.mcp.json` hanno effetto al riavvio della sessione. Il file `laravel/database/database.sqlite` **non esiste**: decidere quale database interrogare (il progetto non usa quel percorso).

## Da fare domani
1. Riavviare la sessione e verificare che `qmd` e `sqlite` risultino connessi; usare `qmd search` come primo passo di ogni task.
2. Dopo ogni sessione: memoria (`memory/` + wiki del tema) e `bash bashscripts/docs/llm-wiki-qmd.sh update`.
3. Valutare MCP utili alla parity senza aggiungere dipendenze non necessarie: Playwright e Puppeteer sono gia' configurati; i tool di `bashscripts/tools/visual` coprono confronto, estrazione CSS e spiegazione della cascata.

## Criteri di accettazione
- `qmd` e `sqlite` connessi; `qmd search "design comuni parity"` restituisce questa story.
