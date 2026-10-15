---
type: decision
slug: geo-dynamic-user-location
status: applicato
filosofia: il cittadino segnala il danno dove si trova — il luogo è nel presente, non un punto fisso; la mappa deve centrare sull'utilizzatore
scopo: componente mappa geo deve usare lat/lng del record SE presenti; altrimenti centrarsi sulla posizione attuale dell'utente (navigator.geolocation); mai coordinate fisse (43.7696, 11.2558) come default
funzionalita: JS geolocation con richiesta permesso browser; se non disponibile la mappa resta interattiva con ricerca/click; nessuna coordinata comunale hardcoded
norme: privacy (GDPR — richiesta permesso esplicito per geolocation); accessibilità (aria-label, focus-visible); multilingua; mobile (touch, responsive); trasparenza amministrativa (dati aperti — posizione segnalazione pubblica)
zen: il cittadino non segna 'dove dovrei andare', ma 'dove sono ora' — la responsabilità è nel presente
second-brain: kp-174d15a58ff94901b2b0df0d86b8907a (aperto, geo persistente, geolocation dinamica, auth-state)
antierrore: non impostare coordinate fisse (NO CoordinatePicker::make con valori hardcoded); verificare con ls/find; docs in Sixteen/docs/
title: "Geo — Localizzazione Dinamica dell'Utente (Non Coordinate Fisse)"
updated: 2026-10-14
tags: [docs, sixteen, bmad]
qmd: "geo   localizzazione dinamica dell'utente (non coordinate fisse) sixteen"
---
# Geo — Localizzazione Dinamica dell'Utente (Non Coordinate Fisse)

Correzione applicata a `laravel/Themes/Sixteen/resources/views/components/blocks/geo/mappa-static.blade.php`:
- Se `$lat` / `$lng` presenti nel record (wizard step 2 salvato) → usali.
- Altrimenti: chiamata JS `navigator.geolocation.getCurrentPosition()` con richiesta permesso esplicito.
- Se il browser rifiuta/non può concedere la posizione (ad esempio HTTP su un IP), la mappa resta utilizzabile con ricerca indirizzo, click e trascinamento; non si attribuisce all'utente una posizione inventata.
- La mappa UI si centra dove è l'utente — il pin si sposta, non è fisso.
- NON usare `CoordinatePicker::make('location')->center(43.7696, 11.2558)` — coordinate fisse violano il senso del servizio.
- Non passare coordinate di Firenze/Roma come default dal form: il centro configurabile è riservato a record o integrazioni che lo forniscano esplicitamente.
- `navigator.geolocation` richiede un secure context secondo il browser; su `http://192.168.1.40` non è tecnicamente aggirabile dal JavaScript della pagina.
- **DCP-127 (2026-10-13, misurato)**: «La mappa UI si centra dove è l'utente» vale solo con il GPS (contesto sicuro). Senza (HTTP su IP di rete) si apre sulla zona del fuso orario o sulla vista di default dell'ente, e un clic sotto zoom 10 avvicina soltanto, senza piazzare il punto. Nessun servizio di terzi per la posizione (decisione DCP-129). Dettagli e prove: `laravel/Modules/Geo/docs/stories/dcp-127-mappa-centratura-senza-https.story.md`.
