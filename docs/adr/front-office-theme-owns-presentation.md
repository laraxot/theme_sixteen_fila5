---
status: accepted
theme: Sixteen
---

# Sixteen possiede presentazione e chrome del front office

## Contesto

Sixteen è il tema front office attivo e deve mantenere coerenza con Design Comuni senza assorbire logica di dominio.

## Decisione

Sixteen possiede shell, navigazione, accessibilità e viste dei blocchi; CMS, User e moduli di dominio possiedono dati, routing e autorizzazioni.

## Driver della decisione

- Mantenere coerenza Design Comuni e confini di ownership.

## Alternative scartate

- Implementare ruoli e query sensibili nelle Blade.
- Creare pagine semantiche duplicate fuori dalla struttura Folio prevista.

## Conseguenze

Il tema resta sostituibile e coerente; ogni modifica deve rispettare middleware pagina, contenuti CMS e policy owner.

## Conferma

Verificare pagina reale, CMS JSON, middleware e policy del modulo owner.
