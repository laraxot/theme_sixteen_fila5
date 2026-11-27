---
title: "Contratto — ServeThemeAssetAction"
type: contract
action: "Themes\\Sixteen\\Actions\\Assets\\ServeThemeAssetAction"
theme: Sixteen
<<<<<<< .merge_file_AxtsXo
created: 2026-11-24
updated: 2026-11-24
related:
  - ../adr/theme-assets-via-public-symlink.md
=======
status: accepted
created: 2026-11-24
updated: 2026-11-26
related:
  - ../adr/0004-theme-assets-via-public-symlink.md
>>>>>>> .merge_file_ip5QUo
  - ../../app/Actions/Assets/ServeDesignComuniAssetAction.php
---

# Contratto: ServeThemeAssetAction

<<<<<<< .merge_file_AxtsXo
Serve via PHP un file della cartella `public/` del tema. Oggi **nessuna rotta la usa** (ne' lei ne'
`ServeDesignComuniAssetAction`, che le delega): gli asset passano dal symlink `public_html/themes/Sixteen`
([ADR](../adr/theme-assets-via-public-symlink.md)). Il contratto vale per chi la ricollega.
=======
Serve via PHP un file della cartella `public/` del tema. È il **ripiego** per gli asset: il percorso normale passa dal symlink
`public_html/themes/Sixteen` e dal web server ([ADR](../adr/0004-theme-assets-via-public-symlink.md)). Le rotte esistono:
`laravel/routes/web.php:15` (`/themes/Sixteen/{path}` → `execute`) e `laravel/routes/web.php:20`
(`/{lang}/assets/{path}` → `ServeDesignComuniAssetAction`, che delega a questa Action con il prefisso `design-comuni/assets/`).
>>>>>>> .merge_file_ip5QUo

## Input

- `execute(string $path)`: percorso relativo a `Themes/Sixteen/public`; `\` diventa `/`, gli `/` iniziali si tolgono.
<<<<<<< .merge_file_AxtsXo
=======
- Dalla rotta `/themes/Sixteen/{path}` il parametro ha vincolo `.*` (`routes/web.php:16`); dalla rotta `/{lang}/assets/{path}`
  arriva già anteposto `design-comuni/assets/` e `{lang}` è ignorato.
>>>>>>> .merge_file_ip5QUo

## Output

- `BinaryFileResponse` del file, header `Cache-Control: public, max-age=31536000, immutable`.
- Caso speciale: `design-comuni/assets/images/logo-comune.svg` assente in `public/` si serve da
  `Main_files/five/assets/images/logo-comune.svg`.

## Invarianti

| ID | Regola | Group Pest |
|:---|:---|:---|
<<<<<<< .merge_file_AxtsXo
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
=======
| SIXTEEN-ASSET-INV-1 | Un percorso vuoto o che contiene `..` (anche con `\`) è 404 prima di qualunque accesso al filesystem. Se viene violata, un percorso come `../.env` raggiunge `base_path()` fuori da `public/`. | `SIXTEEN-ASSET-INV-1` |
| SIXTEEN-ASSET-INV-2 | Si servono solo file sotto `Themes/Sixteen/public` (più l'unico ripiego del logo): mai `resources/`, `config/`, sorgenti. Se viene violata, il tema espone il proprio codice sorgente. | — (non dimostrato) |

SIXTEEN-ASSET-INV-2 oggi discende da INV-1 più il prefisso fisso `Themes/Sixteen/public/` (`ServeThemeAssetAction.php:27`): nessun
test chiede un file esistente fuori da `public/` né il ripiego del logo. Backlog test nel [README](README.md).

## Effetti collaterali

- Nessuna scrittura, nessuna sessione, nessuna chiamata esterna.
- Lettura del file dal disco (`is_file`, poi `response()->file`).
- Risposta HTTP con cache di un anno: il browser non lo richiede più, quindi i file devono avere nome con hash o non cambiare
  mai.

## Errori

- `NotFoundHttpException` per percorso vuoto o con `..` (INV-1), o per file inesistente. Nessun'altra eccezione è gestita.

## Non fa

- Non è il modo normale di servire gli asset: il web server li serve dal symlink senza passare da PHP.
- Non verifica i symlink dentro `public/`: un link che esce dalla cartella verrebbe seguito (`is_file` segue i link).
- Non imposta `Content-Type` a mano: lo deduce Symfony dall'estensione.
- Non distingue file con hash da file senza hash: la cache `immutable` vale per entrambi.
- Non controlla il parametro `{lang}` della rotta `/{lang}/assets/{path}`, che vale per qualunque coppia di lettere.

## Limiti noti

- Limite noto: un nome di file legittimo che contiene due punti consecutivi (`foo..bar.css`) è rifiutato con 404, perché il
  controllo è `str_contains($relativePath, '..')` (`ServeThemeAssetAction.php:23`) e non lavora per segmenti.
- Limite noto: nessun test prova che le rotte di `routes/web.php` arrivino davvero all'Action quando il symlink manca (vedi ADR,
  «Conseguenze»).
>>>>>>> .merge_file_ip5QUo
