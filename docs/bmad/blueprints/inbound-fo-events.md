---
title: "Blueprint FO — lista e dettaglio Eventi (/events)"
type: filament-blueprint
status: implemented
theme: Sixteen
module: Blog
created: 2026-10-15
updated: 2026-10-15
tags: [bmad, blueprint, sixteen, events, folio, design-comuni]
qmd: "FO events Eventi Folio ThemeComposer content_type event Design Comuni"
related:
  - ./inbound-fo-blog.md
  - ../content-type-contract.md
  - ../stories/inbound-fo-events-listing.story.md
  - ../../../../../Modules/Blog/docs/blueprints/inbound-blog-events.md
---

# Blueprint — FO `/events`

## Scopo

Esporre al cittadino gli **eventi** (`content_type=event`) come «Eventi»
(Design Comuni: Vivere il comune), con date tipografiche e header/footer JSON.
Nessun Controller, nessun modulo `Event`.

## Ownership

| Layer | Owner |
|---|---|
| Route Folio | `Modules/Blog/resources/views/pages/events/` |
| Copy / SEO | CMS JSON `events.index` |
| Query | `ThemeComposer::paginatedEvents` / `findPublishedEventBySlug` |
| Vestito | `pub_theme::components.blocks.events.{index,detail}` |
| Authoring BO | Filament `ArticleResource` + date condizionali Blueprint Blog |

## Contratto dati

- Lista: `content_type=event` + `published`, ordine `event_start_date`
- In evidenza: stesso filtro + (`is_featured` OR `show_on_homepage`); **no** update massivo
- Dettaglio: stesso filtro + slug via `ThemeComposer::findPublishedEventBySlug`; 404 se assente/post
- Mostra `event_start_date` / `event_end_date`; Parental `type` ignorato
- Commenti: sempre montare `CommentsWidget` (anche thread vuoto); guest
  `readOnly` + CTA login. Canon:
  [fo-comments filament-blueprint](../../../../../Modules/Comment/docs/bmad/fo-comments/filament-blueprint.md)
- Immagine dettaglio: `main_image_url` + blocco `image` (alt/caption/credit)

## UI (must)

- Breadcrumb Home / Eventi [/ titolo]
- Hero + sezione «Eventi in evidenza» (`featured_title` da JSON)
- Card con badge calendario (giorno/mese) + periodo
- Empty state `role=status`
- Dettaglio: SEO title Article, periodo, body, figcaption, commenti/risposte, link ritorno

## Fuori scope

Iscrizioni, capienza, ICS, pagamenti, modulo Event, «Luoghi in evidenza».
