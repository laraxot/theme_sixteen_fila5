---
id: dcp-192
title: "DCP-192: menu, footer, social e segnaposto del front office: ogni voce porta da qualche parte o non c'e'"
type: story
epic: dc-parity-v2
status: open
priority: P1
owner: theme:Sixteen
created: 2026-10-15
updated: 2026-10-15
qmd: "menu header 404 prefisso lingua footer voci senza href social href # servizi home segnaposto mappa del sito numero verde telefoni nome del servizio aria-label graffe header.json dati morti"
related: [dcp-186, dcp-131, dcp-133, dcp-154, dcp-130]
tags: [docs, sixteen, bmad, menu, footer, contenuti-ente, front-office]
---

# DCP-192: voci morte e segnaposto

## Fase BMAD
Plan. Nata dall'audit [DCP-186](./2026-10-14-dcp-186-front-office-scopo-e-senso-di-ogni-pagina-ed-elemento.story.md), gruppo A (misurato dall'agente in it, en, de, es; i numeri sono identici nelle 4 lingue: il difetto e' strutturale) e gruppi B, C.

## Scopo
Il chrome (barra, header, menu, footer) e' la prima cosa che il cittadino usa per orientarsi. Ogni voce deve portare a una pagina vera, oppure non essere un collegamento. Il riferimento Design Comuni e' pieno di voci di un comune d'esempio: vanno sostituite con quelle del servizio e dell'ente, non lasciate.

## Misure (gruppo A, MISURATO dall'agente, home e `/tickets`, 4 lingue)
Home: 92 link = 21 reali + 4 verso il login + **9 che danno 404** + **18 `#`** + **32 senza href** + 6 esterni + 2 ancore. `/tickets`: 108 link = 34 + 4 + 9 + 18 + 32 + 7 + 4. Voci di menu con una pagina vera dietro: **0 su 8**.

