---
title: "BMAD Brainstorm — accesso-servizio"
type: note
status: draft
updated: 2026-10-13
tags: [docs, sixteen, bmad]
qmd: "bmad brainstorm   accesso-servizio sixteen"
---
# BMAD Brainstorm — accesso-servizio

## Obiettivo

Replicare la pagina Design Comuni `servizi/accesso-servizio.html` nel tema Sixteen tramite la pagina Folio generica e blocchi CMS JSON-driven.

## 5 Whys

1. Il body era vuoto perché la route cercava `tests.accesso-servizio`, mentre il JSON esponeva solo `accesso-servizio`.
2. Il blocco non poteva essere risolto perché il namespace puntava a una directory `default` inesistente.
3. I blocchi esistenti usavano classi Bootstrap-like e uno sprite non necessario per la pagina.
4. Le responsabilità di layout e contenuto non erano esplicite nel JSON.
5. La verifica precedente controllava HTTP ma non anche DOM, asset, overflow e screenshot ai tre breakpoint.

## Decisioni convergenti

- Il file JSON è la fonte dei contenuti; la route resta `tests/[slug].blade.php`.
- Ogni view dichiarata nel JSON deve esistere esattamente nel namespace `pub_theme::components.blocks.*`.
- I blocchi della pagina sono: breadcrumb, hero, access-method-card, contacts, search-form, suggestions.
- Le icone del blocco accesso sono asset SVG locali; niente CDN o runtime Bootstrap Italia.
- La verifica minima ricorrente è Playwright a 375/768/1440 con HTTP, console, asset, overflow e screenshot.

## Rischi e controlli

| Rischio | Controllo |
|---|---|
| Slug JSON divergente dalla route | assert `Page::findUniqueBySlug('tests.accesso-servizio')` e controllo H1 |
| view dichiarata ma assente | `view()->exists`/richiesta HTTP |
| layout rotto su mobile | `scrollWidth === innerWidth` a 375 px |
| contrasto o focus insufficiente | audit WCAG e focus keyboard sui link/form |
| regressione di altre pagine | selettori CSS con `data-slug="tests.accesso-servizio"` |

## Non obiettivi

Non si crea una Blade page-specific, non si replica l'intera shell header/footer in questa story e non si dichiara una percentuale di parity senza misurazione ripetibile.
