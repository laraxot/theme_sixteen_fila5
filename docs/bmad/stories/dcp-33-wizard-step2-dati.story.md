---
id: dcp-33
title: "Wizard ticket: step dati con CoordinatePicker/Geo"
type: story
epic: dc-parity-v2
status: ready-for-dev
priority: P1
owner: module:Fixcity + module:Geo + theme:Sixteen
created: 2026-10-13
updated: 2026-10-13
qmd: "dcp-33 tickets create wizard step dati CoordinatePicker Geo segnalazione-02-dati"
related:
  - dcp-00-epic-design-comuni-parity-v2.story.md
  - ../decisions/segnalazione-flow-parity-zen.md
tags: [docs, sixteen, bmad]
---
> Numerazione: esiste un'altra DCP-33 ([riepilogo + mappa, modulo Fixcity](../../../../../Modules/Fixcity/docs/stories/dcp-33-tickets-create-riepilogo-design-comuni-mappa.story.md)); argomento diverso (passo 3). Registro: [DCP-97](dcp-97-registro-flusso-tickets-numerazione-e-coordinamento.story.md).


# DCP-33 — Step dati della segnalazione con mappa

## Story

Come cittadino che sta creando una segnalazione,
voglio compilare titolo, categoria, descrizione, allegati e posizione del
disservizio in un unico step Filament Wizard,
così da inviare una segnalazione comprensibile e localizzabile, con una UI
coerente con il riferimento Design Comuni `segnalazione-02-dati.html`.

## Obiettivo e contesto

Il percorso sotto implementazione è:

```text
/it/tickets/create?step=form.dati-di-segnalazione::data::wizard-step
```

Il riferimento visuale e semantico è:

```text
https://italia.github.io/design-comuni-pagine-statiche/sito/segnalazione-02-dati.html
```

La pagina deve conservare il Filament Wizard e il modello dati di Fixcity,
aggiungendo la mappa Geo richiesta per precisare il punto del danno. La
parità non consiste nel copiare una pagina Blade per questo URL: il modulo
possiede schema, stato, validazione e persistenza; il tema possiede il
rendering e la pelle visuale.

### Contratto tecnico non negoziabile

- Stack UI: TailwindCSS, Alpine.js, Lit, DaisyUI e Flowbite.
- Filament Wizard obbligatorio; la navigazione deve restare gestita da
  Filament, inclusa la query string `step`.
- Nessun Bootstrap Italia runtime, CDN, stylesheet o classe Bootstrap Italia
  aggiunta per risolvere la parità.
- `CoordinatePicker` di `Modules\\Geo` è l'unico componente responsabile della
  mappa, del marker, della ricerca, del reverse geocoding e del readout.
- I dati di posizione passano nello stato `data.location`; non introdurre un
  secondo stato parallelo né una colonna `address` nel database.
- Nessuna pagina Blade dedicata a `homepage`, `segnalazione-02-dati` o al solo
  URL: il wizard/schema esistente resta il punto di composizione.

## Acceptance Criteria (LOCKED)

### AC1 — Entrata nello step e struttura Design Comuni

**Given** un utente apre l'URL dello step dati
**When** il wizard viene renderizzato a locale `it`
**Then** il documento risponde `200`, mantiene breadcrumb/titolo/stepper del
guscio pubblico e mostra lo step dati attivo con una struttura equivalente
al riferimento: titolo dello step, gruppi di contenuto, campo posizione,
categoria, titolo, descrizione, allegati e navigazione precedente/successivo.

La composizione deve provenire dallo schema Filament e dai componenti del
tema, senza markup duplicato per l'URL.

### AC2 — Campi dati e validazione

**Given** lo step dati è attivo
**When** l'utente compila il form
**Then** sono disponibili e associati a label accessibili:

- `data.location.address` per l'indirizzo/testo di supporto;
- `data.location` per coordinate e payload geografico;
- `data.type` per la categoria obbligatoria;
- `data.name` per il titolo obbligatorio, minimo 3 e massimo 255 caratteri;
- `data.content` per la descrizione obbligatoria, minimo 10 caratteri;
- `data.images` per massimo 5 allegati immagine.

**And** errori e stati invalidi sono visibili vicino al controllo, non solo in
un messaggio globale, con `aria-invalid`/`aria-describedby` dove applicabile.

### AC3 — Mappa CoordinatePicker/Geo interattiva

**Given** l'utente visualizza lo step dati
**When** clicca/trascina il marker, cerca un indirizzo o usa la posizione
disponibile
**Then** `CoordinatePicker` aggiorna `data.location` con almeno latitudine,
longitudine e, quando disponibile, indirizzo/display name.

