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
| `/it/tests/appuntamento-02-data-orario` | 87,5% rigorosa / **97,7%** URL normalizzati (era 59%) | 99,86 / 99,81 / 99,74 / 99,84 / 99,78% (era 11%) | pagina a caso scelta dall'utente, [DCP-14](2026-10-13-dcp-14-appuntamento-02-data-orario.story.md); sotto 90% rigoroso solo per i valori degli URL |
| `/it/tests/eventi` | 88,8% rigorosa / **98,4%** URL normalizzati (era 42,9%) | 99,76 / 99,68 / 99,91 / 99,94 / 99,87% (era 20-44%) | pagina indicata dall'utente, [DCP-15](2026-10-13-dcp-15-eventi.story.md); altezze identiche |
| `/it/tests/evento-dettaglio` | **90,15%** rigorosa / 97,7% URL norm. (era 52,5%) | 98,82 / 99,48 / 99,27 / 99,54 / 99,10% (era 30-40%) | pagina indicata dall'utente, [DCP-17](2026-10-13-dcp-17-evento-dettaglio.story.md); altezze identiche; gate HTML superato |
| `/it/tests/segnalazione-01-privacy` | 76,9% / 86,8% (baseline) | 94,2 / 92,9 / 91,5 / 90,0 / 89,2% (baseline) | non iniziata, [DCP-16](2026-10-13-dcp-16-segnalazione-01-privacy.story.md) |
| `/it/tests/accesso-servizio` | 85,5% rigorosa / 97,7% URL norm. (era 74,1%) | 99,90 / 99,87 / 99,81 / 99,76 / 99,64% (era 80-91%) | pagina indicata dall'utente, [DCP-18](2026-10-13-dcp-18-accesso-servizio.story.md); altezze identiche |
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
Report: [parity-sweep-2026-10-13](../parity-sweep-2026-10-13.md). Famiglie: DCP-20 (novita-assistenza), DCP-22 (liste-e-servizi), DCP-24 (appuntamento): done; DCP-23 (segnalazione): done con riserva (HTML rigoroso 85,7-89,9%, URL normalizzati 95,7-98,4%; il cambio tab dell'area personale ora funziona con `initTabs`); DCP-25 (contenuti): done (`/it/tests/domande-frequenti` non da' piu' 500); DCP-21 (service-flow): in corso; ondata 2 (graduatoria DCP-26, imu DCP-27, multa DCP-28, permessi DCP-29, vantaggi DCP-30): agenti avviati in parallelo, report non ancora arrivati; [DCP-31 servizi-index](2026-10-13-dcp-31-servizi-index-catalogo-flussi.story.md) (catalogo dei flussi, ultima pagina fuori famiglia): in revisione, pixel 99,75-100% con altezze uguali, HTML 89,54 / 98,69 normalizzato.

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
- [DCP-01 gate e definizione di fatto](2026-10-13-dcp-01-parity-gate-definition-of-done.story.md)
- [DCP-02 contratto "le pagine sono dato"](2026-10-13-dcp-02-tests-pages-are-data-contract.story.md)
- [DCP-03 debito CSS legacy](2026-10-13-dcp-03-legacy-parity-css-cascade-debt.story.md)
- [DCP-04 homepage main 97%](2026-10-13-dcp-04-homepage-main-block-97.story.md)
- [DCP-05 header](2026-10-13-dcp-05-header-section-design-comuni.story.md)
- [DCP-06 footer e modale](2026-10-13-dcp-06-footer-and-search-modal-sections.story.md)
- [DCP-07 risultati-ricerca](2026-10-13-dcp-07-risultati-ricerca-90-97.story.md)
- [DCP-08 asset e font](2026-10-13-dcp-08-asset-integrity-and-fonts.story.md)
- [DCP-09 guardia JSON](2026-10-13-dcp-09-json-content-integrity-guard.story.md)
- [DCP-10 sweep e FAQ](2026-10-13-dcp-10-faq-block-500-and-pages-sweep.story.md)
- [DCP-11 MCP e second brain](2026-10-13-dcp-11-mcp-repair-and-second-brain.story.md)
- [DCP-12 protocollo multi-agente](2026-10-13-dcp-12-multi-agent-ownership-protocol.story.md)
- [DCP-13 correzione documenti e dossier difetti](2026-10-13-dcp-13-docs-correction-and-defect-dossier.story.md)
- [DCP-14 appuntamento-02-data-orario (pagina a caso)](2026-10-13-dcp-14-appuntamento-02-data-orario.story.md)
- [DCP-15 eventi (pagina indicata)](2026-10-13-dcp-15-eventi.story.md)
- [DCP-16 segnalazione-01-privacy (baseline, da fare)](2026-10-13-dcp-16-segnalazione-01-privacy.story.md)
- [DCP-17 evento-dettaglio](2026-10-13-dcp-17-evento-dettaglio.story.md)
- [DCP-18 accesso-servizio](2026-10-13-dcp-18-accesso-servizio.story.md)
- [DCP-19 piano di replica di tutte le pagine (ondate parallele)](2026-10-13-dcp-19-piano-replica-tutte-le-pagine.story.md)
- [DCP-31 servizi-index (catalogo dei flussi di servizio)](2026-10-13-dcp-31-servizi-index-catalogo-flussi.story.md)

## Analisi delle cause e guardrail
[Decisione 2026-10-13: perche' non ho completato e cosa cambia](../decisions/2026-10-13-parity-root-cause-and-guardrails.md).
Collegata a: [homepage-visual-parity-97](homepage-visual-parity-97.story.md), [risultati-ricerca-visual-parity-97](risultati-ricerca-visual-parity-97.story.md),
[homepage-json-driven-restructure](homepage-json-driven-restructure.story.md) (restano valide, non cancellate).
