---
id: dcp-55
title: "Multilingua e dispositivi: comportamenti ed effetti (it, en, de, es; 375, 768, 1440)"
type: story
epic: dc-parity-v2
status: in-progress
priority: P0
owner: theme:Sixteen
module: Sixteen
created: 2026-10-13
updated: 2026-10-13
tags: [i18n, mobile, tablet, responsive, a11y]
related: [Themes/Sixteen/docs/bmad/stories/dcp-52-header-accesso-e-menu-utente.story.md]
qmd: "dcp-55 Multilingua e dispositivi: comportamenti ed effetti (it, en, de, es; 375, 768, 1440)"
---

# DCP-55: multilingua e dispositivi

## Richiesta (2026-10-13, utente)
Il sito deve essere multilingua; capire e studiare i comportamenti e gli effetti. Deve essere ottimizzato per cellulare e tablet.

## Impostazione
Misurare header, area personale e pagine principali in `it`, `en`, `de`, `es` a 375, 768 e 1440 px: chiavi grezze, ripiego sull'italiano nascosto, cambio lingua (mantiene la pagina?), attributo `lang`, `hreflang`, formati di data e numeri, bersagli tattili >= 44 px, overflow, testi che si spezzano, menu a tendina su touch, zoom consentito. Precedenti: memoria `i18n-fallback-it-hides-missing-translations`, validazione senza messaggi in it/de/es corretta oggi (`laravel/lang/{it,de,es}/validation.php`).

## Studio (subagent I18N-MOBILE)

Misure del 2026-10-13 sul sito di sviluppo, Playwright/Chromium con `hasTouch` e `isMobile` a 375 e 768, sessione autenticata per le pagine riservate, host esterni bloccati. "Verificato" = misura; "ipotesi" = lettura del codice. Comportamenti in forma durevole: `Themes/Sixteen/docs/wiki/concepts/multilingua-e-dispositivi-comportamenti.md`. Avvertenza: nella stessa ora altri agenti hanno tradotto header, footer e home in de/es e localizzato i link; il quadro sotto e' quello delle 17:41-17:45 UTC, il confronto con le 17:05 e' indicato dove serve.

