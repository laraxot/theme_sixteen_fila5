---
title: "FreeLLMAPI boundary — Sixteen theme"
type: bmad-decision
status: active
created: 2026-10-11
updated: 2026-10-11
tags: [bmad, sixteen, freellmapi, design-comuni, second-brain]
qmd: "boundary del tema sixteen"
---

# Boundary del tema

FreeLLMAPI non appartiene al runtime visuale Sixteen. Il tema continua a usare
TailwindCSS + Alpine.js + Lit + DaisyUI + Flowbite + Filament e resta privo di
Bootstrap/Bootstrap Italia nel front office.

Il tema può usare output anonimi del tooling per migliorare docs, audit e test,
ma non deve:

- chiamare `127.0.0.1:3001` dal browser;
- includere chiavi o prompt con dati cittadini;
- spostare le regole visuali fuori da `Themes/Sixteen/docs/`.

La verifica condivisa resta in `bashscripts/tools/visual/`; il contratto visuale
resta in `docs/design-system/`.
