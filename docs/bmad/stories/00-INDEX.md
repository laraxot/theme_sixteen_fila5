---
title: "BMAD story index — Design Comuni and ticket flow"
type: index
status: active
updated: 2026-10-13
tags: [docs, sixteen, bmad]
qmd: "story index sixteen"
---

# Story index

Questo indice è il punto di coordinamento per gli agenti. Le story canoniche sono
quelle `2026-10-13-dcp-*`; le story più vecchie restano archivio di contesto e non
devono introdurre percorsi, JSON o componenti che non esistono nel repository.

## Wave A — wizard Filament, in ordine di dipendenza

| Story | Scope | Stato | File owner principale |
|---|---|---|---|
| [DCP-32](dcp-32-wizard-step1-privacy.story.md) | Privacy / consenso | ready-for-dev | `TicketForm.php`, privacy view |
| [DCP-33](dcp-33-wizard-step2-dati.story.md) | Dati + CoordinatePicker | ready-for-dev | `TicketForm.php`, Geo map |
| [DCP-34](dcp-34-wizard-step3-riepilogo.story.md) | Riepilogo readonly + mappa | ready-for-dev | summary schema/infolist |
| [DCP-35](dcp-35-conferma-parity.story.md) | Conferma post-save | ready-for-dev | confirmation block/action |

## Wave B — pagine Design Comuni

La story [DCP-32S](dcp-32-scope-data-dc-pagine-reali.story.md) copre
lo scope CSS/layout sulle pagine reali e non è lo step privacy: il suffisso `S`
evita l’ID duplicato. Le story DCP-04–DCP-31 coprono homepage, header/footer, ricerca, FAQ, servizi,
eventi, liste e flussi. Ogni agente deve leggere i documenti BMAD radice, dichiarare
Owned File/Module Scope, usare JSON/CMS e componenti condivisi, e consegnare
screenshot 375/768/1440, DOM evidence e WCAG evidence.

## Wave C — area personale vera (menu utente, DCP-106)

| Story | Scope | Stato | Owner principale |
|---|---|---|---|
| [DCP-106](dcp-106-header-area-personale-reale-e-pagine-collegate.story.md) | specifica, coordinamento e causa radice delle pagine vuote | in-progress | tema |
| [DCP-110](dcp-110-area-personale-pratiche-e-seguite.story.md) | "Le mie segnalazioni" e "Segnalazioni che seguo" | done | modulo Fixcity |
| [DCP-111](dcp-111-area-personale-notifiche-e-impostazioni.story.md) | "Notifiche" (tabella `notifications`, segna come letta) e "Impostazioni e privacy" (preferenza email, dati dell'account, diritti GDPR) | done | modulo Fixcity |

## Wave D — compliance Design Italia, cookiebar e disclaimer

Le story figlie collegano l'implementazione del tema alle stories radice BMAD,
senza duplicare il runtime Gdpr o trasformare un audit visuale in approvazione legale.

| Story | Scope | Stato | Owner |
|---|---|---|---|
| [DCP-170](dcp-170-cookiebar-visual-semantic-audit.story.md) | audit visuale/semantico Cookiebar | ready-for-dev | Sixteen |
| [DCP-171](dcp-171-disclaimer-content-and-route-verification.story.md) | verifica disclaimer, dati e route | ready-for-dev | Sixteen + legal owner |
| [DCP-172](dcp-172-legal-surface-localization-regression.story.md) | regressione link legali it/en/de/es | ready-for-dev | Sixteen |
| [DCP-173](dcp-173-design-guideline-evidence-retest.story.md) | retest matrice requisiti/evidenze | ready-for-dev | Sixteen + release owner |

## Story hygiene

- `fil-*`, `dcp-22` e `dcp-23` sono riferimenti storici: usare DCP-32–35 come
  contratto corrente per il wizard e la conferma.
- Nessuna story può dichiarare 90% HTML o 97/98% visual parity senza evidenza.
- Le story devono usare lo stack Tailwind + Alpine + Lit + DaisyUI + Flowbite +
  Filament e dichiarare esplicitamente l'assenza di Bootstrap runtime.
- Le story parallele non possono condividere lo stesso file CSS, JSON o widget:
  quei file entrano nella coda seriale di integrazione.

## Handoff

Le story con AC, Testing e Owned Scope completi passano a `ready-for-dev`; il
codice viene modificato solo dall'external dev tool. Il coordinatore integra i
risultati, esegue il conflict check e aggiorna `bmad-output/sprint-status.yaml`.

## Registro completo (2026-10-14)

- [00-REGISTRO-COMPLETO.md](00-registro-completo.md): tutte le story non citate negli indici principali (famiglie `catalog/`, `pages/`, `dcp-NN` senza data, `s-*`, `s150-*`, `DC-*`, `STORY-*` e `docs/stories/`), con stato e titolo dichiarati nei file.
- Story collegata di un altro modulo: [DCP-152 (owner Geo)](../../../../../Modules/Geo/docs/stories/dcp-152-marker-dettaglio-ticket-e-pulsanti-mappa-su-pagine-dc.story.md), marker del dettaglio ticket (blocco `ticket-detail/design-comuni`) e pulsanti opachi del `coordinate-picker-lit` nelle pagine `data-dc`. Relazione con [DCP-148](dcp-148-dettaglio-pubblico-segnalazione-e-segui.story.md).
- [DCP-183](dcp-183-font-come-asset-di-vite.story.md): i font del tema come asset di Vite (hash, manifest, preload) senza aggiornare Vite; strada nativa scelta, opzione `fonts` di laravel-vite-plugin rinviata (richiede Vite 8). Sorgente pronto, attivazione al prossimo build completo concordato.
- [DCP-195](dcp-195-pulsante-cerca-invisibile-e-reset-button-senza-layer.story.md): il pulsante «Cerca» di `/tickets/track` e' invisibile (reset di `button` senza layer che batte le utility); causa misurata con CDP, decisioni D195-1..3.
- [DCP-196](dcp-196-ricerca-interna-e-modale-di-ricerca.story.md): la ricerca interna non ha funzione e la modale in home non e' cliccabile; decisioni D196-1..4.
- [DCP-197](dcp-197-esposizione-per-ambiente-repliche-tests-file-di-prova-sitemap-robots.story.md): cio' che e' pubblico e non dovrebbe esserlo (84 repliche `tests`, host, sitemap, robots, pagine di errore); decisioni D197-1..6.
- [DCP-198](dcp-198-menu-footer-social-e-segnaposto-del-front-office.story.md): menu, footer, social e segnaposto (92 link in home: 9 a 404, 18 `#`, 32 senza href); decisioni D198-1..6.
- [DCP-203](dcp-203-front-office-restanti-dell-audit-non-ancora-in-una-story.story.md): front office, i difetti dell'audit DCP-186 che nessuna story ancora copre (stelle, accedi per seguire, OSM, soft 404, data di aggiornamento, terms e note legali)
