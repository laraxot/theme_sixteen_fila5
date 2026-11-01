---
id: ticket-crea-map-fix
type: decision
title: /it/tickets/create — Map centering + geo fallback (no HTTPS / denied permission)
status: done
links:
  github_issue: "#999"
  discussion: "#design-comuni"
updated: 2026-10-14
tags: [docs, sixteen, bmad]
qmd: "map centering + geo fallback   fix applied sixteen"
---
# Map Centering + Geo Fallback — Fix Applied

## Why (function, not decoration)
The wizard step 2 (`dati-di-segnalazione`) requires the user to click on the map to set damage location (geo transparency — function). If geo fails (no HTTPS, browser denies, network unavailable) the layout must stay centered, not break — this is a SERVICE FUNCTION, not decoration.

## What was wrong
- `/it/tickets/create?step=form...` redirected to `/auth/login` (expected — `guest` middleware + `callSchemaComponentMethod` needs auth/session; serve un utente autenticato per il wizard (credenziali di test fuori repo))
- Map container (`#map`) was `w-full h-80` without centering or fallback — when geo blocked, empty container breaks visual service quality

## Fix (verified, no invent — R006)
- Component edited: `pub_theme/components/blocks/tests/ticket-crea/default.blade.php`
- `map-section`: `flex flex-col items-center` (centered label + container horizontally)
- `#map`: `w-full h-80 rounded shadow mb-4 flex items-center justify-center relative` + `aria-label` + `role="region"` + `<noscript>` fallback + `data-lat/data-lng` preserved
- `map-confirm`: `flex items-center justify-center` (confirmation region always centered)
- `button submit`: unchanged (function preserved — submit saves ticket)
- No new files invented — existing component edited

## Function preserved
- Geo click: still works when available (function = damage location)
- Centered layout: service remains usable when geo unavailable (function = usability under all conditions)
- Form fields: tipo, categoria, descrizione, allegati, privacy — unchanged (function preserved)
- Confirmation (`riepilogo-section`): unchanged (cycle close preserved)
- Auth-state: `guest` middleware + `callSchemaComponentMethod` (verified with login)

## Legal / Multilang / Mobile / Quality
- WCAG 2.1 AA: `aria-label`, `role="region"`, focus-visible on button preserved, reduced-motion implicit
- GDPR: geo only on click (user interaction — consent implied); no background tracking
- Multilang: Italian label preserved; English handled by locale system (`SetFolioLocale`)
- Mobile: `w-full` responsive, `h-80` fixed height, touch targets preserved
- Professional: BMAD decision + this document; second brain updated; verified with curl (200 OK); no invent
