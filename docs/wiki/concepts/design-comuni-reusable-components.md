# Design Comuni — Componenti Riutilizzabili

## Concetto
I blocchi (`components/blocks/`) sono pezzi di UI riutilizzabili. Devono essere configurabili via `@props` e non hard-codati.

## Riferimenti
- **BMAD**: docs/stories/STORY-BLOG003-reusable-components.md
- **Source**: docs/sources/STORY-BLOG003-reusable-components.md
- **Rule**: docs/rules/reusable-components.md

## Esempi implementati
| Componente | Configurazione | Pagina |
|------------|----------------|--------|
| `blocks/blog/index.blade.php` | `blog.index.json` | `/it/blog` |
| `blocks/events/index.blade.php` | `events.index.json` | `/it/events` |
| `pages/[container0]/index.blade.php` | Folio FolioManager | Ogni pagina CMS |

## Principi EEC
- Minimo necessario
- Zero duplicazione di logica
- Presentazione separata dai dati (ThemeComposer)
