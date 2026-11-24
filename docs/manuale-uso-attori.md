---
title: "Manuale d'uso degli attori"
type: manual
status: active
---

# Manuale d'uso degli attori

## Scopo

Questo manuale descrive ciò che l'attore vede e può fare nel front office del tema Sixteen e indica quale componente possiede la regola:

- **Sixteen** possiede shell, navigazione, componenti visuali e integrazione Design Comuni;
- **CMS** possiede slug, contenuti, blocchi attivi e middleware dichiarati nei dati della pagina;
- **User** possiede autenticazione, profilo, ruoli e permessi;
- **Fixcity** e gli altri moduli possiedono dominio, dati, Action e autorizzazioni delle singole funzioni.

Il tema non è la fonte dei ruoli e non deve duplicare la sicurezza dei moduli.

## Attori

### Ospite

È un visitatore senza sessione autenticata.

Nel front office Sixteen può:

- visitare le pagine pubbliche risolte dal CMS;
- usare il login e la registrazione disponibili nelle pagine `auth`;
- consultare l'elenco pubblico delle segnalazioni e le pagine pubbliche abilitate;
- essere reindirizzato al login quando una funzione richiede autenticazione, per esempio la creazione di una segnalazione o l'area personale.

Non può accedere ai dati personali, alle pratiche proprie o alle funzioni protette. Il limite effettivo è imposto da middleware, widget e Action del modulo, non dal solo link visibile.

### Autenticato

È un utente con sessione valida. Può usare l'area personale e le funzioni per cui i moduli gli concedono accesso, tra cui, quando configurate:

- vedere le proprie pratiche e i relativi dettagli;
- seguire segnalazioni pubbliche;
- consultare notifiche e aggiornamenti;
- modificare preferenze e dati disponibili nel profilo;
- creare una segnalazione tramite il flusso protetto.

Il tema visualizza lo stato autenticato e i collegamenti; User/Fixcity verificano identità, proprietà della risorsa e capacità effettiva.

### Gruppo e team

Il gruppo/team è un perimetro organizzativo dell'utente. Nel codice di piattaforma la gestione dei team e del relativo `team_id` è in User e nella configurazione dei permessi.

Sixteen non assegna né interpreta autonomamente un gruppo: mostra solo le pagine e le azioni che il modulo rende disponibili. L'appartenenza a un gruppo non equivale automaticamente a essere admin o operatore.

### Ruolo

Il ruolo è una voce del sistema di permessi, gestita dal modello `Modules\\User\\Models\\Role` e da Spatie Permission. Il nome del ruolo non è una prova sufficiente per autorizzare un'azione nel tema: l'accesso deve passare da policy, gate, `canAccess()` o Action del proprietario.

Il ruolo speciale dimostrato dal codice è `super-admin` (`Role::SUPER_ADMIN`).

### Admin

`admin` è un attore del back office Filament, non una variante della pagina pubblica Sixteen. Il pannello, le risorse, le policy e la visibilità di navigazione appartengono a Filament e ai moduli.

Un admin può gestire gli oggetti che il pannello e le policy gli consentono. Non deve essere considerato automaticamente super-admin e non può creare o assegnare `super-admin` secondo la regola esplicita del modello Role.

### Super-admin

Il super-admin è il ruolo privilegiato dimostrato da `Role::SUPER_ADMIN`. Il codice consente a un super-admin di assegnare un altro super-admin; la gestione dei ruoli è comunque protetta da policy.

Le pagine operative sensibili di Xot che usano `SuperAdminOnlyTrait` sono accessibili solo a un utente autenticato con quel ruolo. Sixteen non implementa questa verifica e non deve sostituirla con controlli Blade.

### Operatore

Operatore è un attore di dominio usato dai flussi Fixcity quando il modulo assegna o gestisce segnalazioni. Sixteen fornisce la resa del front office e i componenti del flusso; non definisce nel tema l'elenco dei permessi dell'operatore.

Le assegnazioni, i cambi di stato, la visibilità dei dati e le policy devono essere verificati nelle Action, nei modelli e nelle policy di Fixcity. Un operatore non è automaticamente admin né super-admin.

## Flussi del front office

### Accesso e registrazione

Le pagine Folio attive sono sotto `resources/views/pages/auth`. Login e registrazione usano widget/componenti User dentro la shell Sixteen. La verifica email è una pagina autenticata e soggetta a throttling; logout effettua una richiesta POST con CSRF.

I link e i testi sono localizzati. Il tema non deve aggiungere una seconda pagina auth in cartelle semantiche o riattivare `pages_old`.

### Home e pagine pubbliche

