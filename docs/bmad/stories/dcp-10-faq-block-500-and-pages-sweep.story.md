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
tags: [docs, sixteen, bmad]
---

# DCP-10: 500 del blocco FAQ e sweep delle 37 pagine di riferimento

## Evidenza
- `/it/tests/domande-frequenti` risponde 500: `Cannot use object of type Modules\Cms\Datas\BlockData as array` in
  `components/blocks/faq/default.blade.php` (file modificato e non committato; l'errore e' gia' nel log del 2026-10-12 sera).
- Esiste un runner storico `bashscripts/design-comuni/verify-parity.mjs` (37 pagine, 3 viewport) con `pixelmatch`.

## Causa dei `|---LINE:n---|` (trovata il 2026-10-13 sera)
Li inietta l'**exception renderer di Laravel** (`vendor/laravel/framework/src/Illuminate/Foundation/Exceptions/Renderer/Mappers/BladeMapper.php`): quando una pagina va in errore ricompila le viste con quei marcatori per mappare l'errore alla riga Blade, e **li lascia nella cache delle viste** (`storage/framework/views`). Da quel momento le pagine che condividono la vista (qui `pages/tests/[slug]`) stampano i marcatori nel testo e perfino dentro gli attributi (`data-slug="|---LINE:34---|tests.homepage"`).
Riprodotto: un solo 500 su `/it/tests/domande-frequenti` basta a inquinare homepage, ricerca e appuntamento. Rimedio: `php artisan view:clear` (e `optimize:clear`). Ogni 500 di un agente (blocco FAQ, edit rotta) inquina tutti. Mitigazioni fatte: scope CSS tollerante (`data-slug*="tests."`: con un prefisso in testa lo scope con `^=` crollava la pagina al 34%) e `parity-gate.sh --fail-if-contains '|---LINE:'`. Da fare: correggere il blocco FAQ (cosi' non ci sono 500) e valutare di disattivare il renderer in locale.

## Da fare
1. Correggere il blocco FAQ leggendo `$block->data` come oggetto, non come array; test di rendering del blocco.
2. Eseguire lo sweep con `--stub-images`, salvare la tabella in `bmad-output/parity/sweep-<data>.md` e ordinare le pagine per distanza dal 97%.
3. Generare una story per ogni pagina sotto soglia (stesso metodo di DCP-07), senza creare file Folio.

## Criteri di accettazione
- Nessuna pagina `/it/tests/*` risponde 500; la tabella dello sweep e' versionata; ogni pagina sotto soglia ha una story collegata.
