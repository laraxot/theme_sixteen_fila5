---
title: "DesignComuni information architecture — Sixteen presentation contract"
type: bmad-ux
status: active
created: 2026-10-11
updated: 2026-10-11
tags: [bmad, ux, design-comuni, sixteen, information-architecture]
qmd: "contratto di presentazione sixteen"
---

# Contratto di presentazione

Sixteen non definisce l’ontologia del dominio: la riceve da Fixcity/CMS. Deve
però rendere riconoscibili le tipologie del modello comunale ODS v2.0.

| Contract | Presentazione Sixteen |
| --- | --- |
| Servizio | card/landing con obiettivo, destinatari, requisiti e CTA |
| Pratica / segnalazione | wizard progressivo, stato, riepilogo, conferma e tracking |
| Punto di contatto | blocco contatti con canali e orari accessibili |
| Luogo | mappa + indirizzo testuale + alternativa senza mappa |
| Messaggio | alert/aggiornamento con `aria-live` e linguaggio chiaro |
| Documento pubblico | link istituzionale, data/versione e download accessibile |

Il tema usa esclusivamente TailwindCSS, Alpine.js, Lit, DaisyUI, Flowbite e
Filament. Il modello ODS guida contenuti e gerarchia; non autorizza l’inclusione
di Bootstrap Italia nel runtime.

Fonte dominio: [contratto Fixcity](../../../../Modules/Fixcity/docs/bmad/design-comuni-information-architecture.md).
Fonte visuale: [Sixteen design system](../design-system/MASTER.md).
