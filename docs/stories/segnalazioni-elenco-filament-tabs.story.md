---
title: Segnalazioni elenco — Filament 5 tabs Mappa/Elenco
status: done
owner: Themes/Sixteen
scope: "cluster #139/#151/#155"
updated: 2026-11-23
---

# Obiettivo

Allineare la navigazione Mappa/Elenco al contratto Filament-first del tema Sixteen,
senza toccare filtri, GeoJSON o i blocchi `tests`.

## Decisione

`x-filament::tabs` e `x-filament::tabs.item` sono il componente di navigazione. Lo
stato resta nel solo scope Alpine del blocco e i pannelli continuano a usare `x-show`.
Bootstrap non gestisce questi tab: nessun `nav-tabs` o `data-bs-toggle="tab"` nello scope.

## Verifica

- Il test feature verifica Filament e l'assenza del markup Bootstrap tab.
- Build mirata del tema Sixteen.
