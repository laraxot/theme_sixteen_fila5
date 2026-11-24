---
title: "Contratto — CieAuthAction"
type: contract
action: "Themes\\Sixteen\\Actions\\CieAuthAction"
theme: Sixteen
created: 2026-11-24
updated: 2026-11-24
related:
  - ../adr/digital-identity-routes-off-by-default.md
  - ../../app/Http/Controllers/CieAuthController.php
  - ../../config/cie.php
---

# Contratto: CieAuthAction

Client OpenID Connect verso l'IdP CIE. La usa solo `app/Http/Controllers/CieAuthController.php`, con rotte attive solo
se l'identita' digitale e' abilitata ([ADR](../adr/digital-identity-routes-off-by-default.md)).

## Input

- Config: `cie.base_url` (default preproduzione `https://preprod.idserver.servizicie.interno.gov.it/idp`),
  `cie.client_id`, `cie.client_secret`, `cie.redirect_uris.callback` (fallback `route('cie.callback')`),
  `cie.certificates.jwks_uri`, `cie.token.algorithms` (`RS256`, `RS384`, `RS512`).
- `getLoginUrl(?string $returnUrl)`, `getMobileLoginUrl(?string $returnUrl)`, `processCallback(Request $request)`
  (`code`, `state`, `error`), `logout()`, `refreshToken()`, `getLogoutUrl(?string $returnUrl)`.

## Output

- URL di autorizzazione `…/oidc/authorize` (`response_type=code`, `scope=openid profile email`, `prompt=login`,
  `acr_values=SpidL2`) o `cieid://login?…` per l'app.
- `processCallback`: attributi mappati (`cie_id`, `name`, `surname`, `fiscal_code`, …) da userinfo + claim dell'id_token.
- `refreshToken`: i nuovi token o `null`.

## Invarianti

| ID | Regola | Group Pest |
|:---|:---|:---|
| SIXTEEN-CIE-INV-1 | Un id_token si accetta solo con `alg` tra `cie.token.algorithms` e firma verificata sul JWKS di `cie.certificates.jwks_uri`; senza JWKS configurato il login fallisce (mai claim letti da un JWT non verificato). | — |
| SIXTEEN-CIE-INV-2 | `state` della callback deve coincidere con `cie.state` in sessione. | — |
| SIXTEEN-CIE-INV-3 | Il claim `nonce` deve coincidere con `cie.nonce`; `aud` = `client_id`; `iss` = `base_url`; `exp` nel futuro. | — |
| SIXTEEN-CIE-INV-4 | Il log di un login riuscito contiene i nomi degli attributi, mai i loro valori (codice fiscale, email: dati personali). | `SIXTEEN-CIE-INV-4` |

Il caso «JWT con `alg: none`» e' provato da `tests/Unit/DigitalIdentityAuthenticationSecurityTest.php`, che pero' richiede
il boot dell'app (`config()`): non ha group finche' non gira senza app.

## Effetti collaterali

- HTTP verso l'IdP: `POST /oidc/token` (scambio del code e refresh), `GET /oidc/userinfo`, `GET <jwks_uri>`,
  `POST /oidc/revoke` in `logout()`.
- Sessione: scrive `cie.state`, `cie.nonce`, `cie.return_url`, `cie.auth_method`, `cie.access_token`/`cie.refresh_token`
  (refresh); `logout()` cancella le chiavi `cie.*`.
- Log: `processCallback` registra in `Log::info` i **soli nomi** degli attributi (`attribute_names`), mai i valori
  (SIXTEEN-CIE-INV-4);
  `Log::warning` sui fallimenti di revoca e refresh.

## Errori

- `Exception` con messaggi `CIE authentication error: …`, `State parameter mismatch`, `Authorization code missing`,
  `Token exchange failed: <body>`, `UserInfo request failed: <body>`, `JWT signature verification unavailable|failed`,
  `Nonce|Audience|Issuer verification failed`, `Token expired`.
- `logout()` e `refreshToken()` non lanciano: loggano e proseguono (`refreshToken` torna `null`).

## Non fa

- Non crea ne' autentica l'utente Laravel: lo fa il controller (`Auth::login`, `UpsertUserFromDigitalIdentityAction`).
- Non sanifica `returnUrl`: lo fa il controller con `SanitizeReturnUrlAction` prima di chiamarla.
- Non mette in cache il JWKS: una richiesta HTTP per ogni login.
