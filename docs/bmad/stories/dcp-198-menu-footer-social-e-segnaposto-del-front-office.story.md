---
id: dcp-198
title: "DCP-198: menu, footer, social e segnaposto del front office: ogni voce porta da qualche parte o non c'e'"
type: story
epic: dc-parity-v2
status: open
priority: P1
owner: theme:Sixteen
created: 2026-10-15
updated: 2026-10-15
implemented_a10: 2026-10-15
implemented_a1_a2: 2026-10-15
qmd: "menu header 404 prefisso lingua footer voci senza href social href # servizi home segnaposto mappa del sito numero verde telefoni nome del servizio aria-label graffe header.json dati morti"
related: [dcp-186, dcp-131, dcp-133, dcp-154, dcp-130]
tags: [docs, sixteen, bmad, menu, footer, contenuti-ente, front-office]
---

# DCP-198: voci morte e segnaposto

## Fase BMAD
Plan. Nata dall'audit [DCP-186](./dcp-186-front-office-scopo-e-senso-di-ogni-pagina-ed-elemento.story.md), gruppo A (misurato dall'agente in it, en, de, es; i numeri sono identici nelle 4 lingue: il difetto e' strutturale) e gruppi B, C.

## Scopo
Il chrome (barra, header, menu, footer) e' la prima cosa che il cittadino usa per orientarsi. Ogni voce deve portare a una pagina vera, oppure non essere un collegamento. Il riferimento Design Comuni e' pieno di voci di un comune d'esempio: vanno sostituite con quelle del servizio e dell'ente, non lasciate.

## Misure (gruppo A, MISURATO dall'agente, home e `/tickets`, 4 lingue)
Home: 92 link = 21 reali + 4 verso il login + **9 che danno 404** + **18 `#`** + **32 senza href** + 6 esterni + 2 ancore. `/tickets`: 108 link = 34 + 4 + 9 + 18 + 32 + 7 + 4. Voci di menu con una pagina vera dietro: **0 su 8**.

