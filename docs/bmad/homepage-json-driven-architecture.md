---
title: "Sixteen homepage JSON-driven architecture"
type: architecture
status: active
theme: Sixteen
created: 2026-10-09
updated: 2026-10-09
tags: [bmad, sixteen, homepage, architecture, cms]
issues:
  - "https://github.com/laraxot/base_fixcity_fila5/issues"
discussions:
  - "https://github.com/laraxot/base_fixcity_fila5/discussions"
qmd: "architecture   homepage sixteen json-driven sixteen"
---

# Architecture — Homepage Sixteen JSON-driven

## Aggiornamento visuale 2026-10-09

La composizione è stata ampliata con un blocco JSON hero dedicato
pub_theme::components.blocks.home.hero. La mappa resta di proprietà del blocco
ticket.map-preview e non viene duplicata nel hero. Questa separazione mantiene
il contenuto editoriale nel JSON e il rendering visuale nei componenti Sixteen.

## Runtime flow

1. Folio risolve `/it` sulla route `home`.
2. `Themes/Sixteen/resources/views/pages/index.blade.php` monta il layout e chiama `<x-cms::page side="content" slug="home" />`.
3. `Modules\Cms\View\Components\Page` richiede `Page::getBlocksBySlug('home', 'content')`.
4. `Modules\Cms\Models\Traits\HasBlocks` legge `content_blocks` nella lingua primaria.
5. Ogni blocco è trasformato in `Modules\Cms\Datas\BlockData`.
6. `BlockData` valida `data.view` con `view()->exists()`.
7. `Modules/Cms/resources/views/components/page.blade.php` include la view del blocco con payload espanso.

## Pattern JSON da rispettare

I file locali `tickets.index.json`, `tickets.create.json` e `tickets.confirmation.json` mostrano il pattern reale: ogni blocco ha forma:

```json
{
  "type": "ticket_confirmation",
  "data": {
    "view": "pub_theme::components.blocks.flow.ticket.segnalazione.04-conferma"
  }
}
```

Quindi `home.json` non deve descrivere componenti astratti; deve dichiarare direttamente le view Sixteen da includere.

## Mapping architetturale da `index.blade.php.old`

| Sezione old | Responsabilità | Blocco CMS |
|---|---|---|
| Hero `#head-section` | headline, CTA guest/auth, mappa `map-lit` | `pub_theme::components.blocks.home.hero-map` |
| Come funziona | tre card numerate | `pub_theme::components.blocks.home.how-it-works` |
| Quick actions | tracking pratica | `pub_theme::components.blocks.quick-actions` |

## Perché non usare i blocchi generici attuali

- `hero.main` è una landing Tailwind generica e non replica `#head-section.bg-primary` + mappa.
- `features.grid` usa icone Filament da payload e ha già prodotto errore runtime se l’icona non è valida.
- `stats`, `categories`, `testimonials` non esistono in `index.blade.php.old`.
- `ticket.map-preview` è utile ma non contiene il copy/CTA hero del vecchio layout.

## Ownership

- Sixteen possiede layout, componenti visuali e blocks.
- Cms possiede il rendering dei blocchi e la lettura del record JSON.
- Fixcity possiede endpoint e dati ticket, ad esempio `/api/tickets/geojson`.

## Invarianti

- Un solo record CMS locale con `slug = home`.
- Nessun contenuto editoriale hardcoded nella pagina Folio.
- Nessuna `data.view` inesistente.
- Le sezioni del JSON devono rimanere ordinate come nel vecchio file.
