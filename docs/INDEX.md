---
title: "Sixteen: mappa delle sottocartelle di docs/"
type: index
theme: Sixteen
story: dcp-112
created: 2026-10-13
updated: 2026-10-13
qmd: "sixteen docs indice sottocartelle scopo compliance bmad design-comuni visual-parity wiki i18n"
status: draft
tags: [docs, sixteen]
---

# Sixteen: sottocartelle di `docs/` e loro scopo

Nessun file e' stato spostato, rinominato o cancellato per scrivere questa mappa. Per l'indice canonico dei file di radice vedi [00-INDEX.md](00-INDEX.md); `index.md` e' un indice BMAD/QMD piu' vecchio; `00-index.old.md`, `INDEX.historical-bmad.old.md` e `DOCUMENTATION_INDEX.old.md` sono storici. Le story non si cancellano ne' si rinumerano: si collegano o si marcano superseded. I conteggi sono i file presenti il 2026-10-13.

## Da dove partire

| Cartella | Scopo |
|---|---|
| [`compliance/`](compliance/01-matrice-conformita-interfaccia.md) | Nuova (DCP-112). Matrice di conformita' dell'interfaccia: accessibilita', lingue, design, cookie e terze parti, mobile, licenze. Complementa `Modules/Fixcity/docs/compliance/` Scheda per pagina del front office (DCP-186, 2026-10-14): scopo, funzione, politica e coerenza di ogni pagina ed elemento, con difetti e proprietari: [`03-front-office-scheda-per-pagina.md`](compliance/03-front-office-scheda-per-pagina.md). |
| `bmad/` (386) | Story, decisioni, studi e piani BMAD del tema: `stories/` (DCP-xx), `decisions/`, `studies/` |
| `decision-log/` (12) | Decisioni D11-D17 (attenzione: D15, D16 e D17 hanno due file ciascuno) |
| `architecture/` (19) | Regole di architettura: pagine guidate da JSON, routing, scoping CSS (`CSS-SCOPING-RULE.md`) |
| `rules/` (3) | Regole del tema: body senza classi, niente JS inline, architettura delle pagine `tests` |
| `i18n/` (3) | Comportamento multilingua e glossario (DCP-120) |

## Design Comuni e parity

| Cartella | Scopo |
|---|---|
| `design-comuni/` (643) | Integrazione, replica e piani per il kit Design Comuni; componenti, stepper, footer |
| `design-system/` (6) | Sistema di design: `MASTER.md`, README, per pagina |
| `visual-parity/` (280), `visual-comparison/` (224), `visual-analysis/` (53), `comparisons/` (83), `screenshots/` (260) | Misure e confronti visivi con il riferimento, report e screenshot |
| `html-parity-reports/` (29), `html-compare/` (12), `html-structure-analysis/` (4), `html-structure-comparison/` (21), `body-structure-comparison/` (156) | Confronti HTML e di struttura del `<body>` con il riferimento |
| `css/` (10), `css-js-parity/` (2), `ui-fixes/` (14) | Fix e report CSS/JS di parity, decisioni sulle correzioni UI |
| `pages/` (334), `analysis/` (142), `homepage/` (1) | Analisi per pagina e report di batch |
| `agid/` (6) | Analisi di conformita' AgID e gap comunali (anteriori a DCP-112) |
| `components/` (8), `blocks/` (5) | Documentazione dei componenti e dei blocchi (tassonomia, convenzioni) |
| `auth/` (19) | Analisi e correzioni delle pagine di accesso |
| `wizard/` (1), `best-practices/` (1), `concepts/` (2), `clean-code/` (1), `computing/` (1) | Note tecniche brevi su wizard, pattern, mappa Lit, schema, enum |

## Processo, strumenti e conoscenza

| Cartella | Scopo |
|---|---|
| `stories/` (37) | Story storiche numerate (pre-DCP) |
| `phases/` (2), `implementation/` (2), `roadmap/` (3), `product/` (6) | Fasi, strategia, coordinamento e roadmap di prodotto |
| `build/` (15), `scripts/` (16), `mcp/` (1), `qmd-index/` (1) | Guide di build (Vite, manifest), documentazione degli script, setup MCP, query QMD |
| `wiki/` (276), `llm-wiki/` (9), `second-brain/` (2), `knowledge-pages/` (1), `raw/` (16), `sources/` (2) | Second brain del tema e fonti grezze |
| `prompts/` (338) | Prompt numerati usati nelle sessioni |
| `investigation/` (11), `mappings/` (1) | Indagini sul riferimento e mappature |

## Materiale archiviato o generato

| Cartella | Scopo |
|---|---|
| `Main_files/` (47) | Asset salvati dalla pagina di riferimento |
| `graphify-out/` (1556) | Output generato del grafo (cache, `graph.json`): artefatto, non documentazione |
| `root-md-files/` (2), `root-txt-files/` (2) | File spostati dalla radice del tema (changelog, risultati PHPStan) |

## Regole di manutenzione
- Nuova documentazione di conformita': in `compliance/`; nuove story: in `bmad/stories/` con id `dcp-NNN` libero (verificare con `find`).
- Le matrici dichiarano «conforme» solo con un comando o un file riproducibile; il resto e' NON VERIFICATO con cosa servirebbe.
- Nuovi file `.md` o `.txt` non vanno nella radice del tema (regola di progetto): la documentazione sta qui.
