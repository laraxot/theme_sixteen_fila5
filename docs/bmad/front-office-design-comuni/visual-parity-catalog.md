---
title: "Design Comuni complete page parity catalogue"
type: bmad-page-catalog
status: in-progress
source: https://italia.github.io/design-comuni-pagine-statiche/
updated: 2026-10-17
tags: [docs, sixteen, bmad]
qmd: "purpose sixteen"
---

# Purpose

Every HTML page linked by the official Design Comuni static catalogue is a
separate parity work item. The local implementation uses `/it/tests/<slug>`,
JSON content under `laravel/config/local/fixcity/database/content/pages/`, and
the existing Sixteen theme shell. No Bootstrap Italia runtime is introduced.

## Page-level contract

For each row:

1. create or update its JSON page (`id` and `slug` are stable CMS identifiers);
2. map every visible region to a Sixteen block and document its input data;
3. compare reference/local HTML and screenshots at 375, 768 and 1440 px;
4. require HTTP 200, zero browser errors, no missing images/overflow, HTML
   similarity >= 90% and visual similarity >= 95% before marking `done`;
5. record evidence in the matching story and in `/tmp/fixcity-parity/automated`.

## Complete reference catalogue

| Story | Reference page | Local candidate |
|---|---|---|
| DC-001 | `/` | `/it/tests/` |
| DC-002 | `/servizi/index.html` | `/it/tests/servizi` |
| DC-003 | `/sito/amministrazione.html` | `/it/tests/amministrazione` |
| DC-004 | `/sito/appuntamento-01-ufficio-luogo.html` | `/it/tests/appuntamento-01-ufficio-luogo` |
| DC-005 | `/sito/appuntamento-01-ufficio.html` | `/it/tests/appuntamento-01-ufficio` |
| DC-006 | `/sito/appuntamento-02-data-orario.html` | `/it/tests/appuntamento-02-data-orario` |
| DC-007 | `/sito/appuntamento-03-dettagli.html` | `/it/tests/appuntamento-03-dettagli` |
| DC-008 | `/sito/appuntamento-04-richiedente-autenticato.html` | `/it/tests/appuntamento-04-richiedente-autenticato` |
| DC-009 | `/sito/appuntamento-04-richiedente.html` | `/it/tests/appuntamento-04-richiedente` |
| DC-010 | `/sito/appuntamento-05-riepilogo.html` | `/it/tests/appuntamento-05-riepilogo` |
| DC-011 | `/sito/appuntamento-06-conferma.html` | `/it/tests/appuntamento-06-conferma` |
| DC-012 | `/sito/argomenti.html` | `/it/tests/argomenti` |
| DC-013 | `/sito/argomento.html` | `/it/tests/argomento` |
| DC-014 | `/sito/assistenza-01-dati.html` | `/it/tests/assistenza-01-dati` |
| DC-015 | `/sito/assistenza-02-conferma.html` | `/it/tests/assistenza-02-conferma` |
| DC-016 | `/sito/documenti-dati.html` | `/it/tests/documenti-dati` |
| DC-017 | `/sito/domande-frequenti.html` | `/it/tests/domande-frequenti` |
| DC-018 | `/sito/eventi.html` | `/it/tests/eventi` |
| DC-019 | `/sito/evento-dettaglio.html` | `/it/tests/evento-dettaglio` |
| DC-020 | `/sito/homepage.html` | `/it/tests/homepage` |
| DC-021 | `/sito/lista-categorie.html` | `/it/tests/lista-categorie` |
| DC-022 | `/sito/lista-risorse-categorie.html` | `/it/tests/lista-risorse-categorie` |
| DC-023 | `/sito/lista-risorse.html` | `/it/tests/lista-risorse` |
| DC-024 | `/sito/mappa-sito.html` | `/it/tests/mappa-sito` |
| DC-025 | `/sito/novita-dettaglio.html` | `/it/tests/novita-dettaglio` |
| DC-026 | `/sito/novita.html` | `/it/tests/novita` |
| DC-027 | `/sito/risultati-ricerca.html` | `/it/tests/risultati-ricerca` |
| DC-028 | `/sito/segnalazione-01-privacy.html` | `/it/tests/segnalazione-01-privacy` |
| DC-029 | `/sito/segnalazione-02-dati.html` | `/it/tests/segnalazione-02-dati` |
| DC-030 | `/sito/segnalazione-03-riepilogo.html` | `/it/tests/segnalazione-03-riepilogo` |
| DC-031 | `/sito/segnalazione-04-conferma.html` | `/it/tests/segnalazione-04-conferma` |
| DC-032 | `/sito/segnalazione-area-personale.html` | `/it/tests/segnalazione-area-personale` |
| DC-033 | `/sito/segnalazione-dettaglio.html` | `/it/tests/segnalazione-dettaglio` |
| DC-034 | `/sito/segnalazioni-elenco.html` | `/it/tests/segnalazioni-elenco` |
| DC-035 | `/sito/servizi-categoria.html` | `/it/tests/servizi-categoria` |
| DC-036 | `/sito/servizi.html` | `/it/tests/servizi` |
| DC-037 | `/sito/servizio-dettaglio.html` | `/it/tests/servizio-dettaglio` |

The verifier discovers this catalogue from the reference index at runtime so
new official links become failing work items automatically.
