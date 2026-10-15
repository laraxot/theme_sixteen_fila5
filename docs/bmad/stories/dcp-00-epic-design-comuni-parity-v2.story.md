---
id: dcp-00
title: "Epic: parity Design Comuni v2, pagine guidate da JSON"
type: story
epic: dc-parity-v2
status: in-progress
priority: P0
owner: theme:Sixteen
created: 2026-10-13
updated: 2026-10-13
qmd: "design comuni parity epic: parity design comuni v2, pagine guidate da json bmad story"
tags: [docs, sixteen, bmad]
---

# Epic: parity Design Comuni v2, pagine guidate da JSON

## Obiettivo
Le pagine `/it/tests/*` devono raggiungere almeno 90% di HTML parity (body, script esclusi) e 97% di visual parity
(375, 768, 1440 px) rispetto a `https://italia.github.io/design-comuni-pagine-statiche/sito/<pagina>.html`, **passando dal contratto del tema**:
Folio generico `[slug]` -> `<x-page>` -> blocchi/sezioni Blade -> JSON `tests.<slug>.json`, stile in `app.css`,
interattivita' con Alpine in `app.js`. Stack: TailwindCSS + Alpine + Lit + DaisyUI + Flowbite, mai Bootstrap Italia a runtime.

## Stato a fine giornata 2026-10-13 (misurato con il gate, non dichiarato)
| Pagina | HTML body | Visual 1920 / 1440 / 992 / 768 / 375 | Note |
|---|---:|---|---|
| `/it/tests/homepage` | **91,2%** rigorosa / 98,6% URL norm. (era 26,9%) | 99,91 / 99,88 / 99,89 / 99,89 / 99,83% (era 35%) | altezze identiche a ogni larghezza; al limite della soglia HTML |
| `/it/tests/risultati-ricerca` | **93%** rigorosa / 98,9% URL norm. (era 13,2%) | 99,92 / 99,9 / 99,88 / 99,84 / 99,76% (era 34%) | altezze identiche; modale `modal-disservizio` da JSON |
| `/it/tests/appuntamento-02-data-orario` | 87,5% rigorosa / **97,7%** URL normalizzati (era 59%) | 99,86 / 99,81 / 99,74 / 99,84 / 99,78% (era 11%) | pagina a caso scelta dall'utente, [DCP-14](dcp-14-appuntamento-02-data-orario.story.md); sotto 90% rigoroso solo per i valori degli URL |
| `/it/tests/eventi` | 88,8% rigorosa / **98,4%** URL normalizzati (era 42,9%) | 99,76 / 99,68 / 99,91 / 99,94 / 99,87% (era 20-44%) | pagina indicata dall'utente, [DCP-15](dcp-15-eventi.story.md); altezze identiche |
| `/it/tests/evento-dettaglio` | **90,15%** rigorosa / 97,7% URL norm. (era 52,5%) | 98,82 / 99,48 / 99,27 / 99,54 / 99,10% (era 30-40%) | pagina indicata dall'utente, [DCP-17](dcp-17-evento-dettaglio.story.md); altezze identiche; gate HTML superato |
| `/it/tests/segnalazione-01-privacy` | 76,9% / 86,8% (baseline) | 94,2 / 92,9 / 91,5 / 90,0 / 89,2% (baseline) | non iniziata, [DCP-16](dcp-16-segnalazione-01-privacy.story.md) |
| `/it/tests/accesso-servizio` | 85,5% rigorosa / 97,7% URL norm. (era 74,1%) | 99,90 / 99,87 / 99,81 / 99,76 / 99,64% (era 80-91%) | pagina indicata dall'utente, [DCP-18](dcp-18-accesso-servizio.story.md); altezze identiche |
| `/it` (home reale) | n.m. | identica: 0,000% pixel diversi | sentinella |
| `/it/tickets` | n.m. | chrome vecchio invariato (0 `it-header-wrapper`) | usa `layouts/test`, non toccato |
| `/it/tests/` (indice), `/it/tests/argomenti` | n.m. | n.m. dopo il cambio di layout | ora su `layouts/design-comuni`: da rimisurare (DCP-10) |
| `/it/tests/domande-frequenti` | n.m. | n.m. | HTTP 500 nel blocco FAQ (DCP-10) |

