---
title: "Blueprint FO — lista e dettaglio Novità (/blog)"
type: filament-blueprint
status: implemented
theme: Sixteen
module: Blog
created: 2026-10-15
updated: 2026-10-16
tags: [bmad, blueprint, sixteen, blog, folio, design-comuni]
qmd: "FO blog Novità Folio ThemeComposer content_type post Design Comuni"
related:
  - ../content-type-contract.md
  - ../stories/inbound-fo-blog-listing.story.md
  - ../../../../../Modules/Blog/docs/blueprints/inbound-blog-events.md
---

# Blueprint — FO `/blog`

## Scopo

Esporre al cittadino i **post** editoriali (`content_type=post`) come
«Novità», con layout Design Comuni e header/footer JSON. Nessun Controller.

## Ownership

| Layer | Owner |
|---|---|
| Route Folio | `Modules/Blog/resources/views/pages/blog/` |
| Copy / SEO | CMS JSON `blog.index` |
| Query | `ThemeComposer::paginatedBlogPosts` / `findPublishedPostBySlug` |
| Vestito | `pub_theme::components.blocks.blog.{index,detail}` |
| Authoring BO | Filament `ArticleResource` + Blueprint Blog |

## Contratto dati

- Lista: `content_type=post` + `published` + `publishedUntilToday`
- In evidenza: stesso filtro + (`is_featured` OR `show_on_homepage`); **no** update massivo
- Dettaglio: stesso filtro + slug via `ThemeComposer::findPublishedPostBySlug`; 404 se assente/event. La shell è il JSON `pages/blog/view.json` (dentro la cartella lo slug è `view`, Sushi lo legge `blog.view`)
- Parental `type` ignorato
- Commenti: sempre montare `CommentsWidget` (anche thread vuoto); guest
  `readOnly` + CTA login; auth `readOnly=false`. Canon:
  [fo-comments filament-blueprint](../../../../../Modules/Comment/docs/bmad/fo-comments/filament-blueprint.md)
- Immagine dettaglio: `main_image_url` + blocco `image` (alt/caption/credit)

## UI (must)

- Ref parity body: `lista-risorse.html` (HTML ≥90% / visual ≥95%, no header/footer)
- Shell lista: `data-dc` + `body-page=lista-risorse` (vedi [blog-public-index.md](../blog-public-index.md))
- Breadcrumb Home / Novità
- Hero `cmp-hero` titolo + intro da JSON
- Sezione «Notizie in evidenza» (`featured_title`) senza link `read-more`
- Explore `bg-grey-card` + search + conteggio + card + pagination DC
- Card: immagine panoramica, categoria, data maiuscola, titolo, excerpt
- Empty state `role=status`
- Dettaglio Article: sempre chrome DC + `data-dc`. Il blocco lo monta `pages/blog/view.json`; il testo resta sull'Article
  Evidence: [blog-detail-data-dc-comments.md](../investigations/blog-detail-data-dc-comments.md).

## Fuori scope

`/events`, iscrizioni, ICS, filtri avanzati, rename model `Article`→`Post`.
