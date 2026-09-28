---
title: "Design Comuni — confronto runtime FAQ e mappa del sito"
type: bmad-gap-analysis
theme: Sixteen
created: 2026-09-27
updated: 2026-09-27
references:
  - https://italia.github.io/design-comuni-pagine-statiche/index.html
  - https://italia.github.io/design-comuni-pagine-statiche/servizi/index.html
issues:
  - https://github.com/laraxot/base_fixcity_fila5/issues/522
discussions:
  - https://github.com/laraxot/base_fixcity_fila5/discussions/523
---

# Confronto: atteso e realtà osservata

Verifica del 2026-09-27 su `http://localhost:8001`, prima delle modifiche.

| Area | Atteso secondo i template | Realtà prima della correzione | Esito |
|---|---|---|---|
| Catalogo generale | FAQ e mappa del sito con destinazioni utili | Entrambi gli URL rispondono HTTP 200 ma il CMS non ha un contenuto tenant dedicato; il titolo resta “FixCity” e il contenuto principale è vuoto | Gap funzionale mascherato dallo status HTTP |
| Dati disponibili | Contenuti pertinenti al servizio | `Modules/Fixcity/resources/json/domande-frequenti.json` contiene 20 FAQ generiche e risposte Lorem Ipsum | Non riutilizzabile e potenzialmente fuorviante |
| Flussi di servizio | Schermate coerenti con il servizio offerto | FixCity implementa segnalazione, consultazione e tracking; gli altri flussi del catalogo (pagamenti, graduatorie, permessi, appuntamenti) non appartengono al prodotto | Mantenere il perimetro, senza imitare servizi assenti |
| Lingue | Stesso contenuto disponibile nelle lingue pubblicate | Nessuna pagina statica dedicata alle due utility e nessun contratto copy specifico | Quattro cataloghi locale necessari |
| Navigazione | Link contestuali a scheda, elenco, tracking e accesso | I vecchi riferimenti FAQ includono anche `#` e percorsi sotto `/tests` | Sostituire con collegamenti canonici verificati |

## Dopo la correzione

- FAQ e mappa hanno contenuto e metadata localizzati, resi dal pattern CMS/Folio
  + Volt esistente con componenti Sixteen.
- Il footer fornisce un ingresso localizzato alle due utility.
- Playwright Chromium: 2 test passati. Copertura: entrambe le pagine × IT/EN/DE/ES,
  quattro larghezze (320, 390, 768 e 1440px), link, console, overflow, contenuto
  senza chiavi raw e redirect guest nella lingua corretta.
- View cache e quality gate wiki passano.

## Decisione

Implementare due utility nel tema Sixteen, renderizzate dall'entrypoint CMS/Folio
con copy in file lingua e link alle route canoniche già esistenti. Non usare il
JSON FAQ generico del modulo,
non introdurre controller o servizi, non dichiarare tempi di risposta o contatti
non configurati. Il contenuto FAQ descrive soltanto comportamenti verificati.

## Route verificate prima dell'intervento

`/it`, `/it/services`, `/it/tickets`, `/it/tickets/track`, `/it/news`,
`/it/administration`, `/it/privacy`, `/it/auth/login` e `/it/auth/register`
rispondono HTTP 200; `/it/area-personale/pratiche` reindirizza correttamente a
`/it/auth/login` per un guest. Le versioni localizzate verranno controllate nel
browser dopo l'implementazione.
