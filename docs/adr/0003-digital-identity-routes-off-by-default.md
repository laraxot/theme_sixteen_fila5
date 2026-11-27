---
title: "ADR — Le rotte SPID e CIE del tema sono spente finche' non si abilitano esplicitamente"
type: decision
status: accepted
theme: Sixteen
created: 2026-11-24
updated: 2026-11-26
decision-makers: [team front office]
related:
  - ../contracts/spid-auth-action.md
  - ../contracts/cie-auth-action.md
  - ../../app/Providers/ThemeServiceProvider.php
  - ../../routes/auth.php
---

# ADR: identità digitale (SPID/CIE) disattivata di default

## Contesto

`routes/auth.php` registra login, callback, SLO e metadata SPID e CIE (nomi `spid.*`, `cie.*`), implementati in
`app/Actions/SpidAuthAction.php` e `app/Actions/CieAuthAction.php`: codice scritto a mano, senza libreria SAML/OIDC.
L'incidente SEC-02 (commento in `tests/Feature/Infrastructure/DigitalIdentityRoutesDisabledByDefaultTest.php`): il callback
SPID accettava una `SAMLResponse` senza verificarne la firma, quindi chiunque poteva autenticarsi con un codice fiscale
arbitrario. Un ente che usa il tema senza essere accreditato come Service Provider SPID/CIE non ha certificati né metadati
registrati: le rotte esposte sono solo superficie d'attacco. Le rotte di identità digitale devono esistere di default?

## Driver della decisione

- Un'installazione nuova deve essere sicura per costruzione, senza un passo di hardening da ricordare.
- L'identità digitale richiede certificati, metadati e accreditamento: senza, le rotte non possono funzionare.
- L'incidente SEC-02 ha mostrato che il codice scritto a mano può avere falle di verifica della firma.
- Il login con SPID/CIE è richiesto dai servizi online degli enti accreditati: il codice deve restare disponibile.

## Alternative scartate

- **Rotte sempre attive, pulsanti nascosti in UI**: la superficie d'attacco resta raggiungibile via URL diretto.
- **Rimuovere SPID/CIE dal tema**: il login con identità digitale è richiesto dai servizi online degli enti; il codice serve
  quando l'ente è accreditato.
- **Libreria SAML/OIDC esterna** (es. `onelogin/php-saml`): più solida, ma è una nuova dipendenza da approvare (decisione
  umana, vedi `AGENTS.md`); resta la strada da preferire se si riattiva SPID in produzione.

## Decisione

- `ThemeServiceProvider::registerAuthRoutes()` (`app/Providers/ThemeServiceProvider.php:263`) carica `routes/auth.php` solo se
  `ThemeServiceProvider::digitalIdentityRoutesEnabled()` (riga 324) è vero, cioè `config('sixteen.auth.spid.enabled') === true`
  (env `SIXTEEN_SPID_ENABLED`, default `false` in `config/sixteen.php:153`). Solo il booleano `true` abilita: la stringa
  `'true'` no.
- Anche abilitate, le risposte si accettano solo con firma verificata contro un certificato fidato (SPID) o JWKS configurato
  (CIE): vedi i contratti [SpidAuthAction](../contracts/spid-auth-action.md) e [CieAuthAction](../contracts/cie-auth-action.md).

## Conseguenze

- Buono: installazione nuova sicura per costruzione; il test sui nomi delle rotte rende visibile ogni regressione.
- Cattivo: attivare SPID richiede env, certificati in `storage/certificates/spid/` e `spid.providers.<p>.cert_file`.
- Cattivo: la decisione protegge l'esposizione, non la correttezza del codice: se qualcuno imposta
  `SIXTEEN_SPID_ENABLED=true`, valgono i limiti dei contratti (AuthnRequest non firmate, `NotOnOrAfter`/`Audience`/digest
  non controllati: vedi «Limiti noti» in `spid-auth-action.md`).

## Stato attuale

- Il «debito» della versione del 2026-11-24 includeva «attributi utente scritti nei log». Per le due Action non è più vero:
  `SpidAuthAction.php:130-134` e `CieAuthAction.php:116-120` registrano solo `attribute_names`. Resta vero nei controller:
  `app/Http/Controllers/SpidAuthController.php:101` e `CieAuthController.php:137` scrivono `fiscal_code` in `Log::info`, e
  `SpidAuthController.php:113` / `CieAuthController.php:149` scrivono `$request->all()` (la `SAMLResponse` intera) in
  `Log::error` quando il callback fallisce. Il test sui log (group `SIXTEEN-SPID-INV-6`) legge solo le Action.
- `routes/auth.php` espone anche `cie.debug` e `cie.status`; `CieAuthController::debug` (riga 298-300) risponde solo con
  `app.debug` attivo e ambiente `local` o `development`.
- Il rifiuto di una `SAMLResponse` priva di firma è provato (`SIXTEEN-SPID-INV-1`); la verifica del digest del `Reference` non
  esiste nel codice (nessuna occorrenza di `Digest` o `Reference` in `SpidAuthAction.php`): con l'identità digitale accesa
  la firma controlla `SignedInfo`, non il contenuto dell'asserzione. Dettaglio e riferimenti nel contratto SPID.

## Conferma

- `cd laravel && vendor/bin/pest Themes/Sixteen/tests/Feature/Infrastructure/DigitalIdentityRoutesDisabledByDefaultTest.php`:
  nessuna rotta `spid.*`/`cie.*` con l'identità digitale spenta, e solo `true` booleano la accende (richiede il boot
  dell'app; salta se `SIXTEEN_SPID_ENABLED=true`).
- `cd laravel && vendor/bin/pest Themes/Sixteen/tests/Unit --group=SIXTEEN-SPID-INV-1 --group=SIXTEEN-SPID-INV-2`: una risposta
  senza firma o con stato diverso da Success è rifiutata (senza app).
- `Themes/Sixteen/tests/Unit/DigitalIdentityAuthenticationSecurityTest.php`: un JWT CIE con `alg: none` è rifiutato prima di
  leggere i claim (richiede il boot dell'app).
- Review: ogni PR che abilita `SIXTEEN_SPID_ENABLED` in un ambiente reale deve citare i limiti noti dei due contratti.
