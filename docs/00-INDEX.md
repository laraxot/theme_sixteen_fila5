---
title: "Sixteen theme documentation index"
type: index
theme: Sixteen
created: 2026-09-27
updated: 2026-10-13
qmd: "sixteen theme design comuni folio volt accessibility documentation index"
---

# Sixteen — indice canonico

Sixteen è il tema web/PWA pubblico di FixCity: è il proprietario della resa
Design Comuni, del markup e dei componenti visuali. Non contiene business logic,
controller o rotte; le pagine sono Folio + Blade/Volt e le Actions appartengono
al modulo owner.

Questo file è l'indice operativo unico. `INDEX.md`,
`DOCUMENTATION_INDEX.md`, `00-index.md` e `MASTER_DOCUMENTATION.md` sono indici
storici (suffisso `.old` dal 2026-10-13): non usarli per decidere una nuova
struttura.

## Riorganizzazione docs 2026-10-13

- `build/` — tutti i 14 documenti Vite/build, con `build/INDEX.md` come ordine
  di lettura canonico (erano sparse alla root come `vite-*.md`/`VITE_*.md`);
- `visual-parity/` — struttura consolidata: `reports/`, `screenshots/pages/`
  (evidenza per pagina), `screenshots/legacy-2026-04/` (evidenza storica),
  `scripts/` (bug del path annidato `scripts/docs/visual-parity/scripts/`
  eliminato);
- `visual-parity-screenshots/` accorpato in `visual-parity/screenshots/pages/`;
- `visual-comparison/` resta evidence storica cross-referenziata.

## Percorsi di lettura

1. [README](README.md) — identità, ownership e stack;
2. [knowledge-map](knowledge-map.md) — mappa per QMD/Graphify/Second Brain;
3. [docs architecture](../../../../bmad-output/docs-architecture/README.md) — regole cross-project;
4. [docs knowledge architecture](bmad/docs-knowledge-architecture.md) — regole BMAD;
5. [header/footer contract](bmad/header-footer-sections-contract.md) — dati e renderer;
6. [header/footer parity](bmad/header-footer-parity-report.md) — gate Playwright;
7. [header/footer data model](bmad/header-footer-data-model.md) — elementi, forma JSON e AC;
8. [header/footer rationale](second-brain/header-footer-rationale.md) — decisione e perché;
9. [wiki](wiki/README.md) — conoscenza consolidata e regole on-demand;
10. [design-comuni](design-comuni/DESIGN-COMUNI-CANONICAL.md) — vincoli visuali;
11. [design-system](design-system/README.md) — token e componenti del tema;
12. [pages](pages/) — contratti delle pagine e parity;
13. [stories](stories/) — storie BMAD e acceptance criteria;
14. [visual-parity](visual-parity/) — verifiche, screenshot per pagina e report;
15. [investigation](investigation/) — analisi riproducibili, non decisioni canoniche.

## SSoT per area

| Area | Canonico | Non usare come SSoT |
|---|---|---|
| Layout/Folio | `layout-architecture.md` + `docs/wiki/rules/no-parallel-design-comuni-layout.md` | layout paralleli `design-comuni` |
| Accessibilità | `accessibility.md` + contratto mobile | claim “100%” senza audit |
| Design Comuni | `design-comuni/` + documenti parity + `design-system/` | screenshot raw o report duplicati |
| Componenti | `components/` | copie in `blocks/` non indicizzate |
| Build asset | `build/INDEX.md` | log di singole sessioni |
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

