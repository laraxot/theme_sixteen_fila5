---
id: dcp-143
title: "DCP-143: accessibilita': audit manuale WCAG 2.1 AA, axe sulle pagine con login, ACC-01..05 del wizard"
type: story
epic: dc-parity-v2
status: in-progress
priority: P1
owner: theme:Sixteen
created: 2026-10-13
updated: 2026-10-13
qmd: "accessibilita axe aria-allowed-attr aria-required-children tickets tab mappa elenco wizard tastiera screen reader nvda wcag 2.1 aa audit manuale"
related: [dcp-112, dcp-132, dcp-49, dcp-98]
tags: [docs, sixteen, bmad]
---

# DCP-143: le pagine pubbliche e il wizard passano axe e un audit manuale

Nata da DCP-112 (matrice interfaccia I-03, I-04, I-07, I-08, I-26).

## Lacuna e prova (2026-10-13)
Playwright + `axe-core` (tag wcag2a, wcag2aa, wcag21a, wcag21aa) a 1440 px, escluse le violazioni della debug bar di sviluppo:

| Pagina | Esito |
|---|---|
| `/it`, `/en`, `/it/auth/login`, `/it/auth/register`, `/it/tickets/track`, `/it/domande-frequenti`, `/it/mappa-sito` | 0 violazioni (17:08) |
| `/it/tickets` | 17:08: 2 critical (`aria-allowed-attr` su `button[data-tab-id="map"]` e `.border-transparent`; `aria-required-children` su `#tabDisservizio`). 18:12: 0 violazioni dopo la riscrittura della pagina da parte di un'altra sessione |
| `/it` | 18:12: 0 violazioni (rimisurata) |

