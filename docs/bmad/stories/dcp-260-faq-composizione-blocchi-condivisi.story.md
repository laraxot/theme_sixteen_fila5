---
title: "DCP-260 — FAQ come composizione di blocchi condivisi, senza CSS di pagina"
type: story
status: in-review
updated: 2026-10-20
tags: [docs, sixteen, bmad, faq, design-comuni, css, filament-blueprint]
qmd: "dcp 260 faq composizione blocchi condivisi content-page nessun css di pagina data-dc tailwind"
related:
  - ../faq-route-ownership.md
  - ../faq-css-remediation-plan.md
  - ../decision-log.md
  - ../../wiki/concepts/shared-block-composition-no-page-css.md
  - ../../../../../Modules/Fixcity/docs/faq-catalog-ownership.md
---

# DCP-260 — FAQ come composizione di blocchi condivisi

**Numero:** 260, fuori dai blocchi riservati DCP-240..249 e DCP-250..259 (`Modules/Fixcity/docs/bmad/project/`); il 252 è
già assegnato ad altra sessione («Test morti Blog e User»).

**Stato:** in-review. Implementato e misurato in locale (`http://127.0.0.1:8000`). Non rilasciato: `fixcity.eu` è un deploy
separato e resta sulla versione precedente (`BLOCKED_DEPLOYMENT`). Build del tema non rieseguita (vedi T2).

## Story

Come cittadino voglio trovare le risposte su come segnalare un problema in una pagina coerente con Design Comuni, con ricerca,
accordion, valutazione e contatti che funzionano. Come team voglio che la pagina sia **composizione di componenti riusabili +
contenuto JSON**, come fa il riferimento (`italia/design-comuni-pagine-statiche`: `src/pages/sito/domande-frequenti.hbs` assembla
`cmp-breadcrumbs`, `cmp-hero`, `cmp-input-search`, `cmp-accordion-faq`, `cmp-button`, `cmp-rating`, `cmp-contacts-trasversali`; ogni
componente ha il proprio `_cmp-*.scss`, nessuna regola nomina una pagina).

## Diagnosi (misurata il 2026-10-20)

| # | Causa | Evidenza |
|---|---|---|
| R1 | La pagina reale era un **monolite** (`components/pages/faq.blade.php`, blocco `faq-page`) invece della composizione che la replica `/it/tests/domande-frequenti` già usa (`content-page/design-comuni` + `sections[]`). | HTML main vs `sito/domande-frequenti.html`: replica **99,31%**, pagina reale **11,59%** (233 token su 865). |
| R2 | Il monolite era scritto in utility Tailwind, ma la shell mette **sempre** `data-dc` e `postcss/isolate-legacy-important.cjs` emette ogni utility come `.x:not(:where(body:has(.page-content[data-dc]), body:has(.page-content[data-dc]) *))`: **su pagine `data-dc` le utility sono spente**. Le regole legacy `body:has(.page-content[data-dc]) .px-4 / .bg-primary` (`!important`) e `… h2` vincono. | `getComputedStyle` su `fixcity.eu`: titolo rating 40px (atteso `text-xl`), contenitore 1280px senza `max-width`, stelle `svg` 0×0. Le 35 classi usate erano **presenti** nel CSS servito: il grep della classe non prova nulla. |
| R3 | CSS di pagina: `main[data-page="domande-frequenti"]` (49 righe), `<style>` inline di 24 righe, `faq-parity.css` (700 righe, 143 selettori, **tutti** sotto `dc-faq-parity`, classe aggiunta solo da `domande-frequenti-parity.js`, import disattivato in `app.js`). | Il bundle servito conteneva 138 occorrenze di `dc-faq-parity`: peso morto in ogni pagina. |
| R4 | Una cartella Folio omonima (`pages/domande-frequenti/`) **intercetta** l'URL: Folio 1.2.0 prova `MatchLiteralDirectories` prima di `MatchWildcardDirectories`. Un file `pages/domande-frequenti.blade.php` invece perde (`MatchLiteralViews` viene dopo; misurato: la shell ha continuato a servire `domande-frequenti.index`) ma è una seconda sorgente morta. | `vendor/laravel/folio/src/Router.php` (pipeline), prove HTTP del 2026-10-20 08:01. |

## Decisione (D23)

La FAQ è un JSON che compone blocchi condivisi. Niente view Folio, niente `parity_page`, niente CSS o JS che nomini la pagina. Il
riuso sta nel componente `cmp-*`. Utility Tailwind **non** si usano su pagine `data-dc`.

## Acceptance criteria

