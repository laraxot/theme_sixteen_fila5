---
title: "Dettaglio blog — body invisibile con CommentsWidget"
type: investigation
status: resolved
theme: Sixteen
module: Blog
created: 2026-10-16
updated: 2026-10-16
tags: [bmad, blog, comments, data-dc, design-comuni]
qmd: "blog detail data-dc CommentsWidget layout app body missing"
related:
  - ../blueprints/inbound-fo-blog.md
  - ../stories/inbound-fo-blog-listing.story.md
  - ../../../../../Modules/Comment/docs/bmad/fo-comments/decision-log.md
issues: []
discussions: []
---

<!--
Supersedes: nessun doc precedente sul sintomo «body sparisce con commenti»
sul dettaglio FO (solo listing inbound-fo-blog). Linked from:
Comment/docs/bmad/fo-comments/decision-log.md e inbound-fo-blog blueprint.
User: «al posto di aggiungere i commenti non si vede piu' il contenuto della pagina».
-->

# Dettaglio `/it/blog/{slug}` — contenuto sparisce con i commenti

## Sintomo

Su `/it/blog/dopo-l-invio-come-seguire-una-segnalazione` titolo e immagine
restano; sotto, body e sezione commenti sembrano assenti. HTML e query OK.

## Causa

Il dettaglio chiede lo slug CMS `blog.view`. Quel file vive in
`pages/blog/view.json` (dentro la cartella lo slug è solo `view`). Senza quel
JSON la shell Folio stampa un `<main>` vuoto: il titolo c'è, il corpo no.
Senza `data-dc` il CSS legacy nasconde comunque il body.

## Fix

1. `mount()`: Article in `blog|events` → `isDesignComuni=true` (`data-dc`).
2. Layout: `layouts.app`, `headerActive` `news`/`live`; `design-comuni` è solo il valore storico del contenuto CMS.
3. `header.json`: `element: news` (`/blog`), `element: live` (`/events`).
4. Comment: view esplicita + `approved()` FO.

## Verifica

`data-dc` sul `.page-content`; chrome DC; body + commenti approvati visibili.

## Follow-up 2026-10-16 — cookiebar copre il body

Anche con `data-dc`, lead/body stavano a y≈789–841 mentre `.gdpr-cookiebar`
fissa occupa dal y≈749: nel primo viewport il testo era **sotto la barra**.

Fix: nel dettaglio, lead+paragrafi **prima** dell’immagine; `padding-bottom`
su `body:has(.gdpr-cookiebar:not([hidden]))` nel cookie consent.
