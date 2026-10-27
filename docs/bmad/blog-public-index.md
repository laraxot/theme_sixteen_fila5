---
title: "Blog pubblico — contratto tema Novità"
type: architecture
status: active
updated: 2026-10-16
tags: [sixteen, blog, novità, folio, cms, data-dc]
qmd: "blog.index CMS JSON ThemeComposer content_type post FO data-dc detail comments"
---

<!--
Supersedes: versione 2026-10-15 (mancava data-dc sul dettaglio).
Linked from: Blog/00-INDEX, inbound-fo-index, fo-comments.
User: organizzando meglio le cartelle docs dentro i temi.
-->

# Blog pubblico — contratto tema

Lista `blog.index` = JSON CMS Fixcity + blocco `pub_theme::components.blocks.blog.index`.

| Responsabilità | Dove |
|---|---|
| Lista | Folio shell `container0.index` + CMS `blog.index` + blocco tema |
| Post | `ThemeComposer` → `content_type=post` |
| Dettaglio | Folio + CMS `blog.view` + `blog.detail` |
| Chrome dettaglio | `layouts.app` + `data-dc`. Il JSON sta in `pages/blog/view.json` (slug `view`: la cartella aggiunge `blog.`) |
| Commenti | `CommentsWidget` (Comment) |

## Parity Design Comuni — `lista-risorse.html`

Target (tralasciando header/footer): HTML ≥90%, visual ≥95% vs
[lista-risorse.html](https://italia.github.io/design-comuni-pagine-statiche/sito/lista-risorse.html).

| Layer | Contratto |
|---|---|
| Shell Folio | `data-dc` su `.page-content` (CSS `body:has(.page-content[data-dc])`) |
| Chrome page | `body-page=lista-risorse` → `listing-parity.css` scoped |
| Blocco | breadcrumb → hero (`cmp-hero`) → evidenza (`title-xxlarge`) → explore (`bg-grey-card` + search + card + pagination) → rating/contacts |
| Card | `card-wrapper` + `img-responsive-panoramic` + `category-top` + titolo + excerpt; **no** `read-more` in evidenza |
| Date | `strtoupper(translatedFormat('j M Y'))` (es. `9 OTT 2026`) |

## Invariante lista

Per escludere i featured: `setCollection(...->reject(...)->values())`.
**Vietato** `transform` → `null` + `filter()` non riassegnato.
`$renderCard` solo `Article` → `?array`; loop con `@continue($card === null)`.
Fuori `@volt` **non** usare `$this` (500: “Using $this when not in object context”).

Evidence dettaglio: [investigations/blog-detail-data-dc-comments.md](./investigations/blog-detail-data-dc-comments.md).
Hub: [inbound-fo-index.md](./inbound-fo-index.md).
Blueprint: [blueprints/inbound-fo-blog.md](./blueprints/inbound-fo-blog.md).
Shell: [container0-index-shell-contract.md](./container0-index-shell-contract.md).
