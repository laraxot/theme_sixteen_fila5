---
title: "Contratto — Sixteen Folio page shell"
type: presentation-contract
contract: Themes\\Sixteen\\resources\\views\\pages
tags: [contract, folio, shell, theme]
created: 2026-11-23
updated: 2026-11-23
issues:
  - "https://github.com/laraxot/theme_sixteen_fila5/issues/104"
---

# Sixteen Folio page shell

Contratto della superficie pubblica delle pagine dinamiche del tema.

## Input

- Parametri Folio ricevuti da `mount()` (`container0`, `slug0`, `container1`).
- `slug1` quando la rotta usa il quarto livello
  `[container0]/[slug0]/[container1]/[slug1]`.
- Data bag opaco passato a `<x-page>`.
- `PageSlugMiddleware` applicato alla pagina.

## Output

Una shell Volt statica che monta `<x-layouts.app>` e delega il contenuto a
`<x-page>` con lo slug CMS e il data bag ricevuti.

## Invarianti

- `name()` e `@volt()` sono statici e coerenti.
- Il quarto livello usa `container1.view` come nome Volt e conserva tutti i
  quattro segmenti nel data bag.
- Il mount non esegue query, redirect, metadata o logica di dominio.
- La risoluzione pagina e la protezione appartengono a Cms e middleware.
- Il tema possiede solo shell, accessibilità, chrome e markup dei blocchi.
- I blocchi editoriali e del wizard sono data-driven: testo, URL, stato e
  configurazione arrivano dal CMS o da un payload dichiarato; la stessa vista
  non viene copiata per pagine equivalenti.
- La parità Design Comuni è una proprietà verificabile del codice e dei dati
  presenti; non è una giustificazione per creare screenshot, pagine o fixture
  non tracciati.

## Effetti collaterali

- Applica il middleware dichiarato dalla pagina.
- Renderizza i blocchi CMS nel layout Sixteen.

## Errori

- Pagine o record non risolti vengono gestiti dal middleware, Cms o Action owner.
- La shell non converte eccezioni di dominio in fallback visuali.

## Non fa

- Non contiene `render()` dinamico.
- Non interroga direttamente `Page` o modelli di dominio.
- Non crea pagine semantiche parallele per ticket, profili, blog o eventi.
- Non incorpora testo editoriale, URL di pagina o stato del wizard nella vista
  condivisa quando possono appartenere al payload CMS.
