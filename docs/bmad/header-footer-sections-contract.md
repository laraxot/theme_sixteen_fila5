---
title: "Header and footer sections contract"
type: architecture
tags: [bmad, sections, header, footer, json, design-comuni, accessibility]
qmd: "Sixteen x-section header footer JSON contract Design Comuni"
status: draft
updated: 2026-10-15
---

# Contratto delle sections header e footer

## Composizione

La shell canonica delle pagine reali è `components/layouts/app.blade.php`.
`components/layouts/design-comuni.blade.php` non esiste: il valore CMS storico
`design-comuni` viene risolto in `app`, senza trasformarsi in un nome di view.
Le shell di `/tests/*` sono un'eccezione di
parità e non definiscono il runtime del front office.

I layout FO Design Comuni chiamano:

```blade
<x-section slug="header" tpl="v1" />
<x-section slug="footer" tpl="v1" />
```

(`layouts/app.blade.php` puo' usare footer `tpl="full"` → `footer/v1`.)

`Modules/Cms/View/Components/Section` carica i blocchi localizzati dalla
section CMS e risolve rispettivamente:

```text
pub_theme::components.sections.header.{tpl}
pub_theme::components.sections.footer.{tpl}
```

`v1` è l'entrypoint canonico del tema Sixteen per l'header Design Comuni e
delega al renderer Tailwind. `header/design-comuni.blade.php` non è un
entrypoint runtime e non va ricreato.

Lo stesso principio vale per il footer: `footer/v1.blade.php` è l'unico
renderer canonico. Un vecchio `tpl="design-comuni"` va migrato a `v1`, non
supportato con una seconda view.

Le view ricevono `blocks`; il primo blocco attivo contiene `data` e il campo
`view` resta un riferimento verificabile al renderer del tema. `header.v1` e
`footer.v1` devono conservare questi blocchi: ricostruire un blocco vuoto dai
props del componente farebbe perdere il contenuto JSON quando si usa
`<x-section>`.

## Header: dati e responsabilità

| Chiave JSON | Significato |
|---|---|
| `brand.name` | nome dell'ente |
| `brand.tagline` | slogan breve |
| `brand.logo` | asset relativo alla public del tema |
| `region.name`, `region.url` | collegamento istituzionale superiore |
| `utility_links[]` | link di servizio nella top bar |
| `account.label`, `account.url` | accesso all'area personale |
| `navigation[]` | menu principale con `label` e `url` |

Obbligo inbound (2026-10-15, Design Comuni): in tutte le locali devono
comparire **Novità** → `/blog` e **Eventi** → `/events` (etichette civiche,
path tecnici). Stesse voci in footer colonna Informazioni + `groups.news` /
`groups.living`. Studio:
[design-comuni-static-pages-study.md](../../../../Modules/Fixcity/docs/bmad/design-comuni-static-pages-study.md).

Ogni voce di navigazione è un link reale: non si usa `#` come placeholder. I
path relativi sono localizzati dal renderer; gli URL assoluti restano esterni.
Logo e testo sono un unico link istituzionale, mentre il logo è decorativo
quando il nome dell'ente è già adiacente (alt vuoto intenzionale).

## Marchio header = footer (obbligatorio)

`brand.logo` deve essere **identico** in `header.json` e `footer.json` (guard
Pest). Il rendering è un solo partial
`components/sections/partials/brand-mark.blade.php` (SVG + `xlink:href` +
invert bianco su fondo scuro/verde). Vietato:

- `<img class="icon">` solo nel footer (size/filtro diversi dall'header)
- sprite `it-pa` al posto del marchio (hamburger / footer)
- `logo-comune.svg` generico se il tenant ha `assets/fixcity/svg/logo.svg`

Size canoniche: header/footer **82×82**, hamburger **48×48**.

La view normalizza i path interni con LaravelLocalization. I link esterni
restano assoluti. Il menu mobile è gestito da Alpine.js, ha target minimi
accessibili e mantiene `aria-expanded`, `aria-controls` e focus visibile.

## Footer: dati e responsabilità (DCP-222)

| Chiave JSON | Significato |
|---|---|
| `brand.name` / `brand.description` | FixCity + slogan prodotto |
| `columns[]` / `groups.*` | link reali servizio (tickets, FAQ, …) |
| `contact` | solo se ente fornisce dati (D198-1); altrimenti vuoto |
| `social[]` | vuoto finché l'ente non dà account (D198-5) |
| `legal_links[]` / `footer_bottom_links[]` | privacy, accessibilità, cookie, mappa |
| `eu_logo.src` | vuoto finché non c'è prova PNRR (D198-4) |
| `copyright` | riga conclusiva |

Regola A5: URL vuoto/`#` → la voce **non** viene emessa come `<a>` (niente
link morti che sembrano cliccabili). Path interni → `FrontofficeUrl`.
Guard: `FooterJsonBrandAndLinksSsotTest`.

## Fonte dei dati

Per il tenant FixCity la fonte è:

```text
config/local/fixcity/database/content/sections/header.json
config/local/fixcity/database/content/sections/footer.json
```

Il tema fornisce il renderer; il tenant fornisce contenuto e collegamenti.
Non copiare questo JSON dentro Blade e non introdurre un secondo namespace
Design Comuni.

## Gate di verifica

- `php artisan view:cache` senza errori;
- header e footer presenti su una pagina `x-layouts.app` e una `x-layouts.test`;
- nessun errore console e nessun overflow a 375/768/1440 px;
- menu lingua e menu mobile tastierabili;
- link interni localizzati;
- contrasto testo/focus verificato WCAG 2.1 AA;
- screenshot desktop/mobile archiviato in `docs/visual-parity/`;
- decisioni e differenze annotate in BMAD decision log.

## Flusso dati verificabile

```text
sections/header.json  -> SectionModel::getBlocksBySlug('header')
                      -> Section -> components.sections.header.v1
                      -> header/tailwind.blade.php -> HTML

sections/footer.json  -> SectionModel::getBlocksBySlug('footer')
                      -> Section -> components.sections.footer.full
                      -> footer/v1.blade.php -> HTML
```

`v1` è il bridge compatibile con il rendering diretto dei test; il renderer
Tailwind è l'unica resa del tema. Non introdurre una seconda view
`design-comuni` o un layout alternativo.
