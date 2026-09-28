---
qmd: "README"
title: "BMAD UI/UX Sixteen — boundary FixCity"
type: workflow-boundary
status: active
created: 2026-09-26
updated: 2026-09-27
tags: [bmad, ui, ux, sixteen, fixcity]
issues:
  - "https://github.com/laraxot/base_fixcity_fila5/issues"
discussions:
  - "https://github.com/laraxot/base_fixcity_fila5/discussions"
---

# Ownership BMAD del tema Sixteen

Sixteen partecipa ai workflow FixCity `07-ui-ux`, `08-security` (privacy visuale) e
`09-release` (smoke browser), più al percorso [actor-citizen](../../../../Modules/Fixcity/docs/bmad/workflows/actor-citizen.md).
Non replica Actions, policy, schema o persistenza di FixCity.
Indice: [FixCity workflows](../../../../Modules/Fixcity/docs/bmad/workflows/README.md).

## Homepage guest (2026-09-27)

- Contratto: [homepage-guest-visual-contract.md](./homepage-guest-visual-contract.md)
- Atteso dominio: [homepage-guest-expected-visual.md](../../../../Modules/Fixcity/docs/bmad/homepage-guest-expected-visual.md)
- Confronto PASS: [homepage-guest-visual-comparison.md](../../../../Modules/Fixcity/docs/bmad/homepage-guest-visual-comparison.md)
- Concept fix: [homepage-guest-visual-fix.md](../wiki/concepts/homepage-guest-visual-fix.md)

## Utility pubbliche Design Comuni (2026-09-27)

- Contratto: [atteso FAQ e mappa](design-comuni-utility-pages-expected-2026-09-27.md)
- Confronto: [runtime FAQ e mappa](design-comuni-utility-pages-comparison-2026-09-27.md)
- Piano: [correzione utility](design-comuni-utility-pages-correction-plan-2026-09-27.md)
- Story owner: [STORY-524](../../../Modules/Fixcity/docs/bmad/stories/STORY-524-design-comuni-utility-pages.md)

## Evidenze richieste

La pagina Folio `area-personale.impostazioni` ospita il widget delle preferenze
email FixCity; la logica e la persistenza restano nel modulo Fixcity. Vedi
[STORY-013](../../../../Modules/Fixcity/docs/bmad/stories/STORY-013-ticket-notification-preferences.md).

Ultimo controllo runtime: `/it/segnalazioni` risponde 200 a 320, 360, 768 e 1.440 px, senza overflow o errori JS; titolo “Segnalazioni” e CTA canonico verificati. Il brand Sixteen resta interamente visibile a 320 px. La mappa desktop carica tutti i tile dopo stabilizzazione; marker e popup su ticket geolocalizzati restano da verificare. Tracking guest valido e wizard autenticato IT/EN sono provati su SQLite temporaneo: title localizzati, privacy obbligatoria e avanzamento wizard da tastiera; restano focus dell'errore, invio/upload completo, coda PA e verifiche staging. Report e limiti: [audit UI/UX FixCity](../../../../Modules/Fixcity/docs/bmad/ui-ux-runtime-audit-2026-09-26.md) e [report Sixteen](fixcity-ui-ux-runtime-audit.md).

- screenshot responsive del wizard e delle pagine tracking/dettaglio;
- smoke responsive e tastiera su `/area-personale/seguite`, inclusi stato vuoto, conteggio e link tracking;
- la lista seguite non mostra stati interni di ticket appartenenti ad altri utenti; il link di ritorno porta alle proprie pratiche;
- tastiera, focus, contrasto, errori e screen reader;
- parity Design Comuni senza CTA o header duplicati;
- riferimento alla story FixCity e al contratto UX canonico.

La logica resta in `Modules/Fixcity`; il tema aggiorna solo view, CSS, componenti visuali
e report di parity.

## Tracking nell'area personale

La view `area-personale/seguite` compone i link con il codice capability (`?code=`),
mai con l'ID sequenziale. I record storici privi di codice mostrano una nota localizzata
al posto di un link non funzionante. La regressione è coperta dal Feature test Fixcity;
resta da eseguire l'E2E visuale autenticato non appena il runner browser avrà Playwright
e Chromium disponibili. Evidenze: [report BMAD tracking](../../../../Modules/Fixcity/docs/bmad/tracking-links-capability-2026-09-27.md).

## Evidenza lista pubblica FixCity

La pagina `/segnalazioni` attiva è resa dal blocco CMS `ticket-layout`, non dalla
Folio view legacy omonima. Il blocco riceve dati live dal modulo: lista paginata
(20 per pagina), filtri tipo/stato sulle card e mappa `/api/tickets/geojson`.
I Feature test FixCity confermano output senza capability code, filtro stato e
paginazione; la suite SQLite completa passa (350 test, 1.440 asserzioni).

Il browser verifica la route a 320/768/1.440 px e i tab Mappa/Elenco; screenshot
e limiti sono registrati nei report collegati. Il tracking guest/owner e il wizard
IT/EN hanno smoke su dati isolati; questi non provano pagina seguite, coda PA,
accessibilità completa né staging.