Non misurate: il wizard (richiede il login), l'area personale (DCP-110/111), il back office. Il controllo automatico copre solo una parte dei criteri: tastiera, ordine del focus, lettori di schermo, errori nei moduli e contrasto in stato hover/focus restano non verificati. L'audit statico DCP-49 ha elencato ACC-01..05 (`aria-live` sull'intero passo, errori globali non annunciati, «Usa la tua posizione» come link senza ruolo, bottone senza `aria-expanded`, stringhe fisse non tradotte): non corretti.

## Norma
L. 9.1.2004 n. 4 art. 3-bis (principi generali) e art. 3-quater; Dir. (UE) 2016/2102; EN 301 549 e WCAG 2.1 livello AA come baseline del progetto (`bmad-output/front-office-design-comuni/accessibility-strategy.md`). Testi e versioni nel registro fonti 03.

## Requisiti
1. Mantenere a zero le violazioni di `/it/tickets` con un test automatico (la correzione e' arrivata con la riscrittura della pagina, senza test).
2. Correggere ACC-01..ACC-05 di DCP-49 con test.
3. Audit manuale con tastiera sola e con un lettore di schermo (NVDA o VoiceOver) di: home, elenco, tracciamento, login, registrazione, i tre passi del wizard, area personale; checklist con esito per criterio WCAG 2.1 AA.
4. Esito dell'audit consegnato a DCP-132 per la dichiarazione.
5. Elenco informativo degli elementi interattivi sotto 24 px (criterio 2.5.8 di WCAG 2.2, non richiesto dalla baseline 2.1): link «Nome della Regione» (120x21), «Media policy» e «Mappa del sito» nel footer (altezza 20), «Mostra password» (124x20), casella 16x16, link «Leaflet» (51x14).

## Criteri di accettazione
- [x] axe a 0 violazioni (tutte le severita') su 12 pagine a 375 e 1440 px, wizard e area personale inclusi: misurate 15 pagine (8 pubbliche, 3 passi del wizard, 4 pagine dell'area personale) con l'utente di prova isolato della fixture (mai il master), 30 misure su 30 a zero. Vedi "Esito".
- [ ] Checklist manuale allegata con data, strumenti e versioni: allegata sotto, con cio' che e' stato provato con la tastiera e cio' che e' NON VERIFICATO. **Resta aperto il lettore di schermo (NVDA, VoiceOver, TalkBack): mai usato.**
- [ ] Test automatico (Playwright + axe) in CI che fallisce su nuove violazioni serious/critical: il test esiste (`tests/browser/a11y-axe.spec.mjs`, fallisce su serious/critical) ma nessun job di CI lo esegue (`.github/workflows/ci.yml` non ha job di browser: servono un'app e un account di prova). Da decidere dove farlo girare.

## Dipendenze e priorita'
DCP-98 (account di prova), DCP-110/111 (pagine). P1; l'esito alimenta la dichiarazione P0 di DCP-132.

## Esito dell'implementazione (2026-10-13, fase BMAD: sviluppo e verifica)

Strumenti e versioni: Chromium 156.0.8078.4 (Playwright 1.64.0, `@playwright/test` 1.64.0), axe-core 4.13.0 con `@axe-core/playwright` 4.13.0, tag wcag2a, wcag2aa, wcag21a, wcag21aa, debugbar di sviluppo esclusa. Server: istanza isolata `php -S` su DB scratch (`scratch-auth-fixture.sh`), origine `http://127.0.0.1:8092`, utente di prova `@example.test` del DB scratch. Nessuna credenziale in file, story o memoria.

### Che cosa e' cambiato
| File | Cambio | Perche' |
|---|---|---|
| `resources/views/components/blocks/report-list/design-comuni.blade.php` | `li role=presentation`, `a role=tab` con `aria-controls` sul pannello vero (`data-ex-disservizio1/2`), tolti `role=button` e `aria-current` | `/it/tests/segnalazioni-elenco`: critical `aria-allowed-attr` x2, `aria-valid-attr-value`, serious `nested-interactive` x2. E' la stessa forma gia' usata da `ticket-list` (la pagina reale `/it/tickets`) |
| `resources/views/components/blocks/tests-index/design-comuni.blade.php` | tolto `role="tablist"` da `ul#myTab` (le schede sono link ad altre pagine, non hanno pannelli) | `/it/tests` e `/it/tests/servizi-index`: critical `aria-required-children`, serious `listitem` |
| 8 blocchi con barra `it-navscroll-progressbar` (`news-detail`, `event-detail`, `service-page-detail/side-nav`, `service-flow/parts/side-index`, `flow/area-personale/dashboard`, `appointment-step/partials/side-nav`, `personal-area-settings/page-index`, `assistance-form`) | `aria-label="{{ __('pub_theme::a11y.reading_progress') }}"` | serious `aria-progressbar-name` su 20 pagine di prova |
| `Themes/Sixteen/lang/{it,en,de,es}/a11y.php` (nuovi) | chiave `reading_progress` | testi mai fissi |
| `resources/js/app.js` (`closeDropdownMenu`) + build (`npx vite build` con il lock) | se il focus sta dentro il menu che si chiude, torna sul pulsante | Esc sul menu lingua/utente mandava il focus sul `body` (WCAG 2.4.3) |
| `Modules/Fixcity/tests/Feature/Pages/ThemeAriaStructureTest.php` | 21 test su 10 pagine (tablist, aria-controls, progressbar, lang): provato rosso con i blocchi originali (`li[role=tab]` su `/it/tests/segnalazioni-elenco`, progressbar senza nome su 5 pagine) e verde dopo | tiene al riparo la struttura tra una misura axe e l'altra |
| `tests/browser/a11y-axe.spec.mjs` (nuovo) | Playwright + axe su 15 pagine a 375 e 1440 px; fallisce su serious/critical (`A11Y_STRICT=1` su tutto) | requisito 1 e criterio 3 |
| `tests/browser/header-menus-keyboard.spec.mjs` (nuovo) | Esc chiude il menu e il focus torna al pulsante (lingua e utente). Provato: 2 falliti prima, 2 passati dopo il build | correzione di sopra |
| `bashscripts/tools/visual/keyboard-audit.mjs` (+ doc) | audit da tastiera | requisito 3 |

### axe, prima e dopo (comando: `cd laravel/Themes/Sixteen && FIXCITY_BASE_URL=http://127.0.0.1:8092 FIXCITY_STORAGE_STATE=<auth.json> npx playwright test tests/browser/a11y-axe.spec.mjs tests/browser/header-menus-keyboard.spec.mjs --reporter=list --workers=1`)
- 15 pagine x 375 e 1440 px: prima (22:2x) 29 su 30 a zero e 1 test fallito per un limite del mio test (Riepilogo a 1440: il Nominatim pubblico non aveva riempito l'indirizzo obbligatorio; ora e' finto come nella sonda della mappa, e axe ritenta se la pagina sta ancora navigando); dopo: **30 su 30 a 0 violazioni (tutte le severita') e i 2 test della tastiera dell'intestazione verdi: 32 passed (2,9 min)**.
- Pagine della story: `/it`, `/en`, `/it/auth/login`, `/it/auth/register`, `/it/tickets/track`, `/it/domande-frequenti`, `/it/mappa-sito`, `/it/tickets`, wizard passo 1, passo 2 (dati e mappa), Riepilogo, `/it/area-personale/pratiche`, `/seguite`, `/notifiche`, `/impostazioni`.
- Spazzata piu' larga, tutte le pagine CMS da ospite (82 pagine x 2 larghezze = 164 caricamenti, script di lavoro nello scratchpad): **prima** 9 regole violate (critical: `aria-allowed-attr` 4, `aria-required-children` 4, `aria-valid-attr-value` 2, `button-name` 2; serious: `aria-progressbar-name` 40, `listitem` 4, `nested-interactive` 2, `color-contrast` 2, `aria-prohibited-attr` 2); **dopo** 5 regole, tutte fuori dal mio perimetro: YouTube dentro l'iframe di `/it/tests/evento-dettaglio` (`aria-allowed-attr`, `button-name`, `aria-prohibited-attr`: terza parte), `aria-progressbar-name` x1 su `/it/tests/segnalazione-02-dati` a 1440 px (usa `report-partials/navscroll.blade.php`, che un'altra sessione sta modificando con la scelta di dare l'etichetta solo se la pagina la passa: non toccato) e `color-contrast` x2 su `/it/tests/pagamenti-imu-dati-personali` (`label[for="taxpayer-type"]` `#5a768a` su `#ebeef0` = 4,1:1 contro 4,5:1: e' il colore del riferimento, un cambio ricade sulla parity).

### Parity (comando: `BASE_REF=https://italia.github.io/design-comuni-pagine-statiche bash bashscripts/tools/visual/parity-sweep.sh <manifest> --jobs 1 --out <dir>`; manifest: homepage, permessi-area-personale, segnalazione-03-riepilogo, index)
| Pagina | HTML rigorosa prima -> dopo | Pixel minimo prima -> dopo | Altezze |
|---|---|---|---|
| homepage | 95,47 -> 95,47 | 99,83 -> 99,83 | uguali |
| index | 89,54 -> 89,32 | 99,78 -> 99,78 | uguali |
| permessi-area-personale | 94,79 -> 94,62 | 99,57 -> 99,59 | uguali |
| segnalazione-03-riepilogo | 92,89 -> 92,89 | 99,72 -> 99,72 | uguali |
Costo sulla HTML: -0,22 su `index` (tolto `role="tablist"`) e -0,17 su permessi (`aria-label` del navscroll). Provato l'alternativa di AGGIUNGERE attributi su `index` (`li role=presentation`, `a role=tab`, `aria-selected`): 89,10, cioe' peggio di togliere un attributo (89,32). In mezzo alla misura la homepage e' scesa a 95,07 per modifiche di altre sessioni (non ha nessun blocco che ho toccato: nessuna `role=progressbar` ne' `tablist`) ed e' tornata a 95,47 nella misura finale. Se si preferisce la parity all'accessibilita' basta ripristinare i due blocchi (backup: `dcp139-backup/blocks/` nello scratchpad).

### Stato di ACC-01..ACC-05 di DCP-49, misurato sul wizard reale (nessuno corretto da me: i file sono del wizard, DCP-128/DCP-146)
Misura da fixture autenticata (script di lavoro `acc-check.mjs`).
| id | Stato oggi | Dove | Correzione minima proposta al proprietario |
|---|---|---|---|
| ACC-01 | **presente**: `div.steppers-content[aria-live=polite]` contiene 15 controlli | `components/wizard/data-step.blade.php:41` | togliere `aria-live` dal contenitore; tenere una regione `aria-live` solo per il riepilogo errori |
| ACC-02 | errori a vuoto: 5 messaggi, 4 campi con `aria-invalid=true`, tutti dentro la regione live del passo (quindi annunciati, ma grazie al difetto di ACC-01); nessuno con `role=alert`; focus resta su «Avanti» e non va al primo campo non valido | `CreateTicketWizardWidget.php`, `dc-*` | dopo ACC-01, un riepilogo errori con `role=alert` e focus sul primo campo non valido |
| ACC-03 | **presente**: «Usa la tua posizione» e' `<a href="#">` senza ruolo; Enter lo attiva (1 click), **Space no (0 click)**; `p[role=status]` e' `hidden` e si mostra con il testo | `dc-place-autocomplete.blade.php:78-85` | `<button type="button">`; `role=status` sempre nel DOM |
| ACC-04 | in parte: nessun «mostra altro» senza `aria-expanded` sul passo 2 (5 bottoni con `aria-expanded`); resta il link «informativa sulla privacy» con `target=_blank` senza avviso di nuova scheda | `gdpr-notice.blade.php` | testo nascosto «(si apre in una nuova scheda)». Nel footer 18 link social con `target=_blank` senza avviso: e' il footer (DCP-130/131/132) |
| ACC-05 | **in gran parte corretto**: in de, es ed en nessun «Avanti», «Invia», «INFORMAZIONI RICHIESTE» fisso; resta `aria-label="Step"` in en (chiave `ticket_form.nav.aria_label` mancante) e l'icona di obbligatorio (`.icon-required`, 1) senza testo nascosto | `data-step.blade.php:46`, `dc-section-card.blade.php:19` | chiave lang e `<span class="visually-hidden">` |

**Gia' noto, stepper in tedesco e spagnolo:** il testo nascosto «Bestätigt/Aktiv» e «Confirmado/Activo» c'e' gia' (chiavi `fixcity::ticket.steps.active.label` e `confirmed.label` in `Modules/Fixcity/lang/de|es/ticket.php`, aggiunte alle 18:13); misurato nell'HTML di `/de/tickets/create` e `/es/tickets/create` (3 `<template x-if>` per ogni stato) e guardato da `WizardChromeLangTest` (DCP-55), 38 test verdi. Non ho dovuto toccare niente.

### Altri difetti trovati dalla tastiera (non corretti: fuori dal mio perimetro, per DCP-127/128/146)
- Dopo «Avanti» (passo 1 -> 2) il focus finisce sul `body` (il bottone sparisce): chi usa la tastiera riparte dall'inizio della pagina (WCAG 2.4.3).
- Il riquadro della mappa del wizard (`div.map-picker-leaflet-pane`) ha `tabindex="0"` ma nessun ruolo ne' nome (`Modules/Geo`): sosta di Tab senza nome accessibile (WCAG 4.1.2). Le frecce spostano la mappa e `+` fa lo zoom (provato).
- Il campo indirizzo (`input#form.location.address`, `type=search`) ha una `<label class="d-none">` (come il riferimento) e il segnaposto; Chromium (albero di accessibilita' via CDP) riporta nome vuoto, Playwright e axe no. Da provare con un lettore di schermo (NON VERIFICATO); in dubbio, `aria-label` con lo stesso testo.
- Contenitore del passo (`form#form.<passo>::data::wizard-step`, `role=group`, Filament) focalizzabile senza nome: su ognuno dei 3 passi.
- Il pulsante «Cerca indirizzo» della mappa non ha `aria-expanded`.
- Il punto con la tastiera si puo' impostare: «Cerca indirizzo» (Invio apre la ricerca e porta il focus nel campo), testo, Invio, frecce, Invio sul risultato (`li[role=option]`): provato con il Nominatim vero, stato `lat 43.769574, lng 11.255864`. Il campo di testo dell'indirizzo del passo 2 NON e' una ricerca (nessuna richiesta di rete alla digitazione).

### Checklist manuale WCAG 2.1 AA (2026-10-13)
Metodo: tastiera pilotata da `keyboard-audit.mjs` e da script di lavoro su Chromium (Tab, Shift+Tab, Invio, Space, frecce, Esc) a 1280 px; axe; screenshot dell'elemento col focus. **Nessun lettore di schermo.** Nessuna persona. «Non verificato» = non provato con nessun mezzo.
| Criterio | Esito | Prova |
|---|---|---|
| 1.1.1 Contenuto non testuale | parziale | axe `image-alt`, `role-img-alt`, `svg-img-alt` a 0 sulle 15 pagine; la qualita' dei testi alternativi NON VERIFICATA |
| 1.3.1 Informazioni e correlazioni | parziale | axe (liste, tabelle, label, ARIA) a 0 sulle 15 pagine; test di struttura; gerarchia dei titoli NON VERIFICATA |
| 1.3.2 Sequenza significativa | osservazioni | l'ordine di Tab ha salti all'indietro in: home (marker e controllo «Cerca» della mappa, y 1102 dopo 1488), `/it/tickets` («Rimuovi tutti i filtri» in alto a destra ma dopo «Applica filtri»; marker; «Cerca»), `/it/mappa-sito` («Servizi», «Accedi»). Non li classifico come violazioni: l'ordine DOM segue il riferimento |
| 1.3.5 Scopo dei campi | conforme (axe) | `autocomplete-valid` a 0 |
| 1.4.3 Contrasto minimo | parziale | axe `color-contrast` a 0 sulle 15 pagine a 375 e 1440 px; hover e focus NON MISURATI; una pagina di prova a 4,1:1 (sopra) |
| 1.4.4, 1.4.10, 1.4.11, 1.4.12, 1.4.13 | non verificato | ridimensionamento a 200%, reflow a 320 px, contrasto dei componenti, spaziatura del testo: non misurati. Esc chiude i menu a tendina dell'intestazione (provato, 2.4.3) |
| 2.1.1 Tastiera | conforme nei flussi provati | tutte le pagine raggiungibili: 17-56 soste; menu lingua e utente: Invio apre, Esc chiude; passo 1: Space sulla casella privacy, Invio su «Avanti»; passo 2: frecce, `+`, ricerca indirizzo e punto da tastiera; **«Usa la tua posizione»: Space non funziona** (ACC-03) |
| 2.1.2 Nessuna trappola | conforme nelle pagine provate | su 12 pagine il Tab chiude il giro entro 150 soste e la mappa Leaflet si lascia con Tab |
| 2.4.1 Salto dei blocchi | conforme sulle pagine con il salto | prima sosta «Vai ai contenuti», Invio porta a `#main-container` e il Tab dopo cade nel `main` (10 pagine). `/it/auth/login` e il Riepilogo non hanno il salto come prima sosta (layout senza): osservazione |
| 2.4.2 Titolo della pagina | parziale | axe `document-title` a 0; la qualita' dei titoli NON VERIFICATA |
| 2.4.3 Ordine del focus | **3 difetti** | focus su `body` dopo «Avanti» (aperto); dopo Esc sul menu (CORRETTO); dopo «Avanti» con errori resta sul bottone |
| 2.4.4, 2.4.6 Scopo del link, titoli ed etichette | parziale | axe `link-name` e `button-name` a 0; testi generici («Leggi di piu'») NON VERIFICATI |
| 2.4.7 Focus visibile | conforme (nelle pagine provate) | 0 soste senza indicatore dopo aver reso il confronto fedele (i marker Leaflet hanno l'anello su un discendente: screenshot del marker con anello bianco e colore primario) |
| 2.5.1 Gesti del puntatore | conforme per la mappa | trascinare e pinch hanno l'alternativa frecce e `+`/`-` e i pulsanti di zoom |
| 2.5.3 Etichetta nel nome | non verificato | |
| 3.1.1 Lingua della pagina | conforme (axe) | `html-has-lang`, `html-lang-valid` a 0; lingua delle parti NON VERIFICATA |
| 3.3.1 Identificazione dell'errore | conforme nei flussi provati | login con credenziali sbagliate: `div[role=alert][aria-live=assertive]` «Credenziali non valide», 1 campo `aria-invalid`, focus resta nel campo; passo 2 a vuoto: 5 messaggi e 4 campi `aria-invalid=true` (vedi ACC-02) |
| 3.3.2 Etichette o istruzioni | parziale | axe `label` a 0; campo indirizzo del passo 2 con label nascosta (sopra) |
| 3.3.4 Prevenzione degli errori | osservato | il Riepilogo precede l'invio; non valutato giuridicamente |
| 4.1.2 Nome, ruolo, valore | **difetti fuori da axe** | mappa focalizzabile senza ruolo ne' nome, contenitore del passo senza nome, campo indirizzo (sopra) |
| 4.1.3 Messaggi di stato | parziale | login: sì (`role=alert`); `p[role=status]` di «Usa la tua posizione» nascosto finche' non ha testo (ACC-03) |
| Altri criteri A e AA (audio, video, tempo, lampeggio, orientamento, input del puntatore, coerenza) | non verificato | |

**Bersagli sotto 24 px (informativo, WCAG 2.2 SC 2.5.8, requisito 5):** link «Leaflet» 51x14; «Media policy» 73x20 e «Mappa del sito» 86x20 nel footer; «Mostra password» 123x20; casella «Ricordami» 16x16; caselle della registrazione 20x20; «Torna alla home» 95x21; nel Riepilogo «Apri in OpenStreetMap» 305x20 e «© OpenStreetMap» 105x20; «Nome della Regione» 120x21 (misura precedente). Le caselle di Bootstrap Italia (`input` 0x0 con la label come bersaglio) non sono bersagli per la tastiera.

### Consegna a DCP-132 (dichiarazione di accessibilita')
Per la dichiarazione servono: conformita' **non dimostrata** (nessun lettore di schermo, criteri 1.4.x e 2.5.x non verificati); non conformita' note: focus su `body` dopo «Avanti», «Usa la tua posizione» non attivabile con Space, riquadro mappa focalizzabile senza nome, nome dubbio del campo indirizzo, `aria-live` sul passo intero (ACC-01), iframe YouTube delle pagine di prova (terza parte). Non ho modificato la story DCP-132 ne' le pagine della dichiarazione: sono di un'altra sessione.

### Cosa manca per chiudere (perche' lo stato e' `in-progress`)
1. Prova con un lettore di schermo reale (NVDA, VoiceOver, TalkBack) e con una persona: NON VERIFICATO.
2. ACC-01, ACC-03 e i difetti di focus del wizard e della mappa: file di DCP-128, DCP-146, DCP-127 (non toccati per regola); proposte sopra.
3. Un job di CI che esegua `a11y-axe.spec.mjs` (serve un'app con DB di prova).
4. Criteri 1.4.4, 1.4.10, 1.4.11, 1.4.12, 2.5.3 e il resto elencato come non verificato.
5. Matrici `docs/compliance/*` (I-03, I-04, I-07, I-08, I-26): alle 22:58 un'altra sessione le stava modificando, quindi non le ho aggiornate. Da riportare: I-03 -> axe a 0 su 15 pagine (e su 82 pagine CMS i difetti dei blocchi corretti); I-04 -> checklist sopra; I-07 -> la mappa ha un'alternativa da tastiera e un elenco, riquadro senza nome aperto; I-08 -> elenco aggiornato; I-26 -> flusso da tastiera provato, dispositivo reale NON VERIFICATO.

