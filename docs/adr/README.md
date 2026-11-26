---
title: "ADR del tema Sixteen"
type: index
tags: [adr, decisioni, sixteen, design-comuni]
created: 2026-11-18
updated: 2026-11-26
---

# ADR del tema Sixteen

Il **perche'** delle forme del tema che un agente sarebbe tentato di "semplificare": markup identico a Design Comuni,
nomi degli attributi `data-*`, identita' digitale spenta di default, asset serviti da symlink.

**Quando leggerli:** prima di aggiungere markup, classi o attributi a un componente, di toccare il login SPID/CIE, o di
cambiare come si servono gli asset. Formato substantive (Contesto, Driver, Alternative, Decisione, Conseguenze, Conferma):
[regola del canon](../../../../Modules/Xot/docs/rules/action-behavioral-contract.md).

## Decisioni

- [Parita' HTML con Design Comuni](design-comuni-html-parity.md) — il `<body>` e' quello del riferimento; cambiano solo CSS/JS (**substantive**).
- [Attributi data-* per ruolo](data-attributes-named-by-role.md) — mai `data-sixteen-*`: prima gli agganci del riferimento, poi `data-element`, poi un nome di comportamento.
- [SPID e CIE spenti di default](digital-identity-routes-off-by-default.md) — rotte registrate solo con `sixteen.auth.spid.enabled === true`, dopo l'incidente SEC-02.
- [Asset via symlink public_html/themes](theme-assets-via-public-symlink.md) — il web server serve `Themes/Sixteen/public`; le Action PHP di asset restano senza rotta.

## Decisioni precedenti (formato libero, non ancora ADR)

- [front-office-audit](../bmad/decisions/front-office-audit.md)
