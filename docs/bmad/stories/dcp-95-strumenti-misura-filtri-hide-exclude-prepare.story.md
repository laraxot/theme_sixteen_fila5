---
id: dcp-95
title: "DCP-95: strumenti di misura con filtri (--hide, --exclude, --prepare) e correzione dello sweep"
type: story
epic: dc-parity-v2
status: done
priority: P1
owner: theme:Sixteen
created: 2026-10-13
updated: 2026-10-13
qmd: "parity gate hide exclude prepare hide-ref exclude-local screenshot html filtri misura non standard sweep index"
related: [dcp-33]
tags: [docs, sixteen, bmad]
---

# DCP-95: misurare il wizard senza barare in silenzio

## Cosa e' stato fatto (agente `dcp33-tools`, riletto dall'orchestratore)
- `compare-screenshots.mjs`: `--hide`, `--hide-ref`, `--prepare` (solo locale, ordine: prepare, click, hide, scatto). Il report stampa sempre selettori, elementi trovati e visibili, altezza prima e dopo, il testo del JS e un `AVVISO` per 0 match o nessun elemento visibile.
- `compare-body-html.mjs`: `--exclude`, `--exclude-local` (jsdom, sul DOM del server): riga `excluded=ref{..} local{..}` separata; la prima riga resta invariata per chi la parsa.
- `parity-gate.sh` inoltra le opzioni e stampa `MISURA CON FILTRI` con i filtri usati.
- Regressione: gate senza opzioni identico prima e dopo (HTML 87,42 / 97,77; pixel 99,93 / 99,9 / 99,86 / 99,83 / 99,72 su `segnalazione-03-riepilogo`).
- `parity-sweep.sh` (orchestratore): `servizi/index.html` -> `servizi-index` (un `index` in una cartella e' `<cartella>-index`).
- Documenti: `bashscripts/docs/visual-comparison/{parity-gate,screenshot-parity,body-html-parity}.md` e INDEX.

## Regola
Ogni misura con `--hide/--exclude/--prepare` si riporta dichiarando il filtro: non e' il gate standard. Selettori verificati sul DOM reale del wizard: mappa `.coordinate-picker-field-wrapper` (e `[data-dc-map]` dalla vista nuova); passi inattivi per l'HTML: `--exclude-local '.fi-sc-wizard-step:not([id="form.riepilogo::data::wizard-step"])'` (la classe `fi-active` la mette Alpine).

## Limiti
`--exclude` lavora sul DOM del server (senza JS); `--hide` non nasconde gli elementi creati dopo; `parity-wizard-steps.sh` non mostra i filtri nella tabella (stanno nei `passoN.txt`).
