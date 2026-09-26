# Body Structure Comparison Results

<<<<<<< HEAD
Canonical output directory for HTML parity reports.

## How To Run

```bash
bashscripts/html/html-structure-compare.sh segnalazione-dettaglio \
  --output-dir laravel/Themes/Sixteen/docs/body-structure-comparison \
  --threshold 90
```

## Output Layout

- `<page>/report.md`
- `<page>/diff_details.json`
- `<page>/reference-body.html`
- `<page>/local-body.html`
- `<page>/reference-structure.json`
- `<page>/local-structure.json`

## Current Index

See [`INDEX.md`](./INDEX.md) for parity scores and page-level artifacts.

## Governance

- Bash scripts are reusable and project-agnostic.
- Theme-specific artifacts stay under `laravel/Themes/Sixteen/docs/...`.
- Raw HTML snapshots for manual analysis go in `laravel/Themes/Sixteen/docs/prompts/<page>/`.

- Priority rule: structural HTML parity is essential first; visual/functional parity is addressed after via Tailwind @apply + Alpine.js.
=======
[![Module](https://img.shields.io/badge/Module-Body Structure Comparison Results-8B0000.svg)]()
[![Laravel](https://img.shields.io/badge/Laravel-13-red?style=for-the-badge)](https://laravel.com/)](https://laravel.com/)
[![Filament](https://img.shields.io/badge/Filament-5-ffab00?style=for-the-badge)](https://filamentphp.com/)](https://filamentphp.com/)
[![PHP](https://img.shields.io/badge/PHP-8.4+-777BB4?style=for-the-badge)](https://php.net/)](https://php.net/)
[![PHP](https://img.shields.io/badge/PHP-8.4+-777BB4?style=for-the-badge)](https://php.net/)](https://phpstan.org/)
[![PSR-12](https://img.shields.io/badge/Code-PSR--12-blue?style=for-the-badge)](https://www.php-fig.org/psr/psr-12/)](https://www.php-fig.org/psr/psr-12/)
[![Architecture](https://img.shields.io/badge/Architecture-Modular-purple?style=for-the-badge)](https://martinfowler.com/articles/paradigm-shifts.html)]()
]()

> **Core module for the FixCity Platform.**

## Perché esiste

Core module for the FixCity Platform.

## Superpoteri

- Modular component with XotBase patterns
- Professional-grade implementation
- Integrated with FixCity Platform

## Documentazione

| Lingua | Link |
|--------|------|
| 🇮🇹 Presentazione | Questo file (`README.md`) |
| 🇬🇧 Business card | [docs/readme-en.md](./docs/readme-en.md) |
| 📚 Wiki tecnica | [./docs/wiki/](./docs/) |

---

**Modulo** `Sixteen` · **Laraxot** · **FixCity Platform** · PHPStan 10 · Filament 5
>>>>>>> laraxot/dev
