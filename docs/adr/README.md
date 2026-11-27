---
<<<<<<< .merge_file_wzNKwF
title: "ADR del tema Sixteen"
type: index
tags: [adr, decisioni, sixteen, design-comuni]
created: 2026-11-18
updated: 2026-11-24
---

# ADR del tema Sixteen

Il **perche'** delle forme del tema che un agente sarebbe tentato di "semplificare": markup identico a Design Comuni,
nomi degli attributi `data-*`, identita' digitale spenta di default, asset serviti da symlink.

**Quando leggerli:** prima di aggiungere markup, classi o attributi a un componente, di toccare il login SPID/CIE, o di
cambiare come si servono gli asset. Formato (5 sezioni, `type: decision`, `## Verifica`):
[regola del canon](../../../../Modules/Xot/docs/rules/action-behavioral-contract.md).

## Decisioni

- [Parita' HTML con Design Comuni](design-comuni-html-parity.md) — il `<body>` e' quello del riferimento; cambiano solo CSS (Tailwind) e JS (Alpine).
- [Attributi data-* per ruolo](data-attributes-named-by-role.md) — mai `data-sixteen-*`: prima gli agganci del riferimento, poi `data-element`, poi un nome di comportamento.
- [SPID e CIE spenti di default](digital-identity-routes-off-by-default.md) — rotte registrate solo con `sixteen.auth.spid.enabled === true`, dopo l'incidente SEC-02.
- [Asset via symlink public_html/themes](theme-assets-via-public-symlink.md) — il web server serve `Themes/Sixteen/public`; le Action PHP di asset restano senza rotta.

## Decisioni precedenti (formato libero, non ancora ADR)

- [front-office-audit](../bmad/decisions/front-office-audit.md)
=======
title: "Decisioni architetturali — Sixteen"
type: documentation
theme: Sixteen
status: active
---

# Decisioni architetturali — Sixteen

Gli ADR spiegano le scelte difficili da invertire del tema Sixteen:
accessibilità, struttura delle pagine, asset e integrazione con il design
system. L'indice è in [index.md](./index.md).

Ogni ADR deve includere contesto, driver, alternative scartate, decisione,
conseguenze e una conferma verificabile.

## Decisioni

- [0001 — data attributes nominati per ruolo](0001-data-attributes-named-by-role.md)
- [0002 — parità HTML Design Comuni](0002-design-comuni-html-parity.md)
- [0003 — route di identità digitale disattivate di default](0003-digital-identity-routes-off-by-default.md)
- [0004 — asset del tema tramite symlink pubblico](0004-theme-assets-via-public-symlink.md)
>>>>>>> .merge_file_zKjOqr
