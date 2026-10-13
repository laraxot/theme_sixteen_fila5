---
id: dcp-parity-sweep-2026-10-13
title: "Sweep del gate di parity, ondata 1 (2026-10-13)"
type: report
epic: dc-parity-v2
status: partial
created: 2026-10-13
qmd: "sweep parity gate ondata 1 pagine misurate html pixel altezze design comuni"
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
