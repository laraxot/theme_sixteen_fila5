---
id: dcp-163
title: "DCP-163: matrice delle Linee guida di design in vigore (cap. 4) e baseline di riferimento"
type: story
epic: dc-parity-v2
status: done
priority: P1
owner: theme:Sixteen
module: Sixteen
created: 2026-10-14
updated: 2026-10-14
qmd: "linee guida design pa superate in vigore capitolo 4 requisiti matrice baseline designers italia docs italia 8.1 lg-design-servizi-web scansione"
related: [dcp-112, dcp-158, 8.1, 8.8]
tags: [docs, sixteen, bmad]
---

# DCP-163: matrice delle Linee guida di design in vigore (cap. 4) e baseline di riferimento

## Lacuna e prova (2026-10-14)
La pagina indicata dall'utente (`design-linee-guida-docs/it/stabile/doc/introduzione-linee-guida-design.html`) si apre con «Queste linee guida sono superate» e rimanda al testo in vigore e al Manuale operativo di design (v. 2025.1). Nel repository: la story `Themes/Sixteen/docs/stories/design-italia-guidelines-integration.story.md` e il `research-report.md` citano il testo superato come riferimento; la matrice di interfaccia (I-14) cita le linee guida senza versione. Il capitolo 4 del testo in vigore contiene **42 requisiti** (4.1-4.8) che nessuna matrice elencava uno per uno.

## Norma
Linee guida di design della PA, capitolo 4 «Requisiti» (versione corrente, letto il 2026-10-14). Frontespizio: art. 53 c. 1-ter CAD; introduzione: art. 71 CAD e det. AgID 160/2018, riferimento sostanziale all'art. 53; destinatari: PA dell'art. 2 c. 2 lett. a) CAD. Data di adozione, scadenze e sanzioni: non riportate nelle pagine lette.

## Requisiti
1. Matrice `Themes/Sixteen/docs/compliance/02-matrice-linee-guida-design-cap4.md`: un requisito per riga, con verbo (DEVE/DOVREBBE), stato, prova e story.
2. Scansione ripetibile `bashscripts/tools/compliance/lg-design-scan.py` (documentata in `bashscripts/docs/lg-design-scan.md`).
3. Nota di verifica in 8.1 con URL, data di accesso e testo superato etichettato come tale.

## Criteri di accettazione
- [x] 42 righe; sintesi: 12 assenti, 13 parziali, 11 non verificati, 4 conformi, 2 non applicabili.
- [x] `python3 -I bashscripts/tools/compliance/lg-design-scan.py http://127.0.0.1:8081` stampa i numeri della matrice (41/48 senza data di aggiornamento, 48/48 senza canonical, ecc.).
- [x] Ogni lacuna senza copertura ha una story (DCP-164..171) o una voce in DCP-158.
- [ ] Da rifare dopo ogni story DCP-164..170: rilanciare la scansione e aggiornare le righe.

## Dipendenze e priorita'
Completa 8.1 (baseline) per la parte documentale; 8.8 usa la matrice come evidenza del gate. P1: senza una versione citata non si puo' dichiarare conformita'.
