---
title: "Contratto — SpidAuthAction"
type: contract
action: "Themes\\Sixteen\\Actions\\SpidAuthAction"
theme: Sixteen
<<<<<<< .merge_file_ER3QxU
created: 2026-11-24
updated: 2026-11-24
related:
  - ../adr/digital-identity-routes-off-by-default.md
=======
status: accepted
created: 2026-11-24
updated: 2026-11-26
related:
  - ../adr/0003-digital-identity-routes-off-by-default.md
>>>>>>> .merge_file_bSq8zW
  - ../../app/Http/Controllers/SpidAuthController.php
  - ../../tests/Unit/AuthAndAssetActionContractsTest.php
---

# Contratto: SpidAuthAction

<<<<<<< .merge_file_ER3QxU
Service Provider SAML per SPID. La usa solo `app/Http/Controllers/SpidAuthController.php`, le cui rotte esistono solo con
`sixteen.auth.spid.enabled === true` (vedi [ADR](../adr/digital-identity-routes-off-by-default.md)).

## Input

- Costruttore: `spid.entity_id` (fallback `app.url`), rotte `spid.callback` e `spid.slo` (devono esistere: con le rotte
  spente il costruttore fallisce), `spid.providers` (se assente, tre IdP di default: `poste`, `sielte`, `tim`).
=======
Service Provider SAML per SPID. La usa solo `app/Http/Controllers/SpidAuthController.php` (più `routes/auth.php:100,117` per lo
stato), le cui rotte esistono solo con `sixteen.auth.spid.enabled === true` (vedi
[ADR](../adr/0003-digital-identity-routes-off-by-default.md)). **Con l'identità digitale accesa valgono i «Limiti noti» in fondo:
la firma è controllata, il contenuto dell'asserzione no.**

## Input

- Costruttore: `spid.entity_id` (fallback `app.url`), rotte `spid.callback` e `spid.slo` (devono esistere: con le rotte spente
  il costruttore fallisce), `spid.providers` (se non è un array, tre IdP di default: `poste`, `sielte`, `tim`; in questo
  progetto `config/spid.php` li definisce, con `cert_file`).
>>>>>>> .merge_file_bSq8zW
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
<<<<<<< .merge_file_ER3QxU
| SIXTEEN-SPID-INV-1 | Una risposta senza `ds:Signature` viene rifiutata, anche con `StatusCode` Success. | `SIXTEEN-SPID-INV-1` |
| SIXTEEN-SPID-INV-2 | Una risposta con `StatusCode` diverso da `urn:oasis:names:tc:SAML:2.0:status:Success` viene rifiutata. | `SIXTEEN-SPID-INV-2` |
| SIXTEEN-SPID-INV-3 | Il certificato nella firma deve avere la stessa impronta del certificato fidato `storage/certificates/spid/<spid.providers.<p>.cert_file>`; senza `cert_file` configurato la risposta e' rifiutata. | — |
| SIXTEEN-SPID-INV-4 | `RelayState` deve coincidere con `spid.request_id` in sessione (anti-replay/CSRF del flusso). | — |
| SIXTEEN-SPID-INV-5 | Algoritmi di firma accettati: solo RSA-SHA256 e RSA-SHA1; qualunque altro e' rifiutato. | — |
| SIXTEEN-SPID-INV-6 | Il log di un login riuscito contiene i nomi degli attributi, mai i loro valori (codice fiscale, email, telefono: dati personali). | `SIXTEEN-SPID-INV-6` |
=======
| SIXTEEN-SPID-INV-1 | Una risposta senza `ds:Signature` viene rifiutata (`Exception('SPID authentication failed')`), anche con `StatusCode` Success. Se viene violata, chiunque può presentare un codice fiscale arbitrario (incidente SEC-02). | `SIXTEEN-SPID-INV-1` |
| SIXTEEN-SPID-INV-2 | Una risposta con `StatusCode` diverso da `urn:oasis:names:tc:SAML:2.0:status:Success` viene rifiutata, prima di ogni controllo di firma. | `SIXTEEN-SPID-INV-2` |
| SIXTEEN-SPID-INV-3 | L'impronta (SHA-1, default di `openssl_x509_fingerprint`) del certificato nella firma deve coincidere con quella del certificato fidato `storage/certificates/spid/<spid.providers.<p>.cert_file>`; senza `cert_file` configurato o con file mancante o vuoto la risposta è rifiutata. Se viene violata, la firma di un IdP qualunque (o di un attaccante) è accettata. | — (non dimostrato) |
| SIXTEEN-SPID-INV-4 | `RelayState` deve essere non vuoto e coincidere con `spid.request_id` in sessione, altrimenti `Exception('RelayState non valido')`: lega il POST alla sessione che ha iniziato il login (CSRF del flusso). Non è anti-replay: vedi «Limiti noti». | — (non dimostrato) |
| SIXTEEN-SPID-INV-5 | Algoritmi di firma accettati: solo RSA-SHA256 (`xmldsig-more#rsa-sha256`) e RSA-SHA1 (`xmldsig#rsa-sha1`); qualunque altro è rifiutato, e la firma sul `SignedInfo` canonicalizzato (C14N) deve verificarsi con la chiave del certificato fidato. | — (non dimostrato) |
| SIXTEEN-SPID-INV-6 | Il log di un login riuscito (`Log::info('SPID authentication successful')`) contiene i nomi degli attributi, mai i loro valori (codice fiscale, email, telefono: dati personali). Vale per l'Action, non per il controller (vedi «Limiti noti»). | `SIXTEEN-SPID-INV-6` |

