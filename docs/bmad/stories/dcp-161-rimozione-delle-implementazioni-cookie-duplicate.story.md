---
id: dcp-161
title: "DCP-161: una sola cookiebar, rimozione delle implementazioni duplicate del tema"
type: story
epic: dc-parity-v2
status: ready-for-dev
priority: P2
owner: theme:Sixteen
module: Sixteen
created: 2026-10-14
updated: 2026-10-14
qmd: "cookiebar duplicate rimozione codice morto partials cookie-bar feedback cookiebar bootstrap-italia cookie-consent.js vanilla-cookieconsent categorie preattivate agid footer cookie-consent.css doppio"
related: [dcp-136, dcp-153]
tags: [docs, sixteen, bmad]
---

# DCP-161: una sola cookiebar

DCP-153 ha messo **una** cookiebar funzionante nel modulo Gdpr (vista `cookie-consent`, iniettata da `InjectCookieBanner`). Restano nel tema le implementazioni precedenti, tutte non funzionanti o non collegate. Non le ho cancellate io: sono file tracciati, alcuni modificati oggi da un'altra sessione, e due test del modulo UI li nominano.

## Elenco misurato il 2026-10-14
| File | Stato | Perche' va via |
|---|---|---|
| `Themes/Sixteen/resources/views/partials/cookie-bar.blade.php` | non incluso da nessuna vista dopo DCP-153 | 13 chiavi `gdpr::cookie.*` che non esistono, rotta `pages.view` che non esiste, errore `this.pategories`, consenso solo in `localStorage` (il server non lo vede) |
| `.../components/feedback/cookiebar.blade.php` | citato solo da `bootstrap-italia/cookiebar.blade.php` | stesso destino |
| `.../bootstrap-italia/cookiebar.blade.php` | non incluso | idem |
| `.../components/bootstrap-italia/cookiebar.blade.php`, `.../components/ui/cookiebar.blade.php`, `.../components/utilities/ui/cookiebar.blade.php` | citati da `pages_old/bootstrap-italia-showcase.blade.php` e da `Modules/UI/tests/Feature/ComponentFilesExistTest.php` e `ComponentReorganizationTest.php` | prima di cancellare vanno aggiornati i due test del modulo UI, che verificano l'esistenza dei file |
| `Modules/UI/resources/views/components/ui/cookiebar.blade.php` | componente d'esempio | idem |
| `Themes/Sixteen/resources/js/cookie-consent.js` | non importato da `app.js` | `vanilla-cookieconsent` con le categorie `functionality`, `analytics` e `marketings` gia' `enabled: true`: attivato, violerebbe il par. 7.1 delle linee guida (nessun cookie non tecnico al primo accesso) |
| `.../components/ui/footer.blade.php` e `.../components/agid/footer.blade.php` | un `<div class="cookiebar hide">` statico in fondo | testo «Proseguendo nella navigazione accetti» = consenso per scorrimento, che il par. 6.1 non ammette |
| `Themes/TwentyOne/resources/js/cookie-consent*.js` | tema non usato da Fixcity | decisione sul tema (vedi story di studio dei temi) |
| `<link rel="stylesheet" href=".../vendor/cookie-consent/css/cookie-consent.css">` in `layouts/main.blade.php` e `components/layouts/main.blade.php` (e in `Gdpr/app/Providers/Filament/AdminPanelProvider.php`) | caricato due volte per pagina | la vista del modulo ha il suo stile incorporato: il CSS del pacchetto non serve piu' al front office |

## Requisiti
1. Prima di ogni cancellazione: `rg` del nome del file e dei suoi alias di vista, e aggiornamento dei due test del modulo UI.
2. Cancellare i file della tabella (forward-only, nessun rollback come scorciatoia), togliere i due `<link>` del CSS dal front office, tenere quello del pannello Filament se la vista del pannello lo usa.
3. Nessuna regressione: `cookie-banner.spec.mjs` e `CookieBannerPagesTest` restano verdi, `curl -s /it | grep -c cookie-consent.css` = 0.

## Criteri di accettazione
- [ ] `git ls-files | grep -i cookie` in `Themes/Sixteen` elenca solo il blocco `cookie-policy` e il test del browser.
- [ ] I test del modulo UI sui componenti passano senza i file cancellati.
- [ ] Nessuna pagina del front office carica `cookie-consent.css`.

## Dipendenze e priorita'
DCP-153 (la cookiebar nuova). P2: i file non sono raggiungibili da nessuna pagina servita, quindi non c'e' rischio per il cittadino, solo confusione per chi sviluppa (e il pericolo che qualcuno li riattivi).

## Nota di verifica 2026-10-14 sera
Fatto solo il passo piu' sicuro: tolto da `Themes/Sixteen/resources/views/components/layouts/main.blade.php` il `<link>` esplicito a `vendor/cookie-consent/css/cookie-consent.css`. Prima ogni pagina del front office lo caricava due volte (il `<link>` del layout e quello che Filament emette da `Css::make('gdpr-styles', ...)` in `Modules/Gdpr/app/Providers/Filament/AdminPanelProvider.php`); ora una sola (`curl` su `/it`, `/it/privacy`, `/it/auth/login`, `/en/tickets/track`: 1 su 4 pagine su 4). La barra compare ancora (18 occorrenze di `data-cookie` per pagina).
**Non fatto**: la cancellazione dei file della tabella, che richiede di toccare due test del modulo UI e `pages_old/bootstrap-italia-showcase`, e il CSS registrato da Filament, che resta su tutte le pagine finche' non si limita al pannello (`FilamentAsset` con pacchetto o `->assets()` del pannello). Il criterio «nessuna pagina carica cookie-consent.css» non e' ancora vero.

