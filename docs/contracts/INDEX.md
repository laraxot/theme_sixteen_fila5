---
title: "INDEX contratti — Sixteen"
type: index
theme: Sixteen
status: active
created: 2026-11-27
updated: 2026-11-27
qmd: "sixteen contracts index machine readable"
---

# Sixteen behavioral contract index

Inventario machine-readable dei contratti di comportamento del tema **Sixteen**.
Ogni file `type: contract` in questa cartella e' elencato qui; la tabella di lavoro
italiana con i gruppi di invarianti e' in [index.md](index.md). Il contratto di
presentazione delle pagine Folio (`folio-page-shell.md`, `type: presentation-contract`)
è elencato per completezza: non ha una classe Action PHP.

## Contratti

- [cie-auth-action](cie-auth-action.md) — `type: contract` — Client OpenID Connect verso l'IdP CIE (`Themes\Sixteen\Actions\CieAuthAction`).
- [folio-page-shell](folio-page-shell.md) — `type: presentation-contract` — Forma delle pagine Folio di `resources/views/pages` (nessuna classe PHP).
- [sanitize-return-url-action](sanitize-return-url-action.md) — `type: contract` — Difesa contro l'open redirect nei flussi SPID/CIE (`Themes\Sixteen\Actions\Auth\SanitizeReturnUrlAction`).
- [serve-theme-asset-action](serve-theme-asset-action.md) — `type: contract` — Ripiego PHP per servire gli asset del tema (`Themes\Sixteen\Actions\Assets\ServeThemeAssetAction`).
- [spid-auth-action](spid-auth-action.md) — `type: contract` — Service Provider SAML per SPID (`Themes\Sixteen\Actions\SpidAuthAction`).

## Autore

Usa il template [_template.md](_template.md) e il formato descritto in [README.md](README.md).
Le decisioni dietro i contratti stanno in [../adr/index.md](../adr/index.md).
