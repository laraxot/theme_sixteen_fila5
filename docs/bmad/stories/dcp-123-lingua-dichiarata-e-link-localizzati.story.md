---
id: dcp-123
title: "DCP-123: la lingua dichiarata coincide con quella del testo e i link del chrome mantengono la lingua"
type: story
epic: dc-parity-v2
status: ready-for-dev
priority: P1
owner: theme:Sixteen
created: 2026-10-13
updated: 2026-10-13
qmd: "lang parti fallback html lang wcag 3.1.2 hreflang canonical link localizzati ResolveLocalizedBlockDataAction route Folio nome rotte selettore lingua query string"
related: [dcp-120, dcp-121]
tags: [docs, sixteen, bmad]
---

# DCP-123: dichiarare la lingua vera e non perdere la lingua nei link

Nata da DCP-120. Non implementata la' perche' tocca un altro repo git (`Modules/Cms`) e piu' vie diverse di fallback: serve una decisione, non un ritocco.

## Problema (provato il 2026-10-13)
1. Una pagina senza i blocchi nella lingua richiesta ricade sull'italiano ma resta sotto `<html lang="de">` (WCAG 2.1 3.1.2, livello AA). Succede oggi per le 88 pagine `tests.*` (solo `it` ed `en`), per `/tickets` e `/auth/login` in parte, e succedera' per ogni pagina nuova scritta solo in italiano.
2. `<x-page>` e' la classe `Modules\Cms\View\Components\Page` che rende `Modules/Cms/resources/views/components/page.blade.php`, una vista senza wrapper. La vista `Themes/Sixteen/resources/views/components/page.blade.php` (con un `<div>` di wrapper) non e' usata da `<x-page>`: un tentativo di `lang` li' e' stato provato e ritirato perche' non produceva nulla.
3. I `url` di header, footer e modale non hanno prefisso lingua: i percorsi reali (`/domande-frequenti`) funzionano solo se prefissati; i segnaposto danno 404 in ogni caso. `ResolveLocalizedBlockDataAction` esiste ma e' chiamata solo da `Modules/UI` (`Render\Block`), non dal percorso `x-section` / `x-page`.
4. `route('container0.view', ...)` e `route('tickets.track')` restituiscono sempre `/it/...` perche' le rotte Folio condividono il nome e vince l'ultima registrata (`FolioVoltServiceProvider.php:117,157`, ordine `de, en, es, it`). DCP-120 ha aggirato il problema solo nella home e nel footer.
5. Il selettore lingua perde la query string e non ha `lang`/`hreflang` sui link; mancano `hreflang` e `canonical` nell'`<head>`.

## Criteri di accettazione
- [ ] Per ogni pagina CMS senza blocchi nella lingua richiesta, il contenuto in fallback e' racchiuso in un elemento con `lang="it"` (la lingua del fallback) e il resto della pagina conserva la lingua del prefisso; nessun elemento in piu' quando la lingua c'e'; un test Pest con una pagina senza `de` lo prova.
- [ ] Lo stesso per le stringhe `__()` di file lang con fallback: almeno un metodo documentato (per esempio `Lang::handleMissingKeysUsing` che registra la chiave, e un test che fallisce per le pagine della home e del login) o, se si decide di non farlo, la decisione scritta con il motivo.
- [ ] Nessun cambio visivo: confronto a 375, 768 e 1440 px sulle pagine `it` ed `en` prima e dopo, differenza zero; l'`lang` non attiva regole CSS (ricerca `[lang` e `:lang(` nel CSS compilato).
- [x] (2026-10-22, `FolioVoltServiceProvider::localizeFolioNamedRoutes`, test `Cms/tests/Unit/Support/LocalizedFolioRoutesTest.php`) `route()` con locale `de` restituisce `/de/...`, oppure un helper unico `localeRoute()`/`localizeURL` e' usato da tutti i JSON; `grep` di `route('container0` nei JSON di pagina vuoto; il caso `/de` -> pulsante principale -> `/de/tickets/create` e' provato con Playwright.
- [ ] I `url` di header, footer e modale sono localizzati in un punto solo (vista `x-section` o azione chiamata da `Section`), con le stesse regole di `ResolveLocalizedBlockDataAction` (mai `//`, `#`, `http`); un test di vista lo prova.
- [ ] Il selettore lingua conserva la query string, ha `lang` e `hreflang` sui link (`<a lang="de" hreflang="de">Deutsch</a>`) e un nome per esteso nascosto visivamente; axe a 0 violazioni serious/critical.
- [ ] `<head>` emette `<link rel="alternate" hreflang>` per le lingue in cui la pagina esiste davvero (non per quelle in fallback) e `canonical`.
- [ ] La radice `/` sceglie la lingua per `Accept-Language` quando e' tra le servite (o per un cookie scritto dal selettore) invece di rimandare sempre a `/it`; la decisione (cookie si/no) e' documentata in `docs/i18n/00-comportamento-multilingua.md`.
- [ ] `/DE` (maiuscolo) rimanda a `/de`.

## Proposta del meccanismo minimo
Aggiungere nel `Page` component di `Modules/Cms` la lingua realmente servita (`$servedLocale`, prima non vuoto tra `getTranslations($field)` per la lingua richiesta e il fallback) e in `cms::components.page` un wrapper `<div lang="...">` solo quando differisce dalla lingua dell'app. Per la home e per `tests.*` e' sufficiente; per `__()` serve un criterio separato. Rischio da misurare: i selettori CSS con `>` sui figli diretti del wrapper delle pagine `tests.*`.

## Coordinamento
Tocca `Modules/Cms` (repo separato) e il tema: chiedere conferma al proprietario del modulo. Non toccare `sections/header/design-comuni.blade.php` senza avvisare l'altra sessione dell'header.
