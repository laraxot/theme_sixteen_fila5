---
id: dcp-14
title: "DCP-14: pagina a caso del riferimento, appuntamento-02-data-orario (passo 2 della prenotazione)"
type: story
epic: dc-parity-v2
status: done
priority: P1
owner: theme:Sixteen
created: 2026-10-13
updated: 2026-10-13
qmd: "design comuni parity appuntamento 02 data orario stepper navscroll accordion radio bmad story"
tags: [docs, sixteen, bmad]
---

# DCP-14: appuntamento-02-data-orario

## Richiesta
L'utente ha chiesto di prendere una pagina a caso di `https://italia.github.io/design-comuni-pagine-statiche/` e di crearla/migliorarla, con BMAD e second brain.
Estrazione casuale (Python `random.choice` sulle 33 pagine `sito/` non gia' fatte): **`sito/appuntamento-02-data-orario.html`**, secondo passo della prenotazione di un appuntamento.

## Baseline (misurata, prima di toccare nulla)
Pagina locale vuota (HTTP 200 senza blocchi): HTML body 58,95% (solo il chrome), pixel 10,7 / 11,3 / 11,8 / 9,0 / 11,9% a 1920 / 1440 / 992 / 768 / 375 px, altezze 997 contro 2486.

## Cosa e' stato fatto (metodo di `docs/wiki/concepts/design-comuni-parity-method.md`)
1. Contratti gia' letti (pagina = JSON + blocco, `<body>` plain, scope sul wrapper canonico).
2. JSON `tests.appuntamento-02-data-orario.json` (tenant e modulo): titolo, breadcrumb, 5 passi dello stepper, navigazione laterale, sezioni (`appointments`, `office-summary`), pulsanti, contatti.
3. Blocco `components/blocks/appointment-step/design-comuni.blade.php`: struttura del riferimento da JSON; le sezioni si scelgono per `type` (un nuovo tipo = un nuovo `@case`), pensato per i passi fratelli `appuntamento-01/03/04/05/06`. Contatti: partial `dc-contacts` condiviso (ora salta i gruppi vuoti).
4. CSS: aggiunta la pagina a `scripts/regenerate-design-comuni-css.sh` (con gli stati `accordion` e `radio`); nessun CSS scritto a mano.
5. Comportamenti (Alpine, montati per selettore, markup identico al riferimento): `dcNavscroll` (link attivo + barra di avanzamento, formula letta dal riferimento: padding 10 px, progresso = |top contenitore| / altezza); `initFocusMouse` (classe `focus--mouse` / `data-focus-mouse` che nascondono l'anello di focus dopo un clic con il mouse: serve a TUTTE le pagine /tests). L'accordion usa il controller `collapse` del tema.

## Risultato (misurato con `bashscripts/tools/visual/parity-gate.sh`)
- **Visual 99,86 / 99,81 / 99,74 / 99,74-99,84 / 99,78%** a 1920 / 1440 / 992 / 768 / 375 px, altezze identiche (2486, 2574, 2706, 3569). Una misura a 1440 e' oscillata a 98,0-98,45% (posizione dell'elemento sticky nello screenshot a pagina intera), sempre sopra 97.
- **HTML body rigoroso 87,53%; con i valori degli URL normalizzati 97,74%.** La differenza e' tutta nei valori di `href`/`src`: il riferimento ha `#` e percorsi relativi (`../assets/...sprites.svg#it-x`, `../sito/amministrazione.html`), il nostro sito link reali e URL assoluti degli sprite (36 `<use>` e 32 `<a>` sui ~60 token diversi). **Sotto la soglia del 90% rigorosa per questo motivo**; non e' stato "risolto" con trucchi sui dati.
- Comportamenti con i pixel dopo il clic: Avanti con scroll (scroll-spy + barra) 99,02%; accordion chiuso 100%; radio scelto 97,9% a 1440 e 100% a 375; menu mobile aperto 99,69%.
- Sentinelle: `/it` identica (0,000% pixel diversi), `/it/tickets` invariata (chrome vecchio), homepage e risultati-ricerca invariate.

## Differenze note e aperte
- Header: nel riferimento la voce "Servizi" e' `active` e il link del brand ha `title="Vai alla homepage"`: lo stato "voce attiva" dipende dalla pagina, il JSON dell'header e' condiviso. Da modellare (voce attiva per sezione) quando si replicano altre pagine.
- Il passo 1/3/4/5/6 della prenotazione e i loro form: stessi componenti, nuove sezioni `@case` (DCP-10).

## Come si controlla
```bash
bashscripts/tools/visual/parity-gate.sh https://italia.github.io/design-comuni-pagine-statiche/sito/appuntamento-02-data-orario.html \
  http://192.168.1.40:8000/it/tests/appuntamento-02-data-orario --stub-images 'picsum\.photos' --fail-if-contains '|---LINE:'
```
