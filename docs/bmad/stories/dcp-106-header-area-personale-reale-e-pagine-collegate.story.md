---
id: dcp-106
title: "DCP-106: header 'Accedi all'area personale' reale e area personale con pagine che hanno uno scopo"
type: story
epic: dc-parity-v2
status: in-progress
priority: P0
owner: theme:Sixteen
created: 2026-10-13
updated: 2026-10-13
qmd: "header area personale login auth route login menu utente pagine area-personale pratiche seguite notifiche impostazioni scopo norme multilingua mobile"
related: [dcp-42, dcp-98, dcp-97]
tags: [docs, sixteen, bmad]
---

# DCP-106: l'header dice la verita' e ogni voce porta da qualche parte

## Richiesta (utente, 2026-10-13 ~16:45)
Nell'header «Accedi all'area personale» si deve vedere se non sei loggato e va a `route('login')`; se sei loggato si deve vedere quello che si vede nelle pagine di riferimento `*-area-personale` (non "Mario Rossi": un nome che abbia senso). Regola del buon senso: tutto deve avere senso, uno scopo, una funzionalita'. Studiare lo scopo del progetto, le norme che dobbiamo rispettare e come le rispettiamo; il sito e' multilingua; mobile e tablet ottimizzati; prodotto professionale e accademico. Account di sviluppo fornito dall'utente per entrare (le credenziali NON si scrivono in nessun file del repo ne' nella memoria: si passano via variabili d'ambiente e si chiedono di nuovo se servono).

## Stato letto e MISURATO alle 16:55 (login con l'account fornito)
- **Fatto da un'altra sessione** (header `sections/header/design-comuni.blade.php`, mtime 16:50; docs `bmad/scopi-e-norme.md`, `header-auth-logic.md`, `studies/header-auth-state-legal-study.md`, `decisions/decision-header-auth-state.md`, `decision-log/D17-header-login-area-personale.md`): ospite -> link a `route('login')`; loggato -> menu utente con nome reale (`name`/email), iniziale o avatar, logout con POST e CSRF. Verificato: il login con le credenziali date funziona e l'header mostra "Marco Sottana".
- **Difetto sostanziale (provato con `curl` da loggato)**: le voci del menu puntano a pagine che NON hanno contenuto: `/it/area-personale/servizi` e `/it/area-personale/pratiche` rispondono 200 ma vuote (nessun JSON di pagina: solo header, ricerca e footer); `/it/notifications`, `/it/profile`, `/it/area-personale` rispondono 404. Un menu che porta a pagine vuote o inesistenti viola proprio la regola del buon senso.
- **Correzioni dovute a documenti dell'altra sessione** (verificate con `curl`, non rimosse: collegate): `studies/header-auth-state-legal-study.md` e `decisions/decision-header-auth-state.md` dichiarano 404 le pagine di riferimento `graduatoria-area-personale`, `vantaggi-area-personale`, `pagamenti-*-area-personale`, `permessi-area-personale`: **rispondono tutte 200** (le replichiamo gia' come `tests.*-area-personale`). Il numero `dcp-24` in `scopi-e-norme.md` e' gia' di un'altra story (`2026-10-13-dcp-24-appuntamento`). `D17` attribuisce al riferimento "nome Giulia Rossi/Giulia Bianchi" e dati reali nelle pagine di prova: sono fixture statiche del riferimento.

## Specifica funzionale (dal contratto dei test esistenti, rossi per pagine assenti: DCP-103)
| Voce del menu (it / en) | Percorso | Cosa mostra | Test che la definiscono |
|---|---|---|---|
| Le mie segnalazioni / My reports | `/{lang}/area-personale/pratiche` | le segnalazioni di cui l'utente e' proprietario, stato, link al dettaglio `/it/tickets/{id}` e al tracciamento, CTA "Nuova segnalazione"; ospite -> redirect al login localizzato | `CitizenMyTicketsDetailLinkTest` |
| Segnalazioni che seguo / Reports I follow | `/{lang}/area-personale/seguite` | segnalazioni seguite, SEMPRE collegate al tracciamento per codice (`/it/tickets/track?code=...`, mai per id del database), con testo onesto se manca il codice | `FollowedTicketsPageTest` |
| Notifiche / Notifications | `/{lang}/area-personale/notifiche` | gli aggiornamenti di stato ricevuti, con link alle impostazioni | `NotificationPreferencesTest` |
| Impostazioni e privacy / Settings and privacy | `/{lang}/area-personale/impostazioni` | preferenze di notifica (widget `TicketNotificationPreferencesWidget`, `#email-ticket-updates`), dati dell'account, informazioni e canali per esercitare i diritti GDPR | `NotificationPreferencesTest` |
| Esci / Log out | POST `logout` | chiude la sessione | gia' fatto |

