---
title: "Sixteen: contratto Blog/Eventi"
type: decision-record
status: superseded
updated: 2026-10-27
superseded_by: ../../../../Modules/Blog/docs/stories/article-type-parental-sti-post-event.story.md
tags: [sixteen, blog, post, content-type, event]
qmd: "Sixteen content_type post event Novità Eventi FO"
---

# Presentazione dei contenuti

> **Superato (2026-10-27).** Le liste `/blog` e `/events` non filtrano piu' per `content_type`: `Post` e `Event` sono tipi Parental e
> il discriminatore e' `Article.type` (`post` | `event`). Vedi la
> [story Parental](../../../../Modules/Blog/docs/stories/article-type-parental-sti-post-event.story.md) e il contratto del Blog, anch'esso
> marcato superato. Etichette pubbliche e superfici qui sotto restano valide; cambia solo il campo.

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
