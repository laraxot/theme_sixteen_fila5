---
title: "CSS SCOPING RULE"
type: note
tags: [documentation]
created: 2026-09-26
updated: 2026-09-26
qmd: "CSS SCOPING RULE"
issues: []
discussions: []
status: draft
---

# CSS Scoping Rule

Related:
- [HTML parity body policy](../html-parity-body-policy.md)
- [Page routing architecture](./page-routing-architecture.md)
- [Theme docs index](../00-INDEX.md)
- [Fixcity parity rule](../../../../Modules/Fixcity/docs/html-body-parity-rule.md)
- [Agent parity rule](../../../../bashscripts/ai/.agents/docs/rules/html-parity.md)

## Componenti, non pagine

`main[data-page="domande-frequenti"]` è sbagliato. Il riferimento
[design-comuni-pagine-statiche](https://github.com/italia/design-comuni-pagine-statiche)
veste `.cmp-input-search`, `.cmp-accordion`, `.cmp-rating`, `.cmp-contacts`
una volta, su ogni pagina. Il nome della pagina non è uno scope: copiare
la stessa regola per FAQ, novità ed eventi ingrandisce il CSS e lo fa divergere.

Bootstrap Italia resta solo il riferimento tipografico. Non si carica il suo CSS.
Lo stack che dipinge quei componenti è Tailwind, Alpine, Lit, DaisyUI, Flowbite.
Lo scope unico è `.page-content[data-dc]`, il perimetro Design Comuni, non `data-page`.

`data-page` può restare sul `<main>` per i test. Non si scrive nei selettori.

### Piano

1. Fatto: il blocco FAQ in `06-page-cards-and-listing.css` è tolto. `20-dc-components.css` veste i componenti condivisi della pagina di contenuto (`.cmp-input-search`, `.cmp-accordion`, `.cmp-rating`, `.cmp-contacts`, `.bg-primary`, `.bg-grey-card`). Nessuna classe di pagina.
2. Da fare, stesso gesto: `blog/index`, `events-page` e i file che ancora contengono `main[data-page=` (`07`, `08`, `topics-parity`, `argomenti-parity`). La registrazione non usa più `main[data-page="auth-register"]`.
3. Parere e contatti sono i partial `dc-rating` e `dc-contacts`, gli stessi di ogni pagina di contenuto. Il foglio li veste una volta. La griglia Bootstrap nel markup va sostituita quando si tocca il partial, non con un selettore di pagina.

## Rule

Per parity con Design Comuni:

1. Il tag `<body>` resta sempre plain.
2. Non si usano classi o wrapper pagina-specifici inventati.
3. Lo scoping CSS/JS deve partire dal wrapper canonico del progetto:
   `div.page-content[data-slug="..."][data-side="content"]`.
4. `tests-view-wrapper` non e un hook valido di parity: e un dettaglio infrastrutturale Volt/Livewire, instabile e non presente nel reference HTML.
5. Se nel DOM compaiono marker anomali tipo `|---LINE:37---|`, prima pulire le cache con `php laravel/artisan view:clear` e `php laravel/artisan optimize:clear`, poi rivalutare il markup.
6. Per ridurre token e churn, partire da hook runtime reali (`data-slug`, wrapper del widget, classi Filament del wizard) e da screenshot mirati mobile/tablet prima di leggere documentazione ampia.

## Correct pattern

```blade
<div class="page-content content" data-slug="{{ $pageSlug }}" data-side="content">
    @foreach($blocks as $block)
        @include($block->view, array_merge($data, ['data' => $block->data]))
    @endforeach
</div>
```

```css
.page-content[data-slug="tests.segnalazione-02-dati"] .steppers-header {
  /* page-specific parity rules */
}
```

## Wrong pattern

```html
<body class="page-tests-segnalazione-02-dati">
```

```blade
<div class="tests-view-wrapper">
```

```css
.tests-view-wrapper .steppers-header {
  /* coupled to runtime wrapper */
}
```

## Why

- `page-content[data-slug]` e semantico, stabile e gia usato nel Cms.
- `tests-view-wrapper` compare per esigenze di rendering runtime, non di dominio.
- La parity si misura contro il DOM di riferimento, non contro wrapper tecnici interni.
- Il wrapper canonico risolve anche il vincolo Livewire del singolo root element senza introdurre hook sbagliati.

## Enforcement

- Se una pagina test non ha `page-content[data-slug]`, va aggiunto il wrapper canonico.
- Se un CSS usa `tests-view-wrapper`, va migrato.
- Se una doc propone `tests-view-wrapper`, va corretta.

See also:
- [HTML parity body policy](../html-parity-body-policy.md)
- [Page routing architecture](./page-routing-architecture.md)
- [Theme docs index](../00-INDEX.md)


## Nota Design Comuni /tests (2026-10-13)
Per le pagine con chrome Design Comuni (`pages/tests/*` e le pagine reali con JSON `layout` design-comuni*) lo scope degli stili generati e' `body:has(.page-content[data-dc])`: il `<body>` resta plain e lo scope dipende dal wrapper `data-dc` (DCP-32, decision-log D16); fino al 2026-10-13 era `.page-content[data-slug*="tests."]`. Il wrapper
canonico e' `div.page-content` (con `data-slug` e `data-dc`). Header, footer, modale di ricerca e skiplink stanno fuori da `page-content` ma dentro lo stesso body, quindi sono coperti dallo stesso scope
(provato con scope solo su `<main>`: footer 76,6% contro 100%). Shell: `components/layouts/app.blade.php`. Dettagli: `docs/bmad/decisions/parity-root-cause-and-guardrails.md`.
