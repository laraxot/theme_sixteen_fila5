---
id: dcp-parity-sweep-2026-10-13
title: "Sweep del gate di parity, ondata 1 (2026-10-13)"
type: report
epic: dc-parity-v2
status: partial
created: 2026-10-13
qmd: "sweep parity gate ondata 1 pagine misurate html pixel altezze design comuni"
updated: 2026-10-13
tags: [docs, sixteen, bmad]
---

# Sweep del gate di parity, ondata 1

Comando: `bashscripts/tools/visual/parity-sweep.sh <manifest> --jobs 3 --out /tmp/dir` (gate `parity-gate.sh` per pagina, 5 larghezze, `--stub-images`, `--fail-if-contains '|---LINE:'`).
Dopo `regenerate-design-comuni-css.sh` (38 pagine) e `npm run build`. Pagine con HTML >= 90% rigoroso: homepage, risultati-ricerca, evento-dettaglio, lista-risorse-categorie, servizi, servizio-dettaglio, index (89,3 al limite).

| Pagina | HTML rigorosa | URL norm. | Pixel (1920 / 1440 / 992 / 768 / 375) |
|---|---:|---:|---|
| `appuntamento-01-ufficio` | 86.9% | 97.59% | 99.87% / 99.83% / 99.76% / 99.8% / 99.73% |
| `appuntamento-01-ufficio-luogo` | 87.93% | 97.79% | 99.91% / 99.88% / 99.83% / 99.86% / 99.79% |
| `appuntamento-02-data-orario` | 87.53% | 97.74% | 99.86% / 99.81% / 99.74% / 99.84% / 99.78% |
| `appuntamento-03-dettagli` | 86.68% | 97.61% | 99.88% / 99.84% / 99.77% / 99.82% / 99.75% |
| `appuntamento-04-richiedente` | 86.45% | 97.59% | 99.89% / 99.8% / 99.8% / 99.82% / 99.74% |
| `appuntamento-04-richiedente-autenticato` | 86.73% | 97.67% | 99.9% / 99.87% / 99.82% / 99.81% / 99.74% |
| `appuntamento-05-riepilogo` | 87.64% | 97.66% | 99.94% / 99.91% / 99.86% / 99.85% / 99.76% |
| `appuntamento-06-conferma` | 88.61% | 97.85% | 99.88% / 99.84% / 99.78% / 99.84% / 99.74% |
| `assistenza-01-dati` | 87.69% | 97.77% | 99.87% / 99.82% / 99.75% / 99.85% / 99.78% |
| `assistenza-02-conferma` | 87.64% | 97.53% | 99.9% / 99.87% / 99.82% / 99.77% / 99.69% |
| `index` | 89.32% | 98.4% | 99.9% / 99.87% / 100% / 99.78% / 100% |
| `lista-categorie` | 89.39% | 97.98% | 99.92% / 99.89% / 99.85% / 99.84% / 99.78% |
| `lista-risorse` | 89.15% | 98.12% | 99.93% / 99.91% / 99.88% / 99.87% / 99.83% |
| `lista-risorse-categorie` | 90.98% | 98.45% | 99.95% / 99.94% / 99.93% / 99.91% / 99.89% |
| `novita` | 88.48% | 98.18% | 99.94% / 99.92% / 99.9% / 99.88% / 99.84% |
| `novita-dettaglio` | 88.71% | 97.93% | 99.89% / 99.86% / 99.81% / 99.77% / 99.63% |
| `servizi` | 90.81% | 98.24% | 99.94% / 99.92% / 99.89% / 99.89% / 99.83% |
| `servizi-categoria` | 89.71% | 98.07% | 99.94% / 99.92% / 99.89% / 99.86% / 99.79% |
| `servizio-dettaglio` | 90.73% | 98.44% | 99.91% / 99.88% / 99.78% / 99.81% / 99.66% |

## Incidenti dello sweep (da non ripetere)
- Misura durante una `npm run build`: gli asset cambiano a meta' del gate. Una sola build alla volta e nessun gate in quel momento (lock `/tmp/design-comuni-build.lock` solo per lo script di rigenerazione).
- Il primo sweep ha dato **88-89% con altezze diverse** su servizi, servizi-categoria e servizio-dettaglio e il marcatore `|---LINE:`: un 500 di un altro agente aveva inquinato la cache delle viste. Dopo `php artisan view:clear` le stesse pagine fanno 99,66-99,94%. Il gate segnala `[MARCATORI]` e la riga delle altezze `DIVERSE`: leggerle sempre.

## Ondata 2 (2026-10-13 pomeriggio): famiglie servizi/ e catalogo dei flussi
Sweep `parity-sweep.sh` (2 job) sulle 37 pagine, CSS rigenerata con 81 pagine, header autenticato attivo sulle `*-area-personale`. Misura dell'orchestratore (non degli agenti). HTML rigorosa / URL normalizzati, pixel minimo tra i 5 viewport, altezze: tutte uguali.

