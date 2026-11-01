---
title: "Story — Sixteen homepage JSON-driven restructure"
type: story
status: ready
story_id: STORY-SIXTEEN-HOMEPAGE-JSON-DRIVEN
created: 2026-10-09
updated: 2026-10-09
tags: [bmad, sixteen, homepage, json, story]
issues:
  - "https://github.com/laraxot/base_fixcity_fila5/issues"
discussions:
  - "https://github.com/laraxot/base_fixcity_fila5/discussions"
qmd: "story-sixteen-homepage-json-driven   ristrutturare homepage sixteen da json sixteen"
---

# STORY-SIXTEEN-HOMEPAGE-JSON-DRIVEN — Ristrutturare homepage Sixteen da JSON

## User story

Come cittadino guest voglio vedere la homepage FixCity con hero, mappa, spiegazione del processo e tracking pratica, così posso capire subito come segnalare e seguire un problema urbano.

## Context

La vecchia homepage viveva in `Themes/Sixteen/resources/views/pages/index.blade.php.old` con contenuto hardcoded. La nuova pagina Folio deve essere simile a TwentyOne e delegare i blocchi al CMS JSON tramite `<x-cms::page side="content" slug="home" />`.

## Scope

- creare o riusare blocchi Sixteen per le tre sezioni del vecchio file;
- correggere `config/local/fixcity/database/content/pages/home.json`;
- verificare `/it` via Playwright MCP e Puppeteer MCP.

## Acceptance criteria

1. `home.json` contiene solo blocchi equivalenti al vecchio file: hero+mappa, how-it-works, tracking.
2. Ogni `data.view` esiste e viene inclusa dal CMS senza eccezioni.
3. `/it` risponde senza “Internal Server Error”.
4. Non compare l’errore BladeUI Icons su `map-pin`.
5. La home mostra mappa, CTA segnalazione, accesso/registrazione o pratiche, tre step e tracking.
6. La documentazione BMAD del cluster `homepage-json-driven-*` esiste e descrive decisioni, UX, architettura e coverage.

## Tasks

- [ ] Creare BMAD docs del cluster homepage JSON-driven.
- [ ] Estrarre o creare blocchi compatibili con il vecchio layout.
- [ ] Aggiornare `home.json` seguendo il pattern `tickets.confirmation.json`.
- [ ] Validare JSON e view.
- [ ] Verificare browser con Playwright MCP.
- [ ] Verificare browser con Puppeteer MCP.

## Out of scope

- controller;
- servizi;
- redesign marketing non richiesto;
- modifica della logica ticket.
