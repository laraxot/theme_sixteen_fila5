---
id: dcp-110
title: "DCP-110: area personale vera, 'Le mie segnalazioni' e 'Segnalazioni che seguo'"
type: story
epic: dc-parity-v2
status: done
priority: P0
owner: module:Fixcity
created: 2026-10-13
updated: 2026-10-13
qmd: "area personale pratiche seguite le mie segnalazioni segnalazioni che seguo owner_id tracciamento codice capability token auth middleware personal-area-practices BuildPersonalAreaPracticesDataAction BuildPersonalAreaFollowedDataAction multilingua it en de es"
related: [dcp-106, dcp-97, dcp-42, dcp-102, dcp-111, dcp-120]
tags: [docs, sixteen, bmad]
---

# DCP-110: le due pagine dell'area personale che il menu promette

## Scopo e perche'
Il menu utente dell'header (DCP-106) puntava a `/it/area-personale/pratiche` e `/seguite`, che rispondevano 200 con `<main>` vuoto (la pagina dinamica del tema risponde 200 a qualunque URL a due segmenti senza JSON). Regola dell'utente: «tutto deve avere un senso, uno scopo, una funzionalita'». Ora sono pagine vere, solo da autenticati, in it, en, de, es:
- **Le mie segnalazioni** (`/{lang}/area-personale/pratiche`): le segnalazioni di cui l'utente e' PROPRIETARIO (`owner_id`), divise in "In corso" e "Concluse", ciascuna con titolo, stato, data, codice di tracciamento, link al dettaglio `/{lang}/tickets/{id}` e al tracciamento `/{lang}/tickets/track/{code}`; CTA "Nuova segnalazione"; link alle impostazioni di notifica; stato vuoto che spiega cosa fare.
- **Segnalazioni che seguo** (`/{lang}/area-personale/seguite`): i ticket seguiti, SEMPRE collegati al tracciamento per codice (`/{lang}/tickets/track?code=...`, mai per id del database); senza codice la riga dice «Il codice di tracciamento non e' disponibile per questa segnalazione.».
Un ospite viene reindirizzato al login localizzato (`/it/auth/login`, `/en/auth/login`).

