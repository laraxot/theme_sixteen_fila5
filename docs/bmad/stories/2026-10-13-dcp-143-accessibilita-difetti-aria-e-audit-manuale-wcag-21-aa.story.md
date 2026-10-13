---
id: dcp-143
title: "DCP-143: accessibilita': audit manuale WCAG 2.1 AA, axe sulle pagine con login, ACC-01..05 del wizard"
type: story
epic: dc-parity-v2
status: ready-for-dev
priority: P1
owner: theme:Sixteen
created: 2026-10-13
updated: 2026-10-13
qmd: "accessibilita axe aria-allowed-attr aria-required-children tickets tab mappa elenco wizard tastiera screen reader nvda wcag 2.1 aa audit manuale"
related: [dcp-112, dcp-132, dcp-49, dcp-98]
---

# DCP-143: le pagine pubbliche e il wizard passano axe e un audit manuale

Nata da DCP-112 (matrice interfaccia I-03, I-04, I-07, I-08, I-26).

## Lacuna e prova (2026-10-13)
Playwright + `axe-core` (tag wcag2a, wcag2aa, wcag21a, wcag21aa) a 1440 px, escluse le violazioni della debug bar di sviluppo:

| Pagina | Esito |
|---|---|
| `/it`, `/en`, `/it/auth/login`, `/it/auth/register`, `/it/tickets/track`, `/it/domande-frequenti`, `/it/mappa-sito` | 0 violazioni (17:08) |
| `/it/tickets` | 17:08: 2 critical (`aria-allowed-attr` su `button[data-tab-id="map"]` e `.border-transparent`; `aria-required-children` su `#tabDisservizio`). 18:12: 0 violazioni dopo la riscrittura della pagina da parte di un'altra sessione |
| `/it` | 18:12: 0 violazioni (rimisurata) |

Non misurate: il wizard (richiede il login), l'area personale (DCP-110/111), il back office. Il controllo automatico copre solo una parte dei criteri: tastiera, ordine del focus, lettori di schermo, errori nei moduli e contrasto in stato hover/focus restano non verificati. L'audit statico DCP-49 ha elencato ACC-01..05 (`aria-live` sull'intero passo, errori globali non annunciati, «Usa la tua posizione» come link senza ruolo, bottone senza `aria-expanded`, stringhe fisse non tradotte): non corretti.

## Norma
L. 9.1.2004 n. 4 art. 3-bis (principi generali) e art. 3-quater; Dir. (UE) 2016/2102; EN 301 549 e WCAG 2.1 livello AA come baseline del progetto (`bmad-output/front-office-design-comuni/accessibility-strategy.md`). Testi e versioni nel registro fonti 03.

## Requisiti
1. Mantenere a zero le violazioni di `/it/tickets` con un test automatico (la correzione e' arrivata con la riscrittura della pagina, senza test).
2. Correggere ACC-01..ACC-05 di DCP-49 con test.
3. Audit manuale con tastiera sola e con un lettore di schermo (NVDA o VoiceOver) di: home, elenco, tracciamento, login, registrazione, i tre passi del wizard, area personale; checklist con esito per criterio WCAG 2.1 AA.
4. Esito dell'audit consegnato a DCP-132 per la dichiarazione.
5. Elenco informativo degli elementi interattivi sotto 24 px (criterio 2.5.8 di WCAG 2.2, non richiesto dalla baseline 2.1): link «Nome della Regione» (120x21), «Media policy» e «Mappa del sito» nel footer (altezza 20), «Mostra password» (124x20), casella 16x16, link «Leaflet» (51x14).

## Criteri di accettazione
- [ ] axe a 0 violazioni (tutte le severita') su 12 pagine a 375 e 1440 px, wizard e area personale inclusi (login con l'account di prova di DCP-98).
- [ ] Checklist manuale allegata con data, strumenti e versioni.
- [ ] Test automatico (Playwright + axe) in CI che fallisce su nuove violazioni serious/critical.

## Dipendenze e priorita'
DCP-98 (account di prova), DCP-110/111 (pagine). P1; l'esito alimenta la dichiarazione P0 di DCP-132.
