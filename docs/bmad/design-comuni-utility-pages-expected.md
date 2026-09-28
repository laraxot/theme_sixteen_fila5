---
title: "Design Comuni — aspettative per FAQ e mappa del sito"
type: ux-contract
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

# Contratto: pagine di orientamento pubbliche

## Lettura dei cataloghi

Il catalogo v2.4.0 del sito presenta 35 template funzionali in otto famiglie:
generali, amministrazione, novità, servizi, eventi, prenotazione appuntamenti,
assistenza e segnalazioni. Il catalogo dei flussi espone 44 schermate: due
passaggi condivisi e sei famiglie operative (graduatorie, permessi, vantaggi
economici, multe, IMU e pagamenti). Queste ultime non sono funzioni di FixCity e
non vanno simulate come servizi disponibili.

La sezione generale comprende FAQ e mappa del sito. Sono strumenti trasversali:
le FAQ devono rispondere a domande sul prodotto effettivamente attivo; la mappa
deve essere un indice navigabile delle sole destinazioni reali. Ogni pagina deve
avere titolo, breve orientamento, gerarchia leggibile, breadcrumb, link interni
localizzati e navigazione da tastiera.

## Contratto delle FAQ

- Pubblicare risposte brevi e verificabili su invio, visibilità, tracking e
  accesso all'area personale.
- Non presentare informazioni legali, tempi di risposta, canali di contatto,
  requisiti documentali o garanzie che l'ente non ha configurato.
- Collegare ogni risposta alla pagina operativa pertinente.
- Tradurre integralmente in IT, EN, DE ed ES; non usare dati demo o Lorem Ipsum.

## Contratto della mappa del sito

- Raggruppare le destinazioni pubbliche in attività, aggiornamenti e informazioni.
- Includere FAQ, scheda del servizio, elenco segnalazioni, tracking, privacy,
  accesso e registrazione; area personale con redirect login previsto.
- Escludere showcase, pagine di test, route interne e destinazioni non verificate.
- Usare link con nomi comprensibili, target tastiera visibile e tap area adeguata.

## Confini di prodotto

Il catalogo Design Comuni è un riferimento di struttura e usabilità, non una
richiesta di implementare tutti i servizi municipali. FixCity resta focalizzato
sulle segnalazioni civiche e non deve pubblicare flussi fittizi per appuntamenti,
pagamenti, graduatorie o assistenza generica.
