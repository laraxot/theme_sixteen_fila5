---
id: dcp-03
title: "DCP-03: debito di cascata CSS legacy"
type: story
epic: dc-parity-v2
status: todo
priority: P0
owner: theme:Sixteen
created: 2026-10-13
updated: 2026-10-13
qmd: "design comuni parity dcp-03: debito di cascata css legacy bmad story"
---

# DCP-03: debito di cascata CSS legacy

## Evidenza (2026-10-13)
`app.css` importa decine di file `*-parity.css` aggiunti sessione dopo sessione, molti con `!important`. Per la homepage di test:
`explain-style.mjs` mostra `.card-teaser-block-3 {display:grid!important}` e `display:contents!important` su
`.card-wrapper.card-teaser-wrapper-equal`, `h1,h2,h3 {color:#191919!important}`: battono qualunque regola non-important del blocco.
File coinvolti (import in `app.css`): `homepage-visual-fix`, `homepage-parity-v2`, `homepage-mobile-qa`, `app/04-homepage-components`,
`app/05-homepage-parity-overrides`, `app/16-homepage-civic-reframe`, `homepage-tailwind-parity`, piu' `civic-design-global*`, `topics-parity`.

## Esperimento (reversibile, gia' eseguito e ripristinato)
Disattivando i 7 import specifici della homepage: homepage di test 35,4% -> 52,4%; indice e argomenti invariati (88,1% / 51,1%);
**la home reale `/it` cambia** (altezza 3460 -> 3239 px). Quindi quei file servono anche al sito vero.

## Da fare
1. Inventario: per ogni file legacy, quali pagine/classi lo usano (grep sui blade + screenshot prima/dopo).
2. Isolare i file che servono a `/it` sotto un selettore del suo blocco (`.design-comuni-homepage` o attributo su body), poi scollegarli per le pagine `/tests`.
3. Regola nuova: niente nuovi `*-parity.css`, niente `!important` nuovo; per capire una cascata si usa `explain-style.mjs`, si corregge cancellando la regola sbagliata.
4. Regola di scope: gli stili generati restano sotto `.dc-home` (`resources/css/design-comuni/`).

## Criteri di accettazione
- `explain-style.mjs` su `.evidence-section .card-teaser-wrapper display` non mostra regole legacy `!important`.
- `/it` identica a prima (0,000% pixel diversi sopra soglia 16/255) e indice/argomenti non peggiorano.

## Verifica
```bash
node bashscripts/tools/visual/explain-style.mjs http://192.168.1.40:8000/it/tests/homepage '.evidence-section .card-teaser-wrapper' display
```
