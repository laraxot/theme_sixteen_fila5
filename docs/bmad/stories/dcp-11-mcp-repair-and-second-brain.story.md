---
id: dcp-11
title: "DCP-11: riparazione MCP e second brain"
type: story
epic: dc-parity-v2
status: in-progress
priority: P1
owner: theme:Sixteen
created: 2026-10-13
updated: 2026-10-14
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

## Aggiornamento 2026-10-14: tutti i server avviati e misurati
Strumento nuovo: `bashscripts/tools/mcp/mcp-handshake.py` (handshake `initialize` + `tools/list` con timeout e stderr). Causa vera di ogni guasto, correzioni e prerequisiti del go-live sono in [`bashscripts/docs/mcp-servers.md`](../../../../../../bashscripts/docs/mcp-servers.md).

Correzione alla diagnosi di ieri: **la riga `sqlite` risolta il 2026-10-13 non funzionava**. Il pacchetto esiste, ma `mcp-server-sqlite` crasha con la libreria `mcp` 2.x (`Server` senza `list_resources`); serve `uvx --with 'mcp<2'`. E `database.sqlite` esiste, ma a 0 byte.

| Server | Ieri | Oggi (handshake) |
|---|---|---|
| `sqlite` | «provato» | crash reale, ora OK con `mcp<2` su `test_data.sqlite` (6 tool) |
| `context-mode` | «non toccato» | `npx -y context-mode`, OK (11 tool) |
| `gsc` | «Connection closed» | pacchetto inesistente (E404); sostituito da `mcp-google-search-console`, OK (18 tool) |
| `pagespeed` | «Connection closed» | pacchetto inesistente (E404); quello reale vuole `GOOGLE_API_KEY`: fuori dalla config attiva |
| `mauve` | «Connection closed» | pacchetto inesistente (E404); e' un servizio web del CNR-ISTI: passo manuale del go-live |

Esito: `.mcp.json` della root 10 su 10, `laravel/.mcp.json` 12 su 12 (+1 remoto). Tolto `memory-bank` (scrive nel repo, scansiona 72 mila file, mai avuto dati). `supermemory` passa a server remoto con OAuth.

**Da fare, non mio**: ruotare la chiave di Supermemory, che era in chiaro in un file tracciato (e' nella storia git di `laravel/.mcp.json`).
**Non verificato**: l'uso reale dei tool dopo il riavvio della sessione (le modifiche a `.mcp.json` hanno effetto al riavvio); il login OAuth di `supermemory` e di `gsc`; `search-docs` e gli altri tool di `laravel-boost` come chiamate vere, non solo l'handshake.


## Nota della sessione DCP-179/181/182 (2026-10-14, 19:58): stesso lavoro in parallelo, cosa ho aggiunto
Ho riparato gli stessi server in contemporanea alla sessione sopra (stesse cause, stesse correzioni per `sqlite`, `context-mode`, `gsc`, `fetch`): ho scoperto il doppio lavoro solo rileggendo il file alle 19:44. Riverificato col suo `mcp-handshake.py`: radice **10 su 10 OK** (ruflo 358 tool, token-optimizer 67, sqlite 6, puppeteer 7, context-mode 11, qmd 4, playwright 25, laravel-boost 10, flowbite 2, gsc 18).
Cosa ho aggiunto io, da tenere:
- **Versioni fissate in `.mcp.json`** (regola gia' scritta in `mcp-json-progetto.md`: mai senza versione): `token-optimizer-mcp@2.17.0`, `@playwright/mcp@0.0.83`, `flowbite-mcp@1.1.5`, `context-mode@1.0.169`, `mcp-google-search-console@1.2.0`. In `laravel/.mcp.json` restano `@playwright/mcp@latest` e `flowbite-mcp` senza versione (non toccati: file riscritto da voi alle 19:46).
- **Eccezione misurata: `ruflo` e `puppeteer` NON sono fissati.** Con la versione esplicita (`ruflo@3.56.10`, `server-puppeteer@2025.5.12`) l'handshake non rispondeva per 40-150 s (niente su stdout, niente su stderr); senza versione (`ruflo@latest`, pacchetto nudo) risponde in 2 s. `npm view` dice che sono le stesse versioni (`latest` = 3.56.10; puppeteer ha una sola versione recente, deprecata). **Causa non trovata**: ipotesi, cache `~/.npm/_npx` con due directory per lo stesso pacchetto; non provata. Se un giorno si vuole fissarli, ripetere la prova con `mcp-handshake.py` dopo `rm -rf ~/.npm/_npx/<hash>`.
- `sqlite` punta a `test_data.sqlite` (117 tabelle, **0 righe in `users` e `tickets`**, 1,3 MB, generato il 2026-09-27, ignorato da git): serve a leggere lo schema, non i dati. Per i dati di sviluppo c'e' il database MariaDB, che nessun server di questa lista interroga.
- **Segreto:** in HEAD di `.mcp.json` e `laravel/.mcp.json` compare la stringa `sm_` (forma della chiave Supermemory); la sessione sopra ha gia' segnalato la rotazione. Stesso avviso per `GITHUB_PERSONAL_ACCESS_TOKEN` e `CONTEXT7_API_KEY` del tuo file: nell'ambiente di questa shell `GITHUB_TOKEN`, `CONTEXT7_API_KEY`, `GOOGLE_PAGESPEED_API_KEY`, `SUPERMEMORY_API_KEY` **non sono impostate**, quindi `github` e `context7` partono ma senza credenziale.
- Strumento mio, scartato a favore del vostro: `mcp-probe.py` (scratchpad). Non committato.
