---
id: IM-SIXTEEN-001
title: "Liste e dettaglio Novità FO (/blog)"
type: story
theme: Sixteen
module: Blog
epic: "III Presentazione front-office"
status: done
priority: P1
owner: theme:Sixteen + module:Blog
scope: "Modules/Blog/resources/views/pages/blog/, Themes/Sixteen/resources/views/components/blocks/blog/, Modules/Cms/app/Actions/ResolvePageAction.php"
created: 2026-10-15
updated: 2026-10-15
tags: [bmad, sixteen, blog, folio, wcag, design-comuni]
qmd: "FO /it/blog Novità Folio content_type post Design Comuni featured"
related: [IM-BLOG-002, IM-CMS-001, IM-SEO-001, IM-FIXCITY-004]
issues: []
discussions: []
---

# Liste e dettaglio Novità FO (`/blog`)

## Richiesta / scopo

Come cittadino voglio leggere le novità pubblicate su `/it/blog`, con dettaglio
su `/it/blog/{slug}`, coerenti con Design Comuni e dati reali Blog.

## Perché

Nav JSON già punta a `/blog`. Senza Folio la voce era 404. Il dominio è **post**
(`content_type=post`); la presentazione è Sixteen; l’authoring resta Filament Blog.

## Acceptance Criteria

- [x] Folio `blog.index` e `blog.show` risolvono sotto locale (`/it/blog`, `/it/blog/{slug}`).
- [x] Lista mostra solo `content_type=post` pubblicati; dettagli 404 se slug assente/non post.
- [x] Copy/SEO da CMS JSON `blog.index`; dati da `ThemeComposer`.
- [x] Card Design Comuni (immagine, categoria, data, titolo, excerpt) + empty state.
- [x] Sezione «In evidenza» (`is_featured|show_on_homepage`, sola lettura).
- [x] Dettaglio: SEO title da Article; alt/caption/credit; commenti + risposte.
- [x] `ResolvePageAction` blog → solo `findPublishedPostBySlug` (mai event).
- [x] Header/footer via `<x-section>` (layout Design Comuni).
- [ ] Lista Eventi `/events` (story dedicata).
- [ ] Audit WCAG formalizzato (smoke browser).

## Owned File / Module Scope

- `laravel/Modules/Blog/resources/views/pages/blog/index.blade.php`
- `laravel/Modules/Blog/resources/views/pages/blog/[slug].blade.php`
- `laravel/Themes/Sixteen/resources/views/components/blocks/blog/`
- `laravel/Modules/Fixcity/config/database/content/pages/blog.index.json`
- `ThemeArticleQueries::paginatedPosts` / `featuredPosts` / `findPublishedPostBySlug`
- `Modules/Cms/app/Actions/ResolvePageAction.php` (branch blog)

## Blueprint

[inbound-fo-blog.md](../blueprints/inbound-fo-blog.md) · Blog authoring:
[inbound-blog-events.md](../../../../../Modules/Blog/docs/blueprints/inbound-blog-events.md).
