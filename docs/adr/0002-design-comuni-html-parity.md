---
title: "ADR — Sixteen e' un clone di Design Comuni: l'HTML del body resta uguale al riferimento"
type: decision
status: accepted
theme: Sixteen
created: 2026-11-24
updated: 2026-11-26
decision-makers: [team front office]
related:
  - ../body-class-rule.md
  - ../data-attribute-rule.md
  - 0001-data-attributes-named-by-role.md
---

# ADR: l'HTML dentro `<body>` e' quello di Design Comuni, cambiano solo CSS e JS

## Contesto

Sixteen è il tema per siti di enti pubblici italiani. Il modello AgID per i siti dei Comuni è il kit
[Design Comuni](https://italia.github.io/design-comuni-pagine-statiche/sito/): le verifiche di conformità (checklist,
`data-element` letti dagli strumenti di monitoraggio) si basano su quel markup. La copia locale del riferimento sta in
`Themes/Sixteen/Main_files/five/` (`index.html`, `accesso-servizio.html`, `segnalazione-01-privacy.html`,
`segnalazione-02-dati.html`, `assets/`). Il tema non usa Bootstrap Italia JS né il suo CSS: Tailwind v4 in
`resources/css/app.css` e Alpine/Livewire (`docs/NO_BOOTSTRAP_ITALIA.md`). Quando il markup «di comodo» diverge dal
riferimento (una classe in più, un wrapper, un attributo proprio), si accetta la differenza o si adatta il CSS?

## Driver della decisione

- La conformità deve essere leggibile dal markup e confrontabile in modo meccanico (diff del `<body>` della pagina servita
  contro la pagina del riferimento), non solo a occhio.
- Un solo sistema di stile: Tailwind per il CSS e Alpine/Livewire per il comportamento, senza il JS di Bootstrap accanto
  (`docs/NO_BOOTSTRAP_ITALIA.md`).
- Le varianti di sezione si scelgono dai JSON del tenant, ma il renderer canonico di ogni sezione è uno solo e resta
  allineato al riferimento (`components/sections/header/v1.blade.php`, `components/sections/footer/v1.blade.php`).
- Ogni differenza dal riferimento va rispiegata a ogni audit: meglio non produrne.

## Alternative scartate

- **Markup proprio «semantico» con il solo aspetto di Design Comuni**: sembra uguale a occhio ma perde i `data-element` e
  la struttura che i controlli AgID leggono; ogni differenza va rispiegata a ogni audit.
- **Bootstrap Italia completo (CSS + JS)**: parità gratuita, ma due sistemi di stile e il JS di Bootstrap accanto a
  Livewire/Alpine; scelta respinta in `docs/NO_BOOTSTRAP_ITALIA.md`.
- **Parità solo visiva (screenshot)**: tollera markup diverso con resa uguale, quindi non protegge accessibilità e
  `data-element`.

## Decisione

- L'HTML dentro `<body>` (esclusi gli `<script>`) di ogni pagina del front office è **uguale** a quello della pagina
  corrispondente del riferimento: stessi tag, classi, `id`, attributi, `data-element`.
- Si sostituiscono solo: CSS (classi del riferimento ristilizzate in Tailwind) e JS (comportamento `data-bs-*` reso da
  Alpine/runtime del tema, `resources/js/theme/header-mobile-nav.js`).
- Le varianti di sezione si scelgono dai JSON di contenuto del tenant (`"view": "pub_theme::components.sections.header.v1"`
  in `config/local/fixcity/database/content/sections/header.json:16`): il renderer canonico è quello allineato al riferimento.
- Regole figlie: [body-class-rule](../body-class-rule.md) (nessuna classe propria sul `<body>`) e
  [attributi `data-*`](0001-data-attributes-named-by-role.md).

## Conseguenze

- Buono: confronto meccanico con il riferimento, conformità AgID leggibile dal markup.
- Cattivo: il CSS deve ricreare in Tailwind classi Bootstrap (`it-header-wrapper`, `navbar-collapsable`, ...); niente
  scorciatoie di markup per comodità del componente.
- Debito: restano varianti legacy di header non allineate (elencate in `../data-attribute-rule.md`); lo script di confronto
  `bashscripts/html/html-structure-compare.sh`, citato dai docs, non esiste nell'albero: il confronto oggi è manuale
  (`curl` + `diff`).

## Stato attuale

- La regola globale «013-design-comuni-html-match» (CRITICAL), citata da questo ADR nella versione del 2026-11-24 e da
  `docs/data-attribute-rule.md`, non è presente in questo checkout: `find . -name '013-design*'` dalla radice del repo non trova
  nulla (`bashscripts/` è un repository a parte). Il contenuto della regola vale quindi qui solo come riportato nella sezione
  Decisione.
- Il test sul footer (sotto) richiede il boot dell'app (`uses(TestCase::class)` con `Tests\TestCase`, riga 12 del file); non
  eseguito in questa passata.

## Conferma

- `cd laravel && vendor/bin/pest Themes/Sixteen/tests/Feature/Components/FooterV1DesignComuniStructureTest.php`: la struttura
  del footer (`it-footer > it-footer-main > it-footer-small-prints`) è quella del riferimento (richiede il boot dell'app).
- `cd laravel && vendor/bin/pest Themes/Sixteen/tests/Unit/DataAttributeParityContractTest.php`: nessun `data-*` col nome del
  tema (sorgente, senza app).
- Il resto è solo revisione: diff del `<body>` della pagina servita contro la pagina corrispondente in
  `Themes/Sixteen/Main_files/five/`. Nessuna conferma automatica oggi per header, pagine del wizard e blocchi; proposta: un
  test sorgente che confronti la sequenza di tag e `data-element` di `sections/header/v1.blade.php` con `Main_files/five/index.html`.
