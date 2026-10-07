---
title: "Sixteen theme documentation index"
type: index
theme: Sixteen
created: 2026-09-27
updated: 2026-09-27
qmd: "sixteen theme design comuni folio volt accessibility documentation index"
---

# Sixteen — indice canonico

Sixteen è il tema web/PWA pubblico: Design Comuni, responsive, accessibilità e
componenti visuali. Non contiene business logic, controller o rotte; le pagine sono
Folio + Volt e le Actions appartengono al modulo owner.

## Percorsi di lettura

1. [README](README.md) — identità e setup;
2. [layout architecture](layout-architecture.md) — shell e namespace;
3. [accessibility](accessibility.md) — criteri WCAG/AGID;
4. [components](components.md) — componenti riusabili;
5. [header mobile overlay](header-mobile-overlay.md) — comportamento responsive;
6. [mobile accessibility contract](mobile-demo-accessibility-contract.md) — gate demo;
7. [visual parity plan](visual-parity-plan.md) — backlog visuale verificabile.

## SSoT per area

| Area | Canonico | Non usare come SSoT |
|---|---|---|
| Layout/Folio | `layout-architecture.md` | report di confronto duplicati |
| Accessibilità | `accessibility.md` + contratto mobile | claim “100%” senza audit |
| Design Comuni | `design-comuni/` + documenti parity | screenshot raw |
| Componenti | `components/` | copie in `blocks/` non indicizzate |
| Build asset | `vite-theme-integration.md` | log di singole sessioni |
| FixCity journeys | `Modules/Fixcity/docs/actor-flows.md` | duplicati nel tema |
| Modelli/enum prenotazioni | `appointment-enums.md` | costanti `Appointment::STATUS_*` (rimosse) |

## Regola di consolidamento

Le cartelle `analysis/`, `comparisons/`, `html-*`, `body-structure-comparison/` e
`design-comuni/*/raw` sono evidence storica o generated output. Non creare nuovi report
paralleli: aggiornare il canonico con finding, data, viewport e link al codice. Prima di
eliminare o spostare file, verificare i riferimenti con `rg` e registrare la sostituzione
nel log Second Brain.

I nuovi `.md` usano nomi lowercase senza date/timestamp e senza suffissi numerici
sequenziali (`-1`, `-2`, `-3`). I file storici restano tali finché una mappa di rinomina
verificata non garantisce tutti i riferimenti.

## Definition of done visuale

Ogni modifica deve avere: mobile/tablet/desktop evidence, zero overflow, focus visibile,
target touch adeguato, contrasto e reduced-motion verificati. Un screenshot isolato non
chiude il gate.