| Pagina | HTML rig. / norm. | Pixel min | Altezze |
|---|---|---|---|
| `/it/tests/consenso-privacy` | 85.73 / 97.49 | 99.61 | uguali |
| `/it/tests/graduatoria-area-personale` | 89.45 / 99.02 | 99.65 | uguali |
| `/it/tests/graduatoria-conferma` | 88.52 / 98 | 99.66 | uguali |
| `/it/tests/graduatoria-dati-personali` | 92.43 / 98.99 | 99.83 | uguali |
| `/it/tests/graduatoria-dati-specifici` | 87.92 / 98.02 | 99.73 | uguali |
| `/it/tests/graduatoria-messaggio` | 87.41 / 98.03 | 99.74 | uguali |
| `/it/tests/graduatoria-perfezionamento` | 86.91 / 97.79 | 99.69 | uguali |
| `/it/tests/graduatoria-riepilogo` | 91.55 / 98.64 | 99.85 | uguali |
| `/it/tests/graduatoria-scheda-servizio` | 90.37 / 98.2 | 99.69 | uguali |
| `/it/tests/pagamenti-imu-anteprima-F24` | 89.57 / 98.31 | 99.79 | uguali |
| `/it/tests/pagamenti-imu-area-personale` | 89.89 / 98.9 | 99.69 | uguali |
| `/it/tests/pagamenti-imu-conferma` | 87.7 / 97.77 | 99.61 | uguali |
| `/it/tests/pagamenti-imu-dati-personali` | 92.71 / 98.99 | 99.74 | uguali |
| `/it/tests/pagamenti-imu-preferenze` | 89.43 / 98.28 | 99.69 | uguali |
| `/it/tests/pagamenti-imu-riepilogo` | 90.31 / 98.43 | 99.81 | uguali |
| `/it/tests/pagamenti-imu-scheda-servizio` | 90.16 / 98.33 | 99.77 | uguali |
| `/it/tests/pagamenti-multa-area-personale` | 90.2 / 98.93 | 99.69 | uguali |
| `/it/tests/pagamenti-multa-conferma` | 87.84 / 97.8 | 99.63 | uguali |
| `/it/tests/pagamenti-multa-dati-personali` | 87.47 / 97.95 | 99.65 | uguali |
| `/it/tests/pagamenti-multa-dati-specifici-fase1` | 86.86 / 97.84 | 99.68 | uguali |
| `/it/tests/pagamenti-multa-dati-specifici-fase2` | 88.03 / 98.04 | 99.65 | uguali |
| `/it/tests/pagamenti-multa-dati-specifici-fase3` | 88.11 / 98.06 | 99.66 | uguali |
| `/it/tests/pagamenti-multa-riepilogo` | 87.89 / 98.02 | 99.73 | uguali |
| `/it/tests/pagamenti-multa-scheda-servizio` | 89.67 / 98.27 | 99.72 | uguali |
| `/it/tests/permessi-area-personale` | 90.37 / 98.96 | 99.64 | uguali |
| `/it/tests/permessi-conferma` | 88.7 / 97.89 | 99.67 | uguali |
| `/it/tests/permessi-dati-personali` | 90.39 / 98.54 | 99.81 | uguali |
| `/it/tests/permessi-dati-specifici` | 86.88 / 97.84 | 99.66 | uguali |
| `/it/tests/permessi-pagamento` | 86.04 / 97.77 | 99.63 | uguali |
| `/it/tests/permessi-riepilogo` | 89.17 / 98.24 | 99.77 | uguali |
| `/it/tests/permessi-scheda-servizio` | 90.08 / 98.06 | 99.69 | uguali |
| `/it/tests/servizi-index` | 89.54 / 98.69 | 99.75 | uguali |
| `/it/tests/vantaggi-area-personale` | 89.89 / 98.9 | 99.66 | uguali |
| `/it/tests/vantaggi-conferma` | 88.29 / 97.96 | 99.65 | uguali |
| `/it/tests/vantaggi-dati-personali` | 91.57 / 98.85 | 99.83 | uguali |
| `/it/tests/vantaggi-riepilogo` | 90.29 / 98.41 | 99.81 | uguali |
| `/it/tests/vantaggi-scheda-servizio` | 90.26 / 98.25 | 99.71 | uguali |

Riepilogo: 37/37 con pixel minimo >= 99,61% e altezze uguali; HTML rigoroso >= 90 su 13/37 (82,6-93%); URL normalizzati >= 97,49% (`consenso-privacy`, la piu' bassa); decisione sulla metrica: [DCP-94](stories/dcp-94-decisione-metrica-html-rigorosa.story.md). Non nel riferimento (404): `graduatoria-pagamento`, `pagamenti-multa-pagamento`; `pagamenti-multa-dati-specifici-fase1/2/3` (i file con il refuso `specifci` rispondono 404).
Sentinelle durante la giornata: `/it` 5 pixel su 4.982.400 dopo il primo build dello scope `data-dc` (stato di allora); `/it/tickets` 200; 4 pagine di prova a campione invariate (eventi 99,68, homepage 99,83, permessi-area-personale 99,64, risultati-ricerca 99,76).

