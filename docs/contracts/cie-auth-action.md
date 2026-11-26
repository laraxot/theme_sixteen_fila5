---
title: "Contratto — CieAuthAction"
type: contract
action: "Themes\\Sixteen\\Actions\\CieAuthAction"
theme: Sixteen
status: accepted
created: 2026-11-24
updated: 2026-11-26
related:
  - ../adr/0003-digital-identity-routes-off-by-default.md
  - ../../app/Http/Controllers/CieAuthController.php
  - ../../config/cie.php
---

# Contratto: CieAuthAction

Client OpenID Connect verso l'IdP CIE. La usa `app/Http/Controllers/CieAuthController.php` (e `routes/auth.php:101,118` per lo
stato e il logout universale), con rotte attive solo se l'identità digitale è abilitata
([ADR](../adr/0003-digital-identity-routes-off-by-default.md)).

## Input

- Config: `cie.base_url` (default preproduzione `https://preprod.idserver.servizicie.interno.gov.it/idp`; la chiave non è
  definita in `config/cie.php`, vedi «Limiti noti»), `cie.client_id`, `cie.client_secret`, `cie.redirect_uris.callback`
  (fallback `route('cie.callback')`), `cie.certificates.jwks_uri`, `cie.token.algorithms` (`RS256`, `RS384`, `RS512`).
- `getLoginUrl(?string $returnUrl)`, `getMobileLoginUrl(?string $returnUrl)`, `processCallback(Request $request)`
  (`code`, `state`, `error`), `logout()`, `refreshToken()`, `getLogoutUrl(?string $returnUrl)`.

## Output

- URL di autorizzazione `…/oidc/authorize` (`response_type=code`, `scope=openid profile email`, `prompt=login`,
  `acr_values=https://www.spid.gov.it/SpidL2`) o `cieid://login?…` per l'app.
- `processCallback`: attributi mappati (`cie_id`, `name`, `surname`, `fiscal_code`, …) da userinfo + claim dell'id_token.
- `refreshToken`: i nuovi token o `null`.

## Invarianti

| ID | Regola | Group Pest |
|:---|:---|:---|
| SIXTEEN-CIE-INV-1 | Un id_token si accetta solo con `alg` tra `cie.token.algorithms` e firma verificata sul JWKS di `cie.certificates.jwks_uri`; senza JWKS configurato il login fallisce con `JWT signature verification unavailable` (mai claim letti da un JWT non verificato). Se viene violata, un JWT non firmato autentica un cittadino. | `SIXTEEN-CIE-INV-1` (prova parziale) |
| SIXTEEN-CIE-INV-2 | `state` della callback deve essere non vuoto e coincidere con `cie.state` in sessione, altrimenti `State parameter mismatch`, prima di qualunque chiamata all'IdP. | — (non dimostrato) |
| SIXTEEN-CIE-INV-3 | Il claim `nonce` deve coincidere con `cie.nonce`; `aud` = `client_id`; `iss` = `base_url`; `exp` nel futuro: ciascuno, se manca o non coincide, dà un'`Exception` dedicata. | — (non dimostrato) |
| SIXTEEN-CIE-INV-4 | Il log di un login riuscito contiene i nomi degli attributi, mai i loro valori (codice fiscale, email: dati personali). Vale per l'Action, non per il controller (vedi «Limiti noti»). | `SIXTEEN-CIE-INV-4` |

