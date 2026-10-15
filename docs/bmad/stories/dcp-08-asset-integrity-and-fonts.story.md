---
id: dcp-08
title: "DCP-08: integrita' degli asset e font self-hosted"
type: story
epic: dc-parity-v2
status: in-progress
priority: P1
owner: theme:Sixteen
created: 2026-10-13
updated: 2026-10-13
qmd: "design comuni parity dcp-08: integrita' degli asset e font self-hosted bmad story"
tags: [docs, sixteen, bmad]
---

# DCP-08: integrita' degli asset e font self-hosted

## Evidenza e causa radice
`public/design-comuni/assets/images/evidenza-header.png` e `img-disservizio-thumbnail.png` erano file da 0 byte: lo script `npm run copy`
(`cp -vf ./docs/Main_files/five/assets/images/* ...`) li azzerava a ogni build perche' anche la sorgente era vuota. Per questo lo sfondo geometrico
di "Argomenti in evidenza" mancava (difetto 10 dell'audit). Sorgente e destinazione ripristinate da `assets/images` del riferimento (123.406 byte).

## Fatto
- Font Titillium Web, Lora, Roboto Mono scaricati in `public/design-comuni/assets/fonts/` e dichiarati con `@font-face` in `resources/css/design-comuni/fonts.css`.

## Da fare
1. Test o controllo di build che fallisce se un asset in `public/design-comuni/assets` o `docs/Main_files/five/assets` ha 0 byte.
2. Rimuovere l'`@import` di Google Fonts da `app.css` (CDN) dopo aver verificato che nessuna pagina dipenda da pesi non self-hosted.
3. Licenza: i font sono OFL; annotare la provenienza accanto ai file.

## Aggiornamento 2026-10-14 (DCP-183)
- Punto 2 ("Da fare"): l'`@import` di Google Fonts era gia' stato tolto da DCP-137 (zero richieste a Google, misurato).
- Punto 1 per i font: i woff2 sono ora sorgenti di Vite in `resources/fonts/` e `tests/Unit/FontsCssGuardTest.php` fallisce se un file manca, ha 0 byte o se un `url()` non e' relativo. Resta aperto il controllo per le immagini.
- I file in `public/design-comuni/assets/fonts/` restano finche' il CSS vivo non viene ricostruito (attivazione e motivi in [DCP-183](./dcp-183-font-come-asset-di-vite.story.md)).
- Punto 3 (provenienza e licenza OFL accanto ai file): ancora da fare, collegato a DCP-145.

## Criteri di accettazione
- `find public/design-comuni docs/Main_files -size 0` non restituisce immagini o font; il controllo e' automatico.
