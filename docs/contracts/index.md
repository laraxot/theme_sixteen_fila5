---
title: "Indice dei contratti — Sixteen"
type: index
theme: Sixteen
status: active
created: 2026-11-27
updated: 2026-11-27
qmd: "sixteen contracts index copertura invarianti spid cie asset folio"
---

# Indice dei contratti — Sixteen

Ogni file `type: contract` descrive una Action del tema con le sei sezioni canoniche
(`Input`, `Output`, `Invarianti`, `Effetti collaterali`, `Errori`, `Non fa`). La classe
implementatrice e' indicata nella frontmatter `action:`; `folio-page-shell.md` e'
un `presentation-contract` (nessuna classe PHP: copre le pagine Folio).

## Identita' digitale (SPID/CIE)

| Contratto | Action | File | Invarianti (group Pest) |
|---|---|---|---|
| [SpidAuthAction](spid-auth-action.md) | `Themes\Sixteen\Actions\SpidAuthAction` | [spid-auth-action.md](spid-auth-action.md) | `SIXTEEN-SPID-INV-1`, `-2`, `-6` con group; `-3`, `-4`, `-5` non dimostrati |
| [CieAuthAction](cie-auth-action.md) | `Themes\Sixteen\Actions\CieAuthAction` | [cie-auth-action.md](cie-auth-action.md) | `SIXTEEN-CIE-INV-1` (parziale), `-4` con group; `-2`, `-3` non dimostrati |
| [SanitizeReturnUrlAction](sanitize-return-url-action.md) | `Themes\Sixteen\Actions\Auth\SanitizeReturnUrlAction` | [sanitize-return-url-action.md](sanitize-return-url-action.md) | `SIXTEEN-RETURN-INV-1`, `-2`, `-3` con group |

## Asset e presentazione

| Contratto | Action | File | Invarianti (group Pest) |
|---|---|---|---|
| [ServeThemeAssetAction](serve-theme-asset-action.md) | `Themes\Sixteen\Actions\Assets\ServeThemeAssetAction` | [serve-theme-asset-action.md](serve-theme-asset-action.md) | `SIXTEEN-ASSET-INV-1` con group; `-2` non dimostrato |
| [Folio page shell](folio-page-shell.md) | — (presentation-contract su `resources/views/pages`) | [folio-page-shell.md](folio-page-shell.md) | `SIXTEEN-FOLIO-INV-1`…`-5` con group |

## Note

- Le decisioni dietro i contratti stanno in [../adr/index.md](../adr/index.md) (in particolare ADR 0003 per SPID/CIE e ADR 0004 per gli asset).
- Il template per un nuovo contratto e' [_template.md](_template.md); il formato e' descritto in [README.md](README.md).
