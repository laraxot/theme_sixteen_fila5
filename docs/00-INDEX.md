---
title: "Sixteen theme documentation index"
type: index
theme: Sixteen
created: 2026-09-27
updated: 2026-09-27
qmd: "sixteen theme design comuni folio volt accessibility documentation index"
---

# Sixteen — indice canonico

Sixteen è il tema web/PWA pubblico di FixCity: è il proprietario della resa
Design Comuni, del markup e dei componenti visuali. Non contiene business logic,
controller o rotte; le pagine sono Folio + Blade/Volt e le Actions appartengono
al modulo owner.

Questo file è l'indice operativo unico. `INDEX.md`,
`DOCUMENTATION_INDEX.md` e `MASTER_DOCUMENTATION.md` sono indici storici:
non usarli per decidere una nuova struttura.

## Percorsi di lettura

1. [README](README.md) — identità, ownership e stack;
2. [knowledge-map](knowledge-map.md) — mappa per QMD/Graphify/Second Brain;
3. [docs knowledge architecture](bmad/docs-knowledge-architecture.md) — regole BMAD;
4. [header/footer contract](bmad/header-footer-sections-contract.md) — dati e renderer;
5. [header/footer parity](bmad/header-footer-parity-report.md) — gate Playwright;
6. [header/footer data model](bmad/header-footer-data-model.md) — elementi, forma JSON e AC;
7. [header/footer rationale](second-brain/header-footer-rationale.md) — decisione e perché;
8. [wiki](wiki/README.md) — conoscenza consolidata e regole on-demand;
9. [design-comuni](design-comuni/DESIGN-COMUNI-CANONICAL.md) — vincoli visuali;
10. [design-system](design-system/README.md) — token e componenti del tema;
11. [pages](pages/) — contratti delle pagine e parity;
12. [stories](stories/) — storie BMAD e acceptance criteria;
13. [visual-parity](visual-parity/) — verifiche, screenshot e report;
14. [investigation](investigation/) — analisi riproducibili, non decisioni canoniche.

## SSoT per area

| Area | Canonico | Non usare come SSoT |
|---|---|---|
| Layout/Folio | `layout-architecture.md` + `docs/wiki/rules/no-parallel-design-comuni-layout.md` | layout paralleli `design-comuni` |
| Accessibilità | `accessibility.md` + contratto mobile | claim “100%” senza audit |
| Design Comuni | `design-comuni/` + documenti parity + `design-system/` | screenshot raw o report duplicati |
| Componenti | `components/` | copie in `blocks/` non indicizzate |
| Build asset | `vite-theme-integration.md` | log di singole sessioni |
| FixCity journeys | `Modules/Fixcity/docs/actor-flows.md` | duplicati nel tema |

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

## Story BMAD recenti (standard di codice)

- [Services -> Actions e const -> enum (2026-10-08)](stories/2026-10-08-services-to-actions-sixteen.story.md) — il tema non ha piu' `app/Services/`; 31 const in enum con lang it/en.
