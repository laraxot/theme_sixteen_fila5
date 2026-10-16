---
title: "Filament Blueprint — Theme Sixteen"
type: filament-blueprint
status: active
theme: Sixteen
created: 2026-10-16
updated: 2026-10-16
tags: [bmad, filament, blueprint, theme, sixteen, folio, x-page]
qmd: "filament blueprint theme sixteen widget mount no resource folio shell"
related:
  - ../bmad-planning.md
  - ../bmad-brainstorming.md
  - ./container0-index-shell-contract.md
  - ./decision-log.md
---

# Scopo

Il tema **Sixteen** non possiede Resource Filament. Compone pagine Folio/Volt e puo
montare widget Filament **dei moduli owner** con props canoniche.

## FO shell (lista container)

`pages/[container0]/index.blade.php` è solo trasporto: Volt + `<x-page>`.
Nessuna Resource, nessun `match` dominio, nessun layout dinamico nel tema.
Contratto: [container0-index-shell-contract.md](./container0-index-shell-contract.md) (D20).

I widget Filament FO (commenti, wizard ticket, ecc.) entrano **solo** se un blocco
JSON CMS li monta — il tema non decide il dominio.

## Consentito

- Mount `@livewire` / widget Filament modulo con props tipizzate (dai blocchi)
- View Blade del tema che passano solo dati gia autorizzati dal modulo
- Stack FO: Tailwind + DaisyUI + Flowbite + Lit + Alpine (no Bootstrap target)

## Vietato

- `Themes/Sixteen/app/Filament/Resources/*`
- Duplicare policy/Actions nel tema
- Nascondere sezioni FO quando il contratto owner dice "sempre montato"
- Logica lista/utility hardcoded nella Folio page al posto del JSON `{slug}.index`

## Widget tipici consumati

- mount widget moduli (CommentsWidget, ecc.) — nessuna Resource nel tema

## Related

- Planning: [bmad-planning.md](../bmad-planning.md)
- Brainstorming: [bmad-brainstorming.md](../bmad-brainstorming.md)
- Shell contract: [container0-index-shell-contract.md](./container0-index-shell-contract.md)
