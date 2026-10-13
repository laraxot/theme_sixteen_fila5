---
id: dcp-00
title: "Epic: parity Design Comuni v2, pagine guidate da JSON"
type: story
epic: dc-parity-v2
status: in-progress
priority: P0
owner: theme:Sixteen
created: 2026-10-13
updated: 2026-10-13
qmd: "design comuni parity epic: parity design comuni v2, pagine guidate da json bmad story"
---

# Epic: parity Design Comuni v2, pagine guidate da JSON

## Obiettivo
Le pagine `/it/tests/*` devono raggiungere almeno 90% di HTML parity (body, script esclusi) e 97% di visual parity
(375, 768, 1440 px) rispetto a `https://italia.github.io/design-comuni-pagine-statiche/sito/<pagina>.html`, **passando dal contratto del tema**:
Folio generico `[slug]` -> `<x-page>` -> blocchi/sezioni Blade -> JSON `tests.<slug>.json`, stile in `app.css`,
interattivita' con Alpine in `app.js`. Stack: TailwindCSS + Alpine + Lit + DaisyUI + Flowbite, mai Bootstrap Italia a runtime.

## Stato a fine giornata 2026-10-13 (misurato, non dichiarato)
| Pagina | HTML body | Visual 1440 / 768 / 375 | Note |
|---|---:|---:|---|
| `/it/tests/homepage` | 61,2% (solo `<main>`: 93,2%) | 35,4% / n.m. / 38,8% | blocco da JSON fatto; bloccata da CSS legacy `!important` e da header/footer/modal non Design Comuni |
| `/it/tests/risultati-ricerca` | 13,2% (2214 token riferimento, 580 locali) | 34,0% / 26,4% / 24,3% | era HTTP 500 (slug duplicato), ora 200 |
| `/it/tests/domande-frequenti` | n.m. | n.m. | HTTP 500 in `blocks/faq/default.blade.php` |
| `/it/tests/` (indice) | n.m. | 88,1% (1440) | riferimento per regressioni |
| `/it/tests/argomenti` | n.m. | 51,1% (1440) | riferimento per regressioni |

`n.m.` = non misurato oggi. La replica che aveva dato 100% era fuori contratto (pagina Folio dedicata, testo nelle viste,
CSS/JS di Bootstrap Italia) ed e' stata rimossa: il suo numero non vale come risultato.

## Percorso critico per domani
1. DCP-12 e DCP-09: protocollo di proprieta' dei file e guardia sui JSON (rapide, sbloccano il resto senza conflitti).
2. DCP-03: debito di cascata CSS legacy (esperimento gia' fatto: senza 7 import legacy la homepage passa da 35,4% a 52,4%, ma cambia `/it`).
3. DCP-04: homepage `<main>` a 97%.
4. DCP-05 e DCP-06: header, footer, modale di ricerca (circa 43% dei token del body: senza di loro il 90% HTML e' impossibile).
5. DCP-07: risultati-ricerca. DCP-10: sweep delle pagine e 500 delle FAQ.
6. DCP-01 (gate unico), DCP-08, DCP-11, DCP-13 in parallelo.

## Storie
- [DCP-01 gate e definizione di fatto](2026-10-13-dcp-01-parity-gate-definition-of-done.story.md)
- [DCP-02 contratto "le pagine sono dato"](2026-10-13-dcp-02-tests-pages-are-data-contract.story.md)
- [DCP-03 debito CSS legacy](2026-10-13-dcp-03-legacy-parity-css-cascade-debt.story.md)
- [DCP-04 homepage main 97%](2026-10-13-dcp-04-homepage-main-block-97.story.md)
- [DCP-05 header](2026-10-13-dcp-05-header-section-design-comuni.story.md)
- [DCP-06 footer e modale](2026-10-13-dcp-06-footer-and-search-modal-sections.story.md)
- [DCP-07 risultati-ricerca](2026-10-13-dcp-07-risultati-ricerca-90-97.story.md)
- [DCP-08 asset e font](2026-10-13-dcp-08-asset-integrity-and-fonts.story.md)
- [DCP-09 guardia JSON](2026-10-13-dcp-09-json-content-integrity-guard.story.md)
- [DCP-10 sweep e FAQ](2026-10-13-dcp-10-faq-block-500-and-pages-sweep.story.md)
- [DCP-11 MCP e second brain](2026-10-13-dcp-11-mcp-repair-and-second-brain.story.md)
- [DCP-12 protocollo multi-agente](2026-10-13-dcp-12-multi-agent-ownership-protocol.story.md)
- [DCP-13 correzione documenti e dossier difetti](2026-10-13-dcp-13-docs-correction-and-defect-dossier.story.md)

## Analisi delle cause e guardrail
[Decisione 2026-10-13: perche' non ho completato e cosa cambia](../decisions/2026-10-13-parity-root-cause-and-guardrails.md).
Collegata a: [homepage-visual-parity-97](homepage-visual-parity-97.story.md), [risultati-ricerca-visual-parity-97](risultati-ricerca-visual-parity-97.story.md),
[homepage-json-driven-restructure](homepage-json-driven-restructure.story.md) (restano valide, non cancellate).
