---
qmd: "segnalazione flow parity zen"
title: "Segnalazione wizard parity — logica, perche', filosofia, religione, politica, zen"
type: decision
theme: Sixteen
confidence: high
created: 2026-10-13
updated: 2026-10-13
tags: [sixteen, design-comuni, wizard, filament, parity, zen, bmad]
related:
  - ../../../../../Modules/Fixcity/docs/tests-pages-content-files.md
  - ../../wiki/rules/cms-content-slug-matches-folio-page-name.md
  - ../../wiki/rules/no-controllers-rule.md
  - ../../wiki/rules/design-comuni-theme-css-only-rule.md
status: draft
---

# Segnalazione wizard parity — il perche' (zen)

## Obiettivo

`/it/tickets/create` (e i suoi step) con **alta visual parity** con
`design-comuni-pagine-statiche/sito/segnalazione-0{1,2,3,4}-*.html`:

| Step | URL | Riferimento |
|---|---|---|
| 1 privacy | `/it/tickets/create` | `segnalazione-01-privacy.html` |
| 2 dati + mappa | `?step=form.dati-di-segnalazione::data::wizard-step` | `segnalazione-02-dati.html` |
| 3 riepilogo + mappa | `?step=form.riepilogo::data::wizard-step` | `segnalazione-03-riepilogo.html` |
| 4 conferma | redirect dopo save → `/it/tickets/confirmation` | `segnalazione-04-conferma.html` |

## La logica

1. **Il form DEVE essere un Filament wizard** (`CreateTicketWizardWidget`
   estende `XotBaseWizardWidget`). Perché: l'architettura vieta i
   controller (`no-controllers-rule`): il layer HTTP e' Filament
   (backoffice E frontoffice, `filament-first-frontoffice`). La validazione,
   lo stato dei step, la reattività Livewire e il CSRF vengono dal framework,
   non riscritti a mano in Blade. Riscrivere il form in Blade "puro"
   violerebbe DRY e il contratto XotBase.
2. **La parity la fa il tema, non il vendor.** Filament renderizza
   `fi-*` (grid, fields, infolist); il tema Sixteen possiede il markup
   Design Comuni: la vista widget (`create-ticket-wizard.blade.php`)
   stila il guscio (heading, stepper shell) e il CSS del tema mappa
   le classi Filament su quelle Bootstrap Italia. Mai copiare il CSS
   di Bootstrap Italia da CDN (`regenerate-design-comuni-css.sh` lo
   compila nel bundle del tema) e mai CSS per singola pagina
   (`no-page-specific-css-lesson`).
3. **Il contenuto e' dato.** I testi degli step vivono nel JSON
   `tickets.create.json` (slug = nome pagina Folio, vedi la regola
   `cms-content-slug-matches-folio-page-name`), non nelle viste.
4. **La mappa serve a localizzare il danno.** Nei step dati e riepilogo
   il cittadino segna il punto esatto del disservizio
   (`Geo` coordinate-picker/map-picker): click/trascinamento → reverse
   geocoding (`$wire.callSchemaComponentMethod`, esposto da
   `InteractsWithSchemas`) → indirizzo compilato. Senza mappa il
   cittadino non puo' dire "dove e' il danno da riparare".

## La filosofia (religione)

- **No Bootstrap Italia via CDN**: il CSS e' compilato nel bundle del tema
  (3.3MB, contiene `title-xxxlarge`, `single-line-info`, `cmp-nav-steps`,
  `steppers-btn-*`): le classi esistono, basta usarle.
- **No controller, no service proxy**: Actions + Widgets + ViewModels.
- **Tema owner**: Sixteen e' il proprietario della resa Design Comuni;
  i moduli portano logica, il tema porta markup/CSS.
- **Boy scout**: ogni commit lascia il codice meglio di come l'ha trovato.

## La politica (AGID)

Il riferimento e' il sito ufficiale Design Comuni della PA italiana.
Alta visual parity = contratto istituzionale: il cittadino riconosce
il linguaggio visivo della PA, l'accessibilita' e' WCAG 2.1 AA
(contrasto, focus visibile, target touch, reduced-motion), e il
gate visivo non si chiude con uno screenshot isolato ma con
mobile/tablet/desktop evidence.

## Lo zen

> Il wizard non somiglia al riferimento: **e'** il riferimento,
> reso da Filament e vestito dal tema. Non combattere il vendor:
> stendilo. Non copiare la pagina: componila (blocchi + JSON).
> La mappa non e' un optional: e' il cittadino che indica il danno.
> La parity non e' un traguardo: e' una disciplina quotidiana.

## Evidence e stato 2026-10-13

- Heading del wizard corretto da Tailwind (`text-4xl font-bold
  text-slate-900`) a Bootstrap Italia (`title-xxxlarge`,
  `subtitle-small`, `cmp-heading pb-3 pb-lg-4`) in
  `Themes/Sixteen/resources/views/filament/widgets/create-ticket-wizard.blade.php`.
- `callSchemaComponentMethod` esiste su `XotBaseSchemaWidget` via
  `InteractsWithSchemas` (verificato a runtime con `php -r` +
  `getPublicMethodsDefinedBySubClass`): l'errore Livewire segnalato
  non si riproduce piu' (drag/click mappa OK, zero errori).
- Gap aperti: infolist riepilogo da mappare su `cmp-info-summary` +
  `single-line-info`; footer wizard su `cmp-nav-steps` + `steppers-btn-*`;
  conferma: verificare quale blocco serve la rotta dopo il refactor
  Volt in corso (`pages/[container0]/[slug0]/index.blade.php`).
