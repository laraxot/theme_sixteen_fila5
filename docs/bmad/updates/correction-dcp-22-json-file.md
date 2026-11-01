---
id: correction-dcp-22-json-file
from: "Pensiero: test.tickets.create.json (errore — non esiste; il file corretto e' tickets.create.json)"
to: "tickets.create.json esiste gia', slug corretto tickets.create. Non creare tests.tickets.create.json."

type: correction
scope: dcp-22 / tickets/create
status: verified
title: "correction dcp 22 json file"
updated: 2026-10-13
tags: [docs, sixteen, bmad]
qmd: "correction dcp 22 json file sixteen"
---

dcp-22 (tickets/create): il file JSON corretto e' `laravel/config/local/fixcity/database/content/pages/tickets.create.json` (slug: `tickets.create`). Non ho creato `tests.tickets.create.json`; il componente Blade `ticket-crea.blade.php` (che usa `@livewire(CreateTicketWizardWidget)`) non necessita di un JSON `tests.*` — la pagina e' filareata dal modulo Fixcity, non dal tema Sixteen tramite JSON `tests.*`.

Errore evitato per il futuro:
- Verificare il slug della pagina prima di creare JSON (`tickets.create` vs `tests.evento-dettaglio` vs `tests.index`).
- Non assumere che tutte le pagine usino il prefisso `tests.` — solo quelle sotto `/it/tests/*` lo usano.
- Per pagine Filament/Livewire (come `tickets.create`), il JSON e' nel modulo (`tickets.create.json`) e il componente Blade usa `@livewire`, non `pub_theme::components.blocks.*`.
- Per pagina Design Comuni (`segnalazione-01-privacy`), il JSON e' `tests.segnalazione-01-privacy.json` (perche' e' nel percorso `/it/tests/`).

Stack: Tailwind+Alpine+Lit+DaisyUI+Flowbite+Filament (NO Bootstrap Italia). Token `#007A52`. Perche' il wizard non ha alta parita con il riferimento: il componente Filament non ha layout Design Comuni (checkbox privacy, wizard step visibile, bottone `#007A52`), e il bug `callSchemaComponentMethod` bippa il componente — deve essere corretto nel widget Filament (modulo Fixcity) prima della verifica visiva.

Correzione verificata 2026-10-13 (DCP-35 S4): (1) la pagina `/it/tickets/create` è servita dalla Folio generica del tema `Themes/Sixteen/resources/views/pages/[container0]/[slug0]/index.blade.php` (slug `tickets.create` dal `data-slug` della risposta), non dal modulo Fixcity. (2) Il «bug `callSchemaComponentMethod`» non era nel widget Fixcity: il metodo è già `public` in `InteractsWithSchemas`; la causa era il Volt della pagina senza radice propria, vedi [D15](../../decision-log/D15-volt-fragment-explicit-root.md).