SIXTEEN-SPID-INV-1, -2 e -6 sono provate senza app (`tests/Unit/AuthAndAssetActionContractsTest.php`); INV-6 è un controllo sul
sorgente (`'attribute_names' => array_keys(` presente, nessun `'user_attributes' =>` in `Log::info`). INV-3, -4 e -5 non hanno
un test: servirebbe una risposta SAML firmata di prova e una sessione.
>>>>>>> .merge_file_bSq8zW

## Effetti collaterali

- Sessione: `getLoginUrl` scrive `spid.request_id`, `spid.provider`, `spid.return_url`, `spid.auth_level`;
<<<<<<< .merge_file_ER3QxU
  `getLogoutUrl` scrive `spid.logout_request_id`; `logout()` cancella le chiavi `spid.*` di autenticazione.
- Log: `processCallback` scrive `Log::info('SPID authentication successful')` con il provider e i **soli nomi** degli
  attributi ricevuti (`attribute_names`), mai i valori (SIXTEEN-SPID-INV-6).
- Lettura file: il certificato fidato da `storage_path('certificates/spid/...')`.
=======
  `getLogoutUrl` scrive `spid.logout_request_id`; `logout()` cancella `spid.authenticated`, `spid.user_data`, `spid.provider`,
  `spid.request_id`, `spid.auth_level` (non `spid.return_url` né `spid.logout_request_id`).
- Lettura file: in `processCallback`, il certificato fidato da `storage_path('certificates/spid/...')`.
- Log: `processCallback` scrive `Log::info('SPID authentication successful')` con il provider e i **soli nomi** degli
  attributi ricevuti (`attribute_names`), mai i valori (SIXTEEN-SPID-INV-6).
>>>>>>> .merge_file_bSq8zW
- Nessuna chiamata HTTP: il browser va all'IdP tramite redirect.

## Errori

