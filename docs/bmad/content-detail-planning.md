---
title: "BMAD Planning — dettaglio contenuti Blog/Eventi"
type: bmad-planning
status: maintenance
module: Sixteen
created: 2026-10-16
tags: [bmad, planning, blog, events, design-comuni]
related: [./ticket-detail-planning.md, ../../../Modules/Blog/docs/bmad/blog-detail-planning.md]
updated: 2026-10-17
qmd: "contratto tema sixteen"
---

# Contratto tema

Il tema rende i blocchi `blog/detail` ed `events/detail`, mantenendo il
contenuto editoriale visibile anche quando `closed_at` è nullo. Header e footer
sono JSON SSOT e devono offrire collegamenti a Novità/Blog ed Eventi in tutte le
lingue. Il tema non decide moderazione, privacy o stato ticket.

## Gate di composizione

- JSON valido e localizzato;
- un solo header e un solo footer;
- body prima dei commenti;
- link interni localizzati;
- nessun riferimento a componenti Blade inesistenti;
- dettaglio Blog/Eventi e ticket condividono chrome, non dominio.

