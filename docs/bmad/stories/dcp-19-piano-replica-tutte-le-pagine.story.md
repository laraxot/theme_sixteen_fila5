---
id: dcp-19
title: "DCP-19: piano per replicare tutte le pagine del riferimento (76 pagine, ondate parallele)"
type: story
epic: dc-parity-v2
status: in-review
priority: P0
owner: theme:Sixteen
created: 2026-10-13
updated: 2026-10-13
qmd: "piano replica tutte le pagine design comuni ondate agenti paralleli famiglie ordine casuale bmad"
tags: [docs, sixteen, bmad]
---

# DCP-19: piano di replica di tutte le pagine

## Richiesta
"devi fare tutte le pagine di https://italia.github.io/design-comuni-pagine-statiche/, procedi in ordine random in parallelo sempre utilizzando bmad + second brain".

## Perimetro (misurato sul catalogo)
82 pagine `.html` piu' il catalogo: 35 in `sito/` e 47 in `servizi/` (graduatoria 9 + consenso-privacy, pagamenti-imu 7, pagamenti-multa 9, permessi 7, servizi-pagamento 7, vantaggi 5, accesso-servizio 1, piu' il catalogo `index`). **Fatte e misurate al 2026-10-13: 6** (homepage, risultati-ricerca, appuntamento-02-data-orario, eventi, evento-dettaglio, accesso-servizio). **Restano 76.**

## Metodo
Ricetta unica: `docs/prompts/design-comuni-page-recipe.md` (contratto, passi, proprieta' dei file, formato del report, gate). Ogni pagina = JSON + blocco; gate = `bashscripts/tools/visual/parity-gate.sh` (HTML >= 90 rigoroso, pixel >= 97 a cinque larghezze con altezze identiche).

## Organizzazione in parallelo (e perche')
Le pagine condividono file che non possono essere modificati da piu' agenti insieme: il CSS generato (`components.css`, rigenerato da tutte le pagine), `app.js`, i partial, la build di Vite (manifest). Quindi:
1. **Fase A (agenti in parallelo)**: ogni agente ha una *famiglia* di pagine e **solo** i propri file: JSON `tests.<slug>.json` (tenant e modulo), blocchi in cartelle con il proprio prefisso, immagini nuove, la propria story, righe in coda a due manifest (`scripts/design-comuni-pages.txt`, `design-comuni-states.txt`). Non esegue build ne' rigenerazione.
2. **Orchestratore (una sola esecuzione alla volta, con lock)**: `scripts/regenerate-design-comuni-css.sh` legge i manifest, rigenera il CSS da tutte le pagine e ricompila il tema.
3. **Fase B (verifica e correzioni)**: gate completo per ogni pagina, correzione dei blocchi propri, richieste di modifiche condivise (JS, partial) raccolte e applicate dall'orchestratore.
4. **Chiusura**: epic, indici, memoria e wiki aggiornati dall'orchestratore (gli agenti non toccano `MEMORY.md`, indici, epic).
Concorrenza fra famiglie `servizi/`: la prima (servizi-pagamento) progetta lo scheletro generico `blocks/service-flow/`; le altre (graduatoria, imu, multa, permessi, vantaggi) arrivano dopo e scrivono soprattutto JSON.

## Famiglie e ordine (estratto a caso con `random.shuffle`, 2026-10-13)
Ordine casuale: novita-assistenza, srv-pagamento, srv-vantaggi, liste-servizi, segnalazione, srv-permessi, appuntamento, srv-graduatoria, srv-imu, srv-multa, contenuti.
- **Ondata 1 (in corso):** novita-assistenza (5 pagine, DCP-20), srv-pagamento (7, DCP-21), liste-servizi (6, DCP-22), segnalazione (7, DCP-23), appuntamento (7, DCP-24). Differite per non far divergere lo scheletro `service-flow`: srv-vantaggi, srv-permessi.
- **Ondata 2:** srv-vantaggi (5), srv-permessi (7), srv-graduatoria (10), srv-imu (7), srv-multa (9), contenuti (amministrazione, argomenti, argomento, documenti-dati, domande-frequenti, mappa-sito: 6).

## Rischi noti
- Altri agenti esterni (codex, opencode, qwen, omp) scrivono negli stessi file: due file con lo stesso `slug` danno HTTP 500; la cache delle viste si inquina dopo ogni 500 (`view:clear`).
- Carico del browser: molti gate in parallelo rallentano; un agente esegue un gate alla volta.
- Comportamenti nuovi (tab, form validati, calendari, mappe) richiedono JS condiviso: li raccoglie e li applica l'orchestratore.
- Ogni pagina nuova allarga `components.css` (ora 276 KB): da tenere d'occhio il peso del CSS compilato (3,4 MB raw / 255 KB gzip).

## Criteri di accettazione
Per ogni pagina: gate superato o differenza spiegata (valori di URL), story con l'output del gate, pagina registrata nei manifest; nessuna regressione sulle pagine gia' fatte; `/it` e `/it/tickets` invariati.

## Stato a fine giornata (2026-10-13, misurato)
Tutte le pagine del riferimento hanno una pagina di prova guidata da JSON, con pixel >= 99,5% a 5 larghezze e altezze uguali: sito/ 35, servizi/ 44 (famiglie DCP-20..30 + catalogo `servizi/index.html` in [DCP-31](dcp-31-servizi-index-catalogo-flussi.story.md)) + catalogo `index.html`. Le 2 pagine che il catalogo elenca ma il riferimento non pubblica (`graduatoria-pagamento`, `pagamenti-multa-pagamento`) non hanno parity da dichiarare. HTML rigoroso >= 90 solo su una parte: decisione in [DCP-94](dcp-94-decisione-metrica-html-rigorosa.story.md). Le pagine reali (non di prova) del flusso segnalazione sono nel registro [DCP-97](dcp-97-registro-flusso-tickets-numerazione-e-coordinamento.story.md).

