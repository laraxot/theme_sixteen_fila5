---
title: "Design Comuni — piano di correzione FAQ e mappa del sito"
type: correction-plan
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

# Piano di correzione

1. Conservare il routing Folio canonico `pages/[container0]/index.blade.php`.
   Nel matcher Folio il wildcard directory-index precede la view letterale root;
   file standalone `pages/domande-frequenti.blade.php` e `pages/mappa-sito.blade.php`
   non diventano la view attiva e violerebbero il modello agnostico del tema.
2. Rendere le due destinazioni riservate tramite componenti visuali Sixteen
   inclusi dall'entrypoint `[container0]/index`, senza nuove route controller,
   directory semantiche in `pages/` o duplicazioni del layout.
3. Conservare `x-layouts.app`; localizzare titoli, contenuto e link tramite
   `Themes/Sixteen/lang/{locale}` e impostare metadata specifici per ciascuna pagina.
4. Scrivere FAQ limitate alle funzionalità confermate: invio autenticato,
   consultazione pubblica secondo stato, tracking tramite codice e area personale.
   Per i dettagli di trattamento dati rimandare alla privacy del tenant.
5. Costruire l'indice in tre gruppi semantici (servizi, aggiornamenti,
   informazioni), con percorsi reali e locale-aware. L'area personale è un link
   utile anche ai guest perché il redirect al login è intenzionale.
6. Non copiare le 20 FAQ generiche/demo e non aggiungere pagamenti,
   appuntamenti, richieste generiche o dati di contatto non configurati.
7. Verificare in Playwright le due pagine per quattro lingue, desktop e mobile:
   status, titolo, link, contenuto localizzato, assenza di chiavi raw, errori JS
   e overflow. Completare con `view:cache` e il quality gate wiki.

Il lavoro non modifica database, migrazioni, policy o stato dei ticket.
