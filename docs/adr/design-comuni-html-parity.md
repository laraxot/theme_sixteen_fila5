---
title: "ADR — Sixteen e' un clone di Design Comuni: l'HTML del body resta uguale al riferimento"
type: decision
status: accepted
theme: Sixteen
created: 2026-11-24
updated: 2026-11-24
related:
  - ../../../../../bashscripts/ai/wiki/rules/013-design-comuni-html-match.md
  - ../body-class-rule.md
  - ../data-attribute-rule.md
  - data-attributes-named-by-role.md
---

# ADR: l'HTML dentro `<body>` e' quello di Design Comuni, cambiano solo CSS e JS

## Contesto

- Sixteen e' il tema per siti di enti pubblici italiani. Il modello AgID per i siti dei Comuni e' il kit
  [Design Comuni](https://italia.github.io/design-comuni-pagine-statiche/sito/): le verifiche di conformita' (checklist,
  `data-element` letti dagli strumenti di monitoraggio) si basano su quel markup.
- La copia locale del riferimento sta in `Themes/Sixteen/Main_files/five/` (`index.html`, `accesso-servizio.html`,
  `segnalazione-01-privacy.html`, `segnalazione-02-dati.html`, `assets/`).
- Il tema non usa Bootstrap Italia JS ne' il suo CSS: Tailwind v4 in `resources/css/app.css` e Alpine/Livewire
  (`docs/NO_BOOTSTRAP_ITALIA.md`).
- Domanda: quando il markup "di comodo" diverge dal riferimento (una classe in piu', un wrapper, un attributo proprio),
  si accetta la differenza o si adatta il CSS?

## Decisione

- L'HTML dentro `<body>` (esclusi gli `<script>`) di ogni pagina del front office e' **uguale** a quello della pagina
  corrispondente del riferimento: stessi tag, classi, `id`, attributi, `data-element`. Regola globale:
  `bashscripts/ai/wiki/rules/013-design-comuni-html-match.md` (CRITICAL).
- Si sostituiscono solo: CSS (classi del riferimento ristilizzate in Tailwind) e JS (comportamento `data-bs-*` reso da
  Alpine/runtime del tema, `resources/js/theme/header-mobile-nav.js`).
- Le varianti di sezione si scelgono dai JSON di contenuto del tenant (`"view": "pub_theme::components.sections.header.v1"`
  in `sections/header.json`): il renderer canonico (`components/sections/header/v1.blade.php`,
  `components/sections/footer/v1.blade.php`) e' quello allineato al riferimento.
- Regole figlie: [body-class-rule](../body-class-rule.md) (nessuna classe propria sul `<body>`) e
  [attributi `data-*`](data-attributes-named-by-role.md).

## Alternative scartate

- **Markup proprio "semantico" con il solo aspetto di Design Comuni**: sembra uguale a occhio ma perde i `data-element` e
  la struttura che i controlli AgID leggono; ogni differenza va rispiegata a ogni audit.
- **Bootstrap Italia completo (CSS + JS)**: parita' gratuita, ma due sistemi di stile e il JS di Bootstrap accanto a
  Livewire/Alpine; scelta respinta in `docs/NO_BOOTSTRAP_ITALIA.md`.
- **Parita' solo visiva (screenshot)**: tollera markup diverso con resa uguale, quindi non protegge accessibilita' e
  `data-element`.

## Conseguenze

- Pro: confronto meccanico con il riferimento (diff del body), conformita' AgID leggibile dal markup.
- Contro: il CSS deve ricreare in Tailwind classi Bootstrap (`it-header-wrapper`, `navbar-collapsable`, …); niente
  scorciatoie di markup per comodita' del componente.
- Debito: restano varianti legacy di header non allineate (elencate in `../data-attribute-rule.md`); lo script di confronto
  `bashscripts/html/html-structure-compare.sh` citato dai docs non esiste piu' nel repo: il confronto oggi e' manuale
  (`curl` + `diff`, rule 013).

## Verifica

- `Themes/Sixteen/tests/Feature/Components/FooterV1DesignComuniStructureTest.php`: la struttura del footer
  (`it-footer > it-footer-main > it-footer-small-prints`) e' quella del riferimento (richiede il boot dell'app).
- `Themes/Sixteen/tests/Unit/DataAttributeParityContractTest.php`: nessun `data-*` col nome del tema (sorgente, senza app).
- Il resto e' solo revisione: diff del `<body>` della pagina servita contro la pagina del riferimento (rule 013, passi 1-3).
