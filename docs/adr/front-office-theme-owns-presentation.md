---
title: "ADR — Sixteen possiede la presentazione, non la risoluzione delle pagine"
type: decision
status: accepted
theme: Sixteen
updated: 2026-11-23
issues:
  - "https://github.com/laraxot/theme_sixteen_fila5/issues/104"
---

# Sixteen possiede presentazione e chrome del front office

## Contesto

Sixteen è il tema front office attivo e deve mantenere coerenza con Design Comuni senza assorbire logica di dominio.

## Decisione

Sixteen possiede shell, navigazione, accessibilità e viste dei blocchi; CMS, User e moduli di dominio possiedono dati, routing e autorizzazioni.

Per l’editorial Design Comuni il tema mantiene una sola implementazione
riusabile per ogni pattern visuale: i blocchi ricevono dati dal CMS o da un
contratto di presentazione, mentre etichette, URL e stati specifici restano nei
dati. Non si duplicano viste equivalenti per ottenere una parità apparente.

Le pagine Folio `[container0]`, `[container0]/[slug0]` e
`[container0]/[slug0]/[container1]` sono shell Volt lineari: ricevono i parametri
in `mount()`, costruiscono il data bag e delegano a `<x-page>`. Non eseguono query,
resolver, redirect, metadata o rami speciali nella Blade.

Le pagine Folio dinamiche `pages/[container0]/index.blade.php`,
`pages/[container0]/[slug0]/index.blade.php` e
`pages/[container0]/[slug0]/[container1]/index.blade.php` e
`pages/[container0]/[slug0]/[container1]/[slug1]/index.blade.php` sono quindi shell
lineari: `mount()` traduce i parametri del percorso nel data bag, mentre
`<x-page>` delega al CMS il rendering dei blocchi.

## Driver della decisione

- Mantenere coerenza Design Comuni e confini di ownership.

## Alternative scartate

- Implementare ruoli e query sensibili nelle Blade.
- Creare pagine semantiche duplicate fuori dalla struttura Folio prevista.
- Usare `render()`, query CMS, `@php` o `@include` condizionali nelle shell
  Folio per correggere una pagina speciale.

## Conseguenze

Il tema resta sostituibile e coerente; ogni modifica deve rispettare middleware pagina, contenuti CMS e policy owner.
Le funzionalità speciali devono essere espresse da blocchi JSON CMS, Action o
route/middleware del modulo owner. Una shell più corta non autorizza a perdere
un comportamento: prima si trasferisce la responsabilità al proprietario
corretto e poi si rimuove la duplicazione dalla Blade.

La parità Design Comuni viene dichiarata solo per pagine e stati presenti nel
repository. Un audit può usare markup, test, dati JSON e riferimenti pubblici
verificabili; non introduce screenshot, fixture o pagine locali non presenti.
Il wizard di segnalazione segue lo stesso criterio: passi condivisi e componenti
riusabili nel tema, contenuti e destinazioni nei JSON CMS, logica di dominio nei
moduli owner.

Per i dettagli dinamici, Sixteen riceve dal data bag l'identificativo applicativo
e renderizza il blocco generico del tema. Non interpreta l'ID come slug CMS e non
decide la visibilità del record: `PageSlugMiddleware`/CMS risolvono il
contenitore, mentre l'Action del modulo owner prepara i dati pubblicabili.
Per il dettaglio pubblico del ticket la catena verificata è
`Folio shell → PageSlugMiddleware → <x-page> → tickets.view →
ticket-detail → BuildPublicTicketDetailAction`; il tema possiede soltanto
shell e markup Design Comuni.

## Conferma

Verificare pagina reale, CMS JSON, middleware e policy del modulo owner.
Il contratto operativo è [folio-page-shell.md](../contracts/folio-page-shell.md).
