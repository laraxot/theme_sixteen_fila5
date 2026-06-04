# Sixteen Theme Wiki

Indice operativo minimo del wiki tema `Sixteen`.

## Scopo

Il tema accumula solo conoscenza locale di presentazione, parity visuale, asset pipeline e boundary tema/modulo.
Le regole generiche di context compression restano nel wiki root e nel modulo AI; qui si documenta solo l'impatto sul corpus del tema.

**Stack frontoffice (pub)**: Tailwind + [DaisyUI docs](https://daisyui.com/docs/) + Alpine + Lit (Geo) + Filament v5 dove applicabile; **alias stile preferiti con `@apply`** nel CSS tema: [bootstrap-italia-tailwind-philosophy](./concepts/bootstrap-italia-tailwind-philosophy.md); nomi classe Design Comuni / HTML semantico: [design-comuni-class-mapping](./entities/design-comuni-class-mapping.md).

## Pagine
- [geo-map-lit-reconstruction-guide.md](../../../Modules/Geo/docs/wiki/concepts/geo-map-lit-reconstruction-guide.md) — ricostruire mappa `/it` da documentazione
- [segnalazioni-elenco-map-integration.md](./concepts/segnalazioni-elenco-map-integration.md) — blade, filtri, contratto JSON
- [geo-map-marker-civic-pin-theme-boundary.md](./concepts/geo-map-marker-civic-pin-theme-boundary.md) — override CSS marker
- [geo-map-popup-leaflet-boundary.md](./concepts/geo-map-popup-leaflet-boundary.md) — popup + conflitti CSS tema
- [geo-map-lit-reconstruction-guide.md](../../../Modules/Geo/docs/wiki/concepts/geo-map-lit-reconstruction-guide.md) — ricostruzione marker + popup (SSoT modulo Geo)
- [geo-map-fixes-registry.md](../../../Modules/Geo/docs/wiki/concepts/geo-map-fixes-registry.md) — tabella correzioni INC-1…8
- [global-header-css-leak-leaflet-popup.md](./troubleshooting/global-header-css-leak-leaflet-popup.md) — leak CSS header su popup mappa
- [geo-map-marker-civic-pin-theme-boundary.md](./concepts/geo-map-marker-civic-pin-theme-boundary.md) — confine CSS marker FO
- [geo-map-popup-leaflet-boundary.md](./concepts/geo-map-popup-leaflet-boundary.md) — confine popup + fix header parity
- [marker-cluster-hover-stability.md](./concepts/marker-cluster-hover-stability.md) — STORY-123 cluster hover
- [map-lit-vite-build-troubleshooting.md](./concepts/map-lit-vite-build-troubleshooting.md) — STORY-121 bundle 404
- [map-lit-legend-theme-boundary.md](./concepts/map-lit-legend-theme-boundary.md) — STORY-094 confine tema/Geo
- [map-lit-cluster-type-icons](../../../../../Modules/Geo/docs/wiki/concepts/map-lit-cluster-type-icons.md) — sizing pallini cluster
- [ui-ai-tooling-on-demand.md](./concepts/ui-ai-tooling-on-demand.md) — STORY-126 strumenti UI/AI e MCP
- [frontend-design-fixcity-overlay.md](./concepts/frontend-design-fixcity-overlay.md) — skill Anthropic frontend-design adattata PA/Fixcity

- [map-lit-ticket-api](../concepts/map-lit-ticket-api.md) — consumer API Folio `/api/tickets/geojson` e ticket-details (STORY-052/069)
- [no-italian-component-names](./rules/no-italian-component-names.md) — **REGOLA CRITICA**: nomi componenti in inglese (`ticket/`, non `segnalazioni/`)


- [filament-first-frontoffice](./concepts/filament-first-frontoffice.md) — Filament Blade su FO (`x-filament::tabs` su `/it`, skin Design Comuni)
- [segnalazioni-elenco-filament-tabs](./concepts/segnalazioni-elenco-filament-tabs.md) — tab Mappa/Elenco STORY-065
- [wizard-parity-documentation-map](./concepts/wizard-parity-documentation-map.md) — ordine lettura parity segnalazione (dry tema)
- [bootstrap-italia-tailwind-philosophy](./concepts/bootstrap-italia-tailwind-philosophy.md) — `@apply` come alias, HTML semantico
- [daisyui-pro-contro-metriche](./concepts/daisyui-pro-contro-metriche.md) — sintesi tema; SSoT in modulo Cms
- [context-compression-plugin](./concepts/context-compression-plugin.md)
- [design-comuni-class-mapping](./entities/design-comuni-class-mapping.md) — Tailwind, DaisyUI, parity PA, Filament
- [ridondanze-documentazione-wizard](./concepts/ridondanze-documentazione-wizard.md) — quando conviene fusionare slice doc wizard vs tenerle separate

## Collegamenti root

- [context-mode-integration](../../../../../docs/wiki/concepts/context-mode-integration.md)
- [context-compression-plugin-openrouter](../../../../../docs/wiki/concepts/context-compression-plugin-openrouter.md)
- [trigger-map](../../../../../docs/wiki/rules/00-TRIGGER_MAP.md)
