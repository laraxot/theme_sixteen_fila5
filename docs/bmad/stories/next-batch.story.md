---
id: dcp-2026-10-14-next-batch
type: bmad-story
status: open
links:
  github_issue: #999
  discussion: #design-comuni
title: "Next Batch — Continuare Domani (BMAD + Second Brain)"
updated: 2026-10-13
tags: [docs, sixteen, bmad]
qmd: "next batch   continuare domani (bmad + second brain) sixteen"
---
# Next Batch — Continuare Domani (BMAD + Second Brain)

## Pagine Mancanti (random order, parallel)
- `operazioni-orario` — BMAD story da creare (dcp-20)
- `servizi-catalogo` — BMAD story da creare (dcp-21)
- `servizi-utente` — BMAD story da creare (dcp-22)
- `amministrazione` — BMAD story da creare (dcp-23)

## Azioni Per Domani
1. Creare `.story.md` per le 4 pagine sopra
2. Creare JSON `tests.{slug}` con `layout: test`
3. Creare componente `pub_theme/components/blocks/{slug}/default.blade.php`
4. Verificare `curl -I http://192.168.1.40:8000/it/tests/{slug}` → 200 OK
5. Aggiornare `docs/second-brain/knowledge.md` con nuove regole
6. Aggiornare `STATUS_RISULTATI_RICERCA.md` con stato batch

## Stack
Tailwind + Alpine + Lit + DaisyUI + Flowbite — NO Bootstrap Italia.
Token primario: `.btn-primary` = `bg-primary-600` (verde PA #007A52).

## Stato Corrente
- 136 BMAD stories totali
- 27 moduli con docs/
- Doc folders: organized (`doc-folders-index.md` creato)
- Second brain: `knowledge.md` + `header-footer-rationale.md` aggiornati
- Componenti creati: events-list/default.blade.php, faq/default.blade.php, search-results/default.blade.php, filters/default.blade.php, sorting/default.blade.php, pagination/default.blade.php
- Status file: `STATUS_RISULTATI_RICERCA.md` (200 OK, 152522B, 645 risultati, componenti verificati)