<<<<<<< .merge_file_ER3QxU
- `InvalidArgumentException` per provider non configurato.
- `Exception('SAMLResponse mancante' | 'RelayState non valido' | 'SAMLResponse non decodificabile')`.
- `Exception('SPID authentication failed')` per ogni violazione di firma, certificato o stato (messaggio unico voluto: non
  dice all'attaccante quale controllo ha fallito).
=======
- `InvalidArgumentException` per provider non configurato (`getLoginUrl`, `getLogoutUrl`).
- `Exception('SAMLResponse mancante' | 'RelayState non valido' | 'SAMLResponse non decodificabile')` da `processCallback`
  (INV-4 per il secondo).
- `Exception('SPID authentication failed')` per ogni violazione di stato, firma, certificato o algoritmo (INV-1, -2, -3, -5):
  messaggio unico voluto, non dice all'attaccante quale controllo ha fallito.
>>>>>>> .merge_file_bSq8zW

## Non fa

- Non autentica l'utente in Laravel e non crea l'utente: lo fa il controller con `Auth::login()` e
  `Modules\User\Actions\Auth\UpsertUserFromDigitalIdentityAction`; il controller scrive anche `spid.authenticated`.
- Non valida l'URL di ritorno: lo fa `SanitizeReturnUrlAction` nel controller ([contratto](sanitize-return-url-action.md)).
<<<<<<< .merge_file_ER3QxU
- Non firma le `AuthnRequest` (i metadata dichiarano `AuthnRequestsSigned="true"`: debito verso le regole tecniche AgID).
- Non controlla `NotOnOrAfter`/`Audience` dell'asserzione: non aggiungerli "per completezza" qui senza un test; il posto
  giusto e' una libreria SAML dedicata (decisione aperta).
=======
- Non firma le `AuthnRequest` (i metadata dichiarano `AuthnRequestsSigned="true"` a `SpidAuthAction.php:145`: debito verso le
  regole tecniche AgID).
- Non controlla `NotOnOrAfter`, `Audience`, `InResponseTo`, `Destination` né `Issuer` dell'asserzione: non aggiungerli «per
  completezza» qui senza un test; il posto giusto è una libreria SAML dedicata (decisione aperta, [ADR](../adr/0003-digital-identity-routes-off-by-default.md)).

## Limiti noti

- Limite noto (sicurezza, da leggere prima di abilitare SPID): `validateSamlResponse` (`SpidAuthAction.php:332-395`) verifica la
  firma sul `SignedInfo` (`openssl_verify` a riga 387) ma non legge né ricalcola `ds:Reference` / `ds:DigestValue` (nessuna
  occorrenza di `Digest` o `Reference` nel file), e `extractUserAttributes` legge `//saml:Attribute` ovunque nel documento
  (riga 407). Quindi la firma non è legata agli attributi letti: da lettura del codice, un `SignedInfo` + `SignatureValue` +
  certificato validi, copiati da una risposta autentica, accompagnerebbero un'asserzione con attributi diversi. Non provato con
  una risposta forgiata (nessuna è stata costruita in questa passata); è il motivo per cui INV-1 non basta come garanzia di
  autenticità.
- Limite noto: `spid.request_id` non viene consumato dopo un login riuscito (`processCallback` non ha `Session::forget`; il
  controller fa solo `Session::pull('spid.return_url')`, `SpidAuthController.php:105`): `RelayState` resta valido fino a `logout()`.
  Inoltre `RelayState` arriva nello stesso POST controllato da chi invia la risposta e `InResponseTo` non si confronta.
- Limite noto: INV-6 vale per l'Action; `SpidAuthController.php:101` scrive `fiscal_code` in `Log::info('SPID authentication
  completed')` e `SpidAuthController.php:113` scrive `$request->all()` (compresa la `SAMLResponse`) in `Log::error` a ogni
  fallimento. Il test di INV-6 non legge i controller.
- Limite noto: il controller mostra al cittadino `$e->getMessage()` (`SpidAuthController.php:121`): i messaggi `SAMLResponse
  mancante` e `RelayState non valido` rivelano quale controllo è fallito, contro l'intento del messaggio unico.
- Limite noto: l'algoritmo RSA-SHA1 resta accettato (INV-5) e l'impronta del certificato è SHA-1.
- Limite noto: il ritorno di `DOMDocument::loadXML` non è controllato (`SpidAuthAction.php:124`).
>>>>>>> .merge_file_bSq8zW