## Parity Design Comuni v2 (2026-10-13)
- [Epic DCP-00 e storie per la ripresa](bmad/stories/2026-10-13-dcp-00-epic-design-comuni-parity-v2.story.md)
- [Perche' la parity non e' stata completata e guardrail](bmad/decisions/2026-10-13-parity-root-cause-and-guardrails.md)
- [Dossier dei 14 difetti della homepage](bmad/homepage-visual-parity-defects/DEFECTS-D01-D14.md)
- [Coordinamento tra agenti](prompts/homepage/00-COORDINATION.md)
- [Zen del wizard segnalazione (logica/perche'/filosofia/religione/politica)](bmad/decisions/2026-10-13-segnalazione-flow-parity-zen.md)
- [DCP-32 wizard step 1 privacy](bmad/stories/2026-10-13-dcp-32-wizard-step1-privacy.story.md) · [DCP-33 step 2 dati + mappa](bmad/stories/2026-10-13-dcp-33-wizard-step2-dati.story.md) · [DCP-34 step 3 riepilogo + mappa](bmad/stories/2026-10-13-dcp-34-wizard-step3-riepilogo.story.md) · [DCP-35 conferma](bmad/stories/2026-10-13-dcp-35-conferma-parity.story.md)
- Strumenti: `bashscripts/docs/visual-comparison/INDEX.md`

## Wizard /it/tickets/create: DCP-35 (Fixcity) e D15
- [DCP-35 (modulo Fixcity): passi 1 e 2 del wizard e coordinamento tra agenti](../../../Modules/Fixcity/docs/stories/2026-10-13-dcp-35-tickets-create-privacy-dati-coordinamento.story.md): attenzione, la numerazione DCP-32..35 esiste anche nelle story del tema (voci sopra), con significato diverso (qui DCP-35 = conferma)
- [D15: il Volt della pagina generica ha una radice propria](decision-log/D15-volt-fragment-explicit-root.md): causa di `MethodNotFoundException` su «Avanti»; esiste un secondo D15, [conferma post-save](decision-log/D15-conferma-post-save.md)

## Story tickets/create lato tema (2026-10-13)
- [DCP-40 radice del Volt nella pagina generica](bmad/stories/2026-10-13-dcp-40-volt-radice-widget-livewire.story.md)
- [DCP-50 guardia di compilazione dei template Blade](bmad/stories/2026-10-13-dcp-50-guardia-compilazione-template-blade.story.md)
- [D15 radice del Volt (decisione)](decision-log/D15-volt-fragment-explicit-root.md)

## Multilingua it, en, de, es (DCP-120)
- [i18n/INDEX.md](i18n/INDEX.md): comportamento multilingua (lingua, fallback, selettore, link, formati) e glossario di traduzione
- [DCP-120 copertura de/es](bmad/stories/2026-10-13-dcp-120-multilingua-comportamenti-e-copertura.story.md) · [DCP-123 lingua dichiarata e link localizzati](bmad/stories/2026-10-13-dcp-123-lingua-dichiarata-e-link-localizzati.story.md)
- [Multilingua e dispositivi: comportamenti osservati](wiki/concepts/multilingua-e-dispositivi-comportamenti.md): misure su lingua, selettore, wizard, formati, menu e bersagli tattili a 375, 768, 1024, 1440 (studio in [DCP-55](bmad/stories/2026-10-13-dcp-55-multilingua-e-dispositivi.story.md))

## Area personale (DCP-106, DCP-110)
- [DCP-110 area personale: Le mie segnalazioni e Segnalazioni che seguo](bmad/stories/2026-10-13-dcp-110-area-personale-pratiche-e-seguite.story.md)

## Registro story e dettaglio ticket (2026-10-14)
- [Registro completo delle story](bmad/stories/00-REGISTRO-COMPLETO.md): le story di `stories/` e `bmad/stories/` che prima non avevano un indice (stato e titolo dichiarati nei file)
- [DCP-148 dettaglio pubblico e Segui](bmad/stories/2026-10-13-dcp-148-dettaglio-pubblico-segnalazione-e-segui.story.md): blocco `components/blocks/ticket-detail/design-comuni.blade.php`
- [DCP-152 (modulo Geo): marker del dettaglio e pulsanti della mappa](../../../Modules/Geo/docs/stories/2026-10-14-dcp-152-marker-dettaglio-ticket-e-pulsanti-mappa-su-pagine-dc.story.md): il blocco passa `marker-icon-url`, `marker-color`, `marker-label` al `coordinate-picker-lit` (vedi [coordinate-picker](wiki/coordinate-picker.md))
