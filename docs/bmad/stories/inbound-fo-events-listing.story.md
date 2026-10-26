---
id: IM-SIXTEEN-002
title: "Liste e dettaglio Eventi FO (/events)"
type: story
theme: Sixteen
module: Blog
epic: "III Presentazione front-office"
status: done
priority: P1
owner: theme:Sixteen + module:Blog
scope: "Modules/Blog/resources/views/pages/events/, Themes/Sixteen/resources/views/components/blocks/events/"
created: 2026-10-15
updated: 2026-10-15
tags: [bmad, sixteen, events, folio, design-comuni]
qmd: "FO /it/events Eventi Folio content_type event Design Comuni"
related: [IM-SIXTEEN-001, IM-BLOG-002, IM-BLOG-003, IM-FIXCITY-004]
issues: []
discussions: []
---

# Liste e dettaglio Eventi FO (`/events`)

## Richiesta / scopo

Come cittadino voglio esplorare gli appuntamenti pubblici su `/it/events` e
aprirne il dettaglio, con date e presentazione Design Comuni.

## Perché

Nav JSON già punta a `/events`. Stesso modello `Article` del blog, discriminator
`content_type=event` (mai Parental `type`). Mirror operativo di IM-SIXTEEN-001.

## Acceptance Criteria

- [x] Folio `events.index` e `events.show` sotto locale (`/it/events`, `/it/events/{slug}`).
- [x] Lista solo `content_type=event` pubblicati; dettaglio 404 se slug non evento.
- [x] Copy/SEO da CMS `events.index`; dati da `ThemeComposer`.
- [x] Sezione «Eventi in evidenza» (`featuredEvents` sola lettura).
- [x] Card con badge calendario + periodo; empty state.
- [x] Dettaglio: SEO title Article; alt/caption/credit; commenti + risposte.
- [x] `ResolvePageAction` events → solo `findPublishedEventBySlug`.
- [x] Header/footer via layout Design Comuni.
- [ ] Audit WCAG formalizzato (smoke browser).
- [ ] Luoghi in evidenza (fuori scope inbound; Design Comuni statico su `/tests/eventi`).

## Owned File / Module Scope

- `Modules/Blog/resources/views/pages/events/`
- `Themes/Sixteen/resources/views/components/blocks/events/{index,detail}`
- `Modules/Fixcity/config/database/content/pages/events.index.json`
- `ThemeArticleQueries::paginatedEvents` / `featuredEvents` / `findPublishedEventBySlug`
- `Modules/Cms/app/Actions/ResolvePageAction.php` (branch events)

## Blueprint

[inbound-fo-events.md](../blueprints/inbound-fo-events.md) · Blog authoring:
[inbound-blog-events.md](../../../../../Modules/Blog/docs/blueprints/inbound-blog-events.md).
