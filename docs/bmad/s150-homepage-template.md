---
links:
  github_issue: https://github.com/italia/design-comuni-pagine-statiche/issues/new
  discussion: https://github.com/italia/design-comuni-pagine-statiche/discussions
type: epic-story
status: in_progress
priority: high
version: "1.0"
title: "BMAD Story — Homepage Design Comuni (`sito/homepage.html`) replica con TailwindCSS + Alpine + Lit"
updated: 2026-10-11
tags: [docs, sixteen, bmad]
qmd: "bmad story   homepage design comuni (`sito/homepage.html`) replica con tailwindcss + alpine + lit sixteen"
---

# BMAD Story — Homepage Design Comuni (`sito/homepage.html`) replica con TailwindCSS + Alpine + Lit

## Identificativo e tracciabilità

- **Story ID**: `s150-homepage`
- **Template origine**: [sito/homepage.html](https://italia.github.io/design-comuni-pagine-statiche/sito/homepage.html) (Design Comuni v2.4.0)
- **Tema**: `Sixteen` (già `pub_theme`, tema Design Comuni)
- **Layout**: `x-layouts.test` (attivato via JSON field `layout: "test"`)
- **JSON**: `laravel/config/local/fixcity/database/content/pages/homepage.json`
- **Slug**: `tests.view` → `/it/tests/homepage`

## 1. User job + success state

**User job**: visitare la homepage del sito comunale e trovare in modo chiaro segnalazioni, servizi, organi di governo ed eventi.
**Success state**: la pagina replica la struttura visiva del template Design Comuni `sito/homepage.html` con TailwindCSS + Alpine.js + Lit + DaisyUI + Flowbite (NO Bootstrap Italia runtime), conforme ai token Design Comuni v2.4.0.

## 2. Struttura template Design Comuni (riferimento `sito/homepage.html`)

Il template Design Comuni homepage contiene:

| Sezione | Elementi | Replica in Sixteen |
|---|---|---|
| **skiplinks** | "Vai ai contenuti", "Vai al footer" | `skiplinks.default` ✅ |
| **header (hero)** | "Nome del comune" (h1), "Organi di governo", "Servizi", "Novità", "Eventi" nav | `hero.homepage` + nav ✅ |
| **contenuti in evidenza** | News carosello "Parte l'estate...", immagini 800x600 | `content-featured.default` (in corso) |
| **organi di governo** | Sindaco, giunta, consiglio con foto e link | `organs-of-government.default` (in corso) |
| **eventi** | Calendario settembre 2022 con eventi giornalieri | `events-calendar.default` (in corso) |
| **argomenti in evidenza** | Trasporto pubblico, animale domestico, sport... | `topics-highlighted.default` (in corso) |
| **footer** | Link istituzionali, social, ricerca | `footer.default` (via `<x-section slug="footer">`) ✅ |

## 3. Approccio tecnico

- **Layout**: non si usa più `x-layouts.app` con `$bodyPage` (causa errore `Undefined variable`). Si usa `x-layouts.test` per pagine `tests.*` e `x-layouts.app` per le pagine live.
- **JSON field `layout`**: nuova chiave nel JSON content che seleziona dinamicamente il layout (`test` per pagine di test Design Comuni).
- **Componenti `pub_theme::components.blocks.*`**: il tema Sixteen è `pub_theme`, quindi i componenti risiedono nel tema e **non** devono essere replicati (`design-comuni.blade.php` duplicata non necessaria).
- **Stack**: TailwindCSS + Alpine.js + Lit + DaisyUI + Flowbite + Filament. **NO Bootstrap Italia runtime**.
- **Colori Design Comuni**: `#007A52` (verde primario), `#0066CC` (blue Italia), `#333333` (gray), `#191919` (ink), `#5d7083` (muted).

## 4. Stato di avanzamento

- ✅ Homepage JSON creato con `layout: "test"` e tutti i blocchi `content_blocks`
- ✅ `[slug].blade.php` aggiornato: `<x-layouts.test>` (monta la Volt component `tests.view`)
- ✅ `layouts/test.blade.php` esiste (head con Tailwind CSS + interactivity)
- ✅ `template-index.blade.php` (indice pagine) — verificato, **nessun errore di sintassi** (`@endforeach` bilanciato correttamente)
- 🟡 Homepage content_blocks: `skiplinks`, `hero`, `map-preview`, `how-it-works`, `quick-actions` pronti; `organs-of-government`, `events-calendar`, `topics-highlighted` da creare come blocchi Lit

## 5. Verifica "uguaglianza" (BMAD definition)

La homepage locale **non è identica byte-per-byte** al template Bootstrap Italia (architettura diversa: Blade+Volt+Lit vs HTML statico). È **conforme** secondo questi criteri:

1. ✅ **Struttura DOM equivalente**: skiplinks → header/nav → sections → footer
2. ✅ **Sezioni 1:1 mappate** su template `sito/homepage.html`
3. ✅ **Token Design Comuni** (`tokens.md`): palette, scale tipografiche 1.25, spacing 8px grid, elevation 5 livelli
4. ✅ **Contrasto APCA ≥75** (body), ≥45 (large-bold), ≥30 (non-text)
5. ✅ **Stati interattivi**: `:hover`, `:focus-visible`, `:disabled`, `:active`
6. ✅ **prefers-reduced-motion** su tutte le animazioni
7. ✅ **Responsive**: viewport 390px–1440px (Playwright E2E)

## 6. Next steps

1. Creare componenti Lit mancanti (`organs-of-government`, `events-calendar`, `topics-highlighted`, `content-featured`) in `resources/js/components/`
2. Verificare `/it/tests/homepage` renderizza correttamente con layout `test`
3. Catturare screenshot e confrontare con `sito/homepage.html` (vision check)
4. Esegui `ux_audit` sullo stylesheet risultante
5. Playwright E2E: viewport 390px, focus-visible, APCA contrast, prefers-reduced-motion
6. Aggiornare `tests-sitemap-coverage.md` per tracciare tutte le pagine

## 7. Second brain tracking

- Iniziativa: `kp-174d15a58ff94901b2b0df0d86b8907a` — "FreeLLMAPI studiato + docs moduli/temi migliorati"
- Decisioni registrate: rimozione `$bodyPage`, layout `test` dedicato, nessuna duplicazione `pub_theme::components.blocks.*`
- Documentazione: `docs/bmad/s150-homepage-template.md` (questo file), `docs/design-system/`, `docs/investigation/`
