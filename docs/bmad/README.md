---
qmd: "README bmad sixteen hub decision-log auth login oauth filament blueprint graphify-out gitignore d30"
title: "BMAD UI/UX Sixteen — boundary FixCity"
type: workflow-boundary
status: active
created: 2026-09-26
updated: 2026-10-20
tags: [bmad, ui, ux, sixteen, fixcity]
issues:
  - "https://github.com/laraxot/base_fixcity_fila5/issues"
discussions:
  - "https://github.com/laraxot/base_fixcity_fila5/discussions"
---

# Ownership BMAD del tema Sixteen

Indice hub di `docs/bmad/`: decisioni in [decision-log.md](./decision-log.md), vestito FO qui, dominio Auth/Socialite in User. Mai `bmad-output/`.

## Kit BMAD owner (canonico)

- [BMAD Planning](../bmad-planning.md)
- [BMAD Brainstorming](../bmad-brainstorming.md)
- [Filament blueprint](./filament-blueprint.md)
- [Project context](./project-context.md)
- [Decision log](./decision-log.md)
- [Shell Folio `container0.index`](./container0-index-shell-contract.md) (D20)

## Auth / Login / OAuth (FO)

Scopo: il cittadino entra da `/it/auth/login` con vestito Design Comuni; OAuth resta localizzato (`{lang}/auth/login/{provider}`). Il tema veste; User possiede Socialite e lo schema Filament.

| Cosa | Dove |
|------|------|
| Decisioni D24–D27 (card vs accesso-servizio, occhio password, ricordami, Google locale) | [decision-log.md](./decision-log.md) (indice Auth in cima) |
| D30 `graphify-out/` nel `.gitignore` del tema (no LFS) | [decision-log.md](./decision-log.md#d30-graphify-out-ignorato-nel-tema-no-lfs) · canon [graphify-out-gitignore](../../../../Modules/Xot/docs/bmad/graphify-out-gitignore.md) |
| Architettura login | [auth-login-architettura.md](./auth-login-architettura.md) |
| Plan OAuth locale | [plans/oauth-login-locale-fix.md](./plans/oauth-login-locale-fix.md) |
| Plan checkbox/occhiello | [plans/login-checkbox-visibility-fix.md](./plans/login-checkbox-visibility-fix.md) |
| Remediation Design Comuni | [plans/auth-login-design-comuni-remediation.md](./plans/auth-login-design-comuni-remediation.md) |
| Story JSON login + Blueprint | [auth-login-json-bmad.story.md](./auth-login-json-bmad.story.md) |
| Story checkbox/occhiello in `data-dc` | [stories/dcp-268-login-checkbox-e-occhio-password-dentro-data-dc.story.md](./stories/dcp-268-login-checkbox-e-occhio-password-dentro-data-dc.story.md) |
| Audit login | [audit/audit-login-design-comuni.md](./audit/audit-login-design-comuni.md) |
| Filosofia Folio login | [folio-login-philosophy.md](./folio-login-philosophy.md) |
| Dominio User (Google auth) | [../../../../Modules/User/docs/bmad/google-auth-login.md](../../../../Modules/User/docs/bmad/google-auth-login.md) |

**Inbound FO Novità/Eventi:** [inbound-fo-index.md](./inbound-fo-index.md).

Sixteen partecipa ai workflow FixCity `07-ui-ux`, `08-security` (privacy visuale) e
`09-release` (smoke browser), più al percorso [actor-citizen](../../../../Modules/Fixcity/docs/bmad/workflows/actor-citizen.md).
Non replica Actions, policy, schema o persistenza di FixCity.
Indice: [FixCity workflows](../../../../Modules/Fixcity/docs/bmad/workflows/README.md).

## Upload fotocamera mobile

La story owner cross-module è [FIXCITY-MEDIA-001](../../../../Modules/Fixcity/docs/bmad/stories/mobile-camera-upload.story.md).
Sixteen contribuisce solo con il [supporting handoff camera-upload](./stories/camera-upload-mobile-fix.story.md): bundle, attributi del campo,
normalizzazione browser, fallback accessibile e verifica responsive. Claim,
decisioni, handoff e stato restano nella story owner; `docs/chat/` è archivio
storico e non riceve nuove note operative.

**Design Comuni BMAD (ex `bmad-output/`):** [front-office-design-comuni/](front-office-design-comuni/README.md).
Documenti FO solo qui — mai in `bmad-output/`.

## Homepage guest (2026-09-27)

### Contratti correnti 2026-10-07

- [Audit visuale e piano taste-skill](homepage-taste-contract-2026-10-07.md)
- [Contratto presentazione flusso cittadino](citizen-journey-presentation-contract.md)
- [Audit dominio FixCity](../../../../Modules/Fixcity/docs/bmad/homepage-audit.md)
- [Audit flusso cittadino](../../../../Modules/Fixcity/docs/bmad/citizen-journey-audit.md)

La view homepage runtime è `resources/views/pages/index.blade.php`. Il file parallelo
`pages/[locale]/index.blade.php` non è montato dai provider attuali.

- Contratto: [homepage-guest-visual-contract.md](./homepage-guest-visual-contract.md)
- Atteso dominio: [homepage-guest-expected-visual.md](../../../../Modules/Fixcity/docs/bmad/homepage-guest-expected-visual.md)
- Confronto PASS: [homepage-guest-visual-comparison.md](../../../../Modules/Fixcity/docs/bmad/homepage-guest-visual-comparison.md)
- Concept fix: [homepage-guest-visual-fix.md](../wiki/concepts/homepage-guest-visual-fix.md)

## Utility pubbliche Design Comuni (2026-09-27)

- Contratto: [atteso FAQ e mappa](design-comuni-utility-pages-expected-2026-09-27.md)
- Confronto: [runtime FAQ e mappa](design-comuni-utility-pages-comparison-2026-09-27.md)
- Piano: [correzione utility](design-comuni-utility-pages-correction-plan-2026-09-27.md)
- Story owner: [STORY-524](../../../../Modules/Fixcity/docs/bmad/stories/STORY-524-design-comuni-utility-pages.md)

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
## Tooling AI

- [FreeLLMAPI theme boundary](./freellmapi-theme-boundary.md) — nessuna dipendenza dal runtime visuale

## Runtime smoke 2026-10-26

Le route `/it/blog`, `/it/events` e `/it/tickets` sono state aperte con
Playwright sull’ambiente `192.168.1.40:8000`: titoli e heading localizzati
presenti, shell condivisa con skip-link/header/main/footer e nessun errore
console. A 375, 768 e 1440 px `scrollWidth` coincide con la viewport per tutte
le pagine; `/it/tickets` carica `/api/tickets/geojson` con `200`.

Le screenshot runtime non hanno un baseline committato con cui misurare la
parità; quindi la verifica visuale è **inconclusive**, non un PASS. Restano da
fare axe/keyboard e il controllo completo dei link. Evidenza dettagliata:
`Hindsight frontoffice-runtime-smoke-2026-10-26`.

## Inbound marketing

- [Contratto Blog/Eventi (`content_type`)](content-type-contract.md)
- [Liste blog/eventi](../stories/inbound-blog-event-listing.story.md)
- [Dossier coordinatore](../../../../Modules/Fixcity/docs/bmad/inbound-marketing/README.md)

## DesignComuni

- [Information architecture presentation](./design-comuni-information-architecture.md) — contratto di resa ODS
- [Theme identity decision](./design-comuni-theme-identity-decision.md) — nessun layout DesignComuni parallelo
