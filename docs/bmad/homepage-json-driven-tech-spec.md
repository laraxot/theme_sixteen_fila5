---
title: "Sixteen homepage JSON-driven tech spec"
type: tech-spec
status: active
theme: Sixteen
created: 2026-10-09
updated: 2026-10-09
tags: [bmad, sixteen, homepage, json, blocks]
issues:
  - "https://github.com/laraxot/base_fixcity_fila5/issues"
discussions:
  - "https://github.com/laraxot/base_fixcity_fila5/discussions"
qmd: "tech spec   homepage json blocks sixteen"
---

# Tech spec — Homepage JSON blocks

## Delta visuale 2026-10-09

Il payload corrente aggiunge il blocco home.hero con view
pub_theme::components.blocks.home.hero prima di ticket.map-preview. Il blocco
hero riceve eyebrow, heading, intro, primary/secondary label e URL, oltre al
 pannello meta. ticket.map-preview riceve eyebrow, heading e intro in aggiunta
 a data_url, report_url, list_url e height.

Gli URL devono usare i mount CMS/Folio già esposti: container0.index per la
lista e container0.view con container0=tickets e slug0=create per la creazione.

## File target

- JSON: `laravel/config/local/fixcity/database/content/pages/home.json`
- pagina Folio: `laravel/Themes/Sixteen/resources/views/pages/index.blade.php`
- blocchi: `laravel/Themes/Sixteen/resources/views/components/blocks/`

## Struttura `home.json`

```json
{
  "id": "home",
  "title": {"it": "...", "en": "..."},
  "slug": "home",
  "content": null,
  "content_blocks": {
    "it": [
      {"type": "home_hero_map", "data": {"view": "pub_theme::components.blocks.home.hero-map"}},
      {"type": "home_how_it_works", "data": {"view": "pub_theme::components.blocks.home.how-it-works"}},
      {"type": "home_quick_actions", "data": {"view": "pub_theme::components.blocks.quick-actions"}}
    ],
    "en": []
  },
  "sidebar_blocks": {"it": [], "en": []},
  "footer_blocks": null
}
```

## Payload blocco hero

Campi richiesti:

- `site_label`
- `title`
- `subtitle`
- `map.data_url`
- `map.height`
- `map.aria_label`
- `map.caption`
- `map.list_label`
- `map.list_url`
- `actions.create.label`
- `actions.create.url`
- `actions.practices.label`
- `actions.practices.url`
- `actions.login.label`
- `actions.login.url`
- `actions.register.label`
- `actions.register.url`

Il blocco può decidere in Blade quale CTA mostrare con `@auth`, come faceva il vecchio file.

## Payload blocco how-it-works

Campi richiesti:

- `title`
- `intro`
- `steps[]` con `number`, `title`, `body`.

## Payload blocco quick-actions

Campi richiesti:

- `heading`
- `body`
- `button.label`
- `button.url`

## View vietate per questa home

- `pub_theme::components.blocks.features.grid` finché usa icone libere da JSON senza normalizzazione;
- `pub_theme::components.blocks.hero.main` perché non replica il vecchio hero Design Comuni;
- `pub_theme::components.blocks.stats.stats`, `categories.grid`, `testimonials.carousel` perché non fanno parte di `index.blade.php.old`.

## Verifiche tecniche

- JSON parse;
- estrazione di tutti i `data.view` e controllo `view()->exists()`;
- navigazione Playwright su `/it`;
- navigazione Puppeteer su `/it`;
- screenshot temporanei solo se necessari e non committati.
