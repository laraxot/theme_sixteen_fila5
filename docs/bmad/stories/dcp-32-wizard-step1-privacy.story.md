---
id: dcp-32
title: "Step privacy del wizard di creazione segnalazione"
type: story
epic: dc-parity-v2
status: ready-for-dev
priority: P1
owner: Modules/Fixcity + Themes/Sixteen
created: 2026-10-13
updated: 2026-10-13
qmd: "dcp 32 filament wizard privacy consenso informativa segnalazione 01 parity"
related:
  - dcp-00-epic-design-comuni-parity-v2.story.md
  - dcp-16-segnalazione-01-privacy.story.md
  - dcp-33-wizard-step2-dati.story.md
  - dcp-34-wizard-step3-riepilogo.story.md
  - dcp-35-conferma-parity.story.md
tags: [docs, sixteen, bmad]
---
> Numerazione: esiste un'altra DCP-32 della sessione tema ([scope data-dc](dcp-32-scope-data-dc-pagine-reali.story.md)); questa ne dipende (lo scope CSS delle pagine reali). Registro: [DCP-97](dcp-97-registro-flusso-tickets-numerazione-e-coordinamento.story.md).


# DCP-32 — Step privacy del wizard di creazione segnalazione

## Story

Come cittadino autenticato,
voglio leggere l'informativa privacy e accettarla nel primo passo del wizard Filament,
così da poter procedere alla compilazione della segnalazione con un'interfaccia coerente
con `segnalazione-01-privacy.html`, accessibile e senza perdere lo stato Livewire.

## Scope e obiettivo

Lo scope è il primo step della pagina CMS `tickets.create`, visualizzato dal
`CreateTicketWizardWidget` all'URL localizzato `/it/tickets/create` (e relativo locale
supportato). Il riferimento visuale è:

`https://italia.github.io/design-comuni-pagine-statiche/sito/segnalazione-01-privacy.html`

Il wizard deve rimanere un wizard Filament. Il modulo Fixcity resta proprietario di
schema, validazione, stato e salvataggio; il tema Sixteen resta proprietario del guscio
visuale, del markup del widget e degli stili condivisi. Lo stack UI ammesso è
TailwindCSS + Alpine.js + Lit + DaisyUI + Flowbite, con Filament per il form.

### Fuori scope

- Modificare routing, middleware, controller o la risoluzione delle pagine CMS.
- Creare una Blade dedicata all'URL o sostituire il wizard con navigazione manuale.
- Aggiungere dipendenze, componenti paralleli o stili globali non necessari.
- Implementare gli step dati, riepilogo o conferma: sono coperti dalle story collegate.

## Acceptance Criteria

### AC1 — Shell e contesto della pagina

Dato un utente autenticato che apre `/it/tickets/create`, quando viene mostrato il primo
step, allora sono presenti breadcrumb, titolo pagina, eventuale descrizione CMS, barra
degli step e area contatti nel guscio del widget Sixteen; il markup non espone chiavi di
traduzione raw, errori PHP o testo di debug.

### AC2 — Informativa privacy

Dato che `GetPublishedPrivacyPolicyAction` restituisce una policy pubblicata, quando il
primo step viene renderizzato, allora il contenuto Markdown sanitizzato della policy è
visibile, il titolo duplicato iniziale non viene ripetuto e il link all'informativa
completa usa l'URL localizzato, `target="_blank"` e `rel="noopener"`.

### AC3 — Policy non configurata

Dato che non esiste una policy pubblicata, quando il primo step viene renderizzato,
allora viene mostrato un avviso accessibile con il link alla pagina privacy e il controllo
di consenso non consente di procedere; nessun contenuto di policy vuoto viene presentato
come informativa valida.

### AC4 — Consenso obbligatorio e stato Livewire

Dato il controllo di consenso, quando l'utente lo seleziona o deseleziona, allora il valore
è sincronizzato con `data.privacyAccepted`; il campo è obbligatorio, usa l'etichetta
italiana o inglese della locale corrente e conserva gli attributi `data-element="privacy-consent"`,
`aria-describedby="ticket-privacy-error"` e `aria-invalid` coerenti con la validazione.

### AC5 — Validazione e blocco dell'avanzamento

Dato che il consenso non è selezionato, quando l'utente tenta di avanzare, allora il wizard
resta nello step privacy, il campo riceve lo stato di errore e il messaggio è annunciabile
tramite `#ticket-privacy-error`; dato un consenso valido e una policy disponibile,
l'avanzamento verso lo step dati è possibile senza `MethodNotFoundException` né errori
JavaScript in console.

