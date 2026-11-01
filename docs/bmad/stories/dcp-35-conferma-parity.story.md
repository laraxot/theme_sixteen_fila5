---
id: dcp-35
title: "Conferma segnalazione — parity segnalazione-04-conferma"
type: story
epic: dc-parity-v2
status: ready-for-dev
priority: P0
owner: theme:Sixteen
created: 2026-10-13
updated: 2026-10-13
qmd: "conferma segnalazione parity segnalazione 04 conferma tickets confirmation Tailwind Filament"
tags: [docs, sixteen, bmad]
---
> Numerazione e argomento: la conferma e' coperta dalla [DCP-34 del modulo Fixcity](../../../../../Modules/Fixcity/docs/stories/dcp-34-tickets-confirmation-design-comuni.story.md) (azione, blocco, JSON it/en, test, misure); questa resta come storico, da leggere come superseded. Registro: [DCP-97](dcp-97-registro-flusso-tickets-numerazione-e-coordinamento.story.md).


# DCP-35: Conferma post-salvataggio

## Story

Come cittadino che ha inviato una segnalazione, voglio una conferma chiara con il
codice di tracciamento e i prossimi passi, così posso sapere che la richiesta è
stata registrata e seguirne lo stato.

## Acceptance Criteria

1. `CreateTicketWizardWidget::save()` salva il ticket, conserva il payload di
   conferma e redirige all'URL localizzato `tickets.confirmation` con il codice
   capability nel query string.
2. `tickets.confirmation.json` continua a selezionare il blocco
   `ticket_confirmation`; non vengono create pagine Blade dedicate all'URL.
3. La conferma mostra titolo, stato di successo, codice/ricevuta, link all'area
   personale e contatto Comune con contrasto WCAG AA e focus visibile.
4. La view Sixteen usa TailwindCSS + Alpine.js + Lit + DaisyUI + Flowbite e non
   carica Bootstrap Italia, sprite Bootstrap o classi Bootstrap come dipendenza
   runtime.
5. Il layout non produce overflow a 375, 768 o 1440 px; i link e i controlli
   raggiungono almeno 44 px di area tattile.
6. Il fallback tramite codice ricostruisce una conferma sicura quando il flash di
   sessione non è disponibile; non espone dettagli privati oltre al payload
   pubblico previsto.

## Tasks / Subtasks

- [ ] Verificare il contratto di redirect e il codice capability nel widget (AC: #1, #6)
  - [ ] Mantenere `BuildTicketConfirmationDataAction` come builder e
        `ResolveTicketConfirmationDataAction` come resolver del payload (AC: #1, #6)
  - [ ] Verificare locale, query string e redirect Livewire (AC: #1)
- [ ] Mantenere il blocco CMS canonico e il confine di ownership (AC: #2)
- [ ] Allineare markup, gerarchia, spaziature e stati della conferma al riferimento (AC: #3, #4, #5)
- [ ] Audit statico di classi/import Bootstrap e controllo accessibilità (AC: #4, #5)
- [ ] Aggiungere/aggiornare test unitari, feature e browser evidence (AC: #1, #3, #6)

## Dev Notes

- Fixcity possiede creazione ticket, codice, session payload e query recovery;
  Sixteen possiede esclusivamente la resa visuale del blocco. [Source: bmad-output/architecture.md#ADR-001--domain-ownership]
- Il flash è costruito da `BuildTicketConfirmationDataAction` e il caricamento
  della pagina usa `ResolveTicketConfirmationDataAction`; il resolver deve
  mantenere il fallback `?code=` senza esporre dati privati. [Source: `laravel/Modules/Fixcity/app/Actions/ResolveTicketConfirmationDataAction.php`]
- La UI pubblica è server-rendered via Folio/CMS; non va introdotto un controller
  o una pagina URL-specifica. [Source: bmad-output/architecture.md#ADR-002--ui-boundary]
- Il contratto di prodotto richiede conferma e capability code dopo l'invio.
  [Source: bmad-output/prd.md#FR-003-must--confirmation-and-tracking]
- Il blocco canonico è configurato in
  `laravel/Modules/Fixcity/config/database/content/pages/tickets.confirmation.json` e la
  view è `laravel/Themes/Sixteen/resources/views/components/blocks/flow/ticket/segnalazione/04-conferma.blade.php`.
  [Source: bmad-output/decision-log.md]
- Il riferimento visuale è
  `https://italia.github.io/design-comuni-pagine-statiche/sito/segnalazione-04-conferma.html`.
  La mappa è una verifica dello step riepilogo, non un controllo editabile nella
  ricevuta post-salvataggio. [Inference, coerente con DCP-34]
- Stack vincolato: TailwindCSS + Alpine.js + Lit + DaisyUI + Flowbite + Filament;
  Bootstrap Italia resta solo riferimento esterno. [Source: bmad-output/project-context.md#core-constraints]

## Testing

- **Approach:** unit test del payload/redirect, feature test della pagina con
  session payload e codice, browser screenshots responsive e audit WCAG.
- **Key scenarios:** submit valido; codice assente; codice query valido; sessione
  scaduta; lingua italiana/inglese; viewport mobile/tablet/desktop.
- **Per-AC verification:** AC #1 → redirect assertion e payload; AC #2 → JSON
  block resolution; AC #3/#4/#5 → DOM/screenshot/axe; AC #6 → capability lookup
  con allowlist pubblica.
- **Fixtures / mocks:** UserFactory, TicketFactory, Storage::fake, session
  confirmation bag, ticket status pending.
- **Edge cases:** query code inesistente, doppio refresh, HTML traduzioni, assenza
  di email, link focus-visible e assenza overflow orizzontale.

## Dependency Maps

- **Blocked by:** DCP-32, DCP-33, DCP-34 — il ciclo deve avere wizard e riepilogo coerenti.
- **Blocks:** citizen vertical slice 2.1 — la conferma è il passaggio verso tracking.
- **External:** riferimento statico Design Comuni e browser Chromium/Playwright per parity.

## Owned File/Module Scope

- `laravel/Modules/Fixcity/app/Filament/Widgets/CreateTicketWizardWidget.php`
- `laravel/Modules/Fixcity/app/Actions/BuildTicketConfirmationDataAction.php`
- `laravel/Modules/Fixcity/app/Actions/ResolveTicketConfirmationDataAction.php`
- `laravel/Modules/Fixcity/resources/views/pages/tickets/confirmation.blade.php`
- `laravel/Modules/Fixcity/config/database/content/pages/tickets.confirmation.json`
- `laravel/Themes/Sixteen/resources/views/components/blocks/flow/ticket/segnalazione/04-conferma.blade.php`
- `laravel/Modules/Fixcity/tests/Unit/Actions/CreateTicketConfirmationFlowTest.php`
- `laravel/Modules/Fixcity/tests/Unit/Actions/ResolveTicketConfirmationDataActionTest.php`
- `laravel/Modules/Fixcity/tests/Feature/Filament/CreateTicketWizardWidgetTest.php`
- Shared/contended: `laravel/Themes/Sixteen/resources/css/` — serializzare con altre story visuali.

## Learnings from Previous Stories

- Il wizard deve restare Filament e la mappa deve restare di proprietà del modulo
  Geo; non duplicare markup o stato in Sixteen. (DCP-33/DCP-34)
- Il metodo Livewire schema va risolto al confine condiviso Xot/Filament, non con
  un metodo fittizio nella pagina. (investigation-livewire-schema-method)
- I claim di parity sono validi solo con screenshot e DOM evidence alle tre viewport.

## Dev Agent Record

_(empty — da completare dall'external dev tool)_
