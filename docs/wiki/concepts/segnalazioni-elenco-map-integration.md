# Segnalazioni elenco — integrazione mappa in Sixteen

## Ownership

- Tema Sixteen: struttura Blade della pagina, sidebar filtri, tab mappa/lista.
- Modulo Geo: componente mappa riusabile `<geo-map-lit>` e logica interattiva Leaflet/Lit.
- Modulo Fixcity: dominio ticket + generazione GeoJSON (`GenerateTicketsJsonAction`).

## Integrazione corrente nel blade

File owner:

- `../../resources/views/components/blocks/segnalazioni/layout.blade.php`

Pattern attivo:

- mappa in tab con `<geo-map-lit id="ticket-map" data-url="/data/tickets.json">`
- asset JS servito via Vite dal modulo Geo:
  - `Vite::asset('resources/js/components/geo-map-lit.js', 'assets/geo')`
- nessun asset Leaflet/MarkerCluster caricato via CDN nel tema

## Filtri categoria

I checkbox della sidebar filtrano i marker senza refetch:

- `input[name="category"]` con value = `TicketTypeEnum::value`
- script pagina: checkbox change -> `map.filterByType(value|null)`

Questo mantiene DRY/KISS:

- il tema decide solo *quando* filtrare (evento UI),
- il componente Geo decide *come* filtrare i marker.

## Contratto dati

Il componente legge un GeoJSON da:

- `/data/tickets.json`

Il file viene prodotto da:

- `../../../../Modules/Fixcity/app/Actions/GenerateTicketsJsonAction.php`

Campi minimi richiesti nei `properties`:

- `id`, `title`, `type`, `type_label`, `type_color`, `address` (eventuale `description`)

## Comportamento UX atteso

- clustering marker attivo con logica zoom-based + size dinamica per densita marker
- nessun cluster su singolo marker (`minimumClusterSize: 2`)
- niente coverage polygon hover (`showCoverageOnHover: false`) per parity con `farmshops.eu`
- popup informativo al click marker
- ricerca indirizzo collassata di default e apribile via controllo lente
- chiusura ricerca con toggle lente, `Escape` o click fuori dalla search

## Riferimenti

- componente Geo: `../../../../Modules/Geo/resources/js/components/geo-map-lit.js`
- wiki Geo entity: `../../../../Modules/Geo/docs/wiki/entities/geo-map-lit.md`
- wiki Geo cluster: `../../../../Modules/Geo/docs/wiki/concepts/geo-map-lit-marker-clusters.md`
- riferimento esterno farmshops: [direktvermarkter.js](https://github.com/CodeforKarlsruhe/farmshops.eu/blob/master/js/direktvermarkter.js)
