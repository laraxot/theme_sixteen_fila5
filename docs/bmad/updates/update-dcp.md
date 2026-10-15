---
id: bmad-doc-update-dcp-22
type: documentation-update
doc_type: update
status: completed
scope: module:Fixcity + theme:Sixteen
qmd: "update docs for dcp-22 tickets create wizard design comuni parity"
title: "Documentazione aggiornata — dcp-22: tickets/create (Filament Wizard)"
updated: 2026-10-13
tags: [docs, sixteen, bmad]
---

# Documentazione aggiornata — dcp-22: tickets/create (Filament Wizard)

## Modulo Fixcity (docs/)
- Verificato: `docs/CreateTicketWizardWidget.md` esiste; `tests/Feature/Filament/CreateTicketWizardWidgetTest.php` conferma wizard.
- Stato: il componente Filament `CreateTicketWizardWidget.php` esiste; il componente Blade `ticket-crea.blade.php` lo richiama con `@livewire`. La parità visiva con `segnalazione-01-privacy.html` richiede il controllo del layout del widget (step privati, checkbox consent, bottoni `#007A52`).

## Tema Sixteen (docs/bmad/)
- `stories/dcp-22-tickets-create.story.md` creato (frontmatter YAML).
- Componenti Blade: `form-wizard/default.blade.php` (esiste, con `#007a52`); `rating.blade.php`, `search-form.blade.php` (creati per dcp-08); `feedback.blade.php` (creato per dcp-09); `access-method-card.blade.php` (creato per dcp-10).
- Stack: Tailwind+Alpine+Lit+DaisyUI+Flowbite (NO Bootstrap Italia).

## Second brain (D21/D23)
- D21: docs in tema (`Sixteen/docs/bmad/`) + modulo (`Fixcity/docs/`).
- D23: pagine aggiuntive (tickets/create) trattate con BMAD.
- D10: NO Bootstrap Italia confermato nel componente `form-wizard/default.blade.php` (usa classi Tailwind con `#007a52`).

## Stato finale
- `tickets.create.json` esiste; componente Blade `ticket-crea.blade.php` esiste; widget Filament `CreateTicketWizardWidget.php` esiste.
- Story BMAD `dcp-22` creata. Playwright 375/768/1440 per `/it/tickets/create` vs `segnalazione-01-privacy.html`: PENDENTE (ambiente locale `192.168.1.40:8000` non disponibile per il test visivo finale, ma architettura e documentazione complete).
