---
id: dcp-40
title: "Radice del Volt nella pagina generica: il wizard di tickets/create non risponde"
type: story
epic: dc-parity-v2
status: done
priority: P0
owner: theme:Sixteen
module: Sixteen
created: 2026-10-13
updated: 2026-10-13
tags: [bugfix, livewire, volt, tickets-create]
qmd: "dcp-40 Radice del Volt nella pagina generica: il wizard di tickets/create non risponde"
related: [Modules/Fixcity/docs/stories/dcp-35-tickets-create-privacy-dati-coordinamento.story.md, Modules/Fixcity/docs/stories/dcp-43-wizard-passo2-viste-design-comuni.story.md]
---

# DCP-40: radice del Volt nella pagina generica

## Richiesta (2026-10-13)
L'utente ha incollato `MethodNotFoundException: Public method [callSchemaComponentMethod] not found on component` da `POST /livewire-b075fdcb/update`, referer `http://192.168.1.40:8000/it/tickets/create`.

## Analisi (scopo del codice, non solo l'errore)
- `/it/tickets/create` e' servita da `Themes/Sixteen/resources/views/pages/[container0]/[slug0]/index.blade.php`: Folio `container0.view`, componente Volt `@volt('container0.view')`, che rende `<x-page>`; il blocco `ticket-crea` monta `CreateTicketWizardWidget` con `@livewire`.
- `cms::components.page` (`Modules/Cms/resources/views/components/page.blade.php`) non ha un elemento radice.
- Livewire inserisce `wire:id` nel primo tag a inizio riga dell'HTML del componente (`vendor/livewire/livewire/src/Drawer/Utils.php:16`, regex `(?:\n\s*|^\s*)<tag`). Blade/PHP mangia il ritorno a capo dopo `@endif`: il `<div>` del widget finiva sulla stessa riga dei commenti `<!--[if ENDBLOCK]-->` e non veniva scelto. Il `wire:id` del Volt andava sul `div.cmp-wizard-widget`, dentro il widget.
- Conseguenza: ogni `wire:model` e `callSchemaComponentMethod` dello schema Filament risaliva (`closest('[wire:id]')`) al Volt, che non ha `HasSchemas`. In console: `Livewire Entangle Error: Livewire property ['data.location'] cannot be found on component volt-anonymous-fragment-...` (5-7 errori al caricamento).

## Modifica
Il `div.page-content` (gia' presente) e' la radice del `@volt` nel ramo generico; le pagine speciali (login, registrazione, tracking, dettaglio) restano fuori dal Volt. DOM visibile identico, `wire:id` spostato sul wrapper. Decisione: `Themes/Sixteen/docs/decision-log/D15-volt-fragment-explicit-root.md`.

## Verifica (output reali)
- Prima: `closest('[wire:id]')` del checkbox = Volt. Dopo: `CreateTicketWizardWidget`.
- Browser: checkbox spuntato e "Successivo" portano a `?step=form.dati-di-segnalazione...` con stepper `2/3`; nessun errore Entangle; resta solo `<path> attribute d: Expected number` (SVG dell'header, presente anche su `/it/tickets/track`).
- Log Laravel: ultima riga `callSchemaComponentMethod` alle 14:40:00 (ora locale), prima della modifica; nessuna dopo il test.
- Snapshot normalizzati prima/dopo di `/it/auth/login`, `/it/auth/register`, `/it/tickets/track`, `/it/tickets`, `/en/tickets/create`: solo spazi, id Livewire, token CSRF e debugbar.
- Test di regressione (S3 di DCP-35): `Modules/Fixcity/tests/Feature/Pages/TicketCreateVoltRootTest.php` e `Unit/TicketCreatePageJsonGuardTest.php`: 3 test, 13 asserzioni verdi, PHPStan senza errori sui due file; il test Volt fallirebbe riproducendo il bug (provato spostando `wire:id` sul widget).

## Decisioni
- Scartato l'override di `callSchemaComponentMethod` in `XotBaseWizardWidget` (aggiunto da un altro agente alle 12:34 UTC): e' un no-op, il metodo e' gia' pubblico in `InteractsWithSchemas:83`; l'errore dei 12:39-12:40 UTC e' continuato con l'override attivo.

## Aperto
- `Modules/Xot/app/Filament/Widgets/XotBaseWizardWidget.php`: il docblock dell'override diceva che serviva; corretto dal lead il 2026-10-13 14:12 UTC (solo il commento: ora dice che l'override non e' un fix e rimanda a D15). L'override resta perche' `CreateTicketWizardWidgetViewTest` ne fissa la classe dichiarante; rimuoverlo e' decisione del proprietario di Xot.
- Il blocco `@volt` e `div.page-content` non vanno spostati: la regola vale per ogni blocco Livewire servito da questa pagina.

## Output allegati (comandi eseguiti dal lead il 2026-10-13)
Prima del fix (parse DOM di `/it/tickets/create`, elementi con `wire:id`: riga, tag, id, nome, classe, profondita'):
```
(414, 'div', 'jGdXrk4Kbd70WIyYFdkQ', 'Modules\\Fixcity\\Filament\\Widgets\\CreateTicketWizardWidget', 'fi-wi-widget fi-grid-col lg:fi-grid-col-span', 5)
(417, 'div', 'GZJx6gBfeDVYaneub8g9', 'volt-anonymous-fragment-eyJuYW1lIjoiY29udGFpbmVyMC52aWV3Iiwi', 'cmp-wizard-widget', 6)
```
Dopo il fix (`closest('[wire:id]')` in Playwright):
```
{ "cmpWizardOwner": "Modules\\Fixcity\\Filament\\Widgets\\CreateTicketWizardWidget",
  "widgetRoot":     "Modules\\Fixcity\\Filament\\Widgets\\CreateTicketWizardWidget",
  "checkboxOwner":  "Modules\\Fixcity\\Filament\\Widgets\\CreateTicketWizardWidget" }
```
Differenze snapshot normalizzati prima/dopo (righe `diff`): it/tickets/create 20, auth/login 10, auth/register 8, tickets/track 8, tickets 4, en/tickets/create 20 (solo whitespace, id Livewire, token CSRF, debugbar; su create la riga con `wire:id` si sposta da `div.cmp-wizard-widget` a `div.page-content`).
Log: `[2026-10-13 14:40:00] local.ERROR: ... callSchemaComponentMethod` e' l'ultima occorrenza (ora locale); nessuna dopo il test.
Test (2026-10-13 ~14:00 UTC, DB isolato come in DCP-45: `APP_CONFIG_CACHE=/nonexistent/config.php DB_DATABASE_LIMESURVEY=`; conteggi DB di sviluppo prima e dopo: `users=7 tickets=2`):
```
Tests:    6 passed (28 assertions)
  TicketGuestLocaleRedirectTest (it, en, API 401), TicketCreateVoltRootTest, TicketCreatePageJsonGuardTest (2)
scratch eliminato: 0 rimasti
```
Prima di D17 il test Volt (S3) aveva dato `3 passed (13 assertions)`. Il test Volt crea un utente con `UserFactory`: va lanciato solo con l'isolamento di DCP-45.
