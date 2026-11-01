---
id: dcp-22
title: "DCP-22: tickets/create (wizard Filament) — allineato a segnalazione-01-privacy"
type: story
epic: dc-parity-v2
status: archived
priority: P0
owner: theme:Sixteen
created: 2026-10-13
updated: 2026-10-13
qmd: "design comuni parity dcp-22 tickets create wizard 90% html 97% visual"
tags: [docs, sixteen, bmad]
---

# DCP-22: tickets/create (Filament Wizard) — archivio

> **Non autorevole.** Il contratto corrente è suddiviso nelle story DCP-32,
> DCP-33, DCP-34 e DCP-35 nell’indice `00-INDEX.md`. Questo documento conserva
> soltanto il contesto storico e non deve guidare nuove modifiche.

## Perché
`tickets.create.json` (slug `tickets.create`) punta a `components/blocks/tests/ticket-crea.blade.php` (la cartella `tests` è di view, non di slug) che usa `@livewire(Modules\Fixcity\Filament\Widgets\CreateTicketWizardWidget)`. Il componente non ha parità visiva con `segnalazione-01-privacy.html` (Design Comuni step: checkbox privacy, testo informativo, bottoni `#007A52`, wizard 4 step). Questo documento traccia la parità e l'aggiornamento del componente Filament.

## Struttura riferimento (segnalazione-01-privacy)
- Step 1: informativa privacy + checkbox consenso
- Layout: card con border `#007A52`, titolo `text-[#191919]`, body `text-slate-700`, bottoni `#007a52`
- Componenti Blade: `form-wizard/default.blade.php` (già esistente con step numeri), `rating.blade.php`, `search-form.blade.php`

## Correzioni richieste
1. Creare `dcp-22-tickets-create.story.md` (questa)
2. Verificare `ticket-crea.blade.php` — se manca il wizard Filament, aggiornare il widget o creare un componente Blade con `form-wizard` + checkbox privacy
3. Aggiornare `tickets.create.json` (esiste già, non crearne altri) con blocchi: breadcrumb, hero, wizard (con step privacy), search-form (`#007A52`)
4. Aggiornare `docs/bmad/` modulo + tema con riferimento a questa story
5. Playwright: screenshot `/it/tickets/create` vs riferimento `segnalazione-01-privacy.html`; gate ≥97% in 375/768/1440

## Stack (D10/D21/D23)
TailwindCSS + Alpine.js + Lit + DaisyUI + Flowbite + Filament (NO Bootstrap Italia). Token `#007A52`. Wizard Filament: `CreateTicketWizardWidget` (modulo Fixcity) deve mantenere il layout Design Comuni.

## Runtime regression gate

`callSchemaComponentMethod` must be present in the public Livewire method set
before any visual-parity result is accepted. The shared Xot wizard base owns
the bridge and delegates to Filament; do not add a page-specific Livewire
method or replace the schema wizard with Blade navigation.

Evidence: `Modules/Fixcity/tests/Unit/CreateTicketWizardWidgetViewTest.php`
asserts the public bridge is declared by `XotBaseWizardWidget`. Browser gate:
open `/it/tickets/create`, toggle privacy, advance to step two, and confirm no
`MethodNotFoundException` or console error before taking parity screenshots.

Correzione verificata 2026-10-13 (DCP-35 S4): il ponte `callSchemaComponentMethod` in `XotBaseWizardWidget` è un no-op: il metodo è già `public` in `Filament\Schemas\Concerns\InteractsWithSchemas` (`vendor/filament/schemas/src/Concerns/InteractsWithSchemas.php`, riga 83), usato direttamente da `XotBaseSchemaWidget`. Il test `CreateTicketWizardWidgetViewTest` verifica solo la classe che dichiara il metodo, non la causa dell'errore. La causa di `MethodNotFoundException` su «Avanti» era il Volt della pagina generica senza radice propria: [D15](../../decision-log/D15-volt-fragment-explicit-root.md).
