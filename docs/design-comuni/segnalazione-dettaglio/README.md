# Segnalazione dettaglio

<<<<<<< HEAD
[![Module](https://img.shields.io/badge/Module-Segnalazione dettaglio-8B0000.svg)]()
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
Data: 2026-04-03

## Obiettivo

Rimpiazzare la test page placeholder `tests.segnalazione-dettaglio` con una pagina strutturata come la reference Design Comuni per la scheda servizio.

## File toccati

- `laravel/Themes/Sixteen/resources/views/components/blocks/tests/ticket-detail.blade.php`
- `laravel/config/local/fixcity/database/content/pages/tests.segnalazione-dettaglio.json`
- `laravel/Themes/Sixteen/resources/css/app.css`

## Esito

- route locale: `200 OK`
- breadcrumb reale aggiunto
- hero/header servizio aggiunto
- indice laterale pagina aggiunto
- sezioni principali del servizio aggiunte
- sezione contatti nel `main` aggiunta
- rating finale mantenuto come blocco tema esistente
- `npm run build` eseguito
- `npm run copy` eseguito
- `artisan optimize:clear` eseguito

## Artifacts

- [local.png](./local.png)
- [reference.png](./reference.png)

## Note

La pagina non usa Bootstrap Italia runtime: la replica e ottenuta con markup compatibile e CSS scoped del tema Sixteen.
>>>>>>> laraxot/dev
