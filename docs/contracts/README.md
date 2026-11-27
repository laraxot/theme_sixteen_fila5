---
title: "Contratti comportamentali — Sixteen"
type: documentation
theme: Sixteen
status: active
---

# Contratti comportamentali — Sixteen

Questa cartella descrive le superfici pubbliche e le Action del tema Sixteen:
input, output, invarianti, effetti ed errori. L'indice di lavoro e' in
[index.md](./index.md) e l'inventario machine-readable in [INDEX.md](./INDEX.md);
per un nuovo contratto usa [_template.md](_template.md).

I contratti restano agnostici rispetto all'applicazione che installa il tema;
contenuti, branding e dati arrivano dalla configurazione dell'host.

## Registro

- [cie-auth-action.md](cie-auth-action.md)
- [folio-page-shell.md](folio-page-shell.md)
- [sanitize-return-url-action.md](sanitize-return-url-action.md)
- [serve-theme-asset-action.md](serve-theme-asset-action.md)
- [spid-auth-action.md](spid-auth-action.md)

## Harness minimo: ownership, evidenza e recupero (2026-11-27)

I contratti di **theme_sixteen_fila5** restano accanto alle Action, interfacce o superfici di questo package; root e Xot definiscono lo standard, non copiano le promesse. Un contratto comportamentale esplicita **Input, Output, Invarianti, Effetti collaterali, Errori, Non fa**; ogni ID di invariante punta a un group Pest effettivo oppure segnala `non dimostrata`. Se esiste la classe, il docblock deve rimandare al file con `@contract` e `@see`; per temi senza classi PHP non inventare Action/contratti.

- [Standard Xot](https://github.com/laraxot/module_xot_fila5/blob/dev/docs/contracts/contract-authoring-standard.md) · [ownership root](https://github.com/laraxot/base_ptvx_fila5/blob/dev/docs/adr/0001-harness-minimo-e-ownership.md) · [runbook ECC/Second Brain](https://github.com/laraxot/base_ptvx_fila5/blob/dev/docs/harness/README.md).
- **BMAD**: prima di cambiare una promessa, fissa nella story owner scope, esclusioni, evidenza e approvazioni richieste.
- **ECC**: i marker di merge rendono invalido l'indice; citare una suite non significa averla eseguita. Distingui `pass`, `fail`, `non eseguito` e registra il debito in [rollout #15](https://github.com/laraxot/base_ptvx_fila5/issues/15).
