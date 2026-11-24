---
title: "Issue #77: audit del bridge legacy ticket-crea"
type: story
status: audit
module: Sixteen
created: 2026-11-23
updated: 2026-11-23
issues:
  - "https://github.com/laraxot/base_fixcity_fila5/issues/77"
discussions:
  - "https://github.com/laraxot/base_fixcity_fila5/discussions/133"
tags: [bmad, sixteen, cms, legacy, ticket-create]
qmd: "issue 77 audit bridge legacy ticket-crea CMS payload tenant"
---

# Issue #77: audit del bridge legacy `ticket-crea`

## Esito

Il blocco `resources/views/components/blocks/tests/ticket-crea.blade.php` non
risulta usato dalle copie JSON CMS presenti nel repository. Le tre copie
verificate usano direttamente:

```text
pub_theme::components.blocks.ticket-create.design-comuni
```

Il bridge è però ancora necessario come compatibilità prudenziale: il file è
stato introdotto come alias per payload tenant già persistiti e una scansione
del repository non può dimostrare che tali payload non esistano in database o
in configurazioni esterne/versionate altrove.

## Evidenze

- `laravel/config/local/fixcity/database/content/pages/tickets/create.json`
  punta alla vista canonica in tutte le quattro lingue.
- `laravel/Modules/Fixcity/config/database/content/pages/tickets.create.json`
  punta alla vista canonica in tutte le quattro lingue.
- `laravel/Modules/Fixcity/config/database/content/pages/tickets/create.json`
  punta alla vista canonica in tutte le quattro lingue.
- `Themes/Sixteen/tests/Unit/TicketCreateBlockTest.php` verifica sia il
  contratto canonico dei JSON sia la delega del bridge.
- `Themes/Sixteen/tests/Unit/TestsBlocksContractTest.php` tratta i blocchi
  sotto `components/blocks/tests` come adapter di compatibilità per payload
  legacy.

## Decisione per l'issue

Non eliminare `ticket-crea.blade.php` e non modificare il runtime in questo
passo. La rimozione potrebbe trasformare un payload tenant legacy valido in un
errore di view, mentre non è disponibile una prova completa dei dati CMS
persistiti. Non sono necessari aggiornamenti ai test: gli assertion esistenti
documentano correttamente sia l'uso canonico corrente sia la compatibilità del
bridge.

## Criterio per una futura rimozione

Rimuovere il bridge solo dopo aver verificato, per ogni tenant attivo e per i
payload CMS esportabili, che nessun `data.view` risolva a
`pub_theme::components.blocks.tests.ticket-crea`; quindi aggiornare i test per
asserire l'assenza del riferimento legacy e verificare il percorso
`/tickets/create` con il CMS effettivo.