| AC | Stato | Prova |
|---|---|---|
| 1. `/{it,en,de,es}/domande-frequenti` → 200, un solo `h1` localizzato | ✅ | curl 4 lingue; `FaqPageCompositionContractTest` |
| 2. `index.json` compone `content-page` (search + accordion `source: faq`), nessun `parity_page`, copy per lingua nel JSON | ✅ | test di contratto (mutazione verificata) |
| 3. Domande da `ListPublishedFaqsAction` (12 in locale), non dal JSON | ✅ | probe Playwright |
| 4. Filtro live, stato vuoto, "Carica altre domande", accordion, rating funzionano | ✅ | probe: 5/12 visibili; «foto» → 4; testo assurdo → 0 + messaggio; svuota → 5; carica → 12 e pulsante nascosto; accordion `show` (112px); stella → form rating |
| 5. Nessun CSS/JS di pagina; CSS non cresce | ✅ sorgenti / ⏳ bundle | rimossi `faq-parity.css`, `domande-frequenti-parity.js`, `.dc-faq-hero-section`, import e commento; test `nessun CSS o JS del tema nomina la pagina FAQ` |
| 6. Nessuna Folio per pagina (cartella **e** file) | ✅ | `NoSemanticFolioPageDirectoriesTest` esteso al file |
| 7. 375 e 1280 px senza overflow, console pulita | ✅ | probe |
| 8. 768 px, WCAG 2.1 AA (axe), target 44px | ⏳ UNVERIFIED | non misurati; il pulsante cerca è 40px (stile `.btn` condiviso, decisione PRODUCT) |
| 9. HTML main ≥ 90% vs riferimento | ❌ 63,91% (url-norm. 67,28%) | **non raggiungibile con copy reale**: scheletro tag+classe (testo ignorato) 87,6% (replica 99,9%); il divario di 86 elementi è ≈ 8 domande in meno × 11 elementi. Il riferimento ha 20 domande lorem. Decisione PRODUCT: gate sulla struttura. |

## Scope (file proprietari)

- `laravel/config/local/fixcity/database/content/pages/domande-frequenti/index.json` — composizione + copy it/en/de/es (traduzioni riprese da `lang/*/faq.php`).
- `Themes/Sixteen/resources/views/components/blocks/content-page/sections/accordion.blade.php` — `source`, `visible`, `filterable`, `empty` (opzionali; senza flag il markup della replica non cambia).
- `Themes/Sixteen/resources/views/components/blocks/content-page/partials/search.blade.php` — `filter` (evento `list-filter`, Alpine).
- `Themes/Sixteen/resources/css/app.css`, `style-apply.css`, `resources/js/app.js` — import/regole morte rimosse.
- `Themes/Sixteen/tests/Unit/FaqPageCompositionContractTest.php` (nuovo), `NoSemanticFolioPageDirectoriesTest.php` (esteso).
- Dominio: `Modules/Fixcity` (`ListPublishedFaqsAction`, `Faq`, `CivicFaqCatalog`) — invariato.

## Task residui

- **T1** Rimuovere il monolite `components/pages/faq.blade.php`, il tipo di blocco `faq-page` e le chiavi `pub_theme::faq.search|feedback|contacts` ora inutilizzate (un altro agente lavorava sul monolite durante questa sessione: coordinare qui prima di cancellare).
- **T2** `cd laravel/Themes/Sixteen && npm run build` e misura prima/dopo (`app-DnJphMdj.css` serviva 3.781.414 byte). Mai `npm run copy` da solo (azzera immagini).
- **T3** Rilascio su `fixcity.eu` e nuova verifica (`DEPLOYMENT`).
- **T4** Blueprint Filament: il catalogo `Faq` non ha Resource; oggi si modifica solo da seeder. Resource nel modulo Fixcity (non nel tema, vedi `filament-blueprint.md`).
- **T5** Decisioni PRODUCT: gate di parity sulla struttura per pagine con copy di dominio; target 44px per i pulsanti `.btn`.
- **T6** Verifica 768px + axe sulla FAQ.

## Evidenze e comandi

```bash
node bashscripts/tools/visual/compact-markup.mjs https://italia.github.io/design-comuni-pagine-statiche/sito/domande-frequenti.html --tag main --out /tmp/ref.html
node bashscripts/tools/visual/compact-markup.mjs http://127.0.0.1:8000/it/domande-frequenti --tag main --out /tmp/local.html
node bashscripts/tools/visual/compare-body-html.mjs /tmp/ref.html /tmp/local.html   # 63,91% (prima 11,59%)
```

Test (da radice, mai `./vendor/bin/pest` nudo: vedi `docs/prompts/04.md`):
`bash bashscripts/tools/pest-scratch-db.sh Themes/Sixteen/tests/Unit/FaqPageCompositionContractTest.php Themes/Sixteen/tests/Unit/NoSemanticFolioPageDirectoriesTest.php` → 3 passati (42 asserzioni).

## Learnings

1. **Misurare, non dedurre dal nome della classe.** Su `data-dc` una utility può esistere nel CSS e non applicarsi.
2. **Cercare la composizione prima di scrivere markup.** La replica già a 99,31% era nello stesso repo.
3. **Un guardiano che non ha mai fallito non prova nulla**: il test CSS è stato mutato con un file-sonda e ha fallito indicando il file.
4. **Incidente collaterale:** il merge `merge_remote_repo_2.sh` ha lasciato marker `.merge_file_*` in `pages/[container0]/index.blade.php` (08:04) → 500 su tutte le pagine CMS (FAQ, blog, eventi). Risolto nel contenuto (lato locale con titolo e meta description), senza toccare lo stato git.
