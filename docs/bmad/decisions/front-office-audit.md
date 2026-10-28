---
title: "Front office audit — Sixteen — gravatar, comment reply, markdown editor, header avatar"
date: "2026-10-26"
status: decision-adopted
owner: theme-sixteen
tags: [bmad, sixteen, front-office, comment, gravatar, header, ponytail]
---

# Front office audit — Sixteen

## Audit completo (Ponytail + Second Brain + Filament blueprint)

Verifica sistematica del front office: pagine reali (CMS, blog, eventi, ticket detail/track, commenti, area personale). Non pagine test. Regola: riuso prima di inventare; Filament way (widgets, actions, viewmodels); no Bootstrap Italia nel front office; `pub_theme::` namespace.

## Lacune rilevate

### 1. Header — nessun gravatar dell'utente loggato (missing)
- `components/blocks/header-area-personale/default.blade.php` mostra nome/email ma nessun avatar.
- Il modulo `Comment` ha già `Modules\Comment\App\Actions\Gravatar\ResolveGravatarUrlAction.php` e `BuildGravatarUrlAction.php` (reuso).
- Fix Ponytail (1 riga): aggiungere `<img>` con `Gravatar::resolve()` nel componente header-area-personale.

### 2. Commenti — manca reply/thread (missing)
- `Modules/Comment/app/Filament/Widgets/Comment/CommentWidget.php` (ridotto in commit `2105e05`) non espone reply.
- Pacchetto `spatie/laravel-comments` supporta reply (`Comment` modello con `parent_id`).
- Decisione: estendere widget Filament con action `Reply` che apre un form inline (Ponytail: 1 action + 1 partial view).

### 3. Commenti — manca rich/markdown editor nel modo Filament (missing)
- `new-comment.blade.php` usa `textarea` standard; nessun `MarkdownEditor` Filament.
- Fix: sostituire `textarea` con `<x-filament::markdown-editor />` (o `RichEditor` se disponibile nel tema).
- Regola `filament-first-rule`: usare componenti Filament, mai custom HTML.

### 4. Commenti — menzioni (`MentionsFoOptInTest`) non attivate nel front office (partial)
- `MentionsFoOptInTest.php` esiste ma il widget `Commentable/CommentsWidget.php` non include menzioni nel front office.
- Fix: aggiungere `mentions()` nel widget commenti front office.

### 5. Header — nome layout duplicato rimosso, ma header `v1.blade.php` non ha `tpl="design-comuni"` (verificato)
- `header/v1.blade.php` confermato SSoT; `header/design-comuni.blade.php` rimosso (`fbc2224`).
- Nessun fix richiesto.

## Implementazione Ponytail (minima, verificabile)

### Fix 1 — Gravatar nell'header per utente loggato (`pub_theme::components.blocks.header-area-personale.default`)
- Reuso: `Modules\Comment\App\Actions\Gravatar\ResolveGravatarUrlAction.php` + `Gravatar::resolve()`.
- Codice: 1 linea `<img>` con `src` da `resolve()`.
- Non crea nuovi file; modifica solo il componente esistente.

### Fix 2 — Comment widget: markdown editor (parziale, documentato)
- File: `Modules/Comment/resources/views/filament/widgets/comment/comment.blade.php`
- Sostituire `<textarea>` con componente Filament markdown.
- Non modifica schema DB; solo UI.

### Fix 3 — Comment widget: reply action (parziale, documentato)
- Aggiungere action `Reply` al widget `Comment/CommentWidget.php` con partial `components/blocks/comment/reply.blade.php` nel tema Sixteen.
- Non crea nuove pagine; usa widget Filament esistente.

### Fix 4 — Menzioni nel widget commenti FO
- Aggiungere `mentions()` nel widget `CommentsWidget.php` (front office).

## Verifica

- `phpstan analyse Modules Themes --autoload-file=tests/TestCase.php` → 0 errori dopo fix.
- `graphify update .` → grafo aggiornato con nuove relazioni (reply, gravatar).
- `vendor/bin/pest --filter=HeaderGuestCtaAccessibleNameTest` → verde.
- Nessun nuovo file in `Themes/*/resources/views/pages` oltre `auth`, `[container0]`, `tests`, `index.blade.php` (ok).

## Fix applicato (Ponytail — minimale)

- Header `header-area-personale/default.blade.php`: immagine `<img>` gravatar aggiunta (`Gravatar::url()`), riuso `Comment` module.
- Search-modal residuale: `design-comuni.blade.php` spostato in `.old`; `search-modal.blade.php` (v1, root section) confermato SSoT.
- Nessun file nuovo in `Themes/*/resources/views/pages` oltre quelli consentiti.
