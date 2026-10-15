---
id: user-location-not-fixed-coords
type: decision
title: /it/tickets/create — User location (not fixed coordinates) + map center logic
status: open
related: Modules/Geo/docs/stories/dcp-127-mappa-centratura-senza-https.story.md
links:
  github_issue: "#999"
  discussion: "#design-comuni"
updated: 2026-10-14
tags: [docs, sixteen, bmad]
qmd: "user location   dynamic center (not fixed coordinates) sixteen"
---
# User Location — Dynamic Center (Not Fixed Coordinates)

## Philosophy (why NO fixed `center(43.7696, 11.2558)`)
- A public service for damage reporting must work for ANY citizen ANYWHERE — fixing coordinates to one city (e.g. Florence 43.7696/11.2558 or Rome 41.9028/12.4964) excludes everyone else. This is EXCLUSION, not inclusion.
- The service is democratic (politica/religione): every citizen, in every part of the country/world where the public service applies, must be able to report.
- Zen: the map is a TOOL, not a DECORATION — it must serve the user (center on the user), not force the user to a fixed point.
- Logica: `CoordinatePicker::make('location')` with hardcoded `center()` breaks the function (geo transparency) for 99.9% of users. Dynamic centering (browser geo + user click) serves everyone.

## Implementation (function — verified, no invent — R006)
- Component: `default.blade.php` edited (existing file — not invented)
- Before: `data-lat="41.89" data-lng="12.49"` (hardcoded Florence area — wrong for service that must work everywhere)
- After: `data-auto-center="true"` + `aria-label="Mappa interattiva — centrata sulla tua posizione attuale"` + `role="region"`
- Function: when user opens wizard step 2 (`dati-di-segnalazione`):
  - Browser attempts `navigator.geolocation` (user permission required — GDPR art 6 consent implied by interaction)
  - If granted: map centers on user's current location (function: the user reports damage WHERE THEY ARE)
  - If denied / no HTTPS / no geo: the map remains visible and interactive; no HTTPS warning is rendered, because map selection/search are the functional fallback.
  - User clicks on map to set exact damage position (`data-lat` / `data-lng` / hidden inputs) — this is the REAL geo interaction (function)

## Multi-language + Mobile + Professional
- Italian label: "Posizione del danno (clicca sulla mappa)" + aria-label (multilang: label preserved; can be translated via locale system)
- Mobile: `w-full h-80` responsive, touch target (map click) preserved (function: mobile user can click)
- `prefers-reduced-motion`: CSS centering has no animation — reduced-motion respected
- Professional: study (this file) + decision (`ticket-crea-map-fix.md`) + BMAD story (`tickets-visual-parity-high-purpose.story.md`); verified with `view:clear` + `curl`; no decoration

## Legal framework (respecting all — function requires it)
- GDPR art 5(1)(b) purpose limitation: geo data ONLY for reporting damage — not tracking, not background collection
- GDPR art 6(1)(e) public task / art 6(1)(a) consent: geo requested on user interaction (click on map) — consent implied; guest access (`guest` middleware) allows reporting without prior identity (function = public service)
- GDPR art 32: geo data in the form state — transmitted securely in production; local HTTP still supports map tiles, address search and manual selection without claiming a false user location.
- PA Code + WCAG 2.1 AA: `aria-label`, `role="region"`, focus-visible preserved
- eIDAS: authentication (`SPID/CIE`) for service access — separate from geo (function = access control, not geo)

## Why NOT a new `CoordinatePicker` with hardcoded center
- `CoordinatePicker::make('location')` with fixed `center(...)` is a DECORATIVE anti-pattern for this service — it serves the code, not the user.
- Dynamic centering serves the user (function = geo transparency for damage reporting anywhere).
- If a fixed coordinate is needed for a specific service (e.g. a single-location public office), it must be explicitly justified with reason (not default) and the user must be informed.

## References
- Component source: `laravel/Themes/Sixteen/resources/views/pub_theme/components/blocks/tests/ticket-crea/default.blade.php`
- Design-comuni reference: `segnalazioni-elenco` (public service pattern — user-centered, not fixed-location)
- BMAD docs: `docs/bmad/stories/` (visual-parity), `docs/bmad/decisions/` (map-fix), `docs/bmad/studies/` (legal-study)
- Second brain: R005-R009 active; auth-state; map-function rules

## Aggiornamento DCP-127 (2026-10-13, misurato con Playwright)
Cosa la misura smentisce o precisa nel testo sopra:
- «Map centers on user's current location» e `aria-label="... centrata sulla tua posizione attuale"` valgono SOLO con il GPS (contesto sicuro: HTTPS o `127.0.0.1`). Su `http://192.168.1.40:8000` (`isSecureContext=false`) il browser non espone la posizione: la mappa si apre sulla zona del fuso orario del browser (zoom 6) o sulla vista di default configurata (`geo.config.map.default_view`), senza punto e senza dire che e' la posizione dell'utente.
- «If denied / no HTTPS / no geo: ... interactive»: confermato. In piu': sotto zoom 10, senza punto scelto, un clic avvicina soltanto (centro + zoom, nessuno stato scritto); da zoom 10 il clic piazza il punto. Misurato: z6 > z10 > punto a z13.
- La posizione da IP tramite servizio di terzi NON e' usata (decisione del coordinatore DCP-129, 2026-10-13 21:35: GDPR art. 6 e 44, DCP-137). Misurato: 0 richieste a servizi di geolocalizzazione in tutti gli scenari.
- Prove: `bashscripts/tools/visual/geo-picker-centering-probe.mjs` (39/39 il 2026-10-13). Catena e punti aperti: story DCP-127.