Comportamenti verificati con i pixel dopo il clic (header, modale di ricerca, menu mobile, tendina lingua, rating, filtri): 99,7 - 100%.
`n.m.` = non misurato. Header e footer isolati: 100% a 1440, 992 e 375 px.

DCP-05, DCP-06, DCP-07: **done**. Resta: DCP-10 (FAQ 500, `|---LINE:n---|` del compilatore Volt, sweep delle pagine), DCP-12 (peer che riscrivono i file), DCP-09 (guardia JSON), DCP-03 (eliminare i file legacy invece di isolarli), DCP-01 (wrapper del gate).

## Ondata 1 (2026-10-13 sera): 37 pagine misurate col gate reale
Pagine con pixel >= 97% a 1920/1440/992/768/375 e altezze identiche (37; segnalazione DCP-23 e contenuti DCP-25: amministrazione, argomenti, argomento, documenti-dati, domande-frequenti, mappa-sito; minimo 99,52%): segnalazione-01-privacy, 02-dati, 03-riepilogo, 04-conferma, segnalazione-area-personale, segnalazione-dettaglio, segnalazioni-elenco, homepage, risultati-ricerca, appuntamento-01-ufficio-luogo, 01-ufficio, 02-data-orario, 03-dettagli, 04-richiedente, 04-richiedente-autenticato, 05-riepilogo, 06-conferma, eventi, evento-dettaglio, accesso-servizio, novita, novita-dettaglio, assistenza-01-dati, assistenza-02-conferma, index (catalogo), lista-categorie, lista-risorse-categorie, lista-risorse, servizi, servizi-categoria, servizio-dettaglio. Minimo misurato 99,63%.
HTML rigoroso >= 90% su 7 di 24 (homepage, risultati-ricerca, evento-dettaglio, lista-risorse-categorie, servizi, servizio-dettaglio e il catalogo al limite con 89,3%); le altre sono tra 86,5% e 89,7% **solo per i valori di `href`/`src`** (con URL normalizzati tutte >= 97,5%). Decisione aperta per l'utente: tenere come gate l'HTML rigoroso (e allora servono URL identici al riferimento, cioe' percorsi relativi `../assets/...` serviti sotto `/it/assets/`: un alias di route solo per la metrica) oppure l'HTML con URL normalizzati.
Report: [parity-sweep-2026-10-13](../parity-sweep.md). Famiglie: DCP-20 (novita-assistenza), DCP-22 (liste-e-servizi), DCP-24 (appuntamento): done; DCP-23 (segnalazione): done con riserva (HTML rigoroso 85,7-89,9%, URL normalizzati 95,7-98,4%; il cambio tab dell'area personale ora funziona con `initTabs`); DCP-25 (contenuti): done (`/it/tests/domande-frequenti` non da' piu' 500); DCP-21 (service-flow, 7 pagine servizi-pagamento): done con riserva, pixel minimo 99,5-99,82% e altezze uguali (rimisurato con lo sweep), HTML rigoroso >= 90 su 3 di 7; ondata 2 (graduatoria DCP-26, imu DCP-27, multa DCP-28, permessi DCP-29, vantaggi DCP-30): consegnate e rimisurate con lo sweep reale (37 pagine incluso `servizi-index`, CSS rigenerata con 81 pagine, header autenticato per le `*-area-personale`): pixel minimo 99,61-99,85%, altezze uguali su tutte, HTML rigoroso >= 90 su 13 di 37 (URL normalizzati >= 97,49%); `graduatoria-pagamento` e `pagamenti-multa-pagamento` non esistono nel riferimento (404), slug multa rinominati `specifici`; [DCP-31 servizi-index](dcp-31-servizi-index-catalogo-flussi.story.md) (catalogo dei flussi, ultima pagina fuori famiglia): in revisione, pixel 99,75-100% con altezze uguali, HTML 89,54 / 98,69 normalizzato.

## Pagine reali del flusso segnalazione (2026-10-13 pomeriggio)
L'utente ha chiesto altissima parity anche per le pagine REALI: `/it/tickets/create?step=form.riepilogo...` (con mappa) e la conferma dopo il salvataggio. Stato: scope CSS `data-dc` e layout dal JSON ([DCP-32](dcp-32-scope-data-dc-pagine-reali.story.md), in revisione); conferma reale fatta e misurata sulla parte comune, 99,46-99,85% ([DCP-34 modulo](../../../../../Modules/Fixcity/docs/stories/dcp-34-tickets-confirmation-design-comuni.story.md), in revisione); riepilogo cablato nel wizard, **parte alta 99,94-100%, pagina intera NON ancora al criterio** (fixture ospite incompleta: 5 righe e "Dati Generali" mancano; [DCP-33 modulo](../../../../../Modules/Fixcity/docs/stories/dcp-33-tickets-create-riepilogo-design-comuni-mappa.story.md)); mappa di sola lettura nel modulo Geo ([DCP-93](../../../../../Modules/Geo/docs/stories/dcp-93-geo-namespace-blade-e-mappa-sola-lettura-follow-up.story.md)). Passi 1-2 del wizard: altra sessione ([DCP-35 modulo](../../../../../Modules/Fixcity/docs/stories/dcp-35-tickets-create-privacy-dati-coordinamento.story.md)); i numeri duplicati DCP-32..35 sono mappati in [DCP-97](dcp-97-registro-flusso-tickets-numerazione-e-coordinamento.story.md).
Aperti che richiedono una decisione o un'azione: [DCP-94](dcp-94-decisione-metrica-html-rigorosa.story.md) (metrica HTML, serve l'utente), [DCP-90](../../../../../Modules/Fixcity/docs/stories/dcp-90-test-rossi-preesistenti-flusso-tickets.story.md) (test rossi), [DCP-91](dcp-91-wizard-css-legacy-e-passi-su-data-dc.story.md) (regressione dei passi 1-2 finche' non arrivano le viste `dc-*`), [DCP-92](dcp-92-header-voce-servizi-attiva-e-menu-pagine-reali.story.md) (header).

## Cosa ha sbloccato il salto (da 35% a 99,8% sul main)
1. Plugin PostCSS `postcss/isolate-legacy-important.cjs`: ogni regola legacy fuori da `.dc-page` viene limitata agli elementi fuori da `.dc-page` (`:where()`, specificita' zero). Il finder `find-important-overrides.mjs` passa da 143 regole esterne `!important` a 0.
2. Tolti gli `id="main-container"` duplicati copiati dal riferimento (anche `<main>` del layout lo ha): attivavano `#main-container { padding-block: 2rem }`.
3. Tolte le toppe a mano su `.dc-page` aggiunte da un altro agente (`!important` forzato anche in hover sul pulsante "Cerca", `padding-top` doppio sul contenitore).
4. `#main-container:has(.dc-page) { padding: 0 !important }` in `design-comuni/overrides.css` (il layout condiviso mette padding al `<main>`, il riferimento no).
5. Dati completi nel JSON e regola `@class` esatta (ultima voce del calendario).

## Percorso critico per domani
1. (fatto) DCP-05/06/07: header, footer, modale, risultati-ricerca.
2. DCP-10: sweep delle altre pagine con lo stesso metodo (vedi il wiki concept), 500 delle FAQ; l'utente ha chiesto di prendere una pagina a caso del riferimento e crearla/migliorarla (vedi la story DCP-14).
3. DCP-12 e DCP-09: protocollo di proprieta' dei file e guardia sui JSON (rapide).
3. DCP-03 (resto): scollegare i file legacy dalle pagine che non usano `.dc-page`, senza cambiare `/it`.
4. DCP-10: sweep delle pagine e 500 delle FAQ; replicare il metodo (JSON + blocco + CSS generato + isolamento) sulle altre pagine.
6. DCP-01 (gate unico), DCP-08, DCP-11, DCP-13 in parallelo.

## Storie
- [DCP-01 gate e definizione di fatto](dcp-01-parity-gate-definition-of-done.story.md)
- [DCP-02 contratto "le pagine sono dato"](dcp-02-tests-pages-are-data-contract.story.md)
- [DCP-03 debito CSS legacy](dcp-03-legacy-parity-css-cascade-debt.story.md)
- [DCP-04 homepage main 97%](dcp-04-homepage-main-block.story.md)
- [DCP-05 header](dcp-05-header-section-design-comuni.story.md)
- [DCP-06 footer e modale](dcp-06-footer-and-search-modal-sections.story.md)
- [DCP-07 risultati-ricerca](dcp-07-risultati-ricerca-html-visual.story.md)
- [DCP-08 asset e font](dcp-08-asset-integrity-and-fonts.story.md)
- [DCP-09 guardia JSON](dcp-09-json-content-integrity-guard.story.md)
- [DCP-10 sweep e FAQ](dcp-10-faq-block-500-and-pages-sweep.story.md)
- [DCP-11 MCP e second brain](dcp-11-mcp-repair-and-second-brain.story.md)
- [DCP-12 protocollo multi-agente](dcp-12-multi-agent-ownership-protocol.story.md)
- [DCP-13 correzione documenti e dossier difetti](dcp-13-docs-correction-and-defect-dossier.story.md)
- [DCP-14 appuntamento-02-data-orario (pagina a caso)](dcp-14-appuntamento-02-data-orario.story.md)
- [DCP-15 eventi (pagina indicata)](dcp-15-eventi.story.md)
- [DCP-16 segnalazione-01-privacy (baseline, da fare)](dcp-16-segnalazione-01-privacy.story.md)
- [DCP-17 evento-dettaglio](dcp-17-evento-dettaglio.story.md)
- [DCP-18 accesso-servizio](dcp-18-accesso-servizio.story.md)
- [DCP-19 piano di replica di tutte le pagine (ondate parallele)](dcp-19-piano-replica-tutte-le-pagine.story.md)
- [DCP-31 servizi-index (catalogo dei flussi di servizio)](dcp-31-servizi-index-catalogo-flussi.story.md)
- [DCP-32 scope CSS data-dc per le pagine reali e layout dal JSON](dcp-32-scope-data-dc-pagine-reali.story.md)
- [DCP-33 /it/tickets/create passo riepilogo con mappa (modulo Fixcity)](../../../../../Modules/Fixcity/docs/stories/dcp-33-tickets-create-riepilogo-design-comuni-mappa.story.md)
- [DCP-34 /it/tickets/confirmation dopo il salvataggio (modulo Fixcity)](../../../../../Modules/Fixcity/docs/stories/dcp-34-tickets-confirmation-design-comuni.story.md)
- [DCP-35 passi 1-2 del wizard e coordinamento (modulo Fixcity)](../../../../../Modules/Fixcity/docs/stories/dcp-35-tickets-create-privacy-dati-coordinamento.story.md)
- [DCP-90 test rossi preesistenti nel flusso tickets (modulo Fixcity)](../../../../../Modules/Fixcity/docs/stories/dcp-90-test-rossi-preesistenti-flusso-tickets.story.md)
- [DCP-91 wizard: CSS legacy isolato e passi su data-dc](dcp-91-wizard-css-legacy-e-passi-su-data-dc.story.md)
- [DCP-92 header: voce Servizi attiva](dcp-92-header-voce-servizi-attiva-e-menu-pagine-reali.story.md)
- [DCP-93 Geo: namespace Blade e follow-up della mappa (modulo Geo)](../../../../../Modules/Geo/docs/stories/dcp-93-geo-namespace-blade-e-mappa-sola-lettura-follow-up.story.md)
- [DCP-94 decisione sulla metrica HTML (serve l'utente)](dcp-94-decisione-metrica-html-rigorosa.story.md)
- [DCP-95 strumenti di misura con filtri](dcp-95-strumenti-misura-filtri-hide-exclude-prepare.story.md)
- [DCP-97 registro della numerazione e del coordinamento sul flusso tickets](dcp-97-registro-flusso-tickets-numerazione-e-coordinamento.story.md)
- [DCP-98 account e ticket di prova per le misure autenticate (modulo Fixcity)](../../../../../Modules/Fixcity/docs/stories/dcp-98-account-di-prova-per-misure-autenticate.story.md)
- [DCP-99 HTML rigorosa: asset relativi come il riferimento](dcp-99-html-rigorosa-asset-relativi-come-il-riferimento.story.md)
- [DCP-100 service-flow: consolidamento delle varianti per famiglia](dcp-100-service-flow-consolidamento-varianti.story.md) (agente al lavoro; la story compare a fine lavoro)
- [DCP-101 guardie su JSON, asset e manifest (modulo Cms)](../../../../../Modules/Cms/docs/stories/dcp-101-guardie-json-asset-manifest.story.md)
- [DCP-102 tracking pubblico senza rate limit](dcp-102-tracking-pubblico-senza-rate-limit-oscurato-dal-tema.story.md)
- [DCP-103 test rossi residui nel modulo Fixcity](../../../../../Modules/Fixcity/docs/stories/dcp-103-test-rossi-residui-modulo-fixcity.story.md)
- [DCP-104 pagine reali elenco e dettaglio segnalazioni (serve decisione)](dcp-104-pagine-reali-elenco-e-dettaglio-segnalazioni.story.md)
- [DCP-105 versione inglese delle pagine di prova (serve decisione)](dcp-105-versione-inglese-pagine-di-prova.story.md)
- [DCP-106 header "Accedi all'area personale" reale e pagine collegate](dcp-106-header-area-personale-reale-e-pagine-collegate.story.md) (richiesta dell'utente 16:45; coordinamento con altra sessione)
- [DCP-110 area personale: pratiche e seguite (agente AP-A)](dcp-110-area-personale-pratiche-e-seguite.story.md)
- [DCP-111 area personale: notifiche e impostazioni (agente AP-B)](dcp-111-area-personale-notifiche-e-impostazioni.story.md)
- [DCP-112 scopo del progetto e conformita' normativa (agente LEGAL)](dcp-112-scopo-e-conformita-normativa.story.md)
- [DCP-51 home reale miglioramenti (altra sessione + sessione tema)](dcp-51-home-reale-miglioramenti.story.md)
- [DCP-104 `/it/tickets` (elenco) e dettaglio: elenco fatto con funzioni vere, dettaglio da fare](dcp-104-pagine-reali-elenco-e-dettaglio-segnalazioni.story.md)
- [DCP-120 multilinguismo: comportamenti e copertura (de/es)](dcp-120-multilingua-comportamenti-e-copertura.story.md); [DCP-123 lingua dichiarata vs reale](dcp-123-lingua-dichiarata-e-link-localizzati.story.md)
- [DCP-121 mobile e tablet: menu dell'header sulle pagine reali](dcp-121-mobile-e-tablet-menu-header-pagine-reali.story.md)
- [DCP-125 header: toggle utente `<button>` (regressione a 768 px su permessi-area-personale) e hamburger che copriva il nome della Regione](dcp-125-header-toggle-utente-e-hamburger-pagine-reali.story.md)
- [DCP-126 percorsi a due segmenti senza pagina: 404 vero](dcp-126-soft-404-percorsi-a-due-segmenti.story.md)
- [DCP-129 coordinamento passo 2 del wizard, audit mobile/tablet delle pagine reali e footer mobile (con DCP-127 mappa e DCP-128 cablaggio, nei moduli Geo e Fixcity)](dcp-129-coordinamento-wizard-passo2-audit-mobile-e-footer.story.md)
- [DCP-147 meta description delle pagine CMS per lingua (JSON grezzo nella conferma, descrizioni mancanti)](dcp-147-meta-description-pagine-cms-per-lingua.story.md)
- [DCP-148 dettaglio pubblico di una segnalazione e pulsante Segui](dcp-148-dettaglio-pubblico-segnalazione-e-segui.story.md)
- DCP-149 ricerca per codice di tracciamento con limite di tentativi e DCP-150 ricerca dell'elenco per indirizzo senza distinzione di maiuscole: story nel modulo Fixcity (`laravel/Modules/Fixcity/docs/stories/2026-10-14-dcp-149-*.story.md`, `2026-10-14-dcp-150-*.story.md`); DCP-151 pagina 404 del front office con il layout del tema (`2026-10-14-dcp-151-*.story.md`)

## Analisi delle cause e guardrail
[Decisione 2026-10-13: perche' non ho completato e cosa cambia](../decisions/parity-root-cause-and-guardrails.md).
Collegata a: [homepage-visual-parity-97](homepage-visual-parity.story.md), [risultati-ricerca-visual-parity-97](risultati-ricerca-visual-parity.story.md),
[homepage-json-driven-restructure](homepage-json-driven-restructure.story.md) (restano valide, non cancellate).

## Story tickets/create (DCP-35, 13:55 UTC)
Coordinamento: DCP-35 (Fixcity). Figlie: DCP-40 (radice Volt, done, Sixteen), DCP-41 (resolver URL -> JSON, done, Cms), DCP-42 (auth tickets/create, ready-for-dev, Fixcity), DCP-43 (passo 2, in-progress, Fixcity), DCP-44 (audit docs, done, Fixcity), DCP-45 (isolamento DB test, open, Xot), DCP-46 (passo 1 privacy, in-progress, Fixcity). Con DCP-33 e DCP-34 (Fixcity) coprono i quattro passi. Blocco id DCP-40..49 usato da questo lavoro.

## Aggiornamento serale (2026-10-13): HTML rigorosa e account di prova
HTML rigorosa >= 90 su 79 pagine su 81 con gli asset relativi come il riferimento ([DCP-99](dcp-99-html-rigorosa-asset-relativi-come-il-riferimento.story.md); [DCP-94](dcp-94-decisione-metrica-html-rigorosa.story.md) decisa dall'orchestratore, reversibile); voce di menu attiva dal JSON ([DCP-92](dcp-92-header-voce-servizi-attiva-e-menu-pagine-reali.story.md), in revisione); pagine reali misurate da autenticato con un account di prova ([DCP-98](../../../../../Modules/Fixcity/docs/stories/dcp-98-account-di-prova-per-misure-autenticate.story.md)): riepilogo 99,48-99,85%, conferma 99,41-99,84%. Aperti: DCP-90 (agente al lavoro), DCP-91, DCP-93, passi 1-2 (altra sessione).

## Sweep sito/ + catalogo dopo gli asset relativi (2026-10-13 16:20, 36 pagine)
HTML rigorosa >= 90 su 35/36 (sotto solo il catalogo `index` 89,54 / 98,4); pixel minimo >= 99,62% con altezze uguali su 36/36 (eccezione dichiarata: `evento-dettaglio` 98,81). Con le 45 pagine di `servizi/` (campione di 10 rimisurato dopo la modifica, completo da rifare a fine giornata): HTML rigorosa >= 90 su 79/81 pagine.

## Richiesta dell'utente 2026-10-13 ~16:45 e ~17:00 (stato)
(1) `/it/` migliorata (DCP-51: causa dei contrasti e dei padding provata e corretta, axe a 0 serious, SEO, mappa). (2) Header: ospite -> login, loggato -> menu con nome reale (altra sessione) e voci collegate a pagine vere (DCP-106): le pagine `area-personale/*` erano VUOTE (200 senza contenuto) per l'oscuramento della pagina dinamica del tema; in costruzione come pagine JSON (DCP-110, DCP-111). (3) `/it/tickets` con altissima parity e funzioni vere: DCP-104, ora decisa dall'utente e affidata a un agente. (4) Scopo del progetto e norme con prove: DCP-112 (agente LEGAL), con story di chiusura delle lacune da DCP-113. (5) Da fare dopo i report: audit multilingua (DCP-120), mobile/tablet (DCP-121), organizzazione dei docs (DCP-122), 404 al posto del 200 vuoto per slug senza pagina.
Credenziali di sviluppo fornite dall'utente (account `marco.sottana@gmail.com`): usate SOLO via variabili d'ambiente negli script di misura, mai scritte nel repo o nella memoria.

## Consegne del 2026-10-13 pomeriggio-sera (stato)
- **Area personale** (header ospite/loggato, 4 pagine vere): header dall'altra sessione; pagine `pratiche`+`seguite` (DCP-110, AP-A) e `notifiche`+`impostazioni` (DCP-111, AP-B) come pagine JSON con `["auth"]`, test e axe puliti, de/es inclusi; difetti fuori ambito elencati nelle story (footer con link 404, nessuna informativa privacy, contatti del Comune segnaposto).
- **`/it/tickets`**: elenco reale con ricerca, filtri con conteggi, paginazione GET, privacy dei dati, pixel 95,9-96,9% (87,6% a 375 per `min-height` della mappa in Geo) e HTML 49,9% rigorosa: il target 97/90 NON raggiunto; causa: mappa Leaflet contro segnaposto statico e funzioni in piu'. Dati di prova `DCPDEMO-01..11` nel DB di sviluppo (rimozione nella story).
- **Mobile**: menu principale delle pagine reali riparato (DCP-121).
- **Multilingua**: chrome e home tradotti in de/es, selettore lingua con 4 lingue, 5 test di parita' dei contenuti (DCP-120).
- **service-flow** consolidato (DCP-100): -44% di righe, diff HTML vuoto dopo normalizzazione dichiarata.
- In attesa: studio normativo (DCP-112), poi story di chiusura delle lacune da DCP-113.

