---
title: "Pianificazione: Ticket dettaglio — commenti + passaggi (stati + mail tracciate)"
type: planning
status: draft
github_issue: "#ticket-commenti"
links: { design_comuni: "https://italia.github.io/design-comuni-pagine-statiche/" }
updated: 2026-10-17
tags: [docs, sixteen, bmad]
qmd: "ticket detail passaggi commenti.planning sixteen"
---

## Obiettivo
Definire le attività di implementazione per aggiungere i commenti (Filament widget) e migliorare la visualizzazione dei passaggi (stati) con tracciamento mail nel dettaglio ticket.

## Attività
- [ ] Aggiungere il widget Filament dei commenti nella sezione dedicata del blade `design-comuni.blade.php`
- [ ] Verificare che la timeline mostri tutti i passaggi (segnalato, approvato, mail inviata, risposta, chiuso)
- [ ] Estendere la tabella `notification_log` (o crearne una dedicata) per tracciare le mail inviate a destinatari (ULSS, comune, vigili) con data, stato e message_id
- [ ] Aggiornare l'azione che invia la mail per registrare nel log
- [ ] Assicurarsi che la visibilità rimanga: cittadino vede solo propri ticket finché in attesa; moderatore vede tutti
- [ ] Testare con dati realistici (seeder/factory) per dimostrare il flusso completo in demo