## Decisioni
1. **Architettura della casa**: pagine JSON CMS (`area-personale.pratiche.json`, `area-personale.seguite.json`) con `"middleware": ["auth"]` ESATTAMENTE, `"layout": "design-comuni"`, `id` = `slug` = nome del file; un solo blocco adattatore del tema per lingua; copia identica tenant `local` e modulo Fixcity. Nessun testo nel JSON: i testi stanno in `fixcity::personal_area` (it, en, de, es). Le pagine de/es non hanno contenuto proprio nel JSON: i blocchi sono tutti lo stesso adattatore, quindi la lingua la decide il file lang (il fallback del CMS per de/es e' l'italiano e qui non conta).
2. **Dati nelle Action** (final, strict_types, QueueableAction): `BuildPersonalAreaTicketRowAction` (riga di presentazione), `BuildPersonalAreaPracticesDataAction` (solo proprietario, in corso/concluse), `BuildPersonalAreaFollowedDataAction`. Riusano `BuildAuthenticatedUserTicketsQueryAction` (esteso con `?UserContract $user`, e senza utente la query ora e' VUOTA: `where owner_id = null` diventerebbe `IS NULL`) e `BuildAuthenticatedUserFollowedTicketsQueryAction` (invariata: ticket visibili per stato oppure propri).
3. **Stati reali** (`TicketStatusEnum`): concluse = `resolved`, `closed`; tutti gli altri (anche `draft`) sono in corso. Le etichette sono in `personal_area.status.*` (una per valore dell'enum, test di parita') e al femminile ("Risolta", "Chiusa") perche' l'oggetto e' la segnalazione; le etichette dell'enum (`ticket_status_enum`) sono al maschile e in de/es mancano (ricadrebbero sull'italiano).
4. **Tracciamento in due forme perche' i test lo impongono**: `/tickets/track/{code}` in "Le mie segnalazioni" (come il link della ricevuta, che DCP-90 reindirizza a `?code=`), `/tickets/track?code={code}` in "Che seguo". Il codice e' un capability token: compare solo nelle righe consegnate dalla query autorizzata (proprietario o seguace con ticket visibile).
5. **Taglio dichiarato**: al massimo 100 righe per pagina; `total` e' sempre il numero vero e la vista scrive «Sono mostrate le ultime :shown segnalazioni su :total.» (niente taglio silenzioso).
6. **Markup del riferimento** (`segnalazione-area-personale`, variante `list`): `cmp-heading`, `cmp-nav-tab`, `cmp-navscroll`, `it-page-section`, `cmp-filter__title`, `cmp-accordion`, `cmp-icon-list`, `cmp-card`. Cio' che il riferimento ha ma qui non farebbe nulla e' stato lasciato fuori, non finto: Filtra, Ordina, Cerca (le sezioni in corso/concluse sono gia' il filtro, l'ordine e' sempre dal piu' recente), fascia contatti con `#`, modale messaggi. Le "schede" del riferimento sono qui `<nav>` con quattro link veri (pratiche, seguite, notifiche, impostazioni; le ultime due sono le pagine di DCP-111) e `aria-current="page"`, con `flex-wrap`: senza, a 375 px "Notifiche" e "Impostazioni e privacy" erano tagliate dall'`overflow-x:hidden` del CSS generato e irraggiungibili.
7. **Indice laterale** solo con due sezioni; copia propria del partial (`personal-area-practices/navscroll`) perche' quello condiviso lascia la barra di avanzamento senza nome accessibile (axe `aria-progressbar-name`, serious).
8. **Stato vuoto onesto in "Che seguo"**: nei dati di sviluppo l'utente segue 3 ticket `pending` di altri; la query esistente li nasconde (non sono ancora pubblici) quindi il testo non dice "non segui nulla" ma «Nessuna segnalazione da mostrare» e spiega che compaiono quando diventano pubbliche.
9. **(3) `/{lang}/area-personale` -> redirect a pratiche: NON fatto.** Risponde 404 e un redirect richiede di modificare `pages/[container0]/index.blade.php` (Folio condiviso, branch `match` + redirect dentro un componente Volt) o una pagina Folio `pages/area-personale/` che potrebbe oscurare le due pagine a due segmenti; tutto in file altrui. Il menu e la navigazione non lo usano. Proposta per la sessione tema: una voce nel `match` della pagina `[container0]` che fa `redirect()->to(localizzato('/area-personale/pratiche'))`.

## File creati
Modulo Fixcity (`laravel/Modules/Fixcity/`): `app/Actions/BuildPersonalAreaTicketRowAction.php`, `BuildPersonalAreaPracticesDataAction.php`, `BuildPersonalAreaFollowedDataAction.php`; `lang/{it,en,de,es}/personal_area.php`; `config/database/content/pages/area-personale.{pratiche,seguite}.json`; test `tests/Feature/Actions/BuildPersonalAreaPracticesDataActionTest.php`, `BuildPersonalAreaFollowedDataActionTest.php`, `tests/Feature/Pages/PersonalAreaPagesTest.php`, `tests/Unit/PersonalAreaPagesJsonGuardTest.php`, `PersonalAreaLangParityTest.php`.
Tenant: `laravel/config/local/fixcity/database/content/pages/area-personale.{pratiche,seguite}.json` (identici byte per byte alle copie del modulo, guardia nel test). Non creata la copia `config/eu` (li' esistono solo 4 pagine).
Tema Sixteen (`Themes/Sixteen/resources/views/components/blocks/personal-area-practices/`): `design-comuni.blade.php` (pratiche), `followed.blade.php` (seguite), `heading.blade.php`, `section.blade.php`, `empty.blade.php`, `navscroll.blade.php`.
Modificati: `BuildAuthenticatedUserTicketsQueryAction.php` (parametro opzionale, query vuota senza utente, ordine secondario per id); `BuildAuthenticatedUserTicketsQueryActionTest.php` (2 test in coda). Non toccati: report-area, header, layouts, wizard, `TicketPagesTest` e gli altri test di altre story.

## Misure reali (2026-10-13 ~17:00-17:30)
- **Test** (`APP_ENV=testing DB_CONNECTION=sqlite ./vendor/bin/pest`): `CitizenMyTicketsDetailLinkTest` 2/2 verdi (erano rossi); `FollowedTicketsPageTest` 2/3: i due della pagina verdi, il terzo (rate limit del tracking, 10 richieste al minuto) resta rosso ed e' di DCP-102; nuovi: Action 16 test (pratiche 11, seguite 5) + query action 3, pagine 32 (ospite it/en/de/es x 2 pagine, un solo h1 e titolo localizzato, navigazione, proprietario per stato, privacy tra due cittadini, stato vuoto, quattro lingue, tracciamento per codice, nessun link `#`), guardie JSON 9 (middleware esattamente `["auth"]`, layout, id/slug, un blocco per lingua, copie identiche) e parita' lang 2. Regressione: Cms `ContentIntegrityGuardTest`, `TicketCreate*Guard`, `HeaderActiveGuardTest`, `HeaderAccountMenuTest`, `TicketConfirmationPageTest`, `TicketGuestLocaleRedirectTest` verdi (43).
- **PHPStan** (config unica): zero errori su Action, lang, JSON-guardie e tutti i test creati (14 file).
- **curl** (dev `http://192.168.1.40:8000`): ospite `/it` e `/en` x pratiche e seguite -> 302 a `/{lang}/auth/login`; loggato (utente `master_admin` di sviluppo) 200 in it, en, de, es con `<title>` e `h1` localizzati; dopo ogni `view:clear` `/it`, `/it/tickets`, `/it/tests/homepage` -> 200.
- **Screenshot Playwright letti** a 375, 768, 1440 (un browser alla volta): nessuno scroll orizzontale in nessuna lingua (it, en, de, es), tab di navigazione 52 px, bottoni, voci della fisarmonica e link interni >= 44 px (primo link 48 px), menu utente apribile ovunque. Stato vuoto, con dati, voce aperta controllati.
- **axe-core** (`wcag2a`, `wcag2aa`, `wcag21aa`, `best-practice`, con la prima voce aperta) su it ed en, sia con dati sia sullo stato reale: **0 violazioni dentro `#main-container`**. Restano fuori ambito (vedi sotto): la barra Debugbar di sviluppo (color-contrast serious), `button-name` critical dell'header a 375 px, `heading-order` e `landmark-unique` (moderate).
- **Parity con `/it/tests/segnalazione-area-personale`** (scheda 3, variante `list`): metodo = stili calcolati di 12 elementi omologhi (breadcrumb, h1, sottotitolo, tab attiva, bottone e link dell'indice, titolo sezione, bottone fisarmonica, etichetta stato, data, voce `list-item`, codice) x 10 proprieta' (font, peso, interlinea, colore, famiglia, margini, padding, spaziatura) + posizione x: **120 su 120 uguali a 375, 768 e 1440**; x del titolo sezione uguale (dopo aver adottato `px-0 px-sm-3` della variante `list`); la larghezza del titolo differisce solo perche' il testo e' diverso ("In corso (3)" contro "Pratiche"). Le altezze di pagina cambiano con i dati: non e' un difetto. Classi del riferimento non usate: filtri, ricerca, chip, schede messaggio; classi mie in piu': `flex-wrap`, `icon-white`, `mt-2`, `text-decoration-underline` (tutte presenti nel CSS generato).
- Metodo dei dati: nel DB di sviluppo l'utente non ha segnalazioni proprie (0) e segue 3 ticket `pending` non visibili, quindi le pagine REALI mostrano gli stati vuoti. Gli stati con dati sono stati resi da un test usa-e-getta (transazione, dati inventati solo nel test, mai nel DB) e il `<main>` inserito nella pagina reale di sviluppo (header, CSS, JS veri) servita da un proxy locale di misura nello scratchpad; nessuna scrittura nel DB di sviluppo.

## Non verificato
- Pagine con segnalazioni vere nel DB di sviluppo (non ce ne sono per questo utente): provato con dati di test e con i test Pest, non con click end-to-end sul server.
- Traduzioni de ed es fedeli ma non riviste da madrelingua; "incidencia" (es) come nell'header, "Meldung" (de).
- Lettore di schermo reale; browser diversi da Chromium; touch su dispositivo vero.
- Nessuna copia `config/eu`: se il tenant `eu` viene servito, le due pagine rispondono come "senza JSON" (200 vuoto). Rischio basso (il tenant di sviluppo e' `local`).
- Il terzo test di `FollowedTicketsPageTest` (rate limit) e' di DCP-102.

## Difetti fuori ambito (non toccati)
1. `Themes/Sixteen/resources/views/components/sections/header/design-comuni.blade.php:74`: il bottone `#header-user-toggle` sotto `lg` non ha nome accessibile (`d-none d-lg-block` sul nome, icona `aria-hidden`): axe `button-name` **critical** a 375 px su ogni pagina da loggato. `partials/user-dropdown.blade.php:13` lo fa giusto con `aria-label`.
2. `Themes/Sixteen/resources/views/components/blocks/report-partials/navscroll.blade.php:17`: `role="progressbar"` senza nome (axe `aria-progressbar-name` serious) in ogni pagina `report-area`; correzione = `aria-label` come nella copia di questa story.
3. `sections/header/design-comuni.blade.php:49` (`landmark-unique`, moderate) e `sections/footer/design-comuni.blade.php:49` (`h4` dopo `h1`, `heading-order`, moderate).
4. `/it/area-personale` risponde 404 (decisione 9).
5. `Modules/Fixcity/tests/Feature/Actions/PersonalAreaNotificationsActionsTest.php` (DCP-111): le etichette di stato de/es erano rosse mentre quella story era in corso.
6. Codice morto: `Themes/Sixteen/resources/views/pages_old/area-personale/{pratiche,seguite}.blade.php` e `Modules/User/resources/views/pages/area-personale/{pratiche,servizi}.blade.php` non sono mai raggiunti (la pagina del tema li oscura); da archiviare in una story di pulizia.
7. Debugbar visibile nelle schermate e negli audit (`APP_DEBUG` su dev): inquina axe e le altezze; da spegnere per le misure.
8. Le etichette di stato dell'enum sono al maschile ("Risolto") e mancano in de/es: la pagina di tracciamento potrebbe mostrare un'etichetta diversa da questa pagina.

## Rischi
- La query dei seguiti nasconde i ticket non pubblici anche se l'utente li segue (policy esistente, test `BuildAuthenticatedUserFollowedTicketsQueryActionTest`): chi ha seguito un ticket `pending` non lo vede finche' non e' preso in carico.
- `BuildAuthenticatedUserTicketsQueryAction::execute()` senza utente e senza login ora restituisce zero righe (prima, in teoria, quelle con `owner_id` nullo); il vecchio chiamante in `pages_old` e' compatibile.
- Il fallback del CMS per de/es e' l'italiano: se in futuro il JSON desse testi nei blocchi, de/es li mostrerebbero in italiano (qui no, tutto sta nei file lang).