La home `pages/index.blade.php` usa lo slug CMS `home`. Le pagine generiche usano gli entrypoint Folio `[container0]` e `[slug0]`; il contenuto viene risolto da CMS e renderizzato tramite `<x-page>`.

Il CMS seleziona i blocchi attivi e il tema seleziona la view del blocco. Il JSON può indicare layout e voce di navigazione attiva; Sixteen applica il chrome Design Comuni quando il layout lo richiede.

### Segnalazioni

Il tema presenta elenco, dettaglio, tracciamento e wizard secondo i blocchi e le pagine configurate. L'ospite può consultare solo ciò che il dominio pubblica; creazione, modifica, assegnazione, follow e dati personali sono verificati dai moduli.

### Area personale

I percorsi `area-personale/*` sono pagine CMS rese dal tema con blocchi condivisi. Sono destinati all'utente autenticato e devono limitare le query ai suoi dati. Sixteen non deve recuperare direttamente dati di altri utenti né implementare autorizzazioni parallele.

## Prerequisiti

- tenant e tema pubblico Sixteen configurati;
- locale supportato e middleware di localizzazione attivi;
- CMS JSON presente per lo slug richiesto;
- moduli User, Cms e dominio abilitati;
- sessione e guard configurati per i flussi autenticati;
- permessi/ruoli e, se usati, team presenti nel database;
- dati e Action del dominio disponibili per le pagine operative.

## Limiti

- `resources/views/pages_old` è archivio e non è un percorso Folio attivo;
- il tema non garantisce che un link produca autorizzazione: la sicurezza resta nei moduli;
- gruppo, ruolo e operatore non cambiano da soli la visibilità del front office;
- un JSON assente o uno slug non configurato può produrre 404 o una pagina senza contenuto, secondo il resolver;
- le pagine CMS non devono essere sostituite da pagine Folio semanticamente duplicate;
- il tema Sixteen dimostra il flusso front office, non una matrice completa dei permessi amministrativi.

## Inventario documentale e funzionalità osservabili

La documentazione utente è distribuita in [`manuals/manuale-utente.md`](manuals/manuale-utente.md), [`manuals/user-manual.md`](manuals/user-manual.md) e nel PDF [`manuals/manuale-utente.pdf`](manuals/manuale-utente.pdf). Questo manuale chiarisce invece attori e deleghe. La decisione architetturale è [`adr/front-office-theme-owns-presentation.md`](adr/front-office-theme-owns-presentation.md) e il contratto di shell è [`contracts/folio-page-shell.md`](contracts/folio-page-shell.md).

Il materiale visuale comprende [`screenshots/`](screenshots/), [`manuals/assets/front-office-home.png`](manuals/assets/front-office-home.png), i confronti Design Comuni e le immagini dei flussi `segnalazione-*` sotto `docs/prompts/` e `docs/visual-analysis/`.

Dal codice delle view sono osservabili homepage e pagine CMS generiche, autenticazione (login, registrazione, logout, reset e verifica), elenco e dettaglio delle segnalazioni, wizard di creazione, area personale, servizi, eventi, news/blog, ricerca, accessibilità, contatti e mappe. La disponibilità effettiva dipende da slug CMS, tenant e moduli abilitati; la presenza della view non equivale a una verifica HTTP in ogni configurazione.

## Fonti

- [`Themes/Sixteen/resources/views/pages/index.blade.php`](../resources/views/pages/index.blade.php)
- [`Themes/Sixteen/resources/views/pages/[container0]/index.blade.php`](../resources/views/pages/%5Bcontainer0%5D/index.blade.php)
- [`Themes/Sixteen/resources/views/pages/[container0]/[slug0]/index.blade.php`](../resources/views/pages/%5Bcontainer0%5D/%5Bslug0%5D/index.blade.php)
- [`Themes/Sixteen/resources/views/pages/auth`](../resources/views/pages/auth)
- [`Themes/Sixteen/resources/views/components/page.blade.php`](../resources/views/components/page.blade.php)
- [`Themes/Sixteen/docs/page-directory-structure.md`](page-directory-structure.md)
- [`Modules/Cms/app/Providers/FolioVoltServiceProvider.php`](../../../Modules/Cms/app/Providers/FolioVoltServiceProvider.php)
- [`Modules/User/app/Models/Role.php`](../../../Modules/User/app/Models/Role.php)
- [`Modules/Xot/app/Filament/Traits/SuperAdminOnlyTrait.php`](../../../Modules/Xot/app/Filament/Traits/SuperAdminOnlyTrait.php)
- [`Modules/Fixcity`](../../../Modules/Fixcity)

