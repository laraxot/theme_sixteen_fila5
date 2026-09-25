# Segnalazione Disservizio - Documentation Index

<<<<<<< HEAD
[![Module](https://img.shields.io/badge/Module-Segnalazione Disservizio - Documentation Index-8B0000.svg)]()
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
=======
Documentation for implementing the "Segnalazione Disservizio" (Report Issue) flow in Design Comuni pages.

## Overview

Implementation of the citizen report flow following Design Comuni Italia patterns.

## Reference

- **Design Comuni Reference**: https://italia.github.io/design-comuni-pagine-statiche/sito/ticket-list.html
- **Reference HTML**: [`reference_segnalazioni.html`](./reference_segnalazioni.html)
- **Local HTML**: [`local_segnalazioni.html`](./local_segnalazioni.html) (generated)

## Pages in Flow

| Step | Page | Slug | Blade |
|------|------|------|-------|
| 1 | Privacy | `/it/tests/segnalazione-01-privacy` | `[slug].blade.php` |
| 2 | Dati | `/it/tests/segnalazione-02-dati` | `[slug].blade.php` |
| 3 | Riepilogo | `/it/tests/segnalazione-03-riepilogo` | `[slug].blade.php` |
| 4 | Conferma | `/it/tests/segnalazione-04-conferma` | `[slug].blade.php` |
| Elenco | Elenco segnalazioni | `/it/tests/ticket-list` | `[slug].blade.php` |

## Architecture

- **Blade**: `laravel/Themes/Sixteen/resources/views/pages/tests/[slug].blade.php`
- **JSON Config**: `laravel/config/local/fixcity/database/content/pages/tests.*.json`
- **Component**: `laravel/Themes/Sixteen/resources/views/components/blocks/segnalazioni/layout.blade.php`
- **Translations**: `laravel/Modules/Fixcity/lang/{it,en}/segnalazione.php`
- **Translation Pattern**: `fixcity::segnalazione.{context}.{key}.{type}`

## Comparison Reports

- **Body Structure Comparison**: `laravel/Themes/Sixteen/docs/body-structure-comparison/ticket-list/`
  - [`report.md`](../body-structure-comparison/ticket-list/report.md)
  - [`summary.json`](../body-structure-comparison/ticket-list/summary.json)
  - [`diff_details.json`](../body-structure-comparison/ticket-list/diff_details.json)
  - [`reference-body.html`](../body-structure-comparison/ticket-list/reference-body.html)
  - [`local-body.html`](../body-structure-comparison/ticket-list/local-body.html)
  - [`ticket-list-html-parity-analysis.md`](./ticket-list-html-parity-analysis.md)

## CSS

- **Parity Styles**: `laravel/Themes/Sixteen/resources/css/segnalazione-parity.css`

## Related Documentation

- [Theme Docs Index](../README.md)
- [Body Structure Comparison Index](../body-structure-comparison/INDEX.md)
- [Root Bridge Config](../../../../../docs/html-structure-comparison.md)
>>>>>>> laraxot/dev
