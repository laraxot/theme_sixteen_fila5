---
title: "Contratti del tema Sixteen"
type: index
tags: [contracts, actions, sixteen, spid, cie]
created: 2026-11-18
updated: 2026-11-26
---

# Contratti del tema Sixteen

Sixteen e' un tema di presentazione (clone di Design Comuni), ma e' anche l'unico tema con Action che toccano sessione,
HTTP esterno e file: l'identita' digitale SPID/CIE e il servizio degli asset. Qui c'e' cosa promettono e cosa **non** fanno.
Le altre 12 Action del tema (`Block/*`, `Url/*`, `Folio/*`, `Contacts/*`, `MenuBuilderAction`) calcolano o leggono e basta:
non hanno contratto. I contratti applicativi (utenti, segnalazioni, consensi) stanno nei moduli, es.
`Modules/User/docs/contracts/` e `Modules/Gdpr/docs/contracts/`.

**Quando leggerli:** prima di toccare login SPID/CIE, URL di ritorno, servizio di file statici, o di imitare queste Action.

Formato (6 sezioni, invarianti con ID e group Pest): [regola del canon](../../../../Modules/Xot/docs/rules/action-behavioral-contract.md).
I group stanno in `tests/Unit/AuthAndAssetActionContractsTest.php` (senza boot dell'app), in
`tests/Unit/DigitalIdentityAuthenticationSecurityTest.php`, `tests/Unit/FolioPageMountContractTest.php`,
`tests/Unit/NoSemanticFolioPageDirectoriesTest.php` e `tests/Feature/Pages/DetailNotFoundTest.php` (questi ultimi due con app e
database): `vendor/bin/pest Themes/Sixteen/tests --group=<ID>`. Su `Themes/Sixteen/tests` intero il caricamento oggi si ferma
prima: alcuni test usano un `TestCase` di un modulo di progetto non installato (`TestCaseClassOrTraitNotFound`).

## Contratti

- [Contratto — SpidAuthAction](spid-auth-action.md) — richieste SAML e validazione della risposta dell'IdP SPID (firma, certificato, RelayState).
- [Contratto — CieAuthAction](cie-auth-action.md) — flusso OIDC CIE: chiamate HTTP all'IdP e verifica dell'id_token.
- [Contratto — SanitizeReturnUrlAction](sanitize-return-url-action.md) — l'URL di ritorno resta sullo stesso host, o si usa il fallback.
- [Contratto — ServeThemeAssetAction](serve-theme-asset-action.md) — file di `public/` via PHP, mai fuori dalla cartella; ripiego raggiunto da `laravel/routes/web.php:15,20` (le rotte esistono).

## Contratti di presentazione (non Action)

- [Contratto — Sixteen Folio page shell](folio-page-shell.md) — `type: presentation-contract`, **non** e' un contratto di Action:
  forma delle pagine Folio e cosa non devono fare (5 invarianti `SIXTEEN-FOLIO-INV-N`, tutte con group Pest).

Le altre promesse sull'HTML (parita' con Design Comuni, attributi `data-*`, JSON delle sezioni) sono regole verificate da test
sul sorgente, non contratti di Action: vedi gli [ADR](../adr/README.md), `../data-attribute-rule.md`,
`tests/Unit/HeaderJsonContentContractTest.php`, `tests/Unit/DataAttributeParityContractTest.php`.

## Stato di copertura

Misurato il 2026-11-26 con `audit_docs.py` (swarm ADR e contratti) e con la lettura dei test.

| Voce | Esito |
|:---|:---|
| Contratti di Action | 4: `ServeThemeAssetAction`, `SanitizeReturnUrlAction`, `SpidAuthAction`, `CieAuthAction` |
| Contratti di presentazione | 1: `folio-page-shell.md` |
| Invarianti | 20 (ASSET 2, RETURN 3, SPID 6, CIE 4, FOLIO 5) |
| Con un group Pest | 14 su 20 (all'inizio 8 su 15) |
| Senza test (non dimostrate) | 6: `SIXTEEN-ASSET-INV-2`, `SIXTEEN-CIE-INV-2`, `SIXTEEN-CIE-INV-3`, `SIXTEEN-SPID-INV-3`, `SIXTEEN-SPID-INV-4`, `SIXTEEN-SPID-INV-5` |
| Prove parziali | `SIXTEEN-CIE-INV-1` (solo un JWT non firmato, non un token valido) |
| Action a rischio senza contratto | 0 (le altre 12 leggono o calcolano) |

Nessun test e' stato eseguito in questa passata (Pest non si lancia dallo swarm): i group sono annotazioni, e i test che ne
portano uno non sono stati rieseguiti dopo l'annotazione.

I contratti di SPID e CIE hanno una sezione **Limiti noti** con difetti verificati sul codice (firma SPID non legata
al contenuto, `base_url` CIE sempre di preproduzione, dati personali nei log dei controller). Non sono corretti: il
codice non e' stato modificato oltre i docblock.

## Backlog contract

- `ServeDesignComuniAssetAction` (`app/Actions/Assets/`): delega a `ServeThemeAssetAction` con il prefisso
  `design-comuni/assets/`; coperta dal contratto di `ServeThemeAssetAction`, senza un file proprio.
- Nessun'altra Action a rischio.

## Backlog test

- `SIXTEEN-ASSET-INV-2`: un test che dimostri che un file fuori da `public/` non viene servito, compreso un symlink dentro
  `public/` che punta fuori (il contratto dice che oggi verrebbe seguito), e che copra il ripiego del logo.
- `SIXTEEN-CIE-INV-2`, `SIXTEEN-CIE-INV-3`: un test con sessione e un id_token firmato di prova (chiave in fixture) per
  `state`, `nonce`, `aud`, `iss`, `exp`.
- `SIXTEEN-SPID-INV-3`, `SIXTEEN-SPID-INV-4`, `SIXTEEN-SPID-INV-5`: una risposta SAML firmata di prova e un certificato di
  prova in `storage/`; senza di essi la dimostrazione non e' possibile.
- Un test che fallisca se `Log::info`/`Log::error` dei controller SPID/CIE contiene `fiscal_code` o `$request->all()`
  (oggi lo fanno: vedi i Limiti noti).

## Nota sull'audit

`audit_docs.py` segnala `folio-page-shell.md` con `type:contract, action:FQCN`: e' un falso positivo, il file e' un contratto di
presentazione senza classe PHP.
