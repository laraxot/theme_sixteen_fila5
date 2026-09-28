---
title: "Sixteen visual contract — public ticket listing"
type: ux-spec
status: active
module: Sixteen
created: 2026-09-27
updated: 2026-09-27
tags: [bmad, sixteen, fixcity, visual-contract, public-list, responsive]
qmd: "Sixteen public ticket listing visual contract responsive locale css Vite"
issues:
  - "https://github.com/laraxot/base_fixcity_fila5/issues/383"
discussions:
  - "https://github.com/laraxot/base_fixcity_fila5/discussions/392"
related:
  - ../../Modules/Fixcity/docs/bmad/public-ticket-listing-experience.md
---

# Sixteen visual contract — elenco pubblico

Sixteen possiede il layout, il chrome, la navigazione e le componenti visive; il
modulo Fixcity possiede policy, dati, stati e flusso del ticket. La schermata deve
applicare lo stile compilato dal manifest Vite e funzionare senza un dev server
attivo: i riferimenti di sviluppo sono validi solo mentre `php artisan dev` tiene
in esecuzione Vite.

## Composizione richiesta

- Header con marchio FixCity o identità tenant configurata, lingua e navigazione
  coerenti con la locale corrente.
- Contenuto con titolo, descrizione, CTA, mappa/lista e filtri disposti in una
  gerarchia leggibile; nessun widget vuoto deve occupare la colonna principale.
- Card e controlli con spaziatura, contrasto, focus e target touch adeguati.
- La hero dark conserva contrasto elevato per titoli, descrizioni e CTA anche
  con gli override globali Bootstrap Italia.
- Breadcrumb e navigazione usano chiavi presenti nei cataloghi Sixteen per ogni
  locale; una chiave grezza non è contenuto valido.
- Footer essenziale con rotte reali; i social appaiono solo se configurati.

## Verifica visiva obbligatoria

Con browser guest pulito, acquisire viewport a 320, 390, 768, 1024 e 1440 px in
italiano e inglese. Verificare screenshot, overflow di document/body, risorse CSS
e JS, console, navigazione da header/footer, toggle elenco/mappa e principali CTA.
Le fixture `DEMO-*` devono essere identificabili come sintetiche; non usare dati
personali o recapiti dimostrativi.
