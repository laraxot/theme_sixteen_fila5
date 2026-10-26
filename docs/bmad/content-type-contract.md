---
title: "Sixteen: contratto Blog/Eventi"
type: decision-record
status: accepted
updated: 2026-10-15
tags: [sixteen, blog, post, content-type, event]
qmd: "Sixteen content_type post event Novità Eventi FO"
---

# Presentazione dei contenuti

Sixteen non introduce una tassonomia propria: legge il contratto del modulo Blog.

| `content_type` | Etichetta pubblica | Superficie |
|---|---|---|
| `post` | Novità | `/blog` e `/blog/{slug}` |
| `event` | Eventi | `/events` e `/events/{slug}` |

Entrambe riusano `Article`, blocchi, media e Comment. I campi
`event_start_date` / `event_end_date` si mostrano solo per `content_type=event`.

`Article.type` = Parental STI (`NULL` o FQCN). Sixteen non filtra né etichetta
con `type=post|event|article`.

Liste tipizzate: filtrare `content_type` prima di date e pubblicazione.
Legacy `content_type` nullo o `article` esclusi senza fallback documentato.

SSoT Blog: [content-type-contract.md](../../../../Modules/Blog/docs/bmad/content-type-contract.md).
