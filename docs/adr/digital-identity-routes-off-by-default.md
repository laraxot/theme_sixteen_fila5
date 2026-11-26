---
title: "ADR — Le rotte SPID e CIE del tema sono spente finche' non si abilitano esplicitamente"
type: decision
status: accepted
theme: Sixteen
created: 2026-11-24
updated: 2026-11-24
related:
  - ../contracts/spid-auth-action.md
  - ../contracts/cie-auth-action.md
  - ../../app/Providers/ThemeServiceProvider.php
  - ../../routes/auth.php
---

# ADR: identita' digitale (SPID/CIE) disattivata di default

## Contesto

- `routes/auth.php` registra login, callback, SLO e metadata SPID e CIE (`spid.*`, `cie.*`), implementati in
  `app/Actions/SpidAuthAction.php` e `app/Actions/CieAuthAction.php`, codice scritto a mano (nessuna libreria SAML/OIDC).
- Incidente SEC-02 (commento in `tests/Feature/Infrastructure/DigitalIdentityRoutesDisabledByDefaultTest.php`): il callback
  SPID accettava una `SAMLResponse` senza verificarne la firma, quindi chiunque poteva autenticarsi con un codice fiscale
  arbitrario. Allo stesso modo il callback CIE leggeva i claim di un JWT non verificato.
- Un ente che usa il tema senza essere accreditato come Service Provider SPID/CIE non ha certificati ne' metadati
  registrati: le rotte esposte sono solo superficie d'attacco.
- Domanda: le rotte di identita' digitale devono esistere di default?

## Decisione

- `ThemeServiceProvider::registerAuthRoutes()` carica `routes/auth.php` solo se
  `ThemeServiceProvider::digitalIdentityRoutesEnabled()` e' vero, cioe' `config('sixteen.auth.spid.enabled') === true`
  (env `SIXTEEN_SPID_ENABLED`, default `false` in `config/sixteen.php`). Solo il booleano `true` abilita: la stringa
  `'true'` no.
- Anche abilitate, le risposte si accettano solo con firma verificata contro un certificato fidato (SPID) o JWKS
  configurato (CIE): vedi i contratti [SpidAuthAction](../contracts/spid-auth-action.md) e
  [CieAuthAction](../contracts/cie-auth-action.md).

## Alternative scartate

- **Rotte sempre attive, pulsanti nascosti in UI**: la superficie d'attacco resta raggiungibile via URL diretto.
- **Rimuovere SPID/CIE dal tema**: il login con identita' digitale e' richiesto per i servizi online degli enti; il codice
  serve quando l'ente e' accreditato.
- **Libreria SAML/OIDC esterna** (es. `onelogin/php-saml`): piu' solida, ma e' una nuova dipendenza da approvare; resta
  la strada da preferire se si riattiva SPID in produzione.

## Conseguenze

- Pro: installazione nuova sicura per costruzione; il test sui nomi delle rotte rende visibile ogni regressione.
- Contro: attivare SPID richiede env, certificati in `storage/certificates/spid/` e `spid.providers.<p>.cert_file`.
- Debito: le `AuthnRequest` non sono firmate, `NotOnOrAfter`/`Audience` non controllati, attributi utente scritti nei log
  (vedi «Non fa» ed «Effetti collaterali» dei contratti).

## Verifica

- `Themes/Sixteen/tests/Feature/Infrastructure/DigitalIdentityRoutesDisabledByDefaultTest.php`: nessuna rotta `spid.*`/`cie.*`
  con l'identita' digitale spenta; solo `true` booleano la accende (richiede il boot dell'app).
- `Themes/Sixteen/tests/Unit/AuthAndAssetActionContractsTest.php` (group `SIXTEEN-SPID-INV-1`, `SIXTEEN-SPID-INV-2`,
  senza app) e `Themes/Sixteen/tests/Unit/DigitalIdentityAuthenticationSecurityTest.php` (JWT `alg: none` rifiutato).
