---
id: bmad-sixteen-ux-performance-consent-brainstorming
title: "Brainstorming BMAD: UX, prestazioni e terze parti prima del consenso (residui dell'audit del front office)"
type: brainstorming
status: draft
module: Sixteen
created: 2026-11-12
updated: 2026-11-12
tags: [bmad, brainstorming, sixteen, ux, performance, consenso, gdpr, cls, asset]
qmd: "brainstorming ux prestazioni consenso terze parti cls wizard peso asset gravatar openstreetmap demo favicon codice morto residui audit front office"
related:
  - ./front-office-readiness-brainstorming.md
  - ./front-office-production-readiness-plan.md
  - ../plans/front-office-ux-performance-backlog-plan.md
  - ../stories/front-office-production-readiness-audit.story.md
  - ../stories/dcp-449-salto-di-layout-del-wizard-tickets-create.story.md
  - ../stories/dcp-450-peso-e-cache-degli-asset-del-tema.story.md
  - ../stories/dcp-451-guardia-sui-riferimenti-a-viste-cancellate.story.md
  - ../stories/dcp-452-residui-di-ux-accessibilita-e-messa-in-produzione-del-tema.story.md
  - ../stories/dcp-453-ritiro-del-codice-morto-del-tema-decisione.story.md
  - ../../../../Modules/Gdpr/docs/stories/dcp-454-terze-parti-prima-del-consenso-gravatar-e-openstreetmap.story.md
issues: []
discussions: ["https://github.com/laraxot/theme_sixteen_fila5/discussions/94"]
---

# Brainstorming: i residui dell'audit che non sono ancora corretti

Questo brainstorming **non decide**: mette in ordine le domande, le opzioni e i rischi dei cinque filoni rimasti aperti dopo l'audit del 2026-11-11 (le correzioni già fatte sono in DCP-447 e DCP-448).
Le decisioni vere vanno nel registro DCP-200 (DEC-69…72) e le prende chi ne ha titolo. Le altre due sessioni hanno già scritto il brainstorming di rilascio (`front-office-readiness-brainstorming.md`): qui si tratta solo il backlog di UX, prestazioni e consenso.

## Le domande, una per filone

| Filone | Domanda che decide | Chi risponde | Story |
|---|---|---|---|
| Terze parti prima del consenso | Il cittadino può vedere un avatar o una mappa senza che il suo IP arrivi a un terzo? Se serve la mappa, cosa gli diciamo prima? | titolare + DPO | DCP-454 (DEC-69) |
| Codice morto | Ritiriamo con `.old`, cancelliamo o teniamo il cluster che tiene 18 test rossi? | PO (approva anche l'eventuale cancellazione di test) | DCP-453 (DEC-70) |
| «Demo» e dati dell'ente | La fascia alta mostra un nome inventato finché l'ente non dà il suo? Chi consegna favicon e dati? | PO + ente | DCP-452 (DEC-71, DEC-72) |
| Salto di layout del wizard | La barra cookie in flusso vale 0,18 di CLS: la teniamo con `place()` prima del paint, o la rendiamo sempre fissa? | Gdpr + tema | DCP-449 |
| Peso e cache | Qual è l'obiettivo di byte per rotta? Che cosa si può togliere dal login? | PO + fornitore | DCP-450 |
| Viste cancellate | La guardia sui riferimenti ci basta, o serve anche la scansione HTTP delle pagine? | sviluppo | DCP-451 |

## Idee per filone (non decise)

**Terze parti.** Iniziali locali al posto di Gravatar costano quasi nulla; un proxy lato server sposta il problema (l'hash dell'email resta un dato personale). Per la mappa serve un'alternativa locale
o un consenso esplicito prima che parta il primo tile: nessuna delle due è un lavoro da un'ora. Pre-mortem: se si sceglie «dichiarare nell'informativa» (c) ma la base giuridica dichiarata è il consenso, il banner dice una cosa e il sito ne fa un'altra.

**Wizard.** Lo script sincrono per `place()` è piccolo ma sta nel modulo Gdpr; la barra sempre fissa evita il salto ma può coprire un controllo (WCAG 2.4.11). Pre-mortem: ridurre il CLS e coprire il pulsante «Avanti» a 375 px è un peggioramento, non un guadagno.

**Peso.** Il taglio più grosso (Leaflet e Filament fuori dal login) è anche il meno rischioso; il purge del CSS è il più rischioso (classi che spariscono solo in alcune pagine). Pre-mortem: un build che non parte (è già successo, DCP-447) vale più di 1 MB risparmiato.

**Codice morto.** Il `.old` è reversibile e visibile; la cancellazione è irreversibile senza la storia. Pre-mortem: ritirare un file che un modulo richiama a runtime con un nome composto, e scoprirlo con un 500.

**Viste.** Una guardia con troppi falsi positivi viene spenta dopo una settimana: meglio poche regole sicure che molte rumorose.

## Cosa NON fare (anti-obiettivi)

- Non cambiare la barra cookie né la CSP per «sistemare» il CLS o le terze parti: sono scelte del titolare.
- Non fissare obiettivi numerici di prestazioni senza una misura a macchina libera e su un build di produzione (F-05).
- Non rinominare classi del riferimento Design Comuni (`title-snall-semi-bold`) senza controllare il CSS.
- Non cancellare test né file nel docroot senza approvazione.

## Cosa serve per passare alla pianificazione

Le risposte DEC-69…72 e la decisione su `place()` (DCP-449). Il piano per onde è in `../plans/front-office-ux-performance-backlog-plan.md`.
