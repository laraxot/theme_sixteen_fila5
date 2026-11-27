---
title: "Contratto — SanitizeReturnUrlAction"
type: contract
action: "Themes\\Sixteen\\Actions\\Auth\\SanitizeReturnUrlAction"
theme: Sixteen
created: 2026-11-24
updated: 2026-11-24
related:
  - ../../app/Http/Controllers/SpidAuthController.php
  - ../../app/Http/Controllers/CieAuthController.php
---

# Contratto: SanitizeReturnUrlAction

Action pura ma di sicurezza: e' l'unica difesa contro l'open redirect nei flussi SPID/CIE. Senza effetti collaterali,
ha un contratto perche' i controller ne dipendono per non rimandare il cittadino autenticato su un dominio altrui.

## Input

- `execute(Request $request, mixed $candidate, string $fallback)`: `$candidate` arriva da query string o sessione
  (`return_url`), quindi puo' essere qualunque cosa.

## Output

- `$candidate` se valido (un percorso relativo `/…` diventa assoluto sull'host corrente); altrimenti `$fallback` intatto.

## Invarianti

| ID | Regola | Group Pest |
|:---|:---|:---|
| SIXTEEN-RETURN-INV-1 | Un URL con host, schema o porta diversi da quelli della richiesta (compresi `//host` e `javascript:`) da' il fallback. | `SIXTEEN-RETURN-INV-1` |
| SIXTEEN-RETURN-INV-2 | Non-stringa, stringa vuota, `\` o caratteri di controllo (0x00-0x1F, 0x7F) danno il fallback. | `SIXTEEN-RETURN-INV-2` |
| SIXTEEN-RETURN-INV-3 | Un percorso `/…` (non `//`) diventa `<schema>://<host><percorso>` della richiesta. | `SIXTEEN-RETURN-INV-3` |

## Effetti collaterali

Nessuno.

## Errori

- Non lancia: un URL non analizzabile (`Safe\Exceptions\UrlException`) da' il fallback.

## Non fa

- Non valida il `$fallback`: e' fidato per costruzione (rotta interna o `GetPostLoginUrlAction`).
- Non controlla che il percorso esista ne' che l'utente possa vederlo.
- Non ammette sottodomini o host "fratelli": serve l'host identico.
