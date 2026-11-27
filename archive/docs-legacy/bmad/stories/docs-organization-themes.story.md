---
title: "Organizzazione docs dei temi: nomi kebab-case, niente date, duplicati marcati"
type: story
status: done-with-open-decisions
created: 2026-10-28
updated: 2026-10-28
theme: Sixteen
owner: theme:Sixteen
related:
  - docs-organization-themes.dev.md
  - ../../../../../../docs/wiki/rules/markdown-filename-conventions.md
tags: [docs, themes, naming, kebab-case, redundancy, bmad]
qmd: "docs organization themes rename kebab-case no dates redundancy audit md-filenames superseded_by Meetup TwentyOne Sixteen Two Zero"
---

# Organizzazione docs dei temi: nomi kebab-case, niente date, duplicati marcati

## User Request
"Studiare, aggiornare e organizzare meglio le cartelle docs dentro i temi" seguendo le convenzioni dei `.md`: kebab-case, mai date/timestamp/suffissi `-1 -2` nel nome (la data sta nel frontmatter). Regola canonica: `docs/wiki/rules/markdown-filename-conventions.md`. Vincoli: nessun file cancellato, git solo avanti, nessun commit, nessun codice PHP/blade toccato.

## Analysis
- Ambito: `laravel/Themes/{Meetup,TwentyOne,Sixteen,Two,Zero}/docs/**`. Meetup e TwentyOne sono tracciati dal repo di radice; Sixteen, Two e Zero hanno un `.git` proprio.
- `md-filenames.py check` (la regola applicata dal gate REPO-02) trovava 10 nomi con data o suffisso numerico: 3 audit/note datati in Meetup, 2 audit datati + 2 note `2024_04_17*` + 1 roadmap `2025-Q4-ROADMAP` in TwentyOne, 1 decisione datata in Sixteen, piu' `workflow-summary-jan-22` in Meetup.
- Il check non vede maiuscole e underscore, ma la regola scritta li vieta: ~560 file in 5 temi (quasi tutti in Sixteen). Eccezioni di strumento (`README`, `AGENTS`, `INDEX`, `00-INDEX`) lasciate.
- Redundancy: i temi hanno gia' "gemelli" maiuscolo/minuscolo (es. `ROADMAP.md` e `roadmap.md`) lasciati da un passaggio precedente; molti sono marcati `status: superseded` + `superseded_by`, altri no. Un gemello (`SEO_FRONTEND_OPTIMIZATION_GUIDE.md`) conteneva contenuto piu' recente del canonico: va unito, non marcato alla cieca.
- Il tool `md-filenames.py` tratta come serie di ID le sigle maiuscole con numero (`PAGES_GROUP_3`, `AGID_CHECKLIST_100`): minuscolarle crea un nuovo suffisso numerico vietato.

## Result
- Check nomi sui docs dei temi: 10 violazioni -> 0.
- Rinomine: 10 per data/suffisso + 438 maiuscolo/underscore -> kebab-case (Sixteen 376, TwentyOne 54, Two 6, Meetup 1, Zero 1), con `git mv`; riferimenti riscritti in tutto il repo (1836 sostituzioni nel primo passaggio). Link `.md` relativi rotti (`md-filenames.py links`): 55317 -> 55297, nessuna regressione.
- Rinominati e poi riportati al nome originale 8 file (`PAGES_GROUP_1..7`, `AGID_CHECKLIST_100`): serie di ID. Ripristinati anche 4 falsi positivi di riscrittura fuori dai temi (`REPORT.md`, `README-old.md`, `GSD_WORKFLOW.md`, `filament_4x_upgrade_report.md`: esempi generici in moduli e bashscripts).
- Redundancy: audit TwentyOne `copilot-redundancy-audit.md` unito in `redundancy-audit.md` (addendum) e lasciato come puntatore; 14 gemelli quasi identici marcati `status: superseded` + `superseded_by`; contenuto "Stato implementato" di `SEO_FRONTEND_OPTIMIZATION_GUIDE.md` portato in `seo-frontend-optimization-guide.md`.
- Nessun file cancellato (`git status` ` D` = 0 nei temi), nessun commit. Nessun indice nuovo: ogni tema ha gia' `README.md` e `index.md`.

## Acceptance Criteria
- [x] `md-filenames.py check` sui docs dei temi: 0 violazioni.
- [x] `md-collisions.py plan`: 0 collisioni nei temi.
- [x] Data spostata nel frontmatter (`created`/`updated`/`period`) dove il nome la portava.
- [x] Link aggiornati (indici dei temi, bashscripts, moduli) senza aumentare i link rotti.
- [ ] Decisioni aperte risolte dall'utente (vedi `docs-organization-themes.dev.md`).

## GitHub
TODO (`gh` non installato in questa macchina): issue e discussion da creare/collegare.