## Regole di lavoro (architettura della casa)
Pagine = JSON CMS (`area-personale.<voce>.json`, tenant e modulo identici) con `"middleware": ["auth"]` ESATTAMENTE (mai `web`, mai `guest`: DCP-42) e `"layout": "design-comuni"` + blocchi del tema; dati dalle Action del modulo Fixcity (`BuildAuthenticatedUserTicketsQueryAction`, `BuildAuthenticatedUserFollowedTicketsQueryAction`, `GetFixcityEmailNotificationPreferenceAction`); testi in file lang (it ed en completi; de ed es se il sito li serve: verificare `config`); niente `!important`, niente CSS per slug; ogni ticket mostrato solo al suo proprietario (test di autorizzazione). Markup: classi del riferimento `segnalazione-area-personale.html` (blocco `report-area` gia' misurato a pixel >= 99,5%) alimentate da dati veri.

## Coordinamento
| Agente / sessione | Ambito | File |
|---|---|---|
| Altra sessione (header) | logica ospite/loggato, nome, avatar, logout | `sections/header/design-comuni.blade.php`, lang `pub_theme::header.user.*`, sue story |
| Sessione tema (questa) | specifica, voci del menu verso le pagine vere, coordinamento, build | story, 4 `href` + etichette del menu |
| Agente AP-A (DCP-110) | `pratiche` + `seguite` | **consegnato** ([DCP-110](dcp-110-area-personale-pratiche-e-seguite.story.md)): blocchi `personal-area-practices/*`, JSON, Action, lang `personal_area`, test |
| Agente AP-B (DCP-111) | `notifiche` + `impostazioni` + profilo e diritti GDPR | **consegnato** ([DCP-111](dcp-111-area-personale-notifiche-e-impostazioni.story.md)): blocchi `personal-area-settings/*`, JSON, Action, widget Livewire, lang `personal_area_settings`, test; difetti aperti: nessuna informativa privacy (`/privacy` 404), contatti del Comune = segnaposto |
| Agente LEGAL (DCP-112) | scopo del progetto e matrice di conformita' normativa con prove | `Modules/Fixcity/docs/compliance/`, `Themes/Sixteen/docs/compliance/` |
| Poi: I18N (DCP-120), MOBILE (DCP-121), DOCS (DCP-122) | audit multilingua, mobile/tablet, organizzazione `docs/` | report e INDEX |
Numeri riservati a questo lotto: DCP-106, DCP-110..129.

## Voci del menu: stato alle 17:00 (sessione tema)
`sections/header/design-comuni.blade.php` ora punta a `area-personale/pratiche` (Le mie segnalazioni), `area-personale/seguite` (Segnalazioni che seguo), `area-personale/notifiche` (Notifiche), `area-personale/impostazioni` (Impostazioni e privacy) e il POST di logout. Etichette nuove `pub_theme::header.user.dropdown.{my_reports,followed_reports,notification_center,settings_privacy}` in **it, en, de, es** (de/es prima ricadevano sull'inglese per il menu utente). **Avviso all'altra sessione che edita la stessa riga** (alle 16:54 la voce "Notifiche" e' sparita e "Impostazioni" puntava a `profile/edit`): `/it/profile/edit` risponde 200 ma con `<main>` VUOTO (stessa causa sotto), quindi non e' una pagina vera; se cambiate di nuovo le voci, scrivetelo qui.
**Causa radice delle pagine vuote** (provata): `Modules/Cms/app/Providers/FolioVoltServiceProvider.php` monta il percorso del TEMA prima di quelli dei moduli; la pagina dinamica del tema `pages/[container0]/[slug0]/index.blade.php` corrisponde a qualunque URL a due segmenti e risponde 200 con `<main>` vuoto se non esiste un JSON di pagina. Le pagine scritte nel modulo User (`resources/views/pages/area-personale/{pratiche,servizi,impostazioni,notifiche}.blade.php`, 26-67 righe, del 24/09-11/10) non vengono mai raggiunte. Strategia: pagine come JSON + blocchi (architettura della casa), con la logica ripresa da quelle pagine e dalle Action del modulo Fixcity; in piu' la pagina dinamica restituira' 404 quando non c'e' ne' JSON ne' ramo speciale (un 200 vuoto e' un soft-404: peggiora SEO e accessibilita').

