---
title: "Header tenant: identità e link reali"
type: story
status: done
module: Sixteen
created: 2026-09-27
updated: 2026-09-27
tags: [bmad, sixteen, header, tenant, ui-ux]
qmd: "Sixteen header tenant identity placeholder region social links truthful FixCity"
issues:
  - "https://github.com/laraxot/base_fixcity_fila5/issues/383"
discussions:
  - "https://github.com/laraxot/base_fixcity_fila5/discussions/392"
related:
  - fixcity-ui-ux-runtime-audit.md
  - ../../tests/Feature/Components/HeaderTenantFallbackTest.php
---

# Header tenant: identità e link reali

## Obiettivo

L'header Sixteen non deve presentare segnaposto come dati ufficiali del Comune,
né collegamenti social che riportano alla stessa pagina. Il prodotto deve avere
un'identità visibile anche quando i valori tenant non sono ancora configurati.

## Implementazione e criteri verificati

- [x] Nome tenant da `comune.nome`; per il valore vuoto/placeholder usa il nome
  applicativo e infine il brand FixCity.
- [x] Regione mostrata solo se configurata; non crea un link se manca la relativa
  destinazione.
- [x] Sottotitolo usa la configurazione tenant, con copy FixCity localizzato
  come fallback.
- [x] Link social derivati esclusivamente da URL HTTP(S) configurati e rimossi
  dall'header in assenza di destinazioni reali.
- [x] Aperture in nuova scheda con `rel="noopener noreferrer"`.
- [x] Pest: 3 test / 18 asserzioni; include configurazione vuota e link social.
- [x] Chromium: 18 combinazioni IT/EN, `/privacy`, `/tickets/track`, `/auth/login`
  a 320/768/1440 px; nessun overflow o errore JS, nessuna chiave grezza.

## Limite di rilascio

La route privacy risponde HTTP 503 finché il tenant non pubblica l'informativa
approvata. Questo comportamento è intenzionale e resta requisito del gate privacy
owner Fixcity; non va sostituito con contenuti legali inventati.
