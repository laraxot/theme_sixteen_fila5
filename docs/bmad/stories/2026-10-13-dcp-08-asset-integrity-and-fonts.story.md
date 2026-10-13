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

## Criteri di accettazione
- `find public/design-comuni docs/Main_files -size 0` non restituisce immagini o font; il controllo e' automatico.
