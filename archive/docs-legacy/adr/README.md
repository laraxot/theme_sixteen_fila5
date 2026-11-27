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
cambiare come si servono gli asset. Regola del canon:
[action-behavioral-contract](../../../../Modules/Xot/docs/rules/action-behavioral-contract.md).

## Formato

Un file per decisione, nome `NNNN-argomento.md` (numero progressivo a quattro cifre, richiesto da
`Modules/Xot/tests/Unit/Docs/AdrFilenamesAreNumberedTest.php`; la data sta nel frontmatter, mai nel nome). Il modello e'
`0000-template.md`. Frontmatter: `title`, `type: decision`, `status` (`accepted` | `superseded` | `deprecated`, con
`superseded_by` se sostituito), `created`, `updated`, `theme`, `decision-makers`. Sei sezioni `##`, in quest'ordine:

```markdown
## Contesto                 fatti e vincoli, con file e riga
## Driver della decisione   le forze che pesano sulla scelta
## Alternative scartate     ogni alternativa seria, col motivo
## Decisione                cosa si fa e dove sta nel codice
## Conseguenze              pro, contro, debito
## Conferma                 un test esistente, un comando da `laravel/` o una regola di revisione
```

Se il codice contraddice l'ADR si aggiunge `## Stato attuale` con le prove (file e riga). Se la **Conferma** non e'
automatica si scrive «Nessuna conferma automatica oggi; proposta: ...»: non si cita mai un test che non esiste.

## Decisioni

- [Attributi data-* per ruolo](0001-data-attributes-named-by-role.md) — mai `data-sixteen-*`: prima gli agganci del riferimento, poi `data-element`, poi un nome di comportamento.
- [Parita' HTML con Design Comuni](0002-design-comuni-html-parity.md) — il `<body>` e' quello del riferimento; cambiano solo CSS/JS.
- [SPID e CIE spenti di default](0003-digital-identity-routes-off-by-default.md) — rotte registrate solo con `sixteen.auth.spid.enabled === true`, dopo l'incidente SEC-02.
- [Asset via symlink public_html/themes](0004-theme-assets-via-public-symlink.md) — il web server serve `Themes/Sixteen/public`; le Action PHP di asset sono un ripiego e le loro rotte esistono (`laravel/routes/web.php:15,20`).

## Decisioni precedenti (formato libero, non ancora ADR)

- [front-office-audit](../bmad/decisions/front-office-audit.md)

## Stato di copertura

Misurato il 2026-11-26.

| Voce | Esito |
|:---|:---|
| ADR | 4 |
| Con le sei sezioni nel formato sopra | 4 su 4 |
| Con `## Stato attuale` (il codice contraddice o precisa l'ADR) | 4 su 4: dettagli nei file |
| Con una Conferma che cita un test esistente | 4 su 4 |
| Con una conferma automatica completa | 0: ogni ADR ha una parte solo di revisione, scritta come «Nessuna conferma automatica oggi» con una proposta |

Contraddizioni trovate (non corrette: sono decisioni o codice, non documenti):

- `0001`: `data-geo-*` in `components/layouts/main.blade.php:57` e `components/blocks/geo/mappa-static.blade.php:42`, che il
  guard (`DataAttributeParityContractTest.php:46`) non vede.
- `0003`: i controller SPID/CIE scrivono `fiscal_code` e l'intera `SAMLResponse` nei log; la firma SPID non e' legata al
  contenuto dell'asserzione.
- `0004`: il link `public_html/themes/Sixteen` ha una barra finale che `Modules/Xot/tests/Unit/ThemePublicSymlinkTest.php`
  non ammette (confronto di stringhe, non verificato con Pest), e `docs/wiki/concepts/public-html-themes-symlink.md` cita ancora
  `npm run copy`.

## Backlog

- Estendere il guard `data-*` ai nomi di `Modules/*` (`0001`).
- Un test sorgente che confronti la sequenza di tag e `data-element` dell'header con `Main_files/five/index.html` (`0002`).
- Ripristinare o togliere i riferimenti a file inesistenti: `Modules/Xot/docs/wiki/rules/theme-public-symlink.md`,
  `bashscripts/ai/wiki/rules/013-design-comuni-html-match.md`, `Modules/Xot/docs/theme-assets-workflow.md` (citato da `AGENTS.md`).