## Cose da fare (per l'ordine di lavoro vedi anche la tabella delle decisioni)
- [x] **A1 / E5 menu header:** **Fix 2026-10-15:** `header.json` (3 copie) sostituisce la nav demo Design Comuni con percorsi FixCity (`/tickets`, `/tickets/create`, `/tickets/track`, `/domande-frequenti`); `design-comuni.blade.php` localizza con `FrontofficeUrl::fromStoredUrl()` e salta voci con URL vuoto/`#`. Guard: `HeaderNavigationLocalizedUrlsTest`.
- [x] **A2 social header:** **Fix 2026-10-15:** `social_links: []` in ogni lingua (D198-5); il Blade filtra URL vuoti/`#` e non emette `<a href="#">`. Guard: `HeaderNavigationLocalizedUrlsTest` (zero hash nei social renderizzati).
- [x] **A5 footer:** **Fix 2026-10-15 (DCP-222):** `footer.json` ridotto a voci FixCity reali; vestito `design-comuni`/`v1` non emette `<a>` senza URL; social `[]`; logo UE nascosto. Guard `FooterJsonBrandAndLinksSsotTest`.
- [x] **A7 «Mappa del sito»:** path demo morti sostituiti con percorsi FixCity reali (`/tickets/create`, `/tickets`, legale, accessibilita'); guard `Themes/Sixteen/tests/Unit/SitemapPathsGuardTest.php` (2026-10-15).
- [ ] **Home, servizi con `href="#"`** (DCP-186 e verifica di un'altra sessione): 8 servizi che il progetto non eroga («Cambio di residenza», «Prenotazione appuntamenti», «Rilascio CIE», «Rilascio tessera elettorale», «Tributi online», «Voucher connettivita'»). Decisione D198-3.
- [x] **A10:** `aria-label` e `title` della barra «Nome della Regione» contengono graffe letterali, tipo `{Nome della Regione}`, in 4 lingue (`header.json:27-30`): un lettore di schermo le legge. **Fix 2026-10-15:** `RegionPortalLinkLabels` sostituisce i segnaposto `{…}` con `region.name` o `config('comune.regione')`; se il nome manca, gli attributi non vengono emessi. Guard: `HeaderRegionAccessibleLabelsTest`.
- [ ] **A11 / C9 recapiti:** quattro numeri diversi su `/tickets` (`tel:050505` scritto nel Blade, «800 016 123», «+39 320 1234567», «012 3456» nel footer) piu' «05 0505» nel wizard (`tickets.create.json:60`). Il box «Contatta il comune» non esiste in home ne' su `/tickets`; c'e' «Hai bisogno di aiuto?». Un solo recapito, da dati dell'ente (D198-1), mai nel Blade.
- [x] **A14 nome del servizio (header):** `brand.name` / `header_title` / `tagline` = FixCity + slogan prodotto in `header.json` (3 copie). Restano segnaposto regione/ente finche' D198-2 non da' il nome del Comune; footer/cookiebar fuori da questo giro.
- [ ] **A12 logo NextGenerationEU nel footer:** nessuna prova di finanziamento PNRR nel repository. Togliere finche' non c'e' una prova (D198-4).
- [ ] **A15:** le 4 CTA «invia segnalazione» portano al login da ospite senza avviso (contro il principio di D17 «dirlo all'ingresso»); il blocco «Segui la tua segnalazione» promette «Inserisci il codice» ma non ha un campo. Aggiungere l'avviso («per segnalare serve accedere») e il campo del codice, che porta a `/tickets/track`.
- [ ] **A16 dati morti:** `header.json` ha `account.signed_in.menu`, `account.url`, `utility_links` e `social` che il Blade non legge. Togliere o collegare.
- [ ] **A17 documentazione:** la matrice di interfaccia (I-16, I-17) e lo scopo del progetto (par. 5) non corrispondono piu' a cio' che si misura (privacy, note legali, accessibilita', media policy rispondono 200; `/mappa-sito` e' lo slug corretto; i titoli di `/de` e `/es` sono tradotti; nella home 0 stringhe su 29 sono uguali all'italiano). Aggiornarle.
- [ ] Test di regressione: tutti i link di `header` e `footer` di home e `/tickets` in 4 lingue o risolvono (200/302) o non hanno `href`; zero `href="#"`; zero graffe nei testi accessibili.

## Decisioni da prendere
| ID | Domanda | Opzioni | Raccomandazione | Chi decide | Blocca |
|---|---|---|---|---|---|
| D198-1 | Recapito unico del servizio (telefono, email, orari) | numero dell'ente / numero del fornitore / nessun numero | solo recapiti reali dell'ente, in un solo campo di dati letto da header, footer, wizard e box «Contatta il comune» | ente | A11, C9 |
| D198-2 | Denominazione dell'ente e del servizio mostrata in header e footer | nome dell'ente e «FixCity» / solo l'ente | entrambi: «FixCity, un servizio del Comune di X» (chiarisce chi e' titolare, vedi DCP-193) | ente | A14 |
| D198-3 | I servizi della home non erogati | togliere / lasciare come «prossimamente» / tenerli con link a un servizio esterno vero | togliere: il blocco ha senso solo con servizi veri | prodotto, ente | home |
| D198-4 | Logo NextGenerationEU | togliere / tenere con prova di finanziamento | togliere se il Comune non conferma il PNRR | ente | footer |
| D198-5 | Account social | l'ente li indica / toglierli | toglierli finche' l'ente non fornisce gli account (adesso 0 su 18 sono reali) | ente | A2, A6 |
| D198-6 | Voci di menu senza pagina («Amministrazione», «Novita'», «Eventi», «Argomenti»...) | creare le pagine / togliere le voci / link a un sito esterno dell'ente | togliere finche' l'ente non ha i contenuti; FixCity e' un servizio, non il sito del comune | ente, prodotto | A1, E5 |

## Criteri di accettazione
- [ ] Nessun `href="#"` e nessun link che risponde 404 in header, footer, mappa del sito, home e `/tickets`, in 4 lingue (test).
- [ ] Le voci non attive non hanno l'aspetto di un link.
- [ ] Un solo numero di telefono nel sito, preso dai dati dell'ente.
- [ ] La matrice di interfaccia e' riallineata.

## Owned File/Module Scope
- `laravel/config/*/fixcity/database/content/sections/header.json` e `footer.json`
- `laravel/Themes/Sixteen/resources/views/components/{header,footer,sections}/**`
- `laravel/Themes/Sixteen/lang/*/sitemap.php` e le chiavi del footer
- `laravel/Modules/Fixcity/tests/Feature/Pages/Footer*Test.php`
Non toccare: dati dell'ente (decisioni D198-1..6).

## Non verificato
Il menu dell'utente autenticato (dropdown); la visibilita' a schermo delle voci morte a ogni larghezza; i siti esterni.
