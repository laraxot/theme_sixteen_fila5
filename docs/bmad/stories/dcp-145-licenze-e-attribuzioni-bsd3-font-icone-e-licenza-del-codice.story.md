---
id: dcp-145
title: "DCP-145: licenze e attribuzioni: BSD-3 di Bootstrap Italia, font, icone, licenza del codice"
type: story
epic: dc-parity-v2
status: ready-for-dev
priority: P2
owner: theme:Sixteen + module:Fixcity
created: 2026-10-13
updated: 2026-10-13
qmd: "licenza bsd-3-clause bootstrap italia design comuni notice attribuzioni font titillium ofl sprites leaflet openstreetmap odbl license mit eupl agpl cad art 69 riuso"
related: [dcp-112, dcp-137]
tags: [docs, sixteen, bmad]
---

# DCP-145: cio' che si riusa ha la sua licenza rispettata e la propria e' dichiarata

Nata da DCP-112 (matrice normativa N-38, N-39; matrice interfaccia I-27).

## Lacuna e prova (2026-10-13)
- `Themes/Sixteen/resources/css/design-comuni/components.css` (righe 1-8) e' generato da `bootstrap-italia.min.css` 2.9.0 e riporta «licenza BSD-3-Clause, (c) Presidenza del Consiglio dei Ministri». La licenza letta su GitHub (`italia/bootstrap-italia`, `italia/design-comuni-pagine-statiche`) e' BSD-3-Clause con intestazione «Copyright (c) 2022, the respective contributors, as shown by the AUTHORS file» e tre titolari nel file AUTHORS (Team per la Trasformazione Digitale e Dipartimento per la trasformazione digitale della PCM; AgID). Mancano il testo completo con il disclaimer e l'elenco dei titolari.
- Lo sprite `public/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg`, i font locali (`Titillium_Web`, `Lora`, `Roboto_Mono`; dal 2026-10-14 le sorgenti sono in `resources/fonts/{titillium-web,lora,roboto-mono}`, vedi DCP-183) e le immagini copiate dal riferimento non hanno avviso; la licenza di font e icone del pacchetto non e' stata verificata (registro fonti 03).
- Nessun file `LICENSE`, `NOTICE` o pagina di crediti in `Themes/Sixteen`, `Modules/Fixcity` e radice `laravel/`; i `composer.json` dichiarano `"license": "MIT"` (solo `Modules/Gdpr/LICENSE` esiste).
- `Themes/Sixteen/docs/NO_BOOTSTRAP_ITALIA.md` afferma «NON stiamo usando Bootstrap Italia (CSS o JS)»: vero per il pacchetto, non per le regole CSS derivate.

## Norma (testo letto, registro fonti 03)
BSD-3-Clause: la ridistribuzione, anche modificata, e' consentita se si conservano avviso di copyright, condizioni e disclaimer (per i binari nella documentazione o in altri materiali) e se non si usano i nomi dei titolari per promuovere i derivati. CAD art. 69: software su specifiche della PA con licenza aperta in repertorio pubblico; le Linee guida su acquisizione e riuso consigliano EUPL-1.2 o, per software via rete, AGPL-3.0-or-later. Se un Comune ripubblica il codice, la licenza MIT dichiarata e' una scelta da confermare con il legale (titolarita' dei diritti, art. 69 c. 2).

## Requisiti
1. `Themes/Sixteen/docs/compliance/third-party-notices.md` (nessun file `.md` nella radice del tema, regola di progetto) con: testo BSD-3-Clause, titolari dall'AUTHORS aggiornato, elenco di Bootstrap Italia, Design Comuni pagine statiche, Titillium Web e gli altri font (licenza da leggere nei pacchetti), Leaflet, tessere OpenStreetMap (attribuzione dei dati).
2. L'intestazione del CSS generato (script `bashscripts/tools/visual/extract-used-css.mjs`) riproduce l'avviso completo, cosi' sopravvive alla rigenerazione.
3. Pagina «Crediti e licenze» raggiungibile dal footer (si integra con DCP-131), in 4 lingue.
4. File `LICENSE` nei repository del tema e del modulo Fixcity e decisione scritta sulla licenza (MIT, EUPL-1.2 o AGPL-3.0-or-later) con titolare dei diritti indicato dal Comune.
5. Correggere `NO_BOOTSTRAP_ITALIA.md` (non cancellare): distinguere pacchetto e regole derivate.

## Criteri di accettazione
- [ ] `head -20 laravel/Themes/Sixteen/resources/css/design-comuni/components.css` mostra avviso, condizioni e disclaimer; dopo una rigenerazione del file l'intestazione e' identica.
- [ ] `third-party-notices.md` elenca ogni componente copiato con la licenza letta dal pacchetto (nessuna licenza dichiarata «da memoria»).
- [ ] `/it/crediti` (o slug scelto) risponde 200 e il footer vi rimanda.
- [ ] La mappa mostra l'attribuzione OpenStreetMap (verifica visiva a 375 e 1440 px).
- [ ] La decisione sulla licenza e' nel decision log, con data e firmatario.

## Dipendenze e priorita'
DCP-131 (footer), DCP-137 (risorse di terze parti). P2: il rischio e' di reputazione e di conformita' di licenza, non di sicurezza dei cittadini. La rigenerazione del CSS richiede una build, non eseguita in DCP-112.