Prova di INV-1: `tests/Unit/DigitalIdentityAuthenticationSecurityTest.php`, test «CIE rejects an unsigned JWT before reading
claims» (richiede il boot dell'app). Passa con un'eccezione `JWT signature verification…`: dal ramo «JWKS assente» (se
`CIE_JWKS_URI` non è impostata nell'ambiente di test) o da quello «`alg` fuori lista» (se lo è). Non c'è un test per
l'accettazione di un token valido né per gli algoritmi `HS*`. INV-4 è un controllo sul sorgente
(`tests/Unit/AuthAndAssetActionContractsTest.php`, group `SIXTEEN-CIE-INV-4`, senza app).

## Effetti collaterali

In `processCallback`, nell'ordine in cui avvengono:

1. Sessione: lettura di `cie.state` (INV-2); nessuna scrittura.
2. HTTP `POST <base_url>/oidc/token` (scambio del `code`).
3. HTTP `GET <base_url>/oidc/userinfo` con il bearer token.
4. HTTP `GET <jwks_uri>` (in `validateIdToken`, solo se `cie.certificates.jwks_uri` è configurato), poi lettura di
   `cie.nonce` dalla sessione.
5. Log: `Log::info('CIE authentication successful')` con i **soli nomi** degli attributi (`attribute_names`) e `auth_method`
   (SIXTEEN-CIE-INV-4).

Gli altri metodi:

- `getLoginUrl` scrive `cie.state`, `cie.nonce`, `cie.return_url`; `getMobileLoginUrl` scrive anche `cie.auth_method`.
- `logout()`: `POST <base_url>/oidc/revoke` se c'è `cie.refresh_token`, poi cancella `cie.authenticated`, `cie.user_data`,
  `cie.access_token`, `cie.refresh_token`, `cie.state`, `cie.nonce`, `cie.auth_method` (non `cie.return_url`).
- `refreshToken()`: `POST <base_url>/oidc/token` (`grant_type=refresh_token`), scrive `cie.access_token` e, se presente,
  `cie.refresh_token`; `Log::warning` sul fallimento.

## Errori

- `Exception` con messaggi `CIE authentication error: …` (parametro `error` della callback), `State parameter mismatch` (INV-2),
  `Authorization code missing`, `Token exchange failed: <body>`, `UserInfo request failed: <body>`,
  `JWT signature verification unavailable` | `failed` (INV-1), `Nonce|Audience|Issuer verification failed` e `Token expired`
  (INV-3).
- `logout()` e `refreshToken()` non lanciano: loggano un `Log::warning` e proseguono (`refreshToken` torna `null`).

## Non fa

- Non crea né autentica l'utente Laravel: lo fa il controller (`Auth::login`, `UpsertUserFromDigitalIdentityAction`).
- Non sanifica `returnUrl`: lo fa il controller con `SanitizeReturnUrlAction` prima di chiamarla.
- Non mette in cache il JWKS: una richiesta HTTP per ogni login.
- Non consuma `cie.state` e `cie.nonce` dopo un login riuscito: restano in sessione fino a `logout()`.
- Non salva i token del primo scambio nella sessione: `cie.access_token` e `cie.refresh_token` li scrive solo `refreshToken()`,
  che parte da `cie.refresh_token` (mai impostato dal flusso di login), quindi oggi torna `null` al primo giro.

## Limiti noti

- Limite noto: `cie.base_url` non è definita in `config/cie.php` (che ha solo `urls.preprod.base_url` e `urls.prod.base_url`,
  scelti da `environment`): `CieAuthAction.php:37` usa sempre il default di preproduzione, anche con `CIE_ENVIRONMENT=prod`;
  anche il controllo di `iss` (INV-3) confronta con quel valore.
- Limite noto: con `CIE_CLIENT_ID` o `CIE_CLIENT_SECRET` assenti, il costruttore assegna `null` a una proprietà `string`
  (`CieAuthAction.php:38-39`): `TypeError` alla prima risoluzione dell'Action dal container (verificato con PHP 8.4 su una
  classe equivalente), quindi anche le rotte `sixteen.auth.digital-identity.*` di `routes/auth.php`.
- Limite noto: `processCallback` chiama userinfo (passo 3) prima di validare l'id_token (passo 4): il bearer token è usato presso
  l'IdP prima che l'id_token sia verificato.
- Limite noto: `aud` si confronta con `!==` contro `client_id` (`CieAuthAction.php:288`): un id_token con `aud` array, forma
  ammessa da OIDC, verrebbe rifiutato.
- Limite noto: INV-4 vale per l'Action; `CieAuthController.php:137` scrive `fiscal_code` in `Log::info('CIE authentication
  completed')` e `:149` scrive `$request->all()` in `Log::error`; `CieAuthController.php:157` mostra al cittadino
  `$e->getMessage()`, compresi `Token exchange failed: <body>` e `UserInfo request failed: <body>` con il corpo della risposta
  dell'IdP.