## Cose da fare (per l'ordine di lavoro vedi anche la tabella delle decisioni)
- [ ] **A1 / E5 menu header:** 9 URL senza prefisso lingua danno 404 (`/amministrazione`, `/argomenti`, `/argomenti/iscrizioni`, `/argomenti/estate-in-citta`, `/argomenti/polizia-locale`, `/eventi`, `/novita`, `/regione`, `/servizi`). Esiste gia' `/{lang}/services` per «Servizi». Sorgente: `config/*/fixcity/database/content/sections/header.json:27, 82-116`. Test: `FooterLinksResolveTest` ha gia' un `todo` per l'header; trasformarlo in test vero (stesso metodo del footer).
- [ ] **A2 social header:** 12 icone con `href="#"` e `target="_blank"` (il clic apre una nuova scheda sulla stessa pagina). **A6:** 0 account reali su 18 icone; il footer punta alle radici delle piattaforme (twitter.com, facebook.com, youtube.com, telegram.org, wa.me) e l'RSS non ha `href`.
- [ ] **A5 footer:** 32 voci `<a>` senza `href` per lingua (128 su 4), con la stessa sottolineatura e lo stesso colore dei link veri (cambia solo il cursore): un utente da tastiera o da lettore di schermo le percepisce come link. Per le 20 di «Categorie di servizio», «Novita'» e «Vivere il comune» non c'e' motivo di restare. Rendere il testo non attivo davvero distinguibile (non sottolineato) oppure toglierlo.
- [ ] **A7 «Mappa del sito»:** 3 link su 11 morti in 4 lingue (`/services/report-issue`, `/administration`, `/news`, in `Themes/Sixteen/lang/*/sitemap.php:9-10`); non elenca Cookie policy, Note legali, Accessibilita'.
- [ ] **Home, servizi con `href="#"`** (DCP-186 e verifica di un'altra sessione): 8 servizi che il progetto non eroga («Cambio di residenza», «Prenotazione appuntamenti», «Rilascio CIE», «Rilascio tessera elettorale», «Tributi online», «Voucher connettivita'»). Decisione D192-3.
- [ ] **A10:** `aria-label` e `title` della barra «Nome della Regione» contengono graffe letterali, tipo `{Nome della Regione}`, in 4 lingue (`header.json:27-30`): un lettore di schermo le legge.
- [ ] **A11 / C9 recapiti:** quattro numeri diversi su `/tickets` (`tel:050505` scritto nel Blade, «800 016 123», «+39 320 1234567», «012 3456» nel footer) piu' «05 0505» nel wizard (`tickets.create.json:60`). Il box «Contatta il comune» non esiste in home ne' su `/tickets`; c'e' «Hai bisogno di aiuto?». Un solo recapito, da dati dell'ente (D192-1), mai nel Blade.
- [ ] **A14 nome del servizio:** «FixCity» compare 0 volte in header, footer, modale e cookiebar; compaiono 4 nomi d'ente segnaposto («Il mio Comune», «Nome della Regione», «Nome del Comune», «Un comune da vivere»). Mostrare chi eroga il servizio e chi lo gestisce (D192-2).
- [ ] **A12 logo NextGenerationEU nel footer:** nessuna prova di finanziamento PNRR nel repository. Togliere finche' non c'e' una prova (D192-4).
- [ ] **A15:** le 4 CTA «invia segnalazione» portano al login da ospite senza avviso (contro il principio di D17 «dirlo all'ingresso»); il blocco «Segui la tua segnalazione» promette «Inserisci il codice» ma non ha un campo. Aggiungere l'avviso («per segnalare serve accedere») e il campo del codice, che porta a `/tickets/track`.
- [ ] **A16 dati morti:** `header.json` ha `account.signed_in.menu`, `account.url`, `utility_links` e `social` che il Blade non legge. Togliere o collegare.
- [ ] **A17 documentazione:** la matrice di interfaccia (I-16, I-17) e lo scopo del progetto (par. 5) non corrispondono piu' a cio' che si misura (privacy, note legali, accessibilita', media policy rispondono 200; `/mappa-sito` e' lo slug corretto; i titoli di `/de` e `/es` sono tradotti; nella home 0 stringhe su 29 sono uguali all'italiano). Aggiornarle.
- [ ] Test di regressione: tutti i link di `header` e `footer` di home e `/tickets` in 4 lingue o risolvono (200/302) o non hanno `href`; zero `href="#"`; zero graffe nei testi accessibili.

## Decisioni da prendere
| ID | Domanda | Opzioni | Raccomandazione | Chi decide | Blocca |
|---|---|---|---|---|---|
| D192-1 | Recapito unico del servizio (telefono, email, orari) | numero dell'ente / numero del fornitore / nessun numero | solo recapiti reali dell'ente, in un solo campo di dati letto da header, footer, wizard e box «Contatta il comune» | ente | A11, C9 |
| D192-2 | Denominazione dell'ente e del servizio mostrata in header e footer | nome dell'ente e «FixCity» / solo l'ente | entrambi: «FixCity, un servizio del Comune di X» (chiarisce chi e' titolare, vedi DCP-193) | ente | A14 |
| D192-3 | I servizi della home non erogati | togliere / lasciare come «prossimamente» / tenerli con link a un servizio esterno vero | togliere: il blocco ha senso solo con servizi veri | prodotto, ente | home |
| D192-4 | Logo NextGenerationEU | togliere / tenere con prova di finanziamento | togliere se il Comune non conferma il PNRR | ente | footer |
| D192-5 | Account social | l'ente li indica / toglierli | toglierli finche' l'ente non fornisce gli account (adesso 0 su 18 sono reali) | ente | A2, A6 |
| D192-6 | Voci di menu senza pagina («Amministrazione», «Novita'», «Eventi», «Argomenti»...) | creare le pagine / togliere le voci / link a un sito esterno dell'ente | togliere finche' l'ente non ha i contenuti; FixCity e' un servizio, non il sito del comune | ente, prodotto | A1, E5 |

## Criteri di accettazione
- [ ] Nessun `href="#"` e nessun link che risponde 404 in header, footer, mappa del sito, home e `/tickets`, in 4 lingue (test).
- [ ] Le voci non attive non hanno l'aspetto di un link.
- [ ] Un solo numero di telefono nel sito, preso dai dati dell'ente.
- [ ] La matrice di interfaccia e' riallineata.

## Non verificato
Il menu dell'utente autenticato (dropdown); la visibilita' a schermo delle voci morte a ogni larghezza; i siti esterni.
