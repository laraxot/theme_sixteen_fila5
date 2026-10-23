---
title: "Perché la homepage di fixcity.eu si legge meglio della versione locale"
type: knowledge-page
status: active
created: 2026-10-23
updated: 2026-10-23
tags: [knowledge, ux, design-comuni, homepage, gerarchia, tipografia, conversione]
qmd: "why fixcity.eu homepage reads better hierarchy typography step icons track band one row"
related:
  - ../homepage-local-parity.md
  - ./why-home-blade-must-not-exist.md
  - ../header-color-contract.md
---

# Perché `fixcity.eu/it` si legge meglio (misurato 2026-10-23, 1280 px)

L'utente: «mi piaceva più questa versione https://fixcity.eu/it, cerca di capire il perché ed il senso».
Struttura e contenuti sono quasi uguali; cambia **quanto pesa ogni elemento**.

| elemento | fixcity.eu | locale (06:43) |
|---|---|---|
| h1 hero | 48 px / 400 | 48 px / 400 |
| titolo «Segui la tua segnalazione» | 44,8 px / 600, **1 riga**, pulsanti **accanto** | 40 px / 700, **2 righe**, pulsanti **sotto** |
| titolo della scheda «La tua voce conta» | **30 px** / 600 | 18 px / 600 |
| titoli dei passi «Come funziona» | **20,8 px / 600** | 32 px / 700 |
| icone dei passi | **24 px** | 56 px |
| altezza pagina | 3186 px | 3344 px |

## Il senso

1. **La dimensione segue l'importanza.** Su fixcity.eu la scala scende in ordine: titolo (48) → invito finale
   (45) → messaggio civico (30) → passi (21). In locale i passi gridano (32 px grassetto, icone 56) e il
   messaggio civico sussurra (18): tutto pesa uguale, l'occhio non sa dove andare.
2. **Un'idea per riga, l'azione accanto alla frase.** La fascia finale e' il punto di conversione: titolo e
   pulsanti sulla stessa riga si leggono e si cliccano insieme. Titolo spezzato e pulsanti sotto = un passo in piu'.
3. **Calma istituzionale.** Design Comuni usa icone piccole e pesi 600: e' un servizio del Comune, non una landing
   commerciale. Icone grandi e 700 spostano il tono verso «app».
4. **Asse unico.** Su fixcity.eu hero, passi e fascia finale partono dallo stesso bordo; ogni salto di allineamento
   si nota (vedi la revisione «asse orizzontale» in `homepage-local-parity.md`).

## Obiettivi per la versione locale

Passi: titolo ~20 px / 600, icone 24 px. Scheda hero: titolo ~30 px / 600. Fascia finale: titolo su una riga e
pulsanti accanto da 992 px in su. Misura: `scratchpad/why-measure.mjs` della sessione Claude (stesse metriche).
Cosa la versione locale fa **meglio** e va tenuto: mappa centrata sui dati reali (fixcity.eu mostra l'Italia
intera senza segnalazioni), logo del footer uguale all'header, nessuna chiave grezza.
