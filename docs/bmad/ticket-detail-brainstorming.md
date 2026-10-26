---
title: "BMAD Brainstorming — esperienza del dettaglio ticket"
type: bmad-brainstorming
status: synthesized
module: Sixteen
created: 2026-10-16
tags: [bmad, brainstorming, design-comuni, ux, timeline, accessibility]
related: [./ticket-detail-planning.md, ./second-brain-claude-cowork-plugins.md]
updated: 2026-10-17
qmd: "esplorazione ux sixteen"
---

# Esplorazione UX

## Mind map

```text
Dettaglio ticket
├── Cosa è successo? → passaggi, date, esiti
├── Cosa succede ora? → prossimi passi, stato, scadenza
├── Cosa posso aggiungere? → commento, foto, documento
├── Chi lo sta gestendo? → ente/responsabile solo se pubblicabile
└── Cosa resta privato? → email, note interne, moderazione tecnica
```

## Six Thinking Hats sintetici

- **Bianco:** solo eventi con timestamp e fonte presenti.
- **Rosso:** il cittadino deve percepire presa in carico, non silenzio.
- **Nero:** una timeline troppo tecnica può divulgare PII.
- **Giallo:** “prossimi passi” riduce richieste duplicate.
- **Verde:** risposta dell'ente come card con esito e azione successiva.
- **Blu:** il modulo definisce verità e tema definisce forma.

## Decisione

La pagina usa una cronologia verticale leggibile e una sezione successiva
esplicita. Non usa tab nascoste per informazioni essenziali e non inventa una
scadenza quando il tenant non l'ha configurata.

