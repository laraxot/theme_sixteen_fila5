# Sixteen Theme — Scripts

[![Module](https://img.shields.io/badge/Module-Sixteen Theme — Scripts-8B0000.svg)]()
[![Laravel](https://img.shields.io/badge/Laravel-13-red?style=for-the-badge)](https://laravel.com/)](https://laravel.com/)
[![Filament](https://img.shields.io/badge/Filament-5-ffab00?style=for-the-badge)](https://filamentphp.com/)](https://filamentphp.com/)
[![PHP](https://img.shields.io/badge/PHP-8.4+-777BB4?style=for-the-badge)](https://php.net/)](https://php.net/)
[![PHP](https://img.shields.io/badge/PHP-8.4+-777BB4?style=for-the-badge)](https://php.net/)](https://phpstan.org/)
[![PSR-12](https://img.shields.io/badge/Code-PSR--12-blue?style=for-the-badge)](https://www.php-fig.org/psr/psr-12/)](https://www.php-fig.org/psr/psr-12/)
[![Architecture](https://img.shields.io/badge/Architecture-Modular-purple?style=for-the-badge)](https://martinfowler.com/articles/paradigm-shifts.html)]()
]()

> **⚠️ Questi script sono "tool da officina", non sostituiscono i test Pest/Jest del modulo.**

## Perché esiste

⚠️ Questi script sono "tool da officina", non sostituiscono i test Pest/Jest del modulo.

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
Tutti gli script ad-hoc / di tooling vivono qui sotto, mai nella root del tema.
La root deve restare pulita: solo file essenziali (build config, package, docs/, resources/, public/, app/, lang/, views/, node_modules/).

## Layout

```
laravel/Themes/Sixteen/
├── scripts/
│   ├── build/             # Build helpers shell
│   ├── verify/            # Smoke test / DOM verification one-shot (.mjs/.js)
│   └── config-variants/   # Vite/Tailwind/package config alternativi (sperimentali, non in produzione)
└── docs/scripts/README.md # questo file
```

## scripts/build/

| File | Cosa fa | Quando si usa |
|------|---------|---------------|
| `build-advanced.sh` | Wrapper bash sopra `npm run build` con flag/log estesi | Build manuale con diagnostica più verbosa |

Esecuzione: `bash scripts/build/build-advanced.sh` (dalla root del tema Sixteen).

## scripts/verify/

Smoke test JS/MJS one-shot per verificare DOM/render dopo un fix UI. Non sono test Jest/Pest:
sono utility manuali per ispezionare HTML servito dall'app dev.

| File | Cosa fa |
|------|---------|
| `check-header-local.js` | Controlla che l'header `<x-header>` renderizzi i link locali attesi (logo, search, login button). |
| `debug-test.mjs` | Stampa info di debug sul markup del wizard segnalazione. |
| `dom-full-test.mjs` | Full DOM dump della pagina segnalazione-crea per snapshot diff. |
| `final-verify.mjs` | Verifica finale step-by-step del flow.ticket (privacy → form.data → riepilogo). |
| `full-verify.mjs` | Variante più esaustiva del `final-verify.mjs`. |
| `step-content-test.mjs` | Test del contenuto di ogni step del wizard. |
| `stepper-test.mjs` | Verifica visibilità/stato dello stepper (active/completed). |
| `verify-test.mjs` | Verifica generale render pagine tests/*. |

Esecuzione: `node scripts/verify/<file>.mjs` (app dev deve essere in ascolto su `http://127.0.0.1:8000`).

> ⚠️ Questi script sono "tool da officina", non sostituiscono i test Pest/Jest del modulo.
> Per testing canonico usare `php artisan test --compact` e `npm test`.

## scripts/config-variants/

Configurazioni alternative tenute per riferimento (NON usate dal build di produzione).
Il build canonico usa `vite.config.js` + `package.json` + `tailwind.config.js` della root del tema.

| File | Note |
|------|------|
| `vite.config.css-only.js` | Variante che builda solo il CSS, escludendo i bundle JS. Utile per pipeline CSS-only. |
| `vite.config.optimized.js` | Esperimento di tree-shaking e splitting aggressivo. Non usato in produzione. |
| `vite.config.simple.js` | Variante minimale per debug del build. |
| `tailwind-optimized.config.js` | Tailwind config con safelist ridotta — esperimento di bundle slimming. |
| `package.optimized.json` | Package.json sperimentale con devDeps potate. |

> Prima di riattivare uno di questi varianti: verifica compatibilità con
> Tailwind v4 + DaisyUI v5 (vedi `laravel/Themes/Sixteen/docs/DAISYUI.md`).

## Regola operativa

- **Mai script ad-hoc in root del tema.** Tutti i nuovi `*.cjs/*.mjs/*.sh/*.js` di servizio vanno in `scripts/<categoria>/`.
- **Documentare ogni script** in questo `docs/scripts/README.md` (cosa fa, quando si usa).
- Se uno script viene chiamato da `package.json`, l'`scripts.*` path in `package.json` punta a `scripts/<...>/<file>`.

Vedi memoria [feedback-theme-root-clean](../../../../../home/zorin/.claude/projects/-var-www--bases-base-fixcity-fila5/memory/feedback_theme_root_clean.md) e issue GitHub di tracking.
