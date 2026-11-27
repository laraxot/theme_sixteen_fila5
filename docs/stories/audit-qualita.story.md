---
title: "Audit qualita' — tema Sixteen"
type: story
theme: Sixteen
status: in-progress
created: 2026-11-19
updated: 2026-11-19
issue: https://github.com/laraxot/base_techplanner_fila5/issues/64
tags: [bmad, audit, docs, qualita]
---

# Audit qualita' — tema Sixteen

**Fase BMAD**: Dev + QA. **Issue**: [#64](https://github.com/laraxot/base_techplanner_fila5/issues/64).
Audit parallelo dei temi (nomi `.md` senza date, indice unico della docs, file morti, PHPStan, test).

## Risultati

- Nomi `.md`: nessun file datato. Le cartelle `Meetup/docs/screenshots/2026-*` non riguardano Sixteen.
- Indici: rimossi gli indici storici `00-index.old.md`, `documentation-index.old.md`, `index.historical-bmad.old.md` e il residuo
  `00-INDEX.md.tmp`; aggiornato il paragrafo in `00-INDEX.md` (indice operativo unico, ingresso `README.md`).
- Nessun duplicato esatto nella docs.

## Codice e test

- PHPStan (`analyse Themes`): 592 errori in Sixteen (soprattutto `config/sixteen.php`, `config/spid.php`, `config/cie.php`,
  `app/Actions/MenuBuilderAction.php`, controller SPID/CIE e test). Non corretti: il tema non e' attivo in questo progetto.
- Pest `tests/Unit`: 382 passati, 61 falliti, 6 saltati. I fallimenti dipendono dall'ambiente: `pub_theme` qui e' Two (viste
  `pub_theme::...` di Sixteen non trovate) e mancano gli asset compilati in `public/assets/`.

## Aperto

- 196 file della docs citano ancora `npm run copy` o `public/themes/...`: vanno corretti o archiviati con calma.
- Ridurre gli indici rimasti (`index.md`, `00-homepage-replication-index.md`, `replikate-master-index.md`, ...).
