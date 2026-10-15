---
id: dcp-34
title: "Wizard segnalazione step 3 riepilogo + mappa — parity segnalazione-03-riepilogo"
type: story
epic: dc-parity-v2
status: ready-for-dev
priority: P1
owner: module:Fixcity + module:Geo + theme:Sixteen
created: 2026-10-13
updated: 2026-10-13
qmd: "wizard segnalazione step 3 riepilogo mappa parity segnalazione 03 riepilogo infolist"
related:
  - dcp-32-wizard-step1-privacy.story.md
  - dcp-33-wizard-step2-dati.story.md
  - dcp-35-conferma-parity.story.md
tags: [docs, sixteen, bmad]
---

# DCP-34 — Riepilogo readonly con mappa

## Story

Come cittadino che sta per inviare una segnalazione, voglio vedere tutti i dati inseriti
e il punto del danno su una mappa non modificabile, così posso correggere gli errori
prima del salvataggio e riconoscere con chiarezza ciò che sarà inviato.

Il riferimento è `https://italia.github.io/design-comuni-pagine-statiche/sito/segnalazione-03-riepilogo.html`.
La mappa è un requisito aggiuntivo del prodotto e non va rimossa per inseguire una
corrispondenza letterale con il riferimento statico.

## Fuori scope

- Non sostituire il Wizard o l'Infolist Filament con navigazione Blade manuale.
- Non creare una pagina Blade dedicata all'URL e non cambiare il routing CMS.
- Non duplicare il componente Geo o il contratto `data.location` nel tema.
- Non caricare Bootstrap Italia: il riferimento è solo una specifica visuale.

## Acceptance Criteria

### AC1 — Stato wizard e shell

Dato un utente che ha completato privacy e dati, quando apre lo step riepilogo,
allora il terzo step è attivo, breadcrumb, heading, contatti e azioni sono forniti
dal contenuto CMS/widget e non espongono chiavi di traduzione o debug.

### AC2 — Dati completi e readonly

Dato uno stato valido del form, allora il riepilogo mostra luogo, tipo di disservizio,
priorità, titolo, descrizione, allegati e dati dell'autore nelle sezioni previste;
nessun campo del riepilogo modifica direttamente `data.*`.

### AC3 — Mappa coerente

Dato `data.location` con coordinate valide, allora il riepilogo mostra il marker,
il readout di posizione e il componente `CoordinatePicker` in stato readonly,
preservando il contratto `isMapReadonly()` e senza una seconda sorgente di stato.

### AC4 — Azioni e validazione

Quando l'utente torna indietro, i dati restano presenti; quando conferma, il widget
usa l'azione Filament esistente e non invoca metodi Livewire inventati, inclusa
l'assenza di `MethodNotFoundException` nel browser.

### AC5 — Parità responsive

A 375×900, 768×1000 e 1440×1200 la struttura, le larghezze, la tipografia, i colori,
bordi, spaziature, card, callout e footer risultano coerenti con il riferimento;
la mappa aggiuntiva è integrata senza overflow orizzontale. La parity va dimostrata
con screenshot reference/local e DOM evidence, non solo dichiarata.

### AC6 — Accessibilità e stack

Un audit WCAG 2.2 AA e la verifica console non rilevano controlli senza nome,
focus invisibile, contrasto insufficiente, immagini senza testo alternativo o errori
JS/Alpine/Lit/Livewire bloccanti. Gli stili appartengono a Tailwind/DaisyUI/Flowbite
e il form a Filament; nessun asset Bootstrap Italia è runtime.

## Tasks / Subtasks

