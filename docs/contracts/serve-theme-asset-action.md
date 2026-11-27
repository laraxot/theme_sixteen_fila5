---
title: "Contratto — ServeThemeAssetAction"
type: contract
action: "Themes\\Sixteen\\Actions\\Assets\\ServeThemeAssetAction"
theme: Sixteen
created: 2026-11-24
updated: 2026-11-24
related:
  - ../adr/theme-assets-via-public-symlink.md
  - ../../app/Actions/Assets/ServeDesignComuniAssetAction.php
---

# Contratto: ServeThemeAssetAction

Serve via PHP un file della cartella `public/` del tema. Oggi **nessuna rotta la usa** (ne' lei ne'
`ServeDesignComuniAssetAction`, che le delega): gli asset passano dal symlink `public_html/themes/Sixteen`
([ADR](../adr/theme-assets-via-public-symlink.md)). Il contratto vale per chi la ricollega.

## Input

- `execute(string $path)`: percorso relativo a `Themes/Sixteen/public`; `\` diventa `/`, gli `/` iniziali si tolgono.

## Output

- `BinaryFileResponse` del file, header `Cache-Control: public, max-age=31536000, immutable`.
- Caso speciale: `design-comuni/assets/images/logo-comune.svg` assente in `public/` si serve da
  `Main_files/five/assets/images/logo-comune.svg`.

## Invarianti

| ID | Regola | Group Pest |
|:---|:---|:---|
| SIXTEEN-ASSET-INV-1 | Un percorso vuoto o che contiene `..` (anche con `\`) e' 404 prima di qualunque accesso al filesystem. | `SIXTEEN-ASSET-INV-1` |
| SIXTEEN-ASSET-INV-2 | Si servono solo file sotto `Themes/Sixteen/public` (piu' l'unico fallback del logo): mai `resources/`, `config/`, sorgenti. | — |

## Effetti collaterali

- Lettura di un file dal disco e risposta HTTP con cache di un anno (il browser non lo richiede piu': i file devono avere
  nome con hash o non cambiare mai).

## Errori

- `NotFoundHttpException` per percorso vuoto, con `..`, o file inesistente.

## Non fa

- Non e' il modo normale di servire gli asset: il web server li serve dal symlink senza passare da PHP.
- Non verifica i symlink dentro `public/`: un link che esce dalla cartella verrebbe seguito.
- Non imposta `Content-Type` a mano: lo deduce Symfony dall'estensione.
