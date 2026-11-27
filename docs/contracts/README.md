---
<<<<<<< .merge_file_QOQksM
title: "Contratti del tema Sixteen"
type: index
tags: [contracts, actions, sixteen, spid, cie]
created: 2026-11-18
updated: 2026-11-24
---

# Contratti del tema Sixteen

Sixteen e' un tema di presentazione (clone di Design Comuni), ma e' anche l'unico tema con Action che toccano sessione,
HTTP esterno e file: l'identita' digitale SPID/CIE e il servizio degli asset. Qui c'e' cosa promettono e cosa **non** fanno.
Le altre 12 Action del tema (`Block/*`, `Url/*`, `Folio/*`, `Contacts/*`, `MenuBuilderAction`) calcolano o leggono e basta:
non hanno contratto. I contratti applicativi (utenti, segnalazioni, consensi) stanno nei moduli, es.
`Modules/User/docs/contracts/` e `Modules/Gdpr/docs/contracts/`.

**Quando leggerli:** prima di toccare login SPID/CIE, URL di ritorno, servizio di file statici, o di imitare queste Action.

Formato (6 sezioni, invarianti con ID e group Pest): [regola del canon](../../../../Modules/Xot/docs/rules/action-behavioral-contract.md).
I group stanno in `tests/Unit/AuthAndAssetActionContractsTest.php` e girano senza boot dell'app:
`vendor/bin/pest Themes/Sixteen/tests/Unit --group=<ID>`. Su `Themes/Sixteen/tests` intero il caricamento oggi si ferma
prima: alcuni test usano un `TestCase` di un modulo di progetto non installato (`TestCaseClassOrTraitNotFound`).

## Contratti

- [Contratto — SpidAuthAction](spid-auth-action.md) — richieste SAML e validazione della risposta dell'IdP SPID (firma, certificato, RelayState).
- [Contratto — CieAuthAction](cie-auth-action.md) — flusso OIDC CIE: chiamate HTTP all'IdP e verifica dell'id_token.
- [Contratto — SanitizeReturnUrlAction](sanitize-return-url-action.md) — l'URL di ritorno resta sullo stesso host, o si usa il fallback.
- [Contratto — ServeThemeAssetAction](serve-theme-asset-action.md) — file di `public/` via PHP, mai fuori dalla cartella (oggi senza rotta).

## Contratti di presentazione (non Action)

Le promesse sull'HTML (parita' con Design Comuni, attributi `data-*`, JSON delle sezioni) sono regole verificate da test
sul sorgente, non contratti di Action: vedi gli [ADR](../adr/README.md), `../data-attribute-rule.md`,
`tests/Unit/HeaderJsonContentContractTest.php`, `tests/Unit/DataAttributeParityContractTest.php`.
=======
title: "Contratti comportamentali — Sixteen"
type: documentation
theme: Sixteen
status: active
---

# Contratti comportamentali — Sixteen

Questa cartella descrive le superfici pubbliche e le Action del tema Sixteen:
input, output, invarianti, effetti ed errori. L'indice è in
[index.md](./index.md).

I contratti restano agnostici rispetto all'applicazione che installa il tema;
contenuti, branding e dati arrivano dalla configurazione dell'host.

## Registro

- [cie-auth-action.md](cie-auth-action.md)
- [folio-page-shell.md](folio-page-shell.md)
- [sanitize-return-url-action.md](sanitize-return-url-action.md)
- [serve-theme-asset-action.md](serve-theme-asset-action.md)
- [spid-auth-action.md](spid-auth-action.md)
>>>>>>> .merge_file_HXNBQO
