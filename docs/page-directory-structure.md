# Sixteen Page Directory Structure

## Regola canonica

<<<<<<< HEAD
Nel tema `Sixteen` la cartella `resources/views/pages` deve restare minimale e agnostica.

Sono ammessi solo questi entrypoint:
=======
Nel tema `Sixteen` la cartella `resources/views/pages` deve restare minimale, agnostica e controllata da Folio.

Sono ammesse solo queste directory top-level:
>>>>>>> edd328a (.)

```text
resources/views/pages/
├── [container0]/
<<<<<<< HEAD
│   └── [slug0]/
=======
>>>>>>> edd328a (.)
├── auth/
└── tests/
```

<<<<<<< HEAD
=======
`[container0]` contiene la shell dinamica per contenuti CMS e detail page. `auth` contiene le pagine di autenticazione del tema. `tests` contiene solo pagine di showcase/verifica.

>>>>>>> edd328a (.)
## Directory ammesse

- `resources/views/pages/[container0]`
- `resources/views/pages/auth`
- `resources/views/pages/tests`

<<<<<<< HEAD
=======
Qualsiasi altra directory top-level sotto `resources/views/pages` è vietata.

>>>>>>> edd328a (.)
## Directory vietate

Non devono esistere directory semantiche hardcoded come:

- `resources/views/pages/administration`
<<<<<<< HEAD
- `resources/views/pages/ambiente`
- `resources/views/pages/article`
- `resources/views/pages/articles`
- `resources/views/pages/categories`
- `resources/views/pages/cultura`
- `resources/views/pages/dashboard`
- `resources/views/pages/eventi`
- `resources/views/pages/famiglia`
- `resources/views/pages/genesis`
- `resources/views/pages/lavoro`
- `resources/views/pages/learn`
- `resources/views/pages/mobilita`
- `resources/views/pages/news`
- `resources/views/pages/pages`
- `resources/views/pages/profile`
- `resources/views/pages/salute`
- `resources/views/pages.tickets`
- `resources/views/pages/services`
- `resources/views/pages/sport`
- `resources/views/pages/tickets`
- `resources/views/pages/turismo`
=======
- `resources/views/pages/area-personale`
- `resources/views/pages/article`
- `resources/views/pages/articles`
- `resources/views/pages/categories`
- `resources/views/pages/genesis`
- `resources/views/pages/learn`
- `resources/views/pages/news`
- `resources/views/pages/pages`
- `resources/views/pages/personal-area`
- `resources/views/pages/profile`
- `resources/views/pages/segnalazioni`
- `resources/views/pages/services`
- `resources/views/pages/tickets`
>>>>>>> edd328a (.)

## Perché

- DRY: un solo router tematico dinamico invece di molti alberi duplicati.
- KISS: meno viste Folio special-case, meno collisioni, meno manutenzione.
<<<<<<< HEAD
=======
- Ownership: le pagine applicative appartengono al modulo owner, non al tema pubblico.
>>>>>>> edd328a (.)
- Portabilità: il tema pubblico cambia da `pub_theme`, quindi il routing del tema deve restare generico.
- Coerenza CMS: i contenuti si risolvono da slug e JSON, non da una directory dedicata per dominio editoriale.

## Pattern richiesti

### Tests

Il file [`[slug].blade.php`](../resources/views/pages/tests/[slug].blade.php) è l'unico entrypoint dinamico per tutte le pagine `tests/*`.

Il file [`index.blade.php`](../resources/views/pages/tests/index.blade.php) è l'entrypoint per `/tests`.

### Frontoffice dinamico

Il pattern generico resta:

- `resources/views/pages/[container0]/index.blade.php`
- `resources/views/pages/[container0]/[slug0]/index.blade.php`
<<<<<<< HEAD
=======
- `resources/views/pages/[container0]/[slug0]/[container1]/index.blade.php`

Esempi:

| URL | Folio Sixteen | Owner contenuto |
|-----|---------------|-----------------|
| `/it/tickets` | `[container0]/index.blade.php` | CMS slug `tickets.index` + Fixcity |
| `/it/tickets/14` | `[container0]/[slug0]/index.blade.php` | CMS slug `tickets.view` + Fixcity |
| `/it/services` | `[container0]/index.blade.php` | CMS slug `services.index` |

### Pagine applicative

Le pagine con logica applicativa non devono vivere in `Themes/Sixteen/resources/views/pages/<dominio>`.

- Se sono routing FO applicativo, stanno nel modulo owner (`Modules/User/resources/views/pages/area-personale/...`, `Modules/Fixcity/resources/views/pages/...`).
- Se sono sorgenti storici non routabili, non restano nel tema: si eliminano o si ricreano nel modulo owner quando servono davvero.
>>>>>>> edd328a (.)

## Layout contract

Le pagine Folio non devono contenere header, footer o skiplink inline. Quegli elementi vivono nel layout:

- [`app.blade.php`](../resources/views/layouts/app.blade.php)
- [`main.blade.php`](../resources/views/layouts/main.blade.php)

## Enforcement (agenti + CI)

<<<<<<< HEAD
- Rule Cursor: `.cursor/rules/no-semantic-folio-page-dirs.mdc`
- Wiki: [no-semantic-folio-page-directories.md](../../../../docs/wiki/rules/no-semantic-folio-page-directories.md)
- Script: `bash bashscripts/tools/verify-no-semantic-folio-pages.sh`
- Pest: `NoSemanticFolioPageDirectoriesTest.php`

## Collegamenti

- [folio-no-semantic-pages-tickets.md](./wiki/concepts/folio-no-semantic-pages-tickets.md) — post-mortem STORY-285 (`sixteen::` / `pages/tickets`)
- [README.md](./README.md)
- [layout-runtime-contract.md](./layout-runtime-contract.md)
- [component-page-runtime.md](./component-page-runtime.md)
- [../../Modules/Cms/docs/page-directory-structure.md](../../Modules/Cms/docs/page-directory-structure.md)
=======
- Rule: [`docs/wiki/rules/no-semantic-folio-page-directories.md`](../../../../docs/wiki/rules/no-semantic-folio-page-directories.md)
- Script: `bashscripts/tools/verify-no-semantic-folio-pages.sh`
- Pest: `NoSemanticFolioPageDirectoriesTest.php`
- Quality gate: `bash bashscripts/quality-gates/verify-llm-wiki.sh`

## Collegamenti

- [folio-no-semantic-pages-tickets.md](./wiki/concepts/folio-no-semantic-pages-tickets.md)
- [folio-page-pattern.md](./folio-page-pattern.md)
- [wiki/concepts/folio-volt-app-pages.md](./wiki/concepts/folio-volt-app-pages.md)
- [README.md](./README.md)
- [layout-runtime-contract.md](./layout-runtime-contract.md)
>>>>>>> edd328a (.)
