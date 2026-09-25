# Segnalazioni elenco

<<<<<<< HEAD
[![Module](https://img.shields.io/badge/Module-Segnalazioni elenco-8B0000.svg)]()
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
Data: 2026-04-04

## Obiettivo
Allineare il layout della pagina `tests.ticket-list` alla reference, mantenendo filtro + mappa affiancati anche quando si passa alla tab "Elenco" e documentando i pulsanti di filtro e `Elenco`/`Mappa`.

## Cosa ho fatto
- creato il nuovo blocco `pub_theme::components.blocks.segnalazioni.layout` che contiene sidebar + tab mappa/elenco con `x-data` per la logica delle tab/modali;
- trasferito i dati delle categorie direttamente nel blocco (via proprietà `filters.items`), eliminando il blocco `sidebar-filters` duplicato;
- aggiornato il JSON `laravel/config/local/fixcity/database/content/pages/tests.ticket-list.json` sul tema per usare il blocco nuovo e passare `filters`, `tabs`, `cta`, `items`, `results_count`;
- rigenerati gli asset (`npm run build`, `npm run copy`) e pulite le cache (`php artisan optimize:clear`).

## Verifica
- l'HTML locale mostra ora il `row segnalazioni-layout` con la colonna filtri (`col-lg-3`) e la colonna principale (`col-lg-9`) contenente mappa/tab ed elenco;
- cliccando su "Elenco" la mappa resta visibile a lato mentre le schede dettagli si dispongono sul lato destro; i pulsanti "Filtra" (mobile) e "Rimuovi filtri" mantengono lo stesso significato originale della reference; i filtri scompaiono su mobile via modal `showFilterModal`.
- gli screenshot aggiornati sono in `local.png` (locale) e `reference.png` (reference).

## Artifacts
- [local.png](./local.png)
- [reference.png](./reference.png)

## Next passi
- stabilire eventuali variazioni visive nel tab "Mappa" (modal immagini + pin). Se ulteriori differenze emergono, aggiornare i CSS/JS specifici all'interno di `resource/css/app.css` e, se serve, aggiungere un piccolo script Alpine alla pagina stessa.
>>>>>>> laraxot/dev