### AC6 — Parità visuale e responsive

Dato il riferimento Design Comuni, quando la pagina viene confrontata a 375×900,
768×1000 e 1440×1200, allora struttura, gerarchia tipografica, spaziature, colori,
stati di focus/errore, controllo checkbox, stepper, callout e azioni risultano coerenti;
non compare overflow orizzontale e i controlli restano utilizzabili da tastiera e touch.
La valutazione deve essere documentata con screenshot comparabili; non dichiarare una
percentuale di parity senza evidenza.

### AC7 — Accessibilità

Dato il primo step, quando viene sottoposto a verifica automatizzata e manuale, allora
ogni input ha un'etichetta associata, gli errori sono collegati al controllo, il focus è
visibile, il contrasto del testo è sufficiente, il link esterno è esplicitato e il flusso
è completabile da tastiera con lettore di schermo.

## Tasks / Subtasks

- [ ] T1. Verificare il contratto di rendering del widget tema e mantenere il root
      `pub_theme::filament.widgets.create-ticket-wizard`. (AC: #1, #6)
- [ ] T2. Allineare breadcrumb, heading, stepper e contatti ai dati ricevuti in
      `blockData`, senza hardcodare copy nella view. (AC: #1, #6)
- [ ] T3. Verificare `getGdprHtml()` e il rendering di `gdpr-notice`, inclusa sanitizzazione,
      rimozione del titolo duplicato e URL privacy localizzato. (AC: #2, #3)
- [ ] T4. Verificare lo schema `getPrivacySchema()` e il componente custom del checkbox;
      correggere solo markup o classi condivise necessarie per il contratto Filament.
      (AC: #4, #7)
- [ ] T5. Verificare la validazione `accepted|required`, il focus sull'errore e la
      sincronizzazione Livewire del campo `data.privacyAccepted`. (AC: #4, #5, #7)
- [ ] T6. Verificare l'avanzamento del wizard tramite l'API Filament esistente e il
      ponte pubblico `callSchemaComponentMethod` del base widget; non aggiungere metodi
      specifici alla pagina. (AC: #5)
- [ ] T7. Applicare esclusivamente gli stili condivisi del widget necessari a replicare
      shell, callout, checkbox, stepper e azioni nello stack UI previsto. (AC: #6, #7)
- [ ] T8. Aggiornare o aggiungere test unitari/feature per rendering locale, policy
      assente, consenso, errore e avanzamento; aggiungere la matrice screenshot alle
      verifiche browser. (AC: #2, #3, #4, #5, #6, #7)
- [ ] T9. Eseguire il controllo di scope BMAD e lasciare nel record della story gli
      esiti, gli screenshot e gli eventuali limiti residui. (AC: #6)

## Dev Notes

### Contratto applicativo

- `laravel/Modules/Fixcity/app/Filament/Widgets/CreateTicketWizardWidget.php` espone
  `mount`, `getSteps`, `save`, `submit` e `redirectAfterSuccess`; usa
  `TicketForm::getDefaultFormState()` e risolve la view tramite convenzione del base
  widget. Non dichiarare una view property che bypassi questa risoluzione.
- `laravel/Modules/Fixcity/app/Filament/Resources/TicketResource/Schemas/TicketForm.php`
  definisce `getSteps()` e `getPrivacySchema()`. Il consenso è lo stato
  `privacyAccepted`, mentre policy e URL sono forniti da
  `GetPublishedPrivacyPolicyAction` e `LaravelLocalization`.
- `laravel/Modules/Fixcity/app/Actions/GetPublishedPrivacyPolicyAction.php` è la fonte
  applicativa della policy pubblicata: non leggere file o database direttamente dalla
  view.
- `laravel/Modules/Xot/app/Filament/Widgets/XotBaseWizardWidget.php` è il base widget
  condiviso. Il comportamento di avanzamento deve usare il contratto Filament/Xot già
  esistente, non un metodo Livewire inventato nel tema.

### Contratto tema e contenuti

- `laravel/Themes/Sixteen/resources/views/filament/widgets/create-ticket-wizard.blade.php`
  è il wrapper visuale del widget. Conservare `{{ $this->form }}` e le modali Filament;
  usare `blockData` per breadcrumb, titolo, descrizione, navigazione e contatti.
- `laravel/Modules/Fixcity/resources/views/components/gdpr-notice.blade.php` contiene
  il markup dell'informativa; `laravel/Modules/Fixcity/resources/views/filament/forms/components/`
  contiene il renderer del consenso. Le view non devono reimplementare lo stato del form.
- `laravel/config/local/fixcity/database/content/pages/tickets.create.json` è la fonte
  dei contenuti italiani/inglesi del blocco `ticket_create`, inclusi titolo, breadcrumb,
  navigazione e contatti. Le label del form provengono da
  `laravel/Modules/Fixcity/lang/it/ticket_form.php` e dalla locale inglese equivalente.

### Regole di implementazione

- Preferire classi e componenti già presenti nel tema e nello stack dichiarato; non
  introdurre un secondo sistema di layout o una pagina specifica per lo step.
- Non inserire copy italiana nella view quando la stessa informazione è già in JSON o
  nelle traduzioni.
- Escapare dati utente e mantenere la policy sanitizzata prima del rendering HTML.
- Mantenere `data-element="privacy-consent"`, `aria-invalid`, `aria-describedby` e
  l'identificatore `ticket-privacy-error`: sono contratti verificabili dai test.

## Testing strategy

1. **Unit:** verificare che `TicketForm::getPrivacySchema()` esponga il controllo
   `privacyAccepted`, che lo stato iniziale sia `false`, che sia required/accepted e che
   l'HTML della policy non duplichi il titolo.
2. **Feature/Livewire:** autenticare un utente, renderizzare il widget in italiano e
   inglese, verificare titoli/etichette, policy presente/assente, errore senza consenso,
   avanzamento con consenso e assenza di eccezioni Livewire.
3. **Browser:** usare il test esistente
   `laravel/Modules/Fixcity/tests/Playwright/ticket-create-e2e.spec.js` per il controllo
   del campo e aggiungere/verificare il percorso tastiera e gli stati del checkbox.
4. **Visual:** acquisire reference e local a 375×900, 768×1000 e 1440×1200; confrontare
   body, stepper, callout, checkbox, azioni e contatti. Salvare l'evidenza nella cartella
   `laravel/Themes/Sixteen/docs/visual-comparison/` senza modificare questa story per
   risultati non ancora verificati.
5. **Accessibility:** eseguire audit WCAG 2.2 AA sul primo step, includendo contrasto,
   focus, nome/ruolo/valore, associazione errori e assenza di overflow.

## Dependencies

### Blocked by

- DCP-00 — convenzioni e obiettivi dell'epic Design Comuni parity v2.
- DCP-16 — requisiti funzionali e visuali della pagina privacy di riferimento.

### Blocks

- DCP-33 — lo step dati deve riusare il guscio e il contratto di navigazione stabiliti
  dal wizard.
- DCP-34 — lo step riepilogo deve conservare la stessa barra passi e la stessa shell.
- DCP-35 — la conferma deve ricevere il flusso di submit senza regressioni.

## Owned File / Module Scope

Questa story può modificare soltanto i seguenti ambiti, salvo aggiornamenti ai test
direttamente necessari alla verifica degli AC:

- `laravel/Themes/Sixteen/resources/views/filament/widgets/create-ticket-wizard.blade.php`
- `laravel/Themes/Sixteen/resources/css/` — solo fogli condivisi già collegati al widget
- `laravel/Modules/Fixcity/resources/views/components/gdpr-notice.blade.php`
- `laravel/Modules/Fixcity/resources/views/filament/forms/components/`
- `laravel/Modules/Fixcity/lang/it/ticket_form.php`
- `laravel/Modules/Fixcity/lang/en/ticket_form.php`
- `laravel/Modules/Fixcity/tests/Feature/Pages/TicketCreatePageMetadataTest.php`
- `laravel/Modules/Fixcity/tests/Playwright/ticket-create-e2e.spec.js`

Non sono di proprietà di questa story `TicketForm.php`, `CreateTicketWizardWidget.php`,
le configurazioni di routing e i file delle story collegate: vanno modificati solo da
story esplicitamente proprietarie di quei moduli.

## Learnings from Previous Stories

- La pagina CMS e il widget Filament sono due livelli distinti: il JSON fornisce i
  contenuti del guscio, mentre lo schema Fixcity fornisce campi e stato.
- Il campo privacy ha un renderer custom perché il controllo deve mantenere il contratto
  Filament/Livewire e, allo stesso tempo, offrire markup semantico e accessibile.
- Il bridge Livewire/schema è condiviso dal base widget; duplicarlo nella view o creare
  un metodo pagina-specifico provoca regressioni di dispatch.
- Una parity visuale è una verifica da screenshot e viewport dichiarati, non una stima
  basata sul solo HTML.

## Dev Agent Record

<!-- Leave empty. The external development agent records implementation, tests,
     screenshots, deviations and handoff evidence here. -->