**And** il componente Lit resta montato durante i re-render Livewire tramite
`wire:ignore`.

**And** il reverse geocoding usa il contratto Livewire
`callSchemaComponentMethod` del campo, senza endpoint o callback duplicati nel
tema.

**And** il readout mostra coordinate formattate e indirizzo in un'area
`aria-live="polite"`.

### AC4 — Persistenza e contratto location

**Given** il form contiene una posizione valida
**When** il ticket viene salvato dal wizard
**Then** il payload di `data.location` viene consegnato al dominio Ticket,
le coordinate vengono persistite e l'indirizzo rimane dentro il JSON
`location` insieme al payload geografico disponibile.

**And** le colonne mirror `latitude`/`longitude` restano coerenti per
compatibilità.

**And** non viene scritto o richiesto un attributo/colonna SQL `address`.

### AC5 — Navigazione Filament e stato

**Given** l'utente è nello step dati
**When** seleziona “Indietro” o “Successivo”
**Then** Filament cambia step senza perdita dei campi già compilati e conserva
`step` nella query string secondo il comportamento del wizard.

**And** il passaggio allo step successivo è bloccato dagli errori di
validazione pertinenti.

**And** non viene aggiunto un metodo custom `nextStep`/`previousStep` né una
seconda `<form>` annidata attorno al wizard.

### AC6 — Responsive e visual parity

**Given** il riferimento e la pagina locale sono acquisiti allo stesso stato
del wizard
**When** vengono confrontati a viewport 375×900, 768×1000 e 1440×1200
**Then** la pagina locale mantiene ordine, larghezze, spaziatura, card/sezioni,
focus, colori, bordi, CTA e gerarchia tipografica equivalenti al riferimento,
con la mappa aggiuntiva esplicitamente prevista da questa story.

**And** non compare overflow orizzontale a nessuna delle tre dimensioni.

**And** il confronto deve produrre screenshot e una nota di differenze; non
dichiarare una percentuale senza evidenza.

### AC7 — Accessibilità e stack

**Given** il rendering finale dello step
**When** viene eseguito un audit WCAG 2.2 AA e una verifica console
**Then** ogni controllo ha label/role corretti, focus visibile, contrasto
sufficiente, testo alternativo per gli elementi informativi e nessun errore
JavaScript, Alpine, Livewire o Lit bloccante.

**And** gli asset e gli stili usati dalla pagina provengono dallo stack
Tailwind/Alpine/Lit/DaisyUI/Flowbite/Filament; nessun asset Bootstrap Italia
viene caricato.

## Tasks / Subtasks

