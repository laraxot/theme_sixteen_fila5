---
title: "BMAD Planning — dettaglio ticket Design Comuni"
type: bmad-planning
status: ready-for-dev
module: Sixteen
created: 2026-10-16
tags: [bmad, planning, sixteen, design-comuni, ticket, timeline, accessibility]
related:
  - ./ticket-detail-brainstorming.md
  - ./content-detail-planning.md
  - ../../../Modules/Fixcity/docs/bmad/ticket-lifecycle-planning.md
updated: 2026-10-17
qmd: "ownership sixteen"
---

# Ownership

Sixteen possiede layout, componenti, tipografia, responsive behavior e
accessibilità. Fixcity possiede query, privacy, stati, timeline e scadenze.
Comment possiede il widget e il suo contratto di moderazione.

## UI pianificata

1. Intestazione con numero, tipologia, data e stato.
2. Riepilogo “Dove” con alternativa testuale alla mappa.
3. “Passaggi” in `cmp-timeline`/timeline verticale, data leggibile e motivo
   sicuro.
4. “Tempi e scadenze” solo con dati configurati dal tenant.
5. “Prossimi passi” derivati dallo stato: moderazione, presa in carico,
   attesa risposta, intervento, verifica, risoluzione.
6. Commenti solo se l'attore è autorizzato; nessun contenuto privato per guest.

## Accessibilità

- un solo `h1`, heading gerarchici e landmark nominati;
- timeline come lista semantica, non solo elementi decorativi;
- date con `time[datetime]` e testo locale;
- focus visibile, contrasto WCAG 2.1 AA, supporto riduzione movimento;
- messaggi di errore e aggiornamento Livewire annunciati.

## Verifica visuale

Confrontare soltanto i pattern Design Comuni pertinenti (scheda servizio,
conferma, messaggio, eventi); non copiare tempi fittizi o creare CSS Bootstrap
parallelo. Il tema deve consumare il contratto dati Fixcity.

