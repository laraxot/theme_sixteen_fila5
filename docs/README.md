---
title: "Sixteen: ingresso alla documentazione"
type: readme
tags: [documentation, sixteen]
created: 2026-09-26
updated: 2026-10-14
qmd: "sixteen theme readme stato pub_theme vivo contenuti conteggi build npm limiti rotte dormienti layout design-comuni"
issues: []
discussions: []
status: active
---

# Sixteen

Tema pubblico (front office) di Fixcity: resa Design Comuni su Laravel 13, PHP 8.4, Filament 5. Biglietto da visita: [IT](../README.md), [EN](./readme-en.md). L'indice operativo e' [00-INDEX.md](00-INDEX.md).

## Stato verificato (2026-10-14)

| Domanda | Risposta | Prova |
|---|---|---|
| E' il tema in uso? | si, vivo | `'pub_theme' => 'Sixteen'` in tutti e 4 i `laravel/config/**/xra.php`; `public_html/themes/Sixteen` e' un link a `laravel/Themes/Sixteen/public/` |
| Dove vive il codice? | repo git separato (submodule) | `gitmodules.ini`, remote `git@github.com:laraxot/theme_sixteen_fila5.git`; Composer `laraxot/theme_sixteen_fila5`, namespace `Themes\Sixteen\` (app/), provider `Providers\ThemeServiceProvider` che estende `XotBaseThemeServiceProvider` |
| Altri temi | `TwentyOne` (importato da Predict, non usato), `Barthelemy` e `Meetup` (gusci senza codice) | [Barthelemy/docs/README.md](../../Barthelemy/docs/README.md) |

## Cosa contiene (conteggi del 2026-10-14)

- `resources/views/`: 957 file Blade. `layouts/` (11), `components/` (795, di cui `components/blocks/` con 166 voci e 508 Blade, piu' `header/`, `footer/`, `wizard/`, `layouts/`), `pages/` (Folio: `[container0]/`, `tests/[slug]`), `sections/` (footer), `partials/` (accessibility-bar, cookie-bar).
- `resources/css/` (95 file) e `resources/js/` (21 file); punti d'ingresso Vite: `app.css`, `app-test.css`, `app.js` e i Lit di Geo (`map-lit.js`).
- `app/` (79 file PHP): Actions (menu, SPID, CIE, blocchi, asset, URL), Enums (24), Models (13, di cui 9 in `Municipal/`), Http (5 controller, 2 middleware, 1 componente Livewire), Providers, Support, View.
- `lang/` it (43 file), en (43), de (16), es (15).
- `tests/`: 15 test Unit, 6 Feature, 10 spec Playwright in `tests/browser/`.
- `scripts/`: smoke e verifiche di parity (`map-*-smoke.cjs`, `auth-register-smoke.cjs`, `visual-parity.mjs`).

## Come si costruisce (da `package.json`)

- `npm run build`: `vite build` (uscita in `public_html/themes/Sixteen`, cioe' `public/`), poi `npm run copy`, poi `php artisan view:clear` in `laravel/`. `build:with-webroot` e' lo stesso senza `view:clear`.
- `npm run dev`: server Vite. `npm test`: Jest. `npm run lint` e `npm run format`.
- Smoke del browser: `test:map-picker-smoke`, `test:map-lit-smoke`, `test:map-lit-stress`, `test:auth-register-smoke`.
- Riferimento esteso: [build/INDEX.md](build/INDEX.md).

## Limiti noti (verificati)

- Il tema contiene controller e rotte (`app/Http/Controllers/`, `routes/web.php`, `routes/auth.php`) che a runtime non risultano registrati: `php artisan route:list` (461 rotte, senza route cache) non ha ne' `comune/*` ne' `auth/spid` ne' `auth/cie`. Sono codice dormiente, non la via con cui il tema serve le pagine.
- Restano viste legacy non usate dal CSS principale: `resources/views/bootstrap-italia/` (16 Blade), `layouts/bootstrap-italia*.blade.php` (4), `pages_old/` (45); gli `@import` di Bootstrap Italia in `app.css` sono commentati.
- Esistono `components/layouts/design-comuni.blade.php`, `design-comuni-authenticated.blade.php` e `design-comuni-bare.blade.php` (usato da `pages/tests/index.blade.php`), in contrasto con la regola [no-parallel-design-comuni-layout](wiki/rules/no-parallel-design-comuni-layout.md): vedi la story del 2026-10-14 per la decisione aperta.

## Ownership e stack canonico

Sixteen è già il tema Design Comuni: non si crea un secondo tema, layout o
namespace `design-comuni`. Il rendering usa TailwindCSS (`@apply`), Alpine.js,
Lit, DaisyUI e Flowbite; Bootstrap Italia non è una dipendenza runtime.

- contenuti: JSON CMS, con view block riusabili;
- shell pubblica: `x-layouts.app` e, quando dichiarato dal contratto pagina,
  `x-layouts.test`;
- routing pubblico: Folio e `PageSlugMiddleware`;
- accessibilità: WCAG 2.1 AA come requisito minimo, con verifica manuale e automatizzata;
- build: Vite, con asset generati nella public del tema.

## Documentazione

| Lingua | Link |
|--------|------|
| 🇮🇹 Presentazione | Questo file (`README.md`) |
| 🇬🇧 Business card | [docs/readme-en.md](./readme-en.md) |
| 📚 Wiki tecnica | [./wiki/](./wiki/) |
| 💶 Sostenibilità FO | [project-sustainability-front-office.md](./project-sustainability-front-office.md) |
| 📣 Inbound blog/eventi | [inbound-marketing-blog-eventi.md](./inbound-marketing-blog-eventi.md) |

---
**Tema** `Sixteen` · **Laraxot** · **FixCity Platform** · PHPStan `level: max` (`laravel/phpstan.neon`) · Filament 5
