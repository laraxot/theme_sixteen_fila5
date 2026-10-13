---
id: dcp-137
title: "DCP-137: risorse di terze parti: Google Fonts, tessere OpenStreetMap, Nominatim"
type: story
epic: dc-parity-v2
status: ready-for-dev
priority: P1
owner: theme:Sixteen + module:Geo
created: 2026-10-13
updated: 2026-10-13
qmd: "google fonts self host titillium web tile openstreetmap nominatim terze parti ip visitatore informativa csp trasferimenti"
related: [dcp-112, dcp-136, dcp-139, dcp-130]
---

# DCP-137: nessuna richiesta di terze parti non dichiarata

Nata da DCP-112 (matrice normativa N-17; matrice interfaccia I-22).

## Lacuna e prova (2026-10-13)
- Playwright su 10 pagine: `fonts.googleapis.com` e `fonts.gstatic.com` su tutte (`@import` in `Themes/Sixteen/resources/css/app.css:9` e `css/thematic/fonts.css:4`, finito nel CSS compilato `app-I0Ze3QDs.css`); `a.tile.openstreetmap.org`, `b.tile...`, `c.tile...` su `/it` e `/it/tickets`.
- Le copie locali dei font esistono: `Themes/Sixteen/public/design-comuni/assets/fonts/{Titillium_Web,Lora,Roboto_Mono}` (woff2).
- Lato server: i metodi Livewire `searchAddress` e `reverseGeocode` interrogano `nominatim.openstreetmap.org` con testo libero (DCP-49 SEC-07, letto, non rieseguito).
- Nessuna di queste destinazioni e' nell'informativa.

## Norma
GDPR art. 5 e art. 13 par. 1 lett. e)-f) (destinatari e trasferimenti), testo nel registro fonti 02. Il comunicato del Garante del 23.6.2022 su Google Analytics (doc. web 9782874) non e' una linea guida e riguarda un altro strumento: l'estensione ai font e alle mappe e' una valutazione del DPO (NON VERIFICATO).

## Requisiti
1. Servire Titillium Web (e gli altri font usati) dai file locali con `@font-face`; togliere l'`@import` verso Google. Richiede una nuova build del tema (non eseguita in DCP-112).
2. Mappe: decidere tra (a) tessere servite da un fornitore con accordo o da un proprio server, (b) tessere OSM con informativa e attribuzione. Il default attuale e' (b) senza informativa.
3. Nominatim: documentare quali dati partono (testo digitato), User-Agent, limite di frequenza (rimando a DCP-138), e darne conto nell'informativa; valutare un proxy lato server che non inoltri altro.
4. Aggiornare la CSP di DCP-139 con l'elenco finale degli host.

## Criteri di accettazione
- [ ] Log di rete Playwright su `/it`, `/it/tickets`, `/it/auth/login`: zero richieste a `fonts.googleapis.com` e `fonts.gstatic.com`.
- [ ] `grep -c 'fonts.googleapis.com' laravel/../public_html/themes/Sixteen/assets/app-*.css` del manifest corrente = 0.
- [ ] Gli host delle mappe restanti sono elencati nell'informativa (DCP-130) con la finalita'.
- [ ] Attribuzione OpenStreetMap visibile sulla mappa (licenza dei dati: DCP-145).

## Dipendenze e priorita'
DCP-130, DCP-136, DCP-139, DCP-145. P1.
