# archive/docs-legacy — documentazione storica del tema Sixteen

Questo archivio raccoglie la documentazione precedente alla consolidazione di
`docs/` (issue
[#119](https://github.com/laraxot/theme_sixteen_fila5/issues/119), obiettivo:
`find docs -name '*.md' | wc -l` <= 100).

**Contenuto**: tutto cio' che era in `docs/` e non e' piu' considerato canonico:

- `root/` — i ~420 file `.md` sciolti alla radice di `docs/` (report di fase,
  audit, piani, confronti HTML/body, fix CSS datati, analisi login/agid,
  roadmap storiche, draft e duplicati di case) piu' `PRIORITY-MATRIX.json`,
  `prd.json`, `visual-parity-data.json`;
- `design-comuni/` (156+ file) — specifiche e report di parita' pagina per
  pagina, confronti HTML, batch body-parity;
- `prompts/` (97) — prompt di coordinamento tra agenti per homepage e wizard;
- `pages/` (74) — contratti storici per pagina;
- `body-structure-comparison/`, `html-structure-comparison/`,
  `html-parity-reports/`, `html-compare/`, `visual-analysis/`,
  `visual-parity/`, `analysis/`, `investigation/`, `comparisons/`,
  `decision-log/`, `second-brain/`, `build/`, `ui-fixes/`, `agid/`, `auth/`,
  `i18n/`, `compliance/`, `email/`, `marketing/`, `product/`, `roadmap/`,
  `plans/`, `implementation/`, `phases/`, `wizard/`, `blocks/`, `components/`,
  `clean-code/`, `best-practices/`, `computing/`, `concepts/`, `sources/`,
  `knowledge-pages/`, `mappings/`, `logo/`, `assets/`, `mcp/`, `qmd-index/`,
  `raw/`, `screenshots/`, `Main_files/`, `graphify-out/`, `bmd/`, `css/`,
  `css-js-parity/`, `how-to/`, `llm-wiki/`;
- `wiki/` — la llm-wiki del tema (concepts, comparisons, rules, memories,
  troubleshooting, raw sources): le uniche pagine mantenute in
  `docs/wiki/concepts/` sono quelle referenziate dal codice
  (`fo-folio-named-routes-header.md`, `fo-folio-links-multilingua.md`,
  `header-color-parity.md`). Il resto e' archiviato perche' la wiki era
  generata e non piu' mantenuta; se serve una pagina, copiarla qui o
  ripristinarla con `git mv` da questo archivio;
- `bmad/` — piano, decisioni, evidence e brainstorming non-storia;
  `bmad/stories/` contiene solo le due story `docs-organization-themes`
  concluse (`done-with-open-decisions`);
- `stories/` — le story concluse (`done`, `completed`, `implemented`,
  `superseded`) e quelle senza `status` nel frontmatter (draft storici);
- `adr/` — `0000-template.md` e `README.md` di comodo;
- `contracts/` — `INDEX.md` (duplicato di `index.md`), `README.md`,
  `_template.md`;
- `architecture/` — documenti di architettura di secondo livello
  (`wizard-*`, `privacy-policy-folio-route`, `fo-pa-tokens-uniformity`,
  `css-filename-english-naming`, `tailwind-alpine-philosophy`,
  `stepper-responsive-rule`);
- `design-system/` — `README.md`, `components.md`, `argomenti.md`, `pages/`
  (restano `MASTER.md` e `tokens.md`).

## Regole

- Archivio in **sola lettura**: non aggiungere documenti nuovi qui
  (`docs/archive/` era gia' vietato per i nuovi doc; questo percorso esterno
  a `docs/` segue la stessa logica).
- I link interni dei documenti mantenuti in `docs/` che puntano a file
  archiviati qui vanno considerati storici: il percorsi equivalente e'
  `archive/docs-legacy/<percorso-relativo-originale>`.
- Per recuperare un file: `git mv archive/docs-legacy/<path> docs/<path>`.

Eliminati in via definitiva (policy *.old): `*.old` in `css/`,
`design-comuni/`, `auth/`, `bmad/stories/`, `visual-analysis/`,
`wiki/comparisons/`, `wiki/troubleshooting/` e `FOOTER-CSS-FIX-2026-04-02.md.old`.
