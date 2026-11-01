---
type: story
epic: dc-adozione-linee-guida-design-pa
status: open
priority: P1
owner: theme:Sixteen
module: Sixteen
created: 2026-10-14
updated: 2026-10-14
qmd: "affidabilità trasparenza sicurezza dati personali GDPR cookie consenso DCP-161 DCP-153"
related: [dcp-161, dcp-153, dcp-158]
title: "DCP-162: affidabilità, trasparenza e sicurezza (Linee guida PA 4.2)"
tags: [docs, sixteen, bmad]
---
# DCP-162: affidabilità, trasparenza e sicurezza (Linee guida PA 4.2)

## Lacuna
Le Linee guida PA (sezione 4.2) richiedono che il sito fornisca informazioni chiare su:
- Chi è il titolare del trattamento e i contatti (DCP-112 già parzialmente coperto)
- Finalità del trattamento e base giuridica (DCP-153 cookie, Gdpr config)
- Diritti dell'utente (DCP-153 privacy)
- Tempi di risposta e procedure di reclamo
- Misure di sicurezza adottate

## Stato attuale
- Modulo Gdpr: configurazione cookie categories (necessary/analytics/marketing) — DCP-153
- Pagina privacy: `privacy.index.json` con blocco `legal_document` — DCP-153
- Pagina cookie-policy: `cookie-policy.index.json` esistente ma 404 (DCP-161)
- Disclaimer generatore AI: appena creato (`disclaimer.index.json`)

## Requisiti
1. Verificare che tutte le pagine legali (privacy, cookie-policy, disclaimer) siano raggiungibili (nessun 404)
2. Assicurare che i link alle pagine legali siano presenti in header e footer (tutte le lingue)
3. Verificare che i testi contengano: titolare, finalità, diritti, tempi di risposta, sicurezza
4. Assicurare che i link al modulo di feedback (DCP-132) siano presenti nelle pagine legali

## Criteri di accettazione
- [ ] Nessun 404 su `/privacy`, `/cookie-policy`, `/disclaimer` (it/en/de/es)
- [ ] Link footer/header a tutte e tre le pagine legali (tutte le lingue)
- [ ] Testi contengono i 5 elementi richiesti dalle Linee guida PA 4.2
- [ ] Link al modulo di feedback presente nelle pagine legali

## Dipendenze
- DCP-161 (rimozione cookie duplicate)
- DCP-153 (cookiebar integrata nel modulo Gdpr)
- DCP-132 (dichiarazione accessibilità + feedback)