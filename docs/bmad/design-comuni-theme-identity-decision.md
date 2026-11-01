---
title: "ADR — Sixteen is the DesignComuni theme"
type: bmad-decision
status: accepted
created: 2026-10-11
updated: 2026-10-11
tags: [bmad, second-brain, sixteen, design-comuni, architecture]
qmd: "decisione sixteen"
---

# Decisione

Sixteen è già il tema DesignComuni. Non si crea un layout parallelo chiamato
`design-comuni.blade.php`, né sotto `resources/views/layouts/` né sotto
`components/layouts/`.

## Contratto canonico

```text
pages/Folio o Blade
        ↓
layouts/app.blade.php       ← shell pubblica DesignComuni
        ↓
components/layouts/main.blade.php ← shell HTML, Vite, asset globali
        ↓
components/sections/header + footer
```

La grafica DesignComuni è responsabilità permanente di Sixteen: `app.blade.php`,
sezioni, componenti, CSS Tailwind e token del tema. Un nome layout
`design-comuni` comunicherebbe erroneamente l’esistenza di un secondo tema e
creerebbe divergenza, markup duplicato e routing ambiguo.

## Regole operative

- Le pagine front office usano `layouts/app.blade.php`.
- I test pages usano lo stesso contratto pubblico; non hanno layout propri.
- Il modulo Fixcity possiede dominio, dati e transizioni, non layout.
- I documenti visuali restano in `Themes/Sixteen/docs/`.
- Le evidenze storiche che citano il vecchio file non sono istruzioni runtime:
  vanno interpretate come traccia di migrazione.

## Verifica

Il file errato `resources/views/layouts/design-comuni.blade.php` e il relativo
componente duplicato sono stati rimossi dopo aver verificato che non fossero
usati dal runtime. La fonte attiva resta `resources/views/layouts/app.blade.php`.