- [ ] T1. Mappare il markup del riferimento `segnalazione-02-dati.html` in
      stepper, sezioni, campi, mappa e navigazione, annotando le differenze
      ammesse dalla mappa richiesta (AC: #1, #6).
- [ ] T2. Verificare/adeguare `TicketForm::getDataSchema()` usando Section e
      componenti Filament senza cambiare il contratto `data.*` (AC: #2, #5).
- [ ] T3. Verificare le label, helper text, messaggi di errore e attributi
      accessibili per ogni campo del form (AC: #2, #7).
- [ ] T4. Collegare il solo `CoordinatePicker` Geo a
      `data.location`, includendo ricerca, selezione, marker, reverse
      geocoding e readout; non duplicare la mappa nel tema (AC: #3).
- [ ] T5. Verificare il bridge `$wire.callSchemaComponentMethod` e il metodo
      pubblico esposto da `XotBaseWizardWidget`; coprire il percorso di errore
      senza silenziare un fallimento di persistenza (AC: #3, #5).
- [ ] T6. Verificare il mapping Ticket/location e i mirror lat/lng con fixture
      realistica di coordinate e indirizzo; assicurare che `address` non diventi
      una colonna SQL (AC: #4).
- [ ] T7. Applicare il rendering visuale nel tema Sixteen tramite componenti e
      CSS condivisi Tailwind/DaisyUI/Flowbite; rimuovere eventuali dipendenze
      Bootstrap runtime nello scope del wizard (AC: #1, #6, #7).
- [ ] T8. Verificare i tre viewport con screenshot reference/local, DOM
      snapshot essenziale e controllo overflow; registrare evidenza delle
      differenze residue (AC: #6).
- [ ] T9. Eseguire test unitari, feature/browser e audit WCAG/console secondo
      la strategia sotto; correggere solo regressioni nello scope dichiarato
      (AC: #2, #3, #4, #5, #7).

## Dev Notes (LOCKED)

### Implementazione e confini

- La composizione degli step è in
  [`TicketForm.php`](../../../../../Modules/Fixcity/app/Filament/Resources/TicketResource/Schemas/TicketForm.php#L34-L45);
  lo step `data` deve restare uno `Step` Filament e lo schema deve rimanere
  riutilizzabile anche dal back office.
- Il punto di estensione per i campi dello step è
  [`TicketForm::getDataSchema()`](../../../../../Modules/Fixcity/app/Filament/Resources/TicketResource/Schemas/TicketForm.php#L204-L244).
  `priority` e `status` sono stato interno/hidden, non controlli visuali dello
  step.
- La vista pubblica del widget è
  [`create-ticket-wizard.blade.php`](../../../../../Themes/Sixteen/resources/views/filament/widgets/create-ticket-wizard.blade.php).
  Non aggiungere una form annidata: il test di regressione impone che il
  rendering contenga `{{ $this->form }}` e modali Filament nel corretto ordine.
- Il confine architetturale è documentato in
  [`wizard-architecture-filament-theme-boundary.md`](../../../../../Modules/Fixcity/docs/wiki/concepts/wizard-architecture-filament-theme-boundary.md):
  Fixcity possiede schema/validazione; Sixteen possiede presentazione; Geo
  possiede la mappa.

### CoordinatePicker e stato geografico

- Il campo pubblico è
  [`Geo/.../CoordinatePicker.php`](../../../../../Modules/Geo/app/Filament/Forms/Components/CoordinatePicker.php#L18-L36);
  `isMapReadonly()` deve restare la fonte per lo stato read-only del map
  widget, non una classe CSS o una flag duplicata.
- Il rendering Alpine/Lit e il bridge reverse-geocoding sono in
  [`coordinate-picker.blade.php`](../../../../../Modules/Geo/resources/views/filament/forms/components/coordinate-picker.blade.php#L24-L124).
  Il componente usa `wire:ignore`, `$wire` e l'evento `coords-changed`;
  eventuali modifiche devono preservare questi contratti.
- Il contratto persistente è descritto in
  [`ticket-location-json-architecture.md`](../../../../../Modules/Fixcity/docs/wiki/concepts/ticket-location-json-architecture.md):
  `location` JSON è la fonte canonica, lat/lng sono mirror e l'indirizzo non
  ha una colonna dedicata.

### Presentazione e vincoli visuali

- Usare classi e componenti coerenti con la superficie Sixteen già esistente;
  non importare Bootstrap Italia per ottenere il look del riferimento.
- Le card/sezioni devono conservare una gerarchia leggibile anche senza CSS;
  i controlli devono avere focus keyboard e stati error/success coerenti con
  DaisyUI/Flowbite senza trasformare il wizard Filament in un nuovo framework.
- La mappa è una capability aggiuntiva, non un motivo per spostare o
  nascondere i campi essenziali del riferimento.

## Testing strategy (LOCKED; strategy only)

1. **Unit/schema** — verificare che `getDataSchema()` contenga Section,
   `CoordinatePicker`, Select, TextInput, Textarea e upload; verificare i
   default `data.location` e le regole di stato. Usare il pattern già presente
   in [`TicketFormWizardSummarySchemaTest.php`](../../../../../Modules/Fixcity/tests/Unit/TicketFormWizardSummarySchemaTest.php).
2. **Geo unit/feature** — verificare `isMapReadonly()`, entanglement dello stato,
   eventi coordinate/address e reverse-geocoding con risposta strutturata;
   riusare i test esistenti in `Modules/Geo/tests/Unit/Filament/Forms/Components`
   e `Modules/Geo/tests/Feature/Filament/Forms/Components`.
3. **Livewire/feature** — montare `CreateTicketWizardWidget`, impostare una
   posizione valida, avanzare dallo step dati e asserire assenza errori,
   stato conservato e persistenza di coordinate/payload. Coprire anche
   posizione assente e dati invalidi. Rispettare il test di view in
   [`CreateTicketWizardWidgetViewTest.php`](../../../../../Modules/Fixcity/tests/Unit/CreateTicketWizardWidgetViewTest.php)
   e il test di submit in
   [`CreateTicketWizardWidgetTest.php`](../../../../../Modules/Fixcity/tests/Feature/Filament/CreateTicketWizardWidgetTest.php).
4. **Browser/visual** — con Playwright o strumento equivalente acquisire
   reference e local a 375×900, 768×1000 e 1440×1200, con lo stesso step e dati
   deterministici; confrontare screenshot, bounding box del contenitore,
   stepper, sezioni, mappa e CTA. Salvare gli artefatti solo nella cartella
   evidence già prevista dal tema, se il dev tool lo richiede.
5. **Accessibility/console** — eseguire axe/WCAG 2.2 AA, keyboard tab order,
   focus visibility, contrasto e assenza di overflow; fallire la verifica per
   errori console Livewire/Alpine/Lit, richieste asset Bootstrap Italia o
   controlli senza label.
6. **Regression** — eseguire la suite Fixcity/Geo pertinente e `git diff
   --check`; non usare una percentuale di parity come sostituto dei test
   funzionali.

## Dependencies

### Blocked by

- `dcp-00` — convenzioni e shell Design Comuni della serie parity.
- Filament Wizard e `XotBaseWizardWidget` disponibili nel runtime.
- `Modules\\Geo\\Filament\\Forms\\Components\\CoordinatePicker` e il suo
  asset Lit registrati dal tema/app.

### Blocks

- Story dello step riepilogo `segnalazione-03-riepilogo`, che consuma lo stesso
  `data.location` e deve mostrare la posizione in sola lettura.
- Story della conferma `segnalazione-04-conferma`, che consuma il ticket
  persistito e il suo codice.

### Parallelization note

La verifica Geo e la verifica visuale Sixteen possono procedere in parallelo
solo se non modificano gli stessi file. L'integrazione finale deve controllare
lo schema reale e il contratto `data.location` prima di dichiarare la story
ready for external development.

## Owned File / Module Scope

Il dev agent può modificare esclusivamente i seguenti ambiti per questa story:

- `laravel/Modules/Fixcity/app/Filament/Resources/TicketResource/Schemas/TicketForm.php`
  — schema e validazione dello step dati.
- `laravel/Modules/Fixcity/app/Filament/Widgets/CreateTicketWizardWidget.php`
  — solo bridge/submit già necessario al wizard, senza duplicare navigazione.
- `laravel/Modules/Fixcity/resources/views/filament/widgets/create-ticket-wizard.blade.php`
  — wrapper del widget, se indispensabile al rendering.
- `laravel/Modules/Fixcity/lang/{it,en}/ticket_form.php`
  — label/helper/error dello step.
- `laravel/Modules/Fixcity/tests/Unit/**CreateTicketWizard*Test.php` e
  `laravel/Modules/Fixcity/tests/Unit/TicketFormWizardSummarySchemaTest.php`
  — regressioni schema/view.
- `laravel/Modules/Fixcity/tests/Feature/Filament/CreateTicketWizardWidgetTest.php`
  — percorso Livewire/persistenza.
- `laravel/Modules/Geo/app/Filament/Forms/Components/**` e
  `laravel/Modules/Geo/resources/views/filament/forms/components/coordinate-picker.blade.php`
  — solo correzioni necessarie al contratto CoordinatePicker/Geo.
- `laravel/Modules/Geo/tests/Unit/**CoordinatePicker*Test.php` e test feature
  del picker — copertura Geo.
- `laravel/Themes/Sixteen/resources/views/components/wizard/**` e
  `laravel/Themes/Sixteen/resources/views/filament/widgets/create-ticket-wizard.blade.php`
  — markup visuale condiviso del wizard.
- `laravel/Themes/Sixteen/resources/css/**` — soli token/stili condivisi del
  wizard, senza CSS page-specifico o import Bootstrap Italia.

Fuori scope: migrazioni Ticket, nuovo provider mappe, nuovo route/controller,
nuove pagine Blade per URL, redesign globale di header/footer e modifica del
back office non necessaria al contratto condiviso.

## Learnings from Previous Stories

- Il wizard deve restare Filament: una `<form>` aggiuntiva intorno a
  `{{ $this->form }}` produce DOM non valido e rompe submit/navigation.
- Il metodo Livewire chiamato dal picker deve essere esposto pubblicamente dal
  widget/base compatibile con la whitelist Livewire; non risolvere l'errore
  aggiungendo un endpoint o chiamando metodi privati dal browser.
- `data.location` è stato entangled e può contenere più chiavi del solo
  lat/lng; non ridurlo a un nuovo DTO parziale durante un re-render.
- Le label raw (`type`, `content`, `location`, `images`) sono un difetto di
  traduzione, non un requisito visuale: aggiungere le chiavi lang corrette.
- Le classi del riferimento Design Comuni non autorizzano il caricamento di
  Bootstrap Italia: la parità deve essere riprodotta con lo stack dichiarato.
- La mappa nel riepilogo deve essere read-only; nello step dati deve poter
  selezionare/ricercare e aggiornare il payload.

## Dev Agent Record

<!-- Intentionally empty. The external development agent records implementation,
     tests, evidence, and follow-up risks here after handoff. -->


