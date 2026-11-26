---
title: "ADR — Gli attributi data-* si chiamano col ruolo dell'elemento, mai col nome del tema"
type: decision
status: accepted
theme: Sixteen
created: 2026-11-24
updated: 2026-11-24
related:
  - ../data-attribute-rule.md
  - design-comuni-html-parity.md
---

# ADR: `data-*` per ruolo, non per proprietario

## Contesto

- Fino al 2026-10-29 il menu mobile usava `data-sixteen-mobile-nav*` e `resources/js/app.js` scriveva
  `data-sixteen-alpine-components` su `<html>`: un prefisso "ordinato" per evitare collisioni.
- Il riferimento Design Comuni (33 pagine) usa 12 nomi `data-*` in tutto (`data-element`, `data-bs-*`, `data-step`, …)
  e **nessuno** porta il nome di un tema o di un progetto (inventario e comando di rigenerazione in
  [data-attribute-rule](../data-attribute-rule.md)).
- Con la [parita' HTML](design-comuni-html-parity.md), un attributo che il riferimento non ha e' gia' una differenza.
- Domanda: che nome dare a un aggancio per JS, test o analytics?

## Decisione

Scala di scelta, ci si ferma al primo gradino che basta:

1. l'aggancio che il riferimento ha gia' (classe, `id`, `data-bs-*`): il renderer canonico `sections/header/v1` vive solo di questi;
2. `data-element="<ruolo>"`, il pattern nativo del riferimento;
3. `data-<comportamento>` generico (`data-mobile-nav`, `data-mobile-nav-toggle`);
4. stato solo runtime con `dataset`, mai nell'HTML renderizzato dal server.

Vietati `data-sixteen-*`, `data-<modulo>-*`, `data-<progetto>-*`, in Blade, JS (`dataset.*`, `getAttribute`) e CSS.

## Alternative scartate

- **Prefisso del tema** (`data-sixteen-*`): evita collisioni che nel riferimento non esistono e introduce drift in ogni pagina.
- **Prefisso del modulo che possiede il componente**: il nome descrive chi ospita, non cosa fa l'elemento; cambia se il
  componente si sposta di modulo.
- **Solo classi CSS come aggancio JS**: accoppia stile e comportamento; resta ammesso solo quando la classe e' del riferimento.

## Conseguenze

- Pro: markup confrontabile col riferimento; gli agganci sopravvivono a spostamenti tra temi e moduli.
- Contro: i nomi generici possono collidere tra componenti diversi: chi aggiunge un `data-<comportamento>` cerca prima nel
  riferimento e nel tema.
- Debito: i bundle in `public/assets/` vanno ricostruiti (`npm run build`) perche' il JS servito rispecchi la rinomina;
  tre varianti legacy di header portano `data-mobile-nav-target` dove il riferimento ha `data-bs-target`.

## Verifica

`Themes/Sixteen/tests/Unit/DataAttributeParityContractTest.php` (sorgente, gira senza app:
`vendor/bin/pest Themes/Sixteen/tests/Unit/DataAttributeParityContractTest.php`) fallisce se un Blade, JS o CSS del tema
scrive un `data-*` col nome del tema, di un tema fratello o del progetto.