- [ ] T1. Mappare heading, callout, card, righe informative, stepper e footer del riferimento. (AC: #1, #5)
- [ ] T2. Verificare `TicketFormReviewInfolist::summarySectionEntries()` e il contratto dei dati readonly. (AC: #2)
- [ ] T3. Collegare il `CoordinatePicker` readonly a `data.location`, con coordinate e readout accessibili. (AC: #3, #6)
- [ ] T4. Verificare Previous/Confirm attraverso l'API Filament/Xot condivisa e la persistenza dello stato. (AC: #4)
- [ ] T5. Applicare solo stili condivisi Sixteen nello scope `data-dc`, senza riscrivere l'Infolist in Blade. (AC: #1, #5, #6)
- [ ] T6. Acquisire screenshot e DOM snapshot alle tre viewport, annotando ogni differenza residua e la mappa aggiuntiva. (AC: #5)
- [ ] T7. Aggiungere/aggiornare test unitari, feature/browser e audit WCAG per rendering, readonly, azioni e overflow. (AC: #2, #3, #4, #6)
- [ ] T8. Eseguire il controllo di scope BMAD e lasciare l'evidenza nel record del dev agent. (AC: #5, #6)

## Dev Notes (LOCKED)

- La fonte dello schema riepilogo è `laravel/Modules/Fixcity/app/Filament/Resources/TicketResource/Schemas/TicketFormReviewInfolist.php`; il tema non deve duplicare lo stato del form. [Source: `bmad-output/architecture.md#ADR-001--domain-ownership`]
- Il `CoordinatePicker` appartiene a Geo e il suo stato readonly è deciso da `isMapReadonly()`. [Source: `laravel/Modules/Geo/app/Filament/Forms/Components/CoordinatePicker.php`]
- Il wrapper visuale del wizard conserva `{{ $this->form }}` e le modali Filament. [Source: `laravel/Themes/Sixteen/resources/views/filament/widgets/create-ticket-wizard.blade.php`]
- Fixcity possiede schema, validazione e persistenza; Sixteen possiede markup/CSS; Geo possiede la mappa. [Source: `laravel/Modules/Fixcity/docs/wiki/concepts/wizard-architecture-filament-theme-boundary.md`]
- Il contratto di prodotto richiede una posizione verificabile prima dell'invio e una conferma successiva. [Source: `bmad-output/prd.md#FR-003-must--confirmation-and-tracking`]

## Testing strategy (LOCKED)

1. **Unit:** verificare entry del riepilogo, mapping `data.location` e readonly.
2. **Feature/Livewire:** renderizzare lo step con fixture complete/incomplete, tornare indietro,
   avanzare e confermare senza eccezioni; verificare locale italiana e inglese.
3. **Browser:** acquisire reference/local a 375×900, 768×1000 e 1440×1200; controllare console,
   overflow, tab order e marker; usare Playwright quando Chromium è disponibile.
4. **DOM:** confrontare body, landmark, heading, numero e ordine delle sezioni/azioni.
5. **Accessibility:** audit WCAG 2.2 AA su nomi, focus, contrasto, errori e touch target.

## Dependency Maps

### Blocked by

- DCP-32 — privacy e shell del wizard.
- DCP-33 — schema dati e coordinate persistite.

### Blocks

- DCP-35 — la conferma dipende dal submit valido e dal riepilogo coerente.
- Epic 2.1 — vertical slice cittadino.

## Owned File / Module Scope

- `laravel/Modules/Fixcity/app/Filament/Resources/TicketResource/Schemas/TicketFormReviewInfolist.php`
- `laravel/Modules/Fixcity/app/Filament/Widgets/CreateTicketWizardWidget.php` (solo integrazione submit se necessaria)
- `laravel/Modules/Geo/app/Filament/Forms/Components/CoordinatePicker.php` (solo contratto readonly)
- `laravel/Themes/Sixteen/resources/views/filament/widgets/create-ticket-wizard.blade.php`
- `laravel/Themes/Sixteen/resources/css/` (solo regole condivise del riepilogo)
- test unitari/feature/browser direttamente relativi al riepilogo

Shared/contended: `laravel/Themes/Sixteen/resources/css/`; serializzare con DCP-32S,
DCP-33 e DCP-35 durante l'integrazione.

## Learnings from Previous Stories

- La mappa deve restare nel modulo Geo; il tema la compone ma non ne duplica stato o reverse geocoding. (DCP-33)
- Il bridge schema Livewire appartiene a Xot/Filament; non aggiungere un metodo `callSchemaComponentMethod` alla pagina. (DCP-32)
- Una percentuale di parity è accettabile solo con screenshot, DOM e WCAG evidence alle tre viewport. (DCP-01)

## Dev Agent Record

_(empty — da completare dall'external dev tool)_
