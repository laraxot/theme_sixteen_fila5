# BMAD Story — s-parity-all-pages

- Type: epic-story
- Title: "Visual parity — ALL /it/tests/* pages vs https://italia.github.io/design-comuni-pagine-statiche/"
- Status: IN_PROGRESS
- Required parity: HTML ≥90% / visual ≥95%
- Stack: TailwindCSS + Alpine.js + Lit + DaisyUI + Flowbite (NO Bootstrap)
- Reference URL base: https://italia.github.io/design-comuni-pagine-statiche/
- Pages mapped (tests.* JSON files in config/local/fixcity/database/content/pages/):

| Page slug | Reference file | BMAD story file | Status |
|---|---|---|---|
| tests.index | sito/index.html | s-parity-visual.md | IN_PROGRESS |
| homepage | sito/homepage.html | s-parity-visual.md | IN_PROGRESS |
| amministrazione | sito/amministrazione.html | (to create) | PENDING |
| domande-frequenti | sito/domande-frequenti.html | (to create) | PENDING |
| risultati-ricerca | sito/risultati-ricerca.html | (to create) | PENDING |
| argomenti | sito/argomenti.html | (to create) | PENDING |
| catalog | sito/ (map) | (to create) | PENDING |
| segnalazione-dettaglio | sito/segnalazione-dettaglio.html | (to create) | IN_PROGRESS |
| segnalazioni-elenco | sito/segnalazioni-elenco.html | (to create) | IN_PROGRESS |
| segnalazione-area-personale | sito/segnalazione-area-personale.html | (to create) | IN_PROGRESS |

- Block errors fixed: faq/default.blade.php, search-results/default.blade.php
- Screenshot comparison (95% visual): NOT COMPLETE — needs `npx playwright screenshot` per page with viewport 1280x800, saved to /tmp/screenshots/{local,ref}/
- Initiatives: kp-b4af21c7bb2a4f5d93e0cce9fc18a80c (visual parity), kp-174d15a58ff94901b2b0df0d86b8907a (header/footer)
