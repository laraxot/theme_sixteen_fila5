# segnalazione-02-dati

<<<<<<< HEAD
[![Module](https://img.shields.io/badge/Module-segnalazione-02-dati-8B0000.svg)]()
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
Cartella di lavoro per la fase HTML parity di `segnalazione-02-dati`.

## Obiettivo
- Raggiungere almeno il `90%` di parity strutturale HTML rispetto alla reference Design Comuni.
- Usare solo la blade dinamica [`/var/www/_bases/base_fixcity_fila5/laravel/Themes/Sixteen/resources/views/pages/tests/[slug].blade.php`](/var/www/_bases/base_fixcity_fila5/laravel/Themes/Sixteen/resources/views/pages/tests/[slug].blade.php).
- Salvare gli artifact di confronto in `body-structure-comparison/`.

## Guardrail permanenti
- Il tag `<body>` deve restare plain: solo `<body>`, senza classi o attributi di parity.
- Per questa route lo scoping CSS/JS corretto parte da `.page-content[data-slug="tests.segnalazione-02-dati"]`, perche `pages/tests/[slug].blade.php` ora usa il wrapper canonico del Cms.
- Lo stepper mobile/tablet della pagina deve replicare il reference con un solo step visibile + contatore `2/3`.
- I fix di visual parity vanno fatti in CSS/JS, non introducendo hook HTML extra nel body.

## Comando

```bash
bashscripts/html/html-structure-compare.sh \
  "https://italia.github.io/design-comuni-pagine-statiche/sito/segnalazione-02-dati.html" \
  "http://127.0.0.1:8000/it/tests/segnalazione-02-dati" \
  "segnalazione-02-dati" \
  "laravel/Themes/Sixteen/docs/prompts/segnalazione-02-dati/body-structure-comparison" \
  90
```

## Output
- `body-structure-comparison/report.md`
- `body-structure-comparison/summary.json`
- `body-structure-comparison/diff.txt`
- `body-structure-comparison/reference-body.html`
- `body-structure-comparison/local-body.html`
>>>>>>> laraxot/dev
