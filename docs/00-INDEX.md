---
title: "Sixteen theme documentation index"
type: index
theme: Sixteen
created: 2026-09-27
<<<<<<< .merge_file_LE8TZj
updated: 2026-11-19
qmd: "sixteen theme design comuni folio volt accessibility documentation index classificazione cartelle indici storici INDEX.md index.md"
=======
updated: 2026-11-26
qmd: "sixteen theme design comuni folio volt accessibility documentation index"
>>>>>>> .merge_file_OhxHAr
status: active
tags: [docs, sixteen]
---

# Sixteen — indice canonico

Sixteen è il tema web/PWA pubblico di FixCity: è il proprietario della resa
Design Comuni, del markup e dei componenti visuali. Le pagine sono Folio +
Blade/Volt e le Actions di dominio appartengono al modulo owner. Per regola non
deve avere controller o rotte proprie, ma il codice le contiene ancora: 5
controller in `app/Http/Controllers/`, `routes/web.php` e `routes/auth.php`
(verificato 2026-10-14). A runtime non risultano registrate: `php artisan
route:list` non ha `comune/*`, `auth/spid` ne' `auth/cie`. Stato e conteggi in
[README.md](README.md).

<<<<<<< .merge_file_LE8TZj
Questo file è l'indice operativo unico. Gli indici storici con suffisso `.old`
(`00-index.old.md`, `documentation-index.old.md`, `index.historical-bmad.old.md`)
e il residuo `00-INDEX.md.tmp` sono stati rimossi il 2026-11-19 (issue #64).
`index.md` è l'indice BMAD/QMD più vecchio (router storico) e
`master-documentation.md` è un resoconto del 2026-04-01; restano anche
`00-homepage-replication-index.md`, `design-comuni-replication-index.md`,
`replikate-master-index.md` e `SCRIPTS_INDEX.md`. Non usarli per decidere una
nuova struttura.

## Riorganizzazione docs 2026-10-13

- `build/` — tutti i 14 documenti Vite/build (erano sparsi alla root come
  `vite-*.md`/`VITE_*.md`); `build/INDEX.md` non esiste: ordine di lettura da
  [vite-configuration-guide.md](build/vite-configuration-guide.md);
- `visual-parity/` — struttura consolidata: `reports/`, `screenshots/pages/`
  (evidenza per pagina), `screenshots/legacy-2026-04/` (evidenza storica),
  `scripts/` (bug del path annidato `scripts/docs/visual-parity/scripts/`
  eliminato);
- `visual-parity-screenshots/` accorpato in `visual-parity/screenshots/pages/`;
- `visual-comparison/` resta evidence storica cross-referenziata.

## Classificazione delle cartelle (file presenti il 2026-10-14)

| Ruolo | Cartelle (n. file) |
=======
## Struttura docs/ (consolidata 2026-11-26, issue #119)

`docs/` e' stato consolidato a **100 file `.md`** (era ~1452). Tutto il materiale
storico — report di fase, audit, confronti HTML/body, specifiche pagina,
prompt di coordinamento, llm-wiki completa, decision-log, analisi — e' in
**[../archive/docs-legacy/](../archive/docs-legacy/README.md)** (sola lettura,
indice al suo interno). Le regole per i nuovi documenti non cambiano: nomi
lowercase-kebab, niente date/timestamp nel nome, niente suffissi `-1`/`-2`.

### Cosa resta in `docs/`

| Percorso | Contenuto |
>>>>>>> .merge_file_OhxHAr
|---|---|
| `README.md`, `00-INDEX.md` (questo file), `readme-en.md` | Indici e identita' del tema |
| `page-directory-structure.md` | Regola canonica delle pagine Folio (riferenziata dai test arch) |
| `data-attribute-rule.md` | Regola `data-*` di parita' col riferimento Design Comuni (guardata da `DataAttributeParityContractTest`) |
| `html-parity-body-policy.md` | Policy del body per la parita' HTML (riferimento in `layouts/app.blade.php`) |
| `decision-log.md` | Registro delle decisioni del tema |
| `adr/` | Architecture Decision Record del tema (4 ADR + indice) |
| `contracts/` | Contratti delle Action del tema (5 contratti + indice) |
| `rules/` | Regole operative (body senza classi, no inline JS, componenti riusabili, architettura test/pagine) |
| `architecture/` | Architettura corrente: layout, routing, pagine, blocchi CMS, CSS, namespace componenti |
| `design-system/` | `MASTER.md` + `tokens.md`: token e principi del design system |
| `stories/` | Solo story **attive** (status `open`, `in-progress`, `todo`, `ready-for-dev`, `needs-decision`, `planning`, `draft`, `review`, `linked-to-module-story`, o senza status ma referenziate dal codice). Le concluse sono in archivio |
| `bmad/stories/` | Story BMAD attive del registro pagine (`pages/`) e del coordinamento |
| `wiki/concepts/` | Solo le 3 pagine wiki referenziate dal codice (`fo-folio-*`, `header-color-parity`); il resto della llm-wiki e' in archivio |

### Cosa e' stato archiviato

- `design-comuni/`, `pages/`, `prompts/`, `body-structure-comparison/`,
  `html-*/`, `visual-*/`, `analysis/`, `investigation/`, `comparisons/`,
  `decision-log/`, `second-brain/`, `build/`, `ui-fixes/`, `agid/`, `auth/`,
  `i18n/`, `compliance/`, `email/`, `marketing/`, `product/`, `roadmap/`,
  `plans/`, `implementation/`, `phases/`, `wizard/`, `blocks/`, `components/`;
- tutti i ~420 `.md` sciolti di radice (report `phase-*`, `login-*`, `agid-*`,
  `*-parity*`, roadmap, draft);
- `wiki/` per intero tranne le 3 pagine concetto sopra; `llm-wiki/`, `raw/`,
  `qmd-index/`;
- `stories/` concluse e senza status; `bmad/` decisioni/piani/evidence;
- file `*.old` eliminati in via definitiva.

Per recuperare un file: `git mv archive/docs-legacy/<percorso> docs/<percorso>`
(v. `archive/docs-legacy/README.md`).

## Percorsi di lettura

1. [README](README.md) — identità, ownership e stack;
2. questo indice — struttura e SSoT;
3. [page-directory-structure](page-directory-structure.md) — regola pagine Folio;
4. [data-attribute-rule](data-attribute-rule.md) — regola attributi `data-*`;
5. [architecture/](architecture/) — layout, routing, blocchi CMS;
6. [adr/](adr/) e [contracts/](contracts/) — decisioni e contratti;
7. [stories/](stories/) e [bmad/stories/](bmad/stories/) — lavoro attivo;
8. [design-system/MASTER.md](design-system/MASTER.md) — token e componenti;
9. Per la parita' Design Comuni v2 e i dossier storici: archivio
   `archive/docs-legacy/bmad/` e `archive/docs-legacy/design-comuni/`.

## SSoT per area

| Area | Canonico | Non usare come SSoT |
|---|---|---|
| Layout/Folio | `page-directory-structure.md` + `architecture/layout-architecture.md` | `design-comuni` come nome di layout runtime; i valori CMS storici vengono risolti da `x-layouts.app` |
| Accessibilità | audit in `stories/` attive | claim "100%" senza audit |
| Design Comuni | `architecture/` + `design-system/` + documenti parity in archivio | screenshot raw o report duplicati in `docs/` |
| Componenti | `architecture/component-namespace.md` + `rules/reusable-components.md` | copie in `blocks/` non indicizzate |
| Build asset | `vite.config.js` + documento build in archivio (`archive/docs-legacy/build/`) | log di singole sessioni |
| FixCity journeys | `Modules/Fixcity/docs/actor-flows.md` | duplicati nel tema |
| `data-*` markup | `data-attribute-rule.md` | nomi con il nome del tema |

## Definition of done visuale

Ogni modifica deve avere: mobile/tablet/desktop evidence, zero overflow, focus
visibile, target touch adeguato, contrasto e reduced-motion verificati. Uno
screenshot isolato non chiude il gate.

## Note operative

- Le story attive sono quelle con status non conclusivo in `stories/` e
  `bmad/stories/`; le concluse (`done`, `completed`, `implemented`,
  `superseded`) e i draft senza status sono in `archive/docs-legacy/stories/`.
- `wiki/concepts/` resta solo per le pagine citate da `@see`/commenti nel
  codice (`FrontofficeUrl`, `FrontofficeRoutes`, `header-color-parity`): il
  codice non e' stato toccato, quindi i percorsi vanno mantenuti.
- I link interni dei documenti mantenuti che puntano a file ora in archivio
  sono da considerare riferimenti storici: risolvere via
  `archive/docs-legacy/` o aggiornare il link al canonico.
