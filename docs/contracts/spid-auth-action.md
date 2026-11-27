---
title: "Contratto — SpidAuthAction"
type: contract
action: "Themes\\Sixteen\\Actions\\SpidAuthAction"
theme: Sixteen
created: 2026-11-24
updated: 2026-11-24
related:
  - ../adr/digital-identity-routes-off-by-default.md
  - ../../app/Http/Controllers/SpidAuthController.php
  - ../../tests/Unit/AuthAndAssetActionContractsTest.php
---

# Contratto: SpidAuthAction

Service Provider SAML per SPID. La usa solo `app/Http/Controllers/SpidAuthController.php`, le cui rotte esistono solo con
`sixteen.auth.spid.enabled === true` (vedi [ADR](../adr/digital-identity-routes-off-by-default.md)).

## Input

- Costruttore: `spid.entity_id` (fallback `app.url`), rotte `spid.callback` e `spid.slo` (devono esistere: con le rotte
  spente il costruttore fallisce), `spid.providers` (se assente, tre IdP di default: `poste`, `sielte`, `tim`).
- `getLoginUrl(string $provider, int $level = 2, ?string $returnUrl = null)`.
- `getLogoutUrl(string $provider, string $nameId, string $sessionIndex)`.
- `processCallback(Request $request)`: `SAMLResponse` (base64) e `RelayState` nel POST.

## Output

- `getLoginUrl` / `getLogoutUrl`: URL dell'IdP con `SAMLRequest` (deflate + base64) e `RelayState` = id della richiesta.
- `processCallback`: array normalizzato (`spid_code`, `name`, `surname`, `fiscal_code`, `email`, `mobile`, `birth_date`,
  `birth_place`, `gender`, `address`, `digital_address`, `company_name`, `vat_number`, `provider`, `auth_level`).
- `getMetadata()`: XML del Service Provider.

## Invarianti

| ID | Regola | Group Pest |
|:---|:---|:---|
| SIXTEEN-SPID-INV-1 | Una risposta senza `ds:Signature` viene rifiutata, anche con `StatusCode` Success. | `SIXTEEN-SPID-INV-1` |
| SIXTEEN-SPID-INV-2 | Una risposta con `StatusCode` diverso da `urn:oasis:names:tc:SAML:2.0:status:Success` viene rifiutata. | `SIXTEEN-SPID-INV-2` |
| SIXTEEN-SPID-INV-3 | Il certificato nella firma deve avere la stessa impronta del certificato fidato `storage/certificates/spid/<spid.providers.<p>.cert_file>`; senza `cert_file` configurato la risposta e' rifiutata. | — |
| SIXTEEN-SPID-INV-4 | `RelayState` deve coincidere con `spid.request_id` in sessione (anti-replay/CSRF del flusso). | — |
| SIXTEEN-SPID-INV-5 | Algoritmi di firma accettati: solo RSA-SHA256 e RSA-SHA1; qualunque altro e' rifiutato. | — |
| SIXTEEN-SPID-INV-6 | Il log di un login riuscito contiene i nomi degli attributi, mai i loro valori (codice fiscale, email, telefono: dati personali). | `SIXTEEN-SPID-INV-6` |

## Effetti collaterali

- Sessione: `getLoginUrl` scrive `spid.request_id`, `spid.provider`, `spid.return_url`, `spid.auth_level`;
  `getLogoutUrl` scrive `spid.logout_request_id`; `logout()` cancella le chiavi `spid.*` di autenticazione.
- Log: `processCallback` scrive `Log::info('SPID authentication successful')` con il provider e i **soli nomi** degli
  attributi ricevuti (`attribute_names`), mai i valori (SIXTEEN-SPID-INV-6).
- Lettura file: il certificato fidato da `storage_path('certificates/spid/...')`.
- Nessuna chiamata HTTP: il browser va all'IdP tramite redirect.

## Errori

- `InvalidArgumentException` per provider non configurato.
- `Exception('SAMLResponse mancante' | 'RelayState non valido' | 'SAMLResponse non decodificabile')`.
- `Exception('SPID authentication failed')` per ogni violazione di firma, certificato o stato (messaggio unico voluto: non
  dice all'attaccante quale controllo ha fallito).

## Non fa

- Non autentica l'utente in Laravel e non crea l'utente: lo fa il controller con `Auth::login()` e
  `Modules\User\Actions\Auth\UpsertUserFromDigitalIdentityAction`; il controller scrive anche `spid.authenticated`.
- Non valida l'URL di ritorno: lo fa `SanitizeReturnUrlAction` nel controller ([contratto](sanitize-return-url-action.md)).
- Non firma le `AuthnRequest` (i metadata dichiarano `AuthnRequestsSigned="true"`: debito verso le regole tecniche AgID).
- Non controlla `NotOnOrAfter`/`Audience` dell'asserzione: non aggiungerli "per completezza" qui senza un test; il posto
  giusto e' una libreria SAML dedicata (decisione aperta).
