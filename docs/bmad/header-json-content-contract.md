---
title: "Header Sixteen: contratto contenuti JSON"
type: architecture-contract
status: active
tags: [bmad, second-brain, ponytail, header, json, accessibility]
updated: 2026-10-17
qmd: "scopo sixteen"
---

# Scopo

`<x-section slug="header">` risolve il blocco locale `header.json` per la
lingua corrente e passa i dati al template. Il JSON è la fonte di verità per
ogni contenuto percepibile dell'intestazione: nome, slogan, regione, etichette,
link, navigazione, social, ricerca, lingue e menu.

La Blade è il vestito: struttura semantica, classi responsive, icone,
interazione Alpine/Bootstrap-compatible e attributi tecnici di accessibilità.
Non deve inventare testi, destinazioni o fallback visibili.

## Flusso canonico

```text
header.json locale → Section → blocks → header/v1
                              └──────→ renderer tipografico/accessibile
```

Gli URL memorizzati nel JSON passano da `FrontofficeUrl` quando sono link
interni, così il cambio lingua non duplica prefissi. Un link esterno resta
esterno. Un valore vuoto non genera `href="#"`.

## Regole di qualità

- aggiungere o cambiare copy e link nel JSON della tenant/lingua;
- mantenere nel template solo presentazione e comportamento;
- ogni controllo interattivo deve avere nome accessibile dal JSON e focus
  visibile;
- mantenere target touch di almeno 44px e funzionamento a zoom 200%;
- dopo modifiche al JSON eseguire `php artisan optimize:clear` prima dei test.

## Verifica

- test di rendering con slogan, label e URL sentinella provenienti dal JSON;
- test che impedisce il ritorno di copy hardcoded nei renderer;
- axe WCAG 2.1 AA a 375 e 1440px;
- verifica manuale tastiera, zoom 200% e contrasto.
