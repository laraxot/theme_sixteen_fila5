---
id: dcp-10
title: "DCP-10: 500 del blocco FAQ e sweep delle 37 pagine di riferimento"
type: story
epic: dc-parity-v2
status: todo
priority: P1
owner: theme:Sixteen
created: 2026-10-13
updated: 2026-10-13
qmd: "design comuni parity dcp-10: 500 del blocco faq e sweep delle 37 pagine di riferimento bmad story"
---

# DCP-10: 500 del blocco FAQ e sweep delle 37 pagine di riferimento

## Evidenza
- `/it/tests/domande-frequenti` risponde 500: `Cannot use object of type Modules\Cms\Datas\BlockData as array` in
  `components/blocks/faq/default.blade.php` (file modificato e non committato; l'errore e' gia' nel log del 2026-10-12 sera).
- Esiste un runner storico `bashscripts/design-comuni/verify-parity.mjs` (37 pagine, 3 viewport) con `pixelmatch`.

## Da fare
1. Correggere il blocco FAQ leggendo `$block->data` come oggetto, non come array; test di rendering del blocco.
2. Eseguire lo sweep con `--stub-images`, salvare la tabella in `bmad-output/parity/sweep-<data>.md` e ordinare le pagine per distanza dal 97%.
3. Generare una story per ogni pagina sotto soglia (stesso metodo di DCP-07), senza creare file Folio.

## Criteri di accettazione
- Nessuna pagina `/it/tests/*` risponde 500; la tabella dello sweep e' versionata; ogni pagina sotto soglia ha una story collegata.