### Lingua: come si sceglie (verificato)
- Lingue: it, en, de, es. La lingua viene solo dal prefisso URL (`SetFolioLocale`). `/` risponde 302 a `/it` con ogni `Accept-Language` (de-DE, es-ES, en-GB, fr-FR) e dopo aver visitato `/en/`; nessun cookie di lingua. `/tickets` senza prefisso 404, `/fr/` 404, `/IT/` 200.
- `<html lang>` corretto 40/40. `hreflang`, `canonical`, `og:locale`, `og:title`: 0/40 pagine (head del layout: `Themes/Sixteen/resources/views/components/layouts/main.blade.php:11-16`; il componente `Modules/Cms/resources/views/components/metatags.blade.php` non e' usato). Viewport `width=device-width, initial-scale=1.0`: zoom consentito.
- Selettore: ITA, ENG, DEU, SPA; da `/it/`, `/it/tickets`, `/it/tickets/create`, `/it/area-personale/pratiche`, `/it/auth/login` ogni voce porta alla stessa pagina nell'altra lingua, ma la query string si perde (`?q=strada&page=2`, `?step=...`).
- Ospite su `/{lang}/tickets/create` va a `/{lang}/auth/login` (lingua conservata).

### Tabella 1: testo italiano residuo (testi / attributi aria-label, title, placeholder), 17:45 UTC
Conteggi di stringhe distinte uguali alla pagina italiana, esclusi nomi propri, marchi social, dati dell'utente e titoli dei marker (testo dei cittadini). HTTP 200 su tutte le 40 combinazioni. Chiavi grezze nel testo: 0 ovunque; in `it` 1 per pagina del wizard nell'attributo del campo Categoria (`filament-forms::components.select.search_label`).

| Pagina | en | de | es |
|---|---|---|---|
| home | 0/1 | 1/1 | 2/1 |
| tickets | 0/2 | 1/2 | 3/2 |
| tickets/create passo 1 | 0/3 | 16/17 | 17/17 |
| tickets/create passo 2 | 5/3 | 36/17 | 37/17 |
| tickets/create passo 3 | 0/3 | 24/17 | 25/17 |
| auth/login | 2/0 | 3/0 | 4/0 |
| auth/register | 3/0 | 4/0 | 5/0 |
| area-personale/pratiche | 0/1 | 1/1 | 2/1 |
| area-personale/impostazioni | 0/0 | 1/0 | 2/0 |
| profile/edit | 0/0 | 1/0 | 2/0 |
| Totale | 10/13 | 88/55 | 99/55 |

Le voci di de/es fuori dal wizard sono `Via Roma 123 - 00100 Comune` (segnaposto del piede) e `Turismo` (es); in en/de/es i marker della mappa hanno `title` e `aria-label` italiani (`Marker posizione segnalazione`, tipo e stato). Alle 17:05 de/es erano interamente italiani (97-101 testi per pagina, 25-26 attributi).

### Tabella 2: layout per larghezza (italiano; a 375 identico in en, de, es)
Overflow orizzontale: 0 px su tutte le pagine e larghezze. Campi sotto 16 px: 0. Elementi oltre il bordo destro: 0. Immagini/tabelle piu' larghe del contenitore: 0 (escluse le tessere Leaflet, tagliate dalla mappa). Bersagli sotto 44x44 / bersagli totali (link in linea esclusi):

| Pagina | 375 | 768 | 1024 | 1440 |
|---|---|---|---|---|
| home | 46/68 | 37/72 | 49/85 | 50/85 |
| tickets | 58/73 | 49/77 | 65/92 | 66/95 |
| create passo 1 | 53/57 | 45/57 | 56/67 | 57/70 |
| create passo 2 | 59/70 | 51/70 | 62/80 | non misurato |
| create passo 3 | 55/59 | 47/59 | 58/69 | non misurato |
| login | 49/55 | 40/55 | 52/68 | 53/68 |
| register | 48/60 | 39/60 | 51/73 | 52/73 |
| pratiche | 48/56 | 40/56 | 51/66 | 52/69 |
| impostazioni | 48/54 | 40/54 | 53/68 | 55/71 |
| profile | 45/50 | 36/50 | 48/63 | 49/63 |

Di quei bersagli 43 (375), 34 (768), 42-43 (1024, 1440) sono link del piede alti 24 px. Sotto 24 px: link "Leaflet" 51x14, link regione 21 px, icone social 24 px (16x16 a 1024/1440 nell'header). Posizione fissa/sticky: solo Debugbar (ambiente di sviluppo) e `div.cmp-navscroll.sticky-top` in impostazioni (5% dello schermo); nessun banner cookie.

### Tabella 3: menu con tocco (verificato)

| Elemento | 375 | 768 |
|---|---|---|
| Hamburger, pagine `data-dc` (tickets, create, pratiche, impostazioni) | 24x24; si apre a tutto schermo, `aria-expanded`, fuoco su "Nascondi la navigazione" 44x44, Esc chiude | uguale |
| Hamburger, altre pagine (home, login, register, profile) | 48x48; si sovrappone al link regione (24-143 contro 8-56 px) | non misurato |
| Menu lingua, pagine `data-dc` | 160x176, voci 160x40, tagliato 28 px a destra | tagliato 6 px |
| Menu utente, pagine `data-dc` | 228x293, voci 228x56, tagliato 169 px (visibili 59 px: "Le mi", "Segna", "Notifi") | tagliato 147 px |
| Menu lingua e utente, altre pagine | entro lo schermo (192 px) | non misurato |
| Ricerca | modale a tutto schermo, `aria-modal`, Esc chiude | uguale |

### Wizard e cambio lingua (verificato, senza inviare nulla)
- Il parametro `?step=` usa una chiave derivata dall'etichetta (`Modules/Fixcity/app/Actions/BuildTicketReviewSummaryAction.php`, `dataStepKey()`, circa riga 218): it, de, es `form.autorizzazioni-e-condizioni`, `form.dati-di-segnalazione`, `form.riepilogo`; en `form.privacy-and-terms`, `form.report-details`, `form.summary` (tutte con `::data::wizard-step`).
- La chiave giusta apre il passo (anche il 2 e il 3 direttamente, senza passare dal 1: da controllare se l'invio lo impedisce). La chiave di un'altra lingua apre il passo 1 senza avviso e resta nell'URL.
- Dal passo 2 con un campo compilato, il selettore porta a `/en/tickets/create` (query persa), passo 1, campi vuoti, nessun `beforeunload`, nulla in localStorage/sessionStorage. "Indietro" del browser riapre il passo 2 con campi vuoti.

### Formati (tinker, nessuna pagina misurata mostra date)
- Il dettaglio segnalazione non ha date e l'elenco dell'utente era vuoto. `isoFormat('LL')` (`BuildPersonalAreaTicketRowAction.php:60`) corretto: `3 ottobre 2026`, `October 3, 2026`, `3. Oktober 2026`, `3 de octubre de 2026`.
- `translatedFormat('d F Y')` (`Modules/User/resources/views/pages/area-personale/pratiche.blade.php:59`): `03 ottobre 2026`, `03 Oktober 2026`, `03 octubre 2026` (zero iniziale, senza punto tedesco ne' "de"). `__('Inviata il')` torna la chiave in en, de, es.
- `number_format()` da `1,234,567.89` in tutte le lingue (`Themes/Sixteen/resources/views/components/blocks/ticket-list/results-header.blade.php:15`), `Number::format(locale)` da `1.234.567,89` per it, de, es. Pluralizzazione: ipotesi, `:count Risultati` e' una frase unica (`Themes/Sixteen/lang/it/ticket.php:74`).

### Difetti, con gravita', causa probabile, correzione minima e verifica
1. ALTA, menu utente tagliato su cellulare e tablet (verificato). Causa: `Themes/Sixteen/resources/js/app.js:189-195` (`placeDropdownMenu`) allinea il menu a sinistra del pulsante, senza controllare il bordo destro. Correzione: limitare `x` a `innerWidth - menu.offsetWidth - 8 - parent.left`. Verifica: aprire il menu a 375 e 768, il bordo destro del menu <= larghezza della finestra, voce "Esci" raggiungibile con tocco; stesso controllo per il menu lingua (28 e 6 px).
2. ALTA, wizard in de/es quasi tutto italiano (16-17 testi passo 1, 36-37 passo 2, 24-25 passo 3, 17 attributi: zoom, "Cerca indirizzo", "Schermo intero", placeholder). Causa (ipotesi, non letta riga per riga): chiavi mancanti in `Modules/Fixcity/lang/{de,es}/` (`fixcity.php` `ticket.steps.*`, `ticket_form.php`, `create_ticket_wizard.php`); e le mappe `Modules/Geo`. Correzione: tradurre; verifica `audit-locales.py /tickets/create` (e passi 2 e 3) e `ContentLocaleParityTest`, attesi 0 testi uguali all'italiano.
3. ALTA, 18 dei 28 link interni della home danno 404 in ogni lingua (header 9: `/amministrazione`, `/novita`, `/servizi`, ... senza prefisso lingua; piede 8: `/{lang}/privacy`, `/{lang}/note-legali`, ...). Causa: `Modules/Fixcity/config/database/content/sections/header.json` e `footer.json` puntano a pagine che non esistono. Correzione: togliere le voci senza pagina o puntarle a pagine reali localizzate (si lega a DCP-52 e DCP-53). Verifica: `python3` dei link (stato 200 per ogni href interno, 4 lingue).
4. MEDIA, logo e home perdono la lingua: `url('/')` in `design-comuni.blade.php:129` e `:168` da `/en/` porta a `/it` (verificato). Correzione: `$localizedUrl('/')` (gia' definito nello stesso file). Verifica: click sul logo da `/de/tickets` porta a `/de`.
5. MEDIA, cambio lingua a meta wizard: perde i dati senza avviso e la chiave `?step=` dipende dalla lingua. Causa: `localeUrl` (`design-comuni.blade.php:21-30`) scarta la query; la chiave nasce dall'etichetta. Correzione minima: chiave del passo fissa e neutra (`->key('dati')` su ogni `Step`) e query mantenuta nel selettore; in piu' avviso `beforeunload` se il form e' sporco (ipotesi di fattibilita', da provare su Filament 5). Verifica: da `?step=...` cambiare lingua e riavere lo stesso passo; stessa chiave in 4 lingue.
6. MEDIA, SEO: nessun `hreflang`, `canonical`, `og:locale` (0/40). Causa: `layouts/main.blade.php:11-16`. Correzione: una riga `rel=canonical` e quattro `rel=alternate hreflang` costruite con `LaravelLocalization::getLocalizedURL`, piu' `og:locale` (si lega a DCP-123). Verifica: `curl /en/ | grep hreflang` = 4 + x-default.
7. MEDIA, API mappa senza lingua: etichette di stato e tipo italiane e `detail_url` `/it/tickets/29` in ogni lingua (`Modules/Fixcity/app/Actions/BuildTicketsGeoJsonAction.php:99`, `data_url` in `Modules/Fixcity/config/database/content/pages/home.json`). Correzione: passare la lingua (`?lang={{ app()->getLocale() }}`) e usarla nell'azione. Verifica: `curl "/api/tickets/geojson?lang=en"` etichette in inglese e `detail_url` `/en/tickets/29`.
8. MEDIA, bersagli tattili: hamburger 24x24 sulle pagine `data-dc`, pulsanti lingua/utente/ricerca 36-37 px, campi 37 px, link del piede 24 px x 43, "Mostra password" 123x20, casella "Ricordami" 16 px. Causa: CSS di parita' con il riferimento. Correzione: area di tocco piu' ampia senza cambiare l'aspetto (`::after` con `inset: -10px`, `min-height: 44px` sui link del piede sotto `lg`). Verifica: ripetere la misura, bersagli sotto 44 px dal 75% a meno del 10%.
9. MEDIA, login e register in en/de/es: titolo, sottotitolo e "Mostra password" in italiano e `<title>` "Accedi a FixCity" (`Themes/Sixteen/resources/views/components/pages/auth-login.blade.php:5` usa l'italiano come chiave JSON; `Modules/Gdpr/lang/it/gdpr.php:7` per register; ipotesi: mancano le voci in en/de/es). Correzione: tradurre. Verifica: `audit-locales.py /auth/login /auth/register`.
10. MEDIA, iniziale dell'utente invisibile: `color rgb(255,255,255)` su cerchio bianco (`Themes/Sixteen/resources/css/app/13-final-runtime-overrides.css:7-47` colora `> a.btn...`, ma l'elemento e' `button#header-user-toggle`). Correzione: estendere il selettore a `.btn`. Verifica: colore calcolato `rgb(0, 64, 43)`.
11. BASSA, hamburger sovrapposto al link regione su home, login, register, profile a 375 (24-143 contro 8-56 px; il tocco a sinistra va all'hamburger). Correzione: margine sinistro del link regione >= 56 px sotto `lg`. Verifica: rettangoli senza intersezione.
12. BASSA, formati: `number_format` senza lingua, `translatedFormat('d F Y')` senza zero ne' punto tedesco, `__('Inviata il')` senza voce in en/de/es, `service-card.blade.php:121` con `->locale('it')`. Correzione: `Number::format(..., locale: app()->getLocale())` e `isoFormat('LL')`. Verifica: `php artisan tinker` come sopra.
13. BASSA, in `it` 1 chiave grezza nell'attributo del campo Categoria: `filament-forms::components.select.search_label` (e `...actions.clear.label` nel codice Alpine); la traduzione italiana di Filament non ha `select.search_label` (verificato: 0 occorrenze in `vendor/filament/forms/resources/lang/it/components.php`). Correzione: voce in `lang/vendor/filament-forms/it/components.php`. Verifica: `curl /it/tickets/create | grep -c 'filament-forms::'` = 0.
14. BASSA, campo password 141 px su 291 a 375 per via del pulsante "Mostra password" accanto; `/IT/` duplica `/it/`; `/` ignora `Accept-Language` nonostante `useAcceptLanguageHeader=true`; passi 2 e 3 raggiungibili da URL senza accettare la privacy (l'invio non e' stato provato).
Rumore di misura: la barra Debugbar e `POST /_boost/browser-logs` compaiono solo in sviluppo e coprono il form a 375; non sono difetti di produzione.

## Aperto
Correzioni per priorita' dopo lo studio.

## Nota 2026-10-13 (sera): difetto 1 corretto e verificato
Difetto 1 (menu utente e menu lingua tagliati a destra su cellulare e tablet): rimisurato in modo indipendente sulla fixture isolata (`scratch-auth-fixture.sh`, utente usa-e-getta, DB di sviluppo mai scritto). Prima: a 375 px menu utente sporge di 171 px e menu lingua di 30; a 768 px di 149 e 8; da 1024 px 0 (i numeri della prima misura erano 169/28 e 147/6: stessa entita', 2 px di differenza per arrotondamento).
Correzione: `resources/js/app.js`, `placeDropdownMenu`: il menu si misura dopo `position: absolute` e la `translate` orizzontale e' limitata a `clientWidth - larghezza menu - 8 px` (e non scende sotto 8 px). Con il menu che entra, il valore resta quello di prima.
Prova: `tests/browser/header-logged-dropdown.spec.mjs`, nuovo blocco `STORY-DCP-55 menu dentro il viewport` (3 larghezze x 2 menu, misura il rettangolo e non solo `toBeVisible`, che passava anche con il menu tagliato). ROSSO prima: bordo destro 545,5 su 375, 916,5 su 768, lingua 404,5 e 775,5; VERDE dopo: `6 passed`. Rimisurato con una sonda a parte: sporgenza 0 su `/it/tickets` e `/it/tickets/create` a 375, 768, 1024, 1440; i rettangoli a 1024 e 1440 sono identici a prima (lingua 712-872 e 1100-1260, utente 783-1013 e 1171-1401), quindi nessun cambio sul desktop. Build: solo `npx vite build` (non `npm run build`, che esegue `copy` e puo' riazzerare le immagini, vedi DCP-08).
Per rieseguire: dal tema, `FIXCITY_BASE_URL=... FIXCITY_TEST_EMAIL=... FIXCITY_TEST_PASSWORD=... ./node_modules/.bin/playwright test tests/browser/header-logged-dropdown.spec.mjs -g "menu dentro il viewport"`. Va usata la CLI del tema (`laravel/Themes/Sixteen/node_modules`): quella della root fallisce con `test.describe() ... not expected here` perche' ci sono due copie di `@playwright/test`.
Cose da sapere:
- Il test STORY-147 desktop dello stesso file e' ROSSO per un motivo che non dipende da questa correzione: cerca nel menu il testo "I miei servizi" / "My services" e non lo trova (toggle, classi e menu visibile passano). Le voci del menu sono state riscritte dalla sessione area personale (DCP-53); l'asserzione e' vecchia e va aggiornata dal suo proprietario. Non l'ho toccata.
- `git diff` su `app.js` contiene anche un blocco non mio (chiusura delle modali Bootstrap sulle pagine /tests) lasciato non committato da un'altra sessione; il mio build l'ha incluso come qualsiasi build della working tree.
- Non verificato: tastiera (frecce, Esc) sul menu riposizionato; schermo girato con menu aperto (il menu non si riposiziona al resize); lingue diverse dall'italiano (le etichette piu' lunghe di de e es potrebbero allargare il menu: la misura del menu e' dinamica, quindi la correzione le copre, ma non l'ho provato).

## Nota 2026-10-13 (sera): difetto 5 corretto, link social
Difetto 5 (il logo perde la lingua): confermato dal vivo. `/` rimanda sempre a `/it` (anche con `Accept-Language: de`) e tre link puntavano a `/`: logo dell'header, logo del menu mobile (`sections/header/design-comuni.blade.php`, righe 129 e 168) e logo del footer (`sections/footer/design-comuni.blade.php`, riga 40; il subagente non l'aveva elencato). Ora usano `$localizedUrl('')` nell'header e `url(app()->getLocale())` nel footer.
Prova: `Modules/Fixcity/tests/Feature/Pages/HeaderLogoLocaleTest.php` (it, en, de, es; controlla tutti i link figli diretti di `.it-brand-wrapper`, quindi anche il footer, e `a.logo-hamburger`). ROSSO prima (`href: 'http://fixcity.local'`, senza lingua), poi `18 passed (160 assertions)` insieme ai test di header e footer; PHPStan sul test 0 errori; sul sito vero i tre link valgono `/it`, `/en`, `/de`, `/es`. Un primo ROSSO sbagliato mi ha fatto credere a un errore del test: dipendeva dal logo del footer, non dal selettore.
Non cambia: `/` senza prefisso continua a rimandare sempre a `/it` (difetto 5, seconda parte: ignora `Accept-Language` e sessione). Decisione da prendere: seguire la lingua del browser alla prima visita sarebbe un comportamento nuovo e va deciso dal titolare (cookie di lingua = trattamento da dichiarare?).
Nuovo punto emerso (non nell'elenco del subagente): le 6 icone social dell'header (Twitter, Facebook, YouTube, Telegram, WhatsApp, RSS) hanno `href="#"` e `target="_blank"`, e sono ripetute nel menu mobile. Il codice legge `social_links` dal JSON dell'header e ripiega su `#` quando manca l'URL. Un clic apre una scheda vuota della stessa pagina: controllo senza scopo, con un nome (es. "Twitter") che promette una destinazione che non c'e'. Non ho inventato URL: i profili reali li deve dare il titolare. Opzioni: (a) `social_links` con gli URL veri; (b) non stampare le icone senza URL (cambia la parity con il riferimento, che ha `#`). Decisione aperta, non applicata.

## Nota 2026-10-13 (sera): difetto 2 corretto, wizard in de ed es
Difetto 2 (wizard quasi tutto in italiano in de ed es): causa verificata, e non era una sola.
1. `Modules/Fixcity/lang/{de,es}/ticket_form.php` conteneva solo segnaposto dell'auto-writer (30 righe, valori come `'fixcity::ticket_form.sections.location.heading'`, fermi dalle 13:14) e `en` copriva 56 chiavi su 143. Riscritti `de` ed `es` (153 chiavi, tutte quelle di `it` piu' 5 voci per i titoli sezione cercati col testo gia' tradotto) e completato `en` in modo additivo (93 chiavi aggiunte, 0 valori esistenti alterati). Termini dal glossario: de Sie, Meldung/Störung; es tuteo, incidencia.
2. Altri gruppi mancanti in de/es, trovati con una prova a lingua di ripiego vuota (`Lang::handleMissingKeysUsing` con `setFallbackLocale('xx')` sulle schermate del wizard): `fixcity.php` (etichette dei passi), `ticket.php` (4 voci: informativa e stati), `ticket_review.php` (14 voci del riepilogo), `ticket_wizard.php` (Weiter/Zurück, Siguiente/Anterior), e nel modulo Geo `coordinate-picker.php` (13 voci: zoom, schermo intero, cerca indirizzo...).
3. Il JSON `tickets.create.json` (titolo, breadcrumb, avviso, "Avanti/Indietro/Invia", blocco "Contatta il comune") aveva blocchi solo `it` ed `en`, quindi de/es ripiegavano sull'italiano. Aggiunti `de` ed `es` a `title`, `content_blocks` e `sidebar_blocks`, nelle due copie identiche (tenant fixcity e modulo). Round-trip del JSON verificato byte per byte prima di scrivere.
Prova: tre test nuovi, tutti ROSSI prima: `Modules/Fixcity/tests/Unit/TicketFormLangParityTest.php` (chiavi complete, nessun testo italiano, nessun segnaposto, `:count` e plurali intatti; unica eccezione motivata: "Email" in en), `Modules/Fixcity/tests/Feature/Pages/WizardChromeLangTest.php` (38 casi, controlla che la chiave esista nella lingua e non sia il testo italiano) e `Modules/Fixcity/tests/Unit/TicketCreatePageJsonLocalesTest.php` (9 casi: copie identiche, blocco completo e tradotto per it/en/de/es). Insieme ai test di logo, categorie e guardia JSON: `73 passed (790 assertions)`; PHPStan sui test nuovi 0 errori.
Misura sul sito (fixture isolata, utente usa-e-getta, passi 1-2-3, ogni testo italiano di `ticket_form` piu' "Avanti", "Indietro", "Invia", "Contatta il comune", "Segnalazione disservizio", "Servizi", cercato nel testo e negli attributi `placeholder`, `aria-label`, `title`): prima 88 e 99 testi italiani in de ed es (misura del subagente); dopo 0 in de e 0 in es nei tre passi. Il solo "Email" rimasto in en e' un omografo vero.
Effetto collaterale da conoscere: la chiave `?step=` del wizard e' lo slug dell'etichetta TRADOTTA del passo (`BuildTicketReviewSummaryAction`, riga 225; il pulsante "Modifica" la ricalcola, quindi segue la lingua). Con le etichette tradotte cambia in de (`angaben-zur-meldung`, `zusammenfassung`) e in es (`datos-de-la-incidencia`, `resumen`), come gia' in en (`report-details`, `summary`); in it resta `dati-di-segnalazione`, `riepilogo`. Un URL con la chiave di un'altra lingua apre in silenzio il passo 1 (difetto 4, non risolto). `parity-wizard-steps.sh` misura solo /it.
Controllo di regressione: i test di pagina e unitari di Fixcity hanno alcuni rossi (privacy 404 invece di 503/200, limite del tracking 200 invece di 429, tabelle `TicketHour` e `GenerateTickets`). Prova di controllo: ripristinati temporaneamente i miei file e rilanciati 5 file di test sospetti: 8 rossi senza le mie modifiche, 7 con; quindi gia' presenti, non causati da questo lavoro (file rimessi e confrontati byte per byte). Da assegnare ai proprietari.
Non fatto / non verificato: (1) `Modules/Fixcity/lang/it/ticket_wizard.php` ha valori segnaposto in italiano (`'save'`, `'cancel'`) e `en` ha `'next'`, `'previous'`: non visibili grazie a un altro percorso, ma da ripulire; in de/es non li ho riempiti. (2) Altri gruppi che il wizard usa solo con dati diversi (es. profilo senza telefono: la riga Telefono compare solo se c'e') potrebbero avere chiavi non ancora viste; la prova a lingua di ripiego vuota va ripetuta con un profilo completo. (3) Le traduzioni dei testi vicini al piano legale (casella di consenso: "Ich habe die Datenschutzerklärung gelesen und verstanden" / "He leído y comprendido la política de privacidad"; avviso "gelten als Erklärung" / "tiene valor de declaración") non sono state riviste da un madrelingua ne' dal titolare, e non sono un parere legale: da fare prima della messa online. (4) Le altre pagine e blocchi del sito (es. l'elenco `/tickets`, l'area personale) hanno il loro stato: vedi i difetti 3, 9-14. (5) Il titolo "Files" al passo 2 e' la legenda interna di FilePond, uguale in tutte le lingue: non e' un nostro testo.
