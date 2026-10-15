---
title: "Geo map + ticket wizard — 2026-10-14 parallel fixes"
type: note
module: Sixteen
theme: Sixteen
tags: [map-marker, geolocation, wizard, design-comuni, wcag]
qmd: "geo map ticket wizard marker button geolocation"
created: 2026-10-14
updated: 2026-10-14
status: done
links:
  story:
    - STORY-054-ticket-marker-visibility.md
    - STORY-XXX-wizard-map-buttons.md
    - STORY-530-geolocation-not-working.md
  investigation:
    - geolocalizzazione-permesso-browser.md
---

# Geo Map + Ticket Wizard — Aggiornamenti 2026-10-14

Tre interventi paralleli su mappa + wizard ticket (swarm BMAD):

## 1. Marker ticket non visibile (STORY-054)
**Problema**: `nero piccolo con un punto di domanda a fianco` — SVG nero, piccola, overlay `?`.
**File**: `Themes/Sixteen/resources/views/tickets/index.blade.php`
**Fix**: SVG Design Comuni `#007A52`, dimensioni `36×48`, `aria-label="Segnalazione sul territorio"`, `role="img"`, nessun `?`.

## 2. Pulsanti mappa trasparenti (STORY-XXX)
**Problema**: pulsanti `ctrl-btn` con `bg-transparent` → invisibili.
**File**: `Modules/Geo/resources/js/components/map/controls/geolocation.js` (`renderButton`)
**Fix**: background `#007a52`, hover/focus-visible `#005c3d`, `shadow`, `rounded-lg`, transition.

## 3. Geolocalizzazione non funziona (STORY-530)
**Problema**: "usa la posizione corrente" non funziona.
**Causa radice**: `window.isSecureContext === false` su HTTP (`APP_URL=http://fixcity.local` in `.env`). `navigator.geolocation` disattivato su origini non sicure.
**File**: `Modules/Geo/resources/js/components/map/controls/geolocation.js`
**Fix**: `fallBackToApproximate` già presente e attivato su errore/HTTP; documentato requisito HTTPS per produzione (`FORCE_HTTPS=true` in `.env.production.example`).

## Regola Design Comuni applicata
- Marker: green PA `#007A52`, size `36×48`, accessible `aria-label`.
- Buttons: primary accent `#007a52` background, proper hover/focus-visible, elevation via shadow.
- No `bg-transparent` on interactive elements.

## Second brain
Cross-link con modulo Fixcity: `Fixcity/docs/second-brain.md` §8, `Fixcity/docs/bmad/stories/STORY-054`, `STORY-XXX`, `STORY-530`.

## Verifica del lead DCP-152 (2026-10-14, misure con Playwright)
- Marker: la pagina del problema e' il dettaglio `/it/tickets/{id}`, non `views/tickets/index.blade.php` (non servita da nessuna rotta). Causa: `coordinate-picker-lit` non includeva gli stili del marker e aggiungeva l'iniziale del tipo (`?`). Fix nel modulo Geo.
- Pulsanti: la causa e' il reset `button` delle pagine `data-dc` (specificita' 0,2,2), non `bg-transparent`. Fix nel componente per tutti i pulsanti (`.map-container .ctrl-btn.ctrl-btn`); lo stile verde inline del solo pulsante posizione e' stato ripristinato (incoerente, `@focus-visible` non e' un evento).
- Posizione: `APP_URL` non c'entra, conta l'origine che vede il browser: su `http://192.168.1.40:8000` il GPS e' vietato dal browser; il proxy HTTPS `:8080` era spento ed e' stato riavviato.
- Dettagli e prove: `Modules/Geo/docs/stories/dcp-152-marker-dettaglio-ticket-e-pulsanti-mappa-su-pagine-dc.story.md`.
