---
title: "Header and footer sections contract"
type: architecture
tags: [bmad, sections, header, footer, json, design-comuni, accessibility]
qmd: "Sixteen x-section header footer JSON contract Design Comuni"
---

# Contratto delle sections header e footer

## Composizione

I layout pubblici chiamano soltanto:

```blade
<x-section slug="header" />
<x-section slug="footer" tpl="full" />
```

`Modules/Cms/View/Components/Section` carica i blocchi localizzati dalla
section CMS e risolve rispettivamente:

```text
pub_theme::components.sections.header.v1
pub_theme::components.sections.footer.full
```

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

Ogni voce di navigazione è un link reale: non si usa `#` come placeholder. I
path relativi sono localizzati dal renderer; gli URL assoluti restano esterni.
Logo e testo sono un unico link istituzionale, mentre il logo è decorativo
quando il nome dell'ente è già adiacente (alt vuoto intenzionale).

La view normalizza i path interni con LaravelLocalization. I link esterni
restano assoluti. Il menu mobile è gestito da Alpine.js, ha target minimi
accessibili e mantiene `aria-expanded`, `aria-controls` e focus visibile.

## Footer: dati e responsabilità

| Chiave JSON | Significato |
|---|---|
| `brand` | identità e descrizione dell'ente |
| `columns[]` | gruppi di link istituzionali |
| `contact` | indirizzo, email, telefono e orari |
| `social[]` | profili esterni con `rel` sicuro |
| `legal_links[]` | privacy, accessibilità, note legali, mappa |
| `copyright` | riga conclusiva |

`columns[]` contiene gruppi omogenei (`title`, `links[]`); `contact` è
opzionale perché il contatto può essere espresso in una colonna. `social[]`
richiede `label` e `url`: le voci senza destinazione non vengono renderizzate.
I link HTTP esterni aprono in nuova scheda con `rel="noopener noreferrer"`.

Il footer usa solo utility Tailwind e semantica HTML (`footer`, `address`,
heading, liste). Non usa classi o runtime Bootstrap Italia e non contiene URL
`#` per contenuti applicativi.

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
