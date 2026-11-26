---
title: "ADR — Gli attributi data-* si chiamano col ruolo dell'elemento, mai col nome del tema"
type: decision
status: accepted
theme: Sixteen
created: 2026-11-24
updated: 2026-11-26
decision-makers: [team front office]
related:
  - ../data-attribute-rule.md
  - design-comuni-html-parity.md
---

# ADR: `data-*` per ruolo, non per proprietario

## Contesto

Fino al 2026-10-29 il menu mobile usava `data-sixteen-mobile-nav*` e `resources/js/app.js` scriveva
`data-sixteen-alpine-components` su `<html>`: un prefisso «ordinato» per evitare collisioni. Il riferimento Design Comuni
(33 pagine) usa 12 nomi `data-*` in tutto (`data-element`, `data-bs-*`, `data-step`, ...) e **nessuno** porta il nome di un
tema o di un progetto (inventario e comando di rigenerazione in [data-attribute-rule](../data-attribute-rule.md)). Con la
[parità HTML](design-comuni-html-parity.md), un attributo che il riferimento non ha è già una differenza. Che nome dare a un
aggancio per JS, test o analytics?

## Driver della decisione

- Il markup deve restare confrontabile col riferimento: ogni attributo in più è drift.
- Gli agganci devono sopravvivere agli spostamenti di un componente tra temi e moduli.
- Un test o uno strumento di analytics deve poter cercare un ruolo (`data-element`) senza conoscere il tema che ospita
  l'elemento.
- Il nome di un tema o di un progetto nel markup rende il tema non riusabile da un altro ente.

## Alternative scartate

- **Prefisso del tema** (`data-sixteen-*`): evita collisioni che nel riferimento non esistono e introduce drift in ogni pagina.
- **Prefisso del modulo che possiede il componente**: il nome descrive chi ospita, non cosa fa l'elemento; cambia se il
  componente si sposta di modulo.
- **Solo classi CSS come aggancio JS**: accoppia stile e comportamento; resta ammesso solo quando la classe è del riferimento.

## Decisione

Scala di scelta, ci si ferma al primo gradino che basta:

1. l'aggancio che il riferimento ha già (classe, `id`, `data-bs-*`): il renderer canonico `sections/header/v1` vive solo di questi;
2. `data-element="<ruolo>"`, il pattern nativo del riferimento;
3. `data-<comportamento>` generico (`data-mobile-nav`, `data-mobile-nav-toggle`);
4. stato solo runtime con `dataset`, mai nell'HTML renderizzato dal server.

Vietati `data-sixteen-*`, `data-<modulo>-*`, `data-<progetto>-*`, in Blade, JS (`dataset.*`, `getAttribute`) e CSS.

## Conseguenze

- Buono: markup confrontabile col riferimento; gli agganci sopravvivono a spostamenti tra temi e moduli.
- Cattivo: i nomi generici possono collidere tra componenti diversi: chi aggiunge un `data-<comportamento>` cerca prima nel
  riferimento e nel tema.
- Cattivo: la guardia automatica non copre tutto il divieto (vedi «Stato attuale»).

## Stato attuale

- Il «debito» della versione del 2026-11-24 non c'è più: `rg -n "data-mobile-nav" laravel/Themes/Sixteen/resources/views`
  non trova nessuna Blade che emetta `data-mobile-nav*` (restano i selettori opzionali in
  `resources/js/theme/header-mobile-nav.js:6-41` e in due CSS), e `rg -l "data-sixteen" laravel/Themes/Sixteen/public` non trova
  nulla: i bundle serviti sono stati ricostruiti.
- La guardia scrive `data-(sixteen|two|fixcity|techplanner)` e `dataset.(sixteen|fixcity|techplanner)`
  (`tests/Unit/DataAttributeParityContractTest.php:51`): un `data-<modulo>-*` (per esempio `data-geo-*`) non è intercettato,
  anche se questo ADR lo vieta. Nessuna conferma automatica per quel caso.

## Conferma

- `cd laravel && vendor/bin/pest Themes/Sixteen/tests/Unit/DataAttributeParityContractTest.php` (sorgente, senza app): il
  primo test fallisce se un Blade, JS o CSS di `resources/` scrive un `data-*` col nome del tema, di un tema fratello o del
  progetto; il secondo fallisce se una Blade emette un `data-mobile-nav*` che nessun JS o CSS legge.
- Per il divieto sui nomi di modulo, comando di review da `laravel/`:
  `rg -n "data-(geo|fixcity|cms|user|ticket)[a-z-]*=" Themes/Sixteen/resources/views`. Nessun test automatico oggi; proposta:
  estendere l'espressione regolare del test ai nomi di `Modules/*`.
