---
title: "Header slim — stato autenticazione (Design Comuni)"
type: concept
confidence: high
updated: 2026-04-20
tags: [header, authentication, area-personale, bootstrap-italia, six]
sources:
  - ../../../resources/views/components/sections/header/v1.blade.php
  - ../../../resources/views/components/bootstrap-italia/header.blade.php
  - ../../../lang/it/ui.php
  - ../../../Main_files/five/segnalazione-area-personale.html
  - https://italia.github.io/design-comuni-pagine-statiche/sito/segnalazione-area-personale.html
related:
  - [story 5.0](../../../../../../.planning/stories/5.0-header-logged-in-state.story.md)
  - [playwright visual](../playwright-visual-testing.md)
---

# Header slim — stato autenticazione (Design Comuni)

## Regola operativa (memoria progetto)

| Stato | Cosa deve comparire nella `it-header-slim-right-zone` (zona destra della barra slim) |
|--------|----------------------------------------------------------------------------------------|
| **Non connesso** | Un solo pulsante primario: testo da `pub_theme::ui.personal_area` (es. «Accedi all'area personale»), link a `route('login')`. |
| **Connesso** | Blocco `it-user-wrapper`: **avatar** (prima `Profile::getAvatarUrl()` / `avatar_url`, poi `profile_photo_url` / `profile_photo_path`, altrimenti icona `it-user`), **nickname** (`profile.user_name` → `profile.full_name` → `user.user_name` → `user.full_name` → `name` → `email`), **dropdown** con voci tradotte (`pub_theme::ui.header_area_personale.*.label`) e **Esci** via `POST` su `route('logout')`. |

Non mostrare il pulsante «Accedi all'area personale» a utente già autenticato.

## Implementazione (path reale prima di tutto)

Per questo flusso il path reale parte da:

- `<x-section slug="header" />`

e va verificato prima in:

- `resources/views/components/sections/header/v1.blade.php`

Solo dopo si controllano eventuali partial secondari o file delegati.

Regola pratica:

- mai assumere direttamente `bootstrap-italia/header.blade.php` come owner senza verificare il percorso reale della section.

Implementazione corrente consolidata per `segnalazione-crea`:

- il file owner reale è `resources/views/components/sections/header/v1.blade.php`
- i dropdown slim usano **Alpine.js** (`x-data`/`x-show`) — NON `data-bs-toggle`, NON vanilla JS in `app.js`
- il resolver utente del section header privilegia il nome visibile e usa l'avatar solo come segnale secondario

Logica: `@guest` / `@else`. Dropdown: **Alpine.js** con `x-data="{ langOpen: false }"` e `x-show="langOpen"`.

Meccanismo attivo:
```blade
<div x-data="{ langOpen: false }" @click.away="langOpen = false">
    <button @click="langOpen = !langOpen" :aria-expanded="langOpen">
    <div class="dropdown-menu" x-show="langOpen" x-transition>
```

**VIETATO** aggiungere `data-bs-toggle="dropdown"` o un secondo sistema dropdown — il wiring Alpine è già presente.

**Causa tipica dropdown non funzionanti**: Bootstrap Italia CSS ha `.dropdown-menu { display: none !important }` che sovrascrive Alpine `x-show`. Fix: aggiungere `!important` all'override CSS o usare `x-show` con `x-transition` che forza inline style.

Traduzioni menu: namespace **`pub_theme`**, file `lang/{locale}/ui.php`, chiave radice **`header_area_personale`** (oggetti con `.label`, `.tooltip`, ecc., struttura estesa per i testi mostrati in UI).

Resolver auth corrente:

- display name: preferire nickname/profile owner-side e degradare fino a `email`
- avatar: preferire il resolver del `Profile`, non un path hardcoded nel tema

## Riferimento visivo

- Statico ufficiale: [segnalazione area personale](https://italia.github.io/design-comuni-pagine-statiche/sito/segnalazione-area-personale.html)
- Copia locale HTML: `Main_files/five/segnalazione-area-personale.html`

## Verifica con screenshot (guest vs auth)

1. Avviare l’app (`php artisan serve`).
2. Aprire ad esempio `/{locale}/tests/segnalazione-crea` (stesso header delle altre pagine che usano la section `header`).
3. **Guest**: catturare viewport con testo «Accedi…» e **nessun** nome utente.
4. Effettuare login, ricaricare la stessa URL: catturare **nome/avatar + chevron + menu** (aprire il dropdown e salvare un secondo screenshot se serve review UX).
5. Verificare anche il dropdown lingue: chiuso/aperto, coordinamento con il dropdown utente e parity colori del menu rispetto al reference.

Procedure strumentale: [playwright visual testing](../playwright-visual-testing.md) e, in root, `docs/wiki/concepts/playwright-mcp-screenshots.md` se presente.

## Link di menu (implementazione corrente)

Hub di contenuto su route Folio `tests.view`:

- Servizi: `slug` = `servizi`
- Pratiche / notifiche / impostazioni: hub `segnalazione-area-personale` (eventuali anchor dedicati in backlog)

## Contratto dropdown funzionale (regola 2026-04-20)

I dropdown lingua e utente slim usano **Alpine.js** (`x-data`/`x-show`) in `sections/header/v1.blade.php`. Devono essere **funzionalmente verificati**, non solo presenti nel DOM.

Checklist obbligatoria per ogni fix/story sull’header:
- [ ] click sul toggle → dropdown si apre (`x-show` diventa true, Alpine aggiunge `display:block`)
- [ ] secondo click o click fuori (`@click.away`) → dropdown si chiude
- [ ] Alpine.js caricato nel layout usato dalla pagina
- [ ] nessun Livewire `wire:navigate` o re-render che distrugge il contesto Alpine
- [ ] z-index e overflow non bloccano il menu
- [ ] avatar `<img>` ha classe `icon-white` (visibilità su barra slim scura)
- [ ] nome utente `<span>` ha `d-none d-lg-block` (responsive, come reference)
- [ ] chevron `<svg>` ha `icon-white d-none d-lg-block` (idem)
- [ ] colori sfondo/testo/icone/hover/focus coerenti con reference `graduatoria-area-personale.html`
- [ ] screenshot prima/dopo salvati come evidenza

Cause tipiche di dropdown non funzionanti:
- Bootstrap Italia CSS: `.dropdown-menu { display: none !important }` sovrascrive Alpine `x-show` inline style
- Alpine.js non caricato o inizializzato dopo il componente (`x-cloak` CSS mancante)
- Livewire full-page re-render che distrugge il contesto Alpine
- z-index / overflow / stacking context bloccante

## Regola UX blocco utente slim — "Mario Rossi"

Dalla reference `graduatoria-area-personale.html`, il blocco utente slim:
- comunica autenticazione tramite **NOME leggibile** (`Mario Rossi`) — non l'avatar
- il nome è **protagonista**: ben leggibile, non compresso in pill
- avatar/icona è **secondaria**, non dominante
- freccia dropdown è **visibile** — affordance obbligatoria
- NON deve sembrare un pulsante generico verde appiattito

**Vincoli visivi:**
- `VIETATO`: dare all'avatar peso visivo dominante
- `VIETATO`: comprimere il nome in una pill illeggibile
- `OBBLIGATORIO`: nome utente protagonista, leggibile, piena visibilità

## Anti-pattern

- Duplicare questa logica in altre view dell’header senza estrarre include: mantenere **un solo** punto (`sections/header/v1.blade.php`).
- Assumere il file owner dell’header senza seguire il path reale della section.
- Stringhe italiane hardcoded nel Blade per il menu utente: usare sempre `pub_theme::ui.header_area_personale`.
- Considerare i dropdown slim come decorazione invece che come parte del contratto runtime di navigazione.
- Validare i colori dei dropdown senza confronto screenshot sul reference reale.
- Chiudere una story header senza verificare click/open/close nel browser reale.

## Backlink

- [Story 5.0](../../../../../../.planning/stories/5.0-header-logged-in-state.story.md)
- [Overview tema](./../overviews/sixteen-theme.md)
